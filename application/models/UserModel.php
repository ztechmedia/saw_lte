<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        //load dependencise
        $this->load->model('BaseModel', 'BM');
        $this->load->library('form_validation');
        $this->load->helper('utility');
        //local variabel
        $this->validate = ['name', 'email', 'password', 'confirm', 'role'];
        $this->table = 'users';
    }

    public function create($data, $validate = [])
    {
        $validator = $this->validator($validate ? $validate : $this->validate);
        if ($validator) {
            unset($data['confirm']);
            return $this->BM->create($this->table, $data);
        }
    }

    public function update($id, $data, $validate = [])
    {
        $validator = $this->validator($validate ? $validate : $this->validate, $id);
        if ($validator) {
            return $this->BM->updateById($this->table, $id, $data);
        }
    }

    public function validator($validate, $id = null)
    {
        $isUnique = $id ? "users.email.$id" : 'users.email';

        $rules = [
            'name' => [
                'field' => 'name',
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Nama tidak boleh kosong',
                ],
            ],
            'email' => [
                'field' => 'email',
                'label' => 'Email',
                'rules' => "required|trim|isUnique[$isUnique]|valid_email",
                'errors' => [
                    'required' => '* Email tidak boleh kosong',
                    'isUnique' => 'Email sudah digunakan',
                    'valid_email' => 'Format email tidak valide'
                ],
            ],
            'password' => [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Password tidak boleh kosong',
                ],
            ],
            'confirm' => [
                'field' => 'confirm',
                'label' => 'Confirm',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '* Password konfirmasi tidak boleh kosong',
                    'matches' => 'Password konfirmasi tidak cocok',
                ],
            ],
            'role' => [
                'field' => 'role',
                'label' => 'Role',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Level user tidak boleh kosong',
                ],
            ],
        ];

        $filterRules = [];

        foreach ($validate as $v) {
            $filterRules[] = $rules[$v];
        }

        $this->form_validation->set_rules($filterRules);
        if(!$this->form_validation->run()){
            response(['errors' => $this->form_validation->error_array()]);
            return false;
        } else {
            return true;
        }
    }

    public function users($where)
    {
        return $this->db->select('*')->from('users')->where($where);
    }
}