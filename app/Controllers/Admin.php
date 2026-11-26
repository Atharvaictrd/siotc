<?php
namespace App\Controllers;
use App\Models\UserModel;
use App\Models\AdmissionModel;
use App\Models\UserCustomMenuModel;
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


public function loginsubmit()
{
    $validation = $this->validate([
        'username' => [
            'label'  => 'User Name',
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

    if (!$validation) {
        $data['error'] = $this->validator->getErrors();
        return view('login', $data);
    }

    // Get form data
    $username = trim($this->request->getVar('username'));
    $password = $this->request->getVar('password');
    $session1 = $this->request->getVar('session');

    // Create UserModel object
    $admin = new UserModel();

    // Login using username and password
    $row = $admin->where('user_name', $username)
                 ->where('password', $password)
                 ->first();

    if ($row) {

        session()->set('adminloggedid', $row['user_id']);
        session()->set('adminloggedname', $row['user_name']);
        session()->set('session_year', $session1);

        return redirect()->to(base_url(route_to('dashboard')));

    } else {

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
    $adminId = session()->get('adminloggedid');

    $db = \Config\Database::connect();

    // Assigned active roles
    $roles = $db->table('user_roles ur')
        ->select('r.role_id, r.role_name')
        ->join('roles r', 'r.role_id = ur.role_id')
        ->where('ur.user_id', $adminId)
        ->where('r.status', 1)
        ->get()
        ->getResultArray();

    $roleIds = array_map('intval', array_column($roles, 'role_id'));

    // Super Admin check
    $isSuperAdmin = false;

    foreach ($roles as $role) {
        $roleName = strtolower(
            preg_replace('/[\s_-]+/', '', $role['role_name'])
        );

        if ($roleName === 'superadmin') {
            $isSuperAdmin = true;
            break;
        }
    }

    // Fees Report child module keys
    $feesPages = [
        'scholarship_section',
        'fees_collection',
        'bus_fees_collection',
        'collect_other_fees',
        'management_concession',
        'change_student_category',
        'change_student_fees_structure',
        'fees_report_page'
    ];

    $data['allowedFeesPages'] = [];

    if ($isSuperAdmin) {

        foreach ($feesPages as $key) {
            $data['allowedFeesPages'][$key] = true;
        }

    } else {

        // Role-based View permissions
        $rolePermissionIds = [];

        if (!empty($roleIds)) {
            $rolePermissionRows = $db->table('role_permissions')
                ->select('permission_id')
                ->whereIn('role_id', $roleIds)
                ->get()
                ->getResultArray();

            $rolePermissionIds = array_map(
                'intval',
                array_column($rolePermissionRows, 'permission_id')
            );
        }

        // User-specific permission overrides
        $userOverrides = $db->table('user_permissions')
            ->select('permission_id, permission_status')
            ->where('user_id', $adminId)
            ->get()
            ->getResultArray();

        $overrideMap = [];

        foreach ($userOverrides as $override) {
            $overrideMap[(int) $override['permission_id']] =
                (int) $override['permission_status'];
        }

        // Get child module View permissions
        $permissions = $db->table('modules m')
            ->select('m.module_key, p.permission_id')
            ->join('permissions p', 'p.module_id = m.module_id')
            ->whereIn('m.module_key', $feesPages)
            ->where('p.action_name', 'view')
            ->where('m.status', 1)
            ->get()
            ->getResultArray();

        foreach ($permissions as $permission) {

            $permissionId = (int) $permission['permission_id'];
            $moduleKey = $permission['module_key'];

            // User override takes priority over role permission
            if (array_key_exists($permissionId, $overrideMap)) {
                $allowed = ($overrideMap[$permissionId] === 1);
            } else {
                $allowed = in_array($permissionId, $rolePermissionIds, true);
            }

            $data['allowedFeesPages'][$moduleKey] = $allowed;
        }
    }

    return view('acedemic/fees_report', $data);
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

    $data['modules'] = $this->db->table('modules')
        ->where('status', 1)
        ->orderBy('sort_order', 'ASC')
        ->get()
        ->getResultArray();

$feesReportModuleId = $this->getFeesReportModuleId();
$permissionQuery = $this->db->table('permissions p')
    ->select('p.permission_id, p.module_id, p.action_name')
    ->join('modules m', 'm.module_id = p.module_id')
    ->where('m.status', 1)
    ->groupStart()
    ->where('m.route IS NOT NULL', null, false);

if ($feesReportModuleId !== null) {
    $permissionQuery->orWhere('m.parent_id', $feesReportModuleId);
}

$data['permissions'] = $permissionQuery
    ->groupEnd()
    ->whereNotIn('m.module_key', [
        'user_management',
        'roles_permissions',
        'create_user',
        'create_menu'
    ])
    ->orderBy('p.module_id', 'ASC')
    ->orderBy('p.permission_id', 'ASC')
    ->get()
    ->getResultArray();

    $data['assignedPermissions'] = [];

$selectedRole = $this->request->getGet('role_id');

if (!empty($selectedRole)) {
    $assigned = $this->db->table('role_permissions rp')
        ->select('rp.permission_id')
        ->join('permissions p', 'p.permission_id = rp.permission_id')
        ->where('rp.role_id', $selectedRole)
        ->get()
        ->getResultArray();

    $data['assignedPermissions'] = array_map(
        'intval',
        array_column($assigned, 'permission_id')
    );
}

    $data['users'] = $this->db->table('user u')
        ->select('u.*, r.role_name')
        ->join('user_roles ur', 'ur.user_id = u.user_id', 'left')
        ->join('roles r', 'r.role_id = ur.role_id', 'left')
        ->orderBy('u.user_id', 'DESC')
        ->get()
        ->getResultArray();

    $data['selectedRole'] = $this->request->getGet('role_id') ?? '';

    return view('administrator/create_user', $data);
}


public function save_user()
{
    $fullName = trim((string) ($this->request->getPost('full_name') ?? ''));
    $email    = trim((string) ($this->request->getPost('email') ?? ''));
    $mobile   = trim((string) ($this->request->getPost('mobile') ?? ''));
    $password = $this->request->getPost('password');
    $roleId   = $this->request->getPost('role_id');
    $address  = trim((string) ($this->request->getPost('address') ?? ''));
    $selectedIds = $this->normalizePostedPermissionIds(
        $this->request->getPost('permissions') ?? []
    );
    $editableIds = $this->normalizePostedPermissionIds(
        $this->request->getPost('permission_ids') ?? []
    );

    if (
        $fullName === ''
        || $email === ''
        || $mobile === ''
        || empty($password)
        || !is_scalar($roleId)
        || !ctype_digit((string) $roleId)
        || (int) $roleId < 1
    ) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please fill all required fields.');
    }

    if ($selectedIds === null || $editableIds === null) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Invalid permission selection.');
    }

    $validPermissionIds = $this->getAssignablePermissionIds();
    if (
        array_diff($editableIds, $validPermissionIds) !== []
        || array_diff($selectedIds, $editableIds) !== []
    ) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Invalid permission selection.');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please enter a valid email.');
    }

    if (!preg_match('/^[0-9]{10}$/', $mobile)) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Mobile number must be 10 digits.');
    }
    $role = $this->db->table('roles')
        ->where('role_id', $roleId)
        ->where('status', 1)
        ->get()
        ->getRowArray();

    if (!$role) {
        return redirect()->back()
            ->with('error', 'Invalid role selected.');
    }

    $existingUser = $this->db->table('user')
        ->groupStart()
            ->where('email', $email)
            ->orWhere('user_name', $fullName)
        ->groupEnd()
        ->get()
        ->getRowArray();

    if ($existingUser) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Email already exists.');
    }

    if ($this->db->transBegin() !== true) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Unable to start user creation.');
    }

    try {
        if (!$this->db->table('user')->insert([
            'emp_id'    => 0,
            'user_name' => $fullName,
            'full_name' => $fullName,
            'email'     => $email,
            'mobile'    => $mobile,
            'address'   => $address,
            'password'  => $password
        ])) {
            throw new \RuntimeException('User insert failed.');
        }

        $userId = (int) $this->db->insertID();
        if ($userId < 1) {
            throw new \RuntimeException('User ID was not generated.');
        }

        if (!$this->db->table('user_roles')->insert([
            'user_id' => $userId,
            'role_id' => (int) $roleId
        ])) {
            throw new \RuntimeException('User role assignment failed.');
        }

        $rolePermissionRows = $this->db->table('role_permissions')
            ->select('permission_id')
            ->where('role_id', (int) $roleId)
            ->whereIn('permission_id', $editableIds ?: [0])
            ->get()
            ->getResultArray();
        $rolePermissionIds = array_map(
            'intval',
            array_column($rolePermissionRows, 'permission_id')
        );

        foreach ($editableIds as $permissionId) {
            $isSelected = in_array($permissionId, $selectedIds, true);
            $isGrantedByRole = in_array($permissionId, $rolePermissionIds, true);

            if ($isSelected !== $isGrantedByRole) {
                if (!$this->db->table('user_permissions')->insert([
                    'user_id' => $userId,
                    'permission_id' => $permissionId,
                    'permission_status' => $isSelected ? 1 : 0
                ])) {
                    throw new \RuntimeException('User permission override insert failed.');
                }
            }
        }

        if ($this->db->transStatus() === false || $this->db->transCommit() !== true) {
            throw new \RuntimeException('User creation transaction failed.');
        }

        return redirect()->to('create_user')
            ->with('success', 'User created successfully.');
    } catch (\Throwable $e) {
        $this->db->transRollback();
        log_message('error', 'Create User Error: ' . $e->getMessage());

        return redirect()->back()
            ->withInput()
            ->with('error', 'User could not be created.');
    }
}


public function update_password()
{
    $adminId = (int) session()->get('adminloggedid');
    

    $permissionService = new \App\Libraries\PermissionService($this->db);
    if (!$permissionService->hasPermission('forgot_password_link', 'edit', $adminId)) {
        return redirect()->back()->with(
            'select_fail',
            'You do not have permission to change password.'
        );
    }

    // Validation
$validation = $this->validate([
    'password' => [
        'rules' => 'required|exact_length[6]|numeric',
    ],
    'conf_password' => [
        'rules' => 'required|matches[password]',
    ],
]);

    if (!$validation) {
        return view('forget_password', [
            'validation' => $this->validator
        ]);
    }

    $password = $this->request->getPost('password');

    $this->db->table('user')
        ->where('user_id', $adminId)
        ->update([
            'password' =>  $password
        ]);

    return redirect()->to('forget_password')
        ->with('success', 'Password Changed successfully!');
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
    $feesReportModuleId = $this->getFeesReportModuleId();

    $data['roles'] = $this->db->table('roles')
        ->orderBy('role_id', 'DESC')
        ->get()
        ->getResultArray();

    // Active pages with parent names
// Active pages excluding User Management
$moduleQuery = $this->db->table('modules m')
    ->select('m.module_id, m.module_name, m.route, m.parent_id, p.module_name AS parent_name')
    ->join('modules p', 'p.module_id = m.parent_id', 'left')
    ->groupStart()
    ->where('m.route IS NOT NULL', null, false);

if ($feesReportModuleId !== null) {
    $moduleQuery->orWhere('m.parent_id', $feesReportModuleId);
}

$data['modules'] = $moduleQuery
    ->groupEnd()
    ->where('m.status', 1)
    ->whereNotIn('m.module_key', [
        'user_management',
        'roles_permissions',
        'create_user'
    ])
    ->orderBy('m.sort_order', 'ASC')
    ->orderBy('m.module_id', 'ASC')
    ->get()
    ->getResultArray();

$data['permissions'] = $this->db->table('permissions p')
    ->join('modules m', 'm.module_id = p.module_id')
    ->whereNotIn('m.module_key', [
        'user_management',
        'roles_permissions',
        'create_user',
        'create_menu'
    ])
    ->orderBy('p.module_id', 'ASC')
    ->get()
    ->getResultArray();

    $data['assignedPermissions'] = [];

    if (!empty($roleId)) {
        $assigned = $this->db->table('role_permissions')
            ->select('permission_id')
            ->where('role_id', $roleId)
            ->get()
            ->getResultArray();

        $data['assignedPermissions'] = array_map(
            'intval',
            array_column($assigned, 'permission_id')
        );
    }

    // Assigned modules for Role List
    $data['assignedModulesByRole'] = [];

    $assignedModules = $this->db->table('role_permissions rp')
        ->select('rp.role_id, m.module_id, m.module_name')
        ->join('permissions p', 'p.permission_id = rp.permission_id')
        ->join('modules m', 'm.module_id = p.module_id')
        ->where('p.action_name', 'view')
        ->distinct()
        ->get()
        ->getResultArray();

    foreach ($assignedModules as $item) {
        $data['assignedModulesByRole'][$item['role_id']][] = $item['module_name'];
    }

    $data['selectedRole'] = $roleId;

    return view('administrator/create_role', $data);
}


public function save_role()
{
    $roleName = trim($this->request->getPost('role_name') ?? '');

    if ($roleName === '') {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Role name is required.');
    }

    $existingRole = $this->db->table('roles')
        ->where('role_name', $roleName)
        ->countAllResults();

    if ($existingRole > 0) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'This role already exists.');
    }

    $this->db->table('roles')->insert([
        'role_name'   => $roleName,
        'description' => '',
        'status'      => 1
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
// public function create_menu()
// {
//     $data['modules'] = $this->db->table('modules')
//         ->where('status', 1)
//         ->orderBy('sort_order', 'ASC')
//         ->get()
//         ->getResultArray();

//     return view('administrator/create_menu', $data);
// }


// public function save_menu()
// {
//     $menuName = trim($this->request->getPost('module_name') ?? '');
//     $parentId = $this->request->getPost('parent_id');
//     $route = trim($this->request->getPost('route') ?? '');
//     $icon = trim($this->request->getPost('icon') ?? '');
//     $sortOrder = (int) ($this->request->getPost('sort_order') ?? 0);
//     $isMenu = (int) ($this->request->getPost('is_menu') ?? 1);
//     $status = (int) ($this->request->getPost('status') ?? 1);

//     // Basic validation
//     if ($menuName === '') {
//         return redirect()->back()
//             ->withInput()
//             ->with('error', 'Menu name is required.');
//     }

//     // Generate module key from route or menu name
//     $moduleKey = strtolower($route !== '' ? $route : $menuName);
//     $moduleKey = preg_replace('/[^a-z0-9]+/', '_', $moduleKey);
//     $moduleKey = trim($moduleKey, '_');

//     if ($moduleKey === '') {
//         return redirect()->back()
//             ->withInput()
//             ->with('error', 'Invalid menu name or route.');
//     }

//     // Check duplicate module key
//     $exists = $this->db->table('modules')
//         ->where('module_key', $moduleKey)
//         ->countAllResults();

//     if ($exists > 0) {
//         return redirect()->back()
//             ->withInput()
//             ->with('error', 'This menu already exists.');
//     }

//     // Validate parent menu
//     $parentId = ($parentId === '' || $parentId === '0')
//         ? null
//         : (int) $parentId;

//     if ($parentId !== null) {
//         $parentExists = $this->db->table('modules')
//             ->where('module_id', $parentId)
//             ->where('status', 1)
//             ->countAllResults();

//         if (!$parentExists) {
//             return redirect()->back()
//                 ->withInput()
//                 ->with('error', 'Invalid parent menu selected.');
//         }
//     }

//     $menuData = [
//         'parent_id'  => $parentId,
//         'module_name' => $menuName,
//         'module_key' => $moduleKey,
//         'route'      => $route,
//         'icon'       => $icon,
//         'sort_order' => $sortOrder,
//         'is_menu'    => $isMenu,
//         'status'     => $status,
//         'created_at' => date('Y-m-d H:i:s')
//     ];

//     $this->db->transBegin();

//     try {

//         // Insert menu
//         $this->db->table('modules')->insert($menuData);

//         $moduleId = $this->db->insertID();

//         // Automatically create four permissions
//         $permissions = [
//             ['module_id' => $moduleId, 'action_name' => 'view'],
//             ['module_id' => $moduleId, 'action_name' => 'add'],
//             ['module_id' => $moduleId, 'action_name' => 'edit'],
//             ['module_id' => $moduleId, 'action_name' => 'delete'],
//         ];

//         $this->db->table('permissions')->insertBatch($permissions);

//         if ($this->db->transStatus() === false) {
//             throw new \RuntimeException('Database operation failed.');
//         }

//         $this->db->transCommit();

//         return redirect()->to(base_url('create_menu'))
//             ->with('success', 'Menu created successfully with all permissions.');

//     } catch (\Throwable $e) {

//         $this->db->transRollback();

//         log_message('error', 'Create Menu Error: ' . $e->getMessage());

//         return redirect()->back()
//             ->withInput()
//             ->with('error', 'Unable to create menu. Please try again.');
//     }
// }

public function get_role_permissions()
{
    $roleId = $this->request->getGet('role_id');

    $permissions = [];

    if (!empty($roleId)) {
        $rows = $this->db->table('role_permissions')
            ->select('permission_id')
            ->where('role_id', $roleId)
            ->get()
            ->getResultArray();

        $permissions = array_map(
            'intval',
            array_column($rows, 'permission_id')
        );
    }

    return $this->response->setJSON($permissions);
}

public function edit_user($id)
{
    // User details
    $data['user'] = $this->db->table('user')
        ->where('user_id', $id)
        ->get()
        ->getRow();

    if (!$data['user']) {
        return redirect()->to(base_url('create_user'))
            ->with('error', 'User not found.');
    }

    // Active roles (Super Admin role excluded)
    $data['roles'] = $this->db->table('roles')
        ->where('status', 1)
        ->where('role_name !=', 'Super Admin')
        ->orderBy('role_name', 'ASC')
        ->get()
        ->getResultArray();

    // Current role
    $userRole = $this->db->table('user_roles')
        ->select('role_id')
        ->where('user_id', $id)
        ->get()
        ->getRowArray();

    $data['selectedRole'] = $userRole['role_id'] ?? '';

    $feesReportModuleId = $this->getFeesReportModuleId();

    // Active modules with parent names
    $moduleQuery = $this->db->table('modules m')
        ->select('m.module_id, m.module_name, m.module_key, m.route, m.parent_id, p.module_name AS parent_name')
        ->join('modules p', 'p.module_id = m.parent_id', 'left')
        ->groupStart()
        ->where('m.route IS NOT NULL', null, false);

    if ($feesReportModuleId !== null) {
        $moduleQuery->orWhere('m.parent_id', $feesReportModuleId);
    }

    $data['modules'] = $moduleQuery
        ->groupEnd()
        ->where('m.status', 1)
        ->whereNotIn('m.module_key', [
            'user_management',
            'roles_permissions',
            'create_user',
            'create_menu'
        ])
        ->orderBy('m.sort_order', 'ASC')
        ->get()
        ->getResultArray();

    $permissionQuery = $this->db->table('permissions p')
        ->select('p.permission_id, p.module_id, p.action_name')
        ->join('modules m', 'm.module_id = p.module_id')
        ->groupStart()
        ->where('m.route IS NOT NULL', null, false);

    if ($feesReportModuleId !== null) {
        $permissionQuery->orWhere('m.parent_id', $feesReportModuleId);
    }

    $data['permissions'] = $permissionQuery
        ->groupEnd()
        ->where('m.status', 1)
        ->whereNotIn('m.module_key', [
            'user_management',
            'roles_permissions',
            'create_user',
            'create_menu'
        ])
        ->orderBy('p.module_id', 'ASC')
        ->orderBy('p.permission_id', 'ASC')
        ->get()
        ->getResultArray();

    // Role permissions
    $rolePermissions = [];

    if (!empty($data['selectedRole'])) {
        $rows = $this->db->table('role_permissions')
            ->select('permission_id')
            ->where('role_id', $data['selectedRole'])
            ->get()
            ->getResultArray();

        $rolePermissions = array_map(
            'intval',
            array_column($rows, 'permission_id')
        );
    }

    // User-specific permission overrides
    $userOverrides = $this->db->table('user_permissions')
        ->select('permission_id, permission_status')
        ->where('user_id', $id)
        ->get()
        ->getResultArray();

    $overrideMap = [];

    foreach ($userOverrides as $override) {
        $overrideMap[(int)$override['permission_id']] =
            (int)$override['permission_status'];
    }

    // Effective permissions: user override takes priority over role
    $data['assignedPermissions'] = [];

    foreach ($data['permissions'] as $permission) {
        $permissionId = (int)$permission['permission_id'];

        if (isset($overrideMap[$permissionId])) {
            if ($overrideMap[$permissionId] === 1) {
                $data['assignedPermissions'][] = $permissionId;
            }
        } elseif (in_array($permissionId, $rolePermissions, true)) {
            $data['assignedPermissions'][] = $permissionId;
        }
    }

    return view('administrator/edit_user', $data);
}
public function update_user($id)
{
    $user = $this->db->table('user')
        ->where('user_id', $id)
        ->get()
        ->getRowArray();

    if (!$user) {
        return redirect()->to(base_url('create_user'))
            ->with('error', 'User not found.');
    }

    // Form data
    $fullName = trim($this->request->getPost('full_name'));
    $email    = trim($this->request->getPost('email'));
    $mobile   = trim($this->request->getPost('mobile'));
    $address  = trim($this->request->getPost('address'));
    $password = $this->request->getPost('password');
    $roleId   = $this->request->getPost('role_id');

    $selectedIds = $this->normalizePostedPermissionIds(
        $this->request->getPost('permissions') ?? []
    );
    $editableIds = $this->normalizePostedPermissionIds(
        $this->request->getPost('permission_ids') ?? []
    );

    // Basic validation
    if ($fullName === '' || $email === '') {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Name and Email are required.');
    }

    if ($selectedIds === null || $editableIds === null) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Invalid permission selection.');
    }

    $validPermissionIds = $this->getAssignablePermissionIds();
    if (
        array_diff($editableIds, $validPermissionIds) !== []
        || array_diff($selectedIds, $editableIds) !== []
    ) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Invalid permission selection.');
    }

    // Duplicate email check
    $duplicateEmail = $this->db->table('user')
        ->where('email', $email)
        ->where('user_id !=', $id)
        ->countAllResults();

    if ($duplicateEmail > 0) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Email already exists.');
    }

    if ($roleId !== null && $roleId !== '') {
        if (!is_scalar($roleId) || !ctype_digit((string) $roleId) || (int) $roleId < 1) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Invalid role selected.');
        }

        $role = $this->db->table('roles')
            ->where('role_id', $roleId)
            ->where('status', 1)
            ->where('role_name !=', 'Super Admin')
            ->get()
            ->getRowArray();

        if (!$role) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Invalid role selected.');
        }
    }

    // Prepare user data
    $updateData = [
        'user_name'       => $fullName,
        'full_name'       => $fullName,
        'email'           => $email,
        'mobile'          => $mobile,
        'address'         => $address,
        'last_modify_date' => date('Y-m-d H:i:s')
    ];

    // Update password only when entered
    if (!empty($password)) {
        $updateData['password'] = $password;
    }

    $this->db->transBegin();

    try {

        // 1. Update user details
        $this->db->table('user')
            ->where('user_id', $id)
            ->update($updateData);

        // 2. Update user role
        $this->db->table('user_roles')
            ->where('user_id', $id)
            ->delete();

        if ($roleId !== null && $roleId !== '') {
            $this->db->table('user_roles')->insert([
                'user_id' => $id,
                'role_id' => (int) $roleId
            ]);
        }

        if ($editableIds !== []) {
            $this->db->table('user_permissions')
                ->where('user_id', $id)
                ->whereIn('permission_id', $editableIds)
                ->delete();
        }

        $rolePermissionIds = [];
        if ($roleId !== null && $roleId !== '') {
            $rolePermissionRows = $this->db->table('role_permissions')
                ->select('permission_id')
                ->where('role_id', (int) $roleId)
                ->whereIn('permission_id', $editableIds ?: [0])
                ->get()
                ->getResultArray();
            $rolePermissionIds = array_map(
                'intval',
                array_column($rolePermissionRows, 'permission_id')
            );
        }

        foreach ($editableIds as $permissionId) {
            $isSelected = in_array($permissionId, $selectedIds, true);
            $isGrantedByRole = in_array($permissionId, $rolePermissionIds, true);

            if ($isSelected !== $isGrantedByRole) {
                if (!$this->db->table('user_permissions')->insert([
                    'user_id' => $id,
                    'permission_id' => $permissionId,
                    'permission_status' => $isSelected ? 1 : 0
                ])) {
                    throw new \RuntimeException('User permission override update failed.');
                }
            }
        }

        if ($this->db->transStatus() === false) {
            throw new \RuntimeException('Database update failed.');
        }

        $this->db->transCommit();

        return redirect()->to(base_url('create_user'))
            ->with('success', 'User updated successfully.');

    } catch (\Throwable $e) {

        $this->db->transRollback();

        log_message('error', 'Update User Error: ' . $e->getMessage());

        return redirect()->back()
            ->withInput()
            ->with('error', 'Unable to update user.');
    }
}

public function delete_user($id)
{
    // Get user
    $user = $this->db->table('user')
        ->where('user_id', $id)
        ->get()
        ->getRowArray();

    if (!$user) {
        return redirect()->to(base_url('create_user'))
            ->with('error', 'User not found.');
    }

    // Prevent deleting Super Admin
    $role = $this->db->table('user_roles ur')
        ->select('r.role_name')
        ->join('roles r', 'r.role_id = ur.role_id')
        ->where('ur.user_id', $id)
        ->get()
        ->getResultArray();

    foreach ($role as $item) {
        if (strcasecmp((string) $item['role_name'], 'Super Admin') === 0) {
            return redirect()->to(base_url('create_user'))
                ->with('error', 'Super Admin cannot be deleted.');
        }
    }

    $this->db->transBegin();

    try {

        // Delete custom permissions
        $this->db->table('user_permissions')
            ->where('user_id', $id)
            ->delete();

        // Delete assigned roles
        $this->db->table('user_roles')
            ->where('user_id', $id)
            ->delete();

        // Delete user
        $this->db->table('user')
            ->where('user_id', $id)
            ->delete();

        if ($this->db->transStatus() === false) {
            throw new \RuntimeException('User deletion failed.');
        }

        $this->db->transCommit();

        return redirect()->to(base_url('create_user'))
            ->with('success', 'User deleted successfully.');

    } catch (\Throwable $e) {

        $this->db->transRollback();

        log_message('error', 'Delete User Error: ' . $e->getMessage());

        return redirect()->to(base_url('create_user'))
            ->with('error', 'Unable to delete user.');
    }
}

private function getFeesReportModuleId(): ?int
{
    $module = $this->db->table('modules')
        ->select('module_id')
        ->where('module_key', 'fees_report')
        ->where('status', 1)
        ->get()
        ->getRowArray();

    return $module === null ? null : (int) $module['module_id'];
}

private function getAssignablePermissionIds(): array
{
    $feesReportModuleId = $this->getFeesReportModuleId();
    $permissionQuery = $this->db->table('permissions p')
        ->select('p.permission_id')
        ->join('modules m', 'm.module_id = p.module_id')
        ->where('m.status', 1)
        ->groupStart()
        ->where('m.route IS NOT NULL', null, false);

    if ($feesReportModuleId !== null) {
        $permissionQuery->orWhere('m.parent_id', $feesReportModuleId);
    }

    $rows = $permissionQuery
        ->groupEnd()
        ->whereNotIn('m.module_key', [
            'user_management',
            'roles_permissions',
            'create_user',
            'create_menu'
        ])
        ->get()
        ->getResultArray();

    return array_map('intval', array_column($rows, 'permission_id'));
}

private function normalizePostedPermissionIds($values): ?array
{
    if (!is_array($values)) {
        return null;
    }

    $permissionIds = [];
    foreach ($values as $value) {
        if (!is_scalar($value) || !ctype_digit((string) $value) || (int) $value < 1) {
            return null;
        }

        $permissionIds[] = (int) $value;
    }

    return array_values(array_unique($permissionIds));
}
public function create_menu()
{
    $menuModel = new UserCustomMenuModel();

    $data['users'] = $this->db->table('user')
        ->select('user_id, full_name, user_name')
        ->orderBy('full_name', 'ASC')
        ->get()
        ->getResultArray();

    $data['menus'] = $menuModel
        ->select('user_custom_menus.*, user.full_name')
        ->join('user', 'user.user_id = user_custom_menus.user_id')
        ->orderBy('user_custom_menus.menu_id', 'DESC')
        ->findAll();

    return view('administrator/create_menu', $data);
}

public function save_custom_menu()
{
    $menuModel = new UserCustomMenuModel();

    $userId   = (int) $this->request->getPost('user_id');
    $parentId = $this->request->getPost('parent_id');
    $menuName = trim($this->request->getPost('menu_name'));
    $route    = trim($this->request->getPost('route'));
    $icon     = trim($this->request->getPost('icon'));
    $sort     = (int) $this->request->getPost('sort_order');

    if (!$userId || $menuName === '') {
        return redirect()->back()->with('error', 'User and Menu Name are required.');
    }

    $userExists = $this->db->table('user')
        ->where('user_id', $userId)
        ->countAllResults();

    if (!$userExists) {
        return redirect()->back()->with('error', 'Invalid user selected.');
    }

    if (!empty($parentId)) {
        $parent = $menuModel->where('menu_id', (int) $parentId)
            ->where('user_id', $userId)
            ->where('parent_id', null)
            ->first();

        if (!$parent) {
            return redirect()->back()->with('error', 'Invalid parent menu.');
        }
    } else {
        $parentId = null;
    }

    $menuModel->insert([
        'user_id'   => $userId,
        'parent_id' => $parentId,
        'menu_name' => $menuName,
        'route'     => $route ?: null,
        'icon'      => $icon ?: 'fa fa-folder',
        'sort_order'=> $sort,
        'is_menu'   => 1,
        'status'    => 1
    ]);

    return redirect()->to(base_url('create_menu'))
        ->with('success', 'Menu created successfully.');
}

public function edit_custom_menu($id)
{
    $menuModel = new UserCustomMenuModel();

    $data['menu'] = $menuModel->find($id);

    if (!$data['menu']) {
        return redirect()->to(base_url('create_menu'))
            ->with('error', 'Menu not found.');
    }

    $data['users'] = $this->db->table('user')
        ->select('user_id, full_name, user_name')
        ->orderBy('full_name', 'ASC')
        ->get()
        ->getResultArray();

    $data['parentMenus'] = $menuModel
        ->where('user_id', $data['menu']['user_id'])
        ->where('parent_id', null)
        ->where('menu_id !=', $id)
        ->findAll();

    return view('administrator/edit_custom_menu', $data);
}

public function update_custom_menu($id)
{
    $menuModel = new UserCustomMenuModel();

    $menu = $menuModel->find($id);

    if (!$menu) {
        return redirect()->to(base_url('create_menu'))
            ->with('error', 'Menu not found.');
    }

    $userId   = (int) $this->request->getPost('user_id');
    $parentId = $this->request->getPost('parent_id');
    $menuName = trim($this->request->getPost('menu_name'));

    if (!$userId || $menuName === '') {
        return redirect()->back()->with('error', 'User and Menu Name are required.');
    }

    $userExists = $this->db->table('user')
        ->where('user_id', $userId)
        ->countAllResults();

    if (!$userExists) {
        return redirect()->back()->with('error', 'Invalid user selected.');
    }

    if (!empty($parentId)) {
        $parent = $menuModel->where('menu_id', (int) $parentId)
            ->where('user_id', $userId)
            ->where('parent_id', null)
            ->first();

        if (!$parent || (int) $parentId === (int) $id) {
            return redirect()->back()->with('error', 'Invalid parent menu.');
        }
    } else {
        $parentId = null;
    }

    $menuModel->update($id, [
        'user_id'    => $userId,
        'parent_id'  => $parentId,
        'menu_name'  => $menuName,
        'route'      => trim($this->request->getPost('route')) ?: null,
        'icon'       => trim($this->request->getPost('icon')) ?: 'fa fa-folder',
        'sort_order' => (int) $this->request->getPost('sort_order'),
        'status'     => (int) $this->request->getPost('status'),
        'updated_at' => date('Y-m-d H:i:s')
    ]);

    return redirect()->to(base_url('create_menu'))
        ->with('success', 'Menu updated successfully.');
}

public function delete_custom_menu($id)
{
    $menuModel = new UserCustomMenuModel();

    $menu = $menuModel->find($id);

    if (!$menu) {
        return redirect()->to(base_url('create_menu'))
            ->with('error', 'Menu not found.');
    }

    // Delete its submenus first
    $menuModel->where('parent_id', $id)->delete();

    $menuModel->delete($id);

    return redirect()->to(base_url('create_menu'))
        ->with('success', 'Menu deleted successfully.');
}
}