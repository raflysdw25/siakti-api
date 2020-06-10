<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_peminjaman extends CI_Model {


	// please use $table_number = table name 
	private $table_1 = 'tik.pinjambrg';



	// for naming your function
	// please use get for selecting data or getting data 
	// please use insert for selecting data or inserting new data 
	// please use update for selecting data or update data 
	// please use delete for selecting data or deleting data 
	// format camelCase
	// for the result, this is a simple request you can improve by your self to make a any response


	public function getPeminjaman($kd_pjm='')
	{
		// Memanggil table user
        $this->db->select($this->table_1.".*, tik.barang.nama_brg, tik.staff.nama as nama_staff , tik.mahasiswa.nama_mhs as nama_mahasiswa"); //Select digunakan untuk menspesifik nama yang ditampilkan di dalam database
        $this->db->from($this->table_1);
        $this->db->join("tik.barang",  "tik.barang.kode_brg = ". $this->table_1.".barang_kode_brg");
		$this->db->join("tik.mahasiswa", "tik.mahasiswa.nim = ". $this->table_1.".mahasiswa_nim");
		$this->db->join("tik.staff", "tik.staff.nip = ". $this->table_1.".staff_nip");

		if ($kd_pjm) {
			$this->db->where('kd_pjm', $kd_pjm);
		}


		$data = $this->db->get();
		return $data->result();
	}

	public function insertPeminjaman($data='')
	{
		$query = $this->db->insert($this->table_1, $data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function updatePeminjaman($kd_pjm, $data)
	{
		$this->db->where('kd_pjm', $kd_pjm);
		$query = $this->db->update($this->table_1,$data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function deletePeminjaman($kd_pjm)
	{
		$this->db->where('kd_pjm', $kd_pjm);
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