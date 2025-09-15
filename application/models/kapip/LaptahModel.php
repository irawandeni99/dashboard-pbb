<?php
	class LaptahModel extends CI_Model{


	    public function getInstansi()
	    {
			$instansi = $this->session->userdata('id_instansi');
			$akses = $this->session->userdata('is_admin');
		
			if($akses==3){
				$where="where kd_apip='".$instansi."'";
			}else{
				$where='';
			}
		 
			$query = "SELECT * FROM ms_apip ".$where ;
	    	$sql = $this->db->query($query)->result();
	    	return $sql;
	    }

	    public function getElemen()
	    {
			
			$query = "SELECT * FROM ms_elemen order by kd_elemen";
	    	$sql = $this->db->query($query)->result();
	    	return $sql;
	    }



		public function viewProfil1($cthn,$ckode,$ctriw)
		{
		
		 $akses = $this->session->userdata('is_admin');	
		

			
		$query="SELECT a.urut,a.id_angreal,a.kd_apip,b.kd_angreal1,b.kd_angreal2,a.triw,b.uraian,b.hd,b.tampil,b.tipe,
				CASE WHEN hd='H' THEN 1 ELSE 2 END AS clevel,a.visible,a.nilai FROM tprofil_angreal a
				INNER JOIN tmap_angreal b ON a.id_angreal=b.id_angreal where a.tahun='".$cthn."' AND a.kd_apip=".$ckode." AND a.triw='".$ctriw."' and b.tampil='1'
				order by urut";	
				
			$data = $this->db->query($query)->result();
			$html = "";
			$no = 0;
			foreach ($data as $value) {
				$no++;
				
				$clevel=$value->clevel;
				$chd=$value->hd;
				$ctipe=$value->tipe;
				$ctampil=$value->tampil;
				
				
				if($ctampil=='1'){
					$icon="fa fa-plus-square-o fa-2x";
					$color="color: #006E7F";
				}else{
					$icon="fa fa-minus-square-o fa-2x";
					$color="color: #F15412";
				}
				
				$cf ="return(currencyFormat(this,',','.',event))";
				
				$chitungp1 ="javascript:hitungP1(angka(this.value),$no-1)";
			


				$button4 = '<a  class="list-group-item list-group-item-action simpan-profil1"  data-tahun="'.$cthn.'"><i class="fa fa-floppy-o" aria-hidden="true" style="color: #006E7F" ></i> Simpan</a>';
				
				if($akses == 3){
					$button5 = '';
					$button6 = '';
				}else{
					$button5 = '<a  class="list-group-item list-group-item-action showKeluaran"  ><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus</a>';
					$button6 = '<a  class="list-group-item list-group-item-action showKeluaran" ><i class="fa fa-map-o" aria-hidden="true" style="color: #F3950D"></i> Formula</a>';
						
					
				}
				

				
				if($clevel=='1'){
					$abold="<b>";
					$nbold="<b>";					
					$space="";
					
						if($chd=='H'){
							$disable="disabled";
						//	$button3 = '';
							$tback="text-align:right;background-color: #DFDFDE;";

					
							if($ctipe!=='Persentase'){
								$crp='Rp';
								$button1 = '<a  class="btn btn-sm dropdown-toggle" id="btn'.$cid.'" aria-expanded="false" data-skpd="'.$ckode.'"  style="padding: 2px 2px;" ><i class="'.$icon.'" aria-hidden="true" style="'.$color.'"></i> </a>';  		
								$button3 = '';
								$subbutton=$button4.
										   $button5;
						
							}else{
								$crp='.%.';
								
								if($akses == 3){
									$button3='';
								}else{
									$button3 = '<button data-toggle="dropdown"  id="btnGroupDrop1" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
									$subbutton=$button6;
									
								}
									
					
							}
						}else{
							
							$abold="<b>";
							$nbold="<b>";
							
							$button1 = '';
							$disable="";
							$tback="text-align:right;";
							$button3 = '<button data-toggle="dropdown"  id="btnGroupDrop1" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';

							$subbutton=$button4.
									   $button5;
							$crp='Rp';	

														

						}
					
				}else{
					$crp='Rp';
					$abold="";
					$nbold="";
					$space="&nbsp;&nbsp;";
					$button1 = '';
					$disable="";
					$tback="text-align:right;";
					$button3 = '<button data-toggle="dropdown"  id="btnGroupDrop1" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
					$subbutton=$button4.
							   $button5;

				}				
				
				//$uraian 	= '<a href="'.base_url("anggaran-rekening-subkegiatan?skpd=".$skpd).'&prog='.$prog.'&keg='.$keg.'&subkeg='.$value->kd_subkegiatan.'&nmsubkeg='.$value->nm_subkegiatan.'">'.$value->uraian.'</a>';

				$cid			=$value->id_angreal;
				//$uraian 	= $value->uraian;  $cthn."' AND a.kd_apip=".$ckode." AND a.triw='".$ctriw."'
				
				$uraian 	= '<a  class="showEditRincian" data-tahun="'.$cthn.'" data-kdapip="'.$ckode.'" data-cid="'.$cid.'" data-triw="'.$ctriw.'" data-uraian="'.$value->uraian.'">'.'&nbsp;&nbsp;'.$abold.''.$value->uraian.''.$nbold.'</a>';
		
				$cnilai 	= number_format($value->nilai,2,',','.');
				$informasi 	= '<div class="flex"><span class="currency">'.$crp.'</span>'.$abold.'<input id="'.$cid.'" name="'.$cid.'" value="'.$cnilai.'""type="text" '.$disable.' onkeyup="'.$chitungp1.'"  onkeypress="'.$cf.'" style="'.$tback.'">'.$nbold.'<div/>';

			//	$informasi 	= '<input id='.$cid.' name='.$cid.' value="'.$cnilai.'""type="text" '.$disable.' onkeypress="'.$cf.'" style="'.$tback.'">';

			$aksi='<center>
						<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
							'.$button3.'
							</button><ul class="dropdown-menu" >
							<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
								  
								  '.$subbutton.'
								
							</div> 
						  </div>
						
					</center>';


				
				$html.='<tr id='.$cid.'>
							<td style="width:5%;text-align:center;" hidden>'.$cid.'</td>
							<td style="width:5%;text-align:center;">'.$button1.'</td>
							<td style="width:45%;text-align:left;">'.$space.' '.$uraian.'</td>
							<td style="width:10%;text-align:right;">'.$informasi.'</td>
							<td style="width:5%;text-align:center;" hidden>'.$value->nilai.'</td>';
							if($this->session->userdata('is_admin') == 1 || $this->session->userdata('is_admin') == 3){ 
								$html .='<td style="width:7%;text-align:center;">'.$aksi.'</td>';
							}							
				$html.=	'
						</tr>';
						

			}
			
			return $html;
		}



		public function viewEProfil1($cthn,$ckode,$ctriw,$cid)
		{
		
			$query="SELECT a.urut,a.id_angreal,a.kd_apip,b.kd_angreal1,b.kd_angreal2,a.triw,b.uraian,b.hd,b.tampil,b.tipe,
					CASE WHEN hd='H' THEN 1 ELSE 2 END AS clevel,a.visible,a.nilai FROM tprofil_angreal a
					INNER JOIN tmap_angreal b ON a.id_angreal=b.id_angreal WHERE a.tahun='".$cthn."' AND a.kd_apip=".$ckode." AND a.triw='".$ctriw."' and b.tampil='1'
					AND kd_angreal1=(SELECT kd_angreal1 FROM tmap_angreal WHERE id_angreal='".$cid."')
					ORDER BY urut";

			$data = $this->db->query($query)->result();
			$html = "";
			$no = 0;
			foreach ($data as $value) {
				$no++;
				
				$clevel=$value->clevel;
				$chd=$value->hd;
				$ctipe=$value->tipe;
				$ctampil=$value->tampil;
				$cid			=$value->id_angreal;
				
				if($ctampil=='1'){
					$icon="fa fa-plus-square-o fa-2x";
					$color="color: #006E7F";
				}else{
					$icon="fa fa-minus-square-o fa-2x";
					$color="color: #F15412";
				}
				//onkeypress="javascript:enter(event.keyCode,'mei');
				
			//	$cnext=$no+1;
				
				
				
			//$cf ="javascript:enter(event.keyCode,".$cnext.")";
			
				$cf ="return(currencyFormat(this,',','.',event))";
				$chitungp1 ="javascript:ehitungP1(angka(this.value),$no-1)";
				
				if($clevel=='1'){
					$abold="<b>";
					$nbold="<b>";					
					$space="";
					
						if($chd=='H'){
							$disable="disabled";
						//	$button3 = '';
							$tback="text-align:right;background-color: #DFDFDE;";

					
							if($ctipe!=='Persentase'){
								$crp='Rp';
								
							}else{
								$crp='.%.';
							}
							
							$informasi 	='';
						}else{
							$button1 = '';
							$disable="";
							$tback="text-align:right;";
							
							$crp='Rp'; //np1e.

						$cnilai 	= number_format($value->nilai,2,',','.');
						$informasi 	= '<div class="flex"><span class="currency">'.$crp.'</span>'.$abold.' <input id="'.$cid.'" name="'.$cid.'" value="'.$cnilai.'""type="text" '.$disable.' onkeyup="'.$chitungp1.'"  onkeypress="'.$cf.'" style="'.$tback.'">'.$nbold.' <div/>';
									

						}
					
				}else{
					$crp='Rp';
					$abold="";
					$nbold="";
					$space="&nbsp;&nbsp;";
					$button1 = '';
					$disable="";
					$tback="text-align:right;";
					
					
				$cnilai 	= number_format($value->nilai,2,',','.');
				$informasi 	= '<div class="flex"><span class="currency">'.$crp.'</span>'.$abold.' <input id="'.$cid.'" name="'.$cid.'" value="'.$cnilai.'""type="text" '.$disable.' onkeyup="'.$chitungp1.'"  onkeypress="'.$cf.'" style="'.$tback.'">'.$nbold.' <div/>';

					
				}				
				
			
				
				$uraian 	= '<a  class="showEditRincian" disabled data-tahun="'.$cthn.'" data-kdapip="'.$ckode.'" data-cid="'.$cid.'" data-triw="'.$ctriw.'" data-uraian="'.$value->uraian.'">'.'&nbsp;&nbsp;'.$abold.' '.$value->uraian.''.$nbold.' </a>';
		

				
				$html.='<tr>
							<td style="width:5%;text-align:center;" hidden >'.$cid.'</td>
							<td style="width:45%;text-align:left;">'.$space.''.$uraian.'</td>
							<td style="width:10%;text-align:right;">'.$informasi.'</td>
							<td style="width:5%;text-align:center;"  hidden>'.$value->nilai.'</td>';
				$html.=	'
						</tr>';
						

			}
			
			return $html;
		}



		public function viewEProfil2($cthn,$ckode,$ctriw,$cid)
		{
		
			$query="SELECT a.urut,a.id_pengawasan,a.kd_apip,b.kd_pengawasan1,b.kd_pengawasan2,b.kd_pengawasan3,b.kd_pengawasan4,a.triw,b.uraian,b.hd,b.tampil,b.tipe,
				clevel,a.visible,a.nilai FROM tprofil_pengawasan a
				INNER JOIN tmap_pengawasan b ON a.id_pengawasan=b.id_pengawasan where a.tahun='".$cthn."' AND a.kd_apip=".$ckode." AND a.triw='".$ctriw."' and b.tampil='1'
				AND CONCAT_WS(kd_pengawasan1,kd_pengawasan2,kd_pengawasan3) =(SELECT CONCAT_WS(kd_pengawasan1,kd_pengawasan2,kd_pengawasan3) FROM tmap_pengawasan WHERE id_pengawasan='".$cid."')
				ORDER BY urut";	
								
			$data = $this->db->query($query)->result();
			$html = "";
			$no = 0;
			foreach ($data as $value) {
				$no++;
				
				$clevel=$value->clevel;
				$chd=$value->hd;
				$ctipe=$value->tipe;
				$ctampil=$value->tampil;
				$cid = $value->id_pengawasan;
				
				
				if($ctampil=='1'){
					$icon="fa fa-plus-square-o fa-2x";
					$color="color: #006E7F";
				}else{
					$icon="fa fa-minus-square-o fa-2x";
					$color="color: #F15412";
				}
				
				$cf ="return(currencyFormat(this,',','.',event))";
				
				
				$chitungp2 ="javascript:ehitungP2(angka(this.value),$no-1)";
			


				$button4 = '<a  class="list-group-item list-group-item-action simpan-profil2 data-skpd="'.$ckode.'" data-tahun="'.$cthn.'"><i class="fa fa-floppy-o" aria-hidden="true" style="color: #006E7F" ></i> Simpan</a>';
				$button5 = '<a  class="list-group-item list-group-item-action showKeluaran" data-skpd="'.$ckode.'" ><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus</a>';
				$button6 = '<a  class="list-group-item list-group-item-action showKeluaran" data-skpd="'.$ckode.'" ><i class="fa fa-map-o" aria-hidden="true" style="color: #F3950D"></i> Formula</a>';

				if($clevel=='1'){
					 $abold="<b>";
					 $nbold="</b>";					
					 $space="";
					$button1 ='';
					
				 }else if($clevel=='2'){
					
					$abold="<b>";
					 $nbold="</b>";					
					 $space="&nbsp;&nbsp;&nbsp;";
					 $button1 ='';
					 
				 }else if($clevel=='3'){
					
								
					 $space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	
					 
					 if($chd=='H'){
						 $abold="<b><i>";
						 $nbold="</i></b>";		
						 
						 $button1 = '<a class="btn btn-sm dropdown-toggle" id="btnp2'.$cid.'" aria-expanded="false"   style="padding: 2px 2px;" ><i class="'.$icon.'" aria-hidden="true" style="'.$color.'"></i> </a>';  		
				
					 }else{
						 $button1 =''; 
						 $abold="";
						 $nbold="";	
					 }
						
					
				 }else{
					
					 $abold="";
					 $nbold="";
					 $space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	
					 $button1 ='';	
					 
				 }	

				
				if($chd=='H'){
				$disable="disabled";
				$button3 = '';
				$tback="text-align:right;background-color: #DFDFDE;";
				$subbutton='';
				$informasi 	= '';
				}else{
					$disable="";
					$tback="text-align:right;";
					$button3 = '<button data-toggle="dropdown"  id="btnGroupDrop1P2" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
					$subbutton=$subbutton=$button4.
										  $button5;
												  
						if($ctipe=='kosong'){
							
							$informasi 	= '';
							
							
						}else if($ctipe=='angka'){
							$crp='....';
							$cnilai 	= number_format($value->nilai,0,',','.');
							$informasi 	= '<div class="flex"><span class="currency">'.$crp.'</span>'.$abold.'<input id="'.$cid.'" name="'.$cid.'" value="'.$cnilai.'""type="text" '.$disable.' onkeyup="'.$chitungp2.'"   style="'.$tback.'">'.$nbold.'<div/>';

							
						}else{
							$crp='Rp';
							$cnilai 	= number_format($value->nilai,2,',','.');
							
							$informasi 	= '<div class="flex"><span class="currency">'.$crp.'</span>'.$abold.'<input id="'.$cid.'" name="'.$cid.'" value="'.$cnilai.'""type="text" '.$disable.' onkeyup="'.$chitungp2.'"  onkeypress="'.$cf.'" style="'.$tback.'">'.$nbold.'<div/>';

							
							
						}
										  
					
				}
								
				$uraian 	= '<a  class="showEditRincianP2" data-tahun="'.$cthn.'" data-kdapip="'.$ckode.'" data-cid="'.$cid.'" data-triw="'.$ctriw.'" data-uraian="'.$value->uraian.'">'.'&nbsp;&nbsp;'.$value->uraian.'</a>';
				$aksi='<center>
							<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
								'.$button3.'
								</button><ul class="dropdown-menu" >
								<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
									  
									  '.$subbutton.'
									
								</div> 
							  </div>
							
						</center>';



						
				
				$html.='<tr id='.$cid.'>
							<td style="width:5%;text-align:center;" hidden >'.$cid.'</td>
							<td style="width:45%;text-align:left;">'.$space.''.$abold.' '.$uraian.''.$nbold.'</td>
							<td style="width:10%;text-align:right;">'.$informasi.'</td>
							<td style="width:5%;text-align:center;" hidden >'.$value->nilai.'</td>';
				
				$html.=	'
						</tr>';

			}
			
			
			return $html;
		}



		public function viewEProfil5($cthn,$ckode,$ctriw,$cid)
		{
		
					
		$query="SELECT a.urut,a.id_struktur_sdm,a.kd_apip,b.kd_struktur_sdm1,b.kd_struktur_sdm2,b.kd_struktur_sdm3,a.triw,
				case when b.poin<>'' then concat_ws('. ',b.poin,b.uraian) else uraian end as uraian,b.hd,b.tampil,
				b.clevel,a.visible,a.nilai FROM tprofil_struktur_sdm a
				INNER JOIN tmap_struktur_sdm b ON a.id_struktur_sdm=b.id_struktur_sdm WHERE a.tahun='".$cthn."' AND a.kd_apip=".$ckode." AND a.triw='".$ctriw."' AND b.tampil='1'
				AND CONCAT(kd_struktur_sdm1,kd_struktur_sdm2) =(SELECT CONCAT(kd_struktur_sdm1,kd_struktur_sdm2) FROM tmap_struktur_sdm WHERE id_struktur_sdm='".$cid."')
				ORDER BY urut";	
																
								
			$data = $this->db->query($query)->result();
			$html = "";
			$no = 0;
			foreach ($data as $value) {
				$no++;
				
				$clevel=$value->clevel;
				$chd=$value->hd;
				$ctipe=$value->tipe;
				$ctampil=$value->tampil;
				$cid = $value->id_struktur_sdm;
				
				
				if($ctampil=='1'){
					$icon="fa fa-plus-square-o fa-2x";
					$color="color: #006E7F";
				}else{
					$icon="fa fa-minus-square-o fa-2x";
					$color="color: #F15412";
				}
				
				$cf ="";//return(currencyFormat(this,',','.',event))";
				
				
				$chitungp5 ="javascript:ehitungP5(angka(this.value),$no-1)";
			


				$button4 = '<a  class="list-group-item list-group-item-action simpan-profil5 data-skpd="'.$ckode.'" data-tahun="'.$cthn.'"><i class="fa fa-floppy-o" aria-hidden="true" style="color: #006E7F" ></i> Simpan</a>';
				$button5 = '<a  class="list-group-item list-group-item-action showKeluaran" data-skpd="'.$ckode.'" ><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus</a>';
				$button6 = '<a  class="list-group-item list-group-item-action showKeluaran" data-skpd="'.$ckode.'" ><i class="fa fa-map-o" aria-hidden="true" style="color: #F3950D"></i> Formula</a>';

				if($clevel=='1'){
					 $abold="<b>";
					 $nbold="</b>";					
					 $space="";
					$button1 ='';
					
				 }else if($clevel=='2'){
					
					$abold="<b>";
					 $nbold="</b>";					
					 $space="&nbsp;&nbsp;&nbsp;";
					 $button1 ='';
					 
				 }else if($clevel=='3'){
					
								
					 $space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	
					 
					 if($chd=='H'){
						 $abold="<b><i>";
						 $nbold="</i></b>";		
						 
						 $button1 = '<a class="btn btn-sm dropdown-toggle" id="btnp2'.$cid.'" aria-expanded="false"   style="padding: 2px 2px;" ><i class="'.$icon.'" aria-hidden="true" style="'.$color.'"></i> </a>';  		
				
					 }else{
						 $button1 =''; 
						 $abold="";
						 $nbold="";	
					 }
						
					
				 }else{
					
					 $abold="";
					 $nbold="";
					 $space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	
					 $button1 ='';	
					 
				 }	

				
				if($chd=='H'){
				$disable="disabled";
				$button3 = '';
				$tback="text-align:right;background-color: #DFDFDE;";
				$subbutton='';
				$informasi 	= '';
				}else{
					$disable="";
					$tback="text-align:right;";
					$button3 = '<button data-toggle="dropdown"  id="btnGroupDrop1P5" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
					$subbutton=$subbutton=$button4.
										  $button5;
												  
						if($ctipe=='kosong'){
							
							$informasi 	= '';
							
							
						}else if($ctipe=='angka'){
							$crp='....';
							$cnilai 	= number_format($value->nilai,0,',','.');
							$informasi 	= '<div class="flex"><span class="currency">'.$crp.'</span>'.$abold.'<input id="'.$cid.'" name="'.$cid.'" value="'.$cnilai.'""type="text" '.$disable.' onkeyup="'.$chitungp5.'"   style="'.$tback.'">'.$nbold.'<div/>';

							
						}else{
							$crp='....';
							$cnilai 	= number_format($value->nilai,0,',','.');
							
							$informasi 	= '<div class="flex"><span class="currency">'.$crp.'</span>'.$abold.'<input id="'.$cid.'" name="'.$cid.'" value="'.$cnilai.'""type="text" '.$disable.' onkeyup="'.$chitungp5.'"  onkeypress="'.$cf.'" style="'.$tback.'">'.$nbold.'<div/>';
							
						}
										  
					
				}
				
				
				$uraian 	= '<a  class="showEditRincianP5" data-tahun="'.$cthn.'" data-kdapip="'.$ckode.'" data-cid="'.$cid.'" data-triw="'.$ctriw.'" data-uraian="'.$value->uraian.'">'.'&nbsp;&nbsp;'.$value->uraian.'</a>';

				$aksi='<center>
							<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
								'.$button3.'
								</button><ul class="dropdown-menu" >
								<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
									  
									  '.$subbutton.'
									
								</div> 
							  </div>
							
						</center>';



						
				
				$html.='<tr id='.$cid.'>
							<td style="width:5%;text-align:center;" hidden >'.$cid.'</td>
							<td style="width:45%;text-align:left;">'.$space.''.$abold.' '.$uraian.''.$nbold.'</td>
							<td style="width:10%;text-align:right;">'.$informasi.'</td>
							<td style="width:5%;text-align:center;" hidden >'.$value->nilai.'</td>';
				
				$html.=	'
						</tr>';

			}
			
			
			return $html;
		}



		public function viewEProfil6($cthn,$ckode,$ctriw,$cid)
		{
		
					
		$query="SELECT a.urut,a.id_sertifikasi_sdm,a.kd_apip,b.kd_sertifikasi_sdm1,b.kd_sertifikasi_sdm2,b.kd_sertifikasi_sdm3,a.triw,
				case when b.poin<>'' then concat_ws('. ',b.poin,b.uraian) else uraian end as uraian,b.hd,b.tampil,
				b.clevel,a.visible,a.nilai FROM tprofil_sertifikasi_sdm a
				INNER JOIN tmap_sertifikasi_sdm b ON a.id_sertifikasi_sdm=b.id_sertifikasi_sdm WHERE a.tahun='".$cthn."' AND a.kd_apip=".$ckode." AND a.triw='".$ctriw."' AND b.tampil='1'
				AND CONCAT(kd_sertifikasi_sdm1,kd_sertifikasi_sdm2) =(SELECT CONCAT(kd_sertifikasi_sdm1,kd_sertifikasi_sdm2) FROM tmap_sertifikasi_sdm WHERE id_sertifikasi_sdm='".$cid."')
				ORDER BY urut";	
																
								
			$data = $this->db->query($query)->result();
			$html = "";
			$no = 0;
			foreach ($data as $value) {
				$no++;
				
				$clevel=$value->clevel;
				$chd=$value->hd;
				$ctipe=$value->tipe;
				$ctampil=$value->tampil;
				$cid = $value->id_sertifikasi_sdm;
				
				
				if($ctampil=='1'){
					$icon="fa fa-plus-square-o fa-2x";
					$color="color: #006E7F";
				}else{
					$icon="fa fa-minus-square-o fa-2x";
					$color="color: #F15412";
				}
				
				$cf ="";//return(currencyFormat(this,',','.',event))";
				
				
				$chitungp6 ="javascript:ehitungP6(angka(this.value),$no-1)";
			


				$button4 = '<a  class="list-group-item list-group-item-action simpan-profil5 data-skpd="'.$ckode.'" data-tahun="'.$cthn.'"><i class="fa fa-floppy-o" aria-hidden="true" style="color: #006E7F" ></i> Simpan</a>';
				$button5 = '<a  class="list-group-item list-group-item-action showKeluaran" data-skpd="'.$ckode.'" ><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus</a>';
				$button6 = '<a  class="list-group-item list-group-item-action showKeluaran" data-skpd="'.$ckode.'" ><i class="fa fa-map-o" aria-hidden="true" style="color: #F3950D"></i> Formula</a>';

				if($clevel=='1'){
					 $abold="<b>";
					 $nbold="</b>";					
					 $space="";
					$button1 ='';
					
				 }else if($clevel=='2'){
					
					$abold="<b>";
					 $nbold="</b>";					
					 $space="&nbsp;&nbsp;&nbsp;";
					 $button1 ='';
					 
				 }else if($clevel=='3'){
					
								
					 $space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	
					 
					 if($chd=='H'){
						 $abold="<b><i>";
						 $nbold="</i></b>";		
						 
						 $button1 = '<a class="btn btn-sm dropdown-toggle" id="btnp2'.$cid.'" aria-expanded="false"   style="padding: 2px 2px;" ><i class="'.$icon.'" aria-hidden="true" style="'.$color.'"></i> </a>';  		
				
					 }else{
						 $button1 =''; 
						 $abold="";
						 $nbold="";	
					 }
						
					
				 }else{
					
					 $abold="";
					 $nbold="";
					 $space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	
					 $button1 ='';	
					 
				 }	

				
				if($chd=='H'){
				$disable="disabled";
				$button3 = '';
				$tback="text-align:right;background-color: #DFDFDE;";
				$subbutton='';
				$informasi 	= '';
				}else{
					$disable="";
					$tback="text-align:right;";
					$button3 = '<button data-toggle="dropdown"  id="btnGroupDrop1P5" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
					$subbutton=$subbutton=$button4.
										  $button5;
												  
						if($ctipe=='kosong'){
							
							$informasi 	= '';
							
							
						}else if($ctipe=='angka'){
							$crp='....';
							$cnilai 	= number_format($value->nilai,0,',','.');
							$informasi 	= '<div class="flex"><span class="currency">'.$crp.'</span>'.$abold.'<input id="'.$cid.'" name="'.$cid.'" value="'.$cnilai.'""type="text" '.$disable.' onkeyup="'.$chitungp6.'"   style="'.$tback.'">'.$nbold.'<div/>';

							
						}else{
							$crp='....';
							$cnilai 	= number_format($value->nilai,0,',','.');
							
							$informasi 	= '<div class="flex"><span class="currency">'.$crp.'</span>'.$abold.'<input id="'.$cid.'" name="'.$cid.'" value="'.$cnilai.'""type="text" '.$disable.' onkeyup="'.$chitungp6.'"  onkeypress="'.$cf.'" style="'.$tback.'">'.$nbold.'<div/>';
							
						}
										  
					
				}
				
				
				$uraian 	= '<a  class="showEditRincianP6" data-tahun="'.$cthn.'" data-kdapip="'.$ckode.'" data-cid="'.$cid.'" data-triw="'.$ctriw.'" data-uraian="'.$value->uraian.'">'.'&nbsp;&nbsp;'.$value->uraian.'</a>';

				$aksi='<center>
							<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
								'.$button3.'
								</button><ul class="dropdown-menu" >
								<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
									  
									  '.$subbutton.'
									
								</div> 
							  </div>
							
						</center>';



						
				
				$html.='<tr id='.$cid.'>
							<td style="width:5%;text-align:center;" hidden >'.$cid.'</td>
							<td style="width:45%;text-align:left;">'.$space.''.$abold.' '.$uraian.''.$nbold.'</td>
							<td style="width:10%;text-align:right;">'.$informasi.'</td>
							<td style="width:5%;text-align:center;" hidden >'.$value->nilai.'</td>';
				
				$html.=	'
						</tr>';

			}
			
			
			return $html;
		}



		public function viewEProfil7($cthn,$ckode,$ctriw,$ckd1,$ckd2,$cjns)
		{
			
			
			
			if($ckd2==0){  // level1
				
				$query="SELECT*FROM tprofil_it1 WHERE tahun='".$cthn."' AND kd_apip='".$ckode."' AND triw='".$ctriw."' AND kd_profil_it1='".$ckd1."'";
				
						$data = $this->db->query($query)->result();
						$html = "";
						
						foreach ($data as $value) {
							
							$cnilai=$value->nilai;
							$cpoin=$value->poin;
							$curaian=$value->uraian;
							$curut=$value->urut;
							
						}	
						
						if($cjns==1){
								
							$html.='   <form id="form-edit-p7" enctype="multipart/form-data" method="post">

											<div class="product-status mg-b-15">
												<div class="container-fluid">
													<div class="row" style="margin-top: 5px">
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
															<div class="product-status-wrap">

																	<div class="form-group row" style="margin-top: 5px">
																	
																					<div class="row" style="margin-top: 5px">
																						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																							<div class="product-status-wrap">
																								<div class="form-group row">
																								
																									<div class="col-sm-8">											
																										<label for="role" class="col-sm-12 control-label input-sm">'.$cpoin.'. '.$curaian.'</label>
																										<input type="hidden" id="hckd1" value='.$ckd1.'>
																										<input type="hidden" id="hckd2" value='.$ckd2.'>
																									</div>
																									
																									<div class="col-sm-4">											
																										<label class="switch">
																										  <input type="checkbox" id="cpilihan" value='.$cnilai.'>
																										  <div class="slider"></div>
																										</label>
																									</div>
																								</div>	

																							<div class="form-group row">&nbsp;
																						</div>
																					</div>
																	</div>	
																		
														  </div>
													</div>
												</div>
											</div>	

								
											<div class="modal-footer">
												<center>
														<button type="button"  class="btn-danger btn-sm" data-dismiss="modal"> <i class="fa fa-times-circle" aria-hidden="true"></i> TUTUP</button>
														<button type="button"  class="btn-success btn-sm simpan-eprofil7"><i class="fa fa-check-square"></i> SIMPAN </button>
														
												</center>
												
									</form>		
									
									</div>';
				
									

						}else{
							
							
									$html.='  <form id="form_apl"  name="form_apl" enctype="multipart/form-data" method="post">
									
												<div class="product-status mg-b-15">
													<div class="container-fluid">
														<div class="row" style="margin-top: 5px">
															<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																

																		<div class="col-sm-12">	
																			<div class="form-group row">
																				<div class="col-sm-3">														
																					<label  style="text-align: left;" class="control-label input-sm">Urut</label>
																				</div>	
																				<div class="col-sm-9">	
																					<input style="font-size:10pt; width:50px"  " value="'.$curut.'" class="form-control" id="curut_head" name="curut_head"> </input>
																				</div>	
																			
																				</div>	
																			</div>
																
																		<div class="col-sm-12">	
																			<div class="form-group row">
																				<div class="col-sm-3">														
																					<label  style="text-align: left;" class="control-label input-sm">Poin</label>
																				</div>	
																				<div class="col-sm-9">	
																					<input style="font-size:10pt; width:50px"  " value="'.$cpoin.'" class="form-control" id="cpoin_head" name="cpoin_head"> </input>
																					<input type="hidden" value="'.$ckd1.'" class="form-control" id="ckd1_head" name="ckd1_head"> </input>
																				</div>	
																			
																				</div>	
																			</div>		
																
																			
																		<div class="col-sm-12">
																			<div class="form-group row">																			
																				<div class="col-sm-3">														
																					<label  style="text-align: left;" class="control-label input-sm">Uraian</label>
																				</div>	
																				<div class="col-sm-9">	
																					<input style="font-size:10pt;"  value="'.$curaian.'" class="form-control" id="curaian_head" name="curaian_head"> </input>
																				</div>	
																			
																				</div>
																			</div>						
																			
																		
																		&nbsp;<br></div>
															  </div>
														</div>
													</div>
												</div>	
										
													<div class="modal-footer">
															<center>
																<button type="button"  class="btn-danger btn-sm" data-dismiss="modal"> <i class="fa fa-times-circle" aria-hidden="true"></i> TUTUP</button>
																<button type="button"  class="btn-success btn-sm simpan-header-eprofil7"><i class="fa fa-check-square"></i> SIMPAN </button>
															</center>	
													</div>	
														
										   
										  </div>
											
											
										</form>
						  
										  
							  </div>
							</div>';

						}

			}else{   // level 2
			
				$query="SELECT a.*,b.uraian uraian1,b.poin FROM tprofil_it2 a inner join tprofil_it1 b on a.kd_profil_it1=b.kd_profil_it1 WHERE a.tahun='".$cthn."' 
							AND a.kd_apip='".$ckode."' AND a.triw='".$ctriw."' AND a.kd_profil_it1='".$ckd1."' AND a.kd_profil_it2='".$ckd2."'";
							
							
							$csql = $this->db->query($query);
							
							$data2 = $csql->row();
							$curaian1 = $data2->uraian1;
							$cpoin = $data2->poin;
							$curaian = $data2->uraian;
				
					
		
				
									$html.='  <form id="form_apl"  name="form_apl" enctype="multipart/form-data" method="post">
												<label for="role" style="text-align: left;" class="col-sm-12 control-label input-sm">'.$cpoin.'. '.$curaian1.'</label>
												<label for="role" style="text-align: left;" class="control-label input-sm">'.$ckd2.'. '.$curaian.'</label>
												<div class="product-status mg-b-15">
													<div class="container-fluid">
														<div class="row" style="margin-top: 5px">
															<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																
																			
																			<div class="col-sm-12">	
																				<div class="col-sm-3">														
																					<label  style="text-align: left;" class="control-label input-sm">Nama Aplikasi</label>
																				</div>	
																				<div class="col-sm-9">	
																					<input style="font-size:10pt;  " class="form-control" id="cnmapl" name="cnmapl"> </input>
																					<input type="hidden" readonly="true" name="hkd1rinci" class="form-control input-sm" id="hkd1rinci" placeholder="">
																					<input type="hidden" readonly="true" name="hkd2rinci" class="form-control input-sm" id="hkd2rinci" placeholder="">
																					<input type="hidden" readonly="true" name="hkd3rinci" class="form-control input-sm" id="hkd3rinci" placeholder="">
																				</div>	
																			
																				
																			</div>						
																			
																		
																		&nbsp;<br></div>
															  </div>
														</div>
													</div>
												</div>	
										
													<div class="modal-footer">
															<center>
																<button type="button"  class="btn-danger btn-sm" data-dismiss="modal"> <i class="fa fa-times-circle" aria-hidden="true"></i> TUTUP</button>
																<button type="button" id="tambah_rinci7" class="btn-info  btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> TAMBAH </button>	
																<button type="button"  class="btn-success btn-sm simpan-rinci-eprofil7"><i class="fa fa-check-square"></i> SIMPAN </button>
															</center>	
													</div>	
														
										   
										  </div>
											
											
										</form>
						  
										  
											<div class="product-status mg-b-15">
												<div >
													<div class="row">
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
															<div class="product-status-wrap">
																<br><br>
																
																<div >
																	<table id="aplikasi-table" class="table table-bordered table-striped" style="width:100%">
																		<thead>
																			<tr>
																				
																				<th hidden>kd1</th>
																				<th hidden>kd2</th>
																				<th style="text-align:center;">No</th>
																				<th style="text-align:center;">Nama Aplikasi</th>                                   
																				<th style="text-align:center;">Aksi</th>
																			</tr>
																		</thead>
																		
																		 <tbody id="rincian-informasip7">
																								
																		 </tbody>
																	</table>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
							  </div>
							</div>';
					}
	
			return $html;
		}



		public function viewHProfil7($cthn,$ckode,$ctriw,$ckd1,$caksi)
		{
			
			
			
			if($caksi==1){
				
			
					
					$query="SELECT ifnull(max(kd_profil_it1),0)+1 cnext,ifnull(max(urut),0)+1 nexturut FROM tprofil_it1 WHERE tahun='".$cthn."' AND kd_apip='".$ckode."' AND triw='".$ctriw."'";
						$csql = $this->db->query($query);
						
						$data = $csql->row();
						$cnext = $data->cnext;
						$cnexturut = $data->nexturut;
					
				
						
						
						
						
				$html.='   <form id="form-edit-p7" enctype="multipart/form-data" method="post">

								<div class="product-status mg-b-15">
									<div class="container-fluid">
										<div class="row" style="margin-top: 5px">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
												<div class="product-status-wrap">

														<div class="form-group row" style="margin-top: 5px">
														
																		<div class="row" style="margin-top: 5px">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																				<div class="product-status-wrap">
																				
																				<div class="form-group row">
																						<div class="col-sm-4">											
																							<label>Urut</label>
																						</div>
																						
																						<div class="col-sm-8">	
																							<input style="font-size:10pt; width: 50px;" class="form-control" id="urutf7" value='.$cnexturut.' name="urutf7"> </input>
																							
																						</div>	
																	
																					</div>	
																				
																				
																					
																					<div class="form-group row">
																							<div class="col-sm-4">											
																								<label>Poin</label>
																							</div>
																							
																							<div class="col-sm-8">	
																								<input style="font-size:10pt; width: 50px;" class="form-control" id="poinf7" name="poinf7"> </input>
																								<input type="hidden" readonly="true" value="'.$cnext.'" name="ckd1f7" class="form-control input-sm" id="ckd1f7" placeholder="">
																								
																							</div>
																						
																					</div>	
																					
																					
																					<div class="form-group row">
																						<div class="col-sm-4">											
																							<label ">Uraian</label>
																						</div>
																						
																						<div class="col-sm-8">	
																							<input style="font-size:10pt;" class="form-control" id="uraianf7" name="uraianf7"> </input>
																							
																						</div>	
																					</div>						
																						
																					<div class="form-group row">
																							<div class="col-sm-4">											
																								<label>Jenis</label>
																							</div>
																								
																							<div class="col-sm-8">		
																								 <select name="jnsf7" id="jnsf7" class="form-control input-sm">
																									<option value="1">Pilihan (Ya/Tidak)</option>
																									<option value="0">Teks Uraian</option>
																									
																								  </select>

																							</div>
																							
																																											
																							</div>	
																					</div>	

																					

																				<div class="form-group row">&nbsp;
																			</div>
																		</div>
														</div>	
															
											  </div>
										</div>
									</div>
								</div>	

					
								<div class="modal-footer">
									<center>
											<button type="button"  class="btn-danger btn-sm" data-dismiss="modal"> <i class="fa fa-times-circle" aria-hidden="true"></i> TUTUP</button>
											<button type="button"  class="btn-success btn-sm simpan-hprofil7"><i class="fa fa-check-square"></i> SIMPAN </button>
											
									</center>
									
						</form>		
						
						</div>';
	
						

			}else{
				


				$query="SELECT a.*,b.uraian uraian1,b.poin FROM tprofil_it2 a inner join tprofil_it1 b on a.kd_profil_it1=b.kd_profil_it1 WHERE a.tahun='".$cthn."' 
						AND a.kd_apip='".$ckode."' AND a.triw='".$ctriw."' AND a.kd_profil_it1='".$ckd1."' AND a.kd_profil_it2='".$ckd2."'";
						$csql = $this->db->query($query);
						
						$data2 = $csql->row();
						$curaian1 = $data2->uraian1;
						$cpoin = $data2->poin;
						$curaian = $data2->uraian;
				

				
						$html.='  <form id="form_apl"  name="form_apl" enctype="multipart/form-data" method="post">
									<label for="role" style="text-align: left;" class="col-sm-12 control-label input-sm">'.$cpoin.'. '.$curaian1.'</label>
									<label for="role" style="text-align: left;" class="control-label input-sm">'.$ckd2.'. '.$curaian.'</label>
									<div class="product-status mg-b-15">
										<div class="container-fluid">
											<div class="row" style="margin-top: 5px">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													
																
																<div class="col-sm-12">	
																	<div class="col-sm-3">														
																		<label  style="text-align: left;" class="control-label input-sm">Uraian</label>
																	</div>	
																	<div class="col-sm-9">	
																		<input style="font-size:10pt;  " class="form-control" id="cnmapl" name="cnmapl"> </input>
																		
																	</div>	
																
																	
																</div>						
																
															
															&nbsp;<br></div>
												  </div>
											</div>
										</div>
									</div>	
							
										<div class="modal-footer">
												<center>
													<button type="button"  class="btn-danger btn-sm" data-dismiss="modal"> <i class="fa fa-times-circle" aria-hidden="true"></i> TUTUP</button>
													<button type="button" id="tambah_rinci7" class="btn-info  btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> TAMBAH </button>	
													<button type="button"  class="btn-success btn-sm simpan-rinci-eprofil7"><i class="fa fa-check-square"></i> SIMPAN </button>
												</center>	
										</div>	
											
							   
							  </div>
								
								
							</form>
			  
							  
								<div class="product-status mg-b-15">
									<div >
										<div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="product-status-wrap">
													<br><br>
													
													<div >
														<table id="aplikasi-table" class="table table-bordered table-striped" style="width:100%">
															<thead>
																<tr>
																	
																	<th hidden>kd1</th>
																	<th hidden>kd2</th>
																	<th style="text-align:center;">No</th>
																	<th style="text-align:center;">Nama Aplikasi</th>                                   
																	<th style="text-align:center;">Aksi</th>
																</tr>
															</thead>
															
															 <tbody id="rincian-informasip7">
																					
															 </tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
				  </div>
				</div>';
				
			
			}
			
			
			return $html;
		}




		public function viewDProfil7($cthn,$ckode,$ctriw,$ckd1,$caksi)
		{
			
			
			
			if($caksi==1){ //simpan
				
			
					
					$query="SELECT ifnull(max(kd_profil_it2),0)+1 cnext,ifnull(max(urut),0)+1 nexturut FROM tprofil_it2 WHERE tahun='".$cthn."' AND kd_apip='".$ckode."' AND triw='".$ctriw."' AND kd_profil_it1='".$ckd1."'";
						$csql = $this->db->query($query);
						
						$data = $csql->row();
						$cnext = $data->cnext;
						$cnexturut = $data->nexturut;
					
				
						
						
						
						
					$html.='   <form id="form-edit-p7" enctype="multipart/form-data" method="post">

								<div class="product-status mg-b-15">
									<div class="container-fluid">
										<div class="row" style="margin-top: 5px">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
												<div class="product-status-wrap">

														<div class="form-group row" style="margin-top: 5px">
														
																		<div class="row" style="margin-top: 5px">
																			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																				<div class="product-status-wrap">
																					
																					
																					
																					<div class="form-group row">
																						<div class="col-sm-4">											
																							<label ">Uraian</label>
																						</div>
																						
																						<div class="col-sm-8">	
																							<input style="font-size:10pt;" class="form-control" id="uraianf7_d" name="uraianf7_d"> </input>
																								<input type="hidden" readonly="true" value="'.$ckd1.'" name="ckd1f7_d" class="form-control input-sm" id="ckd1f7_d" placeholder="">
																								<input type="hidden" readonly="true" value="'.$cnext.'" name="ckd2f7_d" class="form-control input-sm" id="ckd2f7_d" placeholder="">
																							
																						</div>	
																					</div>						
																						
																					

																					<div class="form-group row">
																						<div class="col-sm-4">											
																							<label>Urut</label>
																						</div>
																						
																						<div class="col-sm-8">	
																							<input style="font-size:10pt; width: 50px;" class="form-control" id="urutf7_d" value='.$cnexturut.' name="urutf7_d"> </input>
																							
																						</div>	
																	
																					</div>	

																				<div class="form-group row">&nbsp;
																			</div>
																		</div>
														</div>	
															
											  </div>
										</div>
									</div>
								</div>	

					
								<div class="modal-footer">
									<center>
											<button type="button"  class="btn-danger btn-sm" data-dismiss="modal"> <i class="fa fa-times-circle" aria-hidden="true"></i> TUTUP</button>
											<button type="button"  class="btn-success btn-sm simpan-dprofil7"><i class="fa fa-check-square"></i> SIMPAN </button>
											
									</center>
									
						</form>		
						
						</div>';
	
						

				}
		
				
			
			return $html;
		}




		public function viewProfil2($cthn,$ckode,$ctriw)
		{
		
		$akses = $this->session->userdata('is_admin');			
		
		$query="SELECT a.urut,a.id_pengawasan,a.kd_apip,b.kd_pengawasan1,b.kd_pengawasan2,b.kd_pengawasan3,b.kd_pengawasan4,a.triw,b.uraian,b.hd,b.tampil,b.tipe,
				b.clevel,a.visible,a.nilai FROM tprofil_pengawasan a
				INNER JOIN tmap_pengawasan b ON a.id_pengawasan=b.id_pengawasan where a.tahun='".$cthn."' AND a.kd_apip=".$ckode." AND a.triw='".$ctriw."' and b.tampil='1'
				ORDER BY urut";	
								
			$data = $this->db->query($query)->result();
			$html = "";
			$no = 0;
			foreach ($data as $value) {
				$no++;
				
				$clevel=$value->clevel;
				$chd=$value->hd;
				$ctipe=$value->tipe;
				$ctampil=$value->tampil;
				$cid = $value->id_pengawasan;
				
				
				if($ctampil=='1'){
					$icon="fa fa-plus-square-o fa-2x";
					$color="color: #006E7F";
				}else{
					$icon="fa fa-minus-square-o fa-2x";
					$color="color: #F15412";
				}
				
				$cf ="return(currencyFormat(this,',','.',event))";
				
				
				$chitungp2 ="javascript:hitungP2(angka(this.value),$no-1)";				
				$button4 = '<a  class="list-group-item list-group-item-action simpan-profil2 data-skpd="'.$ckode.'" data-tahun="'.$cthn.'"><i class="fa fa-floppy-o" aria-hidden="true" style="color: #006E7F" ></i> Simpan</a>';
				
				if($akses==3){
					$button5 = '';
					$button6 = '';
						
				}else{
					$button5 = '<a  class="list-group-item list-group-item-action showKeluaran" data-skpd="'.$ckode.'" ><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus</a>';
					$button6 = '<a  class="list-group-item list-group-item-action showKeluaran" data-skpd="'.$ckode.'" ><i class="fa fa-map-o" aria-hidden="true" style="color: #F3950D"></i> Formula</a>';
					
				}

				
				
				if($clevel=='1'){
					 $abold="<b>";
					 $nbold="</b>";					
					 $space="";
					$button1 ='';
					
				 }else if($clevel=='2'){
					
					$abold="<b>";
					 $nbold="</b>";					
					 $space="&nbsp;&nbsp;&nbsp;";
					 $button1 ='';
					 
				 }else if($clevel=='3'){
								
					 $space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	
					 
					 if($chd=='H'){
						 $abold="<b><i>";
						 $nbold="</b></i>";		
						 
						 $button1 = '<a class="btn btn-sm dropdown-toggle" id="btnp2'.$cid.'" aria-expanded="false"   style="padding: 2px 2px;" ><i class="'.$icon.'" aria-hidden="true" style="'.$color.'"></i> </a>';  		
				
					 }else{
						 $button1 =''; 
						 $abold="";
						 $nbold="";	
					 }
						
					
				 }else{
					
					 $abold="";
					 $nbold="";
					 $space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	
					 $button1 ='';	
					 
				 }	
				
				
				
				
				if($chd=='H'){
					$disable="disabled";
					$button3 = '';
					$tback="text-align:right;background-color: #DFDFDE;";
					$subbutton='';
				}else{
					$disable="";
					$tback="text-align:right;";
					$button3 = '<button data-toggle="dropdown"  id="btnGroupDrop1P2" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
					$subbutton=$subbutton=$button4.
										  $button5;
					
				}
				
				

				if($ctipe=='kosong'){
					
					$informasi 	= '';
					
					
				}else if($ctipe=='angka'){
					$crp='....';
					//$cnilai  	= $value->nilai;
					$cnilai 	= number_format($value->nilai,0,',','.');
					$informasi 	= '<div class="flex"><span class="currency">'.$crp.'</span>'.$abold.'<input id="'.$cid.'" name="'.$cid.'" value="'.$cnilai.'""type="text" '.$disable.' onkeyup="'.$chitungp2.'"   style="'.$tback.'">'.$nbold.'<div/>';

					
				}else{
					$crp='Rp';
					$cnilai 	= number_format($value->nilai,2,',','.');
					
					$informasi 	= '<div class="flex"><span class="currency">'.$crp.'</span>'.$abold.'<input id="'.$cid.'" name="'.$cid.'" value="'.$cnilai.'""type="text" '.$disable.' onkeyup="'.$chitungp2.'"  onkeypress="'.$cf.'" style="'.$tback.'">'.$nbold.'<div/>';

				}
				
				
				 			
				
				$uraian 	= '<a  class="showEditRincianP2" data-tahun="'.$cthn.'" data-kdapip="'.$ckode.'" data-cid="'.$cid.'" data-triw="'.$ctriw.'" data-uraian="'.$value->uraian.'">'.'&nbsp;&nbsp;'.$abold.''.$value->uraian.''.$nbold.'</a>';


				$aksi='<center>
							<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
								'.$button3.'
								</button><ul class="dropdown-menu" >
								<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
									  
									  '.$subbutton.'
									
								</div> 
							  </div>
							
						</center>';
						
						$idtbl='P2_';
				
				$html.='<tr id='.$idtbl.''.$cid.'>
							<td style="width:5%;text-align:center;" hidden >'.$cid.'</td>
							<td style="width:5%;text-align:center;">'.$button1.'</td>
							<td style="width:45%;text-align:left;">'.$space.''.$uraian.'</td>
							<td style="width:10%;text-align:right;">'.$informasi.'</td>
							<td style="width:5%;text-align:center;" hidden >'.$value->nilai.'</td>';
				$html .='<td style="width:7%;text-align:center;">'.$aksi.'</td>';
				$html.=	'
						</tr>';

			}
			
			return $html;
		}


		public function viewProfil5($cthn,$ckode,$ctriw)
		{
		
		$akses = $this->session->userdata('is_admin');				
		
		$query="SELECT a.urut,a.id_struktur_sdm,a.kd_apip,b.kd_struktur_sdm1,b.kd_struktur_sdm2,b.kd_struktur_sdm3,a.triw,
				case when b.poin<>'' then concat_ws('. ',b.poin,b.uraian) else uraian end as uraian,b.hd,b.tampil,
				b.clevel,a.visible,a.nilai FROM tprofil_struktur_sdm a
				INNER JOIN tmap_struktur_sdm b ON a.id_struktur_sdm=b.id_struktur_sdm WHERE a.tahun='".$cthn."' AND a.kd_apip=".$ckode." AND a.triw='".$ctriw."' AND b.tampil='1'
				ORDER BY urut";	
								
			$data = $this->db->query($query)->result();
			$html = "";
			$no = 0;
			foreach ($data as $value) {
				$no++;
				
				$clevel=$value->clevel;
				$chd=$value->hd;
				$ctipe=$value->tipe;
				$ctampil=$value->tampil;
				$cid = $value->id_struktur_sdm;
				
				
				if($ctampil=='1'){
					$icon="fa fa-plus-square-o fa-2x";
					$color="color: #006E7F";
				}else{
					$icon="fa fa-minus-square-o fa-2x";
					$color="color: #F15412";
				}
				
				$cf ="";//"return(currencyFormat(this,',','.',event))";
				
				
				$chitungp5 ="javascript:hitungP5(angka(this.value),$no-1)";				
				$button4 = '<a  class="list-group-item list-group-item-action simpan-profil5 data-skpd="'.$ckode.'" data-tahun="'.$cthn.'"><i class="fa fa-floppy-o" aria-hidden="true" style="color: #006E7F" ></i> Simpan</a>';
				
				if($akses==3){
					$button5 = '';
					$button6 = '';
					
				}else{
					$button5 = '<a  class="list-group-item list-group-item-action showKeluaran" data-skpd="'.$ckode.'" ><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus</a>';
					$button6 = '<a  class="list-group-item list-group-item-action showKeluaran" data-skpd="'.$ckode.'" ><i class="fa fa-map-o" aria-hidden="true" style="color: #F3950D"></i> Formula</a>';
					
				}

				
				
				if($clevel=='1'){
					 $abold="<b>";
					 $nbold="</b>";					
					 $space="";
					$button1 ='';
					
				 }else if($clevel=='2'){
					
					$abold="<b>";
					 $nbold="</b>";					
					 $space="&nbsp;&nbsp;&nbsp;";
					 $button1 = '<a  class="btn btn-sm dropdown-toggle" id="btnp5_'.$cid.'" aria-expanded="false"   style="padding: 2px 2px;" ><i class="'.$icon.'" aria-hidden="true" style="'.$color.'"></i> </a>';  		

					 
				 }else if($clevel=='3'){
								
					 $space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	
					 
					 if($chd=='H'){
						 $abold="<b><i>";
						 $nbold="</b></i>";		
						 
								
					 }else{
						 $button1 =''; 
						 $abold="";
						 $nbold="";	
					 }
						
					
				 }else{
					
					 $abold="";
					 $nbold="";
					 $space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	
					 $button1 ='';	
					 
				 }	
				
				
				
				
				if($chd=='H'){
					$disable="disabled";
					$button3 = '';
					$tback="text-align:right;background-color: #DFDFDE;";
					$subbutton='';
				}else{
					$disable="";
					$tback="text-align:right;";
					$button3 = '<button data-toggle="dropdown"  id="btnGroupDrop1P5" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
					$subbutton=$subbutton=$button4.
										  $button5;
					
				}
				
				

				if($ctipe=='kosong'){
					
					$informasi 	= '';
					
					
				}else if($ctipe=='angka'){
					$crp='<i class="fa fa-user" aria-hidden="true"></i>';
					//$cnilai  	= $value->nilai;
					$cnilai 	= number_format($value->nilai,0,',','.');
					$informasi 	= '<div class="flex"><span class="currency">'.$crp.'</span>'.$abold.'<input id="'.$cid.'" name="'.$cid.'" value="'.$cnilai.'""type="text" '.$disable.' onkeyup="'.$chitungp5.'"   style="'.$tback.'">'.$nbold.'<div/>';

					
				}else{
					$crp='<i class="fa fa-user" aria-hidden="true"></i>';
					$cnilai 	= number_format($value->nilai,0,',','.');
					
					$informasi 	= '<div class="flex"><span class="currency">'.$crp.'</span>'.$abold.'<input id="'.$cid.'" name="'.$cid.'" value="'.$cnilai.'""type="text" '.$disable.' onkeyup="'.$chitungp5.'"  onkeypress="'.$cf.'" style="'.$tback.'">'.$nbold.'<div/>';

				}
				
				
				 			
				
				$uraian 	= '<a  class="showEditRincianP5" data-tahun="'.$cthn.'" data-kdapip="'.$ckode.'" data-cid="'.$cid.'" data-triw="'.$ctriw.'" data-uraian="'.$value->uraian.'">'.'&nbsp;&nbsp;'.$abold.''.$value->uraian.''.$nbold.'</a>';

				$aksi='<center>
							<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
								'.$button3.'
								</button><ul class="dropdown-menu" >
								<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
									  
									  '.$subbutton.'
									
								</div> 
							  </div>
							
						</center>';

				$idtbl='P5_';
				$html.='<tr id='.$idtbl.''.$cid.'>
							<td style="width:5%;text-align:center;" hidden >'.$cid.'</td>
							<td style="width:5%;text-align:center;">'.$button1.'</td>
							<td style="width:45%;text-align:left;">'.$space.''.$uraian.'</td>
							<td style="width:10%;text-align:right;">'.$informasi.'</td>
							<td style="width:5%;text-align:center;" hidden >'.$value->nilai.'</td>';
				$html .='<td style="width:7%;text-align:center;">'.$aksi.'</td>';
				$html.=	'
						</tr>';

			}
			
			return $html;
		}



		public function viewProfil6($cthn,$ckode,$ctriw)
		{
			$akses = $this->session->userdata('is_admin');				
			$query="SELECT a.urut,a.id_sertifikasi_sdm,a.kd_apip,b.kd_sertifikasi_sdm1,b.kd_sertifikasi_sdm2,b.kd_sertifikasi_sdm3,a.triw,
					case when b.poin<>'' then concat_ws('. ',b.poin,b.uraian) else uraian end as uraian,b.hd,b.tampil,
					b.clevel,a.visible,a.nilai FROM tprofil_sertifikasi_sdm a
					INNER JOIN tmap_sertifikasi_sdm b ON a.id_sertifikasi_sdm=b.id_sertifikasi_sdm WHERE a.tahun='".$cthn."' AND a.kd_apip=".$ckode." AND a.triw='".$ctriw."' AND b.tampil='1'
					ORDER BY urut";	
								
			$data = $this->db->query($query)->result();
			$html = "";
			$no = 0;
			foreach ($data as $value) {
				$no++;
				
				$clevel=$value->clevel;
				$chd=$value->hd;
				$ctipe=$value->tipe;
				$ctampil=$value->tampil;
				$cid = $value->id_sertifikasi_sdm;
				
				
				if($ctampil=='1'){
					$icon="fa fa-plus-square-o fa-2x";
					$color="color: #006E7F";
				}else{
					$icon="fa fa-minus-square-o fa-2x";
					$color="color: #F15412";
				}
				
				$cf ="";//"return(currencyFormat(this,',','.',event))";
				
				
				$chitungp6 ="javascript:hitungP6(angka(this.value),$no-1)";				
				$button4 = '<a  class="list-group-item list-group-item-action simpan-profil6 data-skpd="'.$ckode.'" data-tahun="'.$cthn.'"><i class="fa fa-floppy-o" aria-hidden="true" style="color: #006E7F" ></i> Simpan</a>';
				
				if($akses==3){
					$button5 = '';
					$button6 = '';
					
				}else{
					$button5 = '<a  class="list-group-item list-group-item-action showKeluaran" data-skpd="'.$ckode.'" ><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus</a>';
					$button6 = '<a  class="list-group-item list-group-item-action showKeluaran" data-skpd="'.$ckode.'" ><i class="fa fa-map-o" aria-hidden="true" style="color: #F3950D"></i> Formula</a>';

				}
				
				
				
				if($clevel=='1'){
					 $abold="<b>";
					 $nbold="</b>";					
					 $space="";
					$button1 ='';
					
				 }else if($clevel=='2'){
					
					$abold="<b>";
					 $nbold="</b>";					
					 $space="&nbsp;&nbsp;&nbsp;";
					 $button1 = '<a class="btn btn-sm dropdown-toggle" id="btnp6_'.$cid.'" aria-expanded="false"   style="padding: 2px 2px;" ><i class="'.$icon.'" aria-hidden="true" style="'.$color.'"></i> </a>';  		

					 
				 }else if($clevel=='3'){
								
					 $space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	
					 
					 if($chd=='H'){
						 $abold="<b><i>";
						 $nbold="</b></i>";		
						 
								
					 }else{
						 $button1 =''; 
						 $abold="";
						 $nbold="";	
					 }
						
					
				 }else{
					
					 $abold="";
					 $nbold="";
					 $space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	
					 $button1 ='';	
					 
				 }	
				
				
				
				
				if($chd=='H'){
					$disable="disabled";
					$button3 = '';
					$tback="text-align:right;background-color: #DFDFDE;";
					$subbutton='';
				}else{
					$disable="";
					$tback="text-align:right;";
					$button3 = '<button data-toggle="dropdown"  id="btnGroupDrop1P6" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
					$subbutton=$subbutton=$button4.
										  $button5;
					
				}
				
				

				if($ctipe=='kosong'){
					
					$informasi 	= '';
					
					
				}else if($ctipe=='angka'){
					$crp='<i class="fa fa-user" aria-hidden="true"></i>';
					//$cnilai  	= $value->nilai;
					$cnilai 	= number_format($value->nilai,0,',','.');
					$informasi 	= '<div class="flex"><span class="currency">'.$crp.'</span>'.$abold.'<input id="'.$cid.'" name="'.$cid.'" value="'.$cnilai.'""type="text" '.$disable.' onkeyup="'.$chitungp6.'"   style="'.$tback.'">'.$nbold.'<div/>';

					
				}else{
					$crp='<i class="fa fa-user" aria-hidden="true"></i>';
					$cnilai 	= number_format($value->nilai,0,',','.');
					
					$informasi 	= '<div class="flex"><span class="currency">'.$crp.'</span>'.$abold.'<input id="'.$cid.'" name="'.$cid.'" value="'.$cnilai.'""type="text" '.$disable.' onkeyup="'.$chitungp6.'"  onkeypress="'.$cf.'" style="'.$tback.'">'.$nbold.'<div/>';

				}
				
				
				 			
				
				$uraian 	= '<a  class="showEditRincianP6" data-tahun="'.$cthn.'" data-kdapip="'.$ckode.'" data-cid="'.$cid.'" data-triw="'.$ctriw.'" data-uraian="'.$value->uraian.'">'.'&nbsp;&nbsp;'.$abold.''.$value->uraian.''.$nbold.'</a>';

				$aksi='<center>
							<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
								'.$button3.'
								</button><ul class="dropdown-menu" >
								<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
									  
									  '.$subbutton.'
									
								</div> 
							  </div>
							
						</center>';
						
				$idtbl='P6_';
				
				$html.='<tr id='.$idtbl.''.$cid.'>
							<td style="width:5%;text-align:center;" hidden >'.$cid.'</td>
							<td style="width:5%;text-align:center;">'.$button1.'</td>
							<td style="width:45%;text-align:left;">'.$space.''.$uraian.'</td>
							<td style="width:10%;text-align:right;">'.$informasi.'</td>
							<td style="width:5%;text-align:center;" hidden >'.$value->nilai.'</td>';
				$html .='<td style="width:7%;text-align:center;">'.$aksi.'</td>';
				$html.=	'
						</tr>';

			}
			
			return $html;
		}




		public function viewProfil7($cthn,$ckode,$ctriw)
		{			
			$akses = $this->session->userdata('is_admin');
			
			$query="SELECT tahun,triw,kd_profil_it1,nilai,poin,uraian,jns_info,urut,'1'clevel FROM tprofil_it1 
						WHERE tahun='".$cthn."' AND kd_apip=".$ckode." AND triw='".$ctriw."'
						ORDER BY urut,kd_profil_it1";	
							
								
			$data = $this->db->query($query)->result();
			
			$html = "";
			
			$no = 0;
			
			foreach ($data as $value) {
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
				
							$button4 = '<a  class="list-group-item list-group-item-action edit-profil7" data-kd1="'.$ckd1.'" data-kd2="'.$ckd2.'" data-jenis="'.$cjns_info.'" data-nilai="'.$cnilai.'"> <i class="fa fa-pencil-square-o" aria-hidden="true" style="color: #006E7F" ></i> Edit</a>';
							
						if($akses==3){
								$button5 ='';
								$button6 ='';
						}else{
								$button5 = '<a  class="list-group-item list-group-item-action hapus-hprofil7" data-kd1="'.$ckd1.'" data-kd2="'.$ckd2.'" data-uraian="'.$curaian.'" ><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus</a>';
								$button6 = '<a  class="list-group-item list-group-item-action tambah-detail-profil7" data-kd1="'.$ckd1.'"  ><i class="fa fa-plus-square-o" aria-hidden="true" style="color: #006E7F"></i> Tambah</a>';

						}	
						
							
						
						$cpoin=$value->poin;
						
						if($cjns_info!=='1'){
						
							$query2="SELECT uraian FROM tprofil_it3 
									WHERE tahun='".$cthn."' AND kd_apip=".$ckode." AND triw='".$ctriw."' and kd_profil_it1='".$ckd1."'
									group by uraian
									ORDER BY uraian ";	
									
							
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
								$curaian2=$curaian2.$space1.$xno.' . '.$value2->uraian.'<br>&nbsp;&nbsp;';
								
							}
							$button3 ='<button data-toggle="dropdown"  id="btnGroupDrop1P6" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';;
							$button4 = '<a  class="list-group-item list-group-item-action edit-profil7" data-kd1="'.$ckd1.'" data-kd2="'.$ckd2.'" data-jenis="'.$cjns_info.'" data-nilai="'.$cnilai.'"> <i class="fa fa-pencil-square-o" aria-hidden="true" style="color: #006E7F" ></i> Edit</a>';
							
							$subbutton=$button6.$button4.
									   $button5;					
						}else{
							
							$curaian2=$pilihan1;
							$button3 = '<button data-toggle="dropdown"  id="btnGroupDrop1P6" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
							$subbutton=$button4.
									   $button5;
							
						}
						
							$uraian 	= '<a  class="showEditRincianP7" data-tahun="'.$cthn.'" data-kdapip="'.$ckode.'"  data-triw="'.$ctriw.'" data-uraian="'.$value->uraian.'">'.'&nbsp;&nbsp;<b>'.$abold.''.$curaian.'</b></a>';
							$uraian2 	= '<b>'.$curaian2.'</b>';
					

				
				$aksi='<center>
							<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
								'.$button3.'
								</button><ul class="dropdown-menu" >
								<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
									  
									  '.$subbutton.'
									
								</div> 
							  </div>
							
						</center>';
					
							
							
					$html.='<tr>
							<td style="width:5%;text-align:center;" hidden >'.$cjns_info.'</td>
							<td style="width:5%;text-align:center;" hidden >'.$cnilai.'</td>
							<td style="width:5%;text-align:center;" hidden >'.$ckd1.'</td>
							<td style="width:1%;text-align:left;"  >'.$cpoin.'</td>							
							
							<td style="width:45%;text-align:left;">'.$uraian.'</td>
							<td style="width:45%;text-align:left;">'.$uraian2.'</td>';
					$html .='<td style="width:7%;text-align:center;">'.$aksi.'</td>';
					$html.=	'
							</tr>';
						

		// -- level2		
				
				$dquery="SELECT a.tahun,a.triw,a.kd_profil_it1,a.kd_profil_it2,''nilai,'' poin,a.uraian,'0'jns_info,
						urut,'2'clevel FROM tprofil_it2 a 
						WHERE a.tahun='".$cthn."' AND a. kd_apip=".$ckode." AND a.triw='".$ctriw."' and a.kd_profil_it1='".$ckd1."'
						ORDER BY urut,kd_profil_it1,kd_profil_it2";	
							
								
				$ddata = $this->db->query($dquery)->result();
					$dno=0;
					foreach ($ddata as $value2) {   
					$dno++;
				
						$curaian=$value2->uraian;
						$ckd1=$value2->kd_profil_it1;
						$ckd2=$value2->kd_profil_it2;
						$clevel=$value2->clevel;
						$curut=$value2->urut;
						$cjns_info=0;
						
						$button4 = '<a  class="list-group-item list-group-item-action edit-profil7" data-kd1="'.$ckd1.'" data-kd2="'.$ckd2.'" data-jenis="'.$cjns_info.'" data-nilai="'.$cnilai.'"> <i class="fa fa-pencil-square-o" aria-hidden="true" style="color: #006E7F" ></i> Edit</a>';
						if($akses==3){
							$button5 ='';
						}else{
							$button5 = '<a  class="list-group-item list-group-item-action hapus-dprofil7" data-kd1="'.$ckd1.'" data-kd2="'.$ckd2.'" data-uraian="'.$curaian.'" ><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus</a>';
							
						}
						
							$cpoin=$dno;
							$button3 = '<button data-toggle="dropdown"  id="btnGroupDrop1P6" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
							$subbutton=$button4.
									   $button5;
										  
							$query3="SELECT uraian FROM tprofil_it3 
									 WHERE tahun='".$cthn."' AND kd_apip=".$ckode." AND triw='".$ctriw."' and kd_profil_it1='".$ckd1."' and kd_profil_it2='".$ckd2."'
									 ORDER BY uraian ";	
						
							$data3 = $this->db->query($query3)->result();
						
							$cno = 0;
							$curaian3='';
							foreach ($data3 as $value3) {
								$cno++;
								
								if($cno==1){
									$space1='&nbsp;&nbsp;';
								}else{
									$space1='';
								}
								$curaian3=$curaian3.$space1.$cno.' . '.$value3->uraian.'<br>&nbsp;&nbsp;';
								
							}   
						
						
								$uraian 	= '<a  class="showEditRincianP7" data-tahun="'.$cthn.'" data-kdapip="'.$ckode.'"  data-triw="'.$ctriw.'" data-uraian="'.$value->uraian.'">'.'&nbsp;&nbsp;'.$abold.''.$curaian.''.$nbold.'</a>';;
								$uraian2 	= $curaian3;

				
						$aksi='<center>
							<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
								'.$button3.'
								</button><ul class="dropdown-menu" >
								<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
									  
									  '.$subbutton.'
									
								</div> 
							  </div>
							
						</center>';

	
						$html.='<tr>
								<td style="width:5%;text-align:center;" hidden >'.$cjns_info.'</td>
								<td style="width:5%;text-align:center;" hidden >'.$cnilai.'</td>
								<td style="width:5%;text-align:center;" hidden >'.$ckd1.'</td>
								<td style="width:1%;text-align:left;"  >'.$cpoin.'</td>							
								
								<td style="width:45%;text-align:left;">'.$uraian.'</td>
								<td style="width:45%;text-align:left;">'.$uraian2.'</td>';
						$html .='<td style="width:7%;text-align:center;">'.$aksi.'</td>';
						$html.=	'
								</tr>';
							
					
					
					
					}		
					

			}
			
			return $html;
		}




		public function viewEHProfil4($ckd1,$cinstansi,$cjns) 
		
		{			
			$query="select*From tprofil_gov1 
						WHERE kd_apip='".$cinstansi."' and kd_profil_gov1='".$ckd1."'
						ORDER BY urut,kd_profil_gov1";	
							
								
			$data = $this->db->query($query)->result();
			
			$html = "";
			
			$no = 0;
			
			foreach ($data as $value) {
				$no++;
				
				
				$cpoin=$value->poin;
				$curaian=$value->uraian;
				$cjns_info=$value->jns_info;
				$cnilai=$value->nilai;
				$curut=$value->urut;
				$selected='selected';
						
						
				$html.='  <form id="form_hp4"  name="form_apl" enctype="multipart/form-data" method="post">
									
												<div class="product-status mg-b-15">
													<div class="container-fluid">
														<div class="row" style="margin-top: 5px">
															<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																

																		<div class="col-sm-12">	
																			<div class="form-group row">
																				<div class="col-sm-3">														
																					<label  style="text-align: left;" class="control-label input-sm">Urut</label>
																				</div>	
																				<div class="col-sm-9">	
																					<input style="font-size:10pt; width:50px"  " value="'.$curut.'" class="form-control" id="curut_head4" name="curut_head4"> </input>
																				</div>	
																			
																				</div>	
																			</div>
																
																		<div class="col-sm-12">	
																			<div class="form-group row">
																				<div class="col-sm-3">														
																					<label  style="text-align: left;" class="control-label input-sm">Poin</label>
																				</div>	
																				<div class="col-sm-9">	
																					<input style="font-size:10pt; width:50px"  " value="'.$cpoin.'" class="form-control" id="cpoin_head4" name="cpoin_head4"> </input>
																					<input type="hidden" value="'.$ckd1.'" class="form-control" id="ckd1_head4" name="ckd1_head4"> </input>
																				</div>	
																			
																				</div>	
																			</div>		
																
																			
																		<div class="col-sm-12">
																			<div class="form-group row">																			
																				<div class="col-sm-3">														
																					<label  style="text-align: left;" class="control-label input-sm">Uraian</label>
																				</div>	
																					<div class="col-sm-9">	
																						<input style="font-size:10pt;"  value="'.$curaian.'" class="form-control" id="curaian_head4" name="curaian_head4"> </input>
																					</div>	
																			
																			</div>
																		</div>';						
																			
																		
																	$htmlxx.='<div class="col-sm-12">
																			<div class="form-group row">
																				<div class="form-group row">	
																						<div class="col-sm-3">											
																							<label  style="text-align: left;" class="control-label input-sm">Jenis Jawaban</label>
																						</div>


																								<select>
																							  
																								  <option value="1" <?php if("'.$cjns_info.'"=="1") {echo "selected";} ?>>Privilege 1</option> 
																								  <option value="2" <?php if("'.$cjns_info.'"=="2") {echo "selected";} ?>>Privilege 2</option>
																								  <option value="3" <?php if("'.$cjns_info.'"=="3") {echo "selected";} ?>>Privilege 3</option>
																								</select>																			

											

																				</div>
																			</div>
																																									
																		</div>';
																		
																		
																		
																		
																					
															$html.='</div>		
																</div>
																		
																		
															  </div>
														</div>
													</div>
												</div>	
										
													<div class="modal-footer">
															<center>
																<button type="button"  class="btn-danger btn-sm" data-dismiss="modal"> <i class="fa fa-times-circle" aria-hidden="true"></i> TUTUP</button>
																<button type="button"  class="btn-success btn-sm simpan-header-ehprofil4"><i class="fa fa-check-square"></i> SIMPAN </button>
															</center>	
													</div>	
														
										   
										  </div>
											
											
										</form>
						  
										  
							  </div>
							</div>';		
					
				
			}
			
			return $html;
		}



		public function viewHProfil4($cthn,$ckode,$caksi) //cekdni
		
		{			

			$query="SELECT ifnull(max(kd_profil_gov1),0)+1 cnext,ifnull(max(urut),0)+1 nexturut FROM tprofil_gov1 WHERE kd_apip='".$ckode."'";
						$csql = $this->db->query($query);
						
						$data = $csql->row();
						$cnext = $data->cnext;
						$cnexturut = $data->nexturut;
			
			
			$html = "";
	
				
				
						
						
				$html.='  <form id="form_hp4"  name="form_apl" enctype="multipart/form-data" method="post">
									
												<div class="product-status mg-b-15">
													<div class="container-fluid">
														<div class="row" style="margin-top: 5px">
															<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																

																		<div class="col-sm-12">	
																			<div class="form-group row">
																				<div class="col-sm-3">														
																					<label  style="text-align: left;" class="control-label input-sm">Urut</label>
																				</div>	
																				<div class="col-sm-9">	
																					<input style="font-size:10pt; width:50px"  " value="'.$cnexturut.'" class="form-control" id="curut_head4_ins" name="curut_head4_ins"> </input>
																				</div>	
																			
																				</div>	
																			</div>
																
																		<div class="col-sm-12">	
																			<div class="form-group row">
																				<div class="col-sm-3">														
																					<label  style="text-align: left;" class="control-label input-sm">Poin</label>
																				</div>	
																				<div class="col-sm-9">	
																					<input style="font-size:10pt; width:50px"  " value="" class="form-control" id="cpoin_head4_ins" name="cpoin_head4_ins"> </input>
																					<input type="hidden" value="'.$cnext.'" class="form-control" id="ckd1_head4_ins" name="ckd1_head4_ins"> </input>
																				</div>	
																			
																				</div>	
																			</div>		
																
																			
																		<div class="col-sm-12">
																			<div class="form-group row">																			
																				<div class="col-sm-3">														
																					<label  style="text-align: left;" class="control-label input-sm">Pertanyaan</label>
																				</div>	
																				<div class="col-sm-9">	
																					<input style="font-size:10pt;"  value="" class="form-control" id="curaian_head4_ins" name="curaian_head4_ins"> </input>
																				</div>	
																			
																				</div>
																			</div>	


																			<div class="form-group row">
																				<div class="form-group row">	
																						<div class="col-sm-3">											
																							<label  style="text-align: left;" class="control-label input-sm">Jenis Jawaban</label>
																						</div>
																							
																						<div class="col-sm-9">		
																							 <select name="jnsf4_ins" id="jnsf4_ins" class="form-control input-sm">
																								<option value="1">Pilihan (Ya/Tidak)</option>
																								<option value="2">Nilai(Rp)</option>
																								<option value="3">Teks Uraian</option>
																								
																							  </select>

																						</div>
																					</div>
																																									
																					</div>	
																			</div>																				
																			
																		
																		&nbsp;<br></div>
															  </div>
														</div>
													</div>
												</div>	
										
													<div class="modal-footer">
															<center>
																<button type="button"  class="btn-danger btn-sm" data-dismiss="modal"> <i class="fa fa-times-circle" aria-hidden="true"></i> TUTUP</button>
																<button type="button"  class="btn-success btn-sm simpan-header-hprofil4"><i class="fa fa-check-square"></i> SIMPAN </button>
															</center>	
													</div>	
														
										   
										  </div>
											
											
										</form>
						  
										  
							  </div>
							</div>';		
					
		
			
			return $html;
		}


		public function viewProfil4($cthn,$ckode)
		{	


			$akses = $this->session->userdata('is_admin');
			$tahun = $this->session->userdata('year_selected');

			 if($akses == 3){
	    		$chidden="hidden";
	    	}else{
				
				$chidden="";
			}



			$query="SELECT kd_profil_gov1,poin,uraian,jns_info,urut,'1'clevel FROM tprofil_gov1 
					WHERE kd_apip=".$ckode." and visible='1' ORDER BY urut,kd_profil_gov1";	
							
								
			$data = $this->db->query($query)->result();
			
			$cf ="return(currencyFormat(this,',','.',event))";
			
			$html = "";
			$xno = 0;
			$xxno=0;
			$no = 0;
			$tahun_awal=$tahun-4;
			$tahun_akhir=$tahun_awal+2;
			
			//return($tahun_akhir);
			
			foreach ($data as $value) { 
				$no++;
				$xno++;
				
				$cpoin=$value->poin;
				$curaian=$value->uraian;
				$cjns_info=$value->jns_info;
				$cnilai=$value->nilai;
				$ckd1=$value->kd_profil_gov1;
				$ckd2=0;
				$clevel=$value->clevel;
				$curut=$value->urut;
				$ctahun_trx='';
				
				
				
				
				
						
							$button4 = '<a  class="list-group-item list-group-item-action edit-hprofil4" data-kd1="'.$ckd1.'" data-kd2="'.$ckd2.'" data-jenis="'.$cjns_info.'"  > <i class="fa fa-pencil-square-o" aria-hidden="true" style="color: #006E7F" ></i> Edit</a>';
							$button5 = '<a  class="list-group-item list-group-item-action hapus-hprofil4" data-kd1="'.$ckd1.'" data-kd2="'.$ckd2.'" data-uraian="'.$curaian.'" ><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus</a>';
							$button6 = '<a  class="list-group-item list-group-item-action tambah-detail-profil7" data-kd1="'.$ckd1.'"  ><i class="fa fa-plus-square-o" aria-hidden="true" style="color: #006E7F"></i> Tambah</a>';
							
							$button3 = '<button data-toggle="dropdown"  id="btnGroupDrop1P4" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
							$subbutton=$button4.
									   $button5;
						
						
						
							$uraian 	= '<a  class="showEditRincianP7" data-tahun="'.$cthn.'" data-kdapip="'.$ckode.'"  data-triw="'.$ctriw.'" data-uraian="'.$value->uraian.'">'.'&nbsp;&nbsp;<b>'.$abold.''.$curaian.'</b></a>';
							$uraian2 	= '<b>'.$curaian2.'</b>';
					
				
				
				
				
				
					$aksi='<center>
							<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
								'.$button3.'
								</button><ul class="dropdown-menu" >
								<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
									  
									  '.$subbutton.'
									
								</div> 
							  </div>
							
						</center>';
					
							
							
					$html.='<tr> 
							<td style="width:5%;text-align:center;" hidden >'.$cjns_info.'</td>
							<td style="width:5%;text-align:center;" hidden >'.$cnilai.'</td>
							<td style="width:5%;text-align:center;" hidden >'.$ckd1.'</td>
							<td style="width:5%;text-align:center;" hidden >'.$ckd2.'</td>
							<td style="width:1%;text-align:center;"  >'.$cpoin.'</td>							
							<td style="width:1%;text-align:left;" hidden >'.$clevel.'</td>							
							<td style="width:1%;text-align:left;" hidden >'.$ctahun_trx.'</td>							
							
							<td style="width:45%;text-align:left;">'.$uraian.'</td>
							<td style="width:45%;text-align:left;"></td>';
					$html .='<td style="width:7%;text-align:center;" '.$chidden.'>'.$aksi.'</td>';
				

							
					
							$ctahun=$tahun_awal;
							$cinformasi='';
						
						for($i=$tahun_awal;$i<=$tahun_akhir;$i++){
							$ctahun=$ctahun+1;
							$ctahun = $ctahun;
							$xxno++;
							$uraian2='';
							$clevel=2;
								
							
							if($cjns_info==1){
							
								$curaian2=$pilihan1;
							}else{
								
								$curaian2='';
								
							}
							
							
									$query="SELECT COUNT(*)jml FROM tprofil_gov2  WHERE tahun='".$ctahun."' AND kd_apip='".$ckode."' and kd_profil_gov1='".$ckd1."'";
									$csql = $this->db->query($query);
									
									$data = $csql->row();
									$cek = $data->jml;
									
									if($cek>=1){
										
										
										
										$query="SELECT a.*,'2'clevel FROM tprofil_gov2 a WHERE a.tahun='".$ctahun."' AND a.kd_apip='".$ckode."' and a.kd_profil_gov1='".$ckd1."'";
										$csql = $this->db->query($query);
										
										$data = $csql->row();
										$uraian = $data->uraian;
										$nilai = $data->nilai;
										$nilai_pilihan = $data->nilai_pilihan;
										$ckd2 = $data->kd_profil_gov2;
										$clevel = $data->clevel;										


										
										if($cjns_info==1){
											
											
											if($nilai_pilihan==1){
												
												$check='checked';
												
											
											}else{
												
												$check='';
												
												
											}
												

											
											$cnmcheck=$ckd1.$ctahun;	
											
											//return($cnmcheck);
												
											$cpilih ="javascript:changepilihan(angka(this.value),$xxno+$xno-1,$cnmcheck)";
												
											$cinformasi='<div class="col-sm-8">											
																<label class="switch">
																  <input type="checkbox" onchange="'.$cpilih.'" '.$check.' id=cek4_'.$ckd1.$ctahun.' value="'.$nilai_pilihan.'">
																  <div class="slider"></div>
																</label>
															</div>';
											$cnilai =$nilai_pilihan;				
															
											
										}else if($cjns_info==2){
								
													$crp='...';
													$chitungp4 ="javascript:hitungP4(angka(this.value),$xxno+$xno-1)";
													$cnilai 	= number_format($nilai,2,',','.');
													
													$cinformasi 	= '<div class="flex"><span class="currency">'.$crp.'</span><input id="'.$cid.'" name="'.$cid.'" onkeyup="'.$chitungp4.'" onkeypress="'.$cf.'" value="'.$cnilai.'""type="text" style="text-align:right;" ><div/>';

												
											
											
											
										}else if($cjns_info==3){
											$cektext ="javascript:changetext4(this.value,$xxno+$xno-1)";
											$cinformasi='<textarea style="font-size:10pt;" class="form-control" onchange="'.$cektext.'" id="tkkel" name="tkkel" rows="3">'.$uraian.'</textarea>';
											
											$cnilai =$uraian;
										}else if($cjns_info==4){
											
											$cekpilih ="javascript:changelk(angka(this.value),$xxno+$xno-1)";
											$cnilai =$nilai_pilihan;
											
											$cinformasi ='<select name="jnsf4_'.$ctahun.'" id="jnsf4_'.$ctahun.'" onchange="'.$cekpilih.'" style="width:160px" class="form-control input-sm">
														<option></option>
														<option value="1">WTP</option>
														<option value="2">WTP-DPP</option>
														<option value="3">WDP</option>
														<option value="4">TMP</option>
														<option value="5">TW</option>
														<option value="6">N/A</option>
														
													  </select>';
													  
													  
												  
											
										}
										
										
										
									}else{  //cekdd
										
										
										$query="SELECT jns_info  jns FROM tprofil_gov1  WHERE kd_apip='".$ckode."' and kd_profil_gov1='".$ckd1."'";
										$csql = $this->db->query($query);
										
										$data = $csql->row();
										$cek2 = $data->jns;
										
										
										$chitungp4 ="javascript:hitungP4(angka(this.value),$xxno+$xno-1)";
										
										if($cek2==1){  

											$cnmcheck=$ckd1.$ctahun;	
											$cpilih ="javascript:changepilihan(angka(this.value),$xxno+$xno-1,$cnmcheck)";
												
											$cinformasi='<div class="col-sm-8">											
																<label class="switch">
																  <input type="checkbox" onchange="'.$cpilih.'" '.$check.' id=cek4_'.$ckd1.$ctahun.' value=0>
																  <div class="slider"></div>
																</label>
															</div>';
											$cnilai 	=0;				

										}else if($cek2==2){
													$crp='...';
													$cnilai 	= number_format(0,2,',','.');												
													$cinformasi 	= '<div class="flex"><span class="currency">'.$crp.'</span><input id="'.$cid.'" name="'.$cid.'" onkeyup="'.$chitungp4.'" onkeypress="'.$cf.'" value="'.$cnilai.'" type="text" style="text-align:right;" ><div/>';

										}else if ($cek2==3){
											
												$cektext ="javascript:changetext4(this.value,$xxno+$xno-1)";
												$cinformasi ='<textarea style="font-size:10pt;" class="form-control" onchange="'.$cektext.'" id="tkkel" name="tkkel" rows="3"></textarea>';
										}else if($cek2==4){
													$cekpilih ="javascript:changelk(angka(this.value),$xxno+$xno-1)";
													$cinformasi ='<select name="jnsf4_'.$ctahun.'" id="jnsf4_'.$ctahun.'" onchange="'.$cekpilih.'" class="form-control input-sm">
														<option></option>
														<option value="1">WTP</option>
														<option value="2">WTP-DPP</option>
														<option value="3">WDP</option>
														<option value="4">TMP</option>
														<option value="5">TW</option>
														<option value="6">N/A</option>
														
													  </select>';

											
											
										}
										
										
										
									
									
									}
										
							
							
					$button4 = '<a  class="list-group-item list-group-item-action edit-dprofil4" data-kd1="'.$ckd1.'" data-kd2="'.$ckd2.'" data-jenis="'.$cjns_info.'"  > <i class="fa fa-pencil-square-o" aria-hidden="true" style="color: #006E7F" ></i> Edit D</a>';
					$button5 = '<a  class="list-group-item list-group-item-action hapus-dprofil4" data-kd1="'.$ckd1.'" data-kd2="'.$ckd2.'" data-uraian="'.$curaian.'" ><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus</a>';
					$subbutton=$button4.
								$button5;


					$aksi='<center>
							<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
								
								</button><ul class="dropdown-menu" >
								<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
									  
									  '.$subbutton.'
									
								</div> 
							  </div>
							
						</center>';		
											// sub
							
							$ctahun_trx=$ctahun;
							
							$html.='<tr>
									<td style="width:5%;text-align:center;" hidden >'.$cjns_info.'</td>
									<td style="width:5%;text-align:center;" hidden >'.$cnilai.'</td>
									<td style="width:5%;text-align:center;" hidden >'.$ckd1.'</td>
									<td style="width:1%;text-align:left;" hidden >'.$ckd2.'</td>							
									<td style="width:1%;text-align:left;"  ></td>							
									<td style="width:1%;text-align:left;" hidden >'.$clevel.'</td>															
									<td style="width:1%;text-align:left;" hidden >'.$ctahun_trx.'</td>															
									<td style="width:45%;text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$ctahun.'</td>
									<td style="width:45%;text-align:left;">'.$cinformasi.'</td>';
							$html .='<td style="width:7%;text-align:center;" '.$chidden.'>'.$aksi.'</td>';
							
							
						
						}
				
				
					$html.=	'
							</tr>';
						

			}
			
			return $html;
		}



		public function listProfil7($cthn,$ckode,$ctriw,$ckd1,$ckd2,$cjns)
		{			
			$query="SELECT tahun,triw,kd_profil_it1,kd_profil_it2,kd_profil_it3,uraian,urut FROM tprofil_it3 
						WHERE tahun='".$cthn."' AND kd_apip='".$ckode."' AND triw='".$ctriw."' AND kd_profil_it1='".$ckd1."'
						AND kd_profil_it2='".$ckd2."'
						ORDER BY kd_profil_it1,kd_profil_it2,urut";	
							
								
			$data = $this->db->query($query)->result();
			$html = "";
			
			$no = 0;
			
			foreach ($data as $value) {
				$no++;
				
				
				$curaian=$value->uraian;
				$ckd1=$value->kd_profil_it1;
				$ckd2=$value->kd_profil_it2;
				$ckd3=$value->kd_profil_it3;
				
				$button4 = '<a  class="list-group-item list-group-item-action edit-rinci-profil7" data-kd1="'.$ckd1.'" data-kd2="'.$ckd2.'" data-kd3="'.$ckd3.'" data-uraian="'.$curaian.'" > <i class="fa fa-pencil-square-o" aria-hidden="true" style="color: #006E7F" ></i> Edit Rincian</a>';
				$button5 = '<a  class="list-group-item list-group-item-action hapus-rinci-p7" data-kd1="'.$ckd1.'" data-kd2="'.$ckd2.'" data-kd3="'.$ckd3.'" data-uraian="'.$curaian.'" ><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus Rincian</a>';

					if($clevel=='1'){
						$cpoin=$value->poin;
						
						if($ckd1!=='1'){
						
							$query2="SELECT uraian FROM tprofil_it3 
									WHERE tahun='".$cthn."' AND kd_apip=".$ckode." AND triw='".$ctriw."' and kd_profil_it1='".$ckd1."'
									group by uraian
									ORDER BY uraian ";	
									
							
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
								$curaian2=$curaian2.$space1.$xno.' . '.$value2->uraian.'<br>&nbsp;&nbsp;';
								
							}
							$button3 ='';
							$subbutton='';					
						}else{
							
							$curaian2=$pilihan1;
							$button3 = '<button data-toggle="dropdown"  id="btnGroupDrop1P6" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
							$subbutton=$button4.
									   $button5;
							
						}
						
							$uraian 	= '<a  class="" data-tahun="'.$cthn.'" data-kdapip="'.$ckode.'"  data-triw="'.$ctriw.'" data-uraian="'.$value->uraian.'">'.'&nbsp;&nbsp;<b>'.$abold.''.$curaian.'</b></a>';
							$uraian2 	= '<b>'.$curaian2.'</b>';
						
					}else{
						
							$cpoin=$ckd2;
							$button3 = '<button data-toggle="dropdown"  id="btnGroupDrop1P6" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
							$subbutton=$button4.
									   $button5;
										  
							$query3="SELECT uraian FROM tprofil_it3 
									 WHERE tahun='".$cthn."' AND kd_apip=".$ckode." AND triw='".$ctriw."' and kd_profil_it1='".$ckd1."' and kd_profil_it2='".$ckd2."'
									 ORDER BY uraian ";	
						
						//print_r($query3);
							$data3 = $this->db->query($query3)->result();
						
							$cno = 0;
							$curaian3='';
							foreach ($data3 as $value3) {
								$cno++;
								
								if($cno==1){
									$space1='&nbsp;&nbsp;';
								}else{
									$space1='';
								}
								$curaian3=$curaian3.$space1.$cno.' . '.$value3->uraian.'<br>&nbsp;&nbsp;';
								
							}   
						
						
								$uraian 	= '<a  class="" data-tahun="'.$cthn.'" data-kdapip="'.$ckode.'"  data-triw="'.$ctriw.'" data-uraian="'.$value->uraian.'">'.'&nbsp;&nbsp;'.$abold.''.$curaian.''.$nbold.'</a>';;
								$uraian2 	= $curaian3;
								
					}	
					
				$aksi='<center>
							<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
								'.$button3.'
								</button><ul class="dropdown-menu" >
								<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
									  
									  '.$subbutton.'
									
								</div> 
							  </div>
							
						</center>';
						
				
				$html.='<tr>
							<td style="width:5%;text-align:center;" hidden >'.$ckd1.'</td>
							<td style="width:5%;text-align:center;"  hidden>'.$ckd2.'</td>
							<td style="width:5%;text-align:center;"  >'.$ckd3.'</td>
							<td style="width:45%;text-align:left;">'.$uraian.'</td>';
				$html .='<td style="width:7%;text-align:center;">'.$aksi.'</td>';
				$html.=	'
						</tr>';

			}
			
			return $html;
		}





		public function viewMap1($cthn,$ckode,$ctriw)
		{
			$ta = '';//$this->session->userdata('thn_ang');
			$skpd='';
			$prog='';
			$keg='';

			$query="SELECT*FROM tmap_angreal   ORDER BY kd_angreal1,kd_angreal2";		
								
			$data = $this->db->query($query)->result();
			$html = "";
			
					
			$no = 0;
			foreach ($data as $value) {
				$no++;
				
				$clevel=$value->clevel;
				$chd=$value->hd;
				$ctipe=$value->tipe;
				$ctampil=$value->tampil;
				
				
				if($ctampil=='1'){
					$icon="fa fa-plus-square-o fa-2x";
					$color="color: #006E7F";
				}else{
					$icon="fa fa-minus-square-o fa-2x";
					$color="color: #F15412";
				}
				
				$cf ="return(currencyFormat(this,',','.',event))";


				$button4 = '<a  class="list-group-item list-group-item-action showAdd" data-skpd="'.$skpd.'" data-tahun="'.$ta.'"><i class="fa fa-floppy-o" aria-hidden="true" style="color: #006E7F" ></i> Simpan</a>';
				$button5 = '<a  class="list-group-item list-group-item-action showKeluaran" data-skpd="'.$skpd.'" data-subkegiatan="'.$value->kd_subkegiatan.'" data-nmsubkeg="'.$value->nm_subkegiatan.'" data-tahun="'.$ta.'"><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus</a>';
				$button6 = '<a  class="list-group-item list-group-item-action showKeluaran" data-skpd="'.$skpd.'" data-subkegiatan="'.$value->kd_subkegiatan.'" data-nmsubkeg="'.$value->nm_subkegiatan.'" data-tahun="'.$ta.'"><i class="fa fa-map-o" aria-hidden="true" style="color: #F3950D"></i> Formula</a>';

				

				
				if($clevel=='1'){
					$abold="<b>";
					$nbold="<b>";					
					$space="";
					
						if($chd=='H'){
							$disable="disabled";
						//	$button3 = '';
							$tback="text-align:right;background-color: #DFDFDE;";

					
							if($ctipe!=='Persentase'){
							
								$button1 = '<a  class="btn  btn-sm dropdown-toggle" aria-expanded="false" data-skpd="'.$skpd.'"  style="padding: 2px 2px;" data-tahun="'.$ta.'"><i class="'.$icon.'" aria-hidden="true" style="'.$color.'"></i> </a>';  		
								$button3 = '';
								$subbutton=$button4.
										   $button5;
						
							}else{
								
								$button3 = '<button data-toggle="dropdown"  id="btnGroupDrop1" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
								$subbutton=$button6;
					
							}
						}else{
							$button1 = '';
							$disable="";
							$tback="text-align:right;";
							$button3 = '<button data-toggle="dropdown"  id="btnGroupDrop1" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';

							$subbutton=$button4.
									   $button5;

						}
					
				}else{	
					
					$abold="";
					$nbold="";
					$space="&nbsp;&nbsp;";
					$button1 = '';
					$disable="";
					$tback="text-align:right;";
					$button3 = '<button data-toggle="dropdown"  id="btnGroupDrop1" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
					$subbutton=$button4.
							   $button5;
				}				
				
		
				$uraian 	= $value->uraian;
				/* $cnilai 	= number_format($value->nilai,2,',','.');
				$informasi 	= '<div class="flex"><span class="currency">Rp</span><input value="'.$cnilai.'""type="text" '.$disable.' onkeypress="'.$cf.'" style="'.$tback.'"><div/>';
				 */



			$aksi2x='<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" > 
						
					</div>';	
					
					
			$aksi2xx='<center>
						<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
							<input type="checkbox" checked data-toggle="toggle" data-on="Ready" data-off="Not Ready" data-onstyle="success" data-offstyle="danger">
						
						
						</button><ul class="dropdown-menu" >
							
							
							
						  </div>
						
					</center>';					
					
	
			

			$aksi='<center>
						<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
							'.$button3.'
							</button><ul class="dropdown-menu" >
							
							
							<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
								  
								  
								  
								  '.$subbutton.'
								
							</div> 
						  </div>
						
					</center>';


				
				$aksi2='
							<div>					  
							<input type="checkbox" checked data-toggle="toggle" data-on="Ready" data-off="Not Ready" data-onstyle="success" data-offstyle="danger">
					
					</div>';
	
				
				
				
			$html.='
			
			<tr>
							
							<td style="width:45%;text-align:left;">'.$space.''.$abold.' '.$uraian.''.$nbold.'</td>
							<td style="width:10%;text-align:right;">'.$aksi2.'</td>';
														
				$html.=	'
						</tr>';	
				
				
				
				
							
			}
				
			
			return $html;
		}



	    private function _get_all_apip_query($daerah)
	    {
				$akses = $this->session->userdata('is_admin');
				$tahun = $this->session->userdata('year_selected');
				$instansi = $this->session->userdata('id_instansi');
				
				
	    	
	    	if($akses == 3){
				
				$this->db->where('tapip.kd_apip',$instansi);
			}

				$this->db->select('tapip.kd_apip, tapip.tahun, ms_apip.nm_apip');    
				$this->db->from('tapip');
				$this->db->join('ms_apip', 'tapip.kd_apip = ms_apip.kd_apip');
				$this->db->where('tapip.tahun',$tahun);
				
				
			
	        $i = 0;
	     
	        foreach ($this->column_search as $item) // looping awal
	        {
	            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
	            {
	                 
	                if($i===0) // looping awal
	                {
	                    $this->db->group_start(); 
	                    $this->db->like($item, $_POST['search']['value']);
	                }
	                else
	                {
	                    $this->db->or_like($item, $_POST['search']['value']);
	                }
	 
	                if(count($this->column_search) - 1 == $i) 
	                    $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])) 
	        {
	            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	            if ($this->column_order[$_POST['order']['0']['column']] == 'nm_apip') {
	            	$order2 = $this->order2;
	            	$this->db->order_by(key($order2), $order2[key($order2)]);
	        	}
	        } 
	        else if(isset($this->order))
	        {
	            $order = $this->order;
	            $order2 = $this->order2;
	         
	            $this->db->order_by(key($order), $order[key($order)]);
	            $this->db->order_by(key($order2), $order2[key($order2)]);

	        }
	    }
	 
	    function get_all_apip($daerah)
	    {
	        $this->_get_all_apip_query($daerah);
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function get_all_apip_sql($daerah)
	    {
	    	$query = "SELECT a.kd_apip,b.nm_apip,a.tahun from tapip a inner join ms_apip b on a.kd_apip=b.kd_apip where a.akrif='1'";
	        $result = $this->db->query($query)->result();
	      //  print_r($result);die();

	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_apip($daerah)
	    {
	        $this->_get_all_apip_query($daerah);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
		
	 
	    public function count_all_apip($daerah)
	    {

	    	$akses = $this->session->userdata('is_admin');
	    	
	    	if($akses == 2){
				$apip = $this->session->userdata('id_prov');
				$sql = "SELECT a.kd_apip,b.nm_apip,a.tahun FROM tapip a inner join ms_apip b on a.kd_apip=b.kd_apip where a.kd_apip = ".$apip;	
				$daerah = $this->db->query($sql)->row()->kd_apip;
				$arrayDaerah = explode(',',$daerah); 
			}
			
			
	    	$tahun = $this->session->userdata('year_selected');
	    	if ($akses == 1) {
				
	    	}else if($akses == 2){
	    		$this->db->where_in('kd_apip',$arrayDaerah);
	    	}else if($akses == 3){
	    		$this->db->where_in('kd_apip',$daerah);
	    	}else{
	    		
	    	}

	    	$this->db->where('tahun',$tahun);
	        $this->db->from($this->table);
	        return $this->db->count_all_results();
	    }


		public function insertApip($data){

			$this->db->insert('tapip', $data);
			
			return true;
		}
		
		
		
		public function viewProfil4_cek($ctahun,$ckode)
		{
			$tahun_awal=$ctahun-4;
			$tahun_akhir=$tahun_awal+2;
			
			$query="SELECT a.kd_apip,b.tahun,a.kd_profil_gov1,b.kd_profil_gov2,a.uraian,a.jns_info,a.poin,a.urut,a.visible,
					b.nilai,b.nilai_pilihan FROM tprofil_gov1 a INNER JOIN tprofil_gov2 b ON a.kd_apip=b.kd_apip AND a.kd_profil_gov1=b.kd_profil_gov1
					WHERE a.kd_apip='".$ckode."' AND a.visible='1' and b.tahun between '".$tahun_awal."' and '".$tahun_akhir."'";

					
				$query1 = $this->db->query($query);
				$ii = 0;
				foreach($query1->result_array() as $resulte)
				{ 					
					$data = array(      
								'ctahun' => $resulte['tahun'],
								'ckd1' => $resulte['kd_profil_gov1'],
								'ckd2' => $resulte['kd_profil_gov2'],
								'curaian' => $resulte['uraian'],
								'cjns_info' => $resulte['jns_info'],
								'cpoin' => $resulte['poin'],
								'curut' => $resulte['urut'],
								'cnilai' => $resulte['nilai'],
								'cnilai_pilihan' => $resulte['nilai_pilihan']
								);
				}
					
			return $data;
			
			
		}		
	
		

	}

?>