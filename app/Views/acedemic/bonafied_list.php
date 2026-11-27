<?= $this->extend('layout/tempmain') ?>

<?= $this->section('links') ?>
<?= $this->endSection('links') ?>

<?= $this->section('content') ?>
<?php
 $db  = \Config\Database::connect();
 $class_qry = $db->query("SELECT * FROM class");
 $cat_qry = $db->query("SELECT * FROM student_category");
 $sem_qry = $db->query("SELECT * FROM program_sem");
 
    $fee_search_key=array();

if(!empty($_POST['program'])){
$fee_search_key[]="program = '".($_POST['program'] ?? '')."'";
}


if(!empty($_POST['session'])){
$fee_search_key[]="session_year = '".($_POST['session'] ?? '')."'";
}

if(!empty($_POST['category'])){
$fee_search_key[]="category = '".($_POST['category'] ?? '')."'";
}

if(!empty($_POST['semister'])){
$fee_search_key[]="semister = '".($_POST['semister'] ?? '')."'";
}

if(!empty($fee_search_key)){
 $key= ' WHERE ('.implode(' AND ',$fee_search_key).') ';
 $_SESSION['search'] = $key;
}
if (!isset($key)) {
    $key = '';
}
 if(isset($_POST['search'])){
    //  echo "SELECT * FROM `student_admission_information` $key";
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
<h4 class="panel-title">Bonafied Certificate List</h4>
</div>
<div class="panel-body">
<form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post">
<div class="form-group row">
   <div class="col-xl-3" ><b>
Class</b></div>
  <div class="col-xl-3" ><b>Session <span style="color:red;">*</span></b></div>
    <div class="col-xl-3" ><b>Category <span style="color:red;">*</span></b></div>
      <div class="col-xl-3" ><b>Semester <span style="color:red;">*</span></b></div>
  
</div>
<div class="form-group row">
     <div class="col-xl-3" ><select name="program" id="program" class="form-control chosen-select" >
       
     <?php
            $db      = \Config\Database::connect();
				 $query4 = $db->query("SELECT * FROM class"); 
				
			 foreach ($query4->getResult() as $row4) {
            ?>
        
    <option value="<?=$row4->class_id;?>" ><?=$row4->class;?></option>
    <?php
			 }
    ?>
    </select></div>
   <div class="col-xl-3" > <select class="form-control" name="session" id="dropdownYear">
     <option value="<?= $_SESSION['session_year']; ?>" selected><?= $_SESSION['session_year']; ?></option>
</select></div>
     <div class="col-xl-3" ><select class="form-control chosen-select" name="category" id="category">
                      <option value=''>select</option>
                      <?php
				 $query1 = $db->query("SELECT * FROM student_category"); 
				
			 foreach ($query1->getResult() as $row1) {
            ?>
        
    <option value="<?=$row1->category?>"><?=$row1->category?></option>
    <?php
			 }
    ?>
    </select></div>
     <div class="col-xl-3" > <select name="semister" id="semister" class="form-control chosen-select" >
            <option value="">--semester--</option>
            <?php
				 $query1 = $db->query("SELECT * FROM program_sem"); 
				
			 foreach ($query1->getResult() as $row1) {
            ?>
        
    <option value="<?=$row1->program_sem?>"><?=$row1->program_sem?></option>
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
<h5>Bonafied Certificate List</h5>
</div>

<div class="panel-body">
<table id="data-table-buttons" class="table table-striped table-bordered align-middle">
<thead>
<tr>
<th class="text-nowrap">Sr No</th>
<th class="text-nowrap">Student Id</th>
<th class="text-nowrap">Student Name</th>
<th class="text-nowrap">Section </th>
<th class="text-nowrap">Category</th>
<th class="text-nowrap">Contact No</th>
<th class="text-nowrap">Print & Edit L.C</th>
</tr>
</thead>
<tbody>
<?php
$sn = 0;
            foreach ($st_qry->getResult() as $st_row) {
                
                $sn++;
              
                
                $ct_q = $db->query("select contact_no, area from  prospect_sales where 
                session = '".$st_row->session_year."' and student_first_name = '".$st_row->first_name."' and student_middle_name = '".$st_row->middle_name."' and student_last_name = '".$st_row->last_name."'");
                foreach ($ct_q->getResult() as $ct_row) {}
                ?>
                <tr>
<td><?=$sn;?></td>
<td><?=$st_row->reg_no;?></td>
<td><?=$st_row->first_name?> <?=$st_row->middle_name?> <?=$st_row->last_name?></td>
<td><?php
if($st_row->section =='1'){
    echo "Section 1";
}else if($st_row->section =='2'){
    echo "Section 2";
}
?></td>
<td><?=$st_row->category?></td>
<td><?=$ct_row->contact_no;?></td>


   <td>

    <?php if (canAccess('bonafied', 'view')): ?>

        <a href="<?= base_url(); ?>cert_bonafied?reg_no=<?= $st_row->reg_no; ?>"
           class="btn btn-warning">
            Print
        </a>

    <?php endif; ?>

    <?php if (canAccess('bonafied', 'edit')): ?>

        <a href="<?= base_url(); ?>bonafied"
           class="btn btn-primary">
            Edit
        </a>

    <?php endif; ?>

</td>
</tr>

<?php 	  } ?>

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
<script type="text/javascript">
$(window).load(function() {
	$(".loader").fadeOut(5000);
})
 
</script>
<script>
    $('#dropdownYear').each(function() {

  var year = (new Date()).getFullYear();
  var current = year;
  year -= 10;
  for (var i = 0; i < 11; i++) {
    if ((year+i) == current)
      $(this).append('<option  value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) + '-' +  (year+1 + i) +'</option>');
    else
      $(this).append('<option value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) +  '-' +  (year+1 + i) +'</option>');
  }

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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="6d06734b60a66024f3330210-|49" defer>
    
</script>



<?= $this->endSection() ?>

