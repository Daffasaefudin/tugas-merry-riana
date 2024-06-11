<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuan_model extends CI_Model
{

    public function tampil()
    {
        $this->db->from('proses_barang pb');
        $this->db->join('barang b', 'pb.id_barang = b.id_barang', 'LEFT');
        return $this->db->get()->result();
    }
    public function tampil_manager()
    {
        $this->db->from('proses_barang pb');
        $this->db->join('barang b', 'pb.id_barang = b.id_barang', 'LEFT');
        $this->db->where('pb.approve', 'PROSESM');
        return $this->db->get()->result();
    }
    public function tampil_finance()
    {
        $this->db->from('proses_barang pb');
        $this->db->join('barang b', 'pb.id_barang = b.id_barang', 'LEFT');
        $this->db->where('pb.approve', 'PROSESF');
        $this->db->or_where('pb.approve', 'APPROVED');
        return $this->db->get()->result();
    }
    public function getTotal()
    {
        return $this->db->count_all('proses_barang');
    }

    public function insert($data = [])
    {
        $result = $this->db->insert('proses_barang', $data);
        return $result;
    }
    public function insert_historis($data = [])
    {
        $result = $this->db->insert('historis_proses_barang', $data);
        return $result;
    }
    public function show($id_pengajuan)
    {
        $this->db->where('id_pengajuan', $id_pengajuan);
        $query = $this->db->get('proses_barang');
        return $query->row();
    }

    public function update($id_pengajuan, $data = [])
    {
        $ubah = array(
            'id_barang' => $data['id_barang'],
            'harga' => $data['harga'],
            'jumlah' => $data['jumlah'],
            'total' => $data['total'],
        );

        $this->db->where('id_pengajuan', $id_pengajuan);
        $this->db->update('proses_barang', $ubah);
    }



    public function delete($id_pengajuan)
    {
        $this->db->where('id_pengajuan', $id_pengajuan);
        $this->db->delete('proses_barang');
    }
    public function approve_m($id_pengajuan, $data = [])
    {
        $ubah = array(
            'approve' => $data['approve'],
            'alasan' => "-",
        );
        $this->db->where('id_pengajuan', $id_pengajuan);
        $this->db->update('proses_barang', $ubah);

        if ($this->db->affected_rows() > 0) {
            // Successfully updated
            $this->db->from('proses_barang');
            $this->db->where('id_pengajuan', $id_pengajuan);
            $hasil = $this->db->get()->result();
            foreach ($hasil as $r) { // loop over results
                $this->db->insert('historis_proses_barang', $r); // insert each row to another table
            }
        }

    }
    public function historis($id_pengajuan)
    {
        $this->db->from('proses_barang');
        $this->db->where('id_pengajuan', $id_pengajuan);
        return $this->db->get()->result();
    }


    public function approve_f($id_pengajuan, $data = [])
    {
        $ubah = array(

            'approve' => $data['approve'],
            'alasan' => "-",
            'bukti' => $data['bukti'],
        );
        $this->db->where('id_pengajuan', $id_pengajuan);
        $this->db->update('proses_barang', $ubah);



    }
    public function reject($id_pengajuan, $data = [])
    {
        $ubah = array(
            'alasan' => $data['alasan'],
            'approve' => $data['approve']
        );

        $this->db->where('id_pengajuan', $id_pengajuan);
        $this->db->update('proses_barang', $ubah);

    }
}
