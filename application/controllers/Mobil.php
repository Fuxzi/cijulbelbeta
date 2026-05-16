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
                'upload_path'   => './assets/uploads/mobil/',
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
            'kode_mobil'      => 'MOB-' . strtoupper(uniqid()),
            'nama_mobil'      => $this->input->post('nama_mobil'),
            'merek'           => $this->input->post('merek'),
            'model'           => $this->input->post('model'),
            'tipe'            => $this->input->post('tipe'),
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

    public function detail($id)
    {
        $data['mobil'] = $this->Mobil_model->get_by_id($id);
        if (!$data['mobil']) { show_404(); }
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('mobil/detail', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id)
    {
        $data['mobil']    = $this->Mobil_model->get_by_id($id);
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
        $id        = $this->input->post('id');
        $mobil     = $this->Mobil_model->get_by_id($id);
        $foto      = $mobil->foto; // tetap pakai foto lama

        if (!empty($_FILES['foto']['name'])) {
            $config_upload = [
                'upload_path'   => './assets/uploads/mobil/',
                'allowed_types' => 'jpg|jpeg|png|webp',
                'max_size'      => 2048,
                'file_name'     => 'mobil_' . time(),
            ];
            $this->upload->initialize($config_upload);
            if ($this->upload->do_upload('foto')) {
                // Hapus foto lama jika bukan default
                if ($foto !== 'noimage.jpg' && file_exists('./assets/uploads/mobil/' . $foto)) {
                    unlink('./assets/uploads/mobil/' . $foto);
                }
                $foto = $this->upload->data('file_name');
            }
        }

        $data = [
            'nama_mobil'      => $this->input->post('nama_mobil'),
            'merek'           => $this->input->post('merek'),
            'model'           => $this->input->post('model'),
            'tipe'            => $this->input->post('tipe'),
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

        $this->Mobil_model->update($id, $data);
        $this->session->set_flashdata('success', 'Data mobil berhasil diperbarui!');
        redirect('mobil');
    }

    public function hapus($id)
    {
        $mobil = $this->Mobil_model->get_by_id($id);
        if ($mobil && $mobil->foto !== 'noimage.jpg') {
            $path = './assets/uploads/mobil/' . $mobil->foto;
            if (file_exists($path)) unlink($path);
        }
        $this->Mobil_model->delete($id);
        $this->session->set_flashdata('success', 'Data mobil berhasil dihapus!');
        redirect('mobil');
    }
}