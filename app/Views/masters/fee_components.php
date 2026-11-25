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


<!--<h1 class="page-header">Form <small></small></h1>-->


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
<h4 class="panel-title">Manage Fee Component</h4>
<div class="panel-heading-btn">
<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
</div>
</div>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="panel-body">
<form class="form-horizontal" data-parsley-validate="true" name="demo-form"  method="post" action="<?= base_url('masters/save_fee_components')?>">
<div class="form-group row mb-3">
<label class="col-lg-3 col-form-label form-label" for="reference_name">Fee Component : <span class="text-danger">*</span> </label>
<div class="col-lg-7">
<input class="form-control" type="text" id="fee_component" name="fee_component" placeholder="Fee Component" required />
</div>
</div>
<div class="form-group row mb-3">
<label class="col-lg-3 col-form-label form-label" for="reference_name">Session : <span class="text-danger">*</span> </label>
<div class="col-lg-7">
<select class="form-control" name="session"  id="dropdownYear">
    <option value="">Select session</option>
    <option value="<?= $_SESSION['session_year']; ?>" selected><?= $_SESSION['session_year']; ?></option>
</select>
</div>
</div>
<div class="form-group row">
<label class="col-lg-4 col-form-label form-label">&nbsp;</label>
<div class="col-lg-8">
<button type="submit" class="btn btn-primary">Insert</button>
<button type="reset" class="btn btn-danger">Cancel</button>
</div>
</div>
</form>
<div class="panel-body">
<form class="form-horizontal" data-parsley-validate="true" name="demo-form"  method="post" action="<?= base_url('masters/search_fee_components')?>">
<div class="form-group row mb-3">
<label class="col-lg-3 col-form-label form-label" for="reference_name">Session : <span class="text-danger">*</span> </label>
<div class="col-lg-7">

<select name="search_session" class="form-control" id="dropdownYear1">
    <option value="">Select session</option>
    <option value="<?= $_SESSION['session_year']; ?>" selected><?= $_SESSION['session_year']; ?></option>
</select>
</div>
</div>
<div class="form-group row">
<label class="col-lg-4 col-form-label form-label">&nbsp;</label>
<div class="col-lg-8">
<button type="submit" class="btn btn-success">Search</button>
</div>
</div>
</form>
</div>
</div>
    </div>
    <div class="col-md-3"></div>
</div>



<div class="hljs-wrapper">
<pre><code class="html" data-url="../assets/data/form-validation/code-1.json"></code></pre>
</div>

</div>

</div>


<div class="col-xl-12">

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
        <th>Fee Component</th>
        <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <?php
        $db = \Config\Database::connect();
        // $query = $db->query("SELECT * FROM fee_components");
        $sn = 1;
        foreach ($fee_component_list  as $row) :
        ?>
        <td><?=$sn++;?></td>
        <td><?=$row['component'];?></td>
        <td>
            <a title="Edit" href="<?=base_url();?>masters/edit_fee_components/<?=$row['fee_component_id'];?>" class="btn btn-success btn-sm">
              <!--<span class="fa fa-success fw-fa"></span> -->
              <span class="fa fa-edit fw-fa"></span>
              </a>
             
              <a title="Remove" href="<?=base_url();?>masters/delete_fee_components/<?=$row['fee_component_id'];?>"  
              onclick="if (confirm('Are you sure You want to delete.?')){return true;}else{event.stopPropagation(); event.preventDefault();};" 
              class="btn btn-danger btn-sm">
              <span class="fa fa-trash fw-fa"></span>
              </a>
        </td>
        </tr>
       <?php endforeach; ?>
    </tbody>
</table>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $('#dropdownYear').each(function() {

  var year = (new Date()).getFullYear();
  var current = year;
  year -= 24;
  for (var i = 0; i < 25; i++) {
    if ((year+i) == current)
      $(this).append('<option  value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) + '-' +  (year+1 + i) +'</option>');
    else
      $(this).append('<option value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) +  '-' +  (year+1 + i) +'</option>');
  }

});
 $('#dropdownYear1').each(function() {

  var year = (new Date()).getFullYear();
  var current = year;
  year -= 24;
  for (var i = 0; i < 25; i++) {
    if ((year+i) == current)
      $(this).append('<option  value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) + '-' +  (year+1 + i) +'</option>');
    else
      $(this).append('<option value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) +  '-' +  (year+1 + i) +'</option>');
  }

});
</script>
<?= $this->endSection() ?>