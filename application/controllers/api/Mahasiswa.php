<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Mahasiswa extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_mahasiswa', 'mm');
	}


	public function index_get()
	{
		$nim = $this->get('nim');

		if($nim){
			$data = $this->mm->getMahasiswa($nim);
			if($data){
                $responseCode = "200";
                $responseDesc = "Success get a mahasiswa";
			    $responseData = $data;
            }else{
                $responseCode = "204";
                $responseDesc = "Data not Found";
                $responseData = null;
            }
		}else{
			$data = $this->mm->getMahasiswa();
			$responseCode = "200";
			$responseDesc = "Success get All mahasiswa";
			$responseData = $data;
		}
		
		$response = resultJson($responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
    }
    
    public function kartuMahasiswa_get()
    {
        $no_ktm = $this->get('no_ktm');

        if($no_ktm){
            $data = $this->mm->kartuMahasiswa($no_ktm);
			if($data){
                $responseCode = "200";
                $responseDesc = "Success get a mahasiswa";
			    $responseData = $data;
            }else{
                $responseCode = "204";
                $responseDesc = "Data not Found";
                $responseData = null;
            }
        }
		
		$response = resultJson($responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
    }


	public function index_post()
	{	
        $no_ktm = ($this->post('no_ktm') !== null)?  $this->post('no_ktm') : null; 
        
        $insertData = array(
            'nim' => $this->post('nim'),
            'nama_mhs' => $this->post('nama_mhs'),
            'add_mhs' => $this->post('add_mhs'),
            'add_kel_mhs' => $this->post('add_kel_mhs'),
            'add_kec_mhs' => $this->post('add_kec_mhs'),
            'add_kota_mhs' => $this->post('add_kota_mhs'),
            'bpk_mhs' => $this->post('bpk_mhs'),
            'add_bpk_mhs' => $this->post('add_bpk_mhs'),
            'kel_bpk' => $this->post('kel_bpk'),
            'kec_bpk' => $this->post('kec_bpk'),
            'kota_bpk' => $this->post('kota_bpk'),
            'ibu_mhs' => $this->post('ibu_mhs'),
            'add_ibu_mhs' => $this->post('add_ibu_mhs'),
            'kel_ibu' => $this->post('kel_ibu'),
            'kec_ibu' => $this->post('kec_ibu'),
            'kota_ibu' => $this->post('kota_ibu'),
            'no_ktm' => $no_ktm,
            'tlp_mhs' => $this->post('tlp_mhs'),
            'tlp_bpk' => $this->post('tlp_bpk'),
            'tlp_ibu' => $this->post('tlp_ibu'),
            'profesi_bpk' => $this->post('profesi_bpk'),
            'profesi_ibu' => $this->post('profesi_ibu'),
            'penghasilan_bpk' => $this->post('penghasilan_bpk'),
            'email_mhs' => $this->post('email_mhs'),
            'email_ortu' => $this->post('email_ortu'),
            'thn_akad_thn_akad_id' => $this->post('thn_akad_thn_akad_id'),
            'usr_name' => $this->post('usr_name'),
            'password' => $this->post('password'),
            'prodi_prodi_id' => $this->post('prodi_prodi_id')			
        );

        $query = $this->mm->insertMahasiswa($insertData);

        if ($query) {
            $responseCode = "00";
            $responseDesc = "Success to create mahasiswa";
            $responseData = $insertData;
        }
        else{	
            $responseCode = "01";
            $responseDesc = "Failed to create mahasiswa";
            $responseData = $insertData;
        }

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
    }
    
    // function is_unique(){
    //     $post = $this->post(null,TRUE);
    //     $query = $this->db->query("SELECT * FROM tik.mahasiswa WHERE nim = '$post[nim]'");
    //     if($query->num_rows() > 0){
    //         $this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti' );
    //         return FALSE;
    //     }else{
    //         return TRUE;
    //     }
	// }

	public function index_put()
	{
		$nim = $this->put('nim');

        $updateData = array(				
            'nama_mhs' => $this->put('nama_mhs'),
            'add_mhs' => $this->put('add_mhs'),
            'add_kel_mhs' => $this->put('add_kel_mhs'),
            'add_kec_mhs' => $this->put('add_kec_mhs'),
            'add_kota_mhs' => $this->put('add_kota_mhs'),
            'bpk_mhs' => $this->put('bpk_mhs'),
            'add_bpk_mhs' => $this->put('add_bpk_mhs'),
            'kel_bpk' => $this->put('kel_bpk'),
            'kec_bpk' => $this->post('kec_bpk'),
            'kota_bpk' => $this->put('kota_bpk'),
            'ibu_mhs' => $this->put('ibu_mhs'),
            'add_ibu_mhs' => $this->put('add_ibu_mhs'),
            'kel_ibu' => $this->put('kel_ibu'),
            'kec_ibu' => $this->put('kec_ibu'),
            'kota_ibu' => $this->put('kota_ibu'),
            'no_ktm' => $this->put('no_ktm'),
            'tlp_mhs' => $this->put('tlp_mhs'),
            'tlp_bpk' => $this->put('tlp_bpk'),
            'tlp_ibu' => $this->put('tlp_ibu'),
            'profesi_bpk' => $this->put('profesi_bpk'),
            'profesi_ibu' => $this->put('profesi_ibu'),
            'penghasilan_bpk' => $this->put('penghasilan_bpk'),
            'email_mhs' => $this->put('email_mhs'),
            'email_ortu' => $this->put('email_ortu'),
            'thn_akad_thn_akad_id' => $this->put('thn_akad_thn_akad_id'),
            'usr_name' => $this->put('usr_name'),
            'password' => $this->put('password'),
            'prodi_prodi_id' => $this->put('prodi_prodi_id')
        );

        $query = $this->mm->updateMahasiswa($nim, $updateData);

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
		$nim = $this->delete('nim');
		$query = $this->mm->deleteMahasiswa($nim);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to delete mahasiswa";
			$responseData = null;
		}

		else{
			$responseCode = "01";
			$responseDesc = "Failed to delete mahasiswa";
			$responseData = null;
		}
		

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);

    }
    
    public function updateKartu_put()
    {
        $nim = $this->put('nim');

        $updateData = array(				 
            'no_ktm' => $this->put('no_ktm')            
        );

        $query = $this->mm->updateMahasiswa($nim, $updateData);

        if ($query) {
            $responseCode = "00";
            $responseDesc = "Success to update kartu user";
        }
        else{
            $responseCode = "01";
            $responseDesc = "Failed to update kartu user";
        }
		
		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
    }
}
