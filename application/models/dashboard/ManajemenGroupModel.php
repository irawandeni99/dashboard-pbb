<?php
	class ManajemenGroupModel extends CI_Model{

		public function viewManajemen()
		{
				
		$query="SELECT 
					id_group,
					nm_group,
					COUNT(*) OVER() AS jml
				FROM ms_group
				ORDER BY id_group, nm_group";
		

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
				
				
		

				$button3 = '<button style="background-color: #D91656; color: #F6F6F6; border-radius: 45%;" data-toggle="dropdown"  id="btnGroupDrop1" class="dropdown-toggle" aria-expanded="false" title="Klik Aksi"> <i class="fa fa-user-o" style="font-size:18px;color:white"></i>';
				
				$btnmenu = '<a class="list-group-item list-group-item-action showManajemen-menu"  data-kdgroup="'.$cid_group.'" data-nmgroup="'.$cnm_group.'"><i class="fa fa-cogs" aria-hidden="true" style="color: #F15412"></i> Atur Menu</a>';

				$btndel = '<a class="list-group-item list-group-item-action hapus-group-profil" data-kdgroup="'.$cid_group.'" data-nmgroup="'.$cnm_group.'"><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus Group</a>';
										
				$subbutton=$btnmenu.$btndel;
 
				$aksi_group='<center>
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
									 '.$aksi_group.'</button> 
								</div>
							
								<div class="col-md-10" style="cursor: pointer; padding: 3px 0; color: #fff; text-align: center;">
								
								<fieldset>
									<legend>
								
									<details>
										<summary  style="font-size: 16px;color: #1E93AB; text-align: left;" data-toggle="tooltip" data-placement="top" title="Klik Detail Group"><b>'.$cno.'  :  '.$cnm_group.' </b></summary></legend><br>';
				
													$lc = "
														SELECT*FROM(
														SELECT a.urut,a.id_menu AS kode,a.id_menu,a.parent_id,a.title,a.url,a.icon FROM sys_menu a
														INNER JOIN sys_group b ON a.id_menu=b.id_menu
														WHERE parent_id=0 AND id_group=".$cid_group." 

														UNION

														SELECT a.urut,a.parent_id AS kode ,a.id_menu,a.parent_id,a.title,a.url,''icon FROM sys_menu a
														INNER JOIN sys_group b ON a.id_menu=b.id_menu
														WHERE parent_id<>0 AND id_group=".$cid_group." 
														)zz ORDER BY urut";
													
													$query = $this->db->query($lc);
													$data=$query->result();
													
													foreach($data as $menu){
													
													$cid_menu	=	$menu->id_menu;
													$ctitle		=	$menu->title;
													$cicon		=	$menu->icon;
													$parent_id	=	$menu->parent_id;
									
													$btndel = '<a class="list-group-item list-group-item-action hapus-profil"  data-idgroup="'.$cid_group.'" data-idmenu="'.$cid_menu.'" ><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus Profil</a>';
													$subbutton=$btndel;
													
													$aksi_menu='<center>
															<div class="btn-group col-md-1" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
																
																</button><ul class="dropdown-menu" >
																<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
																	  
																	  '.$subbutton.'
																	
																</div> 
															  </div>
															
														</center>';
																	

														$html.='<div class="col-md-12"><fieldset>';

													if($parent_id==0){
																$html.=''.$aksi_menu.'
																	<summary style="font-size: 14px;color: #1E93AB; text-align: left; margin-left:100px;padding:8px"  data-toggle="tooltip" data-placement="top" title="Klik Detail Topik"><b style="margin-left: -100px;" > 
																	<button style="background-color: #006b6f; color: #F6F6F6; " data-toggle="dropdown"  id="btnGroupDrop1" class="dropdown-toggle" aria-expanded="false"> 
																	
																	'.$cicon.' </button>&nbsp;&nbsp;'.$menu->title.' </b></summary> ';

														}else{
																$html.=''.$aksi_menu.'
																	<summary style="font-size: 14px;color: #1E93AB; text-align: left; margin-left:45px;padding:8px"  data-toggle="tooltip" data-placement="top" title="Klik Detail Topik">
																	'.$menu->title.' </summary>';

															
														}
					
																													  
														$html.='</fieldset></div>';
														 
														
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




		public function viewAddMenu($cgroup)
		{

			$nmgroup = $this->PublicModel->get_nama($cgroup,'nm_group','ms_group','id_group');
					
			$query = "select b.urut,a.id_group,a.id_menu,b.title nm_menu,b.parent_id,b.is_parent from sys_group a
						inner join sys_menu b on a.id_menu=b.id_menu 
						where b.parent_id=0 and show_menu='1' and id_group='".$cgroup."' order by b.urut"; //cast(a.id_menu as int),b.parent_id,b.is_parent";					
			
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
			
						$query2 = "select b.urut,a.id_group,a.id_menu,b.title nm_menu,b.parent_id,b.is_parent from sys_group a
									inner join sys_menu b on a.id_menu=b.id_menu 
									where b.parent_id='".$cidmenu."' and show_menu='1' and id_group='".$cgroup."' order by b.urut";  //cast(a.id_menu as int),b.parent_id,b.is_parent";			

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
								
								
								
								$query3 = "select b.urut,a.id_group,a.id_menu,b.title nm_menu,b.parent_id,b.is_parent from sys_group a
									inner join sys_menu b on a.id_menu=b.id_menu 
									where b.parent_id='".$cidmenu2."' and show_menu='1' and id_group='".$cgroup."' order by b.urut"; //cast(a.id_menu as int),b.parent_id,b.is_parent";			

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


		public function viewAddGroup()
		{
		
		$query = "SELECT DISTINCT a.id_group,b.nm_group FROM ms_group_menu_elemen a
				INNER JOIN ms_group b ON a.id_group=b.id_group  order by a.id_group";

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



		public function add_menu($data){
			$this->db->insert('sys_group', $data);
			return true;
		}


		public function add_group($data){
			$this->db->insert('ms_group_menu_elemen', $data);
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


	}

?>