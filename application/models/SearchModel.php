<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SearchModel extends CI_Model
{
    public function getTotal($params, $table)
    {
        $like = 0;
        foreach ($params as $field => $value) {
            $field = str_replace('a_', 'a.', $field);
            $fieldExp = explode(":", $field);
            if (count($fieldExp) > 1) {
                if ($fieldExp[0] == "like") {
                    if ($like == 0) {
                        if ($value) {
                            $this->db->like($fieldExp[1], $value);
                            $like++;
                        }
                    } else {
                        if ($value) {
                            $this->db->or_like($fieldExp[1], $value);
                        }
                    }
                } else if ($fieldExp[0] == "where_in") {
                    $val2 = explode(",", $value);
                    if (count($val2) > 1) {
                        $this->db->where_in($fieldExp[1], $val2);
                    } else {
                        $this->db->where($fieldExp[1], $value);
                    }
                } else if ($fieldExp[0] == "gt") {
                    $this->db->where("$fieldExp[1] >", $value);
                } else if ($fieldExp[0] == "not") {
                    $this->db->where("$fieldExp[1] !=", $value);
                }
            } else {
                if ($value) {
                    $this->db->where($field, $value);
                }
            }
        }
        return $this->db->count_all_results($table);
    }

    public function getLimit($select, $params, $table, $limit, $startIndex, $order_by, $group_by)
    {
        $this->db->select($select);

        $like = 0;
        foreach ($params as $field => $value) {
            
            $fieldExp = explode(":", $field);
            if (count($fieldExp) > 1) {
                if ($fieldExp[0] == "like") {
                    if ($like == 0) {
                        if ($value) {
                            $this->db->like($fieldExp[1], $value);
                            $like++;
                        }
                    } else {
                        if ($value) {
                            $this->db->or_like($fieldExp[1], $value);
                        }
                    }
                } else if ($fieldExp[0] == "where_in") {
                    $val2 = explode(",", $value);
                    if (count($val2) > 1) {
                        $this->db->where_in($fieldExp[1], $val2);
                    } else {
                        $this->db->where($fieldExp[1], $value);
                    }
                } else if ($fieldExp[0] == "gt") {
                    $this->db->where("$fieldExp[1] >", $value);
                } else if ($fieldExp[0] == "not") {
                    $this->db->where("$fieldExp[1] !=", $value);
                }
            } else {
                if ($value) {
                    $this->db->where($field, $value);
                }
            }
            
        }

        foreach ($order_by as $field => $value) {
            $this->db->order_by($field, $value);
        }

        if($group_by) {
            $this->db->group_by($group_by);
        }

        $this->db->limit($limit, $startIndex);
        return $this->db->get($table)->result();
    }

    public function getLimitJoin($select, $params, $table1, $table2, $key, $limit, $startIndex, $order_by, $group_by)
    {
        $this->db->select($select);
        $this->db->from($table1);
        $this->db->join($table2, $key);

        $like = 0;
        foreach ($params as $field => $value) {
            $field = str_replace('a_', 'a.', $field);
            $fieldExp = explode(":", $field);
            if (count($fieldExp) > 1) {
                if ($fieldExp[0] == "like") {
                    if ($like == 0) {
                        if ($value) {
                            $this->db->like($fieldExp[1], $value);
                            $like++;
                        }
                    } else {
                        if ($value) {
                            $this->db->or_like($fieldExp[1], $value);
                        }
                    }
                } else if ($fieldExp[0] == "where_in") {
                    $val2 = explode(",", $value);
                    if (count($val2) > 1) {
                        $this->db->where_in($fieldExp[1], $val2);
                    } else {
                        $this->db->where($fieldExp[1], $value);
                    }
                } else if ($fieldExp[0] == "gt") {
                    $this->db->where("$fieldExp[1] >", $value);
                } else if ($fieldExp[0] == "not") {
                    $this->db->where("$fieldExp[1] !=", $value);
                }
            } else {
                if ($value) {
                    $this->db->where($field, $value);
                }
            }
            
        }

        foreach ($order_by as $field => $value) {
            $this->db->order_by($field, $value);
        }

        if($group_by) {
            $this->db->group_by($group_by);
        }

        $this->db->limit($limit, $startIndex);
        return $this->db->get()->result();
    }
}