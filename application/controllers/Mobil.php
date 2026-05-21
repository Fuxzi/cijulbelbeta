<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobil extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mobil_model');
        $this->load->model('Kategori_mobil_model');
        $this->load->model('Penjual_model');
        $this->load->library(['session', 'upload', 'form_validation']);
        $this->load->helper(['url', 'form']);
        cek_login();
    }

    public function index()
    {
        $data['mobil'] = $this->Mobil_model->get_all();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('mobil/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['kategori'] = $this->Kategori_mobil_model->get_all();
        $data['penjual']  = $this->Penjual_model->get_all();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('mobil/tambah', $data);
        $this->load->view('templates/footer');
    }

    public function simpan()
    {
        // Upload foto
        $foto = 'noimage.jpg';
        if (!empty($_FILES['foto']['name'])) {
            $config_upload = [
                'upload_path'   => './assets/img/',
                'allowed_types' => 'jpg|jpeg|png|webp',
                'max_size'      => 2048,
                'file_name'     => 'mobil_' . time(),
            ];
            $this->upload->initialize($config_upload);
            if ($this->upload->do_upload('foto')) {
                $foto = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('mobil/tambah');
                return;
            }
        }

        $data = [
            'id_mobil'        => 'MOB-' . strtoupper(substr(uniqid(), -3)),
            'merk'            => $this->input->post('merk'),
            'tipe'            => $this->input->post('tipe'),
            'nama_mobil'      => $this->input->post('nama_mobil'),
            'merek'           => $this->input->post('merk'),
            'model'           => $this->input->post('tipe'),
            'tahun'           => $this->input->post('tahun'),
            'warna'           => $this->input->post('warna'),
            'transmisi'       => $this->input->post('transmisi'),
            'bahan_bakar'     => $this->input->post('bahan_bakar'),
            'kapasitas_mesin' => $this->input->post('kapasitas_mesin'),
            'km_tempuh'       => $this->input->post('km_tempuh'),
            'kondisi'         => $this->input->post('kondisi'),
            'harga'           => $this->input->post('harga'),
            'deskripsi'       => $this->input->post('deskripsi'),
            'foto'            => $foto,
            'id_kategori'     => $this->input->post('id_kategori'),
            'id_penjual'      => $this->input->post('id_penjual'),
            'status'          => 'Tersedia',
            'tgl_masuk'       => date('Y-m-d'),
        ];

        $this->Mobil_model->insert($data);
        $this->session->set_flashdata('success', 'Data mobil berhasil ditambahkan!');
        redirect('mobil');
    }

    public function detail($id_mobil)
    {
        $data['mobil'] = $this->Mobil_model->get_by_id($id_mobil);
        if (!$data['mobil']) { show_404(); }
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('mobil/detail', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id_mobil)
    {
        $data['mobil']    = $this->Mobil_model->get_by_id($id_mobil);
        $data['kategori'] = $this->Kategori_mobil_model->get_all();
        $data['penjual']  = $this->Penjual_model->get_all();
        if (!$data['mobil']) { show_404(); }
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('mobil/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $id_mobil  = $this->input->post('id_mobil');
        $mobil     = $this->Mobil_model->get_by_id($id_mobil);
        $foto      = $mobil->foto ?? 'noimage.jpg';

        if (!empty($_FILES['foto']['name'])) {
            $config_upload = [
                'upload_path'   => './assets/img/',
                'allowed_types' => 'jpg|jpeg|png|webp',
                'max_size'      => 2048,
                'file_name'     => 'mobil_' . time(),
            ];
            $this->upload->initialize($config_upload);
            if ($this->upload->do_upload('foto')) {
                if ($foto !== 'noimage.jpg' && file_exists('./assets/img/' . $foto)) {
                    unlink('./assets/img/' . $foto);
                }
                $foto = $this->upload->data('file_name');
            }
        }

        $data = [
            'merk'            => $this->input->post('merk'),
            'tipe'            => $this->input->post('tipe'),
            'nama_mobil'      => $this->input->post('nama_mobil'),
            'merek'           => $this->input->post('merk'),
            'model'           => $this->input->post('tipe'),
            'tahun'           => $this->input->post('tahun'),
            'warna'           => $this->input->post('warna'),
            'transmisi'       => $this->input->post('transmisi'),
            'bahan_bakar'     => $this->input->post('bahan_bakar'),
            'kapasitas_mesin' => $this->input->post('kapasitas_mesin'),
            'km_tempuh'       => $this->input->post('km_tempuh'),
            'kondisi'         => $this->input->post('kondisi'),
            'harga'           => $this->input->post('harga'),
            'deskripsi'       => $this->input->post('deskripsi'),
            'foto'            => $foto,
            'id_kategori'     => $this->input->post('id_kategori'),
            'id_penjual'      => $this->input->post('id_penjual'),
            'status'          => $this->input->post('status'),
        ];

        $this->Mobil_model->update($id_mobil, $data);
        $this->session->set_flashdata('success', 'Data mobil berhasil diperbarui!');
        redirect('mobil');
    }

    public function hapus($id_mobil)
    {
            admin_only(); // fungsi helper untuk cek admin
            
        $mobil = $this->Mobil_model->get_by_id($id_mobil);
        if ($mobil && $mobil->foto !== 'noimage.jpg') {
            $path = './assets/img/' . $mobil->foto;
            if (file_exists($path)) unlink($path);
        }
        $this->Mobil_model->delete($id_mobil);
        $this->session->set_flashdata('success', 'Data mobil berhasil dihapus!');
        redirect('mobil');
    }
}