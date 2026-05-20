<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobil_model extends CI_Model {

    private $table = 'mobil';

    public function get_all()
    {
        return $this->db->select('mobil.*, kategori_mobil.nama_kategori, penjual.nama as nama_penjual')
                        ->join('kategori_mobil', 'kategori_mobil.id = mobil.id_kategori', 'left')
                        ->join('penjual', 'penjual.id = mobil.id_penjual', 'left')
                        ->order_by('mobil.tgl_masuk', 'DESC')
                        ->get($this->table)
                        ->result();
    }

    public function get_by_id($id)
    {
        return $this->db->select('mobil.*, kategori_mobil.nama_kategori, penjual.nama as nama_penjual')
                        ->join('kategori_mobil', 'kategori_mobil.id = mobil.id_kategori', 'left')
                        ->join('penjual', 'penjual.id = mobil.id_penjual', 'left')
                        ->where('mobil.id', $id)
                        ->get($this->table)
                        ->row();
    }

    public function get_by_status($status)
    {
        return $this->db->where('status', $status)->get($this->table)->result();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id)->update($this->table, $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id)->delete($this->table);
    }
}
