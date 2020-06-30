<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_peminjaman extends CI_Model {


	// please use $table_number = table name 
	private $table_pinjambrg = 'tik.pinjambrg';
	private $table_ruangan = 'tik.ruangan';
	private $table_staff = 'tik.staff';
	private $table_mahasiswa = 'tik.mahasiswa';



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
        if ($kd_pjm) {
			$this->db->where('kd_pjm', $kd_pjm);
		}


		$this->db->select(
			$this->table_pinjambrg.'.*,'
			.$this->table_ruangan.'.namaruang,'
			.$this->table_staff.'.nama as nama_penanggungjawab,'
			.$this->table_mahasiswa.'.nama_mhs as nama_mhs,');
		$this->db->from($this->table_pinjambrg);
		$this->db->join($this->table_staff, $this->table_pinjambrg.'.staff_penanggungjawab = '.$this->table_staff.'.nip', 'left');
		$this->db->join($this->table_ruangan, $this->table_pinjambrg.'.ruangan_idruangan = '.$this->table_ruangan.'.id_ruangan', 'left');
		$this->db->join($this->table_mahasiswa, $this->table_pinjambrg.'.mahasiswa_nim = '.$this->table_mahasiswa.'.nim', 'left');		

		$data = $this->db->get();
		return $data->result();
	}

	public function getPeminjamanMhs($mahasiswa_nim)
	{
		// Memanggil table user
        if ($mahasiswa_nim) {
			$this->db->where('mahasiswa_nim', $mahasiswa_nim);
		}

		$this->db->select(
			$this->table_pinjambrg.'.*,'
			.$this->table_ruangan.'.namaruang,'
			.$this->table_staff.'.nama as nama_penanggungjawab,'
			.$this->table_mahasiswa.'.nama_mhs as nama_mhs,');
		$this->db->from($this->table_pinjambrg);
		$this->db->join($this->table_staff, $this->table_pinjambrg.'.staff_penanggungjawab = '.$this->table_staff.'.nip', 'left');
		$this->db->join($this->table_ruangan, $this->table_pinjambrg.'.ruangan_idruangan = '.$this->table_ruangan.'.id_ruangan', 'left');
		$this->db->join($this->table_mahasiswa, $this->table_pinjambrg.'.mahasiswa_nim = '.$this->table_mahasiswa.'.nim', 'left');

		$data = $this->db->get();
		return $data->result();
	}

	public function getPeminjamanStaff($staff_nip)
	{
		// Memanggil table user
        if ($staff_nip) {
			$this->db->where('staff_nip', $staff_nip);
		}

		$this->db->select(
			$this->table_pinjambrg.'.*,'
			.$this->table_ruangan.'.namaruang,'
			.$this->table_staff.'.nama as nama_staff,'
			.$this->table_staff.'.tlp_staff as tlp_staff,');
		$this->db->from($this->table_pinjambrg);
		$this->db->join($this->table_staff, $this->table_pinjambrg.'.staff_nip = '.$this->table_staff.'.nip', 'left');
		$this->db->join($this->table_ruangan, $this->table_pinjambrg.'.ruangan_idruangan = '.$this->table_ruangan.'.id_ruangan', 'left');
		

		$data = $this->db->get();
		return $data->result();
	}

	public function getMaxId()
	{
		$this->db->select('max(kd_pjm)');
		$this->db->from($this->table_pinjambrg);

		$data = $this->db->get();
		return $data->result();
	}

	public function insertPeminjaman($data='')
	{
		$query = $this->db->insert($this->table_pinjambrg, $data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function updatePeminjaman($kd_pjm, $data)
	{
		$this->db->where('kd_pjm', $kd_pjm);
		$query = $this->db->update($this->table_pinjambrg,$data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function deletePeminjaman($kd_pjm)
	{
		$this->db->where('kd_pjm', $kd_pjm);
		$query = $this->db->delete($this->table_pinjambrg);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	

}

/* End of file model_peminjaman.php */
/* Location: ./application/models/model_peminjaman.php */