<?php

namespace App\Controllers;
use App\Models\Prospect;
use App\Models\MarketingModel;
class Marketing extends BaseController
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
	
	public function create_enquiry(){
	    $data = $this->request->getPost();
	    
	    // convert multiple select array to string
        if(isset($data['class'])){
            $data['class'] = implode(',', $data['class']);
        }
    
        $prospect = new MarketingModel();
    
        if ($prospect->insert($data)) {
            return redirect()->to(base_url(route_to('student_enquiry')))
                ->with('success', 'Data Inserted Successfully');
        } else {
            return redirect()->to(base_url(route_to('student_enquiry')))
                ->with('error', 'Data Not Inserted');
        }
	}
	
// 	public function create_enquiry()
// 	{
// 	    	$data1 = $this->request->getVar();
// 	    	$prospect = new MarketingModel();

// 		//store in db
// 		if ($result = $prospect->create($data1)) {
// 		  //  	$data['error']['success']= 'Data Inserted Successfully';
// 				return redirect()->to(base_url(route_to('student_enquiry')) )->with('success', 'Data Inserted Successfully');
// 		}else{
// 		    	$data['error']['not']= 'Data not inserted';
// 				return redirect()->to(base_url(route_to('student_enquiry')) )->with('error', 'Data Not Inserted');
// 		}
// 	}
	
	public function delete_enquiry($id){
	   // 	$id = $this->request->getVar('id');
		$model = new MarketingModel();
		$data['user'] = $model->where('enquiry_no', $id)->delete();
        $msg = 'Deleted !!!';
		return redirect()->to( base_url('student_enquiry') )->with('error', $msg);
    }
    
    public function search_enquiry(){
        
$fee_search_key=array();
$from_Date=$this->request->getVar('from_Date');
if(!empty($from_Date)){
$fee_search_key[]="enquiry_date >= $from_Date";
}
$to_Date=$this->request->getVar('to_Date');
if(!empty($to_Date)){
$fee_search_key[]="enquiry_date <= $to_Date";
}
$enquiry_no=$this->request->getVar('enquiry_no');
if(!empty($enquiry_no)){
$fee_search_key[]="enquiry_no = $enquiry_no";
}
$session=$this->request->getVar('session');
if(!empty($session))
{
$fee_search_key[]="session = $session";
}
if(!empty($fee_search_key)){
 $key= ' WHERE ('.implode(' AND ',$fee_search_key).') ';
 $search = $key;
}
if (!isset($key)) {
    $key = '';
    $search = '';
}
if(!empty($enquiry_no)){
 $query1= $this->db->query("SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC");
 $data['source']=$query1->getResultArray();
    }else{
    $query2= $this->db->query("SELECT * FROM marketing_enquiry ORDER BY enquiry_no DESC");
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
            //  $cat_id = $row['id'];
            // print_r($value);
   endforeach;
        return view('marketing/list_student_enquiry',$data);
    }
}