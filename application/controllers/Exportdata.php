<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exportdata extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('PHPExcel');
		$this->load->model('Fitto_work');
		$this->load->model('Admin_model');
		// $this->load->model('Pegawai_model');
	}

	public function export(){
			$data = [
			'fitworkdata' => $this->Admin_model->datafito_work()->result()
			];
			$this->load->view('admin/export-data', $data);
		
		// return view('home/form');
			// var_dump($fitworkdata);
			// die();

	}
  public function laporan(){

  	$data  = [
  	  	'title' => 'Laporan Data',
  		'laporanfit' => $this->Admin_model->datafito_work()->result()
  	];
		$this->load->view('admin/layout/header', $data);
		$this->load->view('admin/layout/sidebar', $data);
		// $this->load->view('admin/dashboard', $data);
		$this->load->view('laporan/laporan','Manajemen Laporan',$data);
		$this->load->view('admin/layout/footer', $data);


  }
	

	
}