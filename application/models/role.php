<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class role extends CI_Model {

	public function login($value=TRUE)
	{
		if ($value == FALSE) {
			$value	= NULL;
		}
		if ($this->session->userdata('login') != $value) {
			if ($this->session->userdata('login') == TRUE) {
				redirect('admin/index','refresh');
			}else{
				redirect('admin/login','refresh');
			}
		}

	}

	public function akses($role1,$role2 = '',$role3 = '')
	{
		$this->login();
		$roles 		= [$role1,$role2,$role3];
		$role_me 	= $this->session->userdata('role');

		if (!in_array($role_me, $roles)) {
			redirect('admin/index','refresh');
		}
	}


}

/* End of file auth.php */
/* Location: ./application/models/auth.php */