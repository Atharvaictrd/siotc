<?= $this->extend('layout/tempmain') ?>

<?= $this->section('links') ?>
<?= $this->endSection('links') ?>

<?= $this->section('content') ?>


<?php

if(isset($_POST['bon_save'])){
    
    $dob=($_POST['dob'] ?? '');
    $db      = \Config\Database::connect();
     $update=$db->query("Update student_admission_information SET date_of_birth='".($_POST['date_of_birth'] ?? '')."' where reg_no='".($_POST['h_reg_no'] ?? '')."' "); 
//  echo "Update student_admission_information SET date_of_birth='".$_POST['date_of_birth']."' where reg_no='".$_POST['h_reg_no']."' ";
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

<div class="panel panel-inverse">

<div class="panel-heading">
<h4 class="panel-title">Bonafied Certificate</h4>
</div>
<div class="panel-body">
<form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post">
<div class="form-group row">
   <div class="col-xl-6" ><b>Student Name</b></div>
    <div class="col-xl-4" ><b>Date</b></div>
</div>
<div class="form-group row">
    <div class="col-xl-6" > <select name="stu_name" id="stu_name" class="form-control col-sm-5 chosen-select" onChange="myFunction()" autocomplete="off">
                                              <option>--Select--</option>
                                                  <?php
                                                 $db  = \Config\Database::connect();
                                                                    $query1= $db->query("SELECT * FROM student_admission_information WHERE active_status='0' ORDER BY student_admission_id ASC"); 
                                                foreach ($query1->getResult() as $row1) {

                                                     echo ' <option value="'.$row1->reg_no.'">'.$row1->salutation." . ".$row1->first_name." ".$row1->last_name.'</option>';
                                                  }
                                                  ?>
                                              </select></div>
       <div class="col-xl-4" ><input type="date" class="form-control" name="date"id="date" required></div>
</div>
<br>
<div class="form-group row">
   <div class="col-xl-4" ><b>
Student Reg. No</b></div>
  <div class="col-xl-4" ><b>Session</b></div>
  
</div>
<div class="form-group row">
   
     <div class="col-xl-4" ><input type="text" class="form-control" name="stu_reg" id="stu_reg"  value="" required></div>
   <div class="col-xl-4" ><select class="form-control" name="session" id="dropdownYear">
     <option value="<?= $_SESSION['session_year']; ?>" selected><?= $_SESSION['session_year']; ?></option>
</select></div>
</div>
<br>

<div class="form-group row">
<label class="col-lg-4 col-form-label form-label">&nbsp;</label>
<div class="col-lg-6">
<input type="submit" class="btn btn-warning col-xl-4" name="submit" id="searchBtn" value="Submit"> 
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

<?php
if(!empty($_POST['stu_name']) && !empty($_POST['stu_reg']) && !empty($_POST['date']) && !empty($_POST['session'])){
?>
<div class="row" >
<div class="col-xl-12">
    <div class="panel panel-inverse" >
        <?php
         
        // echo "SELECT * FROM student_admission_information  Where reg_no='".$_POST['stu_reg']."'";
            	 $query3 = $db->query("SELECT * FROM student_admission_information  Where reg_no='".($_POST['stu_reg'] ?? '')."'"); 
            	foreach ($query3->getResult() as $row3) {}
            	?>
            	<form method="post">
    <div class="panel-body" id="mydiv">
        <center>
      <table width="680" border="0" cellspacing="0" cellpadding="10" style="border:3px solid #000; font-size:12px;" class="normal-text " >
          <tbody><tr>
            <td> <table width="100%" border="0" cellspacing="0" cellpadding="0" class="address8">
              <tbody style="border-bottom:double;">
             
              <tr>
                <td>  <img src="<?= base_url('assets/img/somya_tech_logo.png'); ?>" height="100px;" width="100%"></td>
              </tr>
          
             
            </tbody></table></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="address9">
            <tbody><tr>
                
  <td width="84%" align="left"><span class="address">Ref. No.   &nbsp;&nbsp;<?= ($_POST['stu_reg'] ?? '');?><span style="float:right;" class="address9">Date:-  <?= date('d-m-Y', strtotime(($_POST['date'] ?? '')));?></span></span></td></tr>
            </tbody></table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="address9">
                <tbody><tr>
                  <td height="38" colspan="2" class="address3"><div align="center">
                    <h3><b><i>Bonafide Certificate</i></b></h3>
                    </div></td>
                </tr>
                	 <?php
        $class = $db->query("SELECT * FROM class WHERE class_id='$row3->program' "); 
                                    // $query   = $builder->get(); 
                                    foreach ($class->getResult() as $class3) { }
?>
                <tr>
                  <td align="justify"><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>&nbsp;&nbsp;&nbsp;This is to  certify that Mast./Ku.</em>&nbsp;<strong style="text-transform:capitalize;"><span class="letter"><?= $row3->first_name.' '.$row3->middle_name.' '.$row3->last_name;?></span></strong><em>&nbsp; is  a student of this College and studying in&nbsp;</em><strong><span class="letter"><?= $class3->class;?></strong><em> for the session</em> <span class="letter"><strong><?= ($_POST['session'] ?? '');?></strong></span><em> His/Her date of</em><em> birth from the college record is</em><strong> <span class="letter">
                      <input type="hidden" name="h_reg_no" value="<?= ($_POST['stu_reg'] ?? '');?>">
                      <input type="text" class="letter text-center"  name="date_of_birth" size="10" value="<?= date('d-m-Y', strtotime($row3->date_of_birth));?>"></span></strong> <em>This is issued on request of parents  / Students's.</em></p>                    <p><strong></strong></p></td>
                </tr>
                <tr>
                  <td height="28" align="left"><p></p></td>
                </tr>
                <tr>
                  <td height="28" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody><tr>
                      <td colspan="2">&nbsp;</td>
                      </tr>
                    <tr>
                      <td><span class="address4" style="padding:25px 55px;"><strong>Clerk</strong></span></td>
                      <td align="right"><span class="address5" style="padding:25px 55px;"><strong>Principal</strong></span></td>
                      </tr>
                    <tr>
                      <td colspan="2">&nbsp;</td>
                      </tr>
                    </tbody></table></td>
                </tr>
            </tbody></table></td>
          </tr>
        </tbody></table></center>
    </div>
     <div class="form-group row">
<label class="col-lg-4 col-form-label form-label">&nbsp;</label>
<div class="col-lg-6">
<input type="submit" class="btn btn-warning col-xl-4" name="bon_save" id="bon_save" value="Save"> 
<a href="<?= base_url(); ?>cert_bonafied?reg_no=<?= ($_POST['stu_reg'] ?? '');?>" value="Print" class=" btn btn-primary col-xl-4 "  />Print </a>
</div>
</div>
</form>
</div>
</div>
</div>

<?php } ?>

</div>

</div>



<a href="javascript:;" class="btn btn-icon btn-circle btn-theme btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>

</div>

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script type="text/javascript">

   function Printtc() {    
       var divToPrint = document.getElementById('leaving');
       var popupWin = window.open('', '', 'width=870,height=450');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
            }
</script>

<?= $this->endSection() ?>

