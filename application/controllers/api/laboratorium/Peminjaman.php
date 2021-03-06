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

		if($kd_pjm != null){
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

	public function pinjamMahasiswa_get()
	{
		$mahasiswa_nim = $this->get('mahasiswa_nim');

		if($mahasiswa_nim != null){
            $data = $this->mp->getPeminjamanMhs($mahasiswa_nim);
			$responseCode = "200";
			$responseDesc = "Success get a peminjaman";
			$responseData = $data;            
		}else{
			$responseCode = "204";
			$responseDesc = "Data not Found";
			$responseData = null;
		}
		
		

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}

	public function pinjamStaff_get()
	{
		$staff_nip = $this->get('staff_nip');

		if($staff_nip != null){
            $data = $this->mp->getPeminjamanStaff($staff_nip);
			$responseCode = "200";
			$responseDesc = "Success get a peminjaman";
			$responseData = $data;            
		}else{
			$responseCode = "204";
			$responseDesc = "Data not Found";
			$responseData = null;
		}
		
		

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}

	// Digunakan untuk membuat data peminjaman dahulu, agar user bisa memasukkan barang yang dipinjam.
	public function index_post()
	{	
		// Null Check		
		$mahasiswa_nim = ($this->post('mahasiswa_nim') !== null) ?  $this->post('mahasiswa_nim') : null;		
        $staff_nip = ($this->post('staff_nip') !== null) ?  $this->post('staff_nip') : null;
		$tgl_pjm = ($this->post('tgl_pjm') !== null)?  $this->post('tgl_pjm') : null;
		$tgl_blk = ($this->post('tgl_blk') !== null)?  $this->post('tgl_blk') : null;
		$tgl_blk_real = ($this->post('tgl_blk_real') !== null)?  $this->post('tgl_blk_real') : null;		
		
		// Generate new ID
		$id = $this->mp->getMaxId();
		$id = $id[0]->max;
		$next_id = number_format($id) + 1;
		
		$insertData = array(
			'kd_pjm' => $next_id,
			'tgl_pjm' => $tgl_pjm,
			'tgl_blk' => $tgl_blk,
			'tgl_blk_real' => $tgl_blk_real,
			'mahasiswa_nim' => $mahasiswa_nim,
			'staff_nip' => $staff_nip,
			'status' => "PENDING"
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
	
	public function maxId_get()
	{
		$data = $this->mp->getMaxId();
		if($data){
			$responseCode = "200";
			$responseDesc = "Success get a peminjam";
			$responseData = $data;
		}else{
			$responseCode = "204";
			$responseDesc = "Data not Found";
			$responseData = null;
		}
		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}
	
	// digunakan ketika proses peminjaman telah selesai.
	public function index_put()
	{
		$kd_pjm = $this->put('kd_pjm');

		// Null Check
		$mahasiswa_nim = ($this->put('mahasiswa_nim') !== null) ?  $this->put('mahasiswa_nim') : null;		
		$staff_nip = ($this->put('staff_nip') !== null) ?  $this->put('staff_nip') : null;
		$staff_penanggungjawab = ($this->put('staff_penanggungjawab') !== null) ?  $this->put('staff_penanggungjawab') : null;		
		$tgl_blk_real = ($this->put('tgl_blk_real') !== null)?  $this->put('tgl_blk_real') : null;	
		
		$ruangan_idruangan = ($this->put('ruangan_idruangan') == null)? null : $this->put('ruangan_idruangan');
		
		$updateData = array(				
			'tgl_pjm' => $this->put('tgl_pjm'),
			'tgl_blk' => $this->put('tgl_blk'),
			'tgl_blk_real' => $tgl_blk_real,
			'mahasiswa_nim' => $mahasiswa_nim,
			'staff_nip' => $staff_nip,
			'staff_penanggungjawab' => $staff_penanggungjawab,
			'status' => $this->put('status'),
			'keperluan' => $this->put('keperluan'),
			'ruangan_idruangan' => $ruangan_idruangan,
		);

		$query = $this->mp->updatePeminjaman($kd_pjm, $updateData);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to update peminjaman";
			$responseData = $updateData;
		}
		else{
			$responseCode = "01";
			$responseDesc = "Failed to update peminjaman";
		}
		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}

	public function updateKembali_put(){
		$kd_pjm = $this->put('kd_pjm');
						
		
		$updateData = array(				
			'tgl_blk_real' => $this->put('tgl_blk_real'),
			'status' => "FINISH"
		);

		$query = $this->mp->updatePeminjaman($kd_pjm, $updateData);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to update pengembalian peminjaman";
			$responseData = $updateData;
		}
		else{
			$responseCode = "01";
			$responseDesc = "Failed to update pengembalian peminjaman";
		}
		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}

	// Untuk update status proses peminjaman dari pending menjadi success
	public function updateStatus_put(){
		$kd_pjm = $this->put('kd_pjm');
				
		
		$updateData = array(							
			'status' => $this->put('status')
		);

		$query = $this->mp->updatePeminjaman($kd_pjm, $updateData);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to update status";
			$responseData = $updateData;
		}
		else{
			$responseCode = "01";
			$responseDesc = "Failed to update status";
			$responseData = $updateData;
		}
		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}
	
	// Digunakan untuk menghapus peminjaman ketika tidak jadi melakukan peminjaman
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
