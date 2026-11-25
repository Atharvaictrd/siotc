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


<?php
$db  = \Config\Database::connect();
		
	$category_res = $db->query("SELECT * FROM student_category");
	
	$fee_program_query = $db->query("SELECT * FROM fees_to_program WHERE fee_assign_id='$fee_assign_id'");
		foreach ($fee_program_query->getResult() as $fee_program_row) {}

// if(isset($_POST['update'])){
//     $class=$_POST['class'];
//     $sem=$_POST['sem'];
//     $session=$_POST['session'];
//     $category=$_POST['category'];
//     $perticular_rate = $_POST['perticular_rate'];
	
//     $check = $db->query("UPDATE `fees_to_program` SET `class`='$class',`sem`='$sem',`session`='$session',
//     `amount`='$perticular_rate',`category`='$category' WHERE fee_assign_id='$fee_assign_id'");
         
// 	if($query){
// 	    echo '<script language="javascript">alert("Updated successfully.");</script>';
// 	    echo "<meta http-equiv='refresh' content='0'>";
// 	}else{
// 	    		echo "<script>alert('something went wrong.')</script>";
// 	}
	
// }
?>


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
<h4 class="panel-title">Manage Fee Component &nbsp;&nbsp;
<button class="btn btn-warning"><a href="<?=base_url();?>masters/fee_assign_to_program_list" class="text-white" style="text-decoration: none;">Go Back</a></button>
</h4>
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
<form class="form-horizontal" data-parsley-validate="true" name="demo-form"  method="post" action="<?= base_url('masters/update_fee_program_list')?>">
        <div class="panel-body">
<input type="hidden" name="fee_assign_id" value="<?=$fee_assign_id;?>">
<div class="form-group row mb-3">

<label class="col-lg-1 col-form-label form-label" for="reference_name">Class : <span class="text-danger">*</span> </label>
<div class="col-lg-3">
<select class="form-control" name="class" >
    <option value="">--Program--</option>
    <?php
foreach ($class_query->getResult() as $row) {
    ?>
    <option value="<?=$row->class;?>" <?php if($fee_program_row->class==$row->class){ echo"selected"; } ?>><?=$row->class;?></option>
    <?php
}
    ?>
</select>
</div>

<label class="col-lg-1 col-form-label form-label" for="reference_name">Semester: <span class="text-danger">*</span> </label>
<div class="col-lg-3">
<select class="form-control" name="sem" >
    <option value="">Select Semester</option>
    <?php
foreach ($program_sem_query->getResult() as $row) {
    ?>
    <option value="<?=$row->program_sem;?>"  <?php if($fee_program_row->sem==$row->program_sem){ echo"selected"; } ?>><?=$row->program_sem;?></option>
    <?php
}
    ?>
   
</select>
</div>

<label class="col-lg-1 col-form-label form-label" for="reference_name">Session : <span class="text-danger">*</span> </label>
<div class="col-lg-2">
<select class="form-control" name="session" id="dropdownYear" >
    <option value="">Select session</option>
     <option value="<?=$fee_program_row->session?>" selected><?=$fee_program_row->session?></option>
</select>
</div>

</div>
<div class="form-group row mb-3">
    <label class="col-lg-1 col-form-label form-label" for="reference_name">Category : <span class="text-danger">*</span> </label>
<div class="col-lg-8" style="padding-top: calc(.4375rem + 1px);">

<?php
 $count=0;
foreach ($category_res->getResult() as $category_row) {
   
    $count++;
			?>
			<input type="radio" name="category"
            value="<?=$category_row->category?>" <?php if($fee_program_row->category ==$category_row->category){ echo "checked"; } ?> />
<span class="margin"><?=$category_row->category?></span>
			<?php
		}
?>

</div>


</div>
<?php
$fee_com_query = $db->query("SELECT * FROM fee_components WHERE fee_component_id='$fee_program_row->fee_type'");
		foreach ($fee_com_query->getResult() as $fee_com_row) {}
?>

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
						
					
						
						<tr>
						    
						<td align="center"><span class="style5" ><b><?php echo '1';?></b></span></td>
							<td  align="center"><b><?=$fee_com_row->component;?></b>
							</td>
							<td align="right">
							<input type="text" name="perticular_rate" id="perticular_rate"  style="text-align:right" value="<?=$fee_program_row->amount;?>"></td>
						</tr>

						<tr>
						<td colspan="4"><hr></td>
						</tr>
					
						</table>
					
</div>	
<div class="form-group row">
<label class="col-lg-4 col-form-label form-label">&nbsp;</label>
<div class="col-lg-8">
<button type="submit" class="btn btn-success" name="update">Update</button>
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