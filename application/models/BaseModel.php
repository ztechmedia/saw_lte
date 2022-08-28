<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BaseModel extends CI_Model
{
    public function getAll($table)
    {
        return $this->db->get($table);
    }

    public function getLike($table, $column, $value)
    {
        $this->db->like($column, $value);
        return $this->db->get($table);
    }

    public function getFirst($table)
    {
        $this->db->limit(1, 0);
        $this->db->order_by('created_at', 'asc');
        return $this->db->get($table)->row();
    }

    public function getOne($table, $column, $id)
    {
        $this->db->limit(1, 0);
        $this->db->where($column, $id);
        return $this->db->get($table)->row();
    }

    public function getTotalData($table)
    {
        return $this->db->count_all($table);
    }

    public function getTotalDataWhere($table, $column, $value)
    {
        $this->db->where($column, $value);
        return $this->db->count_all_results($table);
    }

    public function getWhere($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    public function whereIn($table, $column, $data)
    {
        $this->db->where_in($column, $data);
        return $this->db->get($table);
    }

    public function getById($table, $id)
    {
        return $this->db->get_where($table, array('id' => $id))->row();
    }

    public function create($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function createMultiple($table, $data)
    {
        return $this->db->insert_batch($table, $data);
    }

    public function updateById($table, $id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update($table, $data);
        return $this->db->get_where($table, ['id' => $id])->row();
    }

    public function update($table, $data, $where)
    {
        foreach ($where as $column => $value) {
            $this->db->where($column, $value);
        }
        return $this->db->update($table, $data);
    }

    public function updateMultiple($table, $data, $column)
    {
        return $this->db->update_batch($table, $data, $column);
    }

    public function deleteById($table, $id)
    {
        return $this->db->delete($table, array('id' => $id));
    }

    public function delete($table, $where)
    {
        return $this->db->delete($table, $where);
    }

    public function deleteMultiple($table, $column, $id)
    {
        $this->db->where_in($column, $id);
        return $this->db->delete($table) ? true : false;
    }

    public function deleteMultipleColumn($table, $single, $array)
    {
        if (count($single) > 0) {
            foreach ($single as $skey => $sval) {
                $this->db->where($skey, $sval);
            }
        }

        if (count($array) > 0) {
            foreach ($array as $akey => $aval) {
                $this->db->where_in($akey, $aval);
            }
        }

        return $this->db->delete($table);
    }

    public function checkById($table, $id)
    {
        $query = $this->db->get_where($table, ['id' => $id])->result();
        if (!$query) {
            $data['message'] = 'ID: $id tidak ditemukan';
            $this->load->view('errors/custom/resource_not_found', $data);
            die();
        } else {
            return $query[0];
        }
    }

    public function truncate($table)
    {
        return $this->db->truncate($table);
    }

    public function getMaxValue($table, $column, $where = [])
    {

        return count($where) > 0
        ? $this->db
            ->select_max($column)
            ->from($table)
            ->where($where)
            ->get()
            ->row()
            ->$column
        : $this->db
            ->select_max($column)
            ->from($table)
            ->get()
            ->row()
            ->$column;
    }

    public function getMinValue($table, $column, $where = [])
    {
        return count($where) > 0
        ? $this->db
            ->select_min($column)
            ->from($table)
            ->where($where)
            ->get()
            ->row()
            ->$column
        : $this->db
            ->select_min($column)
            ->from($table)
            ->get()
            ->row()
            ->$column;
    }

    public function getLast($table)
    {
        return $this->db
            ->select('*')
            ->order_by('id', "desc")
            ->limit(1)
            ->get($table)
            ->row();
    }
}
