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

<div class="panel panel-inverse" data-sortable-id="form-validation-1">

<div class="panel-heading">
<h3 class="panel-title">Student Prospectus Sale report</h3>
<div class="panel-heading-btn">
<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
</div>
</div>

<div class="panel-body">
    <form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post" action="<?= base_url('student_prospectus'); ?>">
        
        <!-- Title -->
        <div class="form-group row">
            <div class="col-xl-8 offset-xl-2 text-center">
                <h4>Student Prospectus Sales Report</h4>
            </div>
        </div>
        
        <br>
        
        <!-- Session and Program Row -->
        <div class="form-group row align-items-end">
            <!-- Session Dropdown -->
            <div class="col-xl-3 offset-xl-2">
                <label for="dropdownYear"><b>Session</b></label>
                <select name="session" id="dropdownYear" class="form-control" onchange="form_submit();">
                    <option value="<?= $_SESSION['session_year'] ?>" selected><?= $_SESSION['session_year'] ?></option>
                </select>
            </div>

            <!-- Program Dropdown -->
            <div class="col-xl-3">
                <label for="class"><b>Program</b></label>
                <?php
                $db = \Config\Database::connect();
                $query3 = $db->query("SELECT * FROM class ORDER BY class_id");
                ?>
                <select name="class1" id="class" class="form-control">
                    <option value="">-----SELECT-----</option>
                    <?php foreach ($query3->getResult() as $row3) { ?>
                        <option value="<?= $row3->class_id ?>"><?= $row3->class ?></option>
                    <?php } ?>
                </select>
            </div>
            
            <div class="col-xl-3" > 
                <label for="class"><b>Semester</b></label>
                <select name="semister" class="form-control" id="semister">
                <option value="">-----SELECT-----</option>
                	<?php  $query2 = $db->query("SELECT * FROM program_sem ORDER BY program_sem_id "); foreach ($query2->getResult() as $row2) {
        
                    ?>
                <option value="<?php echo $row2->program_sem;?>"><?php echo $row2->program_sem;?></option>
                <?php } ?>
                </select>
            </div>
        </div>

        <!-- Buttons Row -->
        <div class="form-group row mt-3">
            <div class="col-xl-8 offset-xl-2 text-center">
                <button type="submit" class="btn btn-primary" id="searchBtn">Search</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </div>

    </form>
</div>


<div class="hljs-wrapper">
<pre><code class="html" data-url="<?= base_url('assets/data/form-validation/code-1.json'); ?>"></code></pre>
</div>

</div>

</div>

<div class="col-xl-12" >

<div class="panel panel-inverse">

<div class="panel-heading">
<h4 class="panel-title" id="heading_title">Student Prospectus sales Report List</h4>
</div>

<div class="panel-body">
<table id="data-table-buttons" class="table table-striped table-bordered align-middle ">
<thead>
<tr>


<th class="">Sr No</th>
<!--<th class="text-nowrap">Prospectus No</th>-->
<th class="text-nowrap">Student Name</th>
<th class="text-nowrap">Program</th>
<th class="text-nowrap">Semister</th>
<th class="text-nowrap">Address</th>
<th class="text-nowrap">Contact No</th>
<th class="text-nowrap">Gender</th>
<th class="text-nowrap">Date Of Birth</th>
<th class="text-nowrap">Reference</th>
</tr>
</thead>
<tbody>

<?php $i = 1; ?>
<?php foreach ($source as $row): ?>
<tr>
    <td><?= $i; ?></td>
    <td><?= strtoupper($row['student_name']); ?></td>
    <td><?= $row['program']; ?></td>
    <td><?= $row['semister']; ?></td>
    <td><?= $row['address']; ?></td>
    <td><?= $row['contact_no']; ?></td>
    <td><?= $row['gender1']; ?></td>
    <td><?= $row['date_of_birth']; ?></td>
    <td><?= $row['reference_details']; ?></td>
</tr>
<?php $i++; endforeach; ?>


</tbody>
</table>
</div>




</div>

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
<script>


    function myFunction() {
  var x = document.getElementById("search_enquiry_name").value ;
 $('#prospect_no').val(x);
//  $('.prospectus_no').show();
//   getObject('enquiry_no').value = x.value;
}


</script>
<?= $this->endSection() ?>


