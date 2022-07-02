<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Kesehatan_model');
		$this->load->model('Pegawai_model');
	}

	public function index(){
		$this->load->view('home/form');
		// return view('home/form');
	}

	public function kirim() {

		$this->form_validation->set_rules('nrp' , 'nrp' , 'trim|is_unique[tb_kesehatan.nrp]',
				['alpha_numeric' => '<div class= col-md-12><div class="alert alert-danger alert-dismissible fade in">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-ban"></i> Pemberitahuan!</h4>
				Mohon mengisi nomor NIK dengan benar.
				</div> </div>','is_unique' => '<div class= col-md-12><div class="alert alert-danger alert-dismissible fade in">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-ban"></i> Pemberitahuan!</h4>
				Nomor NIK sudah digunakan.
				</div> </div>']
			);

		// Form 1
		// $nama_lengkap = $this->input->post('nama_lengkap');
		// $no_nik = $this->input->post('no_nik');
		// $jabatan = $this->input->post('jabatan');
		// $kecamatan = $this->input->post('kecamatan');
		// $alamat = $this->input->post('alamat');
		// $info_klinis1 = $this->input->post('demam');
		// // $info_klinis2 = $this->input->post('batu_pilek');
		// $info_klinis3 = $this->input->post('sesak_nafas');
		// $info_klinis4 = $this->input->post('sakit_tenggorokan');
		// $sakit_lain = $this->input->post('sakit_lain');
		// $kontak_positif = $this->input->post('kontak_positif');
		// $negara_dikunjungi = $this->input->post('negara_dikunjungi');
		// $tgl_negara = $this->input->post('tgl_negara');
		// $kota_dikunjungi = $this->input->post('kota_dikunjungi');
		// $tgl_kota = $this->input->post('tgl_kota');
		// $masuk_babel = $this->input->post('masuk_babel');
		// $transportasi = $this->input->post('transportasi');
		// $transit = $this->input->post('transit');

		// Form 2 Fit to Work
		$nrp_pegawai = $this->input->post('nrp_pegawai');
		$name = $this->input->post('name');
		$tidur_24_jam = $this->input->post('tidur_24_jam');
		$tidur_48_jam = $this->input->post('tidur_48_jam');
		$terjaga = $this->input->post('terjaga');
		$konsumsi_obat = $this->input->post('konsumsi_obat');
		$masalah_pribadi = $this->input->post('masalah_pribadi');


		// $postPegawai  = [
		// 	'nama' => $nama_lengkap,
		// 	'nrp' => $no_nik,
		// 	'jabatan' => $jabatan,
		// 	'subcont' => $kecamatan,
		// 	'alamat' => $alamat
		// ];

		// $postKesehatan = [
		// 	'id_pegawai' => $id_pegawai,
		// 	'nama' => $nama_lengkap,
		// 	'nrp' => $no_nik,
		// 	'jabatan' => $jabatan,
		// 	'subcont' => $kecamatan,
		// 	'alamat' => $alamat,
		// 	'info_klinis1' => $info_klinis1, 
		// 	// 'info_klinis2' => $info_klinis2,
		// 	'info_klinis3' => $info_klinis3,
		// 	'info_klinis4' => $info_klinis4,
		// 	'kontak_positif' => $kontak_positif,
		// 	'info_sakit' => $sakit_lain,
		// 	'riwayat_perjalanan' => $negara_dikunjungi,
		// 	'tggl_perjalanan' => $tgl_negara,
		// 	'riwayat_kunjung' => $kota_dikunjungi,
		// 	'tggl_kunjung' => $tgl_kota,
		// 	'tanggal_kerumah' => $masuk_babel,
		// 	'transportasi' => $transportasi,
		// 	'transit' => $transit
		// ];

		$postFitWork = [
			'nrp_pegawai' => $nrp_pegawai,
			'name' => $name,
			'tidur_24_jam' => $tidur_24_jam,
			'tidur_48_jam' => $tidur_48_jam,
			'terjaga' => $terjaga,
			'konsumsi_obat' => $konsumsi_obat,
			'masalah_pribadi' => $masalah_pribadi
		];

		// var_dump($postKesehatan);
		// die();

		$this->db->insert('tb_fit_towork',$postFitWork);
		
		$this->db->trans_start();
		$kesehatan = Kesehatan_model::insert($postKesehatan);

		


		// Kesehatan_model::insert($postKesehatan);
		$this->db->trans_complete();
		if ($this->db->trans_status() == TRUE) {
			$this->session->set_flashdata('success', 'Tanggapan Berhasil Direkam.');
			redirect('home', 'refresh');
		} else {
			$this->session->set_flashdata('error', 'Terjadi kesalahan.');
			redirect('home', 'refresh');
		}
	}
	
}
/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */