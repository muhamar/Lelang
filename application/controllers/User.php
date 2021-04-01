<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_user');

		if (!$this->session->userdata('username')) {
			redirect('login');
		}
    }

    public function index()
    {
        $data['aktif'] = "user";
        $data['judul'] = "Halaman - Kelola - User";
        $data['peserta'] = $this->Model_user->tampilUser();
        $this->template->load('template/template_dashboard.php', 'User/index.php', $data);
    }

    public function edit($id)
    {
        $this->Model_user->editUser($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role"alert"> Peserta berhasil di edit !</div>');
        redirect('user');
    }

    public function hapus($id)
    {
        $this->Model_user->hapusUser($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role"alert"> Peserta berhasil dihapus !</div>');
        redirect('user');
    }
}
