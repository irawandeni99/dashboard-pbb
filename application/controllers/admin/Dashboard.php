<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Dashboard extends CI_Controller  {
		public function __construct(){
			parent::__construct();			
			$this->load->library('mybreadcrumb');
			$this->load->model('kapip/DashboradModel', 'MDashboard');
			$this->load->model('dashboard/PotensiModel', 'MPotensi');
			$this->load->model('PublicModel');
			
		}

		public function index(){			
			ini_set('max_execution_time', 300);					
			$data['view'] = 'admin/dashboard/index';
			$data['kecamatan'] 		= $this->PublicModel->getKecamatan();	
			$this->load->view('template/layout', $data);
		}


		
		public function mpdf()
		{
			$mpdf = new \Mpdf\Mpdf();
			$data['view'] = 'admin/dashboard/index';
			$html = $this->load->view('template/layout', $data,true);
			// $html = $this->load->view('mpdfView',[],true);
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}


		public function simpan_simpulan(){ 
		
			$akses = $this->session->userdata('is_admin');	
			$ctahun = $this->input->post('ctahun');	
			$cinstansi = $this->input->post('cinstansi');			
			$celemen = $this->input->post('celemen');			
			$clevel = $this->input->post('clevel');
			$csimpulan = $this->input->post('csimpulan');
			$user_id = $this->session->userdata('user_id');			
			$ctgl = date('Y-m-d H:i:s');
			
			$sql = "SELECT *from ms_user where id_user='".$user_id."'";
			$user = $this->db->query($sql)->row();	
			$cnmuser = '[ '.$user->name.' ]';
			$ctypeuser = $user->is_admin;

			
			$sql = "select count(*)jml from tsimpulan where tahun='".$ctahun."' and kd_apip='".$cinstansi."' and kd_level='".$clevel."' and id_group='".$akses."'";
			$ceksimpul = $this->db->query($sql)->row()->jml;			
						
			if($ceksimpul==0){
				
							
						$datainsert = array(
							'tahun' 				=> $ctahun,
							'kd_apip'				=> $cinstansi,
							'id_group'				=> $akses,
							'kd_level' 				=> $clevel,
							'simpulan' 				=> $csimpulan,
							'user_insert' 			=> $user_id,
							'insert_at' 			=> $ctgl,
							
						);
			
						$data = $this->security->xss_clean($datainsert);
						$result = $this->MDashboard->insertSimpulan($data);
					
			}else{			
						$whereUpdate = array(
							'tahun' 			=> $ctahun,
							'kd_apip' 			=> $cinstansi,
							'id_group' 			=> $akses,
							'kd_level' 			=> $clevel,
						);
					
						$dataUpdate = array(
							'simpulan' 				=> $csimpulan,
							'user_insert' 			=> $user_id,
							'insert_at' 			=> $ctgl,
						);


						$this->db->where($whereUpdate);
						$result= $this->db->update('tsimpulan', $dataUpdate);
							
					
			
			}	
				
				if($result){
					
					if($csimpulan==1){  	 
						
						$hsql = "UPDATE thistory SET tampil=0 WHERE tahun='".$ctahun."' and kd_apip='".$cinstansi."' and kd_level='".$clevel."' and nilai=1";		
						$cquery = $this->db->query($hsql); 
						
						$curaian =$cnmuser.' Melakukan Penguncian Level '.$clevel;
						$cnilai=1;
						
						//$croute='kapip-Pengaturan-Manajemen-User/get-manajemen/'.$ctahun.'/'.$cinstansi;
						//url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/get-manajemen'); /'+ctahun+'/'+ckode,
						
						$croute='kapip-Pengaturan-Manajemen-User';
						
						$datainserthistory = array(
							'aksi' 					=> 'KUNCI',
							'tahun' 				=> $ctahun,
							'kd_apip'				=> $cinstansi,
							'kd_level'				=> $clevel,
							'uraian' 				=> $curaian,
							'user_id' 				=> $user_id,
							'user_type' 			=> $ctypeuser,
							'user_date' 			=> $ctgl,
							'status' 				=> 0,
							'routes' 				=> $croute,
							'jenis' 				=> 5, 
							'tampil' 				=> 1,
							'nilai'					=> $cnilai,
							'id_penerima'			=> 1,
							
						);

						$datahistory = $this->security->xss_clean($datainserthistory);		
						$hresult = $this->MDashboard->insertHistory($datahistory);		
						
					}
					
					
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
					

		} 


	





	}

?>	