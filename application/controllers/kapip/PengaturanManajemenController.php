<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	/**
	 * 
	 */
	class PengaturanManajemenController extends CI_Controller
	{
		
		public function __construct(){
			parent::__construct();
			date_default_timezone_set('Asia/Jakarta');
			$this->load->model('kapip/PengaturanManajemenModel', 'ManajemenModel');
			$this->load->model('PublicModel');
		}


		public function add(){
			$data['apip'] 			= $this->ManajemenModel->getApip();
			$data['instansi'] 		= $this->ManajemenModel->getInstansi();
			//$data['audit'] 			= $this->db->get('ms_jenis_audit')->result_array();
			$data['view'] 			= 'kapip/master/addPenilaianView';
			$this->load->view('template/layout', $data);
		}


		public function group(){
			$cthn = $this->session->userdata('year_selected');
			$ckode = $this->session->userdata('id_instansi');
			
			$nmapip	 				= $this->PublicModel->get_nama($ckode,'nm_apip','ms_apip','kd_apip');		
			$data['kode'] 			= $ckode;
			$data['instansi'] 		= $nmapip;
			$data['tahun'] 			= $cthn;			
			$data['view'] 			= 'kapip/pengaturan/addGroupView';
			$this->load->view('template/layout', $data);
		}


		public function list_copydata(){
			$cthn = $this->session->userdata('year_selected');
			/* $ckode = $this->session->userdata('id_instansi');
			
			$nmapip	 				= $this->PublicModel->get_nama($ckode,'nm_apip','ms_apip','kd_apip');		
			$data['kode'] 			= $ckode;
			$data['instansi'] 		= $nmapip; */
			$data['tahun'] 			= $cthn;			
			$data['view'] 			= 'kapip/pengaturan/copyDataView';
			$this->load->view('template/layout', $data);
		}

		public function tambah_topik($cthn='',$cinst='',$celemen='',$cgroup=''){
			$data = $this->ManajemenModel->viewAddTopik($cthn,$cinst,$celemen,$cgroup);
			echo $data;
		}


		public function tambah_group_profil($cthn='',$cinst=''){
			$data = $this->ManajemenModel->viewAddGroupProfil($cthn,$cinst);
			echo $data;
		}

		public function tambah_group($cthn='',$cinst=''){
			$data = $this->ManajemenModel->viewAddGroup($cthn,$cinst);
			echo $data;
		}

		public function tambah_profil($cthn='',$cinst='',$cgroup=''){
			$data = $this->ManajemenModel->viewAddProfil($cthn,$cinst,$cgroup);
			echo $data;
		}

		public function tambah_menu($cgroup=''){
			$data = $this->ManajemenModel->viewAddMenu($cgroup);
			echo $data;
		}

		public function tambah_elemen($cthn='',$cinst='',$cgroup=''){
			$data = $this->ManajemenModel->viewAddElemen($cthn,$cinst,$cgroup);
			echo $data;
		}


		public function setting_penilaian($cthn='',$cinst='',$cgroup=''){
			$data = $this->ManajemenModel->viewSettingPenilaian($cthn,$cinst,$cgroup);
			echo $data;
		}


		public function get_simpulan(){
			$ctahun = $this->input->post('ctahun');	
			$cinstansi = $this->input->post('cinst');
			$cgroup = $this->input->post('cgroup');
			
			
			$data = $this->ManajemenModel->viewSimpulan($ctahun,$cinstansi,$cgroup);
			echo $data;
						
		}	


		public function simpan_kunci(){ 
			$akses = $this->session->userdata('is_admin');
			$cgroup = $this->input->post('cgroup');	
			$ctahun = $this->input->post('ctahun');	
			$cinstansi = $this->input->post('cinst');		
			$clevel = $this->input->post('clevel');
			$ckunci = $this->input->post('ckunci');
			$user_id = $this->session->userdata('user_id');			
			$ctgl = date('Y-m-d H:i:s');
			
			$sql = "SELECT *from ms_user where id_user='".$user_id."'";
			$user = $this->db->query($sql)->row();	
			$cnmuser = '[ '.$user->name.' ]';
	
			
			$sql = "select count(*)jml from tsimpulan where tahun='".$ctahun."' and kd_apip='".$cinstansi."' and kd_level='".$clevel."' and id_group='".$cgroup."'";
			$ceksimpul = $this->db->query($sql)->row()->jml;			
			
			
			if($ceksimpul==0){
				$datainsert = array(
					'tahun' 				=> $ctahun,
					'kd_apip'				=> $cinstansi,
					'kd_level' 				=> $clevel,
					'simpulan' 				=> $ckunci,
					'user_insert' 			=> $user_id,
					'insert_at' 			=> $ctgl,
					'id_group'				=> $cgroup,
					
				);
	
				$data = $this->security->xss_clean($datainsert);
				$result = $this->ManajemenModel->insertSimpulan($data);
			
			}else{
				
				$whereUpdate = array(
					'tahun' 			=> $ctahun,
					'kd_apip' 			=> $cinstansi,
					'kd_level' 			=> $clevel,
					'id_group'			=> $cgroup,
				);
			
				$dataUpdate = array(
					'simpulan' 				=> $ckunci,
					'user_insert' 			=> $user_id,
					'insert_at' 			=> $ctgl,
				);


				$this->db->where($whereUpdate);
				$result= $this->db->update('tsimpulan', $dataUpdate);
					
			}
			
				
				
				if($result){
					
					if($ckunci==1){
						
						$hsql = "UPDATE thistory SET tampil=0 WHERE tahun='".$ctahun."' and kd_apip='".$cinstansi."' and kd_level='".$clevel."' and user_type='".$cgroup."' and nilai=1";		
						$cquery = $this->db->query($hsql); 
						
						$curaian =$cnmuser.' Melakukan Penguncian Level '.$clevel;
						$cnilai=1;
						
						$datainserthistory = array(
							'aksi' 					=> 'KUNCI',
							'tahun' 				=> $ctahun,
							'kd_apip'				=> $cinstansi,
							'kd_level'				=> $clevel,
							'uraian' 				=> $curaian,
							'user_id' 				=> $user_id,
							'user_type' 			=> $cgroup,
							'user_date' 			=> $ctgl,
							'status' 				=> 0,
							'routes' 				=> 'dashboard',
							'jenis' 				=> 5, 
							'tampil' 				=> 1,
							'nilai'					=> $cnilai,
							'id_penerima'			=> $cgroup,
							
						);

						$datahistory = $this->security->xss_clean($datainserthistory);		
						$hresult = $this->ManajemenModel->insertHistory($datahistory);		
						
					}else{
						$hsql = "UPDATE thistory SET tampil=0 WHERE tahun='".$ctahun."' and kd_apip='".$cinstansi."' and kd_level='".$clevel."' and user_type='".$cgroup."' and nilai=0";		
						$cquery = $this->db->query($hsql); 
						
						$curaian =$cnmuser.' Melakukan Buka Kunci Level '.$clevel;
						$cnilai=0;
						
						$datainserthistory = array(
							'aksi' 					=> 'BUKA KUNCI',
							'tahun' 				=> $ctahun,
							'kd_apip'				=> $cinstansi,
							'kd_level'				=> $clevel,
							'uraian' 				=> $curaian,
							'user_id' 				=> $user_id,
							'user_type' 			=> $cgroup,
							'user_date' 			=> $ctgl,
							'status' 				=> 'BELUM DIBACA',
							'routes' 				=> 'dashboard',
							'jenis' 				=> 5, 
							'tampil' 				=> 1,
							'nilai'					=> $cnilai,
							
						);

						$datahistory = $this->security->xss_clean($datainserthistory);		
						$hresult = $this->ManajemenModel->insertHistory($datahistory);								
						
						
					}					
					
					
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
					

		} 



		public function cek_topik($cthn='',$cinst='',$celemen=''){
			$data = $this->ManajemenModel->cekTopik($cthn,$cinst,$celemen);
			echo $data;
			
			
		}

		public function list_group($cthn='',$cinst=''){
			$data = $this->ManajemenModel->listGroup($cthn,$cinst);
			echo $data;			
		}

		public function list_group_profil($cthn='',$cinst=''){
			$data = $this->ManajemenModel->listGroupProfil($cthn,$cinst);
			echo $data;			
		}


		public function list_profil($cthn='',$cinst='',$cgroup=''){
			$data = $this->ManajemenModel->listProfil($cthn,$cinst,$cgroup);
			echo $data;
			
			
		}
		
		public function list_elemen($cthn='',$cinst='',$cgroup=''){
			$data = $this->ManajemenModel->listElemen($cthn,$cinst,$cgroup);
			echo $data;
			
			
		}


		public function list_menu($cgroup=''){
			$data = $this->ManajemenModel->listMenu($cgroup);
			echo $data;
			
			
		}

		public function list_topik($cthn='',$cinst='',$celemen='',$cgroup=''){
			$data = $this->ManajemenModel->listTopik($cthn,$cinst,$celemen,$cgroup);
			echo $data;
			
			
		}

		public function get_manajemen($cthn='',$ckode=''){

			$data = $this->ManajemenModel->viewManajemen($cthn,$ckode);
			echo $data;
						
		}


		public function get_awaltahun($cthn='',$ckode=''){

			$data = $this->ManajemenModel->viewCopydata($cthn,$ckode);
			echo $data;
						
		}

		public function get_manajemen_profil($cthn='',$ckode=''){

			$data = $this->ManajemenModel->viewManajemenProfil($cthn,$ckode);
			echo $data;
						
		}


		public function hapus_group_profil(){  
			
			$ctahun = $this->input->post('ctahun');			
			$cinstansi = $this->input->post('cinstansi');
			$cidgroup = $this->input->post('cidgroup');
			
				$result = $this->db->delete('ms_group_menu_profil', array('tahun' => $ctahun,'kd_apip' => $cinstansi,'id_group' => $cidgroup));
				if($result){

					$message = "1";
				}else{
					
					$message = "0";
				}

		    echo json_encode($message);

		}



		public function hapus_group(){   
			
			$ctahun = $this->input->post('ctahun');			
			$cinstansi = $this->input->post('cinstansi');
			$cidgroup = $this->input->post('cidgroup');
			
				$result = $this->db->delete('ms_group_menu_elemen', array('tahun' => $ctahun,'kd_apip' => $cinstansi,'id_group' => $cidgroup));
				if($result){

					$message = "1";
				}else{
					
					$message = "0";
				}

		    echo json_encode($message);
		}
		
	
		public function hapus_profil(){  
			
			$ctahun = $this->input->post('ctahun');			
			$cinstansi = $this->input->post('cinstansi');
			$cprofil = $this->input->post('cprofil');
			$cgroup = $this->input->post('cidgroup');
			
			

			$sql = "SELECT count(*)jml FROM ms_group_menu_profil WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' and id_group='".$cgroup."'";	
			$cekdata = $this->db->query($sql)->row()->jml;
			
				if($cekdata==1){
					
					$whereUpdate = array(
						'tahun' 			=> $ctahun,
						'kd_apip' 			=> $cinstansi,
						'kd_profil' 		=> $cprofil,
						'id_group' 			=> $cgroup
					);
					$dataUpdate = array(
						'kd_profil' 			=> ''
					);


					$this->db->where($whereUpdate);
					$result= $this->db->update('ms_group_menu_profil', $dataUpdate);			
				}else{
					
					$result = $this->db->delete('ms_group_menu_profil', array('tahun' => $ctahun,'kd_apip' => $cinstansi,'kd_profil' => $cprofil,'id_group' => $cgroup));
		
				}
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



		public function copydata(){  
			
			$ctahun = $this->input->post('ctahun');	
			$sql = "SELECT MAX(tahun) tahun FROM ms_group_menu_profil";	
			$cekdata = $this->db->query($sql)->row()->tahun;
			
				if($cekdata==$ctahun){
					$message = "2";

				}else{
					
						$sql3 = 'CALL copy_awaltahun('.$ctahun.');';
						$res3 = $this->db->query($sql3);
						$this->db->close();
						$jmlRes3 = count($res3);
						
					
			
				if($jmlRes3 > 0){

					$message = "1";
				}else{
					
					$message = "0";
				}
			}
		    echo json_encode($message);

		}


		public function hapus_elemen(){  
			
			$ctahun = $this->input->post('ctahun');			
			$cinstansi = $this->input->post('cinstansi');
			$celemen = $this->input->post('celemen');
			$cgroup = $this->input->post('cidgroup');
			
			$sql = "SELECT count(*)jml FROM ms_group_menu_elemen WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' and id_group='".$cgroup."'";	
			$cekdata = $this->db->query($sql)->row()->jml;
			
				if($cekdata==1){
					
					$whereUpdate = array(
						'tahun' 			=> $ctahun,
						'kd_apip' 			=> $cinstansi,
						'id_group' 			=> $cgroup
					);
					$dataUpdate = array(
						'kd_elemen' 			=> 0
						
					);

					$this->db->where($whereUpdate);
					$result= $this->db->update('ms_group_menu_elemen', $dataUpdate);

				}else{
					
					$result = $this->db->delete('ms_group_menu_elemen', array('tahun' => $ctahun,'kd_apip' => $cinstansi,'kd_elemen' => $celemen,'id_group' => $cgroup));

				}			
			
			
				if($result){

					$message = "1";
				}else{
					
					$message = "0";
				}

		    echo json_encode($message);

		}


		public function hapus_topik(){  
			
			$ctahun 	= $this->input->post('ctahun');			
			$cinstansi 	= $this->input->post('cinstansi');
			$celemen 	= $this->input->post('celemen');
			$ctopik 	= $this->input->post('ctopik');
			$cgroup 	= $this->input->post('cgroup');
			
			$sql = "SELECT count(*)jml FROM ms_group_menu_elemen WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' and kd_elemen='".$celemen."' and id_group='".$cgroup."'";	
			
			$cekdata = $this->db->query($sql)->row()->jml;
			
				if($cekdata==1){
					
					$whereUpdate = array(
						'tahun' 			=> $ctahun,
						'kd_apip' 			=> $cinstansi,
						'kd_elemen' 		=> $celemen,
						'id_group' 			=> $cgroup
					);
					$dataUpdate = array(
						'kd_elemen' 		=> $celemen,
						'kd_topik' 			=> 0
						
					);

					$this->db->where($whereUpdate);
					$result= $this->db->update('ms_group_menu_elemen', $dataUpdate);			
				}else{
			
					$result = $this->db->delete('ms_group_menu_elemen', array('tahun' => $ctahun,'kd_apip' => $cinstansi,'kd_elemen' => $celemen,'kd_topik' => $ctopik,'id_group' => $cgroup));
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


		public function simpan_group_profil(){   

			$user_id = $this->session->userdata('user_id');
			$ctgl = date('Y-m-d H:i:s');
			
			$data = array(
						'id_group' 			=> $this->input->post('cgroup'),
						'tahun' 			=> $this->input->post('ctahun'),
						'kd_apip' 			=> $this->input->post('cinstansi')
						
					);
					$data = $this->security->xss_clean($data);
					$result = $this->ManajemenModel->add_group_profil($data);

					
				if($result){
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
					

		} 



		public function simpan_profil(){   

			$user_id = $this->session->userdata('user_id');
			$ctgl = date('Y-m-d H:i:s');
			$cprofil = $this->input->post('cprofil');
			$cgroup  = $this->input->post('cgroup');
			$ctahun  = $this->input->post('ctahun');
			$cinstansi = $this->input->post('cinstansi');
			
			$sql = "SELECT count(*)jml FROM ms_group_menu_profil WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' and id_group='".$cgroup."' and (kd_profil is null or kd_profil=0)";	
			$cekdata = $this->db->query($sql)->row()->jml;
			
			
				if($cekdata==1){
					
					$whereUpdate = array(
						'tahun' 			=> $ctahun,
						'kd_apip' 			=> $cinstansi,
						'id_group' 			=> $cgroup
					);
					$dataUpdate = array(
						'kd_profil' 		=> $cprofil
					);


					$this->db->where($whereUpdate);
					$result= $this->db->update('ms_group_menu_profil', $dataUpdate);			
				}else{		
			
					$data = array(
						'kd_profil' 		=> $this->input->post('cprofil'),
						'id_group' 			=> $this->input->post('cgroup'),
						'tahun' 			=> $this->input->post('ctahun'),
						'kd_apip' 			=> $this->input->post('cinstansi')
						
					
					);
					
					$data = $this->security->xss_clean($data);
					$result = $this->ManajemenModel->add_profil($data);
				}
					
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

	

		public function simpan_elemen(){   

			$user_id = $this->session->userdata('user_id');
			$ctgl = date('Y-m-d H:i:s');

			$celemen 	= $this->input->post('celemen');
			$cgroup	 	= $this->input->post('cgroup');
			$ctahun 	= $this->input->post('ctahun');
			$cinstansi	= $this->input->post('cinstansi');
			
			$sql = "SELECT count(*)jml FROM ms_group_menu_elemen WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' and id_group='".$cgroup."' and (kd_elemen IS NULL or kd_elemen=0)";	
			$cekdata = $this->db->query($sql)->row()->jml;
			
				if($cekdata==1){
					
					$whereUpdate = array(
						'tahun' 			=> $ctahun,
						'kd_apip' 			=> $cinstansi,
						'id_group' 			=> $cgroup
					);
					$dataUpdate = array(
						'kd_elemen' 			=> $celemen
						
					);

					$this->db->where($whereUpdate);
					$result= $this->db->update('ms_group_menu_elemen', $dataUpdate);

				}else{			

					$data = array(
								'kd_elemen' 		=> $this->input->post('celemen'),
								'id_group' 			=> $this->input->post('cgroup'),
								'tahun' 			=> $this->input->post('ctahun'),
								'kd_apip' 			=> $this->input->post('cinstansi')
								
							
							);
							$data = $this->security->xss_clean($data);
							$result = $this->ManajemenModel->add_elemen($data);
				}
					
				if($result){
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
					

		} 


		public function simpan_topik(){   

			$user_id = $this->session->userdata('user_id');
			$ctgl = date('Y-m-d H:i:s');
			
			
			$celemen 	=  $this->input->post('celemen');
			$cgroup 	=  $this->input->post('cgroup');
			$ctahun 	=  $this->input->post('ctahun');
			$cinstansi 	=  $this->input->post('cinstansi');
			$ctopik 	=  $this->input->post('ctopik');
			


			$sql = "SELECT count(*)jml FROM ms_group_menu_elemen WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' and id_group='".$cgroup."' and (kd_topik IS NULL or kd_topik=0)";	
			$cekdata = $this->db->query($sql)->row()->jml;
			
				if($cekdata==1){
					

					$whereUpdate = array(
						'tahun' 			=> $ctahun,
						'kd_apip' 			=> $cinstansi,
						'kd_elemen' 		=> $celemen,
						'id_group' 			=> $cgroup
					);
					$dataUpdate = array(
						'kd_topik' 			=> $ctopik
						
						
					);


					$this->db->where($whereUpdate);
					$result= $this->db->update('ms_group_menu_elemen', $dataUpdate);

				}else{

					
					$data = array(
								'kd_elemen' 		=> $this->input->post('celemen'),
								'id_group' 			=> $this->input->post('cgroup'),
								'tahun' 			=> $this->input->post('ctahun'),
								'kd_apip' 			=> $this->input->post('cinstansi'),
								'kd_topik' 			=> $this->input->post('ctopik')
							
							);
							$data = $this->security->xss_clean($data);
							$result = $this->ManajemenModel->add_topik($data);
	
				}	
						
			if($result){
				$data=1;
			}else{
				$data=0;
			}
				
			echo json_encode($data);
						

		} 



	}
