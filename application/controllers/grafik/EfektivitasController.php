<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class EfektivitasController  extends CI_Controller  {
		public function __construct(){
			parent::__construct();			
			$this->load->library('mybreadcrumb');
			$this->load->model('dashboard/EfektivitasModel', 'MEfektivitas');
			$this->load->model('PublicModel');
			
		}


		public function index(){			
			ini_set('max_execution_time', 300);	
			$data['kecamatan'] 		= $this->PublicModel->getKecamatan();				
			$data['view'] = 'grafik/efektivitas/index';
			$this->load->view('template/layout', $data);
		}


		public function get_chart($kec='000') {
			ini_set('max_execution_time', 0); 
            ini_set('memory_limit','2048M');
			$cnminstansi	 = $this->PublicModel->getInstansi();
			$prop=$cnminstansi[0]->kd_propinsi;		
			$kab=$cnminstansi[0]->kd_dati2;	

			$startYear = $_POST['startYear'];
			$endYear = $_POST['endYear'];

			if($kec=='000'){
				$data  = $this->MEfektivitas->getEfektivitas($prop,$kab,$kec,$startYear,$endYear);
				
				$xno=0;
				foreach ($data as $value) {
					$xno=$xno+1;				

					$sppt_tetap[]=round($value->sppt_tetap);	
					$nilai_tetap[]=round($value->nilai_tetap);	
					$sppt_real[]=round($value->sppt_real);	
					$nilai_real[]=round($value->nilai_real);	
					$group[]=$value->thn_pajak_sppt;	
					
				}

				$data['group'] 			= $group;
				$data['sppt_tetap'] 	= $sppt_tetap;
				$data['nilai_tetap'] 	= $nilai_tetap;
				$data['sppt_real'] 	= $sppt_real;
				$data['nilai_real'] 	= $nilai_real;

			}else{


				$data  = $this->MEfektivitas->getEfektivitas($prop,$kab,$kec,$startYear,$endYear);
				
				$xno=0;
				foreach ($data as $value) {
					$xno=$xno+1;				

					$sppt_tetap[]=round($value->sppt_tetap);	
					$nilai_tetap[]=round($value->nilai_tetap);	
					$sppt_real[]=round($value->sppt_real);	
					$nilai_real[]=round($value->nilai_real);	
					$group[]=$value->thn_pajak_sppt;
					$nama = ucwords(strtolower($value->nm_kecamatan));

					
				}

				$data['group'] 			= $group;
				$data['nama'] 			= $nama;
				$data['sppt_tetap'] 	= $sppt_tetap;
				$data['nilai_tetap'] 	= $nilai_tetap;
				$data['sppt_real'] 		= $sppt_real;
				$data['nilai_real'] 	= $nilai_real;

			}
			
	        echo json_encode($data);
		}




	}	

?>	