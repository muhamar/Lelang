<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') or exit('No direct script access allowed');


class Api_pengiriman extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_pesanan');
    }

    public function index_get()
    {
        $id = $this->get('id');
        if ($id == null) {
            $pengiriman = $this->Model_pesanan->tampilPengiriman();
        } else {
            $pengiriman = $this->Model_pesanan->tampilPengiriman($id);
        }

        if ($pengiriman) {
            $this->response([
                'status' => true,
                'data' => $pengiriman
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'pesan' => 'Data tidak ditemukan'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}
