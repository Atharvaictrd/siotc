
<?= $this->extend('layout/tempmain') ?>

<?= $this->section('content') ?>

<div id="content" class="app-content">
    <div class="col-xl-12">

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

        <!-- 1. ADD ROLE -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h3 class="panel-title">Add Role</h3>
            </div>

            <div class="panel-body">
                <form method="post" action="<?= base_url('save_role') ?>">
                    <?= csrf_field() ?>

                    <div class="form-group row">
                        <div class="col-xl-2 offset-xl-3">
                            <b>Role Name :</b>
                        </div>

                        <div class="col-xl-4">
                            <input type="text"
                                   name="role_name"
                                   class="form-control"
                                   placeholder="Enter role name"
                                   value="<?= esc(old('role_name') ?? '') ?>"
                                   required>
                        </div>
                    </div>
                    <br>

                    <div class="form-group row">
                        <div class="col-xl-2 offset-xl-3">
                            <b>Description :</b>
                        </div>

                        <div class="col-xl-4">
                            <textarea name="description"
                                      class="form-control"
                                      placeholder="Enter description"><?= esc(old('description') ?? '') ?></textarea>
                        </div>
                    </div>
                    <br>

                    <div class="form-group row">
                        <div class="col-xl-12 text-center">
                            <button type="submit" class="btn btn-success col-xl-2">
                                Create Role
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- 2. ASSIGN PERMISSIONS -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h3 class="panel-title">Assign Permissions (Pages)</h3>
            </div>

            <div class="panel-body">

                <form method="get" action="<?= base_url('create_role') ?>">
                    <div class="form-group row">
                        <div class="col-xl-2">
                            <b>Select Role :</b>
                        </div>

                        <div class="col-xl-4">
                            <select name="role_id"
                                    class="form-control"
                                    onchange="this.form.submit()"
                                    required>
                                <option value="">Select Role</option>

                                <?php foreach ($roles as $role): ?>
                                    <option value="<?= $role['role_id'] ?>"
                                        <?= (string)$selectedRole === (string)$role['role_id'] ? 'selected' : '' ?>>
                                        <?= esc($role['role_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </form>

                <?php if (!empty($selectedRole)): ?>

                    <hr>

                    <form method="post" action="<?= base_url('save-role-permissions') ?>">
                        <?= csrf_field() ?>

                        <input type="hidden" name="role_id"
                               value="<?= esc($selectedRole) ?>">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered align-middle w-100">
                                <thead>
                                    <tr>
                                        <th>Module / Page</th>
                                        <th class="text-center">View</th>
                                        <th class="text-center">Add</th>
                                        <th class="text-center">Edit</th>
                                        <th class="text-center">Delete</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($modules as $module): ?>
                                        <tr>
                                            <td>
                                                <b><?= esc($module['parent_name'] ?? '') ?></b>
                                                <?= !empty($module['parent_name']) ? ' - ' : '' ?>
                                                <?= esc($module['module_name']) ?>
                                            </td>

                                            <?php foreach (['view', 'add', 'edit', 'delete'] as $action): ?>
                                                <td class="text-center">
                                                    <?php
                                                    $permissionId = null;

                                                    foreach ($permissions as $permission) {
                                                        if (
                                                            $permission['module_id'] == $module['module_id'] &&
                                                            $permission['action_name'] == $action
                                                        ) {
                                                            $permissionId = $permission['permission_id'];
                                                            break;
                                                        }
                                                    }
                                                    ?>

                                                    <?php if ($permissionId): ?>
                                                        <input type="checkbox"
                                                               name="permissions[]"
                                                               value="<?= $permissionId ?>"
                                                               <?= in_array($permissionId, $assignedPermissions) ? 'checked' : '' ?>>
                                                    <?php else: ?>
                                                        -
                                                    <?php endif; ?>
                                                </td>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <button type="submit" class="btn btn-success">
                            Save Permissions
                        </button>
                    </form>

                <?php else: ?>
                    <div class="alert alert-info">
                        Please select a role to assign permissions.
                    </div>
                <?php endif; ?>

            </div>
        </div>

        <!-- 3. ROLE LIST -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h3 class="panel-title">Role List</h3>
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle w-100">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Role Name</th>
                                <th>Description</th>
                                <th>Assigned Permissions</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($roles)): ?>
                                <?php $i = 1; ?>
                                <?php foreach ($roles as $role): ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= esc($role['role_name']) ?></td>
                                        <td><?= esc($role['description'] ?? '') ?></td>
                                        <td>
                                            <?= $rolePermissionCounts[$role['role_id']] ?? 0 ?>
                                            permissions
                                        </td>
                                        <td>
                                            <?php if ($role['status'] == 1): ?>
                                                <span class="badge bg-success">Active</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Inactive</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('create_role?role_id=' . $role['role_id']) ?>"
                                               class="btn btn-primary btn-sm">
                                                Assign / Edit Permissions
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">
                                        No roles found.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>
