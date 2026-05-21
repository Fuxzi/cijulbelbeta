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
        $data['mobil']   = $this->Mobil_model->get_tersedia();
        $data['pembeli'] = $this->Pembeli_model->get_all();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('transaksi/tambah', $data);
        $this->load->view('templates/footer');
    }

    public function simpan()
    {
        $id_pemesanan = 'PMS-' . strtoupper(substr(uniqid(), -3));
        $id_mobil     = $this->input->post('id_mobil');
        $mobil        = $this->Mobil_model->get_by_id($id_mobil);
        $harga        = $this->input->post('harga_deal') ?: $mobil->harga;

        $data_pemesanan = [
            'id_pemesanan' => $id_pemesanan,
            'id_pembeli'   => $this->input->post('id_pembeli'),
            'tanggal'      => date('Y-m-d'),
            'status'       => 'Pending',
        ];
        $this->db->insert('pemesanan', $data_pemesanan);

        $data_detail = [
            'id_pemesanan' => $id_pemesanan,
            'id_mobil'     => $id_mobil,
            'jumlah'       => 1,
            'harga'        => $harga,
            'subtotal'     => $harga,
        ];
        $this->db->insert('detail_pemesanan', $data_detail);

        $this->Mobil_model->update($id_mobil, ['status' => 'Dipesan']);

        $this->session->set_flashdata('success', 'Transaksi berhasil dibuat!');
        redirect('transaksi');
    }

    public function detail($id_pemesanan)
    {
        $data['transaksi'] = $this->Transaksi_model->get_detail($id_pemesanan);
        if (!$data['transaksi']) show_404();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('transaksi/detail', $data);
        $this->load->view('templates/footer');
    }

    public function update_status()
    {
        $id_pemesanan = $this->input->post('id_pemesanan');
        $status       = $this->input->post('status');
        $trx          = $this->Transaksi_model->get_detail($id_pemesanan);

        $this->Transaksi_model->update_status($id_pemesanan, $status);

        if ($status === 'Selesai') {
            $this->Mobil_model->update($trx->id_mobil, ['status' => 'Terjual']);
        } elseif ($status === 'Batal') {
            $this->Mobil_model->update($trx->id_mobil, ['status' => 'Tersedia']);
        }

        $this->session->set_flashdata('success', 'Status transaksi diperbarui!');
        redirect('transaksi');
    }

    public function hapus($id_pemesanan)
    {
        admin_only(); // ✅ titik koma ditambahkan
        $trx = $this->Transaksi_model->get_detail($id_pemesanan);
        if ($trx) {
            $this->Mobil_model->update($trx->id_mobil, ['status' => 'Tersedia']);
        }
        $this->Transaksi_model->delete($id_pemesanan);
        $this->session->set_flashdata('success', 'Transaksi berhasil dihapus!');
        redirect('transaksi');
    }
}