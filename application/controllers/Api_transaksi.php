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
        $this->load->model('Model_pesanan');
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
		// if (!$peserta) {
		// 	return $this->response([
        //         'status' => 401,
        //         'pesan' => 'mohon login kembali!'
        //     ], 401);
        // }

        // $this->form_validation->set_rules('id', 'Id Pesanan', 'required');
		// if (!$this->form_validation->run()) {
        //     return $this->response([
        //         'status' => 400,
        //         'pesan' => $this->getError([form_error('id')])
        //     ], 400);
        // }

		$query = "SELECT * FROM tawaran WHERE id_lelang = 3  ORDER BY harga_tawar DESC LIMIT 1 ";
		$tawarTertinggi = $this->db->query($query)->row_array();
		$idPesertaMenang = $tawarTertinggi['id_peserta'];
		$lelang = $this->db->get_where('lelang',['id_lelang' => $tawarTertinggi['id_lelang']] )->row_array();
		$waktuSekarang = date('Y-m-d h-m-s');
		if($waktuSekarang > $lelang['waktu_selesai']){
			if(4 == $idPesertaMenang){
				$data = [
					'id_peserta' => 4,
					'id_lelang' => $lelang['id_lelang'],
					'jumlah_bayar' => $tawarTertinggi['harga_tawar'],
					'bukti_gambar' => 'logo.png',
					'status_pembayaran' => 'belum lunas',
					'status_pengiriman' => 'proses',
					'waktu_pembayaran' => date('Y-m-d h-m-s')
					];
				if($this->Model_pesanan->tambahPesanan($data) > 0){
					return $this->response([
						'status' => 200,
						'pesan' => 'Pesanan berhasil ditambahkan'
					], 200);
				}else{
					return $this->response([
						'status' => 400,
						'pesan' => 'Pesanan gagal ditambahkan'
					], 400);
				}
			}else{
				return $this->response([
					'status' => 400,
					'pesan' => 'Sayang sekali anda tidak menang'
				], 400);
			}
		}else{
			return $this->response([
				'status' => 400,
				'pesan' => 'Lelang masih berlangsung !'
			], 400);
		}
		
		

    }
}
