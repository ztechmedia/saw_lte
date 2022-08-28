<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ResultController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('BaseModel', 'BM');
        $this->load->model('BaseModel', 'BM');
        $this->load->library('Datatables', 'datatables');
        $this->load->helper('utility');
        $this->auth->logged();
    }

    public function results()
    {
        $altsList = [];
        $critName = [];
        $alts = $this->BM->getAll('alternatives')->result();
        $totalCriteria = $this->BM->getTotalData('criterias');
        $error = false;

        foreach ($alts as $alt) {
            $altChilds = $this->db->select('a.*, b.name AS sub_name, b.weight AS sub_value, c.name AS crit_name, c.weight AS crit_normal_value, c.percent AS crit_percent_value, c.type AS crit_type')
                ->from('alt_criteria a')
                ->join('subcriterias b', 'a.subcriteria_id = b.id')
                ->join('criterias c', 'a.criteria_code = c.code')
                ->where('a.alt_id', $alt->id)
                ->get()
                ->result();
            $altsList[$alt->id]['name'] = $alt->name;
            $altTotalCriteria = 0;
            foreach ($altChilds as $child) {
                $altTotalCriteria++;
                $critName[$child->criteria_code] = [
                    'crit_name' => $child->crit_name,
                    'crit_normal_value' => $child->crit_normal_value,
                    'crit_percent_value' => $child->crit_percent_value,
                    'crit_type' => $child->crit_type,
                ];

                $altsList[$alt->id][$child->criteria_code] = [
                    'sub_name' => $child->sub_name,
                    'sub_value' => $child->sub_value,
                ];
            }

            if ($totalCriteria !== $altTotalCriteria) {
                $error = true;
            }
        }

        if ($error) {
            $this->load->view('lte/admin/results/criteria_error');
        } else {
            $typeCode = [];
            $i = 1;
            foreach ($critName as $key => $value) {
                $typeCode[$key] = $i;
                $i++;
            }

            $invertMatrix = [];
            foreach ($altsList as $key => $value) {
                foreach ($value as $key => $sValue) {
                    if (array_key_exists($key, $typeCode)) {
                        $invertMatrix[$typeCode[$key]][] = [
                            'crit_code' => $key,
                            'sub_value' => $sValue['sub_value'],
                        ];
                    }
                }
            }

            $i = 0;
            $firsProcAlt = [];
            foreach ($alts as $alt) {
                $firsProcAlt[$alt->id]['name'] = $alt->name;
                foreach ($invertMatrix as $key => $value) {
                    $newValue = [];
                    foreach ($value as $key => $vValue) {
                        $newValue[] = $vValue['sub_value'];
                    }

                    if ($critName[$value[$i]['crit_code']]['crit_type'] === 'Benefit') {
                        $firsProcAlt[$alt->id][] = [
                            'normal_value' => $value[$i]['sub_value'] / max($newValue),
                            'processed_value' => $critName[$value[$i]['crit_code']]['crit_percent_value'] * ($value[$i]['sub_value'] / max($newValue)),
                        ];
                    } else if ($critName[$value[$i]['crit_code']]['crit_type'] === 'Cost') {
                        $firsProcAlt[$alt->id][] = [
                            'normal_value' => min($newValue) / $value[$i]['sub_value'],
                            'processed_value' => $critName[$value[$i]['crit_code']]['crit_percent_value'] * (min($newValue) / $value[$i]['sub_value']),
                        ];
                    }
                }
                $i++;
            }

            $data = [
                'alts' => $altsList,
                'criterias' => $critName,
                'firsProcAlt' => $firsProcAlt,
            ];

            $this->load->view('lte/admin/results/results', $data);
        }

    }

    public function printResults()
    {
        $altsList = [];
        $critName = [];
        $alts = $this->BM->getAll('alternatives')->result();
        $totalCriteria = $this->BM->getTotalData('criterias');
        $error = false;

        foreach ($alts as $alt) {
            $altChilds = $this->db->select('a.*, b.name AS sub_name, b.weight AS sub_value, c.name AS crit_name, c.weight AS crit_normal_value, c.percent AS crit_percent_value, c.type AS crit_type')
                ->from('alt_criteria a')
                ->join('subcriterias b', 'a.subcriteria_id = b.id')
                ->join('criterias c', 'a.criteria_code = c.code')
                ->where('a.alt_id', $alt->id)
                ->get()
                ->result();
            $altsList[$alt->id]['name'] = $alt->name;
            $altTotalCriteria = 0;
            foreach ($altChilds as $child) {
                $altTotalCriteria++;
                $critName[$child->criteria_code] = [
                    'crit_name' => $child->crit_name,
                    'crit_normal_value' => $child->crit_normal_value,
                    'crit_percent_value' => $child->crit_percent_value,
                    'crit_type' => $child->crit_type,
                ];

                $altsList[$alt->id][$child->criteria_code] = [
                    'sub_name' => $child->sub_name,
                    'sub_value' => $child->sub_value,
                ];
            }

            if ($totalCriteria !== $altTotalCriteria) {
                $error = true;
            }
        }

        if ($error) {
            $this->load->view('lte/admin/results/criteria_error');
        } else {
            $typeCode = [];
            $i = 1;
            foreach ($critName as $key => $value) {
                $typeCode[$key] = $i;
                $i++;
            }

            $invertMatrix = [];
            foreach ($altsList as $key => $value) {
                foreach ($value as $key => $sValue) {
                    if (array_key_exists($key, $typeCode)) {
                        $invertMatrix[$typeCode[$key]][] = [
                            'crit_code' => $key,
                            'sub_value' => $sValue['sub_value'],
                        ];
                    }
                }
            }

            $i = 0;
            $firsProcAlt = [];
            foreach ($alts as $alt) {
                $firsProcAlt[$alt->id]['name'] = $alt->name;
                foreach ($invertMatrix as $key => $value) {
                    $newValue = [];
                    foreach ($value as $key => $vValue) {
                        $newValue[] = $vValue['sub_value'];
                    }

                    if ($critName[$value[$i]['crit_code']]['crit_type'] === 'Benefit') {
                        $firsProcAlt[$alt->id][] = [
                            'normal_value' => $value[$i]['sub_value'] / max($newValue),
                            'processed_value' => $critName[$value[$i]['crit_code']]['crit_percent_value'] * ($value[$i]['sub_value'] / max($newValue)),
                        ];
                    } else if ($critName[$value[$i]['crit_code']]['crit_type'] === 'Cost') {
                        $firsProcAlt[$alt->id][] = [
                            'normal_value' => min($newValue) / $value[$i]['sub_value'],
                            'processed_value' => $critName[$value[$i]['crit_code']]['crit_percent_value'] * (min($newValue) / $value[$i]['sub_value']),
                        ];
                    }
                }
                $i++;
            }

            $data = [
                'alts' => $altsList,
                'criterias' => $critName,
                'firsProcAlt' => $firsProcAlt,
            ];

            $this->load->library('fpdf');   
            $this->load->view('lte/admin/results/print_results', $data);
        }
    }

}
