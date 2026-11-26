<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'user';
    protected $primaryKey       = 'user_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $protectFields = true;

    protected $allowedFields = [
        'user_name',
        'full_name',
        'emp_id',
        'email',
        'mobile',
        'address',
        'password',
        'last_modify_date'
    ];

    // Validation
    protected $validationRules = [
        'user_name' => 'required',
        'password'  => 'required'
    ];

    protected $validationMessages = [
        'user_name' => [
            'required' => 'Username is required'
        ],
        'password' => [
            'required' => 'Password is required'
        ]
    ];

    // Existing project uses manual date handling
    protected $useTimestamps = false;

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
        if ($this->insert($data)) {
            return $this->getInsertID();
        }

        return [
            'error' => $this->errors()
        ];
    }

    public function update_row($id, $data)
    {
        if ($this->update($id, $data)) {
            return true;
        }

        return [
            'error' => $this->errors()
        ];
    }

    public function delete_row($id)
    {
        return $this->delete($id);
    }

    public function fetch_single_user($id)
    {
        return $this->where('user_id', $id)->findAll();
    }
}
