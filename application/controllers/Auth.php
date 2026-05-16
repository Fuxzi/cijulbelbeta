<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('session');
        $this->load->helper('url');
    }

    // Halaman login
    public function index()
    {
        // Jika sudah login, langsung ke dashboard
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }
        $this->load->view('auth/login');
    }

    // Proses login
    public function proses_login()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));

        $admin = $this->Auth_model->cek_login($username, $password);

        if ($admin) {
            $sess = array(
                'logged_in' => TRUE,
                'id_admin'  => $admin->id,
                'nama'      => $admin->nama,
                'username'  => $admin->username,
                'role'      => $admin->role,
            );
            $this->session->set_userdata($sess);
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error', 'Username atau password salah!');
            redirect('auth');
        }
    }

    // Logout
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}