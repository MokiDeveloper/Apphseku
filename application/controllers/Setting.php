<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{
	private $direct 	= 'user';
	public 	$id_user 	= '';
	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		$this->load->library('form_validation');
		// $this->load->model('sweetalert');
		$this->load->model('Admin_model');
	}

	public function setting()
	{
		$data['title'] = 'Master Setting';
		$this->load->view('admin/layout/header', $data);
		$this->load->view('admin/layout/sidebar', $data);
		// $this->load->view('admin/dashboard', $data);
		$this->load->view('setting/setting', 'Manajemen Setting', $data);
		$this->load->view('admin/layout/footer', $data);
	}

	public function tambah()
	{
		$cek 	= $this->user->tambah();
		if ($cek) {
			$this->history->log($this->id_user, 'Berhasil Menambahkan User');
			$this->sweetalert->set('Berhasil!', 'Data Berhasil Ditambahkan', 'success');
		} elseif ($cek == 2) {
			$this->history->log($this->id_user, 'Gagal Menambahkan User');
			$this->sweetalert->set('Gagal!', 'Username Telah Digunakan', 'error');
		} else {
			$this->history->log($this->id_user, 'Gagal Menambahkan User');
			$this->sweetalert->set('Gagal!', 'Data Gagal Ditambahkan', 'error');
		}
		redirect($this->direct, 'refresh');
	}
	public function ubah()
	{
		$cek 	= $this->user->ubah();
		if ($cek) {
			$this->history->log($this->id_user, 'Berhasil Mengubah User');
			$this->sweetalert->set('Berhasil!', 'Data Berhasil Diubah', 'success');
		} else {
			$this->history->log($this->id_user, 'Gagal Mengubah User');
			$this->sweetalert->set('Gagal!', 'Data Gagal Diubah', 'error');
		}
		redirect($this->direct, 'refresh');
	}
	public function hapus()
	{
		$cek 	= $this->user->hapus();
		if ($cek) {
			$this->history->log($this->id_user, 'Berhasil Menghapus User');
			$this->sweetalert->set('Berhasil!', 'Data Berhasil Dihapus', 'success');
		} else {
			$this->history->log($this->id_user, 'Gagal Menghapus User');
			$this->sweetalert->set('Gagal!', 'Data Gagal Dihapus', 'error');
		}
		redirect($this->direct, 'refresh');
	}
	public function getById()
	{
		$id 	= $this->input->post('id_user');
		$this->db->where('id_user', $id);
		$get 	= $this->db->get('user')->row();
		echo json_encode($get);
	}

	public function insertdata()
	{
		$app_name   = $this->input->post('app_name');
		// die($app_name);
		// $alamat = $this->input->post('alamat');

		// get foto
		$config['upload_path'] = './assets/picture';
		$config['allowed_types'] = 'jpg|png|jpeg|gif';
		$config['max_size'] = '2048';  //2MB max
		$config['max_width'] = '4480'; // pixel
		$config['max_height'] = '4480'; // pixel
		$config['file_name'] = $_FILES['fotopost']['name'];

		$this->upload->initialize($config);

		if (!empty($_FILES['fotopost']['name'])) {
			// die($_FILES['fotopost']['name']);
			if ($this->upload->do_upload('fotopost')) {
				$gambar = $this->upload->data();
				// die($gambar['file_name']);
				$data = array(
					'app_name'     => $app_name,
					'gambar'       => $gambar['file_name'],

				);

				$this->Admin_model->insert($data);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Success!!</div>');
			} else {
				// $this->history->log($this->id_user,'Gagal Menambahkan Departemen');
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Gagal!</div>');
			}
			redirect('setting/setting');
		}
	}
} // end class
