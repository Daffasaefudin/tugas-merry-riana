<?php

defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
use chriskacerguis\RestServer\RestController;

// require APPPATH . 'libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class harga extends RESTController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Barang_model');
    }

    public function harga_get($id = null)
    {
        $response = [
            'message1' => 'Data Barang',
            'data1' => $this->db->where('id_barang', $id)->get('barang')->result_array(),
        ];

        $id = $this->get('id_barang');

        $response += [
            'message2' => 'Data Harga',
            'data2' => $this->db->where('id_barang', $id)->get('proses_barang')->result_array(),
        ];


        if ($id === NULL) {
            if ($response) {
                $this->response($response, RESTController::HTTP_OK);
            } else {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'Tidak ada data yang ditemukan',
                ], RESTController::HTTP_NOT_FOUND);
            }
        }
    }

}