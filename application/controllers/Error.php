<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Error extends CI_Controller {

		

		public function index(){
			$data['view'] = '404';
			$this->load->view('template/layout', $data);
		}

	}


?>