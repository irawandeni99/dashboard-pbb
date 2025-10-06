


<div class="panel panel-headline panel-primary" style="min-height:500px;">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-file-o"></i>  Laporan Rekap Objek Pajak </h3>
	</div>

	<div class="panel-body">
		
		<div style="display:block;">
				<div class="row">
					<div class="col-md-8">	
							<div class="form-group">
								<!-- Label Kecamatan -->
								<div class="col-sm-2">
									<label class="col-sm-2 control-label input-sm" id="label-tipe">Tahun</label>
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
								<div class="col-sm-2">
									<label class="col-sm-2 control-label input-sm" id="label-tipe">Kecamatan</label>
								</div>
								<!-- Dropdown Kecamatan -->
								<div class="col-sm-5">
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

					</div><br>
					
					<div class="row" style="margin-left:2px; margin-top:80px;">
						<div class="col-sm-8" align="left" >
							<div class="col-sm-2">&nbsp;</div>
							
							<div class="col-sm-10" align="left" >
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
<script src="<?= base_url() ?>assets/vendor/datatables/dataTables.fixedHeader.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/responsive.bootstrap.min.js"></script>

<script>
	$(window).on('load', function () {
	  		$(function () {
		  		$('[data-toggle="tooltip"]').tooltip();
			});
					
			$(document).ready(function() {
			  $('.treeview-animated').mdbTreeview();
			  	$(document).ready(function() {
					$('#kecamatan').select2({
						placeholder: "Pilih Kecamatan",
						allowClear: true,
						width: '100%'   // supaya full lebar
					});
				});
			});
		  	
		});
		
		$(document).ready(function() {
			$('#kecamatan').on('change', function() {
				let nama = $(this).find(':selected').data('nama'); 
				$('#nm_kecamatan').val(nama);
			});

			let initNama = $('#kecamatan').find(':selected').data('nama');
			$('#nm_kecamatan').val(initNama);
		});

	var table;
    $(document).ready(function() {

        function reload_table () {
        	table.ajax.reload( null, false ); 
        }

        $(document).on("click", "#search", function() {
			const tahun 		= document.getElementById('tahun').value;
			const kec 			= document.getElementById('kecamatan').value;
			const nmkec 			= document.getElementById('nm_kecamatan').value;
			const ctipe			= 'prev';
			
			if (tahun == '') {
        		Swal.fire({
						  icon: 'warning',
						  title: 'PERHATIAN',
						  text: 'PILIH TAHUN TERLEBIH DAHULU',
						});
        	}else if(kec == '') {
        		Swal.fire({
						  icon: 'warning',
						  title: 'PERHATIAN',
						  text: 'PILIH KECAMATAN TERLEBIH DAHULU',
						});
        	}else{
        	
				$("#treeview-mdbootstrap").html(
					'<div id="loading-spinner" style="display:block; text-align:center; margin:10px;">'
						+ '<img src="<?php echo base_url('assets/img/loading.gif'); ?>" alt="Loading" height="135" width="135"><br>'
						+ '<span style="font-size:16px; color:#00809D;">Loading data...</span>'
					+ '</div>'
				);


				$.ajax({
					url: '<?php echo base_url('rekap-op-prev'); ?>',
					type: 'POST',
					data: {
						tahun: tahun,
						kec: kec,
						nmkec: nmkec
					},
					success: function(data){
						$("#treeview-mdbootstrap").html(data);
					},
					error: function(xhr, status, error) {
						console.error("AJAX Error:", status, error);

						
						$("#treeview-mdbootstrap").html(`
							<div style="margin-top:50px;">
								<div class="alert alert-danger alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<center><b>Peringatan!</b> Terjadi kesalahan saat mengambil data</center>
								</div>
							</div>
						`);



						// <p style='color:red;'>Terjadi kesalahan saat mengambil data.</p>
					}
				});


        	}

		  });
		  
		  

        $(document).on("click", ".tombol-print", function() {
			const tahun 		= document.getElementById('tahun').value;
			const kec 			= document.getElementById('kecamatan').value;
			const nmkec 			= document.getElementById('nm_kecamatan').value;
			const id 			= $(this).attr("id");
        	
        	if (tahun == '') {
        		Swal.fire({
						  icon: 'warning',
						  title: 'PERHATIAN',
						  text: 'PILIH TAHUN TERLEBIH DAHULU',
						});
        	}else if(kec == '') {
        		Swal.fire({
						  icon: 'warning',
						  title: 'PERHATIAN',
						  text: 'PILIH KECAMATAN TERLEBIH DAHULU',
						});
        	}else{
			  	if (id == 'print-pdf') {
			  		window.open('<?php echo base_url('rekap-op-pdf'); ?>/'+tahun+'/'+kec+'/'+nmkec+'/pdf', '_blank');	
			  	}else{
					window.open('<?php echo base_url('rekap-op-excel'); ?>/'+tahun+'/'+kec+'/'+nmkec+'/excel', '_blank');
			  	}
        	}

		  });

    });

</script> 

