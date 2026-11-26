<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class ModuleViewPermissionFilter implements FilterInterface
{
    private const ACTION_ROUTE_PERMISSIONS = [
        'create_enquiry' => ['student_enquiry', 'add'],
        'delete_enquiry' => ['list_student_enquiry', 'delete'],
        'create_prospect' => ['prospectus', 'add'],
        'delete_prospect' => ['prospectus', 'delete'],
        'create_prospect_enquired' => ['prospectus_enquired', 'add'],
        'delete_prospect_enquired' => ['prospectus_enquired', 'delete'],
        'delete_prospect_report' => ['prospectus_report', 'delete'],
        'insert_section' => ['section_allocation', 'add'],
        'delete_student_list' => ['student_admission', 'delete'],
        'student_admission_form' => ['student_admission', 'edit'],
        'update_std_data' => ['student_admission', 'edit'],
        'add_new_employee' => ['hr_management', 'add'],
        'update_employee' => ['hr_management', 'edit'],
        'delete_emp' => ['hr_management', 'delete'],
        'add_teacher' => ['hr_management', 'add'],
        'delete_fees' => ['fees_report', 'delete'],
        'delete_bus_fees' => ['fees_report', 'delete'],
        'delete_management' => ['fees_report', 'delete'],
        'insert_other_fees' => ['fees_report', 'add'],
        'save_new_keyword' => ['master', 'add'],
        'fees_report/scholarship/togglestatus' => ['fees_report', 'edit'],
    ];

    public function before(RequestInterface $request, $arguments = null)
    {
        $requestPath = $this->normalizePath($request->getUri()->getPath());
        $basePath = $this->normalizePath((string) parse_url(base_url(), PHP_URL_PATH));

        if ($basePath !== '' && ($requestPath === $basePath || strpos($requestPath, $basePath . '/') === 0)) {
            $requestPath = ltrim(substr($requestPath, strlen($basePath)), '/');
        }

        $actionRoute = preg_replace('/\/[0-9]+$/', '', strtolower($requestPath));
        if (isset(self::ACTION_ROUTE_PERMISSIONS[$actionRoute])) {
            [$moduleKey, $action] = self::ACTION_ROUTE_PERMISSIONS[$actionRoute];
            $permissionService = new \App\Libraries\PermissionService();

            if ($permissionService->hasPermission(
                $moduleKey,
                $action,
                session()->get('adminloggedid')
            )) {
                return null;
            }

            return service('response')
                ->setStatusCode(403)
                ->setBody('Access denied.');
        }

        $db = db_connect();
        $modules = $db->table('modules')
            ->select('module_key, route')
            ->where('status', 1)
            ->where('route IS NOT NULL', null, false)
            ->get()
            ->getResultArray();

        $matchedModule = null;
        $matchedRouteLength = -1;
        foreach ($modules as $module) {
            $moduleRoute = $this->normalizePath((string) $module['route']);
            if (
                $moduleRoute !== ''
                && ($requestPath === $moduleRoute || strpos($requestPath, $moduleRoute . '/') === 0)
                && strlen($moduleRoute) > $matchedRouteLength
            ) {
                $matchedModule = $module;
                $matchedRouteLength = strlen($moduleRoute);
            }
        }

        if ($matchedModule === null) {
            return null;
        }

        $relativePath = trim(substr($requestPath, $matchedRouteLength), '/');
        $action = $this->getAction($relativePath, strtoupper($request->getMethod()));
        $permissionService = new \App\Libraries\PermissionService($db);

        if ($permissionService->hasPermission(
            (string) $matchedModule['module_key'],
            $action,
            session()->get('adminloggedid')
        )) {
            return null;
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

    private function getAction(string $relativePath, string $method): string
    {
        if ($method === 'DELETE' || preg_match('/(^|[\/_-])delete([\/_-]|$)/i', $relativePath)) {
            return 'delete';
        }

        if (
            in_array($method, ['PUT', 'PATCH'], true)
            || preg_match('/(^|[\/_-])(edit|update|change|toggle)([\/_-]|$)/i', $relativePath)
        ) {
            return 'edit';
        }

        if (preg_match('/(^|[\/_-])(add|create|insert|save|store)([\/_-]|$)/i', $relativePath)) {
            return 'add';
        }

        return 'view';
    }
}
