

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
								<h3 class="panel-title"><?=$instansi ?> &nbsp;Tahun <?= $tahun ?> <label id="lbtriw" style="text-align: left;"></label></h3>
								
									
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


<!-- 1 -->


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
							</div>
						</div>
					
					</button>
				
				<div class="content-form" style="display:block;">
	
					
				
				
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
																		<th style="text-align:center;" hidden><</th>																		
																		<th style="text-align:center;"></th>
																	</tr>
																</thead>
																
																 <tbody id="data-profil-1" >
																						
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


<!-- 2 -->


<div class="panel panel-headline  panel-primary">

	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form class="form-horizontal" id="form-profil2">
				<button type="button" class="collapsible-form active-form">


				  	<div class="row">
						<div class="col-md-12">
	
							<div class="form-group">
							<div class="col-md-10">
							<h3 class="panel-title"><i class="fa fa-list-alt"></i> Profil Kegiatan Operasional Pengawasan APIP Dan Realisasi</h3>
			
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
	
					
			
	
					  	<div class="row">
						<div class="col-md-12">
						

							<div class="product-status mg-b-15">
										<div class="container-fluid">
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<div class="product-status-wrap">
														
														<div class="asset-inner"><br>
															<table id="Pengawasan-table" class="table table-bordered table-striped" style="width:100%" border="0">
																<thead>
																	<tr>
																		<th style="text-align:center;" hidden></th>
																		<th style="text-align:center;">
																					<SELECT id="optionsP2" onchange="toggleOptionP2(this)">
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
																
																 <tbody id="data-profil-2" >
																						
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
	

						</div>
					</div>
					
					
					<div class="panel-footer">
						<center>
							<a href="<?= base_url($this->dynamic_menu->EncryptLink('kapip-dataumum-profil-apip'));?>" class="btn btn-danger btn-lg"><i class="fa fa-arrow-circle-left"></i> KEMBALI</a>
							<button type="button" data-aksi="simpan" class="btn btn-success btn-lg simpan-profil2"><i class="fa fa-check-square"></i> SIMPAN</button>
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

<!--
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
							<h3 class="panel-title"><i class="fa fa-list-alt"></i> Profil Kegiatan Operasional Pengawasan APIP Dan Realisasi</h3>
			
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

-->

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
									<div class="product-status mg-b-15">
										<div class="container-fluid">
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<div class="product-status-wrap">
														
														<div class="asset-inner"><br>
															<table id="struktur-table" class="table table-bordered table-striped" style="width:100%" border="0">
																<thead>
																	<tr>
																		<th style="text-align:center;" hidden></th>
																		<th style="text-align:center;">
																					<SELECT id="optionsP5" onchange="toggleOptionP5(this)">
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
																
																 <tbody id="data-profil-5" >
																						
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
					
					
					<div class="panel-footer">
						<center>
							<a href="<?= base_url($this->dynamic_menu->EncryptLink('kapip-dataumum-profil-apip'));?>" class="btn btn-danger btn-lg"><i class="fa fa-arrow-circle-left"></i> KEMBALI</a>
							<button type="button" data-aksi="simpan" class="btn btn-success btn-lg simpan-profil5"><i class="fa fa-check-square"></i> SIMPAN</button>
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
				<form class="form-horizontal" id="form-profil6">
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
						
									<div class="product-status mg-b-15">
										<div class="container-fluid">
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<div class="product-status-wrap">
														
														<div class="asset-inner"><br>
															<table id="sertifikasi-table" class="table table-bordered table-striped" style="width:100%" border="0">
																<thead>
																	<tr>
																		<th style="text-align:center;" hidden></th>
																		<th style="text-align:center;">
																					<SELECT id="optionsP6" onchange="toggleOptionP6(this)">
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
																
																 <tbody id="data-profil-6">
																						
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
					
					
					<div class="panel-footer">
						<center>
							<a href="<?= base_url($this->dynamic_menu->EncryptLink('kapip-dataumum-profil-apip'));?>" class="btn btn-danger btn-lg"><i class="fa fa-arrow-circle-left"></i> KEMBALI</a>
							<button type="button" data-aksi="simpan" class="btn btn-success btn-lg simpan-profil6"><i class="fa fa-check-square"></i> SIMPAN</button>
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






<div class="modal fade" id="ModalEditProfil1"  role="dialog" aria-labelledby="EmyModalLabelP1">
  <div class="modal-dialog  " role="document">
    <div class="modal-content">
      <div class="modal-header">
	  
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="EmyModalLabelP1">FORM INPUT NILAI</h4>
      </div>
      <div class="modal-body" id="ElistDetail">

      <form id="form-edit-p1" enctype="multipart/form-data" method="post">

			<div class="product-status mg-b-15">
				<div class="container-fluid">
					<div class="row" style="margin-top: 5px">
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
														<th style="text-align:center;"><b>URAIAN</b></th>
														<th style="text-align:center;"><b>INFORMASI</b></th>
														<th style="text-align:center;" hidden><b>NILAI</b></th>																		
														
													
												</tr>
											</thead>
											
											 <tbody id="data-eprofil-1" >
																	
											 </tbody>
										</table>	
									
					  					
	
										
						  </div>
					</div>
				</div>
			</div>	

	
	
	
		<div class="modal-footer">
					<center>
						<!--<a href="#" class="btn btn-danger btn-lg kembali"><i class="fa fa-arrow-circle-left"></i> KEMBALI</a>
						
						-->
						
						<button type="button"  class="btn-danger btn-sm" data-dismiss="modal"> <i class="fa fa-arrow-circle-left"></i> KEMBALI</button>
						<button type="button"  class="btn-success btn-sm simpan-eprofil1"><i class="fa fa-check-square"></i> SIMPAN </button>
						<button type="button"  data-aksi="new" class="btn btn-primary btn-sm confirm hidden"><i class="fa fa-plus"></i> confirm</button>
					</center>
        </form>
		
		
		
		
      </div>
    </div>
  </div>
</div>

  </div>
</div>




<div class="modal fade" id="ModalEditProfil2"  role="dialog" aria-labelledby="EmyModalLabelP2">
  <div class="modal-dialog  " role="document">
    <div class="modal-content">
      <div class="modal-header">
	  
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="EmyModalLabelP1">FORM INPUT NILAI</h4>
      </div>
      <div class="modal-body" id="ElistDetailP2">

      <form id="form-edit-p2" enctype="multipart/form-data" method="post">

			<div class="product-status mg-b-15">
				<div class="container-fluid">
					<div class="row" style="margin-top: 5px">
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
														<th style="text-align:center;"><b>URAIAN</b></th>
														<th style="text-align:center;"><b>INFORMASI</b></th>
														<th style="text-align:center;" hidden><b>NILAI</b></th>																		
														
													
												</tr>
											</thead>
											
											 <tbody id="data-eprofil-2" >
																	
											 </tbody>
										</table>	
									
										
						  </div>
					</div>
				</div>
			</div>
			
		<div class="modal-footer">
					<center>
						
						<button type="button"  class="btn-danger btn-sm" data-dismiss="modal"> <i class="fa fa-arrow-circle-left"></i> KEMBALI</button>
						<button type="button"  class="btn-success btn-sm simpan-eprofil2"><i class="fa fa-check-square"></i> SIMPAN </button>
						<button type="button"  data-aksi="new" class="btn btn-primary btn-sm confirm hidden"><i class="fa fa-plus"></i> confirm</button>
					</center>
        </form>
		
      </div>
    </div>
  </div>
</div>

  </div>
</div>




<div class="modal fade" id="ModalEditProfil5"  role="dialog" aria-labelledby="EmyModalLabelP5">
  <div class="modal-dialog  " role="document">
		<div class="modal-content">
		  <div class="modal-header">
		  
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="EmyModalLabelP1">FORM INPUT NILAI</h4>
		  </div>
		  <div class="modal-body" id="ElistDetailP5">

		  <form id="form-edit-p5" enctype="multipart/form-data" method="post">

				<div class="product-status mg-b-15">
					<div class="container-fluid">
						<div class="row" style="margin-top: 5px">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="product-status-wrap">

									   <div class="form-group row" style="margin-top: 5px">
											
											<div class="col-sm-10">
												<p id="lbeinfo5" style="font-size: 18px;color: black; text-align: left;"></p> 
												
											</div>
										</div>	
										
											<table id="E-Ptable" class="table table-bordered table-striped" style="width:100%" border="0">
												<thead>
													<tr>
														<th style="text-align:center;" hidden>id</th>
															<th style="text-align:center;"><b>URAIAN</b></th>
															<th style="text-align:center;"><b>INFORMASI</b></th>
															<th style="text-align:center;" hidden><b>NILAI</b></th>																		
															
														
													</tr>
												</thead>
												
												 <tbody id="data-eprofil-5" >
																		
												 </tbody>
											</table>	
										
											
							  </div>
						</div>
					</div>
				</div>
				
			<div class="modal-footer">
						<center>
							
							<button type="button"  class="btn-danger btn-sm" data-dismiss="modal"> <i class="fa fa-arrow-circle-left"></i> KEMBALI</button>
							<button type="button"  class="btn-success btn-sm simpan-eprofil5"><i class="fa fa-check-square"></i> SIMPAN </button>
							<button type="button"  data-aksi="new" class="btn btn-primary btn-sm confirm hidden"><i class="fa fa-plus"></i> confirm</button>
						</center>
			</form>
			
		  </div>
		</div>
	  </div>
	</div>

  </div>
</div>


<div class="modal fade" id="ModalEditProfil6"  role="dialog" aria-labelledby="EmyModalLabelP6">
  <div class="modal-dialog  " role="document">
		<div class="modal-content">
		  <div class="modal-header">
		  
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="EmyModalLabelP1">FORM INPUT NILAI</h4>
		  </div>
		  <div class="modal-body" id="ElistDetailP6">

		  <form id="form-edit-p6" enctype="multipart/form-data" method="post">

				<div class="product-status mg-b-15">
					<div class="container-fluid">
						<div class="row" style="margin-top: 5px">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="product-status-wrap">

									   <div class="form-group row" style="margin-top: 5px">
											
											<div class="col-sm-10">
												<p id="lbeinfo6" style="font-size: 18px;color: black; text-align: left;"></p> 
												
											</div>
										</div>	
										
											<table id="Esertifikasi-table" class="table table-bordered table-striped" style="width:100%" border="0">
												<thead>
													<tr>
														<th style="text-align:center;" hidden>id</th>
															<th style="text-align:center;"><b>URAIAN</b></th>
															<th style="text-align:center;"><b>INFORMASI</b></th>
															<th style="text-align:center;" hidden><b>NILAI</b></th>																		
															
														
													</tr>
												</thead>
												
												 <tbody id="data-eprofil-6" >
																		
												 </tbody>
											</table>	
										
											
							  </div>
						</div>
					</div>
				</div>
				
			<div class="modal-footer">
						<center>
							
							<button type="button"  class="btn-danger btn-sm" data-dismiss="modal"> <i class="fa fa-arrow-circle-left"></i> KEMBALI</button>
							<button type="button"  class="btn-success btn-sm simpan-eprofil6"><i class="fa fa-check-square"></i> SIMPAN </button>
							<button type="button"  data-aksi="new" class="btn btn-primary btn-sm confirm hidden"><i class="fa fa-plus"></i> confirm</button>
						</center>
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



				$.ajax({  
				  url: '<?php echo base_url('kapip-dataumum-profil-apip/get-profil2'); ?>/'+ctahun+'/'+ckode+'/'+triw,
				  type: 'POST',
				  success: function(data){
					$("#data-profil-2").html(data);
				   
				  }
				});					


				$.ajax({  
				  url: '<?php echo base_url('kapip-dataumum-profil-apip/get-profil5'); ?>/'+ctahun+'/'+ckode+'/'+triw,
				  type: 'POST',
				  success: function(data){
					$("#data-profil-5").html(data);
				   
				  }
				});					


				$.ajax({  
				  url: '<?php echo base_url('kapip-dataumum-profil-apip/get-profil6'); ?>/'+ctahun+'/'+ckode+'/'+triw,
				  type: 'POST',
				  success: function(data){
					$("#data-profil-6").html(data);
				   
				  }
				});					

    });





 $(document).on("click", ".showEditRincian", function() {		  
		var ctahun 		= $(this).attr("data-tahun");
        var ckode 		= $(this).attr("data-kdapip");
		var cid 		= $(this).attr("data-cid");
        var ctriw       = $(this).attr("data-triw"); 
		
						
	   $('#ModalEditProfil1').modal('show');	

			$.ajax({           
			 url: '<?php echo base_url('kapip-dataumum-profil-apip/edit-profil1'); ?>/'+ctahun+'/'+ckode+'/'+ctriw+'/'+cid,
           // type: "POST",
            //dataType: "json",
			method: 'POST',
            success: function(data) {
				
					$('#data-eprofil-1').html(data);
				//	$('#ModalEditProfil1').modal('show');
      
				
			
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
			
        });
		 
		
	
	});



 $(document).on("click", ".showEditRincianP2", function() {		  
		var ctahun 		= $(this).attr("data-tahun");
        var ckode 		= $(this).attr("data-kdapip");
		var cid 		= $(this).attr("data-cid");
        var ctriw       = $(this).attr("data-triw"); 
		
						
	   $('#ModalEditProfil2').modal('show');	

			$.ajax({           
			 url: '<?php echo base_url('kapip-dataumum-profil-apip/edit-profil2'); ?>/'+ctahun+'/'+ckode+'/'+ctriw+'/'+cid,
           // type: "POST",
            //dataType: "json",
			method: 'POST',
            success: function(data) {
				
					$('#data-eprofil-2').html(data);
				//	$('#ModalEditProfil1').modal('show');
      
				
			
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
			
        });
		 
		
	
	});

 $(document).on("click", ".showEditRincianP5", function() {		  
		var ctahun 		= $(this).attr("data-tahun");
        var ckode 		= $(this).attr("data-kdapip");
		var cid 		= $(this).attr("data-cid");
        var ctriw       = $(this).attr("data-triw"); 
		
						
	   $('#ModalEditProfil5').modal('show');	

			$.ajax({           
			 url: '<?php echo base_url('kapip-dataumum-profil-apip/edit-profil5'); ?>/'+ctahun+'/'+ckode+'/'+ctriw+'/'+cid,
           // type: "POST",
            //dataType: "json",
			method: 'POST',
            success: function(data) {
				
					$('#data-eprofil-5').html(data);
				//	$('#ModalEditProfil1').modal('show');
      
				
			
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
			
        });
		 
		
	
	});


 $(document).on("click", ".showEditRincianP6", function() {		  
		var ctahun 		= $(this).attr("data-tahun");
        var ckode 		= $(this).attr("data-kdapip");
		var cid 		= $(this).attr("data-cid");
        var ctriw       = $(this).attr("data-triw"); 
		
						
	   $('#ModalEditProfil6').modal('show');	

			$.ajax({           
			 url: '<?php echo base_url('kapip-dataumum-profil-apip/edit-profil6'); ?>/'+ctahun+'/'+ckode+'/'+ctriw+'/'+cid,
           // type: "POST",
            //dataType: "json",
			method: 'POST',
            success: function(data) {
				
					$('#data-eprofil-6').html(data);
				//	$('#ModalEditProfil1').modal('show');
      
				
			
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
				





$(document).on("click", ".simpan-profil2", function(e) {

	var data = $('#form-profil2').serialize();
	var ctriw = $('#triw').val();
	var ctahun = $('#ptahun').val();
	var cinstansi = $('#pkdinstansi').val();
	
		
		document.getElementById('info').innerHTML = "";

        var myTab = document.getElementById('data-profil-2');

        
			var cdata='';
			var table = document.getElementById('data-profil-2');
			
			var cid = '';
			var cnilai = '';
		
			for (var r = 0, n = table.rows.length; r < n; r++) {
				  
				  
				var cid = cid+'#'+table.rows[r].cells[0].innerHTML;
				var cnilai = cnilai+'#'+table.rows[r].cells[4].innerHTML;

			
			}	
			
			
			/* alert(cid);
			alert(cnilai);
			return;
		
		 */
		
		

		
			$.ajax({
					type: 'POST',
					data: ({ctahun,cinstansi,cid,ctriw,cnilai}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-dataumum-profil-apip/simpan-profil2",
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
				
		
		load_profil2(); //cekdd
		
	});	
		


$(document).on("click", ".simpan-profil5", function(e) {

	var data = $('#form-profil5').serialize();
	var ctriw = $('#triw').val();
	var ctahun = $('#ptahun').val();
	var cinstansi = $('#pkdinstansi').val();
	
		
		document.getElementById('info').innerHTML = "";

        var myTab = document.getElementById('data-profil-5');

        
			var cdata='';
			var table = document.getElementById('data-profil-5');
			
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
					url: "<?php echo base_url(); ?>kapip-dataumum-profil-apip/simpan-profil5",
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
				
		
		load_profil5(); //cekdd
		
	});	
		


$(document).on("click", ".simpan-profil6", function(e) {

	var data = $('#form-profil6').serialize();
	var ctriw = $('#triw').val();
	var ctahun = $('#ptahun').val();
	var cinstansi = $('#pkdinstansi').val();
	
			var cdata='';
			var table = document.getElementById('data-profil-6');
			
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
					url: "<?php echo base_url(); ?>kapip-dataumum-profil-apip/simpan-profil6",
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
				
		
		load_profil6(); //cekdd
		
	});	


$(document).on("click", ".simpan-profil6b", function(e) {

	var data = $('#form-profil6').serialize();
	var ctriw = $('#triw').val();
	var ctahun = $('#ptahun').val();
	var cinstansi = $('#pkdinstansi').val();
	
		
		document.getElementById('info').innerHTML = "";
 
			var cdata='';
			var table = document.getElementById('data-profil-6');
			
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
					url: "<?php echo base_url(); ?>kapip-dataumum-profil-apip/simpan-profil6",
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
				
		
		load_profil6(); //cekdd
		
	});	
	
	

$(document).on("click", ".simpan-eprofil1", function(e) {

	var data = $('#form-edit-p1').serialize();
	var ctriw = $('#triw').val();
	var ctahun = $('#ptahun').val();
	var cinstansi = $('#pkdinstansi').val();
	
			var cdata='';
			var table = document.getElementById('data-eprofil-1');
			
			var cid = '';
			var cnilai = '';
		
			for (var r = 0, n = table.rows.length; r < n; r++) {
				  
				var cid = cid+'#'+table.rows[r].cells[0].innerHTML;				
				var cnilai = cnilai+'#'+table.rows[r].cells[3].innerHTML; 
				
			}	
		
		
			$.ajax({
					type: 'POST',
					data: ({ctahun,cinstansi,cid,ctriw,cnilai}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-dataumum-profil-apip/simpan-profil1",
					success: function(data) {
					   var status = data; 
					   var pesan = "Berhasil Disimpan";
					   
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: pesan,
							showConfirmButton: false,
							timer: 2000
						});
					 
					 load_profil2();
					 
					}
			});
				
		
		
		
	});	


$(document).on("click", ".simpan-eprofil2", function(e) {

	var data = $('#form-edit-p2').serialize();
	var ctriw = $('#triw').val();
	var ctahun = $('#ptahun').val();
	var cinstansi = $('#pkdinstansi').val();
	
			var cdata='';
			var table = document.getElementById('data-eprofil-2');
			
			var cid = '';
			var cnilai = '';
		
			for (var r = 0, n = table.rows.length; r < n; r++) {
				  
				var cid = cid+'#'+table.rows[r].cells[0].innerHTML;				
				var cnilai = cnilai+'#'+table.rows[r].cells[3].innerHTML; 
				
			}	
		
		
		
			$.ajax({
					type: 'POST',
					data: ({ctahun,cinstansi,cid,ctriw,cnilai}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-dataumum-profil-apip/simpan-profil2",
					success: function(data) {
					   var status = data; 
					   var pesan = "Berhasil Disimpan";
					   
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: pesan,
							showConfirmButton: false,
							timer: 2000
						});
					 
					 load_profil2();
					 
					}
			});
				
		
		
		
	});	


$(document).on("click", ".simpan-eprofil5", function(e) {

	var data = $('#form-edit-p5').serialize();
	var ctriw = $('#triw').val();
	var ctahun = $('#ptahun').val();
	var cinstansi = $('#pkdinstansi').val();
	
			var cdata='';
			var table = document.getElementById('data-eprofil-5');
			
			var cid = '';
			var cnilai = '';
		
			for (var r = 0, n = table.rows.length; r < n; r++) {
				  
				var cid = cid+'#'+table.rows[r].cells[0].innerHTML;				
				var cnilai = cnilai+'#'+table.rows[r].cells[3].innerHTML; 
				
			}	
		
		
		
			$.ajax({
					type: 'POST',
					data: ({ctahun,cinstansi,cid,ctriw,cnilai}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-dataumum-profil-apip/simpan-profil5",
					success: function(data) {
					   var status = data; 
					   var pesan = "Berhasil Disimpan";
					   
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: pesan,
							showConfirmButton: false,
							timer: 2000
						});
					 
					 load_profil5();
					 
					}
			});
				
		
		
		
	});	


$(document).on("click", ".simpan-eprofil6", function(e) {

	var data = $('#form-edit-p6').serialize();
	var ctriw = $('#triw').val();
	var ctahun = $('#ptahun').val();
	var cinstansi = $('#pkdinstansi').val();
	
			var cdata='';
			var table = document.getElementById('data-eprofil-6');
			
			var cid = '';
			var cnilai = '';
		
			for (var r = 0, n = table.rows.length; r < n; r++) {
				  
				var cid = cid+'#'+table.rows[r].cells[0].innerHTML;				
				var cnilai = cnilai+'#'+table.rows[r].cells[3].innerHTML; 
				
			}	
		
		
		
			$.ajax({
					type: 'POST',
					data: ({ctahun,cinstansi,cid,ctriw,cnilai}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-dataumum-profil-apip/simpan-profil6",
					success: function(data) {
					   var status = data; 
					   var pesan = "Berhasil Disimpan";
					   
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: pesan,
							showConfirmButton: false,
							timer: 2000
						});
					 
					 load_profil6();
					 
					}
			});
				
		
		
		
	});	




	function hitungP1($cnilai,$index){
		var myTable = document.getElementById("data-profil-1");

			content=$cnilai;
		var rn=$index;
		var cn=4;

			var x=document.getElementById('data-profil-1').rows[parseInt(rn,10)].cells;
			x[parseInt(cn,10)].innerHTML=content;
		
	}


	function ehitungP1($cnilai,$index){

		var myTable = document.getElementById("data-eprofil-1");

		content=$cnilai;

		//var row = document.getElementById("myRow");

		var rn=$index;
		var cn=3;

		var x=document.getElementById('data-eprofil-1').rows[parseInt(rn,10)].cells;
		x[parseInt(cn,10)].innerHTML=content;

	}


	function hitungP2($cnilai,$index){
		var myTable = document.getElementById("data-profil-2");

			content=$cnilai;
		var rn=$index;
		var cn=4;
		
		

			var x=document.getElementById('data-profil-2').rows[parseInt(rn,10)].cells;
			x[parseInt(cn,10)].innerHTML=content;
		
			
			/* var x=document.getElementById('data-profil-2').rows[parseInt((rn-1),10)].cells;
			x[parseInt(c,10)].innerHTML=content; */
		
	}


	function ehitungP2($cnilai,$index){
		var myTable = document.getElementById("data-eprofil-2");		
			content=$cnilai;
		var rn=$index;
		var cn=3;

			var x=document.getElementById('data-eprofil-2').rows[parseInt(rn,10)].cells;
			x[parseInt(cn,10)].innerHTML=content;
		
	}


	function hitungP5($cnilai,$index){
		var myTable = document.getElementById("data-profil-5");

			content=$cnilai;
		var rn=$index;
		var cn=4;

			var x=document.getElementById('data-profil-5').rows[parseInt(rn,10)].cells;
			x[parseInt(cn,10)].innerHTML=content;
				
	}

	function ehitungP5($cnilai,$index){
		var myTable = document.getElementById("data-eprofil-5");		
			content=$cnilai;
		var rn=$index;
		var cn=3;

			var x=document.getElementById('data-eprofil-5').rows[parseInt(rn,10)].cells;
			x[parseInt(cn,10)].innerHTML=content;
		
	}
	
	
	function hitungP6($cnilai,$index){
		var myTable = document.getElementById("data-profil-6");

			content=$cnilai;
		var rn=$index;
		var cn=4;

			var x=document.getElementById('data-profil-6').rows[parseInt(rn,10)].cells;
			x[parseInt(cn,10)].innerHTML=content;
				
	}


	function ehitungP6($cnilai,$index){
		var myTable = document.getElementById("data-eprofil-6");		
			content=$cnilai;
		var rn=$index;
		var cn=3;

			var x=document.getElementById('data-eprofil-6').rows[parseInt(rn,10)].cells;
			x[parseInt(cn,10)].innerHTML=content;
		
	}
	
	

/* function hideAll() {
     hideRow('2');
	 hideRow('3');
     hideRow('4');
     hideRow('5');
     hideRow('6');
	 hideRow('7');
	 
	 
   } */

 function hideRow(id) {
      var row = document.getElementById(id);
      row.style.display = 'none';
    }
	


	function toggleOption(thisselect) {

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
			var selected = i; 			
			toggleRow(selected);			
		  }	 
	}	


	function toggleP2_1() {			
		for (i = 3; i < 10; i++) {
			var selected = i; //thisselect.options[thisselect.selectedIndex].value;			
			toggleRow(selected);			
		  }	 
	}	



	function toggleP2_2() {			  
		for (i = 11; i < 14; i++) {
			var selected = i; 			
			toggleRow(selected);			
		  }	 
	}	

	function toggleP2_3() {			  
		for (i = 14; i < 19; i++) {
			var selected = i; 			
			toggleRow(selected);			
		  }	 
	}
	

	function toggleP2_4() {			  
		for (i = 19; i < 24; i++) {
			var selected = i; 			
			toggleRow(selected);			
		  }	 
	}

	function toggleP2_5() {			  
		for (i = 24; i < 29; i++) {
			var selected = i; 			
			toggleRow(selected);			
		  }	 
	}


	function toggleP2_6() {			  
		for (i = 30; i < 37; i++) {
			var selected = i; 			
			toggleRow(selected);			
		  }	 
	}




	function toggleOptionP2(thisselect) {
	
		for (i = 3; i < 10; i++) {
			var selected = i; //thisselect.options[thisselect.selectedIndex].value;			
			toggleRow(selected);			
		  }	 

		  
		for (i = 11; i < 14; i++) {
			var selected = i; 			
			toggleRow(selected);			
		  }	 
		  
		for (i = 14; i < 19; i++) {
			var selected = i; 			
			toggleRow(selected);			
		  }	 

		  
		for (i = 19; i < 24; i++) {
			var selected = i; 			
			toggleRow(selected);			
		  }	 
			  
		for (i = 24; i < 29; i++) {
			var selected = i; 			
			toggleRow(selected);			
		  }	 
		  
		for (i = 30; i < 37; i++) {
			var selected = i; 			
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
	

	function load_profil2(){
		
			var ckode= '<?=$kode ?>';
				var ctahun= '<?= $tahun ?>';
				
				var triw = (document.getElementById('triw').value); 
					$.ajax({  
					  url: '<?php echo base_url('kapip-dataumum-profil-apip/get-profil2'); ?>/'+ctahun+'/'+ckode+'/'+triw,
					  type: 'POST',
					  success: function(data){
						$("#data-profil-2").html(data);
					  }
					});
	}	


	function load_profil5(){
		
			var ckode= '<?=$kode ?>';
				var ctahun= '<?= $tahun ?>';
				
				var triw = (document.getElementById('triw').value); 
					$.ajax({  
					  url: '<?php echo base_url('kapip-dataumum-profil-apip/get-profil5'); ?>/'+ctahun+'/'+ckode+'/'+triw,
					  type: 'POST',
					  success: function(data){
						$("#data-profil-5").html(data);
					  }
					});
	}	


	function load_profil6(){
		
			var ckode= '<?=$kode ?>';
				var ctahun= '<?= $tahun ?>';
				
				var triw = (document.getElementById('triw').value); 
					$.ajax({  
					  url: '<?php echo base_url('kapip-dataumum-profil-apip/get-profil6'); ?>/'+ctahun+'/'+ckode+'/'+triw,
					  type: 'POST',
					  success: function(data){
						$("#data-profil-6").html(data);
					  }
					});
	}	


/* $(document).on("click", ".hapusTemuan", function() {

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

}); */




/* function deleteRow(btn) {
	var row = btn.parentNode.parentNode;
	row.parentNode.removeChild(row);
}
 */


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
	 


	$(document).on("click", "#btnp23", function(e) { 
		toggleP2_1();
	});	 
	
	$(document).on("click", "#btnp211", function(e) { toggleP2_2(); });	
	$(document).on("click", "#btnp214", function(e) { toggleP2_3(); });		
	$(document).on("click", "#btnp219", function(e) { toggleP2_4(); });		 
	$(document).on("click", "#btnp224", function(e) { toggleP2_5(); });		 
	$(document).on("click", "#btnp230", function(e) { toggleP2_6(); });	

</script>    

