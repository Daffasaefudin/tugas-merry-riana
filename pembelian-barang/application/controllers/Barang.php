<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->model('Barang_model');

        if ($this->session->userdata('level') != "MANAGER") {
            ?>
            <script type="text/javascript">
                alert('Anda tidak berhak mengakses halaman ini!');
                window.location = '<?php echo base_url("Login/home"); ?>'
            </script>
            <?php
        }
    }

    public function index()
    {
        $data['page'] = "Barang";
        $data['list'] = $this->Barang_model->tampil();
        $this->load->view('barang/index', $data);
    }

    //menampilkan view create
    public function create()
    {
        $data['page'] = "Barang";
        $this->load->view('barang/create', $data);
    }

    //menambahkan data ke database
    public function store()
    {
        $data = [
            'nama_barang' => $this->input->post('nama_barang'),
            'harga' => $this->input->post('harga')
        ];

        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');




        if ($this->form_validation->run() != false) {
            $result = $this->Barang_model->insert($data);
            if ($result) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
                redirect('Barang');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>');
            redirect('Barang/create');

        }
    }


    public function edit($id_barang)
    {
        $data['page'] = "Kriteria";
        $data['barang'] = $this->Barang_model->show($id_barang);
        $this->load->view('barang/edit', $data);
    }

    public function update($id_barang)
    {
        // TODO: implementasi update data berdasarkan $id_barang
        $id_barang = $this->input->post('id_barang');
        $data = array(
            'nama_barang' => $this->input->post('nama_barang'),
            'harga' => $this->input->post('harga'),


        );

        $this->Barang_model->update($id_barang, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
        redirect('barang');
    }

    public function destroy($id_barang)
    {
        $this->Barang_model->delete($id_barang);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        redirect('barang');
    }

}
