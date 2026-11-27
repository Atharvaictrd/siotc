  <?= $this->extend('layout/tempmain') ?>
  <?= $this->section('content') ?>

  <div id="content" class="app-content">

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

      <?php if (session()->has('validation')): ?>
          <div class="alert alert-danger">
              <?= session('validation')->listErrors() ?>
          </div>
      <?php endif; ?>

      <!-- CREATE USER -->
      <div class="panel panel-inverse">
          <div class="panel-heading">
              <h4 class="panel-title">Create / Edit User</h4>
          </div>

          <div class="panel-body">

              <form method="post" action="<?= base_url('save_user') ?>">
                  <?= csrf_field() ?>

                  <div class="row">

                     <div class="col-md-4 mb-3">
    <label>Full Name</label>
    <input type="text"
           name="full_name"
           class="form-control"
           value="<?= esc(old('full_name') ?? '') ?>"
           placeholder="Enter full name"
           required>
</div>

                      <div class="col-md-4 mb-3">
                          <label>Email</label>
  <input type="email" name="email"
        class="form-control"
        value=""
        placeholder="Enter email"
        autocomplete="off"
        required>
                      </div>

                      <div class="col-md-4 mb-3">
                          <label>Mobile</label>
                          <input type="text" name="mobile"
                                class="form-control"
                                value="<?= esc(old('mobile') ?? '') ?>"
                                placeholder="Enter mobile number" required>
                      </div>

                      <div class="col-md-4 mb-3">
                          <label>Password</label>
  <input type="password" name="password"
        class="form-control"
        placeholder="Enter password"
        autocomplete="new-password"
        required>
                      </div>

                      <div class="col-md-4 mb-3">
                          <label>Select Role</label>

  <select name="role_id" id="role_id"
          class="form-control"
          onchange="loadRolePermissions(this.value)">

                              <option value="">-- Select Role --</option>

                              <?php foreach ($roles as $role): ?>
                                  <option value="<?= $role['role_id'] ?>"
                                      <?= (string)$selectedRole === (string)$role['role_id'] ? 'selected' : '' ?>>
                                      <?= esc($role['role_name']) ?>
                                  </option>
                              <?php endforeach; ?>

                          </select>
                      </div>

                      <div class="col-md-4 mb-3">
                          <label>Address</label>
                          <textarea name="address" class="form-control"
                                    rows="2"
                                    placeholder="Enter address"><?= esc(old('address') ?? '') ?></textarea>
                      </div>

                  </div>

                  <hr>

                  <!-- PERMISSIONS -->
                  <div class="mb-3">
                      <strong>Permissions</strong>

                      <span class="ml-3">
                          <a href="javascript:void(0)" onclick="selectAllGroups(true)">Select All</a>
                          &nbsp; | &nbsp;
                          <a href="javascript:void(0)" onclick="selectAllGroups(false)">Clear All</a>
                          &nbsp; | &nbsp;
                          <a href="javascript:void(0)" onclick="toggleAllGroups()">Expand / Collapse All</a>
                      </span>
                  </div>

                  <?php
                  $moduleMap = [];

                  foreach ($modules as $module) {
                      $moduleMap[$module['module_id']] = $module;
                  }

                  $getModulePath = function ($module) use (&$getModulePath, $moduleMap) {
                      $path = [$module['module_name']];
                      $parentId = $module['parent_id'];

                      while (!empty($parentId) && isset($moduleMap[$parentId])) {
                          $parent = $moduleMap[$parentId];
                          array_unshift($path, $parent['module_name']);
                          $parentId = $parent['parent_id'];
                      }

                      return implode(' > ', $path);
                  };

                  $permissionMap = [];

                  foreach ($permissions as $permission) {
                      $permissionMap[$permission['module_id']][$permission['action_name']] =
                          $permission['permission_id'];
                  }
                  
$groupedModules = [];
$feesReportChildren = [];
$reportPageChildren = [];

// Collect direct children of Fees Report.
foreach ($modules as $module) {
    $parentId = (int) ($module['parent_id'] ?? 0);

    if (
        isset($moduleMap[$parentId]) &&
        ($moduleMap[$parentId]['module_key'] ?? '') === 'fees_report' &&
        isset($permissionMap[$module['module_id']])
    ) {
        $feesReportChildren[] = $module;
    }

    // Collect 8 report pages under Report.
    if (
        isset($moduleMap[$parentId]) &&
        ($moduleMap[$parentId]['module_key'] ?? '') === 'fees_report_page' &&
        isset($permissionMap[$module['module_id']])
    ) {
        $reportPageChildren[] = $module;
    }
}

// Group route-based modules under their top-level module.
foreach ($modules as $module) {
    if (
        ($module['module_key'] ?? '') === 'dashboard' ||
        empty($module['route'])
    ) {
        continue;
    }

    $moduleId = (int) $module['module_id'];
    $parentId = (int) ($module['parent_id'] ?? 0);
    $rootId = $moduleId;

    while ($parentId > 0 && isset($moduleMap[$parentId])) {
        $rootId = $parentId;
        $parentId = (int) ($moduleMap[$parentId]['parent_id'] ?? 0);
    }

    $groupName = $moduleMap[$rootId]['module_name'];
    $groupedModules[$groupName][] = $module;
}

// Within each top-level group, keep pages of the same branch together.
// Example: all Admission pages, then Fees pages, then Student Certificates pages.
foreach ($groupedModules as $groupName => $groupModules) {
    $branchGroups = [];

    foreach ($groupModules as $module) {
        $branchId = (int) $module['module_id'];
        $parentId = (int) ($module['parent_id'] ?? 0);

        while (
            $parentId > 0 &&
            isset($moduleMap[$parentId]) &&
            (int) ($moduleMap[$parentId]['parent_id'] ?? 0) !== 0
        ) {
            $branchId = $parentId;
            $parentId = (int) ($moduleMap[$parentId]['parent_id'] ?? 0);
        }

        $branchGroups[$branchId][] = $module;
    }

    $groupedModules[$groupName] = $branchGroups;
}


                  ?>

                  <!-- DASHBOARD -->
                  <div class="table-responsive mb-2">
                      <table class="table table-bordered mb-0">
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
                                  <?php if (($module['module_key'] ?? '') === 'dashboard'): ?>
                                      <tr>
                                          <td><?= esc($module['module_name']) ?></td>
                                          <?php foreach (['view', 'add', 'edit', 'delete'] as $action): ?>
                                              <td class="text-center">
                                                  <?php if (isset($permissionMap[$module['module_id']][$action])): ?>
                                                      <?php $permissionId = (int) $permissionMap[$module['module_id']][$action]; ?>
                                                      <input type="hidden" name="permission_ids[]" value="<?= $permissionId ?>">
                                                      <input type="checkbox" class="role-permission" name="permissions[]" value="<?= $permissionId ?>"
                                                          <?= in_array($permissionId, $assignedPermissions, true) ? 'checked' : '' ?>>
                                                  <?php else: ?>
                                                      -
                                                  <?php endif; ?>
                                              </td>
                                          <?php endforeach; ?>
                                      </tr>
                                  <?php endif; ?>
                              <?php endforeach; ?>
                          </tbody>
                      </table>
                  </div>

                  <!-- MODULE GROUPS -->
                  <?php foreach ($groupedModules as $groupName => $groupModules): ?>
                      <div class="panel panel-default permission-group mb-2">
                          <div class="panel-heading" style="cursor:pointer" onclick="togglePermissionGroup(this)">
                              <i class="fa fa-folder text-warning"></i>
                              <strong><?= esc($groupName) ?></strong>
                              <span class="pull-right">
                                  <a href="javascript:void(0)" onclick="event.stopPropagation(); selectGroup(this, true)">Select All</a>
                                  &nbsp;
                                  <i class="fa fa-chevron-down group-arrow"></i>
                              </span>
                          </div>

                          <div class="panel-body group-content" style="display:none;padding:0">
                              <div class="table-responsive">
                                  <table class="table table-bordered table-striped mb-0">
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
                                          <?php foreach ($groupModules as $branchModules): ?>
                                              <?php foreach ($branchModules as $module): ?>
                                                  <?php
                                                     $rowsToRender = [$module];

if (($module['module_key'] ?? '') === 'fees_report') {
    $rowsToRender = array_merge($rowsToRender, $feesReportChildren);
}

if (($module['module_key'] ?? '') === 'fees_report_page') {
    $rowsToRender = array_merge($rowsToRender, $reportPageChildren);
}
                                                  ?>
                                                  <?php foreach ($rowsToRender as $rowModule): ?>
                                                      <tr>
                                                          <td><?= esc($getModulePath($rowModule)) ?></td>
                                                          <?php foreach (['view', 'add', 'edit', 'delete'] as $action): ?>
                                                              <td class="text-center">
                                                                  <?php if (isset($permissionMap[$rowModule['module_id']][$action])): ?>
                                                                      <?php $permissionId = (int) $permissionMap[$rowModule['module_id']][$action]; ?>
                                                                      <input type="hidden" name="permission_ids[]" value="<?= $permissionId ?>">
                                                                      <input type="checkbox" class="role-permission" name="permissions[]" value="<?= $permissionId ?>"
                                                                          <?= in_array($permissionId, $assignedPermissions, true) ? 'checked' : '' ?>>
                                                                  <?php else: ?>
                                                                      -
                                                                  <?php endif; ?>
                                                              </td>
                                                          <?php endforeach; ?>
                                                      </tr>
                                                  <?php endforeach; ?>
                                              <?php endforeach; ?>
                                          <?php endforeach; ?>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  <?php endforeach; ?>

                  <div class="mt-3">
                      <button type="submit" class="btn btn-success">
                          Create User
                      </button>

                      <a href="<?= base_url('create_user') ?>"
                        class="btn btn-danger">
                          Cancel
                      </a>
                  </div>

              </form>

          </div>
      </div>

      <!-- USER LIST -->
      <div class="panel panel-inverse">
          <div class="panel-heading">
              <h4 class="panel-title">User List (<?= count($users) ?>)</h4>
          </div>

          <div class="panel-body">

              <div class="table-responsive">
                  <table class="table table-bordered table-striped">

                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Full Name</th>
                              <th>Email</th>
                              <th>Mobile</th>
                              <th>Role</th>
                              <th>Permissions</th>
                              <th>Address</th>
                              <th>Action</th>
                          </tr>
                      </thead>

                      <tbody>

                          <?php if (!empty($users)): ?>
                              <?php $i = 1; ?>

                              <?php foreach ($users as $user): ?>
                                  <tr>
                                      <td><?= $i++ ?></td>

                                      <td><?= esc($user['full_name'] ?? '') ?></td>

                                      <td><?= esc($user['email'] ?? '') ?></td>

                                      <td><?= esc($user['mobile'] ?? '') ?></td>

                                      <td><?= esc($user['role_name'] ?? 'No Role') ?></td>

                                      <td>
                                          <?php
                                          $userModuleList = $userModules[$user['user_id']] ?? [];
                                          ?>

                                          <?php if (!empty($userModuleList)): ?>
                                              <?php foreach (array_unique($userModuleList) as $moduleName): ?>
                                                  <span class="badge badge-primary">
                                                      <?= esc($moduleName) ?>
                                                  </span>
                                              <?php endforeach; ?>
                                          <?php else: ?>
                                              <span class="text-muted">No permissions</span>
                                          <?php endif; ?>
                                      </td>

                                      <td><?= esc($user['address'] ?? '') ?></td>

                                    <td>
      <a href="<?= base_url('edit_user/' . $user['user_id']) ?>"
        class="btn btn-sm btn-primary">
          <i class="fa fa-edit"></i> Edit
      </a>

  <form action="<?= base_url('delete_user/' . $user['user_id']) ?>"
        method="post"
        style="display:inline;"
        onsubmit="return confirm('Are you sure you want to delete this user?');">

      <?= csrf_field() ?>

      <button type="submit" class="btn btn-sm btn-danger">
          Delete
      </button>

  </form>
  </td>
                                  </tr>
                              <?php endforeach; ?>

                          <?php else: ?>
                              <tr>
                                  <td colspan="8" class="text-center">
                                      No users found.
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
  function togglePermissionGroup(heading) {
      const content = heading.nextElementSibling;
      const arrow = heading.querySelector('.group-arrow');
      const isHidden = content.style.display === 'none';
      content.style.display = isHidden ? 'block' : 'none';
      if (arrow) {
          arrow.classList.toggle('fa-chevron-down', !isHidden);
          arrow.classList.toggle('fa-chevron-up', isHidden);
      }
  }

  function selectGroup(link, checked) {
      const group = link.closest('.permission-group');
      group.querySelectorAll('.role-permission').forEach(function(box) {
          box.checked = checked;
      });
  }

  function selectAllGroups(checked) {
      document.querySelectorAll('.role-permission').forEach(function(box) {
          box.checked = checked;
      });
  }

  function toggleAllGroups() {
      const groups = document.querySelectorAll('.permission-group');
      const shouldExpand = Array.from(groups).some(function(group) {
          return group.querySelector('.group-content').style.display === 'none';
      });
      groups.forEach(function(group) {
          group.querySelector('.group-content').style.display = shouldExpand ? 'block' : 'none';
          const arrow = group.querySelector('.group-arrow');
          if (arrow) {
              arrow.classList.toggle('fa-chevron-down', !shouldExpand);
              arrow.classList.toggle('fa-chevron-up', shouldExpand);
          }
      });
  }

  function loadRolePermissions(roleId) {
      document.querySelectorAll('.role-permission').forEach(function(box) {
          box.checked = false;
      });
      if (!roleId) return;

      fetch("<?= base_url('get_role_permissions') ?>?role_id=" + encodeURIComponent(roleId))
          .then(function(response) {
              if (!response.ok) throw new Error('Request failed');
              return response.json();
          })
          .then(function(permissionIds) {
              const selectedIds = permissionIds.map(function(id) { return parseInt(id, 10); });
              document.querySelectorAll('.role-permission').forEach(function(box) {
                  box.checked = selectedIds.includes(parseInt(box.value, 10));
              });
          })
          .catch(function(error) {
              console.error('Permission loading error:', error);
          });
  }
  </script>

  <?= $this->endSection() ?>
