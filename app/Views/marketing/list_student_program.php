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
<h3 class="panel-title">List of Student Enquired for Admission (PROGRAM or SEMESTER)</h3>
</div>


<div class="panel-body">
<form class="form-horizontal" data-parsley-validate="true" name="demo-form"  method="post" action="<?= base_url('list_student_program')?>">
<div class="form-group row">
   <div class="col-xl-4"><b>Program</b></div>
   <div class="col-xl-4"><b>Semester</b></div>
   <div class="col-xl-4"><b>Session</b></div>
</div>
<div class="form-group row">
    <div class="col-xl-4">
        
        <select name="program" id="program" class="form-control chosen-select"  data-placeholder="Select program...">
        <option value="">Click Here To Select program...</option>
     <?php
            $db      = \Config\Database::connect();
				 $query = $db->query("SELECT * FROM class"); 
				
			 foreach ($query->getResult() as $row) {
            ?>
        
    <option value="<?=$row->class_id?>" ><?=$row->class?></option>
    <?php
			 }
    ?>
   
    </select></div>
    <div class="col-xl-4">
        <select name="semister" id="semister" class="form-control  chosen-select" >
            <option value="">Click Here To Select semester...</option>
            <?php
				 $query1 = $db->query("SELECT * FROM program_sem"); 
				
			 foreach ($query1->getResult() as $row1) {
            ?>
        
    <option value="<?=$row1->program_sem?>"><?=$row1->program_sem?></option>
    <?php
			 }
    ?>
   
    </select></div>
    <div class="col-xl-4">
        <select class="form-control  chosen-select" name="session" id="dropdownYear">
    <option value="">Select session</option>
    <option value="<?=$_SESSION['session_year']?>" selected><?=$_SESSION['session_year']?></option>
</select>
    
  
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
<table id="data-table-buttons" class="table table-striped table-bordered align-middle w-100 text-nowrap">
<thead>
<tr>

        <th width="3%"></th>
<th class="text-nowrap">Date</th>
<th class="text-nowrap">Enquiry No</th>
<th class="text-nowrap">Student Name</th>
<th class="text-nowrap">Program</th>
<th class="text-nowrap">Semester</th>
<th class="text-nowrap">Contact No</th>
<th class="text-nowrap">Category</th>
<th class="text-nowrap">Last School / College Attended</th>
<th class="text-nowrap">Percentage</th>
<th class="text-nowrap">Refer By</th>
</tr>
</thead>
<tbody>

<?php
$s=count($source);

                                    foreach ($source  as $row) :
                                        ?>
<tr class="odd gradeX">
<td></td>

<td><?= $row['enquiry_date']; ?> </td>
<td><?= $row['enquiry_no']; ?></td>
<td> <?= $row['f_name'].' '.$row['m_name'].' '.$row['l_name']; ?></td>

<td><?= $row['class']; ?></td>
<td><?= $row['semister']; ?> </td>
<td><?= $row['contact_no']; ?></td>
<td><?= $row['category']; ?></td>
<?php  $query8 = $db->query("SELECT * FROM last_school_attended WHERE s_id='".$row['last_school_attended']."' "); 
                                    // $query   = $builder->get(); 
                                    
                                    ?>
           <?php foreach ($query8->getResult() as $row8) {
    
}

?>
<td><?= $row8->school_name; ?> </td>
<td><?= $row['reference_details']; ?></td>

<td></td>
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
 $('#enquiry_no').val(x);
//   getObject('enquiry_no').value = x.value;
}

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

