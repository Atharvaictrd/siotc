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
    table {
    /*width: auto; */
    table-layout: auto;
    border-collapse: collapse;
}
td, th {
    white-space: nowrap; 
    /*padding: 5px;*/
    border: 1px solid black;
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

<?php
 $db  = \Config\Database::connect();
 $class_query = $db->query("SELECT * FROM class ORDER BY class_id ASC");
 $prpgram_sem_query = $db->query("SELECT * FROM program_sem ORDER BY program_sem_id ASC");
 $student_category_query = $db->query("SELECT * FROM student_category ORDER BY category_id ASC");
$fee_search_key=array();

$fee_search_key[] = 'active_status =0';

if(!empty($_POST['class_program'])){
$fee_search_key[]="program = '".($_POST['class_program'] ?? '')."'";
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
    $students = $stud_query->getResult();

    $sort_session = ($_POST['session'] ?? '');

    // Fee components map (selected session)
    $sort_components = [];
    $compRes = $db->query(
        "SELECT fee_component_id, component FROM fee_components WHERE session = ?",
        [$sort_session]
    )->getResult();
    foreach ($compRes as $c) {
        $sort_components[$c->fee_component_id] = strtolower(trim($c->component));
    }

    // Calculate outstanding once per student
    foreach ($students as $stu) {

        $totalFees = 0;
        $paidAmt   = 0;
        $schAmt    = 0;
        $conAmt    = 0;

        // Same as display: use the LAST fee row of that session
        $feeRows = $db->query(
            "SELECT fee_component_id FROM student_admission_fee
             WHERE student_admission_id = ? AND session = ?",
            [$stu->student_admission_id, $sort_session]
        )->getResult();

        $feeRow = !empty($feeRows) ? end($feeRows) : null;

        if ($feeRow) {
            foreach (explode(';', $feeRow->fee_component_id) as $item) {
                if ($item === '') continue;

                $parts  = explode('_', $item, 2);
                $compId = $parts[0] ?? '';
                $amount = (float) ($parts[1] ?? 0);

                $totalFees += $amount;

                // Paid for this component
                $p = $db->query(
                    "SELECT COALESCE(SUM(amount),0) AS paid
                     FROM fees_collection_detail
                     WHERE student_admission_id = ?
                       AND reg_no = ?
                       AND fee_component_id = ?",
                    [$stu->student_admission_id, $stu->reg_no, $compId]
                )->getRow();
                $paidAmt += (float) $p->paid;

                // Scholarship
                $cName = $sort_components[$compId] ?? '';
                if ($cName === 'scholarship' || $cName === 'scholarship fees') {
                    $schAmt = $amount;
                }
            }
        }

        // Concession (same as display: last row)
        $conRows = $db->query(
            "SELECT consession_amount FROM management_consession
             WHERE reg_no = ? AND session_year = ?",
            [$stu->reg_no, $sort_session]
        )->getResult();
        if (!empty($conRows)) {
            $conAmt = (float) end($conRows)->consession_amount;
        }

        $stu->sort_balance = max(0, $totalFees - $paidAmt - $conAmt - $schAmt);
    }

    // Highest outstanding first, zero/negative last
    usort($students, function ($a, $b) {
        return $b->sort_balance <=> $a->sort_balance;
    });

    $stud_query = $students;

}else{
    // $stud_query = $db->query("SELECT * FROM `student_admission_information`");
}

	if(isset($_POST['section']))
	{
        $update_status = false;
		for($i=1;$i<=($_POST['count'] ?? '');$i++)
		{
		     $student_admission_id  =  $_POST["student_admission_id_".$i];
		     $status = $_POST["status_".$i];
            $update_status = $db->query("UPDATE `student_admission_information` SET `Status_Distribution`='$status' WHERE student_admission_id = '$student_admission_id'");
    // 		echo "<script>alert('$student_admission_id')</script>";
		}
		if($update_status){
		    echo '<script language="javascript">alert("Students are Categorised..... as regular or orregular..");</script>';
		    echo "<meta http-equiv='refresh' content='0'>";
		}
	}

?>


<div class="row">

<div class="col-xl-12">

<div class="panel panel-inverse" data-sortable-id="form-validation-1">

<div class="panel-heading">
<h3 class="panel-title">Section Allocation</h3>
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
                <option value="<?=$class_row->class_id;?>"><?=$class_row->class;?></option>
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


<br>
</div>


<div class="hljs-wrapper">
<pre><code class="html" data-url="<?= base_url('assets/data/form-validation/code-1.json'); ?>"></code></pre>
</div>

</div>

</div>



</div>

<!---->

<div class="col-xl-12">

<div class="panel panel-inverse">

<div class="panel-body">
  <div id="mydiv">
      <table  width="100%">
          <?php
          if($stud_query== true){
          ?>
        <tr>
        <td>
		 <table  width="100%" class="table-bordered"  border="1" style="border-collapse:collapse;border-color:#000000; font-family:Tahoma, Geneva, sans-serif;" align="center" cellpadding="1" cellspacing="0" >
		  <tr>
           
            <td align="center" colspan="13"><h2>STUDENT BALANCE REPORT</h2>
            <h2>
                <?php
                $class_id= ($_POST['class_program'] ?? '');
                $p_r= $db->query("SELECT * FROM class WHERE class_id='$class_id'")->getRow();
                ?>
                <?php echo $p_r->class;echo '&nbsp;&nbsp;&nbsp;'; echo ($_POST['semister'] ?? '');echo '&nbsp;&nbsp;&nbsp;'; echo ($_POST['category'] ?? ''); ?></h2>
            <h4>SESSION YEAR : <?php echo ($_POST['session'] ?? ''); ?></h4> </td>
             
           </tr>
            <tr>
           
            <td align="center" colspan="13">Printed Date : <b><?php echo date('d/m/Y'); echo '&nbsp;&nbsp;'; //echo date('H:i:s'); ?></b></td>
             
           </tr>
				  <tr>
                    <td align="center"><b style="font-size:12px">Sr No.</b></td>
					<td align="center"><b style="font-size:12px">Name</b></td>
                    <td align="center"><b style="font-size:12px">Category</b></td>
                    <td align="center"><b style="font-size:12px">Reference</b></td>           
                    <td align="center"><b style="font-size:12px">Total Fees</b></td>
                    <td align="center"><b style="font-size:12px">Admission Fees<br>Total/Paid</b></td>
                    <td align="center"><b style="font-size:12px">Other Fees<br>Total/Paid</b></td>
                    <!--<td align="center"><b style="font-size:12px">Development Fees<br>Total/Paid</b></td>-->
                    <td align="center"><b style="font-size:12px">Paid</b></td>
                    <td align="center"><b style="font-size:12px">Consession</b></td>
                    <td align="center"><b style="font-size:12px">ScholorShip</b></td>
                    <td align="center"><b style="font-size:12px">Tution Fees<br>Total/Paid</b></td>
				    <td align="center"><b style="font-size:12px">Outstanding</b></td>
				 </tr>
             <?php
              $sr = 1;
			 $count=0;
			 $total_consession = 0;
			 $total_tution = 0;
			 $component = ($_POST['component_name'] ?? '');
			 $total_amount=0;
			 $total_outstanding=0;
			 $sub_total_paid=0;
			 $total_amount_component = 0;
			 $total_actual_scholarship=0;
			 $total_rec_scholarship=0;
             $paid_scholarship = 0;
			 $total_admission = 0;
            $total_paid_admission = 0;
            $total_other = 0;
            $total_paid_other = 0;
            // $total_development = 0;
            // $total_paid_development = 0;
            // $development_amt = 0;
            // $paid_development_amt = 0;
            $total_tuition = 0;
            $total_paid_tuition = 0;

			 
			 // Load fee components for selected session
$selected_session = ($_POST['session'] ?? '');

$component_query = $db->query("
    SELECT fee_component_id, component
    FROM fee_components
    WHERE session = '".$selected_session."'
");

$fee_components = [];

foreach ($component_query->getResult() as $component_row) {
    $fee_components[$component_row->fee_component_id] = strtolower(trim($component_row->component));
}

			  foreach ($stud_query as $stud_query_row) {
			      $admission_amt = 0;
$other_amt = 0;
$sch_amt = 0;
			      //for Reference Details
			      $query1= $db->query("SELECT * FROM prospect_sales WHERE prospect_no='".$stud_query_row->prospectus_no."'");
// echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 foreach ($query1->getResult() as $query1_row) {
     
 }
  $query2= $db->query("SELECT * FROM marketing_enquiry WHERE enquiry_no='".$query1_row->enquiry_no."'");
   foreach ($query2->getResult() as $query2_row) {
     
 }
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
$sql = $db->query("select * from management_consession where reg_no = '".$stud_query_row->reg_no."' and session_year='".($_POST['session'] ?? '')."'");
 foreach($sql->getResult() as $d)
	{
		$con_amt =  $d->consession_amount;
	
	 }
              
             ?>
			 
			 <tr  style="font-size:12px;">
			     <?php 
			     //echo $total_fees1=$fees_detail_data['student_add_fee_id']; echo '#'; 
			     ?>
				 <td ><?=$sr++;?></td>
				
				 <td style="font-size:11px;"><?=$stud_query_row->first_name;?> <?=$stud_query_row->middle_name;?> <?=$stud_query_row->last_name;?></td>
                <td ><?=$stud_query_row->category;?></td>
                <td><?php echo $query2_row->reference_details?:'Not Specified'; ?> </td>
                <td align="center">
                     <?php 
				
					$fees_detail_query2 =  $db->query("SELECT * FROM student_admission_fee WHERE student_admission_id='".$stud_query_row->student_admission_id."' and session = '".($_POST['session'] ?? '')."' ");
					foreach($fees_detail_query2->getResult() as $fees_detail_query22){
					    
					}
					$fees_data2 = explode(';',$fees_detail_query22->fee_component_id);
					$count1=0;
				$Actual_Amount1=0;
				$paid_Amount=0;
				foreach($fees_data2 as $key=>$value1){
					
				$count1++;
				if(!empty($value1)){
				list($component,$amount1)=explode('_',$value1);
				$Actual_Amount1= $Actual_Amount1+$amount1;
				}
				}
    //                 $total_fees=$fees_row->total_amount;
				// 	echo number_format($total_fees,2);
				//     $total_amount = $total_amount+$total_fees;
				    
				     $total_fees=$Actual_Amount1;
					echo number_format($total_fees,2);
				    $total_amount = $total_amount+$total_fees;
                    ?> 
                    </td>
                    
                <td align="center">
                    <?php
                    
                    $fees_detail_query = $db->query("
                        SELECT fee_component_id
                        FROM student_admission_fee
                        WHERE student_admission_id = '".$stud_query_row->student_admission_id."'
                        AND session = '".$selected_session."'
                        LIMIT 1
                    ");
                    
                    $paid_admission_amt = 0;
                    
                    $fee_detail = $fees_detail_query->getRow();
                    
                    $admission_components = [
                        'admission fees',
                        'd. batu registration fees',
                        'insurance fees',
                        't & p fees',
                        'learning material fees'
                    ];
                    
                    if ($fee_detail) {
                    
                        $fees_data = explode(';', $fee_detail->fee_component_id);
                    
                        foreach ($fees_data as $fee_value) {
                    
                            if (empty($fee_value)) {
                                continue;
                            }
                    
                            list($component_id, $amount) = explode('_', $fee_value);
                    
                            $component_name = strtolower(
                                trim($fee_components[$component_id] ?? '')
                            );
                    
                            // All these components are treated as Admission Fees
                            if (in_array($component_name, $admission_components)) {
                    
                                // Total admission fee
                                $admission_amt += (float)$amount;
                    
                                // Paid amount
                                $paid_query = $db->query("
                                    SELECT SUM(amount) AS paid_amount
                                    FROM fees_collection_detail
                                    WHERE student_admission_id = '".$stud_query_row->student_admission_id."'
                                    AND reg_no = '".$stud_query_row->reg_no."'
                                    AND fee_component_id = '".$component_id."'
                                    AND session_year = '".$selected_session."'
                                ");
                    
                                $paid_row = $paid_query->getRow();
                    
                                if ($paid_row && $paid_row->paid_amount !== null) {
                                    $paid_admission_amt += (float)$paid_row->paid_amount;
                                }
                            }
                        }
                    }
                    
                    // Grand totals
                    $total_admission += $admission_amt;
                    $total_paid_admission += $paid_admission_amt;
                    
                    // Display: Total Admission Fee / Paid Admission Fee
                    echo number_format($admission_amt, 2);
                    echo ' / ';
                    echo number_format($paid_admission_amt, 2);
                    
                    ?>
                    </td>

				<td align="center">
                        <?php
                        
                        $other_amt = 0;
                        $paid_other_amt = 0;
                        
                        $fees_detail_query = $db->query("
                            SELECT fee_component_id
                            FROM student_admission_fee
                            WHERE student_admission_id = '".$stud_query_row->student_admission_id."'
                            AND session = '".$selected_session."'
                            LIMIT 1
                        ");
                        
                        $fee_detail = $fees_detail_query->getRow();
                        
                        if ($fee_detail) {
                        
                            $fees_data = explode(';', $fee_detail->fee_component_id);
                        
                            foreach ($fees_data as $fee_value) {
                        
                                if (empty($fee_value)) {
                                    continue;
                                }
                        
                                list($component_id, $amount) = explode('_', $fee_value);
                        
                                $component_name = $fee_components[$component_id] ?? '';
                        
                                // Other Fee
                                if (strpos($component_name, 'other') !== false) {
                        
                                    $other_amt += (float)$amount;
                        
                                    // Get paid amount
                                    $paid_query = $db->query("
                                        SELECT SUM(amount) AS paid_amount
                                        FROM fees_collection_detail
                                        WHERE student_admission_id = '".$stud_query_row->student_admission_id."'
                                        AND reg_no = '".$stud_query_row->reg_no."'
                                        AND fee_component_id = '".$component_id."'
                                        AND session_year = '".$selected_session."'
                                    ");
                        
                                    $paid_row = $paid_query->getRow();
                        
                                    if ($paid_row && $paid_row->paid_amount !== null) {
                                        $paid_other_amt += (float)$paid_row->paid_amount;
                                    }
                                }
                            }
                        }
                        
                        // $total_other = ($total_other ?? 0) + $other_amt;
                        $total_other += $other_amt;
                        $total_paid_other += $paid_other_amt;
                        
                        // Show: Fee Amount / Paid Amount
                        echo number_format($other_amt, 2);
                        echo ' / ';
                        echo number_format($paid_other_amt, 2);
                        
                        ?>
                        </td>
				    
				<!--<td align="center">-->
                        <?php
            //             $total_development = 0;
            // $total_paid_development = 0;
            // $development_amt = 0;
            // $paid_development_amt = 0;
            //             $fees_detail_query = $db->query("
            //                 SELECT fee_component_id
            //                 FROM student_admission_fee
            //                 WHERE student_admission_id = '".$stud_query_row->student_admission_id."'
            //                 AND session = '".$selected_session."'
            //                 LIMIT 1
            //             ");
                        
            //             $fee_detail = $fees_detail_query->getRow();
                        
            //             if ($fee_detail) {
                        
            //                 $fees_data = explode(';', $fee_detail->fee_component_id);
                        
            //                 foreach ($fees_data as $fee_value) {
                        
            //                     if (empty($fee_value)) {
            //                         continue;
            //                     }
                        
                                // list($component_id, $amount) = explode('_', $fee_value);
                        
                                // $component_name = $fee_components[$component_id] ?? '';
                        
                                // // Other Fee
                                // if (strpos($component_name, 'development') !== false) {
                        
                                //     $development_amt += (float)$amount;
                        
                                //     // Get paid amount
                                //     $paid_query = $db->query("
                                //         SELECT SUM(amount) AS paid_amount
                                //         FROM fees_collection_detail
                                //         WHERE student_admission_id = '".$stud_query_row->student_admission_id."'
                                //         AND reg_no = '".$stud_query_row->reg_no."'
                                //         AND fee_component_id = '".$component_id."'
                                //         AND session_year = '".$selected_session."'
                                //     ");
                        
                                //     $paid_row = $paid_query->getRow();
                        
                        //             if ($paid_row && $paid_row->paid_amount !== null) {
                        //                 $paid_development_amt += (float)$paid_row->paid_amount;
                        //             }
                        //         }
                        //     }
                        // }
                        
                        // // $total_other = ($total_other ?? 0) + $other_amt;
                        // $total_development += $development_amt;
                        // $total_paid_development += $paid_development_amt;
                        
                        // // Show: Fee Amount / Paid Amount
                        // echo number_format($development_amt, 2);
                        // echo ' / ';
                        // echo number_format($paid_development_amt, 2);
                        
                        ?>
                        <!--</td>-->
				    
				<td align="center" >
				      <?php   
				  echo number_format($paid_Amount1,2);
				  $sub_total_paid = $sub_total_paid +  $paid_Amount1;
				 
				  ?>
				  </td>
				<td align="center"><?php echo number_format($con_amt,2); ?>  </td>
                <td align="center">  
                    	<?php 
					//$sch_amt =  _scholorShip($student_detail['category'],$_POST['sem'],$_POST['session']);
					$fees_detail_query1 =  $db->query("SELECT * FROM student_admission_fee WHERE student_admission_id='".$stud_query_row->student_admission_id."' and session = '".($_POST['session'] ?? '')."' ");
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
            				// $cmpName=$general->component($component); 
            				$fees_detail_query3 = $db->query("SELECT * FROM fee_components WHERE fee_component_id='$component' and session = '".$_SESSION['session_year']."'  ");
		 foreach ($fees_detail_query3->getResult() as $cmpName) {
		 }
            				$cmpid=$cmpName->fee_component_id;
            				$cname=$cmpName->component;
            				if($cname=='Scholarship'|| $cname=='Scholarship Fees')
                    		{
                    			 $sch_amt=$amount;
                    		}
            			 }
        				}
				// 	echo $sch_amt;
					
					echo number_format($sch_amt,2);
					 ?>
				</td>
				 	<td align="center">
                        <?php
                                    $tuition_amt = 0;
            $paid_tuition_amt = 0;
                        $fees_detail_query = $db->query("
                            SELECT fee_component_id
                            FROM student_admission_fee
                            WHERE student_admission_id = '".$stud_query_row->student_admission_id."'
                            AND session = '".$selected_session."'
                            LIMIT 1
                        ");
                        
                        $fee_detail = $fees_detail_query->getRow();
                        
                        if ($fee_detail) {
                        
                            $fees_data = explode(';', $fee_detail->fee_component_id);
                        
                            foreach ($fees_data as $fee_value) {
                        
                                if (empty($fee_value)) {
                                    continue;
                                }
                        
                                list($component_id, $amount) = explode('_', $fee_value);
                        
                                $component_name = $fee_components[$component_id] ?? '';
                        
                                // Other Fee
                                if (strpos($component_name, 'tuition') !== false) {
                        
                                    $tuition_amt += (float)$amount;
                        
                                    // Get paid amount
                                    $paid_query = $db->query("
                                        SELECT SUM(amount) AS paid_amount
                                        FROM fees_collection_detail
                                        WHERE student_admission_id = '".$stud_query_row->student_admission_id."'
                                        AND reg_no = '".$stud_query_row->reg_no."'
                                        AND fee_component_id = '".$component_id."'
                                        AND session_year = '".$selected_session."'
                                    ");
                        
                                    $paid_row = $paid_query->getRow();
                        
                                    if ($paid_row && $paid_row->paid_amount !== null) {
                                        $paid_tuition_amt += (float)$paid_row->paid_amount;
                                    }
                                }
                            }
                        }
                        
                        // $total_other = ($total_other ?? 0) + $other_amt;
                        $total_tuition += $tuition_amt;
                        $total_paid_tuition += $paid_tuition_amt;
                        
                        $tuition_after_concession = $tuition_amt - $con_amt;

                        if ($tuition_after_concession < 0) {
                            $tuition_after_concession = 0;
                        }
                        
                        echo number_format($tuition_after_concession, 2);
                        echo ' / ';
                        echo number_format($paid_tuition_amt, 2);
                        
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
				<td align="center"><h6><b><?php echo  number_format($total_amount,2);?></b></h6></td>
				<td align="center"><h6><b><?php echo number_format($total_admission, 2);echo ' / ';
                                 echo number_format($total_paid_admission, 2);?></b></h6></td>

                <td align="center"><h6><b><?php echo number_format($total_other, 2); echo ' / ';
                            echo number_format($total_paid_other, 2); ?></b> </h6></td>
                            
                <!--<td align="center"><h6><b>-->
                <?php #echo number_format($total_development, 2); echo ' / ';
                            #echo number_format($total_paid_development, 2); ?>
                            <!--</b> </h6></td>-->
			
				<td align="center"><h6><b><?php echo  number_format($sub_total_paid,2);?></b></h6></td>
               
				<td align="center"><h6><b><?php echo  number_format($total_consession, 2);?></b></h6></td>
				 <td align="center">&nbsp;</td>
				<td align="center">
                <h6><b>
                        <?php
                        $total_tuition_after_concession = $total_tuition - $total_consession;
                        if ($total_tuition_after_concession < 0) {
                            $total_tuition_after_concession = 0;
                        }
                        echo number_format($total_tuition_after_concession, 2);
                        echo ' / ';
                        echo number_format($total_paid_tuition, 2);
                        ?>
                    </b></h6></td>
				<td align="center"><h6><b><?php  
				echo number_format($total_outstanding,2);
				?></b></h6></td>
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
       
       <center>  
       <input type="button" value="Print" class="Print btn btn-warning mt-3" onclick="PrintElem('#mydiv')" /> 
       <input type="button" value="Export to Excel" class="btn btn-warning mt-3" onclick="exportToExcel()" />
       </center>
       
     
</div>
<?php
function paid_fees_collection($student_id=null,$reg_no,$f_com_id=null){
// $data_query = $db->query("SELECT * FROM fees_collection_detail WHERE student_admission_id ='$student_id' AND reg_no ='$reg_no' AND fee_component_id='$f_com_id'");
            //   foreach ($data_query->getResult() as $data) {
    // $data_query  = mysql_query("SELECT * FROM fees_collection_detail WHERE student_admission_id='".$student_id."' AND reg_no='".$reg_no."' AND 	fee_component_id='".$f_com_id."'");
		
	$total_amount = 0;
// 	while($data = mysql_fetch_array($data_query)){
	
// 	 $total_amount = $total_amount + $data->amount;
            //   }
	return('$total_amount');
	
}
?>


<div class="hljs-wrapper">
<pre><code class="html" data-url="<?= base_url('assets/data/table-manage/keytable.json'); ?>"></code></pre>
</div>

</div>

</div>
<!---->
</div>

</div>
<?php
function paid_fees_collection_by_comp($student_id=null,$reg_no,$f_com_id=null){
	$fees_detail_query = $db->query("SELECT * FROM fees_collection_detail WHERE student_admission_id ='$student_id' AND reg_no ='$reg_no' AND fee_component_id='$f_com_id'");
              foreach ($fees_detail_query->getResult() as $fees_row) {
// 		$data_query  = tep_db_query("SELECT * FROM ".TABLE_FEES_COLLECTION_DETAIL." WHERE student_admission_id='".$student_id."' AND reg_no='".$reg_no."' AND 	fee_component_id='".$f_com_id."'");
		
	$total_amount = 0;
// 	while($data = tep_db_fetch_array($data_query)){
	$total_amount = $total_amount +$fees_row['amount'];
	}
	
	return($total_amount);
	}	
?>

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

<!--for session select-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!--end for session select-->

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
<script>
    $('#dropdownYear').each(function() {

  var year = (new Date()).getFullYear();
  var current = year;
  year -= 20;
  for (var i = 0; i < 21; i++) {
    if ((year+i) == current)
      $(this).append('<option  value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) + '-' +  (year+1 + i) +'</option>');
    else
      $(this).append('<option value="' + (year + i) + '-' +  (year+1 + i) + '">' + (year + i) +  '-' +  (year+1 + i) +'</option>');
  }

});

</script>

<script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.1.min.js" > </script> 

 <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>
  
  
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
function exportToExcel() {
      var table = document.querySelector("#mydiv table");
      var wb = XLSX.utils.table_to_book(table, { sheet: "Sheet1" });
      XLSX.writeFile(wb, "Student_Balance_Report.xlsx");
    }
</script>
<?= $this->endSection() ?>

