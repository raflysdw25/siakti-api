<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_mahasiswa extends CI_Model {


	// please use $table_number = table name 
	private $table_1 = 'tik.mahasiswa';



	// for naming your function
	// please use get for selecting data or getting data 
	// please use insert for selecting data or inserting new data 
	// please use update for selecting data or update data 
	// please use delete for selecting data or deleting data 
	// format camelCase
	// for the result, this is a simple request you can improve by your self to make a any response


	public function getMahasiswa($nim = '')
	{
		if ($nim != null) {
			$this->db->where('nim', $nim);
		}

		$this->db->select('*');
		$this->db->from($this->table_1);

		$data = $this->db->get();
		return $data->result();
	}

	public function kartuMahasiswa($no_ktm)
	{
		$this->db->where('no_ktm', $no_ktm);
		$this->db->select('*');
		$this->db->from($this->table_1);

		$data = $this->db->get();
		return $data->result();
	}

	public function insertMahasiswa($data='')
	{
		$query = $this->db->insert($this->table_1, $data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function updateMahasiswa($nim, $data)
	{
		$this->db->where('nim', $nim);
		$query = $this->db->update($this->table_1,$data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function deleteMahasiswa($nim)
	{
		$this->db->where('nim', $nim);
		$query = $this->db->delete($this->table_1);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	

}

/* End of file model_mahasiswa.php */
/* Location: ./application/models/model_mahasiswa.php */