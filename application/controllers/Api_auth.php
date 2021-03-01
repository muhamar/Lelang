<?php

use chriskacerguis\RestServer\RestController;
use \Firebase\JWT\JWT;

defined('BASEPATH') or exit('No direct script access allowed');


class Api_auth extends RestController
{
    const SECRET = 'secret';


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_user');
        $this->load->library('form_validation');
    }

    public function daftar_post()
    {

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[peserta.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == false) {
            $this->response([
                'status' => false,
                'pesan' => 'Form tidak valid'
                // 'pesan' => "Username / Nohp telah terdaftar !"
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            $data = [
                'nama' => $this->post('nama'),
                'username' => $this->post('username'),
                'password' => $this->post('password')
            ];

            if ($this->Model_user->tambahUser($data) > 0) {
                $time = time();
                $exp = $time + 60 * 60 * 24 * 60;


                $peserta = $this->db->get_where('peserta', ['username' => $data['username']])->row_array();
                $token = JWT::encode(['id' => $peserta['id_peserta'], 'iat' => $time, 'exp' => $exp], self::SECRET);
                $this->response([
                    'status' => true,
                    'pesan' => "Peserta berhasil ditambahkan",
                    'token' => $token,
                    'peserta' => $peserta
                ], RestController::HTTP_CREATED);
            } else {
                $this->response([
                    'status' => false,
                    'pesan' => 'Peserta gagal ditambahkan'
                ], RestController::HTTP_BAD_REQUEST);
            }
        }
    }



    public function login_post()
    {


        $username = $this->post('username');
        $password = $this->post('password');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {
            $this->response([
                'status' => false,
                'pesan' => 'Username/Password salah!'
                // 'pesan' => "Username / Nohp telah terdaftar !"
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            $peserta = $this->db->get_where('peserta', ['username' => $username])->row_array();
            if ($peserta) {
                if ($password == $peserta['password']) {
                    $time = time();
                    $exp = $time + 60 * 60 * 24 * 60;
                    $token = JWT::encode(['id' => $peserta['id_peserta'], 'iat' => $time, 'exp' => $exp], self::SECRET);
                    $this->response([
                        'status' => true,
                        'peserta' => $peserta,
                        'token' => $token,
                        'pesan' => 'berhasil login'
                    ], RestController::HTTP_OK);
                } else {
                    $this->response([
                        'status' => false,
                        'pesan' => 'Password Salah !'
                        // 'pesan' => "Username / Nohp telah terdaftar !"
                    ], RestController::HTTP_BAD_REQUEST);
                }
            } else {
                $this->response([
                    'status' => false,
                    'pesan' => 'Username tidak terdaftar !'
                    // 'pesan' => "Username / Nohp telah terdaftar !"
                ], RestController::HTTP_BAD_REQUEST);
            }
        }
    }

    public function profile_get()
    {
        $token = $this->input->request_headers()['authorization'];
        $decode = JWT::decode($token, self::SECRET, array('HS256'));
        $id = (int) $decode->id;

        if ($id == null) {
            $peserta = $this->Model_user->tampilUser();
        } else {
            $peserta = $this->Model_user->tampilUser($id);
        }

        if ($peserta) {
            $this->response([
                'status' => true,
                'data' => $peserta
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'pesan' => 'Data tidak ditemukan'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function profile_post()
    {
        $token = $this->input->request_headers()['authorization'];
        $decode = JWT::decode($token, self::SECRET, array('HS256'));
        $id = (int) $decode->id;


        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nohp', 'Nohp', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        if (!$this->form_validation->run()) {
            $this->response([
                'status' => false,
                'pesan' => 'Form tidak valid!'
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            $data = [
                'nama' => $this->post('nama'),
                'nohp' => $this->post('nohp'),
                'alamat' => $this->post('alamat')
            ];

            if ($this->Model_user->updateUser($data, $id) > 0) {
                $this->response([
                    'status' => true,
                    'pesan' => 'Peserta berhasil di update',
                    'peserta' => $this->db->get_where('peserta', ['id_peserta' => $id])->row_array()
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'pesan' => "Peserta gagal di update"
                ], RestController::HTTP_BAD_REQUEST);
            }
        }
    }
}
