<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Peminjaman extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_peminjaman', 'mp');
	}


	public function index_get()
	{
		$kd_pjm = $this->get('kd_pjm');

		if($kd_pjm){
            $data = $this->mp->getPeminjaman($kd_pjm);
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
            $data = $this->mp->getPeminjaman();
            $responseCode = "200";
			$responseDesc = "Success get All peminjaman";
			$responseData = $data;
		}
		
		

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}


	public function index_post()
	{		    
		$insertData = array(
			'kd_pjm' => $this->post('kd_pjm'),
			'tgl_pjm' => $this->post('tgl_pjm'),
			'tgl_blk' => $this->post('tgl_blk'),
			'tgl_blk_real' => $this->post('tgl_blk_real'),
			'mahasiswa_nim' => $this->post('mahasiswa_nim'),
			'staff_nip' => $this->post('staff_nip'),
			'barang_kode_brg' => $this->post('barang_kode_brg')
		);

		$query = $this->mp->insertPeminjaman($insertData);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to create peminjaman";
			$responseData = $insertData;
		}
		else{	
			$responseCode = "01";
			$responseDesc = "Failed to create peminjaman";
			$responseData = $insertData;
		}

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
    }
    
    function is_unique(){
        $post = $this->post(null,TRUE);
        $query = $this->db->query("SELECT * FROM tik.peminjaman WHERE kd_pjm = '$post[kd_pjm]'");
        if($query->num_rows() > 0){
            $this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti' );
            return FALSE;
        }else{
            return TRUE;
        }
	}

	public function index_put()
	{
		$kd_pjm = $this->put('kd_pjm');
		
		$updateData = array(				
			'tgl_pjm' => $this->put('tgl_pjm'),
			'tgl_blk' => $this->put('tgl_blk'),
			'tgl_blk_real' => $this->put('tgl_blk_real'),
			'mahasiswa_nim' => $this->put('mahasiswa_nim'),
			'staff_nip' => $this->put('staff_nip'),
			'barang_kode_brg' => $this->put('barang_kode_brg')
		);

		$query = $this->mp->updatePeminjaman($kd_pjm, $updateData);

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

	public function updateKembali(){
		
	}
	
	public function index_delete()
	{
		$kd_pjm = $this->delete('kd_pjm');
		$query = $this->mp->deletePeminjaman($kd_pjm);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to delete peminjaman";
			$responseData = null;
		}

		else{
			$responseCode = "01";
			$responseDesc = "Failed to delete peminjaman";
			$responseData = null;
		}
		

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);

	}
}
