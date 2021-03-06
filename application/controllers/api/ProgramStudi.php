<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class ProgramStudi extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_programstudi', 'mps');
	}


	public function index_get()
	{
		$prodi_id = $this->get('prodi_id');

		if($prodi_id){
			$data = $this->mps->getProdi($prodi_id);
			if($data){
                $responseCode = "200";
                $responseDesc = "Success get a program studi";
			    $responseData = $data;
            }else{
                $responseCode = "204";
                $responseDesc = "Data not Found";
                $responseData = null;
            }
		}else{
			$data = $this->mps->getProdi();
			$responseCode = "200";
			$responseDesc = "Success get All program studi";
			$responseData = $data;
		}
		
		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
    }
}