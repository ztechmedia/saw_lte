<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CriteriaController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('BaseModel', 'BM');
        $this->load->library('Datatables', 'datatables');
        $this->load->helper('utility');
        $this->load->library('form_validation');
        $this->auth->logged();
        $this->validate = ['code', 'name', 'weight', 'type'];
    }

    public function criterias()
    {
        $this->load->view('lte/admin/criterias/criterias');
    }

    public function criteriaTable()
    {
        $columns = $this->validate;
        $columns[] = 'id';
        $tableOption = [
            'columns' => $columns,
            'searchable' => $this->validate,
            'delete_message' => [
                'name' => "Yakin ingin menghapus [name]",
            ],
            'actions_url' => [
                'edit' => base_url('admin/criterias/[id]/edit'),
                'delete' => base_url('admin/criterias/[id]/delete'),
                'id' => null
            ],
            'actions' => 'lte/admin/actions/edit-delete-sub'
        ];

        $users = $this->datatables->setDatatables('criterias', $tableOption);
        json($users);
    }

    public function create()
    {
        $this->load->View('lte/admin/criterias/create');
    }

    public function add()
    {
        if($this->validator($this->validate)) {
            $post = getPost();
            $post['percent'] = $post['weight'] > 0 ? $post['weight'] / 100 : 0;
            $criteria = $this->BM->create('criterias', $post);
            if ($criteria) {
                response([
                    'message' => 'Berhasil menambah data kriteria',
                ]);
            }
        }
    }

    public function edit($id)
    {
        $criteria = $this->BM->checkById('criterias', $id);
        $this->load->view('lte/admin/criterias/edit', ['criteria' => $criteria]);
    }

    public function update($id)
    {
        if($this->validator($this->validate, $id)) {
            $post = getPost();
            $post['percent'] = $post['weight'] > 0 ? $post['weight'] / 100 : 0;
            $criteria = $this->BM->updateById('criterias', $id, $post);
            if ($criteria) {
                response([
                    'message' => 'Berhasil mengubah data kriteria',
                ]);
            }
        }
    }

    public function delete($id)
    {
        $code = $this->BM->getById('criterias', $id)->code;
        $isUsed = $this->BM->getWhere('alt_criteria', ['criteria_code' => $code])->row();
        if($isUsed) {
            response(['errors' => 'Kriteria sudah digunakan']);
        } else {
            $this->BM->deleteById('criterias', $id);
            response($id);
        }
    }

    public function validator($validate, $id = null)
    {
        $isUnique = $id ? "criterias.code.$id" : 'criterias.code';

        $rules = [
            'code' => [
                'field' => 'code',
                'rules' => "required|isUnique[$isUnique]",
                'errors' => [
                    'required' => '* Kode tidak boleh kosong',
                    'isUnique' => 'Kode sudah digunakan'
                ],
            ],
            'name' => [
                'field' => 'name',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Nama kriteria tidak boleh kosong',
                ],
            ],
            'weight' => [
                'field' => 'weight',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Bobot tidak boleh kosong',
                ],
            ], 
            'type' => [
                'field' => 'type',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Tipe kriteria tidak boleh kosong',
                ],
            ]        
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
}