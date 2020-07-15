<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class StrukturalLab extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_strukturallab', 'mst');
	}


	public function index_get()
	{
		$id_jablab_struk = $this->get('id_jablab_struk');

		if($id_jablab_struk){
			$data = $this->mst->getStruktural($id_jablab_struk);
			if($data){
                $responseCode = "200";
                $responseDesc = "Success get a Struktural";
			    $responseData = $data;
            }else{
                $responseCode = "204";
                $responseDesc = "Data not Found";
                $responseData = null;
            }
		}else{
			$data = $this->mst->getStruktural();
			$responseCode = "200";
			$responseDesc = "Success get All Struktural";
			$responseData = $data;
		}
		
		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}
		

	public function index_post()
	{
		$id_jablab_struk = $this->mst->getMaxId();
		$id_jablab_struk = $id_jablab_struk[0]->max;
		$next_id = number_format($id_jablab_struk) + 1;
				
		$insertData = array(
		   'id_jablab_struk' => $next_id,
		   'nama_jab' => $this->post('nama_jab'),
        );

        $query = $this->mst->insertStrukturalLab($insertData);

        if ($query) {
            $responseCode = "00";
            $responseDesc = "Success to add jabatan lab";
            $responseData = $insertData;
        }
        else{	
            $responseCode = "01";
            $responseDesc = "Failed to add jabatan lab";
            $responseData = $insertData;
        }

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}

	public function index_put()
	{
		$id_jablab_struk = $this->put('id_jablab_struk');

		$updateData = array(									
			'nama_jab' => $this->put('nama_jab'),
		);

		$query = $this->ms->updateStruktural($id_jablab_struk, $updateData);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to update struktural lab";
			$responseData = $updateData;
		}
		else{
			$responseCode = "01";
			$responseDesc = "Failed to update struktural lab";
			$responseData = null;
		}
		

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}

	public function index_delete()
	{
		$id_jablab_struk = $this->delete('id_jablab_struk');
		$query = $this->ms->deleteStruktural($id_jablab_struk);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to delete struktural lab";
			$responseData = null;
		}

		else{
			$responseCode = "01";
			$responseDesc = "Failed to delete struktural lab";
			$responseData = null;
		}
		

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);

	}
}