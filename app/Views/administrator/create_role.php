
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

        <!-- CREATE ROLE -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Create Role</h4>
            </div>

            <div class="panel-body">
                <form method="post" action="<?= base_url('save_role') ?>">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label>Role Name</label>
                        <input type="text"
                               name="role_name"
                               class="form-control"
                               style="max-width:350px"
                               placeholder="Enter role name"
                               value="<?= esc(old('role_name') ?? '') ?>"
                               required>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Create Role
                    </button>

                    <button type="reset" class="btn btn-danger">
                        Reset
                    </button>
                </form>
            </div>
        </div>

        <!-- ASSIGN PERMISSIONS -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Assign Permissions</h4>
            </div>

            <div class="panel-body">

                <form method="get" action="<?= base_url('create_role') ?>">
                    <div class="row align-items-end">
                        <div class="col-md-4">
                            <label>Select Role</label>
                            <select name="role_id" class="form-control"
                                    onchange="this.form.submit()" required>
                                <option value="">-- Select Role --</option>

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

                    <form method="post" action="<?= base_url('save-role-permissions') ?>"
                          id="permissionForm">

                        <?= csrf_field() ?>

                        <input type="hidden" name="role_id"
                               value="<?= esc($selectedRole) ?>">

                        <div class="mb-3">
                            <button type="button" class="btn btn-primary btn-sm"
                                    onclick="setAllPermissions(true)">
                                Select All
                            </button>

                            <button type="button" class="btn btn-default btn-sm"
                                    onclick="setAllPermissions(false)">
                                Clear All
                            </button>
                        </div>

                        <?php
                        $groupedModules = [];

                        foreach ($modules as $module) {
                            $groupName = $module['parent_name'] ?: 'Other Pages';
                            $groupedModules[$groupName][] = $module;
                        }
                        ?>

                        <?php foreach ($groupedModules as $groupName => $groupModules): ?>

                            <div class="panel panel-default mb-3">
                                <div class="panel-heading"
                                     style="cursor:pointer"
                                     onclick="toggleGroup(this)">

                                    <label style="margin:0;cursor:pointer">
                                        <input type="checkbox"
                                               class="group-checkbox"
                                               onclick="event.stopPropagation(); toggleGroupPermissions(this)">
                                        <?= esc($groupName) ?>
                                    </label>

                                    <span class="pull-right">
                                        <i class="fa fa-chevron-down"></i>
                                    </span>
                                </div>

                                <div class="panel-body group-content"
                                     style="display:block;padding:0">

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Page</th>
                                                    <th class="text-center">View</th>
                                                    <th class="text-center">Add</th>
                                                    <th class="text-center">Edit</th>
                                                    <th class="text-center">Delete</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php foreach ($groupModules as $module): ?>
                                                    <tr>
                                                        <td><?= esc($module['module_name']) ?></td>

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
                                                                           class="permission-checkbox"
                                                                           name="permissions[]"
                                                                           value="<?= $permissionId ?>"
                                                                           <?= in_array((int)$permissionId, $assignedPermissions) ? 'checked' : '' ?>>
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
                                </div>
                            </div>

                        <?php endforeach; ?>

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

        <!-- ROLE LIST -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Role List</h4>
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="60">#</th>
                                <th>Role Name</th>
                                <th>Assigned Modules</th>
                                <th width="100">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($roles)): ?>
                                <?php $i = 1; ?>

                                <?php foreach ($roles as $role): ?>
                                    <tr>
                                        <td><?= $i++ ?></td>

                                        <td>
                                            <strong><?= esc($role['role_name']) ?></strong>
                                        </td>

                                        <td>
                                            <?php
                                            $assigned = $assignedModulesByRole[$role['role_id']] ?? [];
                                            ?>

                                            <?php if (!empty($assigned)): ?>
                                                <?php foreach (array_unique($assigned) as $moduleName): ?>
                                                    <span class="badge bg-primary me-1">
                                                        <?= esc($moduleName) ?>
                                                    </span>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <span class="text-muted">No modules assigned</span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <a href="<?= base_url('create_role?role_id=' . $role['role_id']) ?>"
                                               class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">
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

<script>
function setAllPermissions(checked) {
    document.querySelectorAll('.permission-checkbox').forEach(function(box) {
        box.checked = checked;
    });

    updateGroupCheckboxes();
}

function toggleGroupPermissions(groupCheckbox) {
    const panel = groupCheckbox.closest('.panel');
    panel.querySelectorAll('.permission-checkbox').forEach(function(box) {
        box.checked = groupCheckbox.checked;
    });

    updateGroupCheckboxes();
}

function toggleGroup(heading) {
    const content = heading.nextElementSibling;
    content.style.display = content.style.display === 'none' ? 'block' : 'none';
}

function updateGroupCheckboxes() {
    document.querySelectorAll('.panel').forEach(function(panel) {
        const groupCheckbox = panel.querySelector('.group-checkbox');
        if (!groupCheckbox) return;

        const boxes = panel.querySelectorAll('.permission-checkbox');

        groupCheckbox.checked =
            boxes.length > 0 &&
            Array.from(boxes).every(box => box.checked);
    });
}

document.querySelectorAll('.permission-checkbox').forEach(function(box) {
    box.addEventListener('change', updateGroupCheckboxes);
});

updateGroupCheckboxes();
</script>

<?= $this->endSection() ?>
