<?php
	class Notifikasi_model extends CI_Model{

		var $table = 'thistory'; //nama tabel dari database
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
			
      

			if ($akses==1) {
	
				$this->db->from('thistory'); 
				$this->db->join('ms_user', 'ms_user.id_user=thistory.user_id');
				$this->db->where('thistory.tampil = ',1);

			}else{
				
		 		$this->db->from('thistory');						
				$query1 = $this->db->get_compiled_select();
			
				
				
			}			

			
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

			
			$this->db->from('thistory'); 
			$this->db->join('ms_user', 'ms_user.id_user=thistory.user_id', 'left');
			$this->db->where('thistory.tampil = ',1);	
			

		   return $this->db->count_all_results();
	    }

	
		public function viewNotifikasi()
		{
		
				$html='<tr>
							<td style="width:5%;text-align:center;"></td>
							<td style="width:80%;text-align:left;"></td>
							<td style="width:15%;text-align:left;"></td>
							
						</tr>';
			
			
			return $html;
		}		
		
		

	}

?>