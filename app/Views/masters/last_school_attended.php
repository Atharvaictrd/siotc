<?= $this->extend('masters/layout1/tempmain') ?>

<?= $this->section('links') ?>
<?= $this->endSection('links') ?>

<?= $this->section('content') ?>

<div id="content" class="app-content">

<h1 class="page-header">Last School Attended Name <small></small></h1>


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
<h4 class="panel-title">Fill the Form</h4>
<div class="panel-heading-btn">
<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
</div>
</div>


<div class="panel-body">
<form class="form-horizontal" data-parsley-validate="true" name="demo-form"  method="post" action="<?= base_url('masters/last_school_attended_name')?>">
<div class="form-group row mb-3">
<label class="col-lg-4 col-form-label form-label" for="reference_name">Last School Attended Name * :</label>
<div class="col-lg-8">
<input class="form-control" type="text" id="school_name" name="school_name" placeholder="school name name" data-parsley-required="true"required />
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
<div class="panel panel-inverse" data-sortable-id="form-validation-2">

<div class="panel-heading">
<h4 class="panel-title">Last School Attended Name</h4>
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
        <th>sno</th>
        <th>Deduction</th>
        <th>Action</th>
    </thead>
    <tbody>
        <tr>
        <?php
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM last_school_attended order by s_id DESC");
        $sn = 1;
        foreach ($query->getResult() as $row) {
        ?>
        <td><?=$sn++;?></td>
        <td><?=$row->school_name;?></td>
        <td>
              <a title="Remove" href="<?=base_url();?>masters/delete_last_school_attended/<?=$row->s_id;?>"  
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
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $('#dropdownYear').each(function() {

  var year = (new Date()).getFullYear();
  var current = year;
  year -= 24;
  for (var i = 0; i < 25; i++) {
    if ((year+i) == current)
      $(this).append('<option selected value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) + '-' +  (year+1 + i) +'</option>');
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
      $(this).append('<option selected value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) + '-' +  (year+1 + i) +'</option>');
    else
      $(this).append('<option value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) +  '-' +  (year+1 + i) +'</option>');
  }

});
</script>

<?= $this->endSection() ?>

