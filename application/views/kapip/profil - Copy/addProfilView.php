

<style>
.collapsible-form {
  background-color: #074979;
  color: white;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border-radius: 0px;
  border: none;
  border-bottom: 2px solid #f8a406;
  text-align: left;
  outline: none;
  font-size: 12px;
}

.active-form, .collapsible-form:hover {
  background-color: #074979;
}

.content-form {
  padding: 10px 18px;
  display: none;
  border: 1px solid #ccc;
  overflow: hidden;
  background-color: #fcfcfc;
}
</style>



<style>

/**/
.nav-pills > li.active > a,
.nav-pills > li.active > a:hover,
.nav-pills > li.active > a:focus {
	color: #fff;
	background-color: #f8a406;
	box-shadow: inset 3px 3px 4px #fcfcfc;
}
.nav-pills > li > a {
	border-radius: 0px;
}
textarea{
	resize: vertical;
}

textarea {
    font-size: 0.1rem;
    letter-spacing: 0.1px;
}
textarea {
    padding: 1px 1px;
    line-height: 0.2;
    border-radius: 5px;
    border: 1px solid #ccc;
    box-shadow: 1px 1px 1px #999;
}
.ui-autocomplete {
  z-index: 100000000;
}
.form-group{
	margin: 5px 5px ;
}
.control-label{
	bottom: 6px ;
}


</style>

	

<div class="panel panel-headline  panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-list-alt"></i> FORM DETAIL PROFIL</h3>
		
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form class="form-horizontal" id="form-profil">
				<button type="button" class="collapsible-form active-form">


				  	<div class="row">
						<div class="col-md-12">
	
							<div class="form-group">
							<div class="col-md-10">
	
								<label>APIP K/L/Provinsi/Kabupaten/Kota : </label><br>&nbsp;<?=$instansi ?> &nbsp;Tahun <?= $tahun ?>
								<label id="lbtriw" style="text-align: left;"></label>
									
									<input type="hidden" name="ptahun"  value=<?= $tahun ?> class="form-control input-sm" id="ptahun" placeholder="">
									<input type="hidden" name="pkdinstansi"  value=<?= $kode ?> class="form-control input-sm" id="pkdinstansi" placeholder="">
								
								
								
							</div>
								
								
								<div class="col-sm-2"><label>Pilih Triwulan</label>

									 <select name="triw" id="triw" class="form-control input-sm">
										<option value="0" ></option>
										<option value="1" >Triwulan I</option>
										<option value="2" >Triwulan II</option>
										<option value="3" >Triwulan III</option>
										<option value="4" >Triwulan IV</option>
									  </select>
								</div>
								
								
							</div>	
						
							<div class="form-group">


								
								
							</div>

						</div>
					</div>
			
				
				</button>
				
				

			</div>
		</div>
	</div>

</div>  


<!-- 2 -->


<div class="panel panel-headline  panel-primary">

	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form class="form-horizontal" id="form-profil1">
				<button name="btnp1" type="button" class="collapsible-form active-form">


				  	<div class="row">
						<div class="col-md-12">
	
							<div class="form-group">
							<div class="col-md-10">
							<h3 class="panel-title"><i class="fa fa-list-alt"></i> Profil Anggaran Realisasi</h3>


							</div>

							</div>	
						
							<div class="form-group">

								
							</div>

						</div>
					</div>
				
				</button>
				
				<div class="content-form" style="display:block;">
	
					<div class="row">
					
						  <div class="col-md-12"> 
						  <!--
									<div class="pull-right <?=$hidden; ?>">
									<input type="checkbox" checked data-toggle="toggle" data-on="Ready" data-off="Not Ready" data-onstyle="success" data-offstyle="danger">
										<a href="#"  class="list-group-item list-group-item-action showMap" type="button" name="tambahmap" id="tambahmap" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Tambahxx </a>
									</div>
									
									-->
						  </div>
					
					</div>	 
				
				
				  	<div class="row">
						<div class="col-md-12">
						

							<div class="product-status mg-b-15">
										<div class="container-fluid">
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<div class="product-status-wrap">
														
														<div class="asset-inner"><br>
															<table id="keluaran-table" class="table table-bordered table-striped" style="width:100%" border="0">
																<thead>
																	<tr>
																		<th style="text-align:center;" hidden></th>
																		<th style="text-align:center;">
																					<SELECT id="options" onchange="toggleOption(this)">
																						<OPTION value="1">Rinci</OPTION>
																						<OPTION value="2">Header</OPTION>
																					</SELECT>
																		
																		</th>
																		<th style="text-align:center;"><b>URAIAN</b></th>
																		<th style="text-align:center;"><b>INFORMASI</b></th>
																		<th style="text-align:center;" hidden><b>NILAIX</b></th>																		
																		<th style="text-align:center;"></th>
																	</tr>
																</thead>
																
																 <tbody id="data-profil-1" onLoad="hideAll()">
																						
																 </tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>



						</div>
					</div>
					 <p id="info"></p>
					
					<div class="panel-footer">
						<center>
							<a href="<?= base_url($this->dynamic_menu->EncryptLink('kapip-dataumum-profil-apip'));?>" class="btn btn-danger btn-lg"><i class="fa fa-arrow-circle-left"></i> KEMBALI</a>
							<button type="button"  class="btn btn-success btn-lg simpan-profil1"><i class="fa fa-check-square"></i> SIMPAN</button>
							<button type="button"  data-aksi="new" class="btn btn-primary btn-lg confirm hidden"><i class="fa fa-plus"></i> confirm</button>
						</center>
						</form>
					</div>					

				</div>

			</div>
		</div>

	</div>
</div>	


<!-- 3 -->


<div class="panel panel-headline  panel-primary">

	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form class="form-horizontal" id="form-profil">
				<button type="button" class="collapsible-form active-form">


				  	<div class="row">
						<div class="col-md-12">
	
							<div class="form-group">
							<div class="col-md-10">
							<h3 class="panel-title"><i class="fa fa-list-alt"></i> Profil Pengawasan</h3>
			
							</div>

							</div>	
						
							<div class="form-group">

								
							</div>

						</div>
					</div>
			
				
				</button>
				<div class="content-form" style="display:block;">
				  	<div class="row">
						<div class="col-md-12">
	

						</div>
					</div>
					
					
					<div class="panel-footer">
						<center>
							<a href="<?= base_url($this->dynamic_menu->EncryptLink('kapip-dataumum-profil-apip'));?>" class="btn btn-danger btn-lg"><i class="fa fa-arrow-circle-left"></i> KEMBALI</a>
							<button type="button" data-aksi="simpan" class="btn btn-success btn-lg simpan-temuan"><i class="fa fa-check-square"></i> SIMPAN</button>
							<button type="button"  data-aksi="new" class="btn btn-primary btn-lg confirm hidden"><i class="fa fa-plus"></i> confirm</button>
						</center>
						</form>
					</div>					

				</div>

			</div>
		</div>

	</div>
</div>	


<!-- 3 -->


<div class="panel panel-headline  panel-primary">

	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form class="form-horizontal" id="form-profil">
				<button type="button" class="collapsible-form active-form">


				  	<div class="row">
						<div class="col-md-12">
	
							<div class="form-group">
							<div class="col-md-10">
							<h3 class="panel-title"><i class="fa fa-list-alt"></i> Profil Realisasi Kegiatan Operasional Pengawasan</h3>
			
							</div>

							</div>	
						
							<div class="form-group">

								
							</div>

						</div>
					</div>
			
				
				</button>
				<div class="content-form" style="display:block;">
				  	<div class="row">
						<div class="col-md-12">
						
	
					<!--		
						
							<div class="form-group">

								<label class="col-sm-2 control-label input-sm" id="label-tipe">Triwulan</label>

								<div class="col-sm-4">
									 <select name="triwxx" id="triw" class="form-control input-sm">
										<option value="1" >Triwulan I</option>
										<option value="2" >Triwulan II</option>
										<option value="3" >Triwulan III</option>
										<option value="4" >Triwulan IV</option>
									  </select>
								</div>
							</div>
							
							-->

						</div>
					</div>
					
					
					<div class="panel-footer">
						<center>
							<a href="<?= base_url($this->dynamic_menu->EncryptLink('kapip-dataumum-profil-apip'));?>" class="btn btn-danger btn-lg"><i class="fa fa-arrow-circle-left"></i> KEMBALI</a>
							<button type="button" data-aksi="simpan" class="btn btn-success btn-lg simpan-temuan"><i class="fa fa-check-square"></i> SIMPAN</button>
							<button type="button"  data-aksi="new" class="btn btn-primary btn-lg confirm hidden"><i class="fa fa-plus"></i> confirm</button>
						</center>
						</form>
					</div>					

				</div>

			</div>
		</div>

	</div>
</div>	


<!-- 4 -->


<div class="panel panel-headline  panel-primary">

	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form class="form-horizontal" id="form-profil">
				<button type="button" class="collapsible-form active-form">


				  	<div class="row">
						<div class="col-md-12">
	
							<div class="form-group">
							<div class="col-md-10">
							<h3 class="panel-title"><i class="fa fa-list-alt"></i> Profil Tren Perbaikan Governance</h3>
			
							</div>

							</div>	
						
							<div class="form-group">

								
							</div>

						</div>
					</div>
			
				
				</button>
				<div class="content-form" style="display:block;">
				  	<div class="row">
						<div class="col-md-12">
						
	
					<!--		
						
							<div class="form-group">

								<label class="col-sm-2 control-label input-sm" id="label-tipe">Triwulan</label>

								<div class="col-sm-4">
									 <select name="triwxx" id="triw" class="form-control input-sm">
										<option value="1" >Triwulan I</option>
										<option value="2" >Triwulan II</option>
										<option value="3" >Triwulan III</option>
										<option value="4" >Triwulan IV</option>
									  </select>
								</div>
							</div>
							
							-->

						</div>
					</div>
					
					
					<div class="panel-footer">
						<center>
							<a href="<?= base_url($this->dynamic_menu->EncryptLink('kapip-dataumum-profil-apip'));?>" class="btn btn-danger btn-lg"><i class="fa fa-arrow-circle-left"></i> KEMBALI</a>
							<button type="button" data-aksi="simpan" class="btn btn-success btn-lg simpan-temuan"><i class="fa fa-check-square"></i> SIMPAN</button>
							<button type="button"  data-aksi="new" class="btn btn-primary btn-lg confirm hidden"><i class="fa fa-plus"></i> confirm</button>
						</center>
						</form>
					</div>					

				</div>

			</div>
		</div>

	</div>
</div>	



<!-- 5 -->


<div class="panel panel-headline  panel-primary">

	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form class="form-horizontal" id="form-profil">
				<button type="button" class="collapsible-form active-form">


				  	<div class="row">
						<div class="col-md-12">
	
							<div class="form-group">
							<div class="col-md-10">
							<h3 class="panel-title"><i class="fa fa-list-alt"></i> Profil Struktur Komposisi SDM</h3>
			
							</div>

							</div>	
						
							<div class="form-group">

								
							</div>

						</div>
					</div>
			
				
				</button>
				<div class="content-form" style="display:block;">
				  	<div class="row">
						<div class="col-md-12">
						
	
					<!--		
						
							<div class="form-group">

								<label class="col-sm-2 control-label input-sm" id="label-tipe">Triwulan</label>

								<div class="col-sm-4">
									 <select name="triwxx" id="triw" class="form-control input-sm">
										<option value="1" >Triwulan I</option>
										<option value="2" >Triwulan II</option>
										<option value="3" >Triwulan III</option>
										<option value="4" >Triwulan IV</option>
									  </select>
								</div>
							</div>
							
							-->

						</div>
					</div>
					
					
					<div class="panel-footer">
						<center>
							<a href="<?= base_url($this->dynamic_menu->EncryptLink('kapip-dataumum-profil-apip'));?>" class="btn btn-danger btn-lg"><i class="fa fa-arrow-circle-left"></i> KEMBALI</a>
							<button type="button" data-aksi="simpan" class="btn btn-success btn-lg simpan-temuan"><i class="fa fa-check-square"></i> SIMPAN</button>
							<button type="button"  data-aksi="new" class="btn btn-primary btn-lg confirm hidden"><i class="fa fa-plus"></i> confirm</button>
						</center>
						</form>
					</div>					

				</div>

			</div>
		</div>

	</div>
</div>	


<!-- 6 -->


<div class="panel panel-headline  panel-primary">

	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form class="form-horizontal" id="form-profil">
				<button type="button" class="collapsible-form active-form">


				  	<div class="row">
						<div class="col-md-12">
	
							<div class="form-group">
							<div class="col-md-10">
							<h3 class="panel-title"><i class="fa fa-list-alt"></i> Profil Sertifikasi Profesional SDM</h3>
			
							</div>

							</div>	
						
							<div class="form-group">

								
							</div>

						</div>
					</div>
			
				
				</button>
				<div class="content-form" style="display:block;">
				  	<div class="row">
						<div class="col-md-12">
						
	
					<!--		
						
							<div class="form-group">

								<label class="col-sm-2 control-label input-sm" id="label-tipe">Triwulan</label>

								<div class="col-sm-4">
									 <select name="triwxx" id="triw" class="form-control input-sm">
										<option value="1" >Triwulan I</option>
										<option value="2" >Triwulan II</option>
										<option value="3" >Triwulan III</option>
										<option value="4" >Triwulan IV</option>
									  </select>
								</div>
							</div>
							
							-->

						</div>
					</div>
					
					
					<div class="panel-footer">
						<center>
							<a href="<?= base_url($this->dynamic_menu->EncryptLink('kapip-dataumum-profil-apip'));?>" class="btn btn-danger btn-lg"><i class="fa fa-arrow-circle-left"></i> KEMBALI</a>
							<button type="button" data-aksi="simpan" class="btn btn-success btn-lg simpan-temuan"><i class="fa fa-check-square"></i> SIMPAN</button>
							<button type="button"  data-aksi="new" class="btn btn-primary btn-lg confirm hidden"><i class="fa fa-plus"></i> confirm</button>
						</center>
						</form>
					</div>					

				</div>

			</div>
		</div>

	</div>
</div>	







<!-- 6 -->


<div class="panel panel-headline  panel-primary">

	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form class="form-horizontal" id="form-profil">
				<button type="button" class="collapsible-form active-form">


				  	<div class="row">
						<div class="col-md-12">
	
							<div class="form-group">
							<div class="col-md-10">
							<h3 class="panel-title"><i class="fa fa-list-alt"></i> Profil IT</h3>
			
							</div>

							</div>	
						
							<div class="form-group">

								
							</div>

						</div>
					</div>
			
				
				</button>
				<div class="content-form" style="display:block;">
				  	<div class="row">
						<div class="col-md-12">
						
	
					<!--		
						
							<div class="form-group">

								<label class="col-sm-2 control-label input-sm" id="label-tipe">Triwulan</label>

								<div class="col-sm-4">
									 <select name="triwxx" id="triw" class="form-control input-sm">
										<option value="1" >Triwulan I</option>
										<option value="2" >Triwulan II</option>
										<option value="3" >Triwulan III</option>
										<option value="4" >Triwulan IV</option>
									  </select>
								</div>
							</div>
							
							-->

						</div>
					</div>
					
					
					<div class="panel-footer">
						<center>
							<a href="<?= base_url($this->dynamic_menu->EncryptLink('kapip-dataumum-profil-apip'));?>" class="btn btn-danger btn-lg"><i class="fa fa-arrow-circle-left"></i> KEMBALI</a>
							<button type="button" data-aksi="simpan" class="btn btn-success btn-lg simpan-temuan"><i class="fa fa-check-square"></i> SIMPAN</button>
							<button type="button"  data-aksi="new" class="btn btn-primary btn-lg confirm hidden"><i class="fa fa-plus"></i> confirm</button>
						</center>
						</form>
					</div>					

				</div>

			</div>
		</div>

	</div>
</div>	



<!-- Modal -->
<div class="modal fade" id="modalMap1"  tabindex="-1" role="dialog" aria-labelledby="modalMap1Label">
	<div class="modal-dialog  modal-lg"  role="document">
		<div class="modal-content" >
			<div class="modal-header">				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="modalMap1Label">MAPPING PROFIL ANGGARAN DAN REALISASI</h4>
			</div>
			
			
		<!--	<div class="modal-body" id="list_map1">


			</div>
			-->
			
			
			<div class="content-form" style="display:block;">
			
				<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
				<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
				
	
												<div class="asset-inner"><br>
															<table id="keluaran-map1" class="table table-dark table-striped  style="width:100%" border="1">
																<thead>
																	<tr>
																		
																		<th style="text-align:center;"><b>URAIAN</b></th>
																		<th style="text-align:center;"></th>
																	</tr>
																</thead>
																
																 <tbody id="list_map1">
																						
																 </tbody>
															</table>
												</div>
			
			
			<!--	  	<div class="row">
						<div class="col-md-12">
								<div class="modal-body" id="list_map1">


								</div>

						</div>
					</div>
				-->		
						
					
					<div class="panel-footer">
						<center>
							<a href="<?= base_url($this->dynamic_menu->EncryptLink('kapip-dataumum-profil-apip'));?>" class="btn btn-danger btn-lg"><i class="fa fa-arrow-circle-left"></i> KEMBALI</a>
							<button type="button" data-aksi="simpan" class="btn btn-success btn-lg simpan-temuan"><i class="fa fa-check-square"></i> SIMPAN</button>
							<button type="button"  data-aksi="new" class="btn btn-primary btn-lg confirm hidden"><i class="fa fa-plus"></i> confirm</button>
						</center>
						</form>
					</div>					

				</div>
			
			
			
			<div class="modal-footer">
				
			</div>

		</div>
	</div>
</div>




<!-- Modal Edit-->

<div class="modal fade" id="ModalEditProfil1"  tabindex="-1" role="dialog" aria-labelledby="modalEprofil1">
	<div class="modal-dialog  modal-lg"  role="document">
		<div class="modal-content" >
			<div class="modal-header">				
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="modalEprofil1">FORM ISIAN NILAI</h4>
			</div>
			
			

					<div class="asset-inner" id="list-rinci-p1">
							
									
									 
															
									
					</div>

					
					<div class="panel-footer">
						<center>
							<a href="<?= base_url($this->dynamic_menu->EncryptLink('kapip-dataumum-profil-apip'));?>" class="btn btn-danger btn-lg"><i class="fa fa-arrow-circle-left"></i> KEMBALI</a>
							<button type="button" data-aksi="simpan" class="btn btn-success btn-lg simpan-nilai-p1"><i class="fa fa-check-square"></i> SIMPAN</button>
							<button type="button"  data-aksi="new" class="btn btn-primary btn-lg confirm hidden"><i class="fa fa-plus"></i> confirm</button>
						</center>
						</form>
					</div>					

			
			
			
			
			<div class="modal-footer">
				
			</div>

		</div>
	</div>
</div>



<div class="modal fade" id="ModalEditProfil1"  role="dialog" aria-labelledby="EmyModalLabelP1">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="EmyModalLabelP1">Edit Profil Anggaran</h4>
      </div>
      <div class="modal-body" id="ElistDetail">

      <form id="form-edit-lokasi" enctype="multipart/form-data" method="post">

			<div class="product-status mg-b-15">
				<div class="container-fluid">
					<div class="row" style="margin-top: 5px">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="product-status-wrap">

								   <div class="form-group row" style="margin-top: 5px">
										<label for="role" class="col-sm-2 control-label input-sm">Sub Kegiatan</label>
										<div class="col-sm-10">
											<p id="lbeinfo" style="font-size: 18px;color: black; text-align: left;"></p> 
											<input type="hidden" readonly="true" name="ekdsubkeg" style="width: 152px;" class="form-control input-sm" id="ekdsubkeg" placeholder="">
											<input type="text" readonly="true" name="enmsubkeg" class="form-control input-sm" id="enmsubkeg" placeholder="">
											<input type="hidden" name="ekdskpd"  class="form-control input-sm" id="ekdskpd" placeholder="">
											
										</div>
									</div>	

									<div class="asset-inner"><br>
												<table id="rincian-profil1" class="table table-dark table-striped  style="width:100%" border="1">
													
													
													 <tbody id="list-simpan-p1">
																			
													 </tbody>
												</table>
									</div>							  					



												
										
						  </div>
					</div>
				</div>
			</div>	

	
	
	
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-flat btn-lg btn-primary">Simpan Perubahan</button> -->
        <input type="submit" name="submit"  id="edit" value="Simpan Perubahan" class="btn btn-primary btn-lg"  aksi = "edit">
        <button type="button" class="btn btn-flat btn-lg btn-danger" data-dismiss="modal">Tutup</button>
        </form>
      </div>
    </div>
  </div>
</div>

  </div>
</div>



<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: #F6FBF4;
  color: gray;
}


	
.flex {
    display: flex;
    justify-content: flex-start;
}
.flex input {
    max-width: 130px;
    flex: 1 1 300px;
}
.flex .currency {
    font-size:10px;
    padding: 0 10px 0 10px;
    color: #999;
    border: 1px solid #ccc;
    border-right: 0;
    line-height: 2.5;
    border-radius: 7px 0 0 7px;
    background: white;
}
	

</style>


<script>
var coll = document.getElementsByClassName("collapsible-form");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active-form");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}




</script>



	<script src="<?= base_url() ?>assets/vendor/datatables/autoCurrency.js"></script>
	<script src="<?= base_url() ?>assets/vendor/datatables/numberFormat.js"></script>
	
	<script src="<?= base_url() ?>assets/vendor/datepicker/bootstrap-datepicker.js"></script>
	<script src="<?= base_url() ?>assets/custom/custom.js"></script>
	


	<script type="text/javascript">
	$(document).ready(function() {	
		 $(function() {
			  $("#tahun").datepicker({
			  	minViewMode: 2,
	         	format: 'yyyy',
			    onSelect: function(dateText) {
			      display("Selected date: " + dateText + ", Current Selected Value= " + this.value);
			      $(this).change();
			    }
			  }).on("change", function() {
			    
			  });
		});
		
		
		
		
	let button = document.querySelector("#btnp1").click();



		
		
		
		
	});



	$('#triw').change(function(data) {			

			var ckode= '<?=$kode ?>';
			var ctahun= '<?= $tahun ?>';
			
			var triw = (document.getElementById('triw').value); 
				if(triw==1){
					ctriw='Triwulan I';
				}else if(triw==2){
					ctriw='Triwulan II';
					
				}else if(triw==3){
					ctriw='Triwulan III';
				}else if(triw==4){
					ctriw='Triwulan IV';
				}else{
					ctriw='';
				}
						document.getElementById("lbtriw").innerHTML=ctriw;	
		  
				$.ajax({  


				  url: '<?php echo base_url('kapip-dataumum-profil-apip/get-profil1'); ?>/'+ctahun+'/'+ckode+'/'+triw,
				  type: 'POST',
				  success: function(data){
					$("#data-profil-1").html(data);
				   // $('#table-subkeg').DataTable();
				  }
				});	

    });





 $(document).on("click", ".showEditRincian", function() {		  
		var ctahun 		= $(this).attr("data-tahun");

        var ckode 		= $(this).attr("data-kdapip");
		var cid 		= $(this).attr("data-cid");
        var ctriw       = $(this).attr("data-triw"); 
	//	var curaian 	= $(this).attr("data-uraian");
	
	//	var nmsubkeg    = $(this).attr("data-nmsubkeg"); 	

	
	
						
	   $('#ModalEditProfil1').modal('show');	
		    //$("#enmsubkeg").attr("value",curaian); 

	/*   $("#ekdskpd").attr("value",skpd); 	 
	   $("#ekdsubkeg").attr("value",subkeg); 
	   document.getElementById("lbeinfo").innerHTML=subkeg+' '+nmsubkeg; */



			$.ajax({           
			 url: '<?php echo base_url('kapip-dataumum-profil-apip/edit-profil1'); ?>/'+ctahun+'/'+ckode+'/'+ctriw+'/'+cid,
           // type: "POST",
            //dataType: "json",
			method: 'POST',
            success: function(data) {
				
					$('#list-rinci-p1').html(data);
					$('#ModalEditProfil1').modal('show');	





      
				
			
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
			
        });
		 
		
	
	});



 $(document).on("click", ".showMap", function() {		 

		var ctriw 		= $('#triw').val();		
			$ckode		= <?= $kode ?>;
			$cthn		=	<?= $tahun ?>;
		
		    $.ajax({           
			 url: '<?php echo base_url('kapip-dataumum-profil-apip/map1'); ?>/'+$cthn+'/'+$ckode+'/'+ctriw,
           // type: "POST",
            //dataType: "json",
			method: 'POST',
            success: function(data) {
				
					$('#list_map1').html(data);
					$('#modalMap1').modal('show');
				
				
				
			
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
			
        });
		 
		
	
	});




 $(document).on("click", ".setShowdata", function() {		 

alert('y'); 
		/* var thn 		= $(this).attr("data-tahun");
        var subkeg 		= $(this).attr("data-subkegiatan");
        var skpd        = $(this).attr("data-skpd"); 
		var nmsubkeg    = $(this).attr("data-nmsubkeg"); 		
	
							
	   $('#ModalEditProfil1').modal('show');	
	   $("#enmsubkeg").attr("value",nmsubkeg); 

	   $("#ekdskpd").attr("value",skpd); 	 
	   $("#ekdsubkeg").attr("value",subkeg); 
	   document.getElementById("lbeinfo").innerHTML=subkeg+' '+nmsubkeg;

		    $.ajax({           
			 url: '<?php echo base_url('anggaran-get-RinciSubkegiatan'); ?>?skpd='+skpd+'&subkeg='+subkeg,
            type: "POST",
            dataType: "json",
            success: function(data) {
      
				$("#ekabkota").val(data.kd_kabkota); 
				$('#ekabkota').select2().trigger('change');
	
				$("#ekecamatan").val(data.kd_kecamatan); 
				$('#ekecamatan').select2().trigger('change');

				$("#ekelurahan").val(data.kd_kelurahan); 
				$('#ekelurahan').select2().trigger('change');
				
				$("#eblnawal").val(data.waktu_awal); 
				$('#eblnawal').select2().trigger('change');
				
				$("#eblnakhir").val(data.waktu_akhir); 
				$('#eblnakhir').select2().trigger('change');
				
			
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
			
        });
		 */
		
	
	});




	$(document).on("click", ".showDetailbuttonApip", function() {
		
		alert('tesssssssss');
		return;
		/* var kode 		= $(this).attr("data-kd");
		
		alert(kode); */
		
		/* var no_lhp 		= $(this).attr("data-lhp");
        var nama 	= $(this).attr("data-nama");
        $.ajax({
	      method: 'POST',
	      url: '<?php echo base_url('tlhp-bpk-lapkeu/get-detail-button-lhp'); ?>?noreg='+noreg+'&no_lhp='+no_lhp,
	    })
	    .done(function(data) {
	    	$('#listDetail').html(data);
			   $('#myModal').modal('show');
	      	
	    }) */
	});


	$(document).ready(function() {
	  $('textarea').on('keyup keypress', function() {
	    $(this).height(0);
	    $(this).height(this.scrollHeight);
	  });
	  // The date picker (read the docs)
		
	});
	
	




	$(window).on('load', function () {

		<?php 
		$this->session->set_userdata(array('cart'=>0));
		?>
		$(function () {
			$('[data-toggle="tooltip"]').tooltip();
		});
			// Treeview Initialization
			$(document).ready(function() {
				$('.treeview-animated').mdbTreeview();
			});
  

	});


 // cekdn


$(document).on("click", ".simpan-profil1", function(e) {

	var data = $('#form-profil').serialize();
	var ctriw = $('#triw').val();
	var ctahun = $('#ptahun').val();
	var cinstansi = $('#pkdinstansi').val();
	
		
		document.getElementById('info').innerHTML = "";

        var myTab = document.getElementById('data-profil-1');

        
			var cdata='';
			var table = document.getElementById('data-profil-1');
			
			var cid = '';
			var cnilai = '';
		
			for (var r = 0, n = table.rows.length; r < n; r++) {
				  
				  
				var cid = cid+'#'+table.rows[r].cells[0].innerHTML;
				var cnilai = cnilai+'#'+table.rows[r].cells[4].innerHTML;

			
			}	
		

		
			$.ajax({
					type: 'POST',
					data: ({ctahun,cinstansi,cid,ctriw,cnilai}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-dataumum-profil-apip/simpan-profil1",
					success: function(data) {
						
						// console.log(data);

					   var status = data; //alert(status);
					   var pesan = "Berhasil Disimpan";
					   
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: pesan,
							showConfirmButton: false,
							timer: 2000
						});
					 
					 
					}
			});
				
		
		load_datatriw();
		
	});	
				


function hitungP1($cnilai,$index){
	//alert('aaatuus');
	
     
			var myTable = document.getElementById("data-profil-1");

	content=$cnilai;

	//var row = document.getElementById("myRow");
	
	var rn=$index;
	var cn=4;

		var x=document.getElementById('data-profil-1').rows[parseInt(rn,10)].cells;
		x[parseInt(cn,10)].innerHTML=content;
	
}



function hideAll() {
     hideRow('2');
	 hideRow('3');
     hideRow('4');
     hideRow('5');
     hideRow('6');
	 hideRow('7');
	 
	 
   }

 function hideRow(id) {
      var row = document.getElementById(id);
      row.style.display = 'none';
    }
	
//thisselect

/*  function filter(thisselect) {
	 
	 alert(thisselect);
	 
	
			/* for (i = 0; i < 20; i++) {
				toggleOption(this);
				

			   }
 
 }
 */

 function toggleOption(thisselect) {
	 

	//	hideRow('6');
	//	hideRow('7'); 
		 
	          for (i = 3; i < 9; i++) {
     
				var selected = i; //thisselect.options[thisselect.selectedIndex].value;
				
				toggleRow(selected);
				
			  }
			  
			  
			   for (i = 11; i < 17; i++) {
     
				var selected = i; //thisselect.options[thisselect.selectedIndex].value;
				
				toggleRow(selected);
				
			  }
			  
			  for (i = 18; i < 20; i++) {
     
				var selected = i; //thisselect.options[thisselect.selectedIndex].value;
				
				toggleRow(selected);
				
			  }
				
			 for (i = 22; i < 24; i++) {
     
				var selected = i; //thisselect.options[thisselect.selectedIndex].value;
				
				toggleRow(selected);
				
			  }	
			  
			 for (i = 25; i < 34; i++) {
     
				var selected = i; //thisselect.options[thisselect.selectedIndex].value;
				
				toggleRow(selected);
				
			  }	 
			  
			   for (i = 36; i < 45; i++) {
     
				var selected = i; //thisselect.options[thisselect.selectedIndex].value;
				
				toggleRow(selected);
				
			  }	 
			 
			 for (i = 46; i < 49; i++) {
     
				var selected = i; //thisselect.options[thisselect.selectedIndex].value;
				
				toggleRow(selected);
				
			  }	 
			  
			  
			 for (i = 51; i < 54; i++) {
     
				var selected = i; //thisselect.options[thisselect.selectedIndex].value;
				
				toggleRow(selected);
				
			  }	 			  
			  
			 for (i = 55; i < 57; i++) {
     
				var selected = i; //thisselect.options[thisselect.selectedIndex].value;
				
				toggleRow(selected);
				
			  }	 

			for (i = 59; i < 61; i++) {
     
				var selected = i; //thisselect.options[thisselect.selectedIndex].value;
				
				toggleRow(selected);
				
			  }	 			  
				
        
    }
	
	
		 function toggleP1_1() {	
			
					for (i = 3; i < 9; i++) {
			 
						var selected = i; //thisselect.options[thisselect.selectedIndex].value;
						
						toggleRow(selected);
						
					  }
		 }	  
				

		 function toggleP1_2() {				
			   for (i = 11; i < 17; i++) {
     
				var selected = i; //thisselect.options[thisselect.selectedIndex].value;
				
				toggleRow(selected);
				
			  }
		}


	function toggleP1_3() {		
			  
			  for (i = 18; i < 20; i++) {
     
				var selected = i; //thisselect.options[thisselect.selectedIndex].value;
				
				toggleRow(selected);
				
			  }
			  
	}	  
				

function toggleP1_4() {
			 for (i = 22; i < 24; i++) {
     
				var selected = i; //thisselect.options[thisselect.selectedIndex].value;
				
				toggleRow(selected);
				
			  }	
}


function toggleP1_5() {			  
			  
			 for (i = 25; i < 34; i++) {
     
				var selected = i; //thisselect.options[thisselect.selectedIndex].value;
				
				toggleRow(selected);
				
			  }	 
			  
}


function toggleP1_6() {	

	for (i = 36; i < 45; i++) {
     
				var selected = i; //thisselect.options[thisselect.selectedIndex].value;
				
				toggleRow(selected);
				
			  }	 
			 
}


function toggleP1_7() {
	
			 for (i = 46; i < 49; i++) {
     
				var selected = i; //thisselect.options[thisselect.selectedIndex].value;
				
				toggleRow(selected);
				
			  }	 
			  
}

function toggleP1_8() {
	
			 for (i = 51; i < 54; i++) {
     
				var selected = i; //thisselect.options[thisselect.selectedIndex].value;
				
				toggleRow(selected);
				
			  }	 			  
			  
}

function toggleP1_9() {	
  
			 for (i = 55; i < 57; i++) {
     
				var selected = i; //thisselect.options[thisselect.selectedIndex].value;
				
				toggleRow(selected);
				
			  }	 
}

function toggleP1_10() {			  

			for (i = 59; i < 61; i++) {
     
				var selected = i; //thisselect.options[thisselect.selectedIndex].value;
				
				toggleRow(selected);
				
			  }	 
	
}	
	
	
	

    function toggleRow(id) {
      var row = document.getElementById(id);
      if (row.style.display == '') {
        row.style.display = 'none';
      }
      else {
         row.style.display = '';
      }
    }

    function showRow(id) {
      var row = document.getElementById(id);
      row.style.display = '';
    }	

	function load_datatriw(){
		
			var ckode= '<?=$kode ?>';
				var ctahun= '<?= $tahun ?>';
				
				var triw = (document.getElementById('triw').value); 
					if(triw==1){
						ctriw='Triwulan I';
					}else if(triw==2){
						ctriw='Triwulan II';
						
					}else if(triw==3){
						ctriw='Triwulan III';
					}else if(triw==4){
						ctriw='Triwulan IV';
					}else{
						ctriw='';
					}
							document.getElementById("lbtriw").innerHTML=ctriw;	
			  
					$.ajax({  


					  url: '<?php echo base_url('kapip-dataumum-profil-apip/get-profil1'); ?>/'+ctahun+'/'+ckode+'/'+triw,
					  type: 'POST',
					  success: function(data){
						$("#data-profil-1").html(data);
					   // $('#table-subkeg').DataTable();
					  }
					});	
		
		
		
	}

$(document).on("click", ".hapusTemuan", function() {

	var noreg 		= $(this).attr("data-reg");
	var lhp 		= $(this).attr("data-lhp");
	var kode 		= $(this).attr("data-kode");
	var nama 	= $(this).attr("data-nama");


	Swal.fire({
		title: 'Apakah anda yakin?',
		text: "Menghapus data ("+noreg+") "+nama,
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#074979',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Ya, Hapus Data Ini.',
		cancelButtonText: 'Batal'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				method: 'POST',
				url: '<?php echo base_url('tlhp-kemendagri/del-temuan'); ?>?noreg='+noreg+'&lhp='+lhp+"&kode="+kode,
			})
			.done(function(data) {
				var out = jQuery.parseJSON(data);
				Swal.fire({
					position: 'top-end',
					icon: 'success',
					title: out.pesan,
					showConfirmButton: false,
					timer: 2000
				});
				$('#jml_temuan').html(out.jml_temuan);
				$('#modalMap1').modal('hide');
			})
		    // document.location.href = "<?= base_url('tlhp-kemendagri/del-temuan?'); ?>noreg="+noreg+"&lhp="+lhp+"&kode="+kode;
		}
	})

});


$(document).on("click", ".back_to_list", function(e) {
	$('#form-edit-temuan').attr('hidden','');
	$('#form-edit-rekomendasi').attr('hidden','');
	$('#daftar-list-lhp').removeAttr('hidden');
	e.preventDefault();
});

function deleteRow(btn) {
	var row = btn.parentNode.parentNode;
	row.parentNode.removeChild(row);
}



	$(document).on("click", "#btn1", function(e) {
        toggleP1_1();    
			
	 });


	$(document).on("click", "#btn9", function(e) {
        toggleP1_2();    
			
	 });


	$(document).on("click", "#btn16", function(e) {
        toggleP1_3();    
			
	 })
	 
	 
	$(document).on("click", "#btn20", function(e) {
        toggleP1_4();    
			
	 })
	$(document).on("click", "#btn23", function(e) {
        toggleP1_5();    
			
	 })
	$(document).on("click", "#btn34", function(e) {
        toggleP1_6();    
			
	 })
	$(document).on("click", "#btn44", function(e) {
        toggleP1_7();    
			
	 })
	$(document).on("click", "#btn49", function(e) {
        toggleP1_8();    
			
	 })
	$(document).on("click", "#btn53", function(e) {
        toggleP1_9();    
			
	 })
	$(document).on("click", "#btn57", function(e) {
        toggleP1_10();    
			
	 })
	 
	 
	 
	 

</script>    

