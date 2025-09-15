<?php
	class User_model extends CI_Model{

		var $table = 'ms_user a'; //nama tabel dari database
	    var $column_order = array(null,'id_user'); //field yang ada di table 
	    var $column_search = array('username','name'); //field yang diizin untuk pencarian 
	    var $order = array('id_user' => 'asc'); // default order 

		public function add_user($data){
			
			$this->db->insert('ms_user', $data);
			return true;
		}

		public function get_all_users(){
			$this->db->select('*, sys_group.id_group as sys_group_id');
			$this->db->from('sys_group');
			$this->db->join('ms_user', 'sys_group.id_group = ms_user.id_group');
			$query = $this->db->get();

			//$query = $this->db->get();
			//$query = $this->db->get('ci_users');
			return $result = $query->result_array();
		}
		// GET USER TLHP PEMDA
		private function _get_all_user_kemendagri_query()
	    {
	    	$this->db->where('apps_modul','KEMENDAGRI');
	    	$this->db->where_in('type',array(1,2,3,6));
	    	$this->db->join('ms_akses_group','ms_akses_group.id_akses = a.id_group');
	        $this->db->from($this->table);
			
	        $i = 0;
	     
	        foreach ($this->column_search as $item) // looping awal
	        {
	            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
	            {
	                 
	                if($i===0) // looping awal
	                {
	                    $this->db->group_start(); 
	                    $this->db->like($item, $_POST['search']['value']);
	                }
	                else
	                {
	                    $this->db->or_like($item, $_POST['search']['value']);
	                }
	 
	                if(count($this->column_search) - 1 == $i) 
	                    $this->db->group_end(); 
	            }
	            $i++;
	        }
	         
	        if(isset($_POST['order'])) 
	        {
	            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	        } 
	        else if(isset($this->order))
	        {
	            $order = $this->order;
	            $this->db->order_by(key($order), $order[key($order)]);
	        }
	    }
	 
	    function get_all_user_kemendagri()
	    {
	        $this->_get_all_user_kemendagri_query();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }

	 
	    function count_filtered_user_kemendagri()
	    {
	        $this->_get_all_user_kemendagri_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function count_all_user_kemendagri()
	    {
	    	$this->db->where('apps_modul','KEMENDAGRI');
	    	$this->db->where_in('type',array(1,2,3,6));
	        $this->db->from($this->table);
	        return $this->db->count_all_results();
	    }

		// GET USER TLHP PEMDA
		private function _get_all_user_pemda_query()
	    {
	    //	$this->db->where('apps_modul','PEMDA');
	    //	$this->db->where_in('type',array(1,2,4,6));
	    //	$this->db->join('ms_group','ms_akses_group.id_akses = a.id_group');
	    //	$this->db->join('ms_group','ms_akses_group.id_akses = a.id_group');
			 
			 $this->db->join('ms_group','ms_group.id_group = a.id_group');
			//$this->db->select('*');
			$this->db->from($this->table);
			
	       
			
	        $i = 0;
	     
	        foreach ($this->column_search as $item) // looping awal
	        {
	            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
	            {
	                 
	                if($i===0) // looping awal
	                {
	                    $this->db->group_start(); 
	                    $this->db->like($item, $_POST['search']['value']);
	                }
	                else
	                {
	                    $this->db->or_like($item, $_POST['search']['value']);
	                }
	 
	                if(count($this->column_search) - 1 == $i) 
	                    $this->db->group_end(); 
	            }
	            $i++;
	        }
	         
	        if(isset($_POST['order'])) 
	        {
	            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	        } 
	        else if(isset($this->order))
	        {
	            $order = $this->order;
	            $this->db->order_by(key($order), $order[key($order)]);
	        }
	    }
	 
	    function get_all_user_pemda()
	    {
	        $this->_get_all_user_pemda_query();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }

	 
	    function count_filtered_user_pemda()
	    {
	        $this->_get_all_user_pemda_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function count_all_user_pemda()
	    {
	    	//$this->db->where('apps_modul','PEMDA');
	    	//$this->db->where_in('type',array(1,2,4,6));
	        $this->db->from($this->table);
	        return $this->db->count_all_results();
	    }

		private function _get_all_user_query()
	    {
	    	//$this->db->join('ms_akses_group','ms_akses_group.id_akses = a.id_group');
			$this->db->select('*');
	        $this->db->from($this->table);
			
	        $i = 0;
	     
	        foreach ($this->column_search as $item) // looping awal
	        {
	            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
	            {
	                 
	                if($i===0) // looping awal
	                {
	                    $this->db->group_start(); 
	                    $this->db->like($item, $_POST['search']['value']);
	                }
	                else
	                {
	                    $this->db->or_like($item, $_POST['search']['value']);
	                }
	 
	                if(count($this->column_search) - 1 == $i) 
	                    $this->db->group_end(); 
	            }
	            $i++;
	        }
	         
	        if(isset($_POST['order'])) 
	        {
	            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	        } 
	        else if(isset($this->order))
	        {
	            $order = $this->order;
	            $this->db->order_by(key($order), $order[key($order)]);
	        }
	    }
	 
	    function get_all_user()
	    {
	        $this->_get_all_user_query();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }

	 
	    function count_filtered_user()
	    {
	        $this->_get_all_user_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function count_all_user()
	    {
	    	
	        $this->db->from($this->table);
	        return $this->db->count_all_results();
	    }


		public function get_useronline(){
			$query = $this->db->get_where('ms_user', array('st_login' => '1'));
			return $result = $query->result_array();
		}

		public function get_user_by_id($id){
			$query = $this->db->get_where('ms_user', array('id_user' => $id));
			return $result = $query->row_array();
		}

		public function edit_user($data, $where){
			$this->db->where($where);
			$this->db->update('ms_user', $data);

			return true;
		}

		public function get_kab_by_id($id){

			$query = $this->db->get_where('sys_group', array('id_group' => $id));
			
			$data = array();
			$hasil = "";

			// SETTING TAHUN ANGGARAN
			// $this->db->select('thn_ang');
			// $querysysclient = $this->db->get('utilitas.sys_sclient');
			// $rowsysclient = $querysysclient->row();
			// if (isset($rowsysclient))
			// {
				$data['thn_ang'] = date('Y');
			// }

			$totalRecord = $query->num_rows();
			
			$i = 0;
			foreach ($query->result() as $row)
			{
				$i++;
				if ($i < $totalRecord)
				{
					$hasil .= $row->id_menu . ',';				
				} else 
				{
					$hasil .= $row->id_menu;				
				}
			}
			$data['nm_group'] = $row->nm_group;
			$data['menu_permission'] = $hasil;


			return $result = $data;

		}

		public function get_menu_ekapip($id){

			$query = $this->db->get_where('sys_group', array('id_group' => $id));
			
			$data = array();
			$hasil = "";

			// SETTING TAHUN ANGGARAN
			// $this->db->select('thn_ang');
			// $querysysclient = $this->db->get('utilitas.sys_sclient');
			// $rowsysclient = $querysysclient->row();
			// if (isset($rowsysclient))
			// {
				$data['thn_ang'] = date('Y');
			// }

			$totalRecord = $query->num_rows();
			
			$i = 0;
			foreach ($query->result() as $row)
			{
				$i++;
				if ($i < $totalRecord)
				{
					$hasil .= $row->id_menu . ',';				
				} else 
				{
					$hasil .= $row->id_menu;				
				}
			}
			$data['nm_group'] = $row->nm_group;
			$data['menu_permission'] = $hasil;


			return $result = $data;

		}
		

		public function get_kab_by_id_tlhp($id){

			// $query = $this->db->get_where('sys_group', array('id_group' => $id,'left(id_menu,1)' => ''));
			$query = $this->db->query('SELECT * from sys_group where id_group = '.$id.' and (left(id_menu,1) =5 or id_menu in (1,2));');
			
			$data = array();
			$hasil = "";

			// SETTING TAHUN ANGGARAN
			// $this->db->select('thn_ang');
			// $querysysclient = $this->db->get('utilitas.sys_sclient');
			// $rowsysclient = $querysysclient->row();
			// if (isset($rowsysclient))
			// {
				$data['thn_ang'] = date('Y');
			// }

			$totalRecord = $query->num_rows();
			
			$i = 0;
			foreach ($query->result() as $row)
			{
				$i++;
				if ($i < $totalRecord)
				{
					$hasil .= $row->id_menu . ',';				
				} else 
				{
					$hasil .= $row->id_menu;				
				}
			}
			$data['nm_group'] = $row->nm_group;
			$data['menu_permission'] = $hasil;


			return $result = $data;

		}

		public function get_menu_pemda($id){

			// $query = $this->db->get_where('sys_group', array('id_group' => $id,'left(id_menu,1)' => ''));

			$query = $this->db->query('SELECT * from sys_group_tlhp_pemda where id_group = '.$id.';');
			
			$data = array();
			$hasil = "";

			// SETTING TAHUN ANGGARAN
			// $this->db->select('thn_ang');
			// $querysysclient = $this->db->get('utilitas.sys_sclient');
			// $rowsysclient = $querysysclient->row();
			// if (isset($rowsysclient))
			// {
				$data['thn_ang'] = date('Y');
			// }

			$totalRecord = $query->num_rows();
			
			$i = 0;
			foreach ($query->result() as $row)
			{
				$i++;
				if ($i < $totalRecord)
				{
					$hasil .= $row->id_menu . ',';				
				} else 
				{
					$hasil .= $row->id_menu;				
				}
			}
			$data['nm_group'] = $row->nm_group;
			$data['menu_permission'] = $hasil;


			return $result = $data;

		}

		public function get_menu_bpk($id){

			// $query = $this->db->get_where('sys_group', array('id_group' => $id,'left(id_menu,1)' => ''));

			$query = $this->db->query('SELECT * from sys_group_tlhp_bpk where id_group = '.$id.';');
			
			$data = array();
			$hasil = "";
			// 2 5 10 501 1001 50100 50101 50102 50103 50104 50109 50203
			// SETTING TAHUN ANGGARAN
			// $this->db->select('thn_ang');
			// $querysysclient = $this->db->get('utilitas.sys_sclient');
			// $rowsysclient = $querysysclient->row();
			// if (isset($rowsysclient))
			// {
				$data['thn_ang'] = date('Y');
			// }

			$totalRecord = $query->num_rows();
			
			$i = 0;
			foreach ($query->result() as $row)
			{
				$i++;
				if ($i < $totalRecord)
				{
					$hasil .= $row->id_menu . ',';				
				} else 
				{
					$hasil .= $row->id_menu;				
				}
			}
			$data['nm_group'] = $row->nm_group;
			$data['menu_permission'] = $hasil;


			return $result = $data;

		}

		public function get_menu_kemendagri($id){

			// $query = $this->db->get_where('sys_group', array('id_group' => $id,'left(id_menu,1)' => ''));
			$query = $this->db->query('SELECT * from sys_group_tlhp_kemendagri where id_group = '.$id.';');
			
			$data = array();
			$hasil = "";

			// SETTING TAHUN ANGGARAN
			// $this->db->select('thn_ang');
			// $querysysclient = $this->db->get('utilitas.sys_sclient');
			// $rowsysclient = $querysysclient->row();
			// if (isset($rowsysclient))
			// {
				$data['thn_ang'] = date('Y');
			// }

			$totalRecord = $query->num_rows();
			
			$i = 0;
			foreach ($query->result() as $row)
			{
				$i++;
				if ($i < $totalRecord)
				{
					$hasil .= $row->id_menu . ',';				
				} else 
				{
					$hasil .= $row->id_menu;				
				}
			}
			$data['nm_group'] = $row->nm_group;
			$data['menu_permission'] = $hasil;


			return $result = $data;

		}

		public function get_access($id){

			$query = $this->db->get_where('ms_akses_group', array('id_akses' => $id));
			
			return $result = $query->row();

		}

		public function get_pemda_inspektorat($ins)
		{
			$query = 'SELECT pemda FROM ms_inspektorat where id_inspektorat = "'.$ins.'"';
	    	$sql = $this->db->query($query)->result();

	    	foreach ($sql as $value) {
	    		$arrayDaerah = $value->pemda;
	    	}
	    	$where = " ";
	    	if($arrayDaerah <> ''){
	    		$where = " and id_daerah in (".$arrayDaerah.") ";
	    	}
	    	$queryDaerah = "SELECT * FROM ms_daerah where clevel = 1 ".$where." order by id_daerah asc";
			
			$result = $this->db->query($queryDaerah)->result_array();
			
			$html = '';
			$html .='<option value="0">--Pilih Provinsi--</option>';
			foreach($result as $row){
				$html .='<option value="'.$row['id_daerah'].'">'.$row['id_daerah'].' || '.$row['nm_daerah'].'</option>';
			}
			return $html;
		}

		public function get_kemendagri_inspektorat($ins)
		{
			$query = 'SELECT kemendagri FROM ms_inspektorat where id_inspektorat = "'.$ins.'"';
	    	$sql = $this->db->query($query)->result();
	    	foreach ($sql as $value) {
	    		$arrayDaerah = $value->kemendagri;
	    	}
	    	$where = " ";
	    	if($arrayDaerah <> ''){
	    		$where = " and id_instansi in (".$arrayDaerah.") ";
	    	}
	    	$queryDaerah = "SELECT * FROM ms_instansi_kemendagri where 1 = 1 ".$where." order by id_instansi asc";
			
			$result = $this->db->query($queryDaerah)->result_array();
			
			$html = '';
			$html .='<option value="0">--Pilih Instansi--</option>';
			foreach($result as $row){
				$html .='<option value="'.$row['id_instansi'].'">'.$row['id_instansi'].' || '.$row['nm_instansi'].'</option>';
			}
			return $html;
		}

		public function getprov()
		{
			
			$akses = $this->session->userdata('is_admin');
			if($akses == 1){
				$this->db->select('*');
				$this->db->from('ms_daerah');
				$this->db->where('clevel', 1);
				$this->db->order_by('id_daerah', 'asc');
				$query = $this->db->get();
				$result = $query->result_array();
			}else if($akses == 2){
				$daerah = $this->session->userdata('id_pemda');
				$sqlDaerah = "SELECT * FROM ms_daerah where id_daerah in (".$daerah.") order by id_daerah";	
				$result = $this->db->query($sqlDaerah)->result_array();
			}else if($akses == 4){
				$id_prov = $this->session->userdata('id_prov');
				$sqlDaerah = "SELECT * FROM ms_daerah where id_daerah in (".$id_prov.") order by id_daerah";	
				$result = $this->db->query($sqlDaerah)->result_array();
			}else if($akses == 5){
				$id_prov = $this->session->userdata('id_prov');
				$sqlDaerah = "SELECT * FROM ms_daerah where id_daerah in (".$id_prov.") order by id_daerah";	
				$result = $this->db->query($sqlDaerah)->result_array();
			}else if($akses == 6){
				$apip = $this->session->userdata('id_ins');
				$sql = "SELECT * FROM ms_inspektorat where id_inspektorat = ".$apip;	
				$daerah = $this->db->query($sql)->row()->pemda;
				$sqlDaerah = "SELECT * FROM ms_daerah where id_daerah in (".$daerah.") order by id_daerah";	
				$result = $this->db->query($sqlDaerah)->result_array();
			}

			
			
			$html = '';
			$html .='<option value=""></option>';
			$i = 0;
			foreach($result as $row){
				if ($i == 0 && count($result) > 1) {
					$html .='<option selected value="'.$row['id_daerah'].'">'.$row['id_daerah'].' || '.$row['nm_daerah'].'</option>';
				}else{
					$html .='<option value="'.$row['id_daerah'].'">'.$row['id_daerah'].' || '.$row['nm_daerah'].'</option>';	
				}
				$i++;
			}
			return $html;
		}

		public function getprovfront()
		{
			$akses = 1;
			if($akses == 1){
				$this->db->select('*');
				$this->db->from('ms_daerah');
				$this->db->where('clevel', 1);
				$this->db->order_by('id_daerah', 'asc');
				$query = $this->db->get();
				$result = $query->result_array();
			}else if($akses == 2){
				$apip = $this->session->userdata('id_prov');
				$sql = "SELECT * FROM ms_inspektorat where id_inspektorat = ".$apip;	
				$daerah = $this->db->query($sql)->row()->pemda;
				$sqlDaerah = "SELECT * FROM ms_daerah where id_daerah in (".$daerah.") order by id_daerah";	
				$result = $this->db->query($sqlDaerah)->result_array();
			}else if($akses == 4){
				$id_prov = $this->session->userdata('id_prov');
				
				$sqlDaerah = "SELECT * FROM ms_daerah where id_daerah in (".$id_prov.") order by id_daerah";	
				$result = $this->db->query($sqlDaerah)->result_array();
			}else if($akses == 5){
				$id_prov = $this->session->userdata('id_prov');
				$sqlDaerah = "SELECT * FROM ms_daerah where id_daerah in (".$id_prov.") order by id_daerah";	
				$result = $this->db->query($sqlDaerah)->result_array();
			}

			
			
			$html = '';
			$html .='<option value=""></option>';
			$i = 0;
			foreach($result as $row){
				if ($i == 0 && count($result) > 1) {
					$html .='<option selected value="'.$row['id_daerah'].'">'.$row['id_daerah'].' || '.$row['nm_daerah'].'</option>';
				}else{
					$html .='<option value="'.$row['id_daerah'].'">'.$row['id_daerah'].' || '.$row['nm_daerah'].'</option>';	
				}
				$i++;
			}
			return $html;
		}

		public function getaksesgroup()
		{
			/* $apps_modul = $this->session->userdata('apps_modul');
			if ($apps_modul == 'PEMDA') {
				$this->db->where('tlhp_ij_pemda',1);
			}elseif($apps_modul == 'KEMENDAGRI'){
				$this->db->where('tlhp_ij_kemendagri',1);
			}elseif($apps_modul == 'BPK'){
				$this->db->where('tlhp_bpk',1);
			} */
			
			$this->db->select('*');
			//$this->db->from('ms_akses_group');
			$this->db->from('ms_group');
			$query = $this->db->get();
			$result = $query->result_array();
			
			$html = '';
			$html .='<option value=""></option>';
			foreach($result as $row){
				//$html .='<option value="'.$row['id_akses'].'">'.$row['id_akses'].' || '.$row['uraian'].'</option>';
				$html .='<option value="'.$row['id_group'].'">'.$row['id_group'].' || '.$row['nm_group'].'</option>';
			}
			return $html;
		}


		public function getinspektorat()
		{
			$this->db->select('*');
			$this->db->from('ms_inspektorat');
			$query = $this->db->get();
			$result = $query->result_array();
			
			$html = '';
			$html .='<option value=""></option>';
			foreach($result as $row){
				$html .='<option value="'.$row['id_inspektorat'].'">'.$row['id_inspektorat'].' || '.$row['uraian'].'</option>';
			}
			return $html;
		}

		public function getinspektoratlhp($prov='1')
		{
			$this->db->select('*');
			$this->db->like('pemda', $prov);
			$this->db->from('ms_inspektorat');
			$query = $this->db->get();
			$result = $query->result();
			
			
			return $result;
		}

		public function getinspektoratlhpKemendagri($prov='1')
		{
			$this->db->select('*');
			$this->db->like('kemendagri', $prov);
			$this->db->from('ms_inspektorat');
			$query = $this->db->get();
			$result = $query->result();
			
			
			return $result;
		}

		public function getinstansi()
		{


			$this->db->select('*');
			$this->db->from('ms_apip');
			$this->db->order_by('kd_apip', 'asc');
			$query = $this->db->get();
			$result = $query->result_array();
			
			$html = '';
			$html .='<option value=""></option>';
			foreach($result as $row){
				$html .='<option value="'.$row['kd_apip'].'">'.$row['nm_apip'].'</option>';
			}
			return $html;
		}

		/* public function getkab($kode)
		{
			$akses = $this->session->userdata('is_admin');
			
			$this->db->select('*');
			$this->db->from('ms_daerah');
			if($akses == 5){
				$id_kab = $this->session->userdata('id_kab');
				$this->db->where('id_daerah', $id_kab);
			}else{
				$this->db->where('hd_daerah', $kode);
			}

			$query = $this->db->get();
			$result = $query->result_array();
			
			$html = '';
			$html .='<option value=""></option>';
			foreach($result as $row){
				$html .='<option value="'.$row['id_daerah'].'">'.$row['id_daerah'].' || '.$row['nm_daerah'].'</option>';
			}
			return $html;
		} */

		public function get_username($header = '',$role = ''){
			if ($role == 'prov') {
				$query = 'select max(username) as get_usrnm from ms_user where left(username,2) = "'.$header.'"';
			}else if($role == 'kab'){
				$query = 'select max(username) as get_usrnm from ms_user where left(username,4) = "'.$header.'"';
			}else{
				$query = 'select max(username) as get_usrnm from ms_user where left(username,4) = "'.$header.'"';
			}
			$result = $this->db->query($query)->row()->get_usrnm;
			$new = '00';
			if ($result == 0 || $result == '') {
				$result = $header.$new;
			}
			$max = $result+1;
			

			return $max;
		}

	}

?>