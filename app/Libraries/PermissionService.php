<?php

namespace App\Libraries;

class PermissionService
{
    private $db;

    public function __construct($db = null)
    {
        $this->db = $db ?? db_connect();
    }

    public function getPermissionContext($userId = null): array
    {
        $userId = $userId ?? session()->get('adminloggedid');
        $context = [
            'is_super_admin' => false,
            'permissions' => [],
        ];

        if ($userId === null || $userId === '') {
            return $context;
        }

        $roles = $this->db->table('user_roles ur')
            ->select('r.role_id, r.role_name')
            ->join('roles r', 'r.role_id = ur.role_id')
            ->where('ur.user_id', $userId)
            ->where('r.status', 1)
            ->get()
            ->getResultArray();

        $roleIds = [];
        foreach ($roles as $role) {
            $roleIds[] = (int) $role['role_id'];
            if (strcasecmp((string) $role['role_name'], 'Super Admin') === 0) {
                $context['is_super_admin'] = true;
                return $context;
            }
        }

        if ($roleIds !== []) {
            $rolePermissions = $this->db->table('role_permissions rp')
                ->select('m.module_key, p.action_name')
                ->join('permissions p', 'p.permission_id = rp.permission_id')
                ->join('modules m', 'm.module_id = p.module_id')
                ->whereIn('rp.role_id', array_values(array_unique($roleIds)))
                ->where('m.status', 1)
                ->get()
                ->getResultArray();

            foreach ($rolePermissions as $permission) {
                $context['permissions'][(string) $permission['module_key']]
                    [strtolower(trim((string) $permission['action_name']))] = true;
            }
        }

        $userPermissions = $this->db->table('user_permissions up')
            ->select('m.module_key, p.action_name, up.permission_status')
            ->join('permissions p', 'p.permission_id = up.permission_id')
            ->join('modules m', 'm.module_id = p.module_id')
            ->where('up.user_id', $userId)
            ->where('m.status', 1)
            ->get()
            ->getResultArray();

        foreach ($userPermissions as $permission) {
            $context['permissions'][(string) $permission['module_key']]
                [strtolower(trim((string) $permission['action_name']))] =
                    (int) $permission['permission_status'] === 1;
        }

        return $context;
    }

    public function hasPermission(string $moduleKey, string $action = 'view', $userId = null): bool
    {
        $context = $this->getPermissionContext($userId);
        if ($context['is_super_admin']) {
            return true;
        }

        return ($context['permissions'][$moduleKey][strtolower(trim($action))] ?? false) === true;
    }

    public function isSuperAdmin($userId = null): bool
    {
        return $this->getPermissionContext($userId)['is_super_admin'];
    }
}
