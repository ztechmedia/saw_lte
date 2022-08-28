<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Search
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    public function advanceSearch($params, $table, $select, $order_by, $group_by = null)
    {
        $this->ci->load->model("SearchModel", "Search");
        $limit = isset($params['limit']) ? htmlspecialchars($params['limit'], ENT_QUOTES, 'UTF-8') : 250;
        $page = isset($params['page']) ? htmlspecialchars($params['page'], ENT_QUOTES, 'UTF-8') : 1;

        unset($params["limit"]);
        unset($params["page"]);

        $totalRecords = $this->ci->Search->getTotal($params, $table);
        $startIndex = ($page - 1) * $limit;
        $endIndex = $page * $limit;
        $pagination = [];

        if ($totalRecords > 0) {

            if ($endIndex < $totalRecords) {
                $pagination["next"] = [
                    "page" => $page + 1,
                ];
            }

            if ($startIndex > 0) {
                $pagination['prev'] = [
                    "page" => $page - 1,
                ];
            }
            $items = $this->ci->Search->getLimit($select, $params, $table, $limit, $startIndex, $order_by, $group_by);
        } else {
            $items = [];
        }

        $data['total'] = $totalRecords;
        $data['pagination'] = $pagination;
        $data['page'] = $page;
        $data["totalRecords"] = $totalRecords;
        $data["totalPage"] = ceil($totalRecords / $limit);
        $data['start'] = $startIndex + 1;
        $data['end'] = $startIndex + count($items);
        $data["items"] = $items;

        return $data;
    }

    public function advanceSearchJoin($params, $table1, $table2, $key, $select, $order_by, $group_by = null)
    {
        $this->ci->load->model("SearchModel", "Search");
        $limit = isset($params['limit']) ? htmlspecialchars($params['limit'], ENT_QUOTES, 'UTF-8') : 250;
        $page = isset($params['page']) ? htmlspecialchars($params['page'], ENT_QUOTES, 'UTF-8') : 1;

        unset($params["limit"]);
        unset($params["page"]);

        $totalRecords = $this->ci->Search->getTotal($params, $table1);
        $startIndex = ($page - 1) * $limit;
        $endIndex = $page * $limit;
        $pagination = [];

        if ($totalRecords > 0) {

            if ($endIndex < $totalRecords) {
                $pagination["next"] = [
                    "page" => $page + 1,
                ];
            }

            if ($startIndex > 0) {
                $pagination['prev'] = [
                    "page" => $page - 1,
                ];
            }
            $items = $this->ci->Search->getLimitJoin($select, $params, $table1, $table2, $key, $limit, $startIndex, $order_by, $group_by);
        } else {
            $items = [];
        }

        $data['total'] = $totalRecords;
        $data['pagination'] = $pagination;
        $data['page'] = $page;
        $data["totalRecords"] = $totalRecords;
        $data["totalPage"] = ceil($totalRecords / $limit);
        $data['start'] = $startIndex + 1;
        $data['end'] = $startIndex + count($items);
        $data["items"] = $items;

        return $data;
    }
}
