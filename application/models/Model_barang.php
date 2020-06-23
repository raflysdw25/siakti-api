<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_barang extends CI_Model {


	// please use $table_number = table name 
	private $table_1 = 'tik.barang';
	private $table_2 = 'tik.supplier';



	// for naming your function
	// please use get for selecting data or getting data 
	// please use insert for selecting data or inserting new data 
	// please use update for selecting data or update data 
	// please use delete for selecting data or deleting data 
	// format camelCase
	// for the result, this is a simple request you can improve by your self to make a any response


	public function getBarang($kode_brg='')
	{
		if ($kode_brg) {
			$this->db->where('kode_brg', $kode_brg);
		}

		$this->db->select($this->table_1.'.*, '.$this->table_2.'.nama_supp as nama_supp');
		$this->db->from($this->table_1);
		$this->db->join($this->table_2,$this->table_1.'.supplier_id_supp = '.$this->table_2.'.id_supp', 'left');

		$data = $this->db->get();
		return $data->result();
	}

	public function getBarcodeBarang($barcode)
	{				
		$this->db->where('barcode', $barcode);
		$this->db->select($this->table_1.'.*, '.$this->table_2.'.nama_supp as nama_supp');
		$this->db->from($this->table_1);
		$this->db->join($this->table_2,$this->table_1.'.supplier_id_supp = '.$this->table_2.'.id_supp', 'left');

		$data = $this->db->get();
		return $data->result();
	}

	public function getMaxId()
	{
		$this->db->select('max(kode_brg)');
		$this->db->from($this->table_1);

		$data = $this->db->get();
		return $data->result();
	}

	public function insertBarang($data='')
	{
		$query = $this->db->insert($this->table_1, $data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function updateBarang($kode_brg, $data)
	{
		$this->db->where('kode_brg', $kode_brg);
		$query = $this->db->update($this->table_1,$data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function deleteBarang($kode_brg='')
	{
		$this->db->where('kode_brg', $kode_brg);
		$query = $this->db->delete($this->table_1);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	

}

/* End of file model_barang.php */
/* Location: ./application/models/model_barang.php */