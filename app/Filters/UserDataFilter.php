<?php

namespace App\Filters;

use App\Models\UserModel;
use App\Models\UserRoleModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class UserDataFilter implements FilterInterface
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
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $userModel = new UserModel();
        $rolesModel = new UserRoleModel();

        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);
        $lineManagerRoleId = $rolesModel->where('name', 'LineManager')->first()['id'];
        $learningDevRoleId = $rolesModel->where('name', 'LDM')->first()['id'];
        $trainerRoleId = $rolesModel->where('name', 'Trainer')->first()['id'];
        $employeeRoleId = $rolesModel->where('name', 'Employee')->first()['id'];

        // Add necessary data to the request
        $request->userData = [
            'userInfo' => $userInfo,
            'lineManagerRoleId' => $lineManagerRoleId,
            'learningDevRoleId' => $learningDevRoleId,
            'trainerRoleId' => $trainerRoleId,
            'employeeRoleId' => $employeeRoleId,
        ];

        return $request;
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
