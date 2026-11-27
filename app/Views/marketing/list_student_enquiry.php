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
<h3 class="panel-title">List of Student Enquired for Admission</h3>
<div class="panel-heading-btn">
<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
</div>
</div>


<div class="panel-body">
<form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post" action="<?= base_url('list_student_enquiry'); ?>">
<div class="form-group row">
   <div class="col-xl-4 offset-xl-2"><b>
Enquired Student Name</b></div>
   <div class="col-xl-4"><b>Enquiry No.</b></div>

</div>
<div class="form-group row">
    <div class="col-xl-4 offset-xl-2">
      <input list="search_enquiry_name1" name="search_enquiry_name" id="search_enquiry_name" class="form-control col-sm-5" onChange="myFunction()" autocomplete="off">
                                              <datalist id="search_enquiry_name1">
                                                  <?php
                                                 $db  = \Config\Database::connect();
                                                                    $query1= $db->query("SELECT * FROM marketing_enquiry ORDER BY id ASC"); 
                                                foreach ($query1->getResult() as $row1) {

                                                     echo ' <option value="'.$row1->enquiry_no.'">'.$row1->gender." . ".$row1->f_name." ".$row1->l_name.'</option>';
                                                  }
                                                  ?>
                                              </datalist>  
    </div>
    <div class="col-xl-4"><input type="text" name = "enquiry_no" class="form-control" id="enquiry_no" ></div>
    </div>
  <br>
<div class="form-group row">
   <div class="col-xl-4"><b>From Date</b></div>
   <div class="col-xl-4"><b>To Date</b></div>
   <div class="col-xl-4"><b>Session</b></div>
</div>
<div class="form-group row">
    <div class="col-xl-4"><input type="date" name="from_Date" class="form-control" id="f_date"></div>
    <div class="col-xl-4"><input type="date" name = "to_Date" class="form-control" id="t_date"></div>
    <div class="col-xl-4">
        
         <select class="form-control" name="session" id="dropdownYear" required>
    <option value="<?= $_SESSION['session_year']; ?>" selected><?= $_SESSION['session_year']; ?></option>
</select>
         </div>
         
</div>
<br>
<div class="form-group row">
<label class="col-lg-4 col-form-label form-label">&nbsp;</label>
<div class="col-lg-6">
<?php if (!empty($canAddListStudentEnquiry)): ?>
<input type="submit" name="select_type" class="btn btn-primary" value="Search">
<button type="reset" class="btn btn-primary">Cancel</button>
<?php endif; ?>
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
<h4 class="panel-title" id="heading_title">Student Enquiry List</h4>
<div class="panel-heading-btn">
<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
</div>
</div>

<div class="panel-body">
<table id="data-table-buttons" class="table table-striped table-bordered align-middle w-100 text-nowrap">
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
<th class="text-nowrap">Action</th>
</tr>
</thead>
<tbody>
<?php
$s=count($source);

                                    foreach ($source  as $row) :
                                        ?>
<tr class="odd gradeX">


<td><?= $row['enquiry_date']; ?> </td>
<td><?= $row['enquiry_no']; ?></td>
<td> <?= $row['f_name'].' '.$row['m_name'].' '.$row['l_name']; ?></td>
<?php
									$db      = \Config\Database::connect();
									 $query3 = $db->query("SELECT * FROM class  WHERE class_id='".$row['class']."' "); 
									// $query   = $builder->get(); 
									
								 foreach ($query3->getResult() as $row3) {
    
}
                                     $query8 = $db->query("SELECT * FROM last_school_attended WHERE s_id='".$row['last_school_attended']."' "); 
                                    // $query   = $builder->get(); 
                                    
                                    ?>
           <?php foreach ($query8->getResult() as $row8) {
}
?>
<td><?= $row3->class; ?></td>
<td><?= $row['semister']; ?> </td>
<td><?= $row['contact_no']; ?></td>
<td><?= $row['category']; ?></td>
<td><?= $row8->school_name; ?> </td>
<td><?= $row['reference_details']; ?></td>
<td><?php if (!empty($canDeleteListStudentEnquiry)): ?><a title="Remove" href="<?= base_url('delete_list_student_enquiry/' . $row['enquiry_no']); ?>"
              onclick="if (confirm('Are you sure You want to delete.?')){return true;}else{event.stopPropagation(); event.preventDefault();};" 
              >
              <img src="https://siotc.eduwings.in/public/record_drop.png" height="12" width="12">
              </a><?php endif; ?></td>
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
<?php  ?>
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

<?= $this->endSection() ?>

