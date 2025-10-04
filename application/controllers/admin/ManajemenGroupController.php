<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	/**
	 * 
	 */
	class ManajemenGroupController extends CI_Controller
	{
		
		public function __construct(){
			parent::__construct();
			date_default_timezone_set('Asia/Jakarta');
			$this->load->model('dashboard/ManajemenGroupModel', 'ManajemenModel');
			$this->load->model('PublicModel');
		}


		public function index(){		
			$data['view'] 			= 'admin/manajemen/addGroupView';
			$this->load->view('template/layout', $data);
		}


		public function tambah_group(){
			$data = $this->ManajemenModel->viewAddGroup();
			echo $data;
		}


		public function add(){
			$data['apip'] 			= $this->ManajemenModel->getApip();
			$data['instansi'] 		= $this->ManajemenModel->getInstansi();
			//$data['audit'] 			= $this->db->get('ms_jenis_audit')->result_array();
			$data['view'] 			= 'admin/manajemen/addPenilaianView';
			$this->load->view('template/layout', $data);
		}







		public function tambah_menu($cgroup=''){
			$data = $this->ManajemenModel->viewAddMenu($cgroup);
			echo $data;
		}




		public function list_group($cthn='',$cinst=''){
			$data = $this->ManajemenModel->listGroup($cthn,$cinst);
			echo $data;			
		}


		public function list_menu($cgroup=''){
			$data = $this->ManajemenModel->listMenu($cgroup);
			echo $data;
			
			
		}


		public function get_manajemen(){

			$data = $this->ManajemenModel->viewManajemen();
			echo $data;
						
		}


		public function hapus_group(){   
			
			$cidgroup = $this->input->post('cidgroup');
			
				$result = $this->db->delete('ms_group', array('id_group' => $cidgroup));
				if($result){

					$message = "1";
				}else{
					
					$message = "0";
				}

		    echo json_encode($message);
		}
		
	
	


		public function hapus_menu(){  
			
			$cmenu = $this->input->post('cmenu');			
			$cgroup = $this->input->post('cgroup');
			
			$sql = "SELECT COUNT(*)jml FROM sys_group a
					INNER JOIN sys_menu b ON a.id_menu=b.id_menu 
					WHERE b.parent_id='".$cmenu."' AND id_group='".$cgroup."'";	
			$cekdata = $this->db->query($sql)->row()->jml;
			
				if($cekdata>=1){
					$message = "2";

				}else{
					
					$result = $this->db->delete('sys_group', array('id_group' => $cgroup,'id_menu' => $cmenu));

				}			
			
			
				if($result){

					$message = "1";
				}else{
					
					$message = "0";
				}

		    echo json_encode($message);

		}


		public function simpan_group(){   

			$user_id = $this->session->userdata('user_id');
			$ctgl = date('Y-m-d H:i:s');
			
			$data = array(
						'id_group' 			=> $this->input->post('cgroup'),
						'tahun' 			=> $this->input->post('ctahun'),
						'kd_apip' 			=> $this->input->post('cinstansi')
						
					);
					$data = $this->security->xss_clean($data);
					$result = $this->ManajemenModel->add_group($data);

					
				if($result){
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
					

		} 

		public function simpan_menu(){   


			$cmenu 		= $this->input->post('cmenu');
			$cgroup	 	= $this->input->post('cgroup');
			$cnmgroup 	=$this->PublicModel->get_nama($cgroup,'nm_group','ms_group','id_group');
				

					$data = array(
								'id_group' 			=> $cgroup,
								'id_menu' 			=> $cmenu,
								'nm_group' 			=> $cnmgroup
							
							);
							$data = $this->security->xss_clean($data);
							$result = $this->ManajemenModel->add_menu($data);
				
					
				if($result){
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
					

		} 



	}
