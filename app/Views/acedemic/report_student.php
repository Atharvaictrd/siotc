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
<h3 class="panel-title">Student Details</h3>
</div>


<div class="panel-body">
<form class="form-horizontal" data-parsley-validate="true" name="demo-form">
<div class="form-group row">
   <div class="col-xl-6 "><b>
Class</b></div>
   <div class="col-xl-6"><b>Semester</b></div>

</div>
<div class="form-group row">
    <div class="col-xl-6 ">
<?php
									$db      = \Config\Database::connect();
									 $query3 = $db->query("SELECT * FROM class ORDER BY class_id "); 
									// $query   = $builder->get(); 
									
									?>
                                    
								
        <select name="class"  class="form-control" id="class">
            
            <option value="">-----SELECT-----</option>
            	<?php foreach ($query3->getResult() as $row3) {
    

?>
            <option value="<?php echo $row3->class_id;?>"><?php echo $row3->class;?></option>
            <?php } ?></select>
         </div>                               
    <div class="col-xl-6"><?php
									
									 $query2 = $db->query("SELECT * FROM program_sem ORDER BY program_sem_id "); 
									// $query   = $builder->get(); 
									
									?>
                                    
								
        <select name="semister"  class="form-control" id="semister">
            
            <option value="">-----SELECT-----</option>
            	<?php foreach ($query2->getResult() as $row2) {
    

?>
            <option value="<?php echo $row2->program_sem;?>"><?php echo $row2->program_sem;?></option>
            <?php } ?></select></div>
    </div>
  <br>
<div class="form-group row">
   <div class="col-xl-6"><b>Session</b></div>
   <div class="col-xl-6"><b> Category</b></div>

</div>
<div class="form-group row">
    <div class="col-xl-6"><select class="form-control" name="session" id="dropdownYear">
    <option value="">-----SELECT-----</option>
</select></div>
    <div class="col-xl-6"><?php
									
									 $query2 = $db->query("SELECT * FROM student_category ORDER BY category_id "); 
									// $query   = $builder->get(); 
									
									?>
                                    
								
        <select name="category"  class="form-control" id="category">
            
            <option value="">-----SELECT-----</option>
            	<?php foreach ($query2->getResult() as $row2) {
    

?>
            <option value="<?php echo $row2->category;?>"><?php echo $row2->category;?></option>
            <?php } ?></select></div>
    
</div>
<br>

<div class="form-group row">
<label class="col-lg-4 col-form-label form-label">&nbsp;</label>
<div class="col-lg-6">
<button type="button" class="btn btn-primary col-xl-4" id="searchBtn">Search</button>
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


<div class="col-xl-12" id="tableDiv">

<div class="panel panel-inverse">

<div class="panel-heading">
<h4 class="panel-title">Student Details List</h4>
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
<th class="text-nowrap">Address</th>
<th class="text-nowrap">Contact No</th>
<th class="text-nowrap">Reference Person</th>
</tr>
</thead>
<tbody>
     <?php 
$s=count($source);
$n=1;

                                    foreach ($source  as $row) {
	      
?>
    <tr>
       <td> <?= $n++; ?></td>
       <td> <?= $row['student_admission_id']; ?></td>
     <td><?= $row['first_name'].' '.$row['middle_name'].' '.$row['last_name']; ?> </td>
        <td> <?= $row['section']; ?> </td>
    <td> <?= $row['category']; ?> </td>
    <td>  </td>
        <td> </td>
        <td><?= $row['reference_details']; ?>  </td>
    </tr>
    <?php	  } ?>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

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
  year -= 10;
  for (var i = 0; i < 11; i++) {
    if ((year+i) == current)
      $(this).append('<option selected value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) + '-' +  (year+1 + i) +'</option>');
    else
      $(this).append('<option value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) +  '-' +  (year+1 + i) +'</option>');
  }

});

</script>
<?= $this->endSection() ?>

