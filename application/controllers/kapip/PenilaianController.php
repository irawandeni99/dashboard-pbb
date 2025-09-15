<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	/**
	 * 
	 */
	class PenilaianController extends CI_Controller
	{
		
		public function __construct(){
			parent::__construct();
			date_default_timezone_set('Asia/Jakarta');
			$this->load->model('kapip/PenilaianModel', 'PenilaianModel');
			$this->load->model('PublicModel');
		}

		public function data_penilaian()
		{
			$data['view'] = 'kapip/penilaian/Penilaian';
			$this->load->view('template/layout', $data);
		}


		public function get() {
			
			$is_admin = $this->session->userdata('is_admin');


			$list = $this->PenilaianModel->get_all_apip($daerah);

	        $data = array();
	        $no = $_POST['start'];

	        foreach ($list as $field) {
	        	
				$ckode=$field->kd_apip;
				$ctahun=$field->tahun; 
				$link=base_url('kapip-penilaian/elemen/'.$ctahun.'/'.$ckode);
			   
	            $no++;
	            $row = array();
	            if($ins != $field->kd_apip){
	            	$row[] = $no;
	            }else{
	            	$no--;
	            	$row[] = "";
	            }
				
				$ins = $field->kd_apip;

	            if($instansi != $field->nm_apip){
					
				
	            	$row[] = $field->nm_apip;
	            }else{
	            	$row[] = "";
	            }
				
				
				
				if($tahun != $field->tahun){
	            	$row[] = $field->tahun;
	            }else{
	            	$row[] = "";
	            }	
			
	            $row[] = '
					<a href="'.$link.'" class="btn btn-info btn-flat btn-xs edit" data-thn="'.$field->tahun.'" data-nama="'.$field->nama.'"><i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="tooltip" title="Detail"></i></a>
	            	</td>    	
		 	    	<script>$(document).ready(function() {$("[data-toggle=\'tooltip\']").tooltip(); });</script>
		 	    	';

	            $data[] = $row;
								
	        }
	 
	 
	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->PenilaianModel->count_all_apip($daerah),
	            "recordsFiltered" => $this->PenilaianModel->count_filtered_apip($daerah),
	            "data" => $data,
	        );
			
			
			
	        echo json_encode($output);
		}
		

		public function add(){
			$data['apip'] 			= $this->PenilaianModel->getApip();
			$data['instansi'] 		= $this->PenilaianModel->getInstansi();
			//$data['audit'] 			= $this->db->get('ms_jenis_audit')->result_array();
			$data['view'] 			= 'kapip/master/addPenilaianView';
			$this->load->view('template/layout', $data);
		}


		public function map1($cthn='',$ckode='',$ctriw=''){
			
			$data['apip'] 			= $this->PenilaianModel->getApip();
			$data['instansi'] 		= $this->PenilaianModel->getInstansi();
			
			//$data['view'] 			= 'kapip/profil/addMaView';
			$data = $this->PenilaianModel->viewMap1($cthn,$ckode,$ctriw);
			echo $data;
		}


		public function elemen(){
			$cthn = $this->session->userdata('year_selected');
			$ckode = $this->session->userdata('id_instansi');
			
			$nmapip	 				= $this->PublicModel->get_nama($ckode,'nm_apip','ms_apip','kd_apip');		
			$data['kode'] 			= $ckode;
			$data['instansi'] 		= $nmapip;
			$data['tahun'] 			= $cthn;
			$data['elemen'] 		= $this->PenilaianModel->FilterElemen($cthn,$ckode);
			$data['view'] 			= 'kapip/penilaian/addPenilaianView';
			$this->load->view('template/layout', $data);
		}


		public function edit_topik($cthn='',$cinst='',$celemen='',$ctopik=''){
			$data = $this->PenilaianModel->viewEditTopik($cthn,$cinst,$celemen,$ctopik);
			echo $data;
		}


		public function tambah_topik($cthn='',$cinst='',$celemen=''){
			$data = $this->PenilaianModel->viewAddTopik($cthn,$cinst,$celemen);
			echo $data;
		}


		public function tambah_level($cthn='',$cinst='',$celemen='',$ctopik=''){
			$data = $this->PenilaianModel->viewAddLevel($cthn,$cinst,$celemen,$ctopik);
			echo $data;
		}


		public function tambah_penilaian(){
			$ctahun = $this->input->post('ctahun');			
			$cinstansi = $this->input->post('cinstansi');
			$celemen = $this->input->post('celemen');
			$ctopik = $this->input->post('ctopik');
			$clevel = $this->input->post('clevel');
			
			
			$data = $this->PenilaianModel->viewAddPenilaian($ctahun,$cinstansi,$celemen,$ctopik,$clevel);
			echo $data;
		}


		public function edit_penilaian(){
			$ctahun = $this->input->post('ctahun');			
			$cinstansi = $this->input->post('cinstansi');
			$celemen = $this->input->post('celemen');
			$ctopik = $this->input->post('ctopik');
			$clevel = $this->input->post('clevel');
			$cpenilaian = $this->input->post('cpenilaian');
			
			
			$data = $this->PenilaianModel->viewEditPenilaian($ctahun,$cinstansi,$celemen,$ctopik,$clevel,$cpenilaian);
			echo $data;
		}


		public function cek_topik($cthn='',$cinst='',$celemen=''){
			$data = $this->PenilaianModel->cekTopik($cthn,$cinst,$celemen);
			echo $data;
			
			
		}

		public function list_level($cthn='',$cinst='',$celemen='',$ctopik=''){
			$data = $this->PenilaianModel->listLevel($cthn,$cinst,$celemen,$ctopik);
			echo $data;
			
			
		}


		public function get_elemen($cthn='',$ckode=''){

			$data = $this->PenilaianModel->viewElemen($cthn,$ckode);
			echo $data;
						
		}


		public function get_pengawasan($cthn='',$ckode=''){

			$data = $this->PenilaianModel->viewPengawasan($cthn,$ckode);
			echo $data;
						
		}


		public function get_elemen1($ctahun='',$cinstansi='',$clevel=''){

			$data = $this->PenilaianModel->viewElemen1($ctahun,$cinstansi,$clevel);
			echo $data;
						
		}
		

		public function get_elemen2($ctahun='',$cinstansi='',$clevel=''){

			$data = $this->PenilaianModel->viewElemen2($ctahun,$cinstansi,$clevel);
			echo $data;
						
		}

		public function get_elemen3($ctahun='',$cinstansi='',$clevel=''){

			$data = $this->PenilaianModel->viewElemen3($ctahun,$cinstansi,$clevel);
			echo $data;
						
		}

		public function get_elemen4($ctahun='',$cinstansi='',$clevel=''){

			$data = $this->PenilaianModel->viewElemen4($ctahun,$cinstansi,$clevel);
			echo $data;
						
		}

		public function get_elemen5($ctahun='',$cinstansi='',$clevel=''){

			$data = $this->PenilaianModel->viewElemen5($ctahun,$cinstansi,$clevel);
			echo $data;
						
		}

		public function get_elemen6($ctahun='',$cinstansi='',$clevel=''){

			$data = $this->PenilaianModel->viewElemen6($ctahun,$cinstansi,$clevel);
			echo $data;
						
		}		
		

		public function get_simpulan1($ctahun='',$cinstansi='',$clevel=''){

			$data = $this->PenilaianModel->viewSimpulan1($ctahun,$cinstansi,$clevel);
			echo $data;
						
		}		

		public function get_table_simpulan($ctahun='',$cinstansi=''){

			$data = $this->PenilaianModel->dataSimpulan($ctahun,$cinstansi);
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
				$result = $this->PenilaianModel->insertSimpulan($data);
			
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



		public function simpan_elemen2(){ 
				
			$ctahun = $this->input->post('ctahun');	
			$cinstansi = $this->input->post('cinstansi');
			$clevel = $this->input->post('clevel');
			$ckdtopik = $this->input->post('ckdtopik');
			$ckdtopik1 = $this->input->post('ckdtopik1');
			$ckdpenilaian = $this->input->post('ckdpenilaian');
			$curaian = $this->input->post('curaian');
			$cjawaban = $this->input->post('cjawaban');
			//$csimpulan = $this->input->post('csimpulan');
			$celemen = 2;
			
			$user_id = $this->session->userdata('user_id');
			
			$ctgl = date('Y-m-d H:i:s');
		

			
			$ckdtopik = explode('#', $ckdtopik);
			$ckdtopik1 = explode('#', $ckdtopik1);
			$ckdpenilaian = explode('#', $ckdpenilaian);
			$curaian = explode('#', $curaian);
			$cjawaban = explode('#', $cjawaban);
		//	$csimpulan = explode('#', $csimpulan);
			$ccount = count($ckdtopik);
		//	$ccount_simpul = count($csimpulan);
/* 
			for ($i = 1; $i < $ccount_simpul; $i++) {
				
				$csqlx = "update tlevel set simpulan_pemenuhan='".$csimpulan[$i]."',user_update='".$user_id."',update_at='".$ctgl."' where 
						 tahun='".$ctahun."' and kd_apip='".$cinstansi."' and kd_elemen='".$celemen."' and kd_topik='".$ckdtopik1[$i]."' and kd_level='".$clevel."'" ;				
				$cqueryx = $this->db->query($csqlx);

			}
 */
		
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
				$cquery1 = $this->db->query($csql);

			}


				if($cquery1){
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
					

		} 


		public function simpan_elemen3(){ 
				
			$ctahun = $this->input->post('ctahun');	
			$cinstansi = $this->input->post('cinstansi');
			$clevel = $this->input->post('clevel');
			$ckdtopik = $this->input->post('ckdtopik');
			$ckdtopik1 = $this->input->post('ckdtopik1');
			$ckdpenilaian = $this->input->post('ckdpenilaian');
			$curaian = $this->input->post('curaian');
			$cjawaban = $this->input->post('cjawaban');
		//	$csimpulan = $this->input->post('csimpulan');
			$celemen = 3;
			
			$user_id = $this->session->userdata('user_id');
			
			$ctgl = date('Y-m-d H:i:s');
		

			
			$ckdtopik = explode('#', $ckdtopik);
			$ckdtopik1 = explode('#', $ckdtopik1);
			$ckdpenilaian = explode('#', $ckdpenilaian);
			$curaian = explode('#', $curaian);
			$cjawaban = explode('#', $cjawaban);
		//	$csimpulan = explode('#', $csimpulan);
			$ccount = count($ckdtopik);
		//	$ccount_simpul = count($csimpulan);

			/* for ($i = 1; $i < $ccount_simpul; $i++) {
				
				$csqlx = "update tlevel set simpulan_pemenuhan='".$csimpulan[$i]."',user_update='".$user_id."',update_at='".$ctgl."' where 
						 tahun='".$ctahun."' and kd_apip='".$cinstansi."' and kd_elemen='".$celemen."' and kd_topik='".$ckdtopik1[$i]."' and kd_level='".$clevel."'" ;				
				$cqueryx = $this->db->query($csqlx);

			}
 */
		
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
				$cquery1 = $this->db->query($csql);

			}


				if($cquery1){
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
					

		} 



		public function simpan_elemen4(){ 
				
			$ctahun = $this->input->post('ctahun');	
			$cinstansi = $this->input->post('cinstansi');
			$clevel = $this->input->post('clevel');
			$ckdtopik = $this->input->post('ckdtopik');
			$ckdtopik1 = $this->input->post('ckdtopik1');
			$ckdpenilaian = $this->input->post('ckdpenilaian');
			$curaian = $this->input->post('curaian');
			$cjawaban = $this->input->post('cjawaban');
		//	$csimpulan = $this->input->post('csimpulan');
			$celemen = 4;
			
			$user_id = $this->session->userdata('user_id');
			
			$ctgl = date('Y-m-d H:i:s');
		

			
			$ckdtopik = explode('#', $ckdtopik);
			$ckdtopik1 = explode('#', $ckdtopik1);
			$ckdpenilaian = explode('#', $ckdpenilaian);
			$curaian = explode('#', $curaian);
			$cjawaban = explode('#', $cjawaban);
		//	$csimpulan = explode('#', $csimpulan);
			$ccount = count($ckdtopik);
		//	$ccount_simpul = count($csimpulan);

		/* 	for ($i = 1; $i < $ccount_simpul; $i++) {
				
				$csqlx = "update tlevel set simpulan_pemenuhan='".$csimpulan[$i]."',user_update='".$user_id."',update_at='".$ctgl."' where 
						 tahun='".$ctahun."' and kd_apip='".$cinstansi."' and kd_elemen='".$celemen."' and kd_topik='".$ckdtopik1[$i]."' and kd_level='".$clevel."'" ;				
				$cqueryx = $this->db->query($csqlx);

			}
 */
		
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
				$cquery1 = $this->db->query($csql);

			}


				if($cquery1){
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
					

		} 



		public function simpan_elemen5(){ 
				
			$ctahun = $this->input->post('ctahun');	
			$cinstansi = $this->input->post('cinstansi');
			$clevel = $this->input->post('clevel');
			$ckdtopik = $this->input->post('ckdtopik');
			$ckdtopik1 = $this->input->post('ckdtopik1');
			$ckdpenilaian = $this->input->post('ckdpenilaian');
			$curaian = $this->input->post('curaian');
			$cjawaban = $this->input->post('cjawaban');
		//	$csimpulan = $this->input->post('csimpulan');
			$celemen = 5;
			
			$user_id = $this->session->userdata('user_id');
			
			$ctgl = date('Y-m-d H:i:s');
		

			
			$ckdtopik = explode('#', $ckdtopik);
			$ckdtopik1 = explode('#', $ckdtopik1);
			$ckdpenilaian = explode('#', $ckdpenilaian);
			$curaian = explode('#', $curaian);
			$cjawaban = explode('#', $cjawaban);
		//	$csimpulan = explode('#', $csimpulan);
			$ccount = count($ckdtopik);
		//	$ccount_simpul = count($csimpulan);

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
				$cquery1 = $this->db->query($csql);

			}

				if($cquery1){
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
		} 



		public function simpan_elemen6(){ 
				
			$ctahun = $this->input->post('ctahun');	
			$cinstansi = $this->input->post('cinstansi');
			$clevel = $this->input->post('clevel');
			$ckdtopik = $this->input->post('ckdtopik');
			$ckdtopik1 = $this->input->post('ckdtopik1');
			$ckdpenilaian = $this->input->post('ckdpenilaian');
			$curaian = $this->input->post('curaian');
			$cjawaban = $this->input->post('cjawaban');
		//	$csimpulan = $this->input->post('csimpulan');
			$celemen = 6;
			
			$user_id = $this->session->userdata('user_id');
			
			$ctgl = date('Y-m-d H:i:s');
		

			
			$ckdtopik = explode('#', $ckdtopik);
			$ckdtopik1 = explode('#', $ckdtopik1);
			$ckdpenilaian = explode('#', $ckdpenilaian);
			$curaian = explode('#', $curaian);
			$cjawaban = explode('#', $cjawaban);
		//	$csimpulan = explode('#', $csimpulan);
			$ccount = count($ckdtopik);
		//	$ccount_simpul = count($csimpulan);

		/* 	for ($i = 1; $i < $ccount_simpul; $i++) {
				
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
				$cquery1 = $this->db->query($csql);

			}


				if($cquery1){
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
					

		} 


		public function simpan_verif()
		{

			$ctahun       		= $_POST['ctahun'];
			$cinstansi      	= $_POST['cinstansi'];
			$celemen       		= $_POST['celemen'];
			$clevel       		= $_POST['clevel'];
			$ctopik       		= $_POST['ctopik'];
			$cpenilaian       	= $_POST['cpenilaian'];
			$cverifikasi       	= $_POST['cverifikasi'];
			$catatan	       	= $_POST['catatan'];
			
			$user_id 			= $this->session->userdata('user_id');			
			$ctgl 				= date('Y-m-d H:i:s');
			
			$sql = "SELECT *from ms_user where id_user='".$user_id."'";
			$user = $this->db->query($sql)->row();	
			
			$cnmuser = '[ '.$user->name.' ]';
				
				
			$csql = "SELECT a.tahun,a.kd_apip,a.kd_elemen,(SELECT nm_elemen FROM ms_elemen WHERE kd_elemen=a.kd_elemen)nm_elemen,a.kd_topik,
					(SELECT nm_topik FROM ttopik WHERE tahun=a.tahun AND kd_topik=a.kd_topik AND kd_elemen=a.kd_elemen AND kd_topik=a.kd_topik)nm_topik,
					a.kd_level,a.kd_penilaian,a.uraian nm_penilaian,
					(SELECT id_group FROM ms_group_menu_elemen WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' AND kd_topik='".$ctopik."' and id_group<>1 limit 1)id_penerima FROM tpenilaian a
					where a.tahun='".$ctahun."' and a.kd_apip='".$cinstansi."' and a.kd_elemen='".$celemen."' and a.kd_topik='".$ctopik."' and a.kd_level='".$clevel."' and a.kd_penilaian='".$cpenilaian."'";
			
			$cverif = $this->db->query($csql)->row();

			$cnmelemen=$cverif->nm_elemen;
			$cnmtopik=$cverif->nm_topik;
			$cnmpenilaian=$cverif->uraian;
			$cpenerima=$cverif->id_penerima;
				
				
				$ctypeuser = $user->is_admin;					

					if($cverifikasi==1){
						
						$curaian =$cnmuser.' Melakukan Verifikasi TIDAK SESUAI';
						$cnilai=0;
						
						$datainserthistory = array(
							'aksi' 					=> 'VERIFIKASI',
							'tahun' 				=> $ctahun,
							'kd_apip'				=> $cinstansi,
							'kd_elemen'				=> $celemen,
							'kd_topik'				=> $ctopik,
							'kd_level'				=> $clevel,
							'kd_penilaian'			=> $cpenilaian,
							'uraian' 				=> $curaian,
							'user_id' 				=> $user_id,
							'user_type' 			=> $ctypeuser,
							'user_date' 			=> $ctgl,
							'status' 				=> 0,
							'routes' 				=> 'kapip-penilaian/elemen',
							'jenis' 				=> 3, 
							'tampil' 				=> 1,
							'nilai'					=> $cnilai,
							'id_penerima'			=> $cpenerima,
							
						);
						
						$csql = "SELECT COUNT(*)jml FROM tpenilaian WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' 
								AND kd_topik='".$ctopik."' AND kd_level='".$clevel."' and kd_penilaian='".$cpenilaian."' AND verifikasi=1";
						$cekverif = $this->db->query($csql)->row()->jml; 
						
						if($cekverif==0){
							
							$hsql = "UPDATE thistory SET tampil=0 WHERE tahun='".$ctahun."' and kd_apip='".$cinstansi."' and kd_elemen='".$celemen."' and kd_topik='".$ctopik."' and kd_level='".$clevel."' and kd_penilaian='".$cpenilaian."'";		
							$cquery = $this->db->query($hsql); 
							
							$datahistory = $this->security->xss_clean($datainserthistory);		
							$hresult = $this->PenilaianModel->insertHistory($datahistory);						
							
							
							if($hresult){
								$csql = "update tpenilaian set verifikasi='".$cverifikasi."',user_verif='".$user_id."',verif_at='".$ctgl."',catatan='".$catatan."' where 
								 tahun='".$ctahun."' and kd_apip='".$cinstansi."' and kd_elemen='".$celemen."' and kd_topik='".$ctopik."' and kd_level='".$clevel."' and kd_penilaian='".$cpenilaian."'" ;				
								$cquery1 = $this->db->query($csql);
								
							}
							
							
						}	
						
						
						 
						

					}else{
						$curaian =$cnmuser.' Melakukan Verifikasi SESUAI';
						$cnilai=1;
						
						$datainserthistoryx = array(
							'aksi' 					=> 'VERIFIKASI',
							'tahun' 				=> $ctahun,
							'kd_apip'				=> $cinstansi,
							'kd_elemen'				=> $celemen,
							'kd_topik'				=> $ctopik,
							'kd_level'				=> $clevel,
							'kd_penilaian'			=> $cpenilaian,
							'uraian' 				=> $curaian,
							'user_id' 				=> $user_id,
							'user_type' 			=> $ctypeuser,
							'user_date' 			=> $ctgl,
							'status' 				=> 0,
							'routes' 				=> 'kapip-penilaian/elemen',
							'jenis' 				=> 3, 
							'tampil' 				=> 1,
							'nilai'					=> $cnilai,
							'id_penerima'			=> $cpenerima,
							
						);
				
					
						$csql = "SELECT COUNT(*)jml FROM tpenilaian WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' 
								AND kd_topik='".$ctopik."' AND kd_level='".$clevel."' and kd_penilaian='".$cpenilaian."' AND verifikasi=2";
						$cekverif = $this->db->query($csql)->row()->jml; 
					
						
						if($cekverif ==0){
							
							$hsql = "UPDATE thistory SET tampil=0 WHERE tahun='".$ctahun."' and kd_apip='".$cinstansi."' and kd_elemen='".$celemen."' and kd_topik='".$ctopik."' and kd_level='".$clevel."' and kd_penilaian='".$cpenilaian."'";		
							$cquery = $this->db->query($hsql); 
							
							$datahistoryx = $this->security->xss_clean($datainserthistoryx);		
							$hresult = $this->PenilaianModel->insertHistory($datahistoryx);						
							
							if($hresult){
									 $csql = "update tpenilaian set verifikasi='".$cverifikasi."',user_verif='".$user_id."',verif_at='".$ctgl."',catatan='".$catatan."' where 
									 tahun='".$ctahun."' and kd_apip='".$cinstansi."' and kd_elemen='".$celemen."' and kd_topik='".$ctopik."' and kd_level='".$clevel."' and kd_penilaian='".$cpenilaian."'" ;				
								$cquery1 = $this->db->query($csql);
								
							}
							
							
						}	
						
					
					
					}
				
				if($cquery1){
					$data=1;
				}else{
					$data=0;
				}
								
			echo json_encode($cekverif);
		}



		public function simpan_file()
		{
			
			// var formData = new FormData();
			$ctahun       		= $_POST['ctahun'];
			$cinstansi      	= $_POST['cinstansi'];
			$celemen       		= $_POST['celemen'];
			$clevel       		= $_POST['clevel'];
			$ctopik       		= $_POST['ctopik'];
			$cpenilaian       	= $_POST['cpenilaian'];
			$curaian       		= $_POST['curaian'];
			
			$user_id = $this->session->userdata('user_id');			
			$ctgl = date('Y-m-d H:i:s');
			
			
			$search = array("/", " ", ":", "*", "?", "&#34;", "<", ">",".");
			$searchdok = array("/", " ", ":", "*", "?", "&#34;", "<", ">", "|");
			$replace = array("_", "_", "_", "_", "_", "_", "_", "_", "_");
			
			
			//$filelTemp 			= str_replace($searchdok, $replace, $dokumentasi);
			$ctahun 		= str_replace($search, $replace, $ctahun);
			$cinstansi 		= str_replace($search, $replace, $cinstansi);
			$celemen 		= str_replace($search, $replace, $celemen);
			$clevel 		= str_replace($search, $replace, $clevel);
			$ckdtopik 		= str_replace($search, $replace, $ctopik);
			$ckdpenilaian 	= str_replace($search, $replace, $cpenilaian);

			
			// $nama_file       = $_POST['nama_file'];
			  $fileupload      = $_FILES['fileupload']['tmp_name'];
			  $ImageName       = $_FILES['fileupload']['name'];
			  $ImageType       = $_FILES['fileupload']['type'];
			  
			  
				$ImageExt       = substr($ImageName, strrpos($ImageName, '.'));
				$ImageExt       = str_replace('.','',$ImageExt); // Extension
				$ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
				$NewImageName   = str_replace(' ', '', $ImageName.'.'.$ImageExt);
				
				$maxlamp=$this->PenilaianModel->get_maxlamp($ctahun,$cinstansi,$celemen,$clevel,$ckdtopik,$ckdpenilaian);			
				$datainsert = array(
					'tahun' 				=> $ctahun,
					'kd_apip'				=> $cinstansi,
					'kd_elemen'				=> $celemen,
					'kd_topik' 				=> $ckdtopik,
					'kd_level' 				=> $clevel,
					'kd_penilaian' 			=> $ckdpenilaian,
					'kd_file' 				=> $maxlamp,
					'nm_file' 				=> $NewImageName,
					'user_insert' 			=> $user_id,
					'insert_at' 			=> $ctgl,
					'uraian' 				=> $curaian,
				);
	
				$data = $this->security->xss_clean($datainsert);
				$result = $this->PenilaianModel->insertLampiran($data);
				

			/* 	
			$csql = "update tpenilaian set pendukung='".$NewImageName."' where 
					 tahun='".$ctahun."' and kd_apip='".$cinstansi."' and kd_elemen='".$celemen."' and kd_topik='".$ctopik."' and kd_level='".$clevel."' and kd_penilaian='".$cpenilaian."'" ;				
			$cquery1 = $this->db->query($csql); */ 

			

				if($result){
					$data=1;
				}else{
					$data=0;
				}					
			echo json_encode($data);
		}


		public function edit_file()
		{
			
			$ctahun       		= $_POST['ctahun'];
			$cinstansi      	= $_POST['cinstansi'];
			$celemen       		= $_POST['celemen'];
			$clevel       		= $_POST['clevel'];
			$ctopik       		= $_POST['ctopik'];
			$cpenilaian       	= $_POST['cpenilaian'];
			$cfile       		= $_POST['cfile'];
			$cnmfile       		= $_POST['cnmfile'];
			$curaian       		= addslashes($_POST['curaian']);


			$search = array("/", " ", ":", "*", "?", "&#34;", "<", ">",".");
			$searchdok = array("/", " ", ":", "*", "?", "&#34;", "<", ">", "|");
			$replace = array("_", "_", "_", "_", "_", "_", "_", "_", "_");
			
			$ctahun 		= str_replace($search, $replace, $ctahun);
			$cinstansi 		= str_replace($search, $replace, $cinstansi);
			$celemen 		= str_replace($search, $replace, $celemen);
			$clevel 		= str_replace($search, $replace, $clevel);
			$ctopik 		= str_replace($search, $replace, $ctopik);
			$cpenilaian 	= str_replace($search, $replace, $cpenilaian);
			$cfile 			= str_replace($search, $replace, $cfile);
			$cnmfile 		= str_replace($search, $replace, $cnmfile);
			


				
			$csql = "update tpenilaian_lamp set uraian='".$curaian."' where 
					 tahun='".$ctahun."' and kd_apip='".$cinstansi."' and kd_elemen='".$celemen."' and kd_topik='".$ctopik."' 
					 and kd_level='".$clevel."' and kd_penilaian='".$cpenilaian."' and kd_file = '".$cfile."'" ;				
			$cquery1 = $this->db->query($csql); 

			

				if($cquery1){
					$data=1;
				}else{
					$data=0;
				}					
			echo json_encode($data);

		}


		public function hapus_file()
		{
			$ctahun       		= $_POST['ctahun'];
			$cinstansi      	= $_POST['cinstansi'];
			$celemen       		= $_POST['celemen'];
			$clevel       		= $_POST['clevel'];
			$ctopik       		= $_POST['ctopik'];
			$cpenilaian       	= $_POST['cpenilaian'];
			$cfile       		= $_POST['cfile'];
			$cnmfile       		= $_POST['cnmfile'];
			
			$search = array("/", " ", ":", "*", "?", "&#34;", "<", ">",".");
			$searchdok = array("/", " ", ":", "*", "?", "&#34;", "<", ">", "|");
			$replace = array("_", "_", "_", "_", "_", "_", "_", "_", "_");
			
			
			$ctahun 		= str_replace($search, $replace, $ctahun);
			$cinstansi 		= str_replace($search, $replace, $cinstansi);
			$celemen 		= str_replace($search, $replace, $celemen);
			$clevel 		= str_replace($search, $replace, $clevel);
			$ckdtopik 		= str_replace($search, $replace, $ctopik);
			$ckdpenilaian 	= str_replace($search, $replace, $cpenilaian);
			$cfile 			= str_replace($search, $replace, $cfile);
			
		
			$folderPenilaian		= 'assets/file_upload/ekapip_dokumen/'.$ctahun.'/'.'Instansi'.$cinstansi.'/'.'Elemen'.$celemen.'/'.'Level'.$clevel.'/'.'Topik'.$ckdtopik.'/'.'Penilaian'.$ckdpenilaian.'/';
			$linktarget= $folderPenilaian.$cnmfile;
		
			
			 if (file_exists($linktarget)) {
	               unlink($linktarget);
	             } 
				 
				 
						
			$result = $this->db->delete('tpenilaian_lamp', array('tahun' => $ctahun,'kd_apip' => $cinstansi,'kd_elemen' => $celemen,'kd_topik' => $ctopik,'kd_level' => $clevel,'kd_penilaian' => $cpenilaian,'kd_file' => $cfile ));
			if($result){
				$data= "1";
			}else{
				$data="0";
			}	 
				 
			echo json_encode($data);	 

		}

	}
