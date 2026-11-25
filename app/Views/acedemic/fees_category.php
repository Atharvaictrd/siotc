<?= $this->extend('layout/tempmain') ?>

<?= $this->section('links') ?>
<?= $this->endSection('links') ?>

<?= $this->section('content') ?>
<link href="assets/css/vendor.min.css" rel="stylesheet" />
<link href="assets/css/default/app.min.css" rel="stylesheet" />


<link href="assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link href="assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
<link href="assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" />
<?php
 $db  = \Config\Database::connect();
 $class_query = $db->query("SELECT * FROM class ORDER BY class_id ASC");
 $prpgram_sem_query = $db->query("SELECT * FROM program_sem ORDER BY program_sem_id ASC");
 $student_category_query = $db->query("SELECT * FROM student_category ORDER BY category_id ASC");
$fee_search_key=array();

$fee_search_key[] = 'active_status =0';



if(!empty($_POST['reg_no'])){
$fee_search_key[]="reg_no = '".($_POST['reg_no'] ?? '')."'";
}

if(!empty($_POST['session'])){
$fee_search_key[]="session_year = '".($_POST['session'] ?? '')."'";
}

// if(!empty($_POST['category'])){
// $fee_search_key[]="category = '".$_POST['category']."'";
// }

// if(!empty($_POST['section'])){
// $fee_search_key[]="section = '".$_POST['section']."'";
// }

if(!empty($fee_search_key)){
 $key= ' WHERE ('.implode(' AND ',$fee_search_key).') ';
 $_SESSION['search'] = $key;
}


if (!isset($key)) {
    $key = '';
}
if(isset($_POST['search'])){
 $stud_query = $db->query("SELECT * FROM `student_admission_information` $key");
}else{
    // $stud_query = $db->query("SELECT * FROM `student_admission_information`");
}

if(isset($_POST['Submit_data']) && $_POST['Submit_data'] == 'Save information')
{
    
    $student_name_query = $db->query("SELECT * FROM student_admission_information WHERE reg_no='".($_POST['reg_no'] ?? '')."' AND session_year='".($_POST['session'] ?? '')."' AND  active_status = 0 ");
 foreach ($student_name_query->getResult() as $student_detail) {
		 }

     $actual_fees = ($_POST['Actual_amount'] ?? '');
    $getting_student_id = $db->query("select * from student_admission_information where reg_no = '".($_POST['reg_no'] ?? '')."'");
        foreach ($getting_student_id->getResult() as $row){
          $stu_id = $row->student_admission_id;
         $stu_name = $row->first_name.'  '.$row->last_name;
         $semister = $row->semister;
         $category = $row->category;
     }
          
                    $update_find=$db->query("SELECT *FROM `fees_to_program` WHERE `class` = '".$student_detail->class."' AND `sem` = '".$student_detail->semister."' AND `session` = '".$student_detail->session_year."' AND `category` = '".($_POST['category_change'] ?? '')."'");
                     
						//$fee_com_id = '';
						if(!empty($update_find)){
						$sub_total=0;	 
						 foreach ($update_find->getResult() as $fee_row)
						{
							$sub_total = $sub_total+$fee_row->amount;
							$fee_com_id = $fee_row->fee_type.'_'.$fee_row->amount.';'.$fee_com_id;
						
						}
						}
         
            //  echo "update student_admission_fee set  fee_component_id  = '".$fee_com_id."' , total_amount = '$sub_total' where student_admission_id = $stu_id and session = '".$_POST['session']."'";    										 
$update1 = $db->query("update student_admission_fee set  fee_component_id  = '".$fee_com_id."' , total_amount = '$sub_total' where student_admission_id = $stu_id and session = '".($_POST['session'] ?? '')."'");
    // echo "update student_admission_information set  category  = '".$_POST['category_change']."' where 	reg_no = '".$_POST['reg_no']."'";
	   $update = $db->query("update student_admission_information set  category  = '".($_POST['category_change'] ?? '')."' where 	reg_no = '".($_POST['reg_no'] ?? '')."'");
	  
	   echo '</br>';
             if($update){
                 ?>
                 <script language="javascript">alert("Student Name  : <?php echo $stu_name; ?>, Their Category Changed Sucsessfully. Now His Category <?php echo ($_POST['category_change'] ?? '');?>");</script>
                 <script language="javascript">window.location.href="<?php echo $_SERVER['PHP_SELF']; ?>";</script>



       
                 <?php 
				 }
	}
?>

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
Change Student Category</h3>
</div>


<div class="panel-body">
<form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post">
<div class="form-group row">
   <div class="col-xl-1 offset-xl-2 "><b>
Session</b></div>
   <div class="col-xl-4"><select name="session" onchange="javascript:form_submit();" class=" form-control"  id="dropdownYear" >
         <option value="<?=$_SESSION['session_year']?>" selected><?=$_SESSION['session_year']?></option>
         </select></div>
  <div class="col-xl-2"> <input type="submit" class="form-control btn btn-warning " name="search" id="" value="View"> </div>
</div>

  <br>
<div class="form-group row">
   <div class="col-xl-4"><b>Student Name </b></div>
   <div class="col-xl-4"><b> Student Reg No</b></div>
   <div class="col-xl-4"><b> Date</b></div>

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
    <div class="col-xl-4"> <input type="text" class="form-control" name="reg_no" id="reg_no" value="<?= esc($_POST['reg_no'] ?? '') ?>" required></div>
    <div class="col-xl-4"><input type="date" class="form-control" name="date" id="date" value="<?= esc($_POST['date'] ?? date('Y-m-d')) ?>"></div>
</div>
<br>

<div class="form-group row">
<label class="col-lg-4 col-form-label form-label">&nbsp;</label>
<div class="col-lg-6">

</div>
</div>



</div>


<div class="hljs-wrapper">
<pre><code class="html" data-url="<?= base_url('assets/data/form-validation/code-1.json'); ?>"></code></pre>
</div>

</div>

</div>



</div>

<?php if(isset($_POST['search']) && $_POST['search']=='View'){ 
    // print_r($stud_query);
     if($stud_query== true){
foreach ($stud_query->getResult() as $fees_collection) {
}
?>
<div class="col-xl-12" >

<div class="panel panel-inverse">

<div class="panel-heading">
<h4 class="panel-title">Student Details List</h4>
</div>

<div class="panel-body">
    
      <table  style="padding:25px;">
        <tr style="padding:25px;">
    <th style="margin-left:100px;padding:10px 25px;"><b>Name &nbsp;&nbsp;</th><th> : </th><th>&nbsp;&nbsp;<span style="font-size:20px;color:#700309"><?=  $fees_collection->salutation.'.'.$fees_collection->first_name.' '.$fees_collection->middle_name.' '.$fees_collection->last_name;?></span></b></th>
    </tr>
    <tr style="padding:25px;">
    <th style="margin-left:100px;padding:10px 25px;"><b>Program &nbsp;&nbsp;</th><th> : </th><th>&nbsp;&nbsp;<?=  $fees_collection->class ?> <span style="color:#338248"><?=  $fees_collection->semister ?> </span> <span style="color:red"><?=  $fees_collection->category ?></span> </b></th></tr>
    <tr style="padding:25px;">
    <th style="margin-left:100px;padding:10px 25px;"><b>Session &nbsp;&nbsp;</th><th> : </th><th>&nbsp;&nbsp;<?=  $fees_collection->session_year; ?></b></th></tr><tr>
    <th style="margin-left:100px;padding:10px 25px;"><b>Student Id &nbsp;&nbsp;</th><th> : </th><th>&nbsp;&nbsp;<?=  $fees_collection->reg_no; ?></b></th>
    </tr>
    </table>
<table id="data-table-buttons" class="table table-striped table-bordered align-middle w-100 text-nowrap">
<thead>
<tr>



<th class="text-nowrap">Actual fees</th>
<th class="text-nowrap">Fees Paid</th>
<th class="text-nowrap">Balance Amount</th>
<th class="text-nowrap">Category</th>
<th class="text-nowrap">New Category</th>
</thead>
 <?php 	$fees_detail_query = $db->query("SELECT * FROM student_admission_fee WHERE student_admission_id='".$fees_collection->student_admission_id."' and session = '".$fees_collection->session_year."' order by fee_component_id ASC");
		 foreach ($fees_detail_query->getResult() as $row2) {
		 }
$fees_data = explode(';',$row2->fee_component_id);
			$student_id=$fees_collection->student_admission_id;
			$reg_no=$fees_collection->reg_no;
				$count=0;
				$Actual_Amount=0;
				$paid_Amount=0;
				$total_amount = 0;
				foreach($fees_data as $key=>$value){
				   
				$count++;
				if(!empty($value)){
				
				list($component,$amount)=explode('_',$value);
				$Actual_Amount= $Actual_Amount+$amount;
				// echo $component;
				// $Actual_Amount= $Actual_Amount+$amount;
				
					$fees_detail_query3 = $db->query("SELECT * FROM fee_components WHERE fee_component_id='$component' and session = '".$fees_collection->session_year."'  ");
		 foreach ($fees_detail_query3->getResult() as $row3) {
		     $c=$fees_collection->category;	
		 $cmpid=$row3->fee_component_id;
		 $f_com_id=$row3->fee_component_id;
		 }
		
			$data_query  = $db->query("SELECT * FROM  fees_collection_detail WHERE student_admission_id='".$student_id."' AND reg_no='".$reg_no."' AND fee_component_id='".$component."'");
// 		echo "SELECT * FROM  fees_collection_detail WHERE student_admission_id='".$student_id."' AND reg_no='".$reg_no."' AND fee_component_id='".$component."'";
	
	 foreach ($data_query->getResult() as $data) {
	$total_amount = $total_amount +$data->amount;
	}
				}}
 number_format($total_amount,2);
		$paid_Amount = $paid_Amount+($total_amount);
?>
<tbody>
   	<tr align="center">
				
				<td align="center"><font color="#FF0000" size="+2"><?php echo $actual_fees = number_format(($Actual_Amount+$fees_collection->actual_scholarship),2);?></font><input type="hidden" name="Actual_amount" id="Actual_amount" value="<?php echo $actual_fees; ?>" /></td>
				<td align="center"><font color="#FF0000" size="+2"><?php echo number_format(($paid_Amount+$paid_scholarship),2);?></font></td>
				<td align="center"><font color="#FF0000" size="+2"><?php 
				$toal_bal_amount = $Actual_Amount-$paid_Amount;
				echo number_format((($toal_bal_amount+$balance_scholarship)),2); ?><input type="hidden" name="Balance_amount" id="Balance_amount" value="<?php echo $amt =  $toal_bal_amount+$balance_scholarship; ?>" /></font></td>
						   <td><select name="category" id="category" class="form-control" required>
       
            <option value="<?php echo $c2;?>" selected><?php echo $c2;?></option>
            <?php	 $query1= $db->query("SELECT * FROM student_category ");

	foreach($query1->getResult() as $value1){ ?>
<option value="<?= $value1->category ?>" id="<?= $value1->category ?>" <?php if($value1->category==$c){ ?> selected <?php } ?>><?=$value1->category?></option>
	
<?php } ?></td> 
 <td><select name="category_change" id="category_change" class="form-control" required>
       
            <option value="<?php echo $c2;?>" selected><?php echo $c2;?></option>
            <?php	 $query1= $db->query("SELECT * FROM student_category ");

	foreach($query1->getResult() as $value1){  ?>
<option value="<?= $value1->category ?>" id="<?= $value1->category ?>" <?php if($value1->category==$c){ ?> selected <?php } ?>><?=$value1->category?></option>
	
<?php	} ?></td> 

               		   

                </tr>
			
			<tr>
		<td align="center" colspan="5"><input type="submit" name="Submit_data" value="Save information" style="height:30px; background-color: #0C6; width:150px; font:'Comic Sans MS', cursive; size:100px; border-radius: 20px;" /></td>
			</tr>		
</tbody>
</table></form>
</div>


<div class="hljs-wrapper">
<pre><code class="html" data-url="<?= base_url('assets/data/table-manage/keytable.json'); ?>"></code></pre>
</div>

</div>

</div>

</div>

</div>

<?php   }else{ echo "data Not Found"; } }?>

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
function fee_sub_total(id){
    // alert(1);
var len = document.fee_assign.length;
// alert(len);
var amount =0;
for(var i=0;i<len;i++){
var ele_name = document.fee_assign.elements[i].name;
var sp = ele_name.split(')'); 
if(sp[0]=='(fee_amount'){
amount = amount+Number(document.fee_assign.elements[i].value);
}
}
document.fee_assign.fees_sub_total.value = amount;
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

