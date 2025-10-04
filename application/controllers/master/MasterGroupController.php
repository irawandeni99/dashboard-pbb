<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	/**
	 * 
	 */
	class MasterGroupController extends CI_Controller
	{
		
		public function __construct(){
			parent::__construct();
			date_default_timezone_set('Asia/Jakarta');
			$this->load->model('dashboard/MasterGroupModel', 'GroupModel');
			$this->load->model('PublicModel');
		}

		public function index()
		{
			$data['cnext'] 			= $this->GroupModel->nextid();  
			$data['view'] 			= 'master/group/GroupUser';
			$this->load->view('template/layout', $data);
		}


		public function get() {
			
			$is_admin = $this->session->userdata('is_admin');


			$list = $this->GroupModel->get_all_group();

	        $data = array();
	        $no = $_POST['start'];

	        foreach ($list as $field) {
	        	
				$ckode=$field->id_group;
				
				$link=base_url('master-group/edit/'.$ckode);
				
			   
	            $no++;
	            $row = array();
	            $row[] =$field->id_group;
	            $row[] = $field->nm_group;
	            $row[] = '
					<a href="'.$link.'" class="btn btn-flat btn-xs edit" data-kode="'.$field->id_group.'" data-nama="'.$field->nm_group.'" style="background-color: #007074; color: #F6F6F6;" ><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:16px;color:#ffffff" title="Edit Data"></i></a>
	            	</td>    	
		 	    	<script>$(document).ready(function() {$("[data-toggle=\'tooltip\']").tooltip(); });</script>
		 	    	';

	            $data[] = $row;
								
	        }
	 
	 
	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->GroupModel->count_all_group(),
	            "recordsFiltered" => $this->GroupModel->count_filtered_group(),
	            "data" => $data,
	        );
			
			
			
	        echo json_encode($output);
		}
		

		public function add(){
			$data['apip'] 			= $this->GroupModel->getGroup();
			$data['cnext'] 			= $this->GroupModel->nextid();
			$data['view'] 			= 'master/group/addGroupUserView';
			$this->load->view('template/layout', $data);
		}




		public function edit($ckode=''){
			$data['ckode'] 			= $ckode;
			$data['cnama']	 		= $this->PublicModel->get_nama($ckode,'nm_group','ms_group','id_group');	

			$data['view'] 			= 'master/group/editGroupUserView';
			$this->load->view('template/layout', $data);
		}


		public function insert(){
			$cid_group= $this->input->post('cid_group');
			$cnm_group = $this->input->post('cnm_group');
			


			$csql = "insert into ms_group(id_group,nm_group)values(".$cid_group.",'".$cnm_group."')";				
				$cquery1 = $this->db->query($csql);
			if($cquery1){
					$pesan=1;//"Data Berhasil Ditambahkan!";
				}else{
					$pesan=0;//"Data Gagal Simpan!";					
				}
				

				$dataRet['pesan'] = $pesan;
				echo json_encode($dataRet);	
		
		}
		
		
		

		public function update(){
			$cid_group= $this->input->post('id_group');
			$cnm_group = $this->input->post('nm_group');

				$csql = "update ms_group set nm_group='".$cnm_group."' where id_group='".$cid_group."'";				
				$cquery1 = $this->db->query($csql);
				
				if($cquery1){
					$pesan=1;//"Data Berhasil Ditambahkan!";
				}else{
					$pesan=0;//"Data Gagal Simpan!";					
				}
				

				$dataRet['pesan'] = $pesan;
				echo json_encode($dataRet);			
			
			
			}



		public function hapus(){
			$cid_group= $this->input->post('cid_group');

				$csql = "delete  from ms_group where id_group='".$cid_group."'";				
				$cquery1 = $this->db->query($csql);

				if($cquery1){
					$pesan=1;
				}else{
					$pesan=0;				
				}
				
				$dataRet['pesan'] = $pesan;
				echo json_encode($dataRet);			

			}			
				
	

	}
