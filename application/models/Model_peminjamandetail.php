<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_peminjamandetail extends CI_Model {


	// please use $table_number = table name 
	private $table_1 = 'tik.pinjambrg_detail';
	private $table_2 = 'tik.barang';



	// for naming your function
	// please use get for selecting data or getting data 
	// please use insert for selecting data or inserting new data 
	// please use update for selecting data or update data 
	// please use delete for selecting data or deleting data 
	// format camelCase
	// for the result, this is a simple request you can improve by your self to make a any response


	public function getPeminjamanDetail($pinjambrg_kd_pjm)
	{		
		$this->db->where('pinjambrg_kd_pjm', $pinjambrg_kd_pjm);

		$this->db->select($this->table_1.'.*,'.$this->table_2.'.nama_brg as nama_brg');
		$this->db->from($this->table_1);
		$this->db->join($this->table_2,$this->table_1.'.barang_kode_brg = '.$this->table_2.'.kode_brg');

		$data = $this->db->get();
		return $data->result();
	}

	public function getDetail($id_detail='')
	{
		// Memanggil table user
        if ($id_detail) {
			$this->db->where('id_detail', $id_detail);
		}

		$this->db->select($this->table_1.'.*,'.$this->table_2.'.nama_brg as nama_brg');
		$this->db->from($this->table_1);
		$this->db->join($this->table_2,$this->table_1.'.barang_kode_brg = '.$this->table_2.'.kode_brg');

		$data = $this->db->get();
		return $data->result();
	}

	public function insertPeminjamanDetail($data='')
	{
		$query = $this->db->insert($this->table_1, $data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function updatePeminjamanDetail($id_detail, $data)
	{
		$this->db->where('id_detail', $id_detail);
		$query = $this->db->update($this->table_1,$data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function deletePeminjamanDetail($pinjambrg_kd_pjm)
	{
		$this->db->where('pinjambrg_kd_pjm', $pinjambrg_kd_pjm);
		$query = $this->db->delete($this->table_1);

		if ($this->db->affected_rows() > 1) {
			return true;
		}else{
			return false;
		}
	}

	public function deleteDetail($id_detail)
	{
		$this->db->where('id_detail', $id_detail);
		$query = $this->db->delete($this->table_1);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}
}

/* End of file model_peminjaman.php */
/* Location: ./application/models/model_peminjaman.php */