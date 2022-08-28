<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UsersController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('BaseModel', 'BM');
        $this->load->model('UserModel', 'User');
        $this->load->library('Datatables', 'datatables');
        $this->load->helper('utility');
        $this->auth->logged();
    }

    //@desc     show users table
    //@route    GET admin/users
    public function users($roleId)
    {
        $data['role'] = $this->BM->getById('roles', $roleId);
        $this->load->view('lte/admin/users/users', $data);
    }

    //@desc     show data users table
    //@route    GET admin/users/users-table
    public function usersTable($roleId)
    {
        $querySelector = [
            '1' => 'user-admin',
            '2' => 'user-pegawai'
        ];

        $role = $this->BM->getById('roles', $roleId);
        $tableOption = [
            'columns' => ['id', 'name', 'email'],
            'searchable' => ['name', 'email'],
            'delete_message' => [
                'name' => "Yakin ingin menghapus [name] pada data $role->display_name",
            ],
            'actions_url' => [
                'edit' => base_url('admin/users/[id]/edit'),
                'delete' => base_url('admin/users/[id]/delete')
            ],
            'actions' => 'lte/admin/actions/edit-delete',
            'querySelector' => $querySelector[$roleId]
        ];

        $users = $this->datatables->setDatatables(
            'users',
            $tableOption
        );

        json($users);
    }

    //@desc     show users create view
    //@route    GET admin/users/users/create
    public function create($roleId)
    {
        $roles = $this->BM->getWhere('roles', ['id' => $roleId]);
        $data = [
            'roles' => $roles->result(),
            'role' => $roles->row()
        ];
        $this->load->View('lte/admin/users/create', $data);
    }

    //@desc     users create action
    //@route    POST admin/users/add
    public function add()
    {
        $post = getPost();
        $post['password'] = password_hash($post['password'], PASSWORD_BCRYPT);
        $user = $this->User->create($post);
        if ($user) {
            response([
                'message' => 'Berhasil menambah data Pengguna',
            ]);
        }
    }

    //@desc     show users update view
    //@route    GET admin/users/:userId/edit
    public function edit($id)
    {
        $user = $this->BM->checkById('users', $id);
        $role = $this->BM->getById('roles', $user->role);
        $roles = $this->BM->getAll('roles')->result();
        $data = [
            'user' => $user,
            'role' => $role,
            'roles' => $roles
        ];
        $this->load->view('lte/admin/users/edit', $data);
    }

    //@desc     users update action
    //@route    POST admin/users/:userId/update
    public function update($id)
    {
        $post = getPost();
        $user = $this->User->update($id, $post, $validate = ['name', 'email']);
        if ($user) {
            response([
                'message' => 'Berhasil mengubah data Pengguna',
            ]);
        }
    }

    //@desc     users delete action
    //@route    GET admin/users/:userId/delete
    public function delete($id)
    {
        if ($id == $this->auth->userId) {
            response(['errors' => 'Tidak dapat menghapus diri sendiri']);
        } else {
            $this->BM->deleteById('users', $id);
            response($id);
        }
    }
}
