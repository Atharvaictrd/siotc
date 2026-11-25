<?php

namespace App\Models;

use CodeIgniter\Model;

class ParentModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'student_parent_information';
	protected $primaryKey           = 'id ';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
// 	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'student_admission_id','f_first_name','f_middle_name','f_last_name','f_occupation','f_annual_income','f_o_plot_no','f_o_area','f_o_city','f_o_pin_code','f_o_state','f_o_tel_no','f_o_email','m_first_name','m_middle_name','m_last_name','m_occupation','	m_annual_income','m_o_plot_no','m_o_area','m_o_city','m_o_pin_code','m_o_state','m_o_tel_no','m_o_email','m_o_district','f_district'
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
