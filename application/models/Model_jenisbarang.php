<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_jenisbarang extends CI_Model {


	// please use $table_number = table name 
	private $table_jenisbarang = 'tik.jenis_barang';



	// for naming your function
	// please use get for selecting data or getting data 
	// please use insert for selecting data or inserting new data 
	// please use update for selecting data or update data 
	// please use delete for selecting data or deleting data 
	// format camelCase
	// for the result, this is a simple request you can improve by your self to make a any response


	public function getJenisBarang($id_jenis='')
	{
		if ($id_jenis) {
			$this->db->where('id_jenis', $id_jenis);
		}

		$this->db->select('*');
		$this->db->from($this->table_jenisbarang);
		$this->db->order_by('id_jenis','asc');		

		$data = $this->db->get();
		return $data->result();
	}

	public function getNamaJenis($nama_jenis, $id_jenis='')
	{	
		$this->db->where('nama_jenis', $nama_jenis);
		if($id_jenis){
			$this->db->where_not_in('id_jenis', $id_jenis);	
		}	
		

		$this->db->select('*');
		$this->db->from($this->table_jenisbarang);

		$data = $this->db->get();
		return $data->result();
	}
	
	public function getMaxId()
	{
		$this->db->select('max(id_jenis)');
		$this->db->from($this->table_jenisbarang);

		$data = $this->db->get();
		return $data->result();
	}

	public function insertJenisBarang($data='')
	{
		$query = $this->db->insert($this->table_jenisbarang, $data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function updateJenisBarang($id_jenis, $data)
	{
		$this->db->where('id_jenis', $id_jenis);
		$query = $this->db->update($this->table_jenisbarang,$data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function deleteJenisBarang($id_jenis='')
	{
		$this->db->where('id_jenis', $id_jenis);
		$query = $this->db->delete($this->table_jenisbarang);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	

}

/* End of file model_barang.php */
/* Location: ./application/models/model_barang.php */