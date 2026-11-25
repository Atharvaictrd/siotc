<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateUserManagementMenuModules extends Migration
{
    public function up()
    {
        $parent = $this->db->table('modules')
            ->where('module_key', 'user_management')
            ->get()
            ->getRowArray();

        if ($parent === null) {
            throw new \RuntimeException('User Management parent module was not found.');
        }

        $rolesModule = $this->db->table('modules')
            ->where('parent_id', $parent['module_id'])
            ->where('module_key', 'permission_panel')
            ->get()
            ->getRowArray();

        $createUserModule = $this->db->table('modules')
            ->where('parent_id', $parent['module_id'])
            ->where('module_key', 'create_user')
            ->get()
            ->getRowArray();

        if ($rolesModule === null || $createUserModule === null) {
            throw new \RuntimeException('Expected User Management child modules were not found.');
        }

        $collision = $this->db->table('modules')
            ->groupStart()
                ->where('module_key', 'roles_permissions')
                ->orWhere('route', 'create_role')
            ->groupEnd()
            ->where('module_id !=', $rolesModule['module_id'])
            ->countAllResults();

        if ($collision > 0) {
            throw new \RuntimeException('Roles & Permissions module key or route is already in use.');
        }

        if ($this->db->transBegin() !== true) {
            throw new \RuntimeException('Unable to start the User Management module update transaction.');
        }

        try {
            $this->db->table('modules')
                ->where('module_id', $rolesModule['module_id'])
                ->update([
                    'module_name' => 'Roles & Permissions',
                    'module_key'  => 'roles_permissions',
                    'route'       => 'create_role',
                    'sort_order'  => 1,
                ]);

            $this->db->table('modules')
                ->where('module_id', $createUserModule['module_id'])
                ->update([
                    'sort_order' => 3,
                ]);

            if ($this->db->transStatus() === false || $this->db->transCommit() !== true) {
                throw new \RuntimeException('User Management module update failed.');
            }
        } catch (\Throwable $e) {
            $this->db->transRollback();
            throw $e;
        }
    }

    public function down()
    {
        $rolesModule = $this->db->table('modules')
            ->where('module_key', 'roles_permissions')
            ->where('route', 'create_role')
            ->get()
            ->getRowArray();

        $createUserModule = $this->db->table('modules')
            ->where('module_key', 'create_user')
            ->get()
            ->getRowArray();

        if ($rolesModule === null || $createUserModule === null) {
            throw new \RuntimeException('Updated User Management module records were not found.');
        }

        if ($this->db->transBegin() !== true) {
            throw new \RuntimeException('Unable to start the User Management module rollback transaction.');
        }

        try {
            $this->db->table('modules')
                ->where('module_id', $rolesModule['module_id'])
                ->update([
                    'module_name' => 'Permission Panel',
                    'module_key'  => 'permission_panel',
                    'route'       => 'permission-panel',
                    'sort_order'  => 2,
                ]);

            $this->db->table('modules')
                ->where('module_id', $createUserModule['module_id'])
                ->update([
                    'sort_order' => 1,
                ]);

            if ($this->db->transStatus() === false || $this->db->transCommit() !== true) {
                throw new \RuntimeException('User Management module rollback failed.');
            }
        } catch (\Throwable $e) {
            $this->db->transRollback();
            throw $e;
        }
    }
}
