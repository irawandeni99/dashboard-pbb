<?php
	class ProfilApipModel extends CI_Model{

		var $table = 'tapip a'; //nama tabel dari database
	    var $column_order = array(null,'tapip.kd_apip','tapip.tahun'); //field yang ada di table 
	    var $column_search = array('tapip.tahun','tapip.kd_apip','ms_apip.nm_apip'); //field yang diizin untuk pencarian 
	    var $order = array('tapip.tahun' => 'asc'); // default order 
	    var $order2 = array('tapip.kd_apip' => 'asc'); // default order 

	    public function getApip()
	    {
	    	$akses = $this->session->userdata('is_admin');
	    	/* if($akses == 1){
	    		$query = 'SELECT id_inspektorat,uraian FROM ms_inspektorat';
	    		$sql = $this->db->query($query)->result();
	    	}
	    	else if($akses == 2){
				$apip = $this->session->userdata('id_prov');
				$query = "SELECT id_inspektorat,uraian FROM ms_inspektorat where id_inspektorat = ".$apip;	
				$sql = $this->db->query($query)->result();
				
			}else{ */
				$query = 'SELECT a.kd_apip,b.nm_apip,a.tahun fROM tapip a inner join ms_apip b on a.kd_apip=b.kd_apip';
	    		$sql = $this->db->query($query)->result();
		//	}

	    	return $sql;
	    }


	    public function getInstansi()
	    {
	 
			$query = 'SELECT * FROM ms_apip';
	    	$sql = $this->db->query($query)->result();
	    	return $sql;
	    }



		public function viewProfil1($cthn,$ckode,$ctriw)
		{
					
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
			


				$button4 = '<a href="#" class="list-group-item list-group-item-action simpan-profil1"  data-tahun="'.$cthn.'"><i class="fa fa-floppy-o" aria-hidden="true" style="color: #006E7F" ></i> Simpan</a>';
				$button5 = '<a href="#" class="list-group-item list-group-item-action showKeluaran"  ><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus</a>';
				$button6 = '<a href="#" class="list-group-item list-group-item-action showKeluaran" ><i class="fa fa-map-o" aria-hidden="true" style="color: #F3950D"></i> Formula</a>';

				

				
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
								$button1 = '<a href="#" class="btn btn-sm dropdown-toggle" id="btn'.$cid.'" aria-expanded="false" data-skpd="'.$ckode.'"  style="padding: 2px 2px;" ><i class="'.$icon.'" aria-hidden="true" style="'.$color.'"></i> </a>';  		
								$button3 = '';
								$subbutton=$button4.
										   $button5;
						
							}else{
								$crp='.%.';
								
								$button3 = '<button data-toggle="dropdown"  id="btnGroupDrop1" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
								$subbutton=$button6;
					
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
				
				$uraian 	= '<a href="#" class="showEditRincian" data-tahun="'.$cthn.'" data-kdapip="'.$ckode.'" data-cid="'.$cid.'" data-triw="'.$ctriw.'" data-uraian="'.$value->uraian.'">'.'&nbsp;&nbsp;'.$abold.''.$value->uraian.''.$nbold.'</a>';
		
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
				
			
				
				$uraian 	= '<a href="#" class="showEditRincian" disabled data-tahun="'.$cthn.'" data-kdapip="'.$ckode.'" data-cid="'.$cid.'" data-triw="'.$ctriw.'" data-uraian="'.$value->uraian.'">'.'&nbsp;&nbsp;'.$abold.' '.$value->uraian.''.$nbold.' </a>';
		

				
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
			


				$button4 = '<a href="#" class="list-group-item list-group-item-action simpan-profil2 data-skpd="'.$ckode.'" data-tahun="'.$cthn.'"><i class="fa fa-floppy-o" aria-hidden="true" style="color: #006E7F" ></i> Simpan</a>';
				$button5 = '<a href="#" class="list-group-item list-group-item-action showKeluaran" data-skpd="'.$ckode.'" ><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus</a>';
				$button6 = '<a href="#" class="list-group-item list-group-item-action showKeluaran" data-skpd="'.$ckode.'" ><i class="fa fa-map-o" aria-hidden="true" style="color: #F3950D"></i> Formula</a>';

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
						 
						 $button1 = '<a href="#" class="btn btn-sm dropdown-toggle" id="btnp2'.$cid.'" aria-expanded="false"   style="padding: 2px 2px;" ><i class="'.$icon.'" aria-hidden="true" style="'.$color.'"></i> </a>';  		
				
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
								
				$uraian 	= '<a href="#" class="showEditRincianP2" data-tahun="'.$cthn.'" data-kdapip="'.$ckode.'" data-cid="'.$cid.'" data-triw="'.$ctriw.'" data-uraian="'.$value->uraian.'">'.'&nbsp;&nbsp;'.$value->uraian.'</a>';
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
			


				$button4 = '<a href="#" class="list-group-item list-group-item-action simpan-profil5 data-skpd="'.$ckode.'" data-tahun="'.$cthn.'"><i class="fa fa-floppy-o" aria-hidden="true" style="color: #006E7F" ></i> Simpan</a>';
				$button5 = '<a href="#" class="list-group-item list-group-item-action showKeluaran" data-skpd="'.$ckode.'" ><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus</a>';
				$button6 = '<a href="#" class="list-group-item list-group-item-action showKeluaran" data-skpd="'.$ckode.'" ><i class="fa fa-map-o" aria-hidden="true" style="color: #F3950D"></i> Formula</a>';

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
						 
						 $button1 = '<a href="#" class="btn btn-sm dropdown-toggle" id="btnp2'.$cid.'" aria-expanded="false"   style="padding: 2px 2px;" ><i class="'.$icon.'" aria-hidden="true" style="'.$color.'"></i> </a>';  		
				
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
				
				
				$uraian 	= '<a href="#" class="showEditRincianP5" data-tahun="'.$cthn.'" data-kdapip="'.$ckode.'" data-cid="'.$cid.'" data-triw="'.$ctriw.'" data-uraian="'.$value->uraian.'">'.'&nbsp;&nbsp;'.$value->uraian.'</a>';

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
			


				$button4 = '<a href="#" class="list-group-item list-group-item-action simpan-profil5 data-skpd="'.$ckode.'" data-tahun="'.$cthn.'"><i class="fa fa-floppy-o" aria-hidden="true" style="color: #006E7F" ></i> Simpan</a>';
				$button5 = '<a href="#" class="list-group-item list-group-item-action showKeluaran" data-skpd="'.$ckode.'" ><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus</a>';
				$button6 = '<a href="#" class="list-group-item list-group-item-action showKeluaran" data-skpd="'.$ckode.'" ><i class="fa fa-map-o" aria-hidden="true" style="color: #F3950D"></i> Formula</a>';

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
						 
						 $button1 = '<a href="#" class="btn btn-sm dropdown-toggle" id="btnp2'.$cid.'" aria-expanded="false"   style="padding: 2px 2px;" ><i class="'.$icon.'" aria-hidden="true" style="'.$color.'"></i> </a>';  		
				
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
				
				
				$uraian 	= '<a href="#" class="showEditRincianP6" data-tahun="'.$cthn.'" data-kdapip="'.$ckode.'" data-cid="'.$cid.'" data-triw="'.$ctriw.'" data-uraian="'.$value->uraian.'">'.'&nbsp;&nbsp;'.$value->uraian.'</a>';

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
			
			if($cjns==1){
					
					$query="SELECT*FROM tprofil_it1 WHERE tahun='".$cthn."' AND kd_apip='".$ckode."' AND triw='".$ctriw."' AND kd_profil_it1='".$ckd1."'";
				
						$data = $this->db->query($query)->result();
						$html = "";
						
						foreach ($data as $value) {
							
							$cnilai=$value->nilai;
							$cpoin=$value->poin;
							$curaian=$value->uraian;
							
						}	
	

				$html.=' ';

			}else{
				


				$query="SELECT a.*,b.uraian uraian1,b.poin FROM tprofil_it2 a inner join tprofil_it1 b on a.kd_profil_it1=b.kd_profil_it1 WHERE a.tahun='".$cthn."' 
						AND a.kd_apip='".$ckode."' AND a.triw='".$ctriw."' AND a.kd_profil_it1='".$ckd1."' AND a.kd_profil_it2='".$ckd2."'";
						$csql = $this->db->query($query);
						
						$data2 = $csql->row();
						$curaian1 = $data2->uraian1;
						$cpoin = $data2->poin;
						$curaian = $data2->uraian;
				

				$html.='';
				
			}
			
			
			return $html;
		}





		public function viewProfil2($cthn,$ckode,$ctriw)
		{
					
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
				$button4 = '<a href="#" class="list-group-item list-group-item-action simpan-profil2 data-skpd="'.$ckode.'" data-tahun="'.$cthn.'"><i class="fa fa-floppy-o" aria-hidden="true" style="color: #006E7F" ></i> Simpan</a>';
				$button5 = '<a href="#" class="list-group-item list-group-item-action showKeluaran" data-skpd="'.$ckode.'" ><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus</a>';
				$button6 = '<a href="#" class="list-group-item list-group-item-action showKeluaran" data-skpd="'.$ckode.'" ><i class="fa fa-map-o" aria-hidden="true" style="color: #F3950D"></i> Formula</a>';

				
				
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
						 
						 $button1 = '<a href="#" class="btn btn-sm dropdown-toggle" id="btnp2'.$cid.'" aria-expanded="false"   style="padding: 2px 2px;" ><i class="'.$icon.'" aria-hidden="true" style="'.$color.'"></i> </a>';  		
				
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
				
				
				 			
				
				$uraian 	= '<a href="#" class="showEditRincianP2" data-tahun="'.$cthn.'" data-kdapip="'.$ckode.'" data-cid="'.$cid.'" data-triw="'.$ctriw.'" data-uraian="'.$value->uraian.'">'.'&nbsp;&nbsp;'.$abold.''.$value->uraian.''.$nbold.'</a>';


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
				$button4 = '<a href="#" class="list-group-item list-group-item-action simpan-profil5 data-skpd="'.$ckode.'" data-tahun="'.$cthn.'"><i class="fa fa-floppy-o" aria-hidden="true" style="color: #006E7F" ></i> Simpan</a>';
				$button5 = '<a href="#" class="list-group-item list-group-item-action showKeluaran" data-skpd="'.$ckode.'" ><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus</a>';
				$button6 = '<a href="#" class="list-group-item list-group-item-action showKeluaran" data-skpd="'.$ckode.'" ><i class="fa fa-map-o" aria-hidden="true" style="color: #F3950D"></i> Formula</a>';

				
				
				if($clevel=='1'){
					 $abold="<b>";
					 $nbold="</b>";					
					 $space="";
					$button1 ='';
					
				 }else if($clevel=='2'){
					
					$abold="<b>";
					 $nbold="</b>";					
					 $space="&nbsp;&nbsp;&nbsp;";
					 $button1 = '<a href="#" class="btn btn-sm dropdown-toggle" id="btnp5'.$cid.'" aria-expanded="false"   style="padding: 2px 2px;" ><i class="'.$icon.'" aria-hidden="true" style="'.$color.'"></i> </a>';  		

					 
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
					$crp='....';
					//$cnilai  	= $value->nilai;
					$cnilai 	= number_format($value->nilai,0,',','.');
					$informasi 	= '<div class="flex"><span class="currency">'.$crp.'</span>'.$abold.'<input id="'.$cid.'" name="'.$cid.'" value="'.$cnilai.'""type="text" '.$disable.' onkeyup="'.$chitungp5.'"   style="'.$tback.'">'.$nbold.'<div/>';

					
				}else{
					$crp='....';
					$cnilai 	= number_format($value->nilai,0,',','.');
					
					$informasi 	= '<div class="flex"><span class="currency">'.$crp.'</span>'.$abold.'<input id="'.$cid.'" name="'.$cid.'" value="'.$cnilai.'""type="text" '.$disable.' onkeyup="'.$chitungp5.'"  onkeypress="'.$cf.'" style="'.$tback.'">'.$nbold.'<div/>';

				}
				
				
				 			
				
				$uraian 	= '<a href="#" class="showEditRincianP5" data-tahun="'.$cthn.'" data-kdapip="'.$ckode.'" data-cid="'.$cid.'" data-triw="'.$ctriw.'" data-uraian="'.$value->uraian.'">'.'&nbsp;&nbsp;'.$abold.''.$value->uraian.''.$nbold.'</a>';

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
				$button4 = '<a href="#" class="list-group-item list-group-item-action simpan-profil6 data-skpd="'.$ckode.'" data-tahun="'.$cthn.'"><i class="fa fa-floppy-o" aria-hidden="true" style="color: #006E7F" ></i> Simpan</a>';
				$button5 = '<a href="#" class="list-group-item list-group-item-action showKeluaran" data-skpd="'.$ckode.'" ><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus</a>';
				$button6 = '<a href="#" class="list-group-item list-group-item-action showKeluaran" data-skpd="'.$ckode.'" ><i class="fa fa-map-o" aria-hidden="true" style="color: #F3950D"></i> Formula</a>';

				
				
				if($clevel=='1'){
					 $abold="<b>";
					 $nbold="</b>";					
					 $space="";
					$button1 ='';
					
				 }else if($clevel=='2'){
					
					$abold="<b>";
					 $nbold="</b>";					
					 $space="&nbsp;&nbsp;&nbsp;";
					 $button1 = '<a href="#" class="btn btn-sm dropdown-toggle" id="btnp6'.$cid.'" aria-expanded="false"   style="padding: 2px 2px;" ><i class="'.$icon.'" aria-hidden="true" style="'.$color.'"></i> </a>';  		

					 
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
					$crp='....';
					//$cnilai  	= $value->nilai;
					$cnilai 	= number_format($value->nilai,0,',','.');
					$informasi 	= '<div class="flex"><span class="currency">'.$crp.'</span>'.$abold.'<input id="'.$cid.'" name="'.$cid.'" value="'.$cnilai.'""type="text" '.$disable.' onkeyup="'.$chitungp6.'"   style="'.$tback.'">'.$nbold.'<div/>';

					
				}else{
					$crp='....';
					$cnilai 	= number_format($value->nilai,0,',','.');
					
					$informasi 	= '<div class="flex"><span class="currency">'.$crp.'</span>'.$abold.'<input id="'.$cid.'" name="'.$cid.'" value="'.$cnilai.'""type="text" '.$disable.' onkeyup="'.$chitungp6.'"  onkeypress="'.$cf.'" style="'.$tback.'">'.$nbold.'<div/>';

				}
				
				
				 			
				
				$uraian 	= '<a href="#" class="showEditRincianP6" data-tahun="'.$cthn.'" data-kdapip="'.$ckode.'" data-cid="'.$cid.'" data-triw="'.$ctriw.'" data-uraian="'.$value->uraian.'">'.'&nbsp;&nbsp;'.$abold.''.$value->uraian.''.$nbold.'</a>';

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
			$query="SELECT*FROM(
						SELECT a.tahun,a.triw,a.kd_profil_it1,'0' kd_profil_it2,a.nilai,a.poin,a.uraian,a.jns_info,a.urut,'1'clevel FROM tprofil_it1 a
						WHERE a.tahun='".$cthn."' AND a.kd_apip=".$ckode." AND a.triw='".$ctriw."' 
						UNION
						SELECT tahun,triw,kd_profil_it1,kd_profil_it2,''nilai,'' poin,uraian,'0'jns_info,urut,'2'clevel FROM tprofil_it2 
						WHERE tahun='".$cthn."' AND kd_apip=".$ckode." AND triw='".$ctriw."'
						)z 
						ORDER BY kd_profil_it1,kd_profil_it2,urut";	
							
								
			$data = $this->db->query($query)->result();
			$html = "";
			
			$no = 0;
			
			foreach ($data as $value) {
				$no++;
				
				
				$curaian=$value->uraian;
				$cjns_info=$value->jns_info;
				$cnilai=$value->nilai;
				$ckd1=$value->kd_profil_it1;
				$ckd2=$value->kd_profil_it2;
				$clevel=$value->clevel;
				
				if($cnilai==1){
					$pilihan1='Ya';
				}else{
					$pilihan1='Tidak';
				}
				
				
				$button4 = '<a href="#" class="list-group-item list-group-item-action edit-profil7" data-kd1="'.$ckd1.'" data-kd2="'.$ckd2.'" data-jenis="'.$cjns_info.'" data-nilai="'.$cnilai.'"> <i class="fa fa-pencil-square-o" aria-hidden="true" style="color: #006E7F" ></i> Edit</a>';
				$button5 = '<a href="#" class="list-group-item list-group-item-action showKeluaran" data-skpd="'.$ckode.'" ><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus</a>';



			
				
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
						
							$uraian 	= '<a href="#" class="showEditRincianP7" data-tahun="'.$cthn.'" data-kdapip="'.$ckode.'"  data-triw="'.$ctriw.'" data-uraian="'.$value->uraian.'">'.'&nbsp;&nbsp;<b>'.$abold.''.$curaian.'</b></a>';
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
						
						
								$uraian 	= '<a href="#" class="showEditRincianP7" data-tahun="'.$cthn.'" data-kdapip="'.$ckode.'"  data-triw="'.$ctriw.'" data-uraian="'.$value->uraian.'">'.'&nbsp;&nbsp;'.$abold.''.$curaian.''.$nbold.'</a>';;
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
				
				$button4 = '<a href="#" class="list-group-item list-group-item-action edit-rinci-profil7" data-kd1="'.$ckd1.'" data-kd2="'.$ckd2.'" data-kd3="'.$ckd3.'" data-uraian="'.$curaian.'" > <i class="fa fa-pencil-square-o" aria-hidden="true" style="color: #006E7F" ></i> Edit</a>';
				$button5 = '<a href="#" class="list-group-item list-group-item-action showKeluaran" data-skpd="'.$ckode.'" ><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus</a>';

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
						
							$uraian 	= '<a href="#" class="" data-tahun="'.$cthn.'" data-kdapip="'.$ckode.'"  data-triw="'.$ctriw.'" data-uraian="'.$value->uraian.'">'.'&nbsp;&nbsp;<b>'.$abold.''.$curaian.'</b></a>';
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
						
						
								$uraian 	= '<a href="#" class="" data-tahun="'.$cthn.'" data-kdapip="'.$ckode.'"  data-triw="'.$ctriw.'" data-uraian="'.$value->uraian.'">'.'&nbsp;&nbsp;'.$abold.''.$curaian.''.$nbold.'</a>';;
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


				$button4 = '<a href="#" class="list-group-item list-group-item-action showAdd" data-skpd="'.$skpd.'" data-tahun="'.$ta.'"><i class="fa fa-floppy-o" aria-hidden="true" style="color: #006E7F" ></i> Simpan</a>';
				$button5 = '<a href="#" class="list-group-item list-group-item-action showKeluaran" data-skpd="'.$skpd.'" data-subkegiatan="'.$value->kd_subkegiatan.'" data-nmsubkeg="'.$value->nm_subkegiatan.'" data-tahun="'.$ta.'"><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus</a>';
				$button6 = '<a href="#" class="list-group-item list-group-item-action showKeluaran" data-skpd="'.$skpd.'" data-subkegiatan="'.$value->kd_subkegiatan.'" data-nmsubkeg="'.$value->nm_subkegiatan.'" data-tahun="'.$ta.'"><i class="fa fa-map-o" aria-hidden="true" style="color: #F3950D"></i> Formula</a>';

				

				
				if($clevel=='1'){
					$abold="<b>";
					$nbold="<b>";					
					$space="";
					
						if($chd=='H'){
							$disable="disabled";
						//	$button3 = '';
							$tback="text-align:right;background-color: #DFDFDE;";

					
							if($ctipe!=='Persentase'){
							
								$button1 = '<a href="#" class="btn  btn-sm dropdown-toggle" aria-expanded="false" data-skpd="'.$skpd.'"  style="padding: 2px 2px;" data-tahun="'.$ta.'"><i class="'.$icon.'" aria-hidden="true" style="'.$color.'"></i> </a>';  		
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
	    	
	    	/* if($akses == 2){
				$apip = $this->session->userdata('id_prov');
				$sql = "SELECT * FROM ms_inspektorat where id_inspektorat = ".$apip;	
				$daerah = $this->db->query($sql)->row()->kemendagri;
				$arrayDaerah = explode(',',$daerah); 
			}
			
			
	    	$tahun = $this->session->userdata('year_selected');
	    	if ($akses == 1) {
				
	    	}else if($akses == 2){
	    		$this->db->where_in('id_instansi',$arrayDaerah);
	    	}else if($akses == 3){
	    		$this->db->where_in('id_instansi',$daerah);
	    	}else{

	    	} */
			
			
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
				$daerah = $this->db->query($sql)->row()->kemendagri;
				$arrayDaerah = explode(',',$daerah); 
			}
			
			
	    	$tahun = $this->session->userdata('year_selected');
	    	if ($akses == 1) {
				
	    	}else if($akses == 2){
	    		$this->db->where_in('id_instansi',$arrayDaerah);
	    	}else if($akses == 3){
	    		$this->db->where_in('id_instansi',$daerah);
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

	}

?>