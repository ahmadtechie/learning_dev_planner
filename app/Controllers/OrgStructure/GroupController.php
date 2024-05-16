<?php

namespace App\Controllers\OrgStructure;

use App\Controllers\BaseController;
use App\Models\DivisionModel;
use App\Models\GroupModel;
use CodeIgniter\Config\Services;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;

helper(['form']);


class GroupController extends BaseController
{
    public array $data;
    public GroupModel $groupModel;
    public DivisionModel $divisionModel;
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

    function __construct()
    {
        $this->groupModel = model(GroupModel::class);
        $this->divisionModel = model(DivisionModel::class);
        $this->data = [
            'title' => 'Group Page | LD Planner',
            'groups' => $this->groupModel->orderBy('created_at', 'DESC')->findAll(),
            'divisions' => $this->divisionModel->orderBy('created_at', 'DESC')->findAll(),
            'page_name' => 'groups',
        ];
    }

    public function index(): string
    {
        $this->data['userData'] = $this->request->userData;

        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_group', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws \ReflectionException
     */
    public function create()
    {
        $this->data['userData'] = $this->request->userData;
        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];

            return view('includes/head') .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_group', array_merge($this->data, $validation)) .
                view('includes/footer');
        }
        $validData = $this->validator->getValidated();
        $this->groupModel->save([
            'group_name' => $validData['group_name'],
            'division_id' => $validData['division_id']
        ]);
        return redirect('ldm.groups')->with('success', "Group {$validData['group_name']} created successfully.");
    }

    public function edit($id): string
    {
        $this->data['userData'] = $this->request->userData;
        $this->data['title'] = 'Edit Group | LD Planner';
        $this->data['group'] = $this->groupModel->find($id);

        return view('includes/head', $this->data) .
            view('includes/navbar') .
            view('includes/sidebar') .
            view('includes/mini_navbar', $this->data) .
            view('forms/create_group', $this->data) .
            view('includes/footer');
    }

    /**
     * @throws \ReflectionException
     */
    public function update($id)
    {
        $this->data['userData'] = $this->request->userData;
        $this->validation['group_name']['rules'] = 'required|min_length[3]';

        if (!$this->validate($this->validation)) {
            $validation = ['validation' => $this->validator];
            return view('includes/head', $this->data) .
                view('includes/navbar') .
                view('includes/sidebar') .
                view('includes/mini_navbar', $this->data) .
                view('forms/create_group', array_merge($this->data, $validation)) .
                view('includes/footer');
        }

        $validData = $this->request->getPost();
        $this->groupModel->update($id, $validData);
        return redirect()->to(url_to('ldm.groups.create'))->with('success', "Group {$validData['group_name']} edited successfully.");
    }

    public function delete(): RedirectResponse
    {
        $this->data['userData'] = $this->request->userData;
        $group_id = $this->request->getVar('group_id');
        $this->groupModel->delete($group_id);
        return redirect('ldm.groups')->with('deleted', "Group deleted successfully.");
    }

    public function allGroups(): ResponseInterface
    {
        $division_id = $this->request->getVar('division_id');
        $groups = $this->groupModel->where('division_id', $division_id)->findAll();

        $formattedGroups = [];
        foreach ($groups as $group) {
            $formattedGroups[] = [
                'id' => $group['id'],
                'group_name' => $group['group_name'],
            ];
        }

        return $this->response->setJSON($formattedGroups);
    }
}
