<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class GrafikController extends CI_Controller  {
		public function __construct(){
			parent::__construct();			
			$this->load->library('mybreadcrumb');
			$this->load->model('dashboard/PotensiModel', 'MPotensi');
			$this->load->model('dashboard/PenerimaanModel', 'MPenerimaan');
			$this->load->model('PublicModel');
			
		}

		public function index(){			
			ini_set('max_execution_time', 300);	
			$data['kecamatan'] 		= $this->PublicModel->getKecamatan();				
			$data['view'] = 'grafik/potensi/index';
			$this->load->view('template/layout', $data);
		}


		public function penerimaan(){			
			ini_set('max_execution_time', 300);	
			$data['kecamatan'] 		= $this->PublicModel->getKecamatan();				
			$data['view'] = 'grafik/penerimaan/index';
			$this->load->view('template/layout', $data);
		}



		public function get_chart_potensi($kec='000') {
			ini_set('max_execution_time', 0); 
            ini_set('memory_limit','2048M');
			
			$creal= array();
			$group= array();

			if($kec=='000'){
				$data  = $this->MPotensi->getPotensiKecamatan();
				// $creal= array();
				// $group= array();
				
				$xno=0;
				foreach ($data as $value) {
					$xno=$xno+1;				
					$potensi[]=round($value->jml);	
					$group[]=$value->nm_kecamatan;	
					
				}

				$data['group'] 			= $group;
				$data['potensi'] 		= $potensi;

			}else{

				$data  = $this->MPotensi->getPotensiKelurahan($kec);
				
				
				$xno=0;
				foreach ($data as $value) {
					$xno=$xno+1;				
					$potensi[]=round($value->jml);	
					$group[]=$value->nm_kelurahan;	
					
				}

				$data['group'] 			= $group;
				$data['potensi'] 		= $potensi;


			}
			
	        echo json_encode($data);
		}


		public function get_chart_penerimaan($kec='000') {
			ini_set('max_execution_time', 0); 
            ini_set('memory_limit','2048M');

			$startDate = $_POST['startDate'];
			$endDate = $_POST['endDate'];
			
			$creal= array();
			$group= array();

			if($kec=='000'){
				$data  = $this->MPenerimaan->getPenerimaanKecamatan($startDate,$endDate);
				// $creal= array();
				// $group= array();
				
				$xno=0;
				foreach ($data as $value) {
					$xno=$xno+1;				
					$pokok[]=round($value->pokok);	
					$denda[]=round($value->denda);	
					$jrec[]=round($value->jrec);	
					$group[]=$value->nm_kecamatan;	
					
				}

				$data['group'] 			= $group;
				$data['pokok'] 			= $pokok;
				$data['denda'] 			= $denda;
				$data['jrec'] 			= $jrec;

			}else{

				$data  = $this->MPenerimaan->getPenerimaanKelurahan($kec,$startDate,$endDate);
				
				
				$xno=0;
				foreach ($data as $value) {
					$xno=$xno+1;				
					$pokok[]=round($value->pokok);	
					$denda[]=round($value->denda);	
					$jrec[]=round($value->jrec);	
					$group[]=$value->nm_kelurahan;	
					
				}

				$data['group'] 			= $group;
				$data['pokok'] 			= $pokok;
				$data['denda'] 			= $denda;
				$data['jrec'] 			= $jrec;


			}
			
	        echo json_encode($data);
		}

	}

?>	