
<?= $this->extend('layout/tempmain') ?>

<?= $this->section('content') ?>

<div id="content" class="app-content">

    <div class="panel panel-inverse">

        <div class="panel-heading">
            <h4 class="panel-title">Edit User</h4>
        </div>

        <div class="panel-body">

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= esc(session()->getFlashdata('success')) ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif; ?>

            <form method="post"
                  action="<?= base_url('update_user/' . $user->user_id) ?>">

                <?= csrf_field() ?>

                <div class="row mb-3">
                    <label class="col-md-3 col-form-label">Full Name</label>
                    <div class="col-md-6">
                        <input type="text"
                               name="full_name"
                               class="form-control"
                               value="<?= esc($user->full_name ?? '') ?>"
                               required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-md-3 col-form-label">Email</label>
                    <div class="col-md-6">
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="<?= esc($user->email ?? '') ?>"
                               required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-md-3 col-form-label">Mobile</label>
                    <div class="col-md-6">
                        <input type="text"
                               name="mobile"
                               class="form-control"
                               maxlength="10"
                               value="<?= esc($user->mobile ?? '') ?>"
                               required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-md-3 col-form-label">New Password</label>
                    <div class="col-md-6">
                        <input type="password"
                               name="password"
                               class="form-control"
                               autocomplete="new-password"
                               placeholder="Leave blank to keep existing password">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-md-3 col-form-label">Address</label>
                    <div class="col-md-6">
                        <textarea name="address"
                                  class="form-control"
                                  rows="3"><?= esc($user->address ?? '') ?></textarea>
                    </div>
                </div>

                <hr>

                <h5 class="mb-3">Role & Permissions</h5>

                <div class="row mb-4">
                    <label class="col-md-3 col-form-label">Select Role</label>

                    <div class="col-md-6">
                        <select name="role_id"
                                id="role_id"
                                class="form-control"
                                onchange="loadRolePermissions(this.value)">

                            <option value="">No Role / Custom Permissions</option>

                            <?php foreach ($roles as $role): ?>

                                <?php if (strtolower(trim($role['role_name'])) === 'super admin') continue; ?>

                                <option value="<?= $role['role_id'] ?>"
                                    <?= (isset($selectedRole) && $selectedRole == $role['role_id']) ? 'selected' : '' ?>>
                                    <?= esc($role['role_name']) ?>
                                </option>

                            <?php endforeach; ?>

                        </select>
                        <button type="button"
                                class="btn btn-sm btn-secondary mt-2"
                                onclick="loadRolePermissions(document.getElementById('role_id').value)">
                            Reset to Role Defaults
                        </button>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5>Individual Permissions</h5>

                    <div>
                        <button type="button"
                                class="btn btn-sm btn-success"
                                onclick="selectAllPermissions(true)">
                            Select All
                        </button>

                        <button type="button"
                                class="btn btn-sm btn-danger"
                                onclick="selectAllPermissions(false)">
                            Clear All
                        </button>
                    </div>
                </div>

                <p class="text-muted">
                    Select the permissions this user should have.
                    These selections will override the role's default permissions.
                </p>

                <?php
                $permissionMap = [];

                foreach ($permissions as $permission) {
                    $permissionMap[$permission['module_id']][$permission['action_name']]
                        = $permission['permission_id'];
                }

                $assignedPermissions = array_map(
                    'intval',
                    $assignedPermissions ?? []
                );

                $groupedModules = [];

                foreach ($modules as $module) {

                    // User Management is reserved for Super Admin.
                    if (in_array(
                        strtolower(trim($module['module_name'])),
                        ['user management', 'roles & permissions', 'create user']
                    )) {
                        continue;
                    }

                    $groupName = !empty($module['parent_name'])
                        ? $module['parent_name']
                        : 'Other Modules';

                    $groupedModules[$groupName][] = $module;
                }

                $actions = ['view', 'add', 'edit', 'delete'];
                ?>

                <?php if (!empty($groupedModules)): ?>

                    <?php foreach ($groupedModules as $groupName => $groupModules): ?>

                        <div class="card mb-3 permission-group">

                            <div class="card-header bg-light">
                                <strong><?= esc($groupName) ?></strong>
                            </div>

                            <div class="card-body">

                                <div class="table-responsive">

                                    <table class="table table-bordered align-middle">

                                        <thead>
                                            <tr>
                                                <th>Module</th>
                                                <?php foreach ($actions as $action): ?>
                                                    <th class="text-center">
                                                        <?= ucfirst($action) ?>
                                                    </th>
                                                <?php endforeach; ?>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            <?php foreach ($groupModules as $module): ?>

                                                <tr>

                                                    <td>
                                                        <?= esc($module['module_name']) ?>
                                                    </td>

                                                    <?php foreach ($actions as $action): ?>

                                                        <td class="text-center">

                                                            <?php
                                                            $permissionId =
                                                                $permissionMap[$module['module_id']][$action] ?? null;
                                                            ?>

                                                            <?php if ($permissionId): ?>

                                                                <input type="hidden"
                                                                       name="permission_ids[]"
                                                                       value="<?= esc($permissionId) ?>">
                                                                <input type="checkbox"
                                                                       class="user-permission"
                                                                       name="permissions[]"
                                                                       value="<?= $permissionId ?>"
                                                                       <?= in_array(
                                                                           (int)$permissionId,
                                                                           $assignedPermissions,
                                                                           true
                                                                       ) ? 'checked' : '' ?>>

                                                            <?php else: ?>

                                                                <span class="text-muted">-</span>

                                                            <?php endif; ?>

                                                        </td>

                                                    <?php endforeach; ?>

                                                </tr>

                                            <?php endforeach; ?>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    <?php endforeach; ?>

                <?php else: ?>

                    <div class="alert alert-warning">
                        No modules available.
                    </div>

                <?php endif; ?>

                <div class="mt-4 text-center">

                    <button type="submit" class="btn btn-primary">
                        Update User
                    </button>

                    <a href="<?= base_url('create_user') ?>"
                       class="btn btn-secondary">
                        Cancel
                    </a>

                </div>

            </form>

        </div>
    </div>

</div>

<script>

function selectAllPermissions(status) {
    document.querySelectorAll('.user-permission').forEach(function(box) {
        box.checked = status;
    });
}

function loadRolePermissions(roleId) {

    const checkboxes = document.querySelectorAll('.user-permission');

    checkboxes.forEach(function(box) {
        box.checked = false;
    });

    if (!roleId) {
        return;
    }

    fetch("<?= base_url('get_role_permissions') ?>?role_id=" + encodeURIComponent(roleId))
        .then(response => {
            if (!response.ok) {
                throw new Error('Unable to load permissions');
            }
            return response.json();
        })
        .then(permissionIds => {

            checkboxes.forEach(function(box) {
                box.checked = permissionIds.includes(parseInt(box.value, 10));
            });

        })
        .catch(error => {
            console.error(error);
            alert('Unable to load role permissions.');
        });
}

</script>

<?= $this->endSection() ?>
