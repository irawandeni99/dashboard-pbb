

<?php
	class ReferensiModel extends CI_Model{

		
  

	    public function get_maxref($ctahun,$cinstansi)
	    {
			
		$sql = "SELECT IFNULL(MAX(kd_file),0)+1 fnext FROM ms_referensi WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."'";	
				$kdfield = $this->db->query($sql)->row()->fnext;	
				return $kdfield;
		}


		public function insertReferensi($data){
			$this->db->insert('ms_referensi', $data);
			return true;
		}
		

		public function insertReferensiHistory($data){
			$this->db->insert('thistory', $data);
			return true;
		}		



		public function viewReferensi($ctahun,$cinstansi)
		{
			
			$celemen=1;
			$akses = $this->session->userdata('is_admin');
			
	    	
			if($akses == 1){
				$disable='';
				$hidden='';
			
				
			}else{
				
				$disable='disabled';
				$hidden='hidden';
				
				
			}

				$csimpulan==1;
				//$disable='';//disabled";
				$cinfo ="( Read Only )";
				
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
			
			
							
						$celemen=1;	
						$ckd_topik=1;
						$clevel=1;
					
								
								$search = array("/", " ", ":", "*", "?", "&#34;", "<", ">",".");
								$searchdok = array("/", " ", ":", "*", "?", "&#34;", "<", ">", "|");
								$replace = array("_", "_", "_", "_", "_", "_", "_", "_", "_");
							
								$ctahun 		= str_replace($search, $replace, $ctahun);
								$cinstansi 		= str_replace($search, $replace, $cinstansi);
								
								
						
								$folder2		= 'assets/file_upload/ekapip_dokumen/'.$ctahun.'/'.'Instansi'.$cinstansi.'/'.'Referensi/';

								$cdokumen=$value2->dokumen;

								$xno2='1';
										
							
							
								
							
									$btnE1_upl 		= '<a class="list-group-item list-group-item-action "  onclick="uploadFileE1('.$xno2.')"; ><i class="fa fa-cloud-upload fa-1x" aria-hidden="true" style="color: #006E7F" ></i> Upload File</a>';
								
							
									$button3 		= '<button data-toggle="dropdown"  id="btnGroupDrop1" class="btn btn-info btn-sm dropdown-toggle '.$disable.'" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';									
									$subbutton=$btnE1_upl;
									
							
							
									$aksi='<center >
										<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
											'.$button3.'
											</button><ul class="dropdown-menu" >
											<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
												  
												  '.$subbutton.'
												
											</div> 
										  </div>
										
									</center>';
							
							
							
							$sql = "SELECT IFNULL(MAX(kd_file),0)+1 fnext FROM ms_referensi WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."'";	
							$kdfield = $this->db->query($sql)->row()->fnext;	
							
							if($kdfield==1){ // data baru
								
								if($csimpulan==1){
									$btnE1_upl ='';
								}else{
									$btnE1_upl 		= '<a class="list-group-item list-group-item-action "  onclick="uploadFileE1('.$kdfield.')"; ><i class="fa fa-cloud-upload fa-1x" aria-hidden="true" style="color: #006E7F" ></i> Upload File</a>';
								
									
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
												
								
						$html.='<div class="col-sm-12" style="margin-left: 10px;">
									<table id="xx" class="table table-bordered table-striped" style="width:100%;" border="0">
										<tbody id="data-referensi">
										
										<thead>
											<tr>
												
												<th style="text-align:center;width:250px;color:black"><b>FILE REFERENSI</b></th>
												<th style="text-align:center;width:800px;color:black"><b>KETERANGAN</b></th>
												<th style="text-align:center;width:10px;"></th>
												
											</tr>
										</thead>';
										
										
										
										
												$xno2='1';
									
											$html.='<tr>
														<td style="width:30px">		
															<input type="file" style="width: 240px"  name="fileuploadE1_'.$xno2.'" id="fileuploadE1_'.$xno2.'" value="" onchange="validateFormat(this,'.$xno2.')" />
														</td>
																			
														<td>
															<textarea  style="font-size:10pt;display : none;" class="form-control"  id="uraianE1_'.$xno2.'" name="uraianE1_'.$xno2.'" rows="2"></textarea>

														</td>				 
																			
														<td>
															'.$aksi.'
														</td>
														
													</tr>';				
				
											
									$html.='
											
									</tbody>
							</table>
						</div>';		
									
								
							}else{     // data sudah ada
									
								
							
								$query3="select *from ms_referensi WHERE tahun='".$ctahun."' AND kd_apip='".$cinstansi."' 
										 ORDER BY insert_at desc";	
								
								$data3 = $this->db->query($query3)->result();
							
								$cno3=0;
								
								$html.='<div class="col-sm-12" style="margin-left: 10px;">
											<table id="xx" class="table table-bordered table-striped" style="width:100%;" border="0">
												<tbody id="data-referensi">
												
												<thead>
													<tr>
														
														<th style="text-align:center;width:250px;color:black"><b>FILE REFERENSI</b></th>
														<th style="text-align:center;width:500px;color:black"><b>KETERANGAN</b></th>
														<th style="text-align:center;width:10px;"></th>
														
													</tr>
												</thead>';
												
												
												
								
								foreach ($data3 as $value3) {
									$cno3++;
									
									$ctahun=$value3->tahun;
									$cinstansi=$value3->kd_apip;
									$cfile=$value3->kd_file;
									$cnmfile=$value3->nm_file;
									$cinformasi=$value3->uraian;
									$ctanggal=$this->PublicModel->tanggal_waktu_indonesia($value3->insert_at);
							
									
							
									$clink			= "<a href='".base_url().$folder2.$value3->nm_file."' target= '_blank' class='list-group-item list-group-item-action' ><i class='fa fa-file-text-o fa-1x' aria-hidden='true' style='color: #069A8E'></i> Lihat File</a>";
					
									$btnE1_View = $clink;
									
									$clink2			= "<a href='".base_url().$folder2.$value3->nm_file."' target= '_blank' class='list-group-item list-group-item-action' ><i class='fa fa-file-text-o fa-1x' aria-hidden='true' style='color: #069A8E'></i></a>";


									$edit="EditFileE1('".$ctahun."','".$cinstansi."','".$cfile."','".$cnmfile."','".$cno3."')";						
									$btnE1_Edit = '<a class="list-group-item list-group-item-action" onclick='.$edit.' ><i class="fa fa-pencil-square-o" aria-hidden="true" style="color: #F15412"></i> Edit File</a>';
				
										
										$aa="hapusFileE1('".$ctahun."','".$cinstansi."','".$cfile."','".$cnmfile."')";
										
										if($akses == 1){
										
											$btnE1_Del = '<a '.$hidden.' class="list-group-item list-group-item-action" onclick='.$aa.' ><i class="fa fa-trash-o fa-1x" aria-hidden="true" style="color: #EB1D36"></i> Hapus File</a>';

										}else{
											
											$btnE1_Del = '';
											
										}
				
									
											$button3 = '<button data-toggle="dropdown"  id="btnGroupDrop1" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars fa-2x" aria-hidden="true"></i>';
			
									if($akses == 1){
											$subbutton=$btnE1_View.$btnE1_Edit.$btnE1_Del;
									}else{
											$subbutton=$btnE1_View.$btnE1_Del;
										
									}
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
														
														
															<a href='.base_url().$folder2.$value3->nm_file.' target= "_blank" title="Lihat File"> <i class="fa fa-file-pdf-o fa-3x" style="color: #EB1D36" aria-hidden="true"></i></a>

														</div>
															<div class="col-sm-9">	
																<a style="word-break: break-all;"><b>'.$value3->nm_file.'</b></a><br><a style="font-size:8pt"><i>di upload tanggal <br>'.$ctanggal.'</i></a>
															</div>	
														
															<input type="hidden" style="width: 240px"  name="kdfileuploadE1_'.$cno3.'" id="kdfileuploadE1_'.$cno3.'" value="'.$value3->kd_file.'"  class="form-control" />

													</td>
																		
    
													<td>
														<textarea  class="form-control" 
															style="font-size:10pt;color: #000;background: transparent;border: none;outline: none;" 
															id="uraianE1_'.$cno3.'" name="uraianE1_'.$cno3.'" rows="2" >'.$cinformasi.'
														</textarea>
													</td>				 
																		
													<td>
														'.$aksi.'
													</td>
												</tr>';	
												
								}
								
								
																
											$cnext=$cno3+1;	
													
											$btnE1_upl	= '<a class="list-group-item list-group-item-action "  onclick="uploadFileE1('.$cnext.')"; ><i class="fa fa-cloud-upload fa-1x" aria-hidden="true" style="color: #006E7F" ></i> Upload file</a>';									
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
			
													
													
											
											$html.='<tr '.$hidden.'>
														<td style="width:30px">		
															<input type="file" style="width: 240px"  name="fileuploadE1_'.$cnext.'" id="fileuploadE1_'.$cnext.'" value="" onchange="validateFormat(this,'.$cnext.')" />
														</td>
																			
														<td>
															<textarea  style="font-size:10pt;display : none;" class="form-control"  id="uraianE1_'.$cnext.'" name="uraianE1_'.$cnext.'" rows="2"></textarea>

														</td>				 
																			
														<td>
															'.$aksi.'
														</td>
														
														
														
													</tr>';	
													
											$html.='</tbody>
									</table>
								</div>';  
									
							
							}	
				$html.='</div>';  //split penilaian
					
	
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
	$html .='</center>
				</form>
			</div>';

			return $html;
		}

}

?>