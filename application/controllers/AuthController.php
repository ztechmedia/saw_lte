<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('BaseModel', 'BM');
        $this->load->library('user_agent', 'agent');
        $this->load->helper('utility');
        $this->load->library("Sendmail", "sendmail");
        $this->auth->auth();
    }

    public function login()
    {
        $data['view'] = 'lte/auth/login';
        $this->load->view('template/lte/auth/app', $data);
    }

    public function authLogin()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        if (strlen($email) <= 0) {
            response(['errors' => ['email' => 'Email tidak boleh kosong']]);
        }

        if (strlen($password) <= 0) {
            response(['errors' => ['password' => 'Password tidak boleh kosong']]);
        }

        $user = $this->BM->getWhere('users', ['email' => $email])->row();
        if (!$user) {
            response(['errors' => [
                'email' => 'Email tidak terdaftar',
            ]]);
        }

        if (!password_verify($password, $user->password)) {
            response(['errors' => [
                'password' => 'Password tidak cocok',
            ]]);
        }

        $role = $this->BM->getById('roles', $user->role);

        $session = array(
            'userId' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $role->display_name,
            'role_id' => $role->id,
        );

        $logsData['browser'] = $this->agent->browser();
        $logsData['browser_version'] = $this->agent->version();
        $logsData['os'] = $this->agent->platform();
        $logsData['ip'] = $this->input->ip_address();
        $logsData['email'] = $user->email;
        $logsData['login_date'] = date('Y-m-d H:i:s');

        $this->BM->create('logs', $logsData);

        $this->session->set_userdata(SESSION_KEY, $session);
        response([
            'success' => true,
            'type' => 'login',
            'redirect' => base_url('admin'),
            'currentUrl' => base_url('admin/dashboard'),
        ]);
    }

    public function forgotPassword()
    {
        $data['view'] = 'lte/auth/forgot-password';
        $this->load->view('template/lte/auth/app', $data);
    }

    public function sendLinkForgot()
    {
        $email = $this->input->post('email');
        if (strlen($email) <= 0) {
            response(['errors' => ['email' => 'Email masih kosong']]);
        }

        $user = $this->BM->getWhere('users', ['email' => $email])->row();
        if (!$user) {
            response(['errors' => ['email' => 'Email tidak terdaftar']]);
        }

        $token = genUnique(62);
        $link = base_url("reset-password/$token");
        $sendEmail = $this->sendmail->send('Reset Password', $link, $email);
        if ($sendEmail) {
            $data['token_password'] = $token;
            $updateEmail = $this->BM->updateById('users', $user->id, $data);
            if ($updateEmail) {
                response([
                    'success' => true,
                    'type' => 'send-link-forgot',
                    'message' => "Berhasil mengirim link reset password kepada $email",
                    'redirect' => base_url('login'),
                ]);
            }
        } else {
            response(['errors' => ['email' => $sendEmail]]);
        }
    }

    public function resetPassword($token_password)
    {
        $user = $this->BM->getWhere('users', ['token_password' => $token_password])->row();
        if (!$user) {
            $data['message'] = "$token_password tidak ada di database kami";
            $this->load->view('errors/custom/page_not_found', $data);
        } else {
            $data['token_password'] = $token_password;
            $data['view'] = 'lte/auth/reset-password';
            $this->load->view('template/lte/auth/app', $data);
        }
    }

    public function reset($token_password)
    {
        $password = $this->input->post('password');
        $confirm = $this->input->post('confirm');

        $user = $this->BM->getWhere('users', ['token_password' => $token_password])->row();

        if (!$user) {
            response(['errors' => ['token' => 'Invalid TOKEN']]);
        }

        if (strlen($password) <= 0) {
            response(['errors' => ['password' => 'Password masih kosong']]);
        }

        if (strlen($confirm) <= 0) {
            response(['errors' => ['confirm' => 'Konfirmasi password masih kosong']]);
        }

        if ($password !== $confirm) {
            response(['errors' => ['confirm' => 'Konfirmasi password tidak cocok']]);
        }

        $data['password'] = password_hash($password, PASSWORD_BCRYPT);
        $data['token_password'] = null;
        $this->BM->updateById('users', $user->id, $data);
        $role = $this->BM->getById('roles', $user->role);
        $session = array(
            'userId' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $role->display_name,
            'role_id' => $user->role,
        );

        $this->session->set_userdata(SESSION_KEY, $session);

        response([
            'success' => true,
            'type' => 'reset-password',
            'redirect' => base_url('admin'),
            'currentUrl' => base_url('admin/dashboard'),
        ]);
    }
}
