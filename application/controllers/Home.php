<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mobil_model');
        $this->load->model('Pembeli_model');
        $this->load->helper('url');
        $this->load->library(['session', 'upload']);
    }

    public function index()
    {
        $data['mobil'] = $this->Mobil_model->get_tersedia();
        $this->load->view('home/index', $data);
    }

    public function detail($id_mobil)
    {
        $data['mobil'] = $this->Mobil_model->get_by_id($id_mobil);
        if (!$data['mobil']) show_404();
        $this->load->view('home/detail', $data);
    }

    public function pesan($id_mobil)
    {
        if (!$this->session->userdata('logged_in_pembeli')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu!');
            redirect('auth');
        }

        $id_pembeli = $this->session->userdata('id_pembeli');
        $mobil = $this->Mobil_model->get_by_id($id_mobil);

        if (!$mobil || $mobil->status != 'Tersedia') {
            $this->session->set_flashdata('error', 'Mobil tidak tersedia!');
            redirect('home');
        }

        $id_pemesanan = 'PMS-' . strtoupper(substr(uniqid(), -3));

        $this->db->insert('pemesanan', [
            'id_pemesanan' => $id_pemesanan,
            'id_pembeli'   => $id_pembeli,
            'tanggal'      => date('Y-m-d'),
            'status'       => 'Pending',
        ]);

        $this->db->insert('detail_pemesanan', [
            'id_pemesanan' => $id_pemesanan,
            'id_mobil'     => $id_mobil,
            'jumlah'       => 1,
            'harga'        => $mobil->harga,
            'subtotal'     => $mobil->harga,
        ]);

        $this->Mobil_model->update($id_mobil, ['status' => 'Dipesan']);

        $this->session->set_flashdata('success', 'Mobil berhasil dipesan! Silakan lakukan pembayaran.');
        redirect('home/bayar/' . $id_pemesanan);
    }

    // Halaman pembayaran
    public function bayar($id_pemesanan)
    {
        if (!$this->session->userdata('logged_in_pembeli')) {
            redirect('auth');
        }

        $data['pesanan'] = $this->db->select('pemesanan.*, mobil.merk, mobil.tipe, mobil.harga, mobil.foto')
                                    ->from('pemesanan')
                                    ->join('detail_pemesanan', 'detail_pemesanan.id_pemesanan = pemesanan.id_pemesanan')
                                    ->join('mobil', 'mobil.id_mobil = detail_pemesanan.id_mobil')
                                    ->where('pemesanan.id_pemesanan', $id_pemesanan)
                                    ->get()
                                    ->row();

        if (!$data['pesanan']) show_404();

        // Cek apakah sudah ada pembayaran
        $data['pembayaran'] = $this->db->where('id_pemesanan', $id_pemesanan)
                                       ->get('pembayaran_penjual')
                                       ->row();

        $this->load->view('home/bayar', $data);
    }

    // Proses upload bukti bayar
    public function proses_bayar()
{
    $id_pemesanan = $this->input->post('id_pemesanan');
    $metode       = $this->input->post('metode');
    $jumlah       = $this->input->post('jumlah');
    $bukti        = null;

    // Upload bukti hanya jika metode Transfer Bank
    if ($metode == 'Transfer Bank' && !empty($_FILES['bukti_bayar']['name'])) {
        $config['upload_path']   = './assets/img/bukti/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 2048;
        $config['file_name']     = 'bukti_' . time();

        if (!is_dir('./assets/img/bukti/')) {
            mkdir('./assets/img/bukti/', 0777, true);
        }

        $this->upload->initialize($config);

        if ($this->upload->do_upload('bukti_bayar')) {
            $bukti = $this->upload->data('file_name');
        } else {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('home/bayar/' . $id_pemesanan);
            return;
        }
    }

    // Cek existing
    $existing = $this->db->where('id_pemesanan', $id_pemesanan)
                         ->get('pembayaran_penjual')
                         ->row();

    $data = [
        'id_pemesanan' => $id_pemesanan,
        'tanggal'      => date('Y-m-d'),
        'jumlah'       => $jumlah,
        'metode'       => $metode,
        'bukti_bayar'  => $bukti,
        'status_bayar' => 'Menunggu',
    ];

    if ($existing) {
        if ($existing->bukti_bayar && file_exists('./assets/img/bukti/' . $existing->bukti_bayar)) {
            unlink('./assets/img/bukti/' . $existing->bukti_bayar);
        }
        $this->db->where('id_pemesanan', $id_pemesanan)
                 ->update('pembayaran_penjual', $data);
    } else {
        $data['id_bayar_jual'] = 'BYR-' . strtoupper(substr(uniqid(), -3));
        $this->db->insert('pembayaran_penjual', $data);
    }

    // Update status pesanan
    $this->db->where('id_pemesanan', $id_pemesanan)
             ->update('pemesanan', ['status' => 'Diproses']);

    $this->session->set_flashdata('success', 'Pembayaran berhasil dikirim! Menunggu konfirmasi admin.');
    redirect('home/bayar/' . $id_pemesanan);
}
    public function pesanan()
    {
        if (!$this->session->userdata('logged_in_pembeli')) {
            redirect('auth');
        }
        $id_pembeli = $this->session->userdata('id_pembeli');
        $data['pesanan'] = $this->db->select('pemesanan.*, mobil.merk, mobil.tipe, mobil.harga, mobil.foto, mobil.tahun, mobil.warna')
                                    ->from('pemesanan')
                                    ->join('detail_pemesanan', 'detail_pemesanan.id_pemesanan = pemesanan.id_pemesanan', 'left')
                                    ->join('mobil', 'mobil.id_mobil = detail_pemesanan.id_mobil', 'left')
                                    ->where('pemesanan.id_pembeli', $id_pembeli)
                                    ->order_by('pemesanan.tanggal', 'DESC')
                                    ->get()
                                    ->result();
        $this->load->view('home/pesanan', $data);
    }

    public function profil()
    {
        if (!$this->session->userdata('logged_in_pembeli')) {
            redirect('auth');
        }
        $id_pembeli = $this->session->userdata('id_pembeli');
        $data['pembeli'] = $this->Pembeli_model->get_by_id($id_pembeli);
        $this->load->view('home/profil', $data);
    }

    public function update_profil()
    {
        $id_pembeli = $this->session->userdata('id_pembeli');
        $data = [
            'nama'   => $this->input->post('nama'),
            'no_hp'  => $this->input->post('no_hp'),
            'alamat' => $this->input->post('alamat'),
        ];
        if ($this->input->post('password')) {
            $data['password'] = md5($this->input->post('password'));
        }
        $this->Pembeli_model->update($id_pembeli, $data);
        $this->session->set_userdata('nama_pembeli', $this->input->post('nama'));
        $this->session->set_flashdata('success', 'Profil berhasil diperbarui!');
        redirect('home/profil');
    }
}