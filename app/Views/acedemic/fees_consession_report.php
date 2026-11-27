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
<?php if(session()->has('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session('success') ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if(session()->has('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session('error') ?>
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="row">

<div class="col-xl-12">

<div class="panel panel-inverse" data-sortable-id="form-validation-1">

<div class="panel-heading">
<h3 class="panel-title">	
Student Fees Consession Report</h3>
</div>


<div class="panel-body">
<form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post">
<div class="form-group row">
    
   <div class="col-xl-1 offset-xl-2"><b>
Session</b></div>
 <div class="col-xl-4 "><select name="session" onchange="javascript:form_submit();" class=" form-control"  id="dropdownYear" >
         <option value="<?=$_SESSION['session_year']?>" selected><?=$_SESSION['session_year']?></option>
         </select></div>
    <div class="col-xl-4 "><input type="submit" name="submit" class="btn btn-md btn-info" value="Search">
<input type="button" name="button" id="expButton" value="Print" class="btn btn-md btn-warning" onclick="printDiv('mydiv');" /> <input type="button" name="button" class="btn btn-md btn-primary" id="expButton" value="Export" onclick="exportdata('mydiv');" /></div>
</div>
   
  <br>





</form>
<?php if(isset($_POST['submit']) && $_POST['submit'] == 'Search'){ 
 $db  = \Config\Database::connect();
$fees_data_query =  $db->query("select *from  management_consession where session_year = '".($_POST['session'] ?? '')."'");

?>
<div id="mydiv" style="overflow-x: auto;">
<h4 class="text-center"> Student Fees Consession Report</h4> <br>
 <p class="text-center"> <b>Session Year : <?php echo ($_POST['session'] ?? ''); ?> </b></p>
<table class="table table-striped table-bordered align-middle w-100 text-nowrap" border="1">
<thead>
    
<tr>
    <th class="text-nowrap">Action</th>
<th class="text-nowrap">Sr No</th>
<th class="text-nowrap">Reg No</th>
<th class="text-nowrap">Name</th>
<th class="text-nowrap">Program</th>
<th class="text-nowrap">Semester</th>
<th class="text-nowrap">Category</th>
<th class="text-nowrap">Address</th>
<th class="text-nowrap">Actual Fees</th>
<th class="text-nowrap">Consession Fees</th>
<th class="text-nowrap">Outstanding Amount</th>
</tr>
</thead>
<tbody>
       
			 <?php
			 $count = 1;
			 $total = 0;
			 $total_bal = 0;

     
			 foreach ($fees_data_query->getResult() as  $fees_data){
			 
			   $reg_no= $fees_data->reg_no;
			 $fees_detail_query1 = $db->query("SELECT * FROM student_admission_information WHERE reg_no='$reg_no'");
		 foreach ($fees_detail_query1->getResult() as $student_detail) {
		 }
		    	$class = $db->query("SELECT * FROM class WHERE class_id='".$student_detail->program."' "); 
                                    // $query   = $builder->get(); 
                                    foreach ($class->getResult() as $class3) { }

			?> 
			 <tr height="25">
			 <td width="15px" style="white-space:nowrap;"><a href="delete_management/<?php echo $fees_data->sr_no;?>">DELETE</a></td>
<td width="5px" style="white-space:nowrap;"><?php echo $count++; ?></td>
				  <td style="white-space:nowrap;"><?php echo $fees_data->reg_no;?></td>
				  <td width="29%"><?php echo $student_detail->salutation.' '.$student_detail->first_name.' '.$student_detail->middle_name.' '.$student_detail->last_name;?></td>
				         <td width="20%"><?php echo $class3->class;?></td>
                  <td style="white-space:nowrap;"><?php echo $fees_data->semister;?></td>
                   <td width="10%"><?php echo $fees_data->category;?></td>
                       <td width="10%"><?php  
					   //if($_POST['session'] == '2014-2015'){
					  // echo $general->student_address_detail( $student_detail['student_admission_id']);
					   //}else{
					   if(($_POST['session'] ?? '') == '2015-2016'){
					   //echo $general->student_address_detail( $student_detail['student_admission_id']);
					   }else{
					   //$cell_no = $db->query("select contact_no, area from  prospect_sales_2016_2017 where session = '2016-2017' and  	student_first_name = '".$student_detail->first_name."' and 	student_middle_name	 = '".$student_detail['middle_name']."' and student_last_name = '".$student_detail['last_name']."'");
						  
						  //$exist = mysql_num_rows($cell_no);
						  //if($exist>0){
							 //     $fetch = mysql_fetch_array($cell_no);
								//   $mobile_no  = $fetch['contact_no'];
                                                              
        //                           $address   = $fetch['area'];
							  
							 // }
						  // echo $address.'<b></br>Mob.no - '.$mobile_no.'</b>';
						   
						   }
					    ?></td>
               <td style="white-space:nowrap;"><?php echo $fees_data->actual_fees;?></td>
				  <td align="right"><?php echo $fees_data->consession_amount.'&nbsp;Rs.'; ?><?php $total = $total+ $fees_data->consession_amount; ?></td>
                    <td align="right"><?php echo $fees_data->balance_amount.'&nbsp;Rs.'; ?><?php $total_bal =  $total_bal+$fees_data->balance_amount; ?></td>
				 
	 		 </tr>
	 		 <?php
			 
			 }
			 ?>
			 <tr>
			 
				<td align="right" colspan="9">Grand Total =>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	<b><?php  
				echo number_format($total, 2);
				?></b></td>

                <td align="right" colspan="3"><b><?php  
				echo number_format($total_bal, 2);
				?></b></td>
			 </tr>
			 			 <tr>
			 	<td colspan="12"><h3>No. Of Students Got Consession :- <?php echo $count-1; ?></h3></td>
              
              
				
			 </tr>
</tbody>
</table>

</div>
<input type="button" name="button" id="expButton" value="Print" class="btn btn-md btn-warning" onclick="printDiv('mydiv');" /> 
</div>


<div class="hljs-wrapper">
<pre><code class="html" data-url="<?= base_url('assets/data/form-validation/code-1.json'); ?>"></code></pre>
</div>

</div>

</div>



</div>

</div>

</div>

<?php } ?>

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
function exportdata(id){  
   
var Contents = $('#'+id+'').html();    
   //alert(''+Contents);
   window.open('data:application/vnd.ms-excel, ' +  '<div>'+encodeURIComponent(Contents) +  '</div>' );
   //alert('exporting records...');

};
function printDiv(data)
{
var mywindow = window.open('', 'my div', 'height=700,width=1300, scrollbars=yes');
mywindow.document.write('<html><head><title>Printing...</title>');
mywindow.document.write('</head><body>');
mywindow.document.write($('#'+data+'').html());
mywindow.document.write('</body></html>');

mywindow.print();
mywindow.close();

return true;
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
<?= $this->endSection() ?>

