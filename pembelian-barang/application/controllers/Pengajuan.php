<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->model('Pengajuan_model');
        $this->load->model('Barang_model');
        date_default_timezone_set('Asia/Jakarta');

    }

    public function index()
    {
        $data['page'] = "Pengajuan";
        $data['list'] = $this->Pengajuan_model->tampil();
        $data['list1'] = $this->Pengajuan_model->tampil_manager();
        $data['list2'] = $this->Pengajuan_model->tampil_finance();
        $this->load->view('pengajuan/index', $data);
    }

    //menampilkan view create
    public function create()
    {
        $data['page'] = "Pengajuan";
        $data['barang'] = $this->Barang_model->getbarang();
        $this->load->view('pengajuan/create', $data);
    }

    //menambahkan data ke database
    public function store()
    {
        $data = [
            'id_user' => $this->input->post('id_user'),
            'id_barang' => $this->input->post('id_barang'),
            'harga' => $this->input->post('harga'),
            'jumlah' => $this->input->post('jumlah'),
            'total' => $this->input->post('total'),
            'approve' => "PROSESM",
            'tanggal_pengajuan' => date("Y-m-d h:i:sa")
        ];
        $this->form_validation->set_rules('id_user', 'User', 'required');
        $this->form_validation->set_rules('id_barang', 'Nama Barang', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
        $this->form_validation->set_rules('total', 'Total', 'required');


        if ($this->form_validation->run() != false) {
            $result = $this->Pengajuan_model->insert($data);
            if ($result) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
                redirect('Pengajuan');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>');
            redirect('Pengajuan/create');

        }
    }


    public function edit($id_pengajuan)
    {
        $data['page'] = "Pengajuan";
        $data['pengajuan'] = $this->Pengajuan_model->show($id_pengajuan);
        $data['barang'] = $this->Barang_model->getbarang();
        $this->load->view('pengajuan/edit', $data);
    }

    public function update($id_pengajuan)
    {
        // TODO: implementasi update data berdasarkan $id_pengajuan
        $id_pengajuan = $this->input->post('id_pengajuan');
        $data = array(
            'id_barang' => $this->input->post('id_barang'),
            'harga' => $this->input->post('harga'),
            'jumlah' => $this->input->post('jumlah'),
            'total' => $this->input->post('total'),


        );

        $this->Pengajuan_model->update($id_pengajuan, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
        redirect('pengajuan');
    }

    public function destroy($id_pengajuan)
    {
        $this->Pengajuan_model->delete($id_pengajuan);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        redirect('pengajuan');
    }
    public function approve_manager($id_pengajuan)
    {
        // TODO: implementasi update data berdasarkan $id_pengajuan
        $data = array(
            'approve' => "PROSESF"
        );

        $this->Pengajuan_model->approve_m($id_pengajuan, $data);
        $data = $this->Pengajuan_model->historis($id_pengajuan);
        foreach ($data as $a) {
            $data1 = array(
                'id_user' => $a->id_user,
                'id_barang' => $a->id_barang,
                'harga' => $a->harga,
                'jumlah' => $a->jumlah,
                'total' => $a->total,
                'tanggal_pengajuan' => $a->tanggal_pengajuan,
                'tanggal_approve' => date("Y-m-d h:i:sa")
            );

            // var_dump($data1);
            // die;
            $this->Pengajuan_model->insert_historis($data1);

        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di Approve!</div>');
        redirect('pengajuan');
    }
    public function approve_finance()
    {
        // Get the id_pengajuan from the POST request
        $id_pengajuan = $this->input->post('id_pengajuan');

        // Configure upload parameters
        $config['upload_path'] = 'assets/uploads/';  // Specify the upload directory
        $config['allowed_types'] = 'jpg|png';  // Specify allowed file types
        $config['max_size'] = 2048;  // Set max size in KB (2MB)

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('bukti')) {
            // Upload failed, show error message
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', 'File upload failed: ' . $error);
            redirect('pengajuan/index');
        } else {
            // Upload success, get uploaded file data
            $fileData = $this->upload->data();
            $filePath = $fileData['full_path'];

            // Example data to update (this could be more complex depending on your needs)
            $ubah = array(
                'approve' => 'APPROVED',
                'bukti' => $filePath
                // Add more fields and values as necessary
            );


            $this->Pengajuan_model->approve_f($id_pengajuan, $ubah);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di approve!</div>');
            redirect('pengajuan');
            redirect('pengajuan/index');
        }
    }
    public function reject()
    {
        // TODO: implementasi update data berdasarkan $id_pengajuan
        $id_pengajuan = $this->input->post('id_pengajuan');
        $data = array(
            'alasan' => $this->input->post('alasan'),
            'approve' => "REJECTED"

        );

        $this->Pengajuan_model->reject($id_pengajuan, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di reject!</div>');
        redirect('pengajuan');
    }
}
