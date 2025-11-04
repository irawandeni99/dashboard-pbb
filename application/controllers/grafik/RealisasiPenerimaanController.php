<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class RealisasiPenerimaanController  extends CI_Controller  {
		public function __construct(){
			parent::__construct();			
			$this->load->library('mybreadcrumb');
			$this->load->model('dashboard/RealisasiPenerimaanModel', 'MRealisasi');
			$this->load->model('PublicModel');
			
		}


		public function index(){			
			ini_set('max_execution_time', 300);	
			$data['kecamatan'] 		= $this->PublicModel->getKecamatan();				
			$data['view'] = 'grafik/realisasi/index';
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
				$data  = $this->MRealisasi->getRealisasi($prop,$kab,$kec,$startYear,$endYear);
				
				$xno=0;
				foreach ($data as $value) {
					$xno=$xno+1;				

					$pokok[]=round($value->pokok);	
					$denda[]=round($value->denda);	
					$jumlah[]=round($value->jumlah);							
					$group[]=$value->tahun;	
					
				}

				$data['group'] 			= $group;
				$data['pokok'] 			= $pokok;
				$data['denda'] 			= $denda;
				$data['jumlah'] 	    = $jumlah;

			}else{


				$data  = $this->MRealisasi->getRealisasi($prop,$kab,$kec,$startYear,$endYear);
				
				$xno=0;
				foreach ($data as $value) {
					$xno=$xno+1;				

					$pokok[]=round($value->pokok);	
					$denda[]=round($value->denda);	
					$jumlah[]=round($value->jumlah);							
					$group[]=$value->tahun;	
					$nama = ucwords(strtolower($value->nm_kecamatan));
					
				}

				$data['group'] 			= $group;
				$data['nama'] 			= $nama;
				$data['pokok'] 			= $pokok;
				$data['denda'] 			= $denda;
				$data['jumlah'] 		= $jumlah;

			}
			
	        echo json_encode($data);
		}

	}	

?>	