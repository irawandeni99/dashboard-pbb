<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaptahPenilaianMandiriController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('kapip/LaptahModel', 'LaptahModel');
		$this->load->model('PublicModel');
	}

	public function index()
	{

		//$data['satker'] 		= $this->pubModel->satker_bpk();
		
		$data['instansi'] 		= $this->LaptahModel->getInstansi();
		$data['elemen'] 		= $this->LaptahModel->getElemen();
		$data['view'] 			= 'kapip/laporan/laporanPenilaianMandiriView';
		$this->load->view('template/layout', $data);
	}


	function prev_laporan(){ 

		$ctahun = $this->input->post('ctahun');	
		$cinstansi = $this->input->post('cinstansi');			
		$celemen = $this->input->post('celemen');
		$ctipe = $this->input->post('ctipe');
		
		//if($ctipe=='priv'){
			$cRet = $this->laporan_mandiri($ctahun,$cinstansi,$celemen,$ctipe);
			echo $cRet;
		
		//}
		
		
	}




	function laporan_mandiri($ctahun,$cinstansi,$celemen,$ctipe){ 

		$cnminstansi	 = $this->PublicModel->get_nama($cinstansi,'nm_apip','ms_apip','kd_apip');	
		$cnmelemen	 	 = $this->PublicModel->get_nama($celemen,'nm_elemen','ms_elemen','kd_elemen');	
		$akses = $this->session->userdata('is_admin');
		
		$cRet ="";

		$cRet .= "<table width=\"100%\"><tr>
							<td width=\"100%\" align=\"center\" colspan=\"9\">
								<h4><b>Kertas Kerja Penilaian Mandiri Kapabilitas APIP Elemen ".$cnmelemen."</b></h4>
								
							</td>
							</tr></table>";
			
							
				$cRet .= "<div style='overflow-x:auto;'><table style=\"border-collapse:collapse;\" style=\"font-size:12\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
									<thead>
									<tr bgcolor=\"#CCCCCC\">
										<th rowspan	=\"3\"  style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>NO<b></th>
										<th rowspan	=\"3\" style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>TOPIK</b></th>
										<th colspan	=\"20\" style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>ASPEK PENILAIAN</b></th>
										<th rowspan	=\"3\" style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>SIMPULAN<br>PEMENUHAN<br>TOPIK</b></th>
										<th rowspan	=\"3\" style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>AREA OF<br>IMPROVEMENT<br>TOPIK</b></th>
											
									</tr>
									
									<tr bgcolor=\"#CCCCCC\">
										<th colspan	=\"4\" style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>LEVEL1</b></th>
										<th colspan	=\"4\" style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>LEVEL2</b></th>
										<th colspan	=\"4\" style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>LEVEL3</b></th>
										<th colspan	=\"4\" style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>LEVEL4</b></th>
										<th colspan	=\"4\" style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>LEVEL5</b></th>
									</tr>
									
									<tr bgcolor=\"#CCCCCC\">
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>NO</b></th>
										<th colspan	=\"2\" style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>URAIAN</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Y/T</b></th>
										
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>NO</b></th>
										<th colspan	=\"2\" style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>URAIAN</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Y/T</b></th>
										
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>NO</b></th>
										<th colspan	=\"2\" style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>URAIAN</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Y/T</b></th>
										
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>NO</b></th>
										<th colspan	=\"2\" style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>URAIAN</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Y/T</b></th>
										
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>NO</b></th>
										<th colspan	=\"2\" style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>URAIAN</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Y/T</b></th>
									</tr>
									
									</thead>";							
							
							
						/* 	$csql = "SELECT*FROM(
									SELECT '1'jns,(select nm_topik FROM ttopik WHERE tahun=zza.tahun AND kd_apip=zza.kd_apip AND kd_elemen=zza.kd_elemen and kd_topik=zza.kd_topik)uraitopik,
									tahun,kd_apip,kd_elemen,kd_topik,''kd_penilaian,'' kd1,''hpoin1,''dpoin1,IF(clevel4 IS NULL,'','Simpulan Pemenuhan') urai1,''penjelasan1,IFNULL(clevel1,'') jwb1,''kd2,''hpoin2,''dpoin2,
									IF(clevel2 IS NULL,'','Simpulan Pemenuhan')urai2,''penjelasan2,IFNULL(clevel2,'') jwb2,''kd3,''hpoin3,''dpoin3,IF(clevel3 IS NULL,'','Simpulan Pemenuhan')urai3,''penjelasan3,IFNULL(clevel3,'') jwb3,''kd4,''hpoin4,''dpoin4,IF(clevel4 IS NULL,'','Simpulan Pemenuhan')urai4,''penjelasan4,IFNULL(clevel4,'') jwb4,''kd5,
									''hpoin5,''dpoin5,IF(clevel5 IS NULL,'','Simpulan Pemenuhan')urai5,''penjelasan5,IFNULL(clevel5,'') jwb5 FROM(
										SELECT tahun,kd_apip,kd_elemen,kd_topik,(SELECT nm_topik FROM ttopik WHERE tahun=zz.tahun AND kd_apip=zz.kd_apip 
										AND kd_elemen=zz.kd_elemen AND kd_topik=zz.kd_topik LIMIT 1)keterangan,
										
										CASE 
										WHEN clevel1=1 THEN 'Y'
										WHEN clevel1=0 THEN 'T'
										ELSE '' END AS clevel1,
										CASE 
										WHEN clevel2=1 THEN 'Y'
										WHEN clevel2=0 THEN 'T'
										ELSE '' END AS clevel2,
										CASE 
										WHEN clevel3=1 THEN 'Y'
										WHEN clevel3=0 THEN 'T'
										ELSE '' END AS clevel3,
										CASE 
										WHEN clevel4=1 THEN 'Y'
										WHEN clevel4=0 THEN 'T'
										ELSE '' END AS clevel4,
										CASE 
										WHEN clevel5=1 THEN 'Y'
										WHEN clevel5=0 THEN 'T'
										END AS clevel5
										FROM(
										SELECT tahun,kd_elemen,kd_apip,kd_topik,SUM(clevel1)clevel1,SUM(clevel2)clevel2,SUM(clevel3)clevel3,SUM(clevel4)clevel4,SUM(clevel5)clevel5,
											(SELECT kd_jns_elemen FROM ms_elemen WHERE kd_elemen=z.kd_elemen LIMIT 1)kd_jns_elemen FROM(
											SELECT a.tahun,a.kd_apip,a.kd_elemen,a.kd_topik,
											CASE WHEN a.kd_level=1 THEN simpulan_pemenuhan END AS clevel1,
											CASE WHEN a.kd_level=2 THEN simpulan_pemenuhan END AS clevel2,
											CASE WHEN a.kd_level=3 THEN simpulan_pemenuhan END AS clevel3,
											CASE WHEN a.kd_level=4 THEN simpulan_pemenuhan END AS clevel4,
											CASE WHEN a.kd_level=5 THEN simpulan_pemenuhan END AS clevel5
											FROM tlevel a
											INNER JOIN ms_group_menu_elemen b ON a.tahun=b.tahun AND a.kd_apip=b.kd_apip AND a.kd_elemen=b.kd_elemen AND a.kd_topik=b.kd_topik
											WHERE a.tahun='".$ctahun."' AND a.kd_apip='".$cinstansi."' AND a.kd_elemen='".$celemen."' AND b.id_group='".$akses."'
											)z GROUP BY kd_elemen,kd_apip,kd_elemen,kd_topik
										)zz
									)zza
								UNION 
									SELECT '2'jns,(select keterangan FROM ttopik WHERE tahun=xx.tahun AND kd_apip=xx.kd_apip AND kd_elemen=xx.kd_elemen and kd_topik=xx.kd_topik)uraitopik,
									tahun,kd_apip,kd_elemen,kd_topik,kd_penilaian,kd1,hpoin1,dpoin1,urai1,penjelasan1,
									CASE 
									WHEN jwb1=1 THEN 'Y'  
									ELSE 'T' END AS jwb1,
									kd2,hpoin2,dpoin2,urai2,penjelasan2,
									CASE 
									WHEN jwb2=1 THEN 'Y' 
									ELSE 'T' END AS jwb2,
									kd3,hpoin3,dpoin3,urai3,penjelasan3,
									CASE 
									WHEN jwb3=1 THEN 'Y' 
									ELSE 'T' END AS jwb3,
									kd4,hpoin4,dpoin4,urai4,penjelasan4,
									CASE 
									WHEN jwb4=1 THEN 'Y' 
									ELSE 'T' END AS jwb4,
									kd5,hpoin5,dpoin5,urai5,penjelasan5,
									CASE 
									WHEN jwb5=1 THEN 'Y' 
									ELSE 'T' END AS jwb5
									FROM(
									SELECT DISTINCT a.tahun,a.kd_apip,a.kd_elemen,a.kd_topik,a.kd_penilaian,IFNULL(b.kd_penilaian,'') kd1,IFNULL(b.uraian,'') urai1,IFNULL(b.penjelasan,'') penjelasan1,IFNULL(b.jawaban,'') jwb1,
									IFNULL(c.kd_penilaian,'') kd2,IFNULL(c.uraian,'') urai2,IFNULL(c.penjelasan,'') penjelasan2,IFNULL(c.jawaban,'') jwb2,
									IFNULL(d.kd_penilaian,'') kd3,IFNULL(d.uraian,'') urai3,IFNULL(d.penjelasan,'') penjelasan3,IFNULL(d.jawaban,'') jwb3,
									IFNULL(e.kd_penilaian,'') kd4,IFNULL(e.uraian,'') urai4,IFNULL(e.penjelasan,'') penjelasan4,IFNULL(e.jawaban,'') jwb4,
									IFNULL(f.kd_penilaian,'') kd5,IFNULL(f.uraian,'') urai5,IFNULL(f.penjelasan,'') penjelasan5,IFNULL(f.jawaban,'') jwb5,
									IFNULL(b.hpoin,'')hpoin1,IFNULL(b.dpoin,'')dpoin1,
									IFNULL(c.hpoin,'')hpoin2,IFNULL(c.dpoin,'')dpoin2,
									IFNULL(d.hpoin,'')hpoin3,IFNULL(d.dpoin,'')dpoin3,
									IFNULL(e.hpoin,'')hpoin4,IFNULL(e.dpoin,'')dpoin4,
									IFNULL(f.hpoin,'')hpoin5,IFNULL(f.dpoin,'')dpoin5
									FROM tpenilaian a 
									INNER JOIN ms_group_menu_elemen bb  ON a.tahun=bb.tahun AND a.kd_apip=bb.kd_apip AND a.kd_elemen=bb.kd_elemen AND a.kd_topik=bb.kd_topik
									LEFT JOIN (SELECT*FROM tpenilaian WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' AND kd_level=1)b
									ON a.tahun=b.tahun AND a.kd_apip=b.kd_apip AND a.kd_elemen=b.kd_elemen AND a.kd_topik=b.kd_topik 
									LEFT JOIN (SELECT*FROM tpenilaian WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' AND kd_level=2)c
									ON a.tahun=c.tahun AND a.kd_apip=c.kd_apip AND a.kd_elemen=c.kd_elemen AND a.kd_topik=c.kd_topik 
									LEFT JOIN (SELECT*FROM tpenilaian WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' AND kd_level=3)d
									ON a.tahun=d.tahun AND a.kd_apip=d.kd_apip AND a.kd_elemen=d.kd_elemen AND a.kd_topik=d.kd_topik 
									LEFT JOIN (SELECT*FROM tpenilaian WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' AND kd_level=4)e
									ON a.tahun=e.tahun AND a.kd_apip=e.kd_apip AND a.kd_elemen=e.kd_elemen AND a.kd_topik=e.kd_topik 
									LEFT JOIN (SELECT*FROM tpenilaian WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' AND kd_level=5)f
									ON a.tahun=f.tahun AND a.kd_apip=f.kd_apip AND a.kd_elemen=f.kd_elemen AND a.kd_topik=f.kd_topik 
									WHERE a.penjelasan<>'' AND a.tahun='".$ctahun."' AND a.kd_apip='".$cinstansi."'
									AND a.kd_elemen='".$celemen."' AND bb.id_group='".$akses."' 
									)xx 
								)abc ORDER BY tahun,kd_apip,kd_elemen,kd_topik,kd_penilaian,jns"; */
								
								
			
	$csql = "SELECT*FROM(
				SELECT '1'jns,(SELECT nm_topik FROM ttopik WHERE tahun=zza.tahun AND kd_apip=zza.kd_apip AND kd_elemen=zza.kd_elemen AND kd_topik=zza.kd_topik)uraitopik,
				tahun,kd_apip,kd_elemen,kd_topik,''kd_penilaian,''hpoin1,''dpoin1,IF(clevel4 IS NULL,'','Simpulan Pemenuhan') uraian1,''penjelasan1,IFNULL(clevel1,'') jawaban1,''hpoin2,''dpoin2,
				IF(clevel2 IS NULL,'','Simpulan Pemenuhan')uraian2,''penjelasan2,IFNULL(clevel2,'') jawaban2,''hpoin3,''dpoin3,IF(clevel3 IS NULL,'','Simpulan Pemenuhan')uraian3,''penjelasan3,IFNULL(clevel3,'') jawaban3,''hpoin4,''dpoin4,IF(clevel4 IS NULL,'','Simpulan Pemenuhan')uraian4,''penjelasan4,IFNULL(clevel4,'') jawaban4,
				''hpoin5,''dpoin5,IF(clevel5 IS NULL,'','Simpulan Pemenuhan')uraian5,''penjelasan5,IFNULL(clevel5,'') jawanan5 FROM(
				
				
					SELECT tahun,kd_apip,kd_elemen,kd_topik,(SELECT nm_topik FROM ttopik WHERE tahun=zz.tahun AND kd_apip=zz.kd_apip 
					AND kd_elemen=zz.kd_elemen AND kd_topik=zz.kd_topik LIMIT 1)keterangan,
					
					CASE 
					WHEN clevel1=1 THEN 'Y'
					WHEN clevel1=0 THEN 'T'
					ELSE '' END AS clevel1,
					CASE 
					WHEN clevel2=1 THEN 'Y'
					WHEN clevel2=0 THEN 'T'
					ELSE '' END AS clevel2,
					CASE 
					WHEN clevel3=1 THEN 'Y'
					WHEN clevel3=0 THEN 'T'
					ELSE '' END AS clevel3,
					CASE 
					WHEN clevel4=1 THEN 'Y'
					WHEN clevel4=0 THEN 'T'
					ELSE '' END AS clevel4,
					CASE 
					WHEN clevel5=1 THEN 'Y'
					WHEN clevel5=0 THEN 'T'
					END AS clevel5
					FROM(
					SELECT tahun,kd_elemen,kd_apip,kd_topik,SUM(clevel1)clevel1,SUM(clevel2)clevel2,SUM(clevel3)clevel3,SUM(clevel4)clevel4,SUM(clevel5)clevel5,
						(SELECT kd_jns_elemen FROM ms_elemen WHERE kd_elemen=z.kd_elemen LIMIT 1)kd_jns_elemen FROM(
						SELECT a.tahun,a.kd_apip,a.kd_elemen,a.kd_topik,
						CASE WHEN a.kd_level=1 THEN simpulan_pemenuhan END AS clevel1,
						CASE WHEN a.kd_level=2 THEN simpulan_pemenuhan END AS clevel2,
						CASE WHEN a.kd_level=3 THEN simpulan_pemenuhan END AS clevel3,
						CASE WHEN a.kd_level=4 THEN simpulan_pemenuhan END AS clevel4,
						CASE WHEN a.kd_level=5 THEN simpulan_pemenuhan END AS clevel5
						FROM tlevel a
						INNER JOIN ms_group_menu_elemen b ON a.tahun=b.tahun AND a.kd_apip=b.kd_apip AND a.kd_elemen=b.kd_elemen AND a.kd_topik=b.kd_topik
						WHERE a.tahun='".$ctahun."' AND a.kd_apip='".$cinstansi."' AND a.kd_elemen='".$celemen."' AND b.id_group='".$akses."'
						)z GROUP BY kd_elemen,kd_apip,kd_elemen,kd_topik
					)zz
					
					
				)zza
				
			UNION 

				SELECT '2'jns,(SELECT keterangan FROM ttopik WHERE tahun=xx.tahun AND kd_apip=xx.kd_apip AND kd_elemen=xx.kd_elemen AND kd_topik=xx.kd_topik)uraitopik,
				tahun,kd_apip,kd_elemen,kd_topik,kd_penilaian,hpoin1,dpoin1,uraian1,penjelasan1,
				CASE 
				WHEN jawaban1=1 THEN 'Y'  
				ELSE 'T' END AS jawaban1,
				hpoin2,dpoin2,uraian2,penjelasan2,
				CASE 
				WHEN jawaban2=1 THEN 'Y' 
				ELSE 'T' END AS jawaban2,
				hpoin3,dpoin3,uraian3,penjelasan3,
				CASE 
				WHEN jawaban3=1 THEN 'Y' 
				ELSE 'T' END AS jawaban3,
				hpoin4,dpoin4,uraian4,penjelasan4,
				CASE 
				WHEN jawaban4=1 THEN 'Y' 
				ELSE 'T' END AS jawaban4,
				hpoin5,dpoin5,uraian5,penjelasan5,
				CASE 
				WHEN jawaban5=1 THEN 'Y' 
				ELSE 'T' END AS jawaban5
				FROM(

					SELECT tahun,kd_apip,kd_elemen,kd_topik,kd_penilaian,IFNULL(hpoin1,'')hpoin1,IFNULL(dpoin1,'')dpoin1,
					IFNULL(uraian1,'')uraian1,IFNULL(jawaban1,'')jawaban1,IFNULL(penjelasan1,'')penjelasan1,
					IFNULL(hpoin2,'')hpoin2,IFNULL(dpoin2,'')dpoin2,IFNULL(uraian2,'')uraian2,IFNULL(jawaban2,'')jawaban2,IFNULL(penjelasan2,'')penjelasan2,
					IFNULL(hpoin3,'')hpoin3,IFNULL(dpoin3,'')dpoin3,IFNULL(uraian3,'')uraian3,IFNULL(jawaban3,'')jawaban3,IFNULL(penjelasan3,'')penjelasan3,
					IFNULL(hpoin4,'')hpoin4,IFNULL(dpoin4,'')dpoin4,IFNULL(uraian4,'')uraian4,IFNULL(jawaban4,'')jawaban4,IFNULL(penjelasan4,'')penjelasan4,
					IFNULL(hpoin5,'')hpoin5,IFNULL(dpoin5,'')dpoin5,IFNULL(uraian5,'')uraian5,IFNULL(jawaban5,'')jawaban5,IFNULL(penjelasan5,'')penjelasan5
					FROM(
						SELECT DISTINCT tahun,kd_apip,kd_elemen,kd_topik,kd_penilaian,(SELECT hpoin FROM tpenilaian WHERE tahun=a.tahun AND kd_apip=a.kd_apip AND kd_elemen=a.kd_elemen 
						AND kd_topik=a.kd_topik AND kd_penilaian=a.kd_penilaian AND kd_level=1)AS hpoin1,
						(SELECT dpoin FROM tpenilaian WHERE tahun=a.tahun AND kd_apip=a.kd_apip AND kd_elemen=a.kd_elemen 
						AND kd_topik=a.kd_topik AND kd_penilaian=a.kd_penilaian AND kd_level=1) AS dpoin1,
						(SELECT jawaban FROM tpenilaian WHERE tahun=a.tahun AND kd_apip=a.kd_apip AND kd_elemen=a.kd_elemen 
						AND kd_topik=a.kd_topik AND kd_penilaian=a.kd_penilaian AND kd_level=1) AS jawaban1,
						(SELECT uraian FROM tpenilaian WHERE tahun=a.tahun AND kd_apip=a.kd_apip AND kd_elemen=a.kd_elemen 
						AND kd_topik=a.kd_topik AND kd_penilaian=a.kd_penilaian AND kd_level=1) AS uraian1,
						(SELECT penjelasan FROM tpenilaian WHERE tahun=a.tahun AND kd_apip=a.kd_apip AND kd_elemen=a.kd_elemen 
						AND kd_topik=a.kd_topik AND kd_penilaian=a.kd_penilaian AND kd_level=1) AS penjelasan1,
						(SELECT hpoin FROM tpenilaian WHERE tahun=a.tahun AND kd_apip=a.kd_apip AND kd_elemen=a.kd_elemen 
						AND kd_topik=a.kd_topik AND kd_penilaian=a.kd_penilaian AND kd_level=2) AS hpoin2,
						(SELECT dpoin FROM tpenilaian WHERE tahun=a.tahun AND kd_apip=a.kd_apip AND kd_elemen=a.kd_elemen 
						AND kd_topik=a.kd_topik AND kd_penilaian=a.kd_penilaian AND kd_level=2) AS dpoin2,
						(SELECT jawaban FROM tpenilaian WHERE tahun=a.tahun AND kd_apip=a.kd_apip AND kd_elemen=a.kd_elemen 
						AND kd_topik=a.kd_topik AND kd_penilaian=a.kd_penilaian AND kd_level=2) AS jawaban2,
						(SELECT uraian FROM tpenilaian WHERE tahun=a.tahun AND kd_apip=a.kd_apip AND kd_elemen=a.kd_elemen 
						AND kd_topik=a.kd_topik AND kd_penilaian=a.kd_penilaian AND kd_level=2) AS uraian2,
						(SELECT penjelasan FROM tpenilaian WHERE tahun=a.tahun AND kd_apip=a.kd_apip AND kd_elemen=a.kd_elemen 
						AND kd_topik=a.kd_topik AND kd_penilaian=a.kd_penilaian AND kd_level=2) AS penjelasan2,
						(SELECT hpoin FROM tpenilaian WHERE tahun=a.tahun AND kd_apip=a.kd_apip AND kd_elemen=a.kd_elemen 
						AND kd_topik=a.kd_topik AND kd_penilaian=a.kd_penilaian AND kd_level=3)AS hpoin3,
						(SELECT dpoin FROM tpenilaian WHERE tahun=a.tahun AND kd_apip=a.kd_apip AND kd_elemen=a.kd_elemen 
						AND kd_topik=a.kd_topik AND kd_penilaian=a.kd_penilaian AND kd_level=3) AS dpoin3,
						(SELECT jawaban FROM tpenilaian WHERE tahun=a.tahun AND kd_apip=a.kd_apip AND kd_elemen=a.kd_elemen 
						AND kd_topik=a.kd_topik AND kd_penilaian=a.kd_penilaian AND kd_level=3) AS jawaban3,
						(SELECT uraian FROM tpenilaian WHERE tahun=a.tahun AND kd_apip=a.kd_apip AND kd_elemen=a.kd_elemen 
						AND kd_topik=a.kd_topik AND kd_penilaian=a.kd_penilaian AND kd_level=3) AS uraian3,
						(SELECT penjelasan FROM tpenilaian WHERE tahun=a.tahun AND kd_apip=a.kd_apip AND kd_elemen=a.kd_elemen 
						AND kd_topik=a.kd_topik AND kd_penilaian=a.kd_penilaian AND kd_level=3) AS penjelasan3,
						(SELECT hpoin FROM tpenilaian WHERE tahun=a.tahun AND kd_apip=a.kd_apip AND kd_elemen=a.kd_elemen 
						AND kd_topik=a.kd_topik AND kd_penilaian=a.kd_penilaian AND kd_level=4) AS hpoin4,
						(SELECT dpoin FROM tpenilaian WHERE tahun=a.tahun AND kd_apip=a.kd_apip AND kd_elemen=a.kd_elemen 
						AND kd_topik=a.kd_topik AND kd_penilaian=a.kd_penilaian AND kd_level=4) AS dpoin4,
						(SELECT jawaban FROM tpenilaian WHERE tahun=a.tahun AND kd_apip=a.kd_apip AND kd_elemen=a.kd_elemen 
						AND kd_topik=a.kd_topik AND kd_penilaian=a.kd_penilaian AND kd_level=4) AS jawaban4,
						(SELECT uraian FROM tpenilaian WHERE tahun=a.tahun AND kd_apip=a.kd_apip AND kd_elemen=a.kd_elemen 
						AND kd_topik=a.kd_topik AND kd_penilaian=a.kd_penilaian AND kd_level=4) AS uraian4,
						(SELECT penjelasan FROM tpenilaian WHERE tahun=a.tahun AND kd_apip=a.kd_apip AND kd_elemen=a.kd_elemen 
						AND kd_topik=a.kd_topik AND kd_penilaian=a.kd_penilaian AND kd_level=4) AS penjelasan4,
						(SELECT hpoin FROM tpenilaian WHERE tahun=a.tahun AND kd_apip=a.kd_apip AND kd_elemen=a.kd_elemen 
						AND kd_topik=a.kd_topik AND kd_penilaian=a.kd_penilaian AND kd_level=5) AS hpoin5,
						(SELECT dpoin FROM tpenilaian WHERE tahun=a.tahun AND kd_apip=a.kd_apip AND kd_elemen=a.kd_elemen 
						AND kd_topik=a.kd_topik AND kd_penilaian=a.kd_penilaian AND kd_level=5) AS dpoin5,
						(SELECT jawaban FROM tpenilaian WHERE tahun=a.tahun AND kd_apip=a.kd_apip AND kd_elemen=a.kd_elemen 
						AND kd_topik=a.kd_topik AND kd_penilaian=a.kd_penilaian AND kd_level=5) AS jawaban5,
						(SELECT uraian FROM tpenilaian WHERE tahun=a.tahun AND kd_apip=a.kd_apip AND kd_elemen=a.kd_elemen 
						AND kd_topik=a.kd_topik AND kd_penilaian=a.kd_penilaian AND kd_level=5) AS uraian5,
						(SELECT penjelasan FROM tpenilaian WHERE tahun=a.tahun AND kd_apip=a.kd_apip AND kd_elemen=a.kd_elemen 
						AND kd_topik=a.kd_topik AND kd_penilaian=a.kd_penilaian AND kd_level=5) AS penjelasan5
						FROM(
							SELECT DISTINCT aa.tahun,aa.kd_apip,aa.kd_elemen,aa.kd_topik,aa.kd_penilaian FROM tpenilaian aa INNER JOIN 
							ms_group_menu_elemen bb ON aa.tahun=bb.tahun AND aa.kd_apip=bb.kd_apip AND aa.kd_elemen=bb.kd_elemen AND aa.kd_topik=bb.kd_topik 
							WHERE aa.tahun='".$ctahun."' AND aa.kd_apip='".$cinstansi."' AND aa.kd_elemen='".$celemen."' AND bb.id_group='".$akses."'  
						)a
					)z
				)xx

				)abc ORDER BY tahun,kd_apip,kd_elemen,kd_topik,CAST(kd_penilaian AS INT)"; 			
												
								
								
								
							$keluaran = $this->db->query($csql)->result();

							foreach ($keluaran as $row) {
										$cjenis 		= $row->jns;
										$curaitopik 	= $row->uraitopik;
										$ckd_topik 		= $row->kd_topik;
										$ckd_penilaian 	= $row->kd_penilaian;
										$chpoin1 		= $row->hpoin1;
										$cdpoin1 		= $row->dpoin1;
										$curai1 		= $row->uraian1;
										$cjwb1 			= $row->jawaban1;
										
										$chpoin2 		= $row->hpoin2;
										$cdpoin2 		= $row->dpoin2;
										$curai2 		= $row->uraian2;
										$cjwb2 			= $row->jawaban2;
										
										$chpoin3 		= $row->hpoin3;
										$cdpoin3 		= $row->dpoin3;
										$curai3 		= $row->uraian3;
										$cjwb3 			= $row->jawaban3;
										
										$chpoin4 		= $row->hpoin4;
										$cdpoin4 		= $row->dpoin4;
										$curai4 		= $row->uraian4;
										$cjwb4 			= $row->jawaban4;
										
										$chpoin5 		= $row->hpoin5;
										$cdpoin5 		= $row->dpoin5;
										$curai5 		= $row->uraian5;
										$cjwb5 			= $row->jawaban5;
										
										$cpenjelasan1	= $row->penjelasan1;
										$cpenjelasan2	= $row->penjelasan2;
										$cpenjelasan3	= $row->penjelasan3;
										$cpenjelasan4	= $row->penjelasan4;
										$cpenjelasan5	= $row->penjelasan5;
										
										if($chpoin1=='' and $cdpoin1=='' and $curai1=='' and $ckd_penilaian<>''){
											//$ckd1 			= '';
											$chpoin1 		= '';
											$cdpoin1 		= '';
											$curai1 		= '';
											$cjwb1 			= '';
										}else{
											//$ckd1 			= $row->kd1;
											$chpoin1 		= $row->hpoin1;
											$cdpoin1 		= $row->dpoin1;
											$curai1 		= $row->uraian1;
											$cjwb1 			= $row->jawaban1;
										}
										
										
										
										if($chpoin2=='' and $cdpoin2=='' and $curai2=='' and $ckd_penilaian<>''){
											//$ckd2 			= '';
											$chpoin2 		= '';
											$cdpoin2 		= '';
											$curai2 		= '';
											$cjwb2 			= '';											
										}else{
											//$ckd2 			= $row->kd2;
											$chpoin2 		= $row->hpoin2;
											$cdpoin2 		= $row->dpoin2;
											$curai2 		= $row->uraian2;
											$cjwb2 			= $row->jawaban2;											
											
										}
										
										
										
										if($chpoin3=='' and $cdpoin3=='' and $curai3=='' and $ckd_penilaian<>''){
											//$ckd3 			= '';
											$chpoin3 		= '';
											$cdpoin3 		= '';
											$curai3 		= '';
											$cjwb3 			= '';											
										}else{
											//$ckd3 			= $row->kd3;
											$chpoin3 		= $row->hpoin3;
											$cdpoin3 		= $row->dpoin3;
											$curai3 		= $row->uraian3;
											$cjwb3 			= $row->jawaban3;											
											
										}
										
										
										if($chpoin4=='' and $cdpoin4=='' and $curai4=='' and $ckd_penilaian<>''){
										//	$ckd4 			= '';
											$chpoin4 		= '';
											$cdpoin4 		= '';
											$curai4 		= '';
											$cjwb4 			= '';											
										}else{
										//	$ckd4 			= $row->kd4;
											$chpoin4 		= $row->hpoin4;
											$cdpoin4 		= $row->dpoin4;
											$curai4 		= $row->uraian4;
											$cjwb4 			= $row->jawaban4;											
											
										}
										
										
										if($chpoin5=='' and $cdpoin5=='' and $curai5=='' and $ckd_penilaian<>''){
											//$ckd5 			= '';
											$chpoin5 		= '';
											$cdpoin5 		= '';
											$curai5 		= '';
											$cjwb5 			= '';											
										}else{
											//$ckd5 			= $row->kd5;
											$chpoin5 		= $row->hpoin5;
											$cdpoin5 		= $row->dpoin5;
											$curai5 		= $row->uraian5;
											$cjwb5 			= $row->jawaban5;											
											
										}
										
										
										$csimtopik		= '';
										$cimprovtopik 	= '';
										
										$cRet .= "<tr>";
										if($cjenis==1){
											
											$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px;border-bottom:hidden;\">".$ckd_topik."</td>";
											
											$cRet .= "<td style=\"font-size:6pt;text-align:left;padding:5px;\">".$curaitopik."</td>";
											$cRet .= "<td colspan=\"3\" style=\"font-size:6pt;text-align:left;padding:5px;\">".$curai1."</td>";
											$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px\">".$cjwb1."</td>";
											
											$cRet .= "<td colspan=\"3\" style=\"font-size:6pt;text-align:left;padding:5px;\">".$curai2."</td>";
											$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px;\">".$cjwb2."</td>";
											
											$cRet .= "<td colspan=\"3\" style=\"font-size:6pt;text-align:left;padding:5px;\">".$curai3."</td>";
											$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px;\">".$cjwb3."</td>";
											
											$cRet .= "<td colspan=\"3\" style=\"font-size:6pt;text-align:left;padding:5px;\">".$curai4."</td>";
											$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px;\">".$cjwb4."</td>";
											
											$cRet .= "<td colspan=\"3\" style=\"font-size:6pt;text-align:left;padding:5px;\">".$curai5."</td>";
											$cRet .= " <td style=\"font-size:6pt;text-align:center;padding:5px;\">".$cjwb5."</td>";
											
											$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px;\">".$csimtopik."</td>";
											$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px;\">".$cimprovtopik."</td>";
											
											
											
										}else{
											$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px;border-top:hidden;\"></td>";
											
											if($ckd_penilaian==1){
												$cRet .= "<td style=\"font-size:6pt;text-align:left;padding:5px;border-top:hidden;\">Keterangan : ".$curaitopik."</td>";
											
											}else{
												$cRet .= "<td style=\"font-size:6pt;text-align:left;padding:5px;border-top:hidden;\"></td>";
											
											}
											
											
											
											if($cpenjelasan1==''){
												$cjawaban1 = "<td style=\"font-size:6pt;text-align:center;padding:5px;vertical-align: text-top;\" bgcolor=\"#CCCCCC\"></td>";
											}else{
												$cjawaban1 = "<td style=\"font-size:6pt;text-align:center;padding:5px;vertical-align: text-top;\">".$cjwb1."</td>";
											}
											
											
											if($chpoin1!==''){
													$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px;vertical-align: text-top;\">".$chpoin1."</td>";
											}else{
													$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px;border-top:hidden;vertical-align: text-top;\">".$chpoin1."</td>";
											}
											
											if($cdpoin1!==''){
													$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px;vertical-align: text-top;\">".$cdpoin1."</td>";
													$cRet .= "<td style=\"font-size:6pt;text-align:left;padding:5px;vertical-align: text-top;\">".$curai1."</td>";
													$cRet .= $cjawaban1;
											}else{
											
												if($chpoin1!==''){
													$cRet .= "<td colspan=\"2\" style=\"font-size:6pt;text-align:left;padding:5px;vertical-align: text-top;\">".$curai1."</td>";
													$cRet .= $cjawaban1;
												}else{
													$cRet .= "<td colspan=\"2\" style=\"font-size:6pt;text-align:left;padding:5px;border-top:hidden;vertical-align: text-top;\">".$curai1."</td>";
													$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px;border-top:hidden;vertical-align: text-top;\">".$cjwb1."</td>";
												}
											
											}
											
											
											
											if($chpoin2!==''){
												$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px;vertical-align: text-top;\">".$chpoin2."</td>";
											}else{
												$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px;border-top:hidden;vertical-align: text-top;\">".$chpoin2."</td>";
											}
											
											if($cpenjelasan2==''){
												$cjawaban2 = "<td style=\"font-size:6pt;text-align:center;padding:5px;vertical-align: text-top;\" bgcolor=\"#CCCCCC\"></td>";
											}else{
												$cjawaban2 = "<td style=\"font-size:6pt;text-align:center;padding:5px;vertical-align: text-top;\">".$cjwb2."</td>";
											}
											
											
											if($cdpoin2!==''){
												$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px;vertical-align: text-top;\">".$cdpoin2."</td>";
												$cRet .= "<td style=\"font-size:6pt;text-align:left;padding:5px;vertical-align: text-top;\">".$curai2."</td>";
												$cRet .= $cjawaban2;
											}else{
											
												if($chpoin2!==''){
													$cRet .= "<td colspan=\"2\" style=\"font-size:6pt;text-align:left;padding:5px;vertical-align: text-top;\">".$curai2."</td>";
													$cRet .= $cjawaban2;
												}else{
													$cRet .= "<td colspan=\"2\" style=\"font-size:6pt;text-align:left;padding:5px;border-top:hidden;vertical-align: text-top;\">".$curai2."</td>";
													$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px;border-top:hidden;vertical-align: text-top;\">".$cjwb2."</td>";
												}
											
											}						
											
			
											if($chpoin3!==''){
												$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px;vertical-align: text-top;\">".$chpoin3."</td>";
											}else{
												$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px;border-top:hidden;vertical-align: text-top;\">".$chpoin3."</td>";
											}
											
											if($cpenjelasan3==''){
												$cjawaban3 = "<td style=\"font-size:6pt;text-align:center;padding:5px;vertical-align: text-top;\" bgcolor=\"#CCCCCC\"></td>";
											}else{
												$cjawaban3 = "<td style=\"font-size:6pt;text-align:center;padding:5px;vertical-align: text-top;\">".$cjwb3."</td>";
											}											
											
											
											if($cdpoin3!==''){
												$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px;vertical-align: text-top;\">".$cdpoin3."</td>";
												$cRet .= "<td style=\"font-size:6pt;text-align:left;padding:5px;vertical-align: text-top;\">".$curai3."</td>";
												$cRet .= $cjawaban3;
											}else{
											
												if($chpoin3!==''){
													$cRet .= "<td colspan=\"2\" style=\"font-size:6pt;text-align:left;padding:5px;vertical-align: text-top;\">".$curai3."</td>";
													$cRet .= $cjawaban3;
												}else{
													$cRet .= "<td colspan=\"2\" style=\"font-size:6pt;text-align:left;padding:5px;border-top:hidden;vertical-align: text-top;\">".$curai3."</td>";
													$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px;border-top:hidden;vertical-align: text-top;\">".$cjwb3."</td>";
												}
											
											}			
								

											if($chpoin4!==''){
												$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px;vertical-align: text-top;\">".$chpoin4."</td>";
											}else{
												$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px;border-top:hidden;vertical-align: text-top;\">".$chpoin4."</td>";
											}
											
											if($cpenjelasan4==''){
												$cjawaban4 = "<td style=\"font-size:6pt;text-align:center;padding:5px;vertical-align: text-top;\" bgcolor=\"#CCCCCC\"></td>";
											}else{
												$cjawaban4 = "<td style=\"font-size:6pt;text-align:center;padding:5px;vertical-align: text-top;\">".$cjwb4."</td>";
											}											
											
											if($cdpoin4!==''){
												$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px;vertical-align: text-top;\">".$cdpoin4."</td>";
												$cRet .= "<td style=\"font-size:6pt;text-align:left;padding:5px;vertical-align: text-top;\">".$curai4."</td>";
												$cRet .= $cjawaban4;
											}else{
											
												if($chpoin4!==''){
													$cRet .= "<td colspan=\"2\" style=\"font-size:6pt;text-align:left;padding:5px;vertical-align: text-top;\">".$curai4."</td>";
													$cRet .= $cjawaban4;
												}else{
													$cRet .= "<td colspan=\"2\" style=\"font-size:6pt;text-align:left;padding:5px;border-top:hidden;vertical-align: text-top;\">".$curai4."</td>";
													$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px;border-top:hidden;vertical-align: text-top;\">".$cjwb4."</td>";
												}
											
											}


								/* 	if($curai5==''){
										
										$cRet .= "<td style=\"font-size:6pt;text-align:left;padding:5px;border-bottom:hidden;vertical-align: text-top;\"></td>";
										$cRet .= "<td colspan=\"2\" style=\"font-size:6pt;text-align:left;padding:5px;border-bottom:hidden;vertical-align: text-top;\"></td>";
										$cRet .= "<td style=\"font-size:6pt;text-align:left;padding:5px;border-bottom:hidden;vertical-align: text-top;\"></td>";
										
									}else{
										 */
									
								
										if($chpoin5!==''){
												$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px;vertical-align: text-top;\">".$chpoin5."</td>";
											}else{
												$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px;border-top:xhidden;vertical-align: text-top;\">".$chpoin5."</td>";
											}
											
											if($cpenjelasan5==''){
												$cjawaban5 = "<td style=\"font-size:6pt;text-align:center;padding:5px;vertical-align: text-top;\" bgcolor=\"#CCCCCC\"></td>";
											}else{
												$cjawaban5 = "<td style=\"font-size:6pt;text-align:center;padding:5px;vertical-align: text-top;\">".$cjwb5."</td>";
											}											
											
											if($cdpoin5!==''){
												$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px;vertical-align: text-top;\">".$cdpoin5."</td>";
												$cRet .= "<td style=\"font-size:6pt;text-align:left;padding:5px;vertical-align: text-top;\">".$curai5."</td>";
												$cRet .= $cjawaban5;
											}else{
											
												if($chpoin5!==''){
													$cRet .= "<td colspan=\"2\" style=\"font-size:6pt;text-align:left;padding:5px;vertical-align: text-top;\">".$curai5."</td>";
													$cRet .= $cjawaban5;
												}else{
													$cRet .= "<td colspan=\"2\" style=\"font-size:6pt;text-align:left;padding:5px;border-top:xhidden;vertical-align: text-top;\">".$curai5."</td>";
													$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px;border-top:xhidden;vertical-align: text-top;\">".$cjwb5."</td>";
												}
											
											}
								
								//	}	
								
								
											$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px;vertical-align: text-top;\">".$csimtopik."</td>";
											$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px;vertical-align: text-top;\">".$cimprovtopik."</td>";
										

										
											
								}
										
										
							}
								$cRet .= "</tr></table></div>"; 

					
		if ($ctipe == 'prev') {
			echo $cRet;
		}else{
			return $cRet;
		}
	}


	public function pdf_laporan($ctahun='',$cinstansi='',$celemen='',$ctipe='')
	{
		$header = '';
		$body=$this->laporan_mandiri($ctahun,$cinstansi,$celemen,$ctipe); 
		
		$filename = 'Kertas-Kerja-Penilaian-Mandiri-Kapabilitas-APIP'.$celemen.'.pdf'; 
		$this->PublicModel->_mpdf('',$header,$body,10,10,25,10,10,'L',1,true,'A4',$filename);
		
		
	}

	public function excel_laporan($ctahun='',$cinstansi='',$celemen='',$ctipe='')
	{
		
		 $data['html']= $this->laporan_mandiri($ctahun,$cinstansi,$celemen,$ctipe);
		 $this->load->view('cetakan/PenilaianMandiriKapabilitasAPIP',$data);
		
	}




	public function get_parameter_mdb()
	{

		$daerah = $this->input->post('kab');

		$data = $this->kd_model->get_parameter_mdb($daerah);
		echo ($data);
	}



}
