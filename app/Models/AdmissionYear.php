<?php

namespace App\Models;

use CodeIgniter\Model;

class AdmissionYear extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'student_admission_year';
	protected $primaryKey           = 'admission_year_id  ';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'student_admission_id','prospectus_no','salutation','first_name','middle_name','last_name','program','category','semister','last_school_attended','medium','percentage','quota','session_year','Admission_date','reg_no','date_of_entry','ip'
	];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'insert_date';
	protected $updatedField         = 'date_of_entry';
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
