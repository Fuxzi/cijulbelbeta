<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_mobil extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kategori_mobil_model');
        $this->load->library('session');
        $this->load->helper(['url', 'form']);
        cek_login();
    }

    public function index()
    {
        $data['kategori'] = $this->Kategori_mobil_model->get_all();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('kategori_mobil/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        admin_only(); // fungsi helper untuk cek admin
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('kategori_mobil/tambah');
        $this->load->view('templates/footer');
    }

    public function simpan()
    {
        admin_only(); // fungsi helper untuk cek admin
        $data = ['nama_kategori' => $this->input->post('nama_kategori'), 'deskripsi' => $this->input->post('deskripsi')];
        $this->Kategori_mobil_model->insert($data);
        $this->session->set_flashdata('success', 'Kategori berhasil ditambahkan!');
        redirect('kategori_mobil');
    }

    public function edit($id)
    {
        admin_only(); // fungsi helper untuk cek admin
        $data['kategori'] = $this->Kategori_mobil_model->get_by_id($id);
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('kategori_mobil/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        admin_only(); // fungsi helper untuk cek admin
        $id   = $this->input->post('id');
        $data = ['nama_kategori' => $this->input->post('nama_kategori'), 'deskripsi' => $this->input->post('deskripsi')];
        $this->Kategori_mobil_model->update($id, $data);
        $this->session->set_flashdata('success', 'Kategori berhasil diperbarui!');
        redirect('kategori_mobil');
    }

    public function hapus($id)
    {
        admin_only(); // fungsi helper untuk cek admin
        $this->Kategori_mobil_model->delete($id);
        $this->session->set_flashdata('success', 'Kategori berhasil dihapus!');
        redirect('kategori_mobil');
    }
}
