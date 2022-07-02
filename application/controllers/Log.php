<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {

	public 	$role_me 	= '';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('layout');
		$this->load->model('role');
		$this->load->model('M_log','history');
		$this->role->akses(1);
		$this->role_me 	= $this->session->userdata('role');
	}

	public function index()
	{
		$this->layout->view_admin('log/index','Manajemen Log / History');
	}

	public function ajax()
	{
		$list 		= $this->history->getLog();
		$data 		= array();
		$no 		= $this->input->post('start');
		$role_me	= $this->session->userdata('role');
		foreach ($list as $item) {
			$no++;
			$row 	= array();

			$row[] 	= "<div class='text-center'>".$no.".</div>";
			$row[] 	= $item->username;
			$row[] 	= $item->username .' '.$item->isi_log;
			$row[] 	= $item->tanggal_log;

			$data[] = $row;
		}
		$output = array(
			"draw" => $this->input->post('draw'),
			"recordsTotal" => $this->history->countAllLog(),
			"recordsFiltered" => $this->history->countFilteredLog(),
			"data" => $data,
		);

		echo json_encode($output);
	}

}

/* End of file Log.php */
/* Location: ./application/controllers/Log.php */