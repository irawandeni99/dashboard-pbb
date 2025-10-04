
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


.buttondelete {
  background-color: white; 
  color: black; 
  border: 2px solid #f44336;
}

.buttondelete:hover {
  background-color: #f44336;
  color: white;
}

</style>
<div class="panel panel-headline  panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-list-alt"></i> FORM EDIT GROUP USER</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form class="form-horizontal" id="form-group">
				<button type="button" class="collapsible-form active-form"><label>EDIT GROUP USER</label></button>
				<div class="content-form" style="display:block;">
				  	<div class="row">
						<div class="col-md-12">
	
							<div class="form-group">
								<label  class="col-sm-2 control-label input-sm">KODE GROUP</label>

								<div class="col-sm-4"> 
									  <input type="text" readonly name="id_group" value="<?= $ckode; ?>" style="width:60px"; class="form-control input-sm" id="id_group" placeholder="">
									
								</div>	
							</div>	
						
							<div class="form-group">

								<label class="col-sm-2 control-label input-sm" id="label-tipe">NAMA GROUP</label>

								<div class="col-sm-4">
									  <input type="text" name="nm_group"  value="<?= $cnama; ?>" class="form-control input-sm" id="nm_group" placeholder="">
								</div>

						</div>
					</div>
				</div>
				
				

			</div>
		</div>
	</div>
	<div class="panel-footer">
		<center>
			<a href="<?= base_url($this->dynamic_menu->EncryptLink('master-group'));?>" class="btn btn-danger btn-lg"><i class="fa fa-arrow-circle-left"></i> KEMBALI</a>
			<button type="button" data-aksi="simpan" class="btn btn-success btn-lg update-group"><i class="fa fa-check-square"></i> UPDATE</button>
			<button type="button" data-aksi="simpan" class="btn btn-light btn-lg hapus-group"><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> HAPUS</button>
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


$(document).on("click", ".update-group", function(e) {
	var data = $('#form-group').serialize();

	var nm_group = $('#nm_group').val();
	

	if (nm_group == '') {
		Swal.fire({position: 'top-center',icon: 'warning',title: 'Nama Group User Tidak boleh Kosong',showConfirmButton: false,timer: 2000});
		exit();
	}

	

	var aksi = $(this).attr('data-aksi');
	$.blockUI({ message: '<img width="100px" src="<?=base_url(); ?>assets/img/loading.gif"><br/> Proses Simpan Data' });
	$.ajax({
		method: 'POST',
		url: '<?php echo base_url('master-group/update'); ?>',
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
		
		if(out.pesan==1){
			pesan="Data Berhasil DiUpdate!";
			xicon="success";
			
		}else{
			pesan='Gagal Update Data';
			xicon="error";
			
		}		
		
		Swal.fire({
				position: 'top-center',
				icon: xicon,
				title: pesan,
				showConfirmButton: false,
				timer: 2000
			});
			
			window.location.href = "<?= base_url([EncryptLink('master-group')]); ?>";	
	})

	e.preventDefault();
});






$(document).on("click", ".hapus-group", function(e) {
	var data = $('#form-group').serialize();

	var cid_group = $('#id_group').val();
	var cnm_group = $('#nm_group').val();
	
	Swal.fire({
              title: 'Apakah anda yakin?',
              text: "Menghapus Data "+cnm_group+"..?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#074979',
              cancelButtonColor: '#d33',
              cancelButtonText: 'Batal',
              confirmButtonText: 'Ya, Hapus Data.'
            }).then((result) => {
              if (result.value) {			
			
	

				
	

			var urll = '<?php echo base_url(); ?>master-group/hapus';
				$.ajax({url:urll,
					type: 'POST',
					data: ({cid_group}),
					dataType: "json",
				
					success: function(data) {
	
						if(data==0){
							pesan="Data Gagal Hapus";
								Swal.fire({
								  position: 'top-center',
								  icon: 'error',
								  title: pesan,
								  showConfirmButton: false,
								  timer: 2000
								});
							}else{
							
							pesan="File Berhasil Di Hapus";

							Swal.fire({
							  position: 'top-center',
							  icon: 'success',
							  title: pesan,
							  showConfirmButton: false,
							  timer: 2000
							});							
								$.ajax({  
								  url: '<?php echo base_url(EncryptLink('master-group')); ?>',
								  type: 'POST',
								  success: function(data){
									$("#data-elemen-1").html(data);
								  }
								});	
							
							window.location.href = "<?= base_url([EncryptLink('master-group')]); ?>";	
						
						}
					 }
					 
					}); 
			   }
            })	
	


	e.preventDefault();
});






</script>    

