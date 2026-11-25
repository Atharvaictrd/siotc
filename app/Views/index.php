<?= $this->extend('layout/tempmain') ?>

<?= $this->section('links') ?>
<?= $this->endSection('links') ?>

<?= $this->section('content') ?>
<div id="content" class="app-content">

<ol class="breadcrumb float-xl-end">

</ol>

<h1 class="page-header">Dashboard </h1>


<div class="row">

<div class="col-xl-3 col-md-6">
    
    
<div class="widget widget-stats bg-blue">
<div class="stats-icon"><i class="fa fa-desktop"></i></div>
<div class="stats-info">
<h4>Total Admission</h4>
<p><?php
          $db      = \Config\Database::connect();
          $builder = $db->table('student_admission_information');
          echo $builder->countAllResults();
        ?></p>
</div>
<div class="stats-link">
<a href="<?= base_url('student_search'); ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
</div>
</div>
</div>


<div class="col-xl-3 col-md-6">
<div class="widget widget-stats bg-warning">
<div class="stats-icon"><i class="fa fa-link"></i></div>
<div class="stats-info">
<h4>Total Prospectus</h4>
<p><?php
          $db      = \Config\Database::connect();
          $builder = $db->table('prospect_sales');
          echo $builder->countAllResults();
        ?></p>
</div>
<div class="stats-link">
<a href="<?= base_url('prospectus_report'); ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
</div>
</div>
</div>


<div class="col-xl-3 col-md-6">
<div class="widget widget-stats bg-indigo">
<div class="stats-icon"><i class="fa fa-users"></i></div>
<div class="stats-info">
<h4>Total Enquiry</h4>
<p><?php
          $db      = \Config\Database::connect();
          $builder = $db->table('marketing_enquiry');
          echo $builder->countAllResults();
        ?></p>
</div>
<div class="stats-link">
<a href="<?= base_url('list_student_enquiry'); ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
</div>
</div>
</div>

<?php
if(($_SESSION['adminloggedname'] =='superadmin') || ($_SESSION['adminloggedname'] =='Account')){
?>
<div class="col-xl-3 col-md-6">
<div class="widget widget-stats bg-red">
<div class="stats-icon"><i class="fa fa-clock"></i></div>
<div class="stats-info">
<h4>Today Fees Collection</h4>
<p><?php
$d=date('Y-m-d');
$fees_data_query = $db->query("SELECT * FROM fees_collection_detail WHERE date='$d'");
$total_amount = 0;
	 foreach ($fees_data_query->getResult() as $data) {
	$total_amount = $total_amount +$data->amount;
	}
	if($total_amount!=0){
	echo $total_amount.'Rs';
	}else{
	 echo   $total_amount;
	}
?>
</p>
</div>
<div class="stats-link" >
<a href="<?= base_url('daily_collection_report'); ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
</div>
</div>
</div>
<?php
}
?>
</div>
<br>
<div class="row">
<?php
if(($_SESSION['adminloggedname'] =='superadmin') || ($_SESSION['adminloggedname'] =='Account')){
?>
<div class="col-lg-3">
<div class="widget widget-stats bg-success">
<div class="stats-icon"><i class="fa fa-search"></i></div>
<div class="stats-info">
<h4>Student Search</h4>
</div>
<div class="stats-link">
<a href="<?= base_url('student_search'); ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
</div>
</div>


<div class="widget widget-stats bg-secondary">
    <div class="stats-icon"><i class="fa fa-pencil"></i></div>
    <div class="stats-info">
        <h4>Daily Attendence</h4>
    </div>
    <div class="stats-link">
        <a href="<?= base_url('stu_attendence_daily'); ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
    </div>
</div>

<form action="<?= site_url('/download-backup') ?>" method="get">
    <button class="btn btn-warning" type="submit">Download Database Backup</button>
</form>

<!--    <div class="row">-->
<!--    <div class="col-xl-10 col-md-8">-->
<!--<div class="widget widget-stats bg-info">-->
<!--<div class="stats-icon"><i class="fa fa-credit-card"></i></div>-->
<!--<div class="stats-info">-->
<!--<h4>Fees Collection</h4>-->
<!--</div>-->
<!--<div class="stats-link">-->
<!--<a href="<?= base_url('fees_report/fees'); ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
   
<!--    </div>-->
</div>
<?php
}
?>

<div class="col-lg-6 dash-img" style="background:white;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding:10px;padding: 2.5rem 10px 2rem 10px !important;    border-radius: 5px;">
<img src="<?= base_url('assets/img/somya_tech_logo.png')?>" style="width:100%;">
</div>
<div class="col-lg-3">
    <?php
if(($_SESSION['adminloggedname'] =='superadmin') || ($_SESSION['adminloggedname'] =='Account')){
?>
<div class="widget widget-stats bg-primary">
<div class="stats-icon"><i class="fa fa-plus"></i></div>
<div class="stats-info">
<h4>Add New Student</h4>
</div>
<div class="stats-link">
<a href="<?= base_url('student_admission/new_admission'); ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
</div>
</div>

  
<div class="widget widget-stats bg-secondary">
<div class="stats-icon"><i class="fa fa-edit"></i></div>
<div class="stats-info">
<h4>Create User</h4>
</div>
<div class="stats-link">
<a href="<?= base_url('create_user'); ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
</div>
</div>

<!-- <div class="row">-->
<!--    <div class="col-xl-10 col-md-8">-->
<!--<div class="widget widget-stats bg-success">-->
<!--<div class="stats-icon"><i class="fa fa-map-signs"></i></div>-->
<!--<div class="stats-info">-->
<!--<h4>Student Section Allocation</h4>-->
<!--</div>-->
<!--<div class="stats-link">-->
<!--<a href="<?= base_url('section_allocation'); ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
   
<!--    </div>-->
    <?php
}
    ?>
    </div>
    </div>
    <br>
    

</div>


</div>
<?= $this->endSection() ?>