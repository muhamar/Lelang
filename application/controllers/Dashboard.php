<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function index()
	{
		if (!$this->session->userdata('username')) {
			redirect('login');
		}
		$data['aktif'] = "dashboard";
		$data['judul'] = "Halaman - Dashboard";
		$data['jumlah_user'] = $this->db->get('peserta')->num_rows();
		$data['jumlah_lelang'] = $this->db->get('lelang')->num_rows();
		$data['jumlah_pesanan'] = $this->db->get('pesanan')->num_rows();
		$data['jumlah_pengiriman'] = $this->db->get('pengiriman')->num_rows();
		$this->template->load('template/template_dashboard.php', 'dashboard/index.php', $data);
	}
}
