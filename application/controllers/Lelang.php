<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lelang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_lelang');
        $this->load->library('form_validation');

		if (!$this->session->userdata('username')) {
			redirect('login');
		}
    }

    public function index()
    {
        $data['aktif'] = "lelang";
        $data['judul'] = "Halaman - Lelang";
        $data['lelang'] = $this->Model_lelang->tampilLelang();
        $this->template->load('template/template_dashboard.php', 'Lelang/index.php', $data);
    }

    public function tambah()
    {
		if($this->Model_lelang->tambahLelang()>0){
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role"alert"> Lelang berhasil di tambahkan !</div>');
			redirect('lelang');
		}else{
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role"alert"> Lelang gagal ditambahkan, pastikan yang anda input adalah file gambar!</div>');
			redirect('lelang');
		}
    }

    public function edit($id)
    {
		if($this->Model_lelang->editLelang($id) == true){
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role"alert"> Data lelang berhasil di edit !</div>');
			redirect('lelang');
		}else{
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role"alert"> Data lelang gagal di edit, pastikan yang anda input adalah file gambar!</div>');
			redirect('lelang');
		}
    }

    public function hapus($id)
    {
        $this->Model_lelang->hapusLelang($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role"alert"> Data lelang berhasil di hapus !</div>');
        redirect('lelang');
    }
}
