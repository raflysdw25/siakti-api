<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_strukturallab extends CI_Model {


	// please use $table_number = table name 	
	private $table_struktural = 'tik.jablab_struk';
	



	// for naming your function
	// please use get for selecting data or getting data 
	// please use insert for selecting data or inserting new data 
	// please use update for selecting data or update data 
	// please use delete for selecting data or deleting data 
	// format camelCase
	// for the result, this is a simple request you can improve by your self to make a any response


	public function getStruktural($id_jablab_struk='')
	{
		if ($id_jablab_struk) {
			$this->db->where('id_jablab_struk', $id_jablab_struk);
		}

		$this->db->select('*');
		$this->db->from($this->table_struktural);		

		$data = $this->db->get();
		return $data->result();
	}
	
	public function getMaxId()
	{
		$this->db->select('max(id_jablab_struk)');
		$this->db->from($this->table_struktural);

		$data = $this->db->get();
		return $data->result();
	}

	public function insertStrukturalLab($data)
	{
		$query = $this->db->insert($this->table_struktural, $data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function updateStruktural($id_jablab_struk, $data)
	{
		$this->db->where('id_jablab_struk', $id_jablab_struk);
		$query = $this->db->update($this->struktural,$data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function deleteStruktural($id_jablab_struk)
	{
		$this->db->where('id_jablab_struk', $id_jablab_struk);
		$query = $this->db->delete($this->table_struktural);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}
}