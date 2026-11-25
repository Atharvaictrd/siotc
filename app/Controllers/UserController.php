<?php

namespace App\Controllers;
use App\Models\UserModel;

class UserController extends BaseController
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
	public function edit_user($id){
	    $userModel = new UserModel();
	     $array = $userModel->fetch_single_user($id);
        $data['user'] = $array[0];
         return view('administrator/edit_user', $data);
	}
    public function update_user($user_id){
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
            return view('administrator/create_user', $data);
        }else{
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            $usertype = $this->request->getVar('usertype');
             
            $admission = $this->request->getVar('admission');
            $fees = $this->request->getVar('fees');
            $scholarship = $this->request->getVar('scholarship');
            $time_table = $this->request->getVar('time_table');
            $employee_manage = $this->request->getVar('employee_manage');
            $staff_atten = $this->request->getVar('staff_atten');
            $salary = $this->request->getVar('salary');
            $leaves = $this->request->getVar('leaves');
            $eve_planner = $this->request->getVar('eve_planner');
            $library = $this->request->getVar('library');
            $stock = $this->request->getVar('stock');
            $amount = $this->request->getVar('amount');
            $exam = $this->request->getVar('exam');
            $certificates = $this->request->getVar('certificates');
            $user_manage = $this->request->getVar('user_manage');
            $administrator = $this->request->getVar('administrator');
            // if($admission=='' AND $fees=='' AND $scholarship=='' AND $time_table=='' AND $employee_manage=='' AND $staff_atten=='' AND $salary=='' AND $leaves==''
            //  AND $eve_planner=='' AND $library=='' AND $library=='' AND $stock=='' AND $amount=='' AND $exam=='' AND $certificates=='' AND $user_manage==''
            //  AND $administrator==''){
            //     return  redirect()->to('edit_user/'.$user_id)->with('select_fail', 'Select atleast one permission !.');
            // }else{
                
                
                 $query=$this->db->query("UPDATE `user` SET `usertype`='$usertype',`user_name`='$username', `password`='$password' WHERE user_id = '$user_id'");
                 
                $last_enserted_id = $this->db->InsertID();
                 $query=$this->db->query("UPDATE `user_perm` SET `ADMISSION`='$admission',`FEES`='$fees',
                 `SCHOLARSHIP`='$scholarship',`TIME_TABLE`='$time_table',`EMPLOYEE_MANAGEMENT`='$employee_manage',`STAFF_ATTENDANCE`='$staff_atten',`SALARY`='$salary',
                 `LEAVES`='$leaves',`EVENT_PLANNER`='$eve_planner',`LIBRARY`='$library',`STOCK`='$stock',`ACCOUNT`='$amount',`EXAM`='$exam',
                 `CERTIFICATES`='$certificates',`USER_MANAGEMENT`='$user_manage',`ADMINISTRATOR`='$administrator' WHERE user_id='$user_id'");
                if (!$query) {
                    return  redirect()->back->with('fail', 'Failed to Add !.');
                } else {
                    return  redirect()->to('permission-panel')->with('success', 'User updated successfully !.');
                }
            // }
            
        }
	}
	 public function delete_user($user_id){
	     $db = \Config\Database::connect();
        $query=$db->query("DELETE FROM `user` WHERE user_id = '$user_id'");
        $query1=$db->query("DELETE FROM `user_perm` WHERE user_id = '$user_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('permission-panel')->with('success', 'Deleted successfully !.');
        }
	 }


}