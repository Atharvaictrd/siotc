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
<h3 class="panel-title">List of Student Enquired for Admission (According To Category)</h3>
</div>


<div class="panel-body">
<form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post" action="<?= base_url('list_student_category'); ?>">
<div class="form-group row">
   <div class="col-xl-6 offset-xl-3"><b>Category</b></div>
   
 
</div>
<div class="form-group row">
    <div class="col-xl-6 offset-xl-3">
    <select name="category" id="category" class="form-control chosen-select" >
    <option readonly> ---Select Here--- </option>
    <?php
                                $db      = \Config\Database::connect();
                                     $query8 = $db->query("SELECT * FROM student_category ORDER BY category_id "); 
                                    // $query   = $builder->get(); 
                                    
                                    ?>
                                        
           <?php foreach ($query8->getResult() as $row8) {
    

?>
            <option value="<?php echo $row8->category;?>"><?php echo $row8->category;?></option>
            <?php } ?>
    </select></div>
   
</div>
<br>
<div class="form-group row">
<label class="col-lg-4 col-form-label form-label">&nbsp;</label>
<div class="col-lg-6">
<button type="submit" class="btn btn-primary">Search</button>
<button type="reset" class="btn btn-danger">Cancel</button>
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


<div class="col-xl-12">

<div class="panel panel-inverse">

<div class="panel-heading">
<h4 class="panel-title">List</h4>
</div>

<div class="panel-body">
    <!--<table id="data-table-buttons" class="table table-striped table-bordered align-middle w-100 text-nowrap">-->
<table id="data-table-buttons" class="table table-striped table-bordered align-middle">
<thead>
<tr>

       
<th class="text-nowrap">Date</th>
<th class="text-nowrap">Enquiry No</th>
<th class="text-nowrap">Student Name</th>
<th class="text-nowrap">Program</th>
<th class="text-nowrap">Semester</th>
<th class="text-nowrap">Contact No</th>
<th class="text-nowrap">Category</th>
<th class="text-nowrap">Last School / College Attended</th>
<th class="text-nowrap">Refer By</th>
</tr>
</thead>
<tbody>

<?php
$s=count($source);

                                    foreach ($source  as $row) :
                                        ?>
<tr class="odd gradeX">


<td><?= date('d-m-Y', strtotime($row ['enquiry_date'])); ?> </td>
<td><?= $row['enquiry_no']; ?></td>
<td> <?= $row['f_name'].' '.$row['m_name'].' '.$row['l_name']; ?></td>
<?php
									$db      = \Config\Database::connect();
									 $query3 = $db->query("SELECT * FROM class  WHERE class_id='".$row['class']."' "); 
									// $query   = $builder->get(); 
									
								 foreach ($query3->getResult() as $row3) {
    
}
?>
                                    
<td><?= $row3->class; ?></td>
<td><?= $row['semister']; ?> </td>
<td><?= $row['contact_no']; ?></td>
<td><?= $row['category']; ?></td>
<?php  $query8 = $db->query("SELECT * FROM last_school_attended WHERE s_id='".$row['last_school_attended']."' "); 
                                    // $query   = $builder->get(); 
                                    
                                    ?>
           <?php foreach ($query8->getResult() as $row8) {
    
}

?>
<td><?= $row8->school_name;  ?> </td>
<td><?= $row['reference_details']; ?></td>

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

