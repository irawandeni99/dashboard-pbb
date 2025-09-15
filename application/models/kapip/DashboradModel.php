

<?php
	class DashboradModel extends CI_Model{

		/* var $table = 'tapip a'; //nama tabel dari database
	    var $column_order = array(null,'tapip.kd_apip','tapip.tahun'); //field yang ada di table 
	    var $column_search = array('tapip.tahun','tapip.kd_apip','ms_apip.nm_apip'); //field yang diizin untuk pencarian 
	    var $order = array('tapip.tahun' => 'asc'); // default order 
	    var $order2 = array('tapip.kd_apip' => 'asc'); // default order 
 */
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


    function get_all_apip($daerah)
	    {
	        $this->_get_all_apip_query($daerah);
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }


	    private function _get_all_apip_query($daerah)
	    {
	    	$akses = $this->session->userdata('is_admin');
			$tahun = $this->session->userdata('year_selected');
			$instansi = $this->session->userdata('id_instansi');
	    	
			if($akses !== 1){
				
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
		}	


	    public function get_maxlamp($ctahun,$cinstansi,$celemen,$clevel,$ckdtopik,$ckdpenilaian)
	    {
			
		$sql = "SELECT IFNULL(MAX(kd_file),0)+1 fnext FROM tpenilaian_lamp WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' and kd_topik='".$ckdtopik."' AND kd_level='".$clevel."' AND kd_penilaian='".$ckdpenilaian."'";	
				$kdfield = $this->db->query($sql)->row()->fnext;	
				return $kdfield;
		}


		public function insertLampiran($data){
			$this->db->insert('tpenilaian_lamp', $data);
			return true;
		}


		public function insertSimpulan($data){
			$this->db->insert('tsimpulan', $data);
			return true;
		}


		public function viewPengawasan($cthn,$ckode)
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
 
 

			$html.='<div id='.$cno.' style="margin-left: -20px;">
								
							
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
										
													foreach($data as $topik){
													
													
													$btnadd = '<a  class="list-group-item list-group-item-action showTambah-level"  data-tahun="'.$cthn.'" data-inst="'.$ckode.'" data-kdelemen="'.$ckdelemen.'" data-kdtopik="'.$topik->kd_topik.'" ><i class="fa fa-plus" aria-hidden="true" style="color: #18978F"></i> Tambah Level</a>';
													$btnedit = '<a  class="list-group-item list-group-item-action showEdit-topik"  data-tahun="'.$cthn.'" data-inst="'.$ckode.'" data-kdelemen="'.$ckdelemen.'" data-kdtopik="'.$topik->kd_topik.'" ><i class="fa fa-pencil-square-o" aria-hidden="true" style="color: #F15412"></i> Edit Topik</a>';
													$btndel = '<a  class="list-group-item list-group-item-action hapus-topik"  data-tahun="'.$cthn.'" data-inst="'.$ckode.'" data-kdelemen="'.$ckdelemen.'" data-kdtopik="'.$topik->kd_topik.'" data-nmtopik="'.$topik->nm_topik.'" ><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus Topik</a>';
													

													$subbutton=$btnadd.$btnedit.$btndel;
													
													
													$aksi_topik='<center>
															<div class="btn-group col-md-1" align="left" role="group" aria-label="Button group with nested dropdown">  						  
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
																			
													

																			$lcpenilaian = "SELECT distinct kd_penilaian,uraian FROM tpenilaian WHERE tahun='".$cthn."' and kd_apip='".$ckode."' and kd_elemen='".$ckdelemen."' and kd_topik='".$clevel->kd_topik."' and kd_level='".$clevel->kd_level."'";
																			$query = $this->db->query($lcpenilaian);
																			$data=$query->result();
																				$cno_nilai=0;
																			foreach($data as $cpenilaian){
																				$cno_nilai=$cno_nilai+1;																				

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
																							<summary style="font-size: 13px;color: #5F7161; text-align: left; " data-toggle="tooltip" data-placement="top" title="Klik Detail Penilaian"><div class="col-md-1">'.$aksi_penilaian.'</div><div class="col-md-2"><b style="margin-left: -10px;">PENILAIAN </b>'.$cno_nilai.'  </div>
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
														 
														 
													}		
														
											
										$html.='</details>
										
										</fieldset>
								   
								</div>
								<div class="col-md-1"><summary style="font-size: 16px;color: #377D71; text-align: center;"><b>'.$cjml_topik.'</b></summary></div>
							</div>	
						</div>';
							
			
							
				$html.=	'</div>';
						

			}
			
			return $html;
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
 
 

			$html.='<div id='.$cno.' style="margin-left: -20px;">
								
							
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
										
													foreach($data as $topik){
													
													
													$btnadd = '<a  class="list-group-item list-group-item-action showTambah-level"  data-tahun="'.$cthn.'" data-inst="'.$ckode.'" data-kdelemen="'.$ckdelemen.'" data-kdtopik="'.$topik->kd_topik.'" ><i class="fa fa-plus" aria-hidden="true" style="color: #18978F"></i> Tambah Level</a>';
													$btnedit = '<a  class="list-group-item list-group-item-action showEdit-topik"  data-tahun="'.$cthn.'" data-inst="'.$ckode.'" data-kdelemen="'.$ckdelemen.'" data-kdtopik="'.$topik->kd_topik.'" ><i class="fa fa-pencil-square-o" aria-hidden="true" style="color: #F15412"></i> Edit Topik</a>';
													$btndel = '<a  class="list-group-item list-group-item-action hapus-topik"  data-tahun="'.$cthn.'" data-inst="'.$ckode.'" data-kdelemen="'.$ckdelemen.'" data-kdtopik="'.$topik->kd_topik.'" data-nmtopik="'.$topik->nm_topik.'" ><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus Topik</a>';
													

													$subbutton=$btnadd.$btnedit.$btndel;
													
													
													$aksi_topik='<center>
															<div class="btn-group col-md-1" align="left" role="group" aria-label="Button group with nested dropdown">  						  
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
																			
													

																			$lcpenilaian = "SELECT distinct kd_penilaian,uraian FROM tpenilaian WHERE tahun='".$cthn."' and kd_apip='".$ckode."' and kd_elemen='".$ckdelemen."' and kd_topik='".$clevel->kd_topik."' and kd_level='".$clevel->kd_level."'";
																			$query = $this->db->query($lcpenilaian);
																			$data=$query->result();
																				$cno_nilai=0;
																			foreach($data as $cpenilaian){
																				$cno_nilai=$cno_nilai+1;																				

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
																							<summary style="font-size: 13px;color: #5F7161; text-align: left; " data-toggle="tooltip" data-placement="top" title="Klik Detail Penilaian"><div class="col-md-1">'.$aksi_penilaian.'</div><div class="col-md-2"><b style="margin-left: -10px;">PENILAIAN </b>'.$cno_nilai.'  </div>
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
														 
														 
													}		
														
											
										$html.='</details>
										
										</fieldset>
								   
								</div>
								<div class="col-md-1"><summary style="font-size: 16px;color: #377D71; text-align: center;"><b>'.$cjml_topik.'</b></summary></div>
							</div>	
						</div>';
							
			
							
				$html.=	'</div>';
						

			}
			
			return $html;
		}



		public function viewElemen1($ctahun,$cinstansi,$clevel)
		{
			
			$celemen=1;
			$akses = $this->session->userdata('is_admin');
			
	    	
			if($akses == 1){
				$disable_verif='';
				$hidden_verif='';
				
			}else{
				
				$disable_verif='disabled';
				$hidden_verif='hidden';
				
			}


			$query = "SELECT simpulan,(select ifnull(MAX(kd_level),0) FROM tsimpulan WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND simpulan='1')maxsimpul from tsimpulan WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND  kd_level='".$clevel."'";
			$data = $this->db->query($query)->result();
						
			foreach ($data as $value) {

				$csimpulan=$value->simpulan;
				$cmaxsimpul=$value->maxsimpul;

			}
			
			if($csimpulan==1){
				
				$disable="disabled";
				$cinfo ="( Read Only )";
			}else{
				
				$disable="";
				$cinfo ="";
			} 			
					
			$query="SELECT DISTINCT a.kd_topik,b.nm_topik,IFNULL(a.simpulan_pemenuhan,0)simpulan_pemenuhan
			FROM tlevel a INNER JOIN ttopik b ON a.tahun=b.tahun AND a.kd_apip=b.kd_apip
					AND a.kd_elemen=b.kd_elemen AND a.kd_topik=b.kd_topik WHERE a.tahun='".$ctahun."' AND a.kd_apip='".$cinstansi."' AND a.kd_elemen='".$celemen."' AND a.kd_level='".$clevel."'
					ORDER BY kd_topik";	
				
			$data = $this->db->query($query)->result();
			
			$html = "";
			



				$html .='<div class="row">
									<div class="col-md-12">
										<div class="product-status mg-b-15">
											<div class="container-fluid">
												<div class="row">
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
														<div class="product-status-wrap">';
														
														
			
			$html .='<input type="hidden" name="ptahun"  value='.$ctahun.' class="form-control input-sm" id="ptahun">
					 <input type="hidden" name="pkdinstansi"  value='.$cinstansi.' class="form-control input-sm" id="pkdinstansi">';
			$cno = 0;
			$xno = 0; 
			foreach ($data as $value) {
				$cno++;
				
				$ckd_topik=$value->kd_topik;
				$cnm_topik=$value->nm_topik;
				$csimpulan_pemenuhan=$value->simpulan_pemenuhan;
				
				
				if($csimpulan_pemenuhan==1){
						$chksimpul="checked";
					}else{
						$chksimpul="";
					} 
					
					
		$sql = "SELECT acc,nacc,(acc+nacc)jml,((acc/(acc+nacc))*100)persen FROM(
				SELECT SUM(acc)acc,SUM(nacc)nacc FROM(
				SELECT COUNT(*)acc,0 nacc FROM tpenilaian WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' and kd_topik='".$ckd_topik."' AND kd_level='".$clevel."' AND jawaban=1
				UNION
				SELECT 0 acc,COUNT(*)nacc FROM tpenilaian WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' and kd_topik='".$ckd_topik."' AND kd_level='".$clevel."' AND jawaban=0
				)z)zz";
				
		$persenjawab = $this->db->query($sql)->row()->persen;	
		
		$persenjawab=number_format($persenjawab, "0", ",", ".");
		
		if($persenjawab==100){
			$iconjawab='<span class="fa fa-check-square-o fa-3x" aria-hidden="true" style="color: #3CCF4E; margin-left:108%;margin-top:-5px">
							  </span>';
		}else{
			$iconjawab='<span  class="fa fa-window-close-o fa-3x" aria-hidden="true" style="color: #fc544b; margin-left:108%; margin-top:-5%">
							</span>';
		}
			

	
				$html .='<input type="hidden" name="hkd_topiksimpulE1_'.$cno.'"  value='.$ckd_topik.' class="form-control input-sm" id="hkd_topiksimpulE1_'.$cno.'">';
				
				$html.='<div class="col-md-12"><br> 
								<h3 class="panel-title"><i class="fa fa-ravelry" ></i>  <b> <lebel id="lbtopik" style="text-align: left;">Topik '.$cno.' : '.$cnm_topik.'</label></b> </h3>
						<br></div>';
				
						$query2="select *from tpenilaian WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' AND kd_level='".$clevel."' and kd_topik='".$ckd_topik."'
								ORDER BY kd_penilaian";	
							
						$data2 = $this->db->query($query2)->result();
						
							$dno=0;
							$xpilihan='';
							foreach ($data2 as $value2) {
								$dno++;
								$xno++;
								
								$ckd_elemen=$value2->kd_elemen;
								$ckd_penilaian=$value2->kd_penilaian;
								$curaian=$value2->uraian;
								$cpenjelasan=$value2->penjelasan;
								$cbukti=$value2->bukti;
								$clangkah=$value2->langkah;
								$cjawaban=$value2->jawaban;
								$cverifikasi=$value2->verifikasi;
								$cverif_at=$value2->verif_at;
								$cuser_verif=$value2->user_verif;
								$catatan=$value2->catatan;
								
								$chpoin=$value2->hpoin;
								$cdpoin=$value2->dpoin;
								
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
								
								
						
								
								if($cverifikasi==1){  // tidak sesuai
									$color="red";
									$cinfo_verif='di Verifikasi tanggal';
									$cverif_at=$this->PublicModel->tanggal_waktu_indonesia($cverif_at); //$disable=$cverifikasi;
									
									if($csimpulan==1){
										$disable='disabled';
									}else{
										$disable='';
									}
									
									
									
								}else if($cverifikasi==2){  // sesuai
									$color="green";
									$cinfo_verif='di Verifikasi tanggal';
									$cverif_at=$this->PublicModel->tanggal_waktu_indonesia($cverif_at);
									$disable='disabled';
									
									
									
								}else{
									$color="black";
									$cinfo_verif='';
									$cverif_at=''; //$disable=$cverifikasi;
									if($csimpulan==1){
										$disable='disabled';
									}else{
										$disable='';
									}
								}
								
								
								if($cjawaban==1){
									$chk="checked";
								}else{
									$chk="";
								} 
								
								
								if($cuser_verif==null){
									
									$divhidden="hidden";
								}else{
									$divhidden="";
								}
								
								
								
								
								$search = array("/", " ", ":", "*", "?", "&#34;", "<", ">",".");
								$searchdok = array("/", " ", ":", "*", "?", "&#34;", "<", ">", "|");
								$replace = array("_", "_", "_", "_", "_", "_", "_", "_", "_");
							
								$ctahun 		= str_replace($search, $replace, $ctahun);
								$cinstansi 		= str_replace($search, $replace, $cinstansi);
								$celemen 		= str_replace($search, $replace, $ckd_elemen);
								$clevel 		= str_replace($search, $replace, $clevel);
								$ckdtopik 		= str_replace($search, $replace, $ckd_topik);
								$ckdpenilaian 	= str_replace($search, $replace, $ckd_penilaian);
								
								
						
								$folder5		= 'assets/file_upload/ekapip_dokumen/'.$ctahun.'/'.'Instansi'.$cinstansi.'/'.'Elemen'.$celemen.'/'.'Level'.$clevel.'/'.'Topik'.$ckdtopik.'/'.'Penilaian'.$ckdpenilaian.'/';

								$cdokumen=$value2->dokumen;

								$xno2='1';
										
								$html .='<input type="hidden" name="hkd_topikE1_'.$xno.'"  value='.$ckdtopik.' class="form-control input-sm" id="hkd_topikE1_'.$xno.'">';
								$html .='<input type="hidden" name="hkd_penilaianE1_'.$xno.'"  value='.$ckdpenilaian.' class="form-control input-sm" id="hkd_penilaianE1_'.$xno.'">';
							
							
								if($cpenjelasan==''){
									
									$html.='<div class="col-md-12" style="margin-left: 25px"> <br>
								
											
												<fieldset>
														<details>

															<summary style="font-size: 13px;color: black; text-align: left; " data-toggle="tooltip" data-placement="top" title="Klik Penjelasan Pemenuhan Topik Penilaian KAPIP">
																
																<div class="col-md-11" style="margin-left: 25px; cursor: pointer;"> 
																		<div class="col-md-1"><lebel style="text-align: left;">'.$cpoin.'</label></div> 
																		<div class="col-md-11" style="margin-left: -5%"><lebel style="text-align: left;">'.$curaian.'</label></div><br>	 
																</div> 
															</summary> 
															
															
													</details>		
												</fieldset>		
										
										</div>'; 	
									
									
								}else{
							
									$html.='<div class="col-md-12" style="margin-left: 25px"> <br>
											<fieldset>
													<details>

														<summary style="font-size: 13px;color: black; text-align: left; " data-toggle="tooltip" data-placement="top" title="Klik Penjelasan Pemenuhan Topik Penilaian KAPIP">
															<div class="col-md-11" style="margin-left: 25px; cursor: pointer;"> 
																	<div class="col-md-1"><lebel style="text-align: left;">'.$cpoin.'</label></div> 
																	<div class="col-md-11" style="margin-left: -5%"><lebel style="text-align: left;">'.$curaian.'</label> <i class="fa fa-caret-square-o-down fa-lg" style="color: #18978F;" ></i><br><br></div>															</div> 
														</summary> 
														
														<div class="col-md-11" style="margin-left: 45px"> 
																	<lebel style="text-align: left; font-size: 14px;color: #18978F;"><b>Penjelasan Uraian Aspek</b></label>
																	<textarea style="font-size:10pt;" class="form-control" readonly  rows="4">'.$cpenjelasan.'</textarea>
															<br>
														</div>
														
														<div class="col-md-11" style="margin-left: 45px"> 
																	<lebel style="text-align: left; font-size: 14px;color: #18978F;"><b>Contoh Bukti Dukung</b></label>
																	<textarea style="font-size:10pt;" class="form-control" readonly rows="4">'.$cbukti.'</textarea>
																	
															<br>
														</div>
														
												</details>		
											</fieldset>			
										
											
											<div class="col-sm-5" style="margin-left: 35px">											
												<label class="switch">
												  <input type="checkbox" onchange="checkPilihan()" '.$disable.' id="cpilihanE1_'.$xno.'" '.$chk.' value='.$cjawaban.'>
												  <div class="slider"></div>
												</label>
											</div>
											

										</div>'; 
							
							
							
								
							
							
							if($csimpulan==1){
									$btnE1_upl ='';
								}else{
									$xno2=1;
									$btnE1_upl 		= '<a class="list-group-item list-group-item-action "  onclick="uploadFileE1('.$celemen.','.$xno.','.$xno2.')"; ><i class="fa fa-cloud-upload fa-1x" aria-hidden="true" style="color: #006E7F" ></i> Upload File</a>';
								
									
								}
								
									$button3 		= '<button data-toggle="dropdown"  id="btnGroupDrop1" class="btn btn-info btn-sm dropdown-toggle '.$disable.'" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';									
									$subbutton=$btnE1_upl;
									
							
							
									$aksi='<center>
										<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
											'.$button3.'
											</button><ul class="dropdown-menu" >
											<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
												  
												  '.$subbutton.'
												
											</div> 
										  </div>
										
									</center>';
							
							
							
							$sql = "SELECT IFNULL(MAX(kd_file),0)+1 fnext FROM tpenilaian_lamp WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' and kd_topik='".$ckdtopik."' AND kd_level='".$clevel."' AND kd_penilaian='".$ckdpenilaian."'";	
							$kdfield = $this->db->query($sql)->row()->fnext;	
							
							if($kdfield==1){ // data baru
								
								if($csimpulan==1){
									$btnE1_upl ='';
								}else{
									$btnE1_upl 		= '<a class="list-group-item list-group-item-action "  onclick="uploadFileE1('.$celemen.','.$xno.','.$xno2.')"; ><i class="fa fa-cloud-upload fa-1x" aria-hidden="true" style="color: #006E7F" ></i> Upload File</a>';
								
									
								}
								
									$button3 		= '<button data-toggle="dropdown"  id="btnGroupDrop1" class="btn btn-info btn-sm dropdown-toggle '.$disable.'" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';									
									$subbutton=$btnE1_upl;
									
							
							
									$aksi='<center>
										<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
											'.$button3.'
											</button><ul class="dropdown-menu" >
											<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
												  
												  '.$subbutton.'
												
											</div> 
										  </div>
										
									</center>';		
												
								
						$html.='<div class="col-sm-8" style="margin-left: 80px;">
									<table id="xx" class="table table-bordered table-striped" style="width:100%;" border="0">
										<tbody id="data-profil-1">
										
										<thead>
											<tr>
												
												<th style="text-align:center;width:250px;color:black"><b>FILE UPLOAD</b></th>
												<th style="text-align:center;width:500px;color:black"><b>KETERANGAN</b></th>
												<th style="text-align:center;width:10px;"></th>
												
											</tr>
										</thead>';
										
										
										
										
												$xno2='1';
									
											$html.='<tr>
														<td style="width:30px">		
															<input type="file" name="fileuploadE1_'.$xno.'_'.$xno2.'" id="fileuploadE1_'.$xno.'_'.$xno2.'" value="" onchange="validateFormat(this,'.$celemen.','.$xno.','.$xno2.')" />
														</td>
																			
														<td>
															<textarea  style="font-size:10pt;display : none;" class="form-control"  id="uraianE1_'.$xno.'_'.$xno2.'" name="uraianE1_'.$xno.'_'.$xno2.'" rows="2"></textarea>

														</td>				 
																			
														<td>
															'.$aksi.'
														</td>
														
													</tr>';				
				
											
									$html.='
											
									</tbody>
							</table>
						</div>	
				
						
						<div class="col-sm-3"> 
									<div class="col-sm-12"><a><b>VERIFIKASI DATA</b></a>

										 <select '.$disable_verif.' name="cverifikasiE1_'.$xno.'" id="cverifikasiE1_'.$xno.'" class="form-control input-sm" onchange="verifikasi('.$celemen.','.$xno.')" style="color:'.$color.'">
											<option value="0" ></option>
											<option style="color:red" value="1" >TIDAK SESUAI</option>
											<option style="color:green" value="2" >SESUAI</option>
										  </select><br>
									</div>
									
									<script>
										$("#cverifikasiE1_"+'.$xno.').val('.$cverifikasi.');
										$("#cverifikasiE1_"+'.$xno.').select2().trigger("change"); 
									</script>
									
									
									<div id="divCatatanE1_'.$xno.'" class="col-sm-12" '.$divhidden.'><a><b>CATATAN</b></a>
										<textarea  '.$disable_verif.' style="font-size:10pt;" class="form-control"  id="catatanE1_'.$xno.'" name="catatanE1_'.$xno.'" rows="4">'.$catatan.'</textarea>
										
										<div '.$hidden_verif.'><br>
											<button type="button" hidden class="btn btn-success btn-lg simpan-verif" data-elemen="'.$celemen.'" data-topik="'.$ckdtopik.'" data-penilaian="'.$ckd_penilaian.'" data-nomor="'.$xno.'" hidden><i class="fa fa-check-square"></i> VERIFIKASI</button>
											</div><i style="font-size:8pt;">'.$cinfo_verif.'<br>'.$cverif_at.'</i>
									
									</div>
									
								
								</div>';				
														

							
						
								
										
								
								
							}else{     // data sudah ada
									
								
							
								$query3="select *from tpenilaian_lamp WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' AND kd_level='".$clevel."' and kd_topik='".$ckd_topik."' and kd_penilaian='".$ckd_penilaian."'
										 ORDER BY kd_penilaian";	
								
								$data3 = $this->db->query($query3)->result();
							
								$cno3=0;
								
								$html.='<div class="col-sm-8" style="margin-left: 80px;">
											<table id="xx" class="table table-bordered table-striped" style="width:100%;" border="0">
												<tbody id="data-profil-1">
												
												<thead>
													<tr>
														
														<th style="text-align:center;width:250px;color:black"><b>FILE UPLOAD</b></th>
														<th style="text-align:center;width:500px;color:black"><b>KETERANGAN</b></th>
														<th style="text-align:center;width:10px;"></th>
														
													</tr>
												</thead>';
												
												
												
								
								foreach ($data3 as $value3) {
									$cno3++;
									
									$ctahun=$value3->tahun;
									$cinstansi=$value3->kd_apip;
									$celemen=$value3->kd_elemen;
									$ctopik=$value3->kd_topik;
									$clevel=$value3->kd_level;
									$cpenilaian=$value3->kd_penilaian;
									$cfile=$value3->kd_file;
									$cnmfile=$value3->nm_file;
									$cinformasi=$value3->uraian;
									$ctanggal=$this->PublicModel->tanggal_waktu_indonesia($value3->insert_at);
							
									
							
									$clink			= "<a href='".base_url().$folder5.$value3->nm_file."' target= '_blank' class='list-group-item list-group-item-action' ><i class='fa fa-file-text-o fa-1x' aria-hidden='true' style='color: #069A8E'></i> Lihat File</a>";
					
									$btnE1_View = $clink;
									
									$clink2			= "<a href='".base_url().$folder5.$value3->nm_file."' target= '_blank' class='list-group-item list-group-item-action' ><i class='fa fa-file-text-o fa-1x' aria-hidden='true' style='color: #069A8E'></i></a>";
				
		
									$aa="hapusFileE1('".$ctahun."','".$cinstansi."','".$celemen."','".$ctopik."','".$clevel."','".$cpenilaian."','".$cfile."','".$cnmfile."')";
								
										if($csimpulan==1){
											$btnE1_Del = '';
										}else{
											
											if($cverifikasi==2){
													$btnE1_Del = '';
											}else{
												
													$btnE1_Del = '<a class="list-group-item list-group-item-action" onclick='.$aa.' ><i class="fa fa-trash-o fa-1x" aria-hidden="true" style="color: #EB1D36"></i> Hapus File</a>';
	
											}
											
																			
										}
									
											$button3 = '<button data-toggle="dropdown"  id="btnGroupDrop1" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
			
											$subbutton=$btnE1_View.$btnE1_Del;
									
											$aksi='<left>
														<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
															'.$button3.'
															</button><ul class="dropdown-menu" >
															
															<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>																  
																  '.$subbutton.'
															</div> 
														</div>
												
													</left>';		
													
											
												if($cno3==1){
													
													$margin='style="margin-top: -30px"';
													$marginaksi='style="margin-left: -25px;margin-top: -3px;"';
													$br ="";
												}else{
													
													$margin='style="margin-top: -55px"';
													$marginaksi='style="margin-left: -25px;margin-top: -25px;"';
													$br ="<br>";
													
												}
												
												$html.='
															<div class="col-sm-5" style="margin-left: 35px">
																	&nbsp;
															</div>';
								
												$cinput='';
								
										$html.='<tr>
													<td style="width:30px">	
														<div class="col-sm-3">	
														
														
															<a href='.base_url().$folder5.$value3->nm_file.' target= "_blank" title="Lihat File"> <i class="fa fa-file-pdf-o fa-3x" style="color: #EB1D36" aria-hidden="true"></i></a>

														</div>
															<div class="col-sm-9">	
																<a><b>'.$value3->nm_file.'</b></a><br><a style="font-size:8pt"><i>di upload tanggal <br>'.$ctanggal.'</i></a>
															</div>	
														
															<input type="hidden" name="kdfileuploadE1_'.$xno.'_'.$cno3.'" id="kdfileuploadE1_'.$xno.'_'.$cno3.'" value="'.$value3->kd_file.'"  class="form-control" />

													</td>
																		
    
													<td>
														<textarea  readonly class="form-control" 
															style="font-size:10pt;color: #000;background: transparent;border: none;outline: none;" 
															id="uraianE1_'.$xno.'_'.$cno3.'" name="uraianE1_'.$xno.'_'.$cno3.'" rows="2" >'.$cinformasi.'
														</textarea>
													</td>				 
																		
													<td>
														'.$aksi.'
													</td>
												</tr>';	
												
								}
								
								
																
											$cnext=$cno3+1;	
													
											$btnE1_upl	= '<a class="list-group-item list-group-item-action "  onclick="uploadFileE1('.$celemen.','.$xno.','.$cnext.')"; ><i class="fa fa-cloud-upload fa-1x" aria-hidden="true" style="color: #006E7F" ></i> Upload file</a>';									
											$button3 	= '<button data-toggle="dropdown" '.$disable.' id="btnGroupDrop1" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
											$subbutton	= $btnE1_upl;
									
											$aksi='<left>
														<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
															'.$button3.'
															</button><ul class="dropdown-menu" >
															
															<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>																  
																  '.$subbutton.'
															</div> 
														</div>
												
													</left>';	
			
													
													
											
											$html.='<tr>
														<td style="width:30px">		
															<input type="file" name="fileuploadE1_'.$xno.'_'.$cnext.'" id="fileuploadE1_'.$xno.'_'.$cnext.'" value="" onchange="validateFormat(this,'.$celemen.','.$xno.','.$cnext.')" />
														</td>
																			
														<td>
															<textarea  style="font-size:10pt;display : none;" class="form-control"  id="uraianE1_'.$xno.'_'.$cnext.'" name="uraianE1_'.$xno.'_'.$cnext.'" rows="2"></textarea>

														</td>				 
																			
														<td>
															'.$aksi.'
														</td>
														
														
														
													</tr>';	
													
											$html.='</tbody>
									</table>
								</div>

								<div class="col-sm-3"> 
									<div class="col-sm-12"><a><b>VERIFIKASI DATA</b></a>

										 <select '.$disable_verif.' name="cverifikasiE1_'.$xno.'" id="cverifikasiE1_'.$xno.'" class="form-control input-sm" onchange="verifikasi('.$celemen.','.$xno.')" style="color:'.$color.'">
											<option value="0" ></option>
											<option style="color:red" value="1" >TIDAK SESUAI</option>
											<option style="color:green" value="2" >SESUAI</option>
										  </select><br>
									</div>
									
									<script>
										$("#cverifikasiE1_"+'.$xno.').val('.$cverifikasi.');
										$("#cverifikasiE1_"+'.$xno.').select2().trigger("change"); 
									</script>
									
									
									<div id="divCatatanE1_'.$xno.'" class="col-sm-12" '.$divhidden.'><a><b>CATATAN</b></a>
										<textarea  '.$disable_verif.' style="font-size:10pt;" class="form-control"  id="catatanE1_'.$xno.'" name="catatanE1_'.$xno.'" rows="4">'.$catatan.'</textarea>
										
										<div '.$hidden_verif.'><br>
											<button type="button" hidden class="btn btn-success btn-lg simpan-verif" data-elemen="'.$celemen.'" data-topik="'.$ckdtopik.'" data-penilaian="'.$ckd_penilaian.'" data-nomor="'.$xno.'" hidden><i class="fa fa-check-square"></i> VERIFIKASI</button>
											</div><i style="font-size:8pt;">'.$cinfo_verif.'<br>'.$cverif_at.'</i>
									
									</div>
									
								</div>';		
									
							
							}	

						}
							
					}
			
			
			
				$html.='<div class="col-sm-12">
				
				 <fieldset>
						<legend style="background-color: #EDDFB3; font-size:10pt;"><b>&nbsp;</b>
							<div class="col-sm-12" >											
								
								<div class="col-sm-9" >
									<label style="align:center"><b><i>Simpulan Pemenuhan '.$cno.' : '.$cnm_topik.'</i></b>
								  
									</label>
								</div>
								
								
								
								 <div class="col-sm-3">
								 '.$iconjawab.'
								  <div class="progress-bar progress-bar-striped active" role="progressbar"
										aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:'.$persenjawab.'%;margin-top:-10%;" >
									'.$persenjawab.'%
								  </div><br>
								</div>
								
							</div>
							
							
						</legend>	
				</fieldset>
				</div>	';
			
			
			}			
	
			$kembali='kapip-dataumum-profil-apip';
			$html .='</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


 
<div class="panel-footer">
	<center>';
	
	
	$html .='<button type="button"  onclick="kembali()" class="btn btn-danger btn-lg" ><i class="fa fa-arrow-circle-left"></i> KEMBALI</button>'; 
	$html .='<button type="button" '.$disable.' class="btn btn-success btn-lg simpan-elemen1" data-jml="'.$xno.'" data-jmltopik="'.$cno.'"><i class="fa fa-check-square"></i> SIMPAN</button>
			
	</center>
	</form>
</div>';

	
	

			
			return $html;
		}


		public function viewElemen2($ctahun,$cinstansi,$clevel)
		{
			
			$celemen=2;
			$akses = $this->session->userdata('is_admin');
			
	    	
			if($akses == 1){
				$disable_verif='';
				$hidden_verif='';
				
			}else{
				
				$disable_verif='disabled';
				$hidden_verif='hidden';
				
			}


			$query = "SELECT simpulan,(select ifnull(MAX(kd_level),0) FROM tsimpulan WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND simpulan='1')maxsimpul from tsimpulan WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND  kd_level='".$clevel."'";
			$data = $this->db->query($query)->result();
						
			foreach ($data as $value) {

				$csimpulan=$value->simpulan;
				$cmaxsimpul=$value->maxsimpul;

			}
			
			if($csimpulan==1){
				
				$disable="disabled";
				$cinfo ="( Read Only )";
			}else{
				
				$disable="";
				$cinfo ="";
			} 			
					
			$query="SELECT DISTINCT a.kd_topik,b.nm_topik,IFNULL(a.simpulan_pemenuhan,0)simpulan_pemenuhan
			FROM tlevel a INNER JOIN ttopik b ON a.tahun=b.tahun AND a.kd_apip=b.kd_apip
					AND a.kd_elemen=b.kd_elemen AND a.kd_topik=b.kd_topik WHERE a.tahun='".$ctahun."' AND a.kd_apip='".$cinstansi."' AND a.kd_elemen='".$celemen."' AND a.kd_level='".$clevel."'
					ORDER BY kd_topik";	
				
			$data = $this->db->query($query)->result();
			
			$html = "";
			



				$html .='<div class="row">
									<div class="col-md-12">
										<div class="product-status mg-b-15">
											<div class="container-fluid">
												<div class="row">
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
														<div class="product-status-wrap">';
														
														
			
			$html .='<input type="hidden" name="ptahun"  value='.$ctahun.' class="form-control input-sm" id="ptahun">
					 <input type="hidden" name="pkdinstansi"  value='.$cinstansi.' class="form-control input-sm" id="pkdinstansi">';
			$cno = 0;
			$xno = 0; 
			foreach ($data as $value) {
				$cno++;
				
				$ckd_topik=$value->kd_topik;
				$cnm_topik=$value->nm_topik;
				$csimpulan_pemenuhan=$value->simpulan_pemenuhan;
				
				
				if($csimpulan_pemenuhan==1){
						$chksimpul="checked";
					}else{
						$chksimpul="";
					} 
					
					
		$sql = "SELECT acc,nacc,(acc+nacc)jml,((acc/(acc+nacc))*100)persen FROM(
				SELECT SUM(acc)acc,SUM(nacc)nacc FROM(
				SELECT COUNT(*)acc,0 nacc FROM tpenilaian WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' and kd_topik='".$ckd_topik."' AND kd_level='".$clevel."' AND jawaban=1
				UNION
				SELECT 0 acc,COUNT(*)nacc FROM tpenilaian WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' and kd_topik='".$ckd_topik."' AND kd_level='".$clevel."' AND jawaban=0
				)z)zz";
				
		$persenjawab = $this->db->query($sql)->row()->persen;	
		
		$persenjawab=number_format($persenjawab, "0", ",", ".");
		
		if($persenjawab==100){
			$iconjawab='<span class="fa fa-check-square-o fa-3x" aria-hidden="true" style="color: #3CCF4E; margin-left:108%;margin-top:-5px">
							  </span>';
		}else{
			$iconjawab='<span  class="fa fa-window-close-o fa-3x" aria-hidden="true" style="color: #fc544b; margin-left:108%; margin-top:-5%">
							</span>';
		}
			

	
				$html .='<input type="hidden" name="hkd_topiksimpulE2_'.$cno.'"  value='.$ckd_topik.' class="form-control input-sm" id="hkd_topiksimpulE2_'.$cno.'">';
				
				$html.='<div class="col-md-12"><br> 
								<h3 class="panel-title"><i class="fa fa-ravelry" ></i>  <b> <lebel id="lbtopik" style="text-align: left;">Topik '.$cno.' : '.$cnm_topik.'</label></b> </h3>
						<br></div>';
				
						$query2="select *from tpenilaian WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' AND kd_level='".$clevel."' and kd_topik='".$ckd_topik."'
								ORDER BY kd_penilaian";	
							
						$data2 = $this->db->query($query2)->result();
						
							$dno=0;
							$xpilihan='';
							foreach ($data2 as $value2) {
								$dno++;
								$xno++;
								
								$ckd_elemen=$value2->kd_elemen;
								$ckd_penilaian=$value2->kd_penilaian;
								$curaian=$value2->uraian;
								$cpenjelasan=$value2->penjelasan;
								$cbukti=$value2->bukti;
								$clangkah=$value2->langkah;
								$cjawaban=$value2->jawaban;
								$cverifikasi=$value2->verifikasi;
								$cverif_at=$value2->verif_at;
								$cuser_verif=$value2->user_verif;
								$catatan=$value2->catatan;
	
								$chpoin=$value2->hpoin;
								$cdpoin=$value2->dpoin;
								
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
								
						
								
								if($cverifikasi==1){  // tidak sesuai
									$color="red";
									$cinfo_verif='di Verifikasi tanggal';
									$cverif_at=$this->PublicModel->tanggal_waktu_indonesia($cverif_at); //$disable=$cverifikasi;
									
									if($csimpulan==1){
										$disable='disabled';
									}else{
										$disable='';
									}
									
									
									
								}else if($cverifikasi==2){  // sesuai
									$color="green";
									$cinfo_verif='di Verifikasi tanggal';
									$cverif_at=$this->PublicModel->tanggal_waktu_indonesia($cverif_at);
									$disable='disabled';
									
									
									
								}else{
									$color="black";
									$cinfo_verif='';
									$cverif_at=''; //$disable=$cverifikasi;
									if($csimpulan==1){
										$disable='disabled';
									}else{
										$disable='';
									}
								}
								
								
								if($cjawaban==1){
									$chk="checked";
								}else{
									$chk="";
								} 
								
								
								if($cuser_verif==null){
									
									$divhidden="hidden";
								}else{
									$divhidden="";
								}
								
								
								
								
								$search = array("/", " ", ":", "*", "?", "&#34;", "<", ">",".");
								$searchdok = array("/", " ", ":", "*", "?", "&#34;", "<", ">", "|");
								$replace = array("_", "_", "_", "_", "_", "_", "_", "_", "_");
							
								$ctahun 		= str_replace($search, $replace, $ctahun);
								$cinstansi 		= str_replace($search, $replace, $cinstansi);
								$celemen 		= str_replace($search, $replace, $ckd_elemen);
								$clevel 		= str_replace($search, $replace, $clevel);
								$ckdtopik 		= str_replace($search, $replace, $ckd_topik);
								$ckdpenilaian 	= str_replace($search, $replace, $ckd_penilaian);
								
								
						
								$folder5		= 'assets/file_upload/ekapip_dokumen/'.$ctahun.'/'.'Instansi'.$cinstansi.'/'.'Elemen'.$celemen.'/'.'Level'.$clevel.'/'.'Topik'.$ckdtopik.'/'.'Penilaian'.$ckdpenilaian.'/';

								$cdokumen=$value2->dokumen;

								$xno2='1';
										
								$html .='<input type="hidden" name="hkd_topikE2_'.$xno.'"  value='.$ckdtopik.' class="form-control input-sm" id="hkd_topikE2_'.$xno.'">';
								$html .='<input type="hidden" name="hkd_penilaianE2_'.$xno.'"  value='.$ckdpenilaian.' class="form-control input-sm" id="hkd_penilaianE2_'.$xno.'">';

							if($cpenjelasan==''){
									
									$html.='<div class="col-md-12" style="margin-left: 25px"> <br>
								
											
												<fieldset>
														<details>

															<summary style="font-size: 13px;color: black; text-align: left; " data-toggle="tooltip" data-placement="top" title="Klik Penjelasan Pemenuhan Topik Penilaian KAPIP">
																
																<div class="col-md-11" style="margin-left: 25px; cursor: pointer;"> 
																		<div class="col-md-1"><lebel style="text-align: left;">'.$cpoin.'</label></div> 
																		<div class="col-md-11" style="margin-left: -5%"><lebel style="text-align: left;">'.$curaian.'</label></div><br> 
																</div> 
															</summary> 
															
															
													</details>		
												</fieldset>			
										
										</div>'; 	
									
									
								}else{							
							
							
										$html.='<div class="col-md-12" style="margin-left: 25px"> <br>
								
											
											<fieldset>
													<details>

														<summary style="font-size: 13px;color: black; text-align: left; " data-toggle="tooltip" data-placement="top" title="Klik Penjelasan Pemenuhan Topik Penilaian KAPIP">
															<div class="col-md-11" style="margin-left: 25px; cursor: pointer;"> 
																	<div class="col-md-1"><lebel style="text-align: left;">'.$cpoin.'</label></div> 
																	<div class="col-md-11" style="margin-left: -5%"><lebel style="text-align: left;">'.$curaian.'</label> <i class="fa fa-caret-square-o-down fa-lg" style="color: #18978F;" ></i><br><br></div>															</div> 
														</summary> 
														
														<div class="col-md-11" style="margin-left: 45px"> 
																	<lebel style="text-align: left; font-size: 14px;color: #18978F;"><b>Penjelasan Uraian Aspek</b></label>
																	<textarea style="font-size:10pt;" class="form-control" readonly  rows="4">'.$cpenjelasan.'</textarea>
															<br>
														</div>
														
														<div class="col-md-11" style="margin-left: 45px"> 
																	<lebel style="text-align: left; font-size: 14px;color: #18978F;"><b>Contoh Bukti Dukung</b></label>
																	<textarea style="font-size:10pt;" class="form-control" readonly rows="4">'.$cbukti.'</textarea>
																	
															<br>
														</div>
														
												</details>		
											</fieldset>		
										
											
											<div class="col-sm-5" style="margin-left: 35px">											
												<label class="switch">
												  <input type="checkbox" onchange="checkPilihan()" '.$disable.' id="cpilihanE2_'.$xno.'" '.$chk.' value='.$cjawaban.'>
												  <div class="slider"></div>
												</label>
											</div>
											

										</div>'; 
							
										
							
							
							if($csimpulan==1){
									$btnE2_upl ='';
								}else{
									$xno2=1;
									$btnE2_upl 		= '<a class="list-group-item list-group-item-action "  onclick="uploadFileE2('.$celemen.','.$xno.','.$xno2.')"; ><i class="fa fa-cloud-upload fa-1x" aria-hidden="true" style="color: #006E7F" ></i> Upload File</a>';
								
									
								}
								
									$button3 		= '<button data-toggle="dropdown"  id="btnGroupDrop2" class="btn btn-info btn-sm dropdown-toggle '.$disable.'" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';									
									$subbutton=$btnE2_upl;
									
							
							
									$aksi='<center>
										<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
											'.$button3.'
											</button><ul class="dropdown-menu" >
											<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
												  
												  '.$subbutton.'
												
											</div> 
										  </div>
										
									</center>';
							
							
							
							$sql = "SELECT IFNULL(MAX(kd_file),0)+1 fnext FROM tpenilaian_lamp WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' and kd_topik='".$ckdtopik."' AND kd_level='".$clevel."' AND kd_penilaian='".$ckdpenilaian."'";	
							$kdfield = $this->db->query($sql)->row()->fnext;	
							
							if($kdfield==1){ // data baru
								
								if($csimpulan==1){
									$btnE2_upl ='';
								}else{
									$btnE2_upl 		= '<a class="list-group-item list-group-item-action "  onclick="uploadFileE2('.$celemen.','.$xno.','.$xno2.')"; ><i class="fa fa-cloud-upload fa-1x" aria-hidden="true" style="color: #006E7F" ></i> Upload File</a>';
								
									
								}
								
									$button3 		= '<button data-toggle="dropdown"  id="btnGroupDrop2" class="btn btn-info btn-sm dropdown-toggle '.$disable.'" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';									
									$subbutton=$btnE2_upl;
									
							
							
									$aksi='<center>
										<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
											'.$button3.'
											</button><ul class="dropdown-menu" >
											<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
												  
												  '.$subbutton.'
												
											</div> 
										  </div>
										
									</center>';		
												
								
						$html.='<div class="col-sm-8" style="margin-left: 80px;">
									<table id="xx" class="table table-bordered table-striped" style="width:100%;" border="0">
										<tbody id="data-profil-2">
										
										<thead>
											<tr>
												
												<th style="text-align:center;width:250px;color:black"><b>FILE UPLOAD</b></th>
												<th style="text-align:center;width:500px;color:black"><b>KETERANGAN</b></th>
												<th style="text-align:center;width:10px;"></th>
												
											</tr>
										</thead>';
										
										
										
										
												$xno2='1';
									
											$html.='<tr>
														<td style="width:30px">		
															<input type="file" name="fileuploadE2_'.$xno.'_'.$xno2.'" id="fileuploadE2_'.$xno.'_'.$xno2.'" value="" onchange="validateFormat(this,'.$celemen.','.$xno.','.$xno2.')" />
														</td>
																			
														<td>
															<textarea  style="font-size:10pt;display : none;" class="form-control"  id="uraianE2_'.$xno.'_'.$xno2.'" name="uraianE2_'.$xno.'_'.$xno2.'" rows="2"></textarea>

														</td>				 
																			
														<td>
															'.$aksi.'
														</td>
														
													</tr>';				
				
											
									$html.='
											
									</tbody>
							</table>
						</div>	
				
						
						<div class="col-sm-3"> 
									<div class="col-sm-12"><a><b>VERIFIKASI DATA</b></a>

										 <select '.$disable_verif.' name="cverifikasiE2_'.$xno.'" id="cverifikasiE2_'.$xno.'" class="form-control input-sm" onchange="verifikasi('.$celemen.','.$xno.')" style="color:'.$color.'">
											<option value="0" ></option>
											<option style="color:red" value="1" >TIDAK SESUAI</option>
											<option style="color:green" value="2" >SESUAI</option>
										  </select><br>
									</div>
									
									<script>
										$("#cverifikasiE2_"+'.$xno.').val('.$cverifikasi.');
										$("#cverifikasiE2_"+'.$xno.').select2().trigger("change"); 
									</script>
									
									
									<div id="divCatatanE2_'.$xno.'" class="col-sm-12" '.$divhidden.'><a><b>CATATAN</b></a>
										<textarea  '.$disable_verif.' style="font-size:10pt;" class="form-control"  id="catatanE2_'.$xno.'" name="catatanE2_'.$xno.'" rows="4">'.$catatan.'</textarea>
										
										<div '.$hidden_verif.'><br>
											<button type="button" hidden class="btn btn-success btn-lg simpan-verif" data-elemen="'.$celemen.'" data-topik="'.$ckdtopik.'" data-penilaian="'.$ckd_penilaian.'" data-nomor="'.$xno.'" hidden><i class="fa fa-check-square"></i> VERIFIKASI</button>
											</div><i style="font-size:8pt;">'.$cinfo_verif.'<br>'.$cverif_at.'</i>
									
									</div>
									
								
								</div>';				
														

								
										
								
								
							}else{     // data sudah ada
									
								
							
								$query3="select *from tpenilaian_lamp WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' AND kd_level='".$clevel."' and kd_topik='".$ckd_topik."' and kd_penilaian='".$ckd_penilaian."'
										 ORDER BY kd_penilaian";	
								
								$data3 = $this->db->query($query3)->result();
							
								$cno3=0;
								
								$html.='<div class="col-sm-8" style="margin-left: 80px;">
											<table id="xx" class="table table-bordered table-striped" style="width:100%;" border="0">
												<tbody id="data-profil-2">
												
												<thead>
													<tr>
														
														<th style="text-align:center;width:250px;color:black"><b>FILE UPLOAD</b></th>
														<th style="text-align:center;width:500px;color:black"><b>KETERANGAN</b></th>
														<th style="text-align:center;width:10px;"></th>
														
													</tr>
												</thead>';
												
												
												
								
								foreach ($data3 as $value3) {
									$cno3++;
									
									$ctahun=$value3->tahun;
									$cinstansi=$value3->kd_apip;
									$celemen=$value3->kd_elemen;
									$ctopik=$value3->kd_topik;
									$clevel=$value3->kd_level;
									$cpenilaian=$value3->kd_penilaian;
									$cfile=$value3->kd_file;
									$cnmfile=$value3->nm_file;
									$cinformasi=$value3->uraian;
									$ctanggal=$this->PublicModel->tanggal_waktu_indonesia($value3->insert_at);
							
									
							
									$clink			= "<a href='".base_url().$folder5.$value3->nm_file."' target= '_blank' class='list-group-item list-group-item-action' ><i class='fa fa-file-text-o fa-1x' aria-hidden='true' style='color: #069A8E'></i> Lihat File</a>";
					
									$btnE2_View = $clink;
									
									$clink2			= "<a href='".base_url().$folder5.$value3->nm_file."' target= '_blank' class='list-group-item list-group-item-action' ><i class='fa fa-file-text-o fa-1x' aria-hidden='true' style='color: #069A8E'></i></a>";
				
		
									$aa="hapusFileE2('".$ctahun."','".$cinstansi."','".$celemen."','".$ctopik."','".$clevel."','".$cpenilaian."','".$cfile."','".$cnmfile."')";
								
										if($csimpulan==1){
											$btnE2_Del = '';
										}else{
											
											if($cverifikasi==2){
													$btnE2_Del = '';
											}else{
												
													$btnE2_Del = '<a class="list-group-item list-group-item-action" onclick='.$aa.' ><i class="fa fa-trash-o fa-1x" aria-hidden="true" style="color: #EB1D36"></i> Hapus File</a>';
	
											}
											
																			
										}
									
											$button3 = '<button data-toggle="dropdown"  id="btnGroupDrop2" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
			
											$subbutton=$btnE2_View.$btnE2_Del;
									
											$aksi='<left>
														<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
															'.$button3.'
															</button><ul class="dropdown-menu" >
															
															<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>																  
																  '.$subbutton.'
															</div> 
														</div>
												
													</left>';		
													
											
												if($cno3==1){
													
													$margin='style="margin-top: -30px"';
													$marginaksi='style="margin-left: -25px;margin-top: -3px;"';
													$br ="";
												}else{
													
													$margin='style="margin-top: -55px"';
													$marginaksi='style="margin-left: -25px;margin-top: -25px;"';
													$br ="<br>";
													
												}
												
												$html.='
															<div class="col-sm-5" style="margin-left: 35px">
																	&nbsp;
															</div>';
								
												$cinput='';
								
										$html.='<tr>
													<td style="width:30px">	
														<div class="col-sm-3">	
														
														
															<a href='.base_url().$folder5.$value3->nm_file.' target= "_blank" title="Lihat File"> <i class="fa fa-file-pdf-o fa-3x" style="color: #EB1D36" aria-hidden="true"></i></a>

														</div>
															<div class="col-sm-9">	
																<a><b>'.$value3->nm_file.'</b></a><br><a style="font-size:8pt"><i>di upload tanggal <br>'.$ctanggal.'</i></a>
															</div>	
														
															<input type="hidden" name="kdfileuploadE2_'.$xno.'_'.$cno3.'" id="kdfileuploadE2_'.$xno.'_'.$cno3.'" value="'.$value3->kd_file.'"  class="form-control" />

													</td>
																		
    
													<td>
														<textarea  readonly class="form-control" 
															style="font-size:10pt;color: #000;background: transparent;border: none;outline: none;" 
															id="uraianE2_'.$xno.'_'.$cno3.'" name="uraianE2_'.$xno.'_'.$cno3.'" rows="2" >'.$cinformasi.'
														</textarea>
													</td>				 
																		
													<td>
														'.$aksi.'
													</td>
												</tr>';	
												
								}
								
								
																
											$cnext=$cno3+1;	
													
											$btnE2_upl	= '<a class="list-group-item list-group-item-action "  onclick="uploadFileE2('.$celemen.','.$xno.','.$cnext.')"; ><i class="fa fa-cloud-upload fa-1x" aria-hidden="true" style="color: #006E7F" ></i> Upload file</a>';									
											$button3 	= '<button data-toggle="dropdown" '.$disable.' id="btnGroupDrop2" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
											$subbutton	= $btnE2_upl;
									
											$aksi='<left>
														<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
															'.$button3.'
															</button><ul class="dropdown-menu" >
															
															<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>																  
																  '.$subbutton.'
															</div> 
														</div>
												
													</left>';	
			
													
													
											
											$html.='<tr>
														<td style="width:30px">		
															<input type="file" name="fileuploadE2_'.$xno.'_'.$cnext.'" id="fileuploadE2_'.$xno.'_'.$cnext.'" value="" onchange="validateFormat(this,'.$celemen.','.$xno.','.$cnext.')" />
														</td>
																			
														<td>
															<textarea  style="font-size:10pt;display : none;" class="form-control"  id="uraianE2_'.$xno.'_'.$cnext.'" name="uraianE2_'.$xno.'_'.$cnext.'" rows="2"></textarea>

														</td>				 
																			
														<td>
															'.$aksi.'
														</td>
														
														
														
													</tr>';	
													
											$html.='</tbody>
									</table>
								</div>

								<div class="col-sm-3"> 
									<div class="col-sm-12"><a><b>VERIFIKASI DATA</b></a>

										 <select '.$disable_verif.' name="cverifikasiE2_'.$xno.'" id="cverifikasiE2_'.$xno.'" class="form-control input-sm" onchange="verifikasi('.$celemen.','.$xno.')" style="color:'.$color.'">
											<option value="0" ></option>
											<option style="color:red" value="1" >TIDAK SESUAI</option>
											<option style="color:green" value="2" >SESUAI</option>
										  </select><br>
									</div>
									
									<script>
										$("#cverifikasiE2_"+'.$xno.').val('.$cverifikasi.');
										$("#cverifikasiE2_"+'.$xno.').select2().trigger("change"); 
									</script>
									
									
									<div id="divCatatanE2_'.$xno.'" class="col-sm-12" '.$divhidden.'><a><b>CATATAN</b></a>
										<textarea  '.$disable_verif.' style="font-size:10pt;" class="form-control"  id="catatanE2_'.$xno.'" name="catatanE2_'.$xno.'" rows="4">'.$catatan.'</textarea>
										
										<div '.$hidden_verif.'><br>
											<button type="button" hidden class="btn btn-success btn-lg simpan-verif" data-elemen="'.$celemen.'" data-topik="'.$ckdtopik.'" data-penilaian="'.$ckd_penilaian.'" data-nomor="'.$xno.'" hidden><i class="fa fa-check-square"></i> VERIFIKASI</button>
											</div><i style="font-size:8pt;">'.$cinfo_verif.'<br>'.$cverif_at.'</i>
									
									</div>
									
								</div>';		
									
							
							}
						}
							
					}
			
			
			
				$html.='<div class="col-sm-12">
				
				 <fieldset>
						<legend style="background-color: #EDDFB3; font-size:10pt;"><b>&nbsp;</b>
							<div class="col-sm-12" >											
								
								<div class="col-sm-9" >
									<label style="align:center"><b><i>Simpulan Pemenuhan '.$cno.' : '.$cnm_topik.'</i></b>
								  
									</label>
								</div>
								
								
								
								 <div class="col-sm-3">
								 '.$iconjawab.'
								  <div class="progress-bar progress-bar-striped active" role="progressbar"
										aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:'.$persenjawab.'%;margin-top:-10%;" >
									'.$persenjawab.'%
								  </div><br>
								</div>
								
							</div>
							
							
						</legend>	
				</fieldset>
				</div>	';
			
			
							/* <div class="col-sm-3">	
									<label class="switch" style="margin-left: 28px;">
									  <input '.$aktifsimpul.' type="checkbox" onchange="checkSimpulan('.$xpilihan.')" id="chsimpulE2_'.$cno.'" '.$chksimpul.' value='.$csimpulan_pemenuhan.'>
									  <div class="slider"></div>
									</label>
								</div> */
			
			
			}			
	
			$kembali='kapip-dataumum-profil-apip';
			$html .='</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


 
<div class="panel-footer">
	<center>';
	
	
	$html .='<button type="button"  onclick="kembali()" class="btn btn-danger btn-lg" ><i class="fa fa-arrow-circle-left"></i> KEMBALI</button>'; 
	$html .='<button type="button" '.$disable.' class="btn btn-success btn-lg simpan-elemen2" data-jml="'.$xno.'" data-jmltopik="'.$cno.'"><i class="fa fa-check-square"></i> SIMPAN</button>
			
	</center>
	</form>
</div>';

	
	

			
			return $html;
		}



		public function viewElemen3($ctahun,$cinstansi,$clevel)
		{
			
			$celemen=3;
			$akses = $this->session->userdata('is_admin');
			
	    	
			if($akses == 1){
				$disable_verif='';
				$hidden_verif='';
				
			}else{
				
				$disable_verif='disabled';
				$hidden_verif='hidden';
				
			}


			$query = "SELECT simpulan,(select ifnull(MAX(kd_level),0) FROM tsimpulan WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND simpulan='1')maxsimpul from tsimpulan WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND  kd_level='".$clevel."'";
			$data = $this->db->query($query)->result();
						
			foreach ($data as $value) {

				$csimpulan=$value->simpulan;
				$cmaxsimpul=$value->maxsimpul;

			}
			
			if($csimpulan==1){
				
				$disable="disabled";
				$cinfo ="( Read Only )";
			}else{
				
				$disable="";
				$cinfo ="";
			} 			
					
			$query="SELECT DISTINCT a.kd_topik,b.nm_topik,IFNULL(a.simpulan_pemenuhan,0)simpulan_pemenuhan
			FROM tlevel a INNER JOIN ttopik b ON a.tahun=b.tahun AND a.kd_apip=b.kd_apip
					AND a.kd_elemen=b.kd_elemen AND a.kd_topik=b.kd_topik WHERE a.tahun='".$ctahun."' AND a.kd_apip='".$cinstansi."' AND a.kd_elemen='".$celemen."' AND a.kd_level='".$clevel."'
					ORDER BY kd_topik";	
				
			$data = $this->db->query($query)->result();
			
			$html = "";
			



				$html .='<div class="row">
									<div class="col-md-12">
										<div class="product-status mg-b-15">
											<div class="container-fluid">
												<div class="row">
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
														<div class="product-status-wrap">';
														
														
			
			$html .='<input type="hidden" name="ptahun"  value='.$ctahun.' class="form-control input-sm" id="ptahun">
					 <input type="hidden" name="pkdinstansi"  value='.$cinstansi.' class="form-control input-sm" id="pkdinstansi">';
			$cno = 0;
			$xno = 0; 
			foreach ($data as $value) {
				$cno++;
				
				$ckd_topik=$value->kd_topik;
				$cnm_topik=$value->nm_topik;
				$csimpulan_pemenuhan=$value->simpulan_pemenuhan;
				
				
				if($csimpulan_pemenuhan==1){
						$chksimpul="checked";
					}else{
						$chksimpul="";
					} 
					
					
		$sql = "SELECT acc,nacc,(acc+nacc)jml,((acc/(acc+nacc))*100)persen FROM(
				SELECT SUM(acc)acc,SUM(nacc)nacc FROM(
				SELECT COUNT(*)acc,0 nacc FROM tpenilaian WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' and kd_topik='".$ckd_topik."' AND kd_level='".$clevel."' AND jawaban=1
				UNION
				SELECT 0 acc,COUNT(*)nacc FROM tpenilaian WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' and kd_topik='".$ckd_topik."' AND kd_level='".$clevel."' AND jawaban=0
				)z)zz";
				
		$persenjawab = $this->db->query($sql)->row()->persen;	
		
		$persenjawab=number_format($persenjawab, "0", ",", ".");
		
		if($persenjawab==100){
			$iconjawab='<span class="fa fa-check-square-o fa-3x" aria-hidden="true" style="color: #3CCF4E; margin-left:108%;margin-top:-5px">
							  </span>';
		}else{
			$iconjawab='<span  class="fa fa-window-close-o fa-3x" aria-hidden="true" style="color: #fc544b; margin-left:108%; margin-top:-5%">
							</span>';
		}
			

	
				$html .='<input type="hidden" name="hkd_topiksimpulE3_'.$cno.'"  value='.$ckd_topik.' class="form-control input-sm" id="hkd_topiksimpulE3_'.$cno.'">';
				
				$html.='<div class="col-md-12"><br> 
								<h3 class="panel-title"><i class="fa fa-ravelry" ></i>  <b> <lebel id="lbtopik" style="text-align: left;">Topik '.$cno.' : '.$cnm_topik.'</label></b> </h3>
						<br></div>';
				
						$query2="select *from tpenilaian WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' AND kd_level='".$clevel."' and kd_topik='".$ckd_topik."'
								ORDER BY kd_penilaian";	
							
						$data2 = $this->db->query($query2)->result();
						
							$dno=0;
							$xpilihan='';
							foreach ($data2 as $value2) {
								$dno++;
								$xno++;
								
								$ckd_elemen=$value2->kd_elemen;
								$ckd_penilaian=$value2->kd_penilaian;
								$curaian=$value2->uraian;
								$cpenjelasan=$value2->penjelasan;
								$cbukti=$value2->bukti;
								$clangkah=$value2->langkah;
								$cjawaban=$value2->jawaban;
								$cverifikasi=$value2->verifikasi;
								$cverif_at=$value2->verif_at;
								$cuser_verif=$value2->user_verif;
								$catatan=$value2->catatan;
								
								$chpoin=$value2->hpoin;
								$cdpoin=$value2->dpoin;
								
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
						
								
								if($cverifikasi==1){  // tidak sesuai
									$color="red";
									$cinfo_verif='di Verifikasi tanggal';
									$cverif_at=$this->PublicModel->tanggal_waktu_indonesia($cverif_at); //$disable=$cverifikasi;
									
									if($csimpulan==1){
										$disable='disabled';
									}else{
										$disable='';
									}
									
									
									
								}else if($cverifikasi==2){  // sesuai
									$color="green";
									$cinfo_verif='di Verifikasi tanggal';
									$cverif_at=$this->PublicModel->tanggal_waktu_indonesia($cverif_at);
									$disable='disabled';
									
									
									
								}else{
									$color="black";
									$cinfo_verif='';
									$cverif_at=''; //$disable=$cverifikasi;
									if($csimpulan==1){
										$disable='disabled';
									}else{
										$disable='';
									}
								}
								
								
								if($cjawaban==1){
									$chk="checked";
								}else{
									$chk="";
								} 
								
								
								if($cuser_verif==null){
									
									$divhidden="hidden";
								}else{
									$divhidden="";
								}
								
								
								
								
								$search = array("/", " ", ":", "*", "?", "&#34;", "<", ">",".");
								$searchdok = array("/", " ", ":", "*", "?", "&#34;", "<", ">", "|");
								$replace = array("_", "_", "_", "_", "_", "_", "_", "_", "_");
							
								$ctahun 		= str_replace($search, $replace, $ctahun);
								$cinstansi 		= str_replace($search, $replace, $cinstansi);
								$celemen 		= str_replace($search, $replace, $ckd_elemen);
								$clevel 		= str_replace($search, $replace, $clevel);
								$ckdtopik 		= str_replace($search, $replace, $ckd_topik);
								$ckdpenilaian 	= str_replace($search, $replace, $ckd_penilaian);
								
								
						
								$folder5		= 'assets/file_upload/ekapip_dokumen/'.$ctahun.'/'.'Instansi'.$cinstansi.'/'.'Elemen'.$celemen.'/'.'Level'.$clevel.'/'.'Topik'.$ckdtopik.'/'.'Penilaian'.$ckdpenilaian.'/';

								$cdokumen=$value2->dokumen;

								$xno2='1';
										
								$html .='<input type="hidden" name="hkd_topikE3_'.$xno.'"  value='.$ckdtopik.' class="form-control input-sm" id="hkd_topikE3_'.$xno.'">';
								$html .='<input type="hidden" name="hkd_penilaianE3_'.$xno.'"  value='.$ckdpenilaian.' class="form-control input-sm" id="hkd_penilaianE3_'.$xno.'">';
							
							
								if($cpenjelasan==''){
									
									$html.='<div class="col-md-12" style="margin-left: 25px"> <br>
								
											
												<fieldset>
														<details>

															<summary style="font-size: 13px;color: black; text-align: left; " data-toggle="tooltip" data-placement="top" title="Klik Penjelasan Pemenuhan Topik Penilaian KAPIP">
																
																<div class="col-md-11" style="margin-left: 25px; cursor: pointer;"> 
																		<div class="col-md-1"><lebel style="text-align: left;">'.$cpoin.'</label></div> 
																		<div class="col-md-11" style="margin-left: -5%"><lebel style="text-align: left;">'.$curaian.'</label></div><br> 
																</div> 
															</summary> 
															
															
													</details>		
												</fieldset>			
										
										</div>'; 	
									
									
								}else{							
							
							
										$html.='<div class="col-md-12" style="margin-left: 25px"> <br>
								
											
											<fieldset>
													<details>

														<summary style="font-size: 13px;color: black; text-align: left; " data-toggle="tooltip" data-placement="top" title="Klik Penjelasan Pemenuhan Topik Penilaian KAPIP">
															<div class="col-md-11" style="margin-left: 25px; cursor: pointer;"> 
																	<div class="col-md-1"><lebel style="text-align: left;">'.$cpoin.'</label></div> 
																	<div class="col-md-11" style="margin-left: -5%"><lebel style="text-align: left;">'.$curaian.'</label> <i class="fa fa-caret-square-o-down fa-lg" style="color: #18978F;" ></i><br><br></div>															</div> 
														</summary> 
														
														<div class="col-md-11" style="margin-left: 45px"> 
																	<lebel style="text-align: left; font-size: 14px;color: #18978F;"><b>Penjelasan Uraian Aspek</b></label>
																	<textarea style="font-size:10pt;" class="form-control" readonly  rows="4">'.$cpenjelasan.'</textarea>
															<br>
														</div>
														
														<div class="col-md-11" style="margin-left: 45px"> 
																	<lebel style="text-align: left; font-size: 14px;color: #18978F;"><b>Contoh Bukti Dukung</b></label>
																	<textarea style="font-size:10pt;" class="form-control" readonly rows="4">'.$cbukti.'</textarea>
																	
															<br>
														</div>
														
												</details>		
											</fieldset>		
										
											
											<div class="col-sm-5" style="margin-left: 35px">											
												<label class="switch">
												  <input type="checkbox" onchange="checkPilihan()" '.$disable.' id="cpilihanE3_'.$xno.'" '.$chk.' value='.$cjawaban.'>
												  <div class="slider"></div>
												</label>
											</div>
											

										</div>'; 
							
										
							
							
							if($csimpulan==1){
									$btnE3_upl ='';
								}else{
									$xno2=1;
									$btnE3_upl 		= '<a class="list-group-item list-group-item-action "  onclick="uploadFileE3('.$celemen.','.$xno.','.$xno2.')"; ><i class="fa fa-cloud-upload fa-1x" aria-hidden="true" style="color: #006E7F" ></i> Upload File</a>';
								
									
								}
								
									$button3 		= '<button data-toggle="dropdown"  id="btnGroupDrop3" class="btn btn-info btn-sm dropdown-toggle '.$disable.'" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';									
									$subbutton=$btnE3_upl;
									
							
							
									$aksi='<center>
										<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
											'.$button3.'
											</button><ul class="dropdown-menu" >
											<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
												  
												  '.$subbutton.'
												
											</div> 
										  </div>
										
									</center>';
							
							
							
							$sql = "SELECT IFNULL(MAX(kd_file),0)+1 fnext FROM tpenilaian_lamp WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' and kd_topik='".$ckdtopik."' AND kd_level='".$clevel."' AND kd_penilaian='".$ckdpenilaian."'";	
							$kdfield = $this->db->query($sql)->row()->fnext;	
							
							if($kdfield==1){ // data baru
								
								if($csimpulan==1){
									$btnE3_upl ='';
								}else{
									$btnE3_upl 		= '<a class="list-group-item list-group-item-action "  onclick="uploadFileE3('.$celemen.','.$xno.','.$xno2.')"; ><i class="fa fa-cloud-upload fa-1x" aria-hidden="true" style="color: #006E7F" ></i> Upload File</a>';
								
									
								}
								
									$button3 		= '<button data-toggle="dropdown"  id="btnGroupDrop3" class="btn btn-info btn-sm dropdown-toggle '.$disable.'" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';									
									$subbutton=$btnE3_upl;
									
							
							
									$aksi='<center>
										<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
											'.$button3.'
											</button><ul class="dropdown-menu" >
											<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
												  
												  '.$subbutton.'
												
											</div> 
										  </div>
										
									</center>';		
												
								
						$html.='<div class="col-sm-8" style="margin-left: 80px;">
									<table id="xx" class="table table-bordered table-striped" style="width:100%;" border="0">
										<tbody id="data-profil-3">
										
										<thead>
											<tr>
												
												<th style="text-align:center;width:250px;color:black"><b>FILE UPLOAD</b></th>
												<th style="text-align:center;width:500px;color:black"><b>KETERANGAN</b></th>
												<th style="text-align:center;width:10px;"></th>
												
											</tr>
										</thead>';
										
										
										
										
												$xno2='1';
									
											$html.='<tr>
														<td style="width:30px">		
															<input type="file" name="fileuploadE3_'.$xno.'_'.$xno2.'" id="fileuploadE3_'.$xno.'_'.$xno2.'" value="" onchange="validateFormat(this,'.$celemen.','.$xno.','.$xno2.')" />
														</td>
																			
														<td>
															<textarea  style="font-size:10pt;display : none;" class="form-control"  id="uraianE3_'.$xno.'_'.$xno2.'" name="uraianE3_'.$xno.'_'.$xno2.'" rows="2"></textarea>

														</td>				 
																			
														<td>
															'.$aksi.'
														</td>
														
													</tr>';				
				
											
									$html.='
											
									</tbody>
							</table>
						</div>	
				
						
						<div class="col-sm-3"> 
									<div class="col-sm-12"><a><b>VERIFIKASI DATA</b></a>

										 <select '.$disable_verif.' name="cverifikasiE3_'.$xno.'" id="cverifikasiE3_'.$xno.'" class="form-control input-sm" onchange="verifikasi('.$celemen.','.$xno.')" style="color:'.$color.'">
											<option value="0" ></option>
											<option style="color:red" value="1" >TIDAK SESUAI</option>
											<option style="color:green" value="2" >SESUAI</option>
										  </select><br>
									</div>
									
									<script>
										$("#cverifikasiE3_"+'.$xno.').val('.$cverifikasi.');
										$("#cverifikasiE3_"+'.$xno.').select2().trigger("change"); 
									</script>
									
									
									<div id="divCatatanE3_'.$xno.'" class="col-sm-12" '.$divhidden.'><a><b>CATATAN</b></a>
										<textarea  '.$disable_verif.' style="font-size:10pt;" class="form-control"  id="catatanE3_'.$xno.'" name="catatanE3_'.$xno.'" rows="4">'.$catatan.'</textarea>
										
										<div '.$hidden_verif.'><br>
											<button type="button" hidden class="btn btn-success btn-lg simpan-verif" data-elemen="'.$celemen.'" data-topik="'.$ckdtopik.'" data-penilaian="'.$ckd_penilaian.'" data-nomor="'.$xno.'" hidden><i class="fa fa-check-square"></i> VERIFIKASI</button>
											</div><i style="font-size:8pt;">'.$cinfo_verif.'<br>'.$cverif_at.'</i>
									
									</div>
									
								
								</div>';				
														

								
										
								
								
							}else{     // data sudah ada
									
								
							
								$query3="select *from tpenilaian_lamp WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' AND kd_level='".$clevel."' and kd_topik='".$ckd_topik."' and kd_penilaian='".$ckd_penilaian."'
										 ORDER BY kd_penilaian";	
								
								$data3 = $this->db->query($query3)->result();
							
								$cno3=0;
								
								$html.='<div class="col-sm-8" style="margin-left: 80px;">
											<table id="xx" class="table table-bordered table-striped" style="width:100%;" border="0">
												<tbody id="data-profil-3">
												
												<thead>
													<tr>
														
														<th style="text-align:center;width:250px;color:black"><b>FILE UPLOAD</b></th>
														<th style="text-align:center;width:500px;color:black"><b>KETERANGAN</b></th>
														<th style="text-align:center;width:10px;"></th>
														
													</tr>
												</thead>';
												
												
												
								
								foreach ($data3 as $value3) {
									$cno3++;
									
									$ctahun=$value3->tahun;
									$cinstansi=$value3->kd_apip;
									$celemen=$value3->kd_elemen;
									$ctopik=$value3->kd_topik;
									$clevel=$value3->kd_level;
									$cpenilaian=$value3->kd_penilaian;
									$cfile=$value3->kd_file;
									$cnmfile=$value3->nm_file;
									$cinformasi=$value3->uraian;
									$ctanggal=$this->PublicModel->tanggal_waktu_indonesia($value3->insert_at);
							
									
							
									$clink			= "<a href='".base_url().$folder5.$value3->nm_file."' target= '_blank' class='list-group-item list-group-item-action' ><i class='fa fa-file-text-o fa-1x' aria-hidden='true' style='color: #069A8E'></i> Lihat File</a>";
					
									$btnE3_View = $clink;
									
									$clink2			= "<a href='".base_url().$folder5.$value3->nm_file."' target= '_blank' class='list-group-item list-group-item-action' ><i class='fa fa-file-text-o fa-1x' aria-hidden='true' style='color: #069A8E'></i></a>";
				
		
									$aa="hapusFileE3('".$ctahun."','".$cinstansi."','".$celemen."','".$ctopik."','".$clevel."','".$cpenilaian."','".$cfile."','".$cnmfile."')";
								
										if($csimpulan==1){
											$btnE3_Del = '';
										}else{
											
											if($cverifikasi==2){
													$btnE3_Del = '';
											}else{
												
													$btnE3_Del = '<a class="list-group-item list-group-item-action" onclick='.$aa.' ><i class="fa fa-trash-o fa-1x" aria-hidden="true" style="color: #EB1D36"></i> Hapus File</a>';
	
											}
											
																			
										}
									
											$button3 = '<button data-toggle="dropdown"  id="btnGroupDrop3" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
			
											$subbutton=$btnE3_View.$btnE3_Del;
									
											$aksi='<left>
														<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
															'.$button3.'
															</button><ul class="dropdown-menu" >
															
															<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>																  
																  '.$subbutton.'
															</div> 
														</div>
												
													</left>';		
													
											
												if($cno3==1){
													
													$margin='style="margin-top: -30px"';
													$marginaksi='style="margin-left: -25px;margin-top: -3px;"';
													$br ="";
												}else{
													
													$margin='style="margin-top: -55px"';
													$marginaksi='style="margin-left: -25px;margin-top: -25px;"';
													$br ="<br>";
													
												}
												
												$html.='
															<div class="col-sm-5" style="margin-left: 35px">
																	&nbsp;
															</div>';
								
												$cinput='';
								
										$html.='<tr>
													<td style="width:30px">	
														<div class="col-sm-3">	
														
														
															<a href='.base_url().$folder5.$value3->nm_file.' target= "_blank" title="Lihat File"> <i class="fa fa-file-pdf-o fa-3x" style="color: #EB1D36" aria-hidden="true"></i></a>

														</div>
															<div class="col-sm-9">	
																<a><b>'.$value3->nm_file.'</b></a><br><a style="font-size:8pt"><i>di upload tanggal <br>'.$ctanggal.'</i></a>
															</div>	
														
															<input type="hidden" name="kdfileuploadE3_'.$xno.'_'.$cno3.'" id="kdfileuploadE3_'.$xno.'_'.$cno3.'" value="'.$value3->kd_file.'"  class="form-control" />

													</td>
																		
    
													<td>
														<textarea  readonly class="form-control" 
															style="font-size:10pt;color: #000;background: transparent;border: none;outline: none;" 
															id="uraianE3_'.$xno.'_'.$cno3.'" name="uraianE3_'.$xno.'_'.$cno3.'" rows="2" >'.$cinformasi.'
														</textarea>
													</td>				 
																		
													<td>
														'.$aksi.'
													</td>
												</tr>';	
												
								}
								
								
																
											$cnext=$cno3+1;	
													
											$btnE3_upl	= '<a class="list-group-item list-group-item-action "  onclick="uploadFileE3('.$celemen.','.$xno.','.$cnext.')"; ><i class="fa fa-cloud-upload fa-1x" aria-hidden="true" style="color: #006E7F" ></i> Upload file</a>';									
											$button3 	= '<button data-toggle="dropdown" '.$disable.' id="btnGroupDrop3" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
											$subbutton	= $btnE3_upl;
									
											$aksi='<left>
														<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
															'.$button3.'
															</button><ul class="dropdown-menu" >
															
															<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>																  
																  '.$subbutton.'
															</div> 
														</div>
												
													</left>';	
			
													
													
											
											$html.='<tr>
														<td style="width:30px">		
															<input type="file" name="fileuploadE3_'.$xno.'_'.$cnext.'" id="fileuploadE3_'.$xno.'_'.$cnext.'" value="" onchange="validateFormat(this,'.$celemen.','.$xno.','.$cnext.')" />
														</td>
																			
														<td>
															<textarea  style="font-size:10pt;display : none;" class="form-control"  id="uraianE3_'.$xno.'_'.$cnext.'" name="uraianE3_'.$xno.'_'.$cnext.'" rows="2"></textarea>

														</td>				 
																			
														<td>
															'.$aksi.'
														</td>
														
														
														
													</tr>';	
													
											$html.='</tbody>
									</table>
								</div>

								<div class="col-sm-3"> 
									<div class="col-sm-12"><a><b>VERIFIKASI DATA</b></a>

										 <select '.$disable_verif.' name="cverifikasiE3_'.$xno.'" id="cverifikasiE3_'.$xno.'" class="form-control input-sm" onchange="verifikasi('.$celemen.','.$xno.')" style="color:'.$color.'">
											<option value="0" ></option>
											<option style="color:red" value="1" >TIDAK SESUAI</option>
											<option style="color:green" value="2" >SESUAI</option>
										  </select><br>
									</div>
									
									<script>
										$("#cverifikasiE3_"+'.$xno.').val('.$cverifikasi.');
										$("#cverifikasiE3_"+'.$xno.').select2().trigger("change"); 
									</script>
									
									
									<div id="divCatatanE3_'.$xno.'" class="col-sm-12" '.$divhidden.'><a><b>CATATAN</b></a>
										<textarea  '.$disable_verif.' style="font-size:10pt;" class="form-control"  id="catatanE3_'.$xno.'" name="catatanE3_'.$xno.'" rows="4">'.$catatan.'</textarea>
										
										<div '.$hidden_verif.'><br>
											<button type="button" hidden class="btn btn-success btn-lg simpan-verif" data-elemen="'.$celemen.'" data-topik="'.$ckdtopik.'" data-penilaian="'.$ckd_penilaian.'" data-nomor="'.$xno.'" hidden><i class="fa fa-check-square"></i> VERIFIKASI</button>
											</div><i style="font-size:8pt;">'.$cinfo_verif.'<br>'.$cverif_at.'</i>
									
									</div>
									
								</div>';		
									
							
							}					
						}					
					}
			
			
			
				$html.='<div class="col-sm-12">
				
				 <fieldset>
						<legend style="background-color: #EDDFB3; font-size:10pt;"><b>&nbsp;</b>
							<div class="col-sm-12" >											
								
								<div class="col-sm-9" >
									<label style="align:center"><b><i>Simpulan Pemenuhan '.$cno.' : '.$cnm_topik.'</i></b>
								  
									</label>
								</div>
								
								
								
								 <div class="col-sm-3">
								 '.$iconjawab.'
								  <div class="progress-bar progress-bar-striped active" role="progressbar"
										aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:'.$persenjawab.'%;margin-top:-10%;" >
									'.$persenjawab.'%
								  </div><br>
								</div>
								
							</div>
							
							
						</legend>	
				</fieldset>
				</div>	';
						
			}			
	
			$kembali='kapip-dataumum-profil-apip';
			$html .='</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


 
<div class="panel-footer">
	<center>';
	
	
	$html .='<button type="button"  onclick="kembali()" class="btn btn-danger btn-lg" ><i class="fa fa-arrow-circle-left"></i> KEMBALI</button>'; 
	$html .='<button type="button" '.$disable.' class="btn btn-success btn-lg simpan-elemen3" data-jml="'.$xno.'" data-jmltopik="'.$cno.'"><i class="fa fa-check-square"></i> SIMPAN</button>
			
	</center>
	</form>
</div>';

	
	

			
			return $html;
		}



		public function viewElemen4($ctahun,$cinstansi,$clevel)
		{
			
			$celemen=4;
			$akses = $this->session->userdata('is_admin');
			
	    	
			if($akses == 1){
				$disable_verif='';
				$hidden_verif='';
				
			}else{
				
				$disable_verif='disabled';
				$hidden_verif='hidden';
				
			}


			$query = "SELECT simpulan,(select ifnull(MAX(kd_level),0) FROM tsimpulan WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND simpulan='1')maxsimpul from tsimpulan WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND  kd_level='".$clevel."'";
			$data = $this->db->query($query)->result();
						
			foreach ($data as $value) {

				$csimpulan=$value->simpulan;
				$cmaxsimpul=$value->maxsimpul;

			}
			
			if($csimpulan==1){
				
				$disable="disabled";
				$cinfo ="( Read Only )";
			}else{
				
				$disable="";
				$cinfo ="";
			} 			
					
			$query="SELECT DISTINCT a.kd_topik,b.nm_topik,IFNULL(a.simpulan_pemenuhan,0)simpulan_pemenuhan
			FROM tlevel a INNER JOIN ttopik b ON a.tahun=b.tahun AND a.kd_apip=b.kd_apip
					AND a.kd_elemen=b.kd_elemen AND a.kd_topik=b.kd_topik WHERE a.tahun='".$ctahun."' AND a.kd_apip='".$cinstansi."' AND a.kd_elemen='".$celemen."' AND a.kd_level='".$clevel."'
					ORDER BY kd_topik";	
				
			$data = $this->db->query($query)->result();
			
			$html = "";
			



				$html .='<div class="row">
									<div class="col-md-12">
										<div class="product-status mg-b-15">
											<div class="container-fluid">
												<div class="row">
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
														<div class="product-status-wrap">';
														
														
			
			$html .='<input type="hidden" name="ptahun"  value='.$ctahun.' class="form-control input-sm" id="ptahun">
					 <input type="hidden" name="pkdinstansi"  value='.$cinstansi.' class="form-control input-sm" id="pkdinstansi">';
			$cno = 0;
			$xno = 0; 
			foreach ($data as $value) {
				$cno++;
				
				$ckd_topik=$value->kd_topik;
				$cnm_topik=$value->nm_topik;
				$csimpulan_pemenuhan=$value->simpulan_pemenuhan;
				
				
				if($csimpulan_pemenuhan==1){
						$chksimpul="checked";
					}else{
						$chksimpul="";
					} 
					
					
		$sql = "SELECT acc,nacc,(acc+nacc)jml,((acc/(acc+nacc))*100)persen FROM(
				SELECT SUM(acc)acc,SUM(nacc)nacc FROM(
				SELECT COUNT(*)acc,0 nacc FROM tpenilaian WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' and kd_topik='".$ckd_topik."' AND kd_level='".$clevel."' AND jawaban=1
				UNION
				SELECT 0 acc,COUNT(*)nacc FROM tpenilaian WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' and kd_topik='".$ckd_topik."' AND kd_level='".$clevel."' AND jawaban=0
				)z)zz";
				
		$persenjawab = $this->db->query($sql)->row()->persen;	
		
		$persenjawab=number_format($persenjawab, "0", ",", ".");
		
		if($persenjawab==100){
			$iconjawab='<span class="fa fa-check-square-o fa-3x" aria-hidden="true" style="color: #3CCF4E; margin-left:108%;margin-top:-5px">
							  </span>';
		}else{
			$iconjawab='<span  class="fa fa-window-close-o fa-3x" aria-hidden="true" style="color: #fc544b; margin-left:108%; margin-top:-5%">
							</span>';
		}
			

	
				$html .='<input type="hidden" name="hkd_topiksimpulE4_'.$cno.'"  value='.$ckd_topik.' class="form-control input-sm" id="hkd_topiksimpulE4_'.$cno.'">';
				
				$html.='<div class="col-md-12"><br> 
								<h3 class="panel-title"><i class="fa fa-ravelry" ></i>  <b> <lebel id="lbtopik" style="text-align: left;">Topik '.$cno.' : '.$cnm_topik.'</label></b> </h3>
						<br></div>';
				
						$query2="select *from tpenilaian WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' AND kd_level='".$clevel."' and kd_topik='".$ckd_topik."'
								ORDER BY kd_penilaian";	
							
						$data2 = $this->db->query($query2)->result();
						
							$dno=0;
							$xpilihan='';
							foreach ($data2 as $value2) {
								$dno++;
								$xno++;
								
								$ckd_elemen=$value2->kd_elemen;
								$ckd_penilaian=$value2->kd_penilaian;
								$curaian=$value2->uraian;
								$cpenjelasan=$value2->penjelasan;
								$cbukti=$value2->bukti;
								$clangkah=$value2->langkah;
								$cjawaban=$value2->jawaban;
								$cverifikasi=$value2->verifikasi;
								$cverif_at=$value2->verif_at;
								$cuser_verif=$value2->user_verif;
								$catatan=$value2->catatan;
								$chpoin=$value2->hpoin;
								$cdpoin=$value2->dpoin;
								
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
								
						
								
								if($cverifikasi==1){  // tidak sesuai
									$color="red";
									$cinfo_verif='di Verifikasi tanggal';
									$cverif_at=$this->PublicModel->tanggal_waktu_indonesia($cverif_at); //$disable=$cverifikasi;
									
									if($csimpulan==1){
										$disable='disabled';
									}else{
										$disable='';
									}
									
									
									
								}else if($cverifikasi==2){  // sesuai
									$color="green";
									$cinfo_verif='di Verifikasi tanggal';
									$cverif_at=$this->PublicModel->tanggal_waktu_indonesia($cverif_at);
									$disable='disabled';
									
									
									
								}else{
									$color="black";
									$cinfo_verif='';
									$cverif_at=''; //$disable=$cverifikasi;
									if($csimpulan==1){
										$disable='disabled';
									}else{
										$disable='';
									}
								}
								
								
								if($cjawaban==1){
									$chk="checked";
								}else{
									$chk="";
								} 
								
								
								if($cuser_verif==null){
									
									$divhidden="hidden";
								}else{
									$divhidden="";
								}
								
								
								
								
								$search = array("/", " ", ":", "*", "?", "&#34;", "<", ">",".");
								$searchdok = array("/", " ", ":", "*", "?", "&#34;", "<", ">", "|");
								$replace = array("_", "_", "_", "_", "_", "_", "_", "_", "_");
							
								$ctahun 		= str_replace($search, $replace, $ctahun);
								$cinstansi 		= str_replace($search, $replace, $cinstansi);
								$celemen 		= str_replace($search, $replace, $ckd_elemen);
								$clevel 		= str_replace($search, $replace, $clevel);
								$ckdtopik 		= str_replace($search, $replace, $ckd_topik);
								$ckdpenilaian 	= str_replace($search, $replace, $ckd_penilaian);
								
								
						
								$folder5		= 'assets/file_upload/ekapip_dokumen/'.$ctahun.'/'.'Instansi'.$cinstansi.'/'.'Elemen'.$celemen.'/'.'Level'.$clevel.'/'.'Topik'.$ckdtopik.'/'.'Penilaian'.$ckdpenilaian.'/';

								$cdokumen=$value2->dokumen;

								$xno2='1';
										
								$html .='<input type="hidden" name="hkd_topikE4_'.$xno.'"  value='.$ckdtopik.' class="form-control input-sm" id="hkd_topikE4_'.$xno.'">';
								$html .='<input type="hidden" name="hkd_penilaianE4_'.$xno.'"  value='.$ckdpenilaian.' class="form-control input-sm" id="hkd_penilaianE4_'.$xno.'">';
							
							
							
								if($cpenjelasan==''){
									
									$html.='<div class="col-md-12" style="margin-left: 25px"> <br>
								
											
												<fieldset>
														<details>

															<summary style="font-size: 13px;color: black; text-align: left; " data-toggle="tooltip" data-placement="top" title="Klik Penjelasan Pemenuhan Topik Penilaian KAPIP">
																
																<div class="col-md-11" style="margin-left: 25px; cursor: pointer;"> 
																		<div class="col-md-1"><lebel style="text-align: left;">'.$cpoin.'</label></div> 
																		<div class="col-md-11" style="margin-left: -5%"><lebel style="text-align: left;">'.$curaian.'</label></div><br> 
																</div> 
															</summary> 
															
															
													</details>		
												</fieldset>			
										
										</div>'; 	
									
									
								}else{							
							
							
										$html.='<div class="col-md-12" style="margin-left: 25px"> <br>
								
											
											<fieldset>
													<details>

														<summary style="font-size: 13px;color: black; text-align: left; " data-toggle="tooltip" data-placement="top" title="Klik Penjelasan Pemenuhan Topik Penilaian KAPIP">
															<div class="col-md-11" style="margin-left: 25px; cursor: pointer;"> 
																	<div class="col-md-1"><lebel style="text-align: left;">'.$cpoin.'</label></div> 
																	<div class="col-md-11" style="margin-left: -5%"><lebel style="text-align: left;">'.$curaian.'</label> <i class="fa fa-caret-square-o-down fa-lg" style="color: #18978F;" ></i><br><br></div>															</div> 
														</summary> 
														
														<div class="col-md-11" style="margin-left: 45px"> 
																	<lebel style="text-align: left; font-size: 14px;color: #18978F;"><b>Penjelasan Uraian Aspek</b></label>
																	<textarea style="font-size:10pt;" class="form-control" readonly  rows="4">'.$cpenjelasan.'</textarea>
															<br>
														</div>
														
														<div class="col-md-11" style="margin-left: 45px"> 
																	<lebel style="text-align: left; font-size: 14px;color: #18978F;"><b>Contoh Bukti Dukung</b></label>
																	<textarea style="font-size:10pt;" class="form-control" readonly rows="4">'.$cbukti.'</textarea>
																	
															<br>
														</div>
														
												</details>		
											</fieldset>			
										
											
											<div class="col-sm-5" style="margin-left: 35px">											
												<label class="switch">
												  <input type="checkbox" onchange="checkPilihan()" '.$disable.' id="cpilihanE4_'.$xno.'" '.$chk.' value='.$cjawaban.'>
												  <div class="slider"></div>
												</label>
											</div>
											

										</div>'; 
							
										
							
							
							if($csimpulan==1){
									$btnE4_upl ='';
								}else{
									$xno2=1;
									$btnE4_upl 		= '<a class="list-group-item list-group-item-action "  onclick="uploadFileE4('.$celemen.','.$xno.','.$xno2.')"; ><i class="fa fa-cloud-upload fa-1x" aria-hidden="true" style="color: #006E7F" ></i> Upload File</a>';
								
									
								}
								
									$button3 		= '<button data-toggle="dropdown"  id="btnGroupDrop4" class="btn btn-info btn-sm dropdown-toggle '.$disable.'" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';									
									$subbutton=$btnE4_upl;
									
							
							
									$aksi='<center>
										<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
											'.$button3.'
											</button><ul class="dropdown-menu" >
											<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
												  
												  '.$subbutton.'
												
											</div> 
										  </div>
										
									</center>';
							
							
							
							$sql = "SELECT IFNULL(MAX(kd_file),0)+1 fnext FROM tpenilaian_lamp WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' and kd_topik='".$ckdtopik."' AND kd_level='".$clevel."' AND kd_penilaian='".$ckdpenilaian."'";	
							$kdfield = $this->db->query($sql)->row()->fnext;	
							
							if($kdfield==1){ // data baru
								
								if($csimpulan==1){
									$btnE4_upl ='';
								}else{
									$btnE4_upl 		= '<a class="list-group-item list-group-item-action "  onclick="uploadFileE4('.$celemen.','.$xno.','.$xno2.')"; ><i class="fa fa-cloud-upload fa-1x" aria-hidden="true" style="color: #006E7F" ></i> Upload File</a>';
								
									
								}
								
									$button3 		= '<button data-toggle="dropdown"  id="btnGroupDrop4" class="btn btn-info btn-sm dropdown-toggle '.$disable.'" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';									
									$subbutton=$btnE4_upl;
									
							
							
									$aksi='<center>
										<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
											'.$button3.'
											</button><ul class="dropdown-menu" >
											<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
												  
												  '.$subbutton.'
												
											</div> 
										  </div>
										
									</center>';		
												
								
						$html.='<div class="col-sm-8" style="margin-left: 80px;">
									<table id="xx" class="table table-bordered table-striped" style="width:100%;" border="0">
										<tbody id="data-profil-4">
										
										<thead>
											<tr>
												
												<th style="text-align:center;width:250px;color:black"><b>FILE UPLOAD</b></th>
												<th style="text-align:center;width:500px;color:black"><b>KETERANGAN</b></th>
												<th style="text-align:center;width:10px;"></th>
												
											</tr>
										</thead>';
										
										
										
										
												$xno2='1';
									
											$html.='<tr>
														<td style="width:30px">		
															<input type="file" name="fileuploadE4_'.$xno.'_'.$xno2.'" id="fileuploadE4_'.$xno.'_'.$xno2.'" value="" onchange="validateFormat(this,'.$celemen.','.$xno.','.$xno2.')" />
														</td>
																			
														<td>
															<textarea  style="font-size:10pt;display : none;" class="form-control"  id="uraianE4_'.$xno.'_'.$xno2.'" name="uraianE4_'.$xno.'_'.$xno2.'" rows="2"></textarea>

														</td>				 
																			
														<td>
															'.$aksi.'
														</td>
														
													</tr>';				
				
											
									$html.='
											
									</tbody>
							</table>
						</div>	
				
						
						<div class="col-sm-3"> 
									<div class="col-sm-12"><a><b>VERIFIKASI DATA</b></a>

										 <select '.$disable_verif.' name="cverifikasiE4_'.$xno.'" id="cverifikasiE4_'.$xno.'" class="form-control input-sm" onchange="verifikasi('.$celemen.','.$xno.')" style="color:'.$color.'">
											<option value="0" ></option>
											<option style="color:red" value="1" >TIDAK SESUAI</option>
											<option style="color:green" value="2" >SESUAI</option>
										  </select><br>
									</div>
									
									<script>
										$("#cverifikasiE4_"+'.$xno.').val('.$cverifikasi.');
										$("#cverifikasiE4_"+'.$xno.').select2().trigger("change"); 
									</script>
									
									
									<div id="divCatatanE4_'.$xno.'" class="col-sm-12" '.$divhidden.'><a><b>CATATAN</b></a>
										<textarea  '.$disable_verif.' style="font-size:10pt;" class="form-control"  id="catatanE4_'.$xno.'" name="catatanE4_'.$xno.'" rows="4">'.$catatan.'</textarea>
										
										<div '.$hidden_verif.'><br>
											<button type="button" hidden class="btn btn-success btn-lg simpan-verif" data-elemen="'.$celemen.'" data-topik="'.$ckdtopik.'" data-penilaian="'.$ckd_penilaian.'" data-nomor="'.$xno.'" hidden><i class="fa fa-check-square"></i> VERIFIKASI</button>
											</div><i style="font-size:8pt;">'.$cinfo_verif.'<br>'.$cverif_at.'</i>
									
									</div>
									
								
								</div>';				
														

								
										
								
								
							}else{     // data sudah ada
									
								
							
								$query3="select *from tpenilaian_lamp WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' AND kd_level='".$clevel."' and kd_topik='".$ckd_topik."' and kd_penilaian='".$ckd_penilaian."'
										 ORDER BY kd_penilaian";	
								
								$data3 = $this->db->query($query3)->result();
							
								$cno3=0;
								
								$html.='<div class="col-sm-8" style="margin-left: 80px;">
											<table id="xx" class="table table-bordered table-striped" style="width:100%;" border="0">
												<tbody id="data-profil-4">
												
												<thead>
													<tr>
														
														<th style="text-align:center;width:250px;color:black"><b>FILE UPLOAD</b></th>
														<th style="text-align:center;width:500px;color:black"><b>KETERANGAN</b></th>
														<th style="text-align:center;width:10px;"></th>
														
													</tr>
												</thead>';
												
												
												
								
								foreach ($data3 as $value3) {
									$cno3++;
									
									$ctahun=$value3->tahun;
									$cinstansi=$value3->kd_apip;
									$celemen=$value3->kd_elemen;
									$ctopik=$value3->kd_topik;
									$clevel=$value3->kd_level;
									$cpenilaian=$value3->kd_penilaian;
									$cfile=$value3->kd_file;
									$cnmfile=$value3->nm_file;
									$cinformasi=$value3->uraian;
									$ctanggal=$this->PublicModel->tanggal_waktu_indonesia($value3->insert_at);
							
									
							
									$clink			= "<a href='".base_url().$folder5.$value3->nm_file."' target= '_blank' class='list-group-item list-group-item-action' ><i class='fa fa-file-text-o fa-1x' aria-hidden='true' style='color: #069A8E'></i> Lihat File</a>";
					
									$btnE4_View = $clink;
									
									$clink2			= "<a href='".base_url().$folder5.$value3->nm_file."' target= '_blank' class='list-group-item list-group-item-action' ><i class='fa fa-file-text-o fa-1x' aria-hidden='true' style='color: #069A8E'></i></a>";
				
		
									$aa="hapusFileE4('".$ctahun."','".$cinstansi."','".$celemen."','".$ctopik."','".$clevel."','".$cpenilaian."','".$cfile."','".$cnmfile."')";
								
										if($csimpulan==1){
											$btnE4_Del = '';
										}else{
											
											if($cverifikasi==2){
													$btnE4_Del = '';
											}else{
												
													$btnE4_Del = '<a class="list-group-item list-group-item-action" onclick='.$aa.' ><i class="fa fa-trash-o fa-1x" aria-hidden="true" style="color: #EB1D36"></i> Hapus File</a>';
	
											}
											
																			
										}
									
											$button3 = '<button data-toggle="dropdown"  id="btnGroupDrop4" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
			
											$subbutton=$btnE4_View.$btnE4_Del;
									
											$aksi='<left>
														<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
															'.$button3.'
															</button><ul class="dropdown-menu" >
															
															<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>																  
																  '.$subbutton.'
															</div> 
														</div>
												
													</left>';		
													
											
												if($cno3==1){
													
													$margin='style="margin-top: -30px"';
													$marginaksi='style="margin-left: -25px;margin-top: -3px;"';
													$br ="";
												}else{
													
													$margin='style="margin-top: -55px"';
													$marginaksi='style="margin-left: -25px;margin-top: -25px;"';
													$br ="<br>";
													
												}
												
												$html.='
															<div class="col-sm-5" style="margin-left: 35px">
																	&nbsp;
															</div>';
								
												$cinput='';
								
										$html.='<tr>
													<td style="width:30px">	
														<div class="col-sm-3">	
														
														
															<a href='.base_url().$folder5.$value3->nm_file.' target= "_blank" title="Lihat File"> <i class="fa fa-file-pdf-o fa-3x" style="color: #EB1D36" aria-hidden="true"></i></a>

														</div>
															<div class="col-sm-9">	
																<a><b>'.$value3->nm_file.'</b></a><br><a style="font-size:8pt"><i>di upload tanggal <br>'.$ctanggal.'</i></a>
															</div>	
														
															<input type="hidden" name="kdfileuploadE4_'.$xno.'_'.$cno3.'" id="kdfileuploadE4_'.$xno.'_'.$cno3.'" value="'.$value3->kd_file.'"  class="form-control" />

													</td>
																		
    
													<td>
														<textarea  readonly class="form-control" 
															style="font-size:10pt;color: #000;background: transparent;border: none;outline: none;" 
															id="uraianE4_'.$xno.'_'.$cno3.'" name="uraianE4_'.$xno.'_'.$cno3.'" rows="2" >'.$cinformasi.'
														</textarea>
													</td>				 
																		
													<td>
														'.$aksi.'
													</td>
												</tr>';	
												
								}
								
								
																
											$cnext=$cno3+1;	
													
											$btnE4_upl	= '<a class="list-group-item list-group-item-action "  onclick="uploadFileE4('.$celemen.','.$xno.','.$cnext.')"; ><i class="fa fa-cloud-upload fa-1x" aria-hidden="true" style="color: #006E7F" ></i> Upload file</a>';									
											$button3 	= '<button data-toggle="dropdown" '.$disable.' id="btnGroupDrop4" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
											$subbutton	= $btnE4_upl;
									
											$aksi='<left>
														<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
															'.$button3.'
															</button><ul class="dropdown-menu" >
															
															<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>																  
																  '.$subbutton.'
															</div> 
														</div>
												
													</left>';	
			
													
													
											
											$html.='<tr>
														<td style="width:30px">		
															<input type="file" name="fileuploadE4_'.$xno.'_'.$cnext.'" id="fileuploadE4_'.$xno.'_'.$cnext.'" value="" onchange="validateFormat(this,'.$celemen.','.$xno.','.$cnext.')" />
														</td>
																			
														<td>
															<textarea  style="font-size:10pt;display : none;" class="form-control"  id="uraianE4_'.$xno.'_'.$cnext.'" name="uraianE4_'.$xno.'_'.$cnext.'" rows="2"></textarea>

														</td>				 
																			
														<td>
															'.$aksi.'
														</td>
														
														
														
													</tr>';	
													
											$html.='</tbody>
									</table>
								</div>

								<div class="col-sm-3"> 
									<div class="col-sm-12"><a><b>VERIFIKASI DATA</b></a>

										 <select '.$disable_verif.' name="cverifikasiE4_'.$xno.'" id="cverifikasiE4_'.$xno.'" class="form-control input-sm" onchange="verifikasi('.$celemen.','.$xno.')" style="color:'.$color.'">
											<option value="0" ></option>
											<option style="color:red" value="1" >TIDAK SESUAI</option>
											<option style="color:green" value="2" >SESUAI</option>
										  </select><br>
									</div>
									
									<script>
										$("#cverifikasiE4_"+'.$xno.').val('.$cverifikasi.');
										$("#cverifikasiE4_"+'.$xno.').select2().trigger("change"); 
									</script>
									
									
									<div id="divCatatanE4_'.$xno.'" class="col-sm-12" '.$divhidden.'><a><b>CATATAN</b></a>
										<textarea  '.$disable_verif.' style="font-size:10pt;" class="form-control"  id="catatanE4_'.$xno.'" name="catatanE4_'.$xno.'" rows="4">'.$catatan.'</textarea>
										
										<div '.$hidden_verif.'><br>
											<button type="button" hidden class="btn btn-success btn-lg simpan-verif" data-elemen="'.$celemen.'" data-topik="'.$ckdtopik.'" data-penilaian="'.$ckd_penilaian.'" data-nomor="'.$xno.'" hidden><i class="fa fa-check-square"></i> VERIFIKASI</button>
											</div><i style="font-size:8pt;">'.$cinfo_verif.'<br>'.$cverif_at.'</i>
									
									</div>
									
								</div>';		
									
							
							}					
						}					
					}
			
			
			
				$html.='<div class="col-sm-12">
				
				 <fieldset>
						<legend style="background-color: #EDDFB3; font-size:10pt;"><b>&nbsp;</b>
							<div class="col-sm-12" >											
								
								<div class="col-sm-9" >
									<label style="align:center"><b><i>Simpulan Pemenuhan '.$cno.' : '.$cnm_topik.'</i></b>
								  
									</label>
								</div>
								
								
								
								 <div class="col-sm-3">
								 '.$iconjawab.'
								  <div class="progress-bar progress-bar-striped active" role="progressbar"
										aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:'.$persenjawab.'%;margin-top:-10%;" >
									'.$persenjawab.'%
								  </div><br>
								</div>
								
							</div>
							
							
						</legend>	
				</fieldset>
				</div>	';
			
			
							/* <div class="col-sm-3">	
									<label class="switch" style="margin-left: 28px;">
									  <input '.$aktifsimpul.' type="checkbox" onchange="checkSimpulan('.$xpilihan.')" id="chsimpulE4_'.$cno.'" '.$chksimpul.' value='.$csimpulan_pemenuhan.'>
									  <div class="slider"></div>
									</label>
								</div> */
			
			
			}			
	
			$kembali='kapip-dataumum-profil-apip';
			$html .='</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


 
<div class="panel-footer">
	<center>';
	
	
	$html .='<button type="button"  onclick="kembali()" class="btn btn-danger btn-lg" ><i class="fa fa-arrow-circle-left"></i> KEMBALI</button>'; 
	$html .='<button type="button" '.$disable.' class="btn btn-success btn-lg simpan-elemen4" data-jml="'.$xno.'" data-jmltopik="'.$cno.'"><i class="fa fa-check-square"></i> SIMPAN</button>
			
	</center>
	</form>
</div>';

	
	

			
			return $html;
		}


		public function viewElemen5($ctahun,$cinstansi,$clevel)
		{
			
			$celemen=5;
			$akses = $this->session->userdata('is_admin');
			
	    	
			if($akses == 1){
				$disable_verif='';
				$hidden_verif='';
				
			}else{
				
				$disable_verif='disabled';
				$hidden_verif='hidden';
				
			}


			$query = "SELECT simpulan,(select ifnull(MAX(kd_level),0) FROM tsimpulan WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND simpulan='1')maxsimpul from tsimpulan WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND  kd_level='".$clevel."'";
			$data = $this->db->query($query)->result();
						
			foreach ($data as $value) {

				$csimpulan=$value->simpulan;
				$cmaxsimpul=$value->maxsimpul;

			}
			
			if($csimpulan==1){
				
				$disable="disabled";
				$cinfo ="( Read Only )";
			}else{
				
				$disable="";
				$cinfo ="";
			} 			
					
			$query="SELECT DISTINCT a.kd_topik,b.nm_topik,IFNULL(a.simpulan_pemenuhan,0)simpulan_pemenuhan
			FROM tlevel a INNER JOIN ttopik b ON a.tahun=b.tahun AND a.kd_apip=b.kd_apip
					AND a.kd_elemen=b.kd_elemen AND a.kd_topik=b.kd_topik WHERE a.tahun='".$ctahun."' AND a.kd_apip='".$cinstansi."' AND a.kd_elemen='".$celemen."' AND a.kd_level='".$clevel."'
					ORDER BY kd_topik";	
				
			$data = $this->db->query($query)->result();
			
			$html = "";
			



				$html .='<div class="row">
									<div class="col-md-12">
										<div class="product-status mg-b-15">
											<div class="container-fluid">
												<div class="row">
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
														<div class="product-status-wrap">';
														
														
			
			$html .='<input type="hidden" name="ptahun"  value='.$ctahun.' class="form-control input-sm" id="ptahun">
					 <input type="hidden" name="pkdinstansi"  value='.$cinstansi.' class="form-control input-sm" id="pkdinstansi">';
			$cno = 0;
			$xno = 0; 
			foreach ($data as $value) {
				$cno++;
				
				$ckd_topik=$value->kd_topik;
				$cnm_topik=$value->nm_topik;
				$csimpulan_pemenuhan=$value->simpulan_pemenuhan;
				
				
				if($csimpulan_pemenuhan==1){
						$chksimpul="checked";
					}else{
						$chksimpul="";
					} 
					
					
		$sql = "SELECT acc,nacc,(acc+nacc)jml,((acc/(acc+nacc))*100)persen FROM(
				SELECT SUM(acc)acc,SUM(nacc)nacc FROM(
				SELECT COUNT(*)acc,0 nacc FROM tpenilaian WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' and kd_topik='".$ckd_topik."' AND kd_level='".$clevel."' AND jawaban=1
				UNION
				SELECT 0 acc,COUNT(*)nacc FROM tpenilaian WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' and kd_topik='".$ckd_topik."' AND kd_level='".$clevel."' AND jawaban=0
				)z)zz";
				
		$persenjawab = $this->db->query($sql)->row()->persen;	
		
		$persenjawab=number_format($persenjawab, "0", ",", ".");
		
		if($persenjawab==100){
			$iconjawab='<span class="fa fa-check-square-o fa-3x" aria-hidden="true" style="color: #3CCF4E; margin-left:108%;margin-top:-5px">
							  </span>';
		}else{
			$iconjawab='<span  class="fa fa-window-close-o fa-3x" aria-hidden="true" style="color: #fc544b; margin-left:108%; margin-top:-5%">
							</span>';
		}
			

	
				$html .='<input type="hidden" name="hkd_topiksimpulE5_'.$cno.'"  value='.$ckd_topik.' class="form-control input-sm" id="hkd_topiksimpulE5_'.$cno.'">';
				
				$html.='<div class="col-md-12"><br> 
								<h3 class="panel-title"><i class="fa fa-ravelry" ></i>  <b> <lebel id="lbtopik" style="text-align: left;">Topik '.$cno.' : '.$cnm_topik.'</label></b> </h3>
						<br></div>';
				
						$query2="select *from tpenilaian WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' AND kd_level='".$clevel."' and kd_topik='".$ckd_topik."'
								ORDER BY kd_penilaian";	
							
						$data2 = $this->db->query($query2)->result();
						
							$dno=0;
							$xpilihan='';
							foreach ($data2 as $value2) {
								$dno++;
								$xno++;
								
								$ckd_elemen=$value2->kd_elemen;
								$ckd_penilaian=$value2->kd_penilaian;
								$curaian=$value2->uraian;
								$cpenjelasan=$value2->penjelasan;
								$cbukti=$value2->bukti;
								$clangkah=$value2->langkah;
								$cjawaban=$value2->jawaban;
								$cverifikasi=$value2->verifikasi;
								$cverif_at=$value2->verif_at;
								$cuser_verif=$value2->user_verif;
								$catatan=$value2->catatan;
								$chpoin=$value2->hpoin;
								$cdpoin=$value2->dpoin;
								
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
								
						
								
								if($cverifikasi==1){  // tidak sesuai
									$color="red";
									$cinfo_verif='di Verifikasi tanggal';
									$cverif_at=$this->PublicModel->tanggal_waktu_indonesia($cverif_at); //$disable=$cverifikasi;
									
									if($csimpulan==1){
										$disable='disabled';
									}else{
										$disable='';
									}
									
									
									
								}else if($cverifikasi==2){  // sesuai
									$color="green";
									$cinfo_verif='di Verifikasi tanggal';
									$cverif_at=$this->PublicModel->tanggal_waktu_indonesia($cverif_at);
									$disable='disabled';
									
									
									
								}else{
									$color="black";
									$cinfo_verif='';
									$cverif_at=''; //$disable=$cverifikasi;
									if($csimpulan==1){
										$disable='disabled';
									}else{
										$disable='';
									}
								}
								
								
								if($cjawaban==1){
									$chk="checked";
								}else{
									$chk="";
								} 
								
								
								if($cuser_verif==null){
									
									$divhidden="hidden";
								}else{
									$divhidden="";
								}
								
								
								
								
								$search = array("/", " ", ":", "*", "?", "&#34;", "<", ">",".");
								$searchdok = array("/", " ", ":", "*", "?", "&#34;", "<", ">", "|");
								$replace = array("_", "_", "_", "_", "_", "_", "_", "_", "_");
							
								$ctahun 		= str_replace($search, $replace, $ctahun);
								$cinstansi 		= str_replace($search, $replace, $cinstansi);
								$celemen 		= str_replace($search, $replace, $ckd_elemen);
								$clevel 		= str_replace($search, $replace, $clevel);
								$ckdtopik 		= str_replace($search, $replace, $ckd_topik);
								$ckdpenilaian 	= str_replace($search, $replace, $ckd_penilaian);
								
								
						
								$folder5		= 'assets/file_upload/ekapip_dokumen/'.$ctahun.'/'.'Instansi'.$cinstansi.'/'.'Elemen'.$celemen.'/'.'Level'.$clevel.'/'.'Topik'.$ckdtopik.'/'.'Penilaian'.$ckdpenilaian.'/';

								$cdokumen=$value2->dokumen;

								$xno2='1';
										
								$html .='<input type="hidden" name="hkd_topikE5_'.$xno.'"  value='.$ckdtopik.' class="form-control input-sm" id="hkd_topikE5_'.$xno.'">';
								$html .='<input type="hidden" name="hkd_penilaianE5_'.$xno.'"  value='.$ckdpenilaian.' class="form-control input-sm" id="hkd_penilaianE5_'.$xno.'">';
							
							
							
								if($cpenjelasan==''){
									
									$html.='<div class="col-md-12" style="margin-left: 25px"> <br>
								
											
												<fieldset>
														<details>

															<summary style="font-size: 13px;color: black; text-align: left; " data-toggle="tooltip" data-placement="top" title="Klik Penjelasan Pemenuhan Topik Penilaian KAPIP">
																
																<div class="col-md-11" style="margin-left: 25px; cursor: pointer;"> 
																		<div class="col-md-1"><lebel style="text-align: left;">'.$cpoin.'</label></div> 
																		<div class="col-md-11" style="margin-left: -5%"><lebel style="text-align: left;">'.$curaian.'</label></div><br> 
																</div> 
															</summary> 
															
															
													</details>		
												</fieldset>			
										
										</div>'; 	
									
									
								}else{							
							
							
										$html.='<div class="col-md-12" style="margin-left: 25px"> <br>
								
											
											<fieldset>
													<details>

														<summary style="font-size: 13px;color: black; text-align: left; " data-toggle="tooltip" data-placement="top" title="Klik Penjelasan Pemenuhan Topik Penilaian KAPIP">
															<div class="col-md-11" style="margin-left: 25px; cursor: pointer;"> 
																	<div class="col-md-1"><lebel style="text-align: left;">'.$cpoin.'</label></div> 
																	<div class="col-md-11" style="margin-left: -5%"><lebel style="text-align: left;">'.$curaian.'</label> <i class="fa fa-caret-square-o-down fa-lg" style="color: #18978F;" ></i><br><br><div>															</div> 
														</summary> 
														
														<div class="col-md-11" style="margin-left: 45px"> 
																	<lebel style="text-align: left; font-size: 14px;color: #18978F;"><b>Penjelasan Uraian Aspek</b></label>
																	<textarea style="font-size:10pt;" class="form-control" readonly  rows="4">'.$cpenjelasan.'</textarea>
															<br>
														</div>
														
														<div class="col-md-11" style="margin-left: 45px"> 
																	<lebel style="text-align: left; font-size: 14px;color: #18978F;"><b>Contoh Bukti Dukung</b></label>
																	<textarea style="font-size:10pt;" class="form-control" readonly rows="4">'.$cbukti.'</textarea>
																	
															<br>
														</div>
														
												</details>		
											</fieldset>			
										
											
											<div class="col-sm-5" style="margin-left: 35px">											
												<label class="switch">
												  <input type="checkbox" onchange="checkPilihan()" '.$disable.' id="cpilihanE5_'.$xno.'" '.$chk.' value='.$cjawaban.'>
												  <div class="slider"></div>
												</label>
											</div>
											

										</div>'; 
							
										
							
							
							if($csimpulan==1){
									$btnE5_upl ='';
								}else{
									$xno2=1;
									$btnE5_upl 		= '<a class="list-group-item list-group-item-action "  onclick="uploadFileE5('.$celemen.','.$xno.','.$xno2.')"; ><i class="fa fa-cloud-upload fa-1x" aria-hidden="true" style="color: #006E7F" ></i> Upload File</a>';
								
									
								}
								
									$button3 		= '<button data-toggle="dropdown"  id="btnGroupDrop5" class="btn btn-info btn-sm dropdown-toggle '.$disable.'" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';									
									$subbutton=$btnE5_upl;
									
							
							
									$aksi='<center>
										<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
											'.$button3.'
											</button><ul class="dropdown-menu" >
											<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
												  
												  '.$subbutton.'
												
											</div> 
										  </div>
										
									</center>';
							
							
							
							$sql = "SELECT IFNULL(MAX(kd_file),0)+1 fnext FROM tpenilaian_lamp WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' and kd_topik='".$ckdtopik."' AND kd_level='".$clevel."' AND kd_penilaian='".$ckdpenilaian."'";	
							$kdfield = $this->db->query($sql)->row()->fnext;	
							
							if($kdfield==1){ // data baru
								
								if($csimpulan==1){
									$btnE5_upl ='';
								}else{
									$btnE5_upl 		= '<a class="list-group-item list-group-item-action "  onclick="uploadFileE5('.$celemen.','.$xno.','.$xno2.')"; ><i class="fa fa-cloud-upload fa-1x" aria-hidden="true" style="color: #006E7F" ></i> Upload File</a>';
								
									
								}
								
									$button3 		= '<button data-toggle="dropdown"  id="btnGroupDrop5" class="btn btn-info btn-sm dropdown-toggle '.$disable.'" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';									
									$subbutton=$btnE5_upl;
									
							
							
									$aksi='<center>
										<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
											'.$button3.'
											</button><ul class="dropdown-menu" >
											<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
												  
												  '.$subbutton.'
												
											</div> 
										  </div>
										
									</center>';		
												
								
						$html.='<div class="col-sm-8" style="margin-left: 80px;">
									<table id="xx" class="table table-bordered table-striped" style="width:100%;" border="0">
										<tbody id="data-profil-5">
										
										<thead>
											<tr>
												
												<th style="text-align:center;width:250px;color:black"><b>FILE UPLOAD</b></th>
												<th style="text-align:center;width:500px;color:black"><b>KETERANGAN</b></th>
												<th style="text-align:center;width:10px;"></th>
												
											</tr>
										</thead>';
										
										
										
										
												$xno2='1';
									
											$html.='<tr>
														<td style="width:30px">		
															<input type="file" name="fileuploadE5_'.$xno.'_'.$xno2.'" id="fileuploadE5_'.$xno.'_'.$xno2.'" value="" onchange="validateFormat(this,'.$celemen.','.$xno.','.$xno2.')" />
														</td>
																			
														<td>
															<textarea  style="font-size:10pt;display : none;" class="form-control"  id="uraianE5_'.$xno.'_'.$xno2.'" name="uraianE5_'.$xno.'_'.$xno2.'" rows="2"></textarea>

														</td>				 
																			
														<td>
															'.$aksi.'
														</td>
														
													</tr>';				
				
											
									$html.='
											
									</tbody>
							</table>
						</div>	
				
						
						<div class="col-sm-3"> 
									<div class="col-sm-12"><a><b>VERIFIKASI DATA</b></a>

										 <select '.$disable_verif.' name="cverifikasiE5_'.$xno.'" id="cverifikasiE5_'.$xno.'" class="form-control input-sm" onchange="verifikasi('.$celemen.','.$xno.')" style="color:'.$color.'">
											<option value="0" ></option>
											<option style="color:red" value="1" >TIDAK SESUAI</option>
											<option style="color:green" value="2" >SESUAI</option>
										  </select><br>
									</div>
									
									<script>
										$("#cverifikasiE5_"+'.$xno.').val('.$cverifikasi.');
										$("#cverifikasiE5_"+'.$xno.').select2().trigger("change"); 
									</script>
									
									
									<div id="divCatatanE5_'.$xno.'" class="col-sm-12" '.$divhidden.'><a><b>CATATAN</b></a>
										<textarea  '.$disable_verif.' style="font-size:10pt;" class="form-control"  id="catatanE5_'.$xno.'" name="catatanE5_'.$xno.'" rows="4">'.$catatan.'</textarea>
										
										<div '.$hidden_verif.'><br>
											<button type="button" hidden class="btn btn-success btn-lg simpan-verif" data-elemen="'.$celemen.'" data-topik="'.$ckdtopik.'" data-penilaian="'.$ckd_penilaian.'" data-nomor="'.$xno.'" hidden><i class="fa fa-check-square"></i> VERIFIKASI</button>
											</div><i style="font-size:8pt;">'.$cinfo_verif.'<br>'.$cverif_at.'</i>
									
									</div>
									
								
								</div>';				
														

								
										
								
								
							}else{     // data sudah ada
									
								
							
								$query3="select *from tpenilaian_lamp WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' AND kd_level='".$clevel."' and kd_topik='".$ckd_topik."' and kd_penilaian='".$ckd_penilaian."'
										 ORDER BY kd_penilaian";	
								
								$data3 = $this->db->query($query3)->result();
							
								$cno3=0;
								
								$html.='<div class="col-sm-8" style="margin-left: 80px;">
											<table id="xx" class="table table-bordered table-striped" style="width:100%;" border="0">
												<tbody id="data-profil-5">
												
												<thead>
													<tr>
														
														<th style="text-align:center;width:250px;color:black"><b>FILE UPLOAD</b></th>
														<th style="text-align:center;width:500px;color:black"><b>KETERANGAN</b></th>
														<th style="text-align:center;width:10px;"></th>
														
													</tr>
												</thead>';
												
												
												
								
								foreach ($data3 as $value3) {
									$cno3++;
									
									$ctahun=$value3->tahun;
									$cinstansi=$value3->kd_apip;
									$celemen=$value3->kd_elemen;
									$ctopik=$value3->kd_topik;
									$clevel=$value3->kd_level;
									$cpenilaian=$value3->kd_penilaian;
									$cfile=$value3->kd_file;
									$cnmfile=$value3->nm_file;
									$cinformasi=$value3->uraian;
									$ctanggal=$this->PublicModel->tanggal_waktu_indonesia($value3->insert_at);
							
									
							
									$clink			= "<a href='".base_url().$folder5.$value3->nm_file."' target= '_blank' class='list-group-item list-group-item-action' ><i class='fa fa-file-text-o fa-1x' aria-hidden='true' style='color: #069A8E'></i> Lihat File</a>";
					
									$btnE5_View = $clink;
									
									$clink2			= "<a href='".base_url().$folder5.$value3->nm_file."' target= '_blank' class='list-group-item list-group-item-action' ><i class='fa fa-file-text-o fa-1x' aria-hidden='true' style='color: #069A8E'></i></a>";
				
		
									$aa="hapusFileE5('".$ctahun."','".$cinstansi."','".$celemen."','".$ctopik."','".$clevel."','".$cpenilaian."','".$cfile."','".$cnmfile."')";
								
										if($csimpulan==1){
											$btnE5_Del = '';
										}else{
											
											if($cverifikasi==2){
													$btnE5_Del = '';
											}else{
												
													$btnE5_Del = '<a class="list-group-item list-group-item-action" onclick='.$aa.' ><i class="fa fa-trash-o fa-1x" aria-hidden="true" style="color: #EB1D36"></i> Hapus File</a>';
	
											}
											
																			
										}
									
											$button3 = '<button data-toggle="dropdown"  id="btnGroupDrop5" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
			
											$subbutton=$btnE5_View.$btnE5_Del;
									
											$aksi='<left>
														<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
															'.$button3.'
															</button><ul class="dropdown-menu" >
															
															<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>																  
																  '.$subbutton.'
															</div> 
														</div>
												
													</left>';		
													
											
												if($cno3==1){
													
													$margin='style="margin-top: -30px"';
													$marginaksi='style="margin-left: -25px;margin-top: -3px;"';
													$br ="";
												}else{
													
													$margin='style="margin-top: -55px"';
													$marginaksi='style="margin-left: -25px;margin-top: -25px;"';
													$br ="<br>";
													
												}
												
												$html.='
															<div class="col-sm-5" style="margin-left: 35px">
																	&nbsp;
															</div>';
								
												$cinput='';
								
										$html.='<tr>
													<td style="width:30px">	
														<div class="col-sm-3">	
														
														
															<a href='.base_url().$folder5.$value3->nm_file.' target= "_blank" title="Lihat File"> <i class="fa fa-file-pdf-o fa-3x" style="color: #EB1D36" aria-hidden="true"></i></a>

														</div>
															<div class="col-sm-9">	
																<a><b>'.$value3->nm_file.'</b></a><br><a style="font-size:8pt"><i>di upload tanggal <br>'.$ctanggal.'</i></a>
															</div>	
														
															<input type="hidden" name="kdfileuploadE5_'.$xno.'_'.$cno3.'" id="kdfileuploadE5_'.$xno.'_'.$cno3.'" value="'.$value3->kd_file.'"  class="form-control" />

													</td>
																		
    
													<td>
														<textarea  readonly class="form-control" 
															style="font-size:10pt;color: #000;background: transparent;border: none;outline: none;" 
															id="uraianE5_'.$xno.'_'.$cno3.'" name="uraianE5_'.$xno.'_'.$cno3.'" rows="2" >'.$cinformasi.'
														</textarea>
													</td>				 
																		
													<td>
														'.$aksi.'
													</td>
												</tr>';	
												
								}
								
								
																
											$cnext=$cno3+1;	
													
											$btnE5_upl	= '<a class="list-group-item list-group-item-action "  onclick="uploadFileE5('.$celemen.','.$xno.','.$cnext.')"; ><i class="fa fa-cloud-upload fa-1x" aria-hidden="true" style="color: #006E7F" ></i> Upload file</a>';									
											$button3 	= '<button data-toggle="dropdown" '.$disable.' id="btnGroupDrop5" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
											$subbutton	= $btnE5_upl;
									
											$aksi='<left>
														<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
															'.$button3.'
															</button><ul class="dropdown-menu" >
															
															<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>																  
																  '.$subbutton.'
															</div> 
														</div>
												
													</left>';	
			
													
													
											
											$html.='<tr>
														<td style="width:30px">		
															<input type="file" name="fileuploadE5_'.$xno.'_'.$cnext.'" id="fileuploadE5_'.$xno.'_'.$cnext.'" value="" onchange="validateFormat(this,'.$celemen.','.$xno.','.$cnext.')" />
														</td>
																			
														<td>
															<textarea  style="font-size:10pt;display : none;" class="form-control"  id="uraianE5_'.$xno.'_'.$cnext.'" name="uraianE5_'.$xno.'_'.$cnext.'" rows="2"></textarea>

														</td>				 
																			
														<td>
															'.$aksi.'
														</td>
														
														
														
													</tr>';	
													
											$html.='</tbody>
									</table>
								</div>

								<div class="col-sm-3"> 
									<div class="col-sm-12"><a><b>VERIFIKASI DATA</b></a>

										 <select '.$disable_verif.' name="cverifikasiE5_'.$xno.'" id="cverifikasiE5_'.$xno.'" class="form-control input-sm" onchange="verifikasi('.$celemen.','.$xno.')" style="color:'.$color.'">
											<option value="0" ></option>
											<option style="color:red" value="1" >TIDAK SESUAI</option>
											<option style="color:green" value="2" >SESUAI</option>
										  </select><br>
									</div>
									
									<script>
										$("#cverifikasiE5_"+'.$xno.').val('.$cverifikasi.');
										$("#cverifikasiE5_"+'.$xno.').select2().trigger("change"); 
									</script>
									
									
									<div id="divCatatanE5_'.$xno.'" class="col-sm-12" '.$divhidden.'><a><b>CATATAN</b></a>
										<textarea  '.$disable_verif.' style="font-size:10pt;" class="form-control"  id="catatanE5_'.$xno.'" name="catatanE5_'.$xno.'" rows="4">'.$catatan.'</textarea>
										
										<div '.$hidden_verif.'><br>
											<button type="button" hidden class="btn btn-success btn-lg simpan-verif" data-elemen="'.$celemen.'" data-topik="'.$ckdtopik.'" data-penilaian="'.$ckd_penilaian.'" data-nomor="'.$xno.'" hidden><i class="fa fa-check-square"></i> VERIFIKASI</button>
											</div><i style="font-size:8pt;">'.$cinfo_verif.'<br>'.$cverif_at.'</i>
									
									</div>
									
								</div>';		
									
							
							}					
						}					
					}
			
			
			
				$html.='<div class="col-sm-12">
				
				 <fieldset>
						<legend style="background-color: #EDDFB3; font-size:10pt;"><b>&nbsp;</b>
							<div class="col-sm-12" >											
								
								<div class="col-sm-9" >
									<label style="align:center"><b><i>Simpulan Pemenuhan '.$cno.' : '.$cnm_topik.'</i></b>
								  
									</label>
								</div>
								
								
								
								 <div class="col-sm-3">
								 '.$iconjawab.'
								  <div class="progress-bar progress-bar-striped active" role="progressbar"
										aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:'.$persenjawab.'%;margin-top:-10%;" >
									'.$persenjawab.'%
								  </div><br>
								</div>
								
							</div>
							
							
						</legend>	
				</fieldset>
				</div>	';
						
			
			}			
	
			$kembali='kapip-dataumum-profil-apip';
			$html .='</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


 
<div class="panel-footer">
	<center>';
	
	
	$html .='<button type="button"  onclick="kembali()" class="btn btn-danger btn-lg" ><i class="fa fa-arrow-circle-left"></i> KEMBALI</button>'; 
	$html .='<button type="button" '.$disable.' class="btn btn-success btn-lg simpan-elemen5" data-jml="'.$xno.'" data-jmltopik="'.$cno.'"><i class="fa fa-check-square"></i> SIMPAN</button>
			
	</center>
	</form>
</div>';

	
	

			
			return $html;
		}



		public function viewElemen6($ctahun,$cinstansi,$clevel)
		{
			
			$celemen=6;
			$akses = $this->session->userdata('is_admin');
			
	    	
			if($akses == 1){
				$disable_verif='';
				$hidden_verif='';
				
			}else{
				
				$disable_verif='disabled';
				$hidden_verif='hidden';
				
			}


			$query = "SELECT simpulan,(select ifnull(MAX(kd_level),0) FROM tsimpulan WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND simpulan='1')maxsimpul from tsimpulan WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND  kd_level='".$clevel."'";
			$data = $this->db->query($query)->result();
						
			foreach ($data as $value) {

				$csimpulan=$value->simpulan;
				$cmaxsimpul=$value->maxsimpul;

			}
			
			if($csimpulan==1){
				
				$disable="disabled";
				$cinfo ="( Read Only )";
			}else{
				
				$disable="";
				$cinfo ="";
			} 			
					
			$query="SELECT DISTINCT a.kd_topik,b.nm_topik,IFNULL(a.simpulan_pemenuhan,0)simpulan_pemenuhan
			FROM tlevel a INNER JOIN ttopik b ON a.tahun=b.tahun AND a.kd_apip=b.kd_apip
					AND a.kd_elemen=b.kd_elemen AND a.kd_topik=b.kd_topik WHERE a.tahun='".$ctahun."' AND a.kd_apip='".$cinstansi."' AND a.kd_elemen='".$celemen."' AND a.kd_level='".$clevel."'
					ORDER BY kd_topik";	
				
			$data = $this->db->query($query)->result();
			
			$html = "";
			



				$html .='<div class="row">
									<div class="col-md-12">
										<div class="product-status mg-b-15">
											<div class="container-fluid">
												<div class="row">
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
														<div class="product-status-wrap">';
														
														
			
			$html .='<input type="hidden" name="ptahun"  value='.$ctahun.' class="form-control input-sm" id="ptahun">
					 <input type="hidden" name="pkdinstansi"  value='.$cinstansi.' class="form-control input-sm" id="pkdinstansi">';
			$cno = 0;
			$xno = 0; 
			foreach ($data as $value) {
				$cno++;
				
				$ckd_topik=$value->kd_topik;
				$cnm_topik=$value->nm_topik;
				$csimpulan_pemenuhan=$value->simpulan_pemenuhan;
				
				
				if($csimpulan_pemenuhan==1){
						$chksimpul="checked";
					}else{
						$chksimpul="";
					} 
					
					
		$sql = "SELECT acc,nacc,(acc+nacc)jml,((acc/(acc+nacc))*100)persen FROM(
				SELECT SUM(acc)acc,SUM(nacc)nacc FROM(
				SELECT COUNT(*)acc,0 nacc FROM tpenilaian WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' and kd_topik='".$ckd_topik."' AND kd_level='".$clevel."' AND jawaban=1
				UNION
				SELECT 0 acc,COUNT(*)nacc FROM tpenilaian WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' and kd_topik='".$ckd_topik."' AND kd_level='".$clevel."' AND jawaban=0
				)z)zz";
				
		$persenjawab = $this->db->query($sql)->row()->persen;	
		
		$persenjawab=number_format($persenjawab, "0", ",", ".");
		
		if($persenjawab==100){
			$iconjawab='<span class="fa fa-check-square-o fa-3x" aria-hidden="true" style="color: #3CCF4E; margin-left:108%;margin-top:-5px">
							  </span>';
		}else{
			$iconjawab='<span  class="fa fa-window-close-o fa-3x" aria-hidden="true" style="color: #fc544b; margin-left:108%; margin-top:-5%">
							</span>';
		}
			

	
				$html .='<input type="hidden" name="hkd_topiksimpulE6_'.$cno.'"  value='.$ckd_topik.' class="form-control input-sm" id="hkd_topiksimpulE6_'.$cno.'">';
				
				$html.='<div class="col-md-12"><br> 
								<h3 class="panel-title"><i class="fa fa-ravelry" ></i>  <b> <lebel id="lbtopik" style="text-align: left;">Topik '.$cno.' : '.$cnm_topik.'</label></b> </h3>
						<br></div>';
				
						$query2="select *from tpenilaian WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' AND kd_level='".$clevel."' and kd_topik='".$ckd_topik."'
								ORDER BY kd_penilaian";	
							
						$data2 = $this->db->query($query2)->result();
						
							$dno=0;
							$xpilihan='';
							foreach ($data2 as $value2) {
								$dno++;
								$xno++;
								
								$ckd_elemen=$value2->kd_elemen;
								$ckd_penilaian=$value2->kd_penilaian;
								$curaian=$value2->uraian;
								$cpenjelasan=$value2->penjelasan;
								$cbukti=$value2->bukti;
								$clangkah=$value2->langkah;
								$cjawaban=$value2->jawaban;
								$cverifikasi=$value2->verifikasi;
								$cverif_at=$value2->verif_at;
								$cuser_verif=$value2->user_verif;
								$catatan=$value2->catatan;
								$chpoin=$value2->hpoin;
								$cdpoin=$value2->dpoin;
								
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
								
						
								
								if($cverifikasi==1){  // tidak sesuai
									$color="red";
									$cinfo_verif='di Verifikasi tanggal';
									$cverif_at=$this->PublicModel->tanggal_waktu_indonesia($cverif_at); //$disable=$cverifikasi;
									
									if($csimpulan==1){
										$disable='disabled';
									}else{
										$disable='';
									}
									
									
									
								}else if($cverifikasi==2){  // sesuai
									$color="green";
									$cinfo_verif='di Verifikasi tanggal';
									$cverif_at=$this->PublicModel->tanggal_waktu_indonesia($cverif_at);
									$disable='disabled';
									
									
									
								}else{
									$color="black";
									$cinfo_verif='';
									$cverif_at=''; //$disable=$cverifikasi;
									if($csimpulan==1){
										$disable='disabled';
									}else{
										$disable='';
									}
								}
								
								
								if($cjawaban==1){
									$chk="checked";
								}else{
									$chk="";
								} 
								
								
								if($cuser_verif==null){
									
									$divhidden="hidden";
								}else{
									$divhidden="";
								}
								
								
								
								
								$search = array("/", " ", ":", "*", "?", "&#34;", "<", ">",".");
								$searchdok = array("/", " ", ":", "*", "?", "&#34;", "<", ">", "|");
								$replace = array("_", "_", "_", "_", "_", "_", "_", "_", "_");
							
								$ctahun 		= str_replace($search, $replace, $ctahun);
								$cinstansi 		= str_replace($search, $replace, $cinstansi);
								$celemen 		= str_replace($search, $replace, $ckd_elemen);
								$clevel 		= str_replace($search, $replace, $clevel);
								$ckdtopik 		= str_replace($search, $replace, $ckd_topik);
								$ckdpenilaian 	= str_replace($search, $replace, $ckd_penilaian);
								
								
						
								$folder5		= 'assets/file_upload/ekapip_dokumen/'.$ctahun.'/'.'Instansi'.$cinstansi.'/'.'Elemen'.$celemen.'/'.'Level'.$clevel.'/'.'Topik'.$ckdtopik.'/'.'Penilaian'.$ckdpenilaian.'/';

								$cdokumen=$value2->dokumen;

								$xno2='1';
										
								$html .='<input type="hidden" name="hkd_topikE6_'.$xno.'"  value='.$ckdtopik.' class="form-control input-sm" id="hkd_topikE6_'.$xno.'">';
								$html .='<input type="hidden" name="hkd_penilaianE6_'.$xno.'"  value='.$ckdpenilaian.' class="form-control input-sm" id="hkd_penilaianE6_'.$xno.'">';
							
							
								if($cpenjelasan==''){
									
									$html.='<div class="col-md-12" style="margin-left: 25px"> <br>
								
											
												<fieldset>
														<details>

															<summary style="font-size: 13px;color: black; text-align: left; " data-toggle="tooltip" data-placement="top" title="Klik Penjelasan Pemenuhan Topik Penilaian KAPIP">
																
																<div class="col-md-11" style="margin-left: 25px; cursor: pointer;"> 
																		<div class="col-md-1"><lebel style="text-align: left;">'.$cpoin.'</label></div> 
																		<div class="col-md-11" style="margin-left: -5%"><lebel style="text-align: left;">'.$curaian.'</label></div><br> 
																</div> 
															</summary> 
															
															
													</details>		
												</fieldset>			
										
										</div>'; 	
									
									
								}else{							
							
							
										$html.='<div class="col-md-12" style="margin-left: 25px"> <br>
								
											
											<fieldset>
													<details>

														<summary style="font-size: 13px;color: black; text-align: left; " data-toggle="tooltip" data-placement="top" title="Klik Penjelasan Pemenuhan Topik Penilaian KAPIP">
															<div class="col-md-11" style="margin-left: 25px; cursor: pointer;"> 
																	<div class="col-md-1"><lebel style="text-align: left;">'.$cpoin.'</label></div> 
																	<div class="col-md-11" style="margin-left: -5%"><lebel style="text-align: left;">'.$curaian.'</label> <i class="fa fa-caret-square-o-down fa-lg" style="color: #18978F;" ></i><br><br></div>															</div> 
														</summary> 
														
														<div class="col-md-11" style="margin-left: 45px"> 
																	<lebel style="text-align: left; font-size: 14px;color: #18978F;"><b>Penjelasan Uraian Aspek</b></label>
																	<textarea style="font-size:10pt;" class="form-control" readonly  rows="4">'.$cpenjelasan.'</textarea>
															<br>
														</div>
														
														<div class="col-md-11" style="margin-left: 45px"> 
																	<lebel style="text-align: left; font-size: 14px;color: #18978F;"><b>Contoh Bukti Dukung</b></label>
																	<textarea style="font-size:10pt;" class="form-control" readonly rows="4">'.$cbukti.'</textarea>
																	
															<br>
														</div>
														
												</details>		
											</fieldset>			
										
											
											<div class="col-sm-5" style="margin-left: 35px">											
												<label class="switch">
												  <input type="checkbox" onchange="checkPilihan()" '.$disable.' id="cpilihanE6_'.$xno.'" '.$chk.' value='.$cjawaban.'>
												  <div class="slider"></div>
												</label>
											</div>
											

										</div>'; 
							
								
							
							
							if($csimpulan==1){
									$btnE6_upl ='';
								}else{
									$xno2=1;
									$btnE6_upl 		= '<a class="list-group-item list-group-item-action "  onclick="uploadFileE6('.$celemen.','.$xno.','.$xno2.')"; ><i class="fa fa-cloud-upload fa-1x" aria-hidden="true" style="color: #006E7F" ></i> Upload File</a>';
								
									
								}
								
									$button3 		= '<button data-toggle="dropdown"  id="btnGroupDrop6" class="btn btn-info btn-sm dropdown-toggle '.$disable.'" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';									
									$subbutton=$btnE6_upl;
									
							
							
									$aksi='<center>
										<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
											'.$button3.'
											</button><ul class="dropdown-menu" >
											<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
												  
												  '.$subbutton.'
												
											</div> 
										  </div>
										
									</center>';
							
							
							
							$sql = "SELECT IFNULL(MAX(kd_file),0)+1 fnext FROM tpenilaian_lamp WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' and kd_topik='".$ckdtopik."' AND kd_level='".$clevel."' AND kd_penilaian='".$ckdpenilaian."'";	
							$kdfield = $this->db->query($sql)->row()->fnext;	
							
							if($kdfield==1){ // data baru
								
								if($csimpulan==1){
									$btnE6_upl ='';
								}else{
									$btnE6_upl 		= '<a class="list-group-item list-group-item-action "  onclick="uploadFileE6('.$celemen.','.$xno.','.$xno2.')"; ><i class="fa fa-cloud-upload fa-1x" aria-hidden="true" style="color: #006E7F" ></i> Upload File</a>';
								
									
								}
								
									$button3 		= '<button data-toggle="dropdown"  id="btnGroupDrop6" class="btn btn-info btn-sm dropdown-toggle '.$disable.'" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';									
									$subbutton=$btnE6_upl;
									
							
							
									$aksi='<center>
										<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
											'.$button3.'
											</button><ul class="dropdown-menu" >
											<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
												  
												  '.$subbutton.'
												
											</div> 
										  </div>
										
									</center>';		
												
								
						$html.='<div class="col-sm-8" style="margin-left: 80px;">
									<table id="xx" class="table table-bordered table-striped" style="width:100%;" border="0">
										<tbody id="data-profil-5">
										
										<thead>
											<tr>
												
												<th style="text-align:center;width:250px;color:black"><b>FILE UPLOAD</b></th>
												<th style="text-align:center;width:500px;color:black"><b>KETERANGAN</b></th>
												<th style="text-align:center;width:10px;"></th>
												
											</tr>
										</thead>';
										
										
										
										
												$xno2='1';
									
											$html.='<tr>
														<td style="width:30px">		
															<input type="file" name="fileuploadE6_'.$xno.'_'.$xno2.'" id="fileuploadE6_'.$xno.'_'.$xno2.'" value="" onchange="validateFormat(this,'.$celemen.','.$xno.','.$xno2.')" />
														</td>
																			
														<td>
															<textarea  style="font-size:10pt;display : none;" class="form-control"  id="uraianE6_'.$xno.'_'.$xno2.'" name="uraianE6_'.$xno.'_'.$xno2.'" rows="2"></textarea>

														</td>				 
																			
														<td>
															'.$aksi.'
														</td>
														
													</tr>';				
				
											
									$html.='
											
									</tbody>
							</table>
						</div>	
				
						
						<div class="col-sm-3"> 
									<div class="col-sm-12"><a><b>VERIFIKASI DATA</b></a>

										 <select '.$disable_verif.' name="cverifikasiE6_'.$xno.'" id="cverifikasiE6_'.$xno.'" class="form-control input-sm" onchange="verifikasi('.$celemen.','.$xno.')" style="color:'.$color.'">
											<option value="0" ></option>
											<option style="color:red" value="1" >TIDAK SESUAI</option>
											<option style="color:green" value="2" >SESUAI</option>
										  </select><br>
									</div>
									
									<script>
										$("#cverifikasiE6_"+'.$xno.').val('.$cverifikasi.');
										$("#cverifikasiE6_"+'.$xno.').select2().trigger("change"); 
									</script>
									
									
									<div id="divCatatanE6_'.$xno.'" class="col-sm-12" '.$divhidden.'><a><b>CATATAN</b></a>
										<textarea  '.$disable_verif.' style="font-size:10pt;" class="form-control"  id="catatanE6_'.$xno.'" name="catatanE6_'.$xno.'" rows="4">'.$catatan.'</textarea>
										
										<div '.$hidden_verif.'><br>
											<button type="button" hidden class="btn btn-success btn-lg simpan-verif" data-elemen="'.$celemen.'" data-topik="'.$ckdtopik.'" data-penilaian="'.$ckd_penilaian.'" data-nomor="'.$xno.'" hidden><i class="fa fa-check-square"></i> VERIFIKASI</button>
											</div><i style="font-size:8pt;">'.$cinfo_verif.'<br>'.$cverif_at.'</i>
									
									</div>
									
								
								</div>';				
														

								
										
								
								
							}else{     // data sudah ada
									
								
							
								$query3="select *from tpenilaian_lamp WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' AND kd_level='".$clevel."' and kd_topik='".$ckd_topik."' and kd_penilaian='".$ckd_penilaian."'
										 ORDER BY kd_penilaian";	
								
								$data3 = $this->db->query($query3)->result();
							
								$cno3=0;
								
								$html.='<div class="col-sm-8" style="margin-left: 80px;">
											<table id="xx" class="table table-bordered table-striped" style="width:100%;" border="0">
												<tbody id="data-profil-5">
												
												<thead>
													<tr>
														
														<th style="text-align:center;width:250px;color:black"><b>FILE UPLOAD</b></th>
														<th style="text-align:center;width:500px;color:black"><b>KETERANGAN</b></th>
														<th style="text-align:center;width:10px;"></th>
														
													</tr>
												</thead>';
												
												
												
								
								foreach ($data3 as $value3) {
									$cno3++;
									
									$ctahun=$value3->tahun;
									$cinstansi=$value3->kd_apip;
									$celemen=$value3->kd_elemen;
									$ctopik=$value3->kd_topik;
									$clevel=$value3->kd_level;
									$cpenilaian=$value3->kd_penilaian;
									$cfile=$value3->kd_file;
									$cnmfile=$value3->nm_file;
									$cinformasi=$value3->uraian;
									$ctanggal=$this->PublicModel->tanggal_waktu_indonesia($value3->insert_at);
							
									
							
									$clink			= "<a href='".base_url().$folder5.$value3->nm_file."' target= '_blank' class='list-group-item list-group-item-action' ><i class='fa fa-file-text-o fa-1x' aria-hidden='true' style='color: #069A8E'></i> Lihat File</a>";
					
									$btnE6_View = $clink;
									
									$clink2			= "<a href='".base_url().$folder5.$value3->nm_file."' target= '_blank' class='list-group-item list-group-item-action' ><i class='fa fa-file-text-o fa-1x' aria-hidden='true' style='color: #069A8E'></i></a>";
				
		
									$aa="hapusFileE6('".$ctahun."','".$cinstansi."','".$celemen."','".$ctopik."','".$clevel."','".$cpenilaian."','".$cfile."','".$cnmfile."')";
								
										if($csimpulan==1){
											$btnE6_Del = '';
										}else{
											
											if($cverifikasi==2){
													$btnE6_Del = '';
											}else{
												
													$btnE6_Del = '<a class="list-group-item list-group-item-action" onclick='.$aa.' ><i class="fa fa-trash-o fa-1x" aria-hidden="true" style="color: #EB1D36"></i> Hapus File</a>';
	
											}
											
																			
										}
									
											$button3 = '<button data-toggle="dropdown"  id="btnGroupDrop6" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
			
											$subbutton=$btnE6_View.$btnE6_Del;
									
											$aksi='<left>
														<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
															'.$button3.'
															</button><ul class="dropdown-menu" >
															
															<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>																  
																  '.$subbutton.'
															</div> 
														</div>
												
													</left>';		
													
											
												if($cno3==1){
													
													$margin='style="margin-top: -30px"';
													$marginaksi='style="margin-left: -25px;margin-top: -3px;"';
													$br ="";
												}else{
													
													$margin='style="margin-top: -55px"';
													$marginaksi='style="margin-left: -25px;margin-top: -25px;"';
													$br ="<br>";
													
												}
												
												$html.='
															<div class="col-sm-5" style="margin-left: 35px">
																	&nbsp;
															</div>';
								
												$cinput='';
								
										$html.='<tr>
													<td style="width:30px">	
														<div class="col-sm-3">	
														
														
															<a href='.base_url().$folder5.$value3->nm_file.' target= "_blank" title="Lihat File"> <i class="fa fa-file-pdf-o fa-3x" style="color: #EB1D36" aria-hidden="true"></i></a>

														</div>
															<div class="col-sm-9">	
																<a><b>'.$value3->nm_file.'</b></a><br><a style="font-size:8pt"><i>di upload tanggal <br>'.$ctanggal.'</i></a>
															</div>	
														
															<input type="hidden" name="kdfileuploadE6_'.$xno.'_'.$cno3.'" id="kdfileuploadE6_'.$xno.'_'.$cno3.'" value="'.$value3->kd_file.'"  class="form-control" />

													</td>
																		
    
													<td>
														<textarea  readonly class="form-control" 
															style="font-size:10pt;color: #000;background: transparent;border: none;outline: none;" 
															id="uraianE6_'.$xno.'_'.$cno3.'" name="uraianE6_'.$xno.'_'.$cno3.'" rows="2" >'.$cinformasi.'
														</textarea>
													</td>				 
																		
													<td>
														'.$aksi.'
													</td>
												</tr>';	
												
								}
								
								
																
											$cnext=$cno3+1;	
													
											$btnE6_upl	= '<a class="list-group-item list-group-item-action "  onclick="uploadFileE6('.$celemen.','.$xno.','.$cnext.')"; ><i class="fa fa-cloud-upload fa-1x" aria-hidden="true" style="color: #006E7F" ></i> Upload file</a>';									
											$button3 	= '<button data-toggle="dropdown" '.$disable.' id="btnGroupDrop6" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
											$subbutton	= $btnE6_upl;
									
											$aksi='<left>
														<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
															'.$button3.'
															</button><ul class="dropdown-menu" >
															
															<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>																  
																  '.$subbutton.'
															</div> 
														</div>
												
													</left>';	
			
													
													
											
											$html.='<tr>
														<td style="width:30px">		
															<input type="file" name="fileuploadE6_'.$xno.'_'.$cnext.'" id="fileuploadE6_'.$xno.'_'.$cnext.'" value="" onchange="validateFormat(this,'.$celemen.','.$xno.','.$cnext.')" />
														</td>
																			
														<td>
															<textarea  style="font-size:10pt;display : none;" class="form-control"  id="uraianE6_'.$xno.'_'.$cnext.'" name="uraianE6_'.$xno.'_'.$cnext.'" rows="2"></textarea>

														</td>				 
																			
														<td>
															'.$aksi.'
														</td>
														
														
														
													</tr>';	
													
											$html.='</tbody>
									</table>
								</div>

								<div class="col-sm-3"> 
									<div class="col-sm-12"><a><b>VERIFIKASI DATA</b></a>

										 <select '.$disable_verif.' name="cverifikasiE6_'.$xno.'" id="cverifikasiE6_'.$xno.'" class="form-control input-sm" onchange="verifikasi('.$celemen.','.$xno.')" style="color:'.$color.'">
											<option value="0" ></option>
											<option style="color:red" value="1" >TIDAK SESUAI</option>
											<option style="color:green" value="2" >SESUAI</option>
										  </select><br>
									</div>
									
									<script>
										$("#cverifikasiE6_"+'.$xno.').val('.$cverifikasi.');
										$("#cverifikasiE6_"+'.$xno.').select2().trigger("change"); 
									</script>
									
									
									<div id="divCatatanE6_'.$xno.'" class="col-sm-12" '.$divhidden.'><a><b>CATATAN</b></a>
										<textarea  '.$disable_verif.' style="font-size:10pt;" class="form-control"  id="catatanE6_'.$xno.'" name="catatanE6_'.$xno.'" rows="4">'.$catatan.'</textarea>
										
										<div '.$hidden_verif.'><br>
											<button type="button" hidden class="btn btn-success btn-lg simpan-verif" data-elemen="'.$celemen.'" data-topik="'.$ckdtopik.'" data-penilaian="'.$ckd_penilaian.'" data-nomor="'.$xno.'" hidden><i class="fa fa-check-square"></i> VERIFIKASI</button>
											</div><i style="font-size:8pt;">'.$cinfo_verif.'<br>'.$cverif_at.'</i>
									
									</div>
									
								</div>';		
									
							
							}					
						}					
					}
			
			
			
				$html.='<div class="col-sm-12">
				
				 <fieldset>
						<legend style="background-color: #EDDFB3; font-size:10pt;"><b>&nbsp;</b>
							<div class="col-sm-12" >											
								
								<div class="col-sm-9" >
									<label style="align:center"><b><i>Simpulan Pemenuhan '.$cno.' : '.$cnm_topik.'</i></b>
								  
									</label>
								</div>
								
								
								
								 <div class="col-sm-3">
								 '.$iconjawab.'
								  <div class="progress-bar progress-bar-striped active" role="progressbar"
										aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:'.$persenjawab.'%;margin-top:-10%;" >
									'.$persenjawab.'%
								  </div><br>
								</div>
								
							</div>
							
							
						</legend>	
				</fieldset>
				</div>	';
			
			
							/* <div class="col-sm-3">	
									<label class="switch" style="margin-left: 28px;">
									  <input '.$aktifsimpul.' type="checkbox" onchange="checkSimpulan('.$xpilihan.')" id="chsimpulE6_'.$cno.'" '.$chksimpul.' value='.$csimpulan_pemenuhan.'>
									  <div class="slider"></div>
									</label>
								</div> */
			
			
			}			
	
			$kembali='kapip-dataumum-profil-apip';
			$html .='</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


 
<div class="panel-footer">
	<center>';
	
	
	$html .='<button type="button"  onclick="kembali()" class="btn btn-danger btn-lg" ><i class="fa fa-arrow-circle-left"></i> KEMBALI</button>'; 
	$html .='<button type="button" '.$disable.' class="btn btn-success btn-lg simpan-elemen6" data-jml="'.$xno.'" data-jmltopik="'.$cno.'"><i class="fa fa-check-square"></i> SIMPAN</button>
			
	</center>
	</form>
</div>';

	
	

			
			return $html;
		}





		public function viewSimpulan($ctahun,$cinstansi,$clevel)
		{
				
			$akses = $this->session->userdata('is_admin');
		
			$csql = "SELECT simpulan,(select ifnull(MAX(kd_level),0) FROM tsimpulan WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND simpulan='1')maxsimpul from tsimpulan WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' and kd_level='".$clevel."' and id_group='".$akses."'";
			$cdata = $this->db->query($csql)->result();
						
			foreach ($cdata as $value) {

				$csimpulan=$value->simpulan;
				$cmaxsimpul=$value->maxsimpul;
				

			}
			
			
			if($csimpulan==1){
				$chk="checked";
				
				if($akses == 1){
						$disable="";
				}else{
					$disable="disabled";
				}		
			}else{
				$chk="";
				$disable="";
			} 
			
		
			
			
				$html = "";

				$html .='<div class="col-sm-12" style="margin-left: 35px"><br>
								<input type="checkbox" id="chsimpulan_'.$clevel.'" name="chsimpulan_'.$clevel.'" '.$chk.' value='.$csimpulan.' > <label style="font-size: 14px;color: #18978F;">Ya, saya telah menyelesaikan pengisian penilaian mandiri Level '.$clevel.'</label>					
								<br><br>
						</div>';
	
							//onchange="changeLevel()"
							$html .='  </div> 
									</div>
								</div>
					
						</div>
					</div>
				</div>


				 
				<div class="panel-footer">
					<center>';
					
					
					$html .='<button type="button"  onclick="kembali()" class="btn btn-danger btn-lg" ><i class="fa fa-arrow-circle-left"></i> KEMBALI</button>';
					$html .='<button type="button" '.$disable.' class="btn btn-success btn-lg simpan-simpulan" data-level="'.$clevel.'"><i class="fa fa-check-square"></i> SIMPAN FINAL</button>
							
					</center>
					</form>
				</div>';


							return $html;
		}


		public function dataSimpulan($ctahun,$cinstansi)
		{
		
		
		$akses = $this->session->userdata('is_admin');

		$ceksql="select COUNT(*)jml FROM ms_group_menu_elemen WHERE id_group='".$akses."'";
		$cekgroup = $this->db->query($ceksql)->row()->jml;


			if($cekgroup>=1){
				$filter1="AND b.id_group='".$akses."'";
				$filter2="AND c.id_group='".$akses."'";
				$filter3="AND bb.id_group='".$akses."'";
				
				
			}else{
				$filter1="";
				$filter2="";
				$filter3="";
				
			}


				

	$query="SELECT jns,kd_elemen,kd_topik,uraian,kd_jns_elemen,bobot,varkali,clevel1,clevel2,clevel3,clevel4,clevel5,skor_topik,ROUND(simpulan,4)simpulan,satuan, 
			CASE
			WHEN jns<>0 THEN ROUND((simpulan*satuan),4)
			ELSE
			(SELECT SUM(skor)FROM(
			SELECT kd_jns_elemen,
			CASE
			WHEN jns<>0 THEN ROUND((simpulan*satuan),4) END AS skor
			FROM(
			SELECT jns,kd_elemen,kd_topik,kd_jns_elemen,bobot,varkali,
			case 
			when kd_elemen=6 then 
				((bobot/40*varkali)/100)
			else
				((bobot/100*varkali)/100)
			end as  satuan,
			CASE 
			WHEN jns=1 THEN IFNULL(((SELECT IFNULL(SUM(simpulan_pemenuhan),0) FROM tlevel WHERE  tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen=bb.kd_elemen AND simpulan_pemenuhan=1 )/(SELECT COUNT(*) FROM tlevel WHERE  tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen=bb.kd_elemen and kd_level=1 AND simpulan_pemenuhan=1)),0) END AS simpulan
			FROM(
			SELECT '1' jns,kd_elemen,0 kd_topik,aa.nm_elemen,aa.kd_jns_elemen,aa.bobot,(SELECT bobot FROM ms_jns_elemen WHERE kd_jns_elemen=aa.kd_jns_elemen LIMIT 1)varkali FROM ms_elemen aa	 
			)bb
			)aaa
			)xxx WHERE kd_jns_elemen=aaa.kd_jns_elemen)
			END AS skor
			FROM(

			SELECT jns,kd_elemen,kd_topik,uraian,kd_jns_elemen,bobot,varkali,
			case 
			when kd_elemen=6 then 
				((bobot/40*varkali)/100)
			else
				((bobot/100*varkali)/100)
			end as  satuan,
			clevel1,clevel2,clevel3,clevel4,clevel5,skor_topik,
			CASE 
			WHEN jns=2 THEN IFNULL((SELECT SUM(simpulan_pemenuhan) FROM tlevel WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen=aa.kd_elemen AND kd_topik=aa.kd_topik AND simpulan_pemenuhan=1),0)
			WHEN jns=1 THEN IFNULL(((SELECT IFNULL(SUM(simpulan_pemenuhan),0) FROM tlevel WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen=aa.kd_elemen AND simpulan_pemenuhan=1)/(SELECT COUNT(*) FROM tlevel WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen=aa.kd_elemen and kd_level=1 AND simpulan_pemenuhan=1)),0)
			ELSE '' END AS simpulan

			FROM(
				SELECT '2'jns,kd_elemen,kd_topik,(SELECT nm_topik FROM ttopik WHERE tahun=zz.tahun AND kd_apip=zz.kd_apip 
				AND kd_elemen=zz.kd_elemen AND kd_topik=zz.kd_topik LIMIT 1)uraian,(SELECT kd_jns_elemen FROM ms_elemen WHERE kd_elemen=zz.kd_elemen LIMIT 1)kd_jns_elemen,
				(SELECT bobot FROM ms_elemen WHERE kd_elemen=zz.kd_elemen LIMIT 1)bobot,
				(SELECT bobot FROM ms_jns_elemen WHERE kd_jns_elemen=zz.kd_jns_elemen LIMIT 1)varkali,	
				CASE 
				WHEN clevel1>=1 THEN 'Y'
				WHEN clevel1=0 THEN 'T'
				ELSE '-' END AS clevel1,
				CASE 
				WHEN clevel2>=1 THEN 'Y'
				WHEN clevel2=0 THEN 'T'
				ELSE '-' END AS clevel2,
				CASE 
				WHEN clevel3>=1 THEN 'Y'
				WHEN clevel3=0 THEN 'T'
				ELSE '-' END AS clevel3,
				CASE 
				WHEN clevel4>=1 THEN 'Y'
				WHEN clevel4=0 THEN 'T'
				ELSE '-' END AS clevel4,
				CASE 
				WHEN clevel5>=1 THEN 'Y'
				WHEN clevel5=0 THEN 'T'
				ELSE '-' END AS clevel5,
				(IFNULL(clevel1,0)+IFNULL(clevel2,0)+IFNULL(clevel3,0)+IFNULL(clevel4,0)+IFNULL(clevel5,0))skor_topik
				 FROM(
					SELECT tahun,kd_elemen,kd_apip,kd_topik,SUM(clevel1)clevel1,SUM(clevel2)clevel2,SUM(clevel3)clevel3,SUM(clevel4)clevel4,SUM(clevel5)clevel5,
						(SELECT kd_jns_elemen FROM ms_elemen WHERE kd_elemen=z.kd_elemen LIMIT 1)kd_jns_elemen FROM(
						SELECT a.tahun,a.kd_apip,a.kd_elemen,a.kd_topik,
						CASE WHEN a.kd_level=1 THEN simpulan_pemenuhan END AS clevel1,
						CASE WHEN a.kd_level=2 THEN simpulan_pemenuhan END AS clevel2,
						CASE WHEN a.kd_level=3 THEN simpulan_pemenuhan END AS clevel3,
						CASE WHEN a.kd_level=4 THEN simpulan_pemenuhan END AS clevel4,
						CASE WHEN a.kd_level=5 THEN simpulan_pemenuhan END AS clevel5
						FROM tlevel a
						INNER JOIN 
						ms_group_menu_elemen b  ON a.tahun=b.tahun AND a.kd_apip=b.kd_apip AND a.kd_elemen=b.kd_elemen AND a.kd_topik=b.kd_topik
						WHERE a.tahun='".$ctahun."' AND a.kd_apip='".$cinstansi."' ".$filter1."
					)z GROUP BY kd_elemen,kd_apip,kd_elemen,kd_topik

				)zz 

				UNION
				
				SELECT*FROM(
					SELECT DISTINCT '0'jns,0 kd_elemen,0 kd_topik,a.nm_jns_elemen,a.kd_jns_elemen,a.bobot,0 varkali,''clevel1,''clevel2,''cevel3,''clevel4,''clevel5,'' skor_topik 
					FROM ms_jns_elemen a
					INNER JOIN ms_elemen b ON a.kd_jns_elemen=b.kd_jns_elemen
					INNER JOIN ms_group_menu_elemen c ON b.kd_elemen=c.kd_elemen 
					WHERE c.tahun='".$ctahun."' AND c.kd_apip='".$cinstansi."'".$filter2."
				UNION
					SELECT '1'jns,aa.kd_elemen,0 kd_topik,aa.nm_elemen,aa.kd_jns_elemen,aa.bobot,
					(SELECT bobot FROM ms_jns_elemen WHERE kd_jns_elemen=aa.kd_jns_elemen LIMIT 1)varkali,''clevel1,''clevel2,''cevel3,
					''clevel4,''clevel5,'' skor_topik FROM ms_elemen aa 
					INNER JOIN ms_group_menu_elemen bb ON aa.kd_elemen=bb.kd_elemen 
					WHERE bb.tahun='".$ctahun."' AND bb.kd_apip='".$cinstansi."'".$filter3."
					
				)Z 
			)aa 
			)aaa 
			ORDER BY kd_jns_elemen,kd_elemen,kd_topik";

			$data = $this->db->query($query)->result();
			
				if($akses==1){
					
					$jskor=0;
					foreach ($data as $cvalue) {
						
								$cjns=$cvalue->jns;
								$cbobot=$cvalue->bobot;
								$csimpulan=$cvalue->simpulan;
							
								
								$cskorelemen=$cvalue->skor;
								
								if($cjns==0){
									$jskor=$cskorelemen+$jskor;
									
								}	
	
					}
					
					
								if(round($jskor,1) >= 1.0 && round($jskor,1) <= 1.9){
										$csimpulanxx=1;
								}else if(round($jskor,1) >= 2.0 && round($jskor,1) <= 2.9){
										$csimpulanxx=2;
								}else if(round($jskor,1) >= 3.0 && round($jskor,1) <= 3.9){
										$csimpulanxx=3;
								}else if(round($jskor,1) >= 4.0 && round($jskor,1) <= 4.9){
										$csimpulanxx=4;
								}else if(round($jskor,1) >= 5.0){
										$csimpulanxx=5;
								}
					
					$html.='<tr>
										<td style="width:60%;text-align:left;color:#F57328;font-size: 16px"><b>SIMPULAN HASIL</b></td> 
										<td colspan = "5" style="width:25%;text-align:center;"></td>
										<td style="width:5%;text-align:left;"></td>
										<td style="width:5%;text-align:center;color:#F57328;font-size: 16px"><b>'.$csimpulanxx.'</b></td>
										<td style="width:5%;text-align:center;color:#F57328;font-size: 16px"><b>'.$jskor.'</b></td>';
							$html.=	'</tr>';	
			
					
					
				}
					
			foreach ($data as $value) {

				$curaian=$value->uraian;
				$celemen=$value->kd_elemen;
				$clevel1=$value->clevel1;
				$clevel2=$value->clevel2;
				$clevel3=$value->clevel3;
				$clevel4=$value->clevel4;
				$clevel5=$value->clevel5;
				$cskor=$value->skor_topik;
				$cjns=$value->jns;
				$cbobot=$value->bobot;
				$csimpulan=$value->simpulan;
				$cskorelemen=$value->skor;
				
				
				
					if($cjns==1){

							$sql = "SELECT acc,nacc,(acc+nacc)jml,((acc/(acc+nacc))*100)persen FROM(
									SELECT ifnull(SUM(acc),0)acc,ifnull(SUM(nacc),0)nacc FROM(
									SELECT COUNT(*)acc,0 nacc FROM tpenilaian WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."' AND jawaban=1 and penjelasan<>''
									UNION
									SELECT 0 acc,COUNT(*)nacc FROM tpenilaian WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND kd_elemen='".$celemen."'  AND (jawaban=0 OR jawaban IS NULL) and penjelasan<>''
									)z
									)zz";
							$persenjawab = $this->db->query($sql)->row()->persen;	
							
							$persenjawab=number_format($persenjawab, "0", ",", ".");
										
								
								
								
							$cpersensimpulan=' <div class="progress-bar progress-bar-striped active" role="progressbar"
												aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:'.$persenjawab.'%;" >
											'.$persenjawab.'%
										  </div>';

							
							
						
						
					}else{
						$cpersensimpulan='';
						
					}	

		if($clevel1=='Y'){
			$clevel1='<span class="fa fa-check-square-o fa-2x" aria-hidden="true" style="color: #3CCF4E;">
							  </span>';
		}else if($clevel1=='T'){
			$clevel1='<span  class="fa fa-window-close-o fa-2x" aria-hidden="true" style="color: #fc544b;">
							</span>';
		}else{
			$clevel1='-';
		}

		if($clevel2=='Y'){
			$clevel2='<span class="fa fa-check-square-o fa-2x" aria-hidden="true" style="color: #3CCF4E;">
							  </span>';
		}else if($clevel2=='T'){
			$clevel2='<span  class="fa fa-window-close-o fa-2x" aria-hidden="true" style="color: #fc544b;">
							</span>';
		}else{
			$clevel2='-';
		}	

		if($clevel3=='Y'){
			$clevel3='<span class="fa fa-check-square-o fa-2x" aria-hidden="true" style="color: #3CCF4E;">
							  </span>';
		}else if($clevel3=='T'){
			$clevel3='<span  class="fa fa-window-close-o fa-2x" aria-hidden="true" style="color: #fc544b;">
							</span>';
		}else{
			$clevel3='-';
		}

		if($clevel4=='Y'){
			$clevel4='<span class="fa fa-check-square-o fa-2x" aria-hidden="true" style="color: #3CCF4E;">
							  </span>';
		}else if($clevel4=='T'){
			$clevel4='<span  class="fa fa-window-close-o fa-2x" aria-hidden="true" style="color: #fc544b;">
							</span>';
		}else{
			$clevel4='-';
		}


		if($clevel5=='Y'){
			$clevel5='<span class="fa fa-check-square-o fa-2x" aria-hidden="true" style="color: #3CCF4E;">
							  </span>';
		}else if($clevel5=='T'){
			$clevel5='<span  class="fa fa-window-close-o fa-2x" aria-hidden="true" style="color: #fc544b;">
							</span>';
		}else{
			$clevel5='-';
		}
		

				if($cjns<=1){
					$clevel1='';
					$clevel2='';
					$clevel3='';
					$clevel4='';
					$clevel5='';
					$clevel6='';
					$color="color:#006E7F";
					$bold='<b>';
					$nbold='</b>';
				}else{
					$clevel1=$clevel1;
					$clevel2=$clevel2;
					$clevel3=$clevel3;
					$clevel4=$clevel4;
					$clevel5=$clevel5;
					$clevel6=$clevel6;
					$color="color:gray";
					
					
					$bold='';
					$nbold='';
				}
				
						 		

					if($cjns==0){
						
						if($akses==1){
							$html.='<tr>
										<td style="width:60%;text-align:left;'.$color.'">'.$bold.''.$curaian.' ('.$cbobot.'%)'.$nbold.'</td> 
										<td colspan = "5" style="width:25%;text-align:center;">'.$cpersensimpulan.'</td>
										<td style="width:5%;text-align:left;'.$color.'"></td>
										<td style="width:5%;text-align:center;" ></td>
										<td style="width:5%;text-align:center;'.$color.'">'.$bold.''.$cskorelemen.''.$nbold.'</td>';
							$html.=	'</tr>';	
							
						}	
											
						
					}else if($cjns==1){
						$html.='<tr>
									<td style="width:60%;text-align:left;'.$color.'">'.$bold.''.$curaian.' ('.$cbobot.'%)'.$nbold.'</td> 
									<td colspan = "5"  style="width:25%;text-align:center;">'.$cpersensimpulan.'</td>
									<td style="width:5%;text-align:left;'.$color.'">&nbsp;</td>
									<td style="width:5%;text-align:center;'.$color.'" >'.$bold.''.number_format($csimpulan,0,",",".").''.$nbold.'</td>
									<td style="width:5%;text-align:center;'.$color.'" >'.$bold.''.$cskorelemen.''.$nbold.'</td>';
						$html.=	'</tr>';						
						
					}else{  //padding-left: 10px;"

						$html.='<tr>
									<td style="width:60%;text-align:left;padding-left: 30px;'.$color.'">'.$bold.''.$curaian.''.$nbold.'</td> 
									<td style="width:5%;text-align:center;">'.$bold.''.$clevel1.''.$nbold.'</td>
									<td style="width:5%;text-align:center;">'.$bold.''.$clevel2.''.$nbold.'</td>
									<td style="width:5%;text-align:center;"><b>'.$bold.''.$clevel3.''.$nbold.'</td>
									<td style="width:5%;text-align:center;" ><b>'.$bold.''.$clevel4.''.$nbold.'</td>
									<td style="width:5%;text-align:center;" ><b>'.$bold.''.$clevel5.''.$nbold.'</td>
									<td style="width:5%;text-align:center;" ><b>'.$bold.''.$cskor.''.$nbold.'</td>
									<td style="width:5%;text-align:center;" ><b></td>
									<td style="width:5%;text-align:center;" ><b>'.$bold.''.$cskorelemen.''.$nbold.'</td>';
						$html.=	'</tr>'; 
					}
			}
			
			return $html;
		}


		public function insertHistory($data){
			$this->db->insert('thistory', $data);
			return true;
		}	

}

?>