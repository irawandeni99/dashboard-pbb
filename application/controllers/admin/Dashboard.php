<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Dashboard extends CI_Controller  {
		public function __construct(){
			parent::__construct();			
			$this->load->library('mybreadcrumb');
			$this->load->model('dashboard/PotensiModel', 'MPotensi');
			$this->load->model('PublicModel');
			
		}

		public function index(){			
			ini_set('max_execution_time', 300);					
			$data['view'] = 'admin/dashboard/index'; 
			$data['kecamatan'] 			= $this->PublicModel->getKecamatan();  	
			$data['listKecamatan'] 		= $this->PublicModel->listMkecamatan();	
			
			$data['efektivitas'] = 'dashboard-efektivitas/get';
			
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


		public function get_efektivitas(){
			$data = $this->PublicModel->viewEfektivitas();
			
			echo $data;
						
		}


		// public function get_efektivitas_xx() {
		// 	ini_set('max_execution_time', 0); 
        //     ini_set('memory_limit','2048M');

		// 	$cnminstansi	 = $this->PublicModel->getInstansi();
		// 	$prop=$cnminstansi[0]->kd_propinsi;		
		// 	$kab=$cnminstansi[0]->kd_dati2;

		// 	$tahunServer = date("Y");				
		// 	$startYear = $tahunServer-1;
		// 	$endYear = $tahunServer;

		// 	$data  = $this->PublicModel->get_efektivitas($prop,$kab,$startYear,$endYear);

		// 		$xno=0;
		// 		foreach ($data as $value) {
		// 			$xno=$xno+1;				
		// 			$pokok=round($value->thn_pajak_sppt);	
		// 			$denda=round($value->denda);	
		// 			$jrec[]=round($value->jrec);	
		// 			$group[]=$value->nm_kecamatan;	
					
		// 		}

		// 	echo json_encode($data);	

			
		// 	// $creal= array();
		// 	// $group= array();

		// 	// if($kec=='000'){
		// 	// 	$data  = $this->MEfektivitas->getEfektivitasKecamatan($startDate,$endDate);
				
		// 	// 	$xno=0;
		// 	// 	foreach ($data as $value) {
		// 	// 		$xno=$xno+1;				
		// 	// 		$pokok[]=round($value->pokok);	
		// 	// 		$denda[]=round($value->denda);	
		// 	// 		$jrec[]=round($value->jrec);	
		// 	// 		$group[]=$value->nm_kecamatan;	
					
		// 	// 	}

		// 	// 	$data['group'] 			= $group;
		// 	// 	$data['pokok'] 			= $pokok;
		// 	// 	$data['denda'] 			= $denda;
		// 	// 	$data['jrec'] 			= $jrec;

		// 	// }else{

		// 	// 	$data  = $this->MPenerimaan->getPenerimaanKelurahan($kec,$startDate,$endDate);
				
				
		// 	// 	$xno=0;
		// 	// 	foreach ($data as $value) {
		// 	// 		$xno=$xno+1;				
		// 	// 		$pokok[]=round($value->pokok);	
		// 	// 		$denda[]=round($value->denda);	
		// 	// 		$jrec[]=round($value->jrec);	
		// 	// 		$group[]=$value->nm_kelurahan;	
					
		// 	// 	}

		// 	// 	$data['group'] 			= $group;
		// 	// 	$data['pokok'] 			= $pokok;
		// 	// 	$data['denda'] 			= $denda;
		// 	// 	$data['jrec'] 			= $jrec;


		// 	// }
			
	    //    // echo json_encode($data);
		// }



	}

?>	