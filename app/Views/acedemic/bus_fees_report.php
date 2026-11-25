<?= $this->extend('layout/tempmain') ?>

<?= $this->section('links') ?>
<?= $this->endSection('links') ?>

<?= $this->section('content') ?>
<?php
 $db  = \Config\Database::connect();
if((isset($_POST['Submit']))&&($_POST['Submit']=='View')){
//echo $_POST['reg_no'];
if(!empty($_POST['reg_no'])){
$reg_no = "reg_no='".($_POST['reg_no'] ?? '')."'";
}else{
$reg_no ='';
}
$session = ($_POST['session'] ?? '');
$fees_data_query =  $db->query("SELECT * FROM other_fees WHERE  ".$reg_no." AND c_name='Bus' AND session='$session'");



}else{ $session = $_SESSION['session_year'];
    $fees_data_query =  $db->query("SELECT * FROM other_fees WHERE session='$session'");
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

<div class="panel panel-inverse" data-sortable-id="form-validation-1">

<div class="panel-heading">
<h3 class="panel-title" id="heading_title">	
Bus Fees Report</h3>
</div>


<div class="panel-body">
<form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post">
<div class="form-group row">
   <div class="col-xl-4"><b>Student Name</b></div>
   <div class="col-xl-4 "><b>Reg. No</b></div>
   <div class="col-xl-3 "><b>session</b></div>
   
</div>
<div class="form-group row">
   <div class="col-xl-4"><select name="search_enquiry_name" id="search_enquiry_name" class="form-control col-sm-5 chosen-select" onChange="myFunction()" autocomplete="off">
                                              <option>--Select--</option>
                                                  <?php
                                                 $db  = \Config\Database::connect();
                                                                    $query1= $db->query("SELECT * FROM student_admission_information WHERE active_status='0' ORDER BY student_admission_id ASC"); 
                                                foreach ($query1->getResult() as $row1) {

                                                     echo ' <option value="'.$row1->reg_no.'">'.$row1->salutation." . ".$row1->first_name." ".$row1->last_name.'</option>';
                                                  }
                                                  ?>
                                              </select></div>
    <div class="col-xl-4"><input type="text" class="form-control" name="reg_no" id="reg_no" required></div>
    <div class="col-xl-3">
        <select class="form-control" name="session" id="dropdownYear">
    <option value="<?= $_SESSION['session_year']; ?>" selected><?= $_SESSION['session_year']; ?></option>
</select>
    </div>
    </div>
   
  <br>
<div class="form-group row">

   <div class="col-xl-4 offset-xl-2"><input name="Submit" type="submit" class="btn btn-info" id="View" title="View" value="View" style="text-decoration:none"/></div>

</div>

<br>




</form>
</div>


<div class="hljs-wrapper">
<pre><code class="html" data-url="<?= base_url('assets/data/form-validation/code-1.json'); ?>"></code></pre>
</div>

</div>

</div>



</div>

	<?php 
		if (isset($fees_data_query)){
		    
		    foreach ($fees_data_query->getResult() as  $fees_data1){
			 
			   $reg_no= $fees_data1->reg_no;
			 $fees_detail_query1 = $db->query("SELECT * FROM student_admission_information WHERE reg_no='$reg_no'");
		 foreach ($fees_detail_query1->getResult() as $student_detail1) {
		 }
		    }
		?>
		<tr>
<div class="col-xl-12" >

<div class="panel panel-inverse">


<div class="panel-body">
    <h4 class="text-center">Bus Fees Report</h4>
    <!--<p class="text-center"> <b>Student Name : <?php echo $student_detail1->salutation.' '.$student_detail1->first_name.' '.$student_detail1->middle_name.' '.$student_detail1->last_name;?></b></p>-->
<table id="data-table-buttons" class="table table-striped table-bordered align-middle w-100 text-nowrap">
<thead>
<tr>
    <th class="text-nowrap">Action</th>
<th class="text-nowrap">Sr No</th>
<th class="text-nowrap">Receipt No</th>
<th class="text-nowrap">Branch</th>
<th class="text-nowrap">Reg No</th>
<th class="text-nowrap">Name</th>
<th class="text-nowrap">Date</th>
<th class="text-nowrap">Paid Type</th>
<th class="text-nowrap">Total Amount</th>
</tr>
</thead>
<?php
	 $count=0;
			 $total_amount=0;
			 foreach ($fees_data_query->getResult() as  $fees_data){
			 
			   $reg_no= $fees_data->reg_no;
			 $fees_detail_query = $db->query("SELECT * FROM student_admission_information WHERE reg_no='$reg_no'");
		 foreach ($fees_detail_query->getResult() as $student_detail) {
		 }
			$count++;
			 $data_query  = $db->query("SELECT * FROM  other_fees WHERE ID='".$fees_data->ID."'");
		
	$total_amounts = 0;
	 foreach ($data_query->getResult() as $data) {
	     $total_amounts = $total_amounts + $data->c_amount;
	$total_amount = $total_amount +$data->c_amount;
	}
	$class = $db->query("SELECT * FROM class WHERE class_id='".$student_detail->program."' "); 
                                    // $query   = $builder->get(); 
                                    foreach ($class->getResult() as $class3) { }
                                    ?>
                                    	<td>
<a href="#" onClick="window.open('fees_report/print_other_slip?action=preview&id=<?php echo $fees_data->ID; ?>','','menubar=no,width=990px,height=550px,scrollbars=yes,toolbar=no,titlebar=no,status=no,minimize=false');"  alt='Admission Fee View' title="Admission Fee View" ><i class="fa fa-circle-info" style="font-size:20px;"></i></a>
	</a></td>
				
				  <td width="74" style="white-space:nowrap;"><?php echo $count;?></td>
				  <td style="white-space:nowrap;"><?php echo $fees_data->ID;?></td>
				  
				  
				    <td style="white-space:nowrap;"><?php echo $student_detail->class ?></td>
				     <td style="white-space:nowrap;"><?php echo $student_detail->reg_no;?></td>
				  <td width="204" style="white-space:nowrap;"><?php echo $student_detail->salutation.' '.$student_detail->first_name.' '.$student_detail->middle_name.' '.$student_detail->last_name;?></td>
               <td width="188" align="center" style="white-space:nowrap;"><?php
				  $originalDate = $fees_data->Date;
echo $newDate = date("d-m-Y", strtotime($originalDate));
				//   echo $general->date_format($fees_data['date']);
				  ?></td>
				  <td style="white-space:nowrap;"><?php echo $fees_data->paid_type;?></td>	
				  <td width="12%"  style="white-space:nowrap;"><?php
				  echo  $fees_data->c_amount;
				  ?></td>
	 		 </tr>
			 <?php
			 }
			 ?>
			 </tbody>
			 <tfoot>
			     
			     <tr>
			         	<td colspan="8"></td>
				<td align="center"><?php echo  $total_amount;?></td>
			     </tr>
			 </tfoot>

</table>

</div>




</div>

</div>
<?php } ?>
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
    function myFunction() {
  var x = document.getElementById("search_enquiry_name").value ;
 $('#reg_no').val(x);
//  $('.prospectus_no').show();
//   getObject('enquiry_no').value = x.value;
}
  function myFunction1() {
//   var x = document.getElementById("search_enquiry_name").value ;
//  $('#enquiry_no').val(x);
//  $('.prospectus_no').show();
//   getObject('enquiry_no').value = x.value;
}
</script>
<?= $this->endSection() ?>

