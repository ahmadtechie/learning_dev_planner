<?php

namespace App\Filters;

use App\Models\UserRoleModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class EmployeePermissionCheck implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        //
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array|null $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        if (!session()->has('loggedInUser')) {
            session()->set('redirect_url', current_url());
            return redirect()->to(url_to('ldm.login'))->with('error', 'You must be logged In to access this page');
        }
        $rolesModel = new UserRoleModel();
        $employeeRoleId = $rolesModel->where('name', 'Employee')->first()['id'];
        $learningDevRoleId = $rolesModel->where('name', 'LDM')->first()['id'];
        $lineMngRoleId = $rolesModel->where('name', 'LineManager')->first()['id'];

        if (in_array($employeeRoleId, session()->get('employeeRoles')) or in_array($learningDevRoleId, session()->get('employeeRoles')) or in_array($lineMngRoleId, session()->get('employeeRoles'))) {
            return null;
        }
        return redirect()->to(url_to('ldm.access_denied'));
    }
}
