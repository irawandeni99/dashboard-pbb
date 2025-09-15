<?php
	class MasterGroupModel extends CI_Model{

		var $table = 'ms_group'; //nama tabel dari database
	    var $column_order = array(null,'ms_group.id_group'); //field yang ada di table 
	    var $column_search = array('ms_group.id_group','ms_group.nm_group'); //field yang diizin untuk pencarian 
	    var $order = array('ms_group.id_group' => 'asc'); // default order 
	   

	    public function getGroup()
	    {
	    	$akses = $this->session->userdata('is_admin');
	    	/* if($akses == 1){
	    		$query = 'SELECT id_inspektorat,uraian FROM ms_inspektorat';
	    		$sql = $this->db->query($query)->result();
	    	}
	    	else if($akses == 2){
				$apip = $this->session->userdata('id_prov');
				$query = "SELECT id_inspektorat,uraian FROM ms_inspektorat where id_inspektorat = ".$apip;	
				$sql = $this->db->query($query)->result();
				
			}else{ */
				$query = 'SELECT id_group,nm_group fROM ms_group';
	    		$sql = $this->db->query($query)->result();
		//	}

	    	return $sql;
	    }


	    public function nextid()
	    {
			
		$query="SELECT (ifnull(max(id_group),0)+1)as cnext FROM ms_group";
				$csql = $this->db->query($query);
				$cnext = $csql->row()->cnext;
	    	return $cnext;
	    }




	    private function _get_all_group_query()
	    {
				$akses = $this->session->userdata('is_admin');
			//	$tahun = $this->session->userdata('year_selected');
			//	$instansi = $this->session->userdata('id_instansi');
				
				
	    	/* 
	    	if($akses == 3){
				
				$this->db->where('ms_group.id_group',$instansi);
			} */

				$this->db->select('ms_group.id_group, ms_group.nm_group');    
				$this->db->from('ms_group');
				
				
			
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
	            if ($this->column_order[$_POST['order']['0']['column']] == 'nm_group') {
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
	 
	    function get_all_group()
	    {
	        $this->_get_all_group_query();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function get_all_group_sql()
	    {
	    	$query = "SELECT id_group,nm_group from ms_group ";
	        $result = $this->db->query($query)->result();
	      //  print_r($result);die();

	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_group()
	    {
	        $this->_get_all_group_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
		
	 
	    public function count_all_group()
	    {

	    	$akses = $this->session->userdata('is_admin');
	    	
	    	/* if($akses == 2){
				
				$sql = "SELECT a.id_group,b.nm_group FROM ms_group";	
				$daerah = $this->db->query($sql)->row()->id_group;
				$arrayDaerah = explode(',',$daerah); 
			} */
			
			
	    	/* $tahun = $this->session->userdata('year_selected');
	    	if ($akses == 1) {
				
	    	}else if($akses == 2){
	    		$this->db->where_in('id_group',$arrayDaerah);
	    	}else if($akses == 3){
	    		$this->db->where_in('id_group',$daerah);
	    	}else{
	    		
	    	} */

	    	
	        $this->db->from($this->table);
	        return $this->db->count_all_results();
	    }


		public function insertGroup($data){

			$this->db->insert('ms_group', $data);
			
			return true;
		}
		
		
		

	}

?>