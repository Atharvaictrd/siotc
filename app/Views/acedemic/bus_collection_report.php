<?= $this->extend('layout/tempmain') ?>

<?= $this->section('links') ?>
<?= $this->endSection('links') ?>

<?= $this->section('content') ?>
<?php
 $db  = \Config\Database::connect();
if((isset($_POST['Submit']))&&($_POST['Submit']=='View')){

// if((!empty($_POST['amount_type'])) && (!empty($_POST['class']))){
// $fees_data_query = $db->query("SELECT * FROM other_fees WHERE cheque_date>='".$_POST['from_date']."' AND cheque_date <='".$_POST['to_date']."' AND class='".$_POST['class']."' AND paid_type='".$_POST['amount_type']."' ORDER BY `other_fees`.`ID` ASC");
// }elseif(!empty($_POST['amount_type'])){
    
// $fees_data_query = $db->query("SELECT * FROM other_fees WHERE Date>='".$_POST['from_date']."' AND Date <='".$_POST['to_date']."' AND paid_type='".$_POST['amount_type']."' ORDER BY `other_fees`.`ID` ASC");
// }elseif(!empty($_POST['class'])){
// $fees_data_query = $db->query("SELECT * FROM other_fees WHERE cheque_date>='".$_POST['from_date']."' AND cheque_date <='".$_POST['to_date']."' AND class='".$_POST['class']."' ORDER BY `other_fees`.`ID` ASC");

// }else{
//     $fees_data_query = $db->query("SELECT * FROM other_fees WHERE cheque_date>='".$_POST['from_date']."' AND cheque_date <='".$_POST['to_date']."' ORDER BY `other_fees`.`ID` ASC");
// }


if(!empty($_POST['amount_type'])){
$fees_data_query = $db->query("SELECT * FROM other_fees WHERE date>='".($_POST['from_date'] ?? '')."' AND date <='".($_POST['to_date'] ?? '')."' AND paid_type='".($_POST['amount_type'] ?? '')."' ORDER BY `other_fees`.`ID` ASC");
}else{
$fees_data_query = $db->query("SELECT * FROM other_fees WHERE date>='".($_POST['from_date'] ?? '')."' AND date <='".($_POST['to_date'] ?? '')."' ORDER BY `other_fees`.`ID` ASC");

}
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
Bus Collection Report</h3>
</div>


<div class="panel-body">
<form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post">
<div class="form-group row">
     <div class="col-xl-4"><b>From Date</b></div>
   <div class="col-xl-4"><b>
To date</b></div>
   <div class="col-xl-4"><b>Payment</b></div>
</div>
<div class="form-group row">
     <div class="col-xl-4"><input type="date" name="from_date" id="" class="form-control" value="<?php echo (($_POST['from_date'] ?? ''))?($_POST['from_date'] ?? ''):date('Y-m-d'); ?>"></div>
     <div class="col-xl-4"><input type="date" name="to_date" id="" class="form-control" value="<?php echo (($_POST['to_date'] ?? ''))?($_POST['to_date'] ?? ''):date('Y-m-d'); ?>"></div>
  <div class="col-xl-4"><select name="amount_type" class="form-control" ><option value="">All</option>
   <option value="Cash">Cash</option>
   <option value="Cheque">Cheque</option>
   <option value="DD">DD</option>
   <option value="NEFT">NEFT</option><option value="UPI">UPI</option></select></div>
    </div>
   
  <br>
  <div class="form-group row">
     
<!--   <div class="col-xl-6"><b>-->
<!--program</b></div>-->
  </div>
  <div class="form-group row">
<!--     <div class="col-xl-6"><select name="program"  class="form-control" id="program">-->
            
<!--            <option value="">-----SELECT-----</option>-->
<!--            	?php-->
<!--            	 $query3 = $db->query("SELECT * FROM class ORDER BY class_id "); -->
<!--            	foreach ($query3->getResult() as $row3) {-->
<!--    $s=$row3->class_id;-->

<!--?>-->
<!--            <option value="?php echo $row3->class_id;?>"?php if($_POST['program']==$s){ ?> selected ?php } ?>>?php echo $row3->class;?></option>-->
<!--            ?php } ?></select></div>-->
   
  
    </div>
   
  <br>
<div class="form-group row">

   <div class="col-xl-4"><input type="submit" name="Submit" class="btn btn-primary col-xl-4" id="searchBtn" value="View"></div>

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
if((isset($_POST['Submit']))&&($_POST['Submit']=='View')){
    ?>

<div class="col-xl-12" >

<div class="panel panel-inverse">

<div class="panel-heading">
<h4 class="panel-title" id="heading_title">
Bus Collection Report
</h4>
</div>

<div class="panel-body">
<table id="data-table-buttons" class="table table-striped table-bordered align-middle w-100 text-nowrap">
<thead>
<tr>
<th class="text-nowrap">Action</th>
<th class="text-nowrap">Sr No</th>
<th class="text-nowrap">Rec No</th>
<th class="text-nowrap">Date</th>
<th class="text-nowrap">Section</th>
<th class="text-nowrap">Name</th>
<th class="text-nowrap">Class / Sem</th>
<th class="text-nowrap">Category</th>
<th class="text-nowrap">Paid Type</th>
<th class="text-nowrap">Total Amount</th>
</tr>
</thead>
<tbody>
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
		
					
	<td><a href="delete_bus_fees/<?php echo $fees_data->ID; ?>" onclick="return delete_confirm();" class="btn btn-xs btn-warning"  alt='Delete record'><i class="fa fa-trash" style="font-size:15px;color:red;"></i>	</a> /
<a href="#" onClick="window.open('fees_report/print_other_slip?action=preview&id=<?php echo $fees_data->ID; ?>','','menubar=no,width=990px,height=550px,scrollbars=yes,toolbar=no,titlebar=no,status=no,minimize=false');"  alt='Admission Fee View' title="Admission Fee View" ><i class="fa fa-circle-info" style="font-size:20px;"></i></a>
	</a></td>
				
				  <td width="74" style="white-space:nowrap;"><?php echo $count;?></td>
				  <td style="white-space:nowrap;"><?php echo $fees_data->ID;?></td>
				  <td width="188" align="center" style="white-space:nowrap;"><?php
				  $originalDate = $fees_data->Date;
echo $newDate = date("d-m-Y", strtotime($originalDate));
				//   echo $general->date_format($fees_data['date']);
				  ?></td>
				   <td style="white-space:nowrap;"><?php echo $student_detail->section;?></td>
				  <td width="204" style="white-space:nowrap;"><?php echo $student_detail->salutation.' '.$student_detail->first_name.' '.$student_detail->middle_name.' '.$student_detail->last_name;?></td>
                  <td style="white-space:nowrap;"><?php echo $class3->class.'&nbsp;<b>-</b>&nbsp;'.$student_detail->semister;?></td>
                  <td style="white-space:nowrap;"><?php echo $student_detail->category;?></td>
				  
				  <td style="white-space:nowrap;"><?php echo $fees_data->paid_type;?></td>	
				  <td width="167" align="" style="white-space:nowrap;"><?= $total_amounts
				  
				  
				  ?></td>
	 		 </tr>
			 <?php
			 }
			 ?>
			 </tbody>
			 <tfoot>
			     
			     <tr>
			         	<td colspan="9"></td>
				<td align="center"><?php echo  $total_amount;?></td>
			     </tr>
			 </tfoot>

</table><br>
    <div class="form-group row d-none">
    <div class="col-xl-5"> <b>Chairmen Sir : </b> &nbsp;<input type="text" value="9552668585"  class="form-control" readonly></div>
    <div class="col-xl-5"> <b>Messege: </b> &nbsp;<input type="text"  class="form-control" value="Today's Fees Collection is" ></div>
    <div class="col-xl-2 mt-3" > <button type="submit" class="btn btn-warning" >Send</button></div>
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

