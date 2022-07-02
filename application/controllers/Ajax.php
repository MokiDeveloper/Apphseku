<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->library('datatables');
		$this->load->model('Kesehatan_model');
        // $this->load->model('Pegawai_model');
        
    }
    
    public function kesehatan(){
        header('Content-Type: application/json');
        echo Kesehatan_model::getAll();
    }

    // public function pegawai(){
    //     header('Content-Type: application/json');
    //     echo Pegawai_model::getAll();
    // }
}