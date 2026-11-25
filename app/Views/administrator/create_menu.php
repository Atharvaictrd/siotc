<?= $this->extend('layout/tempmain') ?>
<?= $this->section('content') ?>

<div id="content" class="app-content">
    <div class="row">
        <div class="col-md-12">
        <div class="panel panel-inverse">

            <div class="panel-heading">
                <h4 class="panel-title">Create Menu</h4>
            </div>

            <div class="panel-body">

                <form method="post" action="<?= base_url('save_menu') ?>">

                    <?= csrf_field() ?>

                    <div class="row">

                        <!-- Menu Name -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Menu Name</label>
                                <input type="text"
                                       name="module_name"
                                       class="form-control"
                                       placeholder="Enter menu name"
                                       required>
                            </div>
                        </div>

                        <!-- Parent Menu -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Parent Menu</label>

                                <select name="parent_id" class="form-control">
                                    <option value="0">No Parent (Main Menu)</option>

                                    <?php foreach ($modules as $module): ?>
                                        <?php if (empty($module['parent_id'])): ?>
                                            <option value="<?= $module['module_id'] ?>">
                                                <?= esc($module['module_name']) ?>
                                            </option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>

                                </select>
                            </div>
                        </div>

                        <!-- Route -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Route</label>
                                <input type="text"
                                       name="route"
                                       class="form-control"
                                       placeholder="Example: student_list">
                            </div>
                        </div>

                        <!-- Icon -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Icon</label>
                                <input type="text"
                                       name="icon"
                                       class="form-control"
                                       placeholder="Example: fa fa-users">
                            </div>
                        </div>

                        <!-- Sort Order -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sort Order</label>
                                <input type="number"
                                       name="sort_order"
                                       class="form-control"
                                       value="1">
                            </div>
                        </div>

                        <!-- Is Menu -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Show in Sidebar</label>
                                <select name="is_menu" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <hr>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Save Menu
                    </button>

                </form>

            </div>
        </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>  