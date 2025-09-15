<?php
	class MasterPenilaianModel extends CI_Model{

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



		public function viewElemen($cthn,$ckode)
		{
					
		$query="SELECT a.*,(select count(*)jml from ttopik where kd_elemen=a.kd_elemen) jml FROM ms_elemen a order by a.kd_elemen";	
				
			$data = $this->db->query($query)->result();
			$html = "";
			$html .='<input type="hidden" name="ptahun"  value='.$cthn.' class="form-control input-sm" id="ptahun" placeholder="">
					 <input type="hidden" name="pkdinstansi"  value='.$ckode.' class="form-control input-sm" id="pkdinstansi" placeholder="">';
			$cno = 0;
			foreach ($data as $value) {
				$cno++;
				
				$ckdelemen=$value->kd_elemen;
				$cnmelemen=$value->nm_elemen;
				$cjml_topik=$value->jml;
				
				$abold="<b>";
				$nbold="<b>";

				$button3 = '<button style=" background-color: #ECB365; color: #F6F6F6; height:25px; width:5px;" data-toggle="dropdown"  id="btnGroupDrop1" class="btn btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
				$button_topik = '<button style=" background-color: #ECB365; color: #F6F6F6; border-radius: 45%; height:20px; width:5px; margin-left: -45px;" data-toggle="dropdown"  id="btnGroupDrop1" class="btn btn btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
				$button_level = '<button style=" background-color: #ECB365; color: #F6F6F6; border-radius: 45%; height:20px; width:5px; margin-left: -10px;" data-toggle="dropdown" id="btnGroupDrop1" class="btn btn btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
				$button_penilaian = '<button style="background-color: #ECB365;color: #F6F6F6;  border-radius: 45%; height:20px; width:5px; margin-left: -10px;" data-toggle="dropdown" id="btnGroupDrop1" class="btn btn btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';


				$btnadd = '<a class="list-group-item list-group-item-action showTambah-topik"  data-tahun="'.$cthn.'" data-inst="'.$ckode.'" data-kdelemen="'.$ckdelemen.'" data-nmelemen="'.$cnmelemen.'"><i class="fa fa-plus" aria-hidden="true" style="color: #18978F"></i> Tambah Topik</a>';
				$btnedit = '<a class="list-group-item list-group-item-action showEdit-elemen"  data-tahun="'.$cthn.'" data-inst="'.$ckode.'" data-kdelemen="'.$ckdelemen.'"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color: #F15412"></i> Edit Elemen</a>';
				$btndel = '<a class="list-group-item list-group-item-action hapus-elemen"  data-tahun="'.$cthn.'" data-inst="'.$ckode.'" data-kdelemen="'.$ckdelemen.'"><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus Elemen</a>';
				
				$subbutton=$btnadd;
 
				$aksi_elemen='<center>
						<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
							'.$button3.'
							</button><ul class="dropdown-menu" >
							<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
								  
								  '.$subbutton.'
								
							</div> 
						  </div>
						
					</center>';
 
 

			$html.='<div id='.$cno.' style="margin-left: -20px;" >
								
							
						<div class="form-group">
							<div class="col-md-12">
								<div class="col-md-1">
									 '.$aksi_elemen.'</button> 
								</div>
							
								<div class="col-md-10" style="cursor: pointer; padding: 3px 0; color: #fff; text-align: center;">
								
								<fieldset>
									<legend>
								
									<details>
										<summary  style="font-size: 16px;color: #377D71; text-align: left;" data-toggle="tooltip" data-placement="top" title="Klik Detail Elemen"><b>ELEMEN '.$ckdelemen.'  :  '.$cnmelemen.' </b></summary></legend><br>
										';
				
													$lc = "SELECT * FROM ttopik  WHERE tahun='".$cthn."' and kd_apip='".$ckode."' and kd_elemen='".$ckdelemen."'";
													$query = $this->db->query($lc);
													$data=$query->result();
													$tjml_topik=0;
													foreach($data as $topik){
													
													
													$btnadd = '<a  class="list-group-item list-group-item-action showTambah-level"  data-tahun="'.$cthn.'" data-inst="'.$ckode.'" data-kdelemen="'.$ckdelemen.'" data-kdtopik="'.$topik->kd_topik.'" ><i class="fa fa-plus" aria-hidden="true" style="color: #18978F"></i> Tambah Level</a>';
													$btnedit = '<a  class="list-group-item list-group-item-action showEdit-topik"  data-tahun="'.$cthn.'" data-inst="'.$ckode.'" data-kdelemen="'.$ckdelemen.'" data-kdtopik="'.$topik->kd_topik.'" ><i class="fa fa-pencil-square-o" aria-hidden="true" style="color: #F15412"></i> Edit Topik</a>';
													$btndel = '<a  class="list-group-item list-group-item-action hapus-topik"  data-tahun="'.$cthn.'" data-inst="'.$ckode.'" data-kdelemen="'.$ckdelemen.'" data-kdtopik="'.$topik->kd_topik.'" data-nmtopik="'.$topik->nm_topik.'" ><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus Topik</a>';
													

													$subbutton=$btnadd.$btnedit.$btndel;
													
													
													$aksi_topik='<center>
															<div class="btn-group col-md-1" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
																'.$button_topik.'
																</button><ul class="dropdown-menu" >
																<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
																	  
																	  '.$subbutton.'
																	
																</div> 
															  </div>
															
														</center>';
																						
													
													

														$html.='<div class="col-md-12"><fieldset><legend>';
														$html.=''.$aksi_topik.'<details>
																	<summary style="font-size: 14px;color: #3FA796; text-align: left; margin-left:100px"  data-toggle="tooltip" data-placement="top" title="Klik Detail Topik"><b style="margin-left: -70px;" > TOPIK '.$topik->kd_topik.' : '.$topik->nm_topik.'</b></summary> <br>';
													
															$lclevel = "SELECT a.*,b.nm_level FROM tlevel a inner join ms_level b on a.kd_level=b.kd_level WHERE a.tahun='".$cthn."' and a.kd_apip='".$ckode."' and a.kd_elemen='".$ckdelemen."' and a.kd_topik='".$topik->kd_topik."'";
															$query = $this->db->query($lclevel);
															$data=$query->result();
												
															foreach($data as $clevel){ 
															
																	$btnadd = '<a  class="list-group-item list-group-item-action showTambah-penilaian" style="width:170px;" data-tahun="'.$cthn.'" data-inst="'.$ckode.'" data-kdelemen="'.$ckdelemen.'" data-kdtopik="'.$topik->kd_topik.'" data-kdlevel="'.$clevel->kd_level.'"><i class="fa fa-plus" aria-hidden="true" style="color: #18978F"></i> Tambah Penilaian</a>';
																	$btnedit = '<a  class="list-group-item list-group-item-action showEdit-level"  data-tahun="'.$cthn.'" data-inst="'.$ckode.'" data-kdelemen="'.$ckdelemen.'" data-kdtopik="'.$topik->kd_topik.'" data-kdlevel="'.$clevel->kd_level.'"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color: #F15412"></i> Edit Level</a>';
																	$btndel = '<a  class="list-group-item list-group-item-action hapus-level"  data-tahun="'.$cthn.'" data-inst="'.$ckode.'" data-kdelemen="'.$ckdelemen.'" data-kdtopik="'.$topik->kd_topik.'" data-kdlevel="'.$clevel->kd_level.'" data-nmlevel="'.$clevel->nm_level.'"><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus Level</a>';
																	

																	$subbutton=$btnadd.$btndel;
																
																$aksi_level='<center>
																					<div class="btn-group col-md-1" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
																					'.$button_level.'
																					</button><ul class="dropdown-menu" >
																					<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
																						  
																						  '.$subbutton.'
																						
																					</div> 
																				  </div>
																
																			</center>';
															
															

																//$html.='<div class="col-md-12">';
																$html.='<fieldset>
																				<legend> '.$aksi_level.'
																
																
																	<details>
																			<summary style="font-size: 14px;color: #DD4A48; text-align: left;" data-toggle="tooltip" data-placement="top" title="Klik Detail Level" ></button><b style="margin-left: -10px;" > '.$clevel->nm_level.'</b></summary><br> ';
																			
													

																			$lcpenilaian = "SELECT distinct kd_penilaian,uraian,hpoin,dpoin FROM tpenilaian WHERE tahun='".$cthn."' and kd_apip='".$ckode."' and kd_elemen='".$ckdelemen."' and kd_topik='".$clevel->kd_topik."' and kd_level='".$clevel->kd_level."'";
																			$query = $this->db->query($lcpenilaian);
																			$data=$query->result();
																				//$cno_nilai=0;
																			foreach($data as $cpenilaian){
																				//$cno_nilai=$cno_nilai+1;
																				
																				$chpoin=$cpenilaian->hpoin;
																				$cdpoin=$cpenilaian->dpoin;
																				
																				if($chpoin!==''){
																					
																					if($cdpoin!==''){
																						$cpoin=$chpoin.'.'.$cdpoin.'.';
																					}else{
																						$cpoin=$chpoin.'.';
																					}
																				}else{
																					
																					if($cdpoin==''){
																						$cpoin='';
																					}else{
																						$cpoin=$cdpoin.'.';
																						
																					}
																				}	

																				

																				$btnedit = '<a  class="list-group-item list-group-item-action showEdit-Penilaian"   data-tahun="'.$cthn.'" data-inst="'.$ckode.'" data-kdelemen="'.$ckdelemen.'" data-kdtopik="'.$topik->kd_topik.'" data-kdlevel="'.$clevel->kd_level.'" data-kdpenilaian="'.$cpenilaian->kd_penilaian.'"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color: #F15412"></i> Edit Penilaian</a>';
																				$btndel = '<a  id="btnhapus_penilaian" class="list-group-item list-group-item-action hapus-Penilaian" data-tahun="'.$cthn.'" data-inst="'.$ckode.'" data-elemen="'.$ckdelemen.'" data-topik="'.$topik->kd_topik.'" data-level="'.$clevel->kd_level.'" data-penilaian="'.$cpenilaian->kd_penilaian.'" data-uraian="'.$cpenilaian->uraian.'"><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus Penilaian</a>';
																				
																				$subbutton=$btnedit.$btndel;
																			
																			$aksi_penilaian='<center>
																								<div class="btn-group col-md-1" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
																								'.$button_penilaian.'
																								</button><ul class="dropdown-menu" >
																								<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
																									  
																									  '.$subbutton.'
																									
																								</div> 
																							  </div>
																			
																						</center>';
																			
																			
																			
																			
																				$html.=' <fieldset>
																				<legend>
																						<details>
																							<summary style="font-size: 13px;color: #5F7161; text-align: left; " data-toggle="tooltip" data-placement="top" title="Klik Detail Penilaian"><div class="col-md-1">'.$aksi_penilaian.'</div><div class="col-md-2"><b style="margin-left: -10px;">PENILAIAN </b>'.$cpoin.'  </div>
																							<div class="col-md-9" style="margin-left: -33px;">'.$cpenilaian->uraian.' <br><br></div>
																							</summary> ';
																
																
																							$lcpenjelasasn = "SELECT *FROM tpenilaian WHERE tahun='".$cthn."' and kd_apip='".$ckode."' and kd_elemen='".$ckdelemen."' and kd_topik='".$clevel->kd_topik."' and kd_level='".$clevel->kd_level."' 
																							and kd_penilaian='".$cpenilaian->kd_penilaian."'";
																							$query = $this->db->query($lcpenjelasasn);
																							$data=$query->result();
																
																							foreach($data as $cpenjelasasn){ 

																								//$html.='<div class="col-md-12">';
																								$html.='<details>
																											<summary style="font-size: 12px;color: #5F7161; text-align: left;"><div class="col-md-1"></div><div class="col-md-2"  style="margin-left: -10px;"><b>PENJELASAN   </b></div>
																											<div class="col-md-9" style="margin-left: -20px;">'.$cpenjelasasn->penjelasan.' <br><br>
																											</div> 
																											<div class="col-md-1"></div><div class="col-md-2"  style="margin-left: -10px;"><b>BUKTI DUKUNG   </b></div> <div class="col-md-9" style="margin-left: -20px;">'.$cpenjelasasn->bukti.'</div></summary> <br>';

																											
																								$html.='</details>';										
																											
																									
																							}	
																									
																							
																				$html.='</details> </fieldset>';
																				 
																				 
																			}	

																			
																$html.='</details> </fieldset> ';
																 
																 
															}					
																
															  
														$html.='</details></fieldset></div>';
														 
														$tjml_topik=$tjml_topik+$cjml_topik; 
													}		
														
											
										$html.='</details>
										
										</fieldset>
								   
								</div>
								<div class="col-md-1"><summary style="font-size: 16px;color: #377D71; text-align: center;"><b>'.$cjml_topik.'</b></summary></div>
							</div>	
						</div>';
							
			
							
				$html.=	'</div>';
				
								

			}
			$html.=	'<div class="col-md-11" style="cursor: pointer; padding: 3px 0; color: #377D71; text-align: right;"><b>JUMLAH</b></div>
					<div class="col-md-1"><summary style="font-size: 16px;color: #377D71; text-align: left;"><b>'.$tjml_topik.'</b></summary></div>';
			return $html;
		}




		public function viewAddTopik($cthn,$cinst,$celemen)
		{
		
			$query="select a.*,(select max(urut)+1 from ttopik where tahun=a.tahun and kd_apip=a.kd_apip and kd_elemen=a.kd_elemen)cnext_urut from ttopik a WHERE a.tahun='".$cthn."' AND a.kd_apip=".$cinst." AND a.kd_elemen='".$celemen."'
					ORDER BY a.urut";

			$data = $this->db->query($query)->result();
			$html = "";
			$isitable = "";
			$no = 0;
			$result = array();
			foreach ($data as $value) {
				$no++;
				
				$ckd_elemen	= $value->kd_elemen;
				$ckd_topik	= $value->kd_topik;
				$cnm_topik	= $value->nm_topik;
				$curut		= $value->urut;
				$ctahun		= $value->tahun;
				$cket_topik	= $value->keterangan;
				$cnext_urut		= $value->cnext_urut;
				$ckd_apip	= $value->kd_apip;
				
				
				
				$isitable.='<tr>
							<td style="width:5%;text-align:center;" hidden >'.$ckd_elemen.'</td>
							<td style="width:1%;text-align:center;">'.$ckd_topik.'</td>
							<td style="width:45%;text-align:left;">'.$cnm_topik.'</td>
							<td style="width:45%;text-align:left;">'.$cket_topik.'</td>';
							
				$isitable.=	'
						</tr>';
						

			}
			
			
			$html.=' <form id="form-edit-p1" enctype="multipart/form-data" method="post">

						<div class="product-status mg-b-15">
							<div class="container-fluid">
								<div class="row" style="margin-top: 5px">
								
								<div class="content-form" style="display:block;">
								
	

								<div class="row">
									<div class="col-md-12">
									
										<div class="form-group">
											<label class="col-sm-2 control-label input-sm">Urut</label>

											<div class="col-sm-10">
														<input id="urut_topik" type="text" style="width: 50px;" class="form-control" value="'.$cnext_urut.'" name="urut_topik" placeholder="" >
												
											</div>
											
										</div>
											
									</div>
								</div>
				
								<div class="row">
									<div class="col-md-12">
									
									
				
										<div class="form-group">
											<label class="col-sm-2 control-label input-sm">Topik</label>

											<div class="col-sm-10">
														<input id="nm_topik" type="text"  class="form-control" value="" name="nm_topik" placeholder="" >
														<input id="htahun_tpk" type="hidden"  class="form-control" value="" name="htahun_tpk" placeholder="" >
														<input id="hinstansi_tpk" type="hidden"  class="form-control" value="" name="hinstansi_tpk" placeholder="" >
												
											</div>
											
										</div>
											
									</div>
								</div>	
								
								
								<div class="row">
									<div class="col-md-12">
									
										<div class="form-group">
											<label class="col-sm-2 control-label input-sm">Keterangan</label>

											<div class="col-sm-10">
												<textarea style="font-size:10pt;" class="form-control" id="ket_topik" name="ket_topik" rows="2"></textarea>
											
											</div>
											
										</div>
											
									</div>
								</div>
								
								
								
								<div class="col-md-12">&nbsp;</div><br>						

								
											<div class="row">
												<div class="col-md-12">
													<div class="modal-footer"> 
															<center>
																<button type="button"  class="btn-danger btn-sm tutup-topik" data-dismiss="modal"> <i class="fa fa-times-circle" aria-hidden="true"></i> TUTUP</button>
																<button type="button" id="btntambah_topik" class="btn-info  btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> TAMBAH </button>	
																<button type="button"  class="btn-success btn-sm simpan-topik" data-tahun="'.$cthn.'" data-inst="'.$cinst.'" data-elemen="'.$celemen.'"><i class="fa fa-check-square"></i> SIMPAN </button>
															</center>	
													</div>	
												</div>	
											</div>	
								
								</div>		

								
							</div>
						
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="product-status-wrap">

											   <div class="form-group row" style="margin-top: 5px">
													
													<div class="col-sm-10">
														<p id="lbeinfo" style="font-size: 18px;color: black; text-align: left;"></p> 
														
													</div>
												</div>
												
													<table id="E-Ptable" class="table table-bordered table-striped" style="width:100%" border="0">
														<thead>
															<tr>
																<th style="text-align:center;" hidden>id</th>
																	<th style="text-align:center;"><b>Kode</b></th>
																	<th style="text-align:center;"><b>Nama Topik</b></th>																	
																	<th style="text-align:center;"><b>Keterangan</b></th>																	
																	
																
															</tr>
														</thead>
														
														 <tbody>'.$isitable.'
																				
														 </tbody>
													</table>
													
									  </div>
								</div>
							</div>
						</div>	

					</form>';

			return($html);
			
		}



		public function viewAddPenilaian($ctahun,$cinstansi,$celemen,$ctopik,$clevel)
		{

			$query="select a.*,(select (max(kd_penilaian)+1) from tpenilaian where tahun=a.tahun and kd_apip=a.kd_apip and kd_elemen=a.kd_elemen and kd_topik=a.kd_topik 
					and kd_level=a.kd_level)cnext from tpenilaian a WHERE a.tahun='".$ctahun."' AND a.kd_apip=".$cinstansi." AND a.kd_elemen='".$celemen."' and a.kd_topik='".$ctopik."' and a.kd_level='".$clevel."'
					ORDER BY a.kd_penilaian";	

			$data = $this->db->query($query)->result();
			$html = "";
			$isitable = "";
			$no = 0;
			$result = array();
			foreach ($data as $value) {
				$no++;
				
				$ctahun		= $value->tahun;
				$ckd_apip	= $value->kd_apip;
				$ckd_elemen	= $value->kd_elemen;
				$ckd_topik	= $value->kd_topik;
				$ckd_level	= $value->kd_level;
				$ckd_penilaian	= $value->kd_penilaian;
				$curaian	= $value->uraian;
				$cpenjelasan	= $value->penjelasan;
				$cbukti		= $value->bukti;
				$cnext		= $value->cnext;
				$chpoin		= $value->hpoin;
				$cdpoin		= $value->dpoin;
	
				if($chpoin!==''){
					
					if($cdpoin!==''){
						$cpoin=$chpoin.'.'.$cdpoin.'.';
					}else{
						$cpoin=$chpoin.'.';
					}
				}else{
					
					if($cdpoin==''){
						$cpoin='';
					}else{
						$cpoin=$cdpoin.'.';
						
					}
				}	

	
				$isitable.='<tr>
							<td style="width:1%;text-align:center;" hidden >'.$ckd_elemen.'</td>
							<td style="width:1%;text-align:center;" hidden>'.$ckd_topik.'</td>
							<td style="width:1%;text-align:left;" hidden>'.$ckd_level.'</td>
							<td style="width:1%;text-align:center;" hidden>'.$ckd_penilaian.'</td>
							<td style="width:1%;text-align:left;">'.$cpoin.'</td>
							<td style="width:20%;text-align:left;">'.$curaian.'</td>
							<td style="width:20%;text-align:left;">'.$cpenjelasan.'</td>
							<td style="width:20%;text-align:left;">'.$cbukti.'</td>';
							
				$isitable.=	'
						</tr>';
						

			}
			
			
			$html.=' <form id="form-add-penilaian" enctype="multipart/form-data" method="post">

						<div class="product-status mg-b-15">
							<div class="container-fluid">
								<div class="row" style="margin-top: 5px">
								
								<div class="content-form" style="display:block;">
								
									<div class="row" hidden>
										<div class="col-md-12">
										
											<div class="form-group">
												<label class="col-sm-2 control-label input-sm">Urut</label>

												<div class="col-sm-10">
													<input id="kd_penilaian" type="hidden" style="width: 50px;" class="form-control" value="'.$cnext.'" name="kd_penilaian" placeholder="" >
													
												</div>
												
											</div>
												
										</div>
									</div>


									<div class="row">
										<div class="col-md-12">
										
											<div class="form-group">
												<label class="col-sm-2 control-label input-sm">Poin</label>

												<div class="col-sm-1">
												
													<input type="text" name="hpoin" class="form-control" id="hpoin">

												</div>
												
											</div>
												
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-12">
										
											<div class="form-group">
												<label class="col-sm-2 control-label input-sm">Sub Poin</label>

												<div class="col-sm-1">
												
													<input type="text" name="dpoin"  class="form-control" id="dpoin">
							

												</div>
												
											</div>
												
										</div>
									</div>
								
									<div class="row">
										<div class="col-md-12">
										
											<div class="form-group">
												<label class="col-sm-2 control-label input-sm">Uraian Aspek Penilaian</label>

												<div class="col-sm-10">
													<textarea style="font-size:10pt;" class="form-control" id="uraian_penilaian" name="uraian_penilaian" rows="3"></textarea>
												
												</div>
												
											</div>
												
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
										
											<div class="form-group">
												<label class="col-sm-2 control-label input-sm">Penjelasan Uraian Aspek</label>

												<div class="col-sm-10">
													<textarea style="font-size:10pt;" class="form-control" placeholder="Kosongkan untuk menjadikan uraian sebagai Header" id="penjelasan_penilaian" name="penjelasan_penilaian" rows="3"></textarea>
												
												</div>
												
											</div>
												
										</div>
									</div>								
								
									<div class="row">
										<div class="col-md-12">
										
											<div class="form-group">
												<label class="col-sm-2 control-label input-sm">Bukti Pendukung</label>

												<div class="col-sm-10">
													<textarea style="font-size:10pt;" class="form-control" placeholder="Kosongkan untuk menjadikan uraian sebagai Header" id="bukti_penilaian" name="bukti_penilaian" rows="3"></textarea>
												
												</div>
												
											</div>
												
										</div>
									</div><br><br>


									<div class="row">
												
										<div class="modal-footer">   
												<center>
													<button type="button"  class="btn-danger btn-sm tutup-penilaian" data-dismiss="modal"> <i class="fa fa-times-circle" aria-hidden="true"></i> TUTUP</button>
													<button type="button" id="btntambah_penilaian" class="btn-info  btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> TAMBAH </button>	
													<button type="button"  class="btn-success btn-sm simpan-penilaian" data-tahun="'.$ctahun.'" data-inst="'.$cinstansi.'" data-elemen="'.$celemen.'" data-topik="'.$ctopik.'" data-level="'.$clevel.'"><i class="fa fa-check-square"></i> SIMPAN </button>
												</center>	
										</div>	
													
									</div>	
										
						
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="product-status-wrap">

											   <div class="form-group row" style="margin-top: 5px">
													
													<div class="col-sm-10">
														<p id="lbeinfo" style="font-size: 18px;color: black; text-align: left;"></p> 
														
													</div>
												</div>
												
													<table id="tbPenilaian" class="table table-bordered table-striped" style="width:100%" border="0">
														<thead>
															<tr>
																<th style="text-align:center;" hidden>id</th>
																<th style="text-align:center;" hidden>id</th>
																<th style="text-align:center;" hidden>id</th>
																<th style="text-align:center;" >Poin</th>
																<th style="text-align:center;" ><b>Uraian</b></th>
																	<th style="text-align:center;"><b>Penjelasan</b></th>
																	<th style="text-align:center;"><b>Bukti</b></th>																	
																																	
																	
																
															</tr>
														</thead>
														
														 <tbody>'.$isitable.'
																				
														 </tbody>
													</table>
													
									  </div>
									</div>
									
								</div>		

								
							</div>			
									
									
									
									
							</div>
						</div>	

					</form>';

			return($html);
			
		}





		public function viewEditPenilaian($ctahun,$cinstansi,$celemen,$ctopik,$clevel,$cpenilaian)
		{

			$query="select *from tpenilaian  WHERE tahun='".$ctahun."' AND kd_apip=".$cinstansi." AND kd_elemen='".$celemen."' and kd_topik='".$ctopik."' and kd_level='".$clevel."' and kd_penilaian='".$cpenilaian."'
					ORDER BY kd_penilaian";	

			$data = $this->db->query($query)->result();
			$html = "";
			$isitable = "";
			$no = 0;
			$result = array();
			foreach ($data as $value) {
				$no++;
				
				$ctahun		= $value->tahun;
				$ckd_apip	= $value->kd_apip;
				$ckd_elemen	= $value->kd_elemen;
				$ckd_topik	= $value->kd_topik;
				$ckd_level	= $value->kd_level;
				$ckd_penilaian	= $value->kd_penilaian;
				$curaian	= $value->uraian;
				$cpenjelasan	= $value->penjelasan;
				$cbukti		= $value->bukti;
				$chpoin		= $value->hpoin;
				$cdpoin		= $value->dpoin;

				if($chpoin!==''){
					
					if($cdpoin!==''){
						$cpoin=$chpoin.'.'.$cdpoin.'.';
					}else{
						$cpoin=$chpoin.'.';
					}
				}else{
					
					if($cdpoin==''){
						$cpoin='';
					}else{
						$cpoin=$cdpoin.'.';
						
					}
				}	
				
			
				$isitable.='<tr>
							<td style="width:1%;text-align:center;" hidden >'.$ckd_elemen.'</td>
							<td style="width:1%;text-align:center;" hidden>'.$ckd_topik.'</td>
							<td style="width:1%;text-align:left;" hidden>'.$ckd_level.'</td>
							<td style="width:1%;text-align:center;" hidden>'.$ckd_penilaian.'</td>
							<td style="width:1%;text-align:left;">'.$cpoin.'</td>
							<td style="width:20%;text-align:left;">'.$curaian.'</td>
							<td style="width:20%;text-align:left;">'.$cpenjelasan.'</td>
							<td style="width:20%;text-align:left;">'.$cbukti.'</td>';
							
				$isitable.=	'
						</tr>';
						

			}
			
			
			$html.=' <form id="form-add-penilaian" enctype="multipart/form-data" method="post">

						<div class="product-status mg-b-15">
							<div class="container-fluid">
								<div class="row" style="margin-top: 5px">
								
								<div class="content-form" style="display:block;">
								
									<div class="row" hidden>
										<div class="col-md-12">
										
											<div class="form-group">
												<label class="col-sm-2 control-label input-sm">Urut</label>

												<div class="col-sm-10">
													<input id="kd_penilaian" type="hidden" style="width: 50px;" class="form-control" value="'.$ckd_penilaian.'" name="kd_penilaian" placeholder="" >
													
												</div>
												
											</div>
												
										</div>
									</div>

								
									<div class="row">
										<div class="col-md-12">
										
											<div class="form-group">
												<label class="col-sm-2 control-label input-sm">Poin</label>

												<div class="col-sm-1">
												
													<input type="text" name="ehpoin"  value="'.$chpoin.'" class="form-control" id="ehpoin">

												</div>
												
											</div>
												
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-12">
										
											<div class="form-group">
												<label class="col-sm-2 control-label input-sm">Sub Poin</label>

												<div class="col-sm-1">
												
													<input type="text" name="edpoin"  value="'.$cdpoin.'" class="form-control" id="edpoin">
							

												</div>
												
											</div>
												
										</div>
									</div>									
									
									
									<div class="row">
										<div class="col-md-12">
										
											<div class="form-group">
												<label class="col-sm-2 control-label input-sm">Uraian Aspek Penilaian</label>

												<div class="col-sm-10">
													<textarea style="font-size:10pt;" class="form-control" id="euraian_penilaian" name="euraian_penilaian" rows="3">'.$curaian.'</textarea>
												
												</div>
												
											</div>
												
										</div>
									</div>									

									<div class="row">
										<div class="col-md-12">
										
											<div class="form-group">
												<label class="col-sm-2 control-label input-sm">Penjelasan Uraian Aspek</label>

												<div class="col-sm-10">
													<textarea style="font-size:10pt;" class="form-control" id="epenjelasan_penilaian" name="epenjelasan_penilaian" rows="3">'.$cpenjelasan.'</textarea>
												
												</div>
												
											</div>
												
										</div>
									</div>								
								
									<div class="row">
										<div class="col-md-12">
										
											<div class="form-group">
												<label class="col-sm-2 control-label input-sm">Bukti Pendukung</label>

												<div class="col-sm-10">
													<textarea style="font-size:10pt;" class="form-control" id="ebukti_penilaian" name="ebukti_penilaian" rows="3">'.$cbukti.'</textarea>
												
												</div>
												
											</div>
												
										</div>
									</div><br><br>

									
								
									

									<div class="row">
												
										<div class="modal-footer">   
												<center>
													<button type="button"  class="btn-danger btn-sm tutup-penilaian" data-dismiss="modal"> <i class="fa fa-times-circle" aria-hidden="true"></i> TUTUP</button>
													<button type="button"  class="btn-success btn-sm update-penilaian" data-tahun="'.$ctahun.'" data-inst="'.$cinstansi.'" data-elemen="'.$celemen.'" data-topik="'.$ctopik.'" data-level="'.$clevel.'" data-penilaian="'.$cpenilaian.'"><i class="fa fa-check-square"></i> UPDATE </button>
												</center>	
										</div>	
													
									</div>	
										
						
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="product-status-wrap">

											   <div class="form-group row" style="margin-top: 5px">
													
													<div class="col-sm-10">
														<p id="lbeinfo" style="font-size: 18px;color: black; text-align: left;"></p> 
														
													</div>
												</div>
												
													<table id="tbPenilaian" class="table table-bordered table-striped" style="width:100%" border="0">
														<thead>
															<tr>
																<th style="text-align:center;" hidden>id</th>
																<th style="text-align:center;" hidden>id</th>
																<th style="text-align:center;" hidden>id</th>
																<th style="text-align:center;" >Poin</th>
																<th style="text-align:center;" ><b>Uraian</b></th>
																	<th style="text-align:center;"><b>Penjelasan</b></th>
																	<th style="text-align:center;"><b>Bukti</b></th>																	
																																	
																	
																
															</tr>
														</thead>
														
														 <tbody>'.$isitable.'
																				
														 </tbody>
													</table>
													
									  </div>
									</div>
									
								</div>		

								
							</div>			
									
									
									
									
							</div>
						</div>	

					</form>';

			return($html);
			
		}




		public function viewEditTopik($cthn,$cinst,$celemen,$ctopik)
		{
				
			$query2="select * From ttopik WHERE  tahun='".$cthn."' AND kd_apip=".$cinst." AND kd_elemen='".$celemen."' and kd_topik ='".$ctopik."'";
			$data2 = $this->db->query($query2)->result();
			$html = "";
			$isitable = "";
			$no = 0;
			foreach ($data2 as $value2) {
				$no++;
				
				$ekd_elemen	= $value2->kd_elemen;
				$ekd_topik	= $value2->kd_topik;
				$enm_topik	= $value2->nm_topik;
				$eurut		= $value2->urut;
				$etahun		= $value2->tahun;
				$eket_topik	= $value2->keterangan;
				$ekd_apip	= $value2->kd_apip;
				$enm_topik	= $value2->nm_topik;

			}

			
			
			
			$html.=' <form id="form-edit-p1" enctype="multipart/form-data" method="post">

						<div class="product-status mg-b-15">
							<div class="container-fluid">
								<div class="row" style="margin-top: 5px">
								
								<div class="content-form" style="display:block;">
								
	

								<div class="row">
									<div class="col-md-12">
									
										<div class="form-group">
											<label class="col-sm-2 control-label input-sm">Urut</label>

											<div class="col-sm-10">
														<input id="eurut_topik" type="text" style="width: 50px;" class="form-control" value="'.$eurut.'" name="eurut_topik" placeholder="" >
													   
											</div>
											
										</div>
											
									</div>
								</div>
				
								<div class="row">
									<div class="col-md-12">
									
									
				
										<div class="form-group">
											<label class="col-sm-2 control-label input-sm">Topik</label>

											<div class="col-sm-10">
														<input id="enm_topik" type="text"  class="form-control" value="'.$enm_topik.'" name="enm_topik" placeholder="" >
														
												
											</div>
											
										</div>
											
									</div>
								</div>	
								
								
								<div class="row">
									<div class="col-md-12">
									
										<div class="form-group">
											<label class="col-sm-2 control-label input-sm">Keterangan</label>

											<div class="col-sm-10">
												<textarea style="font-size:10pt;" class="form-control" id="eket_topik" name="eket_topik" rows="2">'.$eket_topik.'</textarea>
											
											</div>
											
										</div>
											
									</div>
								</div>
								
								
								
								<div class="col-md-12">&nbsp;</div><br>		
								
											<div class="row">
												<div class="col-md-12">
													<div class="modal-footer">  
															<center>
																<button type="button"  class="btn-danger btn-sm tutup-topik" data-dismiss="modal"> <i class="fa fa-times-circle" aria-hidden="true"></i> TUTUP</button>										
																<button type="button"  class="btn-success btn-sm update-topik" data-tahun="'.$cthn.'" data-inst="'.$cinst.'" data-elemen="'.$celemen.'" data-topik="'.$ctopik.'"><i class="fa fa-check-square"></i> UPDATE </button>
															</center>	
													</div>	
												</div>	
											</div>	
								
								</div>		

								
							</div>
						
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="product-status-wrap">

											   <div class="form-group row" style="margin-top: 5px">
													
													<div class="col-sm-10">
														<p id="lbeinfo" style="font-size: 18px;color: black; text-align: left;"></p> 
														
													</div>
												</div>
												
													
									  </div>
								</div>
							</div>
						</div>	

					</form>';

			return($html);
			
		}



		public function viewAddLevel($cthn,$cinst,$celemen,$ctopik)
		{
		
		$query = "SELECT a.*,b.nm_level FROM tlevel a inner join ms_level b on a.kd_level=b.kd_level 
				  WHERE a.tahun='".$cthn."' and a.kd_apip='".$cinst."' and a.kd_elemen='".$celemen."' and a.kd_topik='".$ctopik."'";
																			
					

			$data = $this->db->query($query)->result();
			$html = "";
			$isitable = "";
			$no = 0;
			$result = array();
			foreach ($data as $value) {
				$no++;
				
				$ckd_elemen	= $value->kd_elemen;
				$ckd_topik	= $value->kd_topik;
				$ckd_level	= $value->kd_level;
				$cnm_level	= $value->nm_level;
				$curut		= $value->urut;
				
				$isitable.='<tr>
							<td style="width:5%;text-align:center;" hidden >'.$ckd_elemen.'</td>
							<td style="width:1%;text-align:center;" hidden>'.$ckd_topik.'</td>
							<td style="width:1%;text-align:left;">'.$ckd_level.'</td>
							<td style="width:50%;text-align:left;">'.$cnm_level.'</td>';
							
				$isitable.=	'
						</tr>';
						

			}
			
			
			$html.=' <form id="form-add-level" enctype="multipart/form-data" method="post">

						<div class="product-status mg-b-15">
							<div class="container-fluid">
								<div class="row" style="margin-top: 5px">
								
								<div class="content-form" style="display:block;">
								
	
				
								<div class="row">
									<div class="col-md-12">
									
									
				
										<div class="form-group">
											<label class="col-sm-2 control-label input-sm">Level</label>

											<div class="col-sm-10">
														<select name="cblevel" id="cblevel" class="form-control input-sm" style="width:100%;">
														</select>
														
											</div>
											
										</div>
											
									</div>
								</div>	
								
								
								<div class="col-md-12">&nbsp;</div><br>		
								
											<div class="row">
												<div class="col-md-12">
													<div class="modal-footer"> 
															<center>
																<button type="button"  class="btn-danger btn-sm tutup-level" data-dismiss="modal"> <i class="fa fa-times-circle" aria-hidden="true"></i> TUTUP</button>
																<button type="button"  class="btn-success btn-sm simpan-level" data-tahun="'.$cthn.'" data-inst="'.$cinst.'" data-elemen="'.$celemen.'" data-topik="'.$ctopik.'"><i class="fa fa-check-square"></i> SIMPAN </button>
															</center>	
													</div>	
												</div>	
											</div>	
								
								</div>		

								
							</div>
						
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="product-status-wrap">

											   <div class="form-group row" style="margin-top: 5px">
													
													<div class="col-sm-10">
														<p id="lbeinfo" style="font-size: 18px;color: black; text-align: left;"></p> 
														
													</div>
												</div>
												
													<table id="E-Ptable" class="table table-bordered table-striped" style="width:100%" border="0">
														<thead>
															<tr>
																<th style="text-align:center;" hidden>elemen</th>
																	<th style="text-align:center;" hidden>topik</th>
																	<th style="text-align:center;"><b>Kode</b></th>
																	<th style="text-align:center;"><b>Nama Level</b></th>																	
																	
																
															</tr>
														</thead>
														
														 <tbody>'.$isitable.'
																				
														 </tbody>
													</table>
													
									  </div>
								</div>
							</div>
						</div>	

					</form>';

			return($html);
		}


		public function add_topik($data){
			$this->db->insert('ttopik', $data);
			return true;
		}

		public function add_level($data){
			$this->db->insert('tlevel', $data);
			return true;
		}

		public function add_penilaian($data){
			$this->db->insert('tpenilaian', $data);
			return true;
		}		
		

		public function cekTopik($cthn,$cinst,$celemen)
		{
		
			$query="select a.*,(select max(urut)+1 from ttopik where tahun=a.tahun and kd_apip=a.kd_apip and kd_elemen=a.kd_elemen)cnext from ttopik a WHERE a.tahun='".$cthn."' AND a.kd_apip=".$cinst." AND a.kd_elemen='".$celemen."'
					ORDER BY a.urut";

			$data = $this->db->query($query)->result();
			$html = "";
			$no = 0;
			
			foreach ($data as $value) {
				$no++;
				
				$ckd_elemen	= $value->kd_elemen;
				$ckd_topik	= $value->kd_topik;
				$cnm_topik	= $value->nm_topik;
				$curut		= $value->urut;
				$ctahun		= $value->tahun;
				$cnext		= $value->cnext;

			}
			
			return($cnext);
			
			
			
		}

		public function listLevel($cthn,$cinst,$celemen,$ctopik)
		{

			$sql = "SELECT * FROM ms_level where kd_level not in(select kd_level from tlevel where  tahun='".$cthn."' AND kd_apip=".$cinst." AND kd_elemen='".$celemen."' and kd_topik='".$ctopik."')";
			
			$data=$this->db->query($sql);
			$html ='<option value="" disabled selected hidden> Pilih Level </option>';
			foreach ($data->result_array() as $value) {
				$html .='<option value="'.$value['kd_level'].'"> '.$value['nm_level'].'</option>';
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