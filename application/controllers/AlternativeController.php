<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AlternativeController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('BaseModel', 'BM');
        $this->load->library('Datatables', 'datatables');
        $this->load->helper('utility');
        $this->load->library('form_validation');
        $this->auth->logged();
        $this->validate = ['code', 'name'];
    }

    public function alternatives()
    {
        $this->load->view('lte/admin/alternatives/alternatives');
    }

    public function altTable()
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
                'edit' => base_url('admin/alternatives/[id]/edit'),
                'delete' => base_url('admin/alternatives/[id]/delete')
            ],
            'actions' => 'lte/admin/actions/edit-delete'
        ];

        $users = $this->datatables->setDatatables('alternatives', $tableOption);
        json($users);
    }

    public function create()
    {
        $critList = [];
        $criterias = $this->BM->getAll('criterias')->result();

        foreach ($criterias as $criteria) {
            $subList = [];
            $subcriterias = $this->BM->getWhere('subcriterias', ['criteria_id' => $criteria->id])->result();
            foreach ($subcriterias as $sub) {
                $range = explode("-", $sub->range_value);
                if(count($range) > 1) {
                    $subList['left'][] = intval($range[0]);
                    $subList['right'][] = intval($range[1]);
                } else {
                    $subList['left'][] = intval($sub->range_value);
                    $subList['right'][] = intval($sub->range_value);
                }
            }
            
            $min = min($subList['left']);
            $max = max($subList['right']);

            $newMin = is_array($min) ? reset($min) : $min;
            $newMax = is_array($max) ? reset($max) : $max;

            $number = [];
            for ($i=$newMin; $i <= $newMax; $i++) { 
                $number[] = intval($i);
            }
            
            $critList[] = [
                'code' => $criteria->code,
                'name' => $criteria->name,
                'subcriterias' => $number
            ];
        }
        $this->load->View('lte/admin/alternatives/create', ['criterias' => $critList]);
    }

    public function add()
    {
        if($this->validator($this->validate)) {
            $post = getPost();
            
            $data = [
                'code' => $post['code'],
                'name' => $post['name']
            ];

            unset($post['code']);
            unset($post['name']);

            $altId = $this->BM->create('alternatives', $data);

            $altCrit = [];
            foreach ($post as $key => $value) {
                $critId = $this->BM->getWhere('criterias', ['code' => $key])->row()->id;

                $subcriterias = $this->BM->getWhere('subcriterias', ['criteria_id' => $critId])->result();

                $subId = 0;
                foreach ($subcriterias as $sub) {
                    $range = explode("-", $sub->range_value);
                    if(count($range) > 1) {
                        $left = $range[0];
                        $right = $range[1];

                        for ($i=$left; $i <= $right; $i++) { 
                            if($i == $value && $subId == 0) {
                                $subId = $sub->id;
                            }
                        }
                    } else {
                        if($sub->range_value == $value && $subId == 0) {
                            $subId = $sub->id;
                        }
                    }
                }

                $altCrit[] = [
                    'alt_id' => $altId,
                    'criteria_code' => $key,
                    'subcriteria_id' => $subId,
                    'value' => $value
                ];
            }

            $insertCrits = $this->BM->createMultiple('alt_criteria', $altCrit);
            if ($insertCrits) {
                response([
                    'message' => 'Berhasil menambah data alternatif',
                ]);
            }
        }
    }

    public function edit($id)
    {
        $critList = [];
        $criterias = $this->BM->getAll('criterias')->result();
        foreach ($criterias as $criteria) {
            $subList = [];
            $subcriterias = $this->BM->getWhere('subcriterias', ['criteria_id' => $criteria->id])->result();
            foreach ($subcriterias as $sub) {
                $subList[] = [
                    'id' => $sub->id,
                    'name' => $sub->name,
                    'weight' => $sub->weight
                ];
            }
            $critList[] = [
                'code' => $criteria->code,
                'name' => $criteria->name,
                'weight' => $criteria->weight,
                'subcriterias' => $subList
            ];
        }
        $alt = $this->BM->checkById('alternatives', $id);
        $altCriterias = $this->BM->getWhere('alt_criteria', ['alt_id' => $id])->result();
        $ownCriterias = [];
        foreach ($altCriterias as $crit) {
            $ownCriterias[$crit->criteria_code] = $crit->subcriteria_id;
        }
        $this->load->view('lte/admin/alternatives/edit', ['alt' => $alt, 'criterias' => $critList, 'ownCriterias' => $ownCriterias]);
    }

    public function update($id)
    {
        if($this->validator($this->validate)) {
            $post = getPost();
            $data = [
                'code' => $post['code'],
                'name' => $post['name'],
            ];

            unset($post['code']);
            unset($post['name']);
           
            foreach ($post as $key => $value) {
                $check = $this->BM->getWhere('alt_criteria', ['alt_id' => $id, 'criteria_code' => $key])->row();
                if($check) {
                    $this->BM->update('alt_criteria', ['subcriteria_id' => $value], [
                        'alt_id' => $id,
                        'criteria_code' => $key
                    ]);
                } else {
                    $this->BM->create('alt_criteria', ['alt_id' => $id, 'criteria_code' => $key, 'subcriteria_id' => $value]);
                }
            }

            $alt = $this->BM->updateById('alternatives', $id, $data);
            if ($alt) {
                response([
                    'message' => 'Berhasil mengubah data alternatif',
                ]);
            }
        }
    }

    public function delete($id)
    {
        $this->BM->deleteById('alternatives', $id);
        response($id);
    }

    public function validator($validate)
    {
        $rules = [
            'code' => [
                'field' => 'code',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Kode Cabang tidak boleh kosong',
                ],
            ],
            'name' => [
                'field' => 'name',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Nama Cabang tidak boleh kosong',
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
}