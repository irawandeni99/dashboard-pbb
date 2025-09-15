


<div class="panel panel-headline panel-primary" style="min-height:500px;">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-file-o"></i>  Anggaran dan Realisasi Keuangan APIP </h3>
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
						
					</div>
					
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

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <?php if(isset($msg) || validation_errors() !== ''): ?>
				  <div class="alert alert-warning alert-dismissible">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					  <h4><i class="icon fa fa-warning"></i> Alert!</h4>
					  <?= validation_errors();?>
					  <?= isset($msg)? $msg: ''; ?>
				  </div>
				<?php endif; ?>
			   
				<!-- <?php echo form_open('#', 'class="form-horizontal" id="form-input"');  ?>  -->
				<form class="form-horizontal" id="form-input">
					  <div class="row">
						<label style="text-align:left;font-size:13pt;" class="col-sm-8 col-xs-6">Nama Parameter</label>
						<label style="text-align:center;font-size:13pt;" class="col-sm-2 col-xs-3">Nilai</label>
						<label style="text-align:center;font-size:13pt;" class="col-sm-2 col-xs-3">Bobot (%)</label>
					  </div>
						<div style="border-top:2px solid #f8a406;padding:5px 5px 10px 5px;"></div>

					  <div class="form-group row" id="form-header">
						<label class="col-sm-2 col-xs-2" id="kode" style="text-align:left;"></label>
						<label class="col-sm-6 col-xs-6" id="parameter" style="text-align:left;"></label>
						<div class="col-sm-2 col-xs-3">
							<center>
							  	<select name="nilai" id="nilai" class="form-control input-sm">
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
								 </select>
							</center>
							 <input type="text" name="id_parameter" class="form-control input-sm hidden" id="id_parameter" placeholder="" value="" readonly>
							 <input type="text" name="tahun" class="form-control input-sm hidden" id="tahun" placeholder="" value="" readonly>
							 <input type="text" name="id_daerah" class="form-control input-sm hidden" id="id_daerah" placeholder="" value="" readonly>
						</div>
						<label class="col-sm-2 col-xs-3" id="bobot" style="text-align:center;"></label>
					  </div>
					  <!-- </div>
					  <div class="modal-footer"> -->
					  <div style="border-top:2px solid #f8a406;padding:5px 5px 10px 5px;"></div>
				  <div class="form-group row">
				  	<div class="col-md-4 control-label"></div>
					<div class="col-md-8">
						<div class="pull-right">
							<input type="button" name="tambah" value="Tambah" id="tambah" class="btn btn-primary btn-lg">
							<input type="submit" name="submit" value="Simpan" id="simpan" class="btn btn-success btn-lg hidden">
					  		<input type="button" name="cetak" value="Cetak" id="cetak" class="btn btn-danger btn-lg">
					  		<input type="button" name="batal" value="Batal" id="batal" class="btn btn-danger btn-lg hidden" data-dismiss="modal">
						</div>
					</div>
				  </div>
			</form>
				
      </div>

    </div>
  </div>
</div>

<!-- Modal 2 -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModal2Label">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModal2Label">Modal title</h4>
      </div>
      <div class="modal-body">

				<!-- <?php echo form_open('#', 'class="form-horizontal" id="form-input"');  ?>  -->
				<form class="form-horizontal" id="form-input">
					  <div class="row">
						<label style="text-align:left;font-size:13pt;" class="col-sm-8 col-xs-6">Nama Parameter</label>
						<label style="text-align:center;font-size:13pt;" class="col-sm-2 col-xs-3">Nilai</label>
						<label style="text-align:center;font-size:13pt;" class="col-sm-2 col-xs-3">Bobot (%)</label>
					  </div>
						<div style="border-top:2px solid #f8a406;padding:5px 5px 10px 5px;"></div>

					  <div class="form-group row" id="form-header">
						<label class="col-sm-2 col-xs-2" id="kode" style="text-align:left;"></label>
						<label class="col-sm-6 col-xs-6" id="parameter" style="text-align:left;"></label>
						<div class="col-sm-2 col-xs-3">
							<center>
							  	<select name="nilai" id="nilai" class="form-control input-sm">
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
								 </select>
							</center>
							 <input type="text" name="id_parameter" class="form-control input-sm hidden" id="id_parameter" placeholder="" value="" readonly>
							 <input type="text" name="tahun" class="form-control input-sm hidden" id="tahun" placeholder="" value="" readonly>
							 <input type="text" name="id_daerah" class="form-control input-sm hidden" id="id_daerah" placeholder="" value="" readonly>
						</div>
						<label class="col-sm-2 col-xs-3" id="bobot" style="text-align:center;"></label>
					  </div>
					  <!-- </div>
					  <div class="modal-footer"> -->
					  <div style="border-top:2px solid #f8a406;padding:5px 5px 10px 5px;"></div>
				  <div class="form-group row">
				  	<div class="col-md-4 control-label"></div>
					<div class="col-md-8">
						<div class="pull-right">
							<input type="button" name="tambah" value="Tambah" id="tambah" class="btn btn-primary btn-lg">
							<input type="submit" name="submit" value="Simpan" id="simpan" class="btn btn-success btn-lg hidden">
					  		<input type="button" name="cetak" value="Cetak" id="cetak" class="btn btn-danger btn-lg">
					  		<input type="button" name="batal" value="Batal" id="batal" class="btn btn-danger btn-lg hidden" data-dismiss="modal">
						</div>
					</div>
				  </div>
			</form>
				
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
		  	
			var kabupaten = "<?php  echo $this->session->userdata('id_kab'); ?>";
			if (kabupaten == 1 || kabupaten == '') {
				
			}else{
				$('.user-akses').attr('hidden','');
			}
		  	$.ajax({
				  url: '<?php echo base_url('informasi-keuangan-daerah/get_tree_mdb'); ?>',
				  type: 'POST',
				  data:{kab:kabupaten},
				  success: function(data){
				  	// $("#treeview-mdbootstrap").html('');
				  }
			  });

		  	var kode = 1;
		  	$.ajax({
				  url: '<?php echo base_url('data-user/getprov'); ?>',
				  data:{kode:kode},
				  type: 'POST',
				  success: function(data){
				  	$("#prov").html(data);
				  }
			  })

		  	$.ajax({
				  url: '<?php echo base_url('combo-skpd-sipd'); ?>',
				  data:{kode:kode},
				  type: 'POST',
				  success: function(data){
				  	$("#skpd").html(data);
				  }
			  })
		});
	var table;
    $(document).ready(function() {
    	$('#form-input').submit(function(e) {
		    var data = $(this).serialize();
		    $.ajax({
		      method: 'POST',
		      url: '<?php echo base_url('informasi-keuangan-daerah/edit'); ?>',
		      data: data
		    })
		    .done(function(data) {
		      var out = jQuery.parseJSON(data);

		    	$('#myModal').modal('hide');
		    	$("#treeview-mdbootstrap").html(out.table);
		    	Swal.fire({
				  position: 'top-end',
				  icon: 'success',
				  title: out.pesan,
				  showConfirmButton: false,
				  timer: 2000
				});
		    })
		    
		    e.preventDefault();
		  });

    	
  

        function reload_table () {
        	table.ajax.reload( null, false ); // user paging is not reset on reload
        }
		
	/* 	function clear_form(){
			$('#id_parameter').val('');
         	$('#nm_parameter').val('');
         	$('#hd_parameter').val('');
         	$('#clevel').val('');
         	$('#hd').val('');
         	$('#ket').val('');
		} */
		
     /*     $(document).on("click", ".showModal", function() {

         	
         	var thn 		= $(this).attr("data-thn");
         	var id_par 		= $(this).attr("data-id");
         	var nm_par 		= $(this).attr("data-nama");
         	var nilai 		= $(this).attr("data-nilai");
         	var bobot 		= $(this).attr("data-bobot");
         	var daerah 		= $(this).attr("data-daerah");
         	var daerah 		= $(this).attr("data-daerah");
         	clear_form();

         	$('#parameter').html(nm_par);
         	$('#kode').html(id_par);
         	// $('#bobot').html(bobot);
         	$('#id_parameter').val(id_par);
         	$('#nilai').val(Math.round(nilai));
         	$('#nilai').select2().trigger('change');
         	$('#tahun').val(thn);
         	$('#id_daerah').val(daerah);
         	var bobot;
			if (nilai == 2) {
				bobot = "<font color='green' size='4px'>100</font>";
			}else if (nilai == 1) {
				bobot = "<font color='#f8a406' size='4px'>50</font>";
			}else{
				bobot = "<font color='red' size='4px'>0</font>";
			}
			$('#bobot').html(bobot);
         	


     		$('#myModalLabel').html('Form Input Nilai Parameter');	
     		// $("#form-input").attr("action", "<?php echo base_url('informasi-keuangan-daerah/edit/'); ?>"+id_par+"/"+daerah+"/"+thn);
         	$('#tambah').attr('class','hidden');
        	$('#cetak').attr('class','hidden');
        	$('#simpan').removeAttr('class','hidden');
        	$('#simpan').attr('class','btn btn-success btn-lg');
        	$('#simpan').removeAttr('aksi');
        	$('#simpan').attr('aksi','edit');
        	$('#batal').removeAttr('class','hidden');
	        	$('#batal').attr('class','btn btn-danger btn-lg');
         	

         	
        	$('#myModal').modal('show');
		  }); */
		  

		/* $(document).on("click", ".showModal2", function() {

         	var thn 		= $(this).attr("data-thn");
         	var id_daerah 		= $(this).attr("data-daerah");
         	var url 		= $(this).attr("data-url");
         	var link = url+'/'+id_daerah+'-'+thn
        	window.location.assign("<?php echo base_url('"+link+"');?>");
		  }); */

		
/* 
        $(document).on("click", "#tambah", function() {
        	var thn = $("#tahun").val();
        	$.ajax({
			  url: '<?php echo base_url('informasi-keuangan-daerah/getmax'); ?>',
			  data:{kode:'',lvl:'H',thn:thn},
			  type: 'POST',
			  	success: function(data){
	  		  		document.getElementById('id_parameter').value =data.trim();
				}
			})
        	$("#form-input").attr("action", "<?php echo base_url('informasi-keuangan-daerah/add'); ?>");
        	$('#tambah').attr('class','hidden');
        	$('#cetak').attr('class','hidden');
        	$('#simpan').removeAttr('class','hidden');
        	$('#simpan').attr('class','btn btn-success btn-lg');
        	$('#batal').removeAttr('class','hidden');
        	$('#batal').attr('class','btn btn-danger btn-lg');

		  });
 */

        $(document).on("click", "#search", function() {
        	var cinstansi 		= $('#instansi').val();  
        	var ctriw 			= $('#ctriw').val();
        	var ctahun 			= $('#ctahun').val();
			var ctipe			= 'priv';
			
			if (cinstansi == '') {
        		Swal.fire({
						  icon: 'warning',
						  title: 'PERHATIAN',
						  text: 'PILIH INSTANSI TERLEBIH DAHULU',
						});
        	}else if(ctriw==0){
				Swal.fire({
						  icon: 'warning',
						  title: 'PERHATIAN',
						  text: 'PILIH TRIWULAN TERLEBIH DAHULU',
						});
			}else{
        		
        		$("#treeview-mdbootstrap").html('<center><img src="<?php echo base_url('assets/img/loading.gif'); ?>" alt="Loading" height="42" width="42"></center>');
			  	$.ajax({
					  url: '<?php echo base_url('kapip-laptri-angreal-prev'); ?>',
					  type: 'POST',
					   data:{cinstansi:cinstansi,ctriw:ctriw,ctahun:ctahun},
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
			  		window.open('<?php echo base_url('kapip-laptri-angreal-pdf'); ?>/'+ctahun+'/'+cinstansi+'/'+ctriw+'/pdf', '_blank');	
			  	}else{
					window.open('<?php echo base_url('kapip-laptri-angreal-excel'); ?>/'+ctahun+'/'+cinstansi+'/'+ctriw+'/excel', '_blank');
			  	}
        	}

		  });

    });

</script> 

