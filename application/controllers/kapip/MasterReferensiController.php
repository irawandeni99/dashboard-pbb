<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	/**
	 * 
	 */
	class MasterReferensiController extends CI_Controller
	{
		
		public function __construct(){
			parent::__construct();
			date_default_timezone_set('Asia/Jakarta');
			$this->load->model('kapip/ReferensiModel', 'ReferensiModel');
			$this->load->model('PublicModel');
		}

		public function index()
		{
			$data['view'] = 'kapip/master/referensi';
			$this->load->view('template/layout', $data);
		}


		public function tambah_penilaian(){
			$ctahun = $this->input->post('ctahun');			
			$cinstansi = $this->input->post('cinstansi');
			$celemen = $this->input->post('celemen');
			$ctopik = $this->input->post('ctopik');
			$clevel = $this->input->post('clevel');
			
			
			$data = $this->ReferensiModel->viewAddPenilaian($ctahun,$cinstansi,$celemen,$ctopik,$clevel);
			echo $data;
		}


		public function edit_penilaian(){
			$ctahun = $this->input->post('ctahun');			
			$cinstansi = $this->input->post('cinstansi');
			$celemen = $this->input->post('celemen');
			$ctopik = $this->input->post('ctopik');
			$clevel = $this->input->post('clevel');
			$cpenilaian = $this->input->post('cpenilaian');
			
			
			$data = $this->ReferensiModel->viewEditPenilaian($ctahun,$cinstansi,$celemen,$ctopik,$clevel,$cpenilaian);
			echo $data;
		}



		public function get_referensi($ctahun='',$cinstansi=''){

			$data = $this->ReferensiModel->viewReferensi($ctahun,$cinstansi);
			echo $data;
						
		}
		


		public function get_table_simpulan($ctahun='',$cinstansi=''){

			$data = $this->ReferensiModel->dataSimpulan($ctahun,$cinstansi);
			echo $data;
						
		}	

		public function simpan_simpulan1(){ 
				
			$ctahun = $this->input->post('ctahun');	
			$cinstansi = $this->input->post('cinstansi');			
			$celemen = $this->input->post('celemen');			
			$clevel = $this->input->post('clevel');
			$csimpulan = $this->input->post('csimpulan');
			$user_id = $this->session->userdata('user_id');			
			$ctgl = date('Y-m-d H:i:s');
			
			
			$sql = "select count(*)jml from tsimpulan where tahun='".$ctahun."' and kd_apip='".$cinstansi."' and kd_level='".$clevel."'";
			$ceksimpul = $this->db->query($sql)->row()->jml;			
			
			
			if($ceksimpul==0){
				$datainsert = array(
					'tahun' 				=> $ctahun,
					'kd_apip'				=> $cinstansi,
					'kd_level' 				=> $clevel,
					'simpulan' 				=> $csimpulan,
					'user_insert' 			=> $user_id,
					'insert_at' 			=> $ctgl,
					
				);
	
				$data = $this->security->xss_clean($datainsert);
				$result = $this->ReferensiModel->insertSimpulan($data);
			
			}else{
				
				$whereUpdate = array(
					'tahun' 			=> $ctahun,
					'kd_apip' 			=> $cinstansi,
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
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
					

		} 


		public function status_simpulan(){ 
			$akses = $this->session->userdata('is_admin');	
			$ctahun = $this->input->post('ctahun');	
			$cinstansi = $this->input->post('cinstansi');				
			$clevel = $this->input->post('level');
			
				
			$sql = "select simpulan from tsimpulan  where tahun='".$ctahun."' and kd_apip='".$cinstansi."'   and kd_level='".$clevel."'" ;				
			$cek = $this->db->query($sql)->row()->simpulan;
			
			
			if($cek==1){
				if($akses==1){
					$msg='( Final )';
				}else{
					$msg='( Read Only )';
				}
				
			}else{
				$msg='';
				
			}
			
				echo json_encode($msg);
		} 


	

		public function simpan_elemen1(){ 
				
			$ctahun = $this->input->post('ctahun');	
			$cinstansi = $this->input->post('cinstansi');
			$clevel = $this->input->post('clevel');
			$ckdtopik = $this->input->post('ckdtopik');
			$ckdtopik1 = $this->input->post('ckdtopik1');
			$ckdpenilaian = $this->input->post('ckdpenilaian');
			$curaian = $this->input->post('curaian');
			$cjawaban = $this->input->post('cjawaban');
			//$csimpulan = $this->input->post('csimpulan');
			$celemen = 1;
			
			$user_id = $this->session->userdata('user_id');
			
			$ctgl = date('Y-m-d H:i:s');
		

			
			$ckdtopik = explode('#', $ckdtopik);
			$ckdtopik1 = explode('#', $ckdtopik1);
			$ckdpenilaian = explode('#', $ckdpenilaian);
			$curaian = explode('#', $curaian);
			$cjawaban = explode('#', $cjawaban);
			//$csimpulan = explode('#', $csimpulan);
			$ccount = count($ckdtopik);
			//$ccount_simpul = count($csimpulan);

			/* for ($i = 1; $i < $ccount_simpul; $i++) {
				
				$csqlx = "update tlevel set simpulan_pemenuhan='".$csimpulan[$i]."',user_update='".$user_id."',update_at='".$ctgl."' where 
						 tahun='".$ctahun."' and kd_apip='".$cinstansi."' and kd_elemen='".$celemen."' and kd_topik='".$ckdtopik1[$i]."' and kd_level='".$clevel."'" ;				
				$cqueryx = $this->db->query($csqlx);

			} */

		
			for ($i = 1; $i < $ccount; $i++) {
				
				
			$sql = "select ifnull(user_insert,0)cuser from tpenilaian  where tahun='".$ctahun."' and kd_apip='".$cinstansi."' and kd_elemen='".$celemen."' and kd_topik='".$ckdtopik[$i]."' and kd_level='".$clevel."' and kd_penilaian='".$ckdpenilaian[$i]."'" ;				
			$query1 = $this->db->query($sql);
			$data = $query1->row();
			$cek=$data->cuser;
			
				if($cek==0){
					$user = "user_insert";
					$create = "insert_at";
					
				}else{
					
					$user = "user_update";
					$create = "update_at";
				}				

				
				$csql = "update tpenilaian set jawaban='".$cjawaban[$i]."',".$user."='".$user_id."',".$create."='".$ctgl."',uraian_jawaban='".$curaian[$i]."' where 
						 tahun='".$ctahun."' and kd_apip='".$cinstansi."' and kd_elemen='".$celemen."' and kd_topik='".$ckdtopik[$i]."' and kd_level='".$clevel."' and kd_penilaian='".$ckdpenilaian[$i]."'" ;				
				$cquery = $this->db->query($csql);
				
			

			}


				if($cquery1){
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
					

		} 





		public function simpan_file()
		{
			
			$ctahun       		= $_POST['ctahun'];
			$cinstansi      	= $_POST['cinstansi'];
		//	$celemen       		= $_POST['celemen'];
		//	$clevel       		= $_POST['clevel'];
		//	$ctopik       		= $_POST['ctopik'];
		//	$cpenilaian       	= $_POST['cpenilaian'];
			$curaian       		= $_POST['curaian'];
			
			$user_id = $this->session->userdata('user_id');			
			$ctgl = date('Y-m-d H:i:s');
			
			
			$search = array("/", " ", ":", "*", "?", "&#34;", "<", ">",".");
			$searchdok = array("/", " ", ":", "*", "?", "&#34;", "<", ">", "|");
			$replace = array("_", "_", "_", "_", "_", "_", "_", "_", "_");
			
			
			//$filelTemp 			= str_replace($searchdok, $replace, $dokumentasi);
			$ctahun 		= str_replace($search, $replace, $ctahun);
			$cinstansi 		= str_replace($search, $replace, $cinstansi);
			//$celemen 		= str_replace($search, $replace, $celemen);
			//$clevel 		= str_replace($search, $replace, $clevel);
			//$ckdtopik 		= str_replace($search, $replace, $ctopik);
			//$ckdpenilaian 	= str_replace($search, $replace, $cpenilaian);
			
						// $nama_file       = $_POST['nama_file'];
			  $fileupload      = $_FILES['fileupload']['tmp_name'];
			  $ImageName       = $_FILES['fileupload']['name'];
			  $ImageType       = $_FILES['fileupload']['type'];
			  
			  
				$ImageExt       = substr($ImageName, strrpos($ImageName, '.'));
				$ImageExt       = str_replace('.','',$ImageExt); // Extension
				$ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
				$NewImageName   = str_replace(' ', '', $ImageName.'.'.$ImageExt);
				
				$maxref=$this->ReferensiModel->get_maxref($ctahun,$cinstansi);			
				
			
				
				$datainsert = array(
					'tahun' 				=> $ctahun,
					'kd_apip'				=> $cinstansi,
					'kd_file' 				=> $maxref,
					'nm_file' 				=> $NewImageName,
					'user_insert' 			=> $user_id,
					'insert_at' 			=> $ctgl,
					'uraian' 				=> $curaian,
					
				);
	
				$data = $this->security->xss_clean($datainsert);
				$result = $this->ReferensiModel->insertReferensi($data);
				
			

			/* 	
			$csql = "update tpenilaian set pendukung='".$NewImageName."' where 
					 tahun='".$ctahun."' and kd_apip='".$cinstansi."' and kd_elemen='".$celemen."' and kd_topik='".$ctopik."' and kd_level='".$clevel."' and kd_penilaian='".$cpenilaian."'" ;				
			$cquery1 = $this->db->query($csql); */ 

			

				if($result){
					$data=1;
					
				//$cNamaUser = $this->ci->db->get_where('ms_user',array('id_user'=>$user_id))->row();
			

			$sql = "SELECT*FROM ms_group WHERE id_group<>1 order by id_group";
			$query = $this->db->query($sql);
			$data=$query->result();

			foreach($data as $rows){ 
			
				$cidpenerima=$rows->id_group;

				
				$sql = "SELECT *from ms_user where id_user='".$user_id."'";
				$user = $this->db->query($sql)->row();	
				$cketerangan =$curaian;
				
				$cnmuser = '[ '.$user->name.' ]';  
				$curaianx=$cnmuser.' Melakukan Upload Referensi';
				//$curaian = html_escape($curaian);					
				$ctypeuser = $user->is_admin;
				//$curaian=htmlentities($curaian);				
					
				$datainserthistory = array(
					'aksi' 					=> 'UPLOAD',
					'tahun' 				=> $ctahun,
					'kd_apip'				=> $cinstansi,
					'uraian' 				=> $curaianx,
					'user_id' 				=> $user_id,
					'user_type' 			=> $ctypeuser,
					'user_date' 			=> $ctgl,
					'status' 				=> 0,
					'kd_file' 				=> $maxref,
					'routes' 				=> 'kapip-master-referensi',
					'jenis' 				=> 4,
					'tampil' 				=> 1,
					'nilai' 				=> 0,
					'keterangan' 			=> $cketerangan,
					'id_penerima' 			=> $cidpenerima,
					
					
				);
	
				$datahistory = $this->security->xss_clean($datainserthistory);		
				$hresult = $this->ReferensiModel->insertReferensiHistory($datahistory);
				
			}				
					
					
				}else{
					$data=0;
				}					
			echo json_encode($data);
		}



		public function hapus_file()
		{
			$ctahun       		= $_POST['ctahun'];
			$cinstansi      	= $_POST['cinstansi'];
			$cfile       		= $_POST['cfile'];
			$cnmfile       		= $_POST['cnmfile'];
			
			$search = array("/", " ", ":", "*", "?", "&#34;", "<", ">",".");
			$searchdok = array("/", " ", ":", "*", "?", "&#34;", "<", ">", "|");
			$replace = array("_", "_", "_", "_", "_", "_", "_", "_", "_");
			
			
			$ctahun 		= str_replace($search, $replace, $ctahun);
			$cinstansi 		= str_replace($search, $replace, $cinstansi);
			$cfile 			= str_replace($search, $replace, $cfile);
			
		
			$folderReferensi		= 'assets/file_upload/ekapip_dokumen/'.$ctahun.'/'.'Instansi'.$cinstansi.'/'.'Referensi/';
			$linktarget= $folderReferensi.$cnmfile;
		
			
			 if (file_exists($linktarget)) {
	               unlink($linktarget);
	             } 
				 
				 
						
			$result = $this->db->delete('ms_referensi', array('tahun' => $ctahun,'kd_apip' => $cinstansi,'kd_file' => $cfile ));
			if($result){
				$data= "1";
			}else{
				$data="0";
			}	 
				 
			echo json_encode($data);	 

		}


		public function edit_file()
		{
			$ctahun       		= $_POST['ctahun'];
			$cinstansi      	= $_POST['cinstansi'];
			$cfile       		= $_POST['cfile'];
			$cnmfile       		= $_POST['cnmfile'];
			$curaian       		= addslashes($_POST['curaian']);
			
			$search = array("/", " ", ":", "*", "?", "&#34;", "<", ">",".");
			$searchdok = array("/", " ", ":", "*", "?", "&#34;", "<", ">", "|");
			$replace = array("_", "_", "_", "_", "_", "_", "_", "_", "_");
			
			
			$ctahun 		= str_replace($search, $replace, $ctahun);
			$cinstansi 		= str_replace($search, $replace, $cinstansi);
			$cfile 			= str_replace($search, $replace, $cfile);
			
		
			$csql = "update ms_referensi set uraian='".$curaian."' where 
					 tahun='".$ctahun."' and kd_apip='".$cinstansi."' and kd_file = '".$cfile."'" ;				
			$cquery1 = $this->db->query($csql); 

			

				if($cquery1){
					$data=1;
				}else{
					$data=0;
				}					
			echo json_encode($data);;	 

		}



	}
