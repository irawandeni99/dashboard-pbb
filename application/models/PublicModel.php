<?php
	class PublicModel extends CI_Model{
		
	 	private $db2;

		public function __construct()
		{
			parent::__construct();
			$this->db2 = $this->load->database('db2', TRUE);
		}
			
	    public function getKecamatan()
	    {		 
			$query = "SELECT * FROM ref_kecamatan ";
	    	$sql = $this->db2->query($query)->result();
	    	return $sql;
	    }


	    public function getMkecamatan($kec = '')
	    {
			$query = 'SELECT * FROM ms_kecamatan where right(kd_kecamatan,3) = "'.$kec.'"';
	    	$sql = $this->db->query($query)->result();
	    	return $sql;
	    }


	    public function listMkecamatan()
	    {
			$query = 'SELECT * FROM ms_kecamatan';
	    	$sql = $this->db->query($query)->result();
	    	return $sql;
	    }

		
		//get nama dari master
		public function get_nama($kode='',$hasil='',$tabel='',$field='')
		{
			$this->db->select($hasil);
			$this->db->where($field, $kode);
			$q = $this->db->get($tabel);
			$data  = $q->result_array();
			$baris = $q->num_rows();
			return $data[0][$hasil];
		}



		public function getInstansi()
		{
			$sql = "SELECT *from ms_config";		
			return $this->db->query($sql)->result();
		}


  public function formatTanggalIndonesia($dateStr) {
        $bulan = [
            1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                 "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];


        $timestamp = strtotime($dateStr);
        if (!$timestamp) {
            return $dateStr; 
        }

        $hari = date('j', $timestamp);
        $bln  = $bulan[(int)date('n', $timestamp)];
        $thn  = date('Y', $timestamp);

        return $hari . " " . $bln . " " . $thn;
    }



		public function getNamaDaerah($id_daerah)
		{
			$sql = "SELECT id_daerah as id, nm_daerah as nama, ket as jenis from ms_daerah where id_daerah = ".$id_daerah.";";		
			return $this->db->query($sql)->result();
		}


	    public function viewNotif($id = 0)
	    {
	    	$where = array('id'=>$id);
	    	$data = array('status'=>'DILIHAT');
	    	$this->db->where($where);
	    	$this->db->update('tr_history_tlhp',$data);
	    }

	 

	    public function getUser($id = '')
	    {
			$query = 'SELECT * FROM ms_user where id_user = "'.$id.'"';
	    	$sql = $this->db->query($query)->row();
	    	return $sql;
	    }

	  

	    public function daftar_ttd()
	    {
			$query = 'SELECT * FROM ms_pejabat WHERE jns = 5';
	    	$sql = $this->db->query($query)->result();
	    	return $sql;
	    }



		function tgl_jam_indo($tanggal){
			 $bulan = array (
			        0 => '-',
			        'Januari',
			        'Februari',
			        'Maret',
			        'April',
			        'Mei',
			        'Juni',
			        'Juli',
			        'Agustus',
			        'September',
			        'Oktober',
			        'November',
			        'Desember'
			    );
			    $tgljam = explode(' ', $tanggal);
			    $pecahkan = explode('-', $tgljam[0]);
			    if($tanggal <> ''){
			        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0].' '  ;
			    }
			    else
			    {
			        return '';
			    }
		}

		function tgl_jam($tanggal){
			 $bulan = array (
			        0 => '-',
			        'Januari',
			        'Februari',
			        'Maret',
			        'April',
			        'Mei',
			        'Juni',
			        'Juli',
			        'Agustus',
			        'September',
			        'Oktober',
			        'November',
			        'Desember'
			    );
			    $tgljam = explode(' ', $tanggal);
			    $pecahkan = explode('-', $tgljam[0]);
			    if($tanggal <> ''){
			        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0].' ' .$tgljam[1] ;
			    }
			    else
			    {
			        return '';
			    }
		}

		function tes($value='')
		{
			echo "string";
		}

		function get_combo_prov2($apip)
		{
			$sql = "SELECT * FROM ms_inspektorat where id_inspektorat = ".$apip;	
			$daerah = $this->db->query($sql)->row()->pemda;
			$sqlDaerah = "SELECT * FROM ms_daerah where id_daerah in (".$daerah.")";	
			$resCombo = $this->db->query($sqlDaerah)->result_array();
			return $resCombo;

		}

		 public function _mpdf($judul,$header,$body,$lMargin,$rMargin,$tMargin,$bMargin,$font,$orientasi,$halaman,$chalaman,$ckertas,$filename){
			
	// ini_set("memory_limit","-1");
            // $mpdf->showImageErrors = true;
            $this->load->library('M_pdf');
         //   $mpdf = new m_pdf('', 'Letter-L');
		    $mpdf = new m_pdf('', $ckertas);
            $pdfFilePath = $filename;
            $mpdf->pdf->SetTitle($filename);
   			$stylesheet = file_get_contents("assets/css/mpdf.css");
			//$mpdf->pdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
			$mpdf->pdf->SetHTMLHeader($header);
			// $mpdf->pdf->SetHTMLHeader($headerEven, 'E');
			/* if($chalaman=='true'){
				 $mpdf->pdf->SetFooter('{PAGENO} / {nb}');				
			}else{
				$mpdf->pdf->SetFooter('');				
			} */
			if($chalaman=='true'){
				 $mpdf->pdf->SetFooter(' Halaman {PAGENO}');				
			}else{
				$mpdf->pdf->SetFooter('');				
			}
            
           // $mpdf->pdf->AddPage($orientasi)
			
		if ($halaman==0){
             $xhal=1;
         } else {       
             $xhal=$halaman;
         }
		    
			
			$mpdf->pdf->AddPage($orientasi,'',$xhal,'','',$lMargin,$rMargin,$tMargin,$bMargin);
            if (!empty($judul)) $mpdf->pdf->writeHTML($judul);
            $mpdf->pdf->WriteHTML($body);         
            $mpdf->pdf->Output($filename,'I');
               
        }

        public function _mpdfPemda($judul,$header,$body,$lMargin,$rMargin,$tMargin,$bMargin,$font,$orientasi,$halaman,$chalaman,$ckertas,$filename){
			
	// ini_set("memory_limit","-1");
            // $mpdf->showImageErrors = true;
            $this->load->library('M_pdf');
         //   $mpdf = new m_pdf('', 'Letter-L');
		    $mpdf = new m_pdf('', $ckertas);
            $pdfFilePath = $filename;
            $mpdf->pdf->SetTitle($filename);
   			$stylesheet = file_get_contents("assets/css/mpdf.css");
			$mpdf->pdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
			// $mpdf->pdf->SetHTMLHeader($header);
			// $mpdf->pdf->SetHTMLHeader($headerEven, 'E');
			/* if($chalaman=='true'){
				 $mpdf->pdf->SetFooter('{PAGENO} / {nb}');				
			}else{
				$mpdf->pdf->SetFooter('');				
			} */
            
           // $mpdf->pdf->AddPage($orientasi)
			
		if ($halaman==0){
             $xhal=1;
         } else {       
             $xhal=$halaman;
         }
		    
			
			$mpdf->pdf->AddPage($orientasi,'',$xhal,'','',$lMargin,$rMargin,$tMargin,$bMargin);
            if (!empty($judul)) $mpdf->pdf->writeHTML($judul);
            $mpdf->pdf->WriteHTML($header);       

            $mpdf->pdf->AddPage('L','',$xhal,'','',$lMargin,$rMargin,$tMargin,$bMargin);
            $mpdf->pdf->WriteHTML($body);         
            $mpdf->pdf->Output($filename,'I');
               
        }

         public function _mpdfRisalah($judul,$header,$body,$table,$lMargin,$rMargin,$tMargin,$bMargin,$font,$orientasi,$halaman,$chalaman,$ckertas,$filename){
			
			// ini_set("memory_limit","-1");
            // $mpdf->showImageErrors = true;
            $this->load->library('M_pdf');
         	//   $mpdf = new m_pdf('', 'Letter-L');
		    $mpdf = new m_pdf('', $ckertas);
            $pdfFilePath = $filename;
            $mpdf->pdf->SetTitle($filename);
   			$stylesheet = file_get_contents("assets/css/mpdf.css");
			$mpdf->pdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
			// $mpdf->pdf->SetHTMLHeader($header);
			// $mpdf->pdf->SetHTMLHeader($headerEven, 'E');
			/* if($chalaman=='true'){
				 $mpdf->pdf->SetFooter('{PAGENO} / {nb}');				
			}else{
				$mpdf->pdf->SetFooter('');				
			} */
			// if($chalaman=='true'){
			// 	 $mpdf->pdf->SetFooter(' Halaman {PAGENO}');				
			// }else{
			// 	$mpdf->pdf->SetFooter('');				
			// }
            
           // $mpdf->pdf->AddPage($orientasi)
			
			if ($halaman==0){
             $xhal=1;
         	} else {       
             $xhal=$halaman;
         	}
		    
			
			$mpdf->pdf->AddPage($orientasi,'',$xhal,'','',$lMargin,$rMargin,$tMargin,$bMargin);
            if (!empty($judul)) $mpdf->pdf->writeHTML($judul);
            $mpdf->pdf->WriteHTML($body);         
            $mpdf->pdf->AddPage('L','',$xhal,'','',$lMargin,$rMargin,$tMargin,$bMargin);
            $mpdf->pdf->WriteHTML($table);         
            $mpdf->pdf->Output($filename,'I');
               
        }


        public function satker_bpk()
	    {
	 		$is_admin = $this->session->userdata('is_admin');
	 			$is_satker = $this->session->userdata('id_kab');
	 		if ($is_admin == 3) {
	 			$this->db->where(array('id_instansi'=>$is_satker));
	 		}
	 		$res = $this->db->get('ms_instansi_kemendagri');
	    	$sql = $res->result();
	    	return $sql;
	    }

	    public function satker_kemendagri()
	    {
	 		$is_admin = $this->session->userdata('is_admin');
	 		if ($is_admin == 3) {
	 			$is_satker = $this->session->userdata('id_kab');
	 			$this->db->where(array('id_instansi'=>$is_satker));
	 		}else if($is_admin == 2){
				$daerah = $this->session->userdata('id_kemendagri');
				$arrayDaerah = explode(', ',$daerah);
				$this->db->where_in('id_instansi',$arrayDaerah);
			}
			else if($is_admin == 6){
				$apip = $this->session->userdata('id_ins');
				$sql = "SELECT * FROM ms_inspektorat where id_inspektorat = ".$apip;	
				$daerah = $this->db->query($sql)->row()->kemendagri;
				$arrayDaerah = explode(',',$daerah); 
				$this->db->where_in('id_instansi',$arrayDaerah);
			}
	 		$res = $this->db->get('ms_instansi_kemendagri');
	    	$sql = $res->result();
	    	return $sql;
	    }

	    public function jenis_bentuk_pengawasan($jenis='')
	    {
	 		$is_admin = $this->session->userdata('is_admin');
	 		$tahun = $this->session->userdata('year_selected');
	 		$is_satker = $this->session->userdata('id_kab');

	 		$this->db->where(array('tahun'=>$tahun));
	 		$this->db->where(array('jenis'=>$jenis));
	 		$res = $this->db->get('ms_bentuk_pengawasan');
	    	$sql = $res->result();
	    	return $sql;
	    }

        public function _mpdf2($judul,$header,$body,$lMargin,$rMargin,$tMargin,$bMargin,$font,$orientasi,$halaman,$chalaman,$ckertas,$filename){
			
	// ini_set("memory_limit","-1");
            // $mpdf->showImageErrors = true;
            $this->load->library('M_pdf');
         //   $mpdf = new m_pdf('', 'Letter-L');
		    $mpdf = new m_pdf('', $ckertas);
            $pdfFilePath = $filename;
            $mpdf->pdf->SetTitle($filename);
            // $stylesheet = file_get_contents(base_url("assets/css/mpdfstyletables.css"));
			// $mpdf->pdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
			// $mpdf->pdf->SetHTMLHeader($header);
			// $mpdf->pdf->SetHTMLHeader($headerEven, 'E');
			/* if($chalaman=='true'){
				 $mpdf->pdf->SetFooter('{PAGENO} / {nb}');				
			}else{
				$mpdf->pdf->SetFooter('');				
			} */
			if($chalaman=='true'){
				 $mpdf->pdf->SetFooter(' Halaman {PAGENO}');				
			}else{
				$mpdf->pdf->SetFooter('');				
			}
            
           // $mpdf->pdf->AddPage($orientasi)
			
		if ($halaman==0){
             $xhal=1;
         } else {       
             $xhal=$halaman;
         }
		    
			
			$mpdf->pdf->AddPage($orientasi,'',$xhal,'','',$lMargin,$rMargin,$tMargin,$bMargin);
            if (!empty($judul)) $mpdf->pdf->writeHTML($judul);
            $mpdf->pdf->WriteHTML($body);         
            $mpdf->pdf->Output($filename,'I');
               
        }



 	/* function _mpdf($judul,$isi,$lMargin,$rMargin,$font,$orientasi,$halaman,$chalaman) {
   		
		ini_set("memory_limit","-1");
		ini_set("max_execution_time","600");

		$this->load->library('mpdf');

		$this->mpdf->defaultheaderfontsize = 6;	// in pts 
		$this->mpdf->defaultheaderfontstyle = BI;	// blank, B, I, or BI 
		$this->mpdf->defaultheaderline = 1; 	// 1 to include line below header/above footer 

		$this->mpdf->defaultfooterfontsize = 8;	// in pts 
		$this->mpdf->defaultfooterfontstyle = BI;	// blank, B, I, or BI 
		$this->mpdf->defaultfooterline = 0; 
		$this->mpdf->SetLeftMargin = $lMargin;
		$this->mpdf->SetRightMargin = $rMargin; 		 
	
 		if ($halaman==''){
             $xhal=1;
         } else {       
             $xhal=$halaman+1;
         }
		    
		if($halaman<>''){
			$this->mpdf->Setfooter('printed by SIMAKDA||Halaman {PAGENO}');
		}			
				 
 		$this->mpdf->AddPage($orientasi,'',$xhal,'','',$lMargin,$rMargin);
				
         if (!empty($judul)) $this->mpdf->writeHTML($judul);
         $this->mpdf->writeHTML($isi);         
         $this->mpdf->Output();
              
    
 } */


	function  tanggal_indonesia($tgl){
		$tanggal  =  substr($tgl,8,2);
		$bulan  = substr($tgl,5,2);
		$tahun  =  substr($tgl,0,4);
		return  $tanggal.'-'.$bulan.'-'.$tahun;
	}


	function  tanggal_waktu_indonesia($tgl){
		$tanggal  =  substr($tgl,8,2);
		$bulan  = substr($tgl,5,2);
		$tahun  =  substr($tgl,0,4);
		$jam	=  substr($tgl,11,8);
		return  $tanggal.'-'.$bulan.'-'.$tahun.' '.$jam.' (WIB)';
	}


	function getHariText($hari){
 
	switch($hari){
		case 'Sun':
			$hari_ini = "Minggu";
		break;
 
		case 'Mon':			
			$hari_ini = "Senin";
		break;
 
		case 'Tue':
			$hari_ini = "Selasa";
		break;
 
		case 'Wed':
			$hari_ini = "Rabu";
		break;
 
		case 'Thu':
			$hari_ini = "Kamis";
		break;
 
		case 'Fri':
			$hari_ini = "Jumat";
		break;
 
		case 'Sat':
			$hari_ini = "Sabtu";
		break;
		
		default:
			$hari_ini = "Tidak di ketahui";		
		break;
	}
 
	return $hari_ini;
 
}

	function  tanggal_balik($tgl){
		$tanggal  =  substr($tgl,0,2);
		$bulan  = substr($tgl,3,2);
		$tahun  =  substr($tgl,6,4);
		return  $tahun.'-'.$bulan.'-'.$tanggal;
		}


        public function  tanggal_format_indonesia($tgl){
            $tanggal  =  substr($tgl,8,2);
            $bulan  = $this-> getBulan(substr($tgl,5,2));
            $tahun  =  substr($tgl,0,4);
            return  $tanggal.' '.$bulan.' '.$tahun;
        }

        public function  getBulan($bln){
            switch  ($bln){
            case  1:
            return  "Januari";
            break;
            case  2:
            return  "Februari";
            break;
            case  3:
            return  "Maret";
            break;
            case  4:
            return  "April";
            break;
            case  5:
            return  "Mei";
            break;
            case  6:
            return  "Juni";
            break;
            case  7:
            return  "Juli";
            break;
            case  8:
            return  "Agustus";
            break;
            case  9:
            return  "September";
            break;
            case  10:
            return  "Oktober";
            break;
            case  11:
            return  "November";
            break;
            case  12:
            return  "Desember";
            break;
            }
        }

        function frmDate($date,$code){
			$explode = explode("-",$date);
			$year  = $explode[0];
			(substr($explode[1],0,1)=="0")?$month=str_replace("0","",$explode[1]):$month=is_string($explode[1]);
			$dated = $explode[2];
			$explode_time = explode(" ",$dated);
			$dates = $explode_time[0];		
			
			switch($code){
				// Per Object
				case 4: $format = $dates; break;															// 01
				case 5: $format = $month; break;															// 01
				case 6: $format = $year; break;																// 2011
			}		
			return $format;
		}	
		function now($code=1){
			switch($code){
				case 1: $date = date("Y-m-d H:i:s"); break;
				case 2: $date = date("Y-m-d"); break;
				case 3: $date = date("H:i:s"); break;
			}
			return $date;
		}
		function nmonth($month){
			$thn_kabisat = date("Y") % 4;
			($thn_kabisat==0)?$feb=29:$feb=28;
			$init_month = array(1=>31,	// Januari [current]
								2=>$feb,	// Feb
								3=>31,	// Mar
								4=>30,	// Apr
								5=>31,	// Mei
								6=>30,	// Juni
								7=>31,	// Juli
								8=>31,	// Aug
								9=>30,	// Sep
								10=>31,	// Oct	
								11=>30,	// Nov
								12=>31);// Des
			$nmonth = $init_month[$month];
			return $nmonth;
		}
		function dateRange($start,$end){
			$xdate	=$this->frmDate($start,4);
			$ydate	=$this->frmDate($end,4);
			$xmonth	=$this->frmDate($start,5);
			$ymonth	=$this->frmDate($end,5);
			$xyear	=$this->frmDate($start,6);
			$yyear	=$this->frmDate($end,6);
			if($xyear==$yyear){
				if($xmonth==$ymonth){
					$nday=$ydate+1-$xdate;
				} else {
					$r2=NULL;
					$nmonth = $ymonth-$xmonth;			
					$r1 = $this->nmonth($xmonth)-$xdate+1;
					for($i=$xmonth+1;$i<$ymonth;$i++){
						$r2 = $r2+$this->nmonth($i);
					}
					$r3 = $ydate;
					$nday = $r1+$r2+$r3;
				}
			} else {
				// Last Year
				//get_nDay
				$r2=NULL; $r3=NULL;
				$r1=$this->nmonth($xmonth)-$xdate+1;
				//get_nMonth
				for($i=$xmonth+1;$i<13;$i++){
					$r2 = $r2+$this->nmonth($i);
				}
				// Current Year
				for($i=1;$i<$ymonth;$i++){
					$r3 = $r3+$this->nmonth($i);
				}
				$r4 = $ydate;
				$nday = $r1+$r2+$r3+$r4;
			}			
			return $nday." Hari";
		}
	
	function deadline($date){
			$now = $this->now();
			$yDate = $this->frmDate($date,6);
			$mDate = $this->frmDate($date,5);
			$dDate = $this->frmDate($date,4);
			$yNow = $this->frmDate($now,6);
			$mNow = $this->frmDate($now,5);
			$dNow = $this->frmDate($now,4);
			$deadmsg = "Telah lewat";
			// cek tahun
			if($yDate>$yNow){
				return $this->dateRange($now,$date);
			} elseif($yDate==$yNow){
				// cek bulan
				if($mDate>$mNow){
					return $this->dateRange($now,$date);
				} elseif($mDate==$mNow){
					// cek hari
					if($dDate>=$dNow){
						return $this->dateRange($now,$date);
					} else {
						return $deadmsg;
					}
				} else {
					return $deadmsg;
				}
			} else {
				return $deadmsg;
			}
		}	
		
		

	}

?>