<?php
	class Notifikasi_model extends CI_Model{

		var $table = 'thistory'; //nama tabel dari database
	//	var $tablePemda = 'tr_history_tlhp_pemda'; //nama tabel dari database
	//	var $tableKemendagri = 'tr_history_tlhp_kemendagri'; //nama tabel dari database
	    var $column_order = array(null,'thistory.uraian'); //field yang ada di table 
	    var $column_search = array('thistory.uraian'); //field yang diizin untuk pencarian 
	    var $order = array('thistory.user_date' => 'desc'); // default order 

		public function add_instansi($data){
			$this->db->insert('ms_manual', $data);
			return true;
		}

		private function _get_all_notification_query()
	    {
	    	$akses   = $this->session->userdata('is_admin');
	    	$user_id   = $this->session->userdata('user_id');
			$instansi   = $this->session->userdata('id_instansi');
        	$tahun   = $this->session->userdata('year_selected');
			
        //	$aksiPemda[] = array('INSERT','UPDATE','DELETE','VERIF','VALID');

       
			/* 
			elseif($akses == 2){
        		if ($apps == 'PEMDA') {
        			$daerah      = $this->session->userdata('id_pemda');
                	$arrayDaerah = explode(', ',$daerah); 

        			$this->db->where_in('tr_history_tlhp_pemda.instansi',$arrayDaerah);
        			$this->db->where('LEFT(tr_history_tlhp_pemda.noreg,4)',$tahunSes);
        			$this->db->where('tr_history_tlhp_pemda.user_id<>',$user_id);
        		}elseif ($apps == 'KEMENDAGRI') {
        			$daerah      = $this->session->userdata('id_kemendagri');
                	$arrayDaerah = explode(', ',$daerah); 
                	$this->db->where_in('tr_history_tlhp_kemendagri.aksi',array('UPLOAD','VALID'));
        			$this->db->where_in('tr_history_tlhp_kemendagri.instansi',$arrayDaerah);
        			$this->db->where('LEFT(tr_history_tlhp_kemendagri.noreg,4)',$tahunSes);
        			$this->db->where('tr_history_tlhp_kemendagri.user_id<>',$user_id);
        		}else{
        			$daerah      = $this->session->userdata('id_kemendagri');
                	$arrayDaerah = explode(', ',$daerah); 
                	$this->db->where_in('tr_history_tlhp.instansi',$arrayDaerah);
                	$this->db->where('LEFT(tr_history_tlhp.noreg,4)',$tahunSes);
                	$this->db->where('tr_history_tlhp.user_id<>',$user_id);
        		}
        	}elseif ($akses == 3 || $akses == 4 || $akses == 5) {
                	$arrayPem = explode(',',$aksiPemda); 
        			$this->db->where('instansi',$id);
        			$this->db->where('LEFT(noreg,4)',$tahunSes);
        			$this->db->where_in('aksi',$arrayPem);
        	}elseif ($akses == 6) {
        		$id      = $this->session->userdata('id_ins');  
            	$sql = "SELECT * FROM ms_inspektorat where id_inspektorat = ".$id; 

            	if ($apps == 'PEMDA') {
	                $daerah = $this->db->query($sql)->row()->pemda;

	            }else{
	                $daerah = $this->db->query($sql)->row()->kemendagri;
	            }
	                $arrayDaerah = explode(',',$daerah); 
	                $this->db->where_in('aksi',array('UPLOAD','VERIF'));
	                $this->db->where_in('instansi',$arrayDaerah);
	                $this->db->where('user_id<>',$user_id);
	                $this->db->where('menu',$apps);
	                $this->db->where('LEFT(noreg,4)',$tahunSes);

        	} */

			
				//$this->db->where('thistory.menu',$apps);
				
				
	

        	//if ($apps == 'PEMDA') {
        		//$this->db->where('thistory.menu',$apps);
	        	//$this->db->from($this->tablePemda);
        	/* }elseif ($apps == 'KEMENDAGRI') {
        		$this->db->where('tr_history_tlhp_kemendagri.menu',$apps);
	        	$this->db->from($this->tableKemendagri);
        	}else{
        		$this->db->where('tr_history_tlhp.menu',$apps);
        		$this->db->from($this->table);
        	}
 */
	
			

			if ($akses==1) {
	
				$this->db->from('thistory'); 
				$this->db->join('ms_user', 'ms_user.id_user=thistory.user_id');
				$this->db->where('thistory.user_type <> ',$user_id);
				$this->db->where('ms_user.is_admin <> ',$akses);
				$this->db->where('thistory.tampil = ',1);
				$this->db->where('thistory.kd_apip = ',$instansi);
				$this->db->where('thistory.tahun = ',$tahun);	
				//$this->db->order_by('a.user_date','desc'); 

			}else{
				
				
				
				
		 	$this->db->from('thistory');
				$this->db->join('ms_group_menu_elemen', 'thistory.tahun = ms_group_menu_elemen.tahun and thistory.kd_apip=ms_group_menu_elemen.kd_apip and thistory.kd_elemen=ms_group_menu_elemen.kd_elemen and thistory.kd_topik=ms_group_menu_elemen.kd_topik');
				$this->db->where('ms_group_menu_elemen.id_group = ',$akses);	
				$this->db->where('thistory.kd_apip = ',$instansi);	
				$this->db->where('thistory.tahun = ',$tahun);	
				$this->db->where('thistory.jenis = ',2);	
				
				$query1 = $this->db->get_compiled_select();
			
				
				
			}			
 

				
			
			
	/* 		
	if ($akses == 1) {
				$csql = "SELECT z.id,z.aksi,z.tahun,z.kd_apip,IFNULL(z.kd_elemen,'')kd_elemen,IFNULL(z.kd_topik,'')kd_topik,IFNULL(z.kd_level,'')kd_level,
						IFNULL(z.kd_penilaian,'')kd_penilaian,z.uraian,
						z.user_id,z.user_type,z.user_date,z.status,z.kd_file,z.routes,z.jenis,z.tampil,z.nilai,IFNULL(z.keterangan,'')keterangan,
						CASE WHEN z.jenis=2 || z.jenis=3  THEN (SELECT nm_elemen FROM ms_elemen WHERE kd_elemen=z.kd_elemen)
						ELSE
						''
						END AS nm_elemen,
						CASE WHEN z.jenis=2 || z.jenis=3  THEN (SELECT nm_topik FROM ttopik WHERE tahun=z.tahun AND kd_apip=z.kd_apip AND kd_elemen=z.kd_elemen AND kd_topik=z.kd_topik)
						ELSE
						''
						END AS nm_topik,
						CASE WHEN  z.jenis=3  THEN (SELECT uraian FROM tpenilaian WHERE tahun=z.tahun AND kd_apip=z.kd_apip AND kd_elemen=z.kd_elemen AND kd_topik=z.kd_topik and kd_penilaian=z.kd_penilaian)
							ELSE
							''
							END AS nm_penilaian
						FROM(
							SELECT a.* FROM thistory a inner join ms_user b on a.user_id=b.id_user WHERE (a.user_type <> 1 and b.is_admin<>1) AND a.status = 'BELUM DIBACA'  
						    and a.tampil=1 and a.kd_apip='".$id_instansi."' and a.tahun='".$tahun."')z ORDER BY user_date desc";
			//$query  = 
			$this->ci->db->query($csql);
		}else{

				$csql  = "SELECT z.id,z.aksi,z.tahun,z.kd_apip,IFNULL(z.kd_elemen,'')kd_elemen,IFNULL(z.kd_topik,'')kd_topik,IFNULL(z.kd_level,'')kd_level,
							IFNULL(z.kd_penilaian,'')kd_penilaian,z.uraian,
							z.user_id,z.user_type,z.user_date,z.status,z.kd_file,z.routes,z.jenis,z.tampil,z.nilai,IFNULL(z.keterangan,'')keterangan,
							CASE WHEN z.jenis=2 || z.jenis=3  THEN (SELECT nm_elemen FROM ms_elemen WHERE kd_elemen=z.kd_elemen)
							ELSE
							''
							END AS nm_elemen,
							CASE WHEN z.jenis=2 || z.jenis=3  THEN (SELECT nm_topik FROM ttopik WHERE tahun=z.tahun AND kd_apip=z.kd_apip AND kd_elemen=z.kd_elemen AND kd_topik=z.kd_topik)
							ELSE
							''
							END AS nm_topik,							
							CASE WHEN  z.jenis=3  THEN (SELECT uraian FROM tpenilaian WHERE tahun=z.tahun AND kd_apip=z.kd_apip AND kd_elemen=z.kd_elemen AND kd_topik=z.kd_topik and kd_penilaian=z.kd_penilaian and kd_level=z.kd_level)
							ELSE
							''
							END AS nm_penilaian
							FROM(
							   SELECT a.*FROM thistory a
								INNER JOIN ms_group_menu_elemen b ON a.tahun=b.tahun AND a.kd_apip=b.kd_apip AND a.kd_elemen=b.kd_elemen AND a.kd_topik=b.kd_topik
								WHERE b.id_group='".$akses."' and a.kd_apip='".$id_instansi."' and a.tahun='".$tahun."' and a.jenis=2 
								
							 union
								 SELECT a.*FROM thistory a
								 INNER JOIN ms_group_menu_elemen b ON a.tahun=b.tahun AND a.kd_apip=b.kd_apip AND a.kd_elemen=b.kd_elemen AND a.kd_topik=b.kd_topik
								 WHERE b.id_group='".$akses."'  and a.kd_apip='".$id_instansi."' and a.tahun='".$tahun."' and a.jenis=3
							union
								SELECT * FROM thistory WHERE thistory.user_type = 1 
								and tampil=1 and kd_apip='".$id_instansi."' and tahun='".$tahun."' and jenis=4
							union
								 SELECT a.*FROM thistory a
								 INNER JOIN ms_group_menu_elemen b ON a.tahun=b.tahun AND a.kd_apip=b.kd_apip
								 WHERE b.id_group='".$akses."'  and a.kd_apip='".$id_instansi."' and a.tahun='".$tahun."' and a.jenis=5	and user_id<>'".$user_id."'								
							
							)z  ORDER BY user_date desc";					   
			
					   
			//$query  = 
			$this->ci->db->query($csql);	
		} */				
			
			
			
			
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
	 
	    function get_all_notification()
	    {
	        $this->_get_all_notification_query();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        
	        
	        return $query->result();
	    }
	 
	    function count_filtered_notification()
	    {
	        $this->_get_all_notification_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	     function count_all_notification()
	    {
	      //  $this->db->from($this->table);
	       
			
			$akses   = $this->session->userdata('is_admin');
	    	$user_id   = $this->session->userdata('user_id');
			$instansi   = $this->session->userdata('id_instansi');
        	$tahun   = $this->session->userdata('year_selected');
			
			
			$this->db->from('thistory'); 
			$this->db->join('ms_user', 'ms_user.id_user=thistory.user_id', 'left');
			$this->db->where('thistory.user_type <> ', $user_id);
			$this->db->where('ms_user.is_admin <> ',$akses);
			$this->db->where('thistory.tampil = ',1);
			$this->db->where('thistory.kd_apip = ',$instansi);
			$this->db->where('thistory.tahun = ',$tahun);		
			
			


		   return $this->db->count_all_results();
	    }


/* 	    private function _get_all_kab_query()
	    {
	    	$this->db->where('clevel',2);
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
	 
	    function get_all_kab()
	    {
	        $this->_get_all_kab_query();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	  */
	    /* function count_filtered_kab()
	    {
	        $this->_get_all_kab_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function count_all_kab()
	    {
	    	$this->db->where('clevel',2);
	        $this->db->from($this->table);
	        return $this->db->count_all_results();
	    } */


/* 		public function get_max_daerah($lvl,$header = ''){
			$this->db->select_max('id_daerah');
			$this->db->where('clevel', $lvl);
			if ($lvl != 1) {
				$this->db->where('hd_daerah', $header);
			}
			$new = array('','00','00','00','2000');
			$this->db->from('ms_instansi_kemendagri');
			$query = $this->db->get();
			$result = $query->row()->id_daerah;
			if ($result == 0 || $result == '') {
				$result = $header.$new[$lvl];
			}
			$max = $result+1;

			return $max;
		} */

	/* 	public function get_all_rek90(){
			$this->db->select('*');
			$this->db->where('left(id_rek90,2)', '52');
			$this->db->where('clevel', '5');
			$this->db->from('ms_rek90');
			$query = $this->db->get();
			return $result = $query->result_array();
		} */

		/* public function get_lokasi_by_id($id){
			if(strlen($id) == 2){
				$csql = "SELECT *,(SELECT nm_lokasi FROM ms_instansi_kemendagri WHERE id_daerah = l.id_daerah) as prov,
				'' as kab,
				'' as kec,
				'' as des
				 FROM ms_instansi_kemendagri l WHERE id_daerah = '".$id."';";
			}elseif (strlen($id) == 4) {
				$csql = "SELECT *,(SELECT nm_lokasi FROM ms_instansi_kemendagri WHERE id_daerah = LEFT(l.hd_lokasi,2)) as prov,
				(SELECT nm_lokasi FROM ms_instansi_kemendagri WHERE id_daerah = l.id_daerah) as kab,
				'' as kec,
				'' as des
				 FROM ms_instansi_kemendagri l WHERE id_daerah = '".$id."';";
			}elseif (strlen($id) == 6) {
				$csql = "SELECT *,(SELECT nm_lokasi FROM ms_instansi_kemendagri WHERE id_daerah = LEFT(l.hd_lokasi,2)) as prov,
				(SELECT nm_lokasi FROM ms_instansi_kemendagri WHERE id_daerah = LEFT(l.hd_lokasi,4)) as kab,
				(SELECT nm_lokasi FROM ms_instansi_kemendagri WHERE id_daerah = l.id_daerah) as kec,
				'' as des
				 FROM ms_instansi_kemendagri l WHERE id_daerah = '".$id."';";
			}elseif (strlen($id) == 10) {
				$csql = "SELECT *,(SELECT nm_lokasi FROM ms_instansi_kemendagri WHERE id_daerah = LEFT(l.hd_lokasi,2)) as prov,
				(SELECT nm_lokasi FROM ms_instansi_kemendagri WHERE id_daerah = LEFT(l.hd_lokasi,4)) as kab,
				(SELECT nm_lokasi FROM ms_instansi_kemendagri WHERE id_daerah = LEFT(l.hd_lokasi,7)) as kec,
				(SELECT nm_lokasi FROM ms_instansi_kemendagri WHERE id_daerah = l.id_daerah) as des
				 FROM ms_instansi_kemendagri l WHERE id_daerah = '".$id."';";
			}
			$query = $this->db->query($csql);
			return $result = $query->row_array();
		} */

	/* 	public function edit_daerah($data, $id){
			$this->db->where('id_daerah', $id);
			$this->db->update('ms_instansi_kemendagri', $data);
			return true;
		}

		public function getprov()
		{
			$this->db->select('*');
			$this->db->from('ms_instansi_kemendagri');
			$this->db->where('clevel', 1);
			$this->db->order_by('id_daerah', 'asc');
			$query = $this->db->get();
			$result = $query->result_array();
			
			$html = '';
			$html .='<option value="">--Pilih Provinsi--</option>';
			foreach($result as $row){
				$html .='<option value="'.$row['id_daerah'].'">'.$row['id_daerah'].' || '.$row['nm_daerah'].'</option>';
			}
			return $html;
		}

		public function getkab($kode)
		{
			$this->db->select('*');
			$this->db->from('ms_instansi_kemendagri');
			$this->db->where('hd_prov', $kode);
			$query = $this->db->get();
			$result = $query->result_array();
			
			$html = '';
			$html .='<option value="">--Pilih Kabupaten--</option>';
			foreach($result as $row){
				$html .='<option value="'.$row['id_daerah'].'">'.$row['id_daerah'].' || '.$row['nm_daerah'].'</option>';
			}
			return $html;
		}

		public function getkec($kode)
		{
			$this->db->select('*');
			$this->db->from('ms_instansi_kemendagri');
			$this->db->where('hd_daerah', $kode);
			$query = $this->db->get();
			$result = $query->result_array();
			
			$html = '';
			$html .='<option value="">--Pilih Kecamatan--</option>';
			foreach($result as $row){
				$html .='<option value="'.$row['id_daerah'].'">'.$row['id_daerah'].' || '.$row['nm_daerah'].'</option>';
			}
			return $html;
		} */

		
		
		public function viewNotifikasi()
		{
			$akses   = $this->session->userdata('is_admin');
	    	$user_id   = $this->session->userdata('user_id');
			$instansi   = $this->session->userdata('id_instansi');
        	$tahun   = $this->session->userdata('year_selected');
				
		if ($akses == 1) {
				$query = "SELECT z.id,z.aksi,z.tahun,z.kd_apip,IFNULL(z.kd_elemen,'')kd_elemen,IFNULL(z.kd_topik,'')kd_topik,IFNULL(z.kd_level,'')kd_level,
						IFNULL(z.kd_penilaian,'')kd_penilaian,z.uraian,
						z.user_id,z.user_type,z.user_date,z.status,z.kd_file,z.routes,z.jenis,z.tampil,z.nilai,IFNULL(z.keterangan,'')keterangan,
						CASE WHEN z.jenis=2 || z.jenis=3  THEN (SELECT nm_elemen FROM ms_elemen WHERE kd_elemen=z.kd_elemen)
						ELSE
						''
						END AS nm_elemen,
						CASE WHEN z.jenis=2 || z.jenis=3  THEN (SELECT nm_topik FROM ttopik WHERE tahun=z.tahun AND kd_apip=z.kd_apip AND kd_elemen=z.kd_elemen AND kd_topik=z.kd_topik)
						ELSE
						''
						END AS nm_topik,
						CASE WHEN  z.jenis=3  THEN (SELECT uraian FROM tpenilaian WHERE tahun=z.tahun AND kd_apip=z.kd_apip AND kd_elemen=z.kd_elemen AND kd_topik=z.kd_topik and kd_penilaian=z.kd_penilaian)
							ELSE
							''
							END AS nm_penilaian,ifnull(user_date,'')user_date
						FROM(
							SELECT a.* FROM thistory a inner join ms_user b on a.user_id=b.id_user WHERE (a.user_type <> 1 and b.is_admin<>1) 
						    and a.tampil=1 and a.kd_apip='".$instansi."' and a.tahun='".$tahun."')z ORDER BY user_date desc";
	
		}else{

				$query  = "SELECT z.id,z.aksi,z.tahun,z.kd_apip,IFNULL(z.kd_elemen,'')kd_elemen,IFNULL(z.kd_topik,'')kd_topik,IFNULL(z.kd_level,'')kd_level,
							IFNULL(z.kd_penilaian,'')kd_penilaian,z.uraian,
							z.user_id,z.user_type,z.user_date,z.status,z.kd_file,z.routes,z.jenis,z.tampil,z.nilai,IFNULL(z.keterangan,'')keterangan,
							CASE WHEN z.jenis=2 || z.jenis=3  THEN (SELECT nm_elemen FROM ms_elemen WHERE kd_elemen=z.kd_elemen)
							ELSE
							''
							END AS nm_elemen,
							CASE WHEN z.jenis=2 || z.jenis=3  THEN (SELECT nm_topik FROM ttopik WHERE tahun=z.tahun AND kd_apip=z.kd_apip AND kd_elemen=z.kd_elemen AND kd_topik=z.kd_topik)
							ELSE
							''
							END AS nm_topik,							
							CASE WHEN  z.jenis=3  THEN (SELECT uraian FROM tpenilaian WHERE tahun=z.tahun AND kd_apip=z.kd_apip AND kd_elemen=z.kd_elemen AND kd_topik=z.kd_topik and kd_penilaian=z.kd_penilaian and kd_level=z.kd_level)
							ELSE
							''
							END AS nm_penilaian,ifnull(user_date,'')user_date
							FROM(
							   SELECT a.*FROM thistory a
								INNER JOIN ms_group_menu_elemen b ON a.tahun=b.tahun AND a.kd_apip=b.kd_apip AND a.kd_elemen=b.kd_elemen AND a.kd_topik=b.kd_topik and a.id_penerima=b.id_group
								WHERE b.id_group='".$akses."' and a.kd_apip='".$instansi."' and a.tahun='".$tahun."' and a.jenis=2 and user_id<>'".$user_id."' 
								
							 union
								 SELECT a.*FROM thistory a
								 INNER JOIN ms_group_menu_elemen b ON a.tahun=b.tahun AND a.kd_apip=b.kd_apip AND a.kd_elemen=b.kd_elemen AND a.kd_topik=b.kd_topik and a.id_penerima=b.id_group
								 WHERE b.id_group='".$akses."'  and a.kd_apip='".$instansi."' and a.tahun='".$tahun."' and a.jenis=3 and user_id<>'".$user_id."'
							union
								SELECT * FROM thistory WHERE thistory.user_type = 1 
								and tampil=1 and kd_apip='".$instansi."' and tahun='".$tahun."' and jenis=4 and id_penerima='".$akses."'
							union
								 SELECT distinct a.*FROM thistory a
								 INNER JOIN ms_group_menu_elemen b ON a.tahun=b.tahun AND a.kd_apip=b.kd_apip AND a.user_type=b.id_group
								 WHERE b.id_group='".$akses."'  and a.kd_apip='".$instansi."' and a.tahun='".$tahun."' and a.jenis=5 and user_id<>'".$user_id."' and a.id_penerima=b.id_group								
							
							)z  ORDER BY user_date desc";					   
	
		}				
			
		
			$data = $this->db->query($query)->result();
			
			$html = "";
			$no = 0;
			foreach ($data as $row) {
				$no++;

                $id         = $row->id;
              //  $_id        = $this->EncryptLink($id);
				
				$jenis         = $row->jenis;
				$nilai         = $row->nilai;
				$ctahun 	   = $row->tahun;
				$cinstansi	   = $row->kd_apip;
				$celemen	   = $row->kd_elemen;
				$ctopik	       = $row->kd_topik;
				$clevel		   = $row->kd_level;
				$cpenilaian	   = $row->kd_penilaian;
				$uraianaksi    = $row->uraian;
				$cketerangan   = $row->keterangan;
				$cnmelemen     = $row->nm_elemen;
				$cnmtopik	   = $row->nm_topik;
				$cnmpenilaian  = $row->nm_penilaian;
				$ctgl  		   = $row->user_date;
				$cstatus	   = $row->status; 
				$routes		   = $row->routes;
				$_routes 	   = $this->dynamic_menu->EncryptLink($routes);
				
				
				if($cstatus==1){
					$cstatus='sudah dibaca';
				}else{
					$cstatus='belum dibaca';
				}
				
				$cont = $_routes;
				$link = base_url($cont);
				
				
				// $uraian = '<a href="'.$link.'">'.$field->uraian.'<br>'.$this->pubModel->tgl_jam($field->user_date).'<br>'.$status.'</a>';
				if($ctgl<>''){
					
					$ctgl=$cverif_at=$this->PublicModel->tanggal_waktu_indonesia($ctgl);
				}else{
					$ctgl='';
				}
				
				if($cstatus=='sudah dibaca'){
					$cview='<i class="fa fa-eye" aria-hidden="true" style="color:#18978F"></i>&nbsp;&nbsp;<i style="color:#18978F">'.$cstatus.'</i>';
					
					//$cview='<i class="fa fa-eye" aria-hidden="true" style="color:#18978F"></i>&nbsp;&nbsp;<a href="#" class="list-group-item list-group-item-action update-view" data-id="'.$id.'">&nbsp;&nbsp;<i style="color:#18978F">'.$cstatus.'</i></a>';
				}else{
					
					$cview='<i class="fa fa-eye-slash" aria-hidden="true" style="color:#EF5B0C"></i>&nbsp;&nbsp;<i style="color:#EF5B0C">'.$cstatus.'</i>';			
					//$cview='<i class="fa fa-eye-slash" aria-hidden="true" style="color:#EF5B0C"></i>&nbsp;&nbsp;<a href="#" class="list-group-item list-group-item-action update-view" data-id="'.$id.'">&nbsp;&nbsp;<i style="color:#EF5B0C">'.$cstatus.'</i></a>';
				}

		if($jenis==2){
			
			if($nilai==0){
				$cicon = '<i class="fa fa-times fa-2x" style="color: #fc544b;"></i>';
				$uraianaksi='<a href="'.$link.'" onclick="update_view('.$id.')">'.$uraianaksi.'&nbsp;&nbsp;&nbsp;&nbsp;'.$cicon.'<br>
				Elemen &nbsp;&nbsp;&nbsp;&nbsp;: '.$celemen.'&nbsp'.$cnmelemen.'<br>
				Topik &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$ctopik.' &nbsp;'.$cnmtopik.'<br><i style="font-size:12px;color:#B93160">'.$ctgl.'</i></a>';

				
			}else{
				$cicon = '<i class="fa fa-check-square-o fa-2x" style="color: #3CCF4E;"></i>';
				$uraianaksi='<a href="'.$link.'" onclick="update_view('.$id.')">'.$uraianaksi.'&nbsp;&nbsp;&nbsp;&nbsp;'.$cicon.'<br>
				Elemen &nbsp;&nbsp;&nbsp;&nbsp;: '.$celemen.'&nbsp; '.$cnmelemen.'<br>
				Topik &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$ctopik.' &nbsp;'.$cnmtopik.'<br><i style="font-size:12px;color:#B93160">'.$ctgl.'</i></a>';
			}
			
		}elseif($jenis==3){
			
			if($nilai==0){
				$cicon = '<i class="fa fa-times fa-2x" style="color: #fc544b;"></i>';
				$uraianaksi='<a href="'.$link.'" onclick="update_view('.$id.')">'.$uraianaksi.'&nbsp;&nbsp;&nbsp;&nbsp;'.$cicon.'<br>
				Elemen &nbsp;&nbsp;&nbsp;&nbsp;: '.$celemen.'&nbsp'.$cnmelemen.'<br>
				Topik &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$ctopik.' &nbsp;'.$cnmtopik.'<br>
				Penilaian &nbsp;&nbsp;: '.$cpenilaian.' &nbsp;'.$cnmpenilaian.'<br>
				Level &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$clevel.'<br><i style="font-size:12px;color:#B93160">'.$ctgl.'</i></a>';

				
			}else{
				$cicon = '<i class="fa fa-check-square-o fa-2x" style="color: #3CCF4E;"></i>';
				$uraianaksi='<a href="'.$link.'" onclick="update_view('.$id.')">'.$uraianaksi.'&nbsp;&nbsp;&nbsp;&nbsp;'.$cicon.'<br>
				Elemen &nbsp;&nbsp;&nbsp;&nbsp;: '.$celemen.'&nbsp; '.$cnmelemen.'<br>
				Topik &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$ctopik.' &nbsp;'.$cnmtopik.'<br>
				Penilaian &nbsp;&nbsp;: '.$cpenilaian.' &nbsp;'.$cnmpenilaian.'<br>
				Level &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$clevel.'<br><i style="font-size:12px;color:#B93160">'.$ctgl.'</i></a>';

			}
			
		}elseif($jenis==4){
					$cicon = '<i class="fa fa-file-pdf-o fa-2x" style="color: #EB1D36" aria-hidden="true"></i>';
					$uraianaksi='<a href="'.$link.'" onclick="update_view('.$id.')">'.$uraianaksi.'&nbsp;&nbsp;&nbsp;&nbsp;'.$cicon.'<br>File &nbsp;&nbsp;&nbsp;&nbsp;: '.$cketerangan.'<br><i style="font-size:12px;color:#B93160">'.$ctgl.'</i></a>';
		}elseif($jenis==5){
			
			if($nilai==0){
				$cicon = '<i class="fa fa-unlock fa-2x" style="color: #069A8E;"></i>';
				$uraianaksi='<a href="'.$link.'" onclick="update_view('.$id.')" >'.$uraianaksi.'&nbsp;&nbsp;&nbsp;&nbsp;'.$cicon.'<br><i style="font-size:12px;color:#B93160">'.$ctgl.'</i></a>';

				
			}else{
				$cicon = '<i class="fa fa-lock fa-2x" style="color: #D61C4E;"></i>';
				$uraianaksi='<a href="'.$link.'" onclick="update_view('.$id.')" >'.$uraianaksi.'&nbsp;&nbsp;&nbsp;&nbsp;'.$cicon.'<br><i style="font-size:12px;color:#B93160">'.$ctgl.'</i></a>';

			}
			
			
		} 
			

			$aksi='<center>
						<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  
						  
							<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-bars" aria-hidden="true"></i>
							</button>
							<div style="margin-left: -200px; position: relative;z-index: 99;" class="dropdown-menu" aria-labelledby="Pilihan aksi" ><left>
								  '.$button1.'
								  '.$button2.'
								
							</div> 
						  </div>
						
					</center>';					
					
				
					
				
				$html.='<tr>
							<td style="width:5%;text-align:center;">'.$no.'</td>
							<td style="width:80%;text-align:left;">'.$uraianaksi.'</td>
							<td style="width:15%;text-align:left;">'.$cview.'</td>
							
						</tr>';
			}
			
			return $html;
		}		
		
		

	}

?>