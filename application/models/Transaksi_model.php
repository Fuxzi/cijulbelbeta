<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

    private $table = 'pemesanan'; // pakai tabel pemesanan (penjualan)

    public function get_all()
    {
        return $this->db->select('pemesanan.*, mobil.merk, mobil.tipe, pembeli.nama as nama_pembeli, pembeli.no_hp')
                        ->join('detail_pemesanan', 'detail_pemesanan.id_pemesanan = pemesanan.id_pemesanan', 'left')
                        ->join('mobil', 'mobil.id_mobil = detail_pemesanan.id_mobil', 'left')
                        ->join('pembeli', 'pembeli.id_pembeli = pemesanan.id_pembeli', 'left')
                        ->group_by('pemesanan.id_pemesanan')
                        ->order_by('pemesanan.tanggal', 'DESC')
                        ->get($this->table)
                        ->result();
    }

    public function get_detail($id)
    {
        return $this->db->select('pemesanan.*, mobil.merk, mobil.tipe, mobil.foto, mobil.id_mobil, mobil.harga, pembeli.nama as nama_pembeli, pembeli.no_hp, pembeli.alamat')
                        ->join('detail_pemesanan', 'detail_pemesanan.id_pemesanan = pemesanan.id_pemesanan', 'left')
                        ->join('mobil', 'mobil.id_mobil = detail_pemesanan.id_mobil', 'left')
                        ->join('pembeli', 'pembeli.id_pembeli = pemesanan.id_pembeli', 'left')
                        ->where('pemesanan.id_pemesanan', $id)
                        ->get($this->table)
                        ->row();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update_status($id, $status)
    {
        $this->db->where('id_pemesanan', $id);
        $this->db->update($this->table, ['status' => $status]);
    }

    public function delete($id)
    {
        $this->db->where('id_pemesanan', $id);
        $this->db->delete($this->table);
    }
}