<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Barang extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_barang', 'mb');
	}


	public function index_get()
	{
		$kode_brg = $this->get('kode_brg');

		if($kode_brg){
			$data = $this->mb->getBarang($kode_brg);
			$responseDesc = "Success get a barang";
			$responseData = $data;	
		}else{
			$data = $this->mb->getBarang();
			$responseDesc = "Success get all barang";
			$responseData = $data;
		}


		$responseCode = "200";

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}

	public function barcodeBarang_get()
	{
		$barcode = $this->get('barcode');
		if($barcode){
			$data = $this->mb->getBarcodeBarang($barcode);
			$responseCode = "200";
			$responseDesc = "Success get a barang";
			$responseData = $data;	
		}else{
			$responseCode = "204";
			$responseDesc = "Data not Found";
			$responseData = null;
		}
		

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}

	public function countKondisi_get()
	{
		$kondisi = $this->get('kondisi');
		if($kondisi){
			if($kondisi == 'RUSAK'){
				$data = $this->mb->getCountKondisi('RUSAK');
			}elseif($kondisi == 'BAIK'){
				$data = $this->mb->getCountKondisi('BAIK');
			}elseif($kondisi == 'HABIS'){
				$data = $this->mb->getCountKondisi('HABIS');
			}

			$responseCode = "200";
			$responseDesc = "Success get kondisi ".$kondisi." barang";
			$responseData = $data;
		}else{
			$responseCode = "204";
			$responseDesc = "Data not Found";
			$responseData = null;
		}

		$response = resultJson($responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}

	public function namaBarang_get()
	{
		$data = $this->mb->getNamaBarang();
		$responseCode = "200";
		$responseDesc = "Success get all nama barang";
		$responseData = $data;

		$response = resultJson($responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}

	public function maxId_get()
	{
		$data = $this->mb->getMaxId();
		if($data){
			$responseCode = "200";
			$responseDesc = "Success get a barang";
			$responseData = $data;
		}else{
			$responseCode = "204";
			$responseDesc = "Data not Found";
			$responseData = null;
		}
		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}

	public function index_post()
	{
		$supplier_id_supp = ($this->post('supplier_id_supp') == null)? null:$this->post('supplier_id_supp');
		

		// STATUS : TERSEDIA, DIGUNAKAN, RUSAK, HABIS
		$insertData = array(
			'kode_brg' => $this->post('kode_brg'),
			'nama_brg' => $this->post('nama_brg'),
			'jenis_id_jenis' => $this->post('jenis_id_jenis'),
			'spesifikasi' => $this->post('spesifikasi'),
			'kondisi' => $this->post('kondisi'),						
			'barcode' => $this->post('barcode'),
			'thn_pengadaan' => $this->post('thn_pengadaan'),
			'asal_pengadaan' => $this->post('asal_pengadaan'),
			'supplier_id_supp' => $supplier_id_supp
		);

		$query = $this->mb->insertBarang($insertData);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to create barang";
			$responseData = $insertData;
			$response = resultJson( $responseCode, $responseDesc, $responseData);
		}
		else{	
			$responseCode = "01";
			$responseDesc = "Failed to create barang";
			$responseData = $insertData;
			$response = resultJson( $responseCode, $responseDesc, $responseData);
		}	
		

		$this->response($response, 200);
	}

	

	public function index_put()
	{			
		$kode_brg = $this->put('kode_brg');

		$supplier_id_supp = ($this->put('supplier_id_supp') !== null)? $this->put('supplier_id_supp') : null;
		
		$updateData = array(			
			'nama_brg' => $this->put('nama_brg'),
			'jenis_id_jenis' => $this->put('jenis_id_jenis'),
			'spesifikasi' => $this->put('spesifikasi'),
			'kondisi' => $this->put('kondisi'),						
			'barcode' => $this->put('barcode'),
			'thn_pengadaan' => $this->put('thn_pengadaan'),
			'asal_pengadaan' => $this->put('asal_pengadaan'),
			'supplier_id_supp' => $supplier_id_supp
		);

		$query = $this->mb->updateBarang($kode_brg, $updateData);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to update barang";
			$responseData = $this->put();
		}
		else{
			$responseCode = "01";
			$responseDesc = "Failed to update barang";
		}
		

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}

	// Untuk mengganti status BARANG dari TERSEDIA,DIGUNAKAN, RUSAK
	public function updateKondisi_put()
	{
		$kode_brg = $this->put('kode_brg');		
		
		$updateData = array(			
			'kondisi' => $this->put('kondisi'),			
		);

		$query = $this->mb->updateBarang($kode_brg, $updateData);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to update kondisi barang";
			$responseData = $this->put();
		}
		else{
			$responseCode = "01";
			$responseDesc = "Failed to update kondisi barang";
		}
		

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}

	public function index_delete()
	{
		$kode_brg = $this->delete('kode_brg');
		$query = $this->mb->deleteBarang($kode_brg);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to delete barang";
			$responseData = null;
		}

		else{
			$responseCode = "01";
			$responseDesc = "Failed to delete barang";
			$responseData = null;
		}
		

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);

	}


}
