<?= $this->extend('layout/tempmain') ?>


<?= $this->section('links') ?>
<?= $this->endSection('links') ?>

<?= $this->section('content') ?>
<?php

if((isset($_POST['Submit']))&&($_POST['Submit']=='View')){
echo ($_POST['amount_type'] ?? '');
$db  = \Config\Database::connect();
if(!empty($_POST['amount_type'])){
    
    // echo "SELECT * FROM fees_collection WHERE date>='".$_POST['from_date']."' AND date <='".$_POST['to_date']."' AND amount_type='".$_POST['amount_type']."' ORDER BY `fees_collection`.`ID` ASC";
$fees_data_query = $db->query("SELECT * FROM fees_collection WHERE date>='".($_POST['from_date'] ?? '')."' AND date <='".($_POST['to_date'] ?? '')."' AND amount_type='".($_POST['amount_type'] ?? '')."' ORDER BY `fees_collection`.`ID` ASC");
}else{
    // echo "SELECT * FROM fees_collection WHERE date>='".$_POST['from_date']."' AND date <='".$_POST['to_date']."' ORDER BY `fees_collection`.`ID` ASC";
$fees_data_query = $db->query("SELECT * FROM fees_collection WHERE date>='".($_POST['from_date'] ?? '')."' AND date <='".($_POST['to_date'] ?? '')."' ORDER BY `fees_collection`.`ID` ASC");

}

}
?>
<style>
#show{
    display:block !important;
}
    a  {
  text-decoration: none;
}
@media print {
    .footer {
        visibility: visible; /* Ensure footer is visible */
        opacity: 1; /* Ensure footer is fully opaque */
    }
}

</style>
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
Daily Collection Report</h3>
</div>


<div class="panel-body">
<form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post">
<div class="form-group row">
     <div class="col-xl-4"><b>From Date</b></div>
   <div class="col-xl-4"><b>
To date</b></div>
   <div class="col-xl-4"><b>
Payment</b></div>
</div>
<div class="form-group row">
     <div class="col-xl-4"><input type="date" name="from_date" id="" class="form-control" value="<?php echo !empty($_POST['from_date']) ? $_POST['from_date'] : date('Y-m-d'); ?>"></div>
     <div class="col-xl-4"><input type="date" name="to_date" id="" class="form-control" value="<?php echo !empty($_POST['to_date']) ? $_POST['to_date'] : date('Y-m-d'); ?>"></div>
   <div class="col-xl-4"><select name="amount_type" class="form-control" ><option value="">All</option>
   <option value="Cash" >Cash</option>
   <option value="Cheque">Cheque</option>
   <option value="DD">DD</option>
   <option value="NEFT">NEFT</option><option value="UPI">UPI</option></select></div>
  
    </div>
   
  <br>
<div class="form-group row">

   <div class="col-xl-4"><input type="submit" name="Submit" class="btn btn-primary col-xl-4" id="searchBtn" value="View">

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
Daily Collection Report</h4>
</div>

<div class="panel-body">
<table id="data-table-buttons" class="table table-striped table-bordered align-middle w-100 text-nowrap">
<thead>
<tr>
<th class="text-nowrap">Action</th>
<th class="text-nowrap">Sr No</th>
<th class="text-nowrap">Rec No</th>
<th class="text-nowrap">Date</th>

<th >Name</th>
<th class="text-nowrap">Class / Sem</th>
<th class="text-nowrap">Category</th>
<th class="text-nowrap">Paid Type</th>
<!--<th class="text-nowrap">Development Fees</th>-->
<th class="text-nowrap">Total Amount</th>
</tr>
</thead>
<tbody>
 <?php
			 $count=0;
			 $total_amount=0;
			 $development_fee = 0;
			 foreach ($fees_data_query->getResult() as  $fees_data){
			   $reg_no= $fees_data->reg_no;
			 $fees_detail_query = $db->query("SELECT * FROM student_admission_information WHERE reg_no='$reg_no'");
		 foreach ($fees_detail_query->getResult() as $student_detail) {
		 }
			$count++;
// 			 $data_query  = $db->query("SELECT * FROM  fees_collection_detail WHERE fee_id='".$fees_data->ID."'");
		
// $total_amount1=0;
// 	 foreach ($data_query->getResult() as $data) {
// 	     	$total_amount = $total_amount +$data->amount;
// 	$total_amount1 = $total_amount1 +$data->amount;
// 	}

$data_query = $db->query("
    SELECT 
        fcd.amount,
        fc.component
    FROM fees_collection_detail fcd
    LEFT JOIN fee_components fc 
        ON fc.fee_component_id = fcd.fee_component_id
    WHERE fcd.fee_id = '".$fees_data->ID."'
");

$total_amount1 = 0;
$development_fees = 0;

foreach ($data_query->getResult() as $data) {

    // Total Amount
    $total_amount += $data->amount;
    $total_amount1 += $data->amount;

    // Development Fees
    if (trim($data->component) == 'Development Fees') {
        $development_fees += $data->amount;
         $development_fee += $data->amount;
    }
}
	$class = $db->query("SELECT * FROM class WHERE class_id='".$student_detail->program."' "); 
                                    // $query   = $builder->get(); 
                                    foreach ($class->getResult() as $class3) { }
			 ?>
		
					
	<td><?php if (!empty($canDeleteFees)): ?><a href="delete_fees/<?php echo $fees_data->ID; ?>" onclick="return delete_confirm();" class="btn btn-xs btn-warning" alt="Delete record"><i class="fa fa-trash" style="font-size:15px;color:red;"></i></a> / <?php endif; ?>
<a href="#" onClick="window.open('fees_report/print_slip?action=preview&id=<?php echo $fees_data->ID; ?>','','menubar=no,width=990px,height=550px,scrollbars=yes,toolbar=no,titlebar=no,status=no,minimize=false');"  alt='Admission Fee View' title="Admission Fee View" ><i class="fa fa-circle-info" style="font-size:20px;"></i></a>
	</a></td>
				
				  <td width="74" style="white-space:nowrap;"><?php echo $count;?></td>
				  <td style="white-space:nowrap;"><?php echo $fees_data->ID;?></td>
				  <td width="188" align="center" style="white-space:nowrap;"><?php
				  $originalDate = $fees_data->date;
echo $newDate = date("d-m-Y", strtotime($originalDate));
				//   echo $general->date_format($fees_data['date']);
				  ?></td>
				   
				  <td style="word-wrap:normal;width:50px;white-space: pre;"><?php echo $student_detail->salutation.' '.$student_detail->first_name.' '.$student_detail->middle_name.' '.$student_detail->last_name;?></td>
                  <td style="white-space:nowrap;"><?php echo $class3->class.'&nbsp;<b>-</b>&nbsp;'.$student_detail->semister;?></td>
                  <td style="white-space:nowrap;"><?php echo $student_detail->category;?></td>
				  
				  <td style="white-space:nowrap;"><?php echo $fees_data->amount_type;?></td>
				  <!--<td style="white-space:nowrap;"><?= $development_fees ?></td>-->
				  <td width="167" align="right" style="white-space:nowrap;"><?= $total_amount1
				  
				  
				  ?></td>
	 		 </tr>
			 <?php
			 }
			 ?>
			 <!--<tr>-->
			 <!--        	<td colspan="8" align="right" style="text-align:right;"><b>Total Amount</b></td>-->
				<!--<td align="right" style="text-align:right;"><b><?php echo  $total_amount;?></b></td>-->
			 <!--    </tr>-->
			 </tbody>
			  
			 <!--<tfoot>-->
			     
			 <!--    <tr>-->
			 <!--        	<td colspan="6" align="right" style="text-align:left;"></td>-->
			 <!--        	<td colspan="" align="right" style="text-align:right;"><b>Total Amount: </b></td>-->
    <!--    				<td align="right" style="text-align:right;" id="show1"><b><?= $development_fees ?></b></td>-->
			         	<!--<td colspan="" align="right" style="text-align:right;"><b>Total Amount: <?php #echo  $total_amount;?></b></td>-->
    <!--    				<td align="right" style="text-align:right;" id="show1"><b><?php echo  $total_amount;?></b></td>-->
			 <!--    </tr>-->
			 <!--</tfoot>-->
			 
			    <tfoot>
                    <tr>
                        <td colspan="7" align="right" style="text-align:left;"></td>
                        <td align="right" style="text-align:right;"><b>Total Amount: </b></td>
                        <!--<td align="right" style="text-align:left;" id="show1"><b><?= $development_fees ?></b></td>-->
                        <td align="right" style="text-align:right;" id="show1"><b><?php echo $total_amount; ?></b></td>
                    </tr>
                </tfoot>

</table>
</div>


</div>

</div>

</div>

</div>
<?php } ?>


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

  getObject('enquiry_no').value = x.value;
}

</script>
<?= $this->endSection() ?>

