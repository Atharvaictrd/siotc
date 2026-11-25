    
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from seantheme.com/color-admin/admin/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 28 Aug 2023 07:47:18 GMT -->
<head>
<meta charset="utf-8" />

<title>Eduwings | Dashboard </title>

<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
<meta content name="description" />
<meta content name="author" />
<!--<link rel="shortcut icon" href="<?=base_url()?>assets/img/bg_r.png">-->
<link
    rel="icon"
    type="image/png"
    href="https://sconw.eduwings.in/assets/eduwings-favicon.png"
>
<link href="<?= base_url('assets/css/vendor.min.css'); ?>" rel="stylesheet" />
<link href="<?= base_url('assets/css/default/app.min.css'); ?>" rel="stylesheet" />


<link href="<?= base_url('assets/plugins/jvectormap-next/jquery-jvectormap.css'); ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css'); ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/gritter/css/jquery.gritter.css'); ?>" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="...">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 <!--<link rel="stylesheet" href="https://harvesthq.github.io/chosen/chosen.css">-->
  <link rel="stylesheet" href="<?= base_url('assets/chosen/chosen.css');?>">
<style>
   
table{
    font-size:13px;
}
.chosen-container-single .chosen-single {
    padding: 4px 10px;
    height: 35px;
}
body{
    /*font-size:14px !important;*/
}
.app-sidebar .menu .menu-profile .menu-profile-cover {
    background-image: url(<?= base_url('/assets/banner1.jpg'); ?>) !important;
}
.panel.panel-inverse>.panel-heading {
    background: #040404 !important;
}
.app-sidebar .menu .menu-item .menu-submenu .menu-item.active:after {
    border-color: #348fe2 !important;
}
.app-sidebar .menu .menu-item.active>.menu-link .menu-icon {
    color: white !important;
}

.pace .pace-progress {
    background: #348fe2 !important;
}
.panel {
    margin-bottom: 3.246875rem  !important;
}
/*.app-sidebar .menu .menu-item.active>.menu-link {*/
/*    position: relative;*/
/*    z-index: 10;*/
/*    color: var(--bs-app-sidebar-component-active-color);*/
/*    background-color: #f69920;*/
/*}*/
</style>
</head>
<body onload="startTime()">



<div id="app" class="app app-header-fixed app-sidebar-fixed ">

<div id="header" class="app-header">

<div class="navbar-header">
<a href="/dashboard" class="navbar-brand"><img src="<?= base_url('assets/img/somya_tech_logo1.png'); ?>" height="35px" width="30px"> 
<!--&nbsp;<b class="me-3px">E Campus</b> -->
<img src="https://eduwings.in/assets/Eduwings_new.png" height="40px" width="100px">
</a>
<button type="button" class="navbar-mobile-toggler" data-toggle="app-sidebar-mobile">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
</div>
<!--<div class="navbar-header ">-->
<!--    <div class="row">-->
<!--        <div class="col-md-5"><b>Academic <br> Year :</b></div>-->
<!--         <div class="col-md-7"><select name="session" onchange="javascript:form_submit();" id="dropdownYear" class="form-control dropdown" style="">-->
<!--     <option value="<?= $_SESSION['session_year']; ?>" selected><?= $_SESSION['session_year']; ?></option>   -->
<!--</select></div>-->
<!--    </div>-->

<!--</button>-->
<!--</div>-->
<div class="navbar-nav" style="    justify-content: flex-start;">
				<div class="navbar-item navbar-form">
				    
						<div class="form-group" style='display:flex'>
							<lable style='margin: 5px 0;font-weight:bold;font-size:.9rem;'>Academic Year : &nbsp; </lable>
							<select name="session" onchange="javascript:form_submit();" id="dropdownYear" class="form-control dropdown" style="">
     <option value="<?= $_SESSION['session_year']; ?>" selected><?= $_SESSION['session_year']; ?></option>   
</select>
						</div>
				</div>
				</div>
<div class="navbar-nav" style='padding-right:2rem;'>
<div class="navbar-item navbar-form">
<!--<form action method="POST" name="search">-->
<!--<div class="form-group">-->
<!--<input type="text" class="form-control" placeholder="Enter keyword" />-->
<!--<button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>-->
<!--</div>-->
<!--</form>-->
<span style="font-size: 1rem; font-weight: bold;">
<?=$_SESSION['adminloggedname'];?>
</span>
</div>

<div class="navbar-item navbar-user dropdown" style="padding: 10px;">
<!--<a href="#" class="navbar-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">-->
<!--<img src="../assets/img/user/user-13.jpg" alt />-->
<span>
<a href="<?= base_url(); ?>logout" class="dropdown-item" style="font-size:18px;"><i class="fa fa-power-off" style="color:red;"></i></a>
<!--<b class="caret"></b>-->
</span>
</a>
<!--<div class="dropdown-menu dropdown-menu-end me-1">-->
<!--<a href="logout" class="dropdown-item">Log Out</a>-->
<!--</div>-->
</div>
</div>

</div>


<div id="sidebar" class="app-sidebar" data-bs-theme="dark" style="background-color:#040404 !important;">
<div class="app-sidebar-content" data-scrollbar="true" data-height="100%">

<div class="menu">
<div class="menu-profile">
<a href="javascript:;" class="menu-profile-link" data-toggle="app-sidebar-profile" data-target="#appSidebarProfileMenu">
<div class="menu-profile-cover with-shadow"></div>
<!--<div class="menu-profile-image">-->
<!--<img src="assets/img/logo.png" height="35px" width="35px"/>-->
<!--</div>-->
<div class="menu-profile-info">
<div class="d-flex align-items-center">
<div class="flex-grow-1"> Welcome,<br>
<?=$_SESSION['adminloggedname'];?>
</div>

</div>

</div>
</a>
</div>

<?php
$db = \Config\Database::connect();
$adminId = session()->get('adminloggedid');
$assignedRoles = [];

if ($adminId !== null && $adminId !== '') {
    $assignedRoles = $db->table('user_roles')
        ->select('roles.role_id, roles.role_name')
        ->join('roles', 'roles.role_id = user_roles.role_id')
        ->where('user_roles.user_id', $adminId)
        ->where('roles.status', 1)
        ->get()
        ->getResultArray();
}

$roleIds = array_values(array_unique(array_column($assignedRoles, 'role_id')));
$isSuperAdmin = false;

foreach ($assignedRoles as $role) {
    $normalizedRoleName = strtolower(preg_replace('/[\s_-]+/', '', (string) ($role['role_name'] ?? '')));
    if ($normalizedRoleName === 'superadmin') {
        $isSuperAdmin = true;
        break;
    }
}

$viewModuleIds = [];
if ($roleIds !== []) {
    $rolePermissions = $db->table('role_permissions')
        ->select('permissions.module_id, permissions.action_name')
        ->join('permissions', 'permissions.permission_id = role_permissions.permission_id')
        ->whereIn('role_permissions.role_id', $roleIds)
        ->get()
        ->getResultArray();

    foreach ($rolePermissions as $permission) {
        if (strtolower(trim((string) ($permission['action_name'] ?? ''))) === 'view') {
            $viewModuleIds[(string) $permission['module_id']] = true;
        }
    }
}

$activeModules = $db->table('modules')
    ->select('module_id, parent_id, module_name, module_key, route, icon, sort_order, is_menu, status')
    ->where('status', 1)
    ->orderBy('sort_order', 'ASC')
    ->orderBy('module_id', 'ASC')
    ->get()
    ->getResultArray();

$modulesByParent = [];
foreach ($activeModules as $module) {
    $parentId = (string) ($module['parent_id'] ?? '');
    if ($parentId === '0') {
        $parentId = '';
    }
    $modulesByParent[$parentId][] = $module;
}

$currentUrl = rtrim(current_url(), '/');
$renderMenu = function ($parentId, $depth = 0) use (&$renderMenu, $modulesByParent, $viewModuleIds, $isSuperAdmin, $currentUrl) {
    $parentKey = (string) $parentId;
    if ($parentKey === '0') {
        $parentKey = '';
    }

    $activeAtThisLevel = false;
    foreach ($modulesByParent[$parentKey] ?? [] as $module) {
        $moduleId = (string) $module['module_id'];

        ob_start();
        $childrenActive = $renderMenu($moduleId, $depth + 1);
        $childrenHtml = ob_get_clean();
        $hasAccessibleChildren = trim($childrenHtml) !== '';

        $route = trim((string) ($module['route'] ?? ''));
        $routeUrl = $route !== '' ? base_url(ltrim($route, '/')) : '';
        $canView = $isSuperAdmin || isset($viewModuleIds[$moduleId]);
        $hasAccessiblePage = (int) ($module['is_menu'] ?? 0) === 1 && $canView && $routeUrl !== '';

        if (!$hasAccessibleChildren && !$hasAccessiblePage) {
            continue;
        }

        $isCurrentPage = $hasAccessiblePage && rtrim($routeUrl, '/') === $currentUrl;
        $isActive = $isCurrentPage || $childrenActive;
        $icon = trim((string) ($module['icon'] ?? ''));

        if ($depth === 0 && $routeUrl === '' && $hasAccessibleChildren) {
            echo '<div class="menu-header">' . esc($module['module_name'], 'html') . '</div>';
            echo $childrenHtml;
        } elseif ($hasAccessibleChildren) {
            echo '<div class="menu-item has-sub' . ($isActive ? ' active' : '') . '">';
            echo '<a href="javascript:;" class="menu-link">';
            echo '<div class="menu-icon">';
            if ($icon !== '') {
                echo '<i class="' . esc($icon, 'attr') . '"></i>';
            }
            echo '</div>';
            echo '<div class="menu-text">' . esc($module['module_name'], 'html') . '</div>';
            echo '<div class="menu-caret"></div>';
            echo '</a>';
            echo '<div class="menu-submenu' . ($isActive ? ' active' : '') . '">';

            if ($hasAccessiblePage) {
                echo '<div class="menu-item' . ($isCurrentPage ? ' active' : '') . '">';
                echo '<a href="' . esc($routeUrl, 'attr') . '" class="menu-link">';
                echo '<div class="menu-text">' . esc($module['module_name'], 'html') . '</div>';
                echo '</a>';
                echo '</div>';
            }

            echo $childrenHtml;
            echo '</div>';
            echo '</div>';
        } else {
            echo '<div class="menu-item' . ($isCurrentPage ? ' active' : '') . '">';
            echo '<a href="' . esc($routeUrl, 'attr') . '" class="menu-link">';
            echo '<div class="menu-icon">';
            if ($icon !== '') {
                echo '<i class="' . esc($icon, 'attr') . '"></i>';
            }
            echo '</div>';
            echo '<div class="menu-text">' . esc($module['module_name'], 'html') . '</div>';
            echo '</a>';
            echo '</div>';
        }

        $activeAtThisLevel = $activeAtThisLevel || $isActive;
    }

    return $activeAtThisLevel;
};

$renderMenu('');
?>

<?php if (false): ?>
<!-- Legacy sidebar backup; remove after RBAC sidebar testing succeeds. -->
<div class="menu-item ">
<a href="<?= base_url(); ?>dashboard" class="menu-link">
<div class="menu-icon">
<i class="fa fa-sitemap"></i> </div>
<div class="menu-text">Dashboard</div>

</a>
</div>
<div class="menu-header">Marketing</div>
<?php
$is_submenu_active = in_array(current_url(), [
    base_url('/student_enquiry'),
    base_url('/list_student_enquiry'),
    base_url('/list_student_program'),
    base_url('/list_student_area'),
    base_url('/list_student_college'),
    base_url('/list_student_category'),
    base_url('/list_student_percentage'),
    base_url('/list_student_medium'),
    base_url('/not_taken_admission'),
    base_url('/not_taken_admission_area'),
    base_url('/enquiry_college'),
    base_url('/enquiry_category'),
    base_url('/enquiry_medium'),
    base_url('/enquiry_percentage'),
    base_url('/enquiry_reference'),
], true);
?>
<div class="menu-item has-sub <?= $is_submenu_active ? 'active' : ''; ?>">
<a href="javascript:;" class="menu-link">
<div class="menu-icon">
<i class="fa-solid fa-gem"></i>
</div>
<div class="menu-text">Enquiry </div>
<div class="menu-caret"></div>
</a>
<div class="menu-submenu <?php if ($is_submenu_active) echo 'active'; ?>">
    <div class="menu-item">
<a href="<?= base_url(); ?>student_enquiry" class="menu-link">
<div class="menu-text">Student Enquiry</div>
</a>
</div>
<!--<div class="menu-item">-->
<!--<a href="ui_general.html" class="menu-link">-->
<!--<div class="menu-text">Delete Student Enquiries</div>-->
<!--</a>-->
<!--</div>-->
<div class="menu-item">
<a href="<?= base_url(); ?>list_student_enquiry" class="menu-link">
<div class="menu-text">List Of Student Enquired For Admission</div>
</a>
</div>
<!--<div class="menu-item">-->
<!--<a href="<?= base_url(); ?>list_student_program" class="menu-link">-->
<!--<div class="menu-text">List Of Student Enquired For Admission(Program or Semester)</div>-->
<!--</a>-->
<!--</div>-->
<!--<div class="menu-item">-->
<!--<a href="<?= base_url(); ?>list_student_area" class="menu-link">-->
<!--<div class="menu-text">List Of Enquired Student According to Area or Address</div>-->
<!--</a>-->
<!--</div>-->
<!--<div class="menu-item">-->
<!--<a href="<?= base_url(); ?>list_student_college" class="menu-link">-->
<!--<div class="menu-text">List Of Enquired Student According to College</div>-->
<!--</a>-->
<!--</div>-->
<!--<div class="menu-item">-->
<!--<a href="<?= base_url(); ?>list_student_category" class="menu-link">-->
<!--<div class="menu-text">List Of Enquired Student According to Category</div>-->
<!--</a>-->
<!--</div>-->
<!--<div class="menu-item">-->
<!--<a href="<?= base_url(); ?>list_student_percentage" class="menu-link">-->
<!--<div class="menu-text">List Of Enquired Student According to Percentage</div>-->
<!--</a>-->
<!--</div>-->
<!--<div class="menu-item">-->
<!--<a href="<?= base_url(); ?>list_student_medium" class="menu-link">-->
<!--<div class="menu-text">List Of Enquired Student According to Medium</div>-->
<!--</a>-->
<!--</div>-->
<!--<div class="menu-item">-->
<!--<a href="<?= base_url(); ?>not_taken_admission" class="menu-link">-->
<!--<div class="menu-text">List Of Student Not Yet Taken Admission </div>-->
<!--</a>-->
<!--</div>-->
<!--<div class="menu-item">-->
<!--<a href="<?= base_url(); ?>not_taken_admission_area" class="menu-link">-->
<!--<div class="menu-text">List Of Student According to Address or Area Not Taken Admission</div>-->
<!--</a>-->
<!--</div>-->
<!--<div class="menu-item">-->
<!--<a href="<?= base_url(); ?>enquiry_college" class="menu-link">-->
<!--<div class="menu-text">List Of Enquiries According to College Not Taken Admission</div>-->
<!--</a>-->
<!--</div>-->
<!--<div class="menu-item">-->
<!--<a href="<?= base_url(); ?>enquiry_category" class="menu-link">-->
<!--<div class="menu-text">List Of Enquiries According to Category Not Taken Admission</div>-->
<!--</div>-->
<!--<div class="menu-item">-->
<!--<a href="<?= base_url(); ?>enquiry_medium" class="menu-link">-->
<!--<div class="menu-text">List Of Enquiries According to Medium Not Taken Admission</div>-->
<!--</a>-->
<!--</div>-->
<!--<div class="menu-item">-->
<!--<a href="<?= base_url(); ?>enquiry_percentage" class="menu-link">-->
<!--<div class="menu-text">List Of Enquiries According to Percentage Not Taken Admission</div>-->
<!--</a>-->
<!--</div>-->
<!--<div class="menu-item">-->
<!--<a href="<?= base_url(); ?>enquiry_reference" class="menu-link">-->
<!--<div class="menu-text">List Of Enquiries According to Reference</div>-->
<!--</a>-->
<!--</div>-->
<!--<div class="menu-item">-->
<!--<a href="<?= base_url(); ?>bulk_sms" class="menu-link">-->
<!--<div class="menu-text">Bulk SMS</div>-->
<!--</a>-->
<!--</div>-->
</div>
</div>
<?php
 $db      = \Config\Database::connect();

 $adminId = $_SESSION['adminloggedid'] ?? null;
 $currentUser = $db->query('SELECT usertype FROM `user` WHERE user_id = ?', [$adminId])->getRow();
 $userType = strtolower(preg_replace('/[\s_-]+/', '', (string) ($currentUser->usertype ?? '')));
 $isSuperadmin = (string) $adminId === '1'
     || $userType === 'superadmin'
     || strtolower((string) ($_SESSION['adminloggedname'] ?? '')) === 'superadmin';
 $user_per_query = $db->query('SELECT * FROM `user_perm` WHERE user_id = ?', [$adminId]);
 $user_per_row = $user_per_query->getRow();
?>
<div class="menu-header">Acedemic</div>
<?php
if($isSuperadmin || (isset($user_per_row->ADMISSION) && $user_per_row->ADMISSION !='0')){
?>
<div class="menu-item has-sub <?= (current_url() == base_url('/prospectus')) ? 'active' : ''; ?>
<?= (current_url() == base_url('/prospectus_enquired')) ? 'active' : ''; ?>
<?= (current_url() == base_url('/prospectus_report')) ? 'active' : ''; ?>
<?= (current_url() == base_url('/prospectus_session')) ? 'active' : ''; ?>
<?= (current_url() == base_url('/student_prospectus')) ? 'active' : ''; ?>
<?= (current_url() == base_url('/student_admission')) ? 'active' : ''; ?>
<?= (current_url() == base_url('/section_allocation')) ? 'active' : ''; ?>
<?= (current_url() == base_url('/student_search')) ? 'active' : ''; ?>
<?= (current_url() == base_url('/strength_report')) ? 'active' : ''; ?>
<?= (current_url() == base_url('/admission_report')) ? 'active' : ''; ?>
<?= (current_url() == base_url('/student_status')) ? 'active' : ''; ?>
<?= (current_url() == base_url('/student_parent_contact')) ? 'active' : ''; ?>
<?= (current_url() == base_url('/bulk_sms')) ? 'active' : ''; ?>">
<a href="javascript:;" class="menu-link">
<div class="menu-icon">
<i class="fa fa-list-ol"> </i>
</div>
<div class="menu-text">Admission</div>
<div class="menu-caret"></div>
</a>
<div class="menu-submenu">
<div class="menu-item">
<a href="<?= base_url(); ?>prospectus" class="menu-link">
<div class="menu-text">Prospectus Sale (New) </div>
</a>
</div>
<div class="menu-item">
<a href="<?= base_url(); ?>prospectus_enquired" class="menu-link">
<div class="menu-text">Prospectus Sale (Already Enquired)</div>
</a>
</div>
<div class="menu-item">
<a href="<?= base_url(); ?>prospectus_report" class="menu-link">
<div class="menu-text">Prospectus Sales Report</div>
</a>
</div>
<div class="menu-item">
<a href="<?= base_url(); ?>prospectus_session" class="menu-link">
<div class="menu-text">Prospectus Sales Report Session Wise</div>
</a>
</div>
<div class="menu-item">
<a href="<?= base_url(); ?>student_prospectus" class="menu-link">
<div class="menu-text">Student Prospectus Sales Report Session Wise</div>
</a>
</div>
<!--<div class="menu-item">-->
<!--<a href="<?= base_url(); ?>import_excel" class="menu-link">-->
<!--<div class="menu-text">Import Excel (CSV) File</div>-->
<!--</a>-->
<!--</div>-->
<div class="menu-item">
<a href="<?= base_url(); ?>student_admission" class="menu-link">
<div class="menu-text">Student Admission</div>
</a>
</div>
<div class="menu-item">
<a href="<?= base_url(); ?>section_allocation" class="menu-link">
<div class="menu-text">Student Section Allocation</div>
</a>
</div>
<div class="menu-item">
<a href="<?= base_url(); ?>student_search" class="menu-link">
<div class="menu-text">Student Search</div>
</a>
</div>
<div class="menu-item">
<a href="<?= base_url(); ?>strength_report" class="menu-link">
<div class="menu-text">Report</div>
</a>
</div>
<!--<div class="menu-item">-->
<!--<a href="<?= base_url(); ?>admission_report" class="menu-link">-->
<!--<div class="menu-text">Report</div>-->
<!--</a>-->
<!--</div>-->
<div class="menu-item">
<a href="<?= base_url(); ?>student_status" class="menu-link">
<div class="menu-text">Student Status (Regular/Irregular)</div>
</a>
</div>
<div class="menu-item">
<a href="<?= base_url(); ?>student_parent_contact" class="menu-link">
<div class="menu-text">Student Parent Contact Number</div>
</a>
</div>
<!--<div class="menu-item">-->
<!--<a href="<?= base_url(); ?>bulk_sms" class="menu-link">-->
<!--<div class="menu-text">Bulk SMS</div>-->
<!--</a>-->
<!--</div>-->
</div>
</div>
<?php
}
?>
<?php
if($isSuperadmin || (isset($user_per_row->FEES) && $user_per_row->FEES !='0')){
?>
 <div class="menu-item">
            <a href="<?= base_url(); ?>fees_report" class="menu-link">
            <div class="menu-icon">
            <i class="fa fa-calendar"></i>
            </div>
            <div class="menu-text">Fees</div>
            </a>
            </div>
<?php } ?>  
<!--<div class="menu-item has-sub <?= (current_url() == base_url('/stu_attendence_daily')) ? 'active' : ''; ?>-->
<!--<?= (current_url() == base_url('/stu_attendence_report')) ? 'active' : ''; ?>">-->
<!--<a href="javascript:;" class="menu-link">-->
<!--<div class="menu-icon">-->
<!--<i class="fa fa-table"></i>-->
<!--</div>-->
<!--<div class="menu-text">Student Attendence</div>-->
<!--<div class="menu-caret"></div>-->
</a>
<!--<div class="menu-submenu">-->
<!--<div class="menu-item">-->
<!--<a href="<?= base_url(); ?>stu_attendence_daily" class="menu-link">-->
<!--<div class="menu-text">Student Attendence Daily</div>-->
<!--</a>-->
<!--</div>-->
<!--<div class="menu-item">-->
<!--<a href="<?= base_url(); ?>stu_attendence_report" class="menu-link">-->
<!--<div class="menu-text">Student Attendence Report</div>-->
<!--</a>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<?php
if($isSuperadmin || (isset($user_per_row->CERTIFICATES) && $user_per_row->CERTIFICATES !='0')){
?>
<div class="menu-item has-sub <?= (current_url() == base_url('/leaving')) ? 'active' : ''; ?>
<?= (current_url() == base_url('/bonafied')) ? 'active' : ''; ?>
<?= (current_url() == base_url('/leaving_list')) ? 'active' : ''; ?>
<?= (current_url() == base_url('/bonafied_list')) ? 'active' : ''; ?>">
<a href="javascript:;" class="menu-link">
<div class="menu-icon">
<i class="fa fa-list"></i>
</div>
<div class="menu-text">Student Certificates</div>
<div class="menu-caret"></div>
</a>
<div class="menu-submenu">
<div class="menu-item">
<a href="<?= base_url(); ?>leaving"  class="menu-link">
<div class="menu-text">Leaving Certificates</div>
</a>
</div>
<div class="menu-item">
<a href="<?= base_url(); ?>bonafied" class="menu-link">
<div class="menu-text">Bonafied Certificates </div>
</a>
</div>
<div class="menu-item">
<a href="<?= base_url(); ?>leaving_list"  class="menu-link">
<div class="menu-text">Leaving Certificates List </div>
</a>
</div>
<div class="menu-item">
<a href="<?= base_url(); ?>bonafied_list" class="menu-link">
<div class="menu-text">Bonafied Certificates List</div>
</a>
</div>
</div>
</div>
<?php
}
?>

<?php
if($isSuperadmin || (isset($user_per_row->USER_MANAGEMENT) && $user_per_row->USER_MANAGEMENT !='0')){
?>
<div class="menu-header">Administrator</div>
<div class="menu-item has-sub <?= (current_url() == base_url('/create_user')) ? 'active' : ''; ?>
<?= (current_url() == base_url('/permission_panel')) ? 'active' : ''; ?>
<?= (current_url() == base_url('/permission-panel')) ? 'active' : ''; ?>">
<a href="javascript:;" class="menu-link">
<div class="menu-icon">
<i class="fa fa-list-ol"> </i>
</div>
<div class="menu-text">User Management</div>
<div class="menu-caret"></div>
</a>
<div class="menu-submenu" id="userSubMenu">
<div class="menu-item">
<a href="<?= base_url(); ?>create_user" class="menu-link">
<div class="menu-text">Create User </div>
</a>
</div>
<div class="menu-item">
<a href="<?= base_url(); ?>permission-panel" class="menu-link">
<div class="menu-text">Permission Panel </div>
</a>
</div>
</div>
</div>
<div class="menu-item">
<a href="<?= base_url(); ?>hr_management" class="menu-link">
<div class="menu-icon">
<i class="fa fa-calendar"></i>
</div>
<div class="menu-text">HR Management</div>
</a>
</div>
<?php
}
if($isSuperadmin || (isset($user_per_row->ADMINISTRATOR) && $user_per_row->ADMINISTRATOR !='0')){
?>
<div class="menu-item has-sub">
<a href="javascript:;" class="menu-link">
<div class="menu-icon">
<i class="fa fa-list-ol"> </i>
</div>
<div class="menu-text">Administrator</div>
<div class="menu-caret"></div>
</a>
<div class="menu-submenu">
<div class="menu-item">
<a href="<?=base_url();?>masters" class="menu-link">
<div class="menu-text">Master</div>
</a>
</div>
</div>
</div>

<?php

}?>

<div class="menu-header">Forgot Password</div>
<div class="menu-item">
            <a href="<?=base_url();?>forget_password" class="menu-link">
            <div class="menu-icon">
            <i class="fa fa-calendar"></i>
            </div>
            <div class="menu-text">Forgot Password</div>
            </a>
            </div>
<div class="menu-item">
            <a href="<?=base_url();?>support" class="menu-link">
            <div class="menu-icon">
            <i class="fa fa-calendar"></i>
            </div>
            <div class="menu-text">Contact Support</div>
            </a>
            </div>
            <?php endif; ?>
</div>

</div>

</div>
<div class="app-sidebar-bg" data-bs-theme="dark"></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>




<script>

    // Get current URL
    var currentURL = window.location.href;

    // Get all menu links
    var menuLinks = document.querySelectorAll('.menu-link');

    // Loop through each menu link
    menuLinks.forEach(function(link) {
        // Check if href attribute matches current URL
        if (link.getAttribute('href') === currentURL) {
            // Add active class to parent menu item
            link.parentNode.classList.add('active');
        }
    });
</script>


    