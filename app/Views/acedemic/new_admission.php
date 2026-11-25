<?= $this->extend('layout/tempmain') ?>

<?= $this->section('links') ?>
<?= $this->endSection('links') ?>

<?= $this->section('content') ?>

<?php


// function enq_no()
// {
    	$db      = \Config\Database::connect();
								
	$enq = $db->query("SELECT student_admission_id FROM student_admission_information ORDER BY reg_no ASC")->getRow();
echo $reg_no = "DBN".(1000+(($enq->student_admission_id ?? 0)+1));
// 	$no1 =	 $no+1;
// $abcd1=sprintf('%04d',$no1);
$id = $_GET['id'] ?? '';
$c2 = $p = $s1 = $se1 = '';
if ($id !== '') {
	$pros1 = $db->query("SELECT * FROM prospect_sales WHERE prospect_no = ?", [$id])->getRow();
	if ($pros1) {
		$c2 = $pros1->category;
		$p = $pros1->class;
		$s1 = $pros1->semister;
		$se1 = $pros1->section;
	}
}
?>
<script src="<?= base_url('assets/js/eng_to_marathi.js')?>"></script>
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
     <?php if (isset($_SESSION['success'])) : ?>
                            <div class="alert alert-success my-5">
                                <h5><?=$_SESSION['success'];?></h5>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['error'])) : ?>
                            <div class="alert alert-danger my-5">
                                <h5><?=$_SESSION['error'];?></h5>
                            </div>
                        <?php endif; ?>
<form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post" action="<?= base_url('std_data'); ?>" enctype="multipart/form-data">
    <div> <h4>Joining Details</h4></div>
<div class="form-group row">
   <div class="col-xl-3" ><b>Date</b></div>
      <div class="col-xl-3"><b>Session</b></div>
   <div class="col-xl-3"><b>Reg No</b></div>
   <div class="col-xl-3"><b>Roll No</b></div>
</div>
<div class="form-group row">
    <div class="col-xl-3"><input type="date" name="date_of_admission" class="form-control" id="date" value="<?php echo date('Y-m-d'); ?>" readonly="readonly" ></div>
      <div class="col-xl-3"><select name="session" onchange="javascript:form_submit();" class=" form-control"  id="dropdownYear" >
           <option value="<?= $_SESSION['session_year']; ?>" selected><?= $_SESSION['session_year']; ?></option>
         </select></div>
   
    <div class="col-xl-3"><input type="text" class="form-control" name = "reg_no"  id="reg_no" value="<?php echo $reg_no ?>" readonly="readonly" ></div>
        <div class="col-xl-3"><input type="text" class="form-control" name = "c_roll_no"  id="c_roll_no" value="<?php echo $c_roll_no ?>"></div>
     </div> 
  <br>
  <div class="form-group row">
   <div class="col-xl-3" ><b>Prospectus No</b></div>
      <div class="col-xl-3"><b>Enrollment No</b></div>
      <div class="col-xl-3"><b>Section</b></div>
   <div class="col-xl-3"><b>Category</b></div>
</div> 
<div class="form-group row">
   <div class="col-xl-3"><input type="text" class="form-control" name = "prospectus_no"  id="prospectus_no"  value="<?= $pros1->prospect_no;?>"></div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "enrollment_no"  id="enroll_no" value="<?php echo rand(0000,9999); ?>" readonly="readonly"></div>
      <div class="col-xl-3"><select name="section" id="section" class="form-control" >
          
      <option value="1"<?php if ($se1 == '1') { ?> selected <?php } ?>>Section A</option>
    <option value="2"<?php if ($se1 == '2') { ?> selected <?php } ?>>Section B</option>
      </select></div>
     <div class="col-xl-3"><select name="category" id="category" class="form-control" >
       
            <option value="<?php echo $c2 ?>"selected><?php echo $c2;?></option>
           
    </select></div>
</div> <br>
<div> <h4>Student Information</h4></div>
  <div class="form-group row">
   <div class="col-xl-3" ><b>Student Name</b></div>
   <div class="col-xl-3"><b>First Name</b></div>
    <div class="col-xl-3"><b>Middle Name</b></div>
    <div class="col-xl-3"><b>Last Name</b></div>
</div>
<div class="form-group row">
     <div class="col-xl-3"><select name="salutation" id="stu_name" class="form-control" >
        <option value="Mr">Mr.</option>
    <option value="Miss">Miss.</option>
      <option value="Mrs">Mrs.</option>
    </select></div>
   <div class="col-xl-3"><input type="text" class="form-control" name = "first_name"  id="f_name" value="<?= $pros1->student_first_name;?>" ></div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "middle_name"  id="l_name"  value="<?= $pros1->student_middle_name;?>"></div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "last_name"  id="l_name"  value="<?= $pros1->student_last_name;?>"></div>
</div> <br>
  <div class="form-group row">
   <div class="col-xl-3" ><b>Student Name In Marathi: </b></div>
     <div class="col-xl-3"><script language="javascript">CreateCustomHindiTextBox("mar_name",<?= json_encode($_POST['mar_name'] ?? '') ?>,40,true);</script></div>
     
      <div class="col-xl-1" ><b>Gender: </b></div>
     <div class="col-xl-3"><select class="form-control" name="gender1"  >
    <option value="male" <?php if($pros1->gender1 =='male'){ echo'selected'; }?>>Male</option>
    <option value="female" <?php if($pros1->gender1 =='female'){ echo'selected'; }?> >Female</option>
</select></div>
   
</div>

  <br>
  <div class="form-group row">
   <div class="col-xl-3" ><b>Program</b></div>
   <div class="col-xl-3"><b>Semester</b></div>
    <!--<div class="col-xl-3"><b>Section</b></div>-->
    <div class="col-xl-3"><b>Date Of Birth</b></div>
</div>
<div class="form-group row">
  <div class="col-xl-3"><?php
								// 	$db      = \Config\Database::connect();
									 $query3 = $db->query("SELECT * FROM class ORDER BY class_id "); 
									// $query   = $builder->get(); 
								
									?>
                                    
								
        <select name="program"  class="form-control" id="class">
            
            <option value="">-----SELECT-----</option>
            	<?php foreach ($query3->getResult() as $row3) {
    	$p2=$row3->class_id;

?>
            <option value="<?php echo $row3->class_id;?>"<?php if ($p == $p2) { ?> selected <?php } ?>><?php echo $row3->class;?></option>
            <?php } ?></select></div>
     <div class="col-xl-3"><?php
								// 	$db      = \Config\Database::connect();
									 $query2 = $db->query("SELECT * FROM program_sem ORDER BY program_sem_id "); 
									// $query   = $builder->get(); 
									
									?>
                                    
								
        <select name="semister"  class="form-control" id="semister">
            
            <option value="">-----SELECT-----</option>
            	<?php foreach ($query2->getResult() as $row2) {
    
$s=$row2->program_sem;
?>
            <option value="<?php echo $row2->program_sem;?>"<?php if ($s == $s1) { ?> selected <?php } ?>><?php echo $row2->program_sem;?></option>
            <?php } ?></select></div>
     <!--<div class="col-xl-3"><select name="section"  class=" form-control" >-->
     <!--    <option value=""></option>-->
         
     <!--    </select></div>-->
    <div class="col-xl-3"><input type="date" class="form-control" name ="date_of_birth"  id="dob"></div>
    </div>
  <br>
  <div class="form-group row">
   <div class="col-xl-4"><b>Photo</b><span style="color:red">*</span></div>
    <div class="col-xl-4"><b>Status</b></div>
    <div class="col-xl-4"><b>Active</b></div>
</div>
<div class="form-group row">
  <div class="col-xl-4"><input type="file" class="form-control" name ="photo"  id="photo" required></div>
     <div class="col-xl-4"><select name="status" class="form-control"><option value=""  selected="">-----SELECT-----</option><option value="New" selected>New</option><option value="Suspended">Suspended</option><option value="Left">Left</option></select></div>
    <div class="col-xl-4"><select name="active_status" class="form-control"><option value=""  >Yes / No</option><option value="0" selected>Yes</option><option value="1">No</option></select></div>
    </div>
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
  
  <!-- Step 1 -->
  <div id="tab1" class="tab active">
      
   <div class="form-group row">
     <div class="col-xl-3"> <b>Father's/Guardian Name</b></div>
   <div class="col-xl-3"><input type="text" class="form-control" name = "fa_first_name"  id="f_name"  placeholder="First Name.."></div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "fa_middle_name"  id="m_name"  placeholder="Middle Name.."></div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "fa_last_name"  id="l_name"  placeholder="Last Name.."></div>
</div> <br>
 <div class="form-group row">
     <div class="col-xl-3"> <b>Mother's Name</b></div>
   <div class="col-xl-3"><input type="text" class="form-control" name = "mo_first_name"  id="f_name"  placeholder="First Name.."></div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "mo_middle_name"  id="m_name"  placeholder="Middle Name.."></div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "mo_last_name"  id="l_name"  placeholder="Last Name.."></div>
</div> <br>
<div> <h4>Address For Correspondence:</h4></div>
  <div class="form-group row">
   <div class="col-xl-3" ><b>Plot No</b></div>
   <div class="col-xl-3"><b>Area</b></div>
    <div class="col-xl-3"><b>City</b></div>
    <div class="col-xl-3"><b>Pin Code</b></div>
</div>
<div class="form-group row"> <div class="col-xl-3"><input type="text" class="form-control" name = "c_plot_no"  id="c_plot_no"  ></div>
     <div class="col-xl-3"><input type="text" name="c_area" id="c_landmark" class="form-control" >
        </div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "c_city"  id="c_city"  ></div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "c_pin_code"  id="c_pincode"  ></div>
</div><br>
<div class="form-group row">
   <div class="col-xl-4" ><b>District</b></div>
   <div class="col-xl-4"><b>State</b></div>
    <div class="col-xl-4"><b>Tel No</b></div>
   
</div>
<div class="form-group row"> <div class="col-xl-4"><input type="text" class="form-control" name = "c_district"  id="c_district"  ></div>
     <div class="col-xl-4"><?php
								
									 $query4 = $db->query("SELECT * FROM states_of_india ORDER BY state_id ASC"); 
									// $query   = $builder->get(); 
									
									?><select name="c_state" id="c_state" class="form-control" >
									    <option option="">Select</option>
       	<?php foreach ($query4->getResult() as $row4) {
    

?>
            <option value="<?php echo $row4->state_id;?>"><?php echo $row4->state;?></option>
            <?php } ?></select></div>
    <div class="col-xl-4"><input type="text" class="form-control" name = "c_tel_no"  id="c_tel_no" > </div>
    
</div>
<div> <h4>Permanent Address:</h4> <input type="checkbox" name="copy_address" onclick="copyAddress()" id="same_as_current">Same As Above</div>
  <div class="form-group row">
   <div class="col-xl-3" ><b>Plot No</b></div>
   <div class="col-xl-3"><b>Area</b></div>
    <div class="col-xl-3"><b>City</b></div>
    <div class="col-xl-3"><b>Pin Code</b></div>
</div>
<div class="form-group row"> <div class="col-xl-3"><input type="text" class="form-control" name = "p_plot_no"  id="p_plot_no"  ></div>
     <div class="col-xl-3"><input type="text" name="p_landmark" id="p_landmark" class="form-control" >
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
     <div class="col-xl-3"><input type="text" class="form-control" name = "p_email"  id="email" > </div>
    
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
     <div class="col-xl-3"><input type="text" class="form-control" name = "place_of_birth"  id="pob"  ></div>
     <div class="col-xl-3"><?php
								
									 $query4 = $db->query("SELECT * FROM states_of_india ORDER BY state_id ASC"); 
									// $query   = $builder->get(); 
									
									?><select name="place_state" id="place_state" class="form-control" ><option option="">Select</option>
       	<?php foreach ($query4->getResult() as $row4) {
    

?>
            <option value="<?php echo $row4->state_id;?>"><?php echo $row4->state;?></option>
            <?php } ?></select></div>
   <div class="col-xl-3"><?php
								
									 $query4 = $db->query("SELECT * FROM states_of_india ORDER BY state_id ASC"); 
									// $query   = $builder->get(); 
									
									?><select name="domicile_of_state" id="domicile_of_state" class="form-control" ><option option="">Select</option>
       	<?php foreach ($query4->getResult() as $row4) {
    

?>
            <option value="<?php echo $row4->state_id;?>"><?php echo $row4->state;?></option>
            <?php } ?></select></div>
     <div class="col-xl-3"><input type="text" class="form-control" name = "place_district"  id="district" > </div>
    </div><br>
    <div class="form-group row">
   <div class="col-xl-3" ><b>Gender</b></div>
   <div class="col-xl-3"><b>Town</b></div>
    <div class="col-xl-3"><b>Religion</b></div>
     <div class="col-xl-3"><b>Nationality</b></div>
</div>
   <div class="form-group row">
        <div class="col-xl-3"><input type="radio"  name = "sex"  id="gender" value="Male"> Male <input type="radio"  name = "sex"  id="gender" value="Female"> Female <input type="radio"  name = "sex"  id="gender" value="other"> Other</div>
         <div class="col-xl-3"><input type="text" class="form-control" name = "domicile_town"  id="district" > </div>
          <div class="col-xl-3"><input type="text" class="form-control" name = "religion"  id="district" > </div>
           <div class="col-xl-3"><input type="text" class="form-control" name = "nationality"  id="district" > </div>
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
            <option value="<?php echo $row3->category;?>"><?php echo $row3->category;?></option>
            <?php } ?>
    </select></div>
         <div class="col-xl-4"><input type="text" class="form-control" name = "domicile_district"  id="district" > </div>
          
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
     <div class="col-xl-3"><input type="text" class="form-control" name = "exam_passed"  id="exam"  ></div>
     <div class="col-xl-3"><select name="year_last_exam" id="dropdownYear1" class="form-control" >
       
    </select></div>
   <div class="col-xl-3"><input type="text" class="form-control" name = "roll_no"  id="roll_no"  ></div>
     <div class="col-xl-1">
    <input type="text" class="form-control" name = "masrks"  id="roll_no"  >
         </div>
    <div class="col-xl-1">
    <span>Out Of</span>
         </div>
         <div class="col-xl-1">
    <input type="text" class="form-control" name = "out_of"  id="roll_no"  >
         </div><br>
         <div class="form-group row">
   <div class="col-xl-3" ><b>Result</b></div>
   <div class="col-xl-3"><b>Divison</b></div>
    <div class="col-xl-3"><b>Enroll No</b></div>
     <div class="col-xl-3"><b>University / Board</b></div>
   
</div>
<div class="form-group row"> <div class="col-xl-3"><input type="text" class="form-control" name = "result"  id="result"  ></div>
     <div class="col-xl-3"><input type="text" class="form-control" name = "divison"  id="divison" ></div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "enrol_no_last_exam"  id="enrolll_no" > </div>
     <div class="col-xl-3"><input type="text" class="form-control" name = "university_last_exam"  id="uni_board" > </div>
    
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
            <option value="<?php echo $row8->s_id;?>"><?php echo $row8->school_name;?></option>
            <?php } ?>
    </select></div>
     <div class="col-xl-3"><input type="text" class="form-control" name = "mscit"  id="mscit" > </div>
        <div class="col-xl-4"><select name="sports" id="sports" class="form-control" >
        <option value="">---Select Achievements---</option>
    <option value="national">National</option>
      <option value="state">State</option>
      <option value="district">District</option>
        <option value="local">Local</option>
    </select></div>
          
       </div>
  </div>
</div>
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
                     <td> <input type="text" class="form-control" name="ssc_board" id=""></td>
                     <td><input type="text" class="form-control" name="ssc_school" id=""> </td>
                     <td> <select class="form-control dropdownYear2" name="ssc_year" id="dropdownYear2">
                         <option></option>
                     </select></td>
                     <td> <input type="text" class="form-control" name="ssc_total_marks" id=""></td>
                     <td> <input type="text" class="form-control" name="ssc_marks_obtained" id=""></td>
                     <td><input type="text" class="form-control " name="ssc_percentage" id=""> </td>
                 </tr>
                 <tr>
                     <td> 	H.S.S.C.</td>
                     <td> <input type="text" class="form-control" name="hssc_board" id=""></td>
                     <td><input type="text" class="form-control" name="hssc_school" id=""> </td>
                     <td> <select class="form-control dropdownYear2" name="hssc_year" id="">
                         <option></option>
                     </select></td>
                     <td> <input type="text" class="form-control" name="hssc_total_marks" id=""></td>
                     <td> <input type="text" class="form-control" name="hssc_marks_obtained" id=""></td>
                     <td><input type="text" class="form-control" name="hssc_percentage" id=""> </td>
                 </tr>
                 <tr>
                     <td> 	Graduation</td>
                     <td> <input type="text" class="form-control" name="grad_uni" id=""></td>
                     <td><input type="text" class="form-control" name="grad_college" id=""> </td>
                     <td> <select class="form-control dropdownYear2" name="grad_year" id="">
                         <option></option>
                     </select></td>
                     <td> <input type="text" class="form-control" name="grad_total_marks" id=""></td>
                     <td> <input type="text" class="form-control" name="grad_marks_obtained" id=""></td>
                     <td><input type="text" class="form-control" name="grad_percentage" id=""> </td>
                 </tr>
                 <tr>
                     <td>Post Graduation</td>
                     <td> <input type="text" class="form-control" name="pg_uni" id=""></td>
                     <td><input type="text" class="form-control" name="pg_college" id=""> </td>
                     <td> <select class="form-control dropdownYear2" name="pg_year" id="">
                         <option></option>
                     </select></td>
                     <td> <input type="text" class="form-control" name="pg_total_marks" id=""></td>
                     <td> <input type="text" class="form-control" name="pg_marks_obtained" id=""></td>
                     <td><input type="text" class="form-control" name="pg_percentage" id=""> </td>
                 </tr>
                 <tr>
                     <td> 	Other</td>
                     <td> <input type="text" class="form-control" name="other_board" id=""></td>
                     <td><input type="text" class="form-control" name="other_school" id=""> </td>
                     <td> <select class="form-control dropdownYear2" name="other_year" id="">
                         <option></option>
                     </select></td>
                     <td> <input type="text" class="form-control" name="other_total_marks" id=""></td>
                     <td> <input type="text" class="form-control" name="other_marks_obtained" id=""></td>
                     <td><input type="text" class="form-control" name="other_percentage" id=""> </td>
                 </tr>
             </tbody>
         </table>
     </div>
    </div>
    <!--step 5-->
    <div id="tab5" class="tab">
        
         <div class="form-group row">
             <div class="col-xl-1">1.</div>
             <div class="col-xl-6">	Guardian Income Certifucate(for other than open category students)</div>
             <div class="col-xl-2"><input type="checkbox" name="guardian_income_certifucate" value="1"></div>
         </div>
         <div class="form-group row">
             <div class="col-xl-1">2.</div>
             <div class="col-xl-6">	Passing Certificate of Std. 10th / Statement of Marks of Std. 10th</div>
             <div class="col-xl-2"><input type="checkbox" name="statement_of_marks_ssc" value="1"></div>
         </div>
         <div class="form-group row">
             <div class="col-xl-1">3.</div>
             <div class="col-xl-6">	Passing Certificate of Std. 12th / Statement of Marks of Std. 12th</div>
             <div class="col-xl-2"><input type="checkbox" name="statement_of_marks" value="1"></div>
         </div>
         <div class="form-group row">
             <div class="col-xl-1">4.</div>
             <div class="col-xl-6">School/College Leaving Certificate</div>
             <div class="col-xl-2"><input type="checkbox" name="leaving_certificate" value="1"></div>
         </div>
         <div class="form-group row">
             <div class="col-xl-1">5.</div>
             <div class="col-xl-6">	Certificate of Caste with Category</div>
             <div class="col-xl-2"><input type="checkbox" name="validity_certificate" value="1"></div>
         </div>
         <div class="form-group row">
             <div class="col-xl-1">6.</div>
             <div class="col-xl-6">	Non Creamy Layer Certificate</div>
             <div class="col-xl-2"><input type="checkbox" name="non_creamylayer" value="1"></div>
         </div>
         <div class="form-group row">
             <div class="col-xl-1">7.</div>
             <div class="col-xl-6">	Eligibility Certificate(for other than Nagpur University students)</div>
             <div class="col-xl-2"><input type="checkbox" name="eligibility_certificate" value="1"></div>
         </div>
         <div class="form-group row">
             <div class="col-xl-1">8.</div>
             <div class="col-xl-6">	Certifucate for Physically Challenged</div>
             <div class="col-xl-2"><input type="checkbox" name="physical_certifucate" value="1"></div>
         </div>
         <div class="form-group row">
             <div class="col-xl-1">9.</div>
             <div class="col-xl-6">	Other Certificates:Freedom Fighter,Physical disability,Military Personal,Sports.etc</div>
             <div class="col-xl-2"><input type="checkbox" name="other_certificates" value="1"></div>
         </div>
         <div class="form-group row">
             <div class="col-xl-1">10.</div>
             <div class="col-xl-6">	Affidavit for changed Name/Marriage Certificate/ Govt. Gazette</div>
             <div class="col-xl-2"><input type="checkbox" name="change_name" value="1"></div>
         </div>
         <div class="form-group row">
             <div class="col-xl-1">11.</div>
             <div class="col-xl-6">	Domicile Certificate</div>
             <div class="col-xl-2"><input type="checkbox" name="domicile_certificate" value="1"></div>
         </div>
         <div class="form-group row">
             <div class="col-xl-1">12.</div>
             <div class="col-xl-6">	Migration certificate(If from other state or university)</div>
             <div class="col-xl-2"><input type="checkbox" name="migration_certificate" value="1"></div>
         </div>
    </div>
    <!--step 6-->
    <div id="tab6" class="tab">
        <div class="form-group row">
             <div class="col-xl-3"><b>Father name:</b></div>
             <div class="col-xl-3">	<input type="text" class="form-control" name = "f_first_name"  id="f_name" placeholder="First Name"></div>
             <div class="col-xl-3">	<input type="text" class="form-control" name = "f_middle_name"  id="m_name" placeholder="Middle Name"></div>
             <div class="col-xl-3">	<input type="text" class="form-control" name = "f_last_name"  id="l_name" placeholder="Last Name"></div>
         </div>
           <div class="form-group row">
             <div class="col-xl-6"><b>Father's Occupation</b></div>
             <div class="col-xl-6">	<b>	Father's Income (Annual)</b></div>
         </div>
           <div class="form-group row">
             <div class="col-xl-6">	<input type="text" class="form-control" name = "f_occupation"  id="f_occupation"></div>
             <div class="col-xl-6">	<input type="text" class="form-control" name = "f_annual_income"  id="f_income" ></div>
         </div> <br>
         <div> <h6>Father's Office Address</h6> </div>
  <div class="form-group row">
   <div class="col-xl-3" ><b>Plot No</b></div>
   <div class="col-xl-3"><b>Area</b></div>
    <div class="col-xl-3"><b>City</b></div>
    <div class="col-xl-3"><b>Pin Code</b></div>
</div>
<div class="form-group row"> <div class="col-xl-3"><input type="text" class="form-control" name = "f_o_plot_no"  id="plot_no"  ></div>
     <div class="col-xl-3"><input type="text" name="f_o_area" id="f_o_area" class="form-control" >
        </div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "f_o_city"  id="city"  ></div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "f_o_pin_code"  id="pincode"  ></div>
</div><br>
<div class="form-group row">
   <div class="col-xl-3" ><b>District</b></div>
   <div class="col-xl-3"><b>State</b></div>
    <div class="col-xl-3"><b>Mobile No</b></div>
     <div class="col-xl-3"><b>Email</b></div>
   
</div>
<div class="form-group row"> <div class="col-xl-3"><input type="text" class="form-control" name = "f_district"  id="district"  ></div>
     <div class="col-xl-3"><?php
								
									 $query4 = $db->query("SELECT * FROM states_of_india ORDER BY state_id ASC"); 
									// $query   = $builder->get(); 
									
									?><select name="f_o_state" id="f_o_state" class="form-control" ><option option="">Select</option>
       	<?php foreach ($query4->getResult() as $row4) {
    

?>
            <option value="<?php echo $row4->state_id;?>"><?php echo $row4->state;?></option>
            <?php } ?></select></div>
    <div class="col-xl-3"><input type="text" class="form-control" name="f_o_tel_no"  id="tel_no" > </div>
     <div class="col-xl-3"><input type="text" class="form-control" name="f_o_email"  id="email" > </div>
    
</div> <br>
 <div class="form-group row">
             <div class="col-xl-3"><b>Mother name:</b></div>
             <div class="col-xl-3">	<input type="text" class="form-control" name="m_first_name"  id="f_name" placeholder="First Name"></div>
             <div class="col-xl-3">	<input type="text" class="form-control" name="m_middle_name"  id="m_middle_name" placeholder="Middle Name"></div>
             <div class="col-xl-3">	<input type="text" class="form-control" name="m_last_name"  id="m_last_name" placeholder="Last Name"></div>
         </div>
           <div class="form-group row">
             <div class="col-xl-6"><b>Mother's Occupation</b></div>
             <div class="col-xl-6">	<b>	Mother's Income (Annual)</b></div>
         </div>
           <div class="form-group row">
             <div class="col-xl-6">	<input type="text" class="form-control" name="m_occupation"  id="f_occupation"></div>
             <div class="col-xl-6">	<input type="text" class="form-control" name="m_annual_income"  id="f_income" ></div>
         </div> <br>
         <div> <h6>Mother's Office Address</h6> </div>
  <div class="form-group row">
   <div class="col-xl-3" ><b>Plot No</b></div>
   <div class="col-xl-3"><b>Area</b></div>
    <div class="col-xl-3"><b>City</b></div>
    <div class="col-xl-3"><b>Pin Code</b></div>
</div>
<div class="form-group row"> <div class="col-xl-3"><input type="text" class="form-control" name = "m_o_plot_no"  id="plot_no"  ></div>
     <div class="col-xl-3"><input type="text" name="m_o_area" id="landmark" class="form-control" >
        </div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "m_o_city"  id="city"  ></div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "m_o_pin_code"  id="pincode"  ></div>
</div><br>
<div class="form-group row">
   <div class="col-xl-3" ><b>District</b></div>
   <div class="col-xl-3"><b>State</b></div>
    <div class="col-xl-3"><b>Mobile No</b></div>
     <div class="col-xl-3"><b>Email</b></div>
   
</div>
<div class="form-group row"> <div class="col-xl-3"><input type="text" class="form-control" name = "m_o_district"  id="district"  ></div>
     <div class="col-xl-3"><?php
									
									 $query4 = $db->query("SELECT * FROM states_of_india ORDER BY state_id ASC"); 
									// $query   = $builder->get(); 
									
									?><select name="m_o_state" id="m_o_state" class="form-control" ><option option="">Select</option>
       	<?php foreach ($query4->getResult() as $row4) {
    

?>
            <option value="<?php echo $row4->state_id;?>"><?php echo $row4->state;?></option>
            <?php } ?></select></div>
    <div class="col-xl-3"><input type="text" class="form-control" name = "m_o_tel_no"  id="tel_no" > </div>
     <div class="col-xl-3"><input type="text" class="form-control" name = "m_o_email"  id="email" > </div>
    
</div> <br>
        
    </div>
    <!--step 7-->
    <div id="tab7" class="tab">
        
        <div class="form-group row"> 
        <div class="col-xl-1">1.</div>
        <div class="col-xl-4">Bonafied Certificate</div>
        <div class="col-xl-1"><input type="checkbox" name="bonafied" value="1"></div>
        <div class="col-xl-2"><input type="date" name="bonafied_date" class="form-control"></div>
        </div><br>
         <div class="form-group row"> 
        <div class="col-xl-1">2.</div>
        <div class="col-xl-4">	Character Certificate</div>
        <div class="col-xl-1"><input type="checkbox" name="charecter" value="1"></div>
        <div class="col-xl-2"><input type="date" name="character_date" class="form-control"></div>
        </div>
    </div>
    
  <!--<div style="overflow:auto;">-->
  <!--  <div style="float:right;">-->
  <!--    <button type="button" id="prevBtn" onclick="prevStep()">Previous</button>-->
  <!--    <button type="button" id="nextBtn" onclick="nextStep()">Next</button>-->
  <!--  </div>-->
  <!--</div>-->

</div>

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
      $(this).append('<option  value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) + ' - ' +  (year+1 + i) +'</option>');
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
      $(this).append('<option selected value="' + (year + i) + '">' + (year + i) + '</option>');
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
      $(this).append('<option selected value="' + (year + i) + '">' + (year + i) + '</option>');
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
    
 function copyAddress() {
  const sameAsCurrentCheckbox = document.getElementById('same_as_current');
  const addressInput = document.getElementById('c_plot_no');
  const permanentAddressInput = document.getElementById('p_plot_no');
  const addressInput1 = document.getElementById('c_landmark');
  const permanentAddressInput1 = document.getElementById('p_landmark');
  const addressInput2 = document.getElementById('c_city');
  const permanentAddressInput2 = document.getElementById('p_city');
  const addressInput3 = document.getElementById('c_pincode');
  const permanentAddressInput3 = document.getElementById('p_pincode');
  const addressInput4 = document.getElementById('c_district');
  const permanentAddressInput4 = document.getElementById('p_district');
  const addressInput5 = document.getElementById('c_state');
  const permanentAddressInput5 = document.getElementById('p_state');
  const addressInput6 = document.getElementById('c_tel_no');
  const permanentAddressInput6 = document.getElementById('p_tel_no');

  if (sameAsCurrentCheckbox.checked) {

    permanentAddressInput.value = addressInput.value;
    permanentAddressInput1.value = addressInput1.value;
    permanentAddressInput2.value = addressInput2.value;
    permanentAddressInput3.value = addressInput3.value;
    permanentAddressInput4.value = addressInput4.value;
    permanentAddressInput5.value = addressInput5.value;
    permanentAddressInput6.value = addressInput6.value;
    
  } else {
    
    permanentAddressInput.value = '';
    permanentAddressInput1.value = '';
    permanentAddressInput2.value = '';
    permanentAddressInput3.value = '';
    permanentAddressInput4.value = '';
    permanentAddressInput5.value = '';
    permanentAddressInput6.value = '';


  }
}
</script>

<?= $this->endSection() ?>



