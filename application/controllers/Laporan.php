<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_pesanan');
    }
    public function index()
    {
        $data['aktif'] = "laporan";
        $data['judul'] = "Halaman - Laporan";
        $this->load->library('mypdf');
        if ($this->input->post('awalTanggal') && $this->input->post('akhirTanggal')) {

            $data['awal'] = $this->input->post('awalTanggal');
            $data['akhir'] = $this->input->post('akhirTanggal');
            $data['pesanan'] = $this->Model_pesanan->tampilPesananFilter();
            $data['totalPenjualan'] = $this->Model_pesanan->getJumlahPenjualan();
            $this->mypdf->generate('laporan/dompdf.php', $data);
        } else {
            $data['pesanan'] = $this->Model_pesanan->tampilpesanan();
        }

        $this->template->load('template/template_dashboard.php', 'laporan/index.php', $data);
    }

    public function unduhLaporan()
    {
        $data['pesanan'] = $this->Model_pesanan->tampilpesanan();
        $data['totalPenjualan'] = $this->Model_pesanan->getJumlahPenjualan();
        $this->load->library('mypdf');
        $this->mypdf->generate('laporan/dompdf.php', $data);
    }
}
