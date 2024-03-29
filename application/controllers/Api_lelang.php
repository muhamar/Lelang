<?php

use chriskacerguis\RestServer\RestController;
use Firebase\JWT\JWT;

defined('BASEPATH') or exit('No direct script access allowed');

class Api_lelang extends RestController
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

    public function lelang_get()
    {
			$lelang = $this->db->get('lelang')->result_array();
			$tawaran = $this->db->get('tawaran')->result_array();
			$peserta = $this->db->get('peserta')->result_array();
			$gambar = $this->db->get('gambar')->result_array();
			$users = [];

			foreach($peserta as $user) {
				array_push($users, [
					'nama' => $user['nama'],
					'username' => $user['username'],
					'nohp' => $user['nohp'],
					'alamat' => $user['alamat'],
				]);
			}

			return $this->response([
				'status' => 200,
				'data' => [
					'lelang' => $lelang,
					'tawaran' => $tawaran,
					'peserta' => $users,
					'gambar' => $gambar
				]
			], 200);
    }

    public function tawaran_post()
    {
			$peserta = $this->isLogin();
			if (!$peserta) {
				return $this->response([
					'status' => 401,
					'pesan' => 'mohon login kembali!'
				], 401);
			}
		
			$this->form_validation->set_rules('id_lelang', 'Id Lelang', 'required');
			$this->form_validation->set_rules('tawaran', 'Tawaran', 'required|max_length[8]',[
				'max_length' => 'Jumlah tawaran maksimal adalah Rp. 9.999.999 !'
			]);

			if (!$this->form_validation->run()) {
				return $this->response([
					'status' => 400,
					'pesan' => $this->getError([
							form_error('id_lelang'),
							form_error('tawaran')
					])
				], 400);
			}

			$id = $this->input->post('id_lelang');
			$lelang = $this->db->get_where('lelang',[ 'id_lelang' =>  $id])->row_array();
			$query = "SELECT harga_tawar FROM tawaran WHERE id_lelang = '$id' ORDER BY harga_tawar DESC LIMIT 1 ";
			$tawaranTertinggi = (int) $this->db->query($query)->row_array()['harga_tawar'];

			date_default_timezone_set('Asia/Makassar');
			$waktuSekarang = date('Y-m-d H:i:s');
			if($waktuSekarang > $lelang['waktu_selesai']){
				return $this->response([
					'status' => false,
					'pesan' => "Waktu lelang telah berakhir silahkan kembali !"
				], RestController::HTTP_BAD_REQUEST);
			}
			if($peserta['nohp'] == NULL || $peserta['alamat'] == NULL){
				return $this->response([
					'status' => false,
					'pesan' => "Lengkapi data diri terlebih dahulu!"
				], RestController::HTTP_BAD_REQUEST);
			}

			if((int)$lelang['harga_buka'] > (int) $this->post('tawaran') && !$tawaranTertinggi) {
				$x = $lelang['harga_buka'];
				return $this->response([
					'status' => false,
					'pesan' => "Tawaran minimal adalah Rp.{$x}"
				], RestController::HTTP_BAD_REQUEST);
			}
		
			if ($this->post('tawaran') > $tawaranTertinggi) {
				$tawaran = $this->post('tawaran');
				$kelipatan = $lelang['kelipatan'];
				$tawaranKelipatan = $tawaranTertinggi + $kelipatan;
				if($tawaran >= $tawaranKelipatan){
					$data = [
						'id_lelang' => $id,
						'id_peserta' => $peserta['id_peserta'],
						'harga_tawar' => $this->post('tawaran'),
						'waktu_penawaran' => date('Y-m-d H:i:s')
					];
					
					if ($this->Model_lelang->tambahPenawaran($data) > 0 ) {
						$idP = $peserta['id_peserta'];
						$query = "SELECT * FROM tawaran WHERE id_peserta = '$idP' ORDER BY id_tawaran DESC LIMIT 1";
						$tawaran = $this->db->query($query)->row_array();
						return $this->response([
							'status' => 200,
							'pesan' => "Tawaran berhasil ditambahkan",
							'tawaran' => $tawaran
						], 200);
					}
				}
				return $this->response([
					'status' => 500,
					'pesan' => "Tawaran harus kelipatan ".$kelipatan
				], 500);
			}
			$this->response([
				'status' => false,
				'pesan' => "Tawaran harus diatas Rp.{$tawaranTertinggi}"
			], RestController::HTTP_BAD_REQUEST);
    }
}
