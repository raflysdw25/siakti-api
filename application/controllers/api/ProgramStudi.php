<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class ProgramStudi extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_staff', 'ms');
	}


	public function index_get()
	{
		$nip = $this->get('nip');

		if($nip){
			$data = $this->ms->getStaff($nip);
			if($data){
                $responseCode = "200";
                $responseDesc = "Success get a staff";
			    $responseData = $data;
            }else{
                $responseCode = "204";
                $responseDesc = "Data not Found";
                $responseData = null;
            }
		}else{
			$data = $this->ms->getStaff();
			$responseCode = "200";
			$responseDesc = "Success get All staff";
			$responseData = $data;
		}
		
		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
    }
}