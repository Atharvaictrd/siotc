<?= $this->extend('layout/tempmain') ?>

<?= $this->section('links') ?>
<?= $this->endSection('links') ?>

<?= $this->section('content') ?>

<?php
 $db  = \Config\Database::connect();
 $st_qry = $db->query("SELECT * FROM student_admission_information ORDER BY student_admission_id ASC");
 $session=($_POST['session'] ?? '');
//  $slc_no=lc_no();
 if(isset($_POST['submit'])){
     $student_id = ($_POST['stu_id'] ?? '');
      $st_qry1 = $db->query("SELECT * FROM student_admission_information Where reg_no='$student_id'");
       foreach ($st_qry->getResult() as $check_row1) {
           
          $stu_id= $check_row1->student_admission_id;
       }
      
     
     $student_admission_id = ($_POST['stu_reg'] ?? '');
     $stu_id = $check_row1->student_admission_id;
	    $discharge_no = ($_POST['discharge_no'] ?? '');
	    $leaving_date = ($_POST['leaving_date'] ?? '');
	    $reason_of_leaving = ($_POST['reason_of_leaving'] ?? '');
	    $remark = ($_POST['remark'] ?? '');
	    $progress = ($_POST['progress'] ?? '');
	    $conduct = ($_POST['conduct'] ?? '');
	    $modify_by			= $_SESSION['user_name'];
			  $modify_date		= date('Y-m-d h:i:s');
			  $modify_ip			= $_SERVER['REMOTE_ADDR'];
     
     if(empty($student_admission_id))
{
	$error[] = 'Registration no. can not be empty.';
}else{
     $check = $db->query("SELECT * FROM cer_leaving WHERE student_admission_id = '$student_id'");
     foreach ($check->getResult() as $check_row) {}
     if($check_row->student_admission_id == $student_id)
    {
        $error[] = 'Leaving Certificate already generated.'.('<a href="'.base_url().'cer_leaving_print_final?reg_no='.$student_admission_id.'&session='.$session.'"><button class="print">Print</button></a>
        OR
        <a href="'.base_url().'cert_leaving?reg_no='.$student_admission_id.'&session='.$session.'"><button class="edit">Edit L.C</button></a>');
        // $update = $db->query("UPDATE `cer_leaving` SET `date_of_leaving`='[value-7]',`reason_of_leaving`='$reason_of_leaving',`remark`='$remark',
        // `progress`='[value-17]',`conduct`='[value-18]' WHERE student_id='$student_id'");
        
        
    }else{
        if(empty($_POST['reason_of_leaving']))
	{
		$error[] = 'Reason can not be empty.';
	}
	if(empty($_POST['remark']))
	{
		$error[] = 'Remark can not be empty.';
	}
	if(empty($_POST['progress']))
	{
		$error[] = 'Progress can not be empty.';
	}
	if(empty($_POST['conduct']))
	{
		$error[] = 'Conduct can not be empty.';
	}
	if(empty($error))
	{
	    
	    $insert_qry = $db->query("INSERT INTO `cer_leaving`(`student_id`,`student_admission_id`, `discharge_no`,`date_of_leaving`, `reason_of_leaving`, `remark`, `progress`, `conduct`, `modify_by`, `modify_date`, `modify_ip`) 
	    VALUES ('$stu_id','$student_admission_id','$discharge_no','$leaving_date','$reason_of_leaving','$remark','$progress','$conduct','$modify_by','$modify_date','$modify_ip')");
	    if($insert_qry){
	        $success[] = 'Leaving Certificate is Generated Successfully...';
	        header("Location: cer_leaving_print_final?reg_no=".$student_admission_id."&session=".$session."");
	    }
	}
    }
 }
 }
 ?>
<div class="menu-item d-flex">
<a href="javascript:;" class="app-sidebar-minify-btn ms-auto d-flex align-items-center text-decoration-none" data-toggle="app-sidebar-minify"><i class="fa fa-angle-double-left"></i></a>
</div>

</div>

</div>

</div>
<div class="app-sidebar-bg" data-bs-theme="dark"></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>

<div id="content" class="app-content">
<div class="row">
<div class="col-xl-12">
<?php if($success): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
       <?php
        foreach($success as $key => $val)
				{
					echo "<li>".$val."</li>";
				}
        ?>
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
<div class="panel panel-inverse">

<div class="panel-heading">
<h4 class="panel-title">Leaving Certificate</h4>
</div>
<div class="panel-body">
<form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post">
<div class="form-group row">
   <div class="col-xl-6" ><b>Student Name</b></div>
</div>
<div class="form-group row">
    <div class="col-xl-6" >
        <select class="form-control chosen-select" name="stu_id"  id="stu_name" class="form-control col-sm-5 chosen-select" onChange="myFunction()" autocomplete="off">
            <option value="">Select Name</option>
            <?php
            foreach ($st_qry->getResult() as $st_row) {
                ?>
                <option value="<?=$st_row->reg_no;?>">
                    <?=$st_row->first_name;?> <?=$st_row->middle_name;?> <?=$st_row->last_name;?>
                </option>
                <?php
            }
            ?>
        </select>
        </div>

</div>
<br>
<div class="form-group row">
   <div class="col-xl-3" ><b>

Student Reg. No</b></div>
  <div class="col-xl-3" ><b>Session</b></div>
   <div class="col-xl-3" ><b>Discharge No.</b></div>
  <div class="col-xl-3" ><b>Date of leaving</b></div>
</div>
<div class="form-group row">
     <div class="col-xl-3" ><input type="text" class="form-control" name="stu_reg"id="stu_reg"></div>
   <div class="col-xl-3" >
   <select class="form-control" name="session" id="dropdownYear" >
    <option value="">Select session</option>
    <option value="<?=$_SESSION['session_year']?>" selected><?=$_SESSION['session_year']?></option>
</select>
   </div>
    <div class="col-xl-3" ><input type="text" class="form-control" name="discharge_no"id="discharge_no"></div>
    <div class="col-xl-3" ><input type="date" class="form-control" name="leaving_date"id="leaving_date"></div>
</div>
<br>
<div class="form-group row">
   <div class="col-xl-3" ><b>
Reason of leaving</b></div>
  <div class="col-xl-3" ><b>Remark</b></div>
   <div class="col-xl-3" ><b>Progress</b></div>
  <div class="col-xl-3" ><b>Conduct </b></div>
</div>
<div class="form-group row">
     <div class="col-xl-3" ><input type="text" class="form-control" name="reason_of_leaving"id="reason"></div>
   <div class="col-xl-3" ><input type="text" class="form-control" name="remark"id="remark"></div>
    <div class="col-xl-3" ><input type="text" class="form-control" name="progress"id="progress"></div>
    <div class="col-xl-3" ><input type="text" class="form-control" name="conduct"id="conduct"></div>
</div>
<br>
<div class="form-group row">
<label class="col-lg-4 col-form-label form-label">&nbsp;</label>
<div class="col-lg-6">
<button type="submit" class="btn btn-warning col-xl-4" name="submit">Submit</button>
</div>
</div>
</form>
</div>
<div class="hljs-wrapper">
<pre><code class="html" data-url="<?= base_url('assets/data/table-manage/keytable.json'); ?>"></code></pre>
</div>

</div>

</div>

</div>




</div>

</div>



<a href="javascript:;" class="btn btn-icon btn-circle btn-theme btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
// Hide the div initially
document.addEventListener("DOMContentLoaded", function() {
  var divToHide = document.getElementById("tableDiv");
  divToHide.style.display = "none";
});

// Add event listener to search button
document.getElementById("searchBtn").addEventListener("click", function() {
  // Show the div with id "tableDiv"
  var divToShow = document.getElementById("tableDiv");
  divToShow.style.display = "block"; // Set the display property to "block" to show the div
});
    function myFunction() {
  var x = document.getElementById("stu_name").value ;
 $('#stu_reg').val(x);
//  $('.prospectus_no').show();
//   getObject('enquiry_no').value = x.value;
}
 
</script>
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
</script>

<?= $this->endSection() ?>

