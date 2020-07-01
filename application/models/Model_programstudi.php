<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_programstudi extends CI_Model {


	// please use $table_number = table name 	
	private $table_prodi = 'tik.prodi';
	



	// for naming your function
	// please use get for selecting data or getting data 
	// please use insert for selecting data or inserting new data 
	// please use update for selecting data or update data 
	// please use delete for selecting data or deleting data 
	// format camelCase
	// for the result, this is a simple request you can improve by your self to make a any response


	public function getProdi($prodi_id='')
	{
		if ($prodi_id) {
			$this->db->where('prodi_id', $prodi_id);
		}

		$this->db->select('*');
		$this->db->from($this->table_prodi);		

		$data = $this->db->get();
		return $data->result();
    }
}