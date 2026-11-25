<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'student_contact_detail ';
	protected $primaryKey           = 'student_contact_id ';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
// 	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'student_admission_id','fa_first_name','fa_middle_name','fa_last_name','mo_first_name','mo_middle_name','mo_last_name','c_plot_no','c_area','c_city','c_district','c_pin_code','c_state','c_tel_no','p_plot_no','p_area','p_city','p_district','p_pin_code','p_state','p_tel_no','p_mobile_no','p_email'
	];

	// Dates
// 	protected $useTimestamps        = true;
// 	protected $dateFormat           = 'datetime';
// 	protected $createdField         = 'insert_date';
// 	protected $updatedField         = 'updated_at';
// 	protected $deletedField         = 'deleted_at';

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
