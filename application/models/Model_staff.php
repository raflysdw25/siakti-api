<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_staff extends CI_Model {


	// please use $table_number = table name 
	private $table_1 = 'tik.staff';



	// for naming your function
	// please use get for selecting data or getting data 
	// please use insert for selecting data or inserting new data 
	// please use update for selecting data or update data 
	// please use delete for selecting data or deleting data 
	// format camelCase
	// for the result, this is a simple request you can improve by your self to make a any response


	public function getStaff($nip='')
	{
		if ($nip) {
			$this->db->where('nip', $nip);
		}

		$this->db->select('*');
		$this->db->from($this->table_1);

		$data = $this->db->get();
		return $data->result();
	}

	public function getAccessStaff($username, $password){
		$this->db->where('usr_name', $username);
		$this->db->select('*');
		$this->db->from($this->table_1);
		$staff = $this->db->get()->result()[0];				
		if($staff){
			$passwordTrue = password_verify($password, $staff->password);
			if($passwordTrue){
				return $staff;
			}
		}

		return false;
	}

	public function insertStaff($data='')
	{
		$query = $this->db->insert($this->table_1, $data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function updateStaff($nip, $data)
	{
		$this->db->where('nip', $nip);
		$query = $this->db->update($this->table_1,$data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function deleteStaff($nip)
	{
		$this->db->where('nip', $nip);
		$query = $this->db->delete($this->table_1);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	

}

/* End of file model_staff.php */
/* Location: ./application/models/model_staff.php */