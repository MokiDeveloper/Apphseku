<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_akses extends CI_Model {

	private $table 		= 'akses';

	public function _setAkses()
	{
		$this->db->select('*');
		$this->db->from($this->table);
	}

	public function _filterAkses()
	{
		$this->_setAkses();

		$column_order 	= array(null, 'nama_akses'); 
		$column_search 	= array('nama_akses'); 
		$first_order	= array('nama_akses' => 'asc');

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

	public function getAkses()
	{
		$this->_filterAkses();
		
		$length 	= $this->input->post('length');
		$start 		= $this->input->post('start');
		if($length != -1){
			$this->db->limit($length, $start);
		}

		$sql 	= $this->db->get();
		return $sql->result();
	}

	public function countFilteredAkses()
	{
		$this->_filterAkses();
		$sql 	= $this->db->get();
		return $sql->num_rows();
	}

	public function countAllAkses()
	{
		$this->_setAkses();
		$sql 	= $this->db->get();
		return $sql->num_rows();
	}

	public function tambah()
	{
		$data["nama_akses"] 		= $this->input->post('nama_akses');
		$cek 						= $this->db->insert($this->table, $data);
		return $cek;

	}

	public function ubah()
	{
		$data["nama_akses"] 	= $this->input->post('nama_akses');
		$this->db->where('id_akses', $this->input->post('id_akses'));
		$cek 					= $this->db->update($this->table, $data);
		return $cek;
	}

	public function hapus()
	{
		$this->db->where('id_akses', $this->input->get('id_akses'));
		$cek 					= $this->db->delete($this->table);
		return $cek;
	}

}

/* End of file M_akses.php */
/* Location: ./application/models/M_akses.php */