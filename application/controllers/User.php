<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	private $direct 	= 'user';
	public 	$id_user 	= '';
	public function __construct()
	{
		parent::__construct();
		// $this->load->model('M_log','history');
		// // $this->load->model('layout');
		// $this->load->model('role');
		// $this->load->model('sweetalert');
		// $this->load->model('M_user','user');
		// $this->role->akses(1);
		// $this->id_user 	= $this->session->userdata('id_user');
	}

	public function index()
	{
		$data["role"]			= $this->db->get('role')->result();
		$data['title'] = 'Data User';
		$this->load->view('admin/layout/header', $data);
		$this->load->view('admin/layout/sidebar', $data);
		// $this->load->view('admin/dashboard', $data);
		$this->load->view('user/index','Manajemen User',$data);
		$this->load->view('admin/layout/footer', $data);

	// 	public function to_work(){

	// 	if (!$this->session->userdata('id_admin')) {
	// 		$this->session->set_flashdata('error', 'Harap login terlebih dahulu.');
	// 		redirect('admin', 'refresh');
	// 	}

	// 	// Get Data Kesehatan
	// 	$data = [
	// 		'title' => 'Fit To Work',
	// 		'fitworkdata' => $this->Admin_model->datafito_work()->result()
	// 		];

	// 	$sessionID = $this->session->userdata('id_admin');
	// 	$data['login'] = Admin_model::getByID($sessionID);
	// 	$data['title'] = 'Fit to Work';
	// 	$this->load->view('admin/layout/header', $data);
	// 	$this->load->view('admin/layout/sidebar', $data);
	// 	// $this->load->view('admin/dashboard', $data);
	// 	$this->load->view('admin/fit_towork');
	// 	// $this->load->view('admin/export-data');
	// 	$this->load->view('admin/layout/footer', $data);
		
		
	// }

	}

	public function ajax()
	{
		$list 		= $this->user->getUser();
		$data 		= array();
		$no 		= $this->input->post('start');
		$role_me	= $this->session->userdata('role');
		foreach ($list as $item) {
			$no++;

			$button 	= "";
			$button 	.= "
			<div class='text-center'>
			<a href='".$item->id_user ."'' class='btn btn-success btnUbah btn-xs'><i class='fas fa-fw fa-pen'></i></a>
			";
			$button 	.= "
			<a href='".base_url('user/hapus?id_user='.$item->id_user) ."'' class='btn btn-danger btnHapus btn-xs'><i class='fas fa-fw fa-trash'></i></a>
			</div>

			";

			$row 	= array();

			$row[] 	= "<div class='text-center'>".$no.".</div>";
			$row[] 	= $item->username;
			$row[] 	= $item->nama_departemen;
			$row[] 	= $item->nama_role;
			$row[] 	= $button;

			$data[] = $row;
		}
		$output = array(
			"draw" => $this->input->post('draw'),
			"recordsTotal" => $this->user->countAllUser(),
			"recordsFiltered" => $this->user->countFilteredUser(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	public function tambah()
	{
		$cek 	= $this->user->tambah();
		if ($cek) {
			$this->history->log($this->id_user,'Berhasil Menambahkan User');
			$this->sweetalert->set('Berhasil!','Data Berhasil Ditambahkan','success');
		}elseif ($cek == 2) {
			$this->history->log($this->id_user,'Gagal Menambahkan User');
			$this->sweetalert->set('Gagal!','Username Telah Digunakan','error');
		}else{
			$this->history->log($this->id_user,'Gagal Menambahkan User');
			$this->sweetalert->set('Gagal!','Data Gagal Ditambahkan','error');
		}
		redirect($this->direct,'refresh');
	}
	public function ubah()
	{
		$cek 	= $this->user->ubah();
		if ($cek) {
			$this->history->log($this->id_user,'Berhasil Mengubah User');
			$this->sweetalert->set('Berhasil!','Data Berhasil Diubah','success');
		}else{
			$this->history->log($this->id_user,'Gagal Mengubah User');
			$this->sweetalert->set('Gagal!','Data Gagal Diubah','error');
		}
		redirect($this->direct,'refresh');
	}
	public function hapus()
	{
		$cek 	= $this->user->hapus();
		if ($cek) {
			$this->history->log($this->id_user,'Berhasil Menghapus User');
			$this->sweetalert->set('Berhasil!','Data Berhasil Dihapus','success');
		}else{
			$this->history->log($this->id_user,'Gagal Menghapus User');
			$this->sweetalert->set('Gagal!','Data Gagal Dihapus','error');
		}
		redirect($this->direct,'refresh');
	}
	public function getById()
	{
		$id 	= $this->input->post('id_user');
		$this->db->where('id_user', $id);
		$get 	= $this->db->get('user')->row();
		echo json_encode($get);
	}

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */