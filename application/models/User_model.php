<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function cek_login($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password); // password sudah di-MD5 dari controller
        $query = $this->db->get('user');
        
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

}