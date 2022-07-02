<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis extends CI_Controller {
	private $direct 	= 'jenis';
	public 	$id_user 	= '';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_log','history');
		$this->load->model('layout');
		$this->load->model('role');
		$this->load->model('sweetalert');
		$this->load->model('M_jenis','jenis');
		$this->role->akses(1);
		$this->id_user 	= $this->session->userdata('id_user');
	}

	public function index()
	{
		$this->layout->view_admin('jenis/index','Manajemen Jenis Berkas');
	}

	public function ajax()
	{
		$list 		= $this->jenis->getJenis();
		$data 		= array();
		$no 		= $this->input->post('start');
		$role_me	= $this->session->userdata('role');
		foreach ($list as $item) {
			$no++;

			$button 	= "";
			$button 	.= "
			<div class='text-center'>
			<a href='".$item->id_jenis ."'' class='btn btn-success btnUbah btn-xs'><i class='fas fa-fw fa-pen'></i></a>
			";
			$button 	.= "
			<a href='".base_url('jenis/hapus?id_jenis='.$item->id_jenis) ."'' class='btn btn-danger btnHapus btn-xs'><i class='fas fa-fw fa-trash'></i></a>
			</div>

			";

			$row 	= array();

			$row[] 	= "<div class='text-center'>".$no.".</div>";
			$row[] 	= $item->nama_jenis;
			$row[] 	= $button;

			$data[] = $row;
		}
		$output = array(
			"draw" => $this->input->post('draw'),
			"recordsTotal" => $this->jenis->countAllJenis(),
			"recordsFiltered" => $this->jenis->countFilteredJenis(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	public function tambah()
	{
		$cek 	= $this->jenis->tambah();
		if ($cek) {
			$this->history->log($this->id_user,'Berhasil Menambahkan Jenis Berkas');
			$this->sweetalert->set('Berhasil!','Data Berhasil Ditambahkan','success');
		}else{
			$this->history->log($this->id_user,'Gagal Menambahkan Jenis Berkas');
			$this->sweetalert->set('Gagal!','Data Gagal Ditambahkan','error');
		}
		redirect($this->direct,'refresh');
	}
	public function ubah()
	{
		$cek 	= $this->jenis->ubah();
		if ($cek) {
			$this->history->log($this->id_user,'Berhasil Mengubah Jenis Berkas');
			$this->sweetalert->set('Berhasil!','Data Berhasil Diubah','success');
		}else{
			$this->history->log($this->id_user,'Gagal Mengubah Jenis Berkas');
			$this->sweetalert->set('Gagal!','Data Gagal Diubah','error');
		}
		redirect($this->direct,'refresh');
	}
	public function hapus()
	{
		$cek 	= $this->jenis->hapus();
		if ($cek) {
			$this->history->log($this->id_user,'Berhasil Menghapus Jenis Berkas');
			$this->sweetalert->set('Berhasil!','Data Berhasil Dihapus','success');
		}else{
			$this->history->log($this->id_user,'Gagal Menghapus Jenis Berkas');
			$this->sweetalert->set('Gagal!','Data Gagal Dihapus','error');
		}
		redirect($this->direct,'refresh');
	}
	public function getById()
	{
		$id 	= $this->input->post('id_jenis');
		$this->db->where('id_jenis', $id);
		$get 	= $this->db->get('jenis')->row();
		echo json_encode($get);
	}

}

/* End of file Jenis.php */
/* Location: ./application/controllers/Jenis.php */