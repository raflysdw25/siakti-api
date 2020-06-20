<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ruangan extends CI_Model {


	// please use $table_number = table name 
	private $table_1 = 'tik.ruangan';



	// for naming your function
	// please use get for selecting data or getting data 
	// please use insert for selecting data or inserting new data 
	// please use update for selecting data or update data 
	// please use delete for selecting data or deleting data 
	// format camelCase
	// for the result, this is a simple request you can improve by your self to make a any response


	public function getRuangan($id_ruangan='')
	{
		if ($id_ruangan) {
			$this->db->where('id_ruangan', $id_ruangan);
		}

		$this->db->select('*');
		$this->db->from($this->table_1);

		$data = $this->db->get();
		return $data->result();
	}
}