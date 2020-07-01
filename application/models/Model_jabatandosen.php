<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_jabatandosen extends CI_Model {


	// please use $table_number = table name 	
	private $table_jabdsn = 'tik.jab_dsn';
	



	// for naming your function
	// please use get for selecting data or getting data 
	// please use insert for selecting data or inserting new data 
	// please use update for selecting data or update data 
	// please use delete for selecting data or deleting data 
	// format camelCase
	// for the result, this is a simple request you can improve by your self to make a any response


	public function getJabatanDosen($id_jabdsn='')
	{
		if ($id_jabdsn) {
			$this->db->where('id_jabdsn', $id_jabdsn);
		}

		$this->db->select('*');
		$this->db->from($this->table_jabdsn);		

		$data = $this->db->get();
		return $data->result();
	}

	public function cekJabatanDosen($staff_nip)
	{
		if ($staff_nip) {
			$this->db->where('staff_nip', $staff_nip);
		}

		$this->db->select('*');
		$this->db->from($this->table_jabdsn);		

		$data = $this->db->get();
		return $data->result();
	}

	public function getMaxId()
	{
		$this->db->select('max(id_jabdsn)');
		$this->db->from($this->table_jabdsn);

		$data = $this->db->get();
		return $data->result();
	}
	
	public function insertJabatanDosen($data)
	{
		$query = $this->db->insert($this->table_jabdsn, $data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function deleteJabatan($id_jabdsn)
	{
		$this->db->where('id_jabdsn', $id_jabdsn);
		$query = $this->db->delete($this->table_jabdsn);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}
}