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


<h1 class="page-header">Manage Subject Information <small></small></h1>


<div class="row">

<div class="col-xl-12">
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
<h4 class="panel-title">Fill Form</h4>
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
$group_query = $db->query("SELECT * FROM admin_group");

?>
<div class="panel-body">
<form class="form-horizontal" data-parsley-validate="true" name="demo-form"  method="post" action="<?= base_url('masters/save_subjects')?>">
<div class="form-group row mb-3">
<label class="col-lg-1 col-form-label form-label" for="class">Class <span class="text-danger">*</span> :</label>
<div class="col-lg-2">
<select class="form-control" type="text" id="class" name="class" required>
    <option value="">--Program--</option>
    <?php
    foreach ($class_query->getResult() as $row) {
    ?>
    <option value="<?=$row->class;?>"><?=$row->class;?></option>
    <?php
}
    ?>
</select>
</div>


<label class="col-lg-1 col-form-label form-label" for="class">Group <span class="text-danger">*</span> :</label>
<div class="col-lg-2">
<select class="form-control" type="text" id="group" name="group" required>
    <option value="">--Group--</option>
    <?php
    foreach ($group_query->getResult() as $row) {
    ?>
    <option value="<?=$row->group_name;?>"><?=$row->group_name;?></option>
    <?php
}
    ?>
</select>
</div>
</div>
<div class="form-group row mb-3">
<label class="col-lg-1 col-form-label form-label" for="Subject">Subject <span class="text-danger">*</span> :</label>
<div class="col-lg-2">
<input class="form-control" type="text" id="subject" name="subject" placeholder="Subject" required />
</div>


<label class="col-lg-1 col-form-label form-label" for="class">Description:</label>
<div class="col-lg-4">
<textarea  class="form-control" id="description" name="description" placeholder="description"></textarea>
</div>
</div>
<div class="form-group row">
<label class="col-lg-4 col-form-label form-label">&nbsp;</label>
<div class="col-lg-8">
<button type="submit" class="btn btn-primary">Insert</button>
<button type="rest" class="btn btn-danger">Cancel</button>
</div>
</div>
</form>
</div>


<div class="hljs-wrapper">
<pre><code class="html" data-url="../assets/data/form-validation/code-1.json"></code></pre>
</div>

</div>

</div>
</div>
</div>

<?= $this->endSection() ?>