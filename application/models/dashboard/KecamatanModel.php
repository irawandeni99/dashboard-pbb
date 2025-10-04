<?php
class KecamatanModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
        
    var $table = 'ms_kecamatan'; 
    var $column_order = array(null, 'kd_kecamatan'); // tambahkan null kalau pakai datatables index
    var $column_search = array('kd_kecamatan','nm_kecamatan','alamat','telp'); 
    var $order = array('kd_kecamatan' => 'asc'); 

	private function _get_all_data_query()
	{
			$akses = $this->session->userdata('is_admin');
			$this->db->select('*');    
			$this->db->from('ms_kecamatan');
			
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
			if ($this->column_order[$_POST['order']['0']['column']] == 'nm_kecamatan') {
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


    function get_all_data()
    {

        $this->_get_all_data_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
		
        return $query->result();
    }   

    function count_filtered_data()
    {
        $this->_get_all_data_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function count_all_data()
    {           
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }


	public function getData()
	{
		$akses = $this->session->userdata('is_admin');
			$query = 'SELECT * fROM ms_kecamatan';
			$sql = $this->db->query($query)->result();

		return $sql;
	}


	public function getDataRow($kode)
	{
		
			$query = 'SELECT * fROM ms_kecamatan where kd_kecamatan="'.$kode.'"';
			$sql = $this->db->query($query)->row();

		return $sql;
	}	


	public function add_data($data){
		$this->db->insert('ms_kecamatan', $data);
		return true;
	}

	public function update_data($data, $where){
		$this->db->where($where);
		$this->db->update('ms_kecamatan', $data);

		return true;
	}



	public function delete_data($where)
	{
		
		
		$this->db->where($where);
		$this->db->delete('ms_kecamatan');
		//return true;
		// kembalikan jumlah row yang terhapus
		return $this->db->affected_rows();
	}



}
?>
