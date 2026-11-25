<?= $this->extend('layout/tempmain') ?>

<?= $this->section('links') ?>
<?= $this->endSection('links') ?>

<?= $this->section('content') ?>
<script src="<?= base_url('assets/js/eng_to_marathi.js')?>"></script>
<?php


    	$db      = \Config\Database::connect();
								
	$sql = $db->query("SELECT * FROM student_admission_information WHERE student_admission_id ='$student_id'");
	foreach ($sql->getResult() as $st_row) {
   $_POST['mar_name'] = ($_POST['mar_name'] ?? '') ? $_POST['mar_name'] : $st_row->mar_name;
	    
	}

?>
<link href="assets/css/vendor.min.css" rel="stylesheet" />
<link href="assets/css/default/app.min.css" rel="stylesheet" />
<link href="assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link href="assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
<link href="assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
<link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
<link href="assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css" rel="stylesheet" />
<link href="assets/plugins/tag-it/css/jquery.tagit.css" rel="stylesheet" />
<link href="assets/plugins/spectrum-colorpicker2/dist/spectrum.min.css" rel="stylesheet" />
<link href="assets/plugins/select-picker/dist/picker.min.css" rel="stylesheet" />
<div class="menu-item d-flex">
<a href="javascript:;" class="app-sidebar-minify-btn ms-auto d-flex align-items-center text-decoration-none" data-toggle="app-sidebar-minify"><i class="fa fa-angle-double-left"></i></a>
</div>

</div>

</div>

</div>
<div class="app-sidebar-bg" data-bs-theme="dark"></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>


<div id="content" class="app-content">
<style>
  .tab {
    display: none;
  }
  .tab.active {
    display: block;
  }
</style>

<div class="row">

<div class="col-xl-12">

<div class="panel panel-inverse" data-sortable-id="form-validation-1">
<style>
  .tab {
    display: none;
  }
  .tab.active {
    display: block;
  }
</style>
<div class="panel-heading">
<h3 class="panel-title">Student Admission Form</h3>
</div>


<div class="panel-body">
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
<form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post" action="<?= base_url('update_std_data/'.$student_id); ?>" enctype="multipart/form-data">
    <div class="text-center"> <h4>Student Admission Form</h4></div>
      <div > <h4 class="text-decoration-underline">Joining Details</h4></div>
<div class="form-group row mt-4">
    <div class="col-xl-3" ><b>Date</b></div>
      <div class="col-xl-3"><b>Session</b></div>
   <div class="col-xl-3"><b>Reg No</b></div>
   <div class="col-xl-3"><b>Roll No</b></div>
</div>
<div class="form-group row">
    <div class="col-xl-3"><input type="date" name="date_of_admission" class="form-control" id="date" value="<?=$st_row->date_of_admission;?>"  ></div>
      <div class="col-xl-3">
          <select name="session_year" onchange="javascript:form_submit();" class=" form-control"  id="dropdownYear" >
            <option value="<?=$st_row->session_year;?>" selected><?=$st_row->session_year;?></option>
         </select>
         </div>
   
    <div class="col-xl-3"><input type="text" class="form-control" name = "reg_no"  id="reg_no" value="<?=$st_row->reg_no;?>"  ></div>
      <div class="col-xl-3"><input type="text" class="form-control" name = "c_roll_no"  id="c_roll_no" value="<?php echo $st_row->c_roll_no ?>"></div>
     </div> 
  <br>
  <div class="form-group row">
   <div class="col-xl-4" ><b>Prospectus No</b></div>
      <div class="col-xl-4"><b>Enrollment No</b></div>
   <div class="col-xl-4"><b>Category</b></div>
</div> 
<div class="form-group row">
   <div class="col-xl-4"><input type="text" class="form-control" name = "prospectus_no"  id="prospectus_no"  value="<?= $st_row->prospectus_no;?>" ></div>
    <div class="col-xl-4"><input type="text" class="form-control" name = "enrollment_no"  id="enroll_no" value="<?= $st_row->enrollment_no;?>" ></div>
     <div class="col-xl-4"><?php
									 $query3 = $db->query("SELECT * FROM student_category ORDER BY category_id ");  
									
									?><select name="category" id="category" class="form-control" >
       	<?php foreach ($query3->getResult() as $row3) {
   $c1= $row3->category;

?>
            <option value="<?php echo $row3->category;?>"<?php if ($c1 == $st_row->category) { ?> selected <?php } ?>><?php echo $row3->category;?></option>
            <?php } ?>
    </select></div>
</div> 
<br>
<hr style="border: 0; 
  height: 1px; 
  background-color: #009292;
  " />
<div > <h4 class="text-decoration-underline">Student Information</h4></div>
 <br> 
    <div class="form-group row">
        <div class="col-xl-9">
            <div class="row">
                <div class="col-xl-3">
                    <lable><b>Student Name</b></lable>
                    <select name="salutation" id="stu_name" class="form-control" >
                        <option value="Mr" <?php if ('Mr' == $st_row->salutation) { ?> selected <?php } ?>>Mr.</option>
                        <option value="Miss" <?php if ('Miss' == $st_row->salutation) { ?> selected <?php } ?>>Miss.</option>
                        <option value="Mrs" <?php if ('Mrs' == $st_row->salutation) { ?> selected <?php } ?>>Mrs.</option>
                    </select>
                </div>
                <div class="col-xl-3">
                    <lable><b>First Name</b></lable>
                    <input type="text" class="form-control" name = "first_name"  id="f_name" value="<?= $st_row->first_name;?>"  >
                </div>
                <div class="col-xl-3">
                    <lable><b>Middle Name</b></lable>
                    <input type="text" class="form-control" name = "middle_name"  id="l_name"  value="<?= $st_row->middle_name;?>" >
                </div>
                <div class="col-xl-3">
                    <lable><b>Last Name</b></lable>
                    <input type="text" class="form-control" name = "last_name"  id="l_name"  value="<?= $st_row->last_name;?>" >
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-xl-3">
                    <lable><b>Student Name In Marathi:</b></lable>
                 
                </div>
                <div class="col-xl-9">
                  <script language="javascript">CreateCustomHindiTextBox("mar_name",<?= json_encode($_POST['mar_name'] ?? '') ?>,40,true);</script>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-xl-4">
                    <lable><b>Program</b></lable>
                    <select name="program"  class="form-control" id="class" >
            
            <option value="">-----SELECT-----</option>
            	<?php 
            	$query3 = $db->query("SELECT * FROM class ORDER BY class_id ");  
            	foreach ($query3->getResult() as $row3) {
    	$p2=$row3->class_id; ?>
            <option value="<?php echo $row3->class_id;?>"<?php if ($row3->class_id == $st_row->program) { ?> selected <?php } ?>><?php echo $row3->class;?></option>
            <?php } ?></select>
                </div>
                <div class="col-xl-4">
                    <lable><b>Semester</b></lable>
                    <select name="semister"  class="form-control" id="semister" >
            
            <option value="">-----SELECT-----</option>
            	<?php
            	$query2 = $db->query("SELECT * FROM program_sem ORDER BY program_sem_id ");  
            	foreach ($query2->getResult() as $row2) { ?>
            <option value="<?php echo $row2->program_sem;?>" <?php if ($row2->program_sem == $st_row->semister) { ?> selected <?php } ?>><?php echo $row2->program_sem;?></option>
            <?php } ?></select>
                </div>
                <div class="col-xl-4">
                    <lable><b>Date of Birth</b></lable>
                    <input type="date" class="form-control" name ="date_of_birth"  id="dob" value="<?=$st_row->date_of_birth;?>" >
                </div>
            </div>
        </div>
        <div class="col-xl-3 text-center">
            <?php if($st_row->student_image !==''){ ?>
            <img src="<?=base_url();?>photo/<?=$st_row->student_image?>" style="width: 100%; height: 100%; border: 2px solid;object-position: center;object-fit: cover;">
            <?php
            }else{
                ?>
            <img src="<?=base_url();?>photo/no_student_image.jpg" style="width: 100%; height: 100%; border: 2px solid;">
                <?php
            }
            ?>
        </div>
    </div>
    
  <br>
  <div class="form-group row">
   <div class="col-xl-4">
       <lable><b>Photo</b></lable>
       <input type="file" class="form-control" name ="photo" id="photo">
    </div>
    <div class="col-xl-4">
        <lable><b>Status</b></lable>
        <select name="status" class="form-control">
            <option value="">-----SELECT-----</option>
            <option value="new" <?php if($st_row->status =='new'){ echo"selected"; } ?>>New</option>
            <option value="Suspended" <?php if($st_row->status =='Suspended'){ echo"selected"; } ?>>Suspended</option>
            <option value="Left" <?php if($st_row->status =='Left'){ echo"selected"; } ?>>Left</option>
        </select>
    </div>
    <div class="col-xl-4">
        <lable><b>Active</b></lable>
        <select name="active_status" class="form-control">
            <option value=""  ></option>Yes / No</option>
            <option value="0" <?php if($st_row->active_status =='0'){ echo"selected"; } ?>>Yes</option>
            <option value="1" <?php if($st_row->active_status =='1'){ echo"selected"; } ?>>No</option>
        </select>
    </div>
</div>

    <hr style="border: 0; 
  height: 1px; 
  background-color: #009292;
  " />
  <br>

<div class="tabs">
  <a class="tablinks btn btn-primary " onclick="openTab(event, 'tab1')">Contact Details</a>
  <a class="tablinks btn btn-primary" onclick="openTab(event, 'tab2')">Personal Info</a>
  <a class="tablinks btn btn-primary " onclick="openTab(event, 'tab3')">Examination Details</a>
  <a class="tablinks btn btn-primary" onclick="openTab(event, 'tab4')">Qualification Details</a>
  <a class="tablinks btn btn-primary" onclick="openTab(event, 'tab5')">Certificate Enclosed</a>
  <a class="tablinks btn btn-primary " onclick="openTab(event, 'tab6')">Parents Info</a>
    <a class="tablinks btn btn-primary " onclick="openTab(event, 'tab7')">Documents Issued</a>
</div>
<br>
<div id="wizardForm"  >
  <?php
  $sql2 = $db->query("SELECT * FROM student_personal_information WHERE student_admission_id ='$student_id'");
	foreach ($sql2->getResult() as $spi_row) {}
  ?>
  
   <?php
  $sql2 = $db->query("SELECT * FROM student_parent_information WHERE student_admission_id ='$student_id'");
	foreach ($sql2->getResult() as $spri_row) {}
  ?>
  <!-- Step 1 -->
  <div id="tab1" class="tab active">
      
   <div class="form-group row">
     <div class="col-xl-3"> <b>Father's/Guardian Name</b></div>
   <div class="col-xl-3"><input type="text" class="form-control" name = "fa_first_name"  id="f_name"  placeholder="First Name.."   value="<?=$spri_row->f_first_name;?>"></div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "fa_middle_name"  id="m_name"  placeholder="Middle Name.."  value="<?=$spri_row->f_middle_name;?>"></div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "fa_last_name"  id="l_name"  placeholder="Last Name.."   value="<?=$spri_row->f_last_name;?>"></div>
</div> <br>
 <div class="form-group row">
     <div class="col-xl-3"> <b>Mother's Name</b></div>
   <div class="col-xl-3"><input type="text" class="form-control" name = "mo_first_name"  id="f_name"  placeholder="First Name.."  value="<?=$spri_row->m_first_name;?>"></div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "mo_middle_name"  id="m_name"  placeholder="Middle Name.."  value="<?=$spri_row->m_middle_name;?>"></div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "mo_last_name"  id="l_name"  placeholder="Last Name.."  value="<?=$spri_row->m_last_name;?>"></div>
</div> <br><br>
<div> <h4>Address For Correspondence</h4></div>
  <div class="form-group row">
   <div class="col-xl-3" ><b>Plot No</b></div>
   <div class="col-xl-3"><b>Area</b></div>
    <div class="col-xl-3"><b>City</b></div>
    <div class="col-xl-3"><b>Pin Code</b></div>
</div>
<div class="form-group row"> <div class="col-xl-3"><input type="text" class="form-control" name = "c_plot_no"  id="c_plot_no"  ></div>
     <div class="col-xl-3"><input type="text" name="c_area" id="c_area" class="form-control" >
        </div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "c_city"  id="c_city"  ></div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "c_pincode"  id="c_pincode"  ></div>
</div><br>
<div class="form-group row">
   <div class="col-xl-4" ><b>District</b></div>
   <div class="col-xl-4"><b>State</b></div>
    <div class="col-xl-4"><b>Tel No</b></div>
   
</div>
<div class="form-group row"> <div class="col-xl-4"><input type="text" class="form-control" name = "c_district"  id="c_district"  ></div>
     <div class="col-xl-4"><?php
								
									 $query4 = $db->query("SELECT * FROM states_of_india ORDER BY state_id ASC");
									
									?><select name="c_state" id="state" class="form-control" ><option option="">Select</option>
       	<?php foreach ($query4->getResult() as $row4) {
    

?>
            <option value="<?php echo $row4->state_id;?>"><?php echo $row4->state;?></option>
            <?php } ?></select></div>
    <div class="col-xl-4"><input type="text" class="form-control" name = "c_tel_no"  id="c_tel_no" > </div>
    
</div>
<br><br>
<div> <h4>Permanent Address:</h4> <input type="checkbox" name="copy_address" class="copy_address" id="copy_address" onclick="myFunction()">Same As Above</div>
  <div class="form-group row">
   <div class="col-xl-3" ><b>Plot No</b></div>
   <div class="col-xl-3"><b>Area</b></div>
    <div class="col-xl-3"><b>City</b></div>
    <div class="col-xl-3"><b>Pin Code</b></div>
</div>
<div class="form-group row"> <div class="col-xl-3"><input type="text" class="form-control" name = "p_plot_no"  id="p_plot_no"  ></div>
     <div class="col-xl-3"><input type="text" name="p_area" id="p_area" class="form-control" >
     </div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "p_city"  id="p_city"  ></div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "p_pincode"  id="p_pincode"  ></div>
</div><br>
<div class="form-group row">
   <div class="col-xl-3" ><b>District</b></div>
   <div class="col-xl-3"><b>State</b></div>
    <div class="col-xl-3"><b>Mobile No</b></div>
     <div class="col-xl-3"><b>Email</b></div>
   
</div>
<div class="form-group row"> <div class="col-xl-3"><input type="text" class="form-control" name = "p_district"  id="p_district"  ></div>
     <div class="col-xl-3"><?php
								
									 $query4 = $db->query("SELECT * FROM states_of_india ORDER BY state_id ASC"); 
									// $query   = $builder->get(); 
									
									?><select name="p_state" id="p_state" class="form-control" ><option option="">Select</option>
       	<?php foreach ($query4->getResult() as $row4) {
    

?>
            <option value="<?php echo $row4->state_id;?>"><?php echo $row4->state;?></option>
            <?php } ?></select></div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "p_tel_no"  id="p_tel_no" > </div>
     <div class="col-xl-3"><input type="text" class="form-control" name = "p_email"  id="p_email" > </div>
    
</div> <br>
  </div>
  
  <!-- Step 2 -->
  <div id="tab2" class="tab">
   
   <div class="form-group row">
   <div class="col-xl-3" ><b>Place of Birth</b></div>
   <div class="col-xl-3"><b>State</b></div>
    <div class="col-xl-3"><b>Domicile of State</b></div>
     <div class="col-xl-3"><b>District</b></div>
   
</div>
<div class="form-group row">
     <div class="col-xl-3"><input type="text" class="form-control" name = "place_of_birth"  id="pob"  valiue="<?=$spi_row->place_of_birth;?>"></div>
     <div class="col-xl-3"><?php
								
									 $query4 = $db->query("SELECT * FROM states_of_india ORDER BY state_id ASC"); 
									// $query   = $builder->get(); 
									
									?><select name="place_state" id="place_state" class="form-control" ><option option="">Select</option>
       	<?php foreach ($query4->getResult() as $row4) {
    

?>
            <option value="<?php echo $row4->state_id;?>" <?php if($spi_row->place_state == $row4->state_id){ echo "selected"; } ?>><?php echo $row4->state;?></option>
            <?php } ?></select></div>
   <div class="col-xl-3"><?php
								
									 $query4 = $db->query("SELECT * FROM states_of_india ORDER BY state_id ASC"); 
									// $query   = $builder->get(); 
									
									?><select name="domicile_of_state" id="domicile_of_state" class="form-control" ><option option="">Select</option>
       	<?php foreach ($query4->getResult() as $row4) {
    

?>
            <option value="<?php echo $row4->domicile_of_state;?>" <?php if($spi_row->domicile_of_state == $row4->domicile_of_state){ echo "selected"; } ?>><?php echo $row4->state;?></option>
            <?php } ?></select></div>
     <div class="col-xl-3"><input type="text" class="form-control" name = "domicile_district"  id="district" value="<?=$spi_row->domicile_district?>"> </div>
    </div><br>
    <div class="form-group row">
   <div class="col-xl-3" ><b>Gender</b></div>
   <div class="col-xl-3"><b>Town</b></div>
    <div class="col-xl-3"><b>Religion</b></div>
     <div class="col-xl-3"><b>Nationality</b></div>
</div>
   <div class="form-group row">
        <div class="col-xl-3">
            <input type="radio"  name = "sex"  id="gender" value="Male" <?php if($spi_row->sex == 'Male'){ echo "checked"; }?>> Male 
            <input type="radio"  name = "sex"  id="gender" value="Female" <?php if($spi_row->sex == 'Female'){ echo "checked"; }?>> Female 
            <input type="radio"  name = "sex"  id="gender" value="other" <?php if($spi_row->sex == 'other'){ echo "checked"; }?>> Other</div>
         <div class="col-xl-3"><input type="text" class="form-control" name = "domicile_town"  id="district"  value="<?=$spi_row->domicile_town?>"> </div>
          <div class="col-xl-3"><input type="text" class="form-control" name = "religion"  id="district"  value="<?=$spi_row->religion?>"> </div>
           <div class="col-xl-3"><input type="text" class="form-control" name = "nationality"  id="district"  value="<?=$spi_row->nationality?>"> </div>
       </div><br>
       <div class="form-group row">
   <div class="col-xl-4"><b>Category</b></div>
   <div class="col-xl-4"><b>Caste</b></div>
</div>
   <div class="form-group row">
        <div class="col-xl-4"><?php
									
									 $query3 = $db->query("SELECT * FROM student_category ORDER BY category_id "); 
									// $query   = $builder->get(); 
									
									?><select name="personal_category" id="category" class="form-control" >
       	<?php foreach ($query3->getResult() as $row3) {
    

?>
            <option value="<?php echo $row3->category;?>" <?php if($spi_row->personal_category == $row3->category){ echo "selected"; } ?>><?php echo $row3->category;?></option>
            <?php } ?>
    </select></div>
         <div class="col-xl-4"><input type="text" class="form-control" name = "caste"  id="district" value="<?=$spi_row->caste?>"> </div>
          
       </div><br>
</div>
   
  
  
  <!-- Step 3 -->
  <div id="tab3" class="tab">
    
      <div class="form-group row">
   <div class="col-xl-3" ><b>Exam</b></div>
   <div class="col-xl-3"><b>Year</b></div>
    <div class="col-xl-3"><b>Roll No</b></div>
     <div class="col-xl-3"><b>Marks</b></div>
   
</div>
<div class="form-group row">
     <div class="col-xl-3"><input type="text" class="form-control" name = "exam_passed"  id="exam"   value="<?=$st_row->exam_passed?>"></div>
     <div class="col-xl-3"><select name="year_last_exam" id="dropdownYear1" class="form-control" >
       <option value="<?=$st_row->year_last_exam?>" selected><?=$st_row->year_last_exam?></option>
    </select></div>
   <div class="col-xl-3"><input type="text" class="form-control" name = "roll_no"  id="roll_no"  value="<?=$st_row->roll_no?>" ></div>
     <div class="col-xl-1">
    <input type="text" class="form-control" name = "masrks"  id="roll_no"   value="<?=$st_row->masrks?>">
         </div>
    <div class="col-xl-1">
    <span>Out Of</span>
         </div>
         <div class="col-xl-1">
    <input type="text" class="form-control" name = "out_of"  id="roll_no"    value="<?=$st_row->out_of?>">
         </div><br>
         <div class="form-group row">
   <div class="col-xl-3" ><b>Result</b></div>
   <div class="col-xl-3"><b>Divison</b></div>
    <div class="col-xl-3"><b>Enroll No</b></div>
     <div class="col-xl-3"><b>University / Board</b></div>
   
</div>
<div class="form-group row"> <div class="col-xl-3"><input type="text" class="form-control" name = "result"  id="result"    value="<?=$st_row->result?>"></div>
     <div class="col-xl-3"><input type="text" class="form-control" name = "division"  id="division"   value="<?=$st_row->division?>"></div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "enrol_no_last_exam"  id="enrolll_no"   value="<?=$st_row->enrol_no_last_exam?>"> </div>
     <div class="col-xl-3"><input type="text" class="form-control" name = "university_last_exam"  id="uni_board"   value="<?=$st_row->university_last_exam?>"> </div>
    
</div> <br>
     <div class="form-group row">
   <div class="col-xl-4"><b>Last School/College Attended</b></div>
    <div class="col-xl-4"><b>MSCIT Institute attended</b></div>
   <div class="col-xl-4"><b>Sports achievements</b></div>
</div>
   <div class="form-group row">
        <div class="col-xl-4"><?php
								
									 $query8 = $db->query("SELECT * FROM last_school_attended ORDER BY s_id "); 
									// $query   = $builder->get(); 
									
									?><select name="last_school_attended" id="last_school_attended" class="form-control" >
       	<?php foreach ($query8->getResult() as $row8) {
    

?>
            <option value="<?php echo $row8->s_id;?>" <?php if($st_row->last_school_attended == $row8->s_id){ echo "selected"; } ?>><?php echo $row8->school_name;?></option>
            <?php } ?>
    </select></div>
     <div class="col-xl-3"><input type="text" class="form-control" name = "mscit"  id="mscit"  value="<?=$st_row->mscit?>"> </div>
        <div class="col-xl-4"><select name="sports" id="sports" class="form-control" >
        <option value="">---Select Achievements---</option>
    <option value="national"  <?php if($st_row->sports == 'national'){ echo "selected"; } ?>>National</option>
      <option value="state"  <?php if($st_row->sports == 'state'){ echo "selected"; } ?>>State</option>
      <option value="district"  <?php if($st_row->sports == 'district'){ echo "selected"; } ?>>District</option>
        <option value="local"  <?php if($st_row->sports == 'local'){ echo "selected"; } ?>>Local</option>
    </select></div>
          
       </div>
  </div>
</div>
<?php
  $sql2 = $db->query("SELECT * FROM student_qualification_detail_2 WHERE student_admission_id ='$student_id'");
	foreach ($sql2->getResult() as $sq_row) {}
  ?>
<!--step 4-->
<div id="tab4" class="tab">
     <div class="form-group row">
         <table class="table table-stripted table-bordered table-responsive">
             <thead>
                 <tr>
                     <th> Examination</th>
                     <th>Board / University </th>
                     <th> School/College</th>
                     <th> Year of passing</th>
                     <th> Total Marks</th>
                     <th> Obatained Marks</th>
                     <th>Percentage </th>
                 </tr>
             </thead>
             <tbody>
                 <tr>
                     <td> S.S.C.</td>
                     <td> <input type="text" class="form-control" name="ssc_board" id="" value="<?=$sq_row->ssc_board;?>"></td>
                     <td><input type="text" class="form-control" name="ssc_school" id="" value="<?=$sq_row->ssc_school;?>"> </td>
                     <td> <select class="form-control dropdownYear2" name="ssc_year" id="dropdownYear2">
                         <option  value="<?=$sq_row->ssc_year;?>" selected><?=$sq_row->ssc_year;?></option>
                     </select></td>
                     <td> <input type="text" class="form-control" name="ssc_total_marks" id=""  value="<?=$sq_row->ssc_total_marks;?>"></td>
                     <td> <input type="text" class="form-control" name="ssc_marks_obtained" id=""  value="<?=$sq_row->ssc_marks_obtained;?>"></td>
                     <td><input type="text" class="form-control " name="ssc_percentage" id=""  value="<?=$sq_row->ssc_percentage;?>"> </td>
                 </tr>
                 <tr>
                     <td> 	H.S.S.C.</td>
                     <td> <input type="text" class="form-control" name="hssc_board" id=""  value="<?=$sq_row->hssc_board;?>"></td>
                     <td><input type="text" class="form-control" name="hssc_school" id=""  value="<?=$sq_row->hssc_school;?>"> </td>
                     <td> <select class="form-control dropdownYear2" name="hssc_year" id="">
                         <option value="<?=$sq_row->hssc_year;?>" selected><?=$sq_row->hssc_year;?></option>
                     </select></td>
                     <td> <input type="text" class="form-control" name="hssc_total_marks" id=""  value="<?=$sq_row->hssc_total_marks;?>"></td>
                     <td> <input type="text" class="form-control" name="hssc_marks_obtained" id=""  value="<?=$sq_row->hssc_marks_obtained;?>"></td>
                     <td><input type="text" class="form-control" name="hssc_percentage" id=""  value="<?=$sq_row->hssc_percentage;?>"> </td>
                 </tr>
                 <tr>
                     <td> 	Graduation</td>
                     <td> <input type="text" class="form-control" name="grad_uni" id=""  value="<?=$sq_row->grad_uni;?>"></td>
                     <td><input type="text" class="form-control" name="grad_college" id=""  value="<?=$sq_row->grad_college;?>"> </td>
                     <td> <select class="form-control dropdownYear2" name="grad_year" id="">
                         <option value="<?=$sq_row->grad_year;?>" selected><?=$sq_row->grad_year;?></option>
                     </select></td>
                     <td> <input type="text" class="form-control" name="grad_total_marks" id=""  value="<?=$sq_row->grad_total_marks;?>"></td>
                     <td> <input type="text" class="form-control" name="grad_marks_obtained" id=""  value="<?=$sq_row->grad_marks_obtained;?>"></td>
                     <td><input type="text" class="form-control" name="grad_percentage" id=""  value="<?=$sq_row->grad_percentage;?>"> </td>
                 </tr>
                 <tr>
                     <td>Post Graduation</td>
                     <td><input type="text" class="form-control" name="pg_uni" id=""  value="<?=$sq_row->pg_uni;?>"></td>
                     <td><input type="text" class="form-control" name="pg_college" id=""  value="<?=$sq_row->pg_college;?>"> </td>
                     <td> <select class="form-control dropdownYear2" name="pg_year" id="">
                         <option value="<?=$sq_row->pg_year;?>" selected><?=$sq_row->pg_year;?></option>
                     </select></td>
                     <td> <input type="text" class="form-control" name="pg_total_marks" id=""  value="<?=$sq_row->pg_total_marks;?>"></td>
                     <td> <input type="text" class="form-control" name="pg_marks_obtained" id=""  value="<?=$sq_row->pg_marks_obtained;?>"></td>
                     <td><input type="text" class="form-control" name="pg_percentage" id=""  value="<?=$sq_row->pg_percentage;?>"> </td>
                 </tr>
                 <tr>
                     <td> 	Other</td>
                     <td> <input type="text" class="form-control" name="other_board" id=""  value="<?=$sq_row->other_board;?>"></td>
                     <td><input type="text" class="form-control" name="other_school" id=""  value="<?=$sq_row->other_school;?>"> </td>
                     <td> <select class="form-control dropdownYear2" name="other_year" id="">
                          <option value="<?=$sq_row->other_year;?>" selected><?=$sq_row->other_year;?></option>
                     </select></td>
                     <td> <input type="text" class="form-control" name="other_total_marks" id=""  value="<?=$sq_row->other_total_marks;?>"></td>
                     <td> <input type="text" class="form-control" name="other_marks_obtained" id=""  value="<?=$sq_row->other_marks_obtained;?>"></td>
                     <td><input type="text" class="form-control" name="other_percentage" id=""  value="<?=$sq_row->other_percentage;?>"> </td>
                 </tr>
             </tbody>
         </table>
     </div>
    </div>
    
    <?php
  $sql2 = $db->query("SELECT * FROM student_certificate_enclosed WHERE student_admission_id ='$student_id'");
	foreach ($sql2->getResult() as $sc_row) {}
  ?>
    <!--step 5-->
    <div id="tab5" class="tab">
        
         <div class="form-group row">
             <div class="col-xl-1">1.</div>
             <div class="col-xl-6">	Guardian Income Certifucate(for other than open category students)</div>
             <div class="col-xl-2"><input type="checkbox" name="guardian_income_certifucate" value="1" <?php if($sc_row->guardian_income_certifucate =='1'){ echo 'checked'; } ?>></div>
         </div>
         <div class="form-group row">
             <div class="col-xl-1">2.</div>
             <div class="col-xl-6">	Passing Certificate of Std. 10th / Statement of Marks of Std. 10th</div>
             <div class="col-xl-2"><input type="checkbox" name="statement_of_marks_ssc" value="1" <?php if($sc_row->statement_of_marks_ssc =='1'){ echo 'checked'; } ?>></div>
         </div>
         <div class="form-group row">
             <div class="col-xl-1">3.</div>
             <div class="col-xl-6">	Passing Certificate of Std. 12th / Statement of Marks of Std. 12th</div>
             <div class="col-xl-2"><input type="checkbox" name="statement_of_marks" value="1" <?php if($sc_row->statement_of_marks =='1'){ echo 'checked'; } ?>></div>
         </div>
         <div class="form-group row">
             <div class="col-xl-1">4.</div>
             <div class="col-xl-6">School/College Leaving Certificate</div>
             <div class="col-xl-2"><input type="checkbox" name="leaving_certificate" value="1" <?php if($sc_row->leaving_certificate =='1'){ echo 'checked'; } ?>></div>
         </div>
         <div class="form-group row">
             <div class="col-xl-1">5.</div>
             <div class="col-xl-6">	Certificate of Caste with Category</div>
             <div class="col-xl-2"><input type="checkbox" name="validity_certificate" value="1" <?php if($sc_row->validity_certificate =='1'){ echo 'checked'; } ?>></div>
         </div>
         <div class="form-group row">
             <div class="col-xl-1">6.</div>
             <div class="col-xl-6">	Non Creamy Layer Certificate</div>
             <div class="col-xl-2"><input type="checkbox" name="non_creamylayer" value="1" <?php if($sc_row->non_creamylayer =='1'){ echo 'checked'; } ?>></div>
         </div>
         <div class="form-group row">
             <div class="col-xl-1">7.</div>
             <div class="col-xl-6">	Eligibility Certificate(for other than Nagpur University students)</div>
             <div class="col-xl-2"><input type="checkbox" name="eligibility_certificate" value="1" <?php if($sc_row->eligibility_certificate =='1'){ echo 'checked'; } ?>></div>
         </div>
         <div class="form-group row">
             <div class="col-xl-1">8.</div>
             <div class="col-xl-6">	Certifucate for Physically Challenged</div>
             <div class="col-xl-2"><input type="checkbox" name="physical_certifucate" value="1" <?php if($sc_row->physical_certifucate =='1'){ echo 'checked'; } ?>></div>
         </div>
         <div class="form-group row">
             <div class="col-xl-1">9.</div>
             <div class="col-xl-6">	Other Certificates:Freedom Fighter,Physical disability,Military Personal,Sports.etc</div>
             <div class="col-xl-2"><input type="checkbox" name="other_certificates" value="1" <?php if($sc_row->other_certificates =='1'){ echo 'checked'; } ?>></div>
         </div>
         <div class="form-group row">
             <div class="col-xl-1">10.</div>
             <div class="col-xl-6">	Affidavit for changed Name/Marriage Certificate/ Govt. Gazette</div>
             <div class="col-xl-2"><input type="checkbox" name="change_name" value="1" <?php if($sc_row->change_name =='1'){ echo 'checked'; } ?>></div>
         </div>
         <div class="form-group row">
             <div class="col-xl-1">11.</div>
             <div class="col-xl-6">	Domicile Certificate</div>
             <div class="col-xl-2"><input type="checkbox" name="domicile_certificate" value="1" <?php if($sc_row->domicile_certificate =='1'){ echo 'checked'; } ?>></div>
         </div>
         <div class="form-group row">
             <div class="col-xl-1">12.</div>
             <div class="col-xl-6">	Migration certificate(If from other state or university)</div>
             <div class="col-xl-2"><input type="checkbox" name="migration_certificate" value="1" <?php if($sc_row->migration_certificate =='1'){ echo 'checked'; } ?>></div>
         </div>
    </div>
    <!--step 6-->
    <div id="tab6" class="tab">
        <div class="form-group row">
             <div class="col-xl-3"><b>Father name:</b></div>
             <div class="col-xl-3">	<input type="text" class="form-control" name = "fn_first_name"  id="f_name" placeholder="First Name"  value="<?=$spri_row->f_first_name;?>"></div>
             <div class="col-xl-3">	<input type="text" class="form-control" name = "fn_middle_name"  id="m_name" placeholder="Middle Name"  value="<?=$spri_row->f_middle_name;?>"></div>
             <div class="col-xl-3">	<input type="text" class="form-control" name = "fn_last_name"  id="l_name" placeholder="Last Name"  value="<?=$spri_row->f_last_name;?>"></div>
         </div>
           <div class="form-group row">
             <div class="col-xl-6"><b>Father's Occupation</b></div>
             <div class="col-xl-6">	<b>	Father's Income (Annual)</b></div>
         </div>
           <div class="form-group row">
             <div class="col-xl-6">	<input type="text" class="form-control" name = "f_occupation"  id="f_occupation"  value="<?=$spri_row->f_occupation;?>"></div>
             <div class="col-xl-6">	<input type="text" class="form-control" name = "f_annual_income"  id="f_income"   value="<?=$spri_row->f_annual_income;?>"></div>
         </div> <br>
         <div> <h6>Father's Office Address</h6> </div>
  <div class="form-group row">
   <div class="col-xl-3" ><b>Plot No</b></div>
   <div class="col-xl-3"><b>Area</b></div>
    <div class="col-xl-3"><b>City</b></div>
    <div class="col-xl-3"><b>Pin Code</b></div>
</div>
<div class="form-group row"> <div class="col-xl-3"><input type="text" class="form-control" name = "f_o_plot_no"  id="plot_no"   value="<?=$spri_row->f_o_plot_no;?>" ></div>
     <div class="col-xl-3"><input type="text" name="f_o_area" id="f_o_area" class="form-control"  value="<?=$spri_row->f_o_area;?>" >
        </div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "f_o_city"  id="city"   value="<?=$spri_row->f_o_city;?>" ></div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "f_o_pin_code"  id="pincode"    value="<?=$spri_row->f_o_pin_code;?>"></div>
</div><br>
<div class="form-group row">
   <div class="col-xl-3" ><b>District</b></div>
   <div class="col-xl-3"><b>State</b></div>
    <div class="col-xl-3"><b>Mobile No</b></div>
     <div class="col-xl-3"><b>Email</b></div>
   
</div>
<div class="form-group row"> <div class="col-xl-3"><input type="text" class="form-control" name = "f_district"  id="district"  value="<?=$spri_row->f_district;?>" ></div>
     <div class="col-xl-3"><?php
								
									 $query4 = $db->query("SELECT * FROM states_of_india ORDER BY state_id ASC"); 
									// $query   = $builder->get(); 
									
									?><select name="f_o_state" id="f_o_state" class="form-control" ><option option="">Select</option>
       	<?php foreach ($query4->getResult() as $row4) {
    

?>
            <option value="<?php echo $row4->state_id;?>" <?php if($row4->state_id == $spri_row->f_o_state){ echo "selected"; } ?>><?php echo $row4->state;?></option>
            <?php } ?></select></div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "f_o_tel_no"  id="tel_no"  value="<?=$spri_row->f_o_tel_no;?>"> </div>
     <div class="col-xl-3"><input type="text" class="form-control" name = "f_o_email"  id="email"  value="<?=$spri_row->f_o_email;?>"> </div>
    
</div> <br>
 <div class="form-group row">
             <div class="col-xl-3"><b>Mother name:</b></div>
             <div class="col-xl-3">	<input type="text" class="form-control" name = "mn_first_name"  id="f_name" placeholder="First Name"  value="<?=$spri_row->m_first_name;?>"></div>
             <div class="col-xl-3">	<input type="text" class="form-control" name = "mn_middle_name"  id="m_middle_name" placeholder="Middle Name"  value="<?=$spri_row->m_middle_name;?>"></div>
             <div class="col-xl-3">	<input type="text" class="form-control" name = "mn_last_name"  id="m_last_name" placeholder="Last Name"  value="<?=$spri_row->m_last_name;?>"></div>
         </div>
           <div class="form-group row">
             <div class="col-xl-6"><b>Mother's Occupation</b></div>
             <div class="col-xl-6">	<b>	Mother's Income (Annual)</b></div>
         </div>
           <div class="form-group row">
             <div class="col-xl-6">	<input type="text" class="form-control" name = "m_occupation"  id="f_occupation" value="<?=$spri_row->m_occupation;?>"></div>
             <div class="col-xl-6">	<input type="text" class="form-control" name = "m_annual_income"  id="f_income"  value="<?=$spri_row->m_annual_income;?>"></div>
         </div> <br>
         <div> <h6>Mother's Office Address</h6> </div>
  <div class="form-group row">
   <div class="col-xl-3" ><b>Plot No</b></div>
   <div class="col-xl-3"><b>Area</b></div>
    <div class="col-xl-3"><b>City</b></div>
    <div class="col-xl-3"><b>Pin Code</b></div>
</div>
<div class="form-group row"> <div class="col-xl-3"><input type="text" class="form-control" name = "m_o_plot_no"  id="plot_no"   value="<?=$spri_row->m_o_plot_no;?>"></div>
     <div class="col-xl-3"><input type="text" name="m_o_area" id="landmark" class="form-control"  value="<?=$spri_row->m_o_area;?>">
        </div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "m_o_city"  id="city"   value="<?=$spri_row->m_o_city;?>"></div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "m_o_pin_code"  id="pincode"   value="<?=$spri_row->m_o_pin_code;?>"></div>
</div><br>
<div class="form-group row">
   <div class="col-xl-3" ><b>District</b></div>
   <div class="col-xl-3"><b>State</b></div>
    <div class="col-xl-3"><b>Mobile No</b></div>
     <div class="col-xl-3"><b>Email</b></div>
   
</div>
<div class="form-group row"> <div class="col-xl-3"><input type="text" class="form-control" name = "m_o_district"  id="district"   value="<?=$spri_row->m_o_district;?>" ></div>
     <div class="col-xl-3"><?php
									
									 $query4 = $db->query("SELECT * FROM states_of_india ORDER BY state_id ASC"); 
									// $query   = $builder->get(); 
									
									?><select name="m_o_state" id="m_o_state" class="form-control" ><option option="">Select</option>
       	<?php foreach ($query4->getResult() as $row4) {
    

?>
            <option value="<?php echo $row4->state_id;?>" <?php if($row4->state_id ==$spri_row->m_o_state){ echo "selected"; } ?>><?php echo $row4->state;?></option>
            <?php } ?></select></div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "m_o_tel_no"  id="tel_no"  value="<?=$spri_row->m_o_tel_no;?>" > </div>
     <div class="col-xl-3"><input type="text" class="form-control" name = "m_o_email"  id="email"   value="<?=$spri_row->m_o_email;?>"> </div>
    
</div> <br>
   <?php
  $sql2 = $db->query("SELECT * FROM student_certificate_issued WHERE student_admission_id ='$student_id'");
	foreach ($sql2->getResult() as $sci_row) {}
  ?>     
    </div>
    <!--step 7-->
    <div id="tab7" class="tab">
        
        <div class="form-group row"> 
        <div class="col-xl-1">1.</div>
        <div class="col-xl-4">Bonafied Certificate</div>
        <div class="col-xl-1"><input type="checkbox" name="bonafied" value="1" <?php if($sci_row->bonafied =='1'){ echo "checked"; } ?>></div>
        <div class="col-xl-2"><input type="date" name="bonafied_date" class="form-control" value="<?=$sci_row->bonafied_date;?>"></div>
        </div><br>
         <div class="form-group row"> 
        <div class="col-xl-1">2.</div>
        <div class="col-xl-4">	Character Certificate</div>
        <div class="col-xl-1"><input type="checkbox" name="charecter" value="1" <?php if($sci_row->charecter =='1'){ echo "checked"; } ?>></div>
        <div class="col-xl-2"><input type="date" name="character_date" class="form-control" value="<?=$sci_row->character_date;?>"></div>
        </div>
    </div>
    
  <!--<div style="overflow:auto;">-->
  <!--  <div style="float:right;">-->
  <!--    <button type="button" id="prevBtn" onclick="prevStep()">Previous</button>-->
  <!--    <button type="button" id="nextBtn" onclick="nextStep()">Next</button>-->
  <!--  </div>-->
  <!--</div>-->

</div>
<hr style="border: 0; 
  height: 1px; 
  background-color: #009292;
  " />
<div class="form-group row">
<label class="col-lg-4 col-form-label form-label">&nbsp;</label>
<div class="col-lg-6">
<button type="submit" class="btn btn-success col-xl-3">Submit</button>
<button type="reset" class="btn btn-danger col-xl-3">Cancel</button>
</div>
</div>
</form>
</div>


<div class="hljs-wrapper">
<pre><code class="html" data-url="<?= base_url('assets/data/form-validation/code-1.json'); ?>"></code></pre>
</div>

</div>

</div>



</div>



</div>

</div>



<a href="javascript:;" class="btn btn-icon btn-circle btn-theme btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>

</div>
<script>
  var currentTab = 0;
  showTab(currentTab);

  function showTab(n) {
    var tabs = document.getElementsByClassName("tab");
    tabs[n].classList.add("active");
    if (n == 0) {
      document.getElementById("prevBtn").style.display = "none";
    } else {
      document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (tabs.length - 1)) {
      document.getElementById("nextBtn").innerHTML = "Submit";
    } else {
      document.getElementById("nextBtn").innerHTML = "Next";
    }
    // Show only the current tab
    for (var i = 0; i < tabs.length; i++) {
      if (i !== n) {
        tabs[i].classList.remove("active");
      }
    }
  }

  function nextStep() {
    var tabs = document.getElementsByClassName("tab");
    if (currentTab >= tabs.length - 1) {
      document.getElementById("wizardForm").submit();
      return false;
    }
    if (!validateForm()) return false;
    currentTab++;
    showTab(currentTab);
  }

  function prevStep() {
    if (currentTab <= 0) {
      return false;
    }
    currentTab--;
    showTab(currentTab);
  }

  function validateForm() {
    var tabs = document.getElementsByClassName("tab");
    var inputs = tabs[currentTab].getElementsByTagName("input");
    for (var i = 0; i < inputs.length; i++) {
      if (inputs[i].value == "") {
        alert("Please fill in all fields.");
        return false;
      }
    }
    return true;
  }

  function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tab");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].classList.remove("active");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.classList.add("active");
    currentTab = Array.prototype.indexOf.call(document.getElementsByClassName("tab"), document.getElementById(tabName));
  }
</script>


<script src="assets/js/vendor.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/js/app.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>


<script src="assets/plugins/datatables.net/js/jquery.dataTables.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/plugins/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/plugins/datatables.net-buttons/js/buttons.flash.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/plugins/datatables.net-buttons/js/buttons.html5.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/plugins/datatables.net-buttons/js/buttons.print.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/plugins/pdfmake/build/pdfmake.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/plugins/pdfmake/build/vfs_fonts.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/plugins/jszip/dist/jszip.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/js/demo/table-manage-buttons.demo.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/plugins/@highlightjs/cdn-assets/highlight.min.js" type="6d06734b60a66024f3330210-text/javascript"></script>
<script src="assets/js/demo/render.highlight.js" type="6d06734b60a66024f3330210-text/javascript"></script>



<script src="cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="6d06734b60a66024f3330210-|49" defer>
    
</script>

<script src="assets/plugins/moment/min/moment.min.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script src="assets/plugins/select2/dist/js/select2.min.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script src="assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script src="assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script src="assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script src="assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script src="assets/plugins/jquery-migrate/dist/jquery-migrate.min.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script src="assets/plugins/tag-it/js/tag-it.min.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script src="assets/plugins/clipboard/dist/clipboard.min.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script src="assets/plugins/spectrum-colorpicker2/dist/spectrum.min.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script src="assets/plugins/select-picker/dist/picker.min.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script src="assets/js/demo/form-plugins.demo.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script src="assets/plugins/@highlightjs/cdn-assets/highlight.min.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>
<script src="assets/js/demo/render.highlight.js" type="ddb3067b0679c4f3ba9d3b8f-text/javascript"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $('#dropdownYear').each(function() {

  var year = (new Date()).getFullYear();
  var current = year;
  year -= 4;
  for (var i = 0; i < 10; i++) {
    if ((year+i) == current)
      $(this).append('<option value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) + ' - ' +  (year+1 + i) +'</option>');
    else
      $(this).append('<option value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) +  ' - ' +  (year+1 + i) +'</option>');
  }

})
</script>
<script>
    $('#dropdownYear1').each(function() {

  var year = (new Date()).getFullYear();
  var current = year;
  year -= 10;
  for (var i = 0; i < 16; i++) {
    if ((year+i) == current)
      $(this).append('<option value="' + (year + i) + '">' + (year + i) + '</option>');
    else
      $(this).append('<option value="' + (year + i) + '">' + (year + i) +  ' </option>');
  }

})
</script>
<script>
    $('.dropdownYear2').each(function() {

  var year = (new Date()).getFullYear();
  var current = year;
  year -= 10;
  for (var i = 0; i < 16; i++) {
    if ((year+i) == current)
      $(this).append('<option value="' + (year + i) + '">' + (year + i) + '</option>');
    else
      $(this).append('<option value="' + (year + i) + '">' + (year + i) +  ' </option>');
  }

})
</script>
<script>
    function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
function select_student_detail(id){
//reg_no
getObject('enquiry_no').value = id.value;
}
</script>

<script>
function myFunction() {
  var copy_address = document.getElementById("copy_address");
  var c_plot_no = document.getElementById("c_plot_no").value;
  var c_area = document.getElementById("c_area").value;
  var c_city = document.getElementById("c_city").value;
  var c_pincode = document.getElementById("c_pincode").value;
  var c_district = document.getElementById("c_district").value;
  if (copy_address.checked == true){
    document.getElementById("p_plot_no").value = c_plot_no;
    document.getElementById("p_area").value = c_area;
    document.getElementById("p_city").value = c_city;
    document.getElementById("p_pincode").value = c_pincode;
    document.getElementById("p_district").value = c_district;
    // alert(c_plot_no)
  } else {
     document.getElementById("p_plot_no").value = '';
    document.getElementById("p_area").value = '';
    document.getElementById("p_city").value = '';
    document.getElementById("p_pincode").value = '';
    document.getElementById("p_district").value = '';
  }
}
</script>
<?= $this->endSection() ?>



