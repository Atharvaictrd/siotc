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
class Admission extends BaseController
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
	public function index(){
        // return view('acedemic/student_admission');
	}
	public function student_admission(){
	    $query2= $this->db->query("SELECT * FROM prospect_sales ORDER BY prospect_no DESC ");
        $data['source']=$query2->getResultArray();
        foreach($data['source'] as $key => $value):
            //  $cat_id = $row['id'];
            // print_r($value);
        endforeach;
        //return view('acedemic/prospectus_report',$data);  
        return view('acedemic/student_admission',$data);
	}
	public function search_reg_no(){
	    $reg_no=$this->request->getVar('reg_no');
	    $AdmissionModel = new AdmissionModel();
    	$data6['user'] = $AdmissionModel->where('reg_no', $reg_no)->first();
    	if($data6['user']['reg_no']==$reg_no){
	    	echo json_encode($data6);
    	}else{
    	  $user = $AdmissionModel->where('reg_no', $reg_no)->first();
$data6['user'] = $user ?: 1;
echo json_encode($data6);
    	}
	}
	public function test(){
        // 	     $query2= $this->db->query("SELECT * FROM prospect_sales ORDER BY prospect_no DESC ");
        // 	     $data['source']=$query2->getResultArray();
        // // }
        //     	 foreach($data['source'] as $key => $value):
        //             //  $cat_id = $row['id'];
        //             print_r($value);
        //   endforeach;
   	    $query2 = $this->db->query("SELECT fc.fee_component_id,fc.component,ftp.amount FROM fee_components fc ,fees_to_program ftp WHERE ftp.fee_type=fc.fee_component_id AND ftp.class='ELECTRICAL ENGINEERING' AND ftp.sem='Sem I' AND ftp.session='2024-2025' AND fc.session = '2024-2025' AND ftp.category='OBC' GROUP BY fc.fee_component_id ");
        $data['source']=$query2->getResultArray();
		$total_amount = 0;$arr=[];
		foreach($data['source'] as $key =>$row){
			// 		$count++;
			$fee_com_id = $row['fee_component_id'].'_'.$row['amount'].';'.$fee_com_id;
			$total_amount= $total_amount+$row['amount'];
		} 
		echo $fee_com_id;
	}
	public function std_data(){
	    helper(['form', 'url']); 
        $data1 = $this->request->getVar();
        $reg_no=$this->request->getVar('reg_no');
		$AdmissionModel = new AdmissionModel();
 	    $data6 = $AdmissionModel->where('reg_no', $reg_no)->first();
	    if($data6['reg_no'] == $reg_no){
	      	$data['error']['not']= 'Data Already inserted';
			return redirect()->to(base_url(route_to('new_admission')) )->with('error', 'Data Not Inserted');
	    }else{
		    $data1['joining_status']='NEW';
		    $data1['ip']=$_SERVER["REMOTE_ADDR"];
		    $data1['insert_ip']=$_SERVER["REMOTE_ADDR"];
		    // $data1['session_year']=$this->request->getVar('session');
		    $syllabus = $this->request->getFile('photo');
            $data1['insert_by']=$_SESSION['adminloggedname'];
		    // var_dump($syllabus);
		    // die;
		    if ($syllabus->getClientName() != null) {
			    //syllabus
			    $originalsyllabusName = time() . $syllabus->getClientName();
			    if ($syllabus->isValid() && !$syllabus->hasMoved()) {
				    $syllabus->move(ROOTPATH . 'photo', $originalsyllabusName);
				    $data1['student_image'] = $originalsyllabusName;
			    } else {
				    $data['fail'] = 'Unable to upload Syllabus';
				    return json_encode($data);
			    }
		    }
		    $session=$this->request->getVar('session');
		    $category=$this->request->getVar('category');
		    $semister=$this->request->getVar('semister');
		    $program=$this->request->getVar('program');
		    $gender1=$this->request->getVar('gender1');
		    $query3= $this->db->query("SELECT * FROM class WHERE class_id='$program' ");
            $data5['source']=$query3->getResultArray();
            // }
    	    foreach($data5['source'] as $key5 => $value5):
                //  $cat_id = $row['id'];
                // print_r($value);
                $program1=$value5['class'];
            endforeach;
            $data1['class']=$program1;
		    // echo "SELECT fc.fee_component_id,fc.component,ftp.amount FROM fee_components fc ,fees_to_program ftp WHERE ftp.fee_type=fc.fee_component_id AND ftp.class='$program' AND ftp.sem='$semister' AND ftp.session='$session' AND fc.session = '$session' AND ftp.category='$category' GROUP BY fc.fee_component_id ";
	      	$query2 = $this->db->query("SELECT fc.fee_component_id,fc.component,ftp.amount FROM fee_components fc ,fees_to_program ftp WHERE ftp.fee_type=fc.fee_component_id AND ftp.class='$program1' AND ftp.sem='$semister' AND ftp.session='$session' AND fc.session = '$session' AND ftp.category='$category' AND ftp.gender='$gender1' GROUP BY fc.fee_component_id ");
            $data['source']=$query2->getResultArray();
	    	$total_amount = 0;$arr=[];
			foreach($data['source'] as $key =>$row){
			    // 		$count++;
			    $fee_com_id = $row['fee_component_id'].'_'.$row['amount'].';'.$fee_com_id;
				$total_amount= $total_amount+$row['amount'];
			} 
            if(!empty($fee_com_id))	{	
                $data1['session_year']=$this->request->getVar('session');
	    		if ($result = $AdmissionModel->create($data1)) {
    	    		// $data2 = $this->request->getVar();  
    	            $id= $AdmissionModel->insertID; 
        		    $data1['student_admission_id']=$id;
        		    $AdmissionYear= new AdmissionYear();
        		    $result12 = $AdmissionYear->create($data1);
        		    //  echo print_r($data1);
        		    $AdmissionPersonalModel = new AdmissionPersonalModel();
    	            if ($result1 = $AdmissionPersonalModel->create($data1)) {
        		        $ParentModel = new ParentModel();
    				    if ($result2 = $ParentModel->create($data1)) {
    						$d=date('d-m-Y');
    				        $ip = $_SERVER['REMOTE_ADDR'];
                            $query=$this->db->query("INSERT INTO student_admission_fee(student_admission_id, fee_component_id,total_amount,date,session,insert_by,insert_date,insert_ip) VALUES ('$id', '$fee_com_id', '$total_amount','$d','$session','Admin','$d','$ip')");
            
    				        $data1['date_of_entry']=date('d-m-Y');
    	    		        $ContactModel= new ContactModel();
    	    		        $result3 = $ContactModel->create($data1);
    	    		        $QualificationModel= new QualificationModel();
    	    		        $result4 = $QualificationModel->create($data1);
    	    		    
    	    		        $CertificateIssue= new CertificateIssue();
    	    		        $result5 =$CertificateIssue->create($data1);
    	    		        $CertificateEnclosed= new CertificateEnclosed();
    	    		        $result6 =$CertificateEnclosed->create($data1);
    				    return redirect()->to(base_url(route_to('new_admission')) )->with('success', 'Data Inserted Successfully');
    		            }else{
        		            //Parent error
        		    	    $data['error']['not']= 'Data not inserted';
        				    return redirect()->to(base_url(route_to('new_admission')) )->with('error', 'Data Not Inserted');
        		        }
        		    }else{
        		        //personal error
        		    	$data['error']['not']= 'Data not inserted';
        				return redirect()->to(base_url(route_to('new_admission')) )->with('error', 'Data Not Inserted');
        		    }
        		}else{
        		    //Admission
    		    	$data['error']['not']= 'Data not inserted';
    				return redirect()->to(base_url(route_to('new_admission')) )->with('error', 'Data Not Inserted');
        		}
    		}else{
    		    //Admission
    	    	$data['error']['not']= 'Data not inserted';
    			return redirect()->to(base_url(route_to('new_admission')) )->with('error', 'Data Not Inserted(Please Insert fees first for the selected gender)');
    		}
    	}
	}
    public function existing_data(){
        helper(['form', 'url']); 
    	$AdmissionModel = new AdmissionModel();
        $data1 = $this->request->getVar();
        $session= $this->request->getVar('session');
        $id=$this->request->getVar('student_admission_id');
        $fee_com_id=$this->request->getVar('fee_com_id');
        $total_amount=$this->request->getVar('total_amount');
        $data1['session_year']=$this->request->getVar('session');
	    $d=date('d-m-Y');
	    $data1['joining_status']='OLD';
	    $data1['ip']=$_SERVER["REMOTE_ADDR"];
	    $data1['insert_ip']=$_SERVER["REMOTE_ADDR"];
	    $data6['user'] = $AdmissionModel->where('student_admission_id', $id)->first();
	    if($data6['user']['session_year']==$session){
	        echo json_encode(1);
	    }else{
	    $username=$_SESSION['adminloggedname'];
	    if ($result = $AdmissionModel->update($id,$data1)){
	        $data1['student_admission_id']=$id;
		    $AdmissionYear= new AdmissionYear();
		    $result12 = $AdmissionYear->create($data1);
		    $query=$this->db->query("INSERT INTO student_admission_fee(student_admission_id, fee_component_id,total_amount,date,session,insert_by,insert_date,insert_ip) VALUES ('$id', '$fee_com_id', '$total_amount','$d','$session','$username','$d','".$data1['insert_ip']."')");
            echo json_encode(2);
	    }
    }	
}



    public function update_std_data($student_id){
        // to student admission information
        $date_of_admission = $this->request->getVar('date_of_admission');
        $reg_no = $this->request->getVar('reg_no');
        $session_year = $this->request->getVar('session_year');
        $status = $this->request->getVar('status');
        $program=$this->request->getVar('program');
        $prospectus_no = $this->request->getVar('prospectus_no');
        $enrollment_no = $this->request->getVar('enrollment_no');
        $category = $this->request->getVar('category');
        $salutation = $this->request->getVar('salutation');
        $first_name = $this->request->getVar('first_name');
        $middle_name = $this->request->getVar('middle_name');
        $last_name = $this->request->getVar('last_name');
        $mar_name= $this->request->getVar('mar_name');
        $program = $this->request->getVar('program');
    
        $query3= $this->db->query("SELECT * FROM class WHERE class_id='$program' ");
        $data5['source']=$query3->getResultArray();
        foreach($data5['source'] as $key5 => $value5):
            $program1=$value5['class'];
        endforeach;
        $semister = $this->request->getVar('semister');
        $last_school_attended = $this->request->getVar('last_school_attended');
        $date_of_birth = $this->request->getVar('date_of_birth');
        $exam_passed = $this->request->getVar('exam_passed');
        $year_last_exam = $this->request->getVar('year_last_exam');
        $roll_no = $this->request->getVar('roll_no');
        $masrks = $this->request->getVar('masrks');
        $out_of = $this->request->getVar('out_of');
        $result = $this->request->getVar('result');
        $division = $this->request->getVar('division');
        $enrol_no_last_exam = $this->request->getVar('enrol_no_last_exam');
        $university_last_exam = $this->request->getVar('university_last_exam');
        $mscit = $this->request->getVar('mscit');
        $sports = $this->request->getVar('sports');
        $active_status = $this->request->getVar('active_status');
        $ip = $_SERVER['REMOTE_ADDR'];
        $date = date('Y-m-d h:i:s');
        $old_image= $this->request->getFile('old_photo');
        $edit_image = $this->request->getFile('photo');
        $query4= $this->db->query("SELECT * FROM student_admission_information WHERE student_admission_id='$student_id' ");
        $data4['source']=$query4->getResultArray();
        foreach($data4['source'] as $key4 => $value4):
            $student_image=$value4['student_image'];
        endforeach;
        if($edit_image!=''){
            if ($edit_image->isValid() && $edit_image->getSize() > 0) {
                // Upload new logo
                if (file_exists("photo/" . $student_image)) {
                    unlink("photo/" . $student_image);
                }
                $imageName = $edit_image->getRandomName();
                $edit_image->move('photo/', $imageName);
                $new_image = $imageName;
            }
        }else{
            $new_image = $student_image;
        }
        $query=$this->db->query("UPDATE `student_admission_information` SET `prospectus_no`='$prospectus_no',`date_of_admission`='$date_of_admission',`salutation`='$salutation',
        `first_name`='$first_name',`middle_name`='$middle_name',`last_name`='$last_name',`mar_name`='$mar_name',
        `enrollment_no`='$enrollment_no',`program`='$program',`semister`='$semister',`last_school_attended`='$last_school_attended',
        `category`='$category',`date_of_birth`='$date_of_birth',`reg_no`='$reg_no',`session_year`='$session_year', `status`='$status',
        `class`='$program1',`exam_passed`='$exam_passed',`mscit`='$mscit',`sports`='$sports',`year_last_exam`='$year_last_exam',`roll_no`='$roll_no',
        `masrks`='$masrks',`out_of`='$out_of',`result`='$result',`division`='$divison',`enrol_no_last_exam`='$enrol_no_last_exam',
        `university_last_exam`='$university_last_exam',`active_status`='$active_status',`modify_date`='$date',`modify_ip`='$ip',`updated_at`='$date',`student_image`='$new_image'
        WHERE student_admission_id ='$student_id'");
    
        // to student personal information
        $place_of_birth = $this->request->getVar('place_of_birth');
        $place_state = $this->request->getVar('place_state');
        $domicile_of_state = $this->request->getVar('domicile_of_state');
        $place_district = $this->request->getVar('place_district');
        $sex = $this->request->getVar('sex');
        $domicile_town = $this->request->getVar('domicile_town');
        $religion = $this->request->getVar('religion');
        $nationality = $this->request->getVar('nationality');
        $personal_category = $this->request->getVar('personal_category');
        $caste = $this->request->getVar('caste');
        $domicile_district =$this->request->getVar('domicile_district');
    
        $query2=$this->db->query("UPDATE `student_personal_information` SET `date_of_birth`='$date_of_birth',`place_of_birth`='$place_of_birth',`place_district`='$place_district',
         `place_state`='$place_state',`domicile_of_state`='$domicile_of_state',`domicile_district`='$domicile_district',`domicile_town`='$domicile_town',
         `sex`='$sex',`religion`='$religion',`nationality`='$nationality',`personal_category`='$personal_category',`caste`='$caste'
        WHERE student_admission_id ='$student_id'");
    
        // to student parent information
        $f_first_name = $this->request->getVar('fa_first_name');
        $f_middle_name = $this->request->getVar('fa_middle_name');
        $f_last_name = $this->request->getVar('fa_last_name');
        $f_occupation = $this->request->getVar('f_occupation');
        $f_annual_income = $this->request->getVar('f_annual_income');
        $f_o_plot_no = $this->request->getVar('f_o_plot_no');
        $f_o_area = $this->request->getVar('f_o_area');
        $f_o_city = $this->request->getVar('f_o_city');
        $f_o_pin_code = $this->request->getVar('f_o_pin_code');
        $f_district = $this->request->getVar('f_district');
        $f_o_state = $this->request->getVar('f_o_state');
        $f_o_tel_no = $this->request->getVar('f_o_tel_no');
        $f_o_email = $this->request->getVar('f_o_email');
        $m_first_name = $this->request->getVar('mn_first_name');
        $m_middle_name = $this->request->getVar('mn_middle_name');
        $m_last_name = $this->request->getVar('mn_last_name');
        $m_occupation = $this->request->getVar('m_occupation');
        $m_annual_income = $this->request->getVar('m_annual_income');
        $m_o_plot_no = $this->request->getVar('m_o_plot_no');
        $m_o_area = $this->request->getVar('m_o_area');
        $m_o_city = $this->request->getVar('m_o_city');
        $m_o_pin_code = $this->request->getVar('m_o_pin_code');
        $m_o_district = $this->request->getVar('m_o_district');
        $m_o_state = $this->request->getVar('m_o_state');
        $m_o_tel_no = $this->request->getVar('m_o_tel_no');
        $m_o_email = $this->request->getVar('m_o_email');
        
        $query3=$this->db->query("UPDATE `student_parent_information` SET `f_first_name`='$f_first_name',`f_middle_name`='$f_middle_name',`f_last_name`='$f_last_name',
         `f_occupation`='$f_occupation',`f_annual_income`='$f_annual_income',
         `f_o_plot_no`='$f_o_plot_no',`f_o_area`='$f_o_area',`f_o_city`='$f_o_city',`f_o_pin_code`='$f_o_pin_code',`f_district`='$f_district',
         `f_o_state`='$f_o_state',`f_o_tel_no`='$f_o_tel_no',`f_o_email`='$f_o_email',`m_first_name`='$m_first_name',`m_middle_name`='$m_middle_name',
         `m_last_name`='$m_last_name',`m_occupation`='$m_occupation',`m_annual_income`='$m_annual_income',`m_o_plot_no`='$m_o_plot_no',`m_o_area`='$m_o_area',
         `m_o_city`='$m_o_city',`m_o_pin_code`='$m_o_pin_code',`m_o_district`='$m_o_district',`m_o_state`='$m_o_state',`m_o_tel_no`='$m_o_tel_no',
         `m_o_email`='$m_o_email'
        WHERE student_admission_id ='$student_id'");
    
        // to student_qualification_detail_2 table
        $ssc_board = $this->request->getVar('ssc_board');
        $ssc_school = $this->request->getVar('ssc_school');
        $ssc_year = $this->request->getVar('ssc_year');
        $ssc_total_marks = $this->request->getVar('ssc_total_marks');
        $ssc_marks_obtained = $this->request->getVar('ssc_marks_obtained');
        $ssc_percentage = $this->request->getVar('ssc_percentage');
        $hssc_board = $this->request->getVar('hssc_board');
        $hssc_school = $this->request->getVar('hssc_school');
        $hssc_year = $this->request->getVar('hssc_year');
        $hssc_total_marks = $this->request->getVar('hssc_total_marks');
        $hssc_marks_obtained = $this->request->getVar('hssc_marks_obtained');
        $hssc_percentage = $this->request->getVar('hssc_percentage');
        $grad_uni = $this->request->getVar('grad_uni');
        $grad_college = $this->request->getVar('grad_college');
        $grad_year = $this->request->getVar('grad_year');
        $grad_total_marks = $this->request->getVar('grad_total_marks');
        $grad_marks_obtained = $this->request->getVar('grad_marks_obtained');
        $grad_percentage = $this->request->getVar('grad_percentage');
        $pg_uni = $this->request->getVar('pg_uni');
        $pg_college = $this->request->getVar('pg_college');
        $pg_year = $this->request->getVar('pg_year');
        $pg_total_marks = $this->request->getVar('pg_total_marks');
        $pg_marks_obtained = $this->request->getVar('pg_marks_obtained');
        $pg_percentage = $this->request->getVar('pg_percentage');
        $other_board = $this->request->getVar('other_board');
        $other_school = $this->request->getVar('other_school');
        $other_year = $this->request->getVar('other_year');
        $other_total_marks = $this->request->getVar('other_total_marks');
        $other_marks_obtained = $this->request->getVar('other_marks_obtained');
        $other_percentage = $this->request->getVar('other_percentage');
        
        $query4=$this->db->query("UPDATE `student_qualification_detail_2` SET `ssc_board`='$ssc_board',`ssc_school`='$ssc_school',`ssc_year`='$ssc_year',
        `ssc_total_marks`='$ssc_total_marks',`ssc_marks_obtained`='$ssc_marks_obtained',`ssc_percentage`='$ssc_percentage',`hssc_board`='$hssc_board',`hssc_school`='$hssc_school',
        `hssc_year`='$hssc_year',`hssc_total_marks`='$hssc_total_marks',`hssc_marks_obtained`='$hssc_marks_obtained',`hssc_percentage`='$hssc_percentage',`grad_uni`='$grad_uni',
        `grad_college`='$grad_college',`grad_year`='$grad_year',`grad_total_marks`='$grad_total_marks',`grad_marks_obtained`='$grad_marks_obtained',`grad_percentage`='$grad_percentage',
        `pg_uni`='$pg_uni',`pg_college`='$pg_college',`pg_year`='$pg_year',`pg_total_marks`='$pg_total_marks',`pg_marks_obtained`='$pg_marks_obtained',`pg_percentage`='$pg_percentage',
        `other_board`='$other_board',`other_school`='$other_school',`other_year`='$other_year',`other_total_marks`='$other_total_marks',`other_marks_obtained`='$other_marks_obtained',
        `other_percentage`='$other_percentage'
        WHERE student_admission_id ='$student_id'");
    
        // to student_certificate_enclosed table
        $guardian_income_certifucate = $this->request->getVar('guardian_income_certifucate');
        $statement_of_marks_ssc = $this->request->getVar('statement_of_marks_ssc');
        $statement_of_marks = $this->request->getVar('statement_of_marks');
        $leaving_certificate = $this->request->getVar('leaving_certificate');
        $validity_certificate = $this->request->getVar('validity_certificate');
        $non_creamylayer = $this->request->getVar('non_creamylayer');
        $eligibility_certificate = $this->request->getVar('eligibility_certificate');
        $physical_certifucate = $this->request->getVar('physical_certifucate');
        $other_certificates = $this->request->getVar('other_certificates');
        $change_name = $this->request->getVar('change_name');
        $domicile_certificate = $this->request->getVar('domicile_certificate');
        $migration_certificate = $this->request->getVar('migration_certificate');
        
        $query5=$this->db->query("UPDATE `student_certificate_enclosed` SET `guardian_income_certifucate`='$guardian_income_certifucate',`statement_of_marks_ssc`='$statement_of_marks_ssc',
        `statement_of_marks`='$statement_of_marks',`leaving_certificate`='$validity_certificate',`validity_certificate`='$validity_certificate',`non_creamylayer`='$non_creamylayer',
        `eligibility_certificate`='$eligibility_certificate',`physical_certifucate`='$physical_certifucate',`other_certificates`='$other_certificates',`change_name`='$change_name',
        `domicile_certificate`='$domicile_certificate',`migration_certificate`='$migration_certificate'
        WHERE student_admission_id ='$student_id'");
        
        // to student_certificate_issued table
        $bonafied = $this->request->getVar('bonafied');
        $bonafied_date = $this->request->getVar('bonafied_date');
        $charecter = $this->request->getVar('charecter');
        $character_date = $this->request->getVar('character_date');
        
        $query5=$this->db->query("UPDATE `student_certificate_issued` SET `bonafied`='$bonafied',`charecter`='$charecter',
       `bonafied_date`='$bonafied_date',`character_date`='$character_date'
        WHERE student_admission_id ='$student_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Update !.');
        } else {
            return  redirect()->to('student_admission_form/'.$student_id)->with('success', 'Student Details Updated successfully !.');
        }
    }
}