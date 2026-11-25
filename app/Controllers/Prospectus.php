<?php
namespace App\Controllers;
use App\Models\Prospect;
use App\Models\MarketingModel;
class Prospectus extends BaseController
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
		public function prospectus_report()
	{
	    helper(['form', 'url']); 
	   $fee_search_key=array();
	   $student_name=$this->request->getVar('student_name');
	   

if(!empty($student_name)){
$fee_search_key[]="prospect_no >= '$student_name'";
}
$prospect_no=$this->request->getVar('prospect_no');
	   

if(!empty($prospect_no)){
$fee_search_key[]="prospect_no = '$prospect_no'";
}
$from_Date=$this->request->getVar('f_date');
	   

if(!empty($from_Date)){
$fee_search_key[]="date >= '$from_Date'";
}
$to_Date=$this->request->getVar('t_date');
if(!empty($to_Date)){
$fee_search_key[]="date <= '$to_Date'";
}
// $enquiry_no=$this->request->getVar('category');
// if(!empty($enquiry_no)){
// $fee_search_key[]="category = '$enquiry_no'";
// }
$category=$this->request->getVar('category');
if(!empty($category)){
$fee_search_key[]="category = '$category'";
}
$class1=$this->request->getVar('class1');
if(!empty($class1)){
$fee_search_key[]="class = '$class1'";
}
$semister=$this->request->getVar('semister');
if(!empty($semister)){
$fee_search_key[]="semister = '$semister'";
}
$last_school_attended=$this->request->getVar('last_school_attended');
if($last_school_attended != '')
{
$fee_search_key[]="last_school_attended = '$last_school_attended'";
}
// $address=$this->request->getVar('address');
// if($address != '')
// {
// $fee_search_key[]="address = '$address'";
// }
if(!empty($fee_search_key)){
 $key= ' WHERE ('.implode(' AND ',$fee_search_key).') ';
 $search = $key;
}
if (!isset($key)) {
    $key = '';
    $search = '';
}
if(($search !=' ')){
 $query1= $this->db->query("SELECT * FROM prospect_sales $search ORDER BY prospect_no DESC");
// echo "SELECT * FROM prospect_sales $search ORDER BY prospect_no DESC";
 $data['source']=$query1->getResultArray();
}else{
    
    $query2= $this->db->query("SELECT * FROM prospect_sales ORDER BY prospect_no DESC");
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
            //  $cat_id = $row['id'];
            // print_r($value);
   endforeach;
	   return view('acedemic/prospectus_report',$data);  
	}
		public function prospectus_session()
	{
	    $session=$this->request->getVar('session');
        if($session != '')
        {
        $fee_search_key[]="session = '$session'";
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
         $query1= $this->db->query("SELECT * FROM prospect_sales $search ORDER BY prospect_no DESC");
        // echo "SELECT * FROM prospect_sales $search ORDER BY prospect_no DESC";
         $data['source']=$query1->getResultArray();
        }else{
            
            $query2= $this->db->query("SELECT * FROM prospect_sales ORDER BY prospect_no DESC");
         $data['source']=$query2->getResultArray();
        }
            	 foreach($data['source'] as $key => $value):
                    //  $cat_id = $row['id'];
                    // print_r($value);
           endforeach;
	   return view('acedemic/prospectus_session',$data);  
	}
	
	
// 	public function student_prospectus1()
//     {
//         $session = $this->request->getVar('session');
//         $classId = $this->request->getVar('class1'); 
//         $sem = $this->request->getVar('semister');
    
//         $conditions = [];
    
//         if (!empty($session)) {
//             $conditions[] = "ps.session = '$session'";
//         }
    
//         if (!empty($classId)) {
//             $conditions[] = "ps.class = '$classId'";
//         }
    
//         if (!empty($sem)) {
//             $conditions[] = "ps.semister = '$sem'";
//         }
    
//         $search = '';
//         if (!empty($conditions)) {
//             $search = " WHERE " . implode(' AND ', $conditions);
//         }
    
//         $sql = "
//             SELECT 
//                 ps.prospect_id,
//                 CONCAT(ps.student_gender, '. ', ps.student_first_name, ' ', ps.student_middle_name, ' ', ps.student_last_name) AS student_name,
//                 ps.class AS program,
//                 ps.semister,
//                 ps.session,
//                 ps.contact_no,
//                 ps.amount,
//                 ps.area,
//                 COALESCE(me.address, '') AS address,
//                 COALESCE(me.reference_details, '') AS reference_details
//             FROM prospect_sales ps
//             LEFT JOIN marketing_enquiry me 
//                 ON ps.enquiry_no = me.enquiry_no
//             $search
//             ORDER BY ps.prospect_id DESC
//         ";
    
//         // Debug: uncomment to check SQL
//         // echo $sql; exit;
    
//         $query = $this->db->query($sql);
//         $data['source'] = $query->getResultArray();
    
//         return view('acedemic/student_prospectus', $data);
//     }
    
//     public function student_prospectus()
// {
// $session = $this->request->getVar('session');
// $classId = $this->request->getVar('class1'); 
// $sem = $this->request->getVar('semister');

// $conditions = [];

// if (!empty($session)) {
//     $conditions[] = "ps.session = '$session'";
// }

// if (!empty($classId)) {
//     $conditions[] = "ps.class = '$classId'";
// }

// if (!empty($sem)) {
//     $conditions[] = "ps.semister = '$sem'";
// }

// $search = '';
// if (!empty($conditions)) {
//     $search = " WHERE " . implode(' AND ', $conditions);
// }

// // $sql = "
// // SELECT 
// //     sai.student_admission_id,
// //     CONCAT(
// //         COALESCE(sai.student_gender, ps.student_gender), '. ',
// //         COALESCE(sai.first_name, ps.student_first_name), ' ',
// //         COALESCE(sai.middle_name, ps.student_middle_name), ' ',
// //         COALESCE(sai.last_name, ps.student_last_name)
// //     ) AS student_name,
// //     sai.program AS program,
// //     sai.semister AS semister,
// //     COALESCE(me.address, '') AS address,
// //     COALESCE(sai.parent_mobile_number, ps.contact_no) AS contact_no,
// //     COALESCE(me.reference_details, sai.reference_details, '') AS reference_details
// // FROM student_admission_information sai
// // LEFT JOIN prospect_sales ps 
// //     ON ps.prospect_no = sai.prospectus_no
// // LEFT JOIN marketing_enquiry me 
// //     ON me.enquiry_no = ps.enquiry_no
// // $search
// // ORDER BY sai.student_admission_id DESC";


// // Execute query
// $query = $this->db->query($sql);
// $data['source'] = $query->getResultArray();

// return view('acedemic/student_prospectus', $data);
// }

public function student_prospectus()
{
    $session = $this->request->getVar('session');
    $classId = $this->request->getVar('class1'); 
    $sem = $this->request->getVar('semister');

$conditions = [];

if (!empty($session)) {
    $conditions[] = " (ps.session = '$session' OR sai.session_year = '$session') ";
}

if (!empty($classId)) {
    $conditions[] = " (ps.class = '$classId' OR sai.program = '$classId') ";
}

if (!empty($sem)) {
    $conditions[] = " (
        (sai.student_admission_id IS NOT NULL AND sai.semister = '$sem')
        OR
        (sai.student_admission_id IS NULL AND ps.semister = '$sem')
    ) ";
}

// if (!empty($sem)) {
//     $conditions[] = " (ps.semister = '$sem' OR sai.semister = '$sem') ";
// }

$search = '';
if (!empty($conditions)) {
    $search = " WHERE " . implode(' AND ', $conditions);
}

$sql = "
SELECT 
    COALESCE(sai.student_admission_id, ps.prospect_id) AS id,
    CONCAT(
        COALESCE(sai.student_gender, ps.student_gender), '. ',
        COALESCE(sai.first_name, ps.student_first_name), ' ',
        COALESCE(sai.middle_name, ps.student_middle_name), ' ',
        COALESCE(sai.last_name, ps.student_last_name)
    ) AS student_name,
    cls.class AS program, 
    COALESCE(sai.semister, ps.semister) AS semister,
    COALESCE(me.address, '') AS address,
    COALESCE(sai.parent_mobile_number, ps.contact_no) AS contact_no,
    COALESCE(me.reference_details, sai.reference_details, '') AS reference_details,
    COALESCE(sai.gender1, ps.gender1, '') AS gender1,
    COALESCE(sai.date_of_birth, '') AS date_of_birth
FROM prospect_sales ps
LEFT JOIN marketing_enquiry me ON ps.enquiry_no = me.enquiry_no
LEFT JOIN student_admission_information sai ON ps.prospect_no = sai.prospectus_no
LEFT JOIN class cls ON cls.class_id = COALESCE(sai.program, ps.class)
$search
ORDER BY student_name ASC
";

    $query = $this->db->query($sql);
    $data['source'] = $query->getResultArray();

    return view('acedemic/student_prospectus', $data);
}

    
	
	public function create_prospect()
	{
	   	$data1 = $this->request->getVar();
	    		$prospect = new Prospect();

		//store in db
		if ($result = $prospect->create($data1)) {
		  //  	$data['error']['success']= 'Data Inserted Successfully';
				return redirect()->to(base_url(route_to('prospectus')) )->with('success', 'Data Inserted Successfully');
		}else{
		    	$data['error']['not']= 'Data not inserted';
				return redirect()->to(base_url(route_to('prospectus')) )->with('error', 'Data Not Inserted');
		} 
	}
	
	
	public function create_prospect_enquired()
	{
    	$data1 = $this->request->getVar();
    	   
		$prospect = new Prospect();
	    	$enquiry_no = $this->request->getVar('enquiry_no'); 
	$data = $prospect->where('enquiry_no', $enquiry_no)->first();
	$enquiry_no1=$data['enquiry_no'];
	if($enquiry_no1 == $enquiry_no){
	    	$data['error']['not']= 'Data not inserted';
				return redirect()->to(base_url(route_to('prospectus_enquired')) )->with('error', 'Data Already Inserted');
	}else{
		//store in db
		if ($result = $prospect->create($data1)) {
		  //  	$data['error']['success']= 'Data Inserted Successfully';
				return redirect()->to(base_url(route_to('prospectus_enquired')) )->with('success', 'Data Inserted Successfully');
		}else{
		    	$data['error']['not']= 'Data not inserted';
				return redirect()->to(base_url(route_to('prospectus_enquired')) )->with('error', 'Data Not Inserted');
		}
	}
	}

    
    public function create_prospect_enquired1()
    {
       
    
        echo $enquiry_no = $this->request->getVar('enquiry_n');
        echo $student_first_name = $this->request->getVar('student_first_name');
    }
    

		public function delete_prospect(){
	    	$id = $this->request->getVar('id');
		$model = new prospect();
		$data['user'] = $model->where('prospect_id', $id)->delete();
        $msg = 'Deleted !!!';
		return redirect()->to( base_url('prospectus') )->with('error', $msg);
    }
    	public function delete_prospect_enquired(){
	    	$id = $this->request->getVar('id');
		$model = new prospect();
		$data['user'] = $model->where('prospect_id', $id)->delete();
        $msg = 'Deleted !!!';
		return redirect()->to( base_url('prospectus_enquired') )->with('error', $msg);
    }
    	public function delete_prospect_report(){
	    	$id = $this->request->getVar('id');
		$model = new prospect();
		$data['user'] = $model->where('prospect_id', $id)->delete();
        $msg = 'Deleted !!!';
		return redirect()->to( base_url('prospectus_report') )->with('error', $msg);
    }
    
    	public function  search_enquiry_pro(){
    	   	$enquiry_no = $this->request->getVar('enquiry_no'); 
    	   	$model = new MarketingModel();
    	   		$data = $model->where('enquiry_no', $enquiry_no)->first();
    	   		$s = $this->db->query("SELECT * from class where class_id= ".$data['class']);
    	   		  foreach ($s->getResult() as $row2) {
                                  $cl = $row2->class; 
                                //   $fullurl = $row2->fullurl; 
                              }
    	   		$data1=array('user'=>$data,'class'=>$cl);
    	   		echo json_encode($data1);
    	}
}