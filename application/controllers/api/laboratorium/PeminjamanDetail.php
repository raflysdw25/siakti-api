<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class PeminjamanDetail extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_peminjamandetail', 'mpd');
	}


	public function index_get()
	{
		$pinjambrg_kd_pjm = $this->get('pinjambrg_kd_pjm');

		if($pinjambrg_kd_pjm !== null){
            $data = $this->mpd->getPeminjamanDetail($pinjambrg_kd_pjm);            
			$responseCode = "200";
			$responseDesc = "Success get a detail peminjaman";
			$responseData = $data;            
		}else{			
			$responseCode = "204";
			$responseDesc = "Data not Found";
			$responseData = null;
		}
		
		$response = resultJson($responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}

	public function detailGet_get()
	{
		$id_detail = $this->get('id_detail');

		if($id_detail){
            $data = $this->mpd->getDetail($id_detail);
            if($data){
                $responseCode = "200";
                $responseDesc = "Success get a detail peminjaman";
			    $responseData = $data;
            }else{
                $responseCode = "204";
                $responseDesc = "Data not Found";
                $responseData = null;
            }
		}else{
            $data = $this->mpd->getPeminjamanDetail();
            $responseCode = "200";
			$responseDesc = "Success get All detail peminjaman";
			$responseData = $data;
		}
		
		

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}


	public function index_post()
	{			        
		
		$insertData = array(
			'id_detail' => $this->post('id_detail'),
			'pinjambrg_kd_pjm' => $this->post('pinjambrg_kd_pjm'),
			'barang_kode_brg' => $this->post('barang_kode_brg'),
			'jumlah' => $this->post('jumlah')
		);

		$query = $this->mpd->insertPeminjamanDetail($insertData);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to create detail peminjaman";
			$responseData = $insertData;
		}
		else{	
			$responseCode = "01";
			$responseDesc = "Failed to create detail peminjaman";
			$responseData = $insertData;
		}

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
    }
    

	public function index_put()
	{
		$id_detail = $this->put('id_detail');

		// Null Check
        
		
		$updateData = array(				
			'id_detail' => $this->put('id_detail'),
			'pinjambrg_kd_pjm' => $this->put('pinjambrg_kd_pjm'),		
			'barang_kode_brg' => $this->put('barang_kode_brg'),
			'jumlah' => $this->put('jumlah')
		);

		$query = $this->mpd->updatePeminjamanDetail($id_detail, $updateData);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to update detail peminjaman";
		}
		else{
			$responseCode = "01";
			$responseDesc = "Failed to update detail peminjaman";
		}
		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}

	// Digunakan untuk menghapus detail yang sudah dimasukkan ketika tidak jadi melakukan peminjaman
	public function index_delete()
	{
		$pinjambrg_kd_pjm = $this->delete('pinjambrg_kd_pjm');
		$query = $this->mpd->deletePeminjamanDetail($pinjambrg_kd_pjm);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to delete some peminjaman";
			$responseData = null;
		}else{
			$responseCode = "01";
			$responseDesc = "Failed to delete some peminjaman";
			$responseData = null;
		}
		

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);

	}

	public function deleteDetail_delete()
	{
		$id_detail = $this->delete('id_detail');
		$query = $this->mpd->deleteDetail($id_detail);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to delete detail peminjaman";
			$responseData = null;
		}else{
			$responseCode = "01";
			$responseDesc = "Failed to delete detail peminjaman";
			$responseData = null;
		}
		

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);

	}
}
