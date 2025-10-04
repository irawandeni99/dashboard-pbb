
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

<div class="panel panel-headline panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list-alt"></i> FORM EDIT KECAMATAN</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" id="form-kecamatan" method="post" enctype="multipart/form-data">
            <button type="button" class="collapsible-form active-form">
                <label>EDIT KECAMATAN</label>
            </button>
            <div class="content-form" style="display:block;">

                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-8">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label col-form-label-sm">Kode Kecamatan</label>
                            <div class="col-sm-6">
                                <input type="text" name="kd_kecamatan"
                                    value="<?= $cdata->kd_kecamatan ?? '' ?>" 
                                    class="form-control form-control-sm" 
                                    id="kd_kecamatan" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label col-form-label-sm">Nama Kecamatan</label>
                            <div class="col-sm-6">
                                <input type="text" name="nm_kecamatan"
                                    value="<?= $cdata->nm_kecamatan ?? '' ?>" 
                                    class="form-control form-control-sm"
                                    id="nm_kecamatan" 
                                    placeholder="Masukkan nama kecamatan">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label col-form-label-sm">Telp</label>
                            <div class="col-sm-6">
                                <input type="text" name="telp"
                                    value="<?= $cdata->telp ?? '' ?>" 
                                    class="form-control form-control-sm"
                                    id="telp" 
                                    placeholder="Masukkan nomor telepon">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label col-form-label-sm">Alamat</label>
                            <div class="col-sm-6">
                                <textarea name="alamat" 
                                    class="form-control form-control-sm"
                                    id="alamat"
                                    rows="3"
                                    placeholder="Masukkan alamat lengkap"><?= $cdata->alamat ?? '' ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan Upload Foto -->
                    <div class="col-md-4 text-center">
                        <div class="form-group">
                            <label for="foto" class="d-block mb-2">Foto Kantor</label>
                            <div class="mb-2">
                                    <?php if (!empty($cdata->foto)): ?>
                                        <img  id="previewFoto"  src="data:image/jpeg;base64,<?= $cdata->foto ?>" 
                                            alt="Foto Kecamatan" 
                                            class="img-thumbnail" 
                                            style="width:350px; height:250px; object-fit:cover; border-radius:8px;">
                                    <?php else: ?>
                                        <img  id="previewFoto"  src="<?= base_url('assets/img/no-image.png') ?>" 
                                            alt="No Image" 
                                            class="img-thumbnail" 
                                            style="width:350px; height:250px; object-fit:cover; border-radius:8px;">
                                           
                                    <?php endif; ?> 
                                     <!-- style="width:350px; height:250px; object-fit:cover;"> -->

                            </div>
                            <input type="file" name="foto" id="foto"
                                class="form-control-file form-control-sm"
                                accept="image/*"
                                onchange="previewImage(event)">
                        </div>
                    </div>
                </div>

            </div>
    </div>

    <div class="panel-footer">
        <center>
            <a href="<?= base_url($this->dynamic_menu->EncryptLink('kecamatan'));?>" 
               class="btn btn-danger btn-lg">
                <i class="fa fa-arrow-circle-left"></i> KEMBALI
            </a>
            <button type="submit" data-aksi="update" 
                class="btn btn-success btn-lg update-data">
                <i class="fa fa-check-square"></i> UPDATE
            </button>
        </center>
        </form>
    </div>
</div>



<script>
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('previewFoto');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
</script>

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


$(document).on("click", ".update-data", function(e) {
	var data = $('#form-kecamatan').serialize();

	var kd_kecamatan = $('#kd_kecamatan').val();
	var nm_kecamatan = $('#nm_kecamatan').val();
	var telp = $('#telp').val();
	var alamat = $('#alamat').val();
	var foto = $('#previewFoto').attr('src');
	if (foto.startsWith("data:image")) {
		foto = foto.split(',')[1]; 
	}
	

	if (kd_kecamatan == '') {
		Swal.fire({position: 'top-end',icon: 'warning',title: 'Kode Kecamatan Tidak boleh Kosong',showConfirmButton: false,timer: 2000});
		exit();
	}else if (nm_kecamatan == '') {
		Swal.fire({position: 'top-end',icon: 'warning',title: 'Nama Kecamatan Tidak boleh Kosong',showConfirmButton: false,timer: 2000});
		exit();
	}


	var aksi = $(this).attr('data-aksi');
	$.ajax({
			
    url: "<?= base_url('kecamatan-update'); ?>",
	type: 'POST',
	data: ({kd_kecamatan: kd_kecamatan,
			nm_kecamatan: nm_kecamatan,
			telp: telp,
			alamat: alamat,
			foto: foto 
	}),
	dataType: "json",
		success: function(data) {	
						if(data==0){
							pesan="Data Gagal Update";
								Swal.fire({
								  position: 'top-end',
								  icon: 'error',
								  title: pesan,
								  showConfirmButton: false,
								  timer: 2000
								});
							}else{
							
							pesan="File Berhasil Di Update";

							Swal.fire({
							  position: 'top-end',
							  icon: 'success',
							  title: pesan,
							  showConfirmButton: false,
							  timer: 2000
							});							
								
							window.location.href = "<?= base_url([EncryptLink('kecamatan')]); ?>";	

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

