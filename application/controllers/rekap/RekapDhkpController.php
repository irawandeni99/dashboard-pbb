<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RekapDhkpController extends CI_Controller
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
		
		$data['instansi'] 	= $this->PublicModel->getInstansi();
		$data['kecamatan'] 	= $this->PublicModel->getKecamatan();
		$data['view'] 		= 'rekap/rekapDhkpView';
		$this->load->view('template/layout', $data);
	}


	function prev_laporan(){  
		$tahun = $this->input->post('tahun');	
		$kec = $this->input->post('kec');
		$nmkec = $this->input->post('nmkec');
		$ctipe ='prev';			
		$cRet = $this->laporan($tahun,$kec,$nmkec,$ctipe);
		echo $cRet;
		
	}


	function laporan($tahun,$kec,$nmkec,$ctipe){ 

		$cnminstansi	 = $this->PublicModel->getInstansi();
		$prop=$cnminstansi[0]->kd_propinsi;		
		$kab=$cnminstansi[0]->kd_dati2;
		$nmkec = str_replace('%20', ' ', $nmkec);
	
		$cRet ="";
		$cRet .= "
		<style>
			body, table, td, h4 {
				font-family: 'Arial', sans-serif; 
			}
		</style>
		<table width=\"100%\"><tr>
							<td width=\"100%\" align=\"center\">
							  <h4><b>PEMERINTAH ".strtoupper($cnminstansi[0]->nm_instansi)."</b></h4>
								<h4><b>REKAPITULASI DAFTAR HIMPUNAN KETETAPAN PAJAK</b></h4>								
								<h4><b>TAHUN $tahun</b></h4>
							</td><br>
							
							</tr>
										
							
							</table>";
			
		
		$cRet .= "<div style='overflow-x:auto;'>";
		if($kec!=='000'){
				$cRet .= "<div>
									<th style=\"font-size:12pt; text-align:right;\">
										<b>KECAMATAN : ".$nmkec."</b>
									</th><br>
								</div>";
		}						
				
		$cRet .= "<table style=\"border-collapse:collapse;\" style=\"font-size:10\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
							<thead>

								<tr bgcolor=\"#d8a25e\" style=\"color:white\">
									<th width=\"10%\" style=\"font-size:11pt;text-align:center;padding:5px\" align=\"center\"><b>Kode</b></th>
									<th width=\"17%\" style=\"font-size:11pt;text-align:center;padding:5px\" align=\"center\"><b>Wilayah</b></th>
									<th width=\"7%\" style=\"font-size:11pt;text-align:center\" align=\"center\"><b>Jumlah SPPT</b></th>
									<th width=\"10%\" style=\"font-size:11pt;text-align:center;padding:5px\" align=\"center\"><b>Luas Bumi<br> (m²)</b></th>

									<th width=\"10%\" style=\"font-size:11pt;text-align:center;padding:5px\" align=\"center\"><b>Luas Bangunan<br> (m²)</b></th>
									<th width=\"14%\" style=\"font-size:11pt;text-align:center;padding:5px\" align=\"center\"><b>NJOP Bumi<br> (000)</b></th>
									<th width=\"14%\" style=\"font-size:11pt;text-align:center\" align=\"center\"><b>NJOP Bangunan<br> (000)</b></th>
									<th width=\"14%\" style=\"font-size:11pt;text-align:center;padding:5px\" align=\"center\"><b>NJOP Total <br>(000)</b></th>
									<th width=\"14%\" style=\"font-size:11pt;text-align:center;padding:5px\" align=\"center\"><b>Pokok Ketetapan<b> (Rp)</b></th>
									
								</tr>
					
							</thead>";							
					
					if($kec=='000'){
						$csql = "CALL get_rekap_dhkp_kab('".$prop."','".$kab."','".$tahun."')";							
						$res = $this->db2->query($csql)->result();	

					}else{
						$csql = "CALL get_rekap_dhkp_kec('".$prop."','".$kab."','".$kec."','".$tahun."')";							
						$res = $this->db2->query($csql)->result();	

					}

					


					$tjumlahsppt = 0;
					$tluasbumi = 0;
					$tluasbng = 0;
					$tnjopbumi = 0;
					$tnjopbng = 0;
					$ttnjop = 0;
					$tnilai = 0;
					$tjumlahop=0;
					$tketetapan=0;
					$cno=0;
					$b="";
					$nb="";
					
					foreach ($res as $val) {
								$clevel 	= $val->clevel;
								$kode 		= $val->kode;
								$wilayah 	= ucwords(strtolower($val->wilayah));

								if($kec=='000'){
									
									if($clevel=='0'){
										$cno++;						
										$b="<b>";
										$nb="</b>";
										$bgr ='background-color:#74C7B8;'; 
										$fsize ='font-size:11pt';
										$space='';

									}else{									
										
										$b="";
										$nb="";
										$bgr ='';
									    $fsize ='font-size:10pt';
										$space='&nbsp;&nbsp;&nbsp;';

									}

								}else{
									
									$cno++;
									
									if($clevel=='0'){
											// $cno++;
											$b="<b>";
											$nb="</b>";
											$bgr ='background-color:#74C7B8;'; 
											$fsize ='font-size:11pt';
											$space='';

										}else{									
											$b="";
											$nb="";
											$bgr ='';
											$fsize ='font-size:10pt';
											$space='&nbsp;&nbsp;&nbsp;';

										}


								}		
								
								
								$jumlahop = $val->jmlop;
								$jumlahsppt = $val->jumlahsppt;
								$luasbumi = $val->luasbumi;
								$luasbng = $val->luasbng;
								$njopbumi = $val->njopbumi;
								$njopbng = $val->njopbng;
								$tnjop = $val->tnjop;
								$tnilai = $val->nilai;
								$ketetapan = $val->ketetapan;

								
								$tjumlahsppt = $tjumlahsppt+$jumlahsppt;
								$tluasbumi = $tluasbumi+$luasbumi;
								$tluasbng = $tluasbng+$luasbng;
								$tnjopbumi = $tnjopbumi+$njopbumi;
								$tnjopbng = $tnjopbng+$njopbng;
								$ttnjop = $ttnjop+$tnjop;
								$tnilai = $tnilai+$nilai;
								$tjumlahop=$tjumlahop+$jumlahop;
								$tketetapan=$tketetapan+$ketetapan;

								$cRet .= "<tr style=\"$bgr\">";
								$cRet .= "<td style=\"$fsize;text-align:left;padding:5px;\">".$b.$kode.$nb."</td>";
								$cRet .= "<td style=\"$fsize;text-align:left;padding:5px;\">".$space.$b.$wilayah.$nb."</td>";
								$cRet .= "<td style=\"$fsize;text-align:center;padding:5px\">".$b.number_format($jumlahsppt , 0, ',', '.').$nb."</td>";
								$cRet .= "<td style=\"$fsize;text-align:right;padding:5px\">".$b.number_format($luasbumi, 0, ',', '.').$nb."</td>";
								$cRet .= "<td style=\"$fsize;text-align:right;padding:5px\">".$b.number_format($luasbng, 0, ',', '.').$nb."</td>";
								$cRet .= "<td style=\"$fsize;text-align:right;padding:5px\">".$b.number_format($njopbumi, 0, ',', '.').$nb."</td>";
								$cRet .= "<td style=\"$fsize;text-align:right;padding:5px\">".$b.number_format($njopbng, 0, ',', '.').$nb."</td>";
								$cRet .= "<td style=\"$fsize;text-align:right;padding:5px\">".$b.number_format($tnjop, 0, ',', '.').$nb."</td>";
								$cRet .= "<td style=\"$fsize;text-align:center;padding:5px\">".$b.number_format($ketetapan , 0, ',', '.').$nb."</td>";
								
						$cRet .= "</tr>";		
					}

						$footbgr ='background-color:#d8a25e;';  
						$cRet .= "<tr style=\"$footbgr\">";
						$cRet .= "<td colspan=\"2\" style=\"font-size:11pt;text-align:center;padding:5px;\"><b>Total</b></td>";
						$cRet .= "<td style=\"font-size:11pt;text-align:center;padding:5px\"><b>".number_format($tjumlahsppt, 0, ',', '.')."</b></td>";
						$cRet .= "<td style=\"font-size:11pt;text-align:right;padding:5px\"><b>".number_format($tluasbumi, 0, ',', '.')."</b></td>";
						$cRet .= "<td style=\"font-size:11pt;text-align:right;padding:5px\"><b>".number_format($tluasbng, 0, ',', '.')."</b></td>";
						$cRet .= "<td style=\"font-size:11pt;text-align:right;padding:5px\"><b>".number_format($tnjopbumi, 0, ',', '.')."</b></td>";
						$cRet .= "<td style=\"font-size:11pt;text-align:right;padding:5px\"><b>".number_format($tnjopbng, 0, ',', '.')."</b></td>";
						$cRet .= "<td style=\"font-size:11pt;text-align:right;padding:5px\"><b>".number_format($ttnjop, 0, ',', '.')."</b></td>";
						$cRet .= "<td style=\"font-size:11pt;text-align:right;padding:5px\"><b>".number_format($tketetapan, 0, ',', '.')."</b></td>";
						$cRet .= "</tr>";	
						$cRet .= "</table></div>"; 

		if ($ctipe == 'prev') {
			echo $cRet;
		}else{
			return $cRet;
		}
	}


	public function pdf_laporan($tahun,$kec,$nmkec,$ctipe)  //$startDate,$endDate,$ctipe
	{
		$header = '';
		$body=$this->laporan($tahun,$kec,$nmkec,$ctipe); 
		
		$filename = 'Laporan-Daftar-Himpunan-Ketetapan-Pajak.pdf'; 
		$this->PublicModel->_mpdf('',$header,$body,10,10,25,10,10,'L',1,true,'A4',$filename);

	}


	public function excel_laporan($tahun,$kec,$nmkec,$ctipe)
	{
		 $data['title']= 'Laporan Daftar Himpunan Ketetapan Pajak';
		 $data['filename']= 'Laporan-Daftar-Himpunan-Ketetapan-Pajak';
		 $data['html']= $this->laporan($tahun,$kec,$nmkec,$ctipe);
		 $this->load->view('cetakan/cetakan',$data);
		
	}

}
