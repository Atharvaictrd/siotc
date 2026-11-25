<?= $this->extend('masters/layout1/tempmain') ?>

<?= $this->section('links') ?>
<?= $this->endSection('links') ?>

<?= $this->section('content') ?>

<div id="content" class="app-content">

<h1 class="page-header">Manage Student Information List <small></small></h1>


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


?>

<div class="panel-body">
<form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post" action="<?= base_url('masters/search_student_list')?>">
<div class="form-group row mb-3">
<label class="col-lg-2 col-form-label form-label" for="program">Student First Name :</label>
<div class="col-lg-2">
   <input class="form-control" type="text" id="first_name" name="first_name" placeholder="First Name" value="<?=$first_name;?>" />
</div>
<label class="col-lg-1 col-form-label form-label" for="program">Reg ID :</label>
<div class="col-lg-2">
   <input class="form-control" type="text" id="reg_no" name="reg_no" placeholder="Registration Id"  value="<?=$reg_no;?>" />
</div>
<div class="col-lg-4">
<button type="submit" class="btn btn-primary">Search</button>
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
<div class="row">
    
<div class="col-xl-12">

<div class="panel panel-inverse" data-sortable-id="form-validation-2">

<div class="panel-heading">
<h4 class="panel-title">Extra Validation Field</h4>
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
        <th>Student Reg No</th>
        <th>Student Name</th>
        <th>class</th>
        <th>Admission Date</th>
        <th>Year</th>
        <th align="center">Action</th>
    </thead>
    <tbody>
        <tr>
        <?php
         foreach ($student_list  as $row) :
        ?>
        <td><?=$row['reg_no'];?></td>
        <td><?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name']; ?></td>
        <td><?=$row['class'];?></td>
        <td><?=$row['date_of_admission'];?></td>
        <td><?=$row['session_year'];?></td>
        <td align="center">
          
              <a title="Remove" href="<?=base_url();?>masters/delete_student_list/<?=$row['student_admission_id'];?>"  
              onclick="if (confirm('Are you sure You want to delete.?')){return true;}else{event.stopPropagation(); event.preventDefault();};" 
              >
              <img src="<?=base_url();?>public/record_drop.png" height="12" width="12">
              </a>
        </td>
        </tr>
        <?php endforeach; ?>	
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

