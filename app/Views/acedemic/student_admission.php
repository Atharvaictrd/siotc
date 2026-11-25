<?= $this->extend('layout/tempmain') ?>

<?= $this->section('links') ?>
<?= $this->endSection('links') ?>

<?= $this->section('content') ?>

<link href="assets/css/vendor.min.css" rel="stylesheet" />
<link href="assets/css/default/app.min.css" rel="stylesheet" />

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link href="assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link href="assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
<link href="assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" />
<title>e-Campus | Student Admission</title>

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
<h3 class="panel-title">Student Admission</h3>
<div class="panel-heading-btn">
    <a href=""  class="btn btn-info" name="n_student" id="n_student" style="float:left;" data-bs-toggle="modal" data-bs-target="#myModal">Existing Student </a>
<a href="<?= base_url();?>student_admission/new_admission " class="btn btn-primary" name="n_student" id="n_student">New Student +</a>
</div>
</div>


<div class="panel-body">
<form class="form-horizontal" data-parsley-validate="true" name="demo-form" id="submit_form" method="post">
<div class="form-group row">
   <div class="col-xl-6 "><b>
Student Name</b></div>
   <div class="col-xl-6"><b>Prospectus No.</b></div>

</div>
<div class="form-group row">
    <div class="col-xl-6 ">
    <select name="search_enquiry_name" id="search_enquiry_name" class="form-control chosen-select" onChange="myFunction()" >
                                              <option>--Select--</option>
                                                  <?php
                                                 $db  = \Config\Database::connect();
                                                                    $query1= $db->query("SELECT * FROM prospect_sales ORDER BY 	prospect_id ASC"); 
                                                foreach ($query1->getResult() as $row1) {

                                                     echo ' <option value="'.$row1->prospect_no.'">'.$row1->student_gender." . ".$row1->student_first_name." ".$row1->student_last_name.'</option>';
                                                  }
                                                  ?>
                                              </select>  </div>                              
    <div class="col-xl-6"><input type="text" name = "prospect_no" class="form-control" id="prospect_no" value="<?= esc($_POST['prospect_no'] ?? '') ?>"></div>
    </div>
  <br>
<div class="form-group row">
   <div class="col-xl-3"><b>Reg No</b></div>
   <div class="col-xl-3"><b>Section</b></div>
      <div class="col-xl-3"><b>Category</b></div>
      <div class="col-xl-3"><b>Gender</b></div>
    
</div>
<div class="form-group row">
    <input type="hidden" class="form-control" name="student_admission_id" id="student_admission_id" value="<?= esc($_POST['student_admission_id'] ?? '') ?>" >
    <div class="col-xl-3"><input type="text" class="form-control" name="reg_no" id="reg_no" value="<?= esc($_POST['reg_no'] ?? '') ?>" required></div>
   <div class="col-xl-3"><select name="section" id="section" class="form-control" >
          
      <option value="1"<?php if (($_POST['section'] ?? '') == '1') { ?> selected <?php } ?>>Section A</option>
    <option value="2"<?php if (($_POST['section'] ?? '') == '2') { ?> selected <?php } ?>>Section B</option>
      </select></div>
     <div class="col-xl-3"><select name="category" id="category" class="form-control" >
       
           
           
    </select></div>
    <div class="col-xl-3"><select class="form-control" name="gender"  >
    <option value="male">Male</option>
    <option value="female" >Female</option>
</select></div>
  
</div>
<br>
<div class="form-group row">
   <div class="col-xl-12"><b>Name:</b></div>
 

</div>
<div class="form-group row">
    <div class="col-xl-3"><select class="form-control" name="salutation" id="name">
        <option value="Mr"<?php if(($_POST['name'] ?? '')=='Mr'){ ?> selected <?php } ?>>Mr.</option>
         <option value="Miss" <?php if(($_POST['name'] ?? '')=='Miss'){ ?> selected <?php } ?>>Miss</option>
          <option value="Mrs" <?php if(($_POST['name'] ?? '')=='Mrs'){ ?> selected <?php } ?>>Mrs.</option>
    </select></div>
     <div class="col-xl-3"><input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter First Name.." value="<?= esc($_POST['first_name'] ?? '') ?>"></div>
       <div class="col-xl-3"><input type="text" class="form-control" name="middle_name" id="middle_name"  placeholder="Enter Middle Name.." value="<?= esc($_POST['middle_name'] ?? '') ?>"></div>
         <div class="col-xl-3"><input type="text" class="form-control" name="last_name" id="last_name"  placeholder="Enter Last Name.." value="<?= esc($_POST['last_name'] ?? '') ?>"></div>
  
</div>
<br>
<div class="form-group row">
   <div class="col-xl-3"><b>Program</b></div>
   <div class="col-xl-3"><b>Semester</b></div>
      <div class="col-xl-3"><b>Session</b></div>
      <div class="col-xl-3"><b>Date</b></div>


</div>
<div class="form-group row">
     <div class="col-xl-3"><?php
									$db      = \Config\Database::connect();
									 $query3 = $db->query("SELECT * FROM class ORDER BY class_id "); 
									// $query   = $builder->get(); 
							
									?>

        <select name="program"  class="form-control" id="program">
            
            <option value="">-----SELECT-----</option>
            	<?php foreach ($query3->getResult() as $row3) {
    $s=$row3->class_id;

?>
            <option value="<?php echo $row3->class_id;?>"<?php if(($_POST['program'] ?? '')==$s){ ?> selected <?php } ?>><?php echo $row3->class;?></option>
            <?php } ?></select></div>
    <div class="col-xl-3"><?php
								// 	$db      = \Config\Database::connect();
									 $query2 = $db->query("SELECT * FROM program_sem ORDER BY program_sem_id "); 
									// $query   = $builder->get(); 
									
									?>
                                    
								
        <select name="semister"  class="form-control" id="semister">
            
            <option value="">-----SELECT-----</option>
            	<?php foreach ($query2->getResult() as $row2) {
    $p=$row2->program_sem;

?>
            <option value="<?php echo $row2->program_sem;?>"<?php if(($_POST['semister'] ?? '')==$p){ ?> selected <?php } ?>><?php echo $row2->program_sem;?></option>
            <?php } ?></select></div>
     <div class="col-xl-3"><select class="form-control" name="session" id="dropdownYear">
         <option value="<?= $_SESSION['session_year']; ?>" selected><?= $_SESSION['session_year']; ?></option>
    </select></div>
      <div class="col-xl-3"><input type="date" class="form-control" name="date" id="date" value="<?php echo date('Y-m-d'); ?>"></div>
  
</div><br>
<div class="form-group row">
<label class="col-lg-4 col-form-label form-label">&nbsp;</label>
<div class="col-lg-6">
<input type="submit" id="next" name="next" class="btn btn-success col-xl-4" value="Next"/>
<button type="Reset" class="btn btn-danger col-xl-4">Cancel</button>
</div>
</div>

</div>

<div class="hljs-wrapper">
<pre><code class="html" data-url="<?= base_url('assets/data/form-validation/code-1.json'); ?>"></code></pre>
</div>

</div>

</div>
<?php if (($_POST['next'] ?? '') == 'Next') {

    // ===== PREVIOUS DUES CHECK (read-only, koi record modify nahi hota) =====
    $feeBlockMessage      = '';   // '' = aage badhne do
    $student_admission_id = trim((string) ($_POST['student_admission_id'] ?? ''));
    $postedRegNo          = trim((string) ($_POST['reg_no'] ?? ''));
    $selectedSession      = trim((string) ($_POST['session'] ?? ''));
    $previousSession121   = '';
    $stu                  = null;

    if ($student_admission_id !== '') {
        $stu = (new \App\Models\AdmissionModel())
                    ->where('student_admission_id', $student_admission_id)
                    ->first();
    }

    if ($student_admission_id === '') {
        $feeBlockMessage = 'Student not selected. Please use "Existing Student" to search the student by Reg No, then click Next.';
    } elseif (empty($stu)) {
        $feeBlockMessage = 'Student record not found for the selected ID. Please search the student again.';
    } elseif (strcasecmp(trim((string) $stu['reg_no']), $postedRegNo) !== 0) {
        $feeBlockMessage = 'Reg No does not match the selected student. Please search the student again.';
  
} elseif ($selectedSession === '') {
    $feeBlockMessage = 'Please select the session.';

} elseif (trim((string) $stu['session_year']) === $selectedSession) {
    $feeBlockMessage = 'This student is already admitted for session ' . $selectedSession . '.';

} else {

    $category = strtoupper(trim((string) ($stu['category'] ?? '')));

if (in_array($category, ['SC', 'ST', 'NT', 'SBC'], true)) {

        $feeBlockMessage = '';

    } else {

        // ===== PREVIOUS SESSION DUES CHECK =====

        $previousSession121 = trim((string) $stu['session_year']);

        if ($previousSession121 === '') {

            $feeBlockMessage = 'Previous admission session is not recorded for this student. Please contact the administrator.';

        } else {

            $feeRow = $db->query("
                SELECT fee_component_id, total_amount
                FROM student_admission_fee
                WHERE student_admission_id = ?
                AND session = ?
                ORDER BY student_add_fee_id DESC
                LIMIT 1
            ", [$student_admission_id, $previousSession121])->getRow();

            if (!$feeRow) {

                $feeBlockMessage = 'Fee record for previous session ' . $previousSession121
                    . ' was not found. Admission cannot proceed until accounts verifies this record.';

            } else {

                // Calculate total fees
                $totalFees = null;
                $feeString = trim((string) $feeRow->fee_component_id);

                if ($feeString !== '') {

                    $sum = 0.0;
                    $ok = true;

                    foreach (explode(';', rtrim($feeString, ';')) as $component) {

                        if (trim($component) === '') {
                            continue;
                        }

                        $parts = explode('_', $component, 2);

                        if (count($parts) !== 2 || !is_numeric($parts[1])) {
                            $ok = false;
                            break;
                        }

                        $sum += (float) $parts[1];
                    }

                    if ($ok) {
                        $totalFees = $sum;
                    }
                }

                if ($totalFees === null && is_numeric($feeRow->total_amount)) {
                    $totalFees = (float) $feeRow->total_amount;
                }

                if ($totalFees === null) {

                    $feeBlockMessage = 'Previous session fee amount could not be read. Please contact accounts.';

                } else {

                    // Paid amount
                    $paidAmount = (float) $db->query("
                        SELECT IFNULL(SUM(amount), 0) AS paid_amount
                        FROM fees_collection_detail
                        WHERE student_admission_id = ?
                        AND session_year = ?
                    ", [$student_admission_id, $previousSession121])->getRow()->paid_amount;

                    // Concession amount
                    $concessionRow = $db->query("
                        SELECT IFNULL(consession_amount, 0) AS consession_amount
                        FROM management_consession
                        WHERE student_admission_id = ?
                        AND session_year = ?
                        ORDER BY sr_no DESC
                        LIMIT 1
                    ", [$student_admission_id, $previousSession121])->getRow();

                    $concessionAmount = $concessionRow
                        ? (float) $concessionRow->consession_amount
                        : 0.0;

                    // Calculate pending balance
                    $balance = $totalFees - $paidAmount - $concessionAmount;

                    if ($balance > 0.01) {

                        $feeBlockMessage = 'Admission Blocked! Previous session (' . $previousSession121
                            . ') fees of ₹' . number_format($balance, 2)
                            . ' are pending. Please clear the dues before admission to the next semester/year.';
                    }
                }
            }
        }
    }

    // ===== END PREVIOUS DUES CHECK =====
}


    // ===== END DUES CHECK — iske neeche aapka purana $query3 ... code jaisa hai waisa =====
    
    			    $query3= $db->query("SELECT * FROM class WHERE class_id='".($_POST['program'] ?? '')."' ");
//  $data5['source']=$query3->getResultArray();
// }
    	 foreach($query3->getResult() as $row3):
            //  $cat_id = $row['id'];
            // print_r($value);
        $program1=$row3->class;
   endforeach;
    
	$query2 = $db->query("SELECT fc.fee_component_id,fc.component,ftp.amount FROM fee_components fc ,fees_to_program ftp WHERE ftp.fee_type=fc.fee_component_id AND ftp.class='$program1' AND ftp.sem='".($_POST['semister'] ?? '')."' AND ftp.session='".($_POST['session'] ?? '')."' AND fc.session = '".($_POST['session'] ?? '')."' AND ftp.category='".($_POST['category'] ?? '')."'  AND ftp.gender='".($_POST['gender'] ?? '')."'  GROUP BY fc.fee_component_id ");
// 	echo "SELECT fc.fee_component_id,fc.component,ftp.amount FROM fee_components fc ,fees_to_program ftp WHERE ftp.fee_type=fc.fee_component_id AND ftp.class='".$program1."' AND ftp.sem='".$_POST['semister']."' AND ftp.session='".$_POST['session']."' AND fc.session = '".$_POST['session']."' AND ftp.category='".$_POST['category']."' GROUP BY fc.fee_component_id";
// 	print_r($query2);
	if($feeBlockMessage !== ''){
?>
<div class="alert alert-danger my-5"><h5><?= esc($feeBlockMessage) ?></h5></div>
<script>alert(<?= json_encode($feeBlockMessage) ?>);</script>
<?php
	}elseif(($db->affectedRows()) != 0){
?>

<div class="col-xl-12" id="feesdiv">

<div class="panel panel-inverse">

<div class="panel-heading">

</div>

<div class="panel-body">
    	<tr>
			<td align="left"><table width="100%" border="1" cellspacing="0" cellpadding="4" class="table_color">
              <tr>
                <td width="62%" valign="top"><!--<div style="height:120px; overflow:auto">-->
                    <table width="100%" class="normal-text" border="0" cellspacing="0" cellpadding="1">
                      <tr>
                        <td width="78" align="center"><span class="style5"><b>&nbsp;&nbsp;Sr.&nbsp;No.</b></span></td>
                        <td width="285" align="left"><span class="style5"><b>Particulars</b></span></td>
                        <td width="120" align="right"><span class="style5"><b>Amount Rs.</b></span></td>
                      </tr>
                      <tr>
                        <td colspan="3"><hr /></td>
                      </tr>
                      <?php
                    //   echo "SELECT fc.fee_component_id,fc.component,ftp.amount FROM fee_components fc ,fees_to_program ftp WHERE ftp.fee_type=fc.fee_component_id AND ftp.class='".$_POST['class']."' AND ftp.sem='".$_POST['semister']."' AND ftp.session='".$_POST['session']."' AND fc.session = '".$_POST['session']."' AND ftp.category='".$_POST['category']."' GROUP BY fc.fee_component_id ";
   

						$count=0;
						$total_amount = 0;
						$fee_com_id = '';
						
						foreach ($query2->getResult() as $fee_row)
						{
							$count++;
							$fee_com_id = $fee_row->fee_component_id.'_'.$fee_row->amount.';'.$fee_com_id;
						?>
                      <tr>
                        <td align="center"><span class="style5" ><b><?php echo $count;?></b></span></td>
                        <td><b><?php echo $fee_row->component; ?></b></td>
                        <td align="right"><?php echo number_format($fee_row->amount,2); ?></td>
                      </tr>
                      <?php
						$total_amount = $total_amount+$fee_row->amount;
						}
						
						?>
                      <input type="hidden" name="fee_com_id" id="fee_com_id" value="<?php echo $fee_com_id;?>" />
                      <tr>
                        <td colspan="3"><hr /></td>
                      </tr>
                      <tr>
                        <td align="center"><span class="style5" ></span></td>
                        <td><b>Total</b></td>
                        <td align="right"><?php echo number_format($total_amount,2); ?></td>
                      </tr>
                    </table>
                  <!--</div>-->                </td>
                <td width="38%" valign="top"><table cellspacing="1" cellpadding="2" width="100%" class="normal-text">
                    
                    <tr>
                      <td width="144"><span class="style5"><strong>Sub Total</strong></span></td>
                      <td width="8" align="left"><strong>:</strong></td>
                      <td width="181" align="left"><input type="text" value="<?php echo $total_amount;?>" name="total_amount" id="total_amount" style="text-align:right" readonly="readonly" /></td>
                    </tr>
                    <tr>
                      <!--<td width="144"><span class="style5"><strong>Paid Amount</strong></span></td>-->
                      <!--<td width="8" align="left"><strong>:</strong></td>-->
                    <!--  <td width="181" align="left"><input type="hidden" name="paid_amount" onblur="javascript:calculate_balance_amount(this.value);" style="text-align:right" value="<?php echo $_POST['paid_amount'];?>" onkeypress="return AllowNumeric(event)" /></td>-->
                    <!--</tr>-->
                    <tr>
                      <td width="144"><span class="style5"><strong><!--Balance Amount--></strong></span></td>
                      <td width="8" align="left"><strong><!--:--></strong></td>
                      <td width="181" align="left"><input type="hidden" name="balance_amount" style="text-align:right" value="<?php echo $total_amount;?>" readonly="readonly" /></td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
		</tr>
        
		
			</tr>
        <tr>
		<td><table cellspacing="2" cellpadding="2"class="table_color" width="100%">
						<tr>
							<td  align="right">
							<input type="button" value="back" onclick="window.location.href='<?php echo $_SERVER['PHP_SELF'];?>';" class="cancel">
							
							<input type="submit"  value="Submit" Name="actionsubmit"  id="actionsubmit" class="save" >							</td>
							</tr>
					</table></td>
        </tr>
	 
      
   </table>   
	</td>
  </tr>
   </table>   
	</td>
  </tr>
</div>

</div>

</div>
</form>
<?php }else{ ?>
<div class="alert alert-danger my-5">
                                <h5>No Fees Data Found</h5></div>
<?php } } ?>
<div class="col-xl-12">

<div class="panel panel-inverse">

<div class="panel-heading">
<h4 class="panel-title" id="heading_title">Recently Sold Prospectus</h4>
</div>

<div class="panel-body">
<table id="data-table-buttons" class="table table-striped table-bordered align-middle w-100 text-nowrap">
<thead>
<tr>

<th class="text-nowrap">Date</th>
<th class="text-nowrap">Prospectus No</th>
<th class="text-nowrap">Student Name</th>
</tr>
</thead>
<tbody>
 <?php 
$s=count($source);

                                    foreach ($source  as $fees_collection) {
	      
?>
<tr class="odd gradeX">

 <td ><?php echo $fees_collection['date'];?></td>
                              <td ><?php echo $fees_collection['prospect_no'];?></td>
                              <td style="white-space:nowrap;"><span style="white-space:nowrap;text-transform:uppercase;"><?php echo $fees_collection['student_gender'].'.'.$fees_collection['student_first_name'].' '.$fees_collection['student_middle_name'].' '.$fees_collection['student_last_name']?></span></td>

</tr>
  <?php	  } ?>
</tbody>
</table>
</div>


<div class="hljs-wrapper">
<pre><code class="html" data-url="<?= base_url('assets/data/table-manage/keytable.json'); ?>"></code></pre>
</div>

</div>

</div>

</div>

</div>

</div>

<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Student Reg no</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <label>Enter Reg No</label>
      <input type="text" name="reg_no1" id="reg_no1" class="form-control">
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
            <a type="submit"   class="btn btn-info" name="submit" id="search">Submit</a>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="6d06734b60a66024f3330210-|49" defer>
    
</script>
<script>
//     function search_student(str,method)
// {

// var url="<?= base_url('search_enquiry_name') ?>";
// url=url+"?q="+str+"&method="+method;
// url=url+"&sid="+Math.random();

//     // Internet Explorer
//   try { prodreq1 = new ActiveXObject("Msxml2.XMLHTTP"); }
//   catch(e) {
//       try { prodreq1 = new ActiveXObject("Microsoft.XMLHTTP"); }
//       catch(oc) { prodreq1 = null; }
//   }
   
//       // Mozailla/Safari
//   if (!prodreq1 && typeof XMLHttpRequest != "undefined") { prodreq1 = new XMLHttpRequest(); }
//   // Call the processChange() function when the page has loaded

//   if (prodreq1 != null) {
//       prodreq1.onreadystatechange = function(){
	   
// 		  if(prodreq1.readyState ==4 && prodreq1.status == 200)
// 		  {	
// 		   final_text=prodreq1.responseText ;
// 		  document.getElementById("student_list").innerHTML=final_text;
// 		  }
		  
// 		  }
// 		   prodreq1.open("GET", url, true);
//       prodreq1.send(null);
// 		  }
		  

// }



function select_student_detail(id){
//reg_no
getObject('enquiry_no').value = id.value;
}

// function myFunction() {
//   var x = document.getElementById("search_enquiry_name").value ;

//   getObject('enquiry_no').value = x.value;
// }
  $(document).on('click','#actionsubmit',function(e) {
       var total_amount=$('#total_amount').val();
       var fee_com_id=$('#fee_com_id').val();
    var data = $("#submit_form").serialize()+ "&total_amount="+total_amount+ "&fee_com_id="+fee_com_id;
                       var reg_no =$('#reg_no').val();
                      
                    //   var formData = $(this).serialize();
                    //   alert(data);
                       if(reg_no != ''){
                       
                                  $.ajax({

                type: "POST",
                                    //   contentType: "application/json; charset=utf-8",
               url: "<?= base_url('existing_data') ?>",
                  data:data,
                //   cache: false,
                success: function(data1) {
                    // alert(data1);
                    if(data1 ==2){
                        alert('Data Inserted');
                    }
                      if(data1 ==1){
                        alert('Data Not Inserted');
                    }
                }
            });
                       }else{
                       alert('Please enter Enquired Student Name OR Enquiry No');
                       }
                 });
           
            // });
$(document).ready(function(e) {

                 $(document).on('click', '#search', function() {
                       var reg_no =$('#reg_no1').val();
                    //   alert(reg_no);
                       if(reg_no != ''){
                       
                                  $.ajax({

                type: "POST",
                                       contentType: "application/json; charset=utf-8",
               url: "<?= base_url('search_reg_no') ?>",
                  data:JSON.stringify( {
                    reg_no: reg_no
                }),
                   cache: false,
                success: function(data) {
                      var data = JSON.parse(data);
                //   setTimeout(function(){
                
                if(data.user == 1){
                  alert('No data found');  
                }
                if(data.user != 1){
               $('.modal').removeClass('in');
                $('.modal').attr("aria-hidden","true");
                $('.modal').css("display", "none");
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
                      $('#first_name').val(data.user.first_name);
                      $('#middle_name').val(data.user.middle_name);
                      $('#last_name').val(data.user.last_name);
                      $('#section').val(data.user.section);
                      $('#category').html('<option value=' + data.user.category + '>' + data.user.category + '</option>');
                        $('#reg_no').val(data.user.reg_no);
                        $('#semister').val(data.user.semister);
                  $('#program').val(data.user.program);
                  $('#class').val(data.user.class);
                  $('#student_admission_id').val(data.user.student_admission_id);
                //   $('#last_school_attended').val(data.user.last_school_attended);
                //     $('#medium').val(data.user.medium);
                //      $('#percentage').val(data.user.percentage);
                //      $('#address').val(data.user.address);
                //      $('#student_gender').val(data.user.gender);
                }
                }
            });
                       }else{
                       alert('Please enter Enquired Student Name OR Enquiry No');
                       }
                 });
           
            });
</script>
<script>
    $('#dropdownYear').each(function() {

  var year = (new Date()).getFullYear();
  var current = year;
  year -= 4;
  for (var i = 0; i < 10; i++) {
    if ((year+i) == current)
      $(this).append('<option  value="' + (year + i) + '-' + (year+1 + i) + '">' + (year + i) + ' - ' +  (year+1 + i) +'</option>');
    else
      $(this).append('<option value="' + (year + i) + '-' + (year+1 + i) + '">' + (year + i) +  ' - ' +  (year+1 + i) +'</option>');
  }

})
</script>
<script>
    function myFunction() {
  var x = document.getElementById("search_enquiry_name").value ;
 $('#prospect_no').val(x);
//  $('.prospectus_no').show();
//   getObject('enquiry_no').value = x.value;
}

$("#hide").click(function(){
  $("p").show();
});

</script>
<?= $this->endSection() ?>

