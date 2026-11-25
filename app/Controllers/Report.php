<?php
namespace App\Controllers;
use App\Models\UserModel;
use App\Models\AdmissionModel;

class Report extends BaseController
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
    
    public function student_status(){
      
	    return view('acedemic/student_status');  
	}

}