<?= $this->extend('layout/tempmain') ?>

<?= $this->section('links') ?>
<?= $this->endSection('links') ?>

<?= $this->section('content') ?>
<style>
    .print{
            border-width: 1px;
    border-style: solid;
    border-color: #ed6502 #a04300 #a04300 #ed6502;
    padding: 0 7px 1px 7px;
    background: #ffac47 url(images/btn_bg.gif) repeat-x 0 100%;
    color: #fff;
    font: bold 12px arial, helvetica, sans-serif;
    cursor: pointer;
    text-align: center !important;
    white-space: nowrap;
    }
    .edit{
            
    border-width: 1px;
    border-style: solid;
    border-color: #40c1c1 #a04300 #a04300 #40c1c1;
    padding: 0 7px 1px 7px;
    background: #40c1c1 url(images/btn_bg.gif) repeat-x 0 100%;
    color: #fff;
    font: bold 12px arial, helvetica, sans-serif;
    cursor: pointer;
    text-align: center !important;
    white-space: nowrap;
    }
</style>
<?php
 $db  = \Config\Database::connect();
 $class_qry = $db->query("SELECT * FROM class");
 $cat_qry = $db->query("SELECT * FROM student_category");
 $sem_qry = $db->query("SELECT * FROM program_sem");
 
    $fee_search_key=array();

if(!empty($_POST['class'])){
$fee_search_key[]="program = '".($_POST['class'] ?? '')."'";
}


if(!empty($_POST['session'])){
$fee_search_key[]="session_year = '".($_POST['session'] ?? '')."'";
}

if(!empty($_POST['category'])){
$fee_search_key[]="category = '".($_POST['category'] ?? '')."'";
}

if(!empty($_POST['semester'])){
$fee_search_key[]="semister = '".($_POST['semester'] ?? '')."'";
}

if(!empty($fee_search_key)){
 $key= ' WHERE ('.implode(' AND ',$fee_search_key).') ';
 $_SESSION['search'] = $key;
}
if (!isset($key)) {
    $key = '';
}
 if(isset($_POST['search'])){
     $st_qry = $db->query("SELECT * FROM `student_admission_information` $key");
     
 }else{
      $st_qry = $db->query("SELECT * FROM `student_admission_information`");
 }
 ?>
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


<div class="row">
<div class="col-xl-12">

<div class="panel panel-inverse">

<div class="panel-heading">
<h4 class="panel-title">Leaving Certificate List</h4>
</div>
<div class="panel-body">
<form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post">
<div class="form-group row">
   <div class="col-xl-3" ><b>
Class</b></div>
  <div class="col-xl-3" ><b>Session </b></div>
    <div class="col-xl-3" ><b>Category </b></div>
      <div class="col-xl-3" ><b>Semester </b></div>
  
</div>
<div class="form-group row">
  <div class="col-xl-3" ><select class="form-control chosen-select" name="class" id="class">
        <option value="">Select Here</option>
        <?php
        foreach ($class_qry->getResult() as $row) {
            ?>
            <option value="<?=$row->class_id;?>" <?php if(($_POST['class'] ?? '') == $row->class_id){ echo "selected"; } ?>><?=$row->class;?></option>
            <?php
        }
        ?>
    </select></div>
   <div class="col-xl-3" ><select class="form-control  chosen-select" name="session" id="dropdownYear">
   
    <option value="<?=$_SESSION['session_year']?>" selected><?=$_SESSION['session_year']?></option>
</select></div>
     <div class="col-xl-3" >
         <select class="form-control chosen-select" name="category" id="category">
        <option value="">Select Here</option>
         <?php
        foreach ($cat_qry->getResult() as $row) {
            ?>
            <option value="<?=$row->category;?>"  <?php if(($_POST['category'] ?? '') == $row->category){ echo "selected"; } ?>><?=$row->category;?></option>
            <?php
        }
        ?>
    </select></div>
     <div class="col-xl-3" ><select class="form-control  chosen-select" name="semester" id="semester">
        <option value="">Select Here</option>
         <?php
        foreach ($sem_qry->getResult() as $row) {
            ?>
            <option value="<?=$row->program_sem;?>"  <?php if(($_POST['semester'] ?? '') == $row->program_sem){ echo "selected"; } ?>><?=$row->program_sem;?></option>
            <?php
        }
        ?>
    </select></div>
</div>
<br>

<div class="form-group row">
<label class="col-lg-4 col-form-label form-label">&nbsp;</label>
<div class="col-lg-6">
<button type="submit" class="btn btn-warning col-xl-4" id="searchBtn" name="search">Search</button>
</div>
</div>
</form>
</div>
<div class="hljs-wrapper">
<pre><code class="html" data-url="<?= base_url('assets/data/table-manage/keytable.json'); ?>"></code></pre>
</div>

</div>

</div>

<div class="col-xl-12" id="">

<div class="panel panel-inverse">

<div class="panel-heading">
<h5>Leaving Certificate List</h5>
</div>

<div class="panel-body">
<table id="data-table-buttons" class="table table-striped table-bordered align-middle w-100 text-nowrap">
<thead>
<tr>
<th class="text-nowrap">Sr No</th>
<th class="text-nowrap">Student Id</th>
<th class="text-nowrap">Student Name</th>
<th class="text-nowrap">Section</th>
<th class="text-nowrap">Category</th>
<th class="text-nowrap">Contact No</th>
<th class="text-nowrap">Issue Date</th>
<th class="text-nowrap">Print & Edit L.C</th>
</tr>
</thead>
<tbody>

<?php
$sn = 0;
            foreach ($st_qry->getResult() as $st_row) {
                
                $sn++;
               
                $st_q = $db->query("SELECT * FROM cer_leaving WHERE student_id = '$st_row->student_admission_id'");
                foreach ($st_q->getResult() as $sl_row) {
            $reg= $sl_row->student_admission_id;
                $ct_q = $db->query("select contact_no, area from  prospect_sales where 
                session = '".$st_row->session_year."' and student_first_name = '".$st_row->first_name."' and student_middle_name = '".$st_row->middle_name."' and student_last_name = '".$st_row->last_name."'");
                foreach ($ct_q->getResult() as $ct_row) {}
                $st_qry1 = $db->query("SELECT * FROM `student_admission_information` WHERE reg_no = '$reg'");
// echo "SELECT * FROM `student_admission_information` WHERE reg_no = '$reg'";
$row = $st_qry1->getRowArray();
// echo $row['reg_no'];
// echo $sl_row->student_id;
                // if($st_row->reg_no==$reg){
                ?>
                <tr>
<td><?=$sn;?></td>
<td><?=$sl_row->student_admission_id;?></td>
<td><?=$row['first_name']?> <?=$row['middle_name']?> <?=$row['last_name']?></td>
<td><?php
if($row['section'] =='1'){
    echo "Section 1";
}else if($row['section'] =='2'){
    echo "Section 2";
}
?></td>
<td><?=$row['category']?></td>
<td><?=$ct_row->contact_no;?></td>
<td><?php
if($sl_row->date_of_leaving){
    echo $sl_row->date_of_leaving;
}else{
    echo "Pending";
}
?></td>
<td>
    <?php
    if($sl_row->student_admission_id==$row['reg_no']){
        ?>
        <a href="<?=base_url();?>cer_leaving_print_final?reg_no=<?=$reg;?>&session=<?=$st_row->session_year;?>"><button class="print">Print</button></a>
        OR
        <a href="<?=base_url();?>cert_leaving?reg_no=<?=$reg;?>&session=<?=$st_row->session_year;?>"><button class="edit">Edit L.C</button></a>
        <?php
	}
    ?>
</td>
</tr>
                <?php
            }} 
                ?>
</tbody>
</table>
</div>
<div class="hljs-wrapper">
<pre><code class="html" data-url="<?= base_url('assets/data/table-manage/keytable.json'); ?>"></code></pre>
</div>
</div>
</div>
</div>

</div>

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
</script>


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
    $('#dropdownYear').each(function() {

  var year = (new Date()).getFullYear();
  var current = year;
  year -= 10;
  for (var i = 0; i < 11; i++) {
    if ((year+i) == current)
      $(this).append('<option value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) + '-' +  (year+1 + i) +'</option>');
    else
      $(this).append('<option value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) +  '-' +  (year+1 + i) +'</option>');
  }

});

</script>

<?= $this->endSection() ?>

