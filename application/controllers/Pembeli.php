<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembeli extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pembeli_model');
        $this->load->library('session');
        $this->load->helper(['url', 'form']);
        cek_login();
    }

    public function index()
    {
        $data['pembeli'] = $this->Pembeli_model->get_all();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('pembeli/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('pembeli/tambah');
        $this->load->view('templates/footer');
    }

    public function simpan()
    {
        $data = [
            'nama'       => $this->input->post('nama'),
            'no_hp'      => $this->input->post('no_hp'),
            'email'      => $this->input->post('email'),
            'alamat'     => $this->input->post('alamat'),
            'kota'       => $this->input->post('kota'),
            'tgl_daftar' => date('Y-m-d'),
        ];
        $this->Pembeli_model->insert($data);
        $this->session->set_flashdata('success', 'Pembeli berhasil ditambahkan!');
        redirect('pembeli');
    }

    public function edit($id)
    {
        $data['pembeli'] = $this->Pembeli_model->get_by_id($id);
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('pembeli/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $id   = $this->input->post('id');
        $data = [
            'nama'   => $this->input->post('nama'),
            'no_hp'  => $this->input->post('no_hp'),
            'email'  => $this->input->post('email'),
            'alamat' => $this->input->post('alamat'),
            'kota'   => $this->input->post('kota'),
        ];
        $this->Pembeli_model->update($id, $data);
        $this->session->set_flashdata('success', 'Data pembeli berhasil diperbarui!');
        redirect('pembeli');
    }

    public function hapus($id)
    {
        $this->Pembeli_model->delete($id);
        $this->session->set_flashdata('success', 'Pembeli berhasil dihapus!');
        redirect('pembeli');
    }
}