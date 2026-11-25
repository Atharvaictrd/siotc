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
use App\Models\AdmissionYear;

class DeleteController extends BaseController
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
		public function delete_fees($id){
	   // 	$id = $this->request->getVar('id');
		$db = \Config\Database::connect();
        $query=$db->query("DELETE FROM `fees_collection` WHERE ID = '$id'");
        $query1=$db->query("DELETE FROM `fees_collection_detail` WHERE fee_id = '$id'");
        $query2 = $db->query("SELECT * FROM `cashbook` WHERE `head`='Fees: Registration / Admission' AND `vch_no` = '$id'");
    
        $data['cash']=$query2->getResultArray();
        // print_r($data['cash'][0]['credit']);
        // echo "UPDATE `cashbook` SET `debit` = '".$data['cash'][0]['credit']."' WHERE `head`='Fees: Registration / Admission' AND `vch_no` = '$id'";
       
        if (!$query) {
             $Update=$db->query("UPDATE `cashbook` SET `debit` = '".$data['cash'][0]['credit']."', `credit`='0' WHERE `head`='Fees: Registration / Admission' AND `vch_no` = '$id'");
            return  redirect('daily_collection_report')->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('daily_collection_report')->with('success', 'Deleted successfully !.');
        }
    }
    public function delete_bus_fees($id){
	   // 	$id = $this->request->getVar('id');
		$db = \Config\Database::connect();
        $query=$db->query("DELETE FROM `other_fees` WHERE ID = '$id'");
        // $query1=$db->query("DELETE FROM `fees_collection_detail` WHERE fee_id = '$id'");
        $query2 = $db->query("SELECT * FROM `cashbook` WHERE `head`='Fees: Stationary / Uniform' AND `vch_no` = '$id'");
    
        $data['cash']=$query2->getResultArray();
        // print_r($data['cash'][0]['credit']);
        // echo "UPDATE `cashbook` SET `debit` = '".$data['cash'][0]['credit']."' WHERE `head`='Fees: Registration / Admission' AND `vch_no` = '$id'";
       
        if (!$query) {
             $Update=$db->query("UPDATE `cashbook` SET `debit` = '".$data['cash'][0]['credit']."', `credit`='0' WHERE `head`='Fees: Stationary / Uniform' AND `vch_no` = '$id'");
            return  redirect('bus_collection_report')->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('bus_collection_report')->with('success', 'Deleted successfully !.');
        }
    }
    
    public function delete_management($id){
        $db = \Config\Database::connect();
        $query=$db->query("DELETE FROM `management_consession` WHERE sr_no = '$id'");
         if (!$query) {
           
            return  redirect('fees_consession_report')->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('fees_consession_report')->with('success', 'Deleted successfully !.');
        }
    }
}