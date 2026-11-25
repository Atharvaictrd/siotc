<?php

namespace App\Controllers;
use App\Models\Prospect;
use App\Models\MarketingModel;
use App\Models\AdmissionPersonalModel;
use App\Models\AdmissionModel;
use App\Models\ParentModel;
use App\Models\ContactModel;
use App\Models\QualificationModel;
use App\Models\CertificateIssue;
use App\Models\CertificateEnclosed;

class FeesController extends BaseController
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
  
	public function index()
	{
// 		return view('acedemic/student_admission');
	}
		public function fees_test()
	{
	    $db = \Config\Database::connect();
	    $data=$this->request->getVar();
	   // print_r($data);
	    $student_admission_id=$this->request->getVar('student_admission_id');
	    $reg_no=$this->request->getVar('reg_no');
	    $amount_type=$this->request->getVar('amount_type');
	    $session=$this->request->getVar('session');
	    $upi_id=$this->request->getVar('upi_id');
	    $upi_name=$this->request->getVar('upi_name');
	    $upi_date=$this->request->getVar('upi_date');
	    $upi_amount=$this->request->getVar('upi_amount');
	   echo $late_fees=$this->request->getVar('late_fees');
	    $date=date('Y-m-d');
	    $ip=$_SERVER['REMOTE_ADDR'];
	 $username=$_SESSION['adminloggedname'];
	    $d1=date('Y-m-d h:i:s');
	    $AdmissionModel = new AdmissionModel();
	    	$data6['user'] = $AdmissionModel->where('reg_no', $reg_no)->first();
	    	$sem=$data6['user']['semister'];
$a=0;
 $query=$db->query("INSERT INTO fees_collection(student_admission_id, reg_no, date,amount_type,ip,user_id,sem,upi_amount,upi_id,upi_name,upi_date,doe) VALUES ('$student_admission_id', '$reg_no', '$date','$amount_type','$ip','$username','$sem','$upi_amount','$upi_id','$upi_name','$upi_date','$d1')");
$ins_id= $db->insertID();

	foreach($data as $key=>$value){
list($s,$cId) = explode('_',$key);
if($s=='feeAmount'){

if(!empty($value)){
$check_data = $check_data+$value;
 $cId;
// echo "INSERT INTO fees_collection(student_admission_id, reg_no, date,amount_type,ip,user_id,upi_amount,upi_id,upi_name,upi_date,doe) VALUES ('$student_admission_id', '$reg_no', '$date','$amount_type','$ip','$username','$upi_amount','$upi_id','$upi_name','$upi_date','$d1')";
 
 
 $query1=$db->query("INSERT INTO fees_collection_detail(fee_id, student_admission_id,reg_no, date,fee_component_id,amount,session_year,sem) VALUES ('$ins_id','$student_admission_id', '$reg_no', '$date','$cId','$value','$session','$sem')");
$a = $a+$value;	
}
}
}
if(!empty($late_fees)){
    
 $sqlLateFees = $db->query("INSERT INTO late_fees_collection (student_admission_id, reg_no, amount, ip, user_id) 
VALUES ('$student_admission_id','$reg_no','$late_fees','$ip','$username')");  

$late_id= $db->insertID();
	$_SESSION['late']['id']=$late_id;
}

$cheque_amount=$this->request->getVar('cheque_amount');
$demand_draft_amount=$this->request->getVar('demand_draft_amount');

if(!empty($cheque_amount)){
    $cheque_no=$this->request->getVar('cheque_no');
    $cheque_date=$this->request->getVar('cheque_date');
    $bank_name=$this->request->getVar('bank_name');
    $branch_name=$this->request->getVar('branch_name');
    $city=$this->request->getVar('city');
    $state=$this->request->getVar('state');
    $payable_to=$this->request->getVar('payable_to');
 $check=$db->query("INSERT INTO `fee_cheque_detail`( `fee_id`, `cheque_amount`, `cheque_no`, `cheque_date`, `bank_name`, `branch_name`, `city`, `state`, `payable_to`) VALUES ('$ins_id','$cheque_amount','$cheque_no','$cheque_date','$bank_name','$branch_name','$city','$state','$payable_to')");
    
}

if(!empty($demand_draft_amount)){
    
    $DD_no=$this->request->getVar('DD_no');
    $DD_date=$this->request->getVar('DD_date');
    $dd_bank_name=$this->request->getVar('dd_bank_name');
    $dd_branch_name=$this->request->getVar('dd_branch_name');
    $d_city=$this->request->getVar('d_city');
    $d_state=$this->request->getVar('d_state');
    $d_payable_to=$this->request->getVar('d_payable_to');
   
 $dd=$db->query("INSERT INTO `fee_demand_draft_detail`( `fee_id`, `demand_draft_amount`, `DD_no`, `DD_date`, `bank_name`, `branch_name`, `city`, `state`, `payable_to`) VALUES ('$ins_id','$demand_draft_amount','$DD_no','$DD_date','$dd_bank_name','$dd_branch_name','$d_city','$d_state','$d_payable_to')");
}
$insert1=$db->query("INSERT INTO `cashbook`(`head`, `vch_type`, `vch_no`, `debit`, `credit`, `insert_by`, `date_of_entry`, `ip`) VALUES ('Fees: Registration / Admission','Receipt','$ins_id','0','$a','$username','$date','$ip')");
if(!empty($ins_id)){
   	$_SESSION['fees']['fees_id']=$ins_id;
return redirect()->to(base_url(route_to('fees_fees')) )->with('success', 'Data Inserted Successfully');
		}else{
		    //Parent error
		    	$data['error']['not']= 'Data not inserted';
				return redirect()->to(base_url(route_to('fees_fees')) )->with('error', 'Data Not Inserted');
		}
	}
	public function fees_fees()
	{
	    
	    $fee_search_key=array();

$reg_no=$this->request->getVar('reg_no');
if(!empty($reg_no)){
$fee_search_key[]="reg_no = '$reg_no'";
}
$session=$this->request->getVar('session');
if(!empty($session))
{
$fee_search_key[]="session_year = '$session'";
}
if(!empty($fee_search_key)){
 $key= ' WHERE ('.implode(' AND ',$fee_search_key).') ';
 $search = $key;
}
if (!isset($key)) {
    $key = '';
    $search = '';
}
if(!empty($reg_no)){
 $query1= $this->db->query("SELECT * FROM student_admission_information $search ");
//  echo "SELECT * FROM student_admission_information $search ";
 $data['source']=$query1->getResultArray();
    }else{
	    $query2= $this->db->query("SELECT * FROM student_admission_information WHERE active_status='1' ORDER BY student_admission_id ASC limit 0,1");
 $data['source']=$query2->getResultArray();
    }
    foreach($data['source'] as $key => $value):
            //  $cat_id = $row['id'];
            // print_r($value);
   endforeach;
   
	   return view('acedemic/fees_fees',$data);  
	}
	
	public function print_slip(){
	    return view('acedemic/print_slip');
	}
	public function print_other_slip(){
	    return view('acedemic/print_other_slip');
	    
	}
	public function print_late_slip(){
	    return view('acedemic/print_late_slip');
	}
	public function collect_other_fee(){
	      $fee_search_key=array();
// $from_Date=$this->request->getVar('from_Date');
// if(!empty($from_Date)){
// $fee_search_key[]="enquiry_date >= $from_Date";
// }
// $to_Date=$this->request->getVar('to_Date');
// if(!empty($to_Date)){
// $fee_search_key[]="enquiry_date <= $to_Date";
// }
$reg_no=$this->request->getVar('reg_no');
if(!empty($reg_no)){
$fee_search_key[]="reg_no = '$reg_no'";
}
$session=$this->request->getVar('session');
if(!empty($session))
{
$fee_search_key[]="session_year = '$session'";
}
if(!empty($fee_search_key)){
 $key= ' WHERE ('.implode(' AND ',$fee_search_key).') ';
 $search = $key;
}
if (!isset($key)) {
    $key = '';
    $search = '';
}
if(!empty($reg_no)){
 $query1= $this->db->query("SELECT * FROM student_admission_information $search ");
//  echo "SELECT * FROM student_admission_information $search ";
 $data['source']=$query1->getResultArray();
    }else{
	    $query2= $this->db->query("SELECT * FROM student_admission_information WHERE active_status='1' ORDER BY student_admission_id ASC limit 0,1");
 $data['source']=$query2->getResultArray();
    }
    foreach($data['source'] as $key => $value):
            //  $cat_id = $row['id'];
            // print_r($value);
   endforeach;
   
	   //return view('acedemic/fees_fees',$data);  
	       return view('acedemic/collect_other_fee',$data);
	}
	public function insert_other_fees(){
	     $db = \Config\Database::connect();
	    $AdmissionModel = new AdmissionModel();
	    $student_admission_id=$this->request->getVar('student_admission_id');
	    $reg_no=$this->request->getVar('reg_no');
	    $amount_type=$this->request->getVar('amount_type');
	    $session=$this->request->getVar('session');
	   echo $late_fees=$this->request->getVar('late_fees');
	   	$data6['user'] = $AdmissionModel->where('reg_no', $reg_no)->first();
	   		$c_name=$this->request->getVar('c_name');
	   			$c_amount=$this->request->getVar('c_amount');
	   	$cheque_amount=$this->request->getVar('cheque_amount');
	   	$cheque_no=$this->request->getVar('cheque_no');
    $cheque_date=$this->request->getVar('cheque_date');
    $bank_name=$this->request->getVar('bank_name');
    $branch_name=$this->request->getVar('branch_name');
    $city=$this->request->getVar('city');
    $state=$this->request->getVar('state');
    $payable_to=$this->request->getVar('payable_to');
    $ip=$_SERVER['REMOTE_ADDR'];
	 $username=$_SESSION['adminloggedname'];
	    $d1=date('Y-m-d h:i:s');
	    
      $date=date('Y-m-d');
	    $insert=$db->query("INSERT INTO `other_fees`(`student_admission_id`, `reg_no`, `session`, `class`, `c_name`, `c_amount`, `paid_type`, `Date`, `cheque_amount`, `cheque_no`, `cheque_date`, `bank_name`, `branch_name`, `city`, `state`, `payable_to`, `ip`, `user_id`, `doe`) VALUES ('$student_admission_id','$reg_no','$session','".$data6['user']['class']."','$c_name','$c_amount','$amount_type','$date','$cheque_amount','$cheque_no','$cheque_date','$bank_name','$branch_name','$city','$state','$payable_to','$ip','$username','$d1')");
	    
	    $ins_id= $db->insertID();
	    
	    $insert1=$db->query("INSERT INTO `cashbook`(`head`, `vch_type`, `vch_no`, `debit`, `credit`, `insert_by`, `date_of_entry`, `ip`) VALUES ('Fees: Stationary / Uniform','Receipt','$ins_id','0','$c_amount','$username','$date','$ip')");
	    if(!empty($ins_id)){
   	$_SESSION['other']['fees_id']=$ins_id;
return redirect()->to(base_url(route_to('collect_other_fee')) )->with('success', 'Data Inserted Successfully');
		}else{
		    //Parent error
		    	$data['error']['not']= 'Data not inserted';
				return redirect()->to(base_url(route_to('collect_other_fee')) )->with('error', 'Data Not Inserted');
		}
	}
	public function fees_management(){
	     $fee_search_key=array();
// $from_Date=$this->request->getVar('from_Date');
// if(!empty($from_Date)){
// $fee_search_key[]="enquiry_date >= $from_Date";
// }
// $to_Date=$this->request->getVar('to_Date');
// if(!empty($to_Date)){
// $fee_search_key[]="enquiry_date <= $to_Date";
// }
$reg_no=$this->request->getVar('reg_no');
if(!empty($reg_no)){
$fee_search_key[]="reg_no = '$reg_no'";

}
$session=$this->request->getVar('session');
if(!empty($session))
{
$fee_search_key[]="session_year = '$session'";
}
if(!empty($fee_search_key)){
 $key= ' WHERE ('.implode(' AND ',$fee_search_key).') ';
 $search = $key;
}
if (!isset($key)) {
    $key = '';
    $search = '';
}
if(!empty($reg_no)){
 $query1= $this->db->query("SELECT * FROM student_admission_information $search ");
//  echo "SELECT * FROM student_admission_information $search ";
 $data['source']=$query1->getResultArray();
    }else{
	    $query2= $this->db->query("SELECT * FROM student_admission_information WHERE active_status='1' ORDER BY student_admission_id ASC limit 0,1");
 $data['source']=$query2->getResultArray();
    }
    foreach($data['source'] as $key => $value):
            //  $cat_id = $row['id'];
            // print_r($value);
   endforeach;
   
	      return view('acedemic/fees_management',$data);
	}
	
	public function insert_management(){
	     $db = \Config\Database::connect();
	    $AdmissionModel = new AdmissionModel();
	    $student_admission_id=$this->request->getVar('student_admission_id');
	    $reg_no=$this->request->getVar('reg_no');
	    $actual_fees = $this->request->getVar('Actual_amount');

	$consession_amount = $this->request->getVar('consession_fee');
	$bal = $this->request->getVar('consession_amount');
		$fees_collection = $consession_amount;
	     	$data6['user'] = $AdmissionModel->where('reg_no', $reg_no)->first();
	    				$insert1=$db->query("insert into  management_consession (reg_no, student_admission_id, class, semister, category, session_year, consession_amount, actual_fees, balance_amount) values ( '".$data6['user']['reg_no']."', '".$data6['user']['student_admission_id']."',  '".$data6['user']['class']."', '".$data6['user']['semister']."', '".$data6['user']['category']."', '".$data6['user']['session_year']."','".$fees_collection."','".$actual_fees."', $bal) ");
 if($insert1){
   	// $_SESSION['other']['fees_id']=$ins_id;
return redirect()->to(base_url(route_to('fees_management')) )->with('success', 'Fees Consession made Successfully.');
		}else{
		    //Parent error
		    	$data['error']['not']= 'Data not inserted';
				return redirect()->to(base_url(route_to('fees_management')) )->with('error', 'Data Not Inserted');
		}
	}
}