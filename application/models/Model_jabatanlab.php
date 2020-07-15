<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_jabatanlab extends CI_Model {


	// please use $table_number = table name 	
	private $table_jablab = 'tik.jab_lab';
	



	// for naming your function
	// please use get for selecting data or getting data 
	// please use insert for selecting data or inserting new data 
	// please use update for selecting data or update data 
	// please use delete for selecting data or deleting data 
	// format camelCase
	// for the result, this is a simple request you can improve by your self to make a any response


	public function getJabatanLab($id_jablab='')
	{
		if ($id_jablab) {
			$this->db->where('id_jablab', $id_jablab);
		}

		$this->db->select('*');
		$this->db->from($this->table_jablab);		

		$data = $this->db->get();
		return $data->result();
	}

	public function cekJabatanLab($staff_nip)
	{
		if ($staff_nip) {
			$this->db->where('staff_nip', $staff_nip);
		}

		$this->db->select('*');
		$this->db->from($this->table_jablab);		

		$data = $this->db->get();
		return $data->result();
	}

	public function getMaxId()
	{
		$this->db->select('max(id_jablab)');
		$this->db->from($this->table_jablab);

		$data = $this->db->get();
		return $data->result();
	}
	
	public function insertJabatanLab($data)
	{
		$query = $this->db->insert($this->table_jablab, $data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function updateJabatanLab($id_jablab, $data)
	{
		$this->db->where('id_jablab', $id_jablab);
		$query = $this->db->update($this->table_jablab,$data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	// Hapus berdasarkan staff
	public function deleteJabatan($staff_nip)
	{
		$this->db->where('staff_nip', $staff_nip);
		$query = $this->db->delete($this->table_jablab);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}
}