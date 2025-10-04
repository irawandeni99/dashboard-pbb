<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	/**
	 * 
	 */
	class MasterController extends CI_Controller
	{
		
		public function __construct(){
			parent::__construct();
			date_default_timezone_set('Asia/Jakarta');
			$this->load->model('PublicModel');
		}

		public function get_Mkecamatan($ckode=''){
			$data = $this->PublicModel->getMkecamatan($ckode);	
			echo json_encode($data[0]);
		}

		public function list_Mkecamatan($ckode=''){
			$data = $this->PublicModel->listMkecamatan($ckode);	
			echo json_encode($data[0]);
		}








		public function get() {
			
			$is_admin = $this->session->userdata('is_admin');


			$list = $this->PublicModel->getMkecamatan();

	        $data = array();
	        $no = $_POST['start'];

	        foreach ($list as $field) {
	        	
				$ckode=$field->kd_apip;
				
				$link=base_url('kapip-master-apip/edit/'.$ckode);
				
			   
	            $no++;
	            $row = array();
	            $row[] =$field->kd_apip;
	            $row[] = $field->nm_apip;
	            $row[] = '
					<a href="'.$link.'" class="btn btn-info btn-flat btn-xs edit" data-kode="'.$field->kd_apip.'" data-nama="'.$field->nm_apip.'"><i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="tooltip" title="Detail"></i></a>
	            	</td>    	
		 	    	<script>$(document).ready(function() {$("[data-toggle=\'tooltip\']").tooltip(); });</script>
		 	    	';

	            $data[] = $row;
								
	        }
	 
	 
	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->ApipModel->count_all_apip(),
	            "recordsFiltered" => $this->ApipModel->count_filtered_apip(),
	            "data" => $data,
	        );
			
			
			
	        echo json_encode($output);
		}
		

		// public function add(){
		// 	$data['apip'] 			= $this->ApipModel->getApip();
		// 	$data['cnext'] 			= $this->ApipModel->nextid();
		// 	$data['view'] 			= 'kapip/master/addApipView';
		// 	$this->load->view('template/layout', $data);
		// }




		// public function edit($ckode=''){
		// 	$data['ckode'] 			= $ckode;
		// 	$data['cnama']	 		= $this->PublicModel->get_nama($ckode,'nm_apip','ms_apip','kd_apip');	

		// 	$data['view'] 			= 'kapip/master/editApipView';
		// 	$this->load->view('template/layout', $data);
		// }


		// public function insert(){
		// 	$ckd_apip= $this->input->post('ckd_apip');
		// 	$cnm_apip = $this->input->post('cnm_apip');
			


		// 	$csql = "insert into ms_apip(kd_apip,nm_apip)values(".$ckd_apip.",'".$cnm_apip."')";				
		// 		$cquery1 = $this->db->query($csql);
		// 	if($cquery1){
		// 			$pesan=1;//"Data Berhasil Ditambahkan!";
		// 		}else{
		// 			$pesan=0;//"Data Gagal Simpan!";					
		// 		}
				

		// 		$dataRet['pesan'] = $pesan;
		// 		echo json_encode($dataRet);	
		
		// }
		
		
		

		// public function update(){
		// 	$ckd_apip= $this->input->post('kd_apip');
		// 	$cnm_apip = $this->input->post('nm_apip');

		// 		$csql = "update ms_apip set nm_apip='".$cnm_apip."' where kd_apip='".$ckd_apip."'";				
		// 		$cquery1 = $this->db->query($csql);

				
		// 		if($cquery1){
		// 			$pesan=1;//"Data Berhasil Ditambahkan!";
		// 		}else{
		// 			$pesan=0;//"Data Gagal Simpan!";					
		// 		}
				

		// 		$dataRet['pesan'] = $pesan;
		// 		echo json_encode($dataRet);			
			
			
		// 	}



		// public function hapus(){
		// 	$ckd_apip= $this->input->post('ckd_apip');

		// 		$csql = "delete  from ms_apip where kd_apip='".$ckd_apip."'";				
		// 		$cquery1 = $this->db->query($csql);

		// 		if($cquery1){
		// 			$pesan=1;
		// 		}else{
		// 			$pesan=0;				
		// 		}
				
		// 		$dataRet['pesan'] = $pesan;
		// 		echo json_encode($dataRet);			

		// 	}			
				
	

	}
