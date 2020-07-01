<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_staff extends CI_Model {


	// please use $table_number = table name 
	private $table_staff = 'tik.staff';
	private $table_jabatan = 'tik.jab_dsn';
	private $table_struktural = 'tik.jab_struk';
	private $table_prodi = 'tik.prodi';
	



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

		$this->db->select(
			$this->table_staff.'.*,'.
			$this->table_jabatan.'.*,'.
			$this->table_struktural.'.nama_jab as jabatan,'.
			$this->table_prodi.'.namaprod as nama_prodi'
		);
		$this->db->from($this->table_staff);
		$this->db->join(
			$this->table_jabatan, $this->table_staff.'.nip = '.$this->table_jabatan.'.staff_nip', 'left');
		$this->db->join(
			$this->table_struktural, $this->table_jabatan.'.jab_struk_id_jabstruk = '.$this->table_struktural.'.id_jabstruk', 'left');
			$this->db->join(
				$this->table_prodi, $this->table_staff.'.prodi_prodi_id = '.$this->table_prodi.'.prodi_id', 'left');

		$data = $this->db->get();
		return $data->result();
	}

	public function getAccess($usr_name, $password)
	{
		$this->db->where('usr_name', $usr_name);
		$this->db->or_where('nip', $usr_name);
		$this->db->select(
			$this->table_staff.'.*,'.
			$this->table_jabatan.'.*,'.
			$this->table_struktural.'.nama_jab as jabatan,'.
			$this->table_prodi.'.namaprod as nama_prodi'
		);
		$this->db->from($this->table_staff);
		$this->db->join(
			$this->table_jabatan, $this->table_staff.'.nip = '.$this->table_jabatan.'.staff_nip', 'left');
		$this->db->join(
			$this->table_struktural, $this->table_jabatan.'.jab_struk_id_jabstruk = '.$this->table_struktural.'.id_jabstruk', 'left');
			$this->db->join(
				$this->table_prodi, $this->table_staff.'.prodi_prodi_id = '.$this->table_prodi.'.prodi_id', 'left');

		$staff = $this->db->get()->result()[0];
		if($staff){
			$passwordTrue = password_verify($password, $staff->password);
			if($passwordTrue){
				return $staff;
			}
		}

		return false;
	}

	public function insertStaff($data)
	{
		$query = $this->db->insert($this->table_staff, $data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function updateStaff($nip, $data)
	{
		$this->db->where('nip', $nip);
		$query = $this->db->update($this->table_staff,$data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function deleteStaff($nip)
	{
		$this->db->where('nip', $nip);
		$query = $this->db->delete($this->table_staff);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	

}

/* End of file model_staff.php */
/* Location: ./application/models/model_staff.php */