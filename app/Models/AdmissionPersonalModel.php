<?php

namespace App\Models;

use CodeIgniter\Model;

class AdmissionPersonalModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'student_personal_information';
	protected $primaryKey           = 'id ';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
// 	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
	'student_admission_id',	'blood_gp','date_of_birth','mother_tongue','place_of_birth','place_district','place_state','domicile_of_state','domicile_district','domicile_town','region','martial_status','monther_tongue','sex','religion','nationality','personal_category','caste','freedom_fighter','physically_handicapped','ex_man_defence_person','sport_participate','e_b_c','annual_income','scolarship_acc','scolarship_bank','scholarship_branch',
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
