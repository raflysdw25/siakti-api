<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Supplier extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_supplier', 'ms');
	}


	public function index_get()
	{
		$id_supp = $this->get('id_supp');

		if($id_supp){
			$data = $this->ms->getSupplier($id_supp);
			if($data){
                $responseCode = "200";
                $responseDesc = "Success get a supplier";
			    $responseData = $data;
            }else{
                $responseCode = "204";
                $responseDesc = "Data not Found";
                $responseData = null;
            }
		}else{
			$data = $this->ms->getSupplier();
			$responseCode = "200";
			$responseDesc = "Success get All supplier";
			$responseData = $data;
		}
		
		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}

	public function maxId_get()
	{
		$data = $this->ms->getMaxId();
		if($data){
			$responseCode = "200";
			$responseDesc = "Success get a supplier";
			$responseData = $data;
		}else{
			$responseCode = "204";
			$responseDesc = "Data not Found";
			$responseData = null;
		}
		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}

	public function namaSupp_post()
	{
		$nama_supp = ucwords($this->post('nama_supp'));
		$id_supp = $this->post('id_supp');
		if($id_supp != null){
			$data = $this->ms->getNamaSupplier($nama_supp, $id_supp);
		}else{
			$data = $this->ms->getNamaSupplier($nama_supp);
		}

		if($data){
			$responseCode = "200";
			$responseDesc = "Success get supplier name";
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
		$id = $this->ms->getMaxId();
		$id = $id[0]->max;
		$next_id = number_format($id) + 1;

		$insertData = array(
			'id_supp' => $next_id,
			'nama_supp' => ucwords($this->post('nama_supp')),
			'alamat' => ($this->post('alamat') == null) ? null : $this->post('alamat'),
			'tlpn' => $this->post('tlpn'),
			'email' => ($this->post('email') == null) ? null : $this->post('email'),
			'pic' => $this->post('pic')
		);

		$query = $this->ms->insertSupplier($insertData);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to create supplier";
			$responseData = $insertData;			
		}
		else{	
			$responseCode = "01";
			$responseDesc = "Failed to create supplier";
			$responseData = $insertData;			
		}


		$response = resultJson( $responseCode, $responseDesc, $responseData);				

		$this->response($response, 200);
    }

	public function index_put()
	{
		$id_supp = $this->put('id_supp');

		$updateData = array(						
			'nama_supp' => $this->put('nama_supp'),
			'alamat' => ($this->put('alamat') == null) ? null : $this->put('alamat'),
			'tlpn' => $this->put('tlpn'),
			'email' => ($this->put('email') == null) ? null : $this->put('email'),
			'pic' => $this->put('pic')
		);

		$query = $this->ms->updateSupplier($id_supp, $updateData);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to update supplier";
			$responseData = $updateData;
		}
		else{
			$responseCode = "01";
			$responseDesc = "Failed to update supplier";
			$responseData = null;
		}
		

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}
	
	public function index_delete()
	{
		$id_supp = $this->delete('id_supp');
		$query = $this->ms->deleteSupplier($id_supp);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to delete supplier";
			$responseData = null;
		}

		else{
			$responseCode = "01";
			$responseDesc = "Failed to delete supplier";
			$responseData = null;
		}
		

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);

	}
}
