<?php
	class RealisasiPenerimaanModel extends CI_Model{
		
	 	private $db2;

		public function __construct()
		{
			parent::__construct();
			$this->db2 = $this->load->database('db2', TRUE);
		}
			
	    public function getRealisasi($prop,$kab,$kec,$startYear,$endYear)
	    {		 

			if($kec=='000'){
				$query = "CALL get_real_penerimaan_pertahun_kab('".$prop."','".$kab."','".$startYear."','".$endYear."')";							
				$sql = $this->db2->query($query)->result();						
			}else{
				$query = "CALL get_real_penerimaan_pertahun_kec('".$prop."','".$kab."','".$kec."','".$startYear."','".$endYear."')";							
				$sql = $this->db2->query($query)->result();								
			}

			return $sql;

	    }


	}

?>