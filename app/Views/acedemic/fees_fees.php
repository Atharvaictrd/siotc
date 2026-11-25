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
         <option value="<?=$_SESSION['session_year']?>" selected><?=$_SESSION['session_year']?></option>
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
    
    <!--<select name="search_enquiry_name" id="search_enquiry_name" class="form-control col-sm-5" onChange="myFunction()" autocomplete="off">-->
    <!--                                          <option>--Select--</option>-->
    <!--                                              ?php-->
    <!--                                             $db  = \Config\Database::connect();-->
    <!--                                                                $query1= $db->query("SELECT * FROM student_admission_information WHERE active_status='0' ORDER BY student_admission_id ASC"); -->
    <!--                                            foreach ($query1->getResult() as $row1) {-->
    <!--                                                 echo ' <option value="'.$row1->reg_no.'">'.$row1->salutation." . ".$row1->first_name." ".$row1->last_name.'</option>';-->
    <!--                                              }-->
    <!--                                              ?>-->
    <!--                                          </select>-->
    </div>
    <div class="col-xl-4">  <input type="date" class="form-control" name="date" id="date"></div>
    <div class="col-xl-2"><?php if(!empty($_SESSION['success'])){ ?> <a class="btn btn-info" href="print_slip?action=preview&id=<?php echo $_SESSION['fees']['fees_id'] ?>" target="_blank">Print</a> <?php if(!empty($_SESSION['late']['id'])){ ?><a class="btn btn-info" href="print_late_slip?action=preview&id=<?php echo $_SESSION['late']['id'] ?>" target="_blank">Late Fees Print</a><?php } ?><?php } ?> </div>
</div>
</form>
</div>


<div class="hljs-wrapper">
<pre><code class="html" data-url="<?= base_url('assets/data/form-validation/code-1.json'); ?>"></code></pre>
</div>

</div>

</div>



</div>
<?php if(isset($_POST['search']) && $_POST['search']=='View'){ ?>
<?php 

                                    foreach ($source  as $fees_collection) {
                                    
                                        ?>
                                        <?php
                                        
                                    }
                                    // echo $fees_collection->program;
                                     $query13= $db->query("SELECT * FROM class WHERE class_id='".$fees_collection['program']."' ");
//  $data5['source']=$query3->getResultArray();
// }
    	 foreach($query13->getResult() as $row13){
            //  $cat_id = $row['id'];
            // print_r($value);
        $program1=$row13->class;
}
?>
<?php if($fees_collection['active_status']==0){ ?>
<div class="col-xl-12" >

<div class="panel panel-inverse">

<div class="panel-heading">
<h4 class="panel-title">Fees Collection</h4>

</div>

<div class="panel-body">
    
    <div>
        <p><b>Name :</b> <?php echo $fees_collection['salutation'].'.'.$fees_collection['first_name'].' '.$fees_collection['middle_name'].' '.$fees_collection['last_name']; ?></p>
         <p><b>Class :</b>  <?php echo $program1; ?> <?php echo $fees_collection['semister'];?></p>
          <p><b>Session :</b> <?php echo $fees_collection['session_year']; ?></p>
          <p><b>Semester :</b> <?php echo $fees_collection['semister']; ?></p>
    </div>
    <?php
			//student_admission_fee Detail
			$fees_detail_query = $db->query("SELECT * FROM student_admission_fee WHERE student_admission_id='".$fees_collection['student_admission_id']."' and session = '".$fees_collection['session_year']."' order by fee_component_id ASC");
		    
		  //  $results = $fees_detail_query->getResultArray();
		  //  echo "<script>console.log('Query Results:', " . json_encode($results) . ");</script>";
		  
		  
		  
		  
		  
		    
		 foreach ($fees_detail_query->getResult() as $row2) {
		 }

	$fees_data = explode(';',$row2->fee_component_id);
		
	 
			?>
<form action="<?php echo base_url('fees_test'); ?>" method="post">
    	<input type="hidden" value="<?php echo $fees_collection['student_admission_id'];?>" name="student_admission_id">
    	<input name="reg_no" ID="reg_no" type="hidden" id="registration_no" value="<?php echo $fees_collection['reg_no'];?>">
    	<input name="session" ID="session" type="hidden" id="registration_no" value="<?php echo $fees_collection['session_year'];?>">
<table id="data-table-buttons" class="table table-striped table-bordered align-middle w-100 text-nowrap">
<thead>
<tr>

<th class="text-nowrap">Sr No</th>
<th class="text-nowrap">Particulars</th>
<th class="text-nowrap">Actual Amount</th>
<th class="text-nowrap">Paid Amount</th>
<th class="text-nowrap">Balance Amount</th>
<th class="text-nowrap">Amount</th>
</tr>
</thead>
<tbody>

<?php
			$student_id=$fees_collection['student_admission_id'];
			$reg_no=$fees_collection['reg_no'];
				$count=1;
				$Actual_Amount=0;
				$paid_Amount=0;
				foreach($fees_data as $key=>$value){
				   
				
				if(!empty($value)){
				
				list($component,$amount)=explode('_',$value);
				
				$Actual_Amount= $Actual_Amount+$amount;
			
				$fees_detail_query3 = $db->query("SELECT * FROM fee_components WHERE fee_component_id='$component' and session = '".$fees_collection['session_year']."'");
		 foreach ($fees_detail_query3->getResult() as $row3) {
		
		 $cmpid=$row3->fee_component_id;
		 $f_com_id=$row3->fee_component_id;
		 
		 $paid_consession_query = $db->query("SELECT * FROM management_consession WHERE student_admission_id='".$student_id."' AND session_year = '".$fees_collection['session_year']."'");
				$consession= 0;
				foreach ($paid_consession_query->getResult() as $paid_consession_data) {
				     $consession = $consession+$paid_consession_data->consession_amount;
					}
				?>
				<tr>
					<td><?php echo $count++;?></td>
					
					<td><?php echo $cname= $row3->component; ?></td>
					<td align="right"><?php	if($component==$cmpid)
        					{
        					    
        						if($cname=='Management Consession')
        						{
        							echo number_format($consession,2);
        						}
        						elseif($cname=='Scholarship Fees'|| $cname=='scholarship')
        						{
        						   
        						    $sch=$amount;
        						    echo number_format($amount,2);
        						}
        						else
        						{
        						   echo number_format($amount,2);
        						}
        					} ?></td>
					<td align="right"><?php 
		$data_query  = $db->query("SELECT * FROM  fees_collection_detail WHERE student_admission_id='".$student_id."' AND reg_no='".$reg_no."' AND fee_component_id='".$f_com_id."'");
		
	$total_amount = 0;
	 foreach ($data_query->getResult() as $data) {
	$total_amount = $total_amount +$data->amount;
	}
	
	echo number_format($total_amount,2);
		$paid_Amount = $paid_Amount+($total_amount);
	?></td>
					<td align="right"><?php $balance = ($amount)-($total_amount);
					echo number_format($balance,2);
					?></td>
				<td align="">
					<?php
					if($balance==0){
						
					?>
					<input type="text" name="<?php echo 'feeAmount_'.$component;?>"  id="perticular_rate_<?=$component?>" value ="" style="text-align:right" onblur="javascript:fee_sub_total(this);" onkeypress="return AllowNumeric(event)" disabled>
					<?php
					}else{
						
					?>
					<input type="text" name="<?php echo 'feeAmount_'.$component;?>" id="perticular_rate_<?=$component?>"  value ="" style="text-align:right" onblur="javascript:fee_sub_total(this);" onkeypress="return AllowNumeric(event)" >
					<?php
					}
					?>
					</td>
				</tr>
				<?php
				}
				}
				 }
				?>
				
				 	<tr>
				<td></td>
				<td></td>
				<td align="right" style="font-weight:600;"><font color="#FF0000"><?php echo number_format(($Actual_Amount+$fees_collection['actual_scholarship']),2);?></font></td>
				<td align="right" style="font-weight:600;"><font color="#FF0000"><?php echo number_format(($paid_Amount+$paid_scholarship),2);?></font></td>
				<td align="right" style="font-weight:600;"><font color="#FF0000"><?php 
				// echo $balance;
				// $toal_bal_amount = $Actual_Amount-$paid_Amount-$consession-$sch;
				// echo number_format((($toal_bal_amount-$fees_collection['actual_scholarship'])),2);
				
				$toal_bal_amount = $Actual_Amount-$paid_Amount-$consession-$sch +$balance;
				echo number_format((($toal_bal_amount+$balance_scholarship)),2);?></font></td>
				
				
				<td>
					<input style="color: green;font-weight: 600;text-align:right" type="text" name="fees_sub_total" id="fees_sub_total"  value="" readonly > 
					</td>
						
				</tr>
				<!--  <tr>-->
				<!--<td></td>-->
				<!--<td>Bus Fees</td>-->
				<!--<td></td>-->
				<!--<td></td>-->
				<!--<td></td>-->
				<!--	<td align="">-->
				
				<!--	<input type="text" name="bus_fees" value ="" style="text-align:right" onblur="javascript:fee_sub_total(this);" onkeypress="return AllowNumeric(event)" >-->
				
				<!--	</td>-->
             
                    
    <!--            </tr>-->
				   <tr>
				<td></td>
				<td>Late Fees</td>
				<td></td>
				<td></td>
				<td></td>
					<td align="">
					<?php
				if($toal_bal_amount==0){
						
				?>
					<input type="text" name="late_fees" value ="" style="text-align:right" onblur="javascript:fee_sub_total(this);" onkeypress="return AllowNumeric(event)" disabled>
				 <?php
			 	}else{
						
			 	?>
					<input type="text" name="late_fees" value ="" style="text-align:right" onblur="javascript:fee_sub_total(this);" onkeypress="return AllowNumeric(event)">
				<?php
					}
					?>
					</td>
             
                    
                </tr>
				
				<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td><select name="amount_type" style="width:120px;"><option value="">--Select--</option><option value="Cash" selected="">Cash</option><option value="Cheque">Cheque</option><option value="DD">DD</option><option value="NEFT">NEFT</option><option value="UPI">UPI</option></select></td>
				<!--<td align="">-->

				<!--	<input type="submit" value="Save" name="a_save">-->
					
				<!--	<input type="button" value="Cancel" name="Cancel" onclick="window.location.href='<?php echo $_SERVER['PHP_SELF'];?>'"></td>-->
				</tr>

</tbody>
</table>

<h5> Payment Mode :</h5>
<div class="tabs">
     <a class="tablinks btn btn-primary active" onclick="openTab(event, 'tab1')">UPI</a>
  <a class="tablinks btn btn-primary " onclick="openTab(event, 'tab2')">Cheque</a>
  <a class="tablinks btn btn-primary" onclick="openTab(event, 'tab2')">Demand Draft </a>
</div><br>
<div id="wizardForm" >
     <div id="tab1" class="tab active">
        <div class="form-group row">
              <div class="col-xl-6"> <b> Date</b></div>
                  <div class="col-xl-6"> <b>Name</b></div>
                   
          </div>
            <div class="form-group row">
              <div class="col-xl-6"> <input type="date" name="upi_date" class="form-control"></div>
                  <div class="col-xl-6"> <input type="text" name="upi_name" class="form-control"></div>
                  
          </div>
          <div class="form-group row">
              <div class="col-xl-6"> <b>UPI Amount</b></div>
                <div class="col-xl-6"> <b>Transaction ID</b></div>
          </div>
          <div class="form-group row">
              <div class="col-xl-6"> <input type="text" name="upi_amount" class="form-control"></div>
                  <div class="col-xl-6"> <input type="text" name="upi_id" class="form-control"></div>
          </div>
      
        
          <!--<div class="form-group row">-->
          <!--    <div class="col-xl-4"> <b>City</b></div>-->
          <!--        <div class="col-xl-4"> <b>State</b></div>-->
          <!--         <div class="col-xl-4"> <b>Payable to:</b></div>-->
          <!--</div>-->
          <!--<div class="form-group row">-->
          <!--    <div class="col-xl-4"> <input type="text" name="city" class="form-control"></div>-->
          <!--        <div class="col-xl-4"> <input type="text" name="state" class="form-control"></div>-->
          <!--         <div class="col-xl-4"> <input type="text" name="payable_to" class="form-control"></div>-->
          <!--</div>-->
      </div>
    <div id="tab2" class="tab ">
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
       <div id="tab3" class="tab ">
          <div class="form-group row">
              <div class="col-xl-6"> <b>Demand Draft Amount</b></div>
                  <div class="col-xl-6"> <b>DD No.</b></div>
          </div>
          <div class="form-group row">
              <div class="col-xl-6"> <input type="text" name="demand_draft_amount" class="form-control"></div>
                  <div class="col-xl-6"> <input type="text" name="DD_no" class="form-control"></div>
          </div>
          <div class="form-group row">
              <div class="col-xl-4"> <b>	DD Date</b></div>
                  <div class="col-xl-4"> <b>Bank Name</b></div>
                   <div class="col-xl-4"> <b>	Branch Name</b></div>
          </div>
          <div class="form-group row">
              <div class="col-xl-4"> <input type="date" name="DD_date" class="form-control"></div>
                  <div class="col-xl-4"> <input type="text" name="dd_bank_name" class="form-control"></div>
                   <div class="col-xl-4"> <input type="text" name="dd_branch_name" class="form-control"></div>
          </div>
          <div class="form-group row">
              <div class="col-xl-4"> <b>City</b></div>
                  <div class="col-xl-4"> <b>State</b></div>
                   <div class="col-xl-4"> <b>Payable to:</b></div>
          </div>
          <div class="form-group row">
              <div class="col-xl-4"> <input type="text" name="d_city" class="form-control"></div>
                  <div class="col-xl-4"> <input type="text" name="d_state" class="form-control"></div>
                   <div class="col-xl-4"> <input type="text" name="d_payable_to" class="form-control"></div>
          </div>
      </div>
    </div>
    <br>
    <div class="tabs">
        <input type="submit" value="Save" class="btn btn-primary" name="a_save">
        <input type="button" class="btn btn-primary" value="Cancel" name="Cancel" onclick="window.location.href='<?php echo $_SERVER['PHP_SELF'];?>'">
  <!--   <a class="tablinks btn btn-primary active" onclick="openTab(event, 'tab1')">UPI</a>-->
  <!--<a class="tablinks btn btn-primary " onclick="openTab(event, 'tab2')">Cheque</a>-->
  <!--<a class="tablinks btn btn-primary" onclick="openTab(event, 'tab2')">Demand Draft </a>-->
</div><br>
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

<script>
    $(document).ready(function () {
        // Attach event listener for input changes
        $(document).on('input', "[id^='perticular_rate_']", function () {
            calculateSubtotal();
        });

        function calculateSubtotal() {
            var totalAmount = 0;

            // Iterate through all input fields with IDs starting with "perticular_rate_"
            $("[id^='perticular_rate_']").each(function () {
                var value = $(this).val(); // Get the value of the input
                if (!isNaN(value) && value.trim() !== "") { // Check if it's a valid number
                    totalAmount += parseInt(value); // Add to totalAmount
                }
            });

            // Update the subtotal field
            $('#fees_sub_total').val(totalAmount);
        //   console.log(totalAmount); 
        }
    });
</script>
<?= $this->endSection() ?>

