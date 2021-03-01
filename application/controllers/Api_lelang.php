<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') or exit('No direct script access allowed');

class Api_lelang extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_lelang');
        $this->load->library('form_validation');
    }

    public function lelang_get()
    {
        $id = $this->get('id');
        if ($id == null) {
            $lelang = $this->Model_lelang->tampilLelang();
        } else {
            $lelang = $this->Model_lelang->tampilLelang($id);
        }

        if ($lelang) {
            $this->response([
                'status' => true,
                'data' => $lelang
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'pesan' => 'Data tidak ditemukan'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function tawaran_get()
    {
        $tawaran = $this->Model_lelang->tampilTawarLelang();

        if ($tawaran) {
            $this->response([
                'status' => true,
                'data' => $tawaran
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'pesan' => 'Data tidak ditemukan'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function kirimTawaran_post()
    {
        $id = $this->input->post('idLelang');
        $query = "SELECT harga_tawar FROM tawaran WHERE id_lelang = '$id' ORDER BY harga_tawar DESC LIMIT 1 ";
        $tawaranTertinggi = $this->db->query($query)->row_array();

        $this->form_validation->set_rules('idLelang', 'Id Lelang', 'required');
        $this->form_validation->set_rules('tawaran', 'Tawaran', 'required');
        if ($this->form_validation->run() == false) {
        } else {
            if ($this->post('tawaran') > $tawaranTertinggi['harga_tawar']) {
                $data = [
                    'id_lelang' => $this->post('idLelang'),
                    'id_peserta' => 3,
                    'harga_tawar' => $this->post('tawaran'),
                    'status' => 'proses',
                    'waktu_penawaran' => 2020
                ];

                if ($this->Model_lelang->tambahPenawaran($data) > 0) {
                    $this->response([
                        'status' => true,
                        'pesan' => "Tawaran berhasil ditambahkan"
                    ], RestController::HTTP_CREATED);
                } else {
                    $this->response([
                        'status' => false,
                        'pesan' => "Tawaran gagal ditambahkan"
                    ], RestController::HTTP_BAD_REQUEST);
                }
            } else {
                $this->response([
                    'status' => false,
                    'pesan' => 'tawaran telah terdaftar, naikkan tawaran!'
                ], RestController::HTTP_BAD_REQUEST);
            }
        }
    }
}
