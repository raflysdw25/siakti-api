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
		$nama_supp = $this->get('nama_supp');

		if($nama_supp){
			$data = $this->ms->getSupplier($nama_supp);
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


	public function index_post()
	{

		$post = $this->post();
        
		$responseData = null;
		

		$insertData = array(
			'nama_supp' => $this->post('nama_supp'),
			'alamat' => $this->post('alamat'),
			'tlpn' => $this->post('tlpn'),
			'email' => $this->post('email'),
			'pic' => $this->post('pic')
		);

		$query = $this->ms->insertSupplier($insertData);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to create supplier";
			$responseData = $insertData;
			$response = resultJson( $responseCode, $responseDesc, $responseData);
		}
		else{	
			$responseCode = "01";
			$responseDesc = "Failed to create supplier";
			$responseData = $insertData;
			$response = resultJson( $responseCode, $responseDesc, $responseData);
		}				

		$this->response($response, 200);
    }
    
    function is_unique(){
        $post = $this->post(null,TRUE);
        $query = $this->db->query("SELECT * FROM tik.supplier WHERE nama_supp = '$post[nama_supp]'");
        if($query->num_rows() > 0){
            $this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti' );
            return FALSE;
        }else{
            return TRUE;
        }
	}

	public function index_put()
	{
		$nama_supp = $this->put('nama_supp');

		$updateData = array(			
			'alamat' => $this->put('alamat'),
			'tlpn' => $this->put('tlpn'),
			'email' => $this->put('email'),
			'pic' => $this->put('pic')
		);

		$query = $this->ms->updateSupplier($nama_supp, $updateData);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to update user";
		}
		else{
			$responseCode = "01";
			$responseDesc = "Failed to update user";
		}
		

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}
	
	public function index_delete()
	{
		$nama_supp = $this->delete('nama_supp');
		$query = $this->ms->deleteSupplier($nama_supp);

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
