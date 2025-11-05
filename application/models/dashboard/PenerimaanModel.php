<?php
	class PenerimaanModel extends CI_Model{
		
	 	private $db2;

		public function __construct()
		{
			parent::__construct();
			$this->db2 = $this->load->database('db2', TRUE);
		}
			
	    public function getPenerimaanKecamatan($prop,$kab,$startDate,$endDate)

	    {		 

			$query = "SELECT z.kd_propinsi,z.kd_dati2,z.kd_kecamatan,z.nm_kecamatan,z.realisasi,z.denda,(z.realisasi-z.denda)pokok FROM(
						SELECT a.kd_propinsi,a.kd_dati2,a.kd_kecamatan,(SELECT nm_kecamatan FROM ref_kecamatan WHERE kd_propinsi=a.kd_propinsi AND kd_dati2=a.kd_dati2 AND kd_kecamatan=a.kd_kecamatan)nm_kecamatan,
						SUM(jml_sppt_yg_dibayar) AS realisasi,SUM(denda_sppt) AS denda 
						FROM pembayaran_sppt a
						INNER JOIN sppt b ON a.kd_propinsi=b.kd_propinsi AND a.kd_dati2=b.kd_dati2 AND a.kd_kecamatan=b.kd_kecamatan AND a.kd_kelurahan=b.kd_kelurahan
						AND a.kd_blok=b.kd_blok AND a.no_urut=b.no_urut AND a.kd_jns_op=b.kd_jns_op  AND a.thn_pajak_sppt=b.thn_pajak_sppt
						WHERE 
						a.kd_propinsi='".$prop."' AND a.kd_dati2='".$kab."' AND a.tgl_pembayaran_sppt >= '".$startDate."' AND  a.tgl_pembayaran_sppt <='".$endDate."' 
						GROUP BY a.kd_propinsi,a.kd_dati2,a.kd_kecamatan
						)z";

	    	$sql = $this->db2->query($query)->result();
	    	return $sql;
	    }

	    public function getPenerimaanKelurahan($prop,$kab,$kec,$startDate,$endDate)
	    {		 

			$query = "SELECT z.kd_propinsi,z.kd_dati2,z.kd_kecamatan,z.kd_kelurahan,z.nm_kelurahan,z.realisasi,z.denda,(z.realisasi-z.denda)pokok FROM(
						SELECT a.kd_propinsi,a.kd_dati2,a.kd_kecamatan,a.kd_kelurahan,(SELECT nm_kelurahan FROM ref_kelurahan WHERE kd_propinsi=a.kd_propinsi AND kd_dati2=a.kd_dati2 AND kd_kecamatan=a.kd_kecamatan and kd_kelurahan=a.kd_kelurahan)nm_kelurahan,
						SUM(jml_sppt_yg_dibayar) AS realisasi,SUM(denda_sppt) AS denda 
						FROM pembayaran_sppt a
						INNER JOIN sppt b ON a.kd_propinsi=b.kd_propinsi AND a.kd_dati2=b.kd_dati2 AND a.kd_kecamatan=b.kd_kecamatan AND a.kd_kelurahan=b.kd_kelurahan
						AND a.kd_blok=b.kd_blok AND a.no_urut=b.no_urut AND a.kd_jns_op=b.kd_jns_op  AND a.thn_pajak_sppt=b.thn_pajak_sppt
						WHERE 
						a.kd_propinsi='".$prop."' AND a.kd_dati2='".$kab."' and a.kd_kecamatan='".$kec."' AND a.tgl_pembayaran_sppt >= '".$startDate."' AND  a.tgl_pembayaran_sppt <='".$endDate."' 
						GROUP BY a.kd_propinsi,a.kd_dati2,a.kd_kecamatan,a.kd_kelurahan
						)z";			
	    	$sql = $this->db2->query($query)->result();
	    	return $sql;
	    }
		
		

	}

?>