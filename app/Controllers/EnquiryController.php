<?php

namespace App\Controllers;
use App\Models\Prospect;
use App\Models\MarketingModel;
class EnquiryController extends BaseController
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
// 		return view('admin/login');
	}
		public function list_student_program()
	{
	    	   helper(['form', 'url']); 
	   $program_search_key=array();
$program=$this->request->getVar('program');
	   

if(!empty($program)){
$program_search_key[]="class = '$program'";
}
$semister=$this->request->getVar('semister');
if(!empty($semister)){
$program_search_key[]="semister = '$semister'";
}
$session=$this->request->getVar('session');
if($session != '')
{
$program_search_key[]="session = '$session'";
}
if(!empty($program_search_key)){
 $key= ' WHERE ('.implode(' AND ',$program_search_key).') ';
 $search = $key;
}
if (!isset($key)) {
    $key = '';
    $search = '';
}
if(($search !=' ')){
 $query1= $this->db->query("SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 $data['source']=$query1->getResultArray();
}else{
	     $query2= $this->db->query("SELECT * FROM marketing_enquiry ORDER BY enquiry_no DESC");
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
            
   endforeach;
    
	   return view('marketing/list_student_program',$data);  
	}

	public function list_student_area()
	{
	    helper(['form', 'url']); 
	   $student_search_key=array();
$address=$this->request->getVar('address');
	   

if(!empty($address)){
$student_search_key[]="address = '$address'";
}
$landmark=$this->request->getVar('landmark');
if(!empty($landmark)){
$student_search_key[]="landmark = '$landmark'";
}

if(!empty($student_search_key)){
 $key= ' WHERE ('.implode(' AND ',$student_search_key).') ';
 $search = $key;
}
if (!isset($key)) {
    $key = '';
    $search = '';
}
if(($search !=' ')){
 $query1= $this->db->query("SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 $data['source']=$query1->getResultArray();
}else{
	     $query2= $this->db->query("SELECT * FROM marketing_enquiry ORDER BY enquiry_no DESC");
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
            //  $cat_id = $row['id'];
            // print_r($value);
   endforeach;
	   return view('marketing/list_student_area',$data);  
	}
	public function save_new_keyword(){
	    $add_address_key=$this->request->getVar('add_new_address_key');
	    $query=$this->db->query("INSERT INTO `adress_keywords`(`adress_key`) VALUES ('$add_address_key')");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('list_student_area')->with('success', 'Added successfully !.');
        }
	}
	
		public function list_student_college()
	{
	    helper(['form', 'url']); 
	   $school_search_key=array();
$last_school_attended=$this->request->getVar('last_school_attended');
	   

if(!empty($last_school_attended)){
$school_search_key[]="last_school_attended = '$last_school_attended'";
}

if(!empty($school_search_key)){
 $key= ' WHERE ('.implode(' AND ',$school_search_key).') ';
 $search = $key;
}
if (!isset($key)) {
    $key = '';
    $search = '';
}
if(($search !=' ')){
 $query1= $this->db->query("SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 $data['source']=$query1->getResultArray();
}else{
	    $query2= $this->db->query("SELECT * FROM marketing_enquiry ORDER BY enquiry_no DESC");
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
            //  $cat_id = $row['id'];
            // print_r($value);
   endforeach;
	   return view('marketing/list_student_college',$data);  
	}
		public function list_student_category()
	{
	    helper(['form', 'url']); 
	   $fee_search_key=array();

$category=$this->request->getVar('category');
if($category != '')
{
$fee_search_key[]="category = '$category'";
}
if(!empty($fee_search_key)){
 $key= ' WHERE ('.implode(' AND ',$fee_search_key).') ';
 $search = $key;
}
if (!isset($key)) {
    $key = '';
    $search = '';
}
if(($search !=' ')){
 $query1= $this->db->query("SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 $data['source']=$query1->getResultArray();
}else{
	     $query2= $this->db->query("SELECT * FROM marketing_enquiry ORDER BY enquiry_no DESC");
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
            //  $cat_id = $row['id'];
            // print_r($value);
   endforeach;
	   return view('marketing/list_student_category',$data);  
	}
		public function list_student_percentage(){
	    helper(['form', 'url']); 
	   $fee_search_key=array();

$percentage=$this->request->getVar('percentage');
if($percentage != '')
{
$fee_search_key[]="percentage = '$percentage'";
}
if(!empty($fee_search_key)){
 $key= ' WHERE ('.implode(' AND ',$fee_search_key).') ';
 $search = $key;
}
if (!isset($key)) {
    $key = '';
    $search = '';
}
if(($search !=' ')){
 $query1= $this->db->query("SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 $data['source']=$query1->getResultArray();
}else{
	     $query2= $this->db->query("SELECT * FROM marketing_enquiry ORDER BY enquiry_no DESC");
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
            //  $cat_id = $row['id'];
            // print_r($value);
   endforeach;
	   return view('marketing/list_student_percentage',$data);  
	}
		public function list_student_medium()
	{
	    helper(['form', 'url']); 
	   $fee_search_key=array();

$medium=$this->request->getVar('medium');
if($medium != '')
{
$fee_search_key[]="medium = '$medium'";
}
if(!empty($fee_search_key)){
 $key= ' WHERE ('.implode(' AND ',$fee_search_key).') ';
 $search = $key;
}
if (!isset($key)) {
    $key = '';
    $search = '';
}
if(($search !=' ')){
 $query1= $this->db->query("SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 $data['source']=$query1->getResultArray();
}else{
	    $query2= $this->db->query("SELECT * FROM marketing_enquiry ORDER BY enquiry_no DESC");
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
            //  $cat_id = $row['id'];
            // print_r($value);
   endforeach;
	   return view('marketing/list_student_medium',$data);  
	}
		public function not_taken_admission()
	{
	   
	    $query2= $this->db->query("SELECT * FROM prospect_sales ORDER BY enquiry_no DESC");
	     
 $data['source']=$query2->getResultArray();

    	 foreach($data['source'] as $key => $value):
            //  $cat_id = $row['id'];
            // print_r($value);
   endforeach;
	   return view('marketing/not_taken_admission',$data);  
	}
		public function not_taken_admission_area()
	{
	     helper(['form', 'url']); 
	   $search_key=array();

$address=$this->request->getVar('address');
if($address != '')
{
$search_key[]="address = '$address'";
}
if(!empty($search_key)){
 $key= ' WHERE ('.implode(' AND ',$search_key).') ';
 $search = $key;
}
if (!isset($key)) {
    $key = '';
    $search = '';
}
if(($search !=' ')){
 $query1= $this->db->query("SELECT * FROM prospect_sales $search ORDER BY enquiry_no DESC");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 $data['source']=$query1->getResultArray();
}else{
	      $query2= $this->db->query("SELECT * FROM prospect_sales ORDER BY enquiry_no DESC");
	     
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
            //  $cat_id = $row['id'];
            // print_r($value);
   endforeach;
	   return view('marketing/not_taken_admission_area',$data);  
	}
		public function enquiry_college()
	{
	    helper(['form', 'url']); 
	   $fee_search_key=array();

$last_school=$this->request->getVar('last_school');
if($last_school != '')
{
$fee_search_key[]="last_school_attended = '$last_school'";
}
if(!empty($fee_search_key)){
 $key= ' WHERE ('.implode(' AND ',$fee_search_key).') ';
 $search = $key;
}
if (!isset($key)) {
    $key = '';
    $search = '';
}
if(($search !=' ')){
 $query1= $this->db->query("SELECT * FROM prospect_sales $search ORDER BY enquiry_no DESC");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 $data['source']=$query1->getResultArray();
}else{
	      $query2= $this->db->query("SELECT * FROM prospect_sales ORDER BY enquiry_no DESC");
	     
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
            //  $cat_id = $row['id'];
            // print_r($value);
   endforeach;
	   return view('marketing/enquiry_college',$data);  
	}
		public function enquiry_category()
	{
	     helper(['form', 'url']); 
	   $fee_search_key=array();

$category=$this->request->getVar('category');
if($category != '')
{
$fee_search_key[]="category = '$category'";
}
if(!empty($fee_search_key)){
 $key= ' WHERE ('.implode(' AND ',$fee_search_key).') ';
 $search = $key;
}
if (!isset($key)) {
    $key = '';
    $search = '';
}
if(($search !=' ')){
 $query1= $this->db->query("SELECT * FROM prospect_sales $search ORDER BY enquiry_no DESC");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 $data['source']=$query1->getResultArray();
}else{
	    $query2= $this->db->query("SELECT * FROM prospect_sales ORDER BY enquiry_no DESC");
	     
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
            //  $cat_id = $row['id'];
            // print_r($value);
   endforeach;
	   return view('marketing/enquiry_category',$data);  
	}
		public function enquiry_percentage()
	{
	     helper(['form', 'url']); 
	   $fee_search_key=array();

$percentage=$this->request->getVar('percentage');
if($percentage != '')
{
$fee_search_key[]="percentage = '$percentage'";
}
if(!empty($fee_search_key)){
 $key= ' WHERE ('.implode(' AND ',$fee_search_key).') ';
 $search = $key;
}
if (!isset($key)) {
    $key = '';
    $search = '';
}
if(($search !=' ')){
 $query1= $this->db->query("SELECT * FROM prospect_sales $search ORDER BY enquiry_no DESC");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 $data['source']=$query1->getResultArray();
}else{
	     $query2= $this->db->query("SELECT * FROM prospect_sales ORDER BY enquiry_no DESC");
	     
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
            //  $cat_id = $row['id'];
            // print_r($value);
   endforeach;
	   return view('marketing/enquiry_percentage',$data);  
	}
		public function enquiry_medium()
	{
	    $fee_search_key=array();

$medium=$this->request->getVar('medium');
if($medium != '')
{
$fee_search_key[]="medium = '$medium'";
}
if(!empty($fee_search_key)){
 $key= ' WHERE ('.implode(' AND ',$fee_search_key).') ';
 $search = $key;
}
if (!isset($key)) {
    $key = '';
    $search = '';
}
if(($search !=' ')){
 $query1= $this->db->query("SELECT * FROM prospect_sales $search ORDER BY enquiry_no DESC");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 $data['source']=$query1->getResultArray();
}else{
	    $query2= $this->db->query("SELECT * FROM prospect_sales ORDER BY enquiry_no DESC");

 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
            //  $cat_id = $row['id'];
            // print_r($value);
   endforeach;
	   return view('marketing/enquiry_medium',$data);  
	}
		public function enquiry_reference()
	{
	    $fee_search_key=array();

$reference=$this->request->getVar('reference');
if($reference != '')
{
$fee_search_key[]="reference_details = '$reference'";
}
if(!empty($fee_search_key)){
 $key= ' WHERE ('.implode(' AND ',$fee_search_key).') ';
 $search = $key;
}
if (!isset($key)) {
    $key = '';
    $search = '';
}
if(($search !=' ')){
 $query1= $this->db->query("SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 $data['source']=$query1->getResultArray();
}else{
	     $query2= $this->db->query("SELECT * FROM marketing_enquiry ORDER BY enquiry_no DESC");
	     
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
            //  $cat_id = $row['id'];
            // print_r($value);
   endforeach;
	   return view('marketing/enquiry_reference',$data);  
	}
		public function bulk_sms()
	{
	   return view('marketing/bulk_sms');  
	}
}