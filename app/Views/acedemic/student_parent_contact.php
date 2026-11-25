<?= $this->extend('layout/tempmain') ?>

<?= $this->section('links') ?>
<?= $this->endSection('links') ?>

<?= $this->section('content') ?>
<link href="assets/css/vendor.min.css" rel="stylesheet" />
<link href="assets/css/default/app.min.css" rel="stylesheet" />


<link href="assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link href="assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
<link href="assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" />


<div class="menu-item d-flex">
<a href="javascript:;" class="app-sidebar-minify-btn ms-auto d-flex align-items-center text-decoration-none" data-toggle="app-sidebar-minify"><i class="fa fa-angle-double-left"></i></a>
</div>

</div>

</div>

</div>
<div class="app-sidebar-bg" data-bs-theme="dark"></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>


<div id="content" class="app-content">

<?php
 $db  = \Config\Database::connect();
 $class_query = $db->query("SELECT * FROM class ORDER BY class_id ASC");
 $prpgram_sem_query = $db->query("SELECT * FROM program_sem ORDER BY program_sem_id ASC");
 $student_category_query = $db->query("SELECT * FROM student_category ORDER BY category_id ASC");
$fee_search_key=array();

if(!empty($_POST['class_program'])){
$fee_search_key[]="class = '".($_POST['class_program'] ?? '')."'";
}


if(!empty($_POST['semister'])){
$fee_search_key[]="semister = '".($_POST['semister'] ?? '')."'";
}

if(!empty($_POST['session'])){
$fee_search_key[]="session_year = '".($_POST['session'] ?? '')."'";
}

if(!empty($_POST['category'])){
$fee_search_key[]="category = '".($_POST['category'] ?? '')."'";
}


if(!empty($fee_search_key)){
 $key= ' WHERE ('.implode(' AND ',$fee_search_key).') ';
 $_SESSION['search'] = $key;
}


if (!isset($key)) {
    $key = '';
}
 $stud_query = false;
if(isset($_POST['search'])){
 $stud_query = $db->query("SELECT * FROM `student_admission_information` $key");
}


	if(isset($_POST['update']))
	{
	   
		
		for($i=1;$i<=($_POST['count'] ?? '');$i++)
		{
		     $student_admission_id  =  $_POST["student_admission_id_".$i];
		     $contact_no = $_POST["contact_no_".$i];
		     if($contact_no !=''){
                $update_status = $db->query("UPDATE `student_admission_information` SET `parent_mobile_number`='$contact_no' WHERE student_admission_id = '$student_admission_id'");
		     }
		}
		if($update_status){
		    echo '<script language="javascript">alert("Updated Successfully");</script>';
		    echo "<meta http-equiv='refresh' content='0'>";
		}
	}

?>


<div class="row">

<div class="col-xl-12">

<div class="panel panel-inverse" data-sortable-id="form-validation-1">

<div class="panel-heading">
<h3 class="panel-title">Section Allocation</h3>
</div>


<div class="panel-body">
<form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post">
<div class="form-group row">
    <div class="col-md-3">
        <label><b>Class</b></label>
        <select class="form-control chosen-select" name="class_program">
            <option value="">--Class--</option>
            <?php
            foreach ($class_query->getResult() as $class_row) {
                ?>
                <option value="<?=$class_row->class;?>"><?=$class_row->class;?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <div class="col-md-3">
        <label><b>Semester</b></label>
        <select class="form-control chosen-select" name="semister">
            <option value="">--Semester--</option>
            <?php
            foreach ($prpgram_sem_query->getResult() as $program_sem_row) {
                ?>
                <option value="<?=$program_sem_row->program_sem;?>"><?=$program_sem_row->program_sem;?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <div class="col-md-3">
        <label><b>Session</b></label>
        <select class="form-control chosen-select" name="session" id="dropdownYear">
    <option value="<?=$_SESSION['session_year']?>" selected><?=$_SESSION['session_year']?></option>
    <option value="">Select session</option>
</select>
    </div>
    <div class="col-md-3">
        <label><b>Category</b></label>
        <select class="form-control chosen-select" name="category">
            <option value="">--Category--</option>
            <?php
            foreach ($student_category_query->getResult() as $student_category_row) {
                ?>
                <option value="<?=$student_category_row->category;?>"><?=$student_category_row->category;?></option>
                <?php
            }
            ?>
        </select>
    </div>   
    </div>
  <br>
<div class="form-group row">
<label class="col-lg-4 col-form-label form-label">&nbsp;</label>
<div class="col-lg-6">
<button type="submit" name="search" class="btn btn-primary col-xl-4">Search</button>
</div>
</div>

</form>


<br>
</div>


<div class="hljs-wrapper">
<pre><code class="html" data-url="<?= base_url('assets/data/form-validation/code-1.json'); ?>"></code></pre>
</div>

</div>

</div>



</div>

<!---->
<form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post">
   
<div class="col-xl-12">

<div class="panel panel-inverse">

<div class="panel-heading">
<h4 class="panel-title" style="font-size: 1rem;" id="heading_title">
   STUDENT DETAILS REPORT
    
    </h4>
    
    
    
</div>

<div class="panel-body">

<?php

if($stud_query ==true) { ?>
<h3 style="text-align: center">
    
    <?php
     foreach ($stud_query->getResult() as $stud_row0) {
         
     }
    ?>
    <?=($_POST['class_program'] ?? '');?>  <?=($_POST['semister'] ?? '');?>
    <br>
    <?=($_POST['session'] ?? '');?> <?=($_POST['category'] ?? '');?>
</h3> 
<table id="data-table-buttons" class="table table-striped table-bordered align-middle w-100 text-nowrap">
<thead>
<tr>

<th class="text-nowrap">Sr No</th>
<th class="text-nowrap">Student Reg No</th>
<th class="text-nowrap">Student Name</th>
<th class="text-nowrap">Branch</th>
<th class="text-nowrap">Semester</th>
<th class="text-nowrap">Category</th>
<th class="text-nowrap">Recent Contact No</th>
<th class="text-nowrap">Contact No</th>
</tr>
</thead>
<tbody>
<?php
$sn = 0;
 foreach ($stud_query->getResult() as $stud_row) {
       $sn++;
     ?>
     <tr class="odd gradeX">


<td><?=$sn;?></td>
<td><?=$stud_row->reg_no;?></td>
<td><?=$stud_row->first_name;?> <?=$stud_row->middle_name;?> <?=$stud_row->last_name;?></td>
<td><?=$stud_row->class;?></td>
<td><?=$stud_row->semister;?></td>
<td><?=$stud_row->category;?></td>
<td><?=$stud_row->parent_mobile_number;?></td>
<td>
     <input type="hidden" value="<?php echo $sn; ?>" id="count" name="count" />
    <input type="hidden" value="<?=$stud_row->	student_admission_id ;?>" name="student_admission_id_<?php echo $sn; ?>" />
    <input type="text" name="contact_no_<?php echo $sn; ?>" /></td>
</tr>
     <?php
   
 }
?>


</tbody>
</table>
<div class="row mt-2">
    <div class="col-md-10"></div>
    <div class="col-md-2">
        <input type="submit" name="update" value="Update"  class="btn btn-warning">
    </div>
    

</div>
<?php 
}else{
    echo"Sorry No record found...";
}
?>
</div>





</div>

</div>
</form>
<!---->
</div>

</div>


<a href="javascript:;" class="btn btn-icon btn-circle btn-theme btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>

</div>


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

<!--for session select-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!--end for session select-->

<script src="cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="6d06734b60a66024f3330210-|49" defer>
    
</script>
<script>
    function search_student(str,method)
{

var url="<?= base_url('search_enquiry_name') ?>";
url=url+"?q="+str+"&method="+method;
url=url+"&sid="+Math.random();

    // Internet Explorer
   try { prodreq1 = new ActiveXObject("Msxml2.XMLHTTP"); }
   catch(e) {
      try { prodreq1 = new ActiveXObject("Microsoft.XMLHTTP"); }
      catch(oc) { prodreq1 = null; }
   }
   
      // Mozailla/Safari
   if (!prodreq1 && typeof XMLHttpRequest != "undefined") { prodreq1 = new XMLHttpRequest(); }
   // Call the processChange() function when the page has loaded

   if (prodreq1 != null) {
      prodreq1.onreadystatechange = function(){
	   
		  if(prodreq1.readyState ==4 && prodreq1.status == 200)
		  {	
		   final_text=prodreq1.responseText ;
		  document.getElementById("student_list").innerHTML=final_text;
		  }
		  
		  }
		   prodreq1.open("GET", url, true);
      prodreq1.send(null);
		  }
		  

}



function select_student_detail(id){
//reg_no
getObject('enquiry_no').value = id.value;
}

function myFunction() {
  var x = document.getElementById("search_enquiry_name").value ;

  getObject('enquiry_no').value = x.value;
}

</script>
<script>
    $('#dropdownYear').each(function() {

  var year = (new Date()).getFullYear();
  var current = year;
  year -= 20;
  for (var i = 0; i < 21; i++) {
    if ((year+i) == current)
      $(this).append('<option value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) + '-' +  (year+1 + i) +'</option>');
    else
      $(this).append('<option value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) +  '-' +  (year+1 + i) +'</option>');
  }

});

</script>
<?= $this->endSection() ?>

