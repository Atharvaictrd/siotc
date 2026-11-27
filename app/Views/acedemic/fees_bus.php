<?= $this->extend('layout/tempmain') ?>

<?= $this->section('links') ?>
<?= $this->endSection('links') ?>

<?= $this->section('content') ?>
<?php
if(isset($_POST['Submit_data']) && $_POST['Submit_data'] == 'Save information' && !empty($canAddBusFeesCollection)){
	$db  = \Config\Database::connect();
	$fees_detail_query = $db->query("SELECT * FROM bus_fees WHERE  reg_no='".($_POST['reg_no1'] ?? '')."' and session = '".($_POST['session1'] ?? '')."'");
	$rows =$fees_detail_query->getNumRows();
		
    $actual_fees = ($_POST['Actual_amount'] ?? '');

	$consession_amount = ($_POST['consession_fee'] ?? '');
	$bal = ($_POST['consession_amount'] ?? '');
	$fees_collection = $consession_amount;
	if($rows ==0 ){
		$qry4 = $db->query("insert into  bus_fees (reg_no,amount,session) values ( '".($_POST['reg_no1'] ?? '')."' ,'".$fees_collection."', '".($_POST['session1'] ?? '')."' ) ");
        if($qry4){
   
	        $success="Bus Fees Consession made Successfully";
		}else{
			echo 'no';
		}
	}else{
	    $qry4=$db->query("UPDATE bus_fees SET amount = '$fees_collection' WHERE  reg_no='".($_POST['reg_no1'] ?? '')."' and session = '".($_POST['session1'] ?? '')."' " );
		 
        if($qry4){
	        $success="Bus Fees Consession made Successfully";
		}else{
			echo 'no';
		} 
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


<div class="row">

<div class="col-xl-12">

<div class="panel panel-inverse" data-sortable-id="form-validation-1">

<div class="panel-heading">
<h3 class="panel-title">	

		
 	
Bus Fees Consession</h3>
</div>


<div class="panel-body">
    <?php if (isset($success)) : ?>
                            <div class="alert alert-success my-5">
                                <h5><?=$success;?></h5>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['error'])) : ?>
                            <div class="alert alert-danger my-5">
                                <h5><?=$_SESSION['error'];?></h5>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($_POST['Submit_data']) && empty($canAddBusFeesCollection)) : ?>
                            <div class="alert alert-danger my-5">
                                <h5>You do not have permission to add bus fee collection.</h5>
                            </div>
                        <?php endif; ?>
<form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post">
<div class="form-group row">
     <div class="col-xl-4"><b>Student Name</b></div>
   <div class="col-xl-4"><b>
Session</b></div>
  
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
                                              </select>
    </div>
    <div class="col-xl-4"><select name="session" onchange="javascript:form_submit();" class=" form-control"  id="dropdownYear" >
           <option value="<?= $_SESSION['session_year']; ?>" selected><?= $_SESSION['session_year']; ?></option>
         </select></div>
  <div class="col-xl-4"><input type="submit" name="submit"  class="btn btn-primary col-xl-4" value="View"></div>
    </div>
   
  <br>
<div class="form-group row">

   <div class="col-xl-4"><b> Student Reg No</b></div>
   <div class="col-xl-4"><b> Date</b></div>

</div>
<div class="form-group row">
    <div class="col-xl-4"><input type="text" class="form-control" name="reg_no" id="reg_no" value="<?= esc($_POST['reg_no'] ?? '') ?>" required></div>
    <div class="col-xl-4"><input type="date" class="form-control" name="date" id="date"></div>
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
<?php if(isset($_POST['submit']) && $_POST['submit']=='View'){ ?>

<div class="col-xl-12" >

<div class="panel panel-inverse">

<div class="panel-heading">
<h4 class="panel-title">
		
 	
Bus Fees Consession</h4>
</div>

<div class="panel-body">
    <?php 
    	$reg_no=($_POST['reg_no'] ?? '');
     $query1= $db->query("SELECT * FROM student_admission_information WHERE reg_no='$reg_no'"); 
                                                foreach ($query1->getResult() as $fees_collection) {
 
                                                   
                                                  }
                                                   $query13= $db->query("SELECT * FROM class WHERE class_id='".$fees_collection->program."' ");
//  $data5['source']=$query3->getResultArray();
// }
    	 foreach($query13->getResult() as $row13){
            //  $cat_id = $row['id'];
            // print_r($value);
        $program1=$row13->class;
}
                                                  ?>
     <p><b>Name :</b> <?php echo $fees_collection->salutation.'.'.$fees_collection->first_name.' '.$fees_collection->middle_name.' '.$fees_collection->last_name; ?></p>
         <p><b>Class :</b>  <?php echo $program1; ?></p>
          <p><b>Session :</b> <?php echo $fees_collection->session_year; ?></p>
          <p><b>Semester :</b> <?php echo $fees_collection->semister; ?></p>
          <form  method="post">
           
    	<input name="reg_no1" ID="reg_no" type="hidden" id="registration_no" value="<?php echo $fees_collection->reg_no;?>">
    	<input name="session1" ID="session" type="hidden" id="registration_no" value="<?php echo $fees_collection->session_year;?>">
<table id="data-table-buttons" class="table table-striped table-bordered align-middle w-100 text-nowrap">
<thead>
<tr>

	<?php
			//student_admission_fee Detail
			$fees_detail_query =  $db->query("SELECT * FROM bus_fees WHERE  reg_no='".($_POST['reg_no'] ?? '')."' and session = '".($_POST['session'] ?? '')."'");
			$fees_detail_data = $fees_detail_query->getRow();
			$reg_no=($_POST['reg_no'] ?? '');
			$session=($_POST['session'] ?? '');
			 
			?>

<td align="center">Actual fees</td>
<td align="center">fees Paid</td>
<td align="center">Balance Amount</td>
<td align="center">Consession Amount</td>
</thead>
<?php
				$count=0;
				// $Actual_Amount=0;
				$paid_Amount=0;
				$Actual_Amount = (float) ($fees_detail_data->amount ?? 0);
				$actual_scholarship = (float) ($fees_collection->actual_scholarship ?? 0);
				$paid_scholarship = (float) ($fees_collection->paid_scholarship ?? 0);
				$balance_scholarship = $actual_scholarship - $paid_scholarship;
				// foreach($fees_data as $key=>$value){
				$count++;
				// if(!empty($Actual_Amount)){
				// list($component,$amount)=explode('_',$value);
			
		$data_query  = $db->query("SELECT * FROM other_fees WHERE  reg_no='".$reg_no."' AND session = '".$session."' AND c_name='Bus'");
		
	$total_amount = 0;
		 foreach ($data_query->getResult() as $data){
	$total_amount = $total_amount +$data->c_amount;
	}
				
				$paid_Amount = $paid_Amount+$total_amount;
				
				?>
			</tr>
				<tr>
				
				<td align="center"><font color="#FF0000" size="+2"><?php echo $actual_fees = number_format(($Actual_Amount+$actual_scholarship),2);?></font><input type="hidden" name="Actual_amount" id="Actual_amount" value="<?php echo $actual_fees; ?>" /></td>
				<td align="center"><font color="#FF0000" size="+2"><?php echo number_format(($paid_Amount+$paid_scholarship),2);?></font></td>
				<td align="center"><font color="#FF0000" size="+2"><?php 
				$toal_bal_amount = $Actual_Amount-$paid_Amount;
				echo number_format((($toal_bal_amount+$balance_scholarship)),2); ?><input type="hidden" name="Balance_amount" id="Balance_amount" value="<?php echo $amt =  $toal_bal_amount+$balance_scholarship; ?>" /></font></td>
				<td align="center"><?php if (!empty($canAddBusFeesCollection)): ?><input type="text" align="middle" name="consession_fee" id="consession_fee" value="<?php echo ($_POST['consession_fee'] ?? '')?>" onkeyup="sum();" /><?php endif; ?>
                
                </tr>
			
		<!--<td align="center"><input type="submit" name="Submit_data" value="Save information" style="height:30px; background-color: #0C6; width:150px; font:'Comic Sans MS', cursive; size:100px; border-radius: 20px;" /></td>-->
			
				
</table>
<?php if (!empty($canAddBusFeesCollection)): ?>
<input type="submit" name="Submit_data" value="Save information" style="height:30px; background-color: #0C6; width:150px; font:'Comic Sans MS', cursive; size:100px; border-radius: 20px;" />
<?php endif; ?>
</form>
</div>


<div class="hljs-wrapper">
<pre><code class="html" data-url="<?= base_url('assets/data/table-manage/keytable.json'); ?>"></code></pre>
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
function sum() {
       var txtFirstNumberValue = document.getElementById('Balance_amount').value;
	  
       var txtSecondNumberValue = document.getElementById('consession_fee').value;
       // alert(txtSecondNumberValue);
	   if (txtFirstNumberValue == "")
           txtFirstNumberValue = 0;
       if (txtSecondNumberValue == "")
           txtSecondNumberValue = 0;

       var result = parseInt(txtFirstNumberValue) - parseInt(txtSecondNumberValue);
       if (!isNaN(result)) {
           document.getElementById('consession_amount').value = result;
       }
   }
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
      $(this).append('<option  value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) + ' - ' +  (year+1 + i) +'</option>');
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
<?= $this->endSection() ?>
