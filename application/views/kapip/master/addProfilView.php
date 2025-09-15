

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




.switch {
  position: relative;
  display: inline-block;
  width: 90px;
  height: 30px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ca2222;
  -webkit-transition: .4s;
  transition: .4s;
  border-radius: 6px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 28px;
  width: 32px;
  top: 1px;
  left: 1px;
  right: 1px;
  bottom: 1px;
  background-color: white;
  transition: 0.4s;
  border-radius: 6px;

}

input:checked + .slider {
  background-color: #2ab934;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(55px);
}

.slider:after {
  content:'......Tidak';
  color: white;
  display: block;
  position: absolute;
  transform: translate(-50%,-50%);
  top: 50%;
  left: 42%;
  font-size: 10px;
  font-family: Verdana, sans-serif;
}
input:checked + .slider:after {
  content:'Ya';
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

<?php 
  $is_admin = $this->session->userdata('is_admin');
  if ($is_admin == 1) {
    $hidden = '';
  }else if ($is_admin == 2) {
    $hidden = '';
  }else if ($is_admin == 3) {
    $hidden = 'hidden';
  }
 ?>	

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



<div class="swiffy-slider">
    <ul class="slider-container">
        <li>


			<div class="panel panel-headline  panel-primary">

				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<form class="form-horizontal" id="form-profil1">
								<button name="btnp1" type="button" class="collapsible-form active-form">
								
										<div class="row">
												
											<div class="form-group"> 
												<div class="col-md-12">
												
												
													<div class="col-md-11"> 
															<h3 class="panel-title"><i class="fa fa-list-alt" style="padding-left: 10px"></i> Profil Anggaran Realisasi</h3>
									
													</div>
										
													<div class="col-md-1"> 
															<h3 class="panel-title"><i class="fa fa-chevron-right" aria-hidden="true" style="padding-left: 67px"></i></h3>
													</div>
										
													
												</div>

											</div>
											<div class="form-group">
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
																		<table id="angreal-table" class="table table-bordered table-striped" style="width:100%;" border="0">
																			<thead>
																				<tr>
																					<th style="text-align:center;" hidden></th>
																					<th style="text-align:center; ">
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

			</li>
			<!-- 2 -->

			<li>
			<div class="panel panel-headline  panel-primary">

				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<form class="form-horizontal" id="form-profil2">
							<button type="button" class="collapsible-form active-form">

									<div class="row">
										
										
												
											<div class="form-group"> 
												<div class="col-md-12">
												
												
													<div class="col-md-11"> 
															<h3 class="panel-title"><i class="fa fa-chevron-left fa-10x" style="padding-left: 5px" aria-hidden="true"></i>  <i class="fa fa-list-alt" style="padding-left: 10px"></i> Profil Kegiatan Operasional Pengawasan APIP Dan Realisasi</h3>
									
													</div>
										
													<div class="col-md-1"> 
															<h3 class="panel-title"><i class="fa fa-chevron-right" aria-hidden="true" style="padding-left: 50px"></i></h3>
													</div>
										
													
												</div>

											</div>
											<div class="form-group">
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


			</li>

 

<!-- 4 -->

<li>
  
<div class="panel panel-headline  panel-primary">

	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form class="form-horizontal" id="form-profi4">
				<button type="button" class="collapsible-form active-form">

				  	<div class="row">
						<div class="row">
						
								
							<div class="form-group"> 
								<div class="col-md-12">
								
								
									<div class="col-md-11"> 
											<h3 class="panel-title"><i class="fa fa-chevron-left fa-10x" style="padding-left: 5px" aria-hidden="true"></i>  <i class="fa fa-list-alt" style="padding-left: 10px"></i> Profil Tren Perbaikan Governancexx</h3>
					
									</div>
						
									<div class="col-md-1"> 
											<h3 class="panel-title"><i class="fa fa-chevron-right" aria-hidden="true" style="padding-left: 40px"></i></h3>
									</div>
						
									
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
						
							<div class="panel panel-headline panel-primary" style="min-height:550px;">

								<div class="panel-body">
									<div class="row">
								  <div class="col-md-12" >
											<div class="pull-right">												
												<a href="#" class="btn btn-primary btn-lg tambah-header-profil4" > <i class="fa fa-plus" ></i> Tambah</a>

											</div>
								  </div>
								</div>
								<div class="row">
								  <div class="col-md-12">
									
										<!--	<table id="sertifikasi-table" class="table table-bordered table-striped table-condensed" style="width:100%" > -->
									
									<div class="product-status mg-b-15">
										<div class="container-fluid">
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<div class="product-status-wrap">
														
														<div class="asset-inner"><br>
														
														
												 <table id="it-table" class="table table-bordered table-striped" style="width:100%" border="0">
		
																<thead>
																		<tr class="rowBlue">
																		  <th  width="5%"   class="text-bold text-center" hidden >jenis</th>
																		  <th  width="5%"  class="text-bold text-center" hidden >nilai</th>
																		  <th  width="5%"  class="text-bold text-center" hidden >kd1</th>
																		  <th  width="5%"  class="text-bold text-center"  hidden >kd2</th>
																		  <th  width="5%"  class="text-bold text-center"  ></th>
																		  <th  width="2%"  class="text-bold text-center" hidden>clevel</th>
																		   <th  width="2%"  class="text-bold text-center" hidden>tahun</th>
																		  <th  width="40%" class="text-bold text-center">PROFIL</th>
																		  <th  width="45%" class="text-bold text-center">INFORMASI</th>
																		  <th  width="10%" class="text-bold text-center">AKSI</th>
																		</tr>
																		
				
																		
																</thead>
																		<tbody id="data-profil-4">
																			
																		</tbody>
																		
															</table>   
															
														<!--	<div id="data-profil-4"></div>  -->
																
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
						
	

						</div>
					</div>
					
					
					<div class="panel-footer">
						<center>
							<a href="<?= base_url($this->dynamic_menu->EncryptLink('kapip-dataumum-profil-apip'));?>" class="btn btn-danger btn-lg"><i class="fa fa-arrow-circle-left"></i> KEMBALI</a>
							<button type="button" data-aksi="simpan" class="btn btn-success btn-lg simpan-profil4"><i class="fa fa-check-square"></i> SIMPAN</button>
							<button type="button"  data-aksi="new" class="btn btn-primary btn-lg confirm hidden"><i class="fa fa-plus"></i> confirm</button>
						</center>
						</form>
					</div>					

				</div>

			</div>
		</div>

	</div>
</div>	

</li>


<!-- 5 -->

<li>
	<div class="panel panel-headline  panel-primary">

	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form class="form-horizontal" id="form-profil">
				<button type="button" class="collapsible-form active-form">


				  	<div class="row">
						<div class="row">
						
								
							<div class="form-group"> 
								<div class="col-md-12">
								
								
									<div class="col-md-11"> 
											<h3 class="panel-title"><i class="fa fa-chevron-left fa-10x" style="padding-left: 5px" aria-hidden="true"></i>  <i class="fa fa-list-alt" style="padding-left: 15px"></i> Profil Struktur Komposisi SDM</h3>
					
									</div>
						
									<div class="col-md-1"> 
											<h3 class="panel-title"><i class="fa fa-chevron-right" aria-hidden="true" style="padding-left: 30px"></i></h3>
									</div>
						
									
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

</li>



<!-- 6 -->

<li>
<div class="panel panel-headline  panel-primary">

	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form class="form-horizontal" id="form-profil6">
				<button type="button" class="collapsible-form active-form">


				  	<div class="row">
						
	
							<div class="form-group"> 
							<div class="col-md-12">
							
							
								<div class="col-md-11"> 
										<h3 class="panel-title"><i class="fa fa-chevron-left fa-10x" style="padding-left: 1px" aria-hidden="true"></i>  <i class="fa fa-list-alt" style="padding-left: 10px"></i> Profil Sertifikasi Profesional SDM</h3>
				
								</div>
					
								<div class="col-md-1"> 
										<h3 class="panel-title"><i class="fa fa-chevron-right" aria-hidden="true" style="padding-left: 57px"></i></h3>
								</div>
					
								
							</div>

							</div>	
						
							<div class="form-group">

								
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



</li>



<!-- 6 -->

<li>
<div class="panel panel-headline  panel-primary">

	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form class="form-horizontal" id="form-profil">
				<button type="button" class="collapsible-form active-form">


				  	<div class="row">
						
							
						<div class="form-group"> 
							<div class="col-md-12">
							
							
								<div class="col-md-11"> 
										<h3 class="panel-title"><i class="fa fa-chevron-left fa-10x" style="padding-left: 1px" aria-hidden="true"></i>  <i class="fa fa-list-alt" style="padding-left: 10px"></i> Profil IT</h3>
				
								</div>
					
								<div class="col-md-1"> 
										
								</div>
					
								
							</div>

						</div>
							
								
						
						<div class="form-group">

							
						</div>

						
					</div>
			
				
				</button>
				<div class="content-form" style="display:block;">
				  	<div class="row">
						<div class="col-md-12">
						
	
													
							<div class="panel panel-headline panel-primary" style="min-height:550px;">

								<div class="panel-body">
									<div class="row">
								  <div class="col-md-12 <?=$hidden; ?>">
											<div class="pull-right">												
												<a href="#" class="btn btn-primary btn-lg tambah-header-profil7" > <i class="fa fa-plus" ></i> Tambah</a>

											</div>
								  </div>
								</div>
								<div class="row">
								  <div class="col-md-12">
									
										<!--	<table id="sertifikasi-table" class="table table-bordered table-striped table-condensed" style="width:100%" > -->
									
									<div class="product-status mg-b-15">
										<div class="container-fluid">
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<div class="product-status-wrap">
														
														<div class="asset-inner"><br>
															<table id="it-table" class="table table-bordered table-striped" style="width:100%" border="0">
		
																<thead>
																		<tr class="rowBlue">
																		  <th  width="5%"  hidden class="text-bold text-center">jenis</th>
																		  <th  width="5%" hidden class="text-bold text-center">nilai</th>
																		  <th  width="5%" hidden class="text-bold text-center">NO</th>
																		  <th  width="2%"  class="text-bold text-center"></th>
																		  <th  width="60%" class="text-bold text-center">PROFIL</th>
																		  <th  width="25%" class="text-bold text-center">INFORMASI</th>
																		  <th  width="10%" class="text-bold text-center">AKSI</th>
																		</tr>
																		
																</thead>
																		<tbody id="data-profil-7">
																			
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
												

				</div>
			</div>
					
					
					<div class="panel-footer">
						<center>
							<a href="<?= base_url($this->dynamic_menu->EncryptLink('kapip-dataumum-profil-apip'));?>" class="btn btn-danger btn-lg"><i class="fa fa-arrow-circle-left"></i> KEMBALI</a>
					
						</center>
						</form>
					</div>					

				</div>

			</div>
		</div>

	</div>
</div>	


</li>


</ul>





	<button type="button" data-toggle="tooltip" data-placement="top" title="Profil Sebelumnya"  class="slider-nav"></button>
    <button type="button" data-toggle="tooltip" data-placement="top" title="Profil Selanjutnya" class="slider-nav slider-nav-next"></button>

    <div class="slider-indicators">
        <button class="active"></button>
        <button></button>
        <button></button>
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
			<!--
				<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
				<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
				-->
	
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
							<a href="<?= base_url($this->dynamic_menu->EncryptLink('kapip-dataumum-profil-apip'));?>" class="btn btn-danger btn-lg"><i class="fa fa-times-circle" aria-hidden="true"></i> TUTUP</a>
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
						
						<button type="button"  class="btn-danger btn-sm" data-dismiss="modal"> <i class="fa fa-times-circle" aria-hidden="true"></i> TUTUP</button>
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









<div class="modal fade" id="ModalEditProfil7"  role="dialog" aria-labelledby="EmyModalLabelP7">
  <div class="modal-dialog  " role="document">
    <div class="modal-content">
		  <div class="modal-header">
		  
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="EmyModalLabelP1">FORM INPUT NILAI</h4>
		  </div>
		 
		 <div class="modal-body" id="ElistDetail">


				<div id="data-eprofil-7" ></div>
			
		  </div>
	  
	  
    </div>
  </div>
</div>



<div class="modal fade" id="ModalEditHProfil4"  role="dialog" aria-labelledby="EmyModalLabelP4">
  <div class="modal-dialog  " role="document">
    <div class="modal-content">
		  <div class="modal-header">
		  
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="EmyModalLabelP1">FORM INPUT NILAI</h4>
		  </div>
		 
		 <div class="modal-body" id="ElistDetail">


				<div id="data-ehprofil-4" ></div>
			
		  </div>
	  
	  
    </div>
  </div>
</div>



<div class="modal fade" id="ModalTambahHProfil7"  role="dialog" aria-labelledby="EmyModalLabelHP7">
  <div class="modal-dialog  " role="document">
    <div class="modal-content">
		  <div class="modal-header">
		  
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="EmyModalLabelHP7">FORM INPUT DATA</h4>
		  </div>
		 
		 <div class="modal-body" id="ElistDetailHp7">


				<div id="data-hprofil7" ></div>
			
		  </div>
	  
	  
    </div>
  </div>
</div>



<div class="modal fade" id="ModalTambahHProfil4"  role="dialog" aria-labelledby="EmyModalLabelHP4">
  <div class="modal-dialog  " role="document">
    <div class="modal-content">
		  <div class="modal-header">
		  
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="EmyModalLabelHP4">FORM INPUT DATA</h4>
		  </div>
		 
		 <div class="modal-body" id="ElistDetailHp4">


				<div id="data-hprofil4" ></div>
			
		  </div>
	  
	  
    </div>
  </div>
</div>

<div class="modal fade" id="ModalTambahDProfil7"  role="dialog" aria-labelledby="EmyModalLabelDP7">
  <div class="modal-dialog  " role="document">
    <div class="modal-content">
		  <div class="modal-header">
		  
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="EmyModalLabelDP7">FORM INPUT DATA</h4>
		  </div>
		 
		 <div class="modal-body" id="ElistDetailDp7">


				<div id="data-dprofil7" ></div>
			
		  </div>
	  
	  
    </div>
  </div>
</div>


<div class="modal fade" id="ModalEditProfil2"  role="dialog" aria-labelledby="EmyModalLabelP2">
  <div class="modal-dialog  " role="document">
    <div class="modal-content">
      <div class="modal-header">
	  
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="EmyModalLabelP2">FORM INPUT NILAI</h4>
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
						
						<button type="button"  class="btn-danger btn-sm" data-dismiss="modal"> <i class="fa fa-times-circle" aria-hidden="true"></i> TUTUP</button>
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
							
							<button type="button"  class="btn-danger btn-sm" data-dismiss="modal"> <i class="fa fa-times-circle" aria-hidden="true"></i> TUTUP</button>
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
							
							<button type="button"  class="btn-danger btn-sm" data-dismiss="modal"> <i class="fa fa-times-circle" aria-hidden="true"></i> TUTUP</button>
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


	<script src="https://cdn.jsdelivr.net/npm/swiffy-slider@1.5.3/dist/js/swiffy-slider.min.js" crossorigin="anonymous" defer></script>
	<link href="https://cdn.jsdelivr.net/npm/swiffy-slider@1.5.3/dist/css/swiffy-slider.min.css" rel="stylesheet" crossorigin="anonymous">

<!--
	<script src="<?= base_url() ?>assets/js/swiffy-slider.min.js" crossorigin="anonymous" defer></script>
	<script src="<?= base_url() ?>assets/ src="<?= base_url() ?>assets/css/swiffy-slider.min.css" rel="stylesheet" crossorigin="anonymous"></script>
-->

<style>

.slider-nav::after {
    content: "";
    mask: url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 0 0'><path fill-rule='evenodd' d='M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z'></path></svg>");
    mask-size: cover;
    background-color: #183540; var(--swiffy-slider-nav-light);
    background-origin: content-box;
	
    width: 5rem;
    height: 3rem;
}

</style>

	
	<script type="text/javascript">
	
	
 $(window).on('load', function () {
	$('#ModalEditProfil1').modal('hide');
	$('#ModalEditProfil2').modal('hide');
	$('#ModalEditProfil5').modal('hide');
	$('#ModalEditProfil6').modal('hide');
	$('#ModalEditProfil7').modal('hide');
	
    });	
	
	
	
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
		
		
		
		
//	let button = document.querySelector("#btnp1").click();
		
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


			$.ajax({  
				  url: '<?php echo base_url('kapip-dataumum-profil-apip/get-profil7'); ?>/'+ctahun+'/'+ckode+'/'+triw,
				  type: 'POST',
				  success: function(data){
					$("#data-profil-7").html(data);
				   
				  }
				});		


			$.ajax({  
				  url: '<?php echo base_url('kapip-dataumum-profil-apip/get-profil4'); ?>/'+ctahun+'/'+ckode,
				  type: 'POST',
				  success: function(data){
					$("#data-profil-4").html(data);
					
					
					
							var table = document.getElementById('data-profil-4');
							for (var r = 0, n = table.rows.length; r < n; r++) {
								  
								var cjenis = table.rows[r].cells[0].innerHTML;
								var cnilai = table.rows[r].cells[1].innerHTML;
								var ctahun_trx = table.rows[r].cells[6].innerHTML;
							//	var cnilai = cnilai+'#'+table.rows[r].cells[4].innerHTML;
							
							if(cjenis==4){
								/* 
								$cnm1="$('#jnsf4_";
								$cnm2=ctahun_trx;
								$cnm3="')";
								
								$cnama=$cnm1+$cnm2+$cnm3; */
	

								if(ctahun_trx=='2019'){
									$('#jnsf4_2019').val(cnilai);
									$('#jnsf4_2019').select2().trigger('change'); 
						
								}else if(ctahun_trx=='2020'){
									$('#jnsf4_2020').val(cnilai);
									$('#jnsf4_2020').select2().trigger('change');
									
								}else if(ctahun_trx=='2021'){
									
									$('#jnsf4_2021').val(cnilai);
									$('#jnsf4_2021').select2().trigger('change');
								}else if(ctahun_trx=='2022'){
									
									$('#jnsf4_2022').val(cnilai);
									$('#jnsf4_2022').select2().trigger('change');
								}else if(ctahun_trx=='2023'){
									
									$('#jnsf4_2023').val(cnilai);
									$('#jnsf4_2023').select2().trigger('change');
								}else if(ctahun_trx=='2024'){
									
									$('#jnsf4_2024').val(cnilai);
									$('#jnsf4_2024').select2().trigger('change');
								}else if(ctahun_trx=='2025'){
									
									$('#jnsf4_2025').val(cnilai);
									$('#jnsf4_2025').select2().trigger('change');
								}else if(ctahun_trx=='2026'){
									
									$('#jnsf4_2026').val(cnilai);
									$('#jnsf4_2026').select2().trigger('change');
								}else if(ctahun_trx=='2027'){
									
									$('#jnsf4_2027').val(cnilai);
									$('#jnsf4_2027').select2().trigger('change');
								}else if(ctahun_trx=='2028'){
									
									$('#jnsf4_2028').val(cnilai);
									$('#jnsf4_2028').select2().trigger('change');
								}else if(ctahun_trx=='2029'){
									
									$('#jnsf4_2029').val(cnilai);
									$('#jnsf4_2029').select2().trigger('change');
								}else if(ctahun_trx=='2030'){
									
									$('#jnsf4_2030').val(cnilai);
									$('#jnsf4_2030').select2().trigger('change');
								}
								
								
								
							}
							
							
						}	
					
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
		var curaian     = $(this).attr("data-uraian"); 

			$.ajax({           
			 url: '<?php echo base_url('kapip-dataumum-profil-apip/edit-profil2'); ?>/'+ctahun+'/'+ckode+'/'+ctriw+'/'+cid,
            //type: "POST",
            //dataType: "json",
			method: 'POST',
            success: function(data) {
				
					$('#data-eprofil-2').html(data);
					$('#ModalEditProfil2').modal('show');	
      
				
			
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





   $(document).on("click", "#tambah_rinci7", function(e) {  
		document.getElementById("cnmapl").focus();
		

		$('#hkd3rinci').val('');
		$('#cnmapl').val('');
            
			e.preventDefault();
		  });



	$(document).on("click", ".edit-rinci-profil7", function() {	
		var ctahun 		= $(this).attr("data-tahun");
        var ckode 		= $(this).attr("data-kdapip");
        var ctriw       = $(this).attr("data-triw"); 
		var ckd1        = $(this).attr("data-kd1"); 
		var ckd2        = $(this).attr("data-kd2"); 
		var ckd3        = $(this).attr("data-kd3"); 
		var curaian     = $(this).attr("data-uraian"); 
		
		
		$('#hkd1rinci').val(ckd1);
		$('#hkd2rinci').val(ckd2);
		$('#hkd3rinci').val(ckd3);
		$('#cnmapl').val(curaian);
		

	
	});




$(document).on("click", ".hapus-rinci-p7", function() {	
		
		var ctriw 		= $('#triw').val();
		var ctahun 		= $('#ptahun').val();
		var cinstansi 	= $('#pkdinstansi').val();
		var ckd1        = $(this).attr("data-kd1"); 
		var ckd2        = $(this).attr("data-kd2"); 
		var ckd3        = $(this).attr("data-kd3"); 
		var curaian     = $(this).attr("data-uraian"); 

       Swal.fire({
              title: 'Apakah anda yakin?',
              text: "Menghapus  "+curaian+"..?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#074979',
              cancelButtonColor: '#d33',
              cancelButtonText: 'Batal',
              confirmButtonText: 'Ya, Hapus Data.'
            }).then((result) => {
              if (result.value) { 

                  $.ajax({
                  method: 'POST',
                  url: '<?php echo base_url('kapip-dataumum-profil-apip/hapus-rinci-p7'); ?>?ctahun='+ctahun+'&ctriw='+ctriw+'&cinstansi='+cinstansi+'&ckd1='+ckd1+'&ckd2='+ckd2+'&ckd3='+ckd3,
                })
                .done(function(data) {
                    var out = jQuery.parseJSON(data);

					if(out==0){
					
						var pesan = "Gagal Hapus Data!";
						Swal.fire({
						  title: 'GAGAL HAPUS',	
						  position: 'top-end',
						  icon: 'warning',
						  text: pesan,
						  showConfirmButton: false,
						  timer: 2000
						});
						 // window.location.reload();
						 // e.preventDefault(); 
						
					}else{
						
						var pesan = "Data Berhasil Di Hapus!";
						Swal.fire({
						  position: 'top-end',
						  icon: 'success',
						  title: pesan,
						  showConfirmButton: false,
						  timer: 2000
						});
						 
						 // e.preventDefault();						  
						 // window.location.reload();						  
						
						
					}
					
				})
				
				
				
				
						$.ajax({  
							  url: '<?php echo base_url('kapip-dataumum-profil-apip/get-profil7'); ?>/'+ctahun+'/'+cinstansi+'/'+ctriw,
							  type: 'POST',
							  success: function(data){
								$("#data-profil-7").html(data);
								
									$.ajax({  
										  url: '<?php echo base_url('kapip-dataumum-profil-apip/list-profil7'); ?>/'+ctahun+'/'+cinstansi+'/'+ctriw+'/'+ckd1+'/'+ckd2+'/'+0,
										  type: 'POST',
										  success: function(data){
											$("#rincian-informasip7").html(data);
											
											document.getElementById("cnmapl").focus();
											$('#hkd3rinci').val('');
											$('#cnmapl').val('');
											
										  }
									});		
								
							  }
							});	
							
				e.preventDefault();
              }
            })

		

	
	});


$(document).on("click", ".hapus-hprofil7", function() {	
		
		var ctriw 		= $('#triw').val();
		var ctahun 		= $('#ptahun').val();
		var cinstansi 	= $('#pkdinstansi').val();
		var ckd1        = $(this).attr("data-kd1"); 
		var ckd2        = $(this).attr("data-kd2"); 
		var curaian     = $(this).attr("data-uraian"); 

       Swal.fire({
              title: 'Apakah anda yakin?',
              text: "Menghapus  "+curaian+"..?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#074979',
              cancelButtonColor: '#d33',
              cancelButtonText: 'Batal',
              confirmButtonText: 'Ya, Hapus Data.'
            }).then((result) => {
              if (result.value) { 

                  $.ajax({
                  method: 'POST',
                  url: '<?php echo base_url('kapip-dataumum-profil-apip/hapus-hprofil7'); ?>?ctahun='+ctahun+'&ctriw='+ctriw+'&cinstansi='+cinstansi+'&ckd1='+ckd1+'&ckd2='+ckd2,
                })
                .done(function(data) {
                    var out = jQuery.parseJSON(data);

					if(out==0){
					
						var pesan = "Gagal Hapus Data!";
						Swal.fire({
						  title: 'GAGAL HAPUS',	
						  position: 'top-end',
						  icon: 'warning',
						  text: pesan,
						  showConfirmButton: false,
						  timer: 2000
						});
						 // window.location.reload();
						  e.preventDefault(); 
						
					}else{
						
						var pesan = "Data Berhasil Di Hapus!";
						Swal.fire({
						  position: 'top-end',
						  icon: 'success',
						  title: pesan,
						  showConfirmButton: false,
						  timer: 2000
						});
						 
						  e.preventDefault();						  
						 // window.location.reload();						  
						
						
					}
					
				})
				
				
				
				
						$.ajax({  
							  url: '<?php echo base_url('kapip-dataumum-profil-apip/get-profil7'); ?>/'+ctahun+'/'+cinstansi+'/'+ctriw,
							  type: 'POST',
							  success: function(data){
								$("#data-profil-7").html(data);
								
									$.ajax({  
										  url: '<?php echo base_url('kapip-dataumum-profil-apip/list-profil7'); ?>/'+ctahun+'/'+cinstansi+'/'+ctriw+'/'+ckd1+'/'+ckd2+'/'+0,
										  type: 'POST',
										  success: function(data){
											$("#rincian-informasip7").html(data);
											
											document.getElementById("cnmapl").focus();
											$('#hkd3rinci').val('');
											$('#cnmapl').val('');
											
										  }
									});		
								
							  }
							});	
							
				e.preventDefault();
              }
            })

		

	
	});


$(document).on("click", ".hapus-hprofil4", function() {	
		
		var ctriw 		= $('#triw').val();
		var ctahun 		= $('#ptahun').val();
		var cinstansi 	= $('#pkdinstansi').val();
		var ckd1        = $(this).attr("data-kd1"); 
		var ckd2        = $(this).attr("data-kd2"); 
		var curaian     = $(this).attr("data-uraian"); 

       Swal.fire({
              title: 'Apakah anda yakin?',
              text: "Menghapus  "+curaian+"..?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#074979',
              cancelButtonColor: '#d33',
              cancelButtonText: 'Batal',
              confirmButtonText: 'Ya, Hapus Data.'
            }).then((result) => {
              if (result.value) { 

                  $.ajax({
                  method: 'POST',
                  url: '<?php echo base_url('kapip-dataumum-profil-apip/hapus-hprofil4'); ?>?ctahun='+ctahun+'&ctriw='+ctriw+'&cinstansi='+cinstansi+'&ckd1='+ckd1+'&ckd2='+ckd2,
                })
                .done(function(data) {
                    var out = jQuery.parseJSON(data);
				

					if(out==0){
					
						var pesan = "Gagal Hapus Data!";
						Swal.fire({
						  title: 'GAGAL HAPUS',	
						  position: 'top-end',
						  icon: 'warning',
						  text: pesan,
						  showConfirmButton: false,
						  timer: 2000
						});
						 // window.location.reload();
						//  e.preventDefault(); 
						
					}else{
						
						var pesan = "Data Berhasil Di Hapus!";
						Swal.fire({
						  position: 'top-end',
						  icon: 'success',
						  title: pesan,
						  showConfirmButton: false,
						  timer: 2000
						});
						 
						 // e.preventDefault();						  
						 // window.location.reload();						  
						
						
					}
					
					
					$.ajax({  
					  url: '<?php echo base_url('kapip-dataumum-profil-apip/get-profil4'); ?>/'+ctahun+'/'+cinstansi,
					  type: 'POST',
					  success: function(data){
						$("#data-profil-4").html(data);
	 
					  }
					});

				})


              }
            })

		

	
	});


$(document).on("click", ".hapus-dprofil7", function() {	
		
		var ctriw 		= $('#triw').val();
		var ctahun 		= $('#ptahun').val();
		var cinstansi 	= $('#pkdinstansi').val();
		var ckd1        = $(this).attr("data-kd1"); 
		var ckd2        = $(this).attr("data-kd2"); 
		var curaian     = $(this).attr("data-uraian"); 

       Swal.fire({
              title: 'Apakah anda yakin?',
              text: "Menghapus  "+curaian+"..?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#074979',
              cancelButtonColor: '#d33',
              cancelButtonText: 'Batal',
              confirmButtonText: 'Ya, Hapus Data.'
            }).then((result) => {
              if (result.value) { 

                  $.ajax({
                  method: 'POST',
                  url: '<?php echo base_url('kapip-dataumum-profil-apip/hapus-dprofil7'); ?>?ctahun='+ctahun+'&ctriw='+ctriw+'&cinstansi='+cinstansi+'&ckd1='+ckd1+'&ckd2='+ckd2,
                })
                .done(function(data) {
                    var out = jQuery.parseJSON(data);

					if(out==0){
					
						var pesan = "Gagal Hapus Data!";
						Swal.fire({
						  title: 'GAGAL HAPUS',	
						  position: 'top-end',
						  icon: 'warning',
						  text: pesan,
						  showConfirmButton: false,
						  timer: 2000
						});
						 // window.location.reload();
						  e.preventDefault(); 
						
					}else{
						
						var pesan = "Data Berhasil Di Hapus!";
						Swal.fire({
						  position: 'top-end',
						  icon: 'success',
						  title: pesan,
						  showConfirmButton: false,
						  timer: 2000
						});
						 
						  e.preventDefault();						  
						 // window.location.reload();						  
						
						
					}
					
				})
				
				
				
				
						$.ajax({  
							  url: '<?php echo base_url('kapip-dataumum-profil-apip/get-profil7'); ?>/'+ctahun+'/'+cinstansi+'/'+ctriw,
							  type: 'POST',
							  success: function(data){
								$("#data-profil-7").html(data);
								
									$.ajax({  
										  url: '<?php echo base_url('kapip-dataumum-profil-apip/list-profil7'); ?>/'+ctahun+'/'+cinstansi+'/'+ctriw+'/'+ckd1+'/'+ckd2+'/'+0,
										  type: 'POST',
										  success: function(data){
											$("#rincian-informasip7").html(data);
											
											document.getElementById("cnmapl").focus();
											$('#hkd3rinci').val('');
											$('#cnmapl').val('');
											
										  }
									});		
								
							  }
							});	
							
				e.preventDefault();
              }
            })

		

	
	});





	$(document).on("click", ".simpan-hprofil7", function() {	 
	
	//var data = $('#form-profil7').serialize();
	var ctriw = $('#triw').val();
	var ctahun = $('#ptahun').val();
	var cinstansi = $('#pkdinstansi').val();
	
	var cpoin = $('#poinf7').val();
	var curaian = $('#uraianf7').val();
	var cjns = $('#jnsf7').val();
	var urut = $('#urutf7').val();	
	var ckd1 = $('#ckd1f7').val();
	


	
		
		$.ajax({
					type: 'POST',
					data: ({ctahun,cinstansi,ctriw,cpoin,curaian,cjns,urut,ckd1}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-dataumum-profil-apip/simpan-hprofil7",
					success: function(data) {
						
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

	
	});


	$(document).on("click", ".simpan-dprofil7", function() {	 
	
	//var data = $('#form-profil7').serialize();
	var ctriw = $('#triw').val();
	var ctahun = $('#ptahun').val();
	var cinstansi = $('#pkdinstansi').val();
	
	var curaian = $('#uraianf7_d').val();
	var urut = $('#urutf7_d').val();	
	var ckd1 = $('#ckd1f7_d').val();
		
		$.ajax({
					type: 'POST',
					data: ({ctahun,cinstansi,ctriw,curaian,urut,ckd1}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-dataumum-profil-apip/simpan-dprofil7",
					success: function(data) {
						
					   var status = data; //alert(status);
					   var pesan = "Berhasil Disimpan";
					   
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: pesan,
							showConfirmButton: false,
							timer: 2000
						});
					 
							$.ajax({  
							  url: '<?php echo base_url('kapip-dataumum-profil-apip/get-profil7'); ?>/'+ctahun+'/'+cinstansi+'/'+ctriw,
							  type: 'POST',
							  success: function(data){
								$("#data-profil-7").html(data);
								
									$.ajax({  
										  url: '<?php echo base_url('kapip-dataumum-profil-apip/list-profil7'); ?>/'+ctahun+'/'+cinstansi+'/'+ctriw+'/'+ckd1+'/'+ckd2+'/'+0,
										  type: 'POST',
										  success: function(data){
											$("#rincian-informasip7").html(data);
											
											document.getElementById("cnmapl").focus();
											$('#hkd3rinci').val('');
											$('#cnmapl').val('');
											
										  }
									});		
								
							  }
							});
					 
					
					}
			});

	
	});




	$(document).on("click", ".simpan-rinci-eprofil7", function() {	 
	
	//var data = $('#form-profil7').serialize();
	var ctriw = $('#triw').val();
	var ctahun = $('#ptahun').val();
	var cinstansi = $('#pkdinstansi').val();
	var triw = (document.getElementById('triw').value);
	
	var ckd1 = $('#hkd1rinci').val();
	var ckd2 = $('#hkd2rinci').val();
	var ckd3 = $('#hkd3rinci').val();
	var curaian = $('#cnmapl').val();
	
	
	
	
		$.ajax({
					type: 'POST',
					data: ({ctahun,cinstansi,ctriw,ckd1,ckd2,ckd3,curaian}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-dataumum-profil-apip/simpan-rinci-profil7",
					success: function(data) {
						
					   var status = data; //alert(status);
					   var pesan = "Berhasil Disimpan";
					   
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: pesan,
							showConfirmButton: false,
							timer: 2000
						});
					 
					 
							 $.ajax({  
								  url: '<?php echo base_url('kapip-dataumum-profil-apip/get-profil7'); ?>/'+ctahun+'/'+cinstansi+'/'+triw,
								  type: 'POST',
								  success: function(data){
									$("#data-profil-7").html(data);
								   
								  }
								});	
								
								$.ajax({  
								  url: '<?php echo base_url('kapip-dataumum-profil-apip/list-profil7'); ?>/'+ctahun+'/'+cinstansi+'/'+ctriw+'/'+ckd1+'/'+ckd2+'/'+0,
								  type: 'POST',
								  success: function(data){
									$("#rincian-informasip7").html(data);
									
									document.getElementById("cnmapl").focus();
									$('#hkd3rinci').val('');
									$('#cnmapl').val('');
									
								  }
								});					
								
					 
					}
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
	var triw = (document.getElementById('triw').value); 
	
		
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
						
					   var status = data; //alert(status);
					   var pesan = "Berhasil Disimpan";
					   
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: pesan,
							showConfirmButton: false,
							timer: 2000
						});
					 
					 
						$.ajax({  
						 
							  url: '<?php echo base_url('kapip-dataumum-profil-apip/get-profil1'); ?>/'+ctahun+'/'+cinstansi+'/'+triw,
							  type: 'POST',
							  success: function(data){
							  $("#data-profil-1").html(data);
						   
						  }
						});	
						 
					 
					 
					}
			});
		
	});	
				



$(document).on("click", ".simpan-profil2", function(e) {

	var data = $('#form-profil2').serialize();
	var ctriw = $('#triw').val();
	var ctahun = $('#ptahun').val();
	var cinstansi = $('#pkdinstansi').val();
	var triw = (document.getElementById('triw').value); 
		
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
						
						
						
							$.ajax({  
							  url: '<?php echo base_url('kapip-dataumum-profil-apip/get-profil2'); ?>/'+ctahun+'/'+cinstansi+'/'+triw,
							  type: 'POST',
							  success: function(data){
								$("#data-profil-2").html(data);
							  }
							});
						
					 
					 
					}
			});
				
		
		
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
					 
					 
						$.ajax({  
						  url: '<?php echo base_url('kapip-dataumum-profil-apip/get-profil5'); ?>/'+ctahun+'/'+cinstansi+'/'+ctriw,
						  type: 'POST',
						  success: function(data){
							$("#data-profil-5").html(data);
						  }
						});

					 
					 
					 
					}
			});
				
		
		
		
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
					 
					 
						$.ajax({  
						  url: '<?php echo base_url('kapip-dataumum-profil-apip/get-profil6'); ?>/'+ctahun+'/'+cinstansi+'/'+ctriw,
						  type: 'POST',
						  success: function(data){
							$("#data-profil-6").html(data);
						  }
						});

					 
					 
					}
			});
				
		
		
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
					 
					 $.ajax({  
						  url: '<?php echo base_url('kapip-dataumum-profil-apip/get-profil6'); ?>/'+ctahun+'/'+cinstansi+'/'+ctriw,
						  type: 'POST',
						  success: function(data){
							$("#data-profil-6").html(data);
						  }
						});
					 
					 
					}
			});
				
		
		
		
	});	
	







$(document).on("click", ".edit-hprofil4", function(e) {

	var ckd1 		= $(this).attr("data-kd1");
	var cinstansi   = $('#pkdinstansi').val();
	var cjenis 		= $(this).attr("data-jenis");

		    $.ajax({            
			 url: '<?php echo base_url('kapip-dataumum-profil-apip/edit-hprofil4'); ?>/'+ckd1+'/'+cinstansi+'/'+cjenis,
			method: 'POST',
            success: function(data) {
				$('#data-ehprofil-4').html(data);
				$('#ModalEditHProfil4').modal('show');
				
					
			
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
			
        });

		
	});	




$(document).on("click", ".edit-profil7", function(e) {

	var data		= $('#form-profil7').serialize();
	var ctriw 		= $('#triw').val();
	var ctahun 		= $('#ptahun').val();
	var cinstansi 	= $('#pkdinstansi').val();
	var ckd1 		= $(this).attr("data-kd1");
	var ckd2 		= $(this).attr("data-kd2");
	var cjenis 		= $(this).attr("data-jenis");
	var cnilai 		= $(this).attr("data-nilai");

		 
		    $.ajax({           
			 url: '<?php echo base_url('kapip-dataumum-profil-apip/edit-profil7'); ?>/'+ctahun+'/'+cinstansi+'/'+ctriw+'/'+ckd1+'/'+ckd2+'/'+cjenis,
			method: 'POST',
            success: function(data) {
				$('#data-eprofil-7').html(data);
				$('#ModalEditProfil7').modal('show');
				
				$('#hkd1rinci').val(ckd1);
				$('#hkd2rinci').val(ckd2);
	
												
				if (cnilai=="1"){            
					$("#cpilihan").attr("checked",true);
				} else {
					$("#cpilihan").attr("checked",false);
				}	
				
				
					
				 $.ajax({  
						  url: '<?php echo base_url('kapip-dataumum-profil-apip/list-profil7'); ?>/'+ctahun+'/'+cinstansi+'/'+ctriw+'/'+ckd1+'/'+ckd2+'/'+cjenis,
						  type: 'POST',
						  success: function(data){
							$("#rincian-informasip7").html(data);
						  }
						});		
			
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
			
        });

		
	});	




$(document).on("click", ".tambah-header-profil7", function(e) {

	//var data		= $('#form-profil7').serialize();
	var ctriw 		= $('#triw').val();
	var ctahun 		= $('#ptahun').val();
	var cinstansi 	= $('#pkdinstansi').val();
	var ckd1		= '';
	var caksi		= '1';
	

		    $.ajax({           
			 url: '<?php echo base_url('kapip-dataumum-profil-apip/proses-hprofil7'); ?>?ctahun='+ctahun+'&ctriw='+ctriw+'&cinstansi='+cinstansi+'&ckd1='+ckd1+'&caksi='+caksi,			 
			method: 'POST',
            success: function(data) {
				$('#data-hprofil7').html(data);
				$('#ModalTambahHProfil7').modal('show');
				
			
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
			
        });

		
	});	




$(document).on("click", ".tambah-header-profil4", function(e) {
	
	var ctahun 		= $('#ptahun').val();
	var cinstansi 	= $('#pkdinstansi').val();
	var ckd1		= '';
	var caksi		= '1';
	

		    $.ajax({           
			 url: '<?php echo base_url('kapip-dataumum-profil-apip/proses-hprofil4'); ?>?ctahun='+ctahun+'&cinstansi='+cinstansi+'&caksi='+caksi,			 
			method: 'POST',
            success: function(data) {
				$('#data-hprofil4').html(data);
				$('#ModalTambahHProfil4').modal('show');
				
			
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
			
        });

		
	});	



$(document).on("click", ".tambah-detail-profil7", function(e) {

	var ctriw 		= $('#triw').val();
	var ctahun 		= $('#ptahun').val();
	var cinstansi 	= $('#pkdinstansi').val();
	var ckd1 		= $(this).attr("data-kd1");	
	var caksi		= '1'; //tambah
	

		    $.ajax({           
			 url: '<?php echo base_url('kapip-dataumum-profil-apip/proses-dprofil7'); ?>?ctahun='+ctahun+'&ctriw='+ctriw+'&cinstansi='+cinstansi+'&ckd1='+ckd1+'&caksi='+caksi,			 
			method: 'POST',
            success: function(data) {
				$('#data-dprofil7').html(data);
				$('#ModalTambahDProfil7').modal('show');
				
			
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
			
        });

		
	});	

	
	
$(document).on("click", ".simpan-header-hprofil4", function(e) {
	
	var cinstansi = $('#pkdinstansi').val();
	var curut = $('#curut_head4_ins').val();
	var cpoin = $('#cpoin_head4_ins').val();
	var curaian = $('#curaian_head4_ins').val();
	var ckd1 = $('#ckd1_head4_ins').val();
	var cjns = $('#jnsf4_ins').val();
	var ctahun= '<?= $tahun ?>';

		
			$.ajax({
					type: 'POST',
					data: ({cinstansi,ckd1,curaian,curut,cpoin,cjns}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-dataumum-profil-apip/simpan-Hprofil4",
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
					 
							$.ajax({  
								 
									  url: '<?php echo base_url('kapip-dataumum-profil-apip/get-profil4'); ?>/'+ctahun+'/'+cinstansi,
									  type: 'POST',
									  success: function(data){
									  $("#data-profil-4").html(data);
									  
									  
								   
								  }
								});	
					 
					}
			});
				
		
		
		
	});	

	



$(document).on("click", ".simpan-header-ehprofil4", function(e) {
	
	var cinstansi = $('#pkdinstansi').val();
	var curut = $('#curut_head4').val();
	var cpoin = $('#cpoin_head4').val();
	var curaian = $('#curaian_head4').val();
	var ckd1 = $('#ckd1_head4').val();
	var ctahun= '<?= $tahun ?>';
		
			$.ajax({
					type: 'POST',
					data: ({cinstansi,ckd1,curaian,curut,cpoin}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-dataumum-profil-apip/update-Hprofil4",
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
					 
							$.ajax({  
								 
									  url: '<?php echo base_url('kapip-dataumum-profil-apip/get-profil4'); ?>/'+ctahun+'/'+cinstansi,
									  type: 'POST',
									  success: function(data){
									  $("#data-profil-4").html(data);
								   
								  }
								});	
					 
					}
			});
				
		
		
		
	});	

	


$(document).on("click", ".simpan-header-eprofil7", function(e) {

	var ctriw = $('#triw').val();
	var ctahun = $('#ptahun').val();
	var cinstansi = $('#pkdinstansi').val();
	var curut = $('#curut_head').val();
	var cpoin = $('#cpoin_head').val();
	var curaian = $('#curaian_head').val();
	var ckd1 = $('#ckd1_head').val();
			
			$.ajax({
					type: 'POST',
					data: ({ctahun,cinstansi,ckd1,ctriw,curaian,curut,cpoin}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-dataumum-profil-apip/update-Hprofil7",
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
					 
							$.ajax({  
								 
									  url: '<?php echo base_url('kapip-dataumum-profil-apip/get-profil7'); ?>/'+ctahun+'/'+cinstansi+'/'+ctriw,
									  type: 'POST',
									  success: function(data){
									  $("#data-profil-7").html(data);
								   
								  }
								});	
					 
					}
			});
				
		
		
		
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
					 
							$.ajax({  
								 
									  url: '<?php echo base_url('kapip-dataumum-profil-apip/get-profil1'); ?>/'+ctahun+'/'+cinstansi+'/'+ctriw,
									  type: 'POST',
									  success: function(data){
									  $("#data-profil-1").html(data);
								   
								  }
								});	
					 
					}
			});
				
		
		
		
	});	
	

$(document).on("click", ".simpan-eprofil2", function(e) {

	var data = $('#form-edit-p2').serialize();
	var ctriw = $('#triw').val();
	var ctahun = $('#ptahun').val();
	var cinstansi = $('#pkdinstansi').val();
	var triw = (document.getElementById('triw').value); 
	
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
					 
						$.ajax({  
						  url: '<?php echo base_url('kapip-dataumum-profil-apip/get-profil2'); ?>/'+ctahun+'/'+cinstansi+'/'+ctriw,
						  type: 'POST',
						  success: function(data){
							$("#data-profil-2").html(data);
						  }
						});
					 
					}
			});
				
		
		
		
	});	


$(document).on("click", ".simpan-profil4", function(e) {



	var data = $('#form-profi4').serialize();
	var ctriw = $('#triw').val();
	var ctahun = $('#ptahun').val();
	var cinstansi = $('#pkdinstansi').val();
	
	
	
			var cdata='';
			var table = document.getElementById('data-profil-4');
			
			var cjenis = '';
			var cnilai = '';
			var ckd1 = '';
			var ckd2 = '';
			var clevel = '';
		
			for (var r = 0, n = table.rows.length; r < n; r++) {
				  
				var cjenis = cjenis+'#'+table.rows[r].cells[0].innerHTML;				
				var cnilai = cnilai+'#'+table.rows[r].cells[1].innerHTML; 
				var ckd1   = ckd1+'#'+table.rows[r].cells[2].innerHTML; 
				var ckd2   = ckd2+'#'+table.rows[r].cells[3].innerHTML;
				var cpoin   = cpoin+'#'+table.rows[r].cells[4].innerHTML;				
				var clevel   = clevel+'#'+table.rows[r].cells[5].innerHTML; 
				var ctahun_trx   = ctahun_trx+'#'+table.rows[r].cells[6].innerHTML; 
				var curaian   = curaian+'#'+table.rows[r].cells[7].innerHTML; 
				
			}	
		
		
		
			$.ajax({
					type: 'POST',
					data: ({ctahun,cinstansi,cjenis,cnilai,ckd1,ckd2,clevel,cpoin,curaian,ctahun_trx}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-dataumum-profil-apip/simpan-profil4",
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
					 
						/* $.ajax({  
						  url: '<?php echo base_url('kapip-dataumum-profil-apip/get-profil2'); ?>/'+ctahun+'/'+cinstansi+'/'+ctriw,
						  type: 'POST',
						  success: function(data){
							$("#data-profil-2").html(data);
						  }
						}); */
					 
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
					 
							$.ajax({  
								  url: '<?php echo base_url('kapip-dataumum-profil-apip/get-profil5'); ?>/'+ctahun+'/'+cinstansi+'/'+ctriw,
								  type: 'POST',
								  success: function(data){
									$("#data-profil-5").html(data);
								  }
								});
					 
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
					 
							$.ajax({  
								  url: '<?php echo base_url('kapip-dataumum-profil-apip/get-profil6'); ?>/'+ctahun+'/'+cinstansi+'/'+ctriw,
								  type: 'POST',
								  success: function(data){
									$("#data-profil-6").html(data);
								  }
								});
					 
					}
			});
				
		
		
		
	});	



$(document).on("click", ".simpan-eprofil7", function(e) {

	var data = $('#form-edit-p7').serialize();
	var ctriw = $('#triw').val();
	var ctahun = $('#ptahun').val();
	var cinstansi = $('#pkdinstansi').val();
	
	var ckd1 = $('#hckd1').val();
	var ckd2 = $('#hckd2').val();
	
	
	


	var cst1 = document.getElementById('cpilihan').checked;
        if (cst1==false){
           cnilai=0;
        }else{
            cnilai=1;
        }	
			//alert(cst1);
		
		
		
			$.ajax({
					type: 'POST',
					data: ({ctahun,cinstansi,ctriw,cnilai,ckd1,ckd2}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-dataumum-profil-apip/simpan-Eprofil7",
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
					 
							$.ajax({  
								  url: '<?php echo base_url('kapip-dataumum-profil-apip/get-profil7'); ?>/'+ctahun+'/'+cinstansi+'/'+ctriw,
								  type: 'POST',
								  success: function(data){
									$("#data-profil-7").html(data);
								  }
								});
					 
					}
			});
				
		
		
		
	});	



	function changepilihan($cnilai,$index,$cnmcheck){
		$cnm=('cek4_'+$cnmcheck);
		
		var cst1 = document.getElementById($cnm).checked;
			if (cst1==false){
			   $cnilai=0;
			}else{
				$cnilai=1;
			}	
	
		
		var myTable = document.getElementById("data-profil-4");

			content=$cnilai;
		var rn=$index;
		var cn=1;

			var x=document.getElementById('data-profil-4').rows[parseInt(rn,10)].cells;
			x[parseInt(cn,10)].innerHTML=content;
			
			
		
	}



	function changelk($cnilai,$index){

		var myTable = document.getElementById("data-profil-4");

			content=$cnilai;
		var rn=$index;
		var cn=1;

			var x=document.getElementById('data-profil-4').rows[parseInt(rn,10)].cells;
			x[parseInt(cn,10)].innerHTML=content;
			
			
		
	}

	function hitungP4($cnilai,$index){
		var myTable = document.getElementById("data-profil-4");

			content=$cnilai;
		var rn=$index;
		var cn=1;

			var x=document.getElementById('data-profil-4').rows[parseInt(rn,10)].cells;
			x[parseInt(cn,10)].innerHTML=content;
		
	}

	function changetext4($cnilai,$index){
		
		
		var myTable = document.getElementById("data-profil-4");

			content=$cnilai;
		var rn=$index;
		var cn=1;

			var x=document.getElementById('data-profil-4').rows[parseInt(rn,10)].cells;
			x[parseInt(cn,10)].innerHTML=content;
	}	
	
	
	
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


//--------------PROFIL 2 ------

	function toggleP2_1() {			
		for (i = 4; i < 10; i++) {
			var selected = 'P2_'+i; 		
			toggleRow(selected);			
		  }	 
	}	



	function toggleP2_2() {			  
		for (i = 12; i < 14; i++) {
			var selected = 'P2_'+i; 			
			toggleRow(selected);			
		  }	 
	}	

	function toggleP2_3() {			  
		for (i = 15; i < 19; i++) {
			var selected = 'P2_'+i; 			
			toggleRow(selected);			
		  }	 
	}
	

	function toggleP2_4() {			  
		for (i = 20; i < 24; i++) {
			var selected = 'P2_'+i; 			
			toggleRow(selected);			
		  }	 
	}

	function toggleP2_5() {			  
		for (i = 25; i < 29; i++) {
			var selected = 'P2_'+i; 			
			toggleRow(selected);			
		  }	 
	}


	function toggleP2_6() {			  
		for (i = 31; i < 37; i++) {
			var selected = 'P2_'+i; 			
			toggleRow(selected);			
		  }	 
	}




	function toggleOptionP2(thisselect) {  
	
		for (i = 4; i < 10; i++) {
			var selected = 'P2_'+i; 		
			toggleRow(selected);			
		  }	 

		  
		for (i = 12; i < 14; i++) {
			var selected = 'P2_'+i; 			
			toggleRow(selected);			
		  }	 
		  
		for (i = 15; i < 19; i++) {
			var selected = 'P2_'+i; 			
			toggleRow(selected);			
		  }	 

		  
		for (i = 20; i < 24; i++) {
			var selected = 'P2_'+i; 			
			toggleRow(selected);			
		  }	 
			  
		for (i = 25; i < 29; i++) {
			var selected = 'P2_'+i; 			
			toggleRow(selected);			
		  }	 
		  
		for (i = 31; i < 37; i++) {
			var selected = 'P2_'+i; 			
			toggleRow(selected);			
		  }	 

		
		
	}



		function toggleP5_1() {
			for (i = 3; i < 4; i++) {
					var selected = 'P5_'+i; 		
					toggleRow(selected);			
				  }	 

		}
		
function toggleP5_2() {	
		  
		for (i = 5; i < 11; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 
}

function toggleP5_3() {	
		for (i = 12; i < 16; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 
}

function toggleP5_4() {
		for (i = 17; i < 27; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	
}

function toggleP5_5() {
		for (i = 28; i < 32; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	
}		  


function toggleP5_6() {		  
		for (i = 33; i < 37; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 
}

function toggleP5_7() {
		for (i = 38; i < 45; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	
}

		  
function toggleP5_8() {
		for (i = 46; i < 52; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	
}

		  
function toggleP5_9() {		  
		for (i = 53; i < 59; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	
}		  

function toggleP5_10() {		  
		for (i = 60; i < 67; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 
}

function toggleP5_11() {		  
		for (i = 68; i < 74; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 
}		  

function toggleP5_12() {		  
		for (i = 75; i < 81; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 
}		  

function toggleP5_13() {		  
		for (i = 82; i < 88; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 
}		  

function toggleP5_14() {		
		for (i = 89; i < 95; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 
}

function toggleP5_15() {
		for (i = 96; i < 103; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 
}

function toggleP5_16() {
		for (i = 104; i < 110; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 
}

function toggleP5_17() {
		for (i = 111; i < 117; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 
}
function toggleP5_18() {
		for (i = 118; i < 124; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 
}

function toggleP5_19() {
		for (i = 125; i < 132; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 
}

function toggleP5_20() {
		for (i = 133; i < 139; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 
}

function toggleP5_21() {
		for (i = 140; i < 146; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 
}

function toggleP5_22() {
		for (i = 147; i < 153; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 
}
		  
function toggleP5_23() {
		for (i = 154; i < 160; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 
}

function toggleP5_24() {
		for (i = 161; i < 167; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 
}		  

function toggleP5_25() {
		for (i = 168; i < 174; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 
}





	function toggleOptionP5(thisselect) {  
	
		for (i = 3; i < 4; i++) {
			var selected = 'P5_'+i; 		
			toggleRow(selected);			
		  }	 

		  
		for (i = 5; i < 11; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 
		  
		for (i = 12; i < 16; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 

		  
		for (i = 17; i < 27; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 
			  
		for (i = 28; i < 32; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 
		  
		for (i = 33; i < 37; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 

		for (i = 38; i < 45; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 

		for (i = 46; i < 52; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 
		  
		for (i = 53; i < 59; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 
		  
		for (i = 60; i < 67; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 
		  
		for (i = 68; i < 74; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 
		  
		for (i = 75; i < 81; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 
		  
		for (i = 82; i < 88; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 
		
		for (i = 89; i < 95; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 

		for (i = 96; i < 103; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 

		for (i = 104; i < 110; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 

		for (i = 111; i < 117; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 

		for (i = 118; i < 124; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 

		for (i = 125; i < 132; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 

		for (i = 133; i < 139; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 

		for (i = 140; i < 146; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 

		for (i = 147; i < 153; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 

		for (i = 154; i < 160; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 

		for (i = 161; i < 167; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 

		for (i = 168; i < 174; i++) {
			var selected = 'P5_'+i; 			
			toggleRow(selected);			
		  }	 


		
	}






function toggleP6_1() {
		for (i = 3; i < 9; i++) {
			var selected = 'P6_'+i; 		
			toggleRow(selected);			
		  }	 
}

function toggleP6_2() {		  
		for (i = 10; i < 16; i++) {
			var selected = 'P6_'+i; 			
			toggleRow(selected);			
		  }	 
}		  

function toggleP6_3() {		  
		for (i = 17; i < 23; i++) {
			var selected = 'P6_'+i; 			
			toggleRow(selected);			
		  }	 
}


function toggleP6_4() {		  
		for (i = 24; i < 30; i++) {
			var selected = 'P6_'+i; 			
			toggleRow(selected);			
		  }	 
	
}


function toggleP6_5() {	
		for (i = 31; i < 32; i++) {
			var selected = 'P6_'+i; 			
			toggleRow(selected);			
		  }	 
}

		  
		  
function toggleP6_6() {		  
		for (i = 33; i < 39; i++) {
			var selected = 'P6_'+i; 			
			toggleRow(selected);			
		  }	 
}

function toggleP6_7() {
		for (i = 40; i < 46; i++) {
			var selected = 'P6_'+i; 			
			toggleRow(selected);			
		  }	 
}		  
		  
function toggleP6_8() {
		for (i = 47; i < 53; i++) {
			var selected = 'P6_'+i; 			
			toggleRow(selected);			
		  }	 
}		  

function toggleP6_9() {		  
		for (i = 54; i < 60; i++) {
			var selected = 'P6_'+i; 			
			toggleRow(selected);			
		  }	

}

		  
function toggleP6_10() {		  
		for (i = 61; i < 67; i++) {
			var selected = 'P6_'+i; 			
			toggleRow(selected);			
		  }	 
}

function toggleP6_11() {		  
		for (i = 68; i < 74; i++) {
			var selected = 'P6_'+i; 			
			toggleRow(selected);			
		  }	 
}		  

function toggleP6_12() {		  
		for (i = 75; i < 81; i++) {
			var selected = 'P6_'+i; 			
			toggleRow(selected);			
		  }	 
}		  


function toggleP6_13() {		  
		for (i = 82; i < 88; i++) {
			var selected = 'P6_'+i; 			
			toggleRow(selected);			
		  }	 
}		  


function toggleP6_14() {		
		for (i = 89; i < 95; i++) {
			var selected = 'P6_'+i; 			
			toggleRow(selected);			
		  }	 
		  
}


		  
function toggleP6_15() {
		for (i = 96; i < 102; i++) {
			var selected = 'P6_'+i; 			
			toggleRow(selected);			
		  }	 
}

function toggleP6_16() {
		for (i = 103; i < 109; i++) {
			var selected = 'P6_'+i; 			
			toggleRow(selected);			
		  }	 

}





function toggleOptionP6(thisselect) {  
	
		for (i = 3; i < 9; i++) {
			var selected = 'P6_'+i; 		
			toggleRow(selected);			
		  }	 

		  
		for (i = 10; i < 16; i++) {
			var selected = 'P6_'+i; 			
			toggleRow(selected);			
		  }	 
		  
		for (i = 17; i < 23; i++) {
			var selected = 'P6_'+i; 			
			toggleRow(selected);			
		  }	 

		  
		for (i = 24; i < 30; i++) {
			var selected = 'P6_'+i; 			
			toggleRow(selected);			
		  }	 
			  
		for (i = 31; i < 32; i++) {
			var selected = 'P6_'+i; 			
			toggleRow(selected);			
		  }	 
		  
		for (i = 33; i < 39; i++) {
			var selected = 'P6_'+i; 			
			toggleRow(selected);			
		  }	 

		for (i = 40; i < 46; i++) {
			var selected = 'P6_'+i; 			
			toggleRow(selected);			
		  }	 

		for (i = 47; i < 53; i++) {
			var selected = 'P6_'+i; 			
			toggleRow(selected);			
		  }	 
		  
		for (i = 54; i < 60; i++) {
			var selected = 'P6_'+i; 			
			toggleRow(selected);			
		  }	 
		  
		for (i = 61; i < 67; i++) {
			var selected = 'P6_'+i; 			
			toggleRow(selected);			
		  }	 
		  
		for (i = 68; i < 74; i++) {
			var selected = 'P6_'+i; 			
			toggleRow(selected);			
		  }	 
		  
		for (i = 75; i < 81; i++) {
			var selected = 'P6_'+i; 			
			toggleRow(selected);			
		  }	 
		  
		for (i = 82; i < 88; i++) {
			var selected = 'P6_'+i; 			
			toggleRow(selected);			
		  }	 
		
		for (i = 89; i < 95; i++) {
			var selected = 'P6_'+i; 			
			toggleRow(selected);			
		  }	 

		for (i = 96; i < 102; i++) {
			var selected = 'P6_'+i; 			
			toggleRow(selected);			
		  }	 

		for (i = 103; i < 109; i++) {
			var selected = 'P6_'+i; 			
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



	$(document).on("click", "#btnp5_2", function(e) { toggleP5_1(); });	
	$(document).on("click", "#btnp5_4", function(e) { toggleP5_2(); });	
	$(document).on("click", "#btnp5_11", function(e) { toggleP5_3(); });	
	$(document).on("click", "#btnp5_16", function(e) { toggleP5_4(); });	
	$(document).on("click", "#btnp5_27", function(e) { toggleP5_5(); });	
	$(document).on("click", "#btnp5_32", function(e) { toggleP5_6(); });	
	$(document).on("click", "#btnp5_37", function(e) { toggleP5_7(); });	
	$(document).on("click", "#btnp5_45", function(e) { toggleP5_8(); });	
	$(document).on("click", "#btnp5_52", function(e) { toggleP5_9(); });	
	$(document).on("click", "#btnp5_59", function(e) { toggleP5_10(); });	
	$(document).on("click", "#btnp5_67", function(e) { toggleP5_11(); });	
	$(document).on("click", "#btnp5_74", function(e) { toggleP5_12(); });	
	$(document).on("click", "#btnp5_81", function(e) { toggleP5_13(); });	
	$(document).on("click", "#btnp5_88", function(e) { toggleP5_14(); });	
	$(document).on("click", "#btnp5_95", function(e) { toggleP5_15(); });	
	$(document).on("click", "#btnp5_103", function(e) { toggleP5_16(); });	
	$(document).on("click", "#btnp5_110", function(e) { toggleP5_17(); });	
	$(document).on("click", "#btnp5_117", function(e) { toggleP5_18(); });	
	$(document).on("click", "#btnp5_124", function(e) { toggleP5_19(); });	
	$(document).on("click", "#btnp5_132", function(e) { toggleP5_20(); });	
	$(document).on("click", "#btnp5_139", function(e) { toggleP5_21(); });	
	$(document).on("click", "#btnp5_146", function(e) { toggleP5_22(); });	
	$(document).on("click", "#btnp5_153", function(e) { toggleP5_23(); });	
	$(document).on("click", "#btnp5_160", function(e) { toggleP5_24(); });	
	$(document).on("click", "#btnp5_167", function(e) { toggleP5_25(); });
	
	
	
	
	
	$(document).on("click", "#btnp6_2", function(e) { toggleP6_1(); });
	$(document).on("click", "#btnp6_9", function(e) { toggleP6_2(); });
	$(document).on("click", "#btnp6_16", function(e) { toggleP6_3(); });
	$(document).on("click", "#btnp6_23", function(e) { toggleP6_4(); });
	$(document).on("click", "#btnp6_30", function(e) { toggleP6_5(); });
	$(document).on("click", "#btnp6_32", function(e) { toggleP6_6(); });
	$(document).on("click", "#btnp6_39", function(e) { toggleP6_7(); });
	$(document).on("click", "#btnp6_46", function(e) { toggleP6_8(); });
	$(document).on("click", "#btnp6_53", function(e) { toggleP6_9(); });
	$(document).on("click", "#btnp6_60", function(e) { toggleP6_10(); });
	$(document).on("click", "#btnp6_67", function(e) { toggleP6_11(); });
	$(document).on("click", "#btnp6_74", function(e) { toggleP6_12(); });
	$(document).on("click", "#btnp6_81", function(e) { toggleP6_13(); });
	$(document).on("click", "#btnp6_88", function(e) { toggleP6_14(); });
	$(document).on("click", "#btnp6_95", function(e) { toggleP6_15(); });
	$(document).on("click", "#btnp6_102", function(e) { toggleP6_16(); });

	
	
	
	
	
	
	

	
	function enter(ckey,_cid){
		
        if (ckey==13)
        	{    	       	       	    	   
        	   
			   document.getElementById("4").focus();
        	}     
    }
	
	
	function hide(_cid1,_cdir1,_cid2,_cdir2) {                      
    $(_cid1).toggle( 'slide',{direction: _cdir1}, 300,
            function(){
                $(_cid2).toggle('slide', {direction: _cdir2}, 300);
            });         
}


	$('#role').select2({
		  placeholder: 'Jenis Uraian'
		});

</script>    

