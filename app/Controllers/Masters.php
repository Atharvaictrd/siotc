<?php

namespace App\Controllers;
use App\Models\UserModel;

class Masters extends BaseController
{
public function masters()
{
	return view('masters/index1');
}
public function last_school_attended()
	{
	     $data['active_tab'] = 'last_school_attended';
		return view('masters/last_school_attended', $data);
	}
public function delete_last_school_attended($s_id){
    $db = \Config\Database::connect();
    $query=$db->query("DELETE FROM `last_school_attended` WHERE s_id = '$s_id'");
    
    if (!$query) {
        return  redirect()->back->with('fail', 'Failed to Add !.');
    } else {
        return  redirect()->to('masters/last_school_attended')->with('success', 'Deleted successfully !.');
    }
}
public function reference_details(){
	     $data['active_tab'] = 'reference_details';
		return view('masters/reference_details', $data);
	}
	public function edit_reference_details($id){
         $data['active_tab'] = 'edit_reference_details';
        $data['refer_id'] = $id;
        return view('masters/edit_reference_details', $data);
	}

public function program(){
    $data['active_tab'] = 'program';
    return view('masters/program');
}
public function class(){
    $data['active_tab'] = 'class';
    return view('masters/class');
}
public function sem(){
    $data['active_tab'] = 'sem';
    return view('masters/sem');
}
public function save_class(){
	    $db = \Config\Database::connect();
	    $s=$db->query("SELECT COUNT(*) AS total_rows FROM `class`");
	    $num = $s->getRow();
	    $rowCount = $num->total_rows;
	    if($rowCount <= 6){
            $class = $this->request->getVar('class');
                $intake = $this->request->getVar('intake');
            $query=$db->query("INSERT INTO `class`(`class`,`intake`) VALUES ('$class','$intake')");
            
            if (!$query) {
                return  redirect()->to('masters/class')->with('error', 'Failed to Add !.');
                // return  redirect()->back->with('fail', 'Failed to Add !.');
            } else {
                return  redirect()->to('masters/class')->with('success', 'Added successfully !.');
            }
	        
	    }else{
	        return  redirect()->to('masters/class')->with('error', 'Error: Cannot insert more than 5 Programs!!.');
        }
}

public function save_sem(){
    $db = \Config\Database::connect();
    $class = $this->request->getVar('class');
    $program_sem= $this->request->getVar('program_sem');
     $query=$db->query("INSERT INTO `program_sem`(`program_id`,`program_sem`) VALUES ('$class','$program_sem')");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/sem')->with('success', 'Added successfully !.');
        }
}
public function edit_class($class_id){
        $data['class_id'] = $class_id;
        return view('masters/edit_class', $data);
	}
	public function edit_sem($sem_id){
        $data['program_sem_id'] = $sem_id;
        return view('masters/edit_sem', $data);
	}
public function update_class($class_id){
    $class = $this->request->getVar('class');
      $intake = $this->request->getVar('intake');
    $db = \Config\Database::connect();
    $query=$db->query("UPDATE `class` SET `class`='$class' ,`intake`='$intake'  WHERE class_id = '$class_id'");
    
    if (!$query) {
        return  redirect()->back->with('fail', 'Failed to Add !.');
    } else {
        return  redirect()->to('masters/class')->with('success', 'Updated successfully !.');
    }
}
public function update_sem($sem_id){
    $class = $this->request->getVar('class');
    $program_sem= $this->request->getVar('program_sem');
    $db = \Config\Database::connect();
    $query=$db->query("UPDATE `program_sem` SET `program_id`='$class' ,`program_sem`='$program_sem'  WHERE program_sem_id = '$sem_id'");
    
    if (!$query) {
        return  redirect()->back->with('fail', 'Failed to Add !.');
    } else {
        return  redirect()->to('masters/sem')->with('success', 'Updated successfully !.');
    }
}
public function delete_class($class_id){
    $db = \Config\Database::connect();
        $query=$db->query("DELETE FROM `class` WHERE class_id = '$class_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/class')->with('success', 'Deleted successfully !.');
        }
}
public function delete_sem($sem_id){
    $db = \Config\Database::connect();
        $query=$db->query("DELETE FROM `program_sem` WHERE program_sem_id = '$sem_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/sem')->with('success', 'Deleted successfully !.');
        }
}
public function section(){
    $data['active_tab'] = 'section';
    return view('masters/section');
}
public function save_section(){
     $db = \Config\Database::connect();
        $section = $this->request->getVar('section');
        $query=$db->query("INSERT INTO `admmission_section`(`section_name`) VALUES ('$section')");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/section')->with('success', 'Added successfully !.');
        }
}
public function edit_section($section_id){
        $data['section_id'] = $section_id;
        return view('masters/edit_section', $data);
	}
	public function update_section($section_id){
	    $section = $this->request->getVar('section');
	    $db = \Config\Database::connect();
        $query=$db->query("UPDATE `admmission_section` SET `section_name`='$section' WHERE section_id = '$section_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/class')->with('success', 'Updated successfully !.');
        }
	}
public function delete_section($section_id){
    $db = \Config\Database::connect();
        $query=$db->query("DELETE FROM `admmission_section` WHERE section_id = '$section_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/section')->with('success', 'Deleted successfully !.');
        }
}
public function adress_keywords(){
    $data['active_tab'] = 'adress_keywords';
    return view('masters/adress_keywords');
}
public function save_adress_keywords(){
     $db = \Config\Database::connect();
        $adress_keywords = $this->request->getVar('adress_keywords');
        $query=$db->query("INSERT INTO `adress_keywords`(`adress_key`) VALUES ('$adress_keywords')");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/adress_keywords')->with('success', 'Added successfully !.');
        }
}
public function edit_adress_keywords($address_id){
        $data['address_id'] = $address_id;
        return view('masters/edit_adress_keywords', $data);
	}
public function update_adress_keywords($address_id){
	    $adress_keywords = $this->request->getVar('adress_keywords');
	    $db = \Config\Database::connect();
        $query=$db->query("UPDATE `adress_keywords` SET `adress_key`='$adress_keywords' WHERE id = '$address_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/adress_keywords')->with('success', 'Updated successfully !.');
        }
	}
public function delete_adress_keywords($address_id){
    $db = \Config\Database::connect();
        $query=$db->query("DELETE FROM `adress_keywords` WHERE id = '$address_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/adress_keywords')->with('success', 'Deleted successfully !.');
        }
}
public function exam(){
    $data['active_tab'] = 'exam';
    return view('masters/exam');
}
public function save_exam(){
     $db = \Config\Database::connect();
        $exam = $this->request->getVar('exam');
        $date = $this->request->getVar('date');
        $doe = date('Y-m-d h:i:s');
        $ip = $_SERVER['REMOTE_ADDR'];
        $query=$db->query("INSERT INTO `exam`(`exam`, `date`, `doe`, `ip`) VALUES ('$exam', '$date','$doe', '$ip')");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/exam')->with('success', 'Added successfully !.');
        }
}
public function edit_exam($exam_id){
        $data['exam_id'] = $exam_id;
        return view('masters/edit_exam', $data);
	}
public function update_exam($exam_id){
	    $exam = $this->request->getVar('exam');
        $date = $this->request->getVar('date');
	    $db = \Config\Database::connect();
        $query=$db->query("UPDATE `exam` SET `exam`='$exam', `date`='$date' WHERE exam_id = '$exam_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/exam')->with('success', 'Updated successfully !.');
        }
	}
public function delete_exam($exam_id){
    $db = \Config\Database::connect();
        $query=$db->query("DELETE FROM `exam` WHERE exam_id = '$exam_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/exam')->with('success', 'Deleted successfully !.');
        }
}
public function program_sem(){
    $data['active_tab'] = 'program_sem';
    return view('masters/program_sem');
}
public function save_program_sem(){
     $db = \Config\Database::connect();
        $program_sem = $this->request->getVar('program_sem');
        $doe = date('Y-m-d h:i:s');
        $ip = $_SERVER['REMOTE_ADDR'];
        $query=$db->query("INSERT INTO `program_sem`(`program_sem`, `ip`, `doe`) VALUES ('$program_sem', '$ip', '$doe')");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/program_sem')->with('success', 'Added successfully !.');
        }
}
public function edit_program_sem($program_sem_id){
        $data['program_sem_id'] = $program_sem_id;
        return view('masters/edit_program_sem', $data);
	}
public function update_program_sem($program_sem_id){
     $db = \Config\Database::connect();
	    $program_sem = $this->request->getVar('program_sem');
        $doe = date('Y-m-d h:i:s');
        $ip = $_SERVER['REMOTE_ADDR'];
        $query=$db->query("UPDATE `program_sem` SET `program_sem`='$program_sem', `ip`='$ip', `doe`='$doe' WHERE program_sem_id = '$program_sem_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/program_sem')->with('success', 'Updated successfully !.');
        }
	}
public function delete_program_sem($program_sem_id){
    $db = \Config\Database::connect();
        $query=$db->query("DELETE FROM `program_sem` WHERE program_sem_id = '$program_sem_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/program_sem')->with('success', 'Deleted successfully !.');
        }
}
public function add_group(){
    $data['active_tab'] = 'add_group';
    return view('masters/add_group');
}
public function save_group(){
     $db = \Config\Database::connect();
        $group = $this->request->getVar('group');
        $doe = date('Y-m-d h:i:s');
        $ip = $_SERVER['REMOTE_ADDR'];
        $query=$db->query("INSERT INTO `admin_group`(`group_name`, `doe`, `ip`) VALUES ('$group', '$doe', '$ip')");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/add_group')->with('success', 'Added successfully !.');
        }
}
public function edit_group($group_id){
        $data['group_id'] = $group_id;
        return view('masters/edit_group', $data);
	}
public function update_group($group_id){
     $db = \Config\Database::connect();
	    $group = $this->request->getVar('group');
        $doe = date('Y-m-d h:i:s');
        $ip = $_SERVER['REMOTE_ADDR'];
        $query=$db->query("UPDATE `admin_group` SET `group_name`='$group', `ip`='$ip', `doe`='$doe' WHERE group_id = '$group_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/add_group')->with('success', 'Updated successfully !.');
        }
	}
public function delete_group($group_id){
    $db = \Config\Database::connect();
        $query=$db->query("DELETE FROM `admin_group` WHERE group_id = '$group_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/add_group')->with('success', 'Deleted successfully !.');
        }
}
public function subjects(){
    $data['active_tab'] = 'subjects';
    return view('masters/subjects');
}
public function save_subjects(){
    $db = \Config\Database::connect();
        $class = $this->request->getVar('class');
        $subject_group = $this->request->getVar('group');
        $subject = $this->request->getVar('subject');
        $description = $this->request->getVar('description');
        $query=$db->query("INSERT INTO `program_wise_subjects`(`class`, `subject`, `subject_group`, `discription`) VALUES ('$class', '$subject', '$subject_group', '$description')");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/subjects')->with('success', 'Added successfully !.');
        }
}
public function subjects_list(){
    $db = \Config\Database::connect();
     $data['active_tab'] = "subjects_list";
      $data['no_search_subjects_list'] = "no";
      
      $class = $this->request->getVar('class');
      $sem = $this->request->getVar('sem');
      $category = $this->request->getVar('category');
    $session = $this->request->getVar('session');
    
    $query2 = $db->query("SELECT * FROM `fees_to_program` WHERE session = '$session' AND class='$class' AND sem='$sem' AND category='$category'");
    $data['subjects_list']=$query2->getResultArray();
    return view('masters/subjects_list',$data);
}
public function search_subjects_list(){
    $db = \Config\Database::connect();
     $data['active_tab'] = "search_subjects_list";
      $data['no_search_subjects_list'] = "yes";
      
      $class = $this->request->getVar('class');
    
    $query2 = $db->query("SELECT * FROM `program_wise_subjects` WHERE class='$class'");
    $data['subjects_list']=$query2->getResultArray();
    return view('masters/subjects_list',$data);
}
public function edit_subjects_list($subject_id){
     $data['subject_id'] = $subject_id;
        return view('masters/edit_subjects_list', $data);
}
public function update_subjects_list($subject_id){
    $db = \Config\Database::connect();
	    $class = $this->request->getVar('class');
        $subject_group = $this->request->getVar('group');
        $subject = $this->request->getVar('subject');
        $description = $this->request->getVar('description');
        $query=$db->query("UPDATE `program_wise_subjects` SET `class`='$class', `subject`='$subject', `subject_group`='$subject_group', `discription`='$description' WHERE subject_id = '$subject_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/subjects_list')->with('success', 'Updated successfully !.');
        }
}
public function student_category(){
    $data['active_tab'] = 'student_category';
    return view('masters/student_category');
}
public function save_student_category(){
     $db = \Config\Database::connect();
        $category = $this->request->getVar('category');
        $section = $this->request->getVar('section');
        $doe = date('Y-m-d h:i:s');
        $ip = $_SERVER['REMOTE_ADDR'];
        $query=$db->query("INSERT INTO `student_category`(`category`,`section`, `ip`,`doe`) VALUES ('$category','$section', '$ip', '$doe')");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/student_category')->with('success', 'Added successfully !.');
        }
}
public function edit_student_category($category_id){
        $data['category_id'] = $category_id;
        return view('masters/edit_student_category', $data);
	}
public function update_student_category($category_id){
	    $db = \Config\Database::connect();
	    $category = $this->request->getVar('category');
	    $section = $this->request->getVar('section');
        $query=$db->query("UPDATE `student_category` SET `category`='$category',`section`='$section' WHERE category_id = '$category_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/student_category')->with('success', 'Updated successfully !.');
        }
	}
public function delete_student_category($category_id){
    $db = \Config\Database::connect();
        $query=$db->query("DELETE FROM `student_category` WHERE category_id = '$category_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/student_category')->with('success', 'Deleted successfully !.');
        }
}
public function add_prospectus(){
    $data['active_tab'] = 'add_prospectus';
    return view('masters/add_prospectus');
}
public function save_prospectus(){
     $db = \Config\Database::connect();
        $program = $this->request->getVar('program');
        $sem = $this->request->getVar('sem');
        $session = $this->request->getVar('session');
        $amount = $this->request->getVar('prospectus_amount');
        $doe = date('Y-m-d h:i:s');
        $ip = $_SERVER['REMOTE_ADDR'];
        $query=$db->query("INSERT INTO `admin_prospectus`(`program`, `sem`,`session`, `amount`) VALUES ('$program', '$sem', '$session', '$amount')");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/add_prospectus')->with('success', 'Added successfully !.');
        }
}
public function edit_prospectus($prospectus_id){
     $data['prospectus_id'] = $prospectus_id;
        return view('masters/edit_prospectus', $data);
}
public function update_prospectus($prospectus_id){
	    $db = \Config\Database::connect();
	    $program = $this->request->getVar('program');
        $sem = $this->request->getVar('sem');
        $session = $this->request->getVar('session');
        $amount = $this->request->getVar('prospectus_amount');
        $query=$db->query("UPDATE `admin_prospectus` SET `program`='$program', `sem`='$sem', `session`='$session', `amount`='$amount' WHERE prospectus_id = '$prospectus_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/add_prospectus')->with('success', 'Updated successfully !.');
        }
	}
public function delete_prospectus($prospectus_id){
    $db = \Config\Database::connect();
        $query=$db->query("DELETE FROM `admin_prospectus` WHERE prospectus_id = '$prospectus_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/add_prospectus')->with('success', 'Deleted successfully !.');
        }
}
public function prospectus_list(){
    $data['active_tab'] = 'prospectus_list';
    return view('masters/prospectus_list');
}

public function fee_components(){
    $db = \Config\Database::connect();
    $current_and_next_year = $_SESSION['session_year'];
    $data['active_tab'] = "fee_components";
    $query2 = $db->query("SELECT * FROM `fee_components` WHERE session = '$current_and_next_year'");
                $data['fee_component_list']=$query2->getResultArray();
                
    return view('masters/fee_components',$data);
}
public function edit_fee_components($id){
    $data['fee_component_id'] = $id;
    return view('masters/edit_fee_component', $data);
}
public function update_fee_components($id){
    $db = \Config\Database::connect();
	    $fee_component = $this->request->getVar('fee_component');
	    $session = $this->request->getVar('session');
        $doe = date('Y-m-d h:i:s');
        $ip = $_SERVER['REMOTE_ADDR'];
        $query=$db->query("UPDATE `fee_components` SET `component`='$fee_component', `session`='$session' WHERE fee_component_id = '$id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/fee_components')->with('success', 'Updated successfully !.');
        }
}
public function delete_fee_components($id){
    $db = \Config\Database::connect();
        $query=$db->query("DELETE FROM `fee_components` WHERE fee_component_id = '$id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/fee_components')->with('success', 'Deleted successfully !.');
        }
}
public function fee_assign_to_program(){
    $db = \Config\Database::connect();
    $current_and_next_year = $_SESSION['session_year'];
    $data['active_tab'] = "fee_components";
    $query2 = $db->query("SELECT * FROM `fee_components` WHERE session = '$current_and_next_year'");
                $data['fee_component_list']=$query2->getResultArray();
                
    $data['active_tab'] = "fee_assign_to_program";
    return view('masters/fee_assign_to_program',$data);
}
public function fee_assign_to_program1(){
    $db = \Config\Database::connect();
    $current_and_next_year = $_SESSION['session_year'];
    $data['active_tab'] = "fee_components";
    $query2 = $db->query("SELECT * FROM `fee_components` WHERE session = '$current_and_next_year'");
                $data['fee_component_list']=$query2->getResultArray();
                
    $data['active_tab'] = "fee_assign_to_program";
    return view('masters/fee_assign_to_program1',$data);
}
public function search_fee_assign_to_program_list(){
    $db = \Config\Database::connect();
     $data['active_tab'] = "search_fee_assign_to_program_list";
      $data['no_fee_assign_to_program_list'] = "yes";
      
      $class = $this->request->getVar('class');
      $sem = $this->request->getVar('sem');
      $category = $this->request->getVar('category');
    $session = $this->request->getVar('session');
    
    $query2 = $db->query("SELECT * FROM `fees_to_program` WHERE session = '$session' AND class='$class' AND sem='$sem' AND category='$category'");
    $data['fees_to_program_list']=$query2->getResultArray();
    return view('masters/fee_assign_to_program_list',$data);
}
public function delete_fee_assign_to_program_list($fee_assign_id){
    $db = \Config\Database::connect();
        $query=$db->query("DELETE FROM `fees_to_program` WHERE fee_assign_id = '$fee_assign_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/fee_assign_to_program_list')->with('success', 'Deleted successfully !.');
        }
}
public function fee_assign_to_program_list(){
     $data['active_tab'] = "fee_assign_to_program_list";
     $data['no_fee_assign_to_program_list'] = "no";
    return view('masters/fee_assign_to_program_list',$data);
}
public function designation_add(){
     $data['active_tab'] = "designation_add";
    return view('masters/designation_add',$data);
}
public function save_designation(){
    $db = \Config\Database::connect();
        $designation_name = $this->request->getVar('designation_name');
        $description = $this->request->getVar('description');
        $query=$db->query("INSERT INTO `user_designation`(`designation_name`, `designation_des`) VALUES ('$designation_name', '$description')");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/designation_add')->with('success', 'Added successfully !.');
        }
}
public function edit_designation($designation_id){
    $data['designation_id'] = $designation_id;
        return view('masters/edit_designation', $data);
}
public function update_designation($designation_id){
    $db = \Config\Database::connect();
	    $designation_name = $this->request->getVar('designation_name');
        $description = $this->request->getVar('description');
        $query=$db->query("UPDATE `user_designation` SET `designation_name`='$designation_name', `designation_des`='$description' WHERE designation_id = '$designation_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/designation_add')->with('success', 'Updated successfully !.');
        }
}
public function delete_designation($designation_id){
     $db = \Config\Database::connect();
        $query=$db->query("DELETE FROM `user_designation` WHERE designation_id = '$designation_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/designation_add')->with('success', 'Deleted successfully !.');
        }
}

public function department_add(){
    $data['active_tab'] = "department_add";
    return view('masters/department_add',$data);
}
public function save_department(){
    $db = \Config\Database::connect();
        $department_name = $this->request->getVar('department_name');
        $query=$db->query("INSERT INTO `department`(`department`) VALUES ('$department_name')");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/department_add')->with('success', 'Added successfully !.');
        }
}
public function edit_department($department_id){
    $data['department_id'] = $department_id;
        return view('masters/edit_department', $data);
}
public function update_department($department_id){
    $db = \Config\Database::connect();
	    $department = $this->request->getVar('department_name');
        $query=$db->query("UPDATE `department` SET `department`='$department' WHERE id = '$department_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/department_add')->with('success', 'Updated successfully !.');
        }
}
public function delete_department($department_id){
    $db = \Config\Database::connect();
        $query=$db->query("DELETE FROM `department` WHERE id = '$department_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/department_add')->with('success', 'Deleted successfully !.');
        }
}

public function delete_student_info(){
    $db = \Config\Database::connect();
    $data['active_tab'] = "delete_student_info";
    $query2 = $db->query("SELECT * FROM `student_admission_information`");
    $data['student_list']=$query2->getResultArray();
    return view('masters/delete_student_info',$data);
}
public function search_student_list(){
     $db = \Config\Database::connect();
     $data['active_tab'] = "search_student_list";
      
  $first_name = $this->request->getVar('first_name');
  $reg_no = $this->request->getVar('reg_no');
  if($first_name !='' AND $reg_no!=''){
       $query2 = $db->query("SELECT * FROM `student_admission_information` WHERE first_name='$first_name' AND reg_no='$reg_no'");
    
        $data['student_list']=$query2->getResultArray();
  }else if($first_name !='' AND $reg_no==''){
      $query2 = $db->query("SELECT * FROM `student_admission_information` WHERE first_name='$first_name'");
    
        $data['student_list']=$query2->getResultArray();
  }else if($first_name=='' AND $reg_no!=''){
      $query2 = $db->query("SELECT * FROM `student_admission_information` WHERE reg_no='$reg_no'");
    
        $data['student_list']=$query2->getResultArray();
  }else if($first_name=='' AND $reg_no==''){
      $query2 = $db->query("SELECT * FROM `student_admission_information`");
    
        $data['student_list']=$query2->getResultArray();
  }
  
    
   
    $data['first_name']=$first_name;
    $data['reg_no']=$reg_no;
    return view('masters/delete_student_info',$data);
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
            return  redirect()->to('masters/delete_student_info')->with('success', 'Deleted successfully !.');
        }
}
public function allowances(){
     $data['active_tab'] = "allowances";
    return view('masters/allowances',$data);
}
public function save_allowances(){
    $db = \Config\Database::connect();
        $allowance = $this->request->getVar('allowance');
        $description = $this->request->getVar('description');
        $query=$db->query("INSERT INTO `admin_allowance`(`allowance`, `discription`) VALUES ('$allowance', '$description')");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/allowances')->with('success', 'Added successfully !.');
        }
}
public function edit_allowances($allowance_id){
    $data['allowance_id'] = $allowance_id;
        return view('masters/edit_allowances', $data);
}
public function update_allowances($allowance_id){
     $db = \Config\Database::connect();
	   $allowance = $this->request->getVar('allowance');
        $description = $this->request->getVar('description');
        $query=$db->query("UPDATE `admin_allowance` SET `allowance`='$allowance',`discription`='$description' WHERE allowance_id = '$allowance_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/allowances')->with('success', 'Updated successfully !.');
        }
}
public function delete_allowances($allowance_id){
    $db = \Config\Database::connect();
        $query=$db->query("DELETE FROM `admin_allowance` WHERE allowance_id = '$allowance_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/allowances')->with('success', 'Deleted successfully !.');
        }
}


public function deduction(){
    $data['active_tab'] = "deduction";
    return view('masters/deduction',$data);
}
public function save_deduction(){
     $db = \Config\Database::connect();
        $deduction = $this->request->getVar('deduction');
        $description = $this->request->getVar('description');
        $query=$db->query("INSERT INTO `admin_deduction`(`deduction`, `discription`) VALUES ('$deduction', '$description')");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/deduction')->with('success', 'Added successfully !.');
        }
}
public function edit_deduction($deduction_id){
     $data['deduction_id'] = $deduction_id;
        return view('masters/edit_deduction', $data);
}
public function update_deduction($deduction_id){
     $db = \Config\Database::connect();
	   $deduction = $this->request->getVar('deduction');
        $description = $this->request->getVar('description');
        $query=$db->query("UPDATE `admin_deduction` SET `deduction`='$deduction',`discription`='$description' WHERE deduction_id = '$deduction_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/deduction')->with('success', 'Updated successfully !.');
        }
}
public function delete_deduction($deduction_id){
     $db = \Config\Database::connect();
        $query=$db->query("DELETE FROM `admin_deduction` WHERE deduction_id = '$deduction_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/deduction')->with('success', 'Deleted successfully !.');
        }
}

	public function save_reference_detail(){
	    $reference_name = $this->request->getVar('reference_name');
	    $db = \Config\Database::connect();
        $query=$db->query("INSERT INTO `reference_details`(`reference`) VALUES ('$reference_name')");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/reference_details')->with('success', 'Added successfully !.');
        }
	}
	public function last_school_attended_name(){
	    $school_name = $this->request->getVar('school_name');
	    $db = \Config\Database::connect();
        $query=$db->query("INSERT INTO `last_school_attended`(`school_name`) VALUES ('$school_name')");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/last_school_attended')->with('success', 'Added successfully !.');
        }
	}
	public function update_reference_detail($refer_id){
	    $reference_name = $this->request->getVar('reference_name');
	    $db = \Config\Database::connect();
        $query=$db->query("UPDATE `reference_details` SET `reference`='$reference_name' WHERE refer_id = '$refer_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/reference_details')->with('success', 'Updated successfully !.');
        }
	}
	public function delete_reference_details($refer_id){
	    $db = \Config\Database::connect();
        $query=$db->query("DELETE FROM `reference_details` WHERE refer_id = '$refer_id'");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/reference_details')->with('success', 'Deleted successfully !.');
        }
	}
	public function save_fee_components(){
	    $fee_component = $this->request->getVar('fee_component');
	    $session = $this->request->getVar('session');
	    $doe	= date('Y-m-d h:i:s');
		$ip	= $_SERVER['REMOTE_ADDR'];
	    $db = \Config\Database::connect();
        $query=$db->query("INSERT INTO `fee_components`(`component`, `session`, `doe`, `ip`) VALUES ('$fee_component', '$session', '$doe', '$ip')");
        
        if (!$query) {
            return  redirect()->back->with('fail', 'Failed to Add !.');
        } else {
            return  redirect()->to('masters/fee_components')->with('success', 'Added successfully !.');
        }
	}
	public function search_fee_components(){
	    $db = \Config\Database::connect();
	    $search_session=$this->request->getVar('search_session');
	    $current_and_next_year = date('Y') .'-'.date('Y', strtotime('+1 year'));
	    if($search_session !=''){
             $query1 = $db->query("SELECT * FROM `fee_components` WHERE session = '$search_session'");
             $data['fee_component_list']=$query1->getResultArray();
             
            }else{
                $query2 = $db->query("SELECT * FROM `fee_components` WHERE session = '$current_and_next_year'");
                $data['fee_component_list']=$query2->getResultArray();
                
            }
            return view('masters/fee_components',$data);
	}
	public function save_fee_assign_program(){
	    $db = \Config\Database::connect();
	    $class=$this->request->getVar('class');
	    $sem=$this->request->getVar('sem');
	    $session=$this->request->getVar('session');
	    $category = $this->request->getVar('category');
	    $component_id = $this->request->getVar('component_id');
	    $component_name = $this->request->getVar('component_name');
	    $perticular_rate = $this->request->getVar('perticular_rate');
	    $date = date('Y-m-d h:i:s');
	    $insert_ip = $_SERVER['REMOTE_ADDR'];
	    if($category ==''){
	        return  redirect()->to('masters/fee_assign_to_program')->with('error', 'Select any category !.');
	    }else{
	        foreach ($category as $category) {
	             for ($i = 0; $i < count($component_id); $i++) {
                    $query=$db->query("INSERT INTO `fees_to_program`(`class`, `sem`, `session`, `fee_type`, `amount`, `category`, `insert_date`, `insert_ip`) VALUES ('$class', '$sem', '$session', '$component_id[$i]', '$perticular_rate[$i]', '$category', '$date', '$insert_ip')");
    	        }
	        }
	        if (!$query) {
                return  redirect()->to('masters/fee_assign_to_program')->with('error', 'not added !.');
            } else {
                return  redirect()->to('masters/fee_assign_to_program')->with('success', 'Added successfully !.');
            }
	    }
	}
	public function demo_fee_assign_to_program(){
    $db = \Config\Database::connect();
    $current_and_next_year = date('Y') .'-'.date('Y', strtotime('+1 year'));
    $data['active_tab'] = "fee_components";
    $query2 = $db->query("SELECT * FROM `fee_components` WHERE session = '$current_and_next_year'");
                $data['fee_component_list']=$query2->getResultArray();
                
    $data['active_tab'] = "demo_fee_assign_to_program";
    return view('masters/demo_fee_assign_to_program',$data);
}
	public function save_demo_fee_assign_program(){
	    $db = \Config\Database::connect();
	    $class=$this->request->getVar('class');
	    $sem=$this->request->getVar('sem');
	    $session=$this->request->getVar('session');
	    $category = $this->request->getVar('category');
	    $component_id = $this->request->getVar('component_id');
	    $component_name = $this->request->getVar('component_name');
	    $perticular_rate = $this->request->getVar('perticular_rate');
	    $date = date('Y-m-d h:i:s');
	    $insert_ip = $_SERVER['REMOTE_ADDR'];
	    if($category ==''){
	        return  redirect()->to('masters/demo_fee_assign_to_program')->with('error', 'Select any category !.');
	    }else{
	        foreach ($category as $category) {
	            
	             for ($i = 0; $i < count($component_id); $i++) {
	                 $query1=$db->query("SELECT * FROM `demo_fees_to_program` WHERE fee_type='$component_id[$i]'");
	                 if($query1 == false){
	                     
	                 
                    $query=$db->query("INSERT INTO `demo_fees_to_program`(`class`, `sem`, `session`, `fee_type`, `amount`, `category`, `insert_date`, `insert_ip`) VALUES ('$class', '$sem', '$session', '$component_id[$i]', '$perticular_rate[$i]', '$category', '$date', '$insert_ip')");
	                 }
	                     
	                 }
	        }
	        if (!$query1) {
                return  redirect()->to('masters/demo_fee_assign_to_program')->with('error', 'already added!.');
            } else {
                return  redirect()->to('masters/demo_fee_assign_to_program')->with('success', 'Added successfully !.');
            }
	    }
	}
	public function edit_fee_program_list($id){
	    $data['fee_assign_id'] = $id;
        return view('masters/edit_fee_program_list', $data);
	}
	public function update_fee_program_list(){
	     $db = \Config\Database::connect();
	    $fee_assign_id=$this->request->getVar('fee_assign_id');
	    $class=$this->request->getVar('class');
	    $sem=$this->request->getVar('sem');
	    $session=$this->request->getVar('session');
	    $category=$this->request->getVar('category');
	    $perticular_rate=$this->request->getVar('perticular_rate');
	    $query = $db->query("UPDATE `fees_to_program` SET `class`='$class',`sem`='$sem',`session`='$session',
    `amount`='$perticular_rate',`category`='$category' WHERE fee_assign_id='$fee_assign_id'");
    
            if (!$query) {
                return  redirect()->to('masters/fee_assign_to_program_list')->with('error', 'already added!.');
            } else {
                return  redirect()->to('masters/fee_assign_to_program_list')->with('success', 'Updated successfully !.');
            }       
	}
}


