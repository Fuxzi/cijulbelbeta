<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Cek login
function cek_login()
{
    $CI =& get_instance();
    if (!$CI->session->userdata('logged_in')) {
        redirect('auth');
    }
}

// Cek role admin
function is_admin()
{
    $CI =& get_instance();
    return $CI->session->userdata('role') === 'admin';
}

// Cek role staff
function is_staff()
{
    $CI =& get_instance();
    return $CI->session->userdata('role') === 'staff';
}

// Hanya admin yang bisa akses
function admin_only()
{
    $CI =& get_instance();
    if (!is_admin()) {
        $CI->session->set_flashdata('error', 'Anda tidak memiliki akses!');
        redirect('dashboard');
    }
}