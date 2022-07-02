<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sweetalert extends CI_Model {

	public function set($title,$text,$type)
	{
		$this->session->set_flashdata('title', $title);
		$this->session->set_flashdata('text', $text);
		$this->session->set_flashdata('type', $type);
	}

}

/* End of file sweetalert.php */
/* Location: ./application/models/sweetalert.php */