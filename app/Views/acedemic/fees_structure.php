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


// 	if(isset($_POST['section']))
// 	{
// 		for($i=1;$i<=$_POST['count'];$i++)
// 		{
// 		     $student_admission_id  =  $_POST["student_admission_id_".$i];
// 		     $status = $_POST["status_".$i];
//             $update_status = $db->query("UPDATE `student_admission_information` SET `Status_Distribution`='$status' WHERE student_admission_id = '$student_admission_id'");
//     // 		echo "<script>alert('$student_admission_id')</script>";
// 		}
// 		if($update_status){
// 		    echo '<script language="javascript">alert("Students are Categorised..... as regular or orregular..");</script>';
// 		    echo "<meta http-equiv='refresh' content='0'>";
// 		}
// 	}
if(isset($_POST['Submit_data']) && $_POST['Submit_data'] == 'Save information' && !empty($canAddFeesStructure))
{

	  
	 
                $fee_com_id = '';
 foreach($_POST as $key=>$value){
			if(substr($key,'-50','12')=='(fee_amount)'){
			list($a,$b) = explode('(fee_amount)',$key);
			$am=$value;
			$fee_com_id = $fee_com_id.$b.'_'.$am.';';
			}
 }
 $v="update student_admission_fee set  fee_component_id  = '".$fee_com_id."' , total_amount = '".($_POST['fees_sub_total'] ?? '')."' where student_add_fee_id = '".($_POST['ids'] ?? '')."'";
$sql=  $db->query("update student_admission_fee set  fee_component_id  = '".$fee_com_id."' , total_amount = '".($_POST['fees_sub_total'] ?? '')."' where student_add_fee_id = '".($_POST['ids'] ?? '')."'");
                 ?>
                 
                 
                 <script language="javascript">alert("Student Name  : <?php echo ($_POST['name'] ?? ''); ?>, Their Fees Structure Changed Sucsessfully. Now His Total Fees is <?php echo ($_POST['fees_sub_total'] ?? ''); ?> ");</script>
                 <!--<script language="javascript">window.location.href="<?php echo $_SERVER['PHP_SELF']; ?>";</script>-->



       
                 <?php
			
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
<?php
        if (!empty(session()->getFlashdata('success'))){?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success'); ?>
                
            </div>
        <?php
        }
        ?>
<div class="panel-heading">
<h3 class="panel-title">	
Student Fees Structure Change</h3>
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
    <div class="col-xl-4">
        <input list="search_enquiry_name1" name="search_enquiry_name" id="search_enquiry_name" class="form-control col-sm-5" onChange="myFunction()" autocomplete="off">
                                              <datalist id="search_enquiry_name1">
                                                  <?php
                                                 $db  = \Config\Database::connect();
                                                   $query1= $db->query("SELECT * FROM student_admission_information WHERE active_status='0' ORDER BY student_admission_id ASC");
                                                foreach ($query1->getResult() as $row1) {

                                                     echo ' <option value="'.$row1->reg_no.'">'.$row1->salutation." . ".$row1->first_name." ".$row1->last_name.'</option>';
                                                  }
                                                  ?>
                                              </datalist>  
        
        <!--<select name="search_enquiry_name" id="search_enquiry_name" class="form-control col-sm-5 chosen-select" onChange="myFunction()" autocomplete="off">-->
        <!--                                      <option>--Select--</option>-->
        <!--                                          ?php-->
        <!--                                         $db  = \Config\Database::connect();-->
        <!--                                                            $query1= $db->query("SELECT * FROM student_admission_information WHERE active_status='0' ORDER BY student_admission_id ASC"); -->
        <!--                                        foreach ($query1->getResult() as $row1) {-->

        <!--                                             echo ' <option value="'.$row1->reg_no.'">'.$row1->salutation." . ".$row1->first_name." ".$row1->last_name.'</option>';-->
        <!--                                          }-->
        <!--                                          ?>-->
        <!--                                      </select>-->
                                              </div>
    <div class="col-xl-4"> <input type="text" class="form-control" name="reg_no" id="reg_no" required></div>
    <div class="col-xl-4"><input type="date" class="form-control" name="date" id="date"></div>
</div>
<br>

<div class="form-group row">
<label class="col-lg-4 col-form-label form-label">&nbsp;</label>
<div class="col-lg-6">

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
<?php if(isset($_POST['search']) && $_POST['search']=='View'){ 
    // print_r($stud_query);
     if($stud_query && $stud_query->getNumRows() > 0){
        $fees_collection = $stud_query->getRow();
?>

<div class="col-xl-12" >

<div class="panel panel-inverse">

<div class="panel-heading">
<h4 class="panel-title">Student Fees Structure Change</h4>
</div>

<div class="panel-body">
    <table  style="padding:25px;">
        <tr style="padding:25px;">
    <th style="margin-left:100px;padding:10px 25px;"><b>Name &nbsp;&nbsp;</th><th> : </th><th>&nbsp;&nbsp;<span style="font-size:20px;color:#700309"> <?=  $fees_collection->salutation.'.'.$fees_collection->first_name.' '.$fees_collection->middle_name.' '.$fees_collection->last_name;?></span></b></th>
    </tr>
    <tr style="padding:25px;">
    <th style="margin-left:100px;padding:10px 25px;"><b>Program &nbsp;&nbsp;</th><th> : </th><th>&nbsp;&nbsp;<?=  $fees_collection->class ?></b></th></tr>
    <tr style="padding:25px;">
    <th style="margin-left:100px;padding:10px 25px;"><b>Session &nbsp;&nbsp;</th><th> : </th><th>&nbsp;&nbsp;<?=  $fees_collection->session_year; ?></b></th></tr>
    <tr style="padding:25px;">
    <th style="margin-left:100px;padding:10px 25px;"><b>Semester &nbsp;&nbsp;</th><th> : </th><th>&nbsp;&nbsp;<?=  $fees_collection->semister; ?></b></th></tr>
    <tr><th style="margin-left:100px;padding:10px 25px;"><b>Student Id &nbsp;&nbsp;</th><th> : </th><th>&nbsp;&nbsp;<?=  $fees_collection->reg_no; ?></b></th>
    </tr>
    </table>
    <form name="fee_assign" action="<?=base_url();?>fees_report/change_fee_structure/<?=  $fees_collection->student_admission_id; ?>" method="post" />
   
<table id="data-table-buttons" class="table table-striped table-bordered align-middle w-100 text-nowrap">
<thead>
<tr>



<th class="text-nowrap">Sr. No</th>
<th class="text-nowrap"> Particulars</th>
<th class="text-nowrap">Amount Rs.</th>
</tr>
</thead>
<tbody>
    <?php 	$fees_detail_query = $db->query("SELECT * FROM student_admission_fee WHERE student_admission_id='".$fees_collection->student_admission_id."' and session = '".$fees_collection->session_year."' order by fee_component_id ASC");
		 foreach ($fees_detail_query->getResult() as $row2) {
		 }

	$fees_data = explode(';',$row2->fee_component_id);
			$student_id=$fees_collection->student_admission_id;
			$reg_no=$fees_collection->reg_no;
				$count=0;
				$Actual_Amount=0;
				$paid_Amount=0;
				foreach($fees_data as $key=>$value){
				   
				$count++;
				if(!empty($value)){
				
				list($component,$amount)=explode('_',$value);
				
				$Actual_Amount= $Actual_Amount+$amount;
			
					$fees_detail_query3 = $db->query("SELECT * FROM fee_components WHERE fee_component_id='$component' and session = '".$fees_collection->session_year."'  ");
		 foreach ($fees_detail_query3->getResult() as $row3) {
		 }
		 $cmpid=$row3->fee_component_id;
		 $f_com_id=$row3->fee_component_id;
		 	$_POST['fees_sub_total']=$Actual_Amount+$amount;
		 $paid_consession_query = $db->query("SELECT * FROM management_consession WHERE student_admission_id='".$student_id."' AND session_year = '".$fees_collection->session_year."'");
					$consession= 0;
				foreach ($paid_consession_query->getResult() as $paid_consession_data) {
				     $consession = $consession+$paid_consession_data->consession_amount;
					}
				?>
				<tr>
					<td><?php echo $count;?></td>
					
					<td><?php echo $row3->component; ?></td>
					<td align="">
					<?php if (!empty($canAddFeesStructure)): ?>
					<input type="hidden" value="<?php echo $component; ?>" name="comp[]">
					<input type="text" name="amount[<?= $component; ?>]" value = "<?php echo (number_format($amount,2))?$amount:$_POST['(fee_amount)'.$f_com_id];?>" style="text-align:right" onblur="javascript:fee_sub_total1(this);" onkeypress="return AllowNumeric(event)">
					<?php else: ?>
					<?= number_format((float) $amount, 2); ?>
					<?php endif; ?>
					</td>
					</tr>
   <?php } }?>
     <tr>
        <td colspan="2"></td>
         
        	<td colspan="4" align="right">
        	     <input type="hidden" value="<?php echo $fees_collection->salutation.'.'.$fees_collection->first_name.' '.$fees_collection->last_name;?>" name="name" >
        	     <input type="hidden" value="<?php echo $row2->student_add_fee_id?>" name="ids" >
							<b>Sub Total&nbsp;&nbsp;</b><input type="text" name="fees_sub_total" id="fees_sub_total"  value="<?php echo $Actual_Amount;?>" style="text-align:right" readonly > </td>
    </tr>
    <?php if (!empty($canAddFeesStructure)): ?>
    <tr>
		<td align="center"><input type="submit" name="Submit_data" value="Save information" style="height:30px; background-color: #0C6; width:150px; font:'Comic Sans MS', cursive; size:100px; border-radius: 20px;" /></td>
			</tr>
    <?php endif; ?>
</tbody>
</table>
</form>
</div>


<div class="hljs-wrapper">
<pre><code class="html" data-url="<?= base_url('assets/data/table-manage/keytable.json'); ?>"></code></pre>
</div>

</div>

</div>
<?php }else{ echo "data Not Found"; } }?>
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

