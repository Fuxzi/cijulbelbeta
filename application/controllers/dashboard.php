<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        cek_login(); // fungsi helper cek session
    }

    public function index()
    {
        $data['total_mobil']      = $this->db->count_all('mobil');
        $data['total_terjual']    = $this->db->where('status', 'Terjual')->count_all_results('mobil');
        $data['total_tersedia']   = $this->db->where('status', 'Tersedia')->count_all_results('mobil');
        
        // FIX: gabung pemesanan + pembelian
        $data['total_transaksi']  = $this->db->count_all('pemesanan') + $this->db->count_all('pembelian');
        
        // FIX: tabel penjual belum ada, isi 0 dulu
        $data['total_penjual']    = 0;
        
        $data['total_pembeli']    = $this->db->count_all('pembeli');

        // Data untuk chart - mobil per merk (pakai merk, bukan merek)
        $merk = $this->db->select('merk, COUNT(*) as jumlah')
                           ->group_by('merk')
                           ->get('mobil')
                           ->result();
        $data['chart_label'] = json_encode(array_column((array)$merk, 'merk'));
        $data['chart_data']  = json_encode(array_column((array)$merk, 'jumlah'));

        // FIX: kolom tgl_masuk tidak ada, pakai tahun
        $data['mobil_terbaru'] = $this->db->order_by('tahun', 'DESC')
                                           ->limit(5)
                                           ->get('mobil')
                                           ->result();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }
}