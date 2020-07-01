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
        $usr_name = ($this->post('usr_name') !== null) ? $this->post('usr_name') : null;
        $password = ($this->post('password') !== null) ? $this->post('password') : null;
        $kel_staff = ($this->post('kel_staff') !== null) ? $this->post('kel_staff') : null;
        $kec_staff = ($this->post('kec_staff') !== null) ? $this->post('kec_staff') : null;
        $kota_staff = ($this->post('kota_staff') !== null) ? $this->post('kota_staff') : null;
        $prodi_prodi_id = ($this->post('prodi_prodi_id') !== null) ? $this->post('prodi_prodi_id') : null;

        $insertData = array(
            'nip' => $this->post('nip'),
            'nama' => $this->post('nama'),
            'alamat' => $this->post('alamat'),
            'kec_staff' => $kec_staff,
            'kel_staff' => $kel_staff,            
            'kota_staff' => $kota_staff,
            'tlp_staff' => $this->post('tlp_staff'),
            'email_staff' => $this->post('email_staff'),
            'usr_name' => $usr_name,
            'password' => $password,
            'prodi_prodi_id' => $prodi_prodi_id			
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

    public function access_post()
    {
        $usr_name = $this->post('usr_name');
        $password = $this->post('password');

        $access = $this->ms->getAccess($usr_name,$password);

        if($access){
            $responseCode = "200";
            $responseDesc = "Success get staff access";
            $responseData = $access;
        }else{
            $responseCode = "204";
            $responseDesc = "Data not Found";
            $responseData = null;
        }

        $response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
    }
    

	public function index_put()
	{
        $nip = $this->put('nip');
        
        // Null check
        $usr_name = ($this->put('usr_name') !== null) ? $this->put('usr_name'): null;
        $password = ($this->put('password') !== null) ? $this->put('password'): null;

        $updateData = array(				
            'nama' => $this->put('nama'),
            'alamat' => $this->put('alamat'),
            'kec_staff' => $this->put('kec_staff'),
            'kel_staff' => $this->put('kel_staff'),            
            'kota_staff' => $this->put('kota_staff'),
            'tlp_staff' => $this->put('tlp_staff'),
            'email_staff' => $this->put('email_staff'),
            'usr_name' => $usr_name,
            'password' => $password,
            'prodi_prodi_id' => $this->put('prodi_prodi_id')
        );

        $query = $this->ms->updateStaff($nip, $updateData);

        if ($query) {
            $responseCode = "00";
            $responseDesc = "Success to update user";
            $responseData = $updateData;
        }
        else{
            $responseCode = "01";
            $responseDesc = "Failed to update user";
            $responseData = null;
        }
		
		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
    }
    
    public function updateAccount_put()
    {
        $nip = $this->put('nip');

        $updateData = array(				             
            'password' => $this->put('password')                        
        );

        $query = $this->ms->updateStaff($nip, $updateData);

        if ($query) {
            $responseCode = "00";
            $responseDesc = "Success to update staff account";
            $responseData = $updateData;
        }
        else{
            $responseCode = "01";
            $responseDesc = "Failed to update staff account";
            $responseData = null;
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
