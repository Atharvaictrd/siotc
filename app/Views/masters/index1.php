<?= $this->extend('masters/layout1/tempmain') ?>

<?= $this->section('links') ?>
<?= $this->endSection('links') ?>

<?= $this->section('content') ?>
<div id="content" class="app-content">

<ol class="breadcrumb float-xl-end">

</ol>



<h1 class="page-header">Masters | Dashboard </h1>
<div class="row">

<div class="col-lg-3">
    
<div style='padding: 0 0 0.9375rem;'>
    <a class="btn btn-primary" href="<?php echo base_url('dashboard') ?>">
Back to Main Dashboard
</a>
</div>
</div>
<div class="col-lg-3">
<div class="widget widget-stats bg-info">
<div class="stats-icon"><i class="fa fa-desktop"></i></div>
<div class="stats-info">
<h4>Total Programs</h4>
<p><?php
          $db      = \Config\Database::connect();
          $builder = $db->table('class');
          echo $builder->countAllResults();
        ?></p>
</div>
<div class="stats-link">
<a href="<?= base_url('masters/class'); ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
</div>
</div>

</div>
<div class="col-lg-3">
<div class="widget widget-stats bg-warning">
<div class="stats-icon"><i class="fa fa-desktop"></i></div>
<div class="stats-info">
<h4>Total Refrence</h4>
<p><?php
          $db      = \Config\Database::connect();
          $builder = $db->table('reference_details');
          echo $builder->countAllResults();
        ?></p>
</div>
<div class="stats-link">
<a href="<?= base_url('masters/reference_details'); ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
</div>
</div>

</div>
 </div>
<div class="row">
<div class="col-lg-2"></div>
<div class="col-lg-8 dash-img">
    <div  style="background:white;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding:10px;padding: 2.5rem 10px 2rem 10px !important;    border-radius: 5px;">
        <img src="<?= base_url('assets/img/somya_tech_logo.png')?>" style="width:100%;">
    </div>

</div>


    </div>
   


</div>


</div>
<?= $this->endSection() ?>