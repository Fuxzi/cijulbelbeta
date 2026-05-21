<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobil_model extends CI_Model {

    private $table = 'mobil';
    private $id    = 'id_mobil';

    public function get_all()
    {
        // Tabel kategori_mobil & penjual belum ada, join dihapus dulu
        return $this->db->order_by('tahun', 'DESC')
                        ->get($this->table)
                        ->result();
    }

    public function get_by_id($id)
    {
        return $this->db->where($this->id, $id)
                        ->get($this->table)
                        ->row();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        $this->db->where($this->id, $id);
        return $this->db->update($this->table, $data);
    }

   public function delete($id)
{
    $this->db->where('id_mobil', $id);
    return $this->db->delete($this->table);
}

    // Untuk dropdown/filter - semuanya dari tabel mobil saja
    public function get_merk()
    {
        return $this->db->select('merk')
                        ->group_by('merk')
                        ->get($this->table)
                        ->result();
    }

    public function get_tahun()
    {
        return $this->db->select('tahun')
                        ->group_by('tahun')
                        ->order_by('tahun', 'DESC')
                        ->get($this->table)
                        ->result();
    }
// Di Mobil_model.php, tambah:
public function get_tersedia()
{
    return $this->db->where('status', 'Tersedia')
                    ->order_by('merk', 'ASC')
                    ->get($this->table)
                    ->result();
}
    // Total stok
    public function total_tersedia()
    {
        return $this->db->where('status', 'Tersedia')->count_all_results($this->table);
    }

    public function total_terjual()
    {
        return $this->db->where('status', 'Terjual')->count_all_results($this->table);
    }
}