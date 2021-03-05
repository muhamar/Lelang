<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Toko extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')) {
			redirect('login');
		}
	}

    public function index()
    {
        $data['aktif'] = "toko";
        $data['judul'] = "Halaman - Tentang - Toko";
        $data['tentang'] = $this->db->get('tentang_toko')->row_array();
        $this->template->load('template/template_dashboard.php', 'toko/index.php', $data);
    }
    public function edit()
    {
        $data['tentang'] = $this->db->get('tentang_toko')->row_array();
        $tentang_aabetta = $this->input->post('tentang', true);

        //cek gambar
        $upload_gambar = $_FILES['gambar']['name'];

        if ($upload_gambar) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '8000';
            $config['upload_path'] = './assets/img/';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('gambar')) {
                $gambar_lama = $data['tentang']['gambar'];
                if ($gambar_lama != 'logo.png') {
                    unlink('./assets/img/' . $gambar_lama);
                }
                $gambar_baru = $this->upload->data('file_name');
                $this->db->set('gambar', $gambar_baru);
            } else {
                echo $this->upload->display_errors();
            }
        }
        $this->db->set('tentang_aabetta', $tentang_aabetta);
        $this->db->update('tentang_toko');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert" > Data Berhasil di update </div>');
        redirect('toko');
    }
}
