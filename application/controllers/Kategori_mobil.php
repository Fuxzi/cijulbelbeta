<?php

class kategori extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('kategori_model');
    }

    public function index(){

        $data['kategori']= $this->kategori_model->get_all();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('kategori/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('kategori/tambah');
        $this->load->view('templates/footer');
    }

    // ======================
    // SIMPAN
    // ======================
    public function simpan()
    {
        $data = [
            'nama_kategori' => $this->input->post('nama_kategori')
        ];

        $this->kategori_model->insert($data);

        redirect('kategori');
    }

    // ======================
    // HAPUS
    // ======================
    public function hapus($id)
    {
        $this->kategori_model->delete($id);

        redirect('kategori');
    }
    public function edit($id)
{
    $data['kategori'] = $this->kategori_model->get_by_id($id);

    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar');
    $this->load->view('kategori/edit', $data);
    $this->load->view('templates/footer');
}

public function update()
{
    $id = $this->input->post('id');

    $data = [
        'nama_kategori' => $this->input->post('nama_kategori')
    ];

    $this->kategori_model->update($id, $data);

    redirect('kategori');
}

}