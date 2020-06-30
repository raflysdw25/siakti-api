<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class JenisBarang extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_jenisbarang', 'mjb');
	}


	public function index_get()
	{
		$id_jenis = $this->get('id_jenis');

		if($id_jenis){
			$data = $this->mjb->getJenisBarang($id_jenis);
			$responseDesc = "Success get a jenis barang";
			$responseData = $data;	
		}else{
			$data = $this->mjb->getJenisBarang();
			$responseDesc = "Success get all jenis barang";
			$responseData = $data;
		}


		$responseCode = "200";

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}


	public function maxId_get()
	{
		$data = $this->mjb->getMaxId();
		if($data){
			$responseCode = "200";
			$responseDesc = "Success get a jenis barang";
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
			
		// STATUS : TERSEDIA, DIGUNAKAN, RUSAK, HABIS
		$insertData = array(
			'id_jenis' => $this->post('id_jenis'),
			'nama_jenis' => $this->post('nama_jenis'),
			
		);

		$query = $this->mjb->insertJenisBarang($insertData);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to create jenis barang";
			$responseData = $insertData;			
		}
		else{	
			$responseCode = "01";
			$responseDesc = "Failed to create jenis barang";
			$responseData = $insertData;			
		}	
		
        $response = resultJson( $responseCode, $responseDesc, $responseData);
		$this->response($response, 200);
	}

	public function namaJenis_post()
	{
		$nama_jenis = ucwords($this->post('nama_jenis'));
		$id_jenis = $this->post('id_jenis');
		if($id_jenis != null){
			$data = $this->mjb->getNamaJenis($nama_jenis, $id_jenis);
		}else{
			$data = $this->mjb->getNamaJenis($nama_jenis);
		}

		if($data){
			$responseCode = "200";
			$responseDesc = "Success get nama jenis ";
			$responseData = $data;
		}else{
			$responseCode = "204";
			$responseDesc = "Data not Found";
			$responseData = null;
		}
		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}

	public function index_put()
	{			
		$id_jenis = $this->put('id_jenis');		
		
		$updateData = array(			
			'nama_jenis' => $this->put('nama_jenis'),			
		);

		$query = $this->mjb->updateJenisBarang($id_jenis, $updateData);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to update jenis barang";
			$responseData = $this->put();
		}
		else{
			$responseCode = "01";
            $responseDesc = "Failed to update jenis barang";
            $responseData = null;
		}
		

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}


	public function index_delete()
	{
		$id_jenis = $this->delete('id_jenis');
		$query = $this->mjb->deleteJenisBarang($id_jenis);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to delete jenis barang";
			$responseData = null;
		}

		else{
			$responseCode = "01";
			$responseDesc = "Failed to delete jenis barang";
			$responseData = null;
		}
		

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);

	}


}
