<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_barang extends CI_Model {


	// please use $table_number = table name 
	private $table_barang = 'tik.barang';
	private $table_supplier = 'tik.supplier';
	private $table_jenisbarang = 'tik.jenis_barang';



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

		$this->db->select(
			$this->table_barang.'.*, '.
			$this->table_supplier.'.nama_supp as nama_supp,'.
			$this->table_jenisbarang.'.nama_jenis as nama_jenis');
		$this->db->from($this->table_barang);
		$this->db->join($this->table_supplier,$this->table_barang.'.supplier_id_supp = '.$this->table_supplier.'.id_supp', 'left');
		$this->db->join($this->table_jenisbarang,$this->table_barang.'.jenis_id_jenis = '.$this->table_jenisbarang.'.id_jenis', 'left');

		$this->db->order_by('kode_brg','desc');
		$data = $this->db->get();
		return $data->result();
	}

	public function getBarcodeBarang($barcode)
	{				
		$this->db->where('barcode', $barcode);
		$this->db->select(
			$this->table_barang.'.*, '.
			$this->table_supplier.'.nama_supp as nama_supp,'.
			$this->table_jenisbarang.'.nama_jenis as nama_jenis');
		$this->db->from($this->table_barang);
		$this->db->join($this->table_supplier,$this->table_barang.'.supplier_id_supp = '.$this->table_supplier.'.id_supp', 'left');
		$this->db->join($this->table_jenisbarang,$this->table_barang.'.jenis_id_jenis = '.$this->table_jenisbarang.'.id_jenis', 'left');

		$data = $this->db->get();
		return $data->result();
	}

	public function getNamaBarang(){
		$this->db->select('nama_brg, COUNT(nama_brg) as jumlah_brg');
		$this->db->from($this->table_barang);
		$this->db->group_by('nama_brg');

		$data = $this->db->get();
		return $data->result();
	}

	public function getCountKondisi($kondisi){
		if($kondisi == 'RUSAK'){
			$this->db->where('kondisi', 'RUSAK');			
		}elseif ($kondisi == 'BAIK') {
			$this->db->where('kondisi', 'BAIK');			
		}elseif($kondisi == 'HABIS'){
			$this->db->where('kondisi', 'HABIS');			
		}

		$this->db->select('nama_brg, COUNT(kondisi) as jumlah_brg');
		$this->db->from($this->table_barang);
		$this->db->group_by('nama_brg');

		$data = $this->db->get();
		return $data->result();
	}

	public function getFilterBarang($asal_pengadaan = '', $thn_pengadaan ='', $jenis_brg = '')
	{
		if($asal_pengadaan != null){
			$this->db->where('asal_pengadaan', $asal_pengadaan);
		}

		if($thn_pengadaan != null){
			$this->db->where('thn_pengadaan', $thn_pengadaan);
		}

		if($jenis_brg != null){
			$this->db->where('jenis_id_jenis', $jenis_brg);
		}

		if($jenis_brg || $thn_pengadaan || $asal_pengadaan){
			$this->db->select(
				$this->table_barang.'.*, '.
				$this->table_supplier.'.nama_supp as nama_supp,'.
				$this->table_jenisbarang.'.nama_jenis as nama_jenis');
			$this->db->from($this->table_barang);
			$this->db->join($this->table_supplier,$this->table_barang.'.supplier_id_supp = '.$this->table_supplier.'.id_supp', 'left');
			$this->db->join($this->table_jenisbarang,$this->table_barang.'.jenis_id_jenis = '.$this->table_jenisbarang.'.id_jenis', 'left');
		}


		$data = $this->db->get();
		return $data->result();
	}

	public function getMaxId()
	{
		$this->db->select('max(kode_brg)');
		$this->db->from($this->table_barang);

		$data = $this->db->get();
		return $data->result();
	}

	public function insertBarang($data='')
	{
		$query = $this->db->insert($this->table_barang, $data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function updateBarang($kode_brg, $data)
	{
		$this->db->where('kode_brg', $kode_brg);
		$query = $this->db->update($this->table_barang,$data);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function deleteBarang($kode_brg='')
	{
		$this->db->where('kode_brg', $kode_brg);
		$query = $this->db->delete($this->table_barang);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	

}

/* End of file model_barang.php */
/* Location: ./application/models/model_barang.php */