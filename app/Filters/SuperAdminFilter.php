<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class SuperAdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        if (!$session->has('adminloggedid')) {
            return redirect()->to(base_url(route_to('login')));
        }

        $permissions = new \App\Libraries\PermissionService();
        if ($permissions->isSuperAdmin($session->get('adminloggedid'))) {
            return null;
        }

        return service('response')
            ->setStatusCode(403)
            ->setBody('Access denied.');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
