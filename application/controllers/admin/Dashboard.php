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



	}

?>	