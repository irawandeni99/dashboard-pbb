<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaptriGovernanceController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('kapip/LaptriGovernanceModel', 'GovModel');
		$this->load->model('PublicModel');
	}

	public function index()
	{
		
		$data['instansi'] 		= $this->PublicModel->getInstansi();
		$data['view'] = 'kapip/laporan/laporanGovernanceView';
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
		$ctipe = $this->input->post('ctipe');

			$cRet = $this->laporan_governance($ctahun,$cinstansi,$ctipe);
			echo $cRet;		
	}




	function laporan_governance($ctahun,$cinstansi,$ctipe){ 

		$cnminstansi	 = $this->PublicModel->get_nama($cinstansi,'nm_apip','ms_apip','kd_apip');
		
		$tahun1=$ctahun-3;
		$tahun2=$ctahun-2;
		$tahun3=$tahun1+2;
		
		$cRet ="";

		$cRet .= "<table width=\"100%\"><tr>
							<td width=\"100%\" align=\"center\" colspan=\"9\">
								<h4><b>Trend Perbaikan Governance</b></h4>
								<h4><b>$cnminstansi</b></h4>
								<h4><b>Tiga Tahun Terakhir</b></h4>
								
							</td>
							</tr></table>";
			
							
				$cRet .= "<div style='overflow-x:auto;'><table style=\"border-collapse:collapse;\" style=\"font-size:12\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
									<thead>

									<tr bgcolor=\"#CCCCCC\">
										<th width=\"5%\" style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>No</b></th>
										<th width=\"30%\" style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Uraian</b></th>
										<th width=\"25%\" style=\"font-size:7pt;text-align:center\" align=\"center\"><b>".$tahun1."</b></th>
										<th width=\"25%\" style=\"font-size:7pt;text-align:center\" align=\"center\"><b>".$tahun2."</b></th>
										<th width=\"25%\" style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>".$tahun3."</b></th>
									</tr>
									</thead>";							
							
							
					$query="SELECT kd_profil_gov1 kode,poin,uraian,jns_info,urut,'1'clevel FROM tprofil_gov1 
							WHERE kd_apip=".$cinstansi." and visible='1' ORDER BY urut,kd_profil_gov1";	
					$data = $this->db->query($query)->result();

						

							foreach ($data as $val) {
										$ckode = $val->kode;
										$cpoin = $val->poin;
										$curaian = $val->uraian;
										$cjns = $val->jns_info;
										$curut = $val->urut;
										$cclevel = $val->clevel;
										
										$cRet .= "<tr>";
										$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px\">".$cpoin."</td>";
										$cRet .= "<td style=\"font-size:6pt;text-align:left;padding:5px\">".$curaian."</td>";
										$cno=0;	
									for($i=$tahun1;$i<=$tahun3;$i++){
										
											$query="SELECT a.*,'2'clevel FROM tprofil_gov2 a WHERE a.tahun='".$i."' AND a.kd_apip='".$cinstansi."' and a.kd_profil_gov1='".$ckode."'";
											$csql = $this->db->query($query);
												
												$cdata = $csql->row();
													$cno=$cno+1;
													$nuraian = $cdata->uraian;
													$cnilai = number_format($cdata->nilai,2,',','.'); 
													$cpilihan = $cdata->nilai_pilihan;
													
														if($cjns==1){  // pilihan
														
															if($cpilihan==1){
																$cpilihan='YA';
															}else{
																$cpilihan='TIDAK';
															}
														
															$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px\">".$cpilihan."</td>";
															
														}else if($cjns==2){ // nilai
															$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px\">".$cnilai."</td>";
														}else if($cjns==3){ // keterangan
															$cRet .= "<td style=\"font-size:6pt;text-align:left;padding:5px\">".$nuraian."</td>";
														}else if($cjns==4){ // list
														
															if($cpilihan==1){
																$cpilihan='WTP';
															}else if($cpilihan==2){
																$cpilihan='WTP-DPP';
															}else if($cpilihan==3){
																$cpilihan='WDP';
															}else if($cpilihan==4){
																$cpilihan='TMP';
															}else if($cpilihan==5){
																$cpilihan='TW';
															}
														
															$cRet .= "<td style=\"font-size:6pt;text-align:center;padding:5px\">".$cpilihan."</td>";
														}
													
									
									}
								
							$cRet .= "</tr>"; 				
											
											
											
											
							}
					$cRet .= "</table></div>"; 				
					
		if ($ctipe == 'prev') {
			echo $cRet;
		}else{
			return $cRet;
		}
	}





	public function pdf_laporan($ctahun='',$cinstansi='',$ctipe='')
	{
		$header = '';
		$body=$this->laporan_governance($ctahun,$cinstansi,$ctipe); 
		
		$filename = 'Trend-Perbaikan-Governance'.$ctriw.'.pdf'; 
		$this->PublicModel->_mpdf('',$header,$body,10,10,25,10,10,'L',1,true,'A4',$filename);
		
		
	}

	public function excel_laporan($ctahun='',$cinstansi='',$ctipe='')
	{
		 $data['title']= 'Trend Perbaikan Governance';
		 $data['filename']= 'Trend-Perbaikan-Governance';
		 $data['html']= $this->laporan_governance($ctahun,$cinstansi,$ctipe);
		 $this->load->view('cetakan/cetakan',$data);
		
	}






}
