<?php
	class PenerimaanModel extends CI_Model{
		
	 	private $db2;

		public function __construct()
		{
			parent::__construct();
			$this->db2 = $this->load->database('db2', TRUE);
		}
			
	    public function getPenerimaanKecamatan($startDate,$endDate)
	    {		 
			$query = "SELECT a.kd_propinsi,a.kd_dati2,a.kd_kecamatan,b.nm_kecamatan,SUM(jml_sppt_yg_dibayar) AS pokok,SUM(denda_sppt) AS denda,COUNT(*) AS jrec FROM pembayaran_sppt a
						INNER JOIN ref_kecamatan b ON a.kd_propinsi=b.kd_propinsi AND a.kd_dati2=b.kd_dati2 AND a.kd_kecamatan=b.kd_kecamatan WHERE 
						a.kd_propinsi='65' AND a.kd_dati2='01' AND a.tgl_pembayaran_sppt >= '".$startDate."' AND  a.tgl_pembayaran_sppt <='".$endDate."'   
						GROUP BY a.kd_propinsi,a.kd_dati2,a.kd_kecamatan,b.nm_kecamatan";				
	    	$sql = $this->db2->query($query)->result();
	    	return $sql;
	    }

	    public function getPenerimaanKelurahan($kec,$startDate,$endDate)
	    {		 
			$query = "SELECT a.kd_propinsi,a.kd_dati2,a.kd_kecamatan,a.kd_kelurahan,b.nm_kelurahan,SUM(jml_sppt_yg_dibayar) AS pokok,SUM(denda_sppt) AS denda,COUNT(*) AS jrec FROM pembayaran_sppt a
						INNER JOIN ref_kelurahan b ON a.kd_propinsi=b.kd_propinsi AND a.kd_dati2=b.kd_dati2 AND a.kd_kecamatan=b.kd_kecamatan and a.kd_kelurahan=b.kd_kelurahan WHERE 
						a.kd_propinsi='65' AND a.kd_dati2='01' and a.kd_kecamatan='".$kec."'AND a.tgl_pembayaran_sppt >= '".$startDate."' AND  a.tgl_pembayaran_sppt <='".$endDate."'   
						GROUP BY a.kd_propinsi,a.kd_dati2,a.kd_kecamatan,a.kd_kelurahan,b.nm_kelurahan";
	    	$sql = $this->db2->query($query)->result();
	    	return $sql;
	    }
		
		

	}

?>