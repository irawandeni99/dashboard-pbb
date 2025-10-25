<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class UserController extends CI_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/user_model', 'user_model');
			//$this->load->model('admin/opd_model', 'opd_model');
			$this->load->model('admin/auth_model', 'auth_model');
			$this->load->model('PublicModel', 'pubModel');
		}

		public function get_dop(){
			$ins = $this->input->post('ins');
			$data['pemda']=$this->user_model->get_pemda_inspektorat($ins);
			$data['kemendagri']=$this->user_model->get_kemendagri_inspektorat($ins);
			echo json_encode($data);
		}

		public function user_profile(){
			$data['view'] = 'admin/users/user_profile';
			$this->load->view('template/layout', $data);
		}

		public function get_user_profile(){
			$id = $this->session->userdata('admin_id');
			$cekUser = $this->db->get_where('ms_user', array('id_user' => $id))->result();
			$data = array();
			if (count($cekUser)>0) {
				foreach ($cekUser as $value) {
					$data['id_user']=$value->id_user;
					$data['username']=$value->username;
					$data['nama']=$value->name;
					$data['email']=$value->email;
					$data['telp']=$value->telp;
					$data['last_login']=$value->last_login==''?'':$this->pubModel->tgl_jam($value->last_login);
				}
			}else{
				$data['id_user']='';
				$data['username']='';
				$data['nama']='';
				$data['email']='';
				$data['telp']='';
				$data['last_login']='';
			}
			echo json_encode($data);
		}



		public function get_user_activity(){

			$id 	= $this->session->userdata('id_kab');
			$akses   = $this->session->userdata('is_admin');
	        $apps    = $this->session->userdata('apps_modul'); 
	        if ($akses == 1) {
	        	$query = "SELECT * FROM tr_history_tlhp WHERE menu = '".$apps."' ORDER BY user_date desc LIMIT 5";
	        	$cekAct = $this->db->query($query);
	        }elseif($akses == 2){
	        	$sql = "SELECT * FROM ms_inspektorat where id_inspektorat = ".$id;    
	            if ($apps == 'PEMDA') {
	                $daerah = $this->db->query($sql)->row()->pemda;
	            }else{
	                $daerah = $this->db->query($sql)->row()->kemendagri;
	            }
	            $arrayDaerah = explode(',',$daerah); 
	            $this->db->where_in('tr_history_tlhp.instansi',$arrayDaerah);
	            $this->db->where('tr_history_tlhp.status','BELUM DIBACA');
	            $this->db->where('tr_history_tlhp.aksi<>','UPLOAD');
	            $this->db->where('tr_history_tlhp.menu',$apps);
	            $this->db->order_by('tr_history_tlhp.user_date','DESC');
	            $this->db->limit(5);
	            $cekAct = $this->ci->db->get('tr_history_tlhp');
	        }elseif ($akses == 3 || $akses == 4 || $akses == 5) {
	        	$query = "SELECT * FROM tr_history_tlhp WHERE tr_history_tlhp.instansi = ".$id." AND menu = '".$apps."' ORDER BY user_date desc LIMIT 5";
				$cekAct = $this->db->query($query);
			}

			if ($cekAct) {
				$htmlAct = '';
				foreach ($cekAct->result() as $row) {

					$id            = $row->id;
	                $uraianaksi = $row->uraian;
	                $aksi = $row->aksi;
	                $lhp = $row->no_lhp;
	                $reg = $row->noreg;
	                $tgl_aksi = $row->user_date;
	                $rekom = $row->kd_rekomendasi;
	                $user_id = $row->user_id;
	                $cekNamaUser = $this->db->get_where('ms_user',array('id_user'=>$user_id))->row();
	                $tgl_act = strtotime($tgl_aksi);
	                $tgl_now = strtotime("now");
	                if ($apps == 'PEMDA') {
	                    $cont = $row->routes.'/tindak-lanjut';
	                    $link = base_url($cont).'?noreg='.$reg.'&no_lhp='.$lhp;
	                }elseif($apps == 'KEMENDAGRI'){
	                    $cont = $row->routes.'/tindak-lanjut';
	                    $link = base_url($cont).'?noreg='.$reg.'&no_lhp='.$lhp;
	                }elseif($apps == 'BPK'){
	                    $cont = $row->routes.'/tindak-lanjut';
	                    $link = base_url($cont).'?noreg='.$reg.'&no_lhp='.$lhp;
	                }

	                $diff = $tgl_now-$tgl_act;
	                $d = floor($diff / (60 * 60 * 24));
	                if ($d == 0) {
	                    // jam saja
	                    $ret= date('H:i', strtotime($tgl_aksi));
	                }elseif ($d== 1) {
	                    // kemarin dan jam
	                    $retJam= date('H:i', strtotime($tgl_aksi));
	                    $ret = 'Kemarin';
	                }elseif ($d>1 && $d<7) {
	                    // n hari lalu
	                    $ret = $d.' Hari lalu';
	                }elseif ($d==7) {
	                    // 1 minggu lalu
	                    $ret = 'Seminggu Lalu';
	                }else{
	                    // tanggal jam
	                    $ret = date('d-m-Y', strtotime($tgl_aksi));
	                }

	                $sts = $row->status;
	                if ($sts =='SUDAH DIBACA') {
	                    $dot = " ";
	                }else{
	                    $dot = " bg-unread ";
	                }
	                // $d = $tgl_now->diff($tgl_act)->days + 1;
	                
	                    $aktor = '['.$cekNamaUser->name.']';
	                
					
					if ($aksi == 'INSERT') {
						$icon = ' fa-plus';
					}elseif ($aksi == 'UPDATE') {
						$icon = ' fa-refresh';
					}elseif ($aksi == 'DELETE' || $aksi == 'DELETEFILE') {
						$icon = ' fa-trash';
					}elseif ($aksi == 'UPLOAD') {
						$icon = ' fa-upload';
					}elseif ($aksi == 'VERIF') {
						$icon = ' fa-check';
					}else{

					}
					$htmlAct .='<li>
								<i class="fa '.$icon.' activity-icon"></i>
								<p>'.$aktor.' '.$uraianaksi.' <span class="timestamp">'.$ret.'</span></p>
								</li>';				
				}
				$data['act']=$htmlAct;
			}else{

				$data['act']='';
			}
			
			echo json_encode($data);
		}

		public function index(){
			$data['view'] = 'admin/users/user';
			$this->load->view('template/layout', $data);
		}

		public function cek_user()
		{
			$user = $_POST['username'];
			$cekUser = $this->db->get_where('ms_user', array('username' => $user))->result();
			if (count($cekUser) == 1) {
				$data['sts']= 'ada';
			}else{
				$data['sts']= 'tdk';
			}
			echo json_encode($data);
		}

		public function cek_password()
		{
			$this->load->library('encrypt');
			$id_user = $_POST['id_user'];
			$old_pw 	= $_POST['c_password'];
			$new_pw 	= $_POST['n_password'];
			$con_pw 	= $_POST['n2_password'];
			$old_pw_hash = password_hash($old_pw, PASSWORD_BCRYPT);

			$cekUser = $this->db->get_where('ms_user', array('id_user' => $id_user))->row_array();
			$validPassword = password_verify($old_pw, $cekUser['password']);
			if ($validPassword) {
				if (strlen($new_pw)>=8) {
					if ($new_pw == $con_pw) {
						$data = array(
							'password' => password_hash($this->input->post('n_password'), PASSWORD_BCRYPT)
						);

						$result = $this->auth_model->change_pwd($data, $id_user);
						$data['pesan'] = 'Password Berhasil Di Update!';
						$data['status'] = 'success';
					}else{
						$data['pesan'] = 'Password baru dan konfirmasi password harus sama';
						$data['status'] = 'info';
					}
				}else{
					$data['pesan'] = 'Password minimal 8 karakter!';
					$data['status'] = 'info';
				}
			}else{
				$data['pesan'] = 'Password Lama Tidak Sesuai!';
				$data['status'] = 'error';
			}
			
			echo json_encode($data);
		}

		public function get() {
			$list = $this->user_model->get_all_user();
	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $field) {
	            $no++;
	            $row = array();
	            $row[] = $no;
	            $row[] = $field->name;
	            $old_pw_hash = password_hash($field->password, PASSWORD_BCRYPT);
	            $row[] = $field->username.'('. $old_pw_hash.')';
	            
	            	$type = $field->uraian;
	            
	            $row[] = $type;
	            $row[] = '<center>
		 	    	<a href="#" class="btn btn-info btn-flat btn-xs edit" data-id="'.$field->id_user.'" data-username="'.$field->username.'" data-nama="'.$field->name.'" data-telp="'.$field->telp.'" data-prov="'.$field->id_prov.'" data-kab="'.$field->id_kab.'" data-email="'.$field->email.'" data-role="'.$field->type.'"><i class="lnr lnr-pencil"></i></a>
		 	    	<a href="#" class="dropdown-item btn btn-danger btn-flat btn-xs tombol-hapus" data-id="'.$field->id_user.'" data-nama="'.$field->name.'"><i class="lnr lnr-trash"></i></a></td>
		 	    	</center>';
	            $data[] = $row;
	        }
	 
	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->user_model->count_all_user(),
	            "recordsFiltered" => $this->user_model->count_filtered_user(),
	            "data" => $data,
	        );
	        echo json_encode($output);
		}


		public function get_user() {
			$list = $this->user_model->get_all_user_pemda();
	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $field) {
	            $no++;
	            $akses = $field->is_admin; 

	            $row = array();
	            $row[] = $no;
	            $row[] = $field->name;
	            $row[] = $field->username;
	            $row[] = $field->nm_group;
	            $row[] = '<center>
		 	    	<a href="#" class="btn btn-info btn-flat btn-xs edit" data-id="'.$field->id_user.'" data-apip = "'.$field->id_instansi.'" data-username="'.$field->username.'" data-nama="'.$field->name.'" data-telp="'.$field->telp.'" data-prov="'.$field->id_prov.'" data-kab="'.$field->id_kab.'" data-email="'.$field->email.'" data-role="'.$field->type.'" data-alias="'.$field->alias.'"  data-pemda="'.$pemda.'"><i class="lnr lnr-pencil"></i></a>
		 	    	<a href="#" class="dropdown-item btn btn-danger btn-flat btn-xs tombol-hapus" data-id="'.$field->id_user.'" data-nama="'.$field->name.'"><i class="lnr lnr-trash"></i></a></td>
		 	    	</center>';
	            $data[] = $row;
	        }
	 
	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->user_model->count_all_user_pemda(),
	            "recordsFiltered" => $this->user_model->count_filtered_user_pemda(),
	            "data" => $data,
	        );
	        echo json_encode($output);
		}
		

		
		public function get_user_kemendagri() {
			$list = $this->user_model->get_all_user_kemendagri();
	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $field) {
	            $no++;
	            $apip = $field->inspektorat;
	            $pemda = $field->pemda;
	            $kemendagri = $field->kemendagri;

	            $row = array();
	            $row[] = $no;
	            $row[] = $field->name;
	            $row[] = $field->username;
	            $row[] = $field->uraian;
	            $row[] = '<center>
		 	    	<a href="#" class="btn btn-info btn-flat btn-xs edit" data-id="'.$field->id_user.'" data-apip = "'.$apip.'" data-username="'.$field->username.'" data-nama="'.$field->name.'" data-telp="'.$field->telp.'" data-prov="'.$field->id_prov.'" data-kab="'.$field->id_kab.'" data-email="'.$field->email.'" data-role="'.$field->type.'" data-alias="'.$field->alias.'"  data-pemda="'.$pemda.'"><i class="lnr lnr-pencil"></i></a>
		 	    	<a href="#" class="dropdown-item btn btn-danger btn-flat btn-xs tombol-hapus" data-id="'.$field->id_user.'" data-nama="'.$field->name.'"><i class="lnr lnr-trash"></i></a></td>
		 	    	</center>';
	            $data[] = $row;
	        }
	 
	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->user_model->count_all_user_kemendagri(),
	            "recordsFiltered" => $this->user_model->count_filtered_user_kemendagri(),
	            "data" => $data,
	        );
	        echo json_encode($output);
		}

		public function get_combo_instansi(){
			echo $this->user_model->getinstansi();	
		}

		public function get_combo_prov(){
			echo $this->user_model->getprov();	
		}

		public function get_combo_prov_front(){
			echo $this->user_model->getprovfront();	
		}

		public function get_combo_grup_akses(){
			echo $this->user_model->getaksesgroup();	
		}

		public function get_combo_inspektorat(){
			echo $this->user_model->getinspektorat();	
		}

		public function get_combo_ins()
		{
			echo $this->user_model->getins();		
		}

		public function get_combo_kab(){
			$prov = $this->input->post('kode');
			
			echo $this->user_model->getkab($prov);	
		}

		public function getmax(){
			 $header = $this->input->post('kode');
			 $role = $this->input->post('role');
			 $username=$this->user_model->get_username($header,$role);
			 echo $username;
		}
		
		public function add(){

			if($this->input->post('submit')){
				$this->form_validation->set_rules('role', 'Role', 'trim|required');	
				$this->form_validation->set_rules('username', 'Username', 'trim|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
				$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|required');

				$role = $this->input->post('role');
				if ($role == 2) {
					$this->form_validation->set_rules('prov', 'Provinsi', 'trim|required');
					$this->form_validation->set_rules('kab', 'Kabupaten', 'trim|required');			
				}
				

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/users/user_list';
					$this->load->view('template/layout', $data);
				}
				else{
					if ($role == 1) {
						$data = array(
							'name' => $this->input->post('nama'),
							'username' => $this->input->post('username'),
							'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
							'telp' => $this->input->post('telp'),
							'email' => $this->input->post('email'),
							'is_admin' => $role,
							'id_prov' => $role,
							'id_kab' => $role,
							'type' => $role,
							'id_group' => $role,
							'create_at' => date('Y-m-d H:i:s'),
							'update_at' => date('Y-m-d H:i:s'),
						);
					}else{
						$data = array(
							'name' => $this->input->post('nama'),
							'username' => $this->input->post('username'),
							'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
							'telp' => $this->input->post('telp'),
							'email' => $this->input->post('email'),
							'is_admin' => $role,
							'id_prov' => $this->input->post('prov'),
							'id_kab' => $this->input->post('kab'),
							'type' => $role,
							'id_group' => $role,
							'create_at' => date('Y-m-d H:i:s'),
							'update_at' => date('Y-m-d H:i:s'),
						);
					}
					$data = $this->security->xss_clean($data);
					$result = $this->user_model->add_user($data);
					if($result){
						$this->session->set_flashdata('msg', 'Data Berhasil Ditambahkan!');
						redirect(base_url($this->dynamic_menu->EncryptLink('data-user')));
					}
				}
			}
			else{
				$data['view'] = 'admin/users/user_list';
				$this->load->view('template/layout', $data);
			}
			
		}

		public function insert(){
			
			$role = $this->input->post('role');
			$alias = $this->input->post('alias');
			if ($alias == '') {
				$alias = $this->input->post('nama');
			}
				
						
						$data = array(
							'name' => $this->input->post('nama'),
							'username' => $this->input->post('username'),
							'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
							'telp' => $this->input->post('telp'),
							'email' => $this->input->post('email'),
							'is_admin' => $role,
							'type' => $role,
							'id_group' => $role,
							'create_at' => date('Y-m-d H:i:s'),
							'update_at' => date('Y-m-d H:i:s'),
						);
					
					$data = $this->security->xss_clean($data);
					$result = $this->user_model->add_user($data);
					if($result){
						$dataRet['pesan'] = "Data Berhasil Ditambahkan!";
					}
					echo json_encode($dataRet);
			
			
		}


		public function update(){

			$whereUpdate = array('username' => $this->input->post('username'));
			$role = $this->input->post('role');
			$alias = $this->input->post('alias');
			$apps_modul  =$this->session->userdata('apps_modul');

			$password = $this->input->post('password');
			if($password != ''){
				$dataPass = array('password' => password_hash($password, PASSWORD_BCRYPT));
			}

					$data = array(
						'name' => $this->input->post('nama'),
						'alias' => $alias,
						'telp' => $this->input->post('telp'),
						'email' => $this->input->post('email'),
						'is_admin' => $role,
						'type' => $role,
						'id_group' => $role,
						'apps_modul' => $apps_modul,
						'update_at' => date('Y-m-d H:i:s'),
					);

					
					
					if($password != ''){
						$dataUpdate = array_merge($data,$dataPass);
					}else{
						$dataUpdate = $data;
					}

					$data = $this->security->xss_clean($dataUpdate);
					$result = $this->user_model->edit_user($data,$whereUpdate);
					if($result){
						$dataRet['pesan'] = "Data Berhasil DiUpdate!";
					}
					echo json_encode($dataRet);
			
			
		}


		public function edit($id = 0){
			
			if($this->input->post('submit')){
				$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
				

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/users/user_list';
					$this->load->view('template/layout', $data);
				}
				else{
					
						$data = array(
								'name' => $this->input->post('nama'),
								'alias' => $alias,
								'telp' => $this->input->post('telp'),
								'email' => $this->input->post('email'),
								'update_at' => date('Y-m-d H:i:s'),
						);

					if(!empty($this->input->post('password'))){
						$data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
					}
					$data = $this->security->xss_clean($data);
					$result = $this->user_model->edit_user($data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Data Berhasil Diupdate!');
						redirect(base_url($this->dynamic_menu->EncryptLink('data-user')));
					}
				}
			}
			else{
				$data['view'] = 'admin/users/user_list';
				$this->load->view('template/layout', $data);
			}
		}



		public function del($id = 0){
			$this->db->delete('ms_user', array('id_user' => $id));
			$this->session->set_flashdata('msg', 'Data Berhasil Dihapus!');
			redirect(base_url($this->dynamic_menu->EncryptLink('data-user')));
		}

	}


?>