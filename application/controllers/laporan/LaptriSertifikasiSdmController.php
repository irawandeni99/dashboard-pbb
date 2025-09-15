<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaptriSertifikasiSdmController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('PublicModel');
	}

	public function index()
	{

		$data['instansi'] 		= $this->PublicModel->getInstansi();
		$data['view'] = 'kapip/laporan/laporanSertifikasiSdmView';
		$this->load->view('template/layout', $data);
	}


	function prev_laporan(){ 

		$ctahun = $this->input->post('ctahun');	
		$cinstansi = $this->input->post('cinstansi');			
		$ctriw = $this->input->post('ctriw');
		$ctipe = $this->input->post('ctipe');
		
		//if($ctipe=='priv'){
			$cRet = $this->laporan($ctahun,$cinstansi,$ctriw,$ctipe);
			echo $cRet;
		
		//}
		
		
	}




	function laporan($ctahun,$cinstansi,$ctipe){ 

		$cnminstansi	 = $this->PublicModel->get_nama($cinstansi,'nm_apip','ms_apip','kd_apip');	
		
		$cRet ="";

		$cRet .= "<table width=\"100%\"><tr>
							<td width=\"100%\" align=\"center\">
								<h4><b>Komposisi SDM APIP berdasarkan Sertifikat Profesi Yang Dimiliki</b></h4>
								<h4><b>$cnminstansi</b></h4>
								<h4><b>Tahun $ctahun</b></h4>
							</td><br>
							</tr></table>";
			
							
				$cRet .= "<div style='overflow-x:auto;'><table style=\"border-collapse:collapse;\" style=\"font-size:10\" width=\"90%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
									<thead>
										<tr bgcolor=\"#CCCCCC\">
											<th width=\"60%\" rowspan	=\"2\" style=\"font-size:10pt;text-align:center;padding:5px\" align=\"center\"><b>URAIAN<b></th>
											<th width=\"40%\" colspan	=\"4\" style=\"font-size:10pt;text-align:center;padding:5px\" align=\"center\"><b>TRIWULAN</b></th>
												
										</tr>
										<tr bgcolor=\"#CCCCCC\">
											<th width=\"10%\" style=\"font-size:10pt;text-align:center;padding:5px\" align=\"center\"><b>I</b></th>
											<th width=\"10%\" style=\"font-size:10pt;text-align:center;padding:5px\" align=\"center\"><b>II</b></th>
											<th width=\"10%\" style=\"font-size:10pt;text-align:center\" align=\"center\"><b>III</b></th>
											<th width=\"10%\" style=\"font-size:10pt;text-align:center;padding:5px\" align=\"center\"><b>IV</b></th>
										</tr>
							
									</thead>";							
												
									$csql = "SELECT a.urut,a.id_sertifikasi_sdm,a.kd_apip,b.kd_sertifikasi_sdm1,b.kd_sertifikasi_sdm2,b.kd_sertifikasi_sdm3,a.triw,
											CASE WHEN b.poin<>'' THEN CONCAT_WS('. ',b.poin,b.uraian) ELSE uraian END AS uraian,b.hd,b.tampil,
											b.clevel,a.visible,a.nilai FROM tprofil_sertifikasi_sdm a
											INNER JOIN tmap_sertifikasi_sdm b ON a.id_sertifikasi_sdm=b.id_sertifikasi_sdm WHERE a.tahun='".$ctahun."' AND a.kd_apip='".$cinstansi."' AND a.triw='1' AND b.tampil='1'
											ORDER BY urut";			
									$res = $this->db->query($csql)->result();
							
								

							foreach ($res as $val) {
										$curut = $val->urut;
										$cid_sertifikasi_sdm = $val->id_sertifikasi_sdm;
										$ckd_sertifikasi_sdm1 = $val->kd_sertifikasi_sdm1;
										$ckd_sertifikasi_sdm2 = $val->kd_sertifikasi_sdm2;
										$ckd_sertifikasi_sdm3 = $val->kd_sertifikasi_sdm3;
										$curaian = $val->uraian;
										$clevel = $val->clevel;
										$ctriw1 = number_format($val->nilai,0,',','.');

										if($clevel==1){
											$abold='<b>';
											$nbold='<b>';
											$space='&nbsp;&nbsp;';
										}else if($clevel==2){
											$abold='<b>';
											$nbold='<b>';
											$space='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
											
										}else{
											$abold='';
											$nbold='';
											$space='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
										}	
										$cRet .= "<tr>";
										$cRet .= "<td style=\"font-size:10pt;text-align:left;padding:5px;\">".$space."".$abold."".$curaian."".$nbold."</td>";
										$cRet .= "<td style=\"font-size:10pt;text-align:center;padding:5px\">".$abold."".$ctriw1."".$nbold."</td>";
										
										
										for($i=2;$i<=4;$i++){
											
											$query="SELECT nilai FROM tprofil_sertifikasi_sdm WHERE kd_apip='".$cinstansi."' AND tahun='".$ctahun."' AND triw=".$i." AND id_sertifikasi_sdm='".$cid_sertifikasi_sdm."'";
											$csql = $this->db->query($query);
												
											$cdata = $csql->row();	
											$cnilai = number_format($cdata->nilai,0,',','.'); 

											if($i==2){
												$cRet .= "<td style=\"font-size:10pt;text-align:center;padding:5px\">".$abold."".$cnilai."".$nbold."</td>";
												
											}else if($i==3){
												$cRet .= "<td style=\"font-size:10pt;text-align:center;padding:5px\">".$abold."".$cnilai."".$nbold."</td>";
											}else if($i==4){
												$cRet .= "<td style=\"font-size:10pt;text-align:center;padding:5px\">".$abold."".$cnilai."".$nbold."</td>";
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
		$body=$this->laporan($ctahun,$cinstansi,$ctipe); 
		
		$filename = 'Sertifikasi-Profesional-SDM.pdf'; 
		$this->PublicModel->_mpdf('',$header,$body,10,10,25,10,10,'P',1,true,'A4',$filename);

	}


	public function excel_laporan($ctahun='',$cinstansi='',$ctipe='')
	{
		 $data['title']= 'Komposisi SDM APIP berdasarkan Sertifikat Profesi Yang Dimiliki';
		 $data['filename']= 'Sertifikasi-Profesional-SDM';
		 $data['html']= $this->laporan($ctahun,$cinstansi,$ctipe);
		 $this->load->view('cetakan/cetakan',$data);
		
	}

}
