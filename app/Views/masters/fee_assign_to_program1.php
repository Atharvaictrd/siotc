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

if(isset($_POST['insert'])){

	if(($_POST['class'] ?? '') ==''){
// 			echo"<script>alert('Please Select Class.')</script>";
			$error[] = 'Please Select Class.';
	}
	if(($_POST['sem'] ?? '')==''){
// 		echo"<script>alert('Please Select sem.)</script>";
		$error[] = 'Please Select sem.';
	}

	if(($_POST['session'] ?? '') == ''){
// 			echo"<script>alert('Please Select Correct Session.)</script>";
			$error[] = 'Please Select Session.';
	}
	if(($_POST['category'] ?? '')==''){
// 		echo"<script>alert('Please Select atleast one category.)</script>";
		$error[] = 'Please Select atleast one category.';
	}
	if(($_POST['session'] ?? '') == $_SESSION['session_year'] && ($_POST['class'] ?? '') !='' && ($_POST['sem'] ?? '') !='' && ($_POST['session'] ?? '') !=''  && ($_POST['category'] ?? '') !=''){
	    for($i=1;$i<=($_POST['count'] ?? '');$i++)
		{
		    $class= ($_POST['class'] ?? '');
		    $sem= ($_POST['sem'] ?? '');
		    $session= ($_POST['session'] ?? '');
		     $component_id  =  $_POST["component_id_".$i];
		     $perticular_rate = $_POST["perticular_rate_".$i];
		     $category = ($_POST["category"] ?? '');
		      $insert_by = $_SESSION['adminloggedname']; // or any identifier
$insert_date = date('Y-m-d H:i:s');
$insert_ip = $_SERVER['REMOTE_ADDR'];
$gender=($_POST['gender'] ?? '');
		     
            $check = $db->query("SELECT * FROM fees_to_program WHERE category='$category' AND class='$class' AND sem='$sem' AND session='$session' AND fee_type='$component_id' AND gender='$gender' ");
             foreach ($check->getResult() as $check_row) {
                 $check_category = $check_row->category;
                 $check_class = $check_row->class;
                 $check_sem = $check_row->sem;
                 $check_session = $check_row->session;
             }
             if($check_category == $category && $check_class == $class && $check_sem ==$sem && $check_session == $session){
    // 		echo "<script>alert('Component already exists.')</script>";
             
             }else{
                
                //  echo "<script>alert('not exists.')</script>";
                 $query = $db->query("INSERT INTO `fees_to_program`
    (`class`, `sem`, `session`, `fee_type`, `amount`, `category`, `gender`, `insert_by`, `insert_date`, `insert_ip`)  
    VALUES 
    ('$class', '$sem', '$session', '$component_id', '$perticular_rate', '$category', '$gender', '$insert_by', '$insert_date', '$insert_ip')");

             }
    
    
		}
		if($query){
		    echo '<script language="javascript">alert("Fees Assign To Program successfully.");</script>';
		  //  $success[] = 'Fees Assign To Program successfully.';
		    echo "<meta http-equiv='refresh' content='0'>";
		}else{
		    		// echo "<script>alert('Components already exists.')</script>";
		    		$error[] = 'Components already exists..';
		}
	}else{
	   // echo "<script>alert('Select currect session')</script>";
	   $error[] = 'Your academic year and slection session must be same. Please login again with the correct session';
	}
}
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
<?php if($error): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php
        foreach($error as $key => $val)
				{
					echo "<li>".$val."</li>";
				}
        ?>
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
$program_sem_query = $db->query("SELECT * FROM program_sem");
$fees_to_program_query = $db->query("SELECT * FROM fees_to_program ORDER BY fee_assign_id DESC LIMIT 1");
foreach ($fees_to_program_query->getResult() as $row) {
  
}
?>
<form class="form-horizontal" data-parsley-validate="true" name="demo-form"  method="post" >
        <div class="panel-body">

<div class="form-group row mb-3">

<label class="col-lg-1 col-form-label form-label" for="reference_name">Class : <span class="text-danger">*</span> </label>
<div class="col-lg-2">
<select class="form-control" name="class" >
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
<div class="col-lg-2">
<select class="form-control" name="sem" >
    <option value="">Select Semester</option>
    <?php
foreach ($program_sem_query->getResult() as $row) {
    ?>
    <option value="<?=$row->program_sem;?>"><?=$row->program_sem;?></option>
    <?php
}
    ?>
   
</select>
</div>

<label class="col-lg-1 col-form-label form-label" for="reference_name">Session : <span class="text-danger">*</span> </label>
<div class="col-lg-2">
<select class="form-control" name="session" id="dropdownYear" >
    <option value="">Select session</option>
    <option value="<?=$_SESSION['session_year']?>" selected><?=$_SESSION['session_year']?></option>
</select>
</div>
<label class="col-lg-1 col-form-label form-label" for="reference_name">Gender : </label>
<div class="col-lg-2">
<select class="form-control" name="gender"  >
    <option value="male">Male</option>
    <option value="female" >Female</option>
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
            value="<?=$category_row->category?>"/>
<span class="margin"><?=$category_row->category?></span>
			<?php
		}
?>

</div>


</div>

<div class="form-group row mb-3">
  
<!--</div>-->
<div class="panel-body">
<table width="100%" bgcolor="#efefef" class="table_color" border="1" cellspacing="2" cellpadding="2">
					
						<tr>

							<td width="100px" align="center"><span class="style5"><b>Sr.&nbsp;No.</b></span></td>
							<td width="300px" align="center"><span class="style5"><b>Particulars</b></span></td>
							<td width="300px" align=""><span class="style5"><b>Session</b></span></td>
							<td align="right">
							<span class="style5"><b>Amount Rs.</b></span></td>
						</tr>
						<tr>
						<td colspan="4"><hr></td>
						</tr>
						
						<?php
						$count=0;
						$total_amount=0;
						
				$current_and_next_year = $_SESSION['session_year'];
						$fee_row = $db->query("SELECT * FROM fee_components WHERE session = '$current_and_next_year'");
foreach ($fee_row->getResult() as $fee_res) {
$count++;
						?>
						
						<tr>
						    
						<td align="center"><span class="style5" ><b><?php echo $count;?></b></span></td>
							<td  align="center"><b><?=$fee_res->component;?></b>
							<input type="hidden" name="component_id_<?=$count;?>"  style="text-align:right" value="<?=$fee_res->fee_component_id;?>">
							<input type="hidden" name="component_name_<?=$count;?>"  style="text-align:right" value="<?=$fee_res->component;?>">
							</td>
							
							<td  align=""><b><?=$fee_res->session;?></b>
							<td align="right">
							<input type="text" name="perticular_rate_<?=$count;?>" id="perticular_rate_<?=$count;?>"  style="text-align:right" onkeyup="fee_sub_total(this);"></td>
							<input type="hidden" value="<?php echo $count; ?>" id="count" name="count" />
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
<button type="submit" class="btn btn-primary" name="insert">Insert</button>
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
      $(this).append('<option selected value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) + '-' +  (year+1 + i) +'</option>');
    else
      $(this).append('<option value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) +  '-' +  (year+1 + i) +'</option>');
  }

});
</script>

<script>

// function fee_sub_total() {
   
//         var totalAmount = 0;
//         $("[id^='perticular_rate_']").each(function() {
//             var id = $(this).attr('id');
//             id = id.replace("perticular_rate_", '');
            
//             var perticular_rate = $('#perticular_rate_' + id).val();
          
//             totalAmount = parseInt(totalAmount) + parseInt(perticular_rate);
//         });
//         $('#fees_sub_total').val(parseInt(totalAmount));
// }
</script>
<script>
    $(document).ready(function () {
        // Attach event listener for input changes
        $(document).on('input', "[id^='perticular_rate_']", function () {
            calculateSubtotal();
        });

        function calculateSubtotal() {
            var totalAmount = 0;

            // Iterate through all input fields with IDs starting with "perticular_rate_"
            $("[id^='perticular_rate_']").each(function () {
                var value = $(this).val(); // Get the value of the input
                if (!isNaN(value) && value.trim() !== "") { // Check if it's a valid number
                    totalAmount += parseInt(value); // Add to totalAmount
                }
            });

            // Update the subtotal field
            $('#fees_sub_total').val(totalAmount);
        }
    });
</script>
<?= $this->endSection() ?>