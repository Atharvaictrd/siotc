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


<div class="row">
<div class="col-xl-12">

<div class="panel panel-inverse">

<div class="panel-heading">
<h4 class="panel-title">Section Wise Admission Report</h4>
</div>
<div class="panel-body">
<form class="form-horizontal" data-parsley-validate="true" name="demo-form">
<div class="form-group row">
   <div class="col-xl-1 offset-xl-2" ><b>
Section</b></div>
  <div class="col-xl-4" ><select class="form-control" name="section" id="section">
      <option>Click Here</option>
      <?php
      $db = \Config\Database::connect();
				 $query1 = $db->query("SELECT * FROM admmission_section"); 
				
			 foreach ($query1->getResult() as $row1) {
            ?>
        
    <option value="<?=$row1->section_name?>"><?=$row1->section_name?></option>
    <?php
			 }
    ?>
  </select></div>
  
   
</div><br>

<div class="form-group row">
<label class="col-lg-4 col-form-label form-label">&nbsp;</label>
<div class="col-lg-6">
<button type="button" class="btn btn-warning col-xl-4" id="searchBtn">Search</button>
</div>
</div>
</form>
</div>
<div class="hljs-wrapper">
<pre><code class="html" data-url="<?= base_url('assets/data/table-manage/keytable.json'); ?>"></code></pre>
</div>

</div>

</div>

<div class="col-xl-12" id="tableDiv">

<div class="panel panel-inverse">

<div class="panel-heading">
<h5>Section Wise Student Details</h5>
</div>

<div class="panel-body">
<table id="data-table-buttons" class="table table-striped table-borderedalign-middle w-100 text-nowrap">
<thead>
<tr>
<th class="text-nowrap">Sr No</th>
<th class="text-nowrap">Student Id</th>
<th class="text-nowrap">Student Name</th>
<th class="text-nowrap">Branch</th>
<th class="text-nowrap">Category</th>
<th class="text-nowrap">Contact No</th>
<th class="text-nowrap">Delete</th>
</tr>
</thead>
<tbody>
<?php
$s=count($source);
$n=1;

                                    foreach ($source  as $row) :
                                        ?>
                                        


<tr>
    <td><?= $n++; ?></td>
    <td><?= $row['student_admission_id']; ?> </td>
    <td><?= $row['first_name'].' '.$row['middle_name'].' '.$row['last_name']; ?>  </td>
    <td> <?= $row['program']; ?> </td>
    <td> <?= $row['category']; ?> </td>
    <?php  $query6 = $db->query("SELECT * FROM marketing_enquiry WHERE enquiry_no='".$row['enquiry_no']."' "); foreach ($query6->getResult() as $row6) {  }?>
   <td><?= $row6['contact_no']; ?> </td>
    <td> </td>
</tr>


<?php endforeach; ?>
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



<script src="cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="6d06734b60a66024f3330210-|49" defer>
    
</script>



<?= $this->endSection() ?>

