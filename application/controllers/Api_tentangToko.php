<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') or exit('No direct script access allowed');



class Api_tentangToko extends RestController
{


    public function index_get()
    {
        $tentangToko = $this->db->get('tentang_toko')->row_array();
        if ($tentangToko) {
            $this->response([
                'status' => true,
                'data' => [
                    'img' => $tentangToko['gambar'],
                    'text' => $tentangToko['tentang_aabetta']
                ]
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'pesan' => 'Data tidak ditemukan'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}
