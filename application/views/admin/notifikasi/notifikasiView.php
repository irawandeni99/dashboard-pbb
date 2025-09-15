

<div class="panel panel-headline panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"> <i class="fa fa-laptop"></i> NOTIFIKASI</h3>
	</div>
	<div class="panel-body" hidden>
		<div class="row">
			<div class="col-md-12">
			<div class="box-body my-form-body">
			




			<?php if(isset($msg) || validation_errors() !== ''): ?>
				  <div class="alert alert-warning alert-dismissible">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					  <h4><i class="icon fa fa-warning"></i> Alert!</h4>
					  <?= validation_errors();?>
					  <?= isset($msg)? $msg: ''; ?>
				  </div>
				<?php endif; ?>
			   
				<?php echo form_open('#', 'class="form-horizontal" id="form-input"');  ?> 

					  <div class="form-group row">
						<label for="provinsi" class="col-sm-2 control-label input-sm" id="lbllokasi">Uraian</label>
						<div class="col-sm-2">
						  <input type="text" name="id_daerah" class="form-control input-sm" id="id_daerah" placeholder="" value="<?= $max_id; ?>" readonly required
						  oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
						</div>
					  </div>

					   <div class="form-group row">
						<label for="nm_daerah" class="col-sm-2 control-label input-sm">Nama *</label>
						<div class="col-sm-9">
						  <input type="text" name="nm_daerah" class="form-control input-sm" id="nm_daerah" placeholder="" value="<?= $ket; ?>" required
						  oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
						</div>
					  </div>
					  <div class="form-group">
							<label for="prov" class="col-sm-2 control-label input-sm">Keterangan *</label>
							<div class="col-sm-3">
							  <select name="level" id="level" class="form-control input-sm">
								<option value="UKE-1">UKE-1</option>
								<option value="SATKER">SATKER</option>
							  </select>
							</div>
						</div>
						<div class="form-group" id="level-2" hidden >
							<label for="prov" class="col-sm-2 control-label input-sm">UKE 1 *</label>
							<div class="col-sm-3">
							  <select name="header" id="header" class="form-control input-sm" style="width:100%;">
								
							  </select>
							</div>
						</div>
				  <div class="form-group row">
				  	<div class="col-md-2 control-label"></div>
					<div class="col-md-9">
						<div class="pull-right">

							<input type="button" name="tambah" value="Tambah" id="tambah" class="btn btn-primary btn-lg">
							<input type="submit" name="submit" value="Simpan" id="simpan" class="btn btn-success btn-lg hidden">
					  		<input type="button" name="cetak" value="Cetak" id="cetak" class="btn btn-warning btn-lg hidden">
					  		<input type="button" name="batal" value="Batal" id="batal" class="btn btn-danger btn-lg hidden">
						</div>
					</div>
				  </div>
				<?php echo form_close( ); ?>
				
				
				
			  </div>
		</div>
    </div>
</div>  
	<div class="panel-footer" style="min-height:450px;">
		<div class="row">
			
			<div class="col-md-12">
				<table id="table-notif" class="table table-condensed table-striped table-hover" style="width:100%">
				<thead hidden>
					<tr class="rowBlue">
					 
						<th style="text-align:center;">No</th>
						<th style="text-align:center;">Uraian</th>
						<th style="text-align:center;">view</th>
                                             
					</tr>
				</thead>
				
				 <tbody id="data-notif">
                                                    
                   </tbody>
				
				</table>
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
        $("#data-notif").html("<tr><td colspan='2' style='text-align:center;'>Harap Tunggu...</td></tr>");
       // var skpd = '<?= $kode;?>';
        $.ajax({
              url: "<?php echo site_url('notifikasi/get2')?>",
              type: 'POST',
              success: function(data){
                $("#data-notif").html(data);
				$('#table-notif').DataTable();
               
              }
          });
          
    });




	var table;
    $(document).ready(function() {
 
        function reload_table () {
        	table.ajax.reload( null, false ); // user paging is not reset on reload
        }


		
        setInterval( function () {
		    table.ajax.reload( null, false ); // user paging is not reset on reload
		}, 30000 );

        

        function clear_form(){
			$('#id_daerah').val('');
         	$('#nm_daerah').val('');
		}

		$("#level").change(function(){
			var level=$(this).val();
			if (level == "SATKER") {
				$('#level-2').removeAttr('hidden');
			}else{
				$('#level-2').attr('hidden',true);
			}
		});

        $(document).on("click", "#tambah", function() {
        	clear_form();
        	$.ajax({
			  url: '<?php echo base_url('data-objek-pengawasan/getmax'); ?>',
			  data:{kode:'',lvl:'1'},
			  type: 'POST',
			  	success: function(data){
	  		  		document.getElementById('id_daerah').value =data.trim();
				}
			})
        	$("#form-input").attr("action", "<?php echo base_url('data-objek-pengawasan/add'); ?>");
        	$('#tambah').attr('class','hidden');
        	$('#cetak').attr('class','hidden');
        	$('#simpan').removeAttr('class','hidden');
        	$('#simpan').attr('class','btn btn-success btn-lg');
        	$('#batal').removeAttr('class','hidden');
        	$('#batal').attr('class','btn btn-danger btn-lg');

		  });

        $(document).on("click", "#batal", function() {
        	clear_form();
        	$('#batal').attr('class','hidden');
        	$('#simpan').attr('class','hidden');
        	// $('#cetak').removeAttr('class','hidden');
        	// $('#cetak').attr('class','btn btn-warning btn-lg');
        	$('#tambah').removeAttr('class','hidden');
        	$('#tambah').attr('class','btn btn-primary btn-lg');
		  });

		  
         $(document).on("click", ".edit", function() {
         	clear_form();
         	var id 		= $(this).attr("data-id");
         	var nama 	= $(this).attr("data-nama");
         	$("#form-input").attr("action", "<?php echo base_url('data-objek-pengawasan/edit/'); ?>"+id);
         	$('#id_daerah').val(id);
         	$('#nm_daerah').val(nama);
         	$('#tambah').attr('class','hidden');
        	$('#cetak').attr('class','hidden');
        	$('#simpan').removeAttr('class','hidden');
        	$('#simpan').attr('class','btn btn-success btn-lg');
        	$('#simpan').removeAttr('aksi');
        	$('#simpan').attr('aksi','edit');
        	$('#batal').removeAttr('class','hidden');
        	$('#batal').attr('class','btn btn-danger btn-lg');
		  });

         $(document).on("click", ".preview", function() {
         	var id 		= $(this).attr("data-id");
         	var nama 	= $(this).attr("data-nama");
         	window.open("<?= base_url('manual-book/preview').'?prev='; ?>"+id+"&file="+nama, "_blank");
		  });


    });
	

function update_view(dd){
	
	$.ajax({
			type: 'POST',
			data: ({cid:dd}),
			dataType: "json",
			url: "<?php echo base_url(); ?>notifikasi/update",
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
			 
				
			}
	});
	
	
}



	

</script> 
<script type="text/javascript">

	$(document).on("click", ".tombol-hapus", function() {
		var id 		= $(this).attr("data-id");
        var nama 	= $(this).attr("data-nama");
        Swal.fire({
		  title: 'Apakah anda yakin?',
		  text: "Menghapus data ("+id+") "+nama,
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#074979',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'Batal',
		  confirmButtonText: 'Ya, Hapus Data Ini.'
		}).then((result) => {
		  if (result.value) {
		    document.location.href = "<?= base_url('data-objek-pengawasan/del/'); ?>"+id;
		  }
		})

	});

</script>
