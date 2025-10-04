<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RealisasiController extends CI_Controller
{
	private $db2;
	public function __construct()
	{
		parent::__construct();
		$this->db2 = $this->load->database('db2', TRUE);
		$this->load->model('PublicModel');
	}

	public function index()
	{
		
		$data['instansi'] 		= $this->PublicModel->getInstansi();
		$data['kecamatan'] 		= $this->PublicModel->getKecamatan();
		$data['view'] 			= 'penerimaan/realisasiPenerimaanView';
		$this->load->view('template/layout', $data);
	}


	function prev_laporan(){  
		$startDate = $this->input->post('startDate');	
		$endDate = $this->input->post('endDate');
		$kecamatan = $this->input->post('kecamatan');
		$ctipe ='prev';			
		$cRet = $this->laporan($kecamatan,$startDate,$endDate,$ctipe);
		echo $cRet;
		
	}


	function laporan($kecamatan,$startDate,$endDate,$ctipe){ 

		$startDate = date('Y-m-d', strtotime($startDate));
		$endDate   = date('Y-m-d', strtotime($endDate));
		$cnminstansi	 = $this->PublicModel->getInstansi();
		$prop=$cnminstansi[0]->kd_propinsi;		
		$kab=$cnminstansi[0]->kd_dati2;	
		$kec=$kecamatan;
		$startDateIndo = $this->PublicModel->formatTanggalIndonesia($startDate);
		$endDateIndo   = $this->PublicModel->formatTanggalIndonesia($endDate);
		
	
		$cRet ="";
		$cRet .= "
		
		<style>
			body, table, td, h4 {
				font-family: 'Arial', sans-serif; 
			}
		</style>
		<table width=\"100%\"><tr>
							<td width=\"100%\" align=\"center\">
							  <h4><b>".strtoupper($cnminstansi[0]->nm_instansi)."</b></h4>
								<h4><b>LAPORAN REALISASI PENERIMAAN PBB</b></h4>								
								<h4><b>Periode $startDateIndo s/d $endDateIndo</b></h4>
							</td><br>
							</tr></table>";
			
							
				$cRet .= "<div style='overflow-x:auto;'><table style=\"border-collapse:collapse;\" style=\"font-size:10\" width=\"90%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
									<thead>
										<tr bgcolor=\"#d8a25e\" style=\"color:white\">
											<th width=\"40%\" rowspan	=\"3\" style=\"font-size:12pt;text-align:center;padding:5px\" align=\"center\"><b>Wilayah<b></th>
											<th width=\"30%\" colspan	=\"5\" style=\"font-size:12pt;text-align:center;padding:5px\" align=\"center\"><b>Tunggakan</b></th>
											<th width=\"30%\" colspan	=\"5\" style=\"font-size:12pt;text-align:center;padding:5px\" align=\"center\"><b>Pokok</b></th>
											<th width=\"30%\" colspan	=\"5\" style=\"font-size:12pt;text-align:center;padding:5px\" align=\"center\"><b>Jumlah</b></th>
											
										</tr>
										<tr bgcolor=\"#d8a25e\" style=\"color:white\">
											<th width=\"10%\" rowspan	=\"2\" style=\"font-size:12pt;text-align:center;padding:5px\" align=\"center\"><b>STTS</b></th>
											<th width=\"10%\" colspan	=\"4\" style=\"font-size:12pt;text-align:center;padding:5px\" align=\"center\"><b>PBB</b></th>
											<th width=\"10%\" rowspan	=\"2\" style=\"font-size:12pt;text-align:center\" align=\"center\"><b>STTS</b></th>
											<th width=\"10%\" colspan	=\"4\" style=\"font-size:12pt;text-align:center;padding:5px\" align=\"center\"><b>PBB</b></th>
											<th width=\"10%\" rowspan	=\"2\" style=\"font-size:12pt;text-align:center\" align=\"center\"><b>STTS</b></th>
											<th width=\"10%\" colspan	=\"4\" style=\"font-size:12pt;text-align:center;padding:5px\" align=\"center\"><b>PBB</b></th>
										</tr>
										<tr bgcolor=\"#d8a25e\" style=\"color:white\">
											<th width=\"10%\" style=\"font-size:12pt;text-align:center;padding:5px\" align=\"center\"><b>Pokok</b></th>
											<th width=\"10%\" style=\"font-size:12pt;text-align:center;padding:5px\" align=\"center\"><b>Diskon</b></th>
											<th width=\"10%\" style=\"font-size:12pt;text-align:center\" align=\"center\"><b>Denda</b></th>
											<th width=\"10%\" style=\"font-size:12pt;text-align:center;padding:5px\" align=\"center\"><b>Dibayar</b></th>

											<th width=\"10%\" style=\"font-size:12pt;text-align:center;padding:5px\" align=\"center\"><b>Pokok</b></th>
											<th width=\"10%\" style=\"font-size:12pt;text-align:center;padding:5px\" align=\"center\"><b>Diskon</b></th>
											<th width=\"10%\" style=\"font-size:12pt;text-align:center\" align=\"center\"><b>Denda</b></th>
											<th width=\"10%\" style=\"font-size:12pt;text-align:center;padding:5px\" align=\"center\"><b>Dibayar</b></th>

											<th width=\"10%\" style=\"font-size:12pt;text-align:center;padding:5px\" align=\"center\"><b>Pokok</b></th>
											<th width=\"10%\" style=\"font-size:12pt;text-align:center;padding:5px\" align=\"center\"><b>Diskon</b></th>
											<th width=\"10%\" style=\"font-size:12pt;text-align:center\" align=\"center\"><b>Denda</b></th>
											<th width=\"10%\" style=\"font-size:12pt;text-align:center;padding:5px\" align=\"center\"><b>Dibayar</b></th>
											
										</tr>
							
									</thead>";		

							if($kec=='000'){
								$csql = "CALL get_real_penerimaan_kab('".$prop."','".$kab."','".$startDate."','".$endDate."')";							
								$res = $this->db2->query($csql)->result();						
							}else{
								$csql = "CALL get_real_penerimaan_kec('".$prop."','".$kab."','".$kec."','".$startDate."','".$endDate."')";							
								$res = $this->db2->query($csql)->result();								
							}

							$tjrec_tunggakan = 0;
							$tpokok_tunggakan = 0;
							$tdiskon_tunggakan = 0;
							$tdenda_tunggakan = 0;
							$tdibayarkan_tunggakan = 0;

							$tjrec_ini = 0;
							$tpokok_ini = 0;
							$tdiskon_ini = 0;
							$tdenda_ini = 0;
							$tdibayarkan_ini = 0;

							$tjrec_jumlah = 0;
							$tpokok_jumlah = 0;
							$tdiskon_jumlah = 0;
							$tdenda_jumlah = 0;
							$tdibayarkan_jumlah = 0;
							foreach ($res as $val) {
										$clevel = $val->clevel;
										
										$wilayah =  ucwords(strtolower($val->wilayah));
										$jrec_tunggakan = $val->jrec_tunggakan;
										$pokok_tunggakan = $val->pokok_tunggakan;
										$diskon_tunggakan = $val->diskon_tunggakan;
										$denda_tunggakan = $val->denda_tunggakan;
										$dibayarkan_tunggakan = $val->dibayarkan_tunggakan;

										$jrec_ini = $val->jrec_ini;
										$pokok_ini = $val->pokok_ini;
										$diskon_ini = $val->diskon_ini;
										$denda_ini = $val->denda_ini;
										$dibayarkan_ini = $val->dibayarkan_ini;	

										$jrec_jumlah = $val->jrec_jumlah;
										$pokok_jumlah = $val->pokok_jumlah;
										$diskon_jumlah = $val->diskon_jumlah;
										$denda_jumlah = $val->denda_jumlah;
										$dibayarkan_jumlah = $val->dibayarkan_jumlah;

										if($clevel==0){
											$tjrec_tunggakan =$tjrec_tunggakan+$jrec_tunggakan  ;
											$tpokok_tunggakan = $tpokok_tunggakan+$pokok_tunggakan;
											$tdiskon_tunggakan = $tdiskon_tunggakan+$diskon_tunggakan;
											$tdenda_tunggakan = $tdenda_tunggakan+$denda_tunggakan;
											$tdibayarkan_tunggakan = $tdibayarkan_tunggakan+$dibayarkan_tunggakan;

											$tjrec_ini = $tjrec_ini+$jrec_ini;
											$tpokok_ini = $tpokok_ini+$pokok_ini;
											$tdiskon_ini = $tdiskon_ini+$diskon_ini;
											$tdenda_ini = $tdenda_ini+$denda_ini;
											$tdibayarkan_ini = $tdibayarkan_ini+$dibayarkan_ini;

											$tjrec_jumlah = $tjrec_jumlah+$jrec_jumlah;
											$tpokok_jumlah = $tpokok_jumlah+$pokok_jumlah;
											$tdiskon_jumlah = $tdiskon_jumlah+$diskon_jumlah;
											$tdenda_jumlah = $tdenda_jumlah+$denda_jumlah;
											$tdibayarkan_jumlah = $tdibayarkan_jumlah+$dibayarkan_jumlah;
										}


										if($clevel==0){
											$abold='<b>';
											$nbold='<b>';
											$space='&nbsp;&nbsp;';
											$bgr ='background-color:#74C7B8;'; 
											$fsize ='font-size:12pt'; 
											
										}else{
											$abold='';
											$nbold='';
											$space='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
											$bgr ='';
											$fsize ='font-size:10pt';
											
										}	
										$cRet .= "<tr style=\"$bgr\">";
										$cRet .= "<td style=\"$fsize;text-align:left;padding:5px;\">".$abold.$wilayah.$nbold."</td>";
										$cRet .= "<td style=\"$fsize;text-align:center;padding:5px;\">".$abold.number_format($jrec_tunggakan, 0, ',', '.').$nbold."</td>";
										$cRet .= "<td style=\"$fsize;text-align:right;padding:5px;\">".$abold.number_format($pokok_tunggakan, 0, ',', '.').$nbold."</td>";
										$cRet .= "<td style=\"$fsize;text-align:right;padding:5px;\">".$abold.number_format($diskon_tunggakan, 0, ',', '.').$nbold."</td>";
										$cRet .= "<td style=\"$fsize;text-align:right;padding:5px;\">".$abold.number_format($denda_tunggakan, 0, ',', '.').$nbold."</td>";
										$cRet .= "<td style=\"$fsize;text-align:right;padding:5px;\">".$abold.number_format($dibayarkan_tunggakan, 0, ',', '.').$nbold."</td>";

										$cRet .= "<td style=\"$fsize;text-align:center;padding:5px;\">".$abold.number_format($jrec_ini, 0, ',', '.').$nbold."</td>";
										$cRet .= "<td style=\"$fsize;text-align:right;padding:5px;\">".$abold.number_format($pokok_ini, 0, ',', '.').$nbold."</td>";
										$cRet .= "<td style=\"$fsize;text-align:right;padding:5px;\">".$abold.number_format($diskon_ini, 0, ',', '.').$nbold."</td>";
										$cRet .= "<td style=\"$fsize;text-align:right;padding:5px;\">".$abold.number_format($denda_ini, 0, ',', '.').$nbold."</td>";
										$cRet .= "<td style=\"$fsize;text-align:right;padding:5px;\">".$abold.number_format($dibayarkan_ini, 0, ',', '.').$nbold."</td>";

										$cRet .= "<td style=\"$fsize;text-align:center;padding:5px;\">".$abold.number_format($jrec_jumlah, 0, ',', '.').$nbold."</td>";
										$cRet .= "<td style=\"$fsize;text-align:right;padding:5px;\">".$abold.number_format($pokok_jumlah, 0, ',', '.').$nbold."</td>";
										$cRet .= "<td style=\"$fsize;text-align:right;padding:5px;\">".$abold.number_format($diskon_jumlah, 0, ',', '.').$nbold."</td>";
										$cRet .= "<td style=\"$fsize;text-align:right;padding:5px;\">".$abold.number_format($denda_jumlah, 0, ',', '.').$nbold."</td>";
										$cRet .= "<td style=\"$fsize;text-align:right;padding:5px;\">".$abold.number_format($dibayarkan_jumlah, 0, ',', '.').$nbold."</td>";;
										
								$cRet .= "</tr>";		
							}
							
								$footbgr ='background-color:#d8a25e;';  
								$cRet .= "<tr style=\"$footbgr\">";
								$cRet .= "<td style=\"font-size:12pt;text-align:center;padding:5px;\"><b>TOTAL</b></td>";
								$cRet .= "<td style=\"font-size:12pt;text-align:center;padding:5px\"><b>".number_format($tjrec_tunggakan, 0, ',', '.')."</b></td>";
								$cRet .= "<td style=\"font-size:12pt;text-align:right;padding:5px\"><b>".number_format($tpokok_tunggakan, 0, ',', '.')."</b></td>";
								$cRet .= "<td style=\"font-size:12pt;text-align:right;padding:5px\"><b>".number_format($tdiskon_tunggakan, 0, ',', '.')."</b></td>";
								$cRet .= "<td style=\"font-size:12pt;text-align:right;padding:5px\"><b>".number_format($tdenda_tunggakan, 0, ',', '.')."</b></td>";
								$cRet .= "<td style=\"font-size:12pt;text-align:right;padding:5px\"><b>".number_format($tdibayarkan_tunggakan, 0, ',', '.')."</b></td>";

								$cRet .= "<td style=\"font-size:12pt;text-align:center;padding:5px\"><b>".number_format($tjrec_ini, 0, ',', '.')."</b></td>";
								$cRet .= "<td style=\"font-size:12pt;text-align:right;padding:5px\"><b>".number_format($tpokok_ini, 0, ',', '.')."</b></td>";
								$cRet .= "<td style=\"font-size:12pt;text-align:right;padding:5px\"><b>".number_format($tdiskon_ini, 0, ',', '.')."</b></td>";
								$cRet .= "<td style=\"font-size:12pt;text-align:right;padding:5px\"><b>".number_format($tdenda_ini, 0, ',', '.')."</b></td>";
								$cRet .= "<td style=\"font-size:12pt;text-align:right;padding:5px\"><b>".number_format($tdibayarkan_ini, 0, ',', '.')."</b></td>";

								$cRet .= "<td style=\"font-size:12pt;text-align:center;padding:5px\"><b>".number_format($tjrec_jumlah, 0, ',', '.')."</b></td>";
								$cRet .= "<td style=\"font-size:12pt;text-align:right;padding:5px\"><b>".number_format($tpokok_jumlah, 0, ',', '.')."</b></td>";
								$cRet .= "<td style=\"font-size:12pt;text-align:right;padding:5px\"><b>".number_format($tdiskon_jumlah, 0, ',', '.')."</b></td>";
								$cRet .= "<td style=\"font-size:12pt;text-align:right;padding:5px\"><b>".number_format($tdenda_jumlah, 0, ',', '.')."</b></td>";
								$cRet .= "<td style=\"font-size:12pt;text-align:right;padding:5px\"><b>".number_format($tdibayarkan_jumlah, 0, ',', '.')."</b></td>";
								$cRet .= "</tr>";	
								$cRet .= "</table></div>"; 

		if ($ctipe == 'prev') {
			echo $cRet;
		}else{
			return $cRet;
		}
	}


	public function pdf_laporan($kecamatan,$startDate,$endDate,$ctipe)  //$startDate,$endDate,$ctipe
	{
		$header = '';
		$body=$this->laporan($kecamatan,$startDate,$endDate,$ctipe); 
		
		$filename = 'Laporan-Realisasi-Penerimaan-PBB.pdf'; 
		$this->PublicModel->_mpdf('',$header,$body,10,10,25,10,10,'L',1,true,'A4',$filename);

	}


	public function excel_laporan($kecamatan,$startDate,$endDate,$ctipe)
	{
		 $data['title']= 'Laporan Realisasi Penerimaan PBB';
		 $data['filename']= 'Laporan-Realisasi-Penerimaan-PBB';
		 $data['html']= $this->laporan($kecamatan,$startDate,$endDate,$ctipe);
		 $this->load->view('cetakan/cetakan',$data);
		
	}

}
