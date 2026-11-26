<?= $this->extend('layout/tempmain') ?>
<?= $this->section('content') ?>

<div id="content" class="app-content">
    <div class="col-xl-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Edit Custom Menu</h4>
            </div>
            <div class="panel-body">
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
                <?php endif; ?>

                <form action="<?= base_url('update_custom_menu/' . $menu['menu_id']) ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="user_id">User *</label>
                            <select name="user_id" id="user_id" class="form-control" required>
                                <?php foreach ($users as $user): ?>
                                    <option value="<?= esc($user['user_id']) ?>"
                                        <?= (string) old('user_id', $menu['user_id']) === (string) $user['user_id'] ? 'selected' : '' ?>>
                                        <?= esc($user['full_name'] ?: $user['user_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="parent_id">Parent Menu</label>
                            <select name="parent_id" id="parent_id" class="form-control">
                                <option value="">Main Menu</option>
                                <?php foreach ($parentMenus as $parent): ?>
                                    <option value="<?= esc($parent['menu_id']) ?>"
                                        <?= (string) old('parent_id', $menu['parent_id'] ?? '') === (string) $parent['menu_id'] ? 'selected' : '' ?>>
                                        <?= esc($parent['menu_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="menu_name">Menu Name *</label>
                            <input type="text" name="menu_name" id="menu_name" class="form-control"
                                value="<?= esc(old('menu_name', $menu['menu_name'])) ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="route">Route / URL</label>
                            <input type="text" name="route" id="route" class="form-control"
                                value="<?= esc(old('route', $menu['route'] ?? '')) ?>">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="icon">Icon Class</label>
                            <input type="text" name="icon" id="icon" class="form-control"
                                value="<?= esc(old('icon', $menu['icon'] ?? 'fa fa-folder')) ?>">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="sort_order">Sort Order</label>
                            <input type="number" name="sort_order" id="sort_order" class="form-control"
                                value="<?= esc(old('sort_order', $menu['sort_order'] ?? 0)) ?>">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" <?= (string) old('status', $menu['status']) === '1' ? 'selected' : '' ?>>Active</option>
                                <option value="0" <?= (string) old('status', $menu['status']) === '0' ? 'selected' : '' ?>>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="<?= base_url('create_menu') ?>" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
