<?php

namespace App\Controllers\DevelopmentContracting;

use App\Controllers\BaseController;

class DevelopmentRatingController extends BaseController
{
    public array $data;
    public array $validation = [
        'group_name' => [
            'rules' => 'required|min_length[3]|validateGroupUnique[group.group_name]',
            'errors' => [
                'required' => 'Group name must be provided',
                'min_length' => 'Group name must be at least 3 characters.',
                'validateGroupUnique' => 'A group with this name already registered'
            ]
        ],
        'division_id' => [
            'rules' => 'required|integer',
            'errors' => [
                'integer' => 'A group must be selected!',
            ],
        ]
    ];

    public function index(): string
    {
        return view('includes/head') .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/self_rating', $this->data) .
            view('includes/footer');
    }

    public function new()
    {

    }

    public function create()
    {

    }

    public function edit($slug)
    {

    }

    public function update($slug)
    {

    }

    public function delete($slug)
    {

    }
}
