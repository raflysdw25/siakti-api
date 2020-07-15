<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class JabatanLab extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_jabatanlab', 'mjl');
	}


	public function index_get()
	{
		$id_jablab = $this->get('id_jablab');
		$staff_nip = $this->get('staff_nip');

		if($id_jablab){
			$data = $this->mjl->getJabatanLab($id_jablab);
			if($data){
                $responseCode = "200";
                $responseDesc = "Success get a jabatan lab";
			    $responseData = $data;
            }else{
                $responseCode = "204";
                $responseDesc = "Data not Found";
                $responseData = null;
            }
		}elseif($staff_nip){
			$data = $this->mjl->cekJabatanLab($staff_nip);
			$responseCode = "200";
			$responseDesc = "Success get Jabatan Lab";
			$responseData = $data;
		}else{
			$data = $this->mjl->getJabatanLab();
			$responseCode = "200";
			$responseDesc = "Success get All JabatanLab";
			$responseData = $data;
		}
		
		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
    }

    public function maxId_get()
	{
		$data = $this->mjl->getMaxId();
		if($data){
			$responseCode = "200";
			$responseDesc = "Success get a jabatan lab";
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
		$id = $this->mjl->getMaxId();
		$id = $id[0]->max;
		$next_id = ($id == null) ? 1: number_format($id) + 1;
			           
        $insertData = array(
            'id_jablab' => $next_id,
            'staff_nip' => $this->post('staff_nip'),
            'jablab_struk_id' => $this->post('jablab_struk_id'),
            'tgl_mulai' => $this->post('tgl_mulai'),
            'tgl_selesai' => $this->post('tgl_selesai')
        );

        $query = $this->mjl->insertJabatanLab($insertData);

        if ($query) {
            $responseCode = "00";
            $responseDesc = "Success to set jabatan lab";
            $responseData = $insertData;
        }
        else{	
            $responseCode = "01";
            $responseDesc = "Failed to set jabatan lab";
            $responseData = $insertData;
        }

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}

	public function index_put()
	{
		$id_jablab = $this->put('id_jablab');

		$updateData = array(									
            'staff_nip' => $this->put('staff_nip'),
            'jablab_struk_id' => $this->put('jablab_struk_id'),
            'tgl_mulai' => $this->put('tgl_mulai'),
            'tgl_selesai' => $this->put('tgl_selesai'),
		);

		$query = $this->mjl->updateJabatanLab($id_jablab, $updateData);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to update jabatan lab";
			$responseData = $updateData;
		}
		else{
			$responseCode = "01";
			$responseDesc = "Failed to update jabatan lab";
			$responseData = null;
		}
		

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}
	
	// Untuk menghapus jabatan lab yang sedang dijalankan oleh petugas lab
	public function index_delete()
	{
		$nip = $this->delete('nip');
		$query = $this->mjl->deleteJabatan($nip);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to delete staff lab";
			$responseData = null;
		}

		else{
			$responseCode = "01";
			$responseDesc = "Failed to delete staff lab";
			$responseData = null;
		}
		

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);

	}
}