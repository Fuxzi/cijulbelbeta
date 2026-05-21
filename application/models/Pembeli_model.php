<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembeli_model extends CI_Model {

    private $table = 'pembeli';
    private $pk    = 'id_pembeli';

    public function login($username, $password)
{
    return $this->db->where('username', $username)
                    ->where('password', $password)
                    ->get($this->table)
                    ->row();
}
    public function get_all()
    {
        return $this->db->order_by('tgl_daftar', 'DESC')->get($this->table)->result();
    }

    public function get_by_id($id)
    {
        return $this->db->where($this->pk, $id)->get($this->table)->row();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        $this->db->where($this->pk, $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        $this->db->where($this->pk, $id);
        return $this->db->delete($this->table);
    }

    // Generate ID Pembeli otomatis
    public function generate_id()
    {
        $last = $this->db->select($this->pk)
                         ->order_by($this->pk, 'DESC')
                         ->limit(1)
                         ->get($this->table)
                         ->row();
        if ($last) {
            $num = (int) substr($last->{$this->pk}, 4) + 1;
        } else {
            $num = 1;
        }
        return 'PBL-' . str_pad($num, 3, '0', STR_PAD_LEFT);
    }
}