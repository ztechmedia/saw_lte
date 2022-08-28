<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->library("Search", "search");
        $this->load->helper("utility");
        $this->auth->logged();
    }

    public function dashboard()
    {
        $this->load->view('lte/admin/dashboard/dashboard');
    }

    public function logs()
    {
        $data = $this->search->advanceSearch(
            //params
            $_GET,
            //table
            "logs",
            //column to show
            "ip, os, browser, browser_version, email, login_date",
            //order by
            $order_by = [
                "login_date" => "desc",
            ]
        );

        $this->load->view('lte/admin/dashboard/logs', $data);
    }
}