<?= $this->extend('layout/tempmain') ?>

<?= $this->section('content') ?>

<div id="content" class="app-content">
<div class="container-fluid">

    <h4 class="mb-4">Create Custom Menu</h4>

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

    <!-- CREATE MENU FORM -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Create Menu For User</h5>
        </div>

        <div class="card-body">

            <form action="<?= base_url('save_custom_menu') ?>" method="post">

                <?= csrf_field() ?>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Select User *</label>
                        <select name="user_id" id="user_id"
                                class="form-control" required>
                            <option value="">Select User</option>

                            <?php foreach ($users as $user): ?>
                                <option value="<?= $user['user_id'] ?>">
                                    <?= esc($user['full_name'] ?: $user['user_name']) ?>
                                </option>
                            <?php endforeach; ?>

                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Parent Menu</label>
                        <select name="parent_id" id="parent_id"
                                class="form-control">
                            <option value="">Main Menu</option>
                        </select>
                        <small class="text-muted">
                            Select a parent to create a submenu.
                        </small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Menu Name *</label>
                        <input type="text" name="menu_name"
                               class="form-control"
                               placeholder="Enter menu name" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Route / URL</label>
                        <input type="text" name="route"
                               class="form-control"
                               placeholder="Example: reports/monthly">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Icon Class</label>
                        <input type="text" name="icon"
                               class="form-control"
                               value="fa fa-folder"
                               placeholder="fa fa-folder">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order"
                               class="form-control" value="0">
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">
                    Save Menu
                </button>

            </form>

        </div>
    </div>


    <!-- MENU LIST -->
    <div class="card">
        <div class="card-header">
            <h5>Custom Menu List</h5>
        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Menu Name</th>
                        <th>Route</th>
                        <th>Parent</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (!empty($menus)): ?>
                        <?php foreach ($menus as $index => $menu): ?>

                            <tr>
                                <td><?= $index + 1 ?></td>

                                <td>
                                    <?= esc($menu['full_name']) ?>
                                </td>

                                <td>
                                    <?= esc($menu['menu_name']) ?>
                                </td>

                                <td>
                                    <?= esc($menu['route'] ?? '-') ?>
                                </td>

                                <td>
                                    <?php
                                    $parentName = '-';

                                    foreach ($menus as $parent) {
                                        if (
                                            $menu['parent_id'] &&
                                            $parent['menu_id'] == $menu['parent_id']
                                        ) {
                                            $parentName = $parent['menu_name'];
                                            break;
                                        }
                                    }
                                    ?>
                                    <?= esc($parentName) ?>
                                </td>

                                <td><?= esc($menu['sort_order']) ?></td>

                                <td>
                                    <?php if ($menu['status'] == 1): ?>
                                        <span class="badge badge-success">Active</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger">Inactive</span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <a href="<?= base_url('edit_custom_menu/' . $menu['menu_id']) ?>"
                                       class="btn btn-sm btn-info">
                                        Edit
                                    </a>

                                    <form action="<?= base_url('delete_custom_menu/' . $menu['menu_id']) ?>"
                                          method="post" style="display:inline;"
                                          onsubmit="return confirm('Delete this menu and its submenus?')">
                                        <?= csrf_field() ?>
                                        <button type="submit"
                                                class="btn btn-sm btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">
                                No custom menus found.
                            </td>
                        </tr>
                    <?php endif; ?>

                </tbody>
            </table>

        </div>
    </div>

</div>
</div>

<script>
const allMenus = <?= json_encode($menus) ?>;

document.getElementById('user_id').addEventListener('change', function () {

    const userId = this.value;
    const parentSelect = document.getElementById('parent_id');

    parentSelect.innerHTML = '<option value="">Main Menu</option>';

    allMenus.forEach(menu => {
        if (
            String(menu.user_id) === String(userId) &&
            (menu.parent_id === null || menu.parent_id === '')
        ) {
            const option = document.createElement('option');
            option.value = menu.menu_id;
            option.textContent = menu.menu_name;
            parentSelect.appendChild(option);
        }
    });

});
</script>

<?= $this->endSection() ?>
