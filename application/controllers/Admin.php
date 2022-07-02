<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('datatables');
		$this->load->model('Kesehatan_model');
		$this->load->model('Pegawai_model');
		$this->load->model('Admin_model');
	}

	public function index()
	{
		if ($this->session->userdata('id_admin') <> '') {
			redirect('admin/dashboard', 'refresh');
		}

		// $data['get_setting']            = $this->Admin_model->get_ones("settings", "id = 1");
		$this->load->view('admin/login');
	}

	public function history()
	{
		$data = [
			'title' => 'History',
			'historylog' => $this->Admin_model->view('history')->result()
		];
		$data['title'] = 'Admin Dashboard';
		$this->load->view('admin/layout/header', $data);
		$this->load->view('admin/layout/sidebar', $data);
		$this->load->view('history/history', $data);
		$this->load->view('admin/layout/footer', $data);
	}

	public function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$checkAdmin = Admin_model::checkAdmin($username);
		$checkPassword = Admin_model::checkPassword($username, $password);

		if ($checkAdmin->num_rows() == 1) {
			if ($checkPassword) {

				$this->setSession($checkAdmin->row_array());
				redirect('admin/dashboard');
			} else {
				$this->session->set_flashdata('error', 'Data admin tidak tersedia.');
				redirect('admin', 'refresh');
			}
		} else {
			$this->session->set_flashdata('error', 'Password tidak sesuai.');
			redirect('admin', 'refresh');
		}
		$data = [
			'datadep' => $this->Admin_model->nampil_data()->result(),

		];

		$this->load->view('admin/login', $data);
	}

	public function dashboard()
	{
		if (!$this->session->userdata('id_admin')) {
			$this->session->set_flashdata('error', 'Harap login terlebih dahulu.');
			redirect('admin', 'refresh');
		}

		$pegawai = $this->db->select('*')->from('tb_fit_towork')->get()->num_rows();
		$total_konsumsi_obat = $this->db->select('')->from('tb_fit_towork')->where('konsumsi_obat', 'Ya')->get()->num_rows();
		// echo '<pre>';
		// print_r($pegawai);
		// echo '</pre>';
		// die;

		$data = [
			'title' => 'Data Fit to Work',
			'pegawai' => $pegawai,
			'total_konsumsi_obat' => $total_konsumsi_obat,
			// 'xkes' => $this->Admin_model->tampil_data()->result(),
			'xfitwork' => $this->Admin_model->datafito_work()->result(),
			// 'datadep' => $this->Admin_model->nampil_data()->result()

		];

		$data_sibar = [
			'datadep' => $this->Admin_model->nampil_data()->result()

		];

		$sessionID = $this->session->userdata('id_admin');
		$data['login'] = Admin_model::getByID($sessionID);
		$data['title'] = 'Admin Dashboard';
		$this->load->view('admin/layout/header', $data);
		$this->load->view('admin/layout/sidebar', $data_sibar);
		$this->load->view('admin/dashboard', $data);
		$this->load->view('admin/layout/footer', $data);
	}

	// public function layout(){
	// 	$this->load->view('admin/dashboard', $data);
	// }

	public function exportExcel()
	{
		$this->load->library('excel');

		$object = new PHPExcel();

		$object->setActiveSheetIndex(0);

		$table_columns = $this->columExcel();

		$column = 0;

		foreach ($table_columns as $field) {

			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);

			$column++;
		}

		$employee_data = Kesehatan_model::dataForExcel();

		$excel_row = 2;
		$nomornya = 1;
		foreach ($employee_data as $row) {
			$pegawai = $this->db->get_where('tb_kesehatan', ['nama' => $row->nama])->row();
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $nomornya++);
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $pegawai->nama);
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $pegawai->nrp);
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $pegawai->jabatan);
			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $pegawai->subcont);
			$object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $pegawai->alamat);
			$object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->info_klinis1);
			// $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->info_klinis2);
			$object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->info_klinis3);
			$object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row->info_klinis4);
			$object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row->info_sakit);
			$object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row->riwayat_perjalanan);
			$object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $row->tggl_perjalanan);
			$object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $row->riwayat_kunjung);
			$object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $row->tggl_kunjung);
			$object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, $row->tanggal_kerumah);
			$object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, $row->transportasi);
			$object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, $row->transit);
			$excel_row++;
		}

		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');

		header('Content-Type: application/vnd.ms-excel');

		header('Content-Disposition: attachment;filename="Data Self Assessment.xls"');

		$object_writer->save('php://output');
	}

	private function columExcel()
	{
		return [
			'No', 'Nama', 'NIK', 'Jabatan', 'Subcont', 'Alamat',
			'Informasi Klinis 1', 'Informasi Klinis 3',
			'Informasi Klinis 4', 'Riwayat Kontak', 'Keluar Negeri', 'Tanggal Keluar',
			'Dalam Negeri', 'Tanggal Negeri', 'Tanggal Kembali Kerumah',
			'Transportasi', 'Transit'
		];
	}
	private function setSession($data = [])
	{
		return $this->session->set_userdata($data);
	}


	// Add BY JIO ASHTER FOUNDER https://techdevelops.com


	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('notif', '<div class="alert alert-warning" role="alert"> Logged Out! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect(base_url('admin/login'));
	}

	public function goback()
	{
		redirect(base_url('home'));
	}

	public function self_assesment()
	{

		if (!$this->session->userdata('id_admin')) {
			$this->session->set_flashdata('error', 'Harap login terlebih dahulu.');
			redirect('admin', 'refresh');
		}

		// Get Data Kesehatan
		$data = [
			'title' => 'Data Self Assessment',
			'fitwork' => $this->Admin_model->tampil_data()->result()
		];

		$sessionID = $this->session->userdata('id_admin');
		$data['login'] = Admin_model::getByID($sessionID);
		$data['title'] = 'Self Assessment';
		$this->load->view('admin/layout/header', $data);
		$this->load->view('admin/layout/sidebar', $data);
		// $this->load->view('admin/dashboard', $data);
		$this->load->view('admin/assesment');
		$this->load->view('admin/layout/footer', $data);
	}

	public function del($id_pegawai)
	{

		if ($this->Admin_model->hapus_data($id_pegawai) == true) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
					<strong> Pemberitahuan! </strong> Data assesment berhasil dihapus!.</div>');
		}
		redirect('admin/self_assesment');
	}

	public function update()
	{
		$data = [
			'nm_lengkap' => htmlspecialchars($this->input->post('nm_lengkap', true)),
			'gender' => htmlspecialchars($this->input->post('gender', true)),
			'nik' => htmlspecialchars($this->input->post('nik', true)),
			'no_kk' => htmlspecialchars($this->input->post('no_kk', true)),
			'email' => htmlspecialchars($this->input->post('email', true)),
			'username' => htmlspecialchars($this->input->post('username', true)),
			// 'password'=> password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'is_aktif' => htmlspecialchars($this->input->post('is_aktif', true)),
			'updated_at' => htmlspecialchars($this->input->post('updated_at', true)),
		];

		$data2 = [
			'nama' => htmlspecialchars($this->input->post('nm_lengkap', true)),
			'username' => htmlspecialchars($this->input->post('username', true)),
			// 'password'=> password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'is_aktif' => htmlspecialchars($this->input->post('is_aktif', true)),
			'updated_at' => htmlspecialchars($this->input->post('updated_at', true)),
			// 'uniq_key' => htmlspecialchars($this->input->post('uniq_key', true)),
		];

		$this->db->where('peserta_id', $this->input->post('peserta_id'));
		$this->db->update('peserta', $data);

		$this->db->where('uniq_key', $this->input->post('uniq_key'));
		$this->db->update('user', $data2);

		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong><i class="icon fa fa-check"></i> Pemberitahuan!</strong> Data berhasil diubah.</div>');
		redirect('admin/self_assesment');
	}

	public function to_work()
	{

		if (!$this->session->userdata('id_admin')) {
			$this->session->set_flashdata('error', 'Harap login terlebih dahulu.');
			redirect('admin', 'refresh');
		}

		// Get Data Kesehatan
		$data = [
			'title' => 'Fit To Work',
			'fitworkdata' => $this->Admin_model->datafito_work()->result()
		];

		$sessionID = $this->session->userdata('id_admin');
		$data['login'] = Admin_model::getByID($sessionID);
		$data['title'] = 'Fit to Work';
		$this->load->view('admin/layout/header', $data);
		$this->load->view('admin/layout/sidebar', $data);
		// $this->load->view('admin/dashboard', $data);
		$this->load->view('admin/fit_towork');
		// $this->load->view('admin/export-data');
		$this->load->view('admin/layout/footer', $data);
	}

	public function del_fit($id)
	{

		if ($this->Admin_model->deldata_fit($id) == true) {
			$desc = 'Data ID $id dihapus';
			$data = array(
				'description'         	=> $desc,
				'name_admin'			=> $this->session->userdata('username'),
			);
			// print_r($data);
			// die();

			$insert_data = $this->Admin_model->insertss('history', $data);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
					<strong> Pemberitahuan! </strong> Data Fit to Work berhasil dihapus!.</div>');
		}
		redirect('admin/to_work');
	}


	public function edit_fit()
	{

		$datanet = $this->input->post('tb_fit_towork', TRUE);
		$id = $this->input->post('id');
		$nama_pegawai = $this->input->post('nama_pegawai');
		$nrp = $this->input->post('nrp');
		$jabatan = $this->input->post('jabatan');
		$ket_24 = $this->input->post('ket_24');
		$ket_48 = $this->input->post('ket_48');
		$terjaga = $this->input->post('terjaga');
		$konsumsi_obat = $this->input->post('konsumsi_obat');
		$masalah_pribadi = $this->input->post('masalah_pribadi');
		// $data = array('nama_pegawai' => $nama_pegawai);
		$data = array(
			'name'              => $nama_pegawai,
			'nrp_pegawai'       => $nrp,
			'jabatan'			=> $jabatan,
			'tidur_24_jam'		=> $ket_24,
			'tidur_48_jam'		=> $ket_48,
			'terjaga'			=> $terjaga,
			'konsumsi_obat'		=> $konsumsi_obat,
			'masalah_pribadi'	=> $masalah_pribadi,
		);
		// $data = array('name' => $datanet);
		// var_dump($data);
		// die();

		$update_dataa = $this->Admin_model->update('tb_fit_towork', $data, 'id', $id);
		// var_dump($action);
		// die();

		// $this->Admin_model->update_data($id, $data);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
					<strong></strong> Data Berhasil Updates</div>');
		redirect('admin/to_work');
	}
}
// }
