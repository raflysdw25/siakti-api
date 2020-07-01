<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Struktural extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_struktural', 'mst');
	}


	public function index_get()
	{
		$id_jabstruk = $this->get('id_jabstruk');

		if($id_jabstruk){
			$data = $this->mst->getStruktural($id_jabstruk);
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
			$data = $this->mst->getStruktural();
			$responseCode = "200";
			$responseDesc = "Success get All program studi";
			$responseData = $data;
		}
		
		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
    }
}