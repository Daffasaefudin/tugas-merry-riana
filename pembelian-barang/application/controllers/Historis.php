<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Historis extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('Historis_model');

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
        $data['page'] = "Historis";
        $data['list'] = $this->Historis_model->tampil();
        $this->load->view('historis/index', $data);
    }


}
