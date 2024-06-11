<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{

    public function tampil()
    {
        $query = $this->db->query("SELECT * FROM barang ORDER BY nama_barang ASC");
        return $query->result();
    }

    public function getTotal()
    {
        return $this->db->count_all('barang');
    }

    public function insert($data = [])
    {
        $result = $this->db->insert('barang', $data);
        return $result;
    }

    public function show($id_barang)
    {
        $this->db->where('id_barang', $id_barang);
        $query = $this->db->get('barang');
        return $query->row();
    }

    public function update($id_barang, $data = [])
    {
        $ubah = array(
            'nama_barang' => $data['nama_barang'],
            'harga' => $data['harga'],
        );

        $this->db->where('id_barang', $id_barang);
        $this->db->update('barang', $ubah);
    }



    public function delete($id_barang)
    {
        $this->db->where('id_barang', $id_barang);
        $this->db->delete('barang');
    }
    public function getbarang()
    {
        $query = $this->db->query("SELECT id_barang, nama_barang FROM barang ORDER BY nama_barang ASC");
        return $query->result();
    }
}
