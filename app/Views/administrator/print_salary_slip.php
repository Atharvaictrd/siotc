<?php
$action = ($_GET['action'] ?? '');
 $id= ($_GET['id'] ?? '');
if($action =='preview'){
  $id= ($_GET['id'] ?? '');
     $db  = \Config\Database::connect();
   $emp_data  = $db->query("SELECT * FROM  employees WHERE id='".$id."'")->getRow();
		
		$salary_data  = $db->query("SELECT * FROM  salaries WHERE emp_id='".$emp_data->emp_id."' AND pay_month='".($_GET['month'] ?? '')."'")->getRow();
		
}
	 
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
    margin-left:50px;
}
</style>
</head>

<body onload="window.print();" style="padding-left:10px;">
<!--1st Receipt-->
<table width="600" class="table1">
    <tr>
        <td style="border: 1px solid;">
    
            <table width="600"  cellspacing="10" cellpadding="0">
      <tr>
        <td><table  align="center"  class="main_container">
          <tr>
            <td >
    		<img src="<?=base_url()?>assets/img/somya_tech_logo.png" width="100%"  style="border: none;"/>
    		</td>
    		
                </tr>
            </table></td>
          </tr>
             
          <tr>
            <td border="0"><table width="100%" border="0" cellpadding="4" cellspacing="0" class="content">
               <tr>
       
           <td colspan="5" align="center" style="font-size: 20px; font-weight: bold; padding: 10px 10px;text-decoration:underline;">
      SALARY SLIP
    </td>
    		
               </td>
          </tr>
                <tr>
                  <td width="14%"><strong>EMP ID.</strong> </td>
                  <td colspan="2"><strong>: </strong><?=$emp_data->emp_id;?></td>
                  <td width="26%" align="right"><strong>DATE :</strong> </td>
                  <td width="22%"><?=$date = date("Y-m-d", strtotime($salary_data->generate_date));;?></td>
                </tr>
                <tr>
                  <td><strong>Employee Name</strong></td>
                  <td colspan="4" style="text-transform:uppercase;"><strong>:</strong> <?=$emp_data->name;?></td>
                </tr>
                <tr>
                  <td><strong>Designation</strong></td>
                
                  <td colspan="4"><strong>:</strong> <?=$emp_data->designation;?></td>
                </tr>
                <tr>
                    <td width="24%"><strong>Month :</strong> </td>
                    <td colspan="4"><strong>:</strong> <?=$salary_data->pay_month;?></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td border="0"><table cellspacing="0" cellpadding="1" width="100%" class="normal-text" border="1" style="border:1px solid #000000;border-collapse:collapse;">
                <tr>
                  <td width="70px" height="30" bgcolor="#EFEFEF"><b>Sr. No.</b></td>
                  <td width="400px" bgcolor="#EFEFEF"><b>
Description</b></td>
                  <td width="150px" align="center" bgcolor="#EFEFEF"><b>Amount(Rs.)</b></td>
                </tr>
               <?php
               $sn = 1;
               $total_amt = 0;
               $qry  = $db->query("SELECT * FROM  salaries WHERE emp_id='".$emp_data->emp_id."' AND pay_month='".($_GET['month'] ?? '')."'");
               foreach ($qry->getResult() as $row) {
                   
               ?>
    			<tr>
                  <td align="center" height="22"><?=$sn++;?></td>
                  <td style="padding-left:20px;"><?=$row->payhead_name;?></td>
                  <td align="right" style="padding-right:20px;"><?=number_format($row->pay_amount, 2, '.', ',');?></td>
                </tr>    
         
                <?php $total_amt +=$row->pay_amount;
                
                } ?>
    	 <tr>
                  <td height="23">&nbsp;</td>
                  <td valign="middle" style="padding-left:20px;"><b>Total Amount</b></td>
                  <td align="right" valign="middle" style="padding-right:20px;"><b><?=number_format($salary_data->net_salary, 2, '.', ',');?></b></td>
                </tr>  
    			<tr>
                  
                </tr>
            </table></td>
          </tr>
          <tr>
            
            <td height="59" border="0" align="right" valign="bottom">Authorized Signature</td>
          </tr>
 <tr>
            <td  align="right" valign="bottom">_______________________</td>
          </tr>
    <tr>
            <td height="20" border="0" align="left" valign="bottom">Printed By <b> superadmin</b></td>
          </tr>
        </table>
<br>
<br>
<!--2nd Receipt-->
   
 
</body>
</html>