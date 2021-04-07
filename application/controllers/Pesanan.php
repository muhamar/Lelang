<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_pesanan');

		if (!$this->session->userdata('username')) {
			redirect('login');
		}
    }
    public function index()
    {
        $data['aktif'] = "pesanan";
        $data['judul'] = "Halaman - Konfirmasi - pesanan";
        $data['pesanan'] = $this->Model_pesanan->tampilpesanan();
        $this->template->load('template/template_dashboard.php', 'pesanan/index.php', $data);
    }

    public function updatepesanan($id)
    {
        $this->Model_pesanan->updateStatuspesanan($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role"alert"> Status pesanan berhasil di update, silahkan melanjutkan penginputan nomor resi di menu pengiriman!</div>');
        redirect('pesanan');
    }

    public function hapusPesanan($id)
    {
        $this->Model_pesanan->hapuspesanan($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role"alert"> pesanan berhasil dihapus !</div>');
        redirect('pesanan');
    }

    public function pengiriman()
    {
        $data['aktif'] = "pengiriman";
        $data['judul'] = "Halaman-Resi";
        $data['pesanan_lunas'] = $this->db->get_where('pesanan', ['status_pembayaran' => 'lunas', 'status_pengiriman' => 'proses'])->result_array();
        $data['pengiriman'] = $this->Model_pesanan->tampilPengiriman();
        $this->template->load('template/template_dashboard.php', 'pesanan/pengiriman.php', $data);
    }

    public function tambahPengiriman()
    {
        $this->Model_pesanan->inputPengiriman();
        $this->Model_pesanan->editStatusPengirimanTabelPesanan();
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role"alert"> Pengiriman berhasil ditambahkan !</div>');
        redirect('pesanan/pengiriman');
    }

    public function editPengiriman($id)
    {
        $this->Model_pesanan->editPengiriman($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role"alert"> Pengiriman berhasil diedit !</div>');
        redirect('pesanan/pengiriman');
    }
    public function hapusPengiriman($id)
    {
        $this->Model_pesanan->hapusPengiriman($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role"alert"> Pengiriman berhasil dihapus !</div>');
        redirect('pesanan/pengiriman');
    }
}
