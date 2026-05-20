<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Cek apakah user sudah login.
 * Panggil fungsi ini di __construct() setiap controller yang butuh login.
 */
if (!function_exists('cek_login')) {
    function cek_login()
    {
        $CI =& get_instance();
        if (!$CI->session->userdata('logged_in')) {
            redirect('auth');
        }
    }
}
