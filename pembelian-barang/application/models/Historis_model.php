<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Historis_model extends CI_Model
{

    public function tampil()
    {
        $this->db->from('historis_proses_barang pb');
        $this->db->join('barang b', 'pb.id_barang = b.id_barang', 'LEFT');
        $this->db->query("SELECT * FROM historis_proses_barang ORDER BY id_approve ASC");
        return $this->db->get()->result();
    }





}
