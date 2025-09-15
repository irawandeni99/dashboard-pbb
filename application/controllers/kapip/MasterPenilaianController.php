<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	/**
	 * 
	 */
	class MasterPenilaianController extends CI_Controller
	{
		
		public function __construct(){
			parent::__construct();
			date_default_timezone_set('Asia/Jakarta');
			$this->load->model('kapip/MasterPenilaianModel', 'PenilaianModel');
			$this->load->model('PublicModel');
		}

		public function data_master_penilaian()
		{
			$data['view'] = 'kapip/master/Penilaian';
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
				$link=base_url('kapip-master-penilaian/elemen/'.$ctahun.'/'.$ckode);
			   
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
			$data['view'] 			= 'kapip/master/addPenilaianView';
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


		public function simpan_topik(){  

			$ctahun = $this->input->post('ctahun');			
			$cinstansi = $this->input->post('cinstansi');
			$celemen = $this->input->post('celemen');

			$user_id = $this->session->userdata('user_id');
			$ctgl = date('Y-m-d H:i:s');
			
			
			$sql = "select (ifnull(max(kd_topik),0)+1)cnext from ttopik  where tahun='".$ctahun."' and kd_apip='".$cinstansi."' and kd_elemen='".$celemen."'" ;				
			$query1 = $this->db->query($sql);
			$data = $query1->row();
			$cnext_topik=$data->cnext;			
			
			
			
			$data = array(
						'kd_elemen' 		=> $this->input->post('celemen'),
						'kd_topik' 			=> $cnext_topik,
						'nm_topik' 			=> $this->input->post('cnm_topik'),
						'urut' 				=> $this->input->post('curut_topik'),
						'tahun' 			=> $this->input->post('ctahun'),
						'kd_apip' 			=> $this->input->post('cinstansi'),
						'keterangan' 			=> $this->input->post('cket_topik')
						
					);
					$data = $this->security->xss_clean($data);
					$result = $this->PenilaianModel->add_topik($data);

					
				if($result){
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
					

		} 


		public function simpan_penilaian(){  

			$ctahun 	 = $this->input->post('ctahun');			
			$cinstansi 	 = $this->input->post('cinstansi');
			$celemen 	 = $this->input->post('celemen');
			$ctopik		 = $this->input->post('ctopik');
			$clevel 	 = $this->input->post('clevel');

			$user_id = $this->session->userdata('user_id');
			$ctgl = date('Y-m-d H:i:s');
			
			
			$sql = "select (ifnull(max(kd_penilaian),0)+1)cnext from tpenilaian  where tahun='".$ctahun."' and kd_apip='".$cinstansi."' and kd_elemen='".$celemen."' 
					and kd_topik='".$ctopik."' and kd_level='".$clevel."'" ;				
			$query1 = $this->db->query($sql);
			$data = $query1->row();
			$cnext=$data->cnext;			
			
			
			
			$data = array(
						'tahun' 			=> $ctahun,
						'kd_apip' 			=> $cinstansi,
						'kd_elemen' 		=> $celemen,
						'kd_topik' 			=> $ctopik,
						'kd_level' 			=> $clevel,
						'kd_penilaian' 		=> $cnext,
						'uraian' 			=> $this->input->post('curaian'),
						'penjelasan' 		=> $this->input->post('cpenjelasan'),
						'bukti' 			=> $this->input->post('cbukti'),
						'hpoin' 			=> $this->input->post('chpoin'),
						'dpoin' 			=> $this->input->post('cdpoin')
	
	
						
					);
					$data = $this->security->xss_clean($data);
					$result = $this->PenilaianModel->add_penilaian($data);

					
				if($result){
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
					

		} 

		public function update_penilaian(){  

			$ctahun 		= $this->input->post('ctahun');			
			$cinstansi 	 	= $this->input->post('cinstansi');
			$celemen 	 	= $this->input->post('celemen');
			$ctopik		 	= $this->input->post('ctopik');
			$clevel 	 	= $this->input->post('clevel');
			$cpenilaian 	= $this->input->post('cpenilaian');
			
			$user_id = $this->session->userdata('user_id');
			$ctgl = date('Y-m-d H:i:s');
			
			$whereUpdate = array(
				'tahun' 			=> $ctahun,
				'kd_apip' 			=> $cinstansi,
				'kd_elemen' 		=> $celemen,
				'kd_topik' 			=> $ctopik,
				'kd_level' 			=> $clevel,
				'kd_penilaian' 		=> $cpenilaian,
			);
			$dataUpdate = array(
				'uraian' 			=> $this->input->post('curaian'),
				'penjelasan' 		=> $this->input->post('cpenjelasan'),
				'bukti' 			=> $this->input->post('cbukti'),
				'hpoin' 			=> $this->input->post('chpoin'),
				'dpoin' 			=> $this->input->post('cdpoin'),
				
				
			);


			$this->db->where($whereUpdate);
			$result= $this->db->update('tpenilaian', $dataUpdate);
					
				if($result){
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
					

		} 


		public function hapus_topik(){  
			
			$ctahun = $this->input->post('ctahun');			
			$cinstansi = $this->input->post('cinstansi');
			$celemen = $this->input->post('celemen');
			$ctopik = $this->input->post('ctopik');
			
			
			$sql = "SELECT count(*)jml FROM tlevel WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' and kd_topik='".$ctopik."'";	
			$cekdata = $this->db->query($sql)->row()->jml;
			
			
			if($cekdata>=1){
					$message = "2";
			}else{
			
				$result = $this->db->delete('ttopik', array('tahun' => $ctahun,'kd_apip' => $cinstansi,'kd_elemen' => $celemen,'kd_topik' => $ctopik));
				if($result){

					$message = "1";
				}else{
					
					$message = "0";
				}
			}
		    echo json_encode($message);

		}


		public function hapus_level(){
			
			$ctahun = $this->input->post('ctahun');			
			$cinstansi = $this->input->post('cinstansi');
			$celemen = $this->input->post('celemen');
			$ctopik = $this->input->post('ctopik');
			$clevel = $this->input->post('clevel');
			
			$sql = "SELECT count(*)jml FROM tpenilaian WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' and kd_topik='".$ctopik."' and kd_level='".$clevel."'";	
			$cekdata = $this->db->query($sql)->row()->jml;
			
			
			if($cekdata>=1){
					$message = "2";
			}else{
			
				$result = $this->db->delete('tlevel', array('tahun' => $ctahun,'kd_apip' => $cinstansi,'kd_elemen' => $celemen,'kd_topik' => $ctopik,'kd_level' => $clevel));
				if($result){

					$message = "1";
				}else{
					
					$message = "0";
				}
			}

		    echo json_encode($message);

		}

		public function hapus_penilaian(){
			
			$ctahun = $this->input->post('ctahun');			
			$cinstansi = $this->input->post('cinstansi');
			$celemen = $this->input->post('celemen');
			$ctopik = $this->input->post('ctopik');
			$clevel = $this->input->post('clevel');
			$cpenilaian = $this->input->post('cpenilaian');
			
			$result = $this->db->delete('tpenilaian', array('tahun' => $ctahun,'kd_apip' => $cinstansi,'kd_elemen' => $celemen,'kd_topik' => $ctopik,'kd_level' => $clevel ,'kd_penilaian' => $cpenilaian));
			if($result){

				$message = "1";
			}else{
				
				$message = "0";
			}

		    echo json_encode($message);

		}


		public function update_topik(){ 

			$ctahun 	= $this->input->post('ctahun');			
			$cinstansi 	= $this->input->post('cinstansi');
			$celemen	= $this->input->post('celemen');
			$ctopik 	= $this->input->post('ctopik');

			$user_id = $this->session->userdata('user_id');
			$ctgl = date('Y-m-d H:i:s');
			


		
			$whereUpdate = array(
				'tahun' 			=> $ctahun,
				'kd_apip' 			=> $cinstansi,
				'kd_elemen' 		=> $celemen,
				'kd_topik' 			=> $ctopik,
			);
			$dataUpdate = array(
				'nm_topik' 				=> $this->input->post('cnm_topik'),
				'urut' 					=> $this->input->post('curut_topik'),
				'keterangan' 			=> $this->input->post('cket_topik')
			);


			$this->db->where($whereUpdate);
			$result= $this->db->update('ttopik', $dataUpdate);
			
				if($result){
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
					

		} 


		public function simpan_level(){   

			$user_id = $this->session->userdata('user_id');
			$ctgl = date('Y-m-d H:i:s');
			
			$data = array(
						'kd_elemen' 		=> $this->input->post('celemen'),
						'kd_topik' 			=> $this->input->post('ctopik'),
						'kd_level' 			=> $this->input->post('clevel'),
						'tahun' 			=> $this->input->post('ctahun'),
						'kd_apip' 			=> $this->input->post('cinstansi')
						
						
					);
					$data = $this->security->xss_clean($data);
					$result = $this->PenilaianModel->add_level($data);

					
				if($result){
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
					

		} 



	}
