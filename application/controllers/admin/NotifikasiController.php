<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class NotifikasiController extends CI_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/Notifikasi_model', 'a_model');
			$this->load->model('PublicModel', 'pubModel');
		}

		public function index(){
			$data['view'] = 'admin/notifikasi/notifikasiView';
			$this->load->view('template/layout', $data);
		}

		public function preview(){
			$data['title'] = $_GET['file'];
			$data['prev'] = $_GET['prev'];
			$id = $_GET['prev'];
			$res = $this->db->get_where('ms_manual',array('id'=>$id))->row();
			if (count($res)>0) {
				$file = $res->file;
				$data['link'] = base_url().'assets/manual/'.$file;
			}
			$this->load->view('admin/manual/manualPreview', $data);
		}

		public function get_combo_prov(){
			echo $this->a_model->getprov();	
		}

		public function get2(){
		
			$data = $this->a_model->viewNotifikasi();
			echo $data;
		}		

		public function update(){
			
			$cid = $this->input->post('cid');		
			$hsql = "UPDATE thistory SET status=1 WHERE id='".$cid."'";		
			$data = $this->db->query($hsql);
			
			echo $data;
		}			
		
		public function get() {
			$list = $this->a_model->get_all_notification();
			$akses = $this->session->userdata('is_admin');
	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $field) {
	            $no++;
	            $row = array();
	            $apps = $this->session->userdata('apps_modul'); 
	            $id            	= $field->id;
                $_id            = $this->dynamic_menu->EncryptLink($id);
                $uraianaksi 	= $field->uraian;
                $aksi 			= $field->aksi;
			   
				
                $routes 		= $field->routes;
                $_routes 		= $this->dynamic_menu->EncryptLink($routes);


                $tgl_aksi 		= $field->user_date;
                $user_id 		= $field->user_id;
              
				
                $status 		= $field->status=='DILIHAT'?'':'<span class="badge badge-sm pull-right">'.$field->status.'</span>';
								
	            $uraian = '<a href="'.$link.'">'.$field->uraian.'<br>'.$this->pubModel->tgl_jam($field->user_date).'<br>'.$status.'</a>';
	            $row[] =  $uraian;
	            $data[] = $row;
	        }

	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->a_model->count_all_notification(),
	            "recordsFiltered" => $this->a_model->count_filtered_notification(),
	            "data" => $data,
				
	        );
	        echo json_encode($output);
		}

		public function add(){
			
			if($this->input->post('submit')){
				$this->form_validation->set_rules('id_daerah', 'Id Provinsi', 'trim|required');
				$this->form_validation->set_rules('nm_daerah', 'Nama Provinsi', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'master/provView';
					$this->load->view('template/layout', $data);
				}
				else{

					$data = array(
						'id_daerah' 		=> $this->input->post('id_daerah'),
						'nm_daerah' 		=> $this->input->post('nm_daerah'),
						'clevel' 			=> 1,
						'hd_daerah' 		=> "",
						'hd' 				=> "H",
						'ket' 				=> "Provinsi"
					);
					$data = $this->security->xss_clean($data);
					$result = $this->a_model->add_daerah($data);
					if($result){
						$this->session->set_flashdata('msg', 'Data Berhasil Ditambahkan!');
						redirect(base_url($this->dynamic_menu->EncryptLink('data-provinsi')));
					}
						
				}
			}
			
		}

		public function edit($id = 0){
			
			if($this->input->post('submit')){
				$this->form_validation->set_rules('id_daerah', 'Id Provinsi', 'trim|required');
				$this->form_validation->set_rules('nm_daerah', 'Nama Provinsi', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'master/provView';
					$this->load->view('template/layout', $data);
				}
				else{
					$data = array(
						'nm_daerah' 		=> $this->input->post('nm_daerah'),
					);
					$data = $this->security->xss_clean($data);
					$result = $this->a_model->edit_daerah($data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Data Berhasil Diupdate!');
						redirect(base_url($this->dynamic_menu->EncryptLink('data-provinsi')));
					}
				}
			}
			else{
				$data['view'] = 'master/provView';
				$this->load->view('template/layout', $data);
			}
		}

		public function del($id = 0){
			$this->db->delete('ms_daerah', array('id_daerah' => $id));
			$this->session->set_flashdata('msg', 'Data Berhasil Dihapus!');
			redirect(base_url($this->dynamic_menu->EncryptLink('data-provinsi')));
		}

		
		// kabupaten kota
		public function index_kab(){
			$data['view'] = 'master/kabKotaView';
			$this->load->view('template/layout', $data);
		}

		public function get_kab() {
			$list = $this->a_model->get_all_kab();

	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $field) {
	            $no++;
	            $row = array();
	            $row[] = $no;
	            $row[] = $field->id_daerah;
	            $row[] = $field->nm_daerah;
	            $row[] = $field->ket;
	            $row[] = '<center>
		 	    	<a href="#" data-toggle="tooltip" title="Edit" class="btn btn-info btn-flat btn-xs edit" data-id="'.$field->id_daerah.'" data-nama="'.$field->nm_daerah.'" data-header="'.$field->hd_daerah.'"><i class="lnr lnr-pencil"></i></a>
		 	    	<a href="#" data-toggle="tooltip" title="Hapus" class="dropdown-item btn btn-danger btn-flat btn-xs tombol-hapus" data-id="'.$field->id_daerah.'" data-nama="'.$field->nm_daerah.'"><i class="lnr lnr-trash"></i></a>
		 	    	</center>';
	            $data[] = $row;
	        }
	 
	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->a_model->count_all_kab(),
	            "recordsFiltered" => $this->a_model->count_filtered_kab(),
	            "data" => $data,
	        );
	        echo json_encode($output);
		}

		public function add_kab(){
			
			if($this->input->post('submit')){
				$this->form_validation->set_rules('id_daerah', 'Id Kabupaten/Kota', 'trim|required');
				$this->form_validation->set_rules('nm_daerah', 'Nama Kabupaten/Kota', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'master/kabKotaView';
					$this->load->view('template/layout', $data);
				}
				else{

					$data = array(
						'id_daerah' 		=> $this->input->post('id_daerah'),
						'nm_daerah' 		=> $this->input->post('nm_daerah'),
						'clevel' 			=> 2,
						'hd_daerah' 		=> $this->input->post('prov'),
						'hd' 				=> "D",
						'ket' 				=> "Kabupaten/Kota"
					);
					$data = $this->security->xss_clean($data);
					$result = $this->a_model->add_daerah($data);
					if($result){
						$this->session->set_flashdata('msg', 'Data Berhasil Ditambahkan!');
						redirect(base_url($this->dynamic_menu->EncryptLink('data-kabupaten-kota')));
					}
						
				}
			}
			
		}

		public function edit_kab($id = 0){
			
			if($this->input->post('submit')){
				$this->form_validation->set_rules('id_daerah', 'Id Kabupaten/Kota', 'trim|required');
				$this->form_validation->set_rules('nm_daerah', 'Nama Kabupaten/Kota', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'master/kabKotaView';
					$this->load->view('template/layout', $data);
				}
				else{
					$data = array(
						'nm_daerah' 		=> $this->input->post('nm_daerah'),
					);
					$data = $this->security->xss_clean($data);
					$result = $this->a_model->edit_daerah($data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Data Berhasil Diupdate!');
						redirect(base_url($this->dynamic_menu->EncryptLink('data-kabupaten-kota')));
					}
				}
			}
			else{
				$data['view'] = 'master/kabKotaView';
				$this->load->view('template/layout', $data);
			}
		}

		public function del_kab($id = 0){
			$this->db->delete('ms_daerah', array('id_daerah' => $id));
			$this->session->set_flashdata('msg', 'Data Berhasil Dihapus!');
			redirect(base_url($this->dynamic_menu->EncryptLink('data-kabupaten-kota')));
		}

		public function getmax(){
			 $header = $this->input->post('kode');			
			 $level = $this->input->post('lvl');
			 $max_id=$this->a_model->get_max_daerah($level,$header);
			 echo $max_id;
		}



	}


?>