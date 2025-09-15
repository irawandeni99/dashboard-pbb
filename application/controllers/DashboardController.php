<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class DashboardController extends CI_Controller  {
		public function __construct(){
			parent::__construct();			
			$this->load->library('mybreadcrumb');
			//$this->load->model('bappeda/Dashboardrenja_model', 'bappeda_model');
			//$this->load->model('pengawasan/HasilPengawasanModel', 'was_model');
			//$this->load->model('profil/AkuntansiPelaporanModel', 'akuntansi_pelaporan_model');
		}

		public function index(){	
					
			ini_set('max_execution_time', 300);					
		//	$this->load->view('front/dashboard-simple', $data);
			$this->load->view('admin/auth/login-ekapip', $data);
		}

		public function profil()
		{
			ini_set('max_execution_time', 300);					
			$this->load->view('front/profil', $data);	
		}

		public function hasil_pengawasan()
		{
			ini_set('max_execution_time', 300);					
			$this->load->view('front/hasilPengawasanView', $data);	
		}

		public function e_audit()
		{
			ini_set('max_execution_time', 300);					
			$this->load->view('404', $data);	
		}
		public function e_dupak()
		{
			ini_set('max_execution_time', 300);					
			$this->load->view('404', $data);	
		}
		public function e_dumas()
		{
			ini_set('max_execution_time', 300);					
			$this->load->view('404', $data);	
		}
		public function m_tlhp()
		{
			ini_set('max_execution_time', 300);					
			$this->load->view('404', $data);	
		}

	




	}

?>	