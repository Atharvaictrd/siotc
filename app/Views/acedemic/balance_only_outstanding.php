<?= $this->extend('layout/tempmain') ?>

<?= $this->section('links') ?>
<?= $this->endSection('links') ?>

<?= $this->section('content') ?>
<?php
 $db  = \Config\Database::connect();
 $class_query = $db->query("SELECT * FROM class ORDER BY class_id ASC");
 $prpgram_sem_query = $db->query("SELECT * FROM program_sem ORDER BY program_sem_id ASC");
 $student_category_query = $db->query("SELECT * FROM student_category ORDER BY category_id ASC");
$fee_search_key=array();

$fee_search_key[] = 'active_status =0';

if(!empty($_POST['class_program'])){
$fee_search_key[]="class = '".($_POST['class_program'] ?? '')."'";
}


if(!empty($_POST['semister'])){
$fee_search_key[]="semister = '".($_POST['semister'] ?? '')."'";
}

if(!empty($_POST['session'])){
$fee_search_key[]="session_year = '".($_POST['session'] ?? '')."'";
}

if(!empty($_POST['category'])){
$fee_search_key[]="category = '".($_POST['category'] ?? '')."'";
}

if(!empty($_POST['section'])){
$fee_search_key[]="section = '".($_POST['section'] ?? '')."'";
}

if(!empty($fee_search_key)){
 $key= ' WHERE ('.implode(' AND ',$fee_search_key).') ';
 $_SESSION['search'] = $key;
}


if (!isset($key)) {
    $key = '';
}
 $stud_query = false;
if(isset($_POST['search'])){
 $stud_query = $db->query("SELECT * FROM `student_admission_information` $key");
}else{
    // $stud_query = $db->query("SELECT * FROM `student_admission_information`");
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
<h3 class="panel-title">	
 Balance On Student (ONLY OUTSTANDING) NEW</h3>
</div>


<div class="panel-body">
<form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post">
<div class="form-group row">
    <div class="col-md-3">
        <label><b>Class</b><span class="text-danger"></span></label>
        <select class="form-control" name="class_program">
            <option value="">--Class--</option>
            <?php
            foreach ($class_query->getResult() as $class_row) {
                ?>
                <option value="<?=$class_row->class;?>"><?=$class_row->class;?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <div class="col-md-2">
        <label><b>Semester</b><span class="text-danger"></span></label>
        <select class="form-control" name="semister">
            <option value="">--Semester--</option>
            <?php
            foreach ($prpgram_sem_query->getResult() as $program_sem_row) {
                ?>
                <option value="<?=$program_sem_row->program_sem;?>"><?=$program_sem_row->program_sem;?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <div class="col-md-2">
        <label><b>Session</b><span class="text-danger"></span></label>
        <select class="form-control" name="session" id="dropdownYear">
     <option value="<?= $_SESSION['session_year']; ?>" selected><?= $_SESSION['session_year']; ?></option>
    
</select>
    </div>
  <div class="col-md-2">
        <label><b>Section</b><span class="text-danger"></span></label>
      <select name="section" id="section" class="form-control" >
        <option value="">--Select Section--</option>
      <option value="1"<?php if (($_POST['section'] ?? '') == '1') { ?> selected <?php } ?>>Section A</option>
    <option value="2"<?php if (($_POST['section'] ?? '') == '2') { ?> selected <?php } ?>>Section B</option>
      </select></div>
     <div class="col-md-3">
         <label><b>Category</b><span class="text-danger"></span></label>
         <select name="category" id="category" class="form-control" >
       
            
           
    </select></div>
    
     
    </div>
  <br>


<div class="form-group row">
<label class="col-lg-4 col-form-label form-label">&nbsp;</label>
<div class="col-lg-6">
<button type="submit" name="search" class="btn btn-primary col-xl-4">Search</button>
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
<h4 class="panel-title">
Student Balance Report  (ONLY OUTSTANDING) </h4>
</div>

<div class="panel-body">
  <div id="mydiv" style="overflow-x: auto;">
      <table  width="100%">
          <?php
          if($stud_query== true){
          ?>
        <tr>
        <td>
		 <table  width="100%" class="table-bordered"  border="1" style="border-collapse:collapse;border-color:#000000; font-family:Tahoma, Geneva, sans-serif;" align="center" cellpadding="1" cellspacing="0" >
		  <tr>
           
            <td align="center" colspan="9"><h2>STUDENT BALANCE REPORT</h2>
            <h2><?php echo ($_POST['class_program'] ?? '');echo '&nbsp;&nbsp;&nbsp;'; echo ($_POST['semister'] ?? '');echo '&nbsp;&nbsp;&nbsp;'; echo ($_POST['category'] ?? ''); ?></h2>
            <h4>SESSION YEAR : <?php echo ($_POST['session'] ?? ''); ?></h4> </td>
             
           </tr>
            <tr>
           
            <td align="center" colspan="9">Printed Date : <b><?php echo date('d/m/Y'); echo '&nbsp;&nbsp;'; //echo date('H:i:s'); ?></b></td>
             
           </tr>
				  <tr height="25">
                    <td width="7%" style="white-space:nowrap;"><b>Sr No.</b></td>
					<td width="25%" style="white-space:nowrap;"><b>Name</b></td>
                    <td width="9%" style="white-space:nowrap;"><b>Category</b></td>
                    <td width="9%" style="white-space:nowrap;"><b>Reference</b></td>           
                    <td align="center"><b>Total Fees</b></td>
                    <td align="center"><b>Paid</b></td>
                    <td align="center"><b>Management Consession</b></td>
                    <td align="center"><b>ScholorShip</b></td>
				    <td width="12%" align="center" style="white-space:nowrap;"><b>Outstanding Amount</b></td>
				 </tr>
             <?php
              $sr = 1;
			 $count=0;
			 $total_consession = 0;
			 $component = ($_POST['component_name'] ?? '');
			 $total_amount=0;
			 $total_outstanding=0;
			 $sub_total_paid=0;
			  $total_amount_component = 0;
			 $total_actual_scholarship=0;
			 $total_rec_scholarship=0;
              $paid_scholarship = 0;
			  foreach ($stud_query->getResult() as $stud_query_row) {
			      
			     
            $fees_detail_query = $db->query("SELECT * FROM student_admission_fee WHERE student_admission_id ='$stud_query_row->student_admission_id'");
              foreach ($fees_detail_query->getResult() as $fees_row) {
                  $fees_data = explode(';',$fees_row->fee_component_id);
				$Actual_Amount=0;
				$paid_Amount1=0;
				foreach($fees_data as $key=>$value){
				if(!empty($value)){
				list($component,$amount)=explode('_',$value);
				
				$Actual_Amount= $Actual_Amount+$amount;
				
				// $fees_collection_detail_query = $db->query("SELECT * FROM fees_collection_detail WHERE student_admission_id ='$stud_query_row->student_admission_id' AND reg_no ='$stud_query_row->reg_no' AND fee_component_id='$component'");
    //           foreach ($fees_collection_detail_query->getResult() as $collection_detail_row) {
    //               $total_amount = $total_amount + $collection_detail_row->amount;
    //           }
				$data_query  = $db->query("SELECT * FROM  fees_collection_detail WHERE student_admission_id='".$stud_query_row->student_admission_id."' AND reg_no='".$stud_query_row->reg_no."' AND fee_component_id='".$component."'");
        
    // $total_amount = 0;
     foreach ($data_query->getResult() as $data) {
    $paid_Amount1 = $paid_Amount1 +$data->amount;
    }
    
				// $paid_Amount1 = $paid_Amount1+(paid_fees_collection($stud_query_row->student_admission_id,$stud_query_row->reg_no,$component));
				}
				$count++;
              }
              
              }
              $con_amt = 0;
              $sch_amt = 0;
$sql = $db->query("select * from management_consession where reg_no = '".$stud_query_row->reg_no."' and session_year='".($_POST['session'] ?? '')."'");
 foreach($sql->getResult() as $d)
	{
		$con_amt =  $d->consession_amount;
	
	 }
              
             ?>
			 
			 <tr height="25">
			     <?php 
			     //echo $total_fees1=$fees_detail_data['student_add_fee_id']; echo '#'; 
			     ?>
				 <td width="5px" style="white-space:nowrap;"><?=$sr++;?></td>
				
				 <td width="15%" style="white-space:nowrap;"><?=$stud_query_row->first_name;?> <?=$stud_query_row->middle_name;?> <?=$stud_query_row->last_name;?></td>
                <td style="white-space:nowrap;"><?=$stud_query_row->category;?></td>
                <td><?php echo $stud_query_row->reference_details?:'Not Specified'; ?> </td>
                 <td align="center">
                    <?php
                    $total_fees=$fees_row->total_amount;
					echo number_format($total_fees,2);
				    $total_amount = $total_amount+$total_fees;
                    ?> 
                    </td>
				  <td width="12%" align="center" style="white-space:nowrap;">
				      <?php   
				  echo number_format($paid_Amount1,2);
				  $sub_total_paid = $sub_total_paid +  $paid_Amount1;
				 
				  ?>
				  </td>
				  <td align="center"><?php echo number_format($con_amt,2); ?>  </td>
                    <td align="center">  
                    	<?php 
					//$sch_amt =  _scholorShip($student_detail['category'],$_POST['sem'],$_POST['session']);
					$fees_detail_query1 =  $db->query("SELECT * FROM student_admission_fee WHERE student_admission_id='".$stud_query_row->student_admission_id."' and session = '".$_SESSION['session_year']."' ");
						foreach($fees_detail_query1->getResult() as $fees_detail_query){
					    
					}
        			$fees_data = explode(';',$fees_detail_query->fee_component_id);
        	            $count=0;
        				$Actual_Amount=0;
        				$paid_Amount=0;
        				foreach($fees_data as $key=>$value){
        				$count++;
        				if(!empty($value))
            			  {
            				
            				list($component,$amount)=explode('_',$value);
            				// echo $component;
            				$fees_detail_query3 = $db->query("SELECT * FROM fee_components WHERE fee_component_id='$component' and session = '".$_SESSION['session_year']."'  ");
		 foreach ($fees_detail_query3->getResult() as $cmpName) {
		 }
            				$cmpid=$cmpName->fee_component_id;
            			$cname=$cmpName->component;
            				if($cname=='Scholarship'|| $cname=='scholarship')
                    		{
                    			 $sch_amt=$amount;
                    		}
            			 }
        				}
					
					
					echo number_format($sch_amt,2);
					 ?>
				</td>
				
				  <td align="center">
				      <?php 
				 
					  $total_balance = $total_fees-$paid_Amount1 - $con_amt - $sch_amt;
				   $total_consession = $total_consession + $con_amt;
				   $actual_total_bal = $total_balance;
				   //$sub_total_paid = $actual_total_bal;
				   $total_outstanding += $actual_total_bal;
				   			 
				   if($actual_total_bal == 0){
					   echo '<b><font color="#FF1717">No Dues</font></b>';

				   continue;
				   }
				   if($actual_total_bal<0){
						echo number_format($actual_total_bal,2);
					   }else{ 
				   echo  number_format($actual_total_bal,2);
					   }  ?>
				 </td>
	 		 </tr>
	 		 <?php
			  }
	 		 ?>
			 
			 <?php
			 
			 $total_actual_scholarship = $total_actual_scholarship+$stud_query_row->actual_scholarship;
			 $total_rec_scholarship=$total_rec_scholarship+$paid_scholarship;
			 
			 ?>
			 <tr>
			 	<td colspan="4">GRAND TOTAL</td>
				<td align="center"><h3><b><?php echo  number_format($total_amount,2);?></b></h3></td>
    
				<td align="center"><h3><b><?php echo  number_format($sub_total_paid,2);?></b></h3></td>
               
				<td align="center"><h3><b><?php echo  number_format($total_consession, 2);?></b></h3></td>
				 <td align="center">&nbsp;</td>
				<td align="center"><h3><b><?php  
				echo number_format($total_outstanding,2);
				?></b></h3></td>
			 </tr>
			 <tr>
			 	<td colspan="9"></td>
              
              
				<td align="right"></td>
			 </tr>
			 </table>
			</td>
		</tr>
		<?php
          }else{
		?>
		
		<tr>
			<td>Record Not Found...</td>
		</tr>
		<?php
          }
		?>
       </table>
       </div>
       <center>  <input type="button" value="Print" class="Print btn btn-warning mt-3" onclick="PrintElem('#mydiv')" /> </center>
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
<script type="text/javascript">

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'scrollbars=1,height=400,width=600');
        mywindow.document.write('<html><head><title>my div</title>');
      mywindow.document.write('<link rel="stylesheet" href="stylesheet.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
       

        return true;
    }

</script>
<?= $this->endSection() ?>

