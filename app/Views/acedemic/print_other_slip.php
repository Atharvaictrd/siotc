<?php
$action = ($_GET['action'] ?? '');
 $id= ($_GET['id'] ?? '');
if($action =='preview'){
  $id= ($_GET['id'] ?? '');
     $db  = \Config\Database::connect();
   $data_query  = $db->query("SELECT * FROM  other_fees WHERE ID='".$id."'");
		

	 foreach ($data_query->getResult() as $Data) {
	     $DataID=$Data->ID;
 $student_admission_id=$Data->student_admission_id;
	 }
$query1= $db->query("SELECT * FROM student_admission_information WHERE student_admission_id='$student_admission_id'"); 
                                                foreach ($query1->getResult() as $row1) {

                                                    //  echo ' <option value="'.$row1->reg_no.'">'.$row1->salutation." . ".$row1->first_name." ".$row1->last_name.'</option>';
                                                  }
}
	//Fees Amount 

	 
	  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Fees Receipt</title>
<style type="text/css">
<!--
body{
background:#ffffff;
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:12px;
}
.main_container{
border:1px solid #000000;
}
.content{
border:1px solid #000000;
}
.style1 {
	font-family: Impact;
	font-size: 28px;
}
.style3 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 15px;
}
.style5 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style6 {border: 1px solid #000000; font-weight: bold; }
.style7 {font-size: 15px; font-family: Arial, Helvetica, sans-serif;}
.style8 {font-weight: bold}
.table1 {
    /*margin-left:50px;*/
    margin-left:100px;
}
</style>
</head>

<body onload="window.print();" style="padding-left:10px;">
<!--1st Receipt-->
<table width="400" class="table1">
    <tr>
        <td style="border: 1px solid;">
    
            <table width="400"  cellspacing="10" cellpadding="0">
      <tr>
        <td><table  align="center"  class="main_container">
          <tr>
            <td>
    		<img src="<?php echo base_url('assets/img/somya_tech_logo.png') ?>" width="100%" style="border: none;"/>
    		</td>
    		
                </tr>
            </table></td>
          </tr>
          <tr>
            <td border="0"><table width="100%" border="0" cellpadding="4" cellspacing="0" class="content">
                <tr>
                  <td width="14%"><strong>REC. NO.</strong> </td>
                  <td colspan="2"><strong>: </strong><?php echo $Data->ID;?></td>
                  <td width="26%" align="right"><strong>DATE :</strong> </td>
                  <td width="22%"><?php  $originalDate=$Data->Date; echo $newDate = date("d-m-Y", strtotime($originalDate));;?></td>
                </tr>
                <tr>
                  <td><strong>NAME</strong></td>
                  <td colspan="4" style="text-transform:uppercase;"><strong>:</strong> <?php echo $row1->salutation.' . '.$row1->first_name.' '.$row1->middle_name.' '.$row1->last_name;?></td>
                </tr>
                <tr>
                  <td><strong>Branch</strong></td>
                  <!--<td width="14%"><strong>:</strong><?php //echo $student_info[3]['program'];?></td>-->
                  <?php  $query13= $db->query("SELECT * FROM class WHERE class_id='".$row1->program."' ");
//  $data5['source']=$query3->getResultArray();
// }
    	 foreach($query13->getResult() as $row13){
            //  $cat_id = $row['id'];
            // print_r($value);
        $program1=$row13->class;
}
?>
                  <td colspan="4"><strong>:</strong> <?php echo $program1;?></td>
                </tr>
                <tr>
                    <td width="24%"><strong>Year :</strong> </td>
                    <td colspan="4"><strong>:</strong> <?php echo $row1->semister;?></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td border="0"><table cellspacing="0" cellpadding="1" width="100%" class="normal-text" border="1" style="border:1px solid #000000;border-collapse:collapse;">
                <tr>
                  <td width="70px" height="30" bgcolor="#EFEFEF"><b>Sr. No.</b></td>
                  <td width="400px" bgcolor="#EFEFEF"><b>Particulars</b></td>
                  <td width="150px" align="center" bgcolor="#EFEFEF"><b>Amount(Rs.)</b></td>
                </tr>
                <?php
    
    		
    			?>
    			<tr>
                  <td align="center" height="22"><?php echo '1';?></td>
                  <td style="padding-left:20px;"><?php echo $Data->c_name; ?></td>
                  <td align="right" style="padding-right:20px;"><?php echo number_format($Data->c_amount,2);?></td>
                </tr>
               
 
        
    	 <tr>
                  <td height="23">&nbsp;</td>
                  <td valign="middle" style="padding-left:20px;"><b>Total Amount</b></td>
                  <td align="right" valign="middle" style="padding-right:20px;"><b><?php echo number_format($Data->c_amount,2);?></b></td>
                </tr>        
    			<tr>
                  <td colspan="3" height="55" valign="middle">&nbsp;&nbsp;&nbsp;<strong><?php echo 'By '.$Data->paid_type;?></strong></span> </td>
                </tr>
    			<tr>
                  
                </tr>
            </table></td>
          </tr>
          <!--<tr>-->
          <!--  <td height="59" border="0" align="right" valign="bottom">RECEIVERS SIGNATURE </td>-->
          <!--</tr>-->
    <tr>
            <td height="29" border="0" align="left" valign="bottom">Printed By <b><?php echo $_SESSION['adminloggedname']; ?></b></td>
          </tr>
        </table>
        </td> 
    </tr>
</table> 
<br>
<!--2nd Receipt-->
<table width="400" class="table1">
    <tr>
        <td style="border: 1px solid;">
    
            <table width="400"  cellspacing="10" cellpadding="0">
      <tr>
        <td><table  align="center"  class="main_container">
        <tr>
            <td>
    		<img src="<?php echo base_url('assets/img/somya_tech_logo.png') ?>" width="100%" style="border: none;"/>
    		</td>
    		
                </tr>
            </table></td>
          </tr>
          <tr>
            <td border="0"><table width="100%" border="0" cellpadding="4" cellspacing="0" class="content">
                <tr>
                  <td width="14%"><strong>REC. NO.</strong> </td>
                  <td colspan="2"><strong>: </strong><?php echo $Data->ID;?></td>
                  <td width="26%" align="right"><strong>DATE :</strong> </td>
                  <td width="22%"><?php  $originalDate=$Data->Date; echo $newDate = date("d-m-Y", strtotime($originalDate));;?></td>
                </tr>
                <tr>
                  <td><strong>NAME</strong></td>
                  <td colspan="4" style="text-transform:uppercase;"><strong>:</strong> <?php echo $row1->salutation.' . '.$row1->first_name.' '.$row1->middle_name.' '.$row1->last_name;?></td>
                </tr>
                <tr>
                  <td><strong>Branch</strong></td>
                  <!--<td width="14%"><strong>:</strong><?php //echo $student_info[3]['program'];?></td>-->
                                   <?php  $query13= $db->query("SELECT * FROM class WHERE class_id='".$row1->program."' ");
//  $data5['source']=$query3->getResultArray();
// }
    	 foreach($query13->getResult() as $row13){
            //  $cat_id = $row['id'];
            // print_r($value);
        $program1=$row13->class;
}
?>
                  <td colspan="4"><strong>:</strong> <?php echo $program1;?></td>
                </tr>
                <tr>
                    <td width="24%"><strong>Year :</strong> </td>
                    <td colspan="4"><strong>:</strong> <?php echo $row1->semister;?></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td border="0"><table cellspacing="0" cellpadding="1" width="100%" class="normal-text" border="1" style="border:1px solid #000000;border-collapse:collapse;">
                <tr>
                  <td width="70px" height="30" bgcolor="#EFEFEF"><b>Sr. No.</b></td>
                  <td width="400px" bgcolor="#EFEFEF"><b>Particulars</b></td>
                  <td width="150px" align="center" bgcolor="#EFEFEF"><b>Amount(Rs.)</b></td>
                </tr>
                <?php
    
    		
    			?>
    			<tr>
                  <td align="center" height="22"><?php echo '1';?></td>
                  <td style="padding-left:20px;"><?php echo $Data->c_name; ?></td>
                  <td align="right" style="padding-right:20px;"><?php echo number_format($Data->c_amount,2);?></td>
                </tr>
               
 
        
    	 <tr>
                  <td height="23">&nbsp;</td>
                  <td valign="middle" style="padding-left:20px;"><b>Total Amount</b></td>
                  <td align="right" valign="middle" style="padding-right:20px;"><b><?php echo number_format($Data->c_amount,2);?></b></td>
                </tr>        
    			<tr>
                  <td colspan="3" height="55" valign="middle">&nbsp;&nbsp;&nbsp;<strong><?php echo 'By '.$Data->paid_type;?></strong></span> </td>
                </tr>
    			<tr>
                  
                </tr>
            </table></td>
          </tr>
          <!--<tr>-->
          <!--  <td height="59" border="0" align="right" valign="bottom">RECEIVERS SIGNATURE </td>-->
          <!--</tr>-->
    <tr>
            <td height="29" border="0" align="left" valign="bottom">Printed By <b><?php echo $_SESSION['adminloggedname']; ?></b></td>
          </tr>
        </table>
        </td> 
    </tr>
</table> 
    
 
</body>
</html>