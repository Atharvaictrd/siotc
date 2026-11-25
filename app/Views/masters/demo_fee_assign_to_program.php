<?= $this->extend('masters/layout1/tempmain') ?>

<?= $this->section('links') ?>
<?= $this->endSection('links') ?>

<?= $this->section('content') ?>
<style>
    .margin{
        margin-right: 10px;
    }
</style>
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

<?php
$db = \Config\Database::connect();
$class_query = $db->query("SELECT * FROM class");
$fees_to_program_query = $db->query("SELECT * FROM fees_to_program ORDER BY fee_assign_id DESC LIMIT 1");
foreach ($fees_to_program_query->getResult() as $row) {
    $increment_id = $row->fee_assign_id;
}
?>
<form class="form-horizontal" data-parsley-validate="true" name="demo-form"  method="post" action="<?= base_url('masters/save_demo_fee_assign_program')?>">
        <div class="panel-body">

<div class="form-group row mb-3">

<label class="col-lg-2 col-form-label form-label" for="reference_name" style="width: 12.666667%;">Program Id : <span class="text-danger">*</span> </label>
<div class="col-lg-2">
<input type="text" value="<?=$increment_id+1;?>" class="form-control" readonly>
</div>

<label class="col-lg-1 col-form-label form-label" for="reference_name">Class : <span class="text-danger">*</span> </label>
<div class="col-lg-3">
<select class="form-control" name="class" required>
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

<label class="col-lg-1 col-form-label form-label" for="reference_name">Semester: <span class="text-danger">*</span> </label>
<div class="col-lg-3">
<select class="form-control" name="sem" required>
    <option value="">Select Semester</option>
    
    <option value="Sem I">Sem I</option>
    <option value="Sem I">Sem II</option>
    <option value="Sem I">Sem III</option>
    <option value="Sem I">Sem IV</option>
    <option value="Sem I">Sem V</option>
    <option value="DIR II Year">DIR II Year</option>
   
</select>
</div>
</div>
<div class="form-group row mb-3">
    <label class="col-lg-1 col-form-label form-label" for="reference_name">Category : <span class="text-danger">*</span> </label>
<div class="col-lg-8" style="padding-top: calc(.4375rem + 1px);">

<input type="checkbox" name="category[]"
            value="Open"/>
<span class="margin">Open</span>

<input type="checkbox" name="category[]"
            value="OBC"/>
<span class="margin">OBC</span>

<input type="checkbox" name="category[]"
            value="SC"/>
<span class="margin">SC</span>

<input type="checkbox" name="category[]"
            value="ST"/>
<span class="margin">ST</span>

<input type="checkbox" name="category[]"
            value="NT"/>
<span class="margin">NT</span>

<input type="checkbox" name="category[]"
            value="SBC"/>
<span class="margin">SBC</span>

<input type="checkbox" name="category[]"
            value="VJ"/>
<span class="margin">VJ</span>

<input type="checkbox" name="category[]"
            value="TFWS"/>
<span class="margin">TFWS</span>

<input type="checkbox" name="category[]"
            value="EBC"/>
<span class="margin">EBC</span>

<input type="checkbox" name="category[]"
            value="Minority"/>
<span class="margin">Minority</span>

<input type="checkbox" name="category[]"
            value="ACAP"/>
<span class="margin">ACAP</span>

<input type="checkbox" name="category[]"
            value="EWS"/>
<span class="margin">EWS</span>

</div>

<label class="col-lg-1 col-form-label form-label" for="reference_name">Session : <span class="text-danger">*</span> </label>
<div class="col-lg-2">
<select class="form-control" name="session" id="dropdownYear" required>
    <option value="">Select session</option>
</select>
</div>
</div>


<div class="panel-body">
<table width="100%" bgcolor="#efefef" class="table_color" border="1" cellspacing="2" cellpadding="2">
					
						<tr>

							<td width="100px" align="center"><span class="style5"><b>Sr.&nbsp;No.</b></span></td>
							<td width="300px" align="center"><span class="style5"><b>Particulars</b></span></td>
							<td align="right">
							<span class="style5"><b>Amount Rs.</b></span></td>
						</tr>
						<tr>
						<td colspan="4"><hr></td>
						</tr>
						
						<?php
						$count=0;
						$total_amount=0;
						
						$current_and_next_year = date('Y') .'-'.date('Y', strtotime('+1 year'));
						$fee_row = $db->query("SELECT * FROM fee_components WHERE session = '$current_and_next_year'");
foreach ($fee_row->getResult() as $fee_res) {
$count++;
						?>
						
						<tr>
						    
						<td align="center"><span class="style5" ><b><?php echo $count;?></b></span></td>
							<td  align="center"><b><?=$fee_res->component;?></b>
							<input type="hidden" name="component_id[]"  style="text-align:right" value="<?=$fee_res->fee_component_id;?>">
							<input type="hidden" name="component_name[]"  style="text-align:right" value="<?=$fee_res->component;?>">
							</td>
							<td align="right">
							<input type="text" name="perticular_rate[]" id="perticular_rate_<?=$count;?>"  style="text-align:right" onkeyup="fee_sub_total(this);"></td>
						</tr>
<?php
}
?>
						<tr>
						<td colspan="4"><hr></td>
						</tr>
						<tr>
						<td colspan="4" align="right">
							<b>Sub Total&nbsp;&nbsp;</b><input type="number" name="fees_sub_total" id="fees_sub_total" style="text-align:right" readonly > </td>
						</tr>
						</table>
					
</div>	
<div class="form-group row">
<label class="col-lg-4 col-form-label form-label">&nbsp;</label>
<div class="col-lg-8">
<button type="submit" class="btn btn-primary">Insert</button>
<button type="reset" class="btn btn-danger">Cancel</button>
</div>
</div>
</form>


<div class="hljs-wrapper">
<pre><code class="html" data-url="../assets/data/form-validation/code-1.json"></code></pre>
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

<script>

function fee_sub_total() {
   
        var totalAmount = 0;
        $("[id^='perticular_rate_']").each(function() {
            var id = $(this).attr('id');
            id = id.replace("perticular_rate_", '');
             
            var perticular_rate = $('#perticular_rate_' + id).val();
          
            totalAmount = parseInt(totalAmount) + parseInt(perticular_rate);
        });
        $('#fees_sub_total').val(parseInt(totalAmount));
}
</script>
<?= $this->endSection() ?>