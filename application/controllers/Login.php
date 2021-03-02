<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
		
    }
    public function index()
    {

        if ($this->session->userdata('username')) {
            redirect('dashboard');
        }

        $this->form_validation->set_rules('username', 'Username', 'required|trim', [
            'required' => 'Username tidak boleh kosong !'
        ]);

        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password tidak boleh kosong !'
        ]);

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Form-Login';
            $this->load->view('login/index.php');
        } else {
            $username = $this->input->post('username', true);
            $password = $this->input->post('password', true);
            $admin = $this->db->get_where('admin', ['username_admin' => $username])->row_array();
            if ($admin) {
                if ($password == $admin['password_admin']) {
                    $data = [
                        'username' => $admin['username_admin'],
                        'nama_admin' => $admin['nama_admin']
                    ];
                    $this->session->set_userdata($data);
                    redirect('dashboard');
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert"> Password Salah ! </div>');
                    redirect('login');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role"alert"> Username tidak ditemukan !</div>');
                redirect('login');

            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('nama_admin');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role"alert"> Anda telah berhasil logout.</div>');
        redirect('login');
    }
}
