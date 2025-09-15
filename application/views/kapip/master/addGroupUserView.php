

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
		<h3 class="panel-title"><i class="fa fa-list-alt"></i> FORM TAMBAH GROUP USER</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form class="form-horizontal" id="form-group">
				<button type="button" class="collapsible-form active-form"><label>TAMBAH GROUP USER</label></button>
				<div class="content-form" style="display:block;">
				  	<div class="row">
						<div class="col-md-12">
	
							<div class="form-group">
								<label  class="col-sm-2 control-label input-sm">KODE GROUP</label>

								<div class="col-sm-4"> 
									  <input type="text"  name="id_group" value="<?= $cnext; ?>" style="width:60px"; class="form-control input-sm" id="id_group" placeholder="">
									
								</div>	
							</div>	
						
							<div class="form-group">

								<label class="col-sm-2 control-label input-sm" id="label-tipe">NAMA GROUP</label>

								<div class="col-sm-4">
									  <input type="text" name="nm_group"  class="form-control input-sm" id="nm_group" placeholder="">
								</div>

						</div>
					</div>
				</div>
				
				

			</div>
		</div>
	</div>
	<div class="panel-footer">
		<center>
			<a href="<?= base_url($this->dynamic_menu->EncryptLink('kapip-master-group'));?>" class="btn btn-danger btn-lg"><i class="fa fa-arrow-circle-left"></i> KEMBALI</a>
			<button type="button" data-aksi="simpan" class="btn btn-success btn-lg simpan-group"><i class="fa fa-check-square"></i> SIMPAN</button>
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


$(document).on("click", ".simpan-group", function(e) {
	var data = $('#form-group').serialize();

	var cid_group = $('#id_group').val();
	var cnm_group = $('#nm_group').val();
	

	if (nm_group == '') {
		Swal.fire({position: 'top-end',icon: 'warning',title: 'Nama Group Tidak boleh Kosong',showConfirmButton: false,timer: 2000});
		exit();
	}

	

	var aksi = $(this).attr('data-aksi');
	$.ajax({
		
	url: '<?php echo base_url('kapip-master-group/insert'); ?>',
	type: 'POST',
	data: ({cid_group,cnm_group}),
	dataType: "json",
		success: function(data) {
	
						if(data==0){
							pesan="Data Gagal Simpan";
								Swal.fire({
								  position: 'top-end',
								  icon: 'error',
								  title: pesan,
								  showConfirmButton: false,
								  timer: 2000
								});
							}else{
							
							pesan="File Berhasil Di Simpan";

							Swal.fire({
							  position: 'top-end',
							  icon: 'success',
							  title: pesan,
							  showConfirmButton: false,
							  timer: 2000
							});							
								
							window.location.href = "<?= base_url([EncryptLink('kapip-master-group')]); ?>";	
							
						
						}
					 }
	
	});
		

	e.preventDefault();
});



function deleteRow(btn) {
	var row = btn.parentNode.parentNode;
	row.parentNode.removeChild(row);
}
</script>    

