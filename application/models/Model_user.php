<?php
class Model_user extends CI_Model
{
    public function tampilUser($id = null)
    {
        if ($id == null) {
            return $this->db->get('peserta')->result_array();
        } else {
            return $this->db->get_where('peserta', ['id_peserta' => $id])->row_array();
        }
    }

    public function editUser($id)
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'nohp' => $this->input->post('nohp'),
            'alamat' => $this->input->post('alamat'),
            'password' => $this->input->post('password')
        ];
        $this->db->set($data);
        $this->db->where('id_peserta', $id);
        $this->db->update('peserta');
    }

    public function hapusUser($id)
    {
        $this->db->delete('peserta', ['id_peserta' => $id]);
    }


    //API Tambh Peserta
    public function tambahUser($data)
    {
        $this->db->insert('peserta', $data);
        return $this->db->affected_rows();
    }

    //API Update Peserta
    public function updateUser($data, $id)
    {
        $this->db->set($data);
        $this->db->where('id_peserta', $id);
        $this->db->update('peserta');

        return $this->db->affected_rows();
    }
}
