<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    private $table = 'admin';

    public function cek_login($username, $password)
    {
        return $this->db->where('username', $username)
                        ->where('password', $password)
                        ->where('status', 'Aktif')
                        ->get($this->table)
                        ->row();
    }
}
