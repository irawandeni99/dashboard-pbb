<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Auth extends CI_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model('admin/auth_model', 'auth_model');
			$this->load->model('admin/opd_model', 'opd_model');
			$this->load->model('admin/User_model', 'user_model');
		}

		public function index(){

			if($this->session->has_userdata('is_admin_login'))
			{
				// redirect('admin/dashboard');
				redirect('dashboard-bappeda');
			}
			else{

				redirect('login');
			}
		}


		public function login_ekapip(){
			$this->load->library('encrypt');
			if($this->input->post('submit')){
				$this->form_validation->set_rules('username', 'Username', 'trim|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['msg'] = 'Username/Password Tidak Valid!';
					$this->load->view('admin/auth/login-ekapip', $data);
				}
				else {

					$data = array(
						'username' 	=> $this->input->post('username'),
						'password' 	=> $this->input->post('password')
					);

					$result = $this->auth_model->login($data);
				//	print_r($result['alias']);die();

				//	if ($result == TRUE && $result['alias'] == 'root') {
						
					if ($result == TRUE ) {
	
						$kab = $this->user_model->get_menu_ekapip($result['id_group']);
						
						$iduser = $result['id_user'];

						$data2 = array(
									'st_login' => 1,
									'last_login' => date('Y-m-d H:i:s'),
								);

						$data2 = $this->security->xss_clean($data2);
						$result2 = $this->user_model->edit_user($data2, $iduser);
						
						$admin_data = array(
							'admin_id' 			=> $result['id_user'],
							'user_id' 			=> $result['id_user'],
						 	'name' 				=> $result['username'],
						 	'nama' 				=> $result['name'],
						 	'alias' 			=> $result['alias'],
						 	'id_kab' 			=> $result['id_kab'],
						 	'id_prov' 			=> $result['id_prov'],
						 	'id_instansi' 			=> $result['id_instansi'],
						 	'id_prov' 			=> $result['id_prov'],
						 	'kab' 				=> $result['id_group'],
						 	'is_admin_login' 	=> TRUE,
						 	'is_admin' 			=> $result['is_admin'],
							'mn'				=> $this->encrypt->encode($kab['menu_permission']),
							'siteDec'			=> $kab['nm_group'],
							'thn_ang'			=> $kab['thn_ang'],
							'year_selected'		=> $this->input->post('tahun')
						);

						$this->session->set_userdata($admin_data);
						$link 	= $this->dynamic_menu->EncryptLink('dashboard');
						redirect(base_url($link), 'refresh');
					}
					else{

						$data['msg'] = 'Username atau Password Tidak Valid!';
						$this->load->view('admin/auth/login-ekapip', $data);
					}
				}
			}
			else{
				$this->load->view('admin/auth/login-ekapip');
				// redirect(base_url(''), $data);
			}
		}	



		public function change_pwd(){

			$id = $this->session->userdata('admin_id');

			if($this->input->post('submit')){
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
				$this->form_validation->set_rules('confirm_pwd', 'Confirm Password', 'trim|required|matches[password]');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/auth/change_pwd';
					$this->load->view('admin/layout', $data);
				}
				else{

					$data = array(
						'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
					);

					$result = $this->auth_model->change_pwd($data, $id);

					if($result){
						$this->session->set_flashdata('msg', 'Password has been changed successfully!');
						redirect(base_url('admin/auth/change_pwd'));
					}
				}
			}
			else{
				$data['view'] = 'admin/auth/change_pwd';
				$this->load->view('template/layout', $data);
			}
		}

		public function ubah_tahun(){
				$thn = $_POST['thn'];
				$admin_data = array(
							'thn_ang'			=> $this->input->post('thn'),
							'year_selected'		=> $this->input->post('thn'),
						);
				$this->session->set_userdata($admin_data);
		}

		public function logout(){
				$id = $this->session->userdata('user_id');

				$data = array(
							'st_login' => 0,
							'last_logout' => date('Y-m-d H:i:s'),
						);

				$data = $this->security->xss_clean($data);
				$result = $this->user_model->edit_user($data, $id);

			$this->session->sess_destroy();
			//$link 	= $this->dynamic_menu->EncryptLink('dashboard-simple');
			$link 	= $this->dynamic_menu->EncryptLink('login-ekapip');
			redirect(base_url($link), 'refresh');
		}
	}  // end class
?>