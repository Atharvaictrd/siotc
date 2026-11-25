<?php

namespace App\Models;

use CodeIgniter\Model;

class AdmissionModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'student_admission_information';
	protected $primaryKey           = 'student_admission_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
// 	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
	'student_admission_id','prospectus_no','section','c_roll_no','date_of_admission','date_of_admission_leavinig','student_full_name_for_leaving','salutation','first_name','mar_name','middle_name','last_name','enrollment_no','pfws','program','semister','last_school_attended','last_percentage','class_year','quota','last_medium','category','sec','group_name','student_image','date_of_birth','reg_no','std_admno','batch_year','session_year','joining_status','joining_date','status','route','class','exam_passed','mscit','parent_mobile_number','sports','percentage','year_last_exam','roll_no','masrks','out_of','result','division','enrol_no_last_exam','university_last_exam','comp_lang','second_lang','grp','optional_sub_1','optional_sub_2','optional_sub_3','optional_sub_4','optional_sub_5','optional_sub_6','last_college','student_gender','actual_scholarship','paid_scholarship','scholarship_status','area','reference_details','active_status','insert_by','insert_date','insert_ip','modify_by','modify_date','modify_ip','dob_words',
	];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'insert_date';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

	public function fetch_all()
	{
		return $this->findAll();
	}

	public function fetch_row($id)
	{
		return $this->find($id);
	}
	public function fetch_rows_by_category_id($category_id)
	{
		return $this->where('category_id',$category_id)->findAll();
	}
	public function fetch_rows_by_category_name($category_name)
	{
		return $this->where('category',$category_name)->findAll();
	}

	public function fetch_row_by_program_name($name)
	{
		return $this->where('program_name',$name)->first();
	}



	public function create($data)
	{
		if ($this->save($data)) {
			if ($this->insertID != 0) {
				return $this->insertID;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function update_row($id, $data)
	{
		if ($this->update($id, $data)) {
			return true;
		} else {
			return false;
		}
	}

	public function delete_row($id)
	{
		return $this->delete($id);
	}
}
