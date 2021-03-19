<?php
class Model_lelang extends CI_Model
{
    public function tampilLelang($id = null)
    {
        if ($id == null) {
			$this->db->order_by('id_lelang','DESC');
            return $this->db->get('lelang')->result_array();
        } else {
            return $this->db->get_where('lelang', ['id_lelang' => $id])->row_array();
        }
    }

    public function tambahLelang()
    {

        //cek gambar
        $upload_gambar = $_FILES['gambar']['name'];
        if ($upload_gambar) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '8000';
            $config['upload_path'] = './assets/img/';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('gambar')) {
                $gambar = $this->upload->data('file_name');
                $data = [
                    'nama_ikan_hias' => $this->input->post('nama'),
                    'harga_buka' => $this->input->post('harga_buka'),
                    'gambar' => $gambar,
                    'deskripsi' => $this->input->post('deskripsi'),
                    'waktu_mulai' => $this->input->post('waktu_mulai'),
                    'waktu_selesai' => $this->input->post('waktu_selesai')
                ];
                $this->db->insert('lelang', $data);
            } else {
                echo $this->upload->display_errors();
            }
        } else {
            echo "<script>alert('Gagal menambahkan lelang !)</script>";
        }
    }



    public function editLelang($id)
    {

        $data['lelang'] = $this->db->get_where('lelang', ['id_lelang' => $id])->row_array();
        //cek gambar
        $upload_gambar = $_FILES['gambar']['name'];
        if ($upload_gambar) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '8000';
            $config['upload_path'] = './assets/img/';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('gambar')) {
                $gambar_baru = $this->upload->data('file_name');
                $this->db->set('gambar', $gambar_baru);
            } else {
                echo $this->upload->display_errors();
            }
        }

    
        $data = [
            'nama_ikan_hias' => $this->input->post('nama'),
            'harga_buka' => $this->input->post('harga_buka'),
            'deskripsi' => $this->input->post('deskripsi'),
            'waktu_mulai' => $this->input->post('waktu_mulai'),
            'waktu_selesai' =>$this->input->post('waktu_selesai')
        ];
        $this->db->set($data);
        $this->db->where('id_lelang', $id);
        $this->db->update('lelang');
    }

    public function hapusLelang($id)
    {
        $this->db->delete('lelang', ['id_lelang' => $id]);
    }


    // PENAWARAN


    public function tampilTawarLelang()
    {
        $query = "SELECT * FROM tawaran INNER JOIN peserta ON tawaran.id_peserta = peserta.id_peserta INNER JOIN lelang ON tawaran.id_lelang = lelang.id_lelang ORDER BY harga_tawar DESC,  waktu_penawaran ASC ";
        return $this->db->query($query)->result_array();
    }

    public function tambahPenawaran($data)
    {
        $this->db->insert('tawaran', $data);
        return $this->db->affected_rows();
    }

}
