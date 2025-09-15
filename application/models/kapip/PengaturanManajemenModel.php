<?php
	class PengaturanManajemenModel extends CI_Model{

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

		public function viewManajemenProfil($cthn,$ckode)
		{
				
		$query="SELECT DISTINCT a.id_group,b.nm_group,(SELECT COUNT(*)jml FROM ms_group_menu_profil WHERE id_group=a.id_group 
				GROUP BY id_group) jml FROM ms_group_menu_profil a 
				INNER JOIN ms_group b ON a.id_group=b.id_group ORDER BY a.id_group,b.nm_group";
		

			$data = $this->db->query($query)->result();
			$html = "";
			$html .='<input type="hidden" name="ptahun"  value='.$cthn.' class="form-control input-sm" id="ptahun" placeholder="">
					 <input type="hidden" name="pkdinstansi"  value='.$ckode.' class="form-control input-sm" id="pkdinstansi" placeholder="">';
			$cno = 0;
			foreach ($data as $value) {
				$cno++;
				
				$cid_group=$value->id_group;
				$cnm_group=$value->nm_group;
				$cjml=$value->jml;

			
				$abold="<b>";
				$nbold="<b>";
				
				
		

				$button3 = '<button style=" background-color: #ECB365; color: #F6F6F6; height:25px; width:5px;" data-toggle="dropdown"  id="btnGroupDrop1" class="btn btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
				$button_profil = '<button style=" background-color: #ECB365; color: #F6F6F6; border-radius: 45%; height:20px; width:5px; margin-left: -45px;" data-toggle="dropdown"  id="btnGroupDrop1" class="btn btn btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
				$button_topik = '<button style=" background-color: #ECB365; color: #F6F6F6; border-radius: 45%; height:20px; width:5px; margin-left: -10px;" data-toggle="dropdown" id="btnGroupDrop1" class="btn btn btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
				$button_penilaian = '<button style="background-color: #ECB365;color: #F6F6F6;  border-radius: 45%; height:20px; width:5px; margin-left: -10px;" data-toggle="dropdown" id="btnGroupDrop1" class="btn btn btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';


				$btnadd = '<a class="list-group-item list-group-item-action showTambah-profil" data-tahun="'.$cthn.'" data-inst="'.$ckode.'" data-kdgroup="'.$cid_group.'" data-nmgroup="'.$cnm_group.'"><i class="fa fa-plus" aria-hidden="true" style="color: #18978F"></i> Tambah Profil</a>';
				$btnmenu = '<a class="list-group-item list-group-item-action showManajemen-menu" data-tahun="'.$cthn.'" data-inst="'.$ckode.'" data-kdgroup="'.$cid_group.'" data-nmgroup="'.$cnm_group.'"><i class="fa fa-cogs" aria-hidden="true" style="color: #F15412"></i> Atur Menu</a>';

				$btndel = '<a class="list-group-item list-group-item-action hapus-group-profil"  data-tahun="'.$cthn.'" data-inst="'.$ckode.'" data-kdgroup="'.$cid_group.'" data-nmgroup="'.$cnm_group.'"><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus Group</a>';
										
				$subbutton=$btnadd.$btnmenu.$btndel;
 
				$aksi_profil='<center>
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
									 '.$aksi_profil.'</button> 
								</div>
							
								<div class="col-md-10" style="cursor: pointer; padding: 3px 0; color: #fff; text-align: center;">
								
								<fieldset>
									<legend>
								
									<details>
										<summary  style="font-size: 16px;color: #377D71; text-align: left;" data-toggle="tooltip" data-placement="top" title="Klik Detail Group"><b>'.$cno.'  :  '.$cnm_group.' </b></summary></legend><br>';
				
													$lc = "SELECT DISTINCT a.tahun,a.kd_apip,a.id_group,a.kd_profil,b.nm_profil FROM ms_group_menu_profil a 
														   INNER JOIN ms_profil b ON a.kd_profil=b.kd_profil WHERE a.tahun='".$cthn."' and a.kd_apip='".$ckode."' and a.id_group='".$cid_group."'
															order by a.id_group,a.kd_profil";
													
													$query = $this->db->query($lc);
													$data=$query->result();
													$tjml_topik=0;
													foreach($data as $profil){
													
													$ckdprofil=$profil->kd_profil;
													$cnmprofil=$profil->nm_profil;
													$ckode=$profil->kd_apip;
													$cidgroup=$profil->id_group;
													
									
													$btndel = '<a class="list-group-item list-group-item-action hapus-profil"  data-tahun="'.$cthn.'" data-inst="'.$ckode.'" data-kdprofil="'.$ckdprofil.'" data-nmprofil="'.$cnmprofil.'" data-idgroup="'.$cidgroup.'"><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus Profil</a>';
													$subbutton=$btndel;
													
													$aksi_elemen='<center>
															<div class="btn-group col-md-1" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
																'.$button_profil.'
																</button><ul class="dropdown-menu" >
																<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
																	  
																	  '.$subbutton.'
																	
																</div> 
															  </div>
															
														</center>';
																	

														$html.='<div class="col-md-12"><fieldset>';
														$html.=''.$aksi_elemen.'
																	<summary style="font-size: 14px;color: #3FA796; text-align: left; margin-left:100px"  data-toggle="tooltip" data-placement="top" title="Klik Detail Topik"><b style="margin-left: -70px;" > PROFIL '.$profil->kd_profil.' : '.$profil->nm_profil.'</b></summary> <br>';
															  
														$html.='</fieldset></div>';
														 
														//$tjml_topik=$tjml_topik+$cjml; 
													}		
														
											
										$html.='</details>
										
										</fieldset>
								   
								</div>
								<div class="col-md-1"><summary style="font-size: 16px;color: #377D71; text-align: center;"><b></b></summary></div>
							</div>	
						</div>';
							
			
							
				$html.=	'</div>';
				
								

			}
					return $html;
		}



		public function viewManajemen($cthn,$ckode)
		{
			
		$akses = $this->session->userdata('is_admin');	
		
		$query="SELECT DISTINCT a.id_group,b.nm_group,(SELECT COUNT(*)jml FROM ms_group_menu_elemen WHERE id_group=a.id_group 
				GROUP BY id_group) jml FROM ms_group_menu_elemen a 
				INNER JOIN ms_group b ON a.id_group=b.id_group ORDER BY a.id_group,b.nm_group";
			
			$data = $this->db->query($query)->result();
			$html = "";
			$html .='<input type="hidden" name="ptahun"  value='.$cthn.' class="form-control input-sm" id="ptahun" placeholder="">
					 <input type="hidden" name="pkdinstansi"  value='.$ckode.' class="form-control input-sm" id="pkdinstansi" placeholder="">';
			$cno = 0;
			foreach ($data as $value) {
				$cno++;
				
				$cid_group=$value->id_group;
				$cnm_group=$value->nm_group;
				$cjml=$value->jml;

			
				$abold="<b>";
				$nbold="<b>";

				$button3 = '<button style=" background-color: #ECB365; color: #F6F6F6; height:25px; width:5px;" data-toggle="dropdown"  id="btnGroupDrop1" class="btn btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
				$button_elemen = '<button style=" background-color: #ECB365; color: #F6F6F6; border-radius: 45%; height:20px; width:5px; margin-left: -45px;" data-toggle="dropdown"  id="btnGroupDrop1" class="btn btn btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
				$button_topik = '<button style=" background-color: #ECB365; color: #F6F6F6; border-radius: 45%; height:20px; width:5px; margin-left: -10px;" data-toggle="dropdown" id="btnGroupDrop1" class="btn btn btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
				$button_penilaian = '<button style="background-color: #ECB365;color: #F6F6F6;  border-radius: 45%; height:20px; width:5px; margin-left: -10px;" data-toggle="dropdown" id="btnGroupDrop1" class="btn btn btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';


				$btkunci = '<a class="list-group-item list-group-item-action showSetting-penilaian" data-tahun="'.$cthn.'" data-inst="'.$ckode.'" data-kdgroup="'.$cid_group.'" data-nmgroup="'.$cnm_group.'"><i class="fa fa-wrench" aria-hidden="true" style="color: #D36B00"></i> Setting Simpulan</a>';
				$btnadd = '<a class="list-group-item list-group-item-action showTambah-elemen" data-tahun="'.$cthn.'" data-inst="'.$ckode.'" data-kdgroup="'.$cid_group.'" data-nmgroup="'.$cnm_group.'"><i class="fa fa-plus" aria-hidden="true" style="color: #18978F"></i> Tambah Elemen</a>';
				$btnmenu = '<a class="list-group-item list-group-item-action showManajemen-menu" data-tahun="'.$cthn.'" data-inst="'.$ckode.'" data-kdgroup="'.$cid_group.'" data-nmgroup="'.$cnm_group.'"><i class="fa fa-cogs" aria-hidden="true" style="color: #F15412"></i> Atur Menu</a>';

				$btndel = '<a class="list-group-item list-group-item-action hapus-group"  data-tahun="'.$cthn.'" data-inst="'.$ckode.'" data-kdgroup="'.$cid_group.'" data-nmgroup="'.$cnm_group.'"><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus Group</a>';
				
				if($cid_group==1){
					$subbutton=$btnadd.$btnmenu.$btndel;
				}else{
					$subbutton=$btkunci.$btnmenu.$btnadd.$btndel;
				}				
				
 
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
								
									<details id="detgroup_'.$cno.'">
										<summary  style="font-size: 16px;color: #377D71; text-align: left;" data-toggle="tooltip" data-placement="top" title="Klik Detail Group"><b>'.$cno.'  :  '.$cnm_group.' </b></summary></legend><br>';
				
													$lc = "SELECT DISTINCT a.tahun,a.kd_apip,a.id_group,a.kd_elemen,b.nm_elemen FROM ms_group_menu_elemen a 
														   INNER JOIN ms_elemen b ON a.kd_elemen=b.kd_elemen WHERE a.tahun='".$cthn."' and a.kd_apip='".$ckode."' and a.id_group='".$cid_group."'
															order by a.id_group,a.kd_elemen";
													
													$query = $this->db->query($lc);
													$data=$query->result();
													$tjml_topik=0;
													$dno=0;
													foreach($data as $elemen){
													$dno=$dno+1;
													$ckdelemen=$elemen->kd_elemen;
													$cnmelemen=$elemen->nm_elemen;
													$ckode=$elemen->kd_apip;
													$cidgroup=$elemen->id_group;
													
									
													$btnadd = '<a  class="list-group-item list-group-item-action showTambah-topik"  data-tahun="'.$cthn.'" data-inst="'.$ckode.'" data-kdelemen="'.$ckdelemen.'" data-idgroup="'.$cidgroup.'"><i class="fa fa-plus" aria-hidden="true" style="color: #18978F"></i> Tambah Topik</a>';
													$btndel = '<a class="list-group-item list-group-item-action hapus-elemen"  data-tahun="'.$cthn.'" data-inst="'.$ckode.'" data-kdelemen="'.$ckdelemen.'" data-nmelemen="'.$cnmelemen.'" data-idgroup="'.$cidgroup.'"><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus Elemen</a>';
												

													$subbutton=$btnadd.$btndel;
													
													
													$aksi_elemen='<center>
															<div class="btn-group col-md-1" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
																'.$button_elemen.'
																</button><ul class="dropdown-menu" >
																<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
																	  
																	  '.$subbutton.'
																	
																</div> 
															  </div>
															
														</center>';
																	

														$html.='<div class="col-md-12"><fieldset><legend>';
														$html.=''.$aksi_elemen.'<details id="detelemen_'.$cno.'_'.$dno.'"">
																	<summary style="font-size: 14px;color: #3FA796; text-align: left; margin-left:100px"  data-toggle="tooltip" data-placement="top" title="Klik Detail Topik"><b style="margin-left: -70px;" > ELEMEN '.$elemen->kd_elemen.' : '.$elemen->nm_elemen.'</b></summary> <br>';
													
															$lctopik = "SELECT DISTINCT a.tahun,a.kd_apip,a.id_group,a.kd_elemen,a.kd_topik,b.nm_topik FROM ms_group_menu_elemen a 
																		INNER JOIN ttopik b ON a.kd_elemen=b.kd_elemen AND a.kd_topik=b.kd_topik WHERE a.tahun='".$cthn."' AND a.kd_apip='".$ckode."' AND a.kd_elemen='".$ckdelemen."' AND a.id_group='".$cidgroup."'
																		ORDER BY a.id_group,a.kd_elemen,a.kd_topik";
															
															$query = $this->db->query($lctopik);
															$data=$query->result();
												
															foreach($data as $ctopik){ 
															
																	$btndel = '<a  class="list-group-item list-group-item-action hapus-topik"  data-tahun="'.$cthn.'" data-inst="'.$ckode.'" data-kdelemen="'.$ckdelemen.'" data-kdtopik="'.$ctopik->kd_topik.'" data-nmtopik="'.$ctopik->nm_topik.'" data-group="'.$ctopik->id_group.'"><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus Topik</a>';

																	$subbutton=$btndel;
																
																$aksi_topik='<center>
																					<div class="btn-group col-md-1" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
																					'.$button_topik.'
																					</button><ul class="dropdown-menu" >
																					<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
																						  
																						  '.$subbutton.'
																						
																					</div> 
																				  </div>
																
																			</center>';
															
																$html.='<fieldset>
																				 '.$aksi_topik.'
																			<summary style="font-size: 14px;color: #DD4A48; text-align: left;" data-toggle="tooltip" data-placement="top" title="Klik Detail Level" ></button><b style="margin-left: -10px;" >TOPIK '.$ctopik->kd_topik.' : '.$ctopik->nm_topik.'</b></summary><br> ';
																			
																$html.='</fieldset> ';
																 
																 
															}					
																
															  
														$html.='</details></fieldset></div>';
														 
														//$tjml_topik=$tjml_topik+$cjml; 
													}		
														
											
										$html.='</details>
										
										</fieldset>
								   
								</div>
								<div class="col-md-1"><summary style="font-size: 16px;color: #377D71; text-align: center;"><b></b></summary></div>
							</div>	
						</div>';
							
			
							
				$html.=	'</div>';
				
								

			}
			$htmlx.=	'<div class="col-md-11" style="cursor: pointer; padding: 3px 0; color: #377D71; text-align: right;"><b>JUMLAH</b></div>
					<div class="col-md-1"><summary style="font-size: 16px;color: #377D71; text-align: left;"><b>'.$tjml_topik.'</b></summary></div>';
			return $html;
		}



		public function viewCopydata($cthn,$ckode)
		{
			
		$akses = $this->session->userdata('is_admin');	
		$tahundata='';
		
		$query="SELECT count(*)cek FROM ms_group_menu_profil where tahun=$cthn";
		$tahundata = $this->db->query($query)->row()->cek;
				
			if($tahundata>=1){
				$chk="checked";
				$persenjawab=100;
			}else{
				$chk="";
				$persenjawab=0;
			}

		
		if($persenjawab==100){
			$iconjawab='<span class="fa fa-check-square-o fa-3x" aria-hidden="true" style="color: #3CCF4E; margin-left:108%;margin-top:-5px">
							  </span>';
		}else{
			$iconjawab='<span  class="fa fa-window-close-o fa-3x" aria-hidden="true" style="color: #fc544b; margin-left:108%; margin-top:-5%">
							</span>';
		}

			
			$html = "";
			
			$html .='<input type="hidden" name="ptahun"  value='.$cthn.' class="form-control input-sm" id="ptahun" placeholder="">
					 <input type="hidden" name="pkdinstansi"  value='.$ckode.' class="form-control input-sm" id="pkdinstansi" placeholder="">';
			
			$html.='<div class="col-sm-12">
				
				 <fieldset>
						<legend style="background-color: #EDDFB3; font-size:11pt;"><b>&nbsp;</b>
							<div class="col-sm-12" >											
								
								<div class="col-sm-4">
									<label style="align:left"><b><i>Proses Copy Data Awal Tahun '.$cthn.' : </i></b>
								  
									</label>
								</div>
								
								
								 <div class="col-sm-7">
								 '.$iconjawab.'
								  <div  class="progress-bar progress-bar-striped active" role="progressbar"
										aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:'.$persenjawab.'%;margin-top:-5%;" >
									'.$persenjawab.'%
								  </div><br>
								</div>
								
							</div>
							
							
						</legend>	
				</fieldset>
				</div></details>';			
			
					
			
			return $html;
		}




		public function viewAddTopik($cthn,$cinst,$celemen,$cgroup)
		{
		
		$query = "SELECT DISTINCT a.kd_elemen,a.kd_topik,b.nm_topik FROM ms_group_menu_elemen a
				INNER JOIN ttopik b ON a.tahun=b.tahun and a.kd_apip=b.kd_apip and a.kd_elemen=b.kd_elemen AND a.kd_topik=b.kd_topik 
				where a.tahun='".$cthn."' AND a.kd_apip='".$cinst."' AND a.kd_elemen='".$celemen."' AND a.id_group='".$cgroup."' ORDER BY a.kd_topik";

			
			$data = $this->db->query($query)->result();
			$html = "";
			$isitable = "";
			$no = 0;
			$result = array();
			foreach ($data as $value) {
				$no++;
				
				$cgroup		= $cgroup;
				$ckd_elemen	= $value->kd_elemen;
				$ckd_topik	= $value->kd_topik;
				$cnm_topik	= $value->nm_topik;
				
				$isitable.='<tr>
							<td style="width:5%;text-align:center;" hidden >'.$cgroup.'</td>
							<td style="width:5%;text-align:center;" hidden >'.$ckd_elemen.'</td>
							<td style="width:5%;text-align:center;"  >'.$ckd_topik.'</td>
							<td style="width:80%;text-align:left;" >'.$cnm_topik.'</td>';
							
				$isitable.=	'
						</tr>';
						

			}
			
			
			$html.=' <form id="form-add-elemen" enctype="multipart/form-data" method="post">

						<div class="product-status mg-b-15">
							<div class="container-fluid">
								<div class="row" style="margin-top: 5px">
								
								<div class="content-form" style="display:block;">
								
	
				
								<div class="row">
									<div class="col-md-12">
									
										<div class="form-group">
											<label class="col-sm-2 control-label input-sm">Topik</label>

											<div class="col-sm-10">
														<select name="cbtopik" id="cbtopik" class="form-control input-sm" style="width:100%;">
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
																<button type="button"  class="btn-danger btn-sm tutup-topik" data-dismiss="modal"> <i class="fa fa-times-circle" aria-hidden="true"></i> TUTUP</button>
																<button type="button"  class="btn-success btn-sm simpan-topik" data-tahun="'.$cthn.'" data-inst="'.$cinst.'" data-elemen="'.$celemen.'"  data-group="'.$cgroup.'" data-nogroup="'.$cno.'" data-noelemen="'.$dno.'"><i class="fa fa-check-square"></i> SIMPAN </button>
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
																<th style="text-align:center;" hidden>id_group</th>
																	<th style="text-align:center;" hidden><b>Elemen</b></th>
																	<th style="text-align:center;"><b>Kode</b></th>
																	<th style="text-align:center;"><b>Nama Topik</b></th>																	
																	
																
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


		public function viewAddProfil($cthn,$cinst,$cgroup)
		{
		
		$query = "SELECT DISTINCT a.kd_profil,b.nm_profil FROM ms_group_menu_profil a
				  INNER JOIN ms_profil b ON a.kd_profil=b.kd_profil AND a.tahun='".$cthn."' AND a.kd_apip='".$cinst."' AND a.id_group='".$cgroup."' order by a.kd_profil";

			$data = $this->db->query($query)->result();
			$html = "";
			$isitable = "";
			$no = 0;
			$result = array();
			foreach ($data as $value) {
				$no++;
				
				$cgroup		= $cgroup;
				$ckd_profil	= $value->kd_profil;
				$cnm_profil	= $value->nm_profil;
				
				$isitable.='<tr>
							<td style="width:5%;text-align:center;" hidden >'.$cgroup.'</td>
							<td style="width:5%;text-align:center;"  >'.$ckd_profil.'</td>
							<td style="width:80%;text-align:left;" >'.$cnm_profil.'</td>';
							
				$isitable.=	'
						</tr>';
						

			}
			
			
			$html.=' <form id="form-add-profil" enctype="multipart/form-data" method="post">

						<div class="product-status mg-b-15">
							<div class="container-fluid">
								<div class="row" style="margin-top: 5px">
								
								<div class="content-form" style="display:block;">
								
	
				
								<div class="row">
									<div class="col-md-12">
									
									
				
										<div class="form-group">
											<label class="col-sm-2 control-label input-sm">Profil</label>

											<div class="col-sm-10">
														<select name="cbprofil" id="cbprofil" class="form-control input-sm" style="width:100%;">
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
																<button type="button"  class="btn-danger btn-sm tutup-profil" data-dismiss="modal"> <i class="fa fa-times-circle" aria-hidden="true"></i> TUTUP</button>
																<button type="button"  class="btn-success btn-sm simpan-profil" data-tahun="'.$cthn.'" data-inst="'.$cinst.'" data-group="'.$cgroup.'"><i class="fa fa-check-square"></i> SIMPAN </button>
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
																<th style="text-align:center;" hidden>id_group</th>
																	<th style="text-align:center;"><b>Kode</b></th>
																	<th style="text-align:center;"><b>Nama Profil</b></th>																	
																
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



		public function viewAddMenu($cgroup)
		{

			$nmgroup = $this->PublicModel->get_nama($cgroup,'nm_group','ms_group','id_group');
					
			$query = "select a.id_group,a.id_menu,b.title nm_menu,b.parent_id,b.is_parent from sys_group a
						inner join sys_menu b on a.id_menu=b.id_menu 
						where b.parent_id=0 and show_menu='1' and id_group='".$cgroup."' order by cast(a.id_menu as int),b.parent_id,b.is_parent";					
			
			$data = $this->db->query($query)->result();
			$html = "";
			$isitable = "";
			$no = 0;
			$result = array();
			foreach ($data as $value) {
				$no++;
				

				$cidmenu	= $value->id_menu;
				$cnama		= $value->nm_menu;
				$cparent_id		= $value->parent_id;
				$cis_parent	= $value->is_parent;
				
				
					$abold='<b>';
					$nbold='</b>';

			$button5 = '<a  class="list-group-item list-group-item-action hapus-menu" data-idmenu="'.$cidmenu.'"  data-idgroup="'.$cgroup.'" data-nama="'.$cnama.'" ><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus</a>';
			$subbutton=$button5;
					
			$button3 = '<button data-toggle="dropdown"  id="btnGroupDrop1P6" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';

			$aksi='<center>
						<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
							'.$button3.'
							</button><ul class="dropdown-menu" >
							<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
								  
								  '.$subbutton.'
								
							</div> 
						  </div>
						
					</center>';							
					

			

				$isitable.='<tr>
							<td style="width:5%;text-align:center;" hidden >'.$cidmenu.'</td>
							<td style="width:70%;text-align:left;"  >'.$abold.''.$cnama.''.$nbold.'</td>
							<td style="width:5%;text-align:left;"  >'.$aksi.'</td>';
							
							
			if($cis_parent==1){
			
						$query2 = "select a.id_group,a.id_menu,b.title nm_menu,b.parent_id,b.is_parent from sys_group a
									inner join sys_menu b on a.id_menu=b.id_menu 
									where b.parent_id='".$cidmenu."' and show_menu='1' and id_group='".$cgroup."' order by cast(a.id_menu as int),b.parent_id,b.is_parent";			

							$data2 = $this->db->query($query2)->result();
							
							foreach ($data2 as $value2) {
								$cidmenu2		= $value2->id_menu;
								$cnama2			= $value2->nm_menu;
								$cparent_id2	= $value2->parent_id;
								$cis_parent2	= $value2->is_parent;
								
							$button5 = '<a  class="list-group-item list-group-item-action hapus-menu" data-idmenu="'.$cidmenu2.'"  data-idgroup="'.$cgroup.'" data-nama="'.$cnama2.'"  ><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus</a>';
							$subbutton=$button5;							
							$button3 = '<button data-toggle="dropdown"  id="btnGroupDrop1P6" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';

							$aksi='<center>
										<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
											'.$button3.'
											</button><ul class="dropdown-menu" >
											<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
												  
												  '.$subbutton.'
												
											</div> 
										  </div>
										
									</center>';							
									
	
								
								
								if($cis_parent2==1){
									$abold='<b>';
									$nbold='</b>';
									$space='';
								}else{
									$abold='';
									$nbold='';
									$space='&nbsp;&nbsp;&nbsp;&nbsp;';
								}
								
								$isitable.='<tr>
											<td style="width:5%;text-align:center;" hidden >'.$cidmenu2.'</td>
											<td style="width:70%;text-align:left;"  >'.$space.''.$abold.''.$cnama2.''.$nbold.'</td>
											<td style="width:5%;text-align:left;"  >'.$aksi.'</td>';
								
								
								
								$query3 = "select a.id_group,a.id_menu,b.title nm_menu,b.parent_id,b.is_parent from sys_group a
									inner join sys_menu b on a.id_menu=b.id_menu 
									where b.parent_id='".$cidmenu2."' and show_menu='1' and id_group='".$cgroup."' order by cast(a.id_menu as int),b.parent_id,b.is_parent";			

									$data3 = $this->db->query($query3)->result();
									
									foreach ($data3 as $value3) {
										$cidmenu3		= $value3->id_menu;
										$cnama3			= $value3->nm_menu;
										$cparent_id3	= $value3->parent_id;
										$cis_parent3	= $value3->is_parent;
										$space='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	
									$button5 = '<a  class="list-group-item list-group-item-action hapus-menu" data-idmenu="'.$cidmenu3.'"  data-idgroup="'.$cgroup.'" data-nama="'.$cnama3.'"  ><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus</a>';
									$subbutton=$button5;
	
									$button3 = '<button data-toggle="dropdown"  id="btnGroupDrop1P6" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';

									$aksi='<center>
												<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
													'.$button3.'
													</button><ul class="dropdown-menu" >
													<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
														  
														  '.$subbutton.'
														
													</div> 
												  </div>
												
											</center>';							
											
										
										
										
										$isitable.='<tr>
											<td style="width:5%;text-align:center;" hidden >'.$cidmenu3.'</td>
											<td style="width:70%;text-align:left;"  >'.$space.''.$cnama3.'</td>
											<td style="width:5%;text-align:left;"  >'.$aksi.'</td>';
								
										
									}							
										
			}
				
				
			}	
							
							
				$isitable.=	'
						</tr>';
						

			}
			
			
			$html.=' <form id="form-add-menu" enctype="multipart/form-data" method="post">

						<div class="product-status mg-b-15">
							<div class="container-fluid">
								<div class="row" style="margin-top: 5px">
								
								<div class="content-form" style="display:block;">
								
	
				
								<div class="row">
									<div class="col-md-12"style="text-align:center;"><label center style="font-size: 14px;color: #18978F;"><i class="fa fa-users" aria-hidden="true"></i>
<b>'.$nmgroup.'</b></label><br>
									
									
				
										<div class="form-group">
											<label class="col-sm-2 control-label input-sm">Menu</label>

											<div class="col-sm-10">
														<select name="cbmenu" id="cbmenu" class="form-control input-sm" style="width:100%;">
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
																<button type="button"  class="btn-danger btn-sm tutup-menu" data-dismiss="modal"> <i class="fa fa-times-circle" aria-hidden="true"></i> TUTUP</button>
																<button type="button"  class="btn-success btn-sm simpan-menu" data-group="'.$cgroup.'"><i class="fa fa-check-square"></i> SIMPAN </button>
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
																<th style="text-align:center;" hidden >id_menu</th>	
																	<th style="text-align:center;"><b>Nama Menu</b></th>
																	<th style="text-align:center;"><b>Aksi</b></th>
																																	
																	
																
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



		public function viewAddElemen($cthn,$cinst,$cgroup)
		{
		
		$query = "SELECT DISTINCT a.kd_elemen,b.nm_elemen FROM ms_group_menu_elemen a
				  INNER JOIN ms_elemen b ON a.kd_elemen=b.kd_elemen AND a.tahun='".$cthn."' AND a.kd_apip='".$cinst."' AND a.id_group='".$cgroup."' order by a.kd_elemen";

			$data = $this->db->query($query)->result();
			$html = "";
			$isitable = "";
			$no = 0;
			$result = array();
			foreach ($data as $value) {
				$no++;
				
				$cgroup		= $cgroup;
				$ckd_elemen	= $value->kd_elemen;
				$cnm_elemen	= $value->nm_elemen;
				
				$isitable.='<tr>
							<td style="width:5%;text-align:center;" hidden >'.$cgroup.'</td>
							<td style="width:5%;text-align:center;"  >'.$ckd_elemen.'</td>
							<td style="width:80%;text-align:left;" >'.$cnm_elemen.'</td>';
							
				$isitable.=	'
						</tr>';
						

			}
			
			
			$html.=' <form id="form-add-elemen" enctype="multipart/form-data" method="post">

						<div class="product-status mg-b-15">
							<div class="container-fluid">
								<div class="row" style="margin-top: 5px">
								
								<div class="content-form" style="display:block;">
								
	
				
								<div class="row">
									<div class="col-md-12">
									
									
				
										<div class="form-group">
											<label class="col-sm-2 control-label input-sm">Elemen</label>

											<div class="col-sm-10">
														<select name="cbelemen" id="cbelemen" class="form-control input-sm" style="width:100%;">
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
																<button type="button"  class="btn-danger btn-sm tutup-elemen" data-dismiss="modal"> <i class="fa fa-times-circle" aria-hidden="true"></i> TUTUP</button>
																<button type="button"  class="btn-success btn-sm simpan-elemen" data-tahun="'.$cthn.'" data-inst="'.$cinst.'" data-group="'.$cgroup.'"><i class="fa fa-check-square"></i> SIMPAN </button>
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
																<th style="text-align:center;" hidden>id_group</th>
																	<th style="text-align:center;"><b>Kode</b></th>
																	<th style="text-align:center;"><b>Nama Elemen</b></th>																	
																	
																
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


		public function viewSettingPenilaian($cthn,$cinst,$cgroup)
		{
		
		$query = "SELECT DISTINCT a.kd_elemen,b.nm_elemen FROM ms_group_menu_elemen a
				  INNER JOIN ms_elemen b ON a.kd_elemen=b.kd_elemen AND a.tahun='".$cthn."' AND a.kd_apip='".$cinst."' AND a.id_group='".$cgroup."' order by a.kd_elemen";

			$data = $this->db->query($query)->result();
			$html = "";
			$isitable = "";
			$no = 0;
			$result = array();
			foreach ($data as $value) {
				$no++;
				
				$cgroup		= $cgroup;
				$ckd_elemen	= $value->kd_elemen;
				$cnm_elemen	= $value->nm_elemen;
				
				$isitable.='<tr>
							<td style="width:5%;text-align:center;" hidden >'.$cgroup.'</td>
							<td style="width:5%;text-align:center;"  >'.$ckd_elemen.'</td>
							<td style="width:80%;text-align:left;" >'.$cnm_elemen.'</td>';
							
				$isitable.=	'
						</tr>';
						

			}
			
			
			$html.=' <form id="form-add-elemen" enctype="multipart/form-data" method="post">

						<div class="product-status mg-b-15">
							<div class="container-fluid">
								<div class="row" style="margin-top: 5px">
								
								<div class="content-form" style="display:block;">
								
	
				
								<div class="row">
									<div class="col-md-12">
									
									
				
										<div class="form-group">
											<label class="col-sm-2 control-label input-sm">Elemen</label>

											<div class="col-sm-10">
														<select name="cbelemen" id="cbelemen" class="form-control input-sm" style="width:100%;">
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
																<button type="button"  class="btn-danger btn-sm tutup-elemen" data-dismiss="modal"> <i class="fa fa-times-circle" aria-hidden="true"></i> TUTUP</button>
																<button type="button"  class="btn-success btn-sm simpan-elemen" data-tahun="'.$cthn.'" data-inst="'.$cinst.'" data-group="'.$cgroup.'"><i class="fa fa-check-square"></i> SIMPAN </button>
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
																<th style="text-align:center;" hidden>id_group</th>
																	<th style="text-align:center;"><b>Kode</b></th>
																	<th style="text-align:center;"><b>Nama Elemen</b></th>																	
																	
																
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


		public function viewSimpulan($ctahun,$cinstansi,$cgroup)
		{

			$akses = $this->session->userdata('is_admin');
			$nmgroup = $this->PublicModel->get_nama($cgroup,'nm_group','ms_group','id_group');
			
		
		
			$csql = "SELECT DISTINCT b.id_group,a.kd_level,IFNULL((SELECT simpulan FROM  tsimpulan WHERE tahun=b.tahun AND kd_apip=b.kd_apip AND id_group=b.id_group AND kd_level=a.kd_level),0)kunci,
					IFNULL((SELECT IFNULL(update_at,insert_at) FROM tsimpulan WHERE tahun=b.tahun AND kd_apip=b.kd_apip AND id_group=b.id_group AND kd_level=a.kd_level),'')tanggal FROM tlevel a
					INNER JOIN ms_group_menu_elemen b ON a.tahun=b.tahun AND a.kd_apip=b.kd_apip AND a.kd_elemen=b.kd_elemen AND a.kd_topik=b.kd_topik
					WHERE a.tahun='".$ctahun."' AND a.kd_apip='".$cinstansi."'
					AND b.id_group='".$cgroup."'";
					
			$cdata = $this->db->query($csql)->result();
			
			$html = "";	
			
			$html .='<div class="container-fluid" style="margin-left: 40px"><br>
						<div class="row"><i class="fa fa-user-circle-o fa-3x" aria-hidden="true" style="color: #A27B5C;""></i><label style="font-size: 18px;color: #87805E;" style="padding-top:150px;">&nbsp;&nbsp;&nbsp; '.$nmgroup.'</label>
						</div> <input type="hidden" readonly name="cnmgroup" id="cnmgroup" value="'.$nmgroup.'" style="width:60px"; class="form-control input-sm" id="kd_apip" placeholder="">
									
					</div><hr>';
			
			
			$xno =0;	
			foreach ($cdata as $value) {
				$xno=$xno+1;
				$cid		=$value->id_group;
				$clevel		=$value->kd_level;
				$ckunci		=$value->kunci;
				$ctanggal	=$value->tanggal;
				
				if($ckunci==0){
							$chk="";
							
							
							if($ctanggal == ''){
								$cket='';
							}else{
								
								$cket='<a style="font-size:8pt"><i class="fa fa-unlock fa-1x" aria-hidden="true" style="color: #18978F"></i><i> di Buka Tanggal </i><br>'.$this->PublicModel->tanggal_waktu_indonesia($ctanggal).'</a>';
							}
							
						}else{ 

							
							$chk="checked";
							$cket='<a style="font-size:8pt"><i class="fa fa-lock fa-1x" aria-hidden="true" style="color: #DF2E2E"></i>
									<i> di Kunci Tanggal </i><br>'.$this->PublicModel->tanggal_waktu_indonesia($ctanggal).'</a>';
							
							
						} 
				
				$html .='
						<div class="container-fluid"><br>
							<div class="row">
									<div class="col-sm-12" style="margin-left: 5px">
										<div class="col-sm-2" style="margin-left: 5px"><label style="font-size: 14px;color: #1C6758;">LEVEL '.$clevel.'</label></div>
										<div class="col-sm-5" style="margin-left: 5px">											
											<label class="switch">
											  <input type="checkbox" onchange="bukakunci('.$xno.','.$cid.')" "'.$disable.'" id="ckunci_'.$xno.'" '.$chk.' value="'.$ckunci.'"> 
											  <div class="slider2"></div>
											</label>
										</div>
										<div class="col-sm-4" style="margin-left: 5px">'.$cket.'</div>
									
										
								</div>
							</div>
						</div>';
				
			}
			
							$html .='  </div> 
									</div>
								</div>
					<br><br>
						</div>
					</div>
				</div>


				 
				<div class="panel-footer">
					<center>';
					
					
					$html .='<button type="button"  onclick="kembali()" class="btn btn-danger btn-lg" ><i class="fa fa-arrow-circle-left"></i> KEMBALI</button>;
							
					</center>
					</form>
				</div>';


							return $html;
		}




		public function viewAddGroup($cthn,$cinst)
		{
		
		$query = "SELECT DISTINCT a.id_group,b.nm_group FROM ms_group_menu_elemen a
				INNER JOIN ms_group b ON a.id_group=b.id_group 
				where a.tahun='".$cthn."' AND a.kd_apip='".$cinst."' order by a.id_group";

			$data = $this->db->query($query)->result();
			$html = "";
			$isitable = "";
			$no = 0;
			$result = array();
			foreach ($data as $value) {
				$no++;
				
				
				$cid_group	= $value->id_group;
				$cnm_group	= $value->nm_group;
				
				$isitable.='<tr>
							<td style="width:5%;text-align:center;" hidden>'.$cid_group.'</td>
							<td style="width:5%;text-align:center;">'.$no.'</td>
							<td style="width:80%;text-align:left;">'.$cnm_group.'</td>';
							
				$isitable.=	'
						</tr>';
						

			}
			
			
			$html.=' <form id="form-add-group" enctype="multipart/form-data" method="post">

						<div class="product-status mg-b-15">
							<div class="container-fluid">
								<div class="row" style="margin-top: 5px">
								
								<div class="content-form" style="display:block;">
								
	
				
								<div class="row">
									<div class="col-md-12">
									
									
				
										<div class="form-group">
											<label class="col-sm-2 control-label input-sm">Group</label>

											<div class="col-sm-10">
														<select name="cbgroup" id="cbgroup" class="form-control input-sm" style="width:100%;">
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
																<button type="button"  class="btn-danger btn-sm tutup-group" data-dismiss="modal"> <i class="fa fa-times-circle" aria-hidden="true"></i> TUTUP</button>
																<button type="button"  class="btn-success btn-sm simpan-group" data-tahun="'.$cthn.'" data-inst="'.$cinst.'"><i class="fa fa-check-square"></i> SIMPAN </button>
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
												
													<table id="E-Group" class="table table-bordered table-striped" style="width:100%" border="0">
														<thead>
															<tr>
																<th style="text-align:center;" hidden>id_group</th>
																	<th style="text-align:center;"><b>No</b></th>
																	<th style="text-align:center;"><b>Nama Group</b></th>																	
																	
																
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



		public function viewAddGroupProfil($cthn,$cinst)
		{
		
		$query = "SELECT DISTINCT a.id_group,b.nm_group FROM ms_group_menu_profil a
				INNER JOIN ms_group b ON a.id_group=b.id_group 
				where a.tahun='".$cthn."' AND a.kd_apip='".$cinst."' order by a.id_group";

			$data = $this->db->query($query)->result();
			$html = "";
			$isitable = "";
			$no = 0;
			$result = array();
			foreach ($data as $value) {
				$no++;
				
				
				$cid_group	= $value->id_group;
				$cnm_group	= $value->nm_group;
				
				$isitable.='<tr>
							<td style="width:5%;text-align:center;" hidden>'.$cid_group.'</td>
							<td style="width:5%;text-align:center;">'.$no.'</td>
							<td style="width:80%;text-align:left;">'.$cnm_group.'</td>';
							
				$isitable.=	'
						</tr>';
						

			}
			
			
			$html.=' <form id="form-add-group" enctype="multipart/form-data" method="post">

						<div class="product-status mg-b-15">
							<div class="container-fluid">
								<div class="row" style="margin-top: 5px">
								
								<div class="content-form" style="display:block;">
								
	
				
								<div class="row">
									<div class="col-md-12">
									
									
				
										<div class="form-group">
											<label class="col-sm-2 control-label input-sm">Group</label>

											<div class="col-sm-10">
														<select name="cbgroup" id="cbgroup" class="form-control input-sm" style="width:100%;">
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
																<button type="button"  class="btn-danger btn-sm tutup-group-profil" data-dismiss="modal"> <i class="fa fa-times-circle" aria-hidden="true"></i> TUTUP</button>
																<button type="button"  class="btn-success btn-sm simpan-group-profil" data-tahun="'.$cthn.'" data-inst="'.$cinst.'"><i class="fa fa-check-square"></i> SIMPAN </button>
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
												
													<table id="E-Group" class="table table-bordered table-striped" style="width:100%" border="0">
														<thead>
															<tr>
																<th style="text-align:center;" hidden>id_group</th>
																	<th style="text-align:center;"><b>No</b></th>
																	<th style="text-align:center;"><b>Nama Group</b></th>																	
																	
																
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
			$this->db->insert('ms_group_menu_elemen', $data);
			return true;
		}

		public function add_elemen($data){
			$this->db->insert('ms_group_menu_elemen', $data);
			return true;
		}

		public function add_menu($data){
			$this->db->insert('sys_group', $data);
			return true;
		}

		public function add_profil($data){
			$this->db->insert('ms_group_menu_profil', $data);
			return true;
		}


		public function add_group($data){
			$this->db->insert('ms_group_menu_elemen', $data);
			return true;
		}


		public function add_group_profil($data){
			$this->db->insert('ms_group_menu_profil', $data);
			return true;
		}

		public function listGroup($cthn,$cinst)
		{

			$sql = "select  a.id_group,a.nm_group from  ms_group a WHERE a.id_group not in(select ifnull(id_group,'') from ms_group_menu_elemen where tahun='".$cthn."' and kd_apip='".$cinst."')
					order by id_group"; 
					
			$data=$this->db->query($sql);
			$html ='<option value="" disabled selected hidden> Pilih Group </option>';
			foreach ($data->result_array() as $value) {
				$html .='<option value="'.$value['id_group'].'"> '.$value['id_group'].' | '.$value['nm_group'].'</option>';
			}

			return $html;
			
			
		}


		public function listGroupProfil($cthn,$cinst)
		{

			$sql = "select  a.id_group,a.nm_group from  ms_group a WHERE a.id_group not in(select ifnull(id_group,'') from ms_group_menu_profil where tahun='".$cthn."' and kd_apip='".$cinst."')
					order by id_group"; 
					
			$data=$this->db->query($sql);
			$html ='<option value="" disabled selected hidden> Pilih Group </option>';
			foreach ($data->result_array() as $value) {
				$html .='<option value="'.$value['id_group'].'"> '.$value['id_group'].' | '.$value['nm_group'].'</option>';
			}

			return $html;
			
			
		}


		public function listProfil($cthn,$cinst,$cgroup)
		{

			$sql = "SELECT DISTINCT a.kd_profil,a.nm_profil FROM  ms_profil a  WHERE a.tahun='".$cthn."' 
					AND a.kd_profil NOT IN(SELECT IFNULL(kd_profil,'') FROM ms_group_menu_profil WHERE id_group='".$cgroup."' AND tahun='".$cthn."' AND kd_apip='".$cinst."')
					ORDER BY kd_profil";
					
			$data=$this->db->query($sql);
			$html ='<option value="" disabled selected hidden> Pilih Profil </option>';
			foreach ($data->result_array() as $value) {
				$html .='<option value="'.$value['kd_profil'].'"> '.$value['kd_profil'].' | '.$value['nm_profil'].'</option>';
			}

			return $html;
			
			
		}



		public function listMenu($cgroup)
		{

			$sql = "SELECT*FROM (
				SELECT id_menu,nm_menu,
				CASE WHEN parent_id=0 THEN id_menu
				ELSE parent_id END AS xx,is_parent,nm_parent FROM(
				SELECT a.id_menu,a.title nm_menu,a.parent_id,a.is_parent,IFNULL((SELECT title FROM sys_menu WHERE id_menu=a.parent_id),'')nm_parent FROM sys_menu a
				WHERE a.id_menu NOT IN(SELECT id_menu FROM sys_group WHERE id_group='".$cgroup."') AND show_menu=1
				)z
				)zz ORDER BY xx,CAST(id_menu AS INT)"; 
					
			$data=$this->db->query($sql);
			$html ='<option value="" disabled selected hidden> Pilih Menu </option>';
			foreach ($data->result_array() as $value) {
				
				if($value['nm_parent']==''){
					$html .='<option value="'.$value['id_menu'].'"> '.$value['nm_menu'].'</option>';
				}else{
					$html .='<option value="'.$value['id_menu'].'"> '.$value['nm_parent'].'  -- > '.$value['nm_menu'].'</option>';
				}
				
			}

			return $html;
			
			
		}


		

		public function listElemen($cthn,$cinst,$cgroup)
		{

			$sql = "select distinct a.kd_elemen,b.nm_elemen from ttopik a
					inner join ms_elemen b on a.kd_elemen=b.kd_elemen WHERE a.tahun='".$cthn."' and a.kd_apip='".$cinst."'
					and a.kd_elemen not in(select ifnull(kd_elemen,'') from ms_group_menu_elemen where id_group='".$cgroup."' and tahun='".$cthn."' and kd_apip='".$cinst."')
					order by kd_elemen"; 
					
			$data=$this->db->query($sql);
			$html ='<option value="" disabled selected hidden> Pilih Elemen </option>';
			foreach ($data->result_array() as $value) {
				$html .='<option value="'.$value['kd_elemen'].'"> '.$value['kd_elemen'].' | '.$value['nm_elemen'].'</option>';
			}

			return $html;
			
			
		}




		public function listTopik($cthn,$cinst,$celemen,$cgroup)
		{

			$sql = "select distinct a.kd_topik,a.nm_topik from ttopik a
					WHERE a.tahun='".$cthn."' and a.kd_apip='".$cinst."' and a.kd_elemen='".$celemen."'
					and a.kd_topik not in(select ifnull(kd_topik,'') from ms_group_menu_elemen where id_group='".$cgroup."' and tahun='".$cthn."' and kd_apip='".$cinst."' and kd_elemen='".$celemen."')
					order by kd_topik"; 
					
					
			$data=$this->db->query($sql);
			$html ='<option value="" disabled selected hidden> Pilih Topik </option>';
			foreach ($data->result_array() as $value) {
				$html .='<option value="'.$value['kd_topik'].'"> '.$value['kd_topik'].' | '.$value['nm_topik'].'</option>';
			}

			return $html;
			
			
		}



	    private function _get_all_apip_query($daerah)
	    {
	    	$akses = $this->session->userdata('is_admin');
			$tahun = $this->session->userdata('year_selected');
	    	
	    	
			
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

		public function insertSimpulan($data){
			$this->db->insert('tsimpulan', $data);
			return true;
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
		
		
		public function insertHistory($data){
			$this->db->insert('thistory', $data);
			return true;
		}	

	}

?>