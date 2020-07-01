<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class JabatanDosen extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_jabatandosen', 'mjd');
	}


	public function index_get()
	{
		$id_jabdsn = $this->get('id_jabdsn');
		$staff_nip = $this->get('staff_nip');

		if($id_jabdsn){
			$data = $this->mjd->getJabatanDosen($id_jabdsn);
			if($data){
                $responseCode = "200";
                $responseDesc = "Success get a program studi";
			    $responseData = $data;
            }else{
                $responseCode = "204";
                $responseDesc = "Data not Found";
                $responseData = null;
            }
		}elseif($staff_nip){
			$data = $this->mjd->cekJabatanDosen($staff_nip);
			$responseCode = "200";
			$responseDesc = "Success get jabatandosen";
			$responseData = $data;
		}else{
			$data = $this->mjd->getJabatanDosen();
			$responseCode = "200";
			$responseDesc = "Success get All program studi";
			$responseData = $data;
		}
		
		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
    }

    public function maxId_get()
	{
		$data = $this->mjd->getMaxId();
		if($data){
			$responseCode = "200";
			$responseDesc = "Success get a jabatandosen";
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
        $insertData = array(
            'id_jabdsn' => $this->post('id_jabdsn'),
            'staff_nip' => $this->post('staff_nip'),
            'jab_struk_id_jabstruk' => $this->post('jab_struk_id_jabstruk'),
            'tgl_mulai' => $this->post('tgl_mulai'),
            'tgl_selesai' => $this->post('tgl_selesai'),
        );

        $query = $this->mjd->insertJabatanDosen($insertData);

        if ($query) {
            $responseCode = "00";
            $responseDesc = "Success to set jabatan staff";
            $responseData = $insertData;
        }
        else{	
            $responseCode = "01";
            $responseDesc = "Failed to set jabatan staff";
            $responseData = $insertData;
        }

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}
	
	public function index_delete()
	{
		$nip = $this->delete('id_jabdsn');
		$query = $this->mjd->deleteJabatan($nip);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to delete staff";
			$responseData = null;
		}

		else{
			$responseCode = "01";
			$responseDesc = "Failed to delete staff";
			$responseData = null;
		}
		

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);

	}
}