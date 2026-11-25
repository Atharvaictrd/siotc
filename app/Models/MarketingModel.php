<?php

namespace App\Models;

use CodeIgniter\Model;

class MarketingModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'marketing_enquiry';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
// 	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'enquiry_no','enquiry_date','gender','gender1','f_name','m_name','l_name','class','semister','session','contact_no','email','address','landmark','last_school_attended','section','category','percentage','medium','medium','reference_details','admission_status','prospectus_status'
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
	public function fetch_rows_by_enquiry_no($enquiry_no)
	{
		return $this->where('enquiry_no',$enquiry_no)->findAll();
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
