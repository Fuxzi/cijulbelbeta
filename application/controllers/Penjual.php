<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjual extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Penjual_model');
        $this->load->library('session');
        $this->load->helper(['url', 'form']);
        cek_login();
    }

    public function index()
    {
        $data['penjual'] = $this->Penjual_model->get_all();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('penjual/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('penjual/tambah');
        $this->load->view('templates/footer');
    }

    public function simpan()
    {
        $data = [
            'nama'      => $this->input->post('nama'),
            'no_hp'     => $this->input->post('no_hp'),
            'email'     => $this->input->post('email'),
            'alamat'    => $this->input->post('alamat'),
            'kota'      => $this->input->post('kota'),
            'tipe'      => $this->input->post('tipe'),
            'status'    => 'Aktif',
            'tgl_daftar'=> date('Y-m-d'),
        ];
        $this->Penjual_model->insert($data);
        $this->session->set_flashdata('success', 'Penjual berhasil ditambahkan!');
        redirect('penjual');
    }

    public function edit($id)
    {
        $data['penjual'] = $this->Penjual_model->get_by_id($id);
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('penjual/edit', $data);
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
            'tipe'   => $this->input->post('tipe'),
            'status' => $this->input->post('status'),
        ];
        $this->Penjual_model->update($id, $data);
        $this->session->set_flashdata('success', 'Data penjual berhasil diperbarui!');
        redirect('penjual');
    }

    public function hapus($id)
    {
        $this->Penjual_model->delete($id);
        $this->session->set_flashdata('success', 'Penjual berhasil dihapus!');
        redirect('penjual');
    }
}
