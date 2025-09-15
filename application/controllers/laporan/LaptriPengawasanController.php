<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaptriPengawasanController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('kapip/ProfilApipModel', 'ApipModel');
		$this->load->model('PublicModel');
	}

	public function index()
	{

		//$data['satker'] 		= $this->pubModel->satker_bpk();
		
		$data['instansi'] 		= $this->ApipModel->getInstansi();
		$data['view'] = 'kapip/laporan/laporanPengawasanView';
		$this->load->view('template/layout', $data);
	}

	public function index_2()
	{

		$data['satker'] 		= $this->pubModel->satker_bpk();
		$data['view'] = 'laporan/laporanTLHPBPKView';
		$this->load->view('template/layout', $data);
	}

	public function numToAlpha($number) {
    $number = intval($number);
    if ($number <= 0) {
       return '';
    }
    $alphabet = '';
    while($number != 0) {
       $p = ($number - 1) % 26;
       $number = intval(($number - $p) / 26);
       $alphabet = chr(65 + $p) . $alphabet;
   }
   return strtolower($alphabet);
  }




	function prev_laporan(){ 

		$ctahun = $this->input->post('ctahun');	
		$cinstansi = $this->input->post('cinstansi');			
		$ctriw = $this->input->post('ctriw');
		$ctipe = $this->input->post('ctipe');
		
		//if($ctipe=='priv'){
			$cRet = $this->laporan_pengawasan($ctahun,$cinstansi,$ctriw,$ctipe);
			echo $cRet;
		
		//}
		
		
	}




	function laporan_pengawasan($ctahun,$cinstansi,$ctriw,$ctipe){ 

		$cnminstansi	 = $this->PublicModel->get_nama($cinstansi,'nm_apip','ms_apip','kd_apip');	
		
		
		if($ctriw==1){
			$triw='I';
		}else if($ctriw==2){
			$triw='II';
		}else if($ctriw==3){
			$triw='III';
		}else{
			$triw='IV';
		}
		
		
		$cRet ="";

		$cRet .= "<table width=\"100%\"><tr>
							<td width=\"100%\" align=\"center\" colspan=\"9\">
								<h4><b>Realisasi Kegiatan Operasional Pengawasan APIP</b></h4>
								<h4><b>$cnminstansi</b></h4>
								<h4><b>Tahun $ctahun Triwulan $triw</b></h4>
							</td>
							</tr></table>";
			
							
				$cRet .= "<div style='overflow-x:auto;'><table style=\"border-collapse:collapse;\" style=\"font-size:12\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
									<thead>
									<tr bgcolor=\"#CCCCCC\">
										<th colspan	=\"9\"  style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Jumlah Realisasi Penugasan Kegiatan Asurans<b></th>
										<th colspan	=\"3\" style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Jasa Konsultansi</b></th>
											
									</tr>
									<tr bgcolor=\"#CCCCCC\">
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Audit Ketaatan</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Audit Kinerja</b></th>
										<th style=\"font-size:7pt;text-align:center\" align=\"center\"><b>Asurans atas GRC</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Audit Investigasi</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Audit Tujuan Tertentu</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Reviu</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Evaluasi</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Pemantauan/Monitoring</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Asurans Lainnya</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Bimtek</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Pendampingan/ Asistensi</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Jasa Konsultansi Lainnya</b></th>
									</tr>
							
									<tr bgcolor=\"#CCCCCC\">
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>1</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>2</b></th>
										<th style=\"font-size:7pt;text-align:center\" align=\"center\"><b>3</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>4</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>5</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>6</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>7</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>8</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>9</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>10</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>11</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>12</b></th>
									</tr>		

									
									</thead>
											";							
							
							
							$csql = "SELECT a.kd_apip,a.tahun,a.triw,a.id_pengawasan,b.kolom,a.nilai,b.jenis FROM tprofil_pengawasan a
										INNER JOIN tmaplaptri_pengawasan b ON a.id_pengawasan=b.id_pengawasan 
										WHERE a.tahun='".$ctahun."' AND a.kd_apip='".$cinstansi."' AND a.triw='".$ctriw."'
										GROUP BY a.kd_apip,a.tahun,a.triw,a.id_pengawasan,b.kolom ORDER BY kolom";
							$res = $this->db->query($csql)->result();
							
					$cRet .= "<tr>";	

							foreach ($res as $val) {
										$cjenis = $val->jenis;
										if($cjenis==1){
											$cnilai = number_format($val->nilai,0,',','.');
											$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px\">".$cnilai."</td>";
										}else{
											$cnilai = '';
											$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px\">".$cnilai."</td>";
										}
										
										
							}
								$cRet .= "</tr></table></div>"; 

					
		if ($ctipe == 'prev') {
			echo $cRet;
		}else{
			return $cRet;
		}
	}





	public function pdf_laporan($ctahun='',$cinstansi='',$ctriw='',$ctipe='')
	{
		$header = '';
		$body=$this->laporan_pengawasan($ctahun,$cinstansi,$ctriw,$ctipe); 
		
		$filename = 'Realisasi-Kegiatan-Operasional-Pengawasan-APIP'.$ctriw.'.pdf'; 
		$this->PublicModel->_mpdf('',$header,$body,10,10,25,10,10,'L',1,true,'A4',$filename);
		
		
	}

	public function excel_laporan($ctahun='',$cinstansi='',$ctriw='',$ctipe='')
	{
		
		 $data['html']= $this->laporan_pengawasan($ctahun,$cinstansi,$ctriw,$ctipe);
		 $this->load->view('cetakan/cetakanPengawasan',$data);
		
	}




	public function get_parameter_mdb()
	{

		$daerah = $this->input->post('kab');

		$data = $this->kd_model->get_parameter_mdb($daerah);
		echo ($data);
	}



}
