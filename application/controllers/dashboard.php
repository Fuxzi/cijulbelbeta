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
        $data['total_transaksi']  = $this->db->count_all('transaksi');
        $data['total_penjual']    = $this->db->count_all('penjual');
        $data['total_pembeli']    = $this->db->count_all('pembeli');

        // Data untuk chart - mobil per merek
        $merek = $this->db->select('merek, COUNT(*) as jumlah')
                           ->group_by('merek')
                           ->get('mobil')
                           ->result();
        $data['chart_label'] = json_encode(array_column((array)$merek, 'merek'));
        $data['chart_data']  = json_encode(array_column((array)$merek, 'jumlah'));

        // 5 mobil terbaru
        $data['mobil_terbaru'] = $this->db->order_by('tgl_masuk', 'DESC')
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
