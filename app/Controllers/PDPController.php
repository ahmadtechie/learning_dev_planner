<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PDPController extends BaseController
{
    public array $data;
    function __construct()
    {
        $this->data = [
            'title' => 'Personal Development Plan | LD Planner',
        ];
    }

    public function index()
    {
        $this->data['userData'] = $this->request->userData;
        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('form/pdp', $this->data) .
            view('includes/footer');
    }
}
