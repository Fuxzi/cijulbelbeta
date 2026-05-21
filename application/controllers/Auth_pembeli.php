<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_pembeli extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pembeli_model');
        $this->load->library('session');
        $this->load->helper(['url', 'form']);
    }

    public function login()
    {
        if ($this->session->userdata('logged_in_pembeli')) {
            redirect('home');
        }
        $this->load->view('auth_pembeli/login');
    }

    public function proses_login()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));

        $pembeli = $this->Pembeli_model->login($username, $password);

        if ($pembeli) {
            $this->session->set_userdata([
                'logged_in_pembeli' => TRUE,
                'id_pembeli'        => $pembeli->id_pembeli,
                'nama_pembeli'      => $pembeli->nama,
                'username_pembeli'  => $pembeli->username,
            ]);
            redirect('home');
        } else {
            $this->session->set_flashdata('error', 'Username atau password salah!');
            redirect('auth_pembeli/login');
        }
    }

    public function register()
    {
        $this->load->view('auth_pembeli/register');
    }

    public function proses_register()
    {
        $data = [
            'id_pembeli' => 'PBL-' . strtoupper(substr(uniqid(), -3)),
            'username'   => $this->input->post('username'),
            'password'   => md5($this->input->post('password')),
            'nama'       => $this->input->post('nama'),
            'no_hp'      => $this->input->post('no_hp'),
            'alamat'     => $this->input->post('alamat'),
            'tgl_daftar' => date('Y-m-d'),
        ];
        $this->Pembeli_model->insert($data);
        $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');
        redirect('auth_pembeli/login');
    }

    public function logout()
    {
        $this->session->unset_userdata('logged_in_pembeli');
        $this->session->unset_userdata('id_pembeli');
        $this->session->unset_userdata('nama_pembeli');
        $this->session->sess_destroy();
        redirect('home');
    }
}