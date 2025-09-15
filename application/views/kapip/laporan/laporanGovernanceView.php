


<div class="panel panel-headline panel-primary" style="min-height:500px;">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-file-o"></i> Tren Perbaikan Governance </h3>
	</div>

	<div class="panel-body">
		
		<div style="display:block;">
				  	<div class="row">
						
						<div class="col-md-8">	
							<div class="form-group">
								<div class="col-sm-2">
									<label class="col-sm-2 control-label input-sm" id="label-tipe">APIP</label>
								</div>
								<div class="col-sm-10">
									<select name="instansi" id="instansi" class="form-control input-sm" style="width:100%">
										<option value="">Pilih Instansi</option>
										<?php foreach($instansi as $row): ?>
											<option value="<?= $row->kd_apip; ?>"><?=$row->kd_apip; ?> | <?=$row->nm_apip; ?></option>
										<?php endforeach; ?>

									</select>
								</div>
							</div>
						</div>						
						
						
						<div class="col-md-8">
	
							<div class="form-group">
								<div class="col-sm-2">
									<label for="mobile_no" class="col-sm-2 control-label input-sm">Tahun</label>
								</div>
								<div class="col-sm-10">
									 <div class="input-group" style="width:80px" >
									  <div class="input-group-addon" ><i class="lnr lnr-calendar-full"></i></div>
									  <input type="text" style="width:80px" class="form-control" placeholder="Tahun" readonly="" id="ctahun" name="ctahun" value="<?= $this->session->userdata('year_selected'); ?>">
									</div>
								</div>
								
							</div>	
						</div>	
					
<!--
						<div class="col-md-8">	
							<div class="form-group">
								<div class="col-sm-2">
									<label class="col-sm-2 control-label input-sm" id="label-tipe">Triwulan</label>
								</div>
								<div class="col-sm-10" style="width:150px">
									<select name="ctriw" id="ctriw" class="form-control input-sm">
										<option value="0" ></option>
										<option value="1" >Triwulan I</option>
										<option value="2" >Triwulan II</option>
										<option value="3" >Triwulan III</option>
										<option value="4" >Triwulan IV</option>
									  </select><br><br>
								</div>
							</div>
						</div>						
	-->					
					</div><br><br>
					
					<div class="row">
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

					<!--  -->
					<div id="treeview-mdbootstrap">
						<div class="alert alert-warning alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  <center><b>Peringatan!</b> Isi data filter yang lengkap!</center>
						</div>
					</div>
					

					<!--  -->

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
					// Treeview Initialization
			$(document).ready(function() {
			  $('.treeview-animated').mdbTreeview();
			});

		});
		
	var table;
    $(document).ready(function() {

        function reload_table () {
        	table.ajax.reload( null, false ); // user paging is not reset on reload
        }
		

        $(document).on("click", "#search", function() {
        	var cinstansi 		= $('#instansi').val();
        	var ctahun 			= $('#ctahun').val();
			var ctipe			= 'priv';
			
			if (cinstansi == '') {
        		Swal.fire({
						  icon: 'warning',
						  title: 'PERHATIAN',
						  text: 'PILIH INSTANSI TERLEBIH DAHULU',
						});
        	}else{
        		
        		$("#treeview-mdbootstrap").html('<center><img src="<?php echo base_url('assets/img/loading.gif'); ?>" alt="Loading" height="42" width="42"></center>');
			  	$.ajax({
					  url: '<?php echo base_url('kapip-laptri-governance-prev'); ?>',
					  type: 'POST',
					   data:{cinstansi:cinstansi,ctahun:ctahun},
					  success: function(data){
					  	$("#treeview-mdbootstrap").html(data);
					  }
				  });
        	}

		  });
		  
		  

        $(document).on("click", ".tombol-print", function() {
			var id 			= $(this).attr("id");
        	var cinstansi 		= $('#instansi').val();  
        	var ctriw 			= $('#ctriw').val();
        	var ctahun 			= $('#ctahun').val();

        	
        	if (cinstansi == '') {
        		Swal.fire({
						  icon: 'warning',
						  title: 'PERINGATAN!',
						  text: 'APIP TIDAK BOLEH KOSONG',
						});
        	}else if(ctriw==0){
				Swal.fire({
						  icon: 'warning',
						  title: 'PERHATIAN',
						  text: 'PILIH TRIWULAN TERLEBIH DAHULU',
						});
			}else{
			  	if (id == 'print-pdf') {
			  		window.open('<?php echo base_url('kapip-laptri-governance-pdf'); ?>/'+ctahun+'/'+cinstansi+'/pdf', '_blank');	
			  	}else{
					window.open('<?php echo base_url('kapip-laptri-governance-excel'); ?>/'+ctahun+'/'+cinstansi+'/excel', '_blank');
			  	}
        	}

		  });

    });

</script> 

