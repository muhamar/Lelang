<?php

use chriskacerguis\RestServer\RestController;
use \Firebase\JWT\JWT;

defined('BASEPATH') or exit('No direct script access allowed');


class Api_auth extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->form_validation->set_error_delimiters('', '');
        $this->load->model('Model_user');
        $this->load->library('form_validation');
    }

    protected function getError(array $arr = [])
    {
        if(count($arr)) {
            foreach($arr as $value) {
                if($value) return $value;
            }
        }
        return "";
    }

    protected function createToken(array $user) {
        $time = time();
        $exp = $time + 60 * 60 * 24 * 60;
        return JWT::encode(['id' => $user['id_peserta'], 'iat' => $time, 'exp' => $exp], SECRET);
    }

	protected function isLogin()
	{
		$headers = $this->input->request_headers();
		if(empty($headers['authorization'])) return false;

		try {
			$token = $headers['authorization'];
			$decode = JWT::decode($token, SECRET, array('HS256'));
			$id = (int) $decode->id;
		} catch (Exception $e) {
			return false;
		}
        if (!$id) return false;
		
		return $this->Model_user->tampilUser($id);
	}

    public function daftar_post()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[peserta.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if (!$this->form_validation->run()) {
            return $this->response([
                'status' => 400,
                'pesan' => $this->getError([
                    form_error('nama'),
                    form_error('username'),
                    form_error('password')
                ])
            ], 400);
        }

        $data = [
            'nama' => $this->post('nama'),
            'username' => $this->post('username'),
            'password' => $this->post('password')
        ];

        if ($this->Model_user->tambahUser($data)) {
            $peserta = $this->db->get_where('peserta', ['username' => $data['username']])->row_array();
            return $this->response([
                'status' => 200,
                'pesan' => "Peserta berhasil ditambahkan",
                'token' => $this->createToken($peserta),
                'peserta' => $peserta
            ], 200);
        }

        return $this->response([
            'status' => 400,
            'pesan' => 'Peserta gagal ditambahkan'
        ], 400);
    }

    public function login_post()
    {
        $username = $this->post('username');
        $password = $this->post('password');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {
            return $this->response([
                'status' => 400,
                'pesan' => $this->getError([form_error('username'), form_error('password')])
            ], 400);
        }

		$peserta = $this->db->get_where('peserta', ['username' => $username])->row_array();
		if ($peserta) {
			if ($password == $peserta['password']) {
				return $this->response([
					'status' => 200,
					'peserta' => $peserta,
					'token' => $this->createToken($peserta),
					'pesan' => 'berhasil login'
				], 200);
			}
			return $this->response([
				'status' => 400,
				'pesan' => 'Password Salah !'
				// 'pesan' => "Username / Nohp telah terdaftar !"
			], 400);
		}

		$this->response([
			'status' => false,
			'pesan' => 'Username tidak terdaftar !'
			// 'pesan' => "Username / Nohp telah terdaftar !"
		], 400);
    }

    public function profile_get()
    {
		if ($peserta = $this->isLogin()) {
			$this->response([
				'status' => true,
                'data' => $peserta
            ], 200);
        } else {
            $this->response([
                'status' => 401,
                'pesan' => 'mohon login kembali!'
            ], 401);
        }
    }

    public function profile_post()
    {
		$peserta = $this->isLogin();

        if (!$peserta) {
			return $this->response([
                'status' => 401,
                'pesan' => 'mohon login kembali!'
            ], 401);
        }

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nohp', 'Nohp', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        if (!$this->form_validation->run()) {
            return $this->response([
                'status' => 400,
                'pesan' => $this->getError([form_error('nama'), form_error('nohp'), form_error('alamat')])
            ], 400);
        }
		$data = [
			'nama' => $this->post('nama'),
			'nohp' => $this->post('nohp'),
			'alamat' => $this->post('alamat')
		];

		if ($this->Model_user->updateUser($data, $peserta['id_peserta']) > 0) {
			$this->response([
				'status' => 200,
				'pesan' => 'Peserta berhasil di update',
				'peserta' => $this->db->get_where('peserta', ['id_peserta' => $peserta['id_peserta']])->row_array()
			], 200);
		} else {
			$this->response([
				'status' => false,
				'pesan' => "Peserta gagal di update"
			], 400);
		}
    }
}
