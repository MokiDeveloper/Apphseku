<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_log extends CI_Model {
	public $table 	= 'log';

	public function log($id_user,$isi_log)
	{
		$data["id_user"]		= $id_user;
		$data["isi_log"]		= $isi_log;
		$data["tanggal_log"]	= date('Y-m-d H:i:s');

		$this->db->insert($this->table, $data);
	}
	public function _setLog()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('user', 'user.id_user = log.id_user', 'left');
	}

	public function _filterLog()
	{
		$this->_setLog();

		$column_order 	= array(null, 'username','isi_log','tanggal_log'); 
		$column_search 	= array('username','isi_log','tanggal_log'); 
		$first_order	= array('tanggal_log' => 'DESC');

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


		if ($this->session->userdata('role') != 1) {
			$this->db->where('user.id_user', $this->session->userdata('id_user'));
		}

	}

	public function getLog()
	{
		$this->_filterLog();
		
		$length 	= $this->input->post('length');
		$start 		= $this->input->post('start');
		if($length != -1){
			$this->db->limit($length, $start);
		}

		$sql 	= $this->db->get();
		return $sql->result();
	}

	public function countFilteredLog()
	{
		$this->_filterLog();
		$sql 	= $this->db->get();
		return $sql->num_rows();
	}

	public function countAllLog()
	{
		$this->_setLog();
		$sql 	= $this->db->get();
		return $sql->num_rows();
	}

}

/* End of file log.php */
/* Location: ./application/models/log.php */