<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EvaluasiController extends CI_Controller
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
		$data['kecamatan'] 	= $this->PublicModel->getKecamatan();
		$data['view'] = 'penerimaan/evaluasiPenerimaanView';
		$this->load->view('template/layout', $data);
	}


	function prev_laporan(){  
		$tahun = $this->input->post('tahun');	
		$kecamatan = $this->input->post('kecamatan');	
		$startDate = $this->input->post('startDate');	
		$endDate = $this->input->post('endDate');
		$ctipe ='prev';			
		$cRet = $this->laporan($tahun,$kecamatan,$startDate,$endDate,$ctipe);
		echo $cRet;
		
	}


	function laporan($tahun,$kecamatan,$startDate,$endDate,$ctipe){ 
		$startDate = date('Y-m-d', strtotime($startDate));
		$endDate   = date('Y-m-d', strtotime($endDate));
		$cnminstansi	 = $this->PublicModel->getInstansi();
		$prop=$cnminstansi[0]->kd_propinsi;		
		$kab=$cnminstansi[0]->kd_dati2;	
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
							  <h3><b>".strtoupper($cnminstansi[0]->nm_instansi)."</b></h3>
								<h3><b>LAPORAN EVALUASI PENERIMAAN PBB TAHUN $tahun</b></h3>								
								<h3><b>Periode $startDateIndo s/d $endDateIndo</b></h3>
							</td><br>
							</tr></table>";
			
							
				$cRet .= "<div style='overflow-x:auto;'><table style=\"border-collapse:collapse;\" style=\"font-size:10\" width=\"90%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
									<thead>
										<tr bgcolor=\"#d8a25e\" style=\"color:white\">
											<th width=\"8%\" rowspan	=\"2\" style=\"font-size:11pt;text-align:center;padding:5px\" align=\"center\"><b>Kode<b></th>
											<th width=\"20%\" rowspan	=\"2\" style=\"font-size:11pt;text-align:center;padding:5px\" align=\"center\"><b>Wilayah<b></th>
											<th width=\"21%\" colspan	=\"2\" style=\"font-size:11pt;text-align:center;padding:5px\" align=\"center\"><b>Pokok Ketetapan</b></th>
											<th width=\"27%\" colspan	=\"3\" style=\"font-size:11pt;text-align:center;padding:5px\" align=\"center\"><b>Realisasi Pokok Ketetapan</b></th>
											<th width=\"24%\" colspan	=\"3\" style=\"font-size:11pt;text-align:center;padding:5px\" align=\"center\"><b>Sisa Pokok Ketetapan</b></th>
											
										</tr>
										<tr bgcolor=\"#d8a25e\" style=\"color:white\">
											<th width=\"8%\"  style=\"font-size:11pt;text-align:center;padding:5px\" align=\"center\"><b>SPPT</b></th>
											<th width=\"13%\"  style=\"font-size:11pt;text-align:center;padding:5px\" align=\"center\"><b>Jml (Rp)</b></th>
											<th width=\"7%\"  style=\"font-size:11pt;text-align:center\" align=\"center\"><b>SPPT</b></th>
											<th width=\"13%\"  style=\"font-size:11pt;text-align:center;padding:5px\" align=\"center\"><b>Jml (Rp)</b></th>
											<th width=\"7%\"  style=\"font-size:11pt;text-align:center\" align=\"center\"><b>%</b></th>
											<th width=\"6%\"  style=\"font-size:11pt;text-align:center\" align=\"center\"><b>SPPT</b></th>
											<th width=\"13%\"  style=\"font-size:11pt;text-align:center;padding:5px\" align=\"center\"><b>Jml (Rp)</b></th>
											<th width=\"5%\"  style=\"font-size:11pt;text-align:center\" align=\"center\"><b>%</b></th>											
										</tr>
										
							
									</thead>";	

						if($kecamatan=='000'){

							$csql = "CALL get_evaluasi_kab('".$prop."','".$kab."','".$tahun."','".$startDate."','".$endDate."')";							
						}else{
							$csql = "CALL get_evaluasi_kec('".$prop."','".$kab."','".$kecamatan."','".$tahun."','".$startDate."','".$endDate."')";							

						}	
							
							$res = $this->db2->query($csql)->result();						

							$tsppt_tetap = 0;
							$tnilai_tetap = 0;
							$tsppt_real = 0;
							$tnilai_real = 0;
							$tsppt_sisa = 0;
							$tnilai_sisa = 0;
							$tpersen_real = 0;
							$tpersen_sisa = 0;

							foreach ($res as $val) {
								$clevel = $val->clevel;								
								$kode = $val->kode;
								$wilayah = ucwords(strtolower($val->nm));
								$sppt_tetap = $val->sppt_tetap;
								$nilai_tetap = $val->nilai_tetap;
								$sppt_real = $val->sppt_real;
								$nilai_real = $val->nilai_real;
								$persen_real = $val->persen_real;
								$sppt_sisa = $val->sppt_sisa;
								$nilai_sisa = $val->nilai_sisa;
								$persen_sisa = $val->persen_sisa;

								if($clevel==0){
									$tsppt_tetap = $tsppt_tetap+$sppt_tetap;
									$tnilai_tetap = $tnilai_tetap+$nilai_tetap;

									$tsppt_real = $tsppt_real+$sppt_real;
									$tnilai_real = $tnilai_real+$nilai_real;

									$tsppt_sisa = $tsppt_sisa+$sppt_sisa;
									$tnilai_sisa = $tnilai_sisa+$nilai_sisa;

								}

								if($clevel==0){
									$abold='<b>';
									$nbold='<b>';
									$space='';
									$bgr ='background-color:#74C7B8;'; 
									$fsize ='font-size:11pt';
								}else{
									$abold='';
									$nbold='';
									$space='&nbsp;&nbsp;&nbsp;';
									$bgr ='';
									$fsize ='font-size:10pt';
								}	
								$cRet .= "<tr style=\"$bgr\">";
								$cRet .= "<td style=\"$fsize;text-align:left;padding:5px;\">".$abold.$kode.$nbold."</td>";
								$cRet .= "<td style=\"$fsize;text-align:left;padding:5px;\">".$space.$abold.$wilayah.$nbold."</td>";
								$cRet .= "<td style=\"$fsize;text-align:center;padding:5px\">".$abold.number_format($sppt_tetap, 0, ',', '.').$nbold."</td>";
								$cRet .= "<td style=\"$fsize;text-align:right;padding:5px\">".$abold.number_format($nilai_tetap, 0, ',', '.').$nbold."</td>";
								$cRet .= "<td style=\"$fsize;text-align:center;padding:5px\">".$abold.number_format($sppt_real, 0, ',', '.').$nbold."</td>";
								$cRet .= "<td style=\"$fsize;text-align:right;padding:5px\">".$abold.number_format($nilai_real, 0, ',', '.').$nbold."</td>";
								$cRet .= "<td style=\"$fsize;text-align:center;padding:5px\">".$abold.number_format($persen_real, 0, ',', '.').$nbold."</td>";
								$cRet .= "<td style=\"$fsize;text-align:center;padding:5px\">".$abold.number_format($sppt_sisa, 0, ',', '.').$nbold."</td>";
								$cRet .= "<td style=\"$fsize;text-align:right;padding:5px\">".$abold.number_format($nilai_sisa, 0, ',', '.').$nbold."</td>";
								$cRet .= "<td style=\"$fsize;text-align:center;padding:5px\">".$abold.number_format($persen_sisa, 0, ',', '.').$nbold."</td>";
									
								$cRet .= "</tr>";		
							}


								$tpersen_real = ($tnilai_real/$tnilai_tetap*100);
								$tpersen_sisa = ($tnilai_tetap-$tnilai_real)/$tnilai_tetap*100;

								$footbgr ='background-color:#d8a25e;';  
								$cRet .= "<tr style=\"$footbgr\">";
								$cRet .= "<td colspan	=\"2\" style=\"font-size:11pt;text-align:center;padding:5px;\"><b>TOTAL</b></td>";
								$cRet .= "<td style=\"font-size:11pt;text-align:center;padding:5px\"><b>".number_format($tsppt_tetap, 0, ',', '.')."</b></td>";
								$cRet .= "<td style=\"font-size:11pt;text-align:right;padding:5px\"><b>".number_format($tnilai_tetap, 0, ',', '.')."</b></td>";
								$cRet .= "<td style=\"font-size:11pt;text-align:center;padding:5px\"><b>".number_format($tsppt_real, 0, ',', '.')."</b></td>";
								$cRet .= "<td style=\"font-size:11pt;text-align:right;padding:5px\"><b>".number_format($tnilai_real, 0, ',', '.')."</b></td>";
								$cRet .= "<td style=\"font-size:11pt;text-align:center;padding:5px\"><b>".number_format($tpersen_real, 0, ',', '.')."</b></td>";

								$cRet .= "<td style=\"font-size:11pt;text-align:center;padding:5px\"><b>".number_format($tsppt_sisa, 0, ',', '.')."</b></td>";
								$cRet .= "<td style=\"font-size:11pt;text-align:right;padding:5px\"><b>".number_format($tnilai_sisa, 0, ',', '.')."</b></td>";
								$cRet .= "<td style=\"font-size:11pt;text-align:center;padding:5px\"><b>".number_format($tpersen_sisa, 0, ',', '.')."</b></td>";
								$cRet .= "</tr>";	
								$cRet .= "</table></div>"; 

		if ($ctipe == 'prev') {
			echo $cRet;
		}else{
			return $cRet;
		}
	}


	public function pdf_laporan($tahun,$kecamatan,$startDate,$endDate,$ctipe)  //$startDate,$endDate,$ctipe
	{
		$header = '';
		$body=$this->laporan($tahun,$kecamatan,$startDate,$endDate,$ctipe); 
		
		$filename = 'Laporan-Evaluasi-Penerimaan-PBB.pdf'; 
		$this->PublicModel->_mpdf('',$header,$body,10,10,25,10,10,'L',1,true,'A4',$filename);

	}


	public function excel_laporan($tahun,$kecamatan,$startDate,$endDate,$ctipe)
	{
		 $data['title']= 'Laporan Evaluasi Penerimaan PBB';
		 $data['filename']= 'Laporan-Evaluasi-Penerimaan-PBB';
		 $data['html']= $this->laporan($tahun,$kecamatan,$startDate,$endDate,$ctipe);
		 $this->load->view('cetakan/cetakan',$data);
		
	}

}
