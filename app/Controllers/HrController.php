<?php

namespace App\Controllers;
use App\Models\HrModel;

class HrController extends BaseController
{
    private $db;
    public function __construct()
	{
	    
		helper(['url', 'session', 'cookie', 'form']);
		if (!isset($session)) {
			$session = session();
		}
		$session = \Config\Services::session();
    // $this->load->library('session');
    $session = session();
    $this->db = db_connect();
	}
	public function add_teacher(){
	    return view('administrator/add_teachers');
	}
	public function hr_management(){
	    return view('administrator/hr_management');
	}
	public function add_new_employee(){
	    $db = \Config\Database::connect();
        $emp_id = $this->request->getVar('emp_id');
        $salary = $this->request->getVar('basic_salary');
        $full_name = $this->request->getVar('full_name');
        $email = $this->request->getVar('email');
        $mobile = $this->request->getVar('mobile');
        $joining_date = $this->request->getVar('joining_date');
        $dob = $this->request->getVar('dob');
        $gender = $this->request->getVar('gender');
        $photo = $this->request->getFile('photo');
        
        
        if ($photo == '') {
            $new_photo = '';
            } else {
                if ($photo->isValid() || !$photo->hasMoved()) {
                    $new_photo = $full_name.$photo->getRandomName();
                    $photo->move('emp_photo/', $new_photo);
                }
            }
            
        $address = $this->request->getVar('address');
        $city = $this->request->getVar('city');
        $state = $this->request->getVar('state');
        $country = $this->request->getVar('country');
        $designation = $this->request->getVar('designation');
        $department = $this->request->getVar('department');
        $pan_no = $this->request->getVar('pan_no');
        $bank_name = $this->request->getVar('bank_name');
        $account_no = $this->request->getVar('account_no');
        $ifsc_code = $this->request->getVar('ifsc_code');
        $pf_account = $this->request->getVar('pf_account');
        
        $query=$db->query("INSERT INTO `employees`(`salary`,`emp_id`, `name`, `email`, `mobile`, `dob`, `gender`, `address`, `city`, `state`, `country`, `designation`, `photo`, `doj`, `department`, `pan_no`, `bank_name`, `account_no`, `ifsc_code`, `pf_account`) VALUES ('$salary','$emp_id','$full_name','$email','$mobile','$dob','$gender','$address','$city','$state','$country','$designation','$new_photo','$joining_date','$department','$pan_no','$bank_name','$account_no','$ifsc_code','$pf_account')");
        
        if (!$query) {
            return  redirect()->to('hr_management')->with('error', 'Failed to Add !.');
            // return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('hr_management')->with('success', 'Employee Added successfully !.');
        }
	    
	}
	public function update_employee(){
	    $db = \Config\Database::connect();
        $id = $this->request->getVar('id');
        $emp_id = $this->request->getVar('emp_id');
        $full_name = $this->request->getVar('full_name');
        $salary = $this->request->getVar('basic_salary');
        $email = $this->request->getVar('email');
        $mobile = $this->request->getVar('mobile');
        $joining_date = $this->request->getVar('joining_date');
        $dob = $this->request->getVar('dob');
        $gender = $this->request->getVar('gender');
        $photo = $this->request->getFile('photo');
        if ($photo == '') {
            
            $enq_sql = $db->query("SELECT * FROM employees WHERE id='$id'")->getRow();
            $new_photo = $enq_sql->photo;
            } else {
                if ($photo->isValid() || !$photo->hasMoved()) {
                    $new_photo = $full_name.$photo->getRandomName();
                    $photo->move('emp_photo/', $new_photo);
                }
            }
            
        $address = $this->request->getVar('address');
        $city = $this->request->getVar('city');
        $state = $this->request->getVar('state');
        $country = $this->request->getVar('country');
        $designation = $this->request->getVar('designation');
        $department = $this->request->getVar('department');
        $pan_no = $this->request->getVar('pan_no');
        $bank_name = $this->request->getVar('bank_name');
        $account_no = $this->request->getVar('account_no');
        $ifsc_code = $this->request->getVar('ifsc_code');
        $pf_account = $this->request->getVar('pf_account');
        
        $query=$db->query("UPDATE `employees` SET `salary`='$salary',`name`='$full_name',`email`='$email',`mobile`='$mobile',`dob`='$dob',`gender`='$gender',`address`='$address',`city`='$city',`state`='$state',`country`='$country',`designation`='$designation',`photo`='$new_photo',`doj`='$joining_date',`department`='$department',`pan_no`='$department',`bank_name`='$bank_name',`account_no`='$account_no',`ifsc_code`='$ifsc_code',`pf_account`='$pf_account' WHERE id='$id'");
        
        if (!$query) {
            return  redirect()->to('hr_management')->with('error', 'Failed to Add !.');
            // return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('hr_management')->with('success', 'Employee data updated successfully !.');
        }
	}
	public function delete_emp($id){
        $db = \Config\Database::connect();
        $query = $db->query("DELETE FROM `employees` WHERE id='$id'");
        if (!$query) {
            return  redirect()->to('hr_management')->with('error', 'Failed to Add !.');
            // return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('hr_management')->with('success', 'Employee Record Deleted successfully !.');
        }
	}
	public function getEmployeeDetails(){
	    $empId = $this->request->getGet('emp_id');

        // Get database connection
        $db = \Config\Database::connect();
    
        // Query to fetch employee details
        $query = $db->query("SELECT * FROM employees WHERE id = ?", [$empId]);
        $result = $query->getRowArray(); // Fetch the row as an associative array
    
        if ($result) {
            return $this->response->setJSON($result);
        } else {
            return $this->response->setJSON(['error' => 'Employee not found'], 404);
        }
	}
	public function pay_salary(){
	    return view('administrator/pay_salary');
	}
	public function generate_slip(){
	    // Get the form data
	    $emp_id = $this->request->getPost('emp_id');
	    $pay_month = $this->request->getPost('pay_month');
	    $month = $this->request->getPost('month');
	    $year = $this->request->getPost('year');
        $head_titles = $this->request->getPost('head_title');
        $head_types = $this->request->getPost('head_type');
        $amounts = $this->request->getPost('amounts');
        $totalEarnings = $this->request->getPost('totalEarnings');
        $totalDeductions = $this->request->getPost('totalDeductions');
        $netSalary = $this->request->getPost('netSalary');
        $createdAt = date('Y-m-d H:i:s');

        // Get the database connection
        $db = \Config\Database::connect();
        $builder = $db->table('salaries'); // Use your 'salaries' table

        // Loop through the form data and insert into the table
        for ($i = 0; $i < count($head_titles); $i++) {
            // Prepare data for insertion
            $data = [
                'emp_id'=>$emp_id,
                'payhead_name' => $head_titles[$i],
                'pay_type'  => $head_types[$i],
                'pay_amount'     => $amounts[$i],
                'earning_total'=>$totalEarnings,
                'deduction_total'=>$totalDeductions,
                'net_salary'=>$netSalary,
                'pay_month' =>$pay_month,
                'generate_date' =>$createdAt
            ];
            
            // Insert the data
            $builder->insert($data);
        }

        // Redirect or display a success message
        return  redirect()->to('pay-salary?emp_id='.$emp_id.'&month='.$month.'&year='.$year.'')->with('success', 'Salary data saved successfully!.');
    }
    public function salary_slip_down(){
        $dompdf = new \Dompdf\Dompdf();

// Your HTML content
$html = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Fees Receipt</title>
<style type="text/css">
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

</style>
</head>

<body  style="padding-left:10px;">
<!--1st Receipt-->
<table class="table1"  style="border: 1px solid;padding:10px">
    <tr>
        <td style="border: 1px solid;">
    
            <table   cellspacing="10" cellpadding="0">
      <tr>
        <td><table  align="center"  class="main_container">
          <tr>
            <td >
    		<img src="https://scopw.eduwings.in/assets/img/savitridevi_clg_logo.png" width="100%"  style="border: none;"/>
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
                  <td colspan="2"><strong>: </strong>1</td>
                  <td width="26%" align="right"><strong>DATE :</strong> </td>
                  <td width="22%">27-11-2024</td>
                </tr>
                <tr>
                  <td><strong>NAME</strong></td>
                  <td colspan="4" style="text-transform:uppercase;"><strong>:</strong> MR . PRIYANKA BAKRE</td>
                </tr>
                <tr>
                  <td><strong>Designation</strong></td>
                
                  <td colspan="4"><strong>:</strong> Software Engineer</td>
                </tr>
                <tr>
                    <td width="24%"><strong>Month :</strong> </td>
                    <td colspan="4"><strong>:</strong> December 2024</td>
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
               
    			<tr>
                  <td align="center" height="22">1</td>
                  <td style="padding-left:20px;">Basic Pay</td>
                  <td align="right" style="padding-right:20px;">3000.00</td>
                </tr>        
    	 <tr>
         <tr>
                  <td align="center" height="22">2</td>
                  <td style="padding-left:20px;">Other Allowances</td>
                  <td align="right" style="padding-right:20px;">500.00</td>
                </tr>        
    	 <tr>
         <tr>
                  <td align="center" height="22">3</td>
                  <td style="padding-left:20px;">Deductions</td>
                  <td align="right" style="padding-right:20px;">-300.00</td>
                </tr>        
    	 <tr>
                  <td height="23">&nbsp;</td>
                  <td valign="middle" style="padding-left:20px;"><b>Total Amount</b></td>
                  <td align="right" valign="middle" style="padding-right:20px;"><b>4200.00</b></td>
                </tr>        
    			<tr>
                  <td colspan="3" height="35" valign="middle">&nbsp;&nbsp;&nbsp;<strong> By Cash</strong></span> </td>
                </tr>
    			<tr>
                  
                </tr>
            </table></td>
          </tr>
          <tr>
            
            <td>
            </td>
          </tr>
          <tr>
            <td height="59" border="0" align="right" valign="bottom">Authorized Signature </td>
          </tr>
 <tr>
            <td  align="right" valign="bottom">____________________________</td>
          </tr>
    <tr>
            <td height="20" border="0" align="left" valign="bottom">Printed By <b> superadmin</b></td>
          </tr>
        </table>
        </td> 
    </tr>
</table> 
<br>
<br>
 
</body>
</html>
';
// $file_name = "INV_".rand(10,1000) . '.pdf';
            $dompdf->set_option('isRemoteEnabled', true);
            $dompdf->loadHtml($html);
            $dompdf->render();
            $dompdf->stream('my.pdf',array('Attachment'=>0));
            exit(0);ew('administrator/salary_slip_down');
    }
    
    public function print_salary_slip(){
	    return view('administrator/print_salary_slip');
	}
}