

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
				<form class="form-horizontal" id="form-temuan">
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
			<button type="button" data-aksi="simpan" class="btn btn-success btn-lg simpan-temuan"><i class="fa fa-check-square"></i> SIMPAN</button>
			<button type="button"  data-aksi="new" class="btn btn-primary btn-lg confirm hidden"><i class="fa fa-plus"></i> confirm</button>
		</center>
		</form>
	</div>
</div>  

<!-- Modal -->
<div class="modal fade" id="modalTemuan" tabindex="-1" role="dialog" aria-labelledby="modalTemuanLabel">
	<div class="modal-dialog  modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="modalTemuanLabel">DAFTAR TEMUAN</h4>
			</div>
			<div class="modal-body" id="list_temuan">


				<!-- <?php echo form_close( ); ?> -->
			</div>
			<div class="modal-footer">
				<marquee width="100%" >INFO STATUS : 
					<i class="fa fa-file ic-w mr-1" style="color:lime;"></i> SESUAI -- 
					<i class="fa fa-file ic-w mr-1" style="color:yellow;"></i> BELUM SESUAI -- 
					<i class="fa fa-file ic-w mr-1" style="color:gray;"></i> BELUM DITINDAKLANJUTI -- 
					<i class="fa fa-file ic-w mr-1" style="color:red;"></i> TIDAK DAPAT DITINDAKLANJUTI 
				</marquee>
			</div>
<!--  <div class="modal-footer">
<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-primary">Save changes</button>
</div> -->
</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalKonfirmasi" tabindex="-1" role="dialog" aria-labelledby="modalKonfirmasiLabel">
	<div class="modal-dialog  modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="modalKonfirmasiLabel"><i class="fa fa-question-circle-o"></i> KONFIRMASI</h4>
			</div>
			<div class="modal-body">
				<center><img src="<?= base_url() ?>assets/img/kemendagri.png" style="width:64px; height:80px;"></center>
				<br>
				<div style="border-top:2px solid #f8a406;padding:5px 5px 10px 5px;"></div>
				<div class="btn-group btn-group-justified" role="group" aria-label="...">
					<a href="<?= base_url($this->dynamic_menu->EncryptLink('tlhp-bpk-lap-keu'));?>" class="btn btn-primary btn-md"><i class="fa fa-arrow-circle-left"></i> Ke Dashboard</a>
					<a href="<?= base_url('tlhp-bpk-lapkeu/add'); ?>" class="btn btn-primary btn-md"><i class="fa fa-plus"></i> LHP Baru</a>
					<!-- <a href="#" class="btn btn-default btn-lg " data-dismiss="modal" aria-label="Close"><i class="fa fa-hand-o-down"></i> Tetap di Halaman ini</a> -->
					<a href="#" class="btn btn-primary btn-md" onclick="clear_temuan();"><i class="fa fa-plus"></i> Temuan Baru </a>
					<a href="#" class="btn btn-primary btn-md tlanjut">Lanjut ke TLHP <i class="fa fa-arrow-circle-right"></i></a>
				</div>

				<!-- <?php echo form_close( ); ?> -->
			</div>
     <!--  <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
    </div> -->
</div>
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

<!--
	<script src="<?= base_url() ?>assets/js/jquery-3.3.1.js"></script>
	<script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	-->
	
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
	
	

	$("#nilai_temuan_satker").on("blur", function(){
		var dt1=$('#nilai_temuan').val();
		var dt2=$('#nilai_temuan_satker').val();
		var nilai1 =  parseFloat(dt1.replace(/,/g,''));
		var nilai2 =  parseFloat(dt2.replace(/,/g,''));

		if(nilai2 <= nilai1){
			$(this).val(dt2);
		}else{
			$(this).val('');
			Swal.fire({
				position: 'top-end',
				icon: 'error',
				title: 'Oops...',
				text: ' Nilai Temuan Satker Tidak Boleh Melebihi Nilai Temuan Kementerian!',
				showConfirmButton: false,
				timer: 3000
			});
		}
	});


	$(document).on("keyup", ".nilai_rekom", function() {
		// alert('coba');
		calculateTr_tem();

	});


	function calculateTr_tem(){
		$( '.nilai_rekom' ).mask('00,000,000,000.00', {reverse: true});
		$('.form_1').each(function () {
			var nilai_rekom = 0;
			$(".nilai_rekom").each(function(i){      
				nilai_rekom += parseFloat( $(this).val().replace(/\,/g,''));  


				var dt=$('#nilai_temuan_satker').val();
				var nilai_temuan =  parseFloat(dt.replace(/,/g,''));

				if(nilai_rekom > nilai_temuan){
					$('.nilai_rekom').val('');
					Swal.fire({
						position: 'top-end',
						icon: 'error',
						title: 'Oops...',
						text: ' Nilai Rekomendasi Tidak Boleh Melebihi Nilai Temuan satker!',
						showConfirmButton: false,
						timer: 4000
					});
					
				}
			});
				// console.log(nilai_rekom);

				// var dt=$('#nilai_temuan_satker').val();
				// var nilai_temuan =  parseFloat(dt.replace(/,/g,''));

				// if(nilai_rekom > nilai_temuan){
				// 	$('.nilai_rekom').val('');
				// 	Swal.fire({
				// 		position: 'top-end',
				// 		icon: 'error',
				// 		title: 'Oops...',
				// 		text: ' Nilai Rekomendasi Tidak Boleh Melebihi Nilai Temuan satker!',
				// 		showConfirmButton: false,
				// 		timer: 4000
				// 	});
					
				// }

		});

	}

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
  	// $.ajax({
		 //  url: '<?php echo base_url('pengawasan-teknis/get_tree'); ?>',
		 //  type: 'POST',
		 //  success: function(data){
		 //  	$("#tree_parameter").html(data);
		 //  }
	  // })

	 

	  var kabupaten = "<?php  echo $this->session->userdata('id_kab'); ?>";
	  if (kabupaten == 1 || kabupaten == '') {

	  }else{
	  	$('.user-akses').attr('hidden','');
	  }
	  $.ajax({
	  	url: '<?php echo base_url('pengawasan-teknis/get_tree_mdb'); ?>',
	  	type: 'POST',
	  	data:{kab:kabupaten},
	  	success: function(data){
	  		$("#treeview-mdbootstrap").html(data);
	  	}
	  });




	  var jns='R';
	  $.ajax({
	  	url: '<?php echo base_url('tlhp-bpk-lapkeu/getaspek'); ?>',
	  	data:{kode:jns},
	  	type: 'POST'
	  }).done(function(data2) {
	  	var out = jQuery.parseJSON(data2);
	  	$('#aspek').html(out.aspek);
	  })


	  var kode = 1;
	  $.ajax({
	  	url: '<?php echo base_url('data-user/getprov'); ?>',
	  	data:{kode:kode},
	  	type: 'POST',
	  	success: function(data){
		  	// $("#prov").html(data);
		  	$("#prov").html('');
		  }
		})
  	// $.ajax({
		 //  url: '<?php echo base_url('pengawasan-teknis/target'); ?>',
		 //  type: 'POST',
		 //  success: function(data){
		 //  	$(".showTarget").html(data);
		 //  }
	  // })

	  var tipe = $('input[name=tipe_daerah]:checked').val();
	  var daerah;
	  if (tipe == 'kab') {
	  	var kabupaten = document.getElementById('kab').value;
	  	daerah = kabupaten;
	  }else{
	  	var provinsi = document.getElementById('prov').value;
	  	daerah = provinsi;
	  }
	  $.ajax({
	  	url: '<?php echo base_url('pengawasan-teknis/target'); ?>',
	  	type: 'POST',
	  	data:{kode:daerah}
	  }).done(function(data2) {
	  	var out = jQuery.parseJSON(data2);

	  	$(".showTarget").html(out.btn);
	  	$("#nilai2").val(out.nilai);
	  	$("#id_daerah2").val(daerah);
	  })


	  
	  var jns='R';
	  $.ajax({
	  	url: '<?php echo base_url('tlhp-bpk-lapkeu/getaspek'); ?>',
	  	data:{kode:jns},
	  	type: 'POST'
	  }).done(function(data2) {
	  	var out = jQuery.parseJSON(data2);
	  	$('#aspek').html(out.aspek);
	  })

	});

$(document).on("click", ".confirm", function(e) {
	$('#modalKonfirmasi').modal('show');
})
$(document).on("click", ".simpan-temuan", function(e) {
	var data = $('#form-temuan').serialize();

	var aspek = $('#aspek').val();
	var jdl_temuan = $('#jdl_temuan').val();
	var nilai_temuan = $('#nilai_temuan').val();
	var satker = $('#satker').val();
	var tgl_lhp = $('#tgl_lhp').val();
	var no_lhp = $('#no_lhp').val();
	var pic = $('#pic').val();

	if (satker == '') {
		Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA SATUAN KERJA BELUM DI PILIH',showConfirmButton: false,timer: 2000});
		exit();
	}if (tgl_lhp == '') {
		Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA TANGGAL LHP BELUM DIISI',showConfirmButton: false,timer: 2000});
		exit();
	}if (no_lhp == '') {
		Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA NOMOR LHP BELUM DIISI',showConfirmButton: false,timer: 2000});
		exit();
	}if (pic == '') {
		Swal.fire({position: 'top-end',icon: 'warning',title: 'NAMA PIC BELUM DI ISI',showConfirmButton: false,timer: 2000});
		exit();
	}

	if (aspek == '') {
		Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA ASPEK/OBRIK BELUM DIPILIH',showConfirmButton: false,timer: 2000});
		exit();
	}
	if (jdl_temuan == '') {
		Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA JUDUL TEMUAN BELUM DIISI',showConfirmButton: false,timer: 2000});
		exit();
	}
	if (nilai_temuan == '') {
		Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA NILAI TEMUAN BELUM DIISI',showConfirmButton: false,timer: 2000});
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



$(document).on("click", "#daftar_temuan", function(e) {
	var noreg = $('#d_noreg').val();
	var no_lhp = $('#d_no_lhp').val();;

	var aksi = $(this).attr('data-aksi');
	$.ajax({
		method: 'POST',
		url: '<?php echo base_url('tlhp-kemendagri/get-modal-temuan'); ?>?noreg='+noreg+'&no_lhp='+no_lhp,
	})
	.done(function(data) {
		$('#list_temuan').html(data);
		$('#modalTemuan').modal('show');

	})

	e.preventDefault();
});

$(document).on("click", ".tes", function(e) {
	var check = $('.tipe_daerah').getAttribute("class"); 
	console.log(check);exit();

	var tipe = $('input[name=tipe_daerah]:checked').val();
	e.preventDefault();
});

$(document).on("click", ".tlanjut", function() {
	var thn = "<?php  echo $this->session->userdata('year_selected'); ?>";
	var satker = $('#satker').val();

	var noreg_form = thn+'-'+satker;
	// var noreg 		= $('#d_noreg').val(noreg_form);
	var no_lhp 		= $('#no_lhp').val();
	document.location.href = '<?php echo base_url('tlhp-bpk-lapkeu/tindak-lanjut'); ?>?noreg='+noreg_form+'&no_lhp='+no_lhp;

});

$(document).on("click", ".edit-halaman-ini", function() {
	var thn = "<?php  echo $this->session->userdata('year_selected'); ?>";
	var satker = $('#satker').val();

	var noreg_form = thn+'-'+satker;
	// var noreg 		= $('#d_noreg').val(noreg_form);
	var no_lhp 		= $('#no_lhp').val();
	document.location.href = '<?php echo base_url('tlhp-bpk-lapkeu/edit'); ?>?noreg='+noreg_form+'&lhp='+no_lhp;

});


function clear_form_lhp() {
	
	$('#ins_pemeriksa').val('');
	$('#ins_pemeriksa').select2().trigger('change');
	$('#prov').val('');
	$('#prov').select2().trigger('change');
	$('#kab').val('');
	$('#kab').select2().trigger('change');
	$('#pembahas_anev').val('');
	$('#pembahas_anev').select2().trigger('change');
	$('#pembahas_apip').val('');
	$('#pembahas_apip').select2().trigger('change');
	$('#pembahas_obrik').val('');
	$('#review').val('');
	$('#review').select2().trigger('change');
	$('#no_lhp').val('');
	$('#dalnis').val('');
	$('#dalnis').select2().trigger('change');

}

function clear_temuan() {
	
	$('#kd_temuan').val('');
	$('#halaman').val('');
	$('#jdl_temuan').val('');
	$('#rekomendasi_kementerian').val('');
	$('#nilai_temuan').val('');
	$('#sub_temuan').val('');
	$('#nilai_temuan_satker').val('');
	var no = 1;	
	$('#tbody_rekom').html('');
	$('#modalKonfirmasi').modal('hide');
}

function clear_form_temuan() {
	var jns='R';
	$.ajax({
		url: '<?php echo base_url('tlhp-bpk-lapkeu/getaspek'); ?>',
		data:{kode:jns},
		type: 'POST'
	}).done(function(data2) {
		var out = jQuery.parseJSON(data2);
		$('#aspek').html(out.aspek);
	});
	$('#kd_temuan').val('');
	$('#jdl_temuan').val('');
	$('#nilai_temuan').val('');
	$('#tbody_rekom').html('');
	no = 1;
	

}


$("#add_user").addClass('active');
$('input:radio').radiocharm({
	'uncheckable': false
});
$('#no_lhp').select2({
	placeholder: 'Pilih LHP'
});
$('#satker').select2({
	placeholder: 'Pilih Satuan Kerja'
});
$('#kd_audit').select2({
	placeholder: 'Pilih Fokus Pemeriksaan'
});
$('#prov').select2({
	placeholder: 'Pilih Instansi'
});
$('#kab').select2({
	placeholder: 'Pilih Kabupaten/Kota'
});
$('#ins_pemeriksa').select2({
	placeholder: 'Pilih Inspektorat Pemeriksa'
});

$('#pembahas_anev').select2({
	placeholder: 'Pilih Petugas Sekretariat'
});
$('#pembahas_apip').select2({
	placeholder: 'Pilih Petugas Tim'
});
$('#dalnis').select2({
	placeholder: 'Pilih Pengendali Teknis Tim'
});
$('#pic').select2({
	placeholder: 'Pilih PIC Itjen'
});
$('#review').select2({
	placeholder: 'Pilih Petugas Validasi'
});
$('#aspek').select2({
	placeholder: 'Pilih Aspek Pemeriksaan'
});

$("#ins_pemeriksa").change(function(){
	var ins=$(this).val();
	$.ajax({
		url: '<?php echo base_url('tlhp-kemendagri/getprov'); ?>',
		data:{kode:ins},
		type: 'POST'
	 //  	success: function(data){
		// }
	}).done(function(data2) {
		var out = jQuery.parseJSON(data2);
		$('#prov').html(out.prov);
		$('#pembahas_anev').html(out.anev);
		$('#pembahas_apip').html(out.apip);
		$('#dalnis').html(out.apip);
		$('#review').html(out.review);
		$('#daerah').val('');
	})

});

$("#satker").change(function(){
	var satker=$(this).val();
	$.ajax({
		url: '<?php echo base_url('tlhp-bpk-lapkeu/getcombo'); ?>',
		data:{satker:satker},
		type: 'POST'

	}).done(function(data2) {
		var out = jQuery.parseJSON(data2);
		$('#pic').html(out.pic);
		  	// $('#prov').html(out.prov);
		  	// $('#pembahas_anev').html(out.anev);
		  	// $('#pembahas_apip').html(out.apip);
		  	// $('#dalnis').html(out.apip);
		  	// $('#review').html(out.review);
		  	// $('#daerah').val('');
		  })

});


$(".tipe_daerah").change(function(){
	var tipe=$(this).val();
	var daerah;
	if (tipe == 'kab') {
		var kabupaten = document.getElementById('kab').value;
		daerah = kabupaten;
	}else{
		var provinsi = document.getElementById('prov').value;
		daerah = provinsi;
	}
	$('#daerah').val(daerah);
	if (tipe=='kab') {
		$('#combo-kab').removeAttr('hidden','');
	}else{
		$('#combo-kab').attr('hidden','');
	}
});

$(".jns_aspek").change(function(){
	var jns=$(this).val();
	$.ajax({
		url: '<?php echo base_url('tlhp-kemendagri/getaspek'); ?>',
		data:{kode:jns},
		type: 'POST'
	}).done(function(data2) {
		var out = jQuery.parseJSON(data2);
		$('#kd_temuan').val('');
	})
});

$("#no_lhp").change(function(){
	var no_lhp = document.getElementById('no_lhp').value;
        $.ajax({
	  	url: '<?php echo base_url('select-no-lhp'); ?>',
	  	type: 'POST',
	  	data:{no_lhp:no_lhp},
	  	success: function(data){
	  		var out = jQuery.parseJSON(data);
	  		$('#uraian_lhp').val(out.uraian_lhp);
	  		$('#tgl_lhp').val(out.tgl_lhp);
	  	}
	  });
});

$(document).ready(function() {
	$("#no_lhp").autocomplete({
     source: function(request, response) {
       $.ajax({
         url: "<?php echo site_url('get-no-lhp/?');?>",
         data: request,
         dataType: "json",
         type: "GET",
         success: function(data) {
           response(data);
         },
           
       });
     },
     select: function(event, ui) {
   		var no_lhp = document.getElementById('no_lhp').value;
        $.ajax({
		  	url: '<?php echo base_url('select-no-lhp'); ?>',
		  	type: 'POST',
		  	data:{no_lhp:no_lhp},
		  	success: function(data){
		  		var out = jQuery.parseJSON(data);
		  		$('#uraian_lhp').val(out.uraian_lhp);
		  		$('#tgl_lhp').val(out.tgl_lhp);
		  		$('#tgl_lhp').pickadate({
					format: 'dd-mm-yyyy',
					selectMonths: true,
		  			selectYears: true,
		  			formatSubmit: 'yyyy-mm-dd',
				});
		  	}
		  });
    },
     minLength: 2,
     delay: 200
   });
});


// $("#aspek").change(function(){
// 	var tipe = $('input[name=tipe_daerah]:checked').val();
// 	var daerah;
// 	if (tipe == 'kab') {
// 		var kabupaten = document.getElementById('kab').value;
// 		daerah = kabupaten;
// 	}else{
// 		var provinsi = document.getElementById('prov').value;
// 		daerah = provinsi;
// 	}
// 	var tahun = '<?= $this->session->userdata("year_selected"); ?>'
// 	var noreg = $('#d_noreg').val();
// 	var no_lhp = $('#d_no_lhp').val();
// 	var aspek=$(this).val();
// 	$.ajax({
// 		url: '<?php echo base_url('tlhp-bpk-lapkeu/getmax-temuan'); ?>',
// 		data:{kode:aspek,noreg:noreg,no_lhp:no_lhp},
// 		type: 'POST'
// 	}).done(function(data2) {
// 		var out = jQuery.parseJSON(data2);
// 		  	//$('#kd_temuan').val(out.max);
// 		  })
// });

$("#prov").change(function(){
	var header=$(this).val();

	$.ajax({
		url: '<?php echo base_url('data-user/getkab'); ?>',
		data:{kode:header},
		type: 'POST',
		success: function(data){
			$('#kab').html(data);
			var tipe = $('input[name=tipe_daerah]:checked').val();
			var daerah;
			if (tipe == 'kab') {
				var kabupaten = document.getElementById('kab').value;
				daerah = kabupaten;
			}else{
				var provinsi = document.getElementById('prov').value;
				daerah = provinsi;
			}
			$('#daerah').val(daerah);
		}
	})
});

$("#kab").change(function(){
	var header=$(this).val();	
	var tipe = $('input[name=tipe_daerah]:checked').val();
	var daerah;
	if (tipe == 'kab') {
		var kabupaten = document.getElementById('kab').value;
		daerah = kabupaten;
	}else{
		var provinsi = document.getElementById('prov').value;
		daerah = provinsi;
	}
	$('#daerah').val(daerah);
});
var no = 1;
$("#add_rekom").click(function(event){
	var tbl = document.getElementById("tbody_rekom").innerHTML;

	if (tbl == '') {
		no = 1;
	}
	var obrik = document.getElementById('aspek').value;
	// if (obrik == '') {
	// 	Swal.fire({
	// 		icon: 'warning',
	// 		title: 'PERINGATAN!',
	// 		text: 'HARAP ISI ASPEK TERLEBIH DAHULU',
	// 	})
	// 	exit();
	// };
	var str = '0'+no;
	var res = str.substring(-2);
	var kd_temuan = document.getElementById('kd_temuan').value;
	var halaman = document.getElementById('halaman').value;
	// if (halaman == '') {
	// 	Swal.fire({
	// 		icon: 'warning',
	// 		title: 'PERINGATAN!',
	// 		text: 'Halaman LHP Silahkan Di Isi',
	// 	})
	// 	exit();
	// };
	var urut = kd_temuan+halaman;
	var rekom = '<tr id = "baris'+no+'" class="form_1 tr_tem">'+
	'<td style="text-align: left;">'+
	'<input type="text" value = "'+urut+'" name="id_rekom[]" class="form-control input-sm hidden">'+
	'<input type="text" name="k_rekom[]" class="form-control input-sm " width="100%">'+
	'</td>'+
	'<td style="text-align: left;">'+
	'<input type="text" name="hal_rekom[]" class="form-control input-sm " width="100%">'+
	'</td>'+
	'<td style="text-align: left;">'+
	'<textarea rows="7" class="form-control input-sm" name="nm_rekom[]" id="nm_rekom[]"></textarea>'+
	'</td>'+
	'<td style="text-align: left;">'+
	'<input type="text" id="nilai_rekom_'+no+'" name="nilai_rekom[]" class="form-control nilai_rekom input-sm function_separator">'+
	'</td>'+
	'<td style="text-align: left;">'+
	'<input type="button" class="btn btn-md btn-danger" value="Hapus" onclick="deleteRow(this)"/>'+
	// '<a href="javascript:void(0);" class="btn btn-danger btn-circle btn-md" onclick="$(this).parents(\'tr\').first().remove();"><i class="fa fa-times"></i></a>'+
	'</td>'+
	'</tr>';
	$('#tbody_rekom').append(rekom);
	no++;
	$('textarea').on('keyup keypress', function() {
	    $(this).height(0);
	    $(this).height(this.scrollHeight);
	  });
	// event.preventDefault();
})


$("#reset_rekom").click(function(event){
	var no = 1;	
	$('#tbody_rekom').html('');

})




$(document).on("click", ".hapusTemuan", function() {

	var noreg 		= $(this).attr("data-reg");
	var lhp 		= $(this).attr("data-lhp");
	var kode 		= $(this).attr("data-kode");
	var nama 	= $(this).attr("data-nama");


	Swal.fire({
		title: 'Apakah anda yakin?',
		text: "Menghapus data ("+noreg+") "+nama,
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#074979',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Ya, Hapus Data Ini.',
		cancelButtonText: 'Batal'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				method: 'POST',
				url: '<?php echo base_url('tlhp-kemendagri/del-temuan'); ?>?noreg='+noreg+'&lhp='+lhp+"&kode="+kode,
			})
			.done(function(data) {
				var out = jQuery.parseJSON(data);
				Swal.fire({
					position: 'top-end',
					icon: 'success',
					title: out.pesan,
					showConfirmButton: false,
					timer: 2000
				});
				$('#jml_temuan').html(out.jml_temuan);
				$('#modalTemuan').modal('hide');
			})
		    // document.location.href = "<?= base_url('tlhp-kemendagri/del-temuan?'); ?>noreg="+noreg+"&lhp="+lhp+"&kode="+kode;
		}
	})

});

$(document).on("click", ".hapusRekom", function() {

	var noreg 		= $(this).attr("data-reg");
	var lhp 		= $(this).attr("data-lhp");
	var kode 		= $(this).attr("data-kode");
	var nama 	= $(this).attr("data-nama");
	Swal.fire({
		title: 'Apakah anda yakin?',
		text: "Menghapus data ("+noreg+") "+nama,
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#074979',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Batal',
		confirmButtonText: 'Ya, Hapus Data Ini.'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				method: 'POST',
				url: '<?php echo base_url('tlhp-kemendagri/del-rekomendasi'); ?>?noreg='+noreg+'&lhp='+lhp+"&kode="+kode,
			})
			.done(function(data) {
				var out = jQuery.parseJSON(data);
				Swal.fire({
					position: 'top-end',
					icon: 'success',
					title: out.pesan,
					showConfirmButton: false,
					timer: 2000
				});
				$('#modalTemuan').modal('hide');

			})
		}
	})
});

$(document).on("click", ".back_to_list", function(e) {
	$('#form-edit-temuan').attr('hidden','');
	$('#form-edit-rekomendasi').attr('hidden','');
	$('#daftar-list-lhp').removeAttr('hidden');
	e.preventDefault();
});

function deleteRow(btn) {
	var row = btn.parentNode.parentNode;
	row.parentNode.removeChild(row);
}
</script>    

