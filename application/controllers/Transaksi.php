<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transaksi_model');
        $this->load->model('Mobil_model');
        $this->load->model('Pembeli_model');
        $this->load->library('session');
        $this->load->helper(['url', 'form']);
        cek_login();
    }

    public function index()
    {
        $data['transaksi'] = $this->Transaksi_model->get_all();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('transaksi/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['mobil']   = $this->Mobil_model->get_by_status('Tersedia');
        $data['pembeli'] = $this->Pembeli_model->get_all();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('transaksi/tambah', $data);
        $this->load->view('templates/footer');
    }

    public function simpan()
    {
        $id_mobil = $this->input->post('id_mobil');
        $data = [
            'kode_transaksi' => 'TRX-' . strtoupper(uniqid()),
            'id_mobil'       => $id_mobil,
            'id_pembeli'     => $this->input->post('id_pembeli'),
            'harga_deal'     => $this->input->post('harga_deal'),
            'tgl_transaksi'  => date('Y-m-d'),
            'status'         => 'Pending',
            'catatan'        => $this->input->post('catatan'),
        ];
        $this->Transaksi_model->insert($data);
        // Update status mobil jadi Dipesan
        $this->db->where('id', $id_mobil)->update('mobil', ['status' => 'Dipesan']);
        $this->session->set_flashdata('success', 'Transaksi berhasil dibuat!');
        redirect('transaksi');
    }

    public function detail($id)
    {
        $data['transaksi'] = $this->Transaksi_model->get_detail($id);
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('transaksi/detail', $data);
        $this->load->view('templates/footer');
    }

    public function update_status()
    {
        $id     = $this->input->post('id');
        $status = $this->input->post('status');
        $trx    = $this->Transaksi_model->get_detail($id);

        $this->Transaksi_model->update_status($id, $status);

        // Sinkronisasi status mobil
        if ($status === 'Selesai') {
            $this->db->where('id', $trx->id_mobil)->update('mobil', ['status' => 'Terjual']);
        } elseif ($status === 'Batal') {
            $this->db->where('id', $trx->id_mobil)->update('mobil', ['status' => 'Tersedia']);
        }

        $this->session->set_flashdata('success', 'Status transaksi diperbarui!');
        redirect('transaksi');
    }

    public function hapus($id)
    {
        $trx = $this->Transaksi_model->get_detail($id);
        // Kembalikan status mobil jadi Tersedia
        $this->db->where('id', $trx->id_mobil)->update('mobil', ['status' => 'Tersedia']);
        $this->Transaksi_model->delete($id);
        $this->session->set_flashdata('success', 'Transaksi berhasil dihapus!');
        redirect('transaksi');
    }
}
