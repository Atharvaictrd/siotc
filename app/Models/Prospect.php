<?php

namespace App\Models;

use CodeIgniter\Model;

class Prospect extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'prospect_sales';
	protected $primaryKey           = 'prospect_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
// 	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'prospect_id','enquiry_no','class','semister','session','section','category','student_gender','gender1','student_first_name','student_middle_name','student_last_name','date','prospect_no','amount','contact_no','last_school_attended','percentage','medium','area','status','insert_by','modify_by','insert_date','modify_date','insert_ip','modify_ip'
	];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
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
