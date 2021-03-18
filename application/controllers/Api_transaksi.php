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
		if (!$peserta) {
			return $this->response([
				'status' => 401,
				'pesan' => 'mohon login kembali!'
			], 401);
		}

		$this->form_validation->set_rules('id_tawaran', 'Id Tawaran', 'required');
		if (!$this->form_validation->run()) {
			return $this->response([
					'status' => 400,
					'pesan' => $this->getError([
							form_error('id_tawaran')
					])
			], 400);
		}

		$idPeserta = $peserta['id_peserta'];
		$idTawaran = $this->input->post('id_tawaran');
		date_default_timezone_set('Asia/Makassar');
		$now = date('Y-m-d H:i:s');

		$query = "SELECT * FROM tawaran WHERE id_tawaran = $idTawaran AND id_peserta = $idPeserta LIMIT 1";
		$tawaran = $this->db->query($query)->row_array();
		if(!$tawaran) {
			return $this->response([
				'status' => 400,
				'pesan' => 'Id Tawaran tidak valid!'
			], 404);
		}

		$lelang = $this->db->get_where('lelang',['id_lelang' => $tawaran['id_lelang']])->row_array();
		if(!$lelang) {
			return $this->response([
				'status' => 400,
				'pesan' => 'Lelang tidak tersedia!'
			], 404);
		}
		$idLelang = $tawaran['id_lelang'];

		$query = "SELECT * FROM tawaran WHERE id_lelang = $idLelang  ORDER BY harga_tawar DESC LIMIT 1 "; 
		$win = $this->db->query($query)->row_array();

		if($now < $lelang['waktu_selesai']) {
			return $this->response([
				'status' => 400,
				'pesan' => 'Lelang masih berlangsung!'
			], 400);
		}
		
		if($idTawaran != $win['id_tawaran']) {
			return $this->response([
				'status' => 400,
				'pesan' => 'Sayang sekali anda tidak menang!'
			], 400);
		}

		$query = "SELECT * FROM pesanan WHERE id_lelang = $idLelang AND id_peserta = $idPeserta"; 
		$exist = $this->db->query($query)->row_array();

		if($exist) {
			return $this->response([
				'status' => 400,
				'pesan' => 'Pesanan telah dikonfirmasi sebelumnya.'
			], 400);
		}
		
		
		$upload_gambar = $_FILES['file'];
		
		if (!$upload_gambar) {
			return $this->response([
				'status' => 400,
				'pesan' => 'Gambar bukti pembayaran wajib ada!'
			], 400);
		}
		
		$filename = time().$this->rdmStr(15) . '.' . 'png';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '8000';
		$config['upload_path'] = './assets/upload/';
		$config['file_name'] = $filename;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('file')) {
			return $this->response([
				'status' => 400,
				'pesan' => $this->upload->display_errors()
			], 400);
		}

		$data = [
			'id_peserta' => $idPeserta,
			'id_lelang' => $lelang['id_lelang'],
			'id_tawaran' => $idTawaran,
			'jumlah_bayar' => $win['harga_tawar'],
			'bukti_gambar' => $filename,
			'status_pembayaran' => 'pending',
			'status_pengiriman' => 'proses',
			'waktu_pembayaran' => $now
		];

		if($this->Model_pesanan->tambahPesanan($data) > 0){
			return $this->response([
				'status' => 200,
				'pesan' => 'Pesanan berhasil ditambahkan'
			], 200);
		}else{
			return $this->response([
				'status' => 500,
				'pesan' => 'Pesanan gagal ditambahkan'
			], 500);
		}
	}


	public function resi_get()
	{
		$peserta = $this->isLogin();
		if (!$peserta) {
			return $this->response([
				'status' => 401,
				'pesan' => 'mohon login kembali!'
			], 401);
		}

		$idPeserta = $peserta['id_peserta'];
		$idTawaran = $this->input->get('id_tawaran');

		$query = "SELECT * FROM pesanan WHERE id_peserta = '$idPeserta' AND id_tawaran = '$idTawaran'";
		$pesanan =  $this->db->query($query)->row_array();
		
		if(!$pesanan) {
			$this->response([
					'status' => false,
					'pesan' => 'Data tidak ditemukan'
			], RestController::HTTP_BAD_REQUEST);
		}

		$idPesanan = $pesanan['id_pesanan'];
		$query = "SELECT * FROM pengiriman WHERE id_pesanan = '$idPesanan'";
		$pengiriman =  $this->db->query($query)->row_array();

		$this->response([
			'status' => true,
			'data' => [
				'pesanan' => $pesanan,
				'pengiriman' => $pengiriman
			]
		], RestController::HTTP_OK);
	}
}

