<?php
namespace App\Controllers;
use App\Models\UserModel;
use App\Models\AdmissionModel;
class Admin extends BaseController
{
    private $db;
    public function __construct(){
	    
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
		return view('admin/login');
	}
	public function support(){
		return view('support');
	}
	public function loginsubmit(){
		//validation on request
		$validation = $this->validate([
			//validation rules and messages
			'username' => [
				'label'  => 'User Name',
				//rules can be added alpha_numeric
				'rules'  => 'required',
				'errors' => [
					'required' => 'Please enter {field} to proceed',
				],
			],
			'password' => [
				'label'  => 'Password',
				'rules'  => 'required|min_length[5]|max_length[12]',
				'errors' => [
					'required' => 'Please enter {field} to proceed',
					'min_length' => 'Please enter at least 5 characters in {field} to proceed',
					'max_length' => 'Please enter at most 12 characters in {field} to proceed',
				],
			],
		]);

		//check validation and send errors
		if (!$validation) {
			//send errors
			$data['error'] = $this->validator->getErrors();
            // 			return view('login', $data);
		}
        // echo "dfgr";
		//get formdata
	    $username = $this->request->getVar('username');
		$password = $this->request->getVar('password');
		$session1 = $this->request->getVar('session');
		//create obj of admin model
		$admin = new UserModel();
		// get row by email
		if ($row = $admin->where('user_name', $username)->where('password', $password)->first()) {
		    //  echo "dfdg";
            // 			if ($row['password'] === $password) {
            if ($row) {
				//set session for admintid logged in 
				session()->set('adminloggedid', $row['user_id']);
				session()->set('adminloggedname', $row['user_name']);
                session()->set('session_year', $session1);
				// $_SESSION['adminloggedid']=$row['id'];
				// $_SESSION['adminloggedname']=$row['username'];
				//redirect to dashboard
				return redirect()->to(base_url(route_to('dashboard')) );
			} else {
				//send error
				$data['error']['username'] = 'Invalid Credentials';
				return view('login', $data);
			}
		} else {
			//send error
			$data['error']['username'] = 'Invalid Credentials';
			return view('login', $data);
		}
	}
	public function dashboard(){
	    return view('index');
	}
	public function logout(){
		//unset session for adminid logged in
		unset($_SESSION['adminloggedid']);
		unset($_SESSION['adminloggedname']);
		return redirect()->to(base_url(route_to('admin.login')) )->with('success', 'You have Successfully Logout');
	}
	public function regenerateSession(){
	    $session1 = $this->request->getVar('session_value');
	    $id=$_SESSION['adminloggedid'];
	    $admin = new UserModel();
	    $row = $admin->where('user_id', $id)->first();
	    $session = session();
        // Regenerate the session ID to prevent session fixation
	    session()->set('adminloggedid', $row['user_id']);
		session()->set('adminloggedname', $row['user_name']);
        session()->set('session_year', $session1);
        $session->regenerate();
        $data=['success'=>true];
        return $this->response->setJSON($data); 
	}
	public function section(){
	    $id= $this->request->getVar('id');
	    $query=$this->db->query("SELECT * FROM student_category WHERE section='$id'");
        // echo	  "SELECT * FROM student_category WHERE section='".$id."'";
	    echo '<option value="" selected="selected">---Category---</option>';
	    $data['source'] = $query->getResultArray();
        // 	print_r($data['source']);
        // 	echo $m;
	    foreach($data['source'] as $key => $value):
	        echo '<option value="'.$value['category'].'" id="'.$value['category'].'" >'.$value['category'].'</option> ';
	    endforeach;
        // 	echo json_encode($id);
	}
	public function student_enquiry(){
	   return view('marketing/student_enquiry');  
	}
	public function list_student_enquiry(){
	   helper(['form', 'url']); 
	   $fee_search_key=array();
        $search = '';
        $from_Date=$this->request->getVar('from_Date');
        if(!empty($from_Date)){
            $fee_search_key[]="enquiry_date >= '$from_Date'";
        }
        $to_Date=$this->request->getVar('to_Date');
        if(!empty($to_Date)){
            $fee_search_key[]="enquiry_date <= '$to_Date'";
        }
        $enquiry_no=$this->request->getVar('enquiry_no');
        if(!empty($enquiry_no)){
            $fee_search_key[]="enquiry_no = '$enquiry_no'";
        }
        $session=$this->request->getVar('session');
        if($session != ''){
            $fee_search_key[]="session = '$session'";
        }
        if(!empty($fee_search_key)){
            $search = ' WHERE ('.implode(' AND ',$fee_search_key).') ';
        }
        if($search !== ''){
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
        return view('marketing/list_student_enquiry',$data);
	}
	public function list_student_area(){
	    $query2= $this->db->query("SELECT * FROM marketing_enquiry ORDER BY enquiry_no DESC");
        $data['source']=$query2->getResultArray();
	    foreach($data['source'] as $key => $value):
            //  $cat_id = $row['id'];
            // print_r($value);
        endforeach;
	   //return view('marketing/list_student_area',$data);  
	}

    // 	ACEDEMIC

	public function prospectus(){
	    helper(['form', 'url']); 
	    $fee_search_key=array();
$from_Date=$this->request->getVar('f_date');
	   

if(!empty($from_Date)){
$fee_search_key[]="date >= '$from_Date'";
}
$to_Date=$this->request->getVar('t_date');
if(!empty($to_Date)){
$fee_search_key[]="date <= '$to_Date'";
}
$enquiry_no=$this->request->getVar('category');
if(!empty($enquiry_no)){
$fee_search_key[]="category = '$enquiry_no'";
}
$category=$this->request->getVar('category');
if(!empty($category)){
$fee_search_key[]="category = '$category'";
}
$class=$this->request->getVar('class');
if(!empty($class)){
$fee_search_key[]="class = '$class'";
}
$semister=$this->request->getVar('semister');
if(!empty($semister)){
$fee_search_key[]="semister = '$semister'";
}
$session=$this->request->getVar('session');
if($session != '')
{
$fee_search_key[]="session = '$session'";
}
if(!empty($fee_search_key)){
 $key= ' WHERE ('.implode(' AND ',$fee_search_key).') ';
 $search = $key;
}
if($key==' AND () '){
$key='';
$search = '';
}
if(($search !=' ')){
 $query1= $this->db->query("SELECT * FROM prospect_sales $search ORDER BY prospect_no DESC");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 $data['source']=$query1->getResultArray();
}else{
    
    $query2= $this->db->query("SELECT * FROM prospect_sales ORDER BY prospect_no DESC");
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
            //  $cat_id = $row['id'];
            // print_r($value);
   endforeach;
	   return view('acedemic/prospectus',$data);  
	}
	public function prospectus_enquired()
	{
	    	    	   helper(['form', 'url']); 
	   $fee_search_key=array();
$from_Date=$this->request->getVar('f_date');
	   


if(!empty($fee_search_key)){
 $key= ' WHERE ('.implode(' AND ',$fee_search_key).') ';
 $search = $key;
}
if($key==' AND () '){
$key='';
$search = '';
}
if(($search !=' ')){
 $query1= $this->db->query("SELECT * FROM prospect_sales $search ORDER BY prospect_no DESC");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 $data['source']=$query1->getResultArray();
}else{
    
    $query2= $this->db->query("SELECT * FROM prospect_sales ORDER BY prospect_no DESC");
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
            //  $cat_id = $row['id'];
            // print_r($value);
   endforeach;
	   return view('acedemic/prospectus_enquired',$data);  
	}
	public function prospectus_enquired1()
	{
	    	    	   helper(['form', 'url']); 
	   $fee_search_key=array();
$from_Date=$this->request->getVar('f_date');
	   


if(!empty($fee_search_key)){
 $key= ' WHERE ('.implode(' AND ',$fee_search_key).') ';
 $search = $key;
}
if($key==' AND () '){
$key='';
$search = '';
}
if(($search !=' ')){
 $query1= $this->db->query("SELECT * FROM prospect_sales $search ORDER BY prospect_no DESC");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 $data['source']=$query1->getResultArray();
}else{
    
    $query2= $this->db->query("SELECT * FROM prospect_sales ORDER BY prospect_no DESC");
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
            //  $cat_id = $row['id'];
            // print_r($value);
   endforeach;
	   return view('acedemic/prospectus_enquired1',$data);  
	}
	public function student_status(){
	    return view('acedemic/student_status');  
	}
		public function section_allocation()
	{
	    helper(['form', 'url']); 
	    $search_key=array();
	    

$class=$this->request->getVar('class');
// echo $class;
if($class !='')
{
// $search_key[]="class = '$class'";
 $search_key[] = "program = '$class'";
}
$semister=$this->request->getVar('semister');
if($semister !='')
{
$search_key[]="semister = '$semister'";
}
$session=$this->request->getVar('session');
if($session != '')
{
$search_key[]="session_year = '$session'";
}
$category=$this->request->getVar('category');
if($category != '')
{
$search_key[]="category = '$category'";
}

if(!empty($search_key)){
 $key= ' WHERE ('.implode(' AND ',$search_key).') ';
 $search = $key;
}

if($key==' AND () '){
$key='';
$search = '';
}
if(($search !='')){
 $query1= $this->db->query("SELECT * FROM student_admission_information $search ORDER BY student_admission_id DESC");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 $data['source']=$query1->getResultArray();
}else{
	    $query2= $this->db->query("SELECT * FROM student_admission_information WHERE active_status='0' ORDER BY student_admission_id  DESC");
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
           
   endforeach;
	   return view('acedemic/section_allocation',$data);  
	}
	public function insert_section(){
	   // $section=$this->request->getVar('section');
	   // $section_change = $this->request->getVar('section_change');


// 	for ($i = 0; $i < count('2'); $i++) {
            // echo $section_change[$i];
        //   $qry2 = mysql_query("UPDATE student_admission_information SET section = '".$_POST['section_name']."' WHERE reg_no = '".$value."'");
        
        // }
	
	}
	public function import_excel()
	{
	   return view('acedemic/import_excel');  
	}
	public function student_search(){
	    helper(['form', 'url']); 
	   $search_key=array();
	   
$reg_no=$this->request->getVar('reg_no');
if(!empty($reg_no)){
$search_key[]="reg_no = '$reg_no'";
}

$first_name=$this->request->getVar('first_name');
if(!empty($first_name)){
$search_key[]="first_name = '$first_name'";
}

$middle_name=$this->request->getVar('middle_name');
if(!empty($middle_name)){
$search_key[]="middle_name = '$middle_name'";
}

$last_name=$this->request->getVar('last_name');
if(!empty($last_name)){
$search_key[]="last_name = '$last_name'";
}

$program=$this->request->getVar('program');
if(!empty($program)){
$search_key[]="class = '$program'";
}

$psemister=$this->request->getVar('psemister');
if(!empty($psemister)){
$search_key[]="semister = '$psemister'";
}

$semister=$this->request->getVar('semister');
if(!empty($semister)){
$search_key[]="semister = '$semister'";
}

$phone_no=$this->request->getVar('phone_no');
if(!empty($phone_no)){
$search_key[]="parent_mobile_number = '$phone_no'";
}

$enrollment_no=$this->request->getVar('enrollment_no');
if(!empty($enrollment_no)){
$search_key[]="enrollment_no = '$enrollment_no'";
}

$session=$this->request->getVar('session');
if(!empty($session)){
$search_key[]="session_year = '$session'";
}

$category=$this->request->getVar('category');
if(!empty($category)){
$search_key[]="category = '$category'";
}

$f_date=$this->request->getVar('f_date');
if(!empty($f_date)){
$program_search_key[]="date_of_admission >= '$f_date'";
}
$t_date=$this->request->getVar('t_date');
if($t_date != '')
{
$search_key[]="date_of_admission <= '$t_date'";
}
if(!empty($search_key)){
 $key= ' WHERE ('.implode(' AND ',$search_key).') ';
 $search = $key;
}
if($key==' AND () '){
$key='';
$search = '';
}
if(($search !=' ')){
 $query1= $this->db->query("SELECT * FROM student_admission_information $search ORDER BY student_admission_id DESC");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 $data['source']=$query1->getResultArray();
}else{
	     $query2= $this->db->query("SELECT * FROM student_admission_information ORDER BY student_admission_id  DESC");
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
           
   endforeach;
   
	    return view('acedemic/student_search',$data);  
	}
	
	
	
	public function strength_report(){
	   
	    return view('acedemic/strength_report');
	    
	}
	
	
	
	public function delete_student_list($student_admission_id){
     $db = \Config\Database::connect();
        $query=$db->query("DELETE FROM `student_admission_information` WHERE student_admission_id = '$student_admission_id'");
        $db->query("DELETE FROM `student_parent_information` WHERE student_admission_id = '$student_admission_id'");
        $db->query("DELETE FROM `student_personal_information` WHERE student_admission_id = '$student_admission_id'");
        $db->query("DELETE FROM `student_contact_detail` WHERE student_admission_id = '$student_admission_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('student_search')->with('success', 'Deleted successfully !.');
        }
}
public function student_admission_form($student_admission_id){
    $data['student_id'] = $student_admission_id;
    return view('acedemic/student_admission_form', $data);  
}
	public function admission_report()
	{
	   return view('acedemic/admission_report');  
	}
	
	
	
// 	Fees
		public function fees_report()
	{
	   return view('acedemic/fees_report');  
	}
	
		public function fees_program()
	{
	   return view('acedemic/fees_program');  
	}
		public function fees_scholarship()
	{
	    
	     $query2= $this->db->query("SELECT * FROM student_admission_information ORDER BY student_admission_id  DESC");
 $data['source']=$query2->getResultArray();

    	 foreach($data['source'] as $key => $value):
           
   endforeach;
	   return view('acedemic/fees_scholarship',$data);  
	}
	
		public function fees_bus()
	{
	   return view('acedemic/fees_bus');  
	}
		public function fees_collect()
	{
	   return view('acedemic/fees_collect');  
	}
		public function fees_management()
	{
	   return view('acedemic/fees_management');  
	}
		public function fees_category()
	{
	   return view('acedemic/fees_category');  
	}
		public function fees_structure()
	{
	   return view('acedemic/fees_structure');  
	}
	public function change_fee_structure($student_admission_id){
	    $db = \Config\Database::connect();

    // Step 1: Retrieve the fee component data from the form
    $fee_components = $this->request->getPost('comp');
    $amounts = $this->request->getPost('amount');

    // Step 2: Prepare the updated fee data to store
    $updated_fee_data = [];
    $total_amount = 0;

    foreach ($fee_components as $component) {
        if (isset($amounts[$component])) {
            $amount = $amounts[$component];
            // Update total amount
            $total_amount += $amount;
            // Prepare the updated fee data for the component
            $updated_fee_data[] = $component . '_' . $amount;
        }
    }

    // Step 3: Convert the updated fee data into a semicolon-separated string
    $updated_fee_str = implode(';', $updated_fee_data);

    // Step 4: Update the fee component data in the database
    $update = $db->query("UPDATE student_admission_fee SET fee_component_id = ? WHERE student_admission_id = ?", [$updated_fee_str, $student_admission_id]);
if($update){
    return redirect()->to('fees_report/fees_structure')->with('success', 'Fees structure changed successfully');
}
	}
		public function fees_report2()
	{
	   return view('acedemic/fees_report2');  
	}
	
	
	
	
	
	
	

	
		public function leaving()
	{
	   return view('acedemic/leaving');  
	}
	
		public function cert_leaving()
		{
	   return view('acedemic/cert_leaving');  
	}
	
	
		public function cer_leaving_print_final()
		{
	   return view('acedemic/cer_leaving_print_final');  
	}
		public function bonafied()
	{
	   return view('acedemic/bonafied');  
	}
		public function leaving_list()
	{
	   return view('acedemic/leaving_list');  
	}
		public function bonafied_list()
	{
	    $query2= $this->db->query("SELECT * FROM student_admission_information WHERE active_status='0' ORDER BY student_admission_id  DESC");
 $data['source']=$query2->getResultArray();

    	 foreach($data['source'] as $key => $value):
           
   endforeach;
	   return view('acedemic/bonafied_list',$data);  
	}
	
		public function stu_attendence_daily()
	{
	   return view('acedemic/stu_attendence_daily');  
	}
		public function stu_attendence_report()
	{
	   return view('acedemic/stu_attendence_report');  
	}
	
		public function daily_report()
	{
	   return view('acedemic/daily_report');  
	}
		public function present_report()
	{
	   return view('acedemic/present_report');  
	}
		public function absent_report()
	{
	   return view('acedemic/absent_report');  
	}
		public function weekly_report()
	{
	   return view('acedemic/weekly_report');  
	}
		public function branchwise_report()
	{
	   return view('acedemic/branchwise_report');  
	}
		public function monthly_report()
	{
	   return view('acedemic/monthly_report');  
	}
		public function attendence_percentage()
	{
	   return view('acedemic/attendence_percentage');  
	}
		public function send_sms()
	{
	   return view('acedemic/send_sms');  
	}
	
// 	Student Admission 
	public function student_admission()
	{
	   return view('acedemic/student_admission');  
	}
	public function new_admission()
	{
	   return view('acedemic/new_admission');  
	}
	
	public function student_parent_contact()
	{
	    
	   return view('acedemic/student_parent_contact');  
	}
	
	
// 	ADMINISTRATOR


public function create_user()
{
    $data['roles'] = $this->db->table('roles')
        ->where('status', 1)
        ->orderBy('role_name', 'ASC')
        ->get()
        ->getResultArray();

    return view('administrator/create_user', $data);
}


public function save_user()
{
    $validation = $this->validate([
        'username' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Username is required'
            ]
        ],
        'password' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Password is required'
            ]
        ],
        'conf_password' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Confirm password is required'
            ]
        ]
    ]);

    $username = trim($this->request->getPost('username'));
    $password = $this->request->getPost('password');
    $confirmPassword = $this->request->getPost('conf_password');
    $usertype = $this->request->getPost('usertype');
    $roleId = $this->request->getPost('role_id');

    // Check validation
    if (!$validation) {
        $data['validation'] = $this->validator;
        $data['roles'] = $this->db->table('roles')
            ->where('status', 1)
            ->orderBy('role_name', 'ASC')
            ->get()
            ->getResultArray();

        return view('administrator/create_user', $data);
    }

    // Confirm password
    if ($password !== $confirmPassword) {
        return redirect()->back()
            ->withInput()
            ->with('select_fail', 'Password and Confirm Password do not match.');
    }

    // Validate selected role
    $role = $this->db->table('roles')
        ->where('role_id', $roleId)
        ->where('status', 1)
        ->get()
        ->getRowArray();

    if (!$role) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please select a valid role.');
    }

    // Check duplicate username
    $existingUser = $this->db->table('user')
        ->where('user_name', $username)
        ->countAllResults();

    if ($existingUser > 0) {
        return redirect()->back()
            ->withInput()
            ->with('select_fail', $username . ' Username is already taken!');
    }

    // Old permissions - kept for existing system compatibility
    $admission = $this->request->getPost('admission') ?? 0;
    $fees = $this->request->getPost('fees') ?? 0;
    $scholarship = $this->request->getPost('scholarship') ?? 0;
    $time_table = $this->request->getPost('time_table') ?? 0;
    $employee_manage = $this->request->getPost('employee_manage') ?? 0;
    $staff_atten = $this->request->getPost('staff_atten') ?? 0;
    $salary = $this->request->getPost('salary') ?? 0;
    $leaves = $this->request->getPost('leaves') ?? 0;
    $eve_planner = $this->request->getPost('eve_planner') ?? 0;
    $library = $this->request->getPost('library') ?? 0;
    $stock = $this->request->getPost('stock') ?? 0;
    $amount = $this->request->getPost('amount') ?? 0;
    $exam = $this->request->getPost('exam') ?? 0;
    $certificates = $this->request->getPost('certificates') ?? 0;
    $user_manage = $this->request->getPost('user_manage') ?? 0;
    $administrator = $this->request->getPost('administrator') ?? 0;

    // Keep at least one old permission selected for now
    $oldPermissions = [
        $admission, $fees, $scholarship, $time_table,
        $employee_manage, $staff_atten, $salary, $leaves,
        $eve_planner, $library, $stock, $amount, $exam,
        $certificates, $user_manage, $administrator
    ];

    if (!in_array(1, array_map('intval', $oldPermissions), true)) {
        return redirect()->back()
            ->withInput()
            ->with('select_fail', 'Select at least one permission!');
    }

    // Insert user
    $this->db->table('user')->insert([
        'emp_id' => 0,
        'usertype' => $usertype,
        'user_name' => $username,
        'password' => $password
    ]);

    if ($this->db->affectedRows() <= 0) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'User could not be created.');
    }

    $lastInsertedId = $this->db->insertID();

    // Insert old permissions
    $this->db->table('user_perm')->insert([
        'user_id' => $lastInsertedId,
        'ADMISSION' => $admission,
        'FEES' => $fees,
        'SCHOLARSHIP' => $scholarship,
        'TIME_TABLE' => $time_table,
        'EMPLOYEE_MANAGEMENT' => $employee_manage,
        'STAFF_ATTENDANCE' => $staff_atten,
        'SALARY' => $salary,
        'LEAVES' => $leaves,
        'EVENT_PLANNER' => $eve_planner,
        'LIBRARY' => $library,
        'STOCK' => $stock,
        'ACCOUNT' => $amount,
        'EXAM' => $exam,
        'CERTIFICATES' => $certificates,
        'USER_MANAGEMENT' => $user_manage,
        'ADMINISTRATOR' => $administrator
    ]);

    // Assign selected role to new user
    $this->db->table('user_roles')->insert([
        'user_id' => $lastInsertedId,
        'role_id' => $roleId
    ]);

    return redirect()->to('permission-panel')
        ->with('success', 'User created successfully!');
}


public function update_password(){
	 $validation = $this->validate([
            'username' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Username is required',
                ],
            ],
            'password' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Password is required',
                ],
            ],
            'conf_password' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Password is required',
                ],
            ],
            
        ]);

        if (!$validation) {
            // echo "not validated";
            
            $data['validation'] = $this->validator;
            return view('forget_password', $data);
        }else{
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            $id=$_SESSION['adminloggedid'];
              $query=$this->db->query("UPDATE `user` SET `password`='$password' WHERE `user_id`='$id'");
               if (!$query) {
                    return  redirect()->back->with('fail', 'Failed to Add !.');
                } else {
                    return  redirect()->to('forget_password')->with('success', 'Password Changed successfully !.');
                }
        }
}
	public function permission_panel()
	{
	   return view('administrator/permission_panel');  
	}
	public function permission_panel1()
	{
	   return view('administrator/permission-panel');  
	}
	
// 	Acedemics - Admision / Report

public function report_section()
	{
	    helper(['form', 'url']); 
	    $search_key=array();
	    

$section=$this->request->getVar('section');
if($section !='')
{
$search_key[]="section = '$section'";
}

if(!empty($search_key)){
 $key= ' WHERE ('.implode(' AND ',$search_key).') ';
 $search = $key;
}

if($key==' AND () '){
$key='';
$search = '';
}
if(($search !='')){
 $query1= $this->db->query("SELECT * FROM student_admission_information $search ORDER BY student_admission_id DESC");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 $data['source']=$query1->getResultArray();
}else{
	    $query2= $this->db->query("SELECT * FROM student_admission_information WHERE active_status='0' ORDER BY student_admission_id  DESC");
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
           
   endforeach;
	   return view('acedemic/report_section',$data);  
	 
	}
	public function report_category()
	{
	      helper(['form', 'url']); 
	    $search_key=array();
	    

$section=$this->request->getVar('section');
if($section !='')
{
$search_key[]="section = '$section'";
}

if(!empty($search_key)){
 $key= ' WHERE ('.implode(' AND ',$search_key).') ';
 $search = $key;
}

if($key==' AND () '){
$key='';
$search = '';
}
if(($search !='')){
 $query1= $this->db->query("SELECT * FROM student_category $search ORDER BY category_id DESC");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 $data['source']=$query1->getResultArray();
}else{
	    $query2= $this->db->query("SELECT * FROM student_category  ORDER BY category_id  DESC");
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
           
   endforeach;
	   return view('acedemic/report_category',$data);  
	}
	public function report_register()
	{
	        helper(['form', 'url']); 
	    $search_key=array();
	    

$section=$this->request->getVar('section');
if($section !='')
{
$search_key[]="section = '$section'";
}

if(!empty($search_key)){
 $key= ' WHERE ('.implode(' AND ',$search_key).') ';
 $search = $key;
}

if($key==' AND () '){
$key='';
$search = '';
}
if(($search !='')){
    $db      = \Config\Database::connect();
 $query1= $this->db->query("SELECT * FROM student_admission_information $search ORDER BY student_admission_id DESC");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 $data['source']=$query1->getResultArray();
}else{
	    $query2= $this->db->query("SELECT * FROM student_admission_information WHERE active_status='0' ORDER BY student_admission_id  DESC");
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
           
   endforeach;
	   return view('acedemic/report_register',$data);  
	}
	public function report_admission_type()
	{
	         helper(['form', 'url']); 
	    $search_key=array();
	    

$section=$this->request->getVar('section');
if($section !='')
{
$search_key[]="section = '$section'";
}

if(!empty($search_key)){
 $key= ' WHERE ('.implode(' AND ',$search_key).') ';
 $search = $key;
}

if($key==' AND () '){
$key='';
$search = '';
}
if(($search !='')){
    $db      = \Config\Database::connect();
 $query1= $this->db->query("SELECT * FROM student_admission_information $search ORDER BY student_admission_id DESC");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 $data['source']=$query1->getResultArray();
}else{
	    $query2= $this->db->query("SELECT * FROM student_admission_information WHERE active_status='0' ORDER BY student_admission_id  DESC");
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
           
   endforeach;
	   return view('acedemic/report_admission_type',$data);  
	}
	public function report_student()
	{
	       helper(['form', 'url']); 
	    $search_key=array();
	    

$section=$this->request->getVar('section');
if($section !='')
{
$search_key[]="section = '$section'";
}

if(!empty($search_key)){
 $key= ' WHERE ('.implode(' AND ',$search_key).') ';
 $search = $key;
}

if($key==' AND () '){
$key='';
$search = '';
}
if(($search !='')){
    $db      = \Config\Database::connect();
 $query1= $this->db->query("SELECT * FROM student_admission_information $search ORDER BY student_admission_id DESC");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 $data['source']=$query1->getResultArray();
}else{
	    $query2= $this->db->query("SELECT * FROM student_admission_information WHERE active_status='0' ORDER BY student_admission_id  DESC");
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
           
   endforeach;
	   return view('acedemic/report_student',$data);  
	}
	public function report_admission_report()
	{
	           helper(['form', 'url']); 
	    $search_key=array();
	    

$section=$this->request->getVar('section');
if($section !='')
{
$search_key[]="section = '$section'";
}

if(!empty($search_key)){
 $key= ' WHERE ('.implode(' AND ',$search_key).') ';
 $search = $key;
}

if($key==' AND () '){
$key='';
$search = '';
}
if(($search !='')){
    $db      = \Config\Database::connect();
 $query1= $this->db->query("SELECT * FROM student_admission_information $search ORDER BY student_admission_id DESC");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 $data['source']=$query1->getResultArray();
}else{
	    $query2= $this->db->query("SELECT * FROM student_admission_information WHERE active_status='0' ORDER BY student_admission_id  DESC");
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
           
   endforeach;
	   return view('acedemic/report_admission_report',$data);  
	}
	public function report_last_exam()
	{
	    
	           helper(['form', 'url']); 
	    $search_key=array();
	    

$section=$this->request->getVar('section');
if($section !='')
{
$search_key[]="section = '$section'";
}

if(!empty($search_key)){
 $key= ' WHERE ('.implode(' AND ',$search_key).') ';
 $search = $key;
}

if($key==' AND () '){
$key='';
$search = '';
}
if(($search !='')){
    $db      = \Config\Database::connect();
 $query1= $this->db->query("SELECT * FROM student_admission_information $search ORDER BY student_admission_id DESC");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 $data['source']=$query1->getResultArray();
}else{
	    $query2= $this->db->query("SELECT * FROM student_admission_information WHERE active_status='0' ORDER BY student_admission_id  DESC");
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
           
   endforeach;
	   return view('acedemic/report_last_exam',$data);  
	}
	public function report_last_school()
	{
	       helper(['form', 'url']); 
	    $search_key=array();
	    

$section=$this->request->getVar('section');
if($section !='')
{
$search_key[]="section = '$section'";
}

if(!empty($search_key)){
 $key= ' WHERE ('.implode(' AND ',$search_key).') ';
 $search = $key;
}

if($key==' AND () '){
$key='';
$search = '';
}
if(($search !='')){
    $db      = \Config\Database::connect();
 $query1= $this->db->query("SELECT * FROM student_admission_information $search ORDER BY student_admission_id DESC");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 $data['source']=$query1->getResultArray();
}else{
	    $query2= $this->db->query("SELECT * FROM student_admission_information WHERE active_status='0' ORDER BY student_admission_id  DESC");
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
           
   endforeach;
	   return view('acedemic/report_last_school',$data);  
	}
	public function report_medium()
	{
	    helper(['form', 'url']); 
	    $search_key=array();
	    

$section=$this->request->getVar('section');
if($section !='')
{
$search_key[]="section = '$section'";
}

if(!empty($search_key)){
 $key= ' WHERE ('.implode(' AND ',$search_key).') ';
 $search = $key;
}

if($key==' AND () '){
$key='';
$search = '';
}
if(($search !='')){
    $db      = \Config\Database::connect();
 $query1= $this->db->query("SELECT * FROM student_admission_information $search ORDER BY student_admission_id DESC");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 $data['source']=$query1->getResultArray();
}else{
	    $query2= $this->db->query("SELECT * FROM student_admission_information WHERE active_status='0' ORDER BY student_admission_id  DESC");
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
           
   endforeach;
	   return view('acedemic/report_medium',$data);  
	}
	public function report_institute()
	{
	    helper(['form', 'url']); 
	    $search_key=array();
	    

$section=$this->request->getVar('section');
if($section !='')
{
$search_key[]="section = '$section'";
}

if(!empty($search_key)){
 $key= ' WHERE ('.implode(' AND ',$search_key).') ';
 $search = $key;
}

if($key==' AND () '){
$key='';
$search = '';
}
if(($search !='')){
    $db      = \Config\Database::connect();
 $query1= $this->db->query("SELECT * FROM student_admission_information $search ORDER BY student_admission_id DESC");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 $data['source']=$query1->getResultArray();
}else{
	    $query2= $this->db->query("SELECT * FROM student_admission_information WHERE active_status='0' ORDER BY student_admission_id  DESC");
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
           
   endforeach;
	   return view('acedemic/report_institute',$data);  
	}
	public function report_percentage()
	{
	    helper(['form', 'url']); 
	    $search_key=array();
	    

$section=$this->request->getVar('section');
if($section !='')
{
$search_key[]="section = '$section'";
}

if(!empty($search_key)){
 $key= ' WHERE ('.implode(' AND ',$search_key).') ';
 $search = $key;
}

if($key==' AND () '){
$key='';
$search = '';
}
if(($search !='')){
    $db      = \Config\Database::connect();
 $query1= $this->db->query("SELECT * FROM student_admission_information $search ORDER BY student_admission_id DESC");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 $data['source']=$query1->getResultArray();
}else{
	    $query2= $this->db->query("SELECT * FROM student_admission_information WHERE active_status='0' ORDER BY student_admission_id  DESC");
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
           
   endforeach;
	   return view('acedemic/report_percentage',$data);  
	}
		public function update_percentage()
	{
	   return view('acedemic/update_percentage');  
	}
	public function report_sports_achievement()
	{
	     helper(['form', 'url']); 
	    $search_key=array();
	    

$section=$this->request->getVar('section');
if($section !='')
{
$search_key[]="section = '$section'";
}

if(!empty($search_key)){
 $key= ' WHERE ('.implode(' AND ',$search_key).') ';
 $search = $key;
}

if($key==' AND () '){
$key='';
$search = '';
}
if(($search !='')){
    $db      = \Config\Database::connect();
 $query1= $this->db->query("SELECT * FROM student_admission_information $search ORDER BY student_admission_id DESC");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 $data['source']=$query1->getResultArray();
}else{
	    $query2= $this->db->query("SELECT * FROM student_admission_information WHERE active_status='0' ORDER BY student_admission_id  DESC");
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
           
   endforeach;
	   return view('acedemic/report_sports_achievement',$data);  
	}
	public function report_custom()
	{
	   return view('acedemic/report_custom');  
	}
	public function report_area()
	{
	   return view('acedemic/report_area');  
	}
	public function list_purchase_prospectus()
	{
	     helper(['form', 'url']); 
	    $search_key=array();
	    

$section=$this->request->getVar('section');
if($section !='')
{
$search_key[]="section = '$section'";
}

if(!empty($search_key)){
 $key= ' WHERE ('.implode(' AND ',$search_key).') ';
 $search = $key;
}

if($key==' AND () '){
$key='';
$search = '';
}
if(($search !='')){
    $db      = \Config\Database::connect();
 $query1= $this->db->query("SELECT * FROM prospect_sales $search ORDER BY enquiry_no DESC");
//  echo "SELECT * FROM marketing_enquiry $search ORDER BY enquiry_no DESC";
 $data['source']=$query1->getResultArray();
}else{
	    $query2= $this->db->query("SELECT * FROM prospect_sales  ORDER BY enquiry_no  DESC");
 $data['source']=$query2->getResultArray();
}
    	 foreach($data['source'] as $key => $value):
           
   endforeach;
	   return view('acedemic/list_purchase_prospectus',$data);  
	}
	public function list_not_purchase_prospectus()
	{
	   return view('acedemic/list_not_purchase_prospectus');  
	}
	 
    
    public function daily_collection_report()
	{
	   return view('acedemic/daily_collection_report');  
	}
	public function Bus_collection_report()
	{
	   return view('acedemic/bus_collection_report');  
	}
	public function student_fees_report()
	{
	   return view('acedemic/student_fees_report');  
	}
	public function balance_on_student()
	{
	   return view('acedemic/balance_on_student');  
	}
	public function balance_bus()
	{
	   return view('acedemic/balance_bus');  
	}
	public function balance_only_outstanding()
	{
	   return view('acedemic/balance_only_outstanding');  
	}
	public function section_wise()
	{
	   return view('acedemic/section_wise');  
	}
	public function fees_consession_report()
	{
	   return view('acedemic/fees_consession_report');  
	}
	public function balance_less_paid()
	{
	   return view('acedemic/balance_less_paid');  
	}
	public function scholarship_form_not_submitted_ref()
	{
	   return view('acedemic/scholarship_form_not_submitted_ref');  
	}
	public function scholarship_form_not_submitted()
	{
	   return view('acedemic/scholarship_form_not_submitted');  
	}
	public function balance_student_reference()
	{
	   return view('acedemic/balance_student_reference');  
	}
	public function bus_fees_report()
	{
	   return view('acedemic/bus_fees_report');  
	}
	


public function forget_password()
	{
	   return view('forget_password');  
	}
	
	public function cert_bonafied()
	{
	   return view('acedemic/cert_bonafied');  
	}
	
			public function togglestatus()
	{
		//get id
		$id = $this->request->getVar('id');

// 		//create obj for db
		$Admission = new AdmissionModel();
		$data2 = $Admission->where('student_admission_id', $id)->first();
// 		$data2['soursce']=$Admissions->fetch_row($id);
		
// 		//toggle status
		if($data2['scholarship_status'] == 1){
			$data1['scholarship_status']= 0;
		} else {
			$data1['scholarship_status']= 1;
		}

// 		//store in db
		$Admission->update_row($id, $data1);
// 		echo json_encode($id);
	}


	//new routes

public function create_role()
{
    $roleId = $this->request->getGet('role_id');

    // All roles for Role List
    $data['roles'] = $this->db->table('roles')
        ->orderBy('role_id', 'DESC')
        ->get()
        ->getResultArray();

    // Modules/pages with parent menu name
    $data['modules'] = $this->db->table('modules m')
        ->select('m.module_id, m.module_name, m.route, p.module_name AS parent_name')
        ->join('modules p', 'p.module_id = m.parent_id', 'left')
        ->where('m.route IS NOT NULL', null, false)
        ->where('m.status', 1)
        ->orderBy('m.sort_order', 'ASC')
        ->orderBy('m.module_id', 'ASC')
        ->get()
        ->getResultArray();

    // All available permissions
    $data['permissions'] = $this->db->table('permissions')
        ->orderBy('module_id', 'ASC')
        ->get()
        ->getResultArray();

    // Selected role permissions
    $data['assignedPermissions'] = [];

    if (!empty($roleId)) {
        $data['assignedPermissions'] = $this->db->table('role_permissions')
            ->select('permission_id')
            ->where('role_id', $roleId)
            ->get()
            ->getResultArray();

        $data['assignedPermissions'] = array_column(
            $data['assignedPermissions'],
            'permission_id'
        );
    }

    // Permission count for Role List
    $data['rolePermissionCounts'] = [];

    $counts = $this->db->table('role_permissions')
        ->select('role_id, COUNT(permission_id) AS total')
        ->groupBy('role_id')
        ->get()
        ->getResultArray();

    foreach ($counts as $count) {
        $data['rolePermissionCounts'][$count['role_id']] = $count['total'];
    }

    $data['selectedRole'] = $roleId;

    return view('administrator/create_role', $data);
}


public function save_role()
{
    $roleName = trim($this->request->getPost('role_name'));
    $description = trim($this->request->getPost('description') ?? '');
    $status = $this->request->getPost('status');

    // Basic validation
    if ($roleName === '') {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Role name is required.');
    }

    if (!in_array((string) $status, ['0', '1'], true)) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please select a valid status.');
    }

    // Check duplicate role name
    $existingRole = $this->db->table('roles')
        ->where('role_name', $roleName)
        ->countAllResults();

    if ($existingRole > 0) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'This role already exists.');
    }

    // Save role
    $this->db->table('roles')->insert([
        'role_name'   => $roleName,
        'description' => $description,
        'status'      => $status
    ]);

    return redirect()->to(base_url('create_role'))
        ->with('success', 'Role created successfully!');
}


public function save_role_permissions()
{
    $submittedRoleId = $this->request->getPost('role_id');
    $submittedPermissionIds = $this->request->getPost('permissions');
    $loggedPermissionIds = [];

    if (is_array($submittedPermissionIds)) {
        foreach (array_slice($submittedPermissionIds, 0, 100) as $permissionId) {
            $loggedPermissionIds[] = is_scalar($permissionId) && ctype_digit((string) $permissionId)
                ? (string) (int) $permissionId
                : 'invalid';
        }
    }

    $loggedRoleId = is_scalar($submittedRoleId) && ctype_digit((string) $submittedRoleId)
        ? (string) (int) $submittedRoleId
        : 'invalid';

    log_message(
        'error',
        '[RBAC diagnostic] permission POST received: role_id=' . $loggedRoleId
        . ', permission_count=' . (is_array($submittedPermissionIds) ? count($submittedPermissionIds) : 0)
        . ', permission_ids=' . implode(',', $loggedPermissionIds)
    );

    if (!is_scalar($submittedRoleId) || !ctype_digit((string) $submittedRoleId) || (int) $submittedRoleId < 1) {
        return redirect()->back()
            ->with('error', 'Please select a valid role.');
    }

    $roleId = (int) $submittedRoleId;
    $submittedPermissionIds = $submittedPermissionIds ?? [];

    if (!is_array($submittedPermissionIds)) {
        return redirect()->back()
            ->with('error', 'Invalid permission selection.');
    }

    $permissionIds = [];
    foreach ($submittedPermissionIds as $permissionId) {
        if (!is_scalar($permissionId) || !ctype_digit((string) $permissionId) || (int) $permissionId < 1) {
            return redirect()->back()
                ->with('error', 'Invalid permission selected.');
        }

        $permissionIds[] = (int) $permissionId;
    }
    $permissionIds = array_values(array_unique($permissionIds));

    // Check role exists and is active
    $role = $this->db->table('roles')
        ->where('role_id', $roleId)
        ->where('status', 1)
        ->get()
        ->getRowArray();

    if (!$role) {
        log_message('error', '[RBAC diagnostic] role validation failed: role_id=' . $roleId);
        return redirect()->back()
            ->with('error', 'Please select a valid role.');
    }

    // Validate submitted permission IDs
    if (!empty($permissionIds)) {
        $validPermissions = $this->db->table('permissions')
            ->select('permission_id')
            ->whereIn('permission_id', $permissionIds)
            ->get()
            ->getResultArray();

        $validIds = array_map(
            'intval',
            array_column($validPermissions, 'permission_id')
        );

        if (count($validIds) !== count($permissionIds)) {
            log_message(
                'error',
                '[RBAC diagnostic] permission validation failed: role_id=' . $roleId
                . ', submitted_count=' . count($permissionIds)
                . ', valid_count=' . count($validIds)
            );
            return redirect()->back()
                ->with('error', 'Invalid permission selected.');
        }
    }

    $transactionStarted = false;
    $saveStage = 'begin';
    try {
        if ($this->db->transBegin() !== true) {
            throw new \RuntimeException('Unable to start the permission transaction.');
        }
        $transactionStarted = true;

        $saveStage = 'delete';
        $deleteSucceeded = $this->db->table('role_permissions')
            ->where('role_id', $roleId)
            ->delete();

        if ($deleteSucceeded !== true) {
            $dbError = $this->db->error();
            $dbMessage = substr(
                preg_replace('/[\r\n\t]+/', ' ', (string) ($dbError['message'] ?? '')),
                0,
                240
            );
            log_message(
                'error',
                '[RBAC diagnostic] permission delete failed: role_id=' . $roleId
                . ', database_error=' . ($dbError['code'] ?? 'unknown')
                . ', database_message=' . ($dbMessage !== '' ? $dbMessage : 'none')
            );
            throw new \RuntimeException(
                'Permission delete failed (database error ' . ($dbError['code'] ?? 'unknown') . ').'
            );
        }

        $saveStage = 'insert';
        foreach ($permissionIds as $permissionId) {
            $insertSucceeded = $this->db->table('role_permissions')->insert([
                'role_id'       => $roleId,
                'permission_id' => $permissionId
            ]);

            if ($insertSucceeded !== true) {
                $dbError = $this->db->error();
                $dbMessage = substr(
                    preg_replace('/[\r\n\t]+/', ' ', (string) ($dbError['message'] ?? '')),
                    0,
                    240
                );
                log_message(
                    'error',
                    '[RBAC diagnostic] permission insert failed: role_id=' . $roleId
                    . ', permission_id=' . $permissionId
                    . ', database_error=' . ($dbError['code'] ?? 'unknown')
                    . ', database_message=' . ($dbMessage !== '' ? $dbMessage : 'none')
                );
                throw new \RuntimeException(
                    'Permission insert failed for permission_id=' . $permissionId
                    . ' (database error ' . ($dbError['code'] ?? 'unknown') . ').'
                );
            }
        }

        if ($this->db->transStatus() === false) {
            throw new \RuntimeException('Permission save failed.');
        }

        $saveStage = 'commit';
        if ($this->db->transCommit() !== true) {
            throw new \RuntimeException('Unable to commit the permission transaction.');
        }
        $transactionStarted = false;

        $saveStage = 'verify';
        $storedPermissionIds = $this->db->table('role_permissions')
            ->select('permission_id')
            ->where('role_id', $roleId)
            ->get()
            ->getResultArray();
        $storedPermissionIds = array_map('intval', array_column($storedPermissionIds, 'permission_id'));
        $expectedPermissionIds = $permissionIds;
        sort($storedPermissionIds);
        sort($expectedPermissionIds);

        if ($storedPermissionIds !== $expectedPermissionIds) {
            throw new \RuntimeException('Saved permissions did not match the submitted permissions.');
        }

        log_message(
            'error',
            '[RBAC diagnostic] permission save verified: role_id=' . $roleId
            . ', stored_count=' . count($storedPermissionIds)
        );

        return redirect()->to(base_url('create_role?role_id=' . $roleId))
            ->with('success', 'Role permissions saved successfully.');

    } catch (\Throwable $e) {
        if ($transactionStarted) {
            $this->db->transRollback();
        }

        $dbError = $this->db->error();
        $dbMessage = substr(
            preg_replace('/[\r\n\t]+/', ' ', (string) ($dbError['message'] ?? '')),
            0,
            240
        );
        log_message(
            'error',
            '[RBAC diagnostic] permission save failed: role_id=' . $roleId
            . ', stage=' . $saveStage
            . ', exception=' . get_class($e)
            . ', database_error=' . ($dbError['code'] ?? 'none')
            . ', database_message=' . ($dbMessage !== '' ? $dbMessage : 'none')
        );

        return redirect()->back()
            ->with('error', 'Unable to save role permissions.');
    }
}
public function create_menu()
{
    $data['modules'] = $this->db->table('modules')
        ->where('status', 1)
        ->orderBy('sort_order', 'ASC')
        ->get()
        ->getResultArray();

    return view('administrator/create_menu', $data);
}


public function save_menu()
{
    $menuName = trim($this->request->getPost('module_name') ?? '');
    $parentId = $this->request->getPost('parent_id');
    $route = trim($this->request->getPost('route') ?? '');
    $icon = trim($this->request->getPost('icon') ?? '');
    $sortOrder = (int) ($this->request->getPost('sort_order') ?? 0);
    $isMenu = (int) ($this->request->getPost('is_menu') ?? 1);
    $status = (int) ($this->request->getPost('status') ?? 1);

    // Basic validation
    if ($menuName === '') {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Menu name is required.');
    }

    // Generate module key from route or menu name
    $moduleKey = strtolower($route !== '' ? $route : $menuName);
    $moduleKey = preg_replace('/[^a-z0-9]+/', '_', $moduleKey);
    $moduleKey = trim($moduleKey, '_');

    if ($moduleKey === '') {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Invalid menu name or route.');
    }

    // Check duplicate module key
    $exists = $this->db->table('modules')
        ->where('module_key', $moduleKey)
        ->countAllResults();

    if ($exists > 0) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'This menu already exists.');
    }

    // Validate parent menu
    $parentId = ($parentId === '' || $parentId === '0')
        ? null
        : (int) $parentId;

    if ($parentId !== null) {
        $parentExists = $this->db->table('modules')
            ->where('module_id', $parentId)
            ->where('status', 1)
            ->countAllResults();

        if (!$parentExists) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Invalid parent menu selected.');
        }
    }

    $menuData = [
        'parent_id'  => $parentId,
        'module_name' => $menuName,
        'module_key' => $moduleKey,
        'route'      => $route,
        'icon'       => $icon,
        'sort_order' => $sortOrder,
        'is_menu'    => $isMenu,
        'status'     => $status,
        'created_at' => date('Y-m-d H:i:s')
    ];

    $this->db->transBegin();

    try {

        // Insert menu
        $this->db->table('modules')->insert($menuData);

        $moduleId = $this->db->insertID();

        // Automatically create four permissions
        $permissions = [
            ['module_id' => $moduleId, 'action_name' => 'view'],
            ['module_id' => $moduleId, 'action_name' => 'add'],
            ['module_id' => $moduleId, 'action_name' => 'edit'],
            ['module_id' => $moduleId, 'action_name' => 'delete'],
        ];

        $this->db->table('permissions')->insertBatch($permissions);

        if ($this->db->transStatus() === false) {
            throw new \RuntimeException('Database operation failed.');
        }

        $this->db->transCommit();

        return redirect()->to(base_url('create_menu'))
            ->with('success', 'Menu created successfully with all permissions.');

    } catch (\Throwable $e) {

        $this->db->transRollback();

        log_message('error', 'Create Menu Error: ' . $e->getMessage());

        return redirect()->back()
            ->withInput()
            ->with('error', 'Unable to create menu. Please try again.');
    }
}

}