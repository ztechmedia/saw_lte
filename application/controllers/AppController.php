<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AppController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('BaseModel', 'BM');
        $this->load->library('user_agent', 'agent');
        $this->load->helper('utility');
        $this->auth->logged();
    }

    public function index()
    {
        $data['browser'] = $this->agent->browser();
        $data['browser_version'] = $this->agent->version();
        $data['os'] = $this->agent->platform();
        $data['ip'] = $this->input->ip_address();
        $this->load->view('template/lte/admin/app', $data);
    }

    public function pageNotFound()
    {
        $this->load->view('errors/custom/page_not_found');
    }

    public function logout()
    {
        $this->session->unset_userdata(SESSION_KEY);
        response([
            'success' => true,
            'redirect' => base_url('login'),
        ]);
    }

    public function resetForm()
    {
        $this->load->view('lte/admin/reset');
    }

    public function reset()
    {
        $post = getPost();

        if($post['code'] !== RESET_SECRET_KEY) {
            response(['errors' => ['code' => 'Kode reset salah']]);
        }

        $this->BM->truncate("logs");
        $this->BM->truncate("alternatives");
        $this->BM->truncate("alt_criteria");

        response(['message' => 'Reset berhasil']);
    }
}
