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
		
		$upload_gambar = $_FILES['gambar']['name'];
		if($upload_gambar){
			$count = count($upload_gambar);
			for($i = 0; $i<$count ; $i++){
				$gambar = $upload_gambar[$i];

				//cek type file
				$valid = ['png','jpg','jpeg'];
				$ekstensi = explode('.',$gambar);
				$ekstensi = strtolower(end($ekstensi));
				if(!in_array($ekstensi,$valid)){
					return	$this->db->affected_rows();
				}

				$tmp = $_FILES['gambar']['tmp_name'][$i];
				move_uploaded_file($tmp,'./assets/img/'.$gambar);
				$query = "SELECT id_lelang FROM lelang ORDER BY id_lelang DESC LIMIT 1";
				$lelang = $this->db->query($query)->row_array();
				$idLelang = $lelang['id_lelang'] + 1;
				$data = [
					'id_lelang' => $idLelang,
					'nama_gambar' => $gambar
				];
				$this->db->insert('gambar', $data);

			}
			$data = [
				'nama_ikan_hias' => $this->input->post('nama'),
				'harga_buka' => $this->input->post('harga_buka'),
				'kelipatan' => $this->input->post('kelipatan'),
				'deskripsi' => $this->input->post('deskripsi'),
				'waktu_mulai' => $this->input->post('waktu_mulai'),
				'waktu_selesai' => $this->input->post('waktu_selesai')
			];
			$this->db->insert('lelang', $data);
			

			return	$this->db->affected_rows();
		}

    }


    public function editLelang($id)
    {
        $data['lelang'] = $this->db->get_where('lelang', ['id_lelang' => $id])->row_array();
		$upload_gambar = $_FILES['gambar']['name'];
		if($upload_gambar){
			$count = count($upload_gambar);
			$this->db->delete('gambar',['id_lelang'=>$id]);
			for($i = 0; $i<$count ; $i++){
				$gambar = $upload_gambar[$i];
				
				//cek type file
				$valid = ['png','jpg','jpeg'];
				$ekstensi = explode('.',$gambar);
				$ekstensi = strtolower(end($ekstensi));
				if(!in_array($ekstensi,$valid)){
					return	false;
				}

				$tmp = $_FILES['gambar']['tmp_name'][$i];
				move_uploaded_file($tmp,'./assets/img/'.$gambar);
				$data = [
					'id_lelang' => $id,
					'nama_gambar' => $gambar
				];
				$this->db->insert('gambar', $data);
			}

			$data = [
				'nama_ikan_hias' => $this->input->post('nama'),
				'harga_buka' => $this->input->post('harga_buka'),
				'kelipatan' => $this->input->post('kelipatan'),
				'deskripsi' => $this->input->post('deskripsi'),
				'waktu_mulai' => $this->input->post('waktu_mulai'),
				'waktu_selesai' =>$this->input->post('waktu_selesai')
			];
			$this->db->set($data);
			$this->db->where('id_lelang', $id);
			$this->db->update('lelang');

			return true;
		}
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
