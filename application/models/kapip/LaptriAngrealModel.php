<?php
	class LaptriAngrealModel extends CI_Model{

		var $table = 'viewlapform1 a'; //nama tabel dari database
	    var $column_order = array(null,'nm_instansi','no_lhp','jml_temuan','jml_rekomendasi'); //field yang ada di table 
	    var $column_search = array('noreg','nm_instansi'); //field yang diizin untuk pencarian 
	    var $order = array('noreg' => 'asc'); // default order 
	    var $order2 = array('no_lhp' => 'asc'); // default order 

	    public function getHeaderLK($tahun,$lhp,$satker){
			$sql = "SELECT a.tahun, b.kd_satker, a.no_lhp, a.tgl_lhp, b.*,
					( SELECT nm_instansi FROM ms_instansi_kemendagri WHERE id_instansi = b.kd_satker ) AS satker,
					( SELECT nama FROM ms_pic_itjen WHERE id = a.pic ) AS pic_itjen,
					( SELECT nama_aspek FROM aspek_pengawasan WHERE kode_aspek = b.kd_aspek) AS aspek
					FROM
						tr_tlhp_bpk a 
					INNER JOIN tr_tlhp_bpk_temuan b ON a.tahun = b.tahun and a.no_lhp = b.no_lhp
					WHERE a.tahun = '".$tahun."' and a.no_lhp = '".$lhp."' and b.kd_satker = ".$satker."
					group by a.tahun, b.kd_satker, a.no_lhp
					";
			$query = $this->db->query($sql)->result();
			
			
			return $query;
		}

	    private function _get_all_tlhp_query($daerah)
	    {
	    	$akses = $this->session->userdata('is_admin');
	    	
	    	if($akses == 2){
				$apip = $this->session->userdata('id_prov');
				$sql = "SELECT * FROM ms_inspektorat where id_inspektorat = ".$apip;	
				$daerah = $this->db->query($sql)->row()->kemendagri;
				$arrayDaerah = explode(',',$daerah); 
			}
			
			
	    	$tahun = $this->session->userdata('year_selected');
	    	if ($akses == 1) {
				
	    	}else if($akses == 2){
	    		$this->db->where_in('id_instansi',$arrayDaerah);
	    	}else if($akses == 3){
	    		$this->db->where_in('id_instansi',$daerah);
	    	}else{

	    	}
	    	$this->db->where('tahun',$tahun);
	        $this->db->from($this->table);
	        // print_r($this->db->get());die();
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
	            if ($this->column_order[$_POST['order']['0']['column']] == 'nm_instansi') {
	            	$order2 = $this->order2;
	            	$this->db->order_by(key($order2), $order2[key($order2)]);
	        	}
	        } 
	        else if(isset($this->order))
	        {
	            $order = $this->order;
	            $order2 = $this->order2;
	         
	            $this->db->order_by(key($order), $order[key($order)]);
	            $this->db->order_by(key($order2), $order2[key($order2)]);

	        }
	    }
	 
	    function get_all_tlhp($daerah)
	    {
	        $this->_get_all_tlhp_query($daerah);
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function get_all_tlhp_sql($daerah)
	    {
	    	$query = "SELECT `a`.`noreg` AS `noreg`,`a`.`id_instansi` AS `id_instansi`,`a`.`tahun` AS `tahun`,`a`.`no_lhp` AS `no_lhp`,`a`.`tgl_lhp` AS `tgl_lhp`,(select `sip_develope`.`ms_instansi_kemendagri`.`nm_instansi` from `sip_develope`.`ms_instansi_kemendagri` where `sip_develope`.`ms_instansi_kemendagri`.`id_instansi` = `a`.`id_instansi`) AS `nm_instansi`,(select count(0) from `sip_develope`.`trd_tlhp_bpklapkeu_temuan` where `sip_develope`.`trd_tlhp_bpklapkeu_temuan`.`tahun` = `a`.`tahun` and `sip_develope`.`trd_tlhp_bpklapkeu_temuan`.`noreg` = `a`.`noreg` and `sip_develope`.`trd_tlhp_bpklapkeu_temuan`.`no_lhp` = `a`.`no_lhp`) AS `jml_temuan`,(select count(0) from `sip_develope`.`trd_tlhp_bpklapkeu_rekomendasi` where `sip_develope`.`trd_tlhp_bpklapkeu_rekomendasi`.`tahun` = `a`.`tahun` and `sip_develope`.`trd_tlhp_bpklapkeu_rekomendasi`.`noreg` = `a`.`noreg` and `sip_develope`.`trd_tlhp_bpklapkeu_rekomendasi`.`no_lhp` = `a`.`no_lhp`) AS `jml_rekomendasi`,`c`.`sesuai` AS `sesuai`,`c`.`blm_sesuai` AS `belum_sesuai`,0 AS `belum_ditindak`,0 AS `tidak_dpt_ditindak` from (`sip_develope`.`trh_tlhp_bpklapkeu` `a` left join (select `b`.`noreg` AS `noreg`,`b`.`no_lhp` AS `no_lhp`,sum(`b`.`sr_s`) AS `sesuai`,sum(`b`.`sr_bs`) AS `blm_sesuai` from (select `a`.`noreg` AS `noreg`,`a`.`no_lhp` AS `no_lhp`,`a`.`kd_rekomendasi` AS `kd_rekomendasi`,count(`a`.`noreg`) AS `jmltl`,sum(`a`.`sesuai`) AS `s`,sum(`a`.`belumsesuai`) AS `bs`,sum(`a`.`belumditindaklanjuti`) AS `bd`,sum(`a`.`tidakdapatditindaklanjuti`) AS `tdtp`,case when count(`a`.`noreg`) = 0 then 0 when count(`a`.`noreg`) = sum(`a`.`sesuai`) then 1 else 0 end AS `sr_s`,case when count(`a`.`noreg`) = 0 then 0 when sum(`a`.`belumsesuai`) > 0 then 1 else 0 end AS `sr_bs` from (select `sip_develope`.`trd_tlhp_bpklapkeu_tl_lamp`.`noreg` AS `noreg`,`sip_develope`.`trd_tlhp_bpklapkeu_tl_lamp`.`no_lhp` AS `no_lhp`,`sip_develope`.`trd_tlhp_bpklapkeu_tl_lamp`.`kd_rekomendasi` AS `kd_rekomendasi`,`sip_develope`.`trd_tlhp_bpklapkeu_tl_lamp`.`kd_tl` AS `kd_tl`,if(`sip_develope`.`trd_tlhp_bpklapkeu_tl_lamp`.`status` = 'SESUAI',1,0) AS `sesuai`,if(`sip_develope`.`trd_tlhp_bpklapkeu_tl_lamp`.`status` = 'BELUM SESUAI',1,0) AS `belumsesuai`,if(`sip_develope`.`trd_tlhp_bpklapkeu_tl_lamp`.`status` = 'BELUM DITINDAKLANJUTI',1,0) AS `belumditindaklanjuti`,if(`sip_develope`.`trd_tlhp_bpklapkeu_tl_lamp`.`status` = 'TIDAK DAPAT DITINDAKLANJUTI',1,0) AS `tidakdapatditindaklanjuti` from `sip_develope`.`trd_tlhp_bpklapkeu_tl_lamp`) `a` group by `a`.`noreg`,`a`.`no_lhp`,`a`.`kd_rekomendasi`) `b` group by `b`.`noreg`,`b`.`no_lhp`) `c` on(`a`.`noreg` = `c`.`noreg` and `a`.`no_lhp` = `c`.`no_lhp`))";
	        $result = $this->db->query($query)->result();
	        print_r($result);die();

	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_tlhp($daerah)
	    {
	        $this->_get_all_tlhp_query($daerah);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function count_all_tlhp($daerah)
	    {

	    	$akses = $this->session->userdata('is_admin');
	    	
	    	if($akses == 2){
				$apip = $this->session->userdata('id_prov');
				$sql = "SELECT * FROM ms_inspektorat where id_inspektorat = ".$apip;	
				$daerah = $this->db->query($sql)->row()->kemendagri;
				$arrayDaerah = explode(',',$daerah); 
			}
			
			
	    	$tahun = $this->session->userdata('year_selected');
	    	if ($akses == 1) {
				
	    	}else if($akses == 2){
	    		$this->db->where_in('id_instansi',$arrayDaerah);
	    	}else if($akses == 3){
	    		$this->db->where_in('id_instansi',$daerah);
	    	}else{
	    		
	    	}

	    	$this->db->where('tahun',$tahun);
	        $this->db->from($this->table);
	        return $this->db->count_all_results();
	    }



	}

?>