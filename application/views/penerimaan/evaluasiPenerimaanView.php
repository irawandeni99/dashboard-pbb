


<div class="panel panel-headline panel-primary" style="min-height:500px;">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-file-o"></i>  Laporan Evaluasi Penerimaan PBB </h3>
	</div>

	<div class="panel-body">
		
		<div style="display:block;">

			<div class="row">
					<div class="col-md-8">	
							<div class="form-group">
								<!-- Label Kecamatan -->
								<div class="col-sm-3">
									<label class="col-sm-10 control-label input-sm" id="label-tipe">SPPT Tahun</label>
								</div>
								<!-- Dropdown Kecamatan -->
								<div class="col-sm-2">
									<select name="tahun" id="tahun" class="form-control">
										<?php 
											$tahunSekarang = date('Y'); 
											for ($i = $tahunSekarang; $i >= 2000; $i--) {
												echo "<option value='$i'>$i</option>";
											}
										?>
									</select>
								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="row">
					<div class="col-md-8">	
							<div class="form-group">
								<!-- Label Kecamatan -->
								<div class="col-sm-3">
									<label class="col-sm-2 control-label input-sm" id="label-tipe">Kecamatan</label>
								</div>
								<!-- Dropdown Kecamatan -->
								<div class="col-sm-7">
									 <select name="kecamatan" id="kecamatan" class="form-control input-sm" style="width:100%">
										<option value="000" data-nama="Semua Kecamatan">Semua Kecamatan</option>
										<?php foreach($kecamatan as $row): ?>
											<option value="<?= $row->kd_kecamatan; ?>" 
													data-nama="<?= $row->nm_kecamatan; ?>">
												<?= $row->kd_kecamatan; ?> | <?= $row->nm_kecamatan; ?>
											</option>
										<?php endforeach; ?>
									</select>
							</div>

							<div class="col-sm-5" style="margin-top:10px;" hidden>
								<input type="text" name="nm_kecamatan" id="nm_kecamatan" 
									class="form-control input-sm" placeholder="Nama Kecamatan" readonly>
							</div>

						</div>

					</div>
				</div>

					<div class="row">
						<div class="col-md-8">	
								<div class="form-group">
									<!-- Label Kecamatan -->
									<div class="col-sm-3">
										<label class="col-sm-10 control-label input-sm" id="label-tipe">Periode Penerimaan</label>
								</div>

							<div class="col-sm-7" style="display:flex; align-items:left; gap:5px;">
								<div class="input-group" style="width:160px;">
									<div class="input-group-addon">
										<i class="lnr lnr-calendar-full text-danger"></i>
									</div>
										<input type="text" class="form-control" placeholder="End Date" 
										id="start_date" name="start_date" value="<?= date('01-01-Y'); ?>">
								</div>
								<span style="margin-top:10px;" >S/D</span>

								<div class="input-group" style="width:160px;">
									<div class="input-group-addon">
										<i class="lnr lnr-calendar-full text-danger"></i>
									</div>
										<input type="text" class="form-control" placeholder="End Date" 
										id="end_date" name="end_date" value="<?= date('d-m-Y'); ?>">
								</div>
				
							</div>

						
						</div>
					</div>
					</div>
					<br>&nbsp;<br>
				
					
					<div class="row">
						<div class="col-sm-8" align="left" >
							<div class="col-sm-3">&nbsp;</div>
							
							<div class="col-sm-8" align="left" >
								<div class="form-group">
									<div class="btn-group btn-group-sm" id="print" style="bottom:4px;">
										<a href="#" class="btn btn-primary" id="search"><i class="icon fa fa-search"></i> Preview</a>
											<div class="btn-group">
											<a href="#" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" style="font-size:11.5px;">
											<i class="icon fa fa-print"></i>
											Cetak <span class="caret"></span></a>
											<ul class="dropdown-menu" role="menu">
											  <li><a href="#" class="tombol-print" id="print-pdf" style="color:#ff3547;"><i class="icon fa fa-file-pdf-o"></i> Pdf</a></li>
											  <li><a href="#" class="tombol-print" id="print-excel" style="color:green;"><i class="icon fa fa-file-excel-o"></i> Excel</a></li>
											</ul>
										  </div>
										</div> 
								</div> 
							</div> 
						</div>				
					</div>				
					
			</div>

		<div class="row">

			<div class="col-md-12">
				<div class="box-body my-form-body">

					<div id="treeview-mdbootstrap" style="margin-top:50px;">
						<div class="alert alert-warning alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  <center><b>Peringatan!</b> Isi data filter yang lengkap!</center>
						</div>
					</div>
					
					<div id="tree_parameter">
						
					</div>
				</div>
			</div>
	    </div>
	</div>  
	
</div>  


<!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/datatables/css/dataTables.bootstrap.min.css">  
<link rel="stylesheet" href="<?= base_url() ?>assets/css/custom.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/datatables/css/fixedHeader.bootstrap.min.css">  
<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/datatables/css/responsive.bootstrap.min.css">  
<!-- DataTables -->
<script src="<?= base_url() ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?= base_urI() ?>assets/vendor/penerimaan/evaluasi.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/dataTables.fixedHeader.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/responsive.bootstrap.min.js"></script>


<script>


</script> 

