<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Fitto_work extends CI_Model {
	public function __construct(){
		parent::__construct();
	}
	// public function data_pegawai(){
	// 	$this->db->order_by('nama_pegawai','asc');
	// 	return $this->db->get('pegawai')->result_array();
	// }
	// public function data(){
	// 	$this->db->order_by('nama_pegawai','asc');
	// 	return $this->db->get('pegawai');
	// }
	public function tambah(){
		$d['nrp_pegawai']= $this->input->post('nrp_pegawai');
		$d['name']= $this->input->post('name');
		$d['jabatan']= $this->input->post('jabatan');
		$d['tidur_24_jam']= $this->input->post('tidur_24_jam');
		$d['tidur_48_jam']= $this->input->post('tidur_48_jam');
		$d['terjaga']= $this->input->post('terjaga');
		$d['konsumsi_obat']= $this->input->post('konsumsi_obat');
		$d['masalah_pribadi']= $this->input->post('masalah_pribadi');
		$this->db->insert('tb_fit_towork',$d);
	}

}

