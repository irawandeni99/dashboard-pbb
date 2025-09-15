<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaptriTeknologiInformasiController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('PublicModel');
	}

	public function index()
	{

		$data['instansi'] 		= $this->PublicModel->getInstansi();
		$data['view'] = 'kapip/laporan/laporanTeknologiInformasiView';
		$this->load->view('template/layout', $data);
	}


	function prev_laporan(){ 

		$ctahun = $this->input->post('ctahun');	
		$cinstansi = $this->input->post('cinstansi');
		$ctipe = $this->input->post('ctipe');

			$cRet = $this->laporan($ctahun,$cinstansi,$ctipe);
			echo $cRet;
		
	
		
	}




	function laporan($ctahun,$cinstansi,$ctipe){ 

		$cnminstansi	 = $this->PublicModel->get_nama($cinstansi,'nm_apip','ms_apip','kd_apip');	
		
		$cRet ="";

		$cRet .= "<table width=\"100%\"><tr>
							<td width=\"100%\" align=\"center\">
								<h4><b>Dukungan/Penggunaan Teknologi Informasi/Aplikasi</b></h4>
								<h4><b>$cnminstansi</b></h4>
								<h4><b>Tahun $ctahun</b></h4>
							</td><br>
							</tr></table>";
			
							
				$cRet .= "<div style='overflow-x:auto;'><table style=\"border-collapse:collapse;\" style=\"font-size:10\" width=\"90%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
									<thead>
										<tr bgcolor=\"#CCCCCC\">
											<th width=\"20%\" rowspan	=\"2\" style=\"font-size:10pt;text-align:center;padding:5px\" align=\"center\"><b>URAIAN<b></th>
											<th width=\"80%\" colspan	=\"4\" style=\"font-size:10pt;text-align:center;padding:5px\" align=\"center\"><b>TRIWULAN</b></th>
												
										</tr>
										<tr bgcolor=\"#CCCCCC\">
											<th width=\"20%\" style=\"font-size:10pt;text-align:center;padding:5px\" align=\"center\"><b>I</b></th>
											<th width=\"20%\" style=\"font-size:10pt;text-align:center;padding:5px\" align=\"center\"><b>II</b></th>
											<th width=\"20%\" style=\"font-size:10pt;text-align:center;padding:5px\" align=\"center\"><b>III</b></th>
											<th width=\"20%\" style=\"font-size:10pt;text-align:center;padding:5px\" align=\"center\"><b>IV</b></th>
										</tr>
									</thead>";							
							
			$query="SELECT tahun,triw,kd_profil_it1,nilai,poin,uraian,jns_info,urut,'1'clevel FROM tprofil_it1 
					WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND triw='1'
					ORDER BY urut,kd_profil_it1";
								
			$cdata = $this->db->query($query)->result();
			$no = 0;
			
			foreach ($cdata as $value) {
				$no++;
				
				$cpoin=$value->poin;
				$curaian=$value->uraian;
				$cjns_info=$value->jns_info;
				$cnilai=$value->nilai;
				$ckd1=$value->kd_profil_it1;
				$ckd2=0; 						 
				$clevel=$value->clevel;
				$curut=$value->urut;
				
				if($cnilai==1){
					$pilihan1='Ya';
				}else{
					$pilihan1='Tidak';
				}
				
			
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
				
						
				if($cjns_info==1){
						
					$cRet .="<tr>";		
					$cRet .= "<td style=\"font-size:8pt;text-align:left;vertical-align: text-top;\">".$abold."".$cpoin.". ".$curaian."".$nbold."</td>";
					$cRet .= "<td style=\"font-size:8pt;text-align:center;\">".$abold."".$pilihan1."".$nbold."</td>";
					
					for($i=2;$i<=4;$i++){
											
							$query="SELECT nilai FROM tprofil_it1 
									WHERE tahun='".$ctahun."' AND kd_apip=".$cinstansi." AND triw=".$i." and kd_profil_it1='".$ckd1."'";
							$csql = $this->db->query($query);
								
							$cdata = $csql->row();	
							$cnilai = $cdata->nilai;
							
							if($cnilai==1){
								$pilihan1='Ya';
							}else{
								$pilihan1='Tidak';
							}
				 

							if($i==2){
								$cRet .= "<td style=\"font-size:8pt;text-align:center;\">".$abold."".$pilihan1."".$nbold."</td>";
								
							}else if($i==3){
								$cRet .= "<td style=\"font-size:8pt;text-align:center;\">".$abold."".$pilihan1."".$nbold."</td>";
							}else if($i==4){
								$cRet .= "<td style=\"font-size:8pt;text-align:center;\">".$abold."".$pilihan1."".$nbold."</td>";
							}	
								
						}		
					
					$cRet .= "</tr>";	
					
					
					
					
				}else{
					
					$cRet .="<tr>";
					$cRet .= "<td style=\"font-size:8pt;text-align:left;vertical-align: text-top;\">".$abold."".$cpoin.". ".$curaian."".$nbold."</td>";
							$query2="SELECT uraian FROM tprofil_it3 
									WHERE tahun='".$ctahun."' AND kd_apip=".$cinstansi." AND triw='1' and kd_profil_it1='".$ckd1."'
									group by uraian ORDER BY uraian";
					
							$data2 = $this->db->query($query2)->result();
							
							$xno = 0;
							$curaian2='';
							foreach ($data2 as $value2) {
								$xno++;
							
								if($xno==1){
									$space1='&nbsp;&nbsp;';
								}else{
									$space1='';
								}
								$curaian2=$curaian2.$space1.$xno." . ".$value2->uraian.'<br>&nbsp;&nbsp;';
								
							}


						$cRet .= "<td style=\"font-size:8pt;text-align:left;\">".$abold."".$curaian2."".$nbold."</td>";
						
						
							for($i=2;$i<=4;$i++){
												
								$query2="SELECT uraian FROM tprofil_it3 
									WHERE tahun='".$ctahun."' AND kd_apip=".$cinstansi." AND triw=".$i." and kd_profil_it1='".$ckd1."'
									group by uraian ORDER BY uraian";
								$data2 = $this->db->query($query2)->result();
									
									$xno = 0;
									$curaian2='';
									foreach ($data2 as $value2) {
										$xno++;
									
										if($xno==1){
											$space1='&nbsp;&nbsp;';
										}else{
											$space1='';
										}
										$curaian2=$curaian2.$space1.$xno." . ".$value2->uraian.'<br>&nbsp;&nbsp;';
										
									}
								
								$cRet .= "<td style=\"font-size:8pt;text-align:left;\">".$abold."".$curaian2."".$nbold."</td>";
								
							}		
						
						
						$cRet .= "</tr>";	
			
			// -- level2					
								
				$dquery="SELECT a.tahun,a.triw,a.kd_profil_it1,a.kd_profil_it2,''nilai,'' poin,a.uraian,'0'jns_info,
						urut,'2'clevel FROM tprofil_it2 a 
						WHERE a.tahun='".$ctahun."' AND a. kd_apip=".$cinstansi." AND a.triw='1' and a.kd_profil_it1='".$ckd1."'
						ORDER BY urut,kd_profil_it1,kd_profil_it2";	
										
						
						$ddata = $this->db->query($dquery)->result();
						$dno=0;
						foreach ($ddata as $value21) {   
						$dno++;
					
							$curaian2=$value21->uraian;
							$ckd1=$value21->kd_profil_it1;
							$ckd2=$value21->kd_profil_it2;
							$clevel=$value21->clevel;
							$curut=$value21->urut;
							
							$cRet .="<tr>";
								$cRet .= "<td style=\"font-size:8pt;text-align:left;vertical-align: text-top;\">".$dno.". ".$curaian2."</td>";
								
								$query22="SELECT uraian FROM tprofil_it3 
									WHERE tahun='".$ctahun."' AND kd_apip=".$cinstansi." AND triw='1' and kd_profil_it1='".$ckd1."'
									and kd_profil_it2='".$ckd2."'
									group by uraian ORDER BY uraian";
								
									$data22 = $this->db->query($query22)->result();
										
										$xno = 0;
										$curaian22='';
										foreach ($data22 as $value22) {
											$xno++;
											if($xno==1){
												$space1='&nbsp;&nbsp;';
											}else{
												$space1='';
											}
											
											$curaian22=$curaian22.$space1.$xno." . ".$value22->uraian.'<br>&nbsp;&nbsp;';
											
										}

							$cRet .= "<td style=\"font-size:8pt;text-align:left;vertical-align: text-top;\">".$curaian22."</td>";
							

							for($i=2;$i<=4;$i++){
												
								$query22="SELECT uraian FROM tprofil_it3 
									WHERE tahun='".$ctahun."' AND kd_apip=".$cinstansi." AND triw=".$i." and kd_profil_it1='".$ckd1."'
									and kd_profil_it2='".$ckd2."'
									group by uraian ORDER BY uraian";
								$data22 = $this->db->query($query22)->result();
									
									$xno = 0;
									$curaian22='';
									foreach ($data22 as $value22) {
										$xno++;
									
										if($xno==1){
											$space1='&nbsp;&nbsp;';
										}else{
											$space1='';
										}
										$curaian22=$curaian22.$space1.$xno." . ".$value22->uraian.'<br>&nbsp;&nbsp;';
										
									}
								
								$cRet .= "<td style=\"font-size:8pt;text-align:left;vertical-align: text-top;\">".$curaian22."</td>";
								
							}		

							

							$cRet .= "</tr>";

						
						}	
				
					
			}				
					
					
					
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
		
		$filename = 'Dukungan-Teknologi-Informasi.pdf'; 
		$this->PublicModel->_mpdf('',$header,$body,10,10,25,10,10,'P',1,true,'A4',$filename);

	}


	public function excel_laporan($ctahun='',$cinstansi='',$ctipe='')
	{
		 $data['title']= 'Dukungan/Penggunaan Teknologi Informasi/Aplikasi';
		 $data['filename']= 'Dukungan-Teknologi-Informasi';
		 $data['html']= $this->laporan($ctahun,$cinstansi,$ctipe);
		 $this->load->view('cetakan/cetakan',$data);
		
	}

}
