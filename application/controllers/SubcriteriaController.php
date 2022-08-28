<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SubcriteriaController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('BaseModel', 'BM');
        $this->load->library('Datatables', 'datatables');
        $this->load->helper('utility');
        $this->load->library('form_validation');
        $this->auth->logged();
        $this->validate = ['range_value', 'name', 'value', 'weight'];
    }

    public function subcriterias($critId)
    {
        $criteria = $this->BM->getById('criterias', $critId);
        $this->load->view('lte/admin/criterias/sub/subcriterias', ['criteria' => $criteria]);
    }

    public function subcriteriasTable($critId)
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
                'edit' => base_url('admin/subcriterias/[id]/edit'),
                'delete' => base_url('admin/subcriterias/[id]/delete')
            ],
            'actions' => 'lte/admin/actions/edit-delete-modal',
            'where' => ['criteria_id' => $critId]
        ];

        $subs = $this->datatables->setDatatables('subcriterias', $tableOption);
        json($subs);
    }

    public function create()
    {
        $this->load->view('lte/admin/criterias/sub/create');
    }

    public function loadSub($critId)
    {
        $this->load->view('lte/admin/criterias/sub/sub_table', ['critId' => $critId]);
    }

    public function add()
    {
        $post = fileGetContent();
        $data = [
            'criteria_id' => $post->critId,
            'range_value' => $post->range_value,
            'name' => $post->name,
            'value' => $post->value,
            'weight' => $post->weight
        ];

        if(!$this->checkRange($data)) {
            response(['status' => 'error', 'message' => 'Format Range atau Nilai tidak sesuai (Numeric Required)']);
        }

        $checkCrit = $this->BM->getWhere('subcriterias', ['criteria_id' => $post->critId])->row();
        if($checkCrit) {
            if(count(explode("-", $checkCrit->range_value)) > 1) {
                if(count(explode("-", $post->range_value)) <= 1) {
                    response(['status' => 'error', 'message' => 'Format Range sama dengan format yang sudah ada']);
                }
            }
        }

        $checkName = $this->BM->getWhere('subcriterias', ['name' => $post->name, 'criteria_id' => $post->critId])->row();
        if($checkName) {
            response(['status' => 'error', 'message' => 'Nama subcriteria sudah digunakan']);
        }

        $this->BM->create('subcriterias', $data);
        response(['status' => 'success', 'message' => 'Berhasil menambah subkriteria']);
    }

    public function edit($id)
    {
        $subcriteria = $this->BM->getById('subcriterias', $id);
        $this->load->view('lte/admin/criterias/sub/edit', ['subcriteria' => $subcriteria]);
    }

    public function update($id)
    {
        $post = fileGetContent();
        $subcriteria = $this->BM->getById('subcriterias', $id);
        if($subcriteria->name !== $post->name) {
            $checkName = $this->BM->getWhere('subcriterias', ['name' => $post->name, 'criteria_id' => $subcriteria->criteria_id])->row();
            if($checkName) {
                response(['status' => 'success', 'message' => 'Nama subkriteria sudah digunakan']);
            }
        }

        $data = [
            'range_value' => $post->range_value,
            'name' => $post->name,
            'value' => $post->value,
            'weight' => $post->weight
        ];

        if(!$this->checkRange($data)) {
            response(['status' => 'error', 'message' => 'Format Range atau Nilai tidak sesuai (Numeric Required)']);
        }

        $checkCrit = $this->BM->getWhere('subcriterias', ['criteria_id' => $subcriteria->criteria_id, 'id !=' => $id])->row();
        if($checkCrit) {
            if(count(explode("-", $checkCrit->range_value)) > 1) {
                if(count(explode("-", $post->range_value)) <= 1) {
                    response(['status' => 'error', 'message' => 'Format Range sama dengan format yang sudah ada']);
                }
            }
        }

        $this->BM->updateById('subcriterias', $id, $data);
        response(['status' => 'success', 'message' => 'Berhasil update data subkriteria']);
    }


    public function delete($id)
    {
        $isUsed = $this->BM->getWhere('alt_criteria', ['subcriteria_id' => $id]);
        if($isUsed) {
            response(['errors' => 'Subkriteria sudah digunakan']);
        } else {
            $this->BM->deleteById('subcriterias', $id);
            response($id);
        }
    }

    public function checkRange($data)
    {
        $range = $data['range_value'];
        $value = $data['value'];
        $isValid = true;

        $expRange = explode("-", $range);
        if(count($expRange) > 1) {
            $val1 = $expRange[0];
            $val2 = $expRange[1];

            if(!is_numeric($val1) ||!is_numeric($val2)) {
                $isValid = false;
            }
        } else {
            if(!is_numeric($range)) {
                $isValid = false;
            }
        }

        if(!is_numeric($value)) {
            $isValid = false;
        }

        return $isValid;
    }
}