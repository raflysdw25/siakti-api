<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Ruangan extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_ruangan', 'mr');
	}


	public function index_get()
	{
		$id_ruangan = $this->get('id_ruangan');

		if($id_ruangan != null){
            $data = $this->mr->getRuangan($id_ruangan);
            if($data){
                $responseCode = "200";
                $responseDesc = "Success get a peminjaman";
			    $responseData = $data;
            }else{
                $responseCode = "204";
                $responseDesc = "Data not Found";
                $responseData = null;
            }
		}else{
            $data = $this->mr->getRuangan();
            $responseCode = "200";
			$responseDesc = "Success get All peminjaman";
			$responseData = $data;
		}
		
		

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
    }
}
?>