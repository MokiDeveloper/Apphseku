<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

	private $table 		= 'user';
	public function _setUser()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('departemen', 'user.id_departemen = departemen.id_departemen');
		$this->db->join('role', 'user.id_role = role.id_role');
	}

	public function _filterUser()
	{
		$this->_setUser();

		$column_order 	= array(null, 'nama','email','username','nama_departemen','nama_role','kontrak_mulai','kontrak_selesai'); 
		$column_search 	= array('nama','email','nama_departemen','username','nama_role','kontrak_mulai','kontrak_selesai'); 
		$first_order	= array('nama' => 'asc');

		$search 		= $this->input->post('search');
		$i = 0;
		foreach ($column_search as $item) { 
			if($search["value"]) { 
				if($i===0) {
					$this->db->group_start();
					$this->db->like($item, $search['value']);
				} else {
					$this->db->or_like($item, $search['value']);
				}

				if(count($column_search) - 1 == $i){
					$this->db->group_end(); 
				}
			}
			$i++;
		}

		$order 	= $this->input->post('order');
		if(isset($order) && $order['0']['column']!=0) {
			$this->db->order_by($column_order[$order['0']['column']], $order['0']['dir']);
		}elseif(isset($first_order)) {
			$this->db->order_by(key($first_order), $first_order[key($first_order)]);
		}

	}

	public function getUser()
	{
		$this->_filterUser();
		
		$length 	= $this->input->post('length');
		$start 		= $this->input->post('start');
		if($length != -1){
			$this->db->limit($length, $start);
		}

		$sql 	= $this->db->get();
		return $sql->result();
	}

	public function countFilteredUser()
	{
		$this->_filterUser();
		$sql 	= $this->db->get();
		return $sql->num_rows();
	}

	public function countAllUser()
	{
		$this->_setUser();
		$sql 	= $this->db->get();
		return $sql->num_rows();
	}

	public function tambah()
	{
		$username 			= $this->input->post('username');
		$cek 				= $this->db->get_where($this->table, ["username" => $username]);
		if ($cek->num_rows() > 0) {
			return 2;
		}

		$data["nama"]				= $this->input->post('nama');
		$data["username"] 			= $username;
		$data["password"] 			= password_hash($this->input->post('password'),PASSWORD_DEFAULT);
		$data["id_departemen"] 		= $this->input->post('id_departemen');
		$data["id_role"] 			= $this->input->post('id_role');
		$data["email"] 				= $this->input->post('email');
		$data["kontrak_mulai"] 		= $this->input->post('kontrak_mulai');
		$data["kontrak_selesai"] 	= $this->input->post('kontrak_selesai');

		$cek 						= $this->db->insert($this->table, $data);
		return $cek;

	}

	public function ubah()
	{
		$data["id_departemen"] 		= $this->input->post('id_departemen');
		$data["id_role"] 			= $this->input->post('id_role');
		$data["nama"]	 			= $this->input->post('nama');
		$data["email"]	 			= $this->input->post('email');
		$data["kontrak_mulai"]	 	= $this->input->post('kontrak_mulai');
		$data["kontrak_selesai"]	= $this->input->post('kontrak_selesai');

		$this->db->where('id_user', $this->input->post('id_user'));
		$cek 					= $this->db->update($this->table, $data);
		return $cek;
	}

	public function hapus()
	{
		$this->db->where('id_user', $this->input->get('id_user'));
		$cek 					= $this->db->delete($this->table);
		return $cek;
	}

	public function gantiUsername()
	{
		$username 			= $this->input->post('username');
		$email 				= $this->input->post('email');
		$id_user 			= $this->session->userdata('id_user');
		
		$cek 				= $this->db->get_where($this->table, ["username" => $username,"id_user != " => $id_user]);
		if ($cek->num_rows() > 0) {
			return 2;
		}
		$data["username"] 	= $username;
		$data["email"] 		= $email;
		$this->db->where('id_user', $id_user);
		$cek 				= $this->db->update($this->table, $data);
		return $cek;
	}

	public function gantiPassword()
	{
		$passwordLama 		= $this->input->post('passwordLama');
		$passwordBaru 		= $this->input->post('passwordBaru');
		$confPassword 		= $this->input->post('confPassword');
		$id_user			= $this->session->userdata('id_user');

		$cek 				= $this->db->get_where($this->table,["id_user" => $id_user])->row();
		if (!password_verify($passwordLama,$cek->password)) {
			return 3;
		}

		if ($passwordBaru !== $confPassword) {
			return 4;	
		}
		
		$data["password"] 	= password_hash($passwordBaru,PASSWORD_DEFAULT);
		$this->db->where('id_user', $id_user);
		$cek 				= $this->db->update($this->table, $data);
		return $cek;
	}

	public function resetPassword($id_user,$password_default)
	{
		$data["password"] 	= password_hash($password_default,PASSWORD_DEFAULT);
		$this->db->where('id_user', $id_user);
		$cek 				= $this->db->update($this->table, $data);
		return $cek;
	}

}

/* End of file M_user.php */
/* Location: ./application/models/M_user.php */