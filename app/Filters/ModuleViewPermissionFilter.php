<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class ModuleViewPermissionFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (strtoupper($request->getMethod()) !== 'GET') {
            return null;
        }

        $requestPath = $this->normalizePath($request->getUri()->getPath());
        $basePath = $this->normalizePath((string) parse_url(base_url(), PHP_URL_PATH));

        if ($basePath !== '' && ($requestPath === $basePath || strpos($requestPath, $basePath . '/') === 0)) {
            $requestPath = ltrim(substr($requestPath, strlen($basePath)), '/');
        }

        $db = db_connect();
        $modules = $db->table('modules')
            ->select('module_id, route')
            ->where('status', 1)
            ->where('is_menu', 1)
            ->where('route IS NOT NULL', null, false)
            ->get()
            ->getResultArray();

        $moduleId = null;
        foreach ($modules as $module) {
            if ($this->normalizePath((string) $module['route']) === $requestPath) {
                $moduleId = (int) $module['module_id'];
                break;
            }
        }

        if ($moduleId === null) {
            return service('response')
                ->setStatusCode(403)
                ->setBody('Access denied.');
        }

        $roles = $db->table('user_roles')
            ->select('roles.role_id, roles.role_name')
            ->join('roles', 'roles.role_id = user_roles.role_id')
            ->where('user_roles.user_id', session()->get('adminloggedid'))
            ->where('roles.status', 1)
            ->get()
            ->getResultArray();

        $roleIds = [];
        foreach ($roles as $role) {
            $roleIds[] = (int) $role['role_id'];
            $normalizedRoleName = strtolower(preg_replace('/[\s_-]+/', '', (string) $role['role_name']));

            if ($normalizedRoleName === 'superadmin') {
                return null;
            }
        }

        if ($roleIds !== []) {
            $permissions = $db->table('role_permissions')
                ->select('permissions.action_name')
                ->join('permissions', 'permissions.permission_id = role_permissions.permission_id')
                ->whereIn('role_permissions.role_id', array_values(array_unique($roleIds)))
                ->where('permissions.module_id', $moduleId)
                ->get()
                ->getResultArray();

            foreach ($permissions as $permission) {
                if (strtolower(trim((string) $permission['action_name'])) === 'view') {
                    return null;
                }
            }
        }

        return service('response')
            ->setStatusCode(403)
            ->setBody('Access denied.');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }

    private function normalizePath(string $path): string
    {
        $parsedPath = parse_url($path, PHP_URL_PATH);

        return trim($parsedPath !== false && $parsedPath !== null ? $parsedPath : $path, '/');
    }
}
