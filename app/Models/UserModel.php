<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'user';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
// 	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'user_name',
		'emp_id',
		'password',
	];

	// Dates
// 	protected $useTimestamps        = true;
// 	protected $dateFormat           = 'datetime';
// 	protected $createdField         = 'created_at';
// 	protected $updatedField         = 'updated_at';
// 	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [
		'user_name'  => 'required',
		'password' => 'required',
	];

	protected $validationMessages   = [
		'user_name' => [
			'required' => '{field} is required',
		],
		'password' => [
			'required' => '{field} is required',
		],
	];
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

	public function create($data)
	{
		if ($this->save($data)) {
			if ($this->insertID != 0) {
				return $this->insertID;
			} else {
				$data['error'] = $this->errors();
				return $data;
			}
		} else {
			$data['error'] = $this->errors();
			return $data;
		}
	}

	public function update_row($id, $data)
	{
		if ($this->update($id, $data)) {
			return true;
		} else {
			$data['error'] = $this->errors();
			return $data;
		}
	}

	public function delete_row($id)
	{
		return $this->delete($id);
	}
	public function fetch_single_user($id){
	    $db = \Config\Database::connect();
        $query=$db->query("SELECT * FROM user WHERE user_id='$id'");
        return $query->getResult();
	}
}
