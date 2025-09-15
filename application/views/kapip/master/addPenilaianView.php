

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




.switch {
  position: relative;
  display: inline-block;
  width: 90px;
  height: 30px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ca2222;
  -webkit-transition: .4s;
  transition: .4s;
  border-radius: 6px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 28px;
  width: 32px;
  top: 1px;
  left: 1px;
  right: 1px;
  bottom: 1px;
  background-color: white;
  transition: 0.4s;
  border-radius: 6px;

}

input:checked + .slider {
  background-color: #2ab934;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(55px);
}

.slider:after {
  content:'......Tidak';
  color: white;
  display: block;
  position: absolute;
  transform: translate(-50%,-50%);
  top: 50%;
  left: 45%;
  font-size: 10px;
  font-family: Verdana, sans-serif;
}
input:checked + .slider:after {
  content:'Ya';
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

<?php 
  $is_admin = $this->session->userdata('is_admin');
  if ($is_admin == 1) {
    $hidden = '';
  }else if ($is_admin == 2) {
    $hidden = '';
  }else if ($is_admin == 3) {
    $hidden = 'hidden';
  }
 ?>	

<div class="panel panel-headline  panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-list-alt"></i> FORM MASTER PENILAIAN</h3>
				
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form class="form-horizontal" id="form-profil">
				<button type="button" class="collapsible-form active-form">


				  	<div class="row">
						<div class="col-md-12">
	
							<div class="form-group">
							<div class="col-md-10">
								<h3 class="panel-title"><?=$instansi ?> &nbsp;Tahun <?= $tahun ?> <label id="lbtriw" style="text-align: left;"></label></h3>
								
									
									<input type="hidden" name="ptahun"  value=<?= $tahun ?> class="form-control input-sm" id="ptahun" placeholder="">
									<input type="hidden" name="pkdinstansi"  value=<?= $kode ?> class="form-control input-sm" id="pkdinstansi" placeholder="">
								
								
								
							</div>
								
								
								
								
							</div>	
						
							<div class="form-group">
								
							</div>

						</div>
					</div>
				
				</button>
			</div>
		</div>
	</div>

</div>  







 
 <div class="panel panel-headline panel-primary" style="min-height:450px;">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="lnr lnr-book"></i> DATA MASTER PENILAIAN</h3>
	</div>
	
	<div class="panel-body"
 
	
							<div class="content-form" style="display:block;">
				
								<div class="row">
									<div class="col-md-12">
									

										<div class="product-status mg-b-15">
													<div class="container-fluid">
														<div class="row">
															<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																<div class="product-status-wrap">
																	
																	<div class="asset-inner"><br>
																		<div id="data-penilaian"></div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>



									</div>
								</div>
								 <p id="info"></p>
								
								<div class="panel-footer">
									<center>
										<a href="<?= base_url($this->dynamic_menu->EncryptLink('dashboard'));?>" class="btn btn-danger btn-lg"><i class="fa fa-arrow-circle-left"></i> KEMBALI</a>
										<button type="button"  class="btn btn-success btn-lg simpan-profil1"><i class="fa fa-check-square"></i> SIMPAN</button>
										<button type="button"  data-aksi="new" class="btn btn-primary btn-lg confirm hidden"><i class="fa fa-plus"></i> confirm</button>
									</center>
									</form>
								</div>					

							</div>
 
					</div>					


		<div class="modal fade" id="ModalAddPenilaian"  role="dialog" aria-labelledby="EmyModalLabelAddPenilaian" >
			<div class="modal-dialog" role="document" style="width: 80%; margin: auto;">
				<div class="modal-content">
				  <div class="modal-header">
				  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="EmyModalLabelP1">FORM TAMBAH PENILAIAN</h4>
				  </div>
					<div class="modal-body" id="data-add-penilaian">

					</div>
			  </div>
			</div>

		</div>


		<div class="modal fade" id="ModalEditPenilaian"  role="dialog" aria-labelledby="EmyModalLabelEditPenilaian" >
			<div class="modal-dialog" role="document" style="width: 80%; margin: auto;">
				<div class="modal-content">
				  <div class="modal-header">
				  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" >FORM EDIT PENILAIAN</h4>
				  </div>
					<div class="modal-body" id="data-edit-penilaian">

					</div>
			  </div>
			</div>

		</div>

		<div class="modal fade" id="ModalAddTopik"  role="dialog" aria-labelledby="EmyModalLabelAddTopik">
			<div class="modal-dialog  " role="document">
				<div class="modal-content">
				  <div class="modal-header">
				  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="EmyModalLabelP1">FORM TAMBAH TOPIK</h4>
				  </div>
					<div class="modal-body" id="data-add-topik">

					</div>
			  </div>
			</div>

		</div>
	
		<div class="modal fade" id="ModalEditTopik"  role="dialog" aria-labelledby="EmyModalLabelEditTopik">
			<div class="modal-dialog  " role="document">
				<div class="modal-content">
				  <div class="modal-header">
				  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="EmyModalLabelP1">FORM EDIT TOPIK</h4>
				  </div>
					<div class="modal-body" id="data-edit-topik">

					</div>
			  </div>
			</div>

		</div>	
		
		<div class="modal fade" id="ModalAddLevel"  role="dialog" aria-labelledby="EmyModalLabelAddLevel">
			<div class="modal-dialog  " role="document">
				<div class="modal-content">
				  <div class="modal-header">
				  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" >FORM TAMBAH LEVEL</h4>
				  </div>
					<div class="modal-body" id="data-add-level">

					</div>
			  </div>
			</div>

		</div>










    


<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: #F6FBF4;
  color: gray;
}


	
.flex {
    display: flex;
    justify-content: flex-start;
}
.flex input {
    max-width: 130px;
    flex: 1 1 300px;
}
.flex .currency {
    font-size:10px;
    padding: 0 10px 0 10px;
    color: #999;
    border: 1px solid #ccc;
    border-right: 0;
    line-height: 2.5;
    border-radius: 7px 0 0 7px;
    background: white;
}





</style>


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



	<script src="<?= base_url() ?>assets/vendor/datatables/autoCurrency.js"></script>
	<script src="<?= base_url() ?>assets/vendor/datatables/numberFormat.js"></script>
	
	<script src="<?= base_url() ?>assets/vendor/datepicker/bootstrap-datepicker.js"></script>
	<script src="<?= base_url() ?>assets/custom/custom.js"></script>

	<script type="text/javascript">
	
	
 $(window).on('load', function () {


			var ckode= '<?=$kode ?>';
			var ctahun= '<?= $tahun ?>';
			
				$.ajax({  
				  url: '<?php echo base_url('kapip-master-penilaian/get-elemen'); ?>/'+ctahun+'/'+ckode,
				  type: 'POST',
				  success: function(data){
					$("#data-penilaian").html(data);
				   // $('#table-subkeg').DataTable();
				  }
				});	




	
    });	
	
	
	
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


$('#cblevel').select2({
	placeholder: 'Pilih Level'
});


 $(document).on("click", ".showTambah-topik", function() {		  
		var ctahun 			= $(this).attr("data-tahun");
        var cinst 			= $(this).attr("data-inst");
		var celemen 		= $(this).attr("data-kdelemen");
		var cnmelemen 		= $(this).attr("data-nmelemen");
		
		
			
		$('#ModalAddTopik').modal('show');	
			$.ajax({           
			 url: '<?php echo base_url('kapip-master-penilaian/tambah-topik'); ?>/'+ctahun+'/'+cinst+'/'+celemen,
			method: 'POST',
            success: function(data) {
				
					$('#data-add-topik').html(data);
					document.getElementById("nm_topik").disabled = true;
					 document.getElementById("ket_topik").disabled = true;
				//	document.getElementById("lbelemen").innerHTML=cnmelemen;
					$('#htahun_tpk').val(ctahun);
					$('#hinstansi_tpk').val(cinst);	
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
			
        });
		 
		
	
	});



 $(document).on("click", ".showTambah-penilaian", function() {		  
		var ctahun 			= $(this).attr("data-tahun");
        var cinstansi 		= $(this).attr("data-inst");
		var celemen 		= $(this).attr("data-kdelemen");
		var ctopik 			= $(this).attr("data-kdtopik");
		var clevel 			= $(this).attr("data-kdlevel");	

			
		$('#ModalAddPenilaian').modal('show');	
			$.ajax({ 
			type: 'POST',
			data: ({ctahun,cinstansi,celemen,ctopik,clevel}),
			//dataType: "json",
			url: "<?php echo base_url(); ?>kapip-master-penilaian/tambah-penilaian",
			
			
            success: function(data) {
				
					$('#data-add-penilaian').html(data);
					document.getElementById("uraian_penilaian").disabled = true;
					document.getElementById("penjelasan_penilaian").disabled = true;
					document.getElementById("bukti_penilaian").disabled = true;
					document.getElementById("langkah_penilaian").disabled = true;
					document.getElementById("hpoin").disabled = true;
					document.getElementById("dpoin").disabled = true;
					
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
			
        });
		 
		
	
	});


 $(document).on("click", ".showEdit-topik", function() {		  
		var ctahun 			= $(this).attr("data-tahun");
        var cinst 			= $(this).attr("data-inst");
		var celemen 		= $(this).attr("data-kdelemen");
		var ctopik 			= $(this).attr("data-kdtopik");
		
		
			
		$('#ModalEditTopik').modal('show');	
			$.ajax({           
			 url: '<?php echo base_url('kapip-master-penilaian/edit-topik'); ?>/'+ctahun+'/'+cinst+'/'+celemen+'/'+ctopik,
			method: 'POST',
            success: function(data) {
				
					$('#data-edit-topik').html(data);
					 document.getElementById("enm_topik").disabled = false;
					 document.getElementById("eket_topik").disabled = false;
            },
           
        });
		 
		
	
	});

				

 $(document).on("click", ".showEdit-Penilaian", function() {		  
		var ctahun 			= $(this).attr("data-tahun");
        var cinstansi 		= $(this).attr("data-inst");
		var celemen 		= $(this).attr("data-kdelemen");
		var ctopik 			= $(this).attr("data-kdtopik");
		var clevel 			= $(this).attr("data-kdlevel");	
		var cpenilaian 		= $(this).attr("data-kdpenilaian");	

			
		$('#ModalEditPenilaian').modal('show');	
			$.ajax({ 
			type: 'POST',
			data: ({ctahun,cinstansi,celemen,ctopik,clevel,cpenilaian}),
			//dataType: "json",
			url: "<?php echo base_url(); ?>kapip-master-penilaian/edit-penilaian",
			
			
            success: function(data) {
				
					$('#data-edit-penilaian').html(data);
					document.getElementById("euraian_penilaian").disabled = false;
					document.getElementById("epenjelasan_penilaian").disabled = false;
					document.getElementById("ebukti_penilaian").disabled = false;
					document.getElementById("elangkah_penilaian").disabled = false;
					document.getElementById("ehpoin").disabled = false;
					document.getElementById("edpoin").disabled = false;
					
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
			
        });
		
	
	});


	$(document).on("click", ".hapus-topik", function() {	
		
		var ctahun 			= $(this).attr("data-tahun");
		var cinstansi 		= $(this).attr("data-inst");
        var celemen		 	= $(this).attr("data-kdelemen");
        var ctopik		 	= $(this).attr("data-kdtopik");
        var curaian		 	= $(this).attr("data-nmtopik");
		

       Swal.fire({
              title: 'Apakah anda yakin?',
              text: "Menghapus Topik "+ctopik+" : "+curaian+"..?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#074979',
              cancelButtonColor: '#d33',
              cancelButtonText: 'Batal',
              confirmButtonText: 'Ya, Hapus Data.'
            }).then((result) => {
              if (result.value) { 

                  $.ajax({
					type: 'POST',
					data: ({ctahun,cinstansi,celemen,ctopik}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-master-penilaian/hapus-topik",
	
                })
                .done(function(data) {
                    var out = jQuery.parseJSON(data);

					if(out==0){
					
						var pesan = "Gagal Hapus Data!";
						Swal.fire({
						  title: 'GAGAL HAPUS',	
						  position: 'top-end',
						  icon: 'warning',
						  text: pesan,
						  showConfirmButton: false,
						  timer: 2000
						});
						 // window.location.reload();
						 // e.preventDefault(); 
						
					}else if(out==1){
						
						var pesan = "Data Berhasil Di Hapus!";
						Swal.fire({
						  position: 'top-end',
						  icon: 'success',
						  title: pesan,
						  showConfirmButton: false,
						  timer: 2000
						});
						 
						 // e.preventDefault();						  
						 window.location.reload();						  
						
						
					}else{
						
						var pesan = "Sudah ada data Level untuk Topik "+ctopik;
						Swal.fire({
						  title: 'GAGAL HAPUS',	
						  position: 'top-end',
						  icon: 'warning',
						  text: pesan,
						  showConfirmButton: false,
						  timer: 2500
						});
						
						
						
					}
					
				})
				
			}
		})
	})


	$(document).on("click", ".hapus-level", function() {	
		
		var ctahun 			= $(this).attr("data-tahun");
		var cinstansi 		= $(this).attr("data-inst");
        var celemen		 	= $(this).attr("data-kdelemen");
        var ctopik		 	= $(this).attr("data-kdtopik");
        var clevel		 	= $(this).attr("data-kdlevel");
        var curaian		 	= $(this).attr("data-nmlevel");
		

       Swal.fire({
              title: 'Apakah anda yakin?',
              text: "Menghapus : "+curaian+"..?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#074979',
              cancelButtonColor: '#d33',
              cancelButtonText: 'Batal',
              confirmButtonText: 'Ya, Hapus Data.'
            }).then((result) => {
              if (result.value) { 

                  $.ajax({
					type: 'POST',
					data: ({ctahun,cinstansi,celemen,ctopik,clevel}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-master-penilaian/hapus-level",
	
                })
                .done(function(data) {
                    var out = jQuery.parseJSON(data);

					if(out==0){
					
						var pesan = "Gagal Hapus Data!";
						Swal.fire({
						  title: 'GAGAL HAPUS',	
						  position: 'top-end',
						  icon: 'warning',
						  text: pesan,
						  showConfirmButton: false,
						  timer: 2000
						});
						 // window.location.reload();
						 // e.preventDefault(); 
						
					}else if(out==1){
						
						var pesan = "Data Berhasil Di Hapus!";
						Swal.fire({
						  position: 'top-end',
						  icon: 'success',
						  title: pesan,
						  showConfirmButton: false,
						  timer: 2000
						});
						 
						 // e.preventDefault();						  
						  window.location.reload();						  
						
						
					}else{
						
						var pesan = "Sudah ada data Penilaian untuk Level "+curaian;
						Swal.fire({
						  title: 'GAGAL HAPUS',	
						  position: 'top-end',
						  icon: 'warning',
						  text: pesan,
						  showConfirmButton: false,
						  timer: 2500
						});
						
						
						
					}
					
				})
				
			}
		})
	})


 $(document).on("click", ".showTambah-level", function() {		  
		var ctahun 			= $(this).attr("data-tahun");
        var cinst 			= $(this).attr("data-inst");
		var celemen 		= $(this).attr("data-kdelemen");
		var ctopik 			= $(this).attr("data-kdtopik");

			
		$('#ModalAddLevel').modal('show');	
			$.ajax({           
			 url: '<?php echo base_url('kapip-master-penilaian/tambah-level'); ?>/'+ctahun+'/'+cinst+'/'+celemen+'/'+ctopik,
			method: 'POST',
            success: function(data) {
				
					$('#data-add-level').html(data);
				//	document.getElementById("nm_level").disabled = true;
					
					
					$.ajax({
						  url: '<?php echo base_url('kapip-master-penilaian/list-level'); ?>/'+ctahun+'/'+cinst+'/'+celemen+'/'+ctopik,
						  type: 'POST',
						  success: function(data){
							$("#cblevel").html(data);
						  }
					});
					
					
				
            },
           
			
        });
		 
		
	
	});




   $(document).on("click", "#btntambah_topik", function(e) {  
 		
		$('#nm_topik').val('');
		document.getElementById("nm_topik").disabled = false;
		document.getElementById("ket_topik").disabled = false;
		document.getElementById("nm_topik").focus();
	});






   $(document).on("click", "#btnhapus_penilaian", function(e) {  
 		var ctahun 			= $(this).attr("data-tahun"); 
        var cinstansi		= $(this).attr("data-inst");
		var celemen			= $(this).attr("data-elemen");
		var ctopik			= $(this).attr("data-topik");
		var clevel			= $(this).attr("data-level");
		var cpenilaian		= $(this).attr("data-penilaian");
		var curaian			= $(this).attr("data-uraian");
		
		
		

       Swal.fire({
              title: 'Apakah anda yakin?',
              text: "Menghapus : "+curaian+"..?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#074979',
              cancelButtonColor: '#d33',
              cancelButtonText: 'Batal',
              confirmButtonText: 'Ya, Hapus Data.'
            }).then((result) => {
              if (result.value) { 

                  $.ajax({
					type: 'POST',
					data: ({ctahun,cinstansi,celemen,ctopik,clevel,cpenilaian}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-master-penilaian/hapus-penilaian",
	
                })
                .done(function(data) {
                    var out = jQuery.parseJSON(data);

					if(out==0){
					
						var pesan = "Gagal Hapus Data!";
						Swal.fire({
						  title: 'GAGAL HAPUS',	
						  position: 'top-end',
						  icon: 'warning',
						  text: pesan,
						  showConfirmButton: false,
						  timer: 2000
						});
						 
						
					}else{
						
						var pesan = "Data Berhasil Di Hapus!";
						Swal.fire({
						  position: 'top-end',
						  icon: 'success',
						  title: pesan,
						  showConfirmButton: false,
						  timer: 2000
						});
						 
						 // e.preventDefault();						  
						  window.location.reload();						  
						
						
					}
					
				})
				
			}
		}) 
	});


   $(document).on("click", "#btntambah_penilaian", function(e) {  
 		
		$('#uraian_penilaian').val('');
		$('#penjelasan_penilaian').val('');
		$('#bukti_penilaian').val('');
		$('#langkah_penilaian').val('');
		$('#hpoin').val('');
		$('#dpoin').val('');
		
		document.getElementById("uraian_penilaian").disabled = false;
		document.getElementById("penjelasan_penilaian").disabled = false;
		document.getElementById("bukti_penilaian").disabled = false;
		document.getElementById("langkah_penilaian").disabled = false;
		document.getElementById("hpoin").disabled = false;
		document.getElementById("dpoin").disabled = false;
		document.getElementById("hpoin").focus();
	});



 $(document).on("click", ".simpan-topik", function() {		
		var ctahun 		= $(this).attr("data-tahun");
        var cinstansi	= $(this).attr("data-inst");
		var celemen		= $(this).attr("data-elemen");
		var cnm_topik	= $('#nm_topik').val();
		var curut_topik = $('#urut_topik').val();
		var cket_topik = $('#ket_topik').val();
		
		
		
		$.ajax({
					type: 'POST',
					data: ({ctahun,cinstansi,celemen,cnm_topik,curut_topik,cket_topik}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-master-penilaian/simpan-topik",
					success: function(data) {
						
					   var status = data; //alert(status);
					   var pesan = "Berhasil Disimpan";
					   
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: pesan,
							showConfirmButton: false,
							timer: 2000
						});
					 
					 
						 $.ajax({           
								 url: '<?php echo base_url('kapip-master-penilaian/tambah-topik'); ?>/'+ctahun+'/'+cinstansi+'/'+celemen,
								method: 'POST',
								success: function(data) {
									
										$('#data-add-topik').html(data);
										document.getElementById("nm_topik").disabled = true;
										document.getElementById("ket_topik").disabled = true;
										
										$('#htahun_tpk').val(ctahun);
										$('#hinstansi_tpk').val(cinstansi);	
										
								},
								
								
							});
						 
						
					 
					}
			});
		 
		
	
	});
	


$(document).on("click", ".simpan-penilaian", function() {		
		var ctahun 		= $(this).attr("data-tahun");
        var cinstansi	= $(this).attr("data-inst");
		var celemen		= $(this).attr("data-elemen");
		var ctopik		= $(this).attr("data-topik");
		var clevel		= $(this).attr("data-level");
		
		var curaian		= $('#uraian_penilaian').val();
		var cpenjelasan = $('#penjelasan_penilaian').val();
		var cbukti 		= $('#bukti_penilaian').val();
		var clangkah 	= $('#langkah_penilaian').val();
		var chpoin 		= $('#hpoin').val();
		var cdpoin 		= $('#dpoin').val();		
		
		
		$.ajax({
					type: 'POST',
					data: ({ctahun,cinstansi,celemen,ctopik,clevel,curaian,cpenjelasan,cbukti,clangkah,chpoin,cdpoin}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-master-penilaian/simpan-penilaian",
					success: function(data) {
						
					   var status = data; //alert(status);
					   var pesan = "Berhasil Disimpan";
					   
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: pesan,
							showConfirmButton: false,
							timer: 2000
						});
					
						 	$.ajax({ 
								type: 'POST',
								data: ({ctahun,cinstansi,celemen,ctopik,clevel}),
								//dataType: "json",
								url: "<?php echo base_url(); ?>kapip-master-penilaian/tambah-penilaian",
								
								
								success: function(data) {
									
										$('#data-add-penilaian').html(data);
										document.getElementById("uraian_penilaian").disabled = true;
										document.getElementById("penjelasan_penilaian").disabled = true;
										document.getElementById("bukti_penilaian").disabled = true;
										document.getElementById("langkah_penilaian").disabled = true;
										document.getElementById("hpoin").disabled = true;
										document.getElementById("dpoin").disabled = true;
										
								},
								processResults: function(data) {
									return {
										results: data
									};
								},
								
							});
						
					 
					}
			});
		 
		
	
	});



$(document).on("click", ".update-penilaian", function() {		
		var ctahun 		= $(this).attr("data-tahun");
        var cinstansi	= $(this).attr("data-inst");
		var celemen		= $(this).attr("data-elemen");
		var ctopik		= $(this).attr("data-topik");
		var clevel		= $(this).attr("data-level");
		var cpenilaian		= $(this).attr("data-penilaian");
		
		var curaian		= $('#euraian_penilaian').val();
		var cpenjelasan = $('#epenjelasan_penilaian').val();
		var cbukti 		= $('#ebukti_penilaian').val();
		var clangkah 	= $('#elangkah_penilaian').val();
		var chpoin 		= $('#ehpoin').val();
		var cdpoin 		= $('#edpoin').val();
		
		
		
		$.ajax({
					type: 'POST',
					data: ({ctahun,cinstansi,celemen,ctopik,clevel,cpenilaian,curaian,cpenjelasan,cbukti,clangkah,chpoin,cdpoin}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-master-penilaian/update-penilaian",
					success: function(data) {
						
					   var status = data; //alert(status);
					   var pesan = "Berhasil Update";
					   
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: pesan,
							showConfirmButton: false,
							timer: 2000
						});
					
						 	$.ajax({ 
								type: 'POST',
								data: ({ctahun,cinstansi,celemen,ctopik,clevel,cpenilaian}),
								//dataType: "json",
								url: "<?php echo base_url(); ?>kapip-master-penilaian/edit-penilaian",
								
								
								success: function(data) {
									
										$('#data-edit-penilaian').html(data);
										
								},
								processResults: function(data) {
									return {
										results: data
									};
								},
								
							});
						
					 
					}
			});
		 
		
	
	});




 $(document).on("click", ".update-topik", function() {		
		var ctahun 		= $(this).attr("data-tahun");
        var cinstansi	= $(this).attr("data-inst");
		var celemen		= $(this).attr("data-elemen");
		var ctopik		= $(this).attr("data-topik");
		var cnm_topik	= $('#enm_topik').val();
		var curut_topik	= $('#eurut_topik').val();
		var cket_topik = $('#eket_topik').val();
		
		
		
		$.ajax({
					type: 'POST',
					data: ({ctahun,cinstansi,celemen,ctopik,cnm_topik,curut_topik,cket_topik}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-master-penilaian/update-topik",
					success: function(data) {
						
					   var status = data; //alert(status);
					   var pesan = "Berhasil Update";
					   
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: pesan,
							showConfirmButton: false,
							timer: 2000
						});
					 
					 
						/*  $.ajax({           
								 url: '<?php echo base_url('kapip-master-penilaian/tambah-topik'); ?>/'+ctahun+'/'+cinstansi+'/'+celemen,
								method: 'POST',
								success: function(data) {
									
										$('#data-add-topik').html(data);
										document.getElementById("nm_topik").disabled = true;
										document.getElementById("ket_topik").disabled = true;
										
										$('#htahun_tpk').val(ctahun);
										$('#hinstansi_tpk').val(cinstansi);	
										
								},
								
								
							});
						  */
						
					 
					}
			});
		 
		
	
	});



 $(document).on("click", ".simpan-level", function() {		
		var ctahun 		= $(this).attr("data-tahun");
        var cinstansi	= $(this).attr("data-inst");
		var celemen		= $(this).attr("data-elemen");
		var ctopik		= $(this).attr("data-topik");
		var clevel	= $('#cblevel').val();
		
		
		
		$.ajax({
					type: 'POST',
					data: ({ctahun,cinstansi,celemen,ctopik,clevel}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-master-penilaian/simpan-level",
					success: function(data) {
						
					   var status = data; //alert(status);
					   var pesan = "Berhasil Disimpan";
					   
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: pesan,
							showConfirmButton: false,
							timer: 2000
						});
					 
					 
						 $.ajax({           
								 url: '<?php echo base_url('kapip-master-penilaian/tambah-level'); ?>/'+ctahun+'/'+cinstansi+'/'+celemen+'/'+ctopik,
								method: 'POST',
								success: function(data) {
									
										$('#data-add-level').html(data);
										
										//document.getElementById("cblevel").disabled = true;
										
										
										$.ajax({
												  url: '<?php echo base_url('kapip-master-penilaian/list-level'); ?>/'+ctahun+'/'+cinstansi+'/'+celemen+'/'+ctopik,
												  type: 'POST',
												  success: function(data){
													$("#cblevel").html(data);
												  }
											});
										
										
										
								},
								
								
							});
						 
						
					 
					}
			});
		 
		
	
	});



$(document).on("click", ".tutup-topik", function() {
	location.reload();
});

$(document).on("click", ".tutup-level", function() {
	location.reload();
});


$(document).on("click", ".tutup-penilaian", function() {
	location.reload();
});



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
  

	});




		function loadview_elemen(){
	
				var ctahun = $('#ptahun').val();
				var cinstansi = $('#pkdinstansi').val();
	
				$.ajax({           
					 url: '<?php echo base_url('kapip-master-penilaian/elemen'); ?>/'+ctahun+'/'+cinstansi,
					method: 'POST',
					success: function(data) {
						
							$('#data-add-topik').html(data);
							document.getElementById("nm_topik").disabled = true;
							document.getElementById("ket_topik").disabled = true;
							
					},
					processResults: function(data) {
						return {
							results: data
						};
					},
					
				});	
			
			
		}



	
	function enter(ckey,_cid){
		
        if (ckey==13)
        	{    	       	       	    	   
        	   
			   document.getElementById("4").focus();
        	}     
    }
	
	
	function hide(_cid1,_cdir1,_cid2,_cdir2) {                      
    $(_cid1).toggle( 'slide',{direction: _cdir1}, 300,
            function(){
                $(_cid2).toggle('slide', {direction: _cdir2}, 300);
            });         
}



</script>    

