<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaptriAngrealController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
/* 		$this->load->model('profil/InfoKeuanganDaerahModel', 'kd_model');
		$this->load->model('tlhp/TlhpBpkLapKeuModel', 'tlhp_model' ); */
		$this->load->model('kapip/ProfilApipModel', 'ApipModel');
		$this->load->model('PublicModel');
	}

	public function index()
	{

		//$data['satker'] 		= $this->pubModel->satker_bpk();
		
		$data['instansi'] 		= $this->ApipModel->getInstansi();
		$data['view'] = 'kapip/laporan/laporanAngrealView';
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


	function prev_laporan_asli(){ 

		$ctahun = $this->input->post('ctahun');	
		$cinstansi = $this->input->post('cinstansi');			
		$ctriw = $this->input->post('ctriw');
		$ctipe = $this->input->post('ctipe');
		
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
		$cRet .= '<div class="tab-content">';
		$cRet .= "<div role='tabpanel' class='tab-pane active' id='forma'>";

		
		/* $sql = "SELECT * from trh_tlhp_bpklapkeu where id_instansi = '$satker' and tahun = '$tahun'";
		$res = $this->db->query($sql)->result(); */
		

		$cRet .= "<table width=\"100%\"><tr>
							<td width=\"100%\" align=\"center\" colspan=\"9\">
								<span><h4><b>Anggaran dan Realisasi Keuangan APIP</b></h4></span>
								<span><h4><b>$cnminstansi</b></h4></span>
								<span><h4><b>Tahun $ctahun Triwulan $triw</b></h4></span>
							</td>
							</tr></table>";
							
				$cRet .= "<div style='overflow-x:auto;'><table style=\"border-collapse:collapse;\" style=\"font-size:12\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
									<thead>
									<tr bgcolor=\"#CCCCCC\">
										<th rowspan	=\"2\"  style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Anggaran K/L/D<b></th>
										<th colspan	=\"8\" style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Anggaran APIP</b></th>
										<th colspan	=\"4\" style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Realisasi Anggaran</b></th>
										<th colspan	=\"4\" style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Realisasi Operasional Pengawasan</b></th>
										
									</tr>
									<tr bgcolor=\"#CCCCCC\">
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Total Anggaran APIP</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>% Total Anggaran APIP thd<br> Anggaran K/L/P</b></th>
										<th style=\"font-size:7pt;text-align:center\" align=\"center\"><b>Minimal % Anggaran APIP <br>Daerah dari APBD <br>(sesuai Permendagri 33/2019)</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Sesuai/Tidak Sesuai Ketentuan</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Operasional Pengawasan APIP</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>% Anggaran Operasional <br>Pengawasan thd Total <br>Anggaran APIP</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Program Peningkatan <br>SDM APIP</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>% Anggaran Program <br>Peningkatan SDM thd Total <br>Anggaran APIP</b></th>
										<th colspan	=\"2\"  style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Operasional Pengawasan</b></th>
										
										
										<th colspan	=\"2\" style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Program Peningkatan SDM</b></th>
										<th colspan	=\"2\" style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Assurance</b></th>
										<th colspan	=\"2\" style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Consulting</b></th>
									</tr>
							
									<tr bgcolor=\"#CCCCCC\">
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Rp</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Rp</b></th>
										<th style=\"font-size:7pt;text-align:center\" align=\"center\"><b>%</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>%</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b></b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Rp</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>%</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Rp</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>%</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Rp</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>%</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Rp</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>%</b></th>
										
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Rp</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>%</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Rp</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>%</b></th>
									</tr>		

									<tr bgcolor=\"#CCCCCC\">
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>1</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>2</b></th>
										<th style=\"font-size:7pt;text-align:center\" align=\"center\"><b>(3 = 2/1)</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>4</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>5</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>6</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>(7=6/2)</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>8</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>(9=8/2)</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>10</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>(11=10/6)</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>12</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>(13=12/8)</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>14</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>(15=14/10)</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>16</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>(17=16/10)</b></th>
									</tr>		
									
									</thead>
									<tbody>";							
							
							
							$csql = "SELECT a.kd_apip,a.tahun,a.triw,a.id_angreal,b.kolom,a.nilai,b.jenis FROM tprofil_angreal a
										INNER JOIN tmaplaptri_angreal b ON a.id_angreal=b.id_angreal 
										WHERE a.tahun='".$ctahun."' AND a.kd_apip='".$cinstansi."' AND a.triw='".$ctriw."'
										GROUP BY a.kd_apip,a.tahun,a.triw,a.id_angreal,b.kolom order by kolom";
							$res = $this->db->query($csql)->result();
							
							$cRet .= "<tr>";	

							foreach ($res as $val) {
										$cjenis = $val->jenis;
										if($cjenis==1){
											$cnilai = number_format($val->nilai,2,',','.');
											$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px\">".$cnilai."</td>";
										}else{
											$cnilai = '';
											$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px\">".$cnilai."</td>";
										}
										
										
							}
								$cRet .= "</tr>";

					
		
		echo $cRet;
	}



	function prev_laporan(){ 

		$ctahun = $this->input->post('ctahun');	
		$cinstansi = $this->input->post('cinstansi');			
		$ctriw = $this->input->post('ctriw');
		$ctipe = $this->input->post('ctipe');
		
		//if($ctipe=='priv'){
			$cRet = $this->laporan_angreal($ctahun,$cinstansi,$ctriw,$ctipe);
			echo $cRet;
		
		//}
		
		
	}




	function laporan_angreal($ctahun,$cinstansi,$ctriw,$ctipe){ 

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
	//	$cRet .= '<div class="tab-content">';
	//	$cRet .= "<div role='tabpanel' class='tab-pane active'>";

		$cRet .= "<table width=\"100%\"><tr>
							<td width=\"100%\" align=\"center\" colspan=\"9\">
								<span><h4><b>Anggaran dan Realisasi Keuangan APIP</b></h4></span>
								<span><h4><b>$cnminstansi</b></h4></span>
								<span><h4><b>Tahun $ctahun Triwulan $triw</b></h4></span>
							</td>
							</tr></table>";
			
							
				$cRet .= "<div style='overflow-x:auto;'><table style=\"border-collapse:collapse;\" style=\"font-size:12\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
									<thead>
									<tr bgcolor=\"#CCCCCC\">
										<th rowspan	=\"2\"  style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Anggaran K/L/D<b></th>
										<th colspan	=\"8\" style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Anggaran APIP</b></th>
										<th colspan	=\"4\" style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Realisasi Anggaran</b></th>
										<th colspan	=\"4\" style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Realisasi Operasional Pengawasan</b></th>
										
									</tr>
									<tr bgcolor=\"#CCCCCC\">
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Total Anggaran APIP</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>% Total Anggaran APIP thd<br> Anggaran K/L/P</b></th>
										<th style=\"font-size:7pt;text-align:center\" align=\"center\"><b>Minimal % Anggaran APIP <br>Daerah dari APBD <br>(sesuai Permendagri 33/2019)</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Sesuai/Tidak Sesuai Ketentuan</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Operasional Pengawasan APIP</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>% Anggaran Operasional <br>Pengawasan thd Total <br>Anggaran APIP</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Program Peningkatan <br>SDM APIP</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>% Anggaran Program <br>Peningkatan SDM thd Total <br>Anggaran APIP</b></th>
										<th colspan	=\"2\"  style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Operasional Pengawasan</b></th>
										
										
										<th colspan	=\"2\" style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Program Peningkatan SDM</b></th>
										<th colspan	=\"2\" style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Assurance</b></th>
										<th colspan	=\"2\" style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Consulting</b></th>
									</tr>
							
									<tr bgcolor=\"#CCCCCC\">
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Rp</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Rp</b></th>
										<th style=\"font-size:7pt;text-align:center\" align=\"center\"><b>%</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>%</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b></b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Rp</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>%</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Rp</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>%</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Rp</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>%</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Rp</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>%</b></th>
										
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Rp</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>%</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Rp</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>%</b></th>
									</tr>		

									<tr bgcolor=\"#CCCCCC\">
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>1</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>2</b></th>
										<th style=\"font-size:7pt;text-align:center\" align=\"center\"><b>(3 = 2/1)</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>4</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>5</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>6</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>(7=6/2)</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>8</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>(9=8/2)</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>10</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>(11=10/6)</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>12</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>(13=12/8)</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>14</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>(15=14/10)</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>16</b></th>
										<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>(17=16/10)</b></th>
									</tr>		
									
									</thead>
											";							
							
							
							$csql = "SELECT a.kd_apip,a.tahun,a.triw,a.id_angreal,b.kolom,a.nilai,b.jenis FROM tprofil_angreal a
										INNER JOIN tmaplaptri_angreal b ON a.id_angreal=b.id_angreal 
										WHERE a.tahun='".$ctahun."' AND a.kd_apip='".$cinstansi."' AND a.triw='".$ctriw."'
										GROUP BY a.kd_apip,a.tahun,a.triw,a.id_angreal,b.kolom order by kolom";
							$res = $this->db->query($csql)->result();
							
					$cRet .= "<tr>";	

							foreach ($res as $val) {
										$cjenis = $val->jenis;
										if($cjenis==1){
											$cnilai = number_format($val->nilai,2,',','.');
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
		$body=$this->laporan_angreal($ctahun,$cinstansi,$ctriw,$ctipe); 
		
		$filename = 'Anggaran-Realisasi-Keuangan-APIP-Triwulan'.$ctriw.'.pdf'; 
		$this->PublicModel->_mpdf('',$header,$body,10,10,25,10,10,'L',1,true,'A4',$filename);
		
		
	}

	public function excel_laporan($ctahun='',$cinstansi='',$ctriw='',$ctipe='')
	{
		
		 $data['html']= $this->laporan_angreal($ctahun,$cinstansi,$ctriw,$ctipe);
		 $this->load->view('cetakan/cetakanAngReal',$data);
		
	}




	public function get_parameter_mdb()
	{

		$daerah = $this->input->post('kab');

		$data = $this->kd_model->get_parameter_mdb($daerah);
		echo ($data);
	}



}
