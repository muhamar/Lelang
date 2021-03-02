<?php

use chriskacerguis\RestServer\RestController;
use Firebase\JWT\JWT;

defined('BASEPATH') or exit('No direct script access allowed');


class Api_transaksi extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->form_validation->set_error_delimiters('', '');
        $this->load->model('Model_user');
        $this->load->model('Model_lelang');
        $this->load->library('form_validation');
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

    protected function getError(array $arr = [])
    {
        if(count($arr)) {
            foreach($arr as $value) {
                if($value) return $value;
            }
        }
        return "";
    }

	protected function rdmStr($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

    public function confirm_post()
    {
		$peserta = $this->isLogin();
		if (!$peserta) {
			return $this->response([
                'status' => 401,
                'pesan' => 'mohon login kembali!'
            ], 401);
        }

        $this->form_validation->set_rules('id', 'Id Pesanan', 'required');
		if (!$this->form_validation->run()) {
            return $this->response([
                'status' => 400,
                'pesan' => $this->getError([form_error('id')])
            ], 400);
        }

		$id = $this->input->post('id');
		$idPeserta = $peserta['id_peserta'];

		$query = "SELECT * FROM tawaran WHERE id_tawaran = '$id' AND id_peserta = '$idPeserta'";
		$tawaran = $this->db->query($query)->row_array();

		$idLelang = $tawaran['id_lelang'];
		$query = "SELECT * FROM lelang WHERE id_lelang = '$idLelang'";
		$lelang = $this->db->query($query)->row_array();

		$query = "SELECT * FROM tawaran WHERE id_lelang = '$idLelang' ORDER BY harga_tawar DESC LIMIT 1";
		$tawaranWin = $this->db->query($query)->row_array();

		if(!$tawaran || !$lelang || !$tawaranWin) {
			return $this->response([
				'status' => 400,
				'pesan' => 'someting was wrong!'
			], 400);
		}

		if((int) $tawaranWin['id_tawaran'] != (int) $id) {
			return $this->response([
                'status' => 400,
                'pesan' => 'someting was wrong 2!'
            ], 400);
		}

		echo json_encode([
			'data' => [
				'p' => $peserta,
				'l' => $lelang,
				't' => $tawaran,
				'tw' => $tawaranWin,
			]
		]);
    }
}
