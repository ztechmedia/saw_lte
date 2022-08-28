<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DatatablesModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel', 'User');
    }

    public function totalDocument($table, $querySelector, $where)
    {
        if ($querySelector) {
            return $this->querySelector($querySelector)->count_all_results();
        } else {
            if($where) {
                foreach ($where as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            return $this->db->count_all_results($table);
        }
    }

    public function getAll($table, $limit, $start, $col, $dir, $querySelector, $where)
    {
        if ($querySelector) {
            return $this->querySelector($querySelector)
            ->limit($limit, $start)
            ->order_by($col, $dir)
            ->get()
            ->result();
        } else {
            if($where) {
                foreach ($where as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            return $this->db->limit($limit, $start)->order_by($col, $dir)->get($table)->result();
        }

    }

    public function dataSearch($table, $limit, $start, $search, $col, $dir, $searchAble, $querySelector, $where)
    {
        $like = 0;
        $query = $querySelector
            ? $this->querySelector($querySelector)
            : $this->db->select('*')->from($table);

        foreach ($searchAble as $sc) {
            if ($like === 0) {
                $query->like($sc, $search);
            } else {
                $query->or_like($sc, $search);
            }
            $like++;
        }

        if($where) {
            foreach ($where as $key => $value) {
                $query->where($key, $value);
            }
        }

        return $query->limit($limit, $start)->order_by($col, $dir)->get()->result();
    }

    public function dataSearchCount($table, $search, $searchAble, $querySelector, $where)
    {
        $like = 0;
        $query = $querySelector
            ? $this->querySelector($querySelector)
            : $this->db->select('*')->from($table);

        foreach ($searchAble as $sc) {
            if ($like === 0) {
                $query->like($sc, $search);
            } else {
                $query->or_like($sc, $search);
            }
            $like++;
        }

        if($where) {
            foreach ($where as $key => $value) {
                $query->where($key, $value);
            }
        }

        return $query->get()->result();
    }

    public function querySelector($type)
    {
        switch ($type) {
            case 'user-admin':
                return $this->User->users(['role' => 1]);
            case 'user-pegawai':
                return $this->User->users(['role' => 2]);
        }
    }
}
