<?= $this->extend('masters/layout1/tempmain') ?>

<?= $this->section('links') ?>
<?= $this->endSection('links') ?>

<?= $this->section('content') ?>

<div id="content" class="app-content">

<!--<ol class="breadcrumb float-xl-end">-->
<!--<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>-->
<!--<li class="breadcrumb-item"><a href="javascript:;">Form Stuff</a></li>-->
<!--<li class="breadcrumb-item active">Form Validation</li>-->
<!--</ol>-->
<h1 class="page-header">Manage Program Semester<small></small></h1>


<div class="row">

<div class="col-xl-6">
<?php if(session()->has('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session('success') ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if(session()->has('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session('error') ?>
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<div class="panel panel-inverse" data-sortable-id="form-validation-1">

<div class="panel-heading">
<h4 class="panel-title">Fill The Form</h4>
<div class="panel-heading-btn">
<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
</div>
</div>

<?php
$db = \Config\Database::connect();
$class_query = $db->query("SELECT * FROM class");
$program_sem_query = $db->query("SELECT * FROM program_sem");
$fees_to_program_query = $db->query("SELECT * FROM fees_to_program ORDER BY fee_assign_id DESC LIMIT 1");
foreach ($fees_to_program_query->getResult() as $row) {
  
}
?>
<div class="panel-body">
<form class="form-horizontal" data-parsley-validate="true" name="demo-form"  method="post" action="<?= base_url('masters/save_sem')?>">
<div class="form-group row mb-3">
<label class="col-lg-4 col-form-label form-label" for="reference_name">Program name * :</label>
<div class="col-lg-8">
<select class="form-control" name="class" >
    <option value="">--Program--</option>
    <?php
foreach ($class_query->getResult() as $row) {
    ?>
    <option value="<?=$row->class_id;?>"><?=$row->class;?></option>
    <?php
}
    ?>
</select>
</div>
</div>
<div class="form-group row mb-3">
<label class="col-lg-4 col-form-label form-label" for="reference_name">Semester * :</label>
<div class="col-lg-8">
<input class="form-control" type="text" id="program_sem" name="program_sem" placeholder="semester" data-parsley-required="true"required />
</div>
</div>
<div class="form-group row">
<label class="col-lg-4 col-form-label form-label">&nbsp;</label>
<div class="col-lg-8">
<button type="submit" class="btn btn-primary">Insert</button>
</div>
</div>
</form>
</div>


<div class="hljs-wrapper">
<pre><code class="html" data-url="../assets/data/form-validation/code-1.json"></code></pre>
</div>

</div>

</div>
<div class="col-xl-6">

<div class="panel panel-inverse" data-sortable-id="form-validation-2">

<div class="panel-heading">
<h4 class="panel-title">List</h4>
<div class="panel-heading-btn">
<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
</div>
</div>


<div class="panel-body">
<table class="table table-bordered" id="example">
    <thead>
        <tr>
        <th>sno</th>
        <th>Program Name</th>
         <th>Semester</th>
        <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <?php
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM program_sem ORDER BY program_sem_id ASC");
        $sn = 1;
        foreach ($query->getResult() as $row) {
            $program_id=$row->program_id;
              $query1 = $db->query("SELECT * FROM class Where class_id='$program_id'");
        $sn = 1;
        foreach ($query1->getResult() as $row1) {
        }
        ?>
        <td><?=$sn++;?></td>
        <td><?=$row1->class;?></td>
        <td><?=$row->program_sem;?></td>
        <td>
            <a title="Edit" href="<?=base_url();?>masters/edit_sem/<?=$row->program_sem_id;?>" style="margin-right: 5px;">
              <span class="fa fa-edit fw-fa text-success"></span>
              </a>
             
              <a title="Remove" href="<?=base_url();?>masters/delete_sem/<?=$row->program_sem_id;?>"  
              onclick="if (confirm('Are you sure You want to delete.?')){return true;}else{event.stopPropagation(); event.preventDefault();};" 
              >
              <img src="<?=base_url();?>public/record_drop.png" height="12" width="12">
              </a>
        </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>
</div>
</div>
</div>


</div>
<?= $this->endSection() ?>