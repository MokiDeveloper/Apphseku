<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homeview extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Fitto_work');
		// $this->load->model('Pegawai_model');
	}

	public function index(){
		$data['title'] = 'Aplikasi Fit to Work';
		$this->load->view('home/form', $data);
		
		// return view('home/form');
	}

	public function insertdata(){
	$this->Fitto_work->tambah();
	// $this->session->set_flashdata('msg','simpan');
	// $this->load->view('home/form');

	$this->db->trans_complete();
		if ($this->db->trans_status() == TRUE) {
			$this->session->set_flashdata('success', 'Data Berhasil Disimpan.');
			redirect('home', 'refresh');
		} else {
			$this->session->set_flashdata('error', 'Terjadi kesalahan.');
			redirect('home', 'refresh');
		}
	}

	
}