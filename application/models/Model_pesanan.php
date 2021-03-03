<?php
class Model_pesanan extends CI_Model
{
    public function tampilpesanan()
    {
        $query = "SELECT * FROM pesanan INNER JOIN peserta ON pesanan.id_peserta = peserta.id_peserta INNER JOIN lelang ON pesanan.id_lelang = lelang.id_lelang ORDER BY id_pesanan DESC";
        return $this->db->query($query)->result_array();
    }

    public function updateStatuspesanan($id)
    {
        $data = [
            'status_pembayaran' => $this->input->post('status_pembayaran', true)
        ];
        $this->db->set($data);
        $this->db->where('id_pesanan', $id);
        $this->db->update('pesanan');
    }

    public function hapuspesanan($id)
    {
        $this->db->delete('pesanan', ['id_pesanan' => $id]);
    }


    public function tampilPengiriman($id = null)
    {
        if ($id == null) {
            $query = "SELECT `pesanan`.`id_pesanan`,`pengiriman`.`id_pengiriman`,`pengiriman`.`nomor_resi`,`pengiriman`.`status_pengiriman` FROM `pengiriman` INNER JOIN `pesanan` ON `pengiriman`.`id_pesanan` = `pesanan`.`id_pesanan` WHERE `status_pembayaran` = 'lunas' ";
            return $this->db->query($query)->result_array();
        } else {
            $query = "SELECT `pesanan`.`id_pesanan`,`pengiriman`.`id_pengiriman`,`pengiriman`.`nomor_resi`,`pengiriman`.`status_pengiriman` FROM `pengiriman` INNER JOIN `pesanan` ON `pengiriman`.`id_pesanan` = `pesanan`.`id_pesanan` WHERE `id_peserta` = '$id' ";
            return $this->db->query($query)->result_array();
        }
        // return $this->db->get('pengiriman')->result_array();
    }

    public function inputPengiriman()
    {
        $data = [
            'id_pesanan' => $this->input->post('id_pesanan', true),
            'status_pengiriman' => $this->input->post('status_pengiriman', true),
            'nomor_resi' => $this->input->post('nomor_resi', true)
        ];
        $this->db->insert('pengiriman', $data);
    }

    public function editPengiriman($id)
    {
        $data = [
            'nomor_resi' => $this->input->post('nomor_resi', true)
        ];

        $this->db->set($data);
        $this->db->where('id_pengiriman', $id);
        $this->db->update('pengiriman');
    }

    public function editStatusPengirimanTabelPesanan()
    {
        $id = $this->input->post('id_pesanan');
        $data = [
            'status_pengiriman' => $this->input->post('status_pengiriman', true)
        ];
        $this->db->set($data);
        $this->db->where('id_pesanan', $id);
        $this->db->update('pesanan');
    }

    public function hapusPengiriman($id)
    {
        //update status pengiriman di tabel pesanan
        $id_pesanan = $this->db->get_where('pengiriman', ['id_pengiriman' => $id])->row_array();
        $this->db->set('status_pengiriman', 'proses');
        $this->db->where('id_pesanan', $id_pesanan['id_pesanan']);
        $this->db->update('pesanan');

        $this->db->delete('pengiriman', ['id_pengiriman' => $id]);
    }


    public function tampilPesananFilter()
    {
        $awalTanggal = $this->input->post('awalTanggal');
        $akhirTanggal = $this->input->post('akhirTanggal');
        $query = "SELECT * FROM pesanan INNER JOIN peserta ON pesanan.id_peserta = peserta.id_peserta INNER JOIN lelang ON pesanan.id_lelang = lelang.id_lelang WHERE waktu_pembayaran BETWEEN '$awalTanggal' and '$akhirTanggal' ORDER BY waktu_pembayaran DESC";
        return $this->db->query($query)->result_array();
    }


    public function getJumlahPenjualan()
    {
        $awalTanggal = $this->input->post('awalTanggal');
        $akhirTanggal = $this->input->post('akhirTanggal');
        if ($this->db->get_where('pesanan', ['status_pembayaran' => 'lunas'])) {
            $this->db->select_sum('jumlah_bayar');
            $this->db->where("waktu_pembayaran BETWEEN '$awalTanggal' AND '$akhirTanggal' ");
            return $this->db->get('pesanan')->row_array();
        }
    }


	public function tambahPesanan($data)
	{
		$this->db->insert('pesanan',$data);
		return $this->db->affected_rows();
	}


}
