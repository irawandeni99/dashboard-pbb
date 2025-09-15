<?php
	class InputWasTeknisModel extends CI_Model{

		var $table = 'ms_was_teknis a'; //nama tabel dari database
	    var $column_order = array(null,'id_parameter'); //field yang ada di table 
	    var $column_search = array('id_parameter','nm_parameter','tahun',); //field yang diizin untuk pencarian 
	    var $order = array('id_parameter' => 'asc'); // default order 

		public function add_parameter($data){
			$this->db->insert('tr_was_teknis', $data);
			return true;
		}

		public function add_target($data){
			$this->db->insert('ms_target', $data);
			return true;
		}

		public function get_tree_parameter()
		{
			$html = '';
			$thn = $this->session->userdata('year_selected');
			$sql1 = 'SELECT * FROM ms_was_teknis WHERE LENGTH(id_parameter) = 3 and tahun = '.$thn;
			$res1 = $this->db->query($sql1)->result_array();
			if (count($res1)>0) {
				// panel grup 1
				$html .= '<div class="panel-group" id="accordion1" role="tablist1" aria-multiselectable="true">';

				foreach ($res1 as $value1) {
					$html .= '<div class="panel panel-default panel-headline-custom">
						    <div class="panel-heading" role="tab1" id="heading'.$value1["id_parameter"].'">
						      <h4 class="panel-title">
						        <a role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse'.$value1["id_parameter"].'" aria-expanded="true" aria-controls="collapse'.$value1["id_parameter"].'">
						          '.$value1["nm_parameter"].'
						        </a>
						        <div class="pull-right">
						        	<a href="#" class = "label label-success showModal" data-aksi="tambah" data-level ="2">
						        		<i class="lnr lnr-plus-circle"></i>
						        	</a>&nbsp;
						        	<a href="#" class = "label label-info showModal" data-aksi="edit" data-level ="1">
						        		<i class="lnr lnr-pencil"></i>
						        	</a>&nbsp;
						        	<a href="#" class = "label label-danger">
						        		<i class="lnr lnr-trash"></i>
						        	</a>
						        </div>
						        
						      </h4>
						    </div>
						  ';	
					$sql2 = "SELECT * FROM ms_was_teknis WHERE LENGTH(id_parameter) = 5 and hd_parameter = '".$value1['id_parameter']."' and tahun = ".$thn;
					$res2 = $this->db->query($sql2)->result_array();
					if (count($res2)>0) {
						$html .= '<div id="collapse'.$value1["id_parameter"].'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.$value1["id_parameter"].'">
				      				<div class="panel-body">';
				      	$html .= '<div class="panel-group" id="accordion2" role="tablist2" aria-multiselectable="true">';
				      	foreach ($res2 as $value2) {
				      		$html .= '<div class="panel panel-default panel-headline-custom">
						    <div class="panel-heading" role="tab2" id="heading'.$value2["id_parameter"].'">
						      <h4 class="panel-title">
						        <a role="button" data-toggle="collapse" data-parent="#accordion2" href="#collapse'.$value2["id_parameter"].'" aria-expanded="true" aria-controls="collapse'.$value2["id_parameter"].'">
						          '.$value2["nm_parameter"].'
						        </a>
						        <div class="pull-right">
						        	<a href="#" class = "label label-success" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
						        		<i class="lnr lnr-plus-circle"></i>
						        	</a>&nbsp;
						        	<a href="#" class = "label label-info">
						        		<i class="lnr lnr-pencil"></i>
						        	</a>&nbsp;
						        	<a href="#" class = "label label-danger">
						        		<i class="lnr lnr-trash"></i>
						        	</a>
						        </div>
						      </h4>
						    </div>
						  ';
						  	$sql3 = "SELECT * FROM ms_was_teknis WHERE LENGTH(id_parameter) = 7 and hd_parameter = '".$value2['id_parameter']."' and tahun = ".$thn;

							$res3 = $this->db->query($sql3)->result_array();
							if (count($res3)>0) {
								$html .= '<div id="collapse'.$value2["id_parameter"].'" class="panel-collapse collapse" role="tabpanel2" aria-labelledby="heading'.$value2["id_parameter"].'">
				      				<div class="panel-body">';
				      			$html .= '<div class="panel-group" id="accordion3" role="tablist3" aria-multiselectable="true">';
				      			foreach ($res3 as $value3) {
				      		$html .= '<div class="panel panel-default panel-headline-custom">
						    <div class="panel-heading" role="tab2" id="heading'.$value3["id_parameter"].'">
						      <h4 class="panel-title">
						        <a role="button" data-toggle="collapse" data-parent="#accordion2" href="#collapse'.$value3["id_parameter"].'" aria-expanded="true" aria-controls="collapse'.$value3["id_parameter"].'">
						          '.$value3["nm_parameter"].'
						        </a>
						        <div class="pull-right">
						        	<a href="#" class = "label label-success" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
						        		<i class="lnr lnr-plus-circle"></i>
						        	</a>&nbsp;
						        	<a href="#" class = "label label-info">
						        		<i class="lnr lnr-pencil"></i>
						        	</a>&nbsp;
						        	<a href="#" class = "label label-danger">
						        		<i class="lnr lnr-trash"></i>
						        	</a>
						        </div>
						      </h4>
						    </div>
						  ';
				      			$html.='	</div>
				    			';
				      		}
				      			$html.='	</div>
				    			</div>';
				      		$html .= '</div>';

							}

						  // panel defailt 2
						  $html .= '</div>';
				      	}

				      	// panel grup2
				      	$html .='</div>';

				      	//panel body 1
				      	$html.='	</div>
				    			</div>';
					}
					// end panel hdefault 1
					$html .='</div>';

				}	
				// end panel grup 1
				$html .='</div>';

			}


			return $html;
			
		}



		public function get_parameter_pdf($id_daerah='',$thn = '')
		{
			$parameter = 2;
			$res = $this->db->query('SELECT nilai from ms_target where tahun = "'.$thn.'" and parameter = '.$parameter.' and id_daerah = "'.$id_daerah.'"')->result();
			if (count($res)>0) {
				$target = (int)$res[0]->nilai;
			}else{
				$target = '0';
			}

			
			$html = '';
			// $resHtml = '';
			$htmlheader = '';
			$sql1 = 'CALL getTrWasTeknis('.$thn.',"'.$id_daerah.'",3);';
			$res1 = $this->db->query($sql1)->result_array();
			$this->db->close();
			$jmlRes1 = count($res1);
			$cresAll=1;
			$bobotAll = 0;
			$countAll = 0;
			$no =1;
			foreach ($res1 as $value1) {
				$cres1=1;
				$id_par1 = $value1['id_parameter'];
				$nm_par1 = $value1['nm_parameter'];
				$thn1 	 = $value1['tahun'];
				$nilai1  = $value1['nilai'] <> '' ? (int)$value1['nilai'] : 0;
				$bobot1  = $value1['bobot'] <> '' ? (int)$value1['bobot'] : 0;
				$bobotAll = $bobotAll+$bobot1;
				$countAll++;

				$sql2 = 'CALL getTrWasTeknis2('.$thn.',"'.$id_daerah.'",5,"'.$id_par1.'");';	
				$res2 = $this->db->query($sql2)->result_array();
				$this->db->close();
				$jmlRes2 = count($res2);
				
						$htmlsubparameter = '';
				if ($jmlRes2 > 0) {
					// $html .= '<td>'.$nm_par1.'</td>';
					foreach ($res2 as $value2) {
						$cres2=1;
						$cres1 = $cres1+1;
						$id_par2 = $value2['id_parameter'];
						$nm_par2 = $value2['nm_parameter'];
						$thn2 	 = $value2['tahun'];
						$nilai2  = $value2['nilai'] <> '' ? (int)$value2['nilai'] : 0;
						$bobot2  = $value2['bobot'] <> '' ? (int)$value2['bobot'] : 0;

						$sql3 = 'CALL getTrWasTeknis2('.$thn.',"'.$id_daerah.'",7,"'.$id_par2.'");';
						$res3 = $this->db->query($sql3)->result_array();
						$this->db->close();
						$jmlRes3 = count($res3);
						$subparameter = '';
						$subparameter2 = '';
						if ($jmlRes3 > 0) {


							foreach ($res3 as $value3) {
								$cres2 = $cres2+1;
								$cres1 = $cres1	+1;
								$id_par3 = $value3['id_parameter'];
								$nm_par3 = $value3['nm_parameter'];
								$thn3 	 = $value3['tahun'];
								$nilai3  = $value3['nilai'] <> '' ? (int)$value3['nilai'] : 0;
								$bobot3  = $value3['bobot'] <> '' ? (int)$value3['bobot'] : 0;
								
								$subparameter2 .= '	<td class="pmhMiddleLeft" style="vertical-align: middle;font-size:9pt;text-align:left;">'.$nm_par3.'</td>
													<td style="text-align:center;vertical-align: middle;">'.$nilai3.'</td>
													</tr><tr class="evenrow">'; 
							}
							
						}else{
							
							// $cres2 = $jmlRes3;
							// $subparameter2 .= '<td></td><td></td></tr><tr>';
						}
						if($cres2 <= 1){
							
							$subparameter .= '<td class="pmhMiddleLeft" style="vertical-align: middle;font-weight:bold;font-size:10pt;text-align:left;">'.$nm_par2.'</td>
												<td style="text-align:center;vertical-align: middle;">'.$nilai2.'</td>
												<td style="text-align:center;vertical-align: middle;">'.$bobot2.'%</td></tr><tr class="evenrow">'; 
						}else{
							$subparameter .= '<td class="pmhMiddleLeft" style="vertical-align: middle;font-weight:bold;font-size:10pt;text-align:left;">'.$nm_par2.'</td>
												<td style="text-align:center;vertical-align: middle;"></td>
												<td rowspan = "'.$cres2.'" style="text-align:center;vertical-align: middle;">'.$bobot2.'%</td></tr><tr class="evenrow">'; 
						}
						$htmlsubparameter .= $subparameter.$subparameter2;
					}
					$parameter = '<td rowspan = "'.$cres1.'" style="font-size:12pt;text-align:center;vertical-align: middle;">'.$no++.'</td>
								<td rowspan = "'.$cres1.'" style="font-size:12pt;text-align:center;vertical-align: middle;"></td>
								<td rowspan = "'.$cres1.'" style="font-size:12pt;text-align:center;vertical-align: middle;"></td>
								<td rowspan = "'.$cres1.'" style="font-size:12pt;text-align:center;vertical-align: middle;"></td>
								<td rowspan = "'.$cres1.'" style="font-size:12pt;text-align:center;vertical-align: middle;">'.$nm_par1.'</td>
								<td style="font-weight:bold;font-size:12pt;text-align:left;">'.$nm_par1.'</td>
								<td></td><td style="text-align:center;vertical-align: middle;font-size:12pt;">'.$bobot1.'%</td>
								</tr><tr class="evenrow">';
					
					$html .= $parameter.$htmlsubparameter;

				}else{
					$html .= '<td style="text-align:center;vertical-align: middle;font-size:12pt;">'.$nm_par1.'</td>
								<td style="text-align:center;vertical-align: middle;font-size:12pt;"></td>
								<td style="text-align:center;vertical-align: middle;font-size:12pt;">'.$nilai1.'</td>
								<td style="text-align:center;vertical-align: middle;font-size:12pt;">'.$bobot1.'%</td>
								</tr><tr class="evenrow">';
					
				}
				$cresAll = $cresAll + $cres1;
			}	
			$total = (int)($bobotAll/$countAll);
			// $htmlTotal = '<td colspan = "3" style="font-weight:bold;text-align:center;vertical-align: middle;font-size:12pt;">TOTAL</td>
								
			// 					<td style="text-align:center;vertical-align: middle;font-size:12pt;">'.$total.'%</td>
			// 					</tr><tr>';
			// $htmlheader .= '<tr class="evenrow">
			// 				<td style="text-align:center;vertical-align: middle;font-size:12pt;"></td>
			// 				<td style="text-align:center;vertical-align: middle;font-size:12pt;">Indeks Pengawasan Pemerintah Daerah</td>
			// 				<td style="text-align:center;vertical-align: middle;font-size:12pt;">'.$target.'%</td>
			// 				<td style="text-align:center;vertical-align: middle;font-size:12pt;">Nilai hasil pengawasan teknis (oleh Itjen dan Itprov)</td>
			// 				<td colspan = "3" style="font-weight:bold;text-align:center;vertical-align: middle;font-size:12pt;">TOTAL</td>
								
			// 					<td style="text-align:center;vertical-align: middle;font-size:12pt;">'.$total.'%</td>
			// 					</tr><tr>';	
			$resHtml = '<table class="bpmTopnTailC"  border = "1" style="border-collapse:collapse;">
						<thead>
							<tr class="headerrow" style="background: linear-gradient(90deg, rgba(228,227,227,1) 0%, rgba(201,201,203,1) 35%, rgba(181,181,181,1) 100%);">
								<th style="font-size:14pt;width:3%;">NO</th>
								<th style="font-size:14pt;width:12%;">INDIKATOR</th>
								<th style="font-size:14pt;width:10%;">TARGET</th>
								<th style="font-size:14pt;width:15%;">SUB INDIKATOR</th>
								<th style="font-size:14pt;width:14%;">PARAMETER</th>
								<th style="font-size:14pt;width:30%;">SUB PARAMETER</th>
								<th style="font-size:14pt;width:8%;">PENILAIAN</th>
								<th style="font-size:14pt;width:8%;">BOBOT</th>
							</tr>
							<tr class="headerrow" style="background: linear-gradient(90deg, rgba(228,227,227,1) 0%, rgba(201,201,203,1) 35%, rgba(181,181,181,1) 100%);">
								<th style="border-bottom:none;text-align:center;vertical-align: middle;font-size:12pt;"></th>
								<th style="border-bottom:none;text-align:center;vertical-align: middle;font-size:12pt;">Indeks Pengawasan Pemerintah Daerah</th>
								<th style="border-bottom:none;text-align:center;vertical-align: middle;font-size:12pt;">'.$target.'%</th>
								<th style="border-bottom:none;text-align:center;vertical-align: middle;font-size:12pt;">Nilai hasil pengawasan teknis (oleh Itjen dan Itprov)</th>
								<th colspan = "3" style="font-weight:bold;text-align:center;vertical-align: middle;font-size:12pt;">TOTAL</th>
								<th style="text-align:center;vertical-align: middle;font-size:12pt;">'.$total.'%</th>
							</tr>
						</thead>
						<tfoot>
							<tr class="headerrow" style="background: linear-gradient(90deg, rgba(228,227,227,1) 0%, rgba(201,201,203,1) 35%, rgba(181,181,181,1) 100%);">
								<td style="font-size:14pt;width:3%;">&nbsp;</td>
								<td style="font-size:14pt;width:12%;">&nbsp;</td>
								<td style="font-size:14pt;width:10%;">&nbsp;</td>
								<td style="font-size:14pt;width:15%;">&nbsp;</td>
								<td style="font-size:14pt;width:14%;">&nbsp;</td>
								<td style="font-size:14pt;width:30%;">&nbsp;</td>
								<td style="font-size:14pt;width:8%;">&nbsp;</td>
								<td style="font-size:14pt;width:8%;">&nbsp;</td>
							</tr>
						</tfoot>
						<tbody><tr class="evenrow">';

			$resHtml .= $htmlheader.$html;


						$resHtml.= '</tbody>
					</table>';
			
			return $resHtml;

		}

		public function get_daerah($kode)
		{
			$this->db->select('*');
			$this->db->from('ms_daerah');
			$this->db->where('id_daerah', $kode);
			$query = $this->db->get();
			$result = $query->row();
			return $result;
		}

		public function get_dashboard_teknis($id_daerah='',$thn='')
		{

			if ($id_daerah == '' || $id_daerah == 1) {
				$html = '<div class="alert alert-warning alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  <center><b>Peringatan!</b> Silahkan Pilih Daerah!</center>
						</div>';
			}else{

			
			$html = '<div class="treeview-animated w-100 border mx-4 my-4">
					  ';
			if($id_daerah == 'nasional'){
				$sql1 = 'CALL getTrWasTeknisAll('.$thn.',3);';
			}else{
				$sql1 = 'CALL getTrWasTeknis('.$thn.',"'.$id_daerah.'",3);';
			}

			$res1 = $this->db->query($sql1)->result_array();
			$this->db->close();
			$jmlRes1 = count($res1);
			if (count($res1)>0) {
				$html .='<ul class="treeview-animated-list mb-3">';
				$html .= '<li>
							<div class="treeview-animated-element">
								<table border = "0" width = "100%">
									<tr style = "border-bottom:1px solid black;font-weight:bold;">
										<td width="80%" style="font-size:16px;font-weight:bold;">&nbsp;PARAMETER</td>
										<td width="10%" style="font-size:16px;font-weight:bold;text-align:center;">Nilai</td>
										<td width="10%" style="font-size:16px;font-weight:bold;text-align:center;">Bobot (%)</td>
									</tr>
								</table> 
							
							</div>
						</li>';

				foreach ($res1 as $value1) {
					$id_par1 = $value1['id_parameter'];
					$nm_par1 = $value1['nm_parameter'];
					$thn1 	 = $value1['tahun'];
					$nilai1  = $value1['nilai'];
					$bobot1  = $value1['bobot'];
					if ($bobot1<50) {
						$bobot1 = "<font color='royalblue'>".$bobot1."</font>";
					}elseif ($bobot1<100) {
						$bobot1 = "<font color='royalblue'>".$bobot1."</font>";
					}else{
						$bobot1 = "<font color='royalblue'>".$bobot1."</font>";
					}
					if ($nilai1<1) {
						$nilai1 = "<font color='royalblue'>".$nilai1."</font>";
					}elseif ($nilai1<2) {
						$nilai1 = "<font color='royalblue'>".$nilai1."</font>";
					}else{
						$nilai1 = "<font color='royalblue'>".$nilai1."</font>";
					}

					$drh1  = $value1['id_daerah'];

					if($id_daerah == 'nasional'){
						$sql2 = 'CALL getTrWasTeknisAll2('.$thn.',5,"'.$id_par1.'");';
					}else{
						$sql2 = 'CALL getTrWasTeknis2('.$thn.',"'.$id_daerah.'",5,"'.$id_par1.'");';
					}
					
					
					$res2 = $this->db->query($sql2)->result_array();
					$this->db->close();

					$jmlRes2 = count($res2);
					// tentukan ada sub nya / tidak
					if (count($res2) == 0) {
						
						$html .= '<li>
									<div class="treeview-animated-element">
										<table border = "0" width = "100%" style="border-top: 1px dotted black;border-bottom: 1px dotted black;">
											<tr>
												<td width="80%" style="font-size:16px;">
													<table width = "100%">
														<tr>
															<td width="10%" style="font-size:16px;">'.$id_par1.' .</td>
															<td width="90%" style="font-size:16px;">'.$nm_par1.'</td>
														</tr>
													</table>
												</td>
												<td width="10%" style="font-size:16px;text-align:center;">'.$nilai1.'</td>
												<td width="10%" style="font-size:16px;text-align:center;">'.$bobot1.'</td>
											</tr>
										</table> 
									
									</div>
								</li>';
					}else{
						$html .= '<li class="treeview-animated-items">';
						$html .= '<a class="closed">
									
									<table border = "0" width = "100%" style="border-top: 1px dotted black;border-bottom: 1px dotted black;">
											<tr>
												<td width="80%" style="font-size:16px;">
													<table width = "100%">
														<tr>
															<td width="10%" style="font-size:16px;"><i class="fa fa-angle-right"></i> '.$id_par1.' .</td>
															<td width="90%" style="font-size:16px;">'.$nm_par1.'</td>
														</tr>
													</table>
												</td>
												<td width="10%" style="font-size:16px;text-align:center;">'.$nilai1.'</td>
												<td width="10%" style="font-size:16px;text-align:center;">'.$bobot1.'</td>
											</tr>
										</table> 
									
									</a>';
						$html .= '<ul class="nested">';
						foreach ($res2 as $value2) {
							$id_par2 = $value2['id_parameter'];
							$nm_par2 = $value2['nm_parameter'];
							$thn2 	 = $value2['tahun'];
							$nilai2  = $value2['nilai'];
							$bobot2  = $value2['bobot'];
							if ($bobot2<50) {
								$bobot2 = "<font color='green'>".$bobot2."</font>";
							}elseif ($bobot2<100) {
								$bobot2 = "<font color='green'>".$bobot2."</font>";
							}else{
								$bobot2 = "<font color='green'>".$bobot2."</font>";
							}
							if ($nilai2<1) {
								$nilai2 = "<font color='green'>".$nilai2."</font>";
							}elseif ($nilai2<2) {
								$nilai2 = "<font color='green'>".$nilai2."</font>";
							}else{
								$nilai2 = "<font color='green'>".$nilai2."</font>";
							}


							$drh2  	= $value2['id_daerah'];
							if($id_daerah == 'nasional'){
								$sql3 = 'CALL getTrWasTeknisAll2('.$thn.',7,"'.$id_par2.'");';
							}else{
								$sql3 = 'CALL getTrWasTeknis2('.$thn.',"'.$id_daerah.'",7,"'.$id_par2.'");';
							}
							$res3 = $this->db->query($sql3)->result_array();
							$this->db->close();
							$jmlRes3 = count($res3);
							if (count($res3) == 0) {
								
								$html .= '<li>
											<div class="treeview-animated-element">
												<table border = "0" width = "100%" style="border-top: 1px dotted black;border-bottom: 1px dotted black;">
													<tr>
														<td width="78.5%" style="font-size:14px;">
															<table width = "100%">
																<tr>
																	<td width="10%" style="font-size:14px;">'.$id_par2.' .</td>
																	<td width="90%" style="font-size:14px;">'.$nm_par2.'</td>
																</tr>
															</table>
														</td>
														<td width="10%" style="font-size:14px;text-align:center;">'.$nilai2.'</td>
														<td width="10%" style="font-size:14px;text-align:center;">'.$bobot2.'</td>
													</tr>
												</table> 
											</div>
										</li>';			
							}else{
								
								$html .= '<li class="treeview-animated-items">';
								$html .= '<a class="closed">  
											<table border = "0" width = "100%" style="border-top: 1px dotted black;border-bottom: 1px dotted black;">
												<tr>
													<td width="78.5%" style="font-size:14px;">
														<table width = "100%">
															<tr>
																<td width="10%" style="font-size:14px;">
																<i class="fa fa-angle-right"></i> '.$id_par2.' .</td>
																<td width="90%" style="font-size:14px;">'.$nm_par2.'</td>
															</tr>
														</table>
													</td>
													<td width="10%" style="font-size:14px;text-align:center;">'.$nilai2.'</td>
													<td width="10%" style="font-size:14px;text-align:center;">'.$bobot2.'</td>
												</tr>
											</table> 

											
										</a>';
								$html .= '<ul class="nested">';
								foreach ($res3 as $value3) {
									$id_par3 = $value3['id_parameter'];
									$nm_par3 = $value3['nm_parameter'];
									$thn3 	 = $value3['tahun'];
									$nilai3  = $value3['nilai'];
									$bobot3  = $value3['bobot'];

									if ($bobot3<50) {
										$bobot3 = "<font color='black'>".$bobot3."</font>";
									}elseif ($bobot3<100) {
										$bobot3 = "<font color='black'>".$bobot3."</font>";
									}else{
										$bobot3 = "<font color='black'>".$bobot3."</font>";
									}
									if ($nilai3<1) {
										$nilai3 = "<font color='black'>".$nilai3."</font>";
									}elseif ($nilai3<2) {
										$nilai3 = "<font color='black'>".$nilai3."</font>";
									}else{
										$nilai3 = "<font color='black'>".$nilai3."</font>";
									}

									$drh3  	 = $value3['id_daerah'];

									$html .= '<li><div class="treeview-animated-element"> 
												<table border = "0" width = "100%" style="border-top: 1px dotted black;border-bottom: 1px dotted black;">
													<tr>
														<td width="77.5%%" style="font-size:12px;">
															<table width = "100%">
																<tr>
																	<td width="10%" style="font-size:12px;">'.$id_par3.' .</td>
																	<td width="90%" style="font-size:12px;">'.$nm_par3.'</td>
																</tr>
															</table>
														</td>
														<td width="10%" style="font-size:12px;text-align:center;">'.$nilai3.'</td>
														<td width="10%" style="font-size:12px;text-align:center;">'.$bobot3.'</td>
													</tr>
												</table> 
											</div></li>';				
								}
								$html .= '</ul>';
								$html .= '</li>';
							}


						}
						$html .= '</ul>';
						$html .= '</li>';
					}
					//end tentukan ada sub nya /tidak

				}
				
				

				$html .='</ul>';
			}
			$html .= '</div>';
			// js
			$html .= '<script>$(document).ready(function() { $(".treeview-animated").mdbTreeview();$("[data-toggle=\'tooltip\']").tooltip(); });</script>';
		}
			return $html;
			
		}


		public function get_parameter_mdb($id_daerah='')
		{

			if ($id_daerah == '' || $id_daerah == 1) {
				$html = '<div class="alert alert-warning alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  <center><b>Peringatan!</b> Silahkan Pilih Daerah!</center>
						</div>';
			}else{


			$thn = $this->session->userdata('year_selected');
			
			$resDaerah = $this->PublicModel->getNamaDaerah($id_daerah);
			$judulDaerah = $resDaerah[0]->nama.'<br><small>('.strtoupper($resDaerah[0]->jenis).')</small>';

			$thn = $this->session->userdata('year_selected');
			
			$html = '<div class="panel panel-headline panel-primary" style="min-height:500px;">
						<div class="panel-heading">
							<h3 class="panel-title" style="text-align:center;">
							'.$judulDaerah.'
							</h3>
						</div>
						<div class="panel-body">
					';

			$html .= '<div class="treeview-animated w-100 border mx-4 my-4">
					  ';
			$sql1 = 'CALL getTrWasTeknis('.$thn.',"'.$id_daerah.'",3);';

			$res1 = $this->db->query($sql1)->result_array();
			$this->db->close();
			$jmlRes1 = count($res1);
			if (count($res1)>0) {
				$html .='<ul class="treeview-animated-list mb-3">';
				$html .= '<li>
							<div class="treeview-animated-element">
								<table border = "0" width = "100%">
									<tr style = "border-bottom:1px solid black;font-weight:bold;">
										<td width="70%" style="font-size:16px;font-weight:bold;">&nbsp;PARAMETER</td>
										<td width="10%" style="font-size:16px;font-weight:bold;text-align:center;">Nilai</td>
										<td width="10%" style="font-size:16px;font-weight:bold;text-align:center;">Bobot (%)</td>
										<td width="10%" style="font-size:16px;font-weight:bold;text-align:center;">Aksi</td>
									</tr>
								</table> 
							
							</div>
						</li>';

				foreach ($res1 as $value1) {
					$id_par1 = $value1['id_parameter'];
					$nm_par1 = $value1['nm_parameter'];
					$thn1 	 = $value1['tahun'];

					$nilai1  = $value1['nilai'];
					$bobot1  = $value1['bobot'];
					$drh1  = $value1['id_daerah'];
					// keterangan & file
					$sqlDtl1 = "SELECT keterangan, file FROM tr_was_teknis where id_parameter = '".$id_par1."' AND tahun =".$thn1." AND id_daerah ='".$drh1."'";
					$cekParameter1 = $this->db->query($sqlDtl1)->result();	
					if (count($cekParameter1) >= 1) {
						foreach ($cekParameter1 as $val1) {
							$files1 = $val1->file;
							$file1 = '';
							// if ($val1->file <> '') {
							// 	$file1='<span><i class="fa fa-file-pdf-o ic-w mx-1 previewAtt" style="padding-top:2px;padding-right:5px;color:red;" data-url ="'.base_url()."assets/file_upload/teknis/".$thn1."/".$drh1."/".$id_par1."/".$files1.'"  data-toggle="tooltip" title="Preview File"></i></span>';
							// }else{
							// 	$file1 = '<span><i class="ic-w mx-1" style="padding-top:2px;padding-right:5px;">&nbsp;&nbsp;&nbsp;</i></span>'; 
							// }

							if ($val1->keterangan <> '') {
								$ket1 = '<span><i class="fa fa-book ic-w mx-1 showModal" style="padding-top:2px;padding-right:5px;color:#0a803d;" data-id ="'.$id_par1.'" data-nama = "'.$nm_par1.'" data-nilai ="'.$nilai1.'" data-bobot ="'.$bobot1.'" data-thn ="'.$thn1.'" data-daerah ="'.$drh1.'" data-toggle="tooltip" title="Lihat Detail" data-aksi="view"></i></span>'; 
							}else{
								$ket1 = '<span><i class="ic-w mx-1" style="padding-top:2px;padding-right:5px;">&nbsp;&nbsp;&nbsp;</i></span>'; 
							}

						}
					}else{
						$ket1 = '<span><i class="ic-w mx-1" style="padding-top:2px;padding-right:5px;">&nbsp;&nbsp;&nbsp;</i></span>'; 
						$file1 = '<span><i class="ic-w mx-1" style="padding-top:2px;padding-right:5px;">&nbsp;&nbsp;&nbsp;</i></span>'; 
					}



					$sql2 = 'CALL getTrWasTeknis2('.$thn.',"'.$id_daerah.'",5,"'.$id_par1.'");';
					
					
					$res2 = $this->db->query($sql2)->result_array();
					$this->db->close();

					$jmlRes2 = count($res2);
					// tentukan ada sub nya / tidak
					if (count($res2) == 0) {
						
						$html .= '<li>
									<div class="treeview-animated-element">
										<table border = "0" width = "100%" style="border-top: 1px dotted black;border-bottom: 1px dotted black;">
											<tr>
												<td width="70%" style="font-size:16px;">
													<table width = "100%">
														<tr>
															<td width="10%" style="font-size:16px;">'.$id_par1.' .</td>
															<td width="90%" style="font-size:16px;">'.$nm_par1.'</td>
														</tr>
													</table>
												</td>
												<td width="10%" style="font-size:16px;text-align:center;"><font color="royalblue">'.$nilai1.'</font></td>
												<td width="10%" style="font-size:16px;text-align:center;"><font color="royalblue">'.$bobot1.'</font></td>
												<td width="10%" style="font-size:16px;text-align:center;">
													<span><i class="fa fa-pencil ic-w mx-1 showModal" style="padding-top:2px;padding-right:5px;color:#074979;" data-id ="'.$id_par1.'" data-nama = "'.$nm_par1.'" data-nilai ="'.$nilai1.'" data-bobot ="'.$bobot1.'" data-thn ="'.$thn1.'" data-daerah ="'.$drh1.'" data-toggle="tooltip" title="Edit Nilai" data-aksi="edit"></i></span>
													'.$ket1.'
													'.$file1.'
												</td>
											</tr>
										</table> 
									
									</div>
								</li>';
					}else{
						$html .= '<li class="treeview-animated-items">';
						$html .= '<a class="closed">
									
									<table border = "0" width = "100%"  style="border-top: 1px dotted black;border-bottom: 1px dotted black;">
											<tr>
												<td width="70%" style="font-size:16px;">
													<table width = "100%">
														<tr>
															<td width="10%" style="font-size:16px;"><i class="fa fa-angle-right"></i> '.$id_par1.' .</td>
															<td width="90%" style="font-size:16px;">'.$nm_par1.'</td>
														</tr>
													</table>
												</td>
												<td width="10%" style="font-size:16px;text-align:center;"><font color="royalblue">'.$nilai1.'</font></td>
												<td width="10%" style="font-size:16px;text-align:center;"><font color="royalblue">'.$bobot1.'</font></td>

												<td width="10%" style="font-size:16px;">
													<!--<span><i class="fa fa-pencil ic-w mx-1 pull-right showModal" style="padding-top:2px;padding-right:5px;" data-aksi="edit" data-level ="'.$value1["clevel"].'" data-id = "'.$value1["id_parameter"].'" data-header ="'.$value1["hd_parameter"].'" data-hd ="'.$value1["hd"].'" data-ket ="'.$value1["ket"].'" data-nama ="'.$value1["nm_parameter"].'" data-toggle="tooltip" title="Edit Nilai"></i></span>-->
												</td>
											</tr>
										</table> 
									
									</a>';
						$html .= '<ul class="nested">';
						foreach ($res2 as $value2) {
							$id_par2 = $value2['id_parameter'];
							$nm_par2 = $value2['nm_parameter'];
							$thn2 	 = $value2['tahun'];
							$nilai2  = $value2['nilai'];
							$bobot2  = $value2['bobot'];
							$drh2  	= $value2['id_daerah'];

							$sqlDtl2 = "SELECT keterangan, file FROM tr_was_teknis where id_parameter = '".$id_par2."' AND tahun =".$thn2." AND id_daerah ='".$drh2."'";
							$cekParameter2 = $this->db->query($sqlDtl2)->result();	
							if (count($cekParameter2) >= 1) {
								foreach ($cekParameter2 as $val2) {
									$files2 = $val2->file;
									$file2 = '';
									// if ($val2->file <> '') {
									// 	$file2='<span><i class="fa fa-file-pdf-o ic-w mx-1 previewAtt" style="padding-top:2px;padding-right:5px;color:red;" data-url ="'.base_url()."assets/file_upload/teknis/".$thn2."/".$drh2."/".$id_par2."/".$files2.'"  data-toggle="tooltip" title="Preview File"></i></span>';
										
									// }else{
									// 	$file2 = '<span><i class="ic-w mx-1" style="padding-top:2px;padding-right:5px;">&nbsp;&nbsp;&nbsp;</i></span>'; 
									// }

									if ($val2->keterangan <> '') {
										$ket2 = '<span><i class="fa fa-book ic-w mx-1 showModal" style="padding-top:2px;padding-right:5px;color:#0a803d;" data-id ="'.$id_par2.'" data-nama = "'.$nm_par2.'" data-nilai ="'.$nilai2.'" data-bobot ="'.$bobot2.'" data-thn ="'.$thn2.'" data-daerah ="'.$drh2.'" data-toggle="tooltip" title="Lihat Detail" data-aksi="view"></i></span>'; 
									}else{
										$ket2 = '<span><i class="ic-w mx-1" style="padding-top:2px;padding-right:5px;">&nbsp;&nbsp;&nbsp;</i></span>'; 
									}

								}
							}else{
								$ket2 = '<span><i class="ic-w mx-1" style="padding-top:2px;padding-right:5px;">&nbsp;&nbsp;&nbsp;</i></span>'; 
								$file2 = '<span><i class="ic-w mx-1" style="padding-top:2px;padding-right:5px;">&nbsp;&nbsp;&nbsp;</i></span>'; 
							}


							$sql3 = 'CALL getTrWasTeknis2('.$thn.',"'.$id_daerah.'",7,"'.$id_par2.'");';
							$res3 = $this->db->query($sql3)->result_array();
							$this->db->close();
							$jmlRes3 = count($res3);
							if (count($res3) == 0) {
								
								$html .= '<li>
											<div class="treeview-animated-element">
												<table border = "0" width = "100%" style="border-top: 1px dotted black;border-bottom: 1px dotted black;">
													<tr>
														<td width="68.5%" style="font-size:14px;">
															<table width = "100%">
																<tr>
																	<td width="10%" style="font-size:14px;">'.$id_par2.' .</td>
																	<td width="90%" style="font-size:14px;">'.$nm_par2.'</td>
																</tr>
															</table>
														</td>
														<td width="10%" style="font-size:14px;text-align:center;"><font color="green">'.$nilai2.'</font></td>
														<td width="10%" style="font-size:14px;text-align:center;"><font color="green">'.$bobot2.'</font></td>
														<td width="10%" style="font-size:14px;text-align:center;">
															<span><i class="fa fa-pencil ic-w mx-1 showModal" style="padding-top:2px;padding-right:5px;color:#074979;" data-id ="'.$id_par2.'" data-nama = "'.$nm_par2.'" data-nilai ="'.$nilai2.'" data-bobot ="'.$bobot2.'" data-thn ="'.$thn2.'" data-daerah ="'.$drh2.'" data-toggle="tooltip" title="Edit Nilai" data-aksi="edit"></i></span>
															'.$ket2.'
															'.$file2.'
														</td>
													</tr>
												</table> 
											</div>
										</li>';			
							}else{
								
								$html .= '<li class="treeview-animated-items">';
								$html .= '<a class="closed">  
											<table border = "0" width = "100%" style="border-top: 1px dotted black;border-bottom: 1px dotted black;">
												<tr>
													<td width="68.5%" style="font-size:14px;">
														<table width = "100%">
															<tr>
																<td width="10%" style="font-size:14px;">
																<i class="fa fa-angle-right"></i> '.$id_par2.' .</td>
																<td width="90%" style="font-size:14px;">'.$nm_par2.'</td>
															</tr>
														</table>
													</td>
													<td width="10%" style="font-size:14px;text-align:center;"><font color="green">'.$nilai2.'</font></td>
													<td width="10%" style="font-size:14px;text-align:center;"><font color="green">'.$bobot2.'</font></td>
													<td width="10%" style="font-size:14px;text-align:center;">
														<!--<span><i class="fa fa-pencil ic-w mx-1 pull-right showModal" style="padding-top:2px;padding-right:5px;" data-aksi="edit" data-level ="'.$value2["clevel"].'" data-id = "'.$value2["id_parameter"].'" data-header ="'.$value2["hd_parameter"].'" data-hd ="'.$value2["hd"].'" data-ket ="'.$value2["ket"].'" data-nama ="'.$value2["nm_parameter"].'" data-toggle="tooltip" title="Edit Nilai"></i></span>-->
													</td>
												</tr>
											</table> 

											
										</a>';
								$html .= '<ul class="nested">';
								foreach ($res3 as $value3) {
									$id_par3 = $value3['id_parameter'];
									$nm_par3 = $value3['nm_parameter'];
									$thn3 	 = $value3['tahun'];
									$nilai3  = $value3['nilai'];
									$bobot3  = $value3['bobot'];
									$drh3  	 = $value3['id_daerah'];

									$sqlDtl3 = "SELECT keterangan, file FROM tr_was_teknis where id_parameter = '".$id_par3."' AND tahun =".$thn3." AND id_daerah ='".$drh3."'";
									$cekParameter3 = $this->db->query($sqlDtl3)->result();	
									if (count($cekParameter3) >= 1) {
										foreach ($cekParameter3 as $val3) {
											$files3 = $val3->file;
											$file3 = '';
											// if ($val3->file <> '') {
											// 	$file3='<span><i class="fa fa-file-pdf-o ic-w mx-1 previewAtt" style="padding-top:2px;padding-right:5px;color:red;" data-url ="'.base_url()."assets/file_upload/teknis/".$thn3."/".$drh3."/".$id_par3."/".$files3.'"  data-toggle="tooltip" title="Preview File"></i></span>';
											// }else{
											// 	$file3 = '<span><i class="ic-w mx-1" style="padding-top:2px;padding-right:5px;">&nbsp;&nbsp;&nbsp;</i></span>'; 
											// }

											if ($val3->keterangan <> '') {
												$ket3 = '<span><i class="fa fa-book ic-w mx-1 showModal" style="padding-top:2px;padding-right:5px;color:#0a803d;" data-id ="'.$id_par3.'" data-nama = "'.$nm_par3.'" data-nilai ="'.$nilai3.'" data-bobot ="'.$bobot3.'" data-thn ="'.$thn3.'" data-daerah ="'.$drh3.'" data-toggle="tooltip" title="Lihat Detail" data-aksi="view"></i></span>'; 
											}else{
												$ket3 = '<span><i class="ic-w mx-1" style="padding-top:2px;padding-right:5px;">&nbsp;&nbsp;&nbsp;</i></span>'; 
											}

										}
									}else{
										$ket3 = '<span><i class="ic-w mx-1" style="padding-top:2px;padding-right:5px;">&nbsp;&nbsp;&nbsp;</i></span>'; 
										$file3 = '<span><i class="ic-w mx-1" style="padding-top:2px;padding-right:5px;">&nbsp;&nbsp;&nbsp;</i></span>'; 
									}


									$html .= '<li><div class="treeview-animated-element"> 
												<table border = "0" width = "100%" style="border-top: 1px dotted black;border-bottom: 1px dotted black;">
													<tr>
														<td width="67.5%%" style="font-size:12px;">
															<table width = "100%">
																<tr>
																	<td width="10%" style="font-size:12px;">'.$id_par3.' .</td>
																	<td width="90%" style="font-size:12px;">'.$nm_par3.'</td>
																</tr>
															</table>
														</td>
														<td width="10%" style="font-size:12px;text-align:center;">'.$nilai3.'</td>
														<td width="10%" style="font-size:12px;text-align:center;">'.$bobot3.'</td>
														<td width="10%" style="font-size:12px;text-align:center;">
															<span><i class="fa fa-pencil ic-w mx-1 showModal" style="padding-top:2px;padding-right:5px;color:#074979;" data-id ="'.$id_par3.'" data-nama = "'.$nm_par3.'" data-nilai ="'.$nilai3.'" data-bobot ="'.$bobot3.'" data-thn ="'.$thn3.'" data-daerah ="'.$drh3.'" data-toggle="tooltip" title="Edit Nilai" data-aksi="edit"></i></span>
															'.$ket3.'
															'.$file3.'
														</td>
													</tr>
												</table> 
											</div></li>';				
								}
								$html .= '</ul>';
								$html .= '</li>';
							}


						}
						$html .= '</ul>';
						$html .= '</li>';
					}
					//end tentukan ada sub nya /tidak

				}
				
				

				$html .='</ul>';
			}
			$html .= '</div></div></div>';
			// js
			$html .= '<script>$(document).ready(function() { $(".treeview-animated").mdbTreeview();$("[data-toggle=\'tooltip\']").tooltip(); });</script>';
		}
			return $html;
			
		}



		private function _get_all_parameter_query()
	    {
	    	$this->db->where('hd','H');
	        $this->db->from($this->table);
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
	        } 
	        else if(isset($this->order))
	        {
	            $order = $this->order;
	            $this->db->order_by(key($order), $order[key($order)]);
	        }
	    }
	 
	    function get_all_parameter()
	    {
	        $this->_get_all_parameter_query();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_parameter()
	    {
	        $this->_get_all_parameter_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function count_all_parameter()
	    {
	    	$this->db->where('hd','H');
	        $this->db->from($this->table);
	        return $this->db->count_all_results();
	    }

	    private function _get_all_sub_parameter_query()
	    {
	    	
	    	$this->db->where('hd','D');
	        $this->db->from($this->table);
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
	        } 
	        else if(isset($this->order))
	        {
	            $order = $this->order;
	            $this->db->order_by(key($order), $order[key($order)]);
	        }
	    }
	 
	    function get_all_sub_parameter()
	    {
	        $this->_get_all_sub_parameter_query();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_sub_parameter()
	    {
	        $this->_get_all_sub_parameter_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function count_all_sub_parameter()
	    {
	    	$this->db->where('hd','D');
	        $this->db->from($this->table);
	        return $this->db->count_all_results();
	    }
	   


		public function get_max_parameter($lvl,$header = '',$thn){
			
			if($lvl == 3){
				$hd = 'D';
			}else{
				$hd = 'H';
			}

			$this->db->select_max('id_parameter');
			$this->db->where('tahun', $thn);
			$this->db->where('hd', $hd);
			$this->db->where('clevel', $lvl);

			
			if ($lvl != 1) {
				$this->db->where('hd_parameter', $header);
			}else{
				$header = '';
			}

			$new = array('','100','00','00');
			$this->db->from('ms_was_teknis');
			$query = $this->db->get();
			
			$result = $query->row()->id_parameter;
			if ($result == 0 || $result == '') {
				$result = $header.$new[$lvl];
			}
			$max = $result+1;
			

			return $max;
		}


		public function get_max_lamp($id,$daerah,$tahun){

			$this->db->select_max('id_lamp');
			$this->db->where('id_parameter', $id);
			$this->db->where('id_daerah', $daerah);
			$this->db->where('tahun', $tahun);
			$this->db->from('tr_was_teknis_lamp');
			$query = $this->db->get();

			$result = $query->row()->id_lamp;
			if (!$result) {
				$result = 1;
			}else{
				$max_temuan = $result+1;
				$result = $max_temuan;
			}
				
			return $result;
		}
		

		public function edit_target($data, $parameter,$thn,$daerah){
			$this->db->where('parameter', $parameter);
			$this->db->where('tahun', $thn);
			$this->db->where('id_daerah', $daerah);
			$this->db->update('ms_target', $data);
			return true;
		}

		public function edit_parameter($data, $id, $daerah,$thn){
			$this->db->where('id_parameter', $id);
			$this->db->where('id_daerah', $daerah);
			$this->db->where('tahun', $thn);
			$this->db->update('tr_was_teknis', $data);
			return true;
		}

		public function get_combo_parameter($tahun)
		{
			
			$this->db->select('*');
			$this->db->from('ms_was_teknis');
			$this->db->where('hd', 'H');
			$this->db->where('tahun', $tahun);
			$this->db->order_by('id_parameter', 'asc');
			$query = $this->db->get();
			$result = $query->result_array();
			
			$html = '';
			$html .='<option value="">--Pilih Parameter--</option>';
			foreach($result as $row){
				$html .='<option value="'.$row['id_parameter'].'">'.$row['id_parameter'].' || '.$row['nm_parameter'].'</option>';
			}
			return $html;
		}

		public function getkab($kode)
		{
			$this->db->select('*');
			$this->db->from('ms_was_teknis');
			$this->db->where('hd_parameter', $kode);
			$query = $this->db->get();
			$result = $query->result_array();
			
			$html = '';
			$html .='<option value="">--Pilih Kabupaten--</option>';
			foreach($result as $row){
				$html .='<option value="'.$row['id_parameter'].'">'.$row['id_parameter'].' || '.$row['nm_parameter'].'</option>';
			}
			return $html;
		}

		public function getkec($kode)
		{
			$this->db->select('*');
			$this->db->from('ms_was_teknis');
			$this->db->where('hd_parameter', $kode);
			$query = $this->db->get();
			$result = $query->result_array();
			
			$html = '';
			$html .='<option value="">--Pilih Kecamatan--</option>';
			foreach($result as $row){
				$html .='<option value="'.$row['id_parameter'].'">'.$row['id_parameter'].' || '.$row['nm_parameter'].'</option>';
			}
			return $html;
		}

		

	}

?>