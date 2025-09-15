

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
		<h3 class="panel-title"><i class="fa fa-list-alt"></i> FORM TAMBAH APIP</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form class="form-horizontal" id="form-apip">
				<button type="button" class="collapsible-form active-form"><label>INPUT APIP</label></button>
				<div class="content-form" style="display:block;">
				  	<div class="row">
						<div class="col-md-12">
	
							<div class="form-group">
								<label for="mobile_no" class="col-sm-2 control-label input-sm">Tahun</label>

								<div class="col-sm-4">
									 <div class="input-group">
									  <div class="input-group-addon"><i class="lnr lnr-calendar-full"></i></div>
									  <input type="text" class="form-control" placeholder="Tahun" readonly="" id="tahun" name="tahun" value="<?= date('Y'); ?>">
									</div>
								</div>
								
							</div>	
						
							<div class="form-group">

								<label class="col-sm-2 control-label input-sm" id="label-tipe">APIP</label>

								<div class="col-sm-4">
									<select name="instansi" id="instansi" class="form-control input-sm" style="width:100%">
										<option value="">Pilih Instansi</option>
										<?php foreach($instansi as $row): ?>
											<option value="<?= $row->kd_apip; ?>"><?=$row->kd_apip; ?> | <?=$row->nm_apip; ?></option>
										<?php endforeach; ?>

									</select>
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
			<button type="button" data-aksi="simpan" class="btn btn-success btn-lg simpan-apip"><i class="fa fa-check-square"></i> SIMPAN</button>
			<button type="button"  data-aksi="new" class="btn btn-primary btn-lg confirm hidden"><i class="fa fa-plus"></i> confirm</button>
		</center>
		</form>
	</div>
</div>  



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
	});
	</script>


<script>
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

	});


$(document).on("click", ".simpan-apip", function(e) {
	var data = $('#form-apip').serialize();

	var satker = $('#satker').val();
	

	if (satker == '') {
		Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA SATUAN KERJA BELUM DI PILIH',showConfirmButton: false,timer: 2000});
		exit();
	}

	

	var aksi = $(this).attr('data-aksi');
	$.blockUI({ message: '<img width="100px" src="<?=base_url(); ?>assets/img/loading.gif"><br/> Proses Simpan Data' });
	$.ajax({
		method: 'POST',
		url: '<?php echo base_url('kapip-dataumum-profil-apip/insert'); ?>',
		data: data
	})
	.done(function(data) {
		var out = jQuery.parseJSON(data);

		if (aksi == 'simpan') {
			$.unblockUI();
			//$('#modalKonfirmasi').modal('show');
			e.preventDefault();
		}else{
			// clear_form_temuan();
		}
		
		if(out.pesan==2){
			pesan="Data Sudah Ada!";
			xicon="warning";
			
		}else if(out.pesan==1){
			pesan="Data Berhasil Ditambahkan!";
			xicon="success";
			
		}else{
			pesan='Gagal Simpan';
			xicon="error";
			
		}		
		
		Swal.fire({
				position: 'top-end',
				icon: xicon,
				title: pesan,
				showConfirmButton: false,
				timer: 2000
			});
	})

	e.preventDefault();
});



function deleteRow(btn) {
	var row = btn.parentNode.parentNode;
	row.parentNode.removeChild(row);
}
</script>    

