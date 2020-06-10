<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Staff extends REST_Controller {
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


	public function index_post()
	{    
        $insertData = array(
            'nip' => $this->post('nip'),
            'nama' => $this->post('nama'),
            'alamat' => $this->post('alamat'),
            'kec_staff' => $this->post('kec_staff'),
            'kel_staff' => $this->post('kel_staff'),            
            'kota_staff' => $this->post('kota_staff'),
            'tlp_staff' => $this->post('tlp_staff'),
            'email_staff' => $this->post('email_staff'),
            'usr_name' => $this->post('usr_name'),
            'password' => $this->post('password'),
            'prodi_prodi_id' => $this->post('prodi_prodi_id')			
        );

        $query = $this->ms->insertStaff($insertData);

        if ($query) {
            $responseCode = "00";
            $responseDesc = "Success to create staff";
            $responseData = $insertData;
        }
        else{	
            $responseCode = "01";
            $responseDesc = "Failed to create staff";
            $responseData = $insertData;
        }

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
    }
    
    // function is_unique(){
    //     $post = $this->post(null,TRUE);
    //     $query = $this->db->query("SELECT * FROM tik.staff WHERE nip = '$post[nip]'");
    //     if($query->num_rows() > 0){
    //         $this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti' );
    //         return FALSE;
    //     }else{
    //         return TRUE;
    //     }
	// }

	public function index_put()
	{
		$nip = $this->put('nip');

        $updateData = array(				
            'nama' => $this->put('nama'),
            'alamat' => $this->put('alamat'),
            'kec_staff' => $this->put('kec_staff'),
            'kel_staff' => $this->put('kel_staff'),            
            'kota_staff' => $this->put('kota_staff'),
            'tlp_staff' => $this->put('tlp_staff'),
            'email_staff' => $this->put('email_staff'),
            'usr_name' => $this->put('usr_name'),
            'password' => $this->put('password'),
            'prodi_prodi_id' => $this->put('prodi_prodi_id')
        );

        $query = $this->ms->updateStaff($nip, $updateData);

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
		$nip = $this->delete('nip');
		$query = $this->ms->deleteStaff($nip);

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
