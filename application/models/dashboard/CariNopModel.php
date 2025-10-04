<?php
class CariNopModel extends CI_Model {
    
    private $db2;

    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('db2', TRUE);
    }
        
    var $table = 'vdata_pajak'; 
    var $column_order = array(null, 'nop'); // tambahkan null kalau pakai datatables index
    var $column_search = array('nop','nm_wp','subjek_pajak_id','alamat_wp'); 
    var $order = array('nop' => 'asc'); 

	private function _get_all_data_query()
	{
			$akses = $this->session->userdata('is_admin');


			$this->db2->select('*');    
			$this->db2->from('vdata_pajak');
			
			
		
		$i = 0;
		
		foreach ($this->column_search as $item) // looping awal
		{
			if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
			{
					
				if($i===0) // looping awal
				{
					$this->db2->group_start(); 
					$this->db2->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db2->or_like($item, $_POST['search']['value']);
				}
	
				if(count($this->column_search) - 1 == $i) 
					$this->db2->group_end(); 
			}
			$i++;
		}
		if(isset($_POST['order'])) 
		{
			$this->db2->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			if ($this->column_order[$_POST['order']['0']['column']] == 'nm_wp') {
				$order2 = $this->order2;
				$this->db2->order_by(key($order2), $order2[key($order2)]);
			}
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$order2 = $this->order2;
			
			$this->db2->order_by(key($order), $order[key($order)]);
			$this->db2->order_by(key($order2), $order2[key($order2)]);

		}
	}


    function get_all_data()
    {

        $this->_get_all_data_query();
        if($_POST['length'] != -1)
            $this->db2->limit($_POST['length'], $_POST['start']);
        $query = $this->db2->get();
        return $query->result();
    }   

    function count_filtered_data()
    {
        $this->_get_all_data_query();
        $query = $this->db2->get();
        return $query->num_rows();
    }
    
    public function count_all_data()
    {           
        $this->db2->from($this->table);
        return $this->db2->count_all_results();
    }

}
?>
