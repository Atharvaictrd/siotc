<?= $this->extend('layout/tempmain') ?>

<?= $this->section('links') ?>
<?= $this->endSection('links') ?>

<?= $this->section('content') ?>


<link href="assets/css/vendor.min.css" rel="stylesheet" />
<link href="assets/css/default/app.min.css" rel="stylesheet" />


<link href="assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link href="assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
<link href="assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" />

<style>
    /*#feesReport{*/
    /*    display:none;*/
    /*}*/
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
<style>
  .tab {
    display: none;
  }
  .tab.active {
    display: block;
  }
</style>

<div class="row">

<div class="col-xl-12">

<div class="panel panel-inverse" data-sortable-id="form-validation-1">

<div class="panel-heading">
<h3 class="panel-title">Student Fees Collection </h3>
</div>


<div class="panel-body">
     <?php if (isset($_SESSION['success'])) : ?>
                            <div class="alert alert-success my-5">
                                <h5><?=$_SESSION['success'];?></h5>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['error'])) : ?>
                            <div class="alert alert-danger my-5">
                                <h5><?=$_SESSION['error'];?></h5>
                            </div>
                        <?php endif; ?>
    <form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post">
<div class="form-group row">
    <div class="col-xl-4" > <b>
Student Reg. No </b></div>
      <div class="col-xl-4"> <b>Session </b> </div>
        <div class="col-xl-4">  </div>
</div>
<div class="form-group row">
    <div class="col-xl-4"> <input type="text" class="form-control" name="reg_no" id="reg_no" required></div>
      <div class="col-xl-4"> <select name="session" onchange="javascript:form_submit();" class=" form-control"  id="dropdownYear" >
          <option value="<?= $_SESSION['session_year']; ?>" selected><?= $_SESSION['session_year']; ?></option>
         </select></div>
        <div class="col-xl-2"> <input type="submit" class="form-control btn btn-warning " name="search" id="" value="View"> </div>
</div>

<div class="form-group row">
    <div class="col-xl-4" > <b>
Student Name</b></div>
      <div class="col-xl-4"> <b>Date </b> </div>
        <div class="col-xl-4">  </div>
</div>
<div class="form-group row">
    <div class="col-xl-4"> <select name="search_enquiry_name" id="search_enquiry_name" class="form-control col-sm-5 chosen-select" onChange="myFunction()" autocomplete="off">
                                              <option>--Select--</option>
                                                  <?php
                                                 $db  = \Config\Database::connect();
                                                                    $query1= $db->query("SELECT * FROM student_admission_information WHERE active_status='0' ORDER BY student_admission_id ASC"); 
                                                foreach ($query1->getResult() as $row1) {

                                                     echo ' <option value="'.$row1->reg_no.'">'.$row1->salutation." . ".$row1->first_name." ".$row1->last_name.'</option>';
                                                  }
                                                  ?>
                                              </select></div>
      <div class="col-xl-4">  <input type="date" class="form-control" name="date" id="date"></div>
        <div class="col-xl-2"><?php if(!empty($_SESSION['success'])){ ?> <a class="btn btn-info" href="print_other_slip?action=preview&id=<?php echo $_SESSION['other']['fees_id'] ?>">Print</a><?php } ?> </div>
</div>
</form>
</div>


<div class="hljs-wrapper">
<pre><code class="html" data-url="<?= base_url('assets/data/form-validation/code-1.json'); ?>"></code></pre>
</div>

</div>

</div>
<?php if(isset($_POST['search']) && $_POST['search']=='View'){ ?>
<?php 

                                    foreach ($source  as $fees_collection) {
                                    
                                        ?>
                                        <?php
                                        
                                    }
?>
<?php if($fees_collection['active_status']==0){ ?>
<div class="col-xl-12" id="feesReport">

<div class="panel panel-inverse">

<div class="panel-heading">
<h4 class="panel-title">Fees Collection</h4>

</div>

<div class="panel-body">
    
    <div>
        <p><b>Name :</b> <?php echo $fees_collection['salutation'].'.'.$fees_collection['first_name'].' '.$fees_collection['middle_name'].' '.$fees_collection['last_name']; ?></p>
         <p><b>Class :</b>  <?php echo $fees_collection['class']; ?></p>
          <p><b>Sem :</b>  <?php echo $fees_collection['semister']; ?></p>
          <p><b>Session :</b> <?php echo $fees_collection['session_year']; ?></p>
    </div>
<form action="<?php echo base_url('insert_other_fees'); ?>" method="post">
    	<input type="hidden" value="<?php echo $fees_collection['student_admission_id'];?>" name="student_admission_id">
    	<input name="reg_no" ID="reg_no" type="hidden" id="registration_no" value="<?php echo $fees_collection['reg_no'];?>" >
    	<input name="session" ID="session" type="hidden" id="registration_no" value="<?php echo $fees_collection['session_year'];?>">
<table id="data-table-buttons" class="table table-striped table-bordered align-middle w-100 text-nowrap">
    	<tr>
					<td></td>
					<td>Component</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td>Component Name</td>

					<td align="left" style="white-space:nowrap"><input type="text" name="c_name" ID="c_name" value ="<?php echo ($_POST['Component_Name'] ?? '');?>" style="width:100px;text-align:left" />
					&nbsp;&nbsp;<select name="component_list_data" id="component_list_data" style="width:120px;" onchange="select_component_list(this)"><option value="" selected="">--Select--</option><option value="ADMISSION FEE">ADMISSION FEE</option><option value="Bus">Bus</option><option value="fine">fine</option><option value="Fresher">Fresher</option><option value="Late fee">Late fee</option></select>
					</td>

				</tr>
				<tr>
					<td  align="right"></td>
					<td>Amount</td>					
					<td  align="left" ><input type="text" name="c_amount" value ="<?php echo ($_POST['Component_Amount'] ?? '');?>" style="width:100px;text-align:right" onkeypress="return AllowNumeric(event)" required/></td>

				</tr>
			
				<tr>

				<td></td>
				<td><select name="amount_type" style="width:120px;"><option value="">--Select--</option><option value="Cash" selected="">Cash</option><option value="Cheque">Cheque</option><option value="DD">DD</option><option value="NEFT">NEFT</option><option value="UPI">UPI</option></select></td>
				<td align="">

					<input type="submit" value="Save" name="a_save">

					<input type="button" value="Cancel" name="Cancel" onclick="window.location.href='<?php echo $_SERVER['PHP_SELF'];?>'"></td>
						</tr>
				</tr>
</table>
<h5> Payment Mode :</h5>
<div class="tabs">
  <a class="tablinks btn btn-primary " onclick="openTab(event, 'tab1')">Cheque</a>
  <!--<a class="tablinks btn btn-primary" onclick="openTab(event, 'tab2')">Demand Draft </a>-->
</div><br>
<div id="wizardForm" >
    <div id="tab1" class="tab active">
          <div class="form-group row">
              <div class="col-xl-6"> <b>Cheque Amount</b></div>
                  <div class="col-xl-6"> <b>Cheque No.</b></div>
          </div>
          <div class="form-group row">
              <div class="col-xl-6"> <input type="text" name="cheque_amount" class="form-control"></div>
                  <div class="col-xl-6"> <input type="text" name="cheque_no" class="form-control"></div>
          </div>
          <div class="form-group row">
              <div class="col-xl-4"> <b>Cheque Date</b></div>
                  <div class="col-xl-4"> <b>Bank Name</b></div>
                   <div class="col-xl-4"> <b>	Branch Name</b></div>
          </div>
          <div class="form-group row">
              <div class="col-xl-4"> <input type="date" name="cheque_date" class="form-control"></div>
                  <div class="col-xl-4"> <input type="text" name="bank_name" class="form-control"></div>
                   <div class="col-xl-4"> <input type="text" name="	branch_name" class="form-control"></div>
          </div>
          <div class="form-group row">
              <div class="col-xl-4"> <b>City</b></div>
                  <div class="col-xl-4"> <b>State</b></div>
                   <div class="col-xl-4"> <b>Payable to:</b></div>
          </div>
          <div class="form-group row">
              <div class="col-xl-4"> <input type="text" name="city" class="form-control"></div>
                  <div class="col-xl-4"> <input type="text" name="state" class="form-control"></div>
                   <div class="col-xl-4"> <input type="text" name="payable_to" class="form-control"></div>
          </div>
      </div>
      <!-- <div id="tab2" class="tab active">-->
      <!--    <div class="form-group row">-->
      <!--        <div class="col-xl-6"> <b>Demand Draft Amount</b></div>-->
      <!--            <div class="col-xl-6"> <b>DD No.</b></div>-->
      <!--    </div>-->
      <!--    <div class="form-group row">-->
      <!--        <div class="col-xl-6"> <input type="text" name="demand_draft_amount" class="form-control"></div>-->
      <!--            <div class="col-xl-6"> <input type="text" name="DD_no" class="form-control"></div>-->
      <!--    </div>-->
      <!--    <div class="form-group row">-->
      <!--        <div class="col-xl-4"> <b>	DD Date</b></div>-->
      <!--            <div class="col-xl-4"> <b>Bank Name</b></div>-->
      <!--             <div class="col-xl-4"> <b>	Branch Name</b></div>-->
      <!--    </div>-->
      <!--    <div class="form-group row">-->
      <!--        <div class="col-xl-4"> <input type="date" name="DD_date" class="form-control"></div>-->
      <!--            <div class="col-xl-4"> <input type="text" name="dd_bank_name" class="form-control"></div>-->
      <!--             <div class="col-xl-4"> <input type="text" name="dd_branch_name" class="form-control"></div>-->
      <!--    </div>-->
      <!--    <div class="form-group row">-->
      <!--        <div class="col-xl-4"> <b>City</b></div>-->
      <!--            <div class="col-xl-4"> <b>State</b></div>-->
      <!--             <div class="col-xl-4"> <b>Payable to:</b></div>-->
      <!--    </div>-->
      <!--    <div class="form-group row">-->
      <!--        <div class="col-xl-4"> <input type="date" name="d_city" class="form-control"></div>-->
      <!--            <div class="col-xl-4"> <input type="text" name="d_state" class="form-control"></div>-->
      <!--             <div class="col-xl-4"> <input type="text" name="d_payable_to" class="form-control"></div>-->
      <!--    </div>-->
      <!--</div>-->
    </div>
    </form>
</div>
<div class="hljs-wrapper">
<pre><code class="html" data-url="<?= base_url('assets/data/table-manage/keytable.json'); ?>"></code></pre>
</div>

</div>

</div>
<?php }elseif($fees_collection['reg_no']!='DBN1001'){ ?>

<p>Data Not Found!</p>
<?php } }?>
</div>

</div>
<script>
  var currentTab = 0;
  showTab(currentTab);

  function showTab(n) {
    var tabs = document.getElementsByClassName("tab");
    tabs[n].classList.add("active");
    if (n == 0) {
      document.getElementById("prevBtn").style.display = "none";
    } else {
      document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (tabs.length - 1)) {
      document.getElementById("nextBtn").innerHTML = "Submit";
    } else {
      document.getElementById("nextBtn").innerHTML = "Next";
    }
    // Show only the current tab
    for (var i = 0; i < tabs.length; i++) {
      if (i !== n) {
        tabs[i].classList.remove("active");
      }
    }
  }


  function nextStep() {
    var tabs = document.getElementsByClassName("tab");
    if (currentTab >= tabs.length - 1) {
      document.getElementById("wizardForm").submit();
      return false;
    }
    if (!validateForm()) return false;
    currentTab++;
    showTab(currentTab);
  }

  function prevStep() {
    if (currentTab <= 0) {
      return false;
    }
    currentTab--;
    showTab(currentTab);
  }

  function validateForm() {
    var tabs = document.getElementsByClassName("tab");
    var inputs = tabs[currentTab].getElementsByTagName("input");
    for (var i = 0; i < inputs.length; i++) {
      if (inputs[i].value == "") {
        alert("Please fill in all fields.");
        return false;
      }
    }
    return true;
  }

  function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tab");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].classList.remove("active");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.classList.add("active");
    currentTab = Array.prototype.indexOf.call(document.getElementsByClassName("tab"), document.getElementById(tabName));
  }
</script>


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