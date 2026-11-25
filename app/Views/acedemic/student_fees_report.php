<?= $this->extend('layout/tempmain') ?>

<?= $this->section('links') ?>
<?= $this->endSection('links') ?>

<?= $this->section('content') ?>
<?php
 $db  = \Config\Database::connect();
if((isset($_POST['Submit']))&&($_POST['Submit']=='View')){
//echo $_POST['reg_no'];
// if(!empty($_POST['reg_no'])){
// $reg_no = "reg_no='".$_POST['reg_no']."'";
// }else{
// $reg_no ='';
// }

$fees_data_query = $db->query("SELECT * FROM fees_collection WHERE reg_no = ?", [$_POST['reg_no'] ?? '']);



}
?>
<link href="assets/css/vendor.min.css" rel="stylesheet" />
<link href="assets/css/default/app.min.css" rel="stylesheet" />


<link href="assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link href="assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
<link href="assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" />

<style>
    .fee-report-container {
    width: 100% !important;
    max-width: 100% !important;
    margin: 0 auto !important;
    padding: 20px !important;
    overflow-x: auto;
}

.fee-report-container > table {
    width: 100% !important;
    margin: 0 auto !important;
}

</style>
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
<h3 class="panel-title">	
Student Fees Report</h3>
</div>


<div class="panel-body">
<form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post">

  <div class="form-group row">
     <div class="col-xl-6"><b>Student Name</b></div>
   <div class="col-xl-6"><b>
Student Reg No</b></div>
  </div>
  <div class="form-group row">
     <div class="col-xl-6"><select name="search_enquiry_name" id="search_enquiry_name" class="form-control col-sm-5 chosen-select" onChange="myFunction()" autocomplete="off">
                                              <option>--Select--</option>
                                                  <?php
                                                 $db  = \Config\Database::connect();
                                                                    $query1= $db->query("SELECT * FROM student_admission_information WHERE active_status='0' ORDER BY student_admission_id ASC"); 
                                                foreach ($query1->getResult() as $row1) {

                                                     echo ' <option value="'.$row1->reg_no.'">'.$row1->salutation." . ".$row1->first_name." ".$row1->last_name.'</option>';
                                                  }
                                                  ?>
                                              </select></div>
   <div class="col-xl-6"><input type="text" name="reg_no" id="reg_no" class="form-control" required></div>
  
    </div>
   
  <br>
<div class="form-group row">

   <div class="col-xl-4"><input name="Submit" type="submit" class="btn btn-info" id="View" title="View" value="View" style="text-decoration:none"/></div>

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
    	foreach ($fees_data_query->getResult() as $fees_data){
    	}
 $reg_no= $fees_data->reg_no;
			 $fees_detail_query = $db->query("SELECT * FROM student_admission_information WHERE reg_no='$reg_no'");
		 foreach ($fees_detail_query->getResult() as $student_detail) {
		 }
		  $data_query123  = $db->query("SELECT DISTINCT session_year FROM  fees_collection_detail WHERE reg_no='$reg_no'");
    // echo "SELECT DISTINCT session_year FROM  fees_collection_detail WHERE reg_no='$reg_no'";
	foreach ($data_query123->getResult() as $fees_data456){
	    $ss[]=	$fees_data456->session_year;
	}
?>

<div class="col-xl-12" >

<div class="panel panel-inverse">

<div class="panel-heading">
<h4 class="panel-title">
Student Fees Report List <?php echo $student_detail->session_year; ?></h4>
</div>

<!--<div class="panel-body" id="mydiv">-->
<!--<div class="panel-body" id="mydiv">-->
    <div class="panel-body fee-report-container" id="feeReport">
      <p class="text-center"><b>Student Name : <?php echo $student_detail->salutation.' '.$student_detail->first_name.' '.$student_detail->middle_name.' '.$student_detail->last_name;?></b></p>
    <?php 
    $cc=count($ss);
   for($i=0;$i<$cc;$i++) { 
//   print_r($ss);
   ?>
   <br>
    <p class="text-center">Student Fees Report List <?php echo $ss[$i]; ?></p>
  
 <table  width="100%"  border="1" style="border-collapse:collapse;border-color:#000000; font-size:11px;" align="center" cellpadding="1" cellspacing="0" class="table-bordered">
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
<tbody>
    <?php
   
// print_r($ss);
			 $count=0;
			 $total_amount=0;
			foreach ($fees_data_query->getResult() as $fees_data){
			 
// 	 print_r($fees_data);
			$count++;
			 $data_query  = $db->query("SELECT * FROM  fees_collection_detail WHERE fee_id='".$fees_data->ID."' AND session_year='$ss[$i]'");
			
// 		echo "SELECT * FROM  fees_collection_detail WHERE fee_id='".$fees_data->ID."' AND session_year='$ss[$i]'";
			
// 	$total_amount = 0;
	 foreach ($data_query->getResult() as $data) {
	$total_amount = $total_amount +$data->amount;
// 	}


			 ?>
			 <tr height="25">
				<td>
<a href="#" onClick="window.open('fees_report/print_slip?action=preview&id=<?php echo $fees_data->ID; ?>','','menubar=no,width=990px,height=550px,scrollbars=yes,toolbar=no,titlebar=no,status=no,minimize=false');"  alt='Admission Fee View' title="Admission Fee View" ><i class="fa fa-circle-info" style="font-size:20px;"></i></a>
	</a></td>
				  <td width="5px" style="white-space:nowrap;"><?php echo $count;?></td>
				 <td style="white-space:nowrap;"><?php echo $fees_data->ID;?></td>
				    <td style="white-space:nowrap;"><?php echo $student_detail->class;?></td>
				     <td style="white-space:nowrap;"><?php echo $student_detail->reg_no;?></td>
				  <td width="204" style="white-space:nowrap;"><?php echo $student_detail->salutation.' '.$student_detail->first_name.' '.$student_detail->middle_name.' '.$student_detail->last_name;?></td>
				 <td width="188" align="center" style="white-space:nowrap;"><?php
				  $originalDate = $fees_data->date;
echo $newDate = date("d-m-Y", strtotime($originalDate));
				//   echo $general->date_format($fees_data['date']);
				  ?></td>
				   <td style="white-space:nowrap;"><?php  echo $fees_data->amount_type; ?></td>	
				  <td width="167" align="right" style="white-space:nowrap;"><?= $data->amount;
				  
				  
				  ?></td>
	 		 </tr>
			 <?php
			 $fee_com_detail_query = $db->query("SELECT * FROM fees_collection_detail WHERE fee_id ='".$fees_data->ID."' ORDER BY fee_component_id 	ASC");
			 //echo $fee_com_detail_query->getNumRows();
			 if(($fee_com_detail_query->getNumRows())>0){
			 ?>
			  <tr>
			  <td colspan="3"></td>
			  <td colspan="2" valign="top">
			  <table cellpadding="2" cellspacing="2" width="100%"> 
			  <?php
			   foreach ($fee_com_detail_query->getResult() as $fee_com_detail_data){
			 ?>
			 <tr>
			  <td width="100px">
			  <?php 
					$fees_detail_query3 = $db->query("SELECT * FROM fee_components WHERE fee_component_id='".$fee_com_detail_data->fee_component_id."'");
		 foreach ($fees_detail_query3->getResult() as $row3) {
		 }
		 echo $row3->component;
		 ?>
			  </td>
			  <td> <?php echo $fee_com_detail_data->amount;?></td>
			   <td ></td>
			   
			 </tr>
			 <?php
			 
			 }
			  ?>
			  </table>
			  </td>
			  <td valign="top" colspan="2">
			 <?php if(($fees_data->amount_type=='UPI')){
			  
			  ?>
			  <table cellpadding="2" cellspacing="2" style="white-space:nowrap">
			  	<tr>
					<td><strong> Amount</strong></td>
					<td><?php echo $fees_data->upi_amount;?></td>
					<td></td>
						<td><strong> Date</strong></td>
				<td><?php echo $fees_data->upi_date;?></td>
				</tr>
			
				<tr>
					<td><strong>Name</strong></td>
					<td><?php echo $fees_data->upi_name;?></td>
				
					<td></td>
					<td><strong>UPI ID</strong></td>
					<td><?php echo $fees_data->upi_id;?></td>
					
				</tr>
				
			  </table>
			  
			  <?php
			  
			  }if(($fees_data->amount_type=='Cheque')){
			  $cheque_detail1 = $db->query("SELECT * FROM fee_cheque_detail WHERE fee_id='".$fees_data->ID."'");
			  
			   foreach ($cheque_detail1->getResult() as $cheque_detail){
			   }
			  ?>
			  <table cellpadding="2" cellspacing="2" style="white-space:nowrap">
			  	<tr>
					<td><strong>Cheque Amount</strong></td>
					<td><?php echo $cheque_detail->cheque_amount;?></td>
					<td><strong>Payable to</strong></td>
					<td><?php echo $cheque_detail->payable_to;?></td>
				</tr>
				<tr>
					<td><strong>Cheque No.</strong></td>
					<td><?php echo $cheque_detail->cheque_no;?></td>
					<td><strong>Cheque Date</strong></td>
					<td></td>
				</tr>
				<tr>
					<td><strong>Bank Name</strong></td>
					<td><?php echo $cheque_detail->bank_name;?></td>
					<td><strong>Branch Name</strong></td>
					<td><?php echo $cheque_detail->branch_name;?></td>
				</tr>
				<tr>
					<td><strong>City</strong></td>
					<td><?php echo $cheque_detail->city;?></td>
					<td><strong>State</strong></td>
					<td><?php echo $cheque_detail->state;?></td>
				</tr>
				
			  </table>
			  
			  <?php
			  
			  }else if($fees_data->amount_type=='DD'){
			   $cheque_detail1 = $db->query("SELECT * FROM fee_demand_draft_detail WHERE fee_id='".$fees_data->ID."'");
			    foreach ($cheque_detail1->getResult() as $cheque_detail){
			   }
			   ?>
			  <table cellpadding="2" cellspacing="2" style="white-space:nowrap">
			  	<tr>
					<td><strong>Amount</strong></td>
					<td><?php echo $cheque_detail->demand_draft_amount;?></td>
					<td><strong>Payable to</strong></td>
					<td><?php echo $cheque_detail->payable_to;?></td>
				</tr>
				<tr>
					<td><strong>Cheque No.</strong></td>
					<td><?php echo $cheque_detail->DD_no;?></td>
					<td><strong>Cheque Date</strong></td>
					<td></td>
				</tr>
				<tr>
					<td><strong>Bank Name</strong></td>
					<td><?php echo $cheque_detail->bank_name;?></td>
					<td><strong>Branch Name</strong></td>
					<td><?php echo $cheque_detail->branch_name;?></td>
				</tr>
				<tr>
					<td><strong>City</strong></td>
					<td><?php echo $cheque_detail->city;?></td>
					<td><strong>State</strong></td>
					<td><?php echo $cheque_detail->state;?></td>
				</tr>
				
			  </table>
			  <?php
			  }
			  
			  ?>
			  </td>
			  <td></td>
			    <td ></td>
			 </tr>
			 <?php
			 
			 //}
			  ?>
			 
			 
			  
			 <?php
			 }
			 
	 }
			 }
			 ?>
			 
			 	 
			 	
		
		
</tbody>

<tfoot>
			     
			     <tr>
			         	<td colspan="8"><b>Total</b> </td>
				<td align="right" style="text-align:right;"><b><?php echo  $total_amount;?></b></td>
		
			     </tr>
			 </tfoot>
			 
</table>
<?php } ?>
</div>
<!--<center>  <input type="button" value="Print" class="Print btn btn-warning mt-3" onclick="PrintElem('#mydiv')" /> </center>-->
<center>  <input type="button" value="Print" class="Print btn btn-warning mt-3" onclick="PrintElem('#feeReport')" /> </center>
<?php }?>


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
function select_component_list(id){
    var x = document.getElementById("component_list_data").value ;
 $('#c_name').val(x);
}
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
<script>
    $('#dropdownYear').each(function() {

  var year = (new Date()).getFullYear();
  var current = year;
  year -= 4;
  for (var i = 0; i < 10; i++) {
    if ((year+i) == current)
      $(this).append('<option selected value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) + ' - ' +  (year+1 + i) +'</option>');
    else
      $(this).append('<option value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) +  ' - ' +  (year+1 + i) +'</option>');
  }

})
  function AllowNumeric(e)
{
    isIE=document.all? 1:0
    keyEntry = !isIE? e.which:event.keyCode;
    
        if(!(keyEntry > '65') && (keyEntry <  '102') || (keyEntry > '186')&& (keyEntry < '191')|| (keyEntry > '59')&& (keyEntry < '47'))
            return true;
            else if(keyEntry=='32')
			return false         
	        else
			return false; 
}
</script>
<script type="text/javascript">

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }
    
    function Popup(data)
{
    var mywindow = window.open(
        '',
        'Print Receipt',
        'width=1000,height=700,scrollbars=yes'
    );

    mywindow.document.write(`
        <html>
        <head>
            <title>Student Fees Report</title>

            <link rel="stylesheet"
                  href="<?= base_url('assets/css/vendor.min.css') ?>">

            <link rel="stylesheet"
                  href="<?= base_url('assets/css/default/app.min.css') ?>">

            <style>
                body {
                    background: #fff !important;
                    margin: 0;
                    padding: 20px;
                    font-family: Arial, sans-serif;
                    color: #000;
                }

                .print-wrapper {
                    width: 100%;
                    max-width: 1000px;
                    margin: auto;
                }

                .print-header {
                    text-align: center;
                    margin-bottom: 20px;
                }

                .print-header img {
                    height: auto;
                    margin-bottom: 10px;
                }

                .print-header h2 {
                    margin: 5px 0;
                    font-size: 22px;
                }

                .print-header p {
                    margin: 3px 0;
                    font-size: 13px;
                }

                table {
                    width: 100% !important;
                    border-collapse: collapse !important;
                }

                th,
                td {
                    border: 1px solid #000 !important;
                    padding: 6px !important;
                    font-size: 12px !important;
                }

                th {
                    font-weight: bold !important;
                    text-align: center;
                }

                .Print {
                    display: none !important;
                }

                @media print {

                    body {
                        padding: 0;
                    }

                    .print-wrapper {
                        width: 100%;
                    }

                    @page {
                        size: A4 portrait;
                        margin: 10mm;
                    }
                }
            </style>
        </head>

        <body>

            <div class="print-wrapper">

                <div class="print-header">

                    <img src="<?= base_url('assets/img/somya_tech_logo.png') ?>"
                         alt="Logo">

                    <h2>Student Fees Report</h2>

                    <p>Student Fees Details</p>

                </div>

                ${data}

            </div>

        </body>
        </html>
    `);

    mywindow.document.close();

    mywindow.onload = function() {
        mywindow.focus();
        mywindow.print();
    };

    return true;
}

    // function Popup(data) 
    // {
    //     var mywindow = window.open('', 'my div', 'scrollbars=1,height=400,width=600');
    //     mywindow.document.write('<html><head><title>my div</title>');
    //     mywindow.document.write('<link rel="stylesheet" href="stylesheet.css" type="text/css" />');
    //     mywindow.document.write('</head><body >');
    //     mywindow.document.write(data);
    //     mywindow.document.write('</body></html>');
    //     mywindow.print();
    //     return true;
    // }

</script>
<?= $this->endSection() ?>

