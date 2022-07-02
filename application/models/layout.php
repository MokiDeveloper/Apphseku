<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layout extends CI_Model {

	public function view_admin($url,$title,$data = [])
	{
		$path 							= explode('/', $this->input->server('PATH_INFO'));
		if (count($path) <= 2) {
			$link 						= $path[1];
		}else{
			$link 						= $path[1].'/'.$path[2];
		}

		$this->set_berkas_inAktif();

		$data["title"]				= $title;
		$data["link"]				= $link;
		$data["username"]			= $this->session->userdata('username');
		$data["role_me"]			= $this->session->userdata('role');
		$data["sweet_title"]		= $this->session->flashdata('title');
		$data["sweet_text"]			= $this->session->flashdata('text');
		$data["sweet_type"]			= $this->session->flashdata('type');

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view($url, $data);
		$this->load->view('layout/footer', $data);
	}

	public function set_berkas_inAktif()
	{

		$this->db->select('id_dokumen');
		$this->db->where('tanggal_kadaluwarsa <=', date('Y-m-d'));
		$this->db->where('id_status', 1);
		$get 						= $this->db->get('dokumen')->result();
		$data["id_status"]			= 2;
		if (count($get) > 0) {
			foreach ($get as $key) {
				$this->db->where('id_dokumen', $key->id_dokumen);
				$this->db->update('dokumen', $data);
			}
		}

	}


}

/* End of file layout.php */
/* Location: ./application/models/layout.php */