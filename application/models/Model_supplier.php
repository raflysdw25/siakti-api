<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_supplier extends CI_Model {


	// please use $table_number = table name 
	private $table_supplier = 'tik.supplier';



	// for naming your function
	// please use get for selecting data or getting data 
	// please use insert for selecting data or inserting new data 
	// please use update for selecting data or update data 
	// please use delete for selecting data or deleting data 
	// format camelCase
	// for the result, this is a simple request you can improve by your self to make a any response


	public function getSupplier($id_supp='')
	{
		if ($id_supp) {
			$this->db->where('id_supp', $id_supp);
		}

		$this->db->select('*');
		$this->db->from($this->table_supplier);

		$data = $this->db->get();
		return $data->result();
	}

	public function getNamaSupplier($nama_supp, $id_supp='')
	{	
		$this->db->where('nama_supp', $nama_supp);
		if($id_supp){
			$this->db->where_not_in('id_supp', $id_supp);	
		}	
		

		$this->db->select('*');
		$this->db->from($this->table_supplier);

		$data = $this->db->get();
		return $data->result();
	}

	public function getMaxId()
	{
		$this->db->select('max(id_supp)');
		$this->db->from($this->table_supplier);

		$data = $this->db->get();
		return $data->result();
	}

	public function insertSupplier($data='')
	{
		$query = $this->db->insert($this->table_supplier, $data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function updateSupplier($id_supp, $data)
	{
		$this->db->where('id_supp', $id_supp);
		$query = $this->db->update($this->table_supplier,$data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function deleteSupplier($id_supp)
	{
		$this->db->where('id_supp', $id_supp);
		$query = $this->db->delete($this->table_supplier);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}
}

/* End of file model_supplier.php */
/* Location: ./application/models/model_supplier.php */