<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_peminjamandetail extends CI_Model {


	// please use $table_number = table name 
	private $table_pinjambrgdetail = 'tik.pinjambrg_detail';
	private $table_barang = 'tik.barang';
	private $table_jenisbrg = 'tik.jenis_barang';



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

		$this->db->select(
			$this->table_pinjambrgdetail.'.*,'.
			$this->table_barang.'.jenis_id_jenis,'.
			$this->table_barang.'.nama_brg,'.
			$this->table_barang.'.kondisi,'.
			$this->table_jenisbrg.'.nama_jenis,'
			);
		$this->db->from($this->table_pinjambrgdetail);
		$this->db->join($this->table_barang,$this->table_pinjambrgdetail.'.barang_kode_brg = '.$this->table_barang.'.kode_brg', 'left');
		$this->db->join($this->table_jenisbrg,$this->table_barang.'.jenis_id_jenis = '.$this->table_jenisbrg.'.id_jenis', 'left');

		$data = $this->db->get();
		return $data->result();
	}

	public function getJumlahBarangPinjam(){
		$this->db->select($this->table_barang.'.nama_brg, COUNT('.$this->table_barang.'.nama_brg) as jumlah_brg');
		$this->db->from($this->table_pinjambrgdetail);
		$this->db->join($this->table_barang,$this->table_pinjambrgdetail.'.barang_kode_brg = '.$this->table_barang.'.kode_brg', 'left');
		$this->db->group_by($this->table_barang.'.nama_brg');

		$data = $this->db->get();
		return $data->result();
	}

	public function getDetail($id_detail='')
	{
		// Memanggil table user
        if ($id_detail) {
			$this->db->where('id_detail', $id_detail);
		}

		$this->db->select($this->table_pinjambrgdetail.'.*,'.$this->table_barang.'.nama_brg as nama_brg');
		$this->db->from($this->table_pinjambrgdetail);
		$this->db->join($this->table_barang,$this->table_pinjambrgdetail.'.barang_kode_brg = '.$this->table_barang.'.kode_brg');

		$data = $this->db->get();
		return $data->result();
	}

	public function getMaxId()
	{
		$this->db->select('max(id_detail)');
		$this->db->from($this->table_pinjambrgdetail);

		$data = $this->db->get();
		return $data->result();
	}

	public function insertPeminjamanDetail($data='')
	{
		$query = $this->db->insert($this->table_pinjambrgdetail, $data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function updatePeminjamanDetail($id_detail, $data)
	{
		$this->db->where('id_detail', $id_detail);
		$query = $this->db->update($this->table_pinjambrgdetail,$data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function deletePeminjamanDetail($pinjambrg_kd_pjm)
	{
		$this->db->where('pinjambrg_kd_pjm', $pinjambrg_kd_pjm);
		$query = $this->db->delete($this->table_pinjambrgdetail);

		if ($this->db->affected_rows() >= 1) {
			return true;
		}else{
			return false;
		}
	}

	public function deleteDetail($id_detail)
	{
		$this->db->where('id_detail', $id_detail);
		$query = $this->db->delete($this->table_pinjambrgdetail);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}
}

/* End of file model_peminjaman.php */
/* Location: ./application/models/model_peminjaman.php */