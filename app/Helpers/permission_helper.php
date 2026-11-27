<?php

if (!function_exists('canAccess')) {
    function canAccess(string $moduleKey, string $action = 'view'): bool
    {
        $permissionService = new \App\Libraries\PermissionService();

        return $permissionService->hasPermission($moduleKey, $action);
    }
}
