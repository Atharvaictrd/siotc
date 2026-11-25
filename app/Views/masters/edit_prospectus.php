<?= $this->extend('masters/layout1/tempmain') ?>

<?= $this->section('links') ?>
<?= $this->endSection('links') ?>

<?= $this->section('content') ?>

<div id="content" class="app-content">

<h1 class="page-header">Manage Prospectus Amount Info <small></small></h1>


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
$program_query = $db->query("SELECT * FROM program");

$admin_query = $db->query("SELECT * FROM admin_prospectus WHERE prospectus_id='$prospectus_id'");
foreach ($admin_query->getResult() as $row) {
    $program = $row->program;
    $sem = $row->sem;
    $session = $row->session;
    $amount = $row->amount;
}
?>

<div class="panel-body">
<form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post" action="<?= base_url('masters/update_prospectus/'.$prospectus_id)?>">
<div class="form-group row mb-3">
<label class="col-lg-1 col-form-label form-label" for="group">Program <span class="text-danger">*</span> :</label>
<div class="col-lg-2">
    <select class="form-control" name="program" required>
        <option value="">--Program--</option>
        <?php
        foreach ($program_query->getResult() as $row) {
            ?>
            <option value="<?=$row->program?>" <?php if($program == $row->program){ echo "selected"; } ?>><?=$row->program?></option>
            <?php
        }
        ?>
    </select>
</div>
<label class="col-lg-1 col-form-label form-label" for="reference_name">Semester: <span class="text-danger">*</span> </label>
<div class="col-lg-3">
<select class="form-control" name="sem" required>
    <option value="">Select Semester</option>
    
    <option value="Sem I"  <?php if($sem == 'Sem I'){ echo "selected"; } ?>>Sem I</option>
    <option value="Sem II"  <?php if($sem == 'Sem II'){ echo "selected"; } ?>>Sem II</option>
    <option value="Sem III"  <?php if($sem == 'Sem III'){ echo "selected"; } ?>>Sem III</option>
    <option value="Sem IV"  <?php if($sem == 'Sem IV'){ echo "selected"; } ?>>Sem IV</option>
    <option value="Sem V"  <?php if($sem == 'Sem V'){ echo "selected"; } ?>>Sem V</option>
    <option value="DIR II Year"  <?php if($sem == 'DIR II Year'){ echo "selected"; } ?>>DIR II Year</option>
   
</select>
</div>
<label class="col-lg-1 col-form-label form-label" for="reference_name">Session : <span class="text-danger">*</span> </label>
<div class="col-lg-2">
<select class="form-control" name="session" id="dropdownYear" required>
    <option value="">Select session</option>
    <option value="<?=$session?>" selected><?=$session?></option>
</select>
</div>
</div>
<div class="form-group row">
<label class="col-lg-2 col-form-label form-label" for="reference_name">Prospectus Amount : <span class="text-danger">*</span> </label>
<div class="col-lg-2">
<input class="form-control" type="text" id="prospectus_amount" name="prospectus_amount" placeholder="Prospectus Amount" value="<?=$amount;?>" required />
</div>
</div>
<div class="form-group row">
<label class="col-lg-4 col-form-label form-label">&nbsp;</label>
<div class="col-lg-8">
<button type="submit" class="btn btn-success">Update</button>
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
        <th>sno</th>
        <th>Program</th>
        <th>Sem</th>
        <th>Session</th>
        <th>Amount</th>
        <th>Action</th>
    </thead>
    <tbody>
        <tr>
        <?php
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM admin_prospectus");
        $sn = 1;
        foreach ($query->getResult() as $row) {
        ?>
        <td><?=$sn++;?></td>
        <td><?=$row->program;?></td>
        <td><?=$row->sem;?></td>
        <td><?=$row->session;?></td>
        <td><?=$row->amount;?></td>
        <td>
            <a title="Edit" href="<?=base_url();?>masters/edit_prospectus/<?=$row->prospectus_id;?>" style="margin-right: 5px;">
              <span class="fa fa-edit fw-fa text-success"></span>
              </a>
             
              <a title="Remove" href="<?=base_url();?>masters/delete_prospectus/<?=$row->prospectus_id;?>"  
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
      $(this).append('<option value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) + '-' +  (year+1 + i) +'</option>');
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
      $(this).append('<option value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) + '-' +  (year+1 + i) +'</option>');
    else
      $(this).append('<option value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) +  '-' +  (year+1 + i) +'</option>');
  }

});
</script>

<?= $this->endSection() ?>

