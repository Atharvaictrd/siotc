
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from seantheme.com/color-admin/admin/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 28 Aug 2023 07:47:18 GMT -->
<head>
<meta charset="utf-8" />
<title>Eduwings | Masters </title>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" >
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="...">


<link href="<?= base_url();?>/assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link href="<?= base_url();?>/assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!--datatable js-->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<style>
    .app-sidebar .menu .menu-item.active>.menu-link {
    position: relative;
    z-index: 10;
    color: var(--bs-app-sidebar-component-active-color);
    background-color: #348fe2;
}
.app-sidebar .menu .menu-item.active>.menu-link .menu-icon {
    color: white;
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
.app-sidebar .menu .menu-item.active>.menu-link {
    position: relative;
    z-index: 10;
    color: var(--bs-app-sidebar-component-active-color);
    background-color: #f69920;
}
</style>

</head>
<body onload="startTime()">



<div id="app" class="app app-header-fixed app-sidebar-fixed ">

<div id="header" class="app-header">

<div class="navbar-header">
<a href="<?=base_url()?>masters" class="navbar-brand"><img src="<?= base_url('assets/img/somya_tech_logo1.png'); ?>" height="35px" width="30px"> 
<!--&nbsp;<b class="me-3px">E Campus</b> --><img src="https://eduwings.in/assets/Eduwings_new.png" height="50px" width="100px"> 
</a>
<button type="button" class="navbar-mobile-toggler" data-toggle="app-sidebar-mobile">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
</div>
<!--<div class="navbar-header">-->
<!--  <div class="row">-->
<!--        <div class="col-md-5"><b>Academic <br> Year :</b></div>-->
<!--         <div class="col-md-7"><select name="session" onchange="javascript:form_submit();" id="dropdownYear" class="form-control dropdown" style="">-->
<!--     <option value="<?= $_SESSION['session_year']; ?>" selected><?= $_SESSION['session_year']; ?></option>   -->
<!--</select></div>-->
<!--    </div>-->
<!--<span class="icon-bar"></span>-->
<!--<span class="icon-bar"></span>-->
<!--<span class="icon-bar"></span>-->
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

<div class="navbar-nav" style="padding-right:2rem;">
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
<div class="navbar-item dropdown">
<!--<a href="#" data-bs-toggle="dropdown" class="navbar-link dropdown-toggle icon">-->
<!--<i class="fa fa-bell"></i>-->
<!--<span class="badge">5</span>-->
<!--</a>-->
</div>
<div class="navbar-item navbar-user dropdown" style="padding: 10px;">
    <a href="<?= base_url(); ?>logout" class="dropdown-item" style="font-size:18px;"><i class="fa fa-power-off" style="color:red;"></i></a>
<!--<b class="caret"></b>-->
</span>
</a>
<!--<a href="#" class="navbar-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">-->
<!--<img src="<?=base_url();?>assets/img/user/user-13.jpg" alt />-->
<!--<span>-->
<!--<span class="d-none d-md-inline">Admin</span>-->
<!--<b class="caret"></b>-->
<!--</span>-->
<!--</a>-->
<!--<div class="dropdown-menu dropdown-menu-end me-1">-->
<!--<a href="logout" class="dropdown-item">Log Out</a>-->
<!--</div>-->
</div>
</div>

</div>


<div id="sidebar" class="app-sidebar" data-bs-theme="dark" style='background-color:#040404 !important;'>

<div class="app-sidebar-content" data-scrollbar="true" data-height="100%">

<div class="menu">
<div class="menu-profile">
<a href="javascript:;" class="menu-profile-link" data-toggle="app-sidebar-profile" data-target="#appSidebarProfileMenu">
<div class="menu-profile-cover with-shadow"></div>
<!--<div class="menu-profile-image">-->
<!--<img src="<?=base_url();?>assets/img/logo.png" height="35px" width="35px"><b class="me-3px">e-Campus</b>-->
<!--</div>-->
<div class="menu-profile-info">
<div class="d-flex align-items-center">
<div class="flex-grow-1">
    Welcome,<br>
Masters | Dashboard
</div>
</div>

</div>
</a>
</div>


<div class="menu-item">
<a href="<?=base_url();?>dashboard" class="menu-link">
<div class="menu-icon">
<i class="fa fa-sitemap"></i> </div>
<div class="menu-text">Back to Main Dashboard</div>
</a>
</div>

<div class="menu-item <?= (current_url() == base_url('masters')) ? 'active' : ''; ?>">
<a href="<?=base_url();?>masters" class="menu-link">
<div class="menu-icon">
<i class="fa fa-sitemap"></i> </div>
<div class="menu-text">Master Dashboard</div>
</a>
</div>

<div class="menu-item <?= (current_url() == base_url('masters/last_school_attended')) ? 'active' : ''; ?>">
<a href="<?=base_url();?>masters/last_school_attended" class="menu-link">
<div class="menu-icon">
<i class="fa-solid fa-school"></i> </div>
<div class="menu-text">Last School Attended</div>
</a>
</div>

<div class="menu-item <?= (current_url() == base_url('masters/reference_details')) ? 'active' : ''; ?>">
<a href="<?=base_url();?>masters/reference_details" class="menu-link">
<div class="menu-icon">
<i class="fa-solid fa-clipboard"></i> </div>
<div class="menu-text">Reference Details</div>
</a>
</div>

<div class="menu-item  <?= (current_url() == base_url('masters/class')) ? 'active' : ''; ?>">
<a href="<?=base_url();?>masters/class" class="menu-link">
<div class="menu-icon">
<i class="fa fa-tasks" aria-hidden="true"></i> </div>
<div class="menu-text">Program</div>
</a>
</div>
<div class="menu-item  <?= (current_url() == base_url('masters/sem')) ? 'active' : ''; ?>">
<a href="<?=base_url();?>masters/sem" class="menu-link">
<div class="menu-icon">
<i class="fa fa-tasks" aria-hidden="true"></i> </div>
<div class="menu-text">Program Semister</div>
</a>
</div>
<!--<div class="menu-item  <?= (current_url() == base_url('masters/section')) ? 'active' : ''; ?>">-->
<!--<a href="<?=base_url();?>masters/section" class="menu-link">-->
<!--<div class="menu-icon">-->
<!--<i class="fa fa-sitemap"></i> </div>-->
<!--<div class="menu-text">Add Section</div>-->
<!--</a>-->
<!--</div>-->

<!--<div class="menu-item  <?= (current_url() == base_url('masters/adress_keywords')) ? 'active' : ''; ?>">-->
<!--<a href="<?=base_url();?>masters/adress_keywords" class="menu-link">-->
<!--<div class="menu-icon">-->
<!--<i class="fa fa-tasks" aria-hidden="true"></i> </div>-->
<!--<div class="menu-text">Address Keywords</div>-->
<!--</a>-->
<!--</div>-->

<!--<div class="menu-item  <?= (current_url() == base_url('masters/exam')) ? 'active' : ''; ?>">-->
<!--<a href="<?=base_url();?>masters/exam" class="menu-link">-->
<!--<div class="menu-icon">-->
<!--<i class="fa fa-graduation-cap"></i> </div>-->
<!--<div class="menu-text">Exam</div>-->
<!--</a>-->
<!--</div>-->

<!--<div class="menu-item  <?= (current_url() == base_url('masters/program_sem')) ? 'active' : ''; ?>">-->
<!--<a href="<?=base_url();?>masters/program_sem" class="menu-link">-->
<!--<div class="menu-icon">-->
<!--<i class="fa fa-university"></i>-->

<!--</div>-->
<!--<div class="menu-text">Semester Year</div>-->
<!--</a>-->
<!--</div>-->
<!--<div class="menu-item  <?= (current_url() == base_url('masters/add_group')) ? 'active' : ''; ?>">-->
<!--<a href="<?=base_url();?>masters/add_group" class="menu-link">-->
<!--<div class="menu-icon">-->
<!--<i class="fa-solid fa-book"></i>-->
<!--</div>-->
<!--<div class="menu-text">Add Group</div>-->
<!--</a>-->
<!--</div>-->
<!--<div class="menu-item  <?= (current_url() == base_url('masters/subjects')) ? 'active' : ''; ?>">-->
<!--<a href="<?=base_url();?>masters/subjects" class="menu-link">-->
<!--<div class="menu-icon">-->

<!--<i class="fa fa-book"></i> </div>-->
<!--<div class="menu-text">Add Subjects</div>-->
<!--</a>-->
<!--</div>-->
<!--<div class="menu-item  <?= (current_url() == base_url('masters/subjects_list')) ? 'active' : ''; ?>-->
<!--<?= (current_url() == base_url('masters/search_subjects_list')) ? 'active' : ''; ?>">-->
<!--<a href="<?=base_url();?>masters/subjects_list" class="menu-link">-->
<!--<div class="menu-icon">-->
<!--<i class="fa fa-sitemap"></i> -->
<!--<i class="fa-solid fa-list"></i>-->
<!--</div>-->
<!--<div class="menu-text">Subjects List</div>-->
<!--</a>-->
<!--</div>-->
<div class="menu-item  <?= (current_url() == base_url('masters/student_category')) ? 'active' : ''; ?>">
<a href="<?=base_url();?>masters/student_category" class="menu-link">
<div class="menu-icon">
<i class="fa-solid fa-list"></i> </div>
<div class="menu-text">Student Category</div>
</a>
</div>
<!--<div class="menu-item  <?= (current_url() == base_url('masters/add_prospectus')) ? 'active' : ''; ?>">-->
<!--<a href="<?=base_url();?>masters/add_prospectus" class="menu-link">-->
<!--<div class="menu-icon">-->
<!--<i class="fa fa-file-pdf"></i> </div>-->
<!--<div class="menu-text">Prospectus</div>-->
<!--</a>-->
<!--</div>-->
<!--<div class="menu-item  <?= (current_url() == base_url('masters/prospectus_list')) ? 'active' : ''; ?>">-->
<!--<a href="<?=base_url();?>masters/prospectus_list" class="menu-link">-->
<!--<div class="menu-icon">-->
<!--<i class="fa fa-sitemap"></i> </div>-->
<!--<div class="menu-text">Prospectus List</div>-->
<!--</a>-->
<!--</div>-->
<div class="menu-item  <?= (current_url() == base_url('masters/fee_components')) ? 'active' : ''; ?> 
<?= (current_url() == base_url('masters/search_fee_components')) ? 'active' : ''; ?>">
<a href="<?=base_url();?>masters/fee_components" class="menu-link">
<div class="menu-icon">
<i class="fa fa-inr"></i> </div>
<div class="menu-text">Fee Components</div>
</a>
</div>
<div class="menu-item  <?= (current_url() == base_url('masters/fee_assign_to_program')) ? 'active' : ''; ?>">
<a href="<?=base_url();?>masters/fee_assign_to_program" class="menu-link">
<div class="menu-icon">
<i class="fa fa-inr"></i> </div>
<div class="menu-text">Fee Assign to Program</div>
</a>
</div>
<div class="menu-item  <?= (current_url() == base_url('masters/fee_assign_to_program_list')) ? 'active' : ''; ?>
<?= (current_url() == base_url('masters/search_fee_assign_to_program_list')) ? 'active' : ''; ?>">
<a href="<?=base_url();?>masters/fee_assign_to_program_list" class="menu-link">
<div class="menu-icon">
<i class="fa fa-inr"></i> </div>
<div class="menu-text">Fee Assign to Program List</div>
</a>
</div>
<!--<div class="menu-item  <?= (current_url() == base_url('masters/designation_add')) ? 'active' : ''; ?>">-->
<!--<a href="<?=base_url();?>masters/designation_add" class="menu-link">-->
<!--<div class="menu-icon">-->
<!--<i class="fa fa-level-up"></i> </div>-->
<!--<div class="menu-text">Designation</div>-->
<!--</a>-->
<!--</div>-->
<!--<div class="menu-item  <?= (current_url() == base_url('masters/designation_list')) ? 'active' : ''; ?>">-->
<!--<a href="<?=base_url();?>masters/designation_list" class="menu-link">-->
<!--<div class="menu-icon">-->
<!--<i class="fa fa-sitemap"></i> </div>-->
<!--<div class="menu-text">Designation List</div>-->
<!--</a>-->
<!--</div>-->
<!--<div class="menu-item  <?= (current_url() == base_url('masters/department_add')) ? 'active' : ''; ?>">-->
<!--<a href="<?=base_url();?>masters/department_add" class="menu-link">-->
<!--<div class="menu-icon">-->
<!--<i class="fa fa-building"></i> </div>-->
<!--<div class="menu-text">Department</div>-->
<!--</a>-->
<!--</div>-->
<!--<div class="menu-item  <?= (current_url() == base_url('masters/department_list')) ? 'active' : ''; ?>">-->
<!--<a href="<?=base_url();?>masters/department_list" class="menu-link">-->
<!--<div class="menu-icon">-->
<!--<i class="fa fa-sitemap"></i> </div>-->
<!--<div class="menu-text">Department List</div>-->
<!--</a>-->
<!--</div>-->
<!--<div class="menu-item  <?= (current_url() == base_url('masters/delete_student_info')) ? 'active' : ''; ?>-->
<!-- <?= (current_url() == base_url('masters/search_student_list')) ? 'active' : ''; ?>">-->
<!--<a href="<?=base_url();?>masters/delete_student_info" class="menu-link">-->
<!--<div class="menu-icon">-->
<!--<i class="fa-solid fa-users"></i> </div>-->
<!--<div class="menu-text">Delete Student Info</div>-->
<!--</a>-->
<!--</div>-->
<!--<div class="menu-item  <?= (current_url() == base_url('masters/allowances')) ? 'active' : ''; ?>">-->
<!--<a href="<?=base_url();?>masters/allowances" class="menu-link">-->
<!--<div class="menu-icon">-->
<!--<i class="fa fa-sitemap"></i> </div>-->
<!--<div class="menu-text">Allowances</div>-->
<!--</a>-->
<!--</div>-->
<!--<div class="menu-item  <?= (current_url() == base_url('masters/deduction')) ? 'active' : ''; ?>">-->
<!--<a href="<?=base_url();?>masters/deduction" class="menu-link">-->
<!--<div class="menu-icon">-->
<!--<i class="fa fa-sitemap"></i> </div>-->
<!--<div class="menu-text">Deduction</div>-->
<!--</a>-->
<!--</div>-->

<div class="menu-item d-flex">
<a href="javascript:;" class="app-sidebar-minify-btn ms-auto d-flex align-items-center text-decoration-none" data-toggle="app-sidebar-minify"><i class="fa fa-angle-double-left"></i></a>
</div>

</div>

</div>

</div>
<div class="app-sidebar-bg" data-bs-theme="dark"></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>


