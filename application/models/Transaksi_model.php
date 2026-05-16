<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

    private $table = 'transaksi';

    public function get_all()
    {
        return $this->db->select('transaksi.*, mobil.nama_mobil, mobil.merek, pembeli.nama as nama_pembeli')
                        ->join('mobil', 'mobil.id = transaksi.id_mobil', 'left')
                        ->join('pembeli', 'pembeli.id = transaksi.id_pembeli', 'left')
                        ->order_by('transaksi.tgl_transaksi', 'DESC')
                        ->get($this->table)
                        ->result();
    }

    public function get_detail($id)
    {
        return $this->db->select('transaksi.*, mobil.nama_mobil, mobil.merek, mobil.foto, mobil.id as id_mobil, pembeli.nama as nama_pembeli, pembeli.no_hp, pembeli.email')
                        ->join('mobil', 'mobil.id = transaksi.id_mobil', 'left')
                        ->join('pembeli', 'pembeli.id = transaksi.id_pembeli', 'left')
                        ->where('transaksi.id', $id)
                        ->get($this->table)
                        ->row();
    }

    public function insert($data)       { return $this->db->insert($this->table, $data); }
    public function update_status($id, $status) { $this->db->where('id', $id)->update($this->table, ['status' => $status]); }
    public function delete($id)         { $this->db->where('id', $id)->delete($this->table); }
}