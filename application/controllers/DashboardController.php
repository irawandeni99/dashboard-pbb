<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class DashboardController extends CI_Controller  {
		public function __construct(){
			parent::__construct();			
			$this->load->library('mybreadcrumb');
		}

		public function index(){	
					
			ini_set('max_execution_time', 300);					
			$this->load->view('admin/auth/login', $data);
		}

		public function profil()
		{
			ini_set('max_execution_time', 300);					
			$this->load->view('front/profil', $data);	
		}

		
	}

?>	