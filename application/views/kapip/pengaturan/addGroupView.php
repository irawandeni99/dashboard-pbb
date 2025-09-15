

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
  width: 200px;
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


.slider2 {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #069A8E; // buka
  -webkit-transition: .4s;
  transition: .4s;
  border-radius: 6px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 31px;
  top: 1px;
  left: 5px;
  right: 150px;
  bottom: 1px;
  background-color: white;
  transition: 0.4s;
  border-radius: 6px;

}

.slider2:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 31px;
  top: 1px;
  left: 5px;
  right: 150px;
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
  -webkit-transform: translateX(50px);
  -ms-transform: translateX(50px);
  transform: translateX(150px);
}

.slider:after {
  content:'ELEMEN';
  color: white;
  display: block;
  position: absolute;
  transform: translate(50%,-50%);
  top: 48%;
  left: 20%;
  font-size: 15px;
  font-family: Verdana, sans-serif;
}
input:checked + .slider:after {
  content:'PROFIL';
}







.slider2:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 31px;
  top: 1px;
  left: 5px;
  right: 150px;
  bottom: 1px;
  background-color: white;
  transition: 0.4s;
  border-radius: 6px;

}

.slider2:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 31px;
  top: 1px;
  left: 5px;
  right: 150px;
  bottom: 1px;
  background-color: white;
  transition: 0.4s;
  border-radius: 6px;

}

input:checked + .slider2 {
  background-color: #DF2E2E; //kunci
}



input:focus + .slider2 {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider2:before {
  -webkit-transform: translateX(50px);
  -ms-transform: translateX(50px);
  transform: translateX(150px);
}




.slider2:after {
  content:'BUKA';
  color: white;
  display: block;
  position: absolute;
  transform: translate(50%,-50%);
  top: 48%;
  left: 30%;
  font-size: 13px;
  font-family: Verdana, sans-serif;
}
input:checked + .slider2:after {
  content:'KUNCI';
}

 .inputWrapper {
    height: 30px;
    width: 30px;
    border-radius: 5px;
    overflow: hidden;
    position: relative;
    cursor: pointer;
    /*Using a background color, but you can use a background image to represent a button*/
    background-image: url("./assets/img/cari.jpg");
     background-position: center; /* Center the image */
  background-repeat: no-repeat; /* Do not repeat the image */
  background-size: cover; 
}
.inputWrapperSearch {
    height: 30px;
    width: 30px;
    border-radius: 5px;
    overflow: hidden;
    position: relative;
    cursor: pointer;
    /*Using a background color, but you can use a background image to represent a button*/
    background-image: url("./assets/img/file.jpg");
     background-position: center; /* Center the image */
    background-repeat: no-repeat; /* Do not repeat the image */
    background-size: cover; 
}

.inputWrapperAdd {
    height: 30px;
    width: 30px;
    border-radius: 5px;
    overflow: hidden;
    position: relative;
    cursor: pointer;
    /*Using a background color, but you can use a background image to represent a button*/
    background-image: url("./assets/img/add.jpg");
     background-position: center; /* Center the image */
  background-repeat: no-repeat; /* Do not repeat the image */
  background-size: cover; 
}

.inputWrapperRemove {
    height: 30px;
    width: 30px;
    border-radius: 5px;
    overflow: hidden;
    position: relative;
    cursor: pointer;
    /*Using a background color, but you can use a background image to represent a button*/
    background-image: url("./assets/img/remove.jpg");
     background-position: center; /* Center the image */
  background-repeat: no-repeat; /* Do not repeat the image */
  background-size: cover; 
}


.fileInput {
    cursor: pointer;
    height: 100%;
    position:absolute;
    top: 0;
    right: 0;
    z-index: 99;
    /*This makes the button huge. If you want a bigger button, increase the font size*/
    font-size:50px;
    /*Opacity settings for all browsers*/
    opacity: 0;
    -moz-opacity: 0;
    filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0)
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
	  }else{
		$hidden = 'hidden';
	  }
 ?>	


	
 <div class="panel panel-headline panel-primary" style="min-height:450px;">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="lnr lnr-book"></i> Data Group User</h3>
	</div>

	<div class="panel-body"
 

							<div class="content-form" style="display:block;">
	
								<div class="col-md-12 pull-center">
								
									<div style="margin-left: 40%"><br>											
										<label class="switch">
										  <input type="checkbox" onchange="checkPilihan()" '.$disable.' id="cpilihan" '.$chk.' value='.$cjawaban.'>
										  <div class="slider"></div>
										</label>
									</div>
								</div>
								
							 
								<div class="col-md-11">			
									<div class="pull-right <?=$hidden; ?>">	
										<a   class="list-group-item list-group-item-action showTambah-group"><i class="fa fa-plus" aria-hidden="true" style="color: #377D71"></i><b> Tambah Group</b></a>';
									</div>
										
								</div>
				
								<div class="row">
									<div class="col-md-12">
									

										<div class="product-status mg-b-15">
													<div class="container-fluid">
														<div class="row">
															<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																<div class="product-status-wrap">
																	
																	<div class="asset-inner"><br>
																		<div id="data-manajemen"></div>
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
									</center>
									</form>
								</div>					

							</div>
 
					</div>					



		<div class="modal fade" id="ModalAddProfil"  role="dialog" aria-labelledby="EmyModalLabelAddProfil">
			<div class="modal-dialog  " role="document">
				<div class="modal-content">
				  <div class="modal-header">
				  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="EmyModalLabelProfil">FORM TAMBAH PROFIL</h4>
				  </div>
					<div class="modal-body" id="data-add-profil">

					</div>
			  </div>
			</div>

		</div>


		<div class="modal fade" id="ModalAddElemen"  role="dialog" aria-labelledby="EmyModalLabelAddElemen">
			<div class="modal-dialog  " role="document">
				<div class="modal-content">
				  <div class="modal-header">
				  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="EmyModalLabelElemen">FORM TAMBAH ELEMEN</h4>
				  </div>
					<div class="modal-body" id="data-add-elemen">

					</div>
			  </div>
			</div>

		</div>


		<div class="modal fade" id="ModalAddMenu"  role="dialog" aria-labelledby="EmyModalLabelAddMenu">
			<div class="modal-dialog  " role="document">
				<div class="modal-content">
				  <div class="modal-header">
				  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="EmyModalLabelMenu">FORM MANAJEMEN MENU</h4>
				  </div>
					<div class="modal-body" id="data-add-menu">

					</div>
			  </div>
			</div>

		</div>

		<div class="modal fade" id="ModalAddTopik"  role="dialog" aria-labelledby="EmyModalLabelAddTopik">
			<div class="modal-dialog  " role="document">
				<div class="modal-content">
				  <div class="modal-header">
				  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="EmyModalLabelTopik">FORM TAMBAH TOPIK</h4>
				  </div>
					<div class="modal-body" id="data-add-topik">

					</div>
			  </div>
			</div>

		</div>
	
		<div class="modal fade" id="ModalAddGroupProfil"  role="dialog" aria-labelledby="EmyModalLabelAddGroupProfil">
			<div class="modal-dialog  " role="document">
				<div class="modal-content">
				  <div class="modal-header">
				  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="EmyModalLabelGroupProfil">FORM TAMBAH GROUP PROFIL</h4>
				  </div>
					<div class="modal-body" id="data-add-group-profil">

					</div>
			  </div>
			</div>

		</div>		

		<div class="modal fade" id="ModalAddGroup"  role="dialog" aria-labelledby="EmyModalLabelAddGroup">
			<div class="modal-dialog  " role="document">
				<div class="modal-content">
				  <div class="modal-header">
				  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="EmyModalLabelGroup">FORM TAMBAH GROUP ELEMEN</h4>
				  </div>
					<div class="modal-body" id="data-add-group">

					</div>
			  </div>
			</div>

		</div>


		<div class="modal fade" id="ModalSettingPenilaian"  role="dialog" aria-labelledby="EmyModalLabelSetting">
			<div class="modal-dialog  " role="document">
				<div class="modal-content">
				  <div class="modal-header">
				  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="EmyModalLabelElemen"><i class="fa fa-wrench" aria-hidden="true"></i> Form Setting Akses Penilaian Mandiri</h4>
				  </div>
					
					<div class="container-fluid" <?= $hide ?> >  
								
						<div class="content-form" style="display:block;">
							<div class="row">
								<div class="row">
									<div class="col-md-12">
									
											<div>
												<div class="row">
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
														<div class="product-status-wrap"> 
													
																 <input type="hidden" name="ptahun"  value='.$ctahun.' class="form-control input-sm" id="ptahun">
																 <input type="hidden" name="pkdinstansi"  value='.$cinstansi.' class="form-control input-sm" id="pkdinstansi">


																		<div class="asset-inner" id="data-simpulan">
																		</div> 
														</div>
													</div>
								
												</div>

							</div>
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

			var ctahun 	  = "<?php  echo $this->session->userdata('year_selected'); ?>";
			var ckode 	  = "<?php  echo $this->session->userdata('id_instansi'); ?>";
			
				$.ajax({  
				  url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/get-manajemen'); ?>/'+ctahun+'/'+ckode,
				  type: 'POST',
				  success: function(data){
					$("#data-manajemen").html(data);
				   
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


$('#cbelemen').select2({
	placeholder: 'Pilih Elemen'
});


$('#cbtopik').select2({
	placeholder: 'Pilih Topik'
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



	$(document).on("click", ".hapus-menu", function() {	
		
		var cmenu 			= $(this).attr("data-idmenu");
		var cgroup 			= $(this).attr("data-idgroup");
		var cnama 			= $(this).attr("data-nama");
		
       Swal.fire({
              title: 'Apakah anda yakin?',
              text: "Menghapus Menu : "+cnama+"..?",
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
					data:({cmenu,cgroup}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-Pengaturan-Manajemen-User/hapus-menu",
	
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
						
						
						
						
						
					}else if(out==1){
						
						var pesan = "Data Berhasil Di Hapus!";
						Swal.fire({
						  position: 'top-end',
						  icon: 'success',
						  title: pesan,
						  showConfirmButton: false,
						  timer: 2000
						});
						 

						$.ajax({           
								url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/tambah-menu'); ?>/'+cgroup,
								method: 'POST',
								success: function(data) {
									
										$('#data-add-menu').html(data);
										
										$.ajax({
											  url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/list-menu'); ?>/'+cgroup,
											  type: 'POST',
											  success: function(data){
												$("#cbmenu").html(data);
											  }
										});		
										
										
										
								},
								
								
							});


					  
					
						
					}else{
					
						var pesan = "HAPUS DULU SUB MENU";
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
						
					}
					
				})
				
			}
		})
	})





	$(document).on("click", ".hapus-group-profil", function() {	
		
		var ctahun 			= $(this).attr("data-tahun");
		var cinstansi 		= $(this).attr("data-inst");
        var cnmgroup		= $(this).attr("data-nmgroup");
        var cidgroup		= $(this).attr("data-kdgroup");
		



       Swal.fire({
              title: 'Apakah anda yakin?',
              text: "Menghapus Group "+cidgroup+" : "+cnmgroup+"..?",
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
					data:({ctahun,cinstansi,cidgroup}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-Pengaturan-Manajemen-User/hapus-group-profil",
	
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
						// window.location.reload();						  
						checkPilihan();
						
					}
					
				})
				
			}
		})
	})




	$(document).on("click", ".hapus-group", function() {	
		
		var ctahun 			= $(this).attr("data-tahun");
		var cinstansi 		= $(this).attr("data-inst");
        var cnmgroup		= $(this).attr("data-nmgroup");
        var cidgroup		= $(this).attr("data-kdgroup");
		



       Swal.fire({
              title: 'Apakah anda yakin?',
              text: "Menghapus Group "+cidgroup+" : "+cnmgroup+"..?",
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
					data:({ctahun,cinstansi,cidgroup}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-Pengaturan-Manajemen-User/hapus-group",
	
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
						// window.location.reload();						  
						checkPilihan();
						
					}
					
				})
				
			}
		})
	})


	$(document).on("click", ".hapus-profil", function() {	
		
		var ctahun 			= $(this).attr("data-tahun");
		var cinstansi 		= $(this).attr("data-inst");
        var cprofil		 	= $(this).attr("data-kdprofil");
        var cnmprofil		= $(this).attr("data-nmprofil");
        var cidgroup		= $(this).attr("data-idgroup");
		

//alert('Tahun '+ctahun+' Instansi '+cinstansi+' Profil '+cprofil+' Namaprofil '+cnmprofil+' Group '+cidgroup);
//return;

       Swal.fire({
              title: 'Apakah anda yakin?',
              text: "Menghapus Profil "+cprofil+" : "+cnmprofil+"..?",
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
					data: ({ctahun,cinstansi,cprofil,cidgroup}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-Pengaturan-Manajemen-User/hapus-profil",
	
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
						// window.location.reload();						  
						checkPilihan();
						
					}
					
				})
				
			}
		})
	})



	$(document).on("click", ".hapus-elemen", function() {	
		
		var ctahun 			= $(this).attr("data-tahun");
		var cinstansi 		= $(this).attr("data-inst");
        var celemen		 	= $(this).attr("data-kdelemen");
        var cnmelemen		= $(this).attr("data-nmelemen");
        var cidgroup		= $(this).attr("data-idgroup");
		

       Swal.fire({
              title: 'Apakah anda yakin?',
              text: "Menghapus Elemen "+celemen+" : "+cnmelemen+"..?",
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
					data: ({ctahun,cinstansi,celemen,cidgroup}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-Pengaturan-Manajemen-User/hapus-elemen",
	
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
						// window.location.reload();						  
						checkPilihan();
						
					}
					
				})
				
			}
		})
	})



	$(document).on("click", ".hapus-topik", function() {
		
		var ctahun 			= $(this).attr("data-tahun");
		var cinstansi 		= $(this).attr("data-inst");
        var celemen		 	= $(this).attr("data-kdelemen");
        var ctopik		 	= $(this).attr("data-kdtopik");
        var curaian		 	= $(this).attr("data-nmtopik");
        var cgroup		 	= $(this).attr("data-group");
		
		
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
					data: ({ctahun,cinstansi,celemen,ctopik,cgroup}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-Pengaturan-Manajemen-User/hapus-topik",
	
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
						// window.location.reload();						  
						checkPilihan();
						
					}
					
				})
				
			}
		})
	})



 $(document).on("click", ".showTambah-group", function() {		  
		
		var ctahun 	= $('#ptahun').val();
		var cinst 	= $('#pkdinstansi').val();
		var chpil = document.getElementById('cpilihan').checked;	
		
		
		if(chpil==true){
			
			
					$('#ModalAddGroupProfil').modal('show');	
					$.ajax({           
					 url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/tambah-group-profil'); ?>/'+ctahun+'/'+cinst,
					method: 'POST',
					success: function(data) {

							$('#data-add-group-profil').html(data);
							$.ajax({
								  url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/list-group-profil'); ?>/'+ctahun+'/'+cinst,
								  type: 'POST',
								  success: function(data){
									$("#cbgroup").html(data);
									
									document.getElementById("cpilihan").checked = true;
								  }
							});					

							
					},
					processResults: function(data) {
						return {
							results: data
						};
					},
					
				});		
			
			
			
		}else{
			
			$('#ModalAddGroup').modal('show');	
				$.ajax({           
				 url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/tambah-group'); ?>/'+ctahun+'/'+cinst,
				method: 'POST',
				success: function(data) {

						$('#data-add-group').html(data);
						$.ajax({
							  url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/list-group'); ?>/'+ctahun+'/'+cinst,
							  type: 'POST',
							  success: function(data){
								$("#cbgroup").html(data);
							  }
						});					

						
				},
				processResults: function(data) {
					return {
						results: data
					};
				},
				
			});			
			
			
		}		
		
		
		

		 
		
	
	});


 $(document).on("click", ".showTambah-profil", function() {		  
		var ctahun 			= $(this).attr("data-tahun");
        var cinst 			= $(this).attr("data-inst");
		var cgroup 			= $(this).attr("data-kdgroup");
		var cnmgroup 		= $(this).attr("data-nmgroup");

			
		$('#ModalAddProfil').modal('show');	
			$.ajax({           
			 url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/tambah-profil'); ?>/'+ctahun+'/'+cinst+'/'+cgroup,
			method: 'POST',
            success: function(data) {

					$('#data-add-profil').html(data);
					$.ajax({
						  url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/list-profil'); ?>/'+ctahun+'/'+cinst+'/'+cgroup,
						  type: 'POST',
						  success: function(data){
							$("#cbprofil").html(data);
						  }
					});					

					
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
			
        });
		 
		
	
	});



 $(document).on("click", ".showManajemen-menu", function() {		  
		var ctahun 			= $(this).attr("data-tahun");
        var cinst 			= $(this).attr("data-inst");
		var cgroup 			= $(this).attr("data-kdgroup");
		var cnmgroup 		= $(this).attr("data-nmgroup");


			
		$('#ModalAddMenu').modal('show');	
			$.ajax({           
			 url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/tambah-menu'); ?>/'+cgroup,
			method: 'POST',
            success: function(data) {

					$('#data-add-menu').html(data);
					$.ajax({
						  url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/list-menu'); ?>/'+cgroup,
						  type: 'POST',
						  success: function(data){
							$("#cbmenu").html(data);
						  }
					});					

					
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
			
        });
		 
		
	
	});



 $(document).on("click", ".showTambah-elemen", function() {		  
		var ctahun 			= $(this).attr("data-tahun");
        var cinst 			= $(this).attr("data-inst");
		var cgroup 		= $(this).attr("data-kdgroup");
		var cnmgroup 		= $(this).attr("data-nmgroup");


			
		$('#ModalAddElemen').modal('show');	
			$.ajax({           
			 url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/tambah-elemen'); ?>/'+ctahun+'/'+cinst+'/'+cgroup,
			method: 'POST',
            success: function(data) {

					$('#data-add-elemen').html(data);
					$.ajax({
						  url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/list-elemen'); ?>/'+ctahun+'/'+cinst+'/'+cgroup,
						  type: 'POST',
						  success: function(data){
							$("#cbelemen").html(data);
						  }
					});					

					
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
			
        });
		 
		
	
	});


 $(document).on("click", ".showSetting-penilaian", function() {		  
		var ctahun 			= $(this).attr("data-tahun");
        var cinst 			= $(this).attr("data-inst");
		var cgroup 			= $(this).attr("data-kdgroup");
		var cnmgroup 		= $(this).attr("data-nmgroup");


		$('#ModalSettingPenilaian').modal('show');	
			$.ajax({  
				  url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/get-simpulan'); ?>',
				  type: 'POST',
				  data:{ctahun,cinst,cgroup},
				  success: function(data){
					$("#data-simpulan").html(data);
				  }
				});	
		 
		
	
	});




 $(document).on("click", ".showTambah-topik", function() {		  
		var ctahun 			= $(this).attr("data-tahun");
        var cinst 			= $(this).attr("data-inst");
		var cgroup 			= $(this).attr("data-idgroup");
		var celemen 		= $(this).attr("data-kdelemen");

			
		$('#ModalAddTopik').modal('show');	
			$.ajax({           
			 url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/tambah-topik'); ?>/'+ctahun+'/'+cinst+'/'+celemen+'/'+cgroup,
			method: 'POST',
            success: function(data) {

					$('#data-add-topik').html(data);
					$.ajax({
						  url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/list-topik'); ?>/'+ctahun+'/'+cinst+'/'+celemen+'/'+cgroup,
						  type: 'POST',
						  success: function(data){
							$("#cbtopik").html(data);
						  }
					});					

					
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
			
        });
		 
		
	
	});



   $(document).on("click", "#btntambah_topik", function(e) {  
 		
		$('#nm_topik').val('');
		document.getElementById("nm_topik").disabled = false;
		document.getElementById("ket_topik").disabled = false;
		document.getElementById("nm_topik").focus();
	});


 $(document).on("click", ".simpan-group-profil", function() {		
		var ctahun 		= $(this).attr("data-tahun");
        var cinstansi	= $(this).attr("data-inst");
		var cgroup		= $('#cbgroup').val();
		
		$.ajax({
					type: 'POST',
					data: ({ctahun,cinstansi,cgroup}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-Pengaturan-Manajemen-User/simpan-group-profil",
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
					
					 
						 $.ajax({           
								url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/tambah-group-profil'); ?>/'+ctahun+'/'+cinstansi,
								method: 'POST',
								success: function(data) {
									
										$('#data-add-group-profil').html(data);
										
										$.ajax({
											  url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/list-group-profil'); ?>/'+ctahun+'/'+cinstansi+'/'+cgroup,
											  type: 'POST',
											  success: function(data){
												$("#cbprofil").html(data);
											  }
										});		
										
										
										
								},
								
								
							});
						 
						
					 
					}
			});
		 
		
	
	});





 $(document).on("click", ".simpan-group", function() {		
		var ctahun 		= $(this).attr("data-tahun");
        var cinstansi	= $(this).attr("data-inst");
		var cgroup		= $('#cbgroup').val();
		
		$.ajax({
					type: 'POST',
					data: ({ctahun,cinstansi,cgroup}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-Pengaturan-Manajemen-User/simpan-group",
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
					
					 
						 $.ajax({           
								url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/tambah-group'); ?>/'+ctahun+'/'+cinstansi,
								method: 'POST',
								success: function(data) {
									
										$('#data-add-group').html(data);
										
										$.ajax({
											  url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/list-group'); ?>/'+ctahun+'/'+cinstansi+'/'+cgroup,
											  type: 'POST',
											  success: function(data){
												$("#cbelemen").html(data);
											  }
										});		
										
										
										
								},
								
								
							});
						 
						
					 
					}
			});
		 
		
	
	});



 $(document).on("click", ".simpan-profil", function() {		
		var ctahun 		= $(this).attr("data-tahun");
        var cinstansi	= $(this).attr("data-inst");
        var cgroup		= $(this).attr("data-group");
		var cprofil		= $('#cbprofil').val();
		
		$.ajax({
					type: 'POST',
					data: ({ctahun,cinstansi,cprofil,cgroup}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-Pengaturan-Manajemen-User/simpan-profil",
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
					
					 
						 $.ajax({           
								url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/tambah-profil'); ?>/'+ctahun+'/'+cinstansi+'/'+cgroup,
								method: 'POST',
								success: function(data) {
									
										$('#data-add-profil').html(data);
										
										$.ajax({
											  url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/list-profil'); ?>/'+ctahun+'/'+cinstansi+'/'+cgroup,
											  type: 'POST',
											  success: function(data){
												$("#cbprofil").html(data);
											  }
										});		
										
										
										
								},
								
								
							});
						 
						
					 
					}
			});
		 
		
	
	});



 $(document).on("click", ".simpan-menu", function() {		
		
        var cgroup		= $(this).attr("data-group");
		var cmenu		= $('#cbmenu').val();
		
		$.ajax({
					type: 'POST',
					data: ({cmenu,cgroup}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-Pengaturan-Manajemen-User/simpan-menu",
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
					
					 
						 $.ajax({           
								url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/tambah-menu'); ?>/'+cgroup,
								method: 'POST',
								success: function(data) {
									
										$('#data-add-menu').html(data);
										
										$.ajax({
											  url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/list-menu'); ?>/'+cgroup,
											  type: 'POST',
											  success: function(data){
												$("#cbmenu").html(data);
											  }
										});		
										
										
										
								},
								
								
							});
						 
						
					 
					}
			});
		 
		
	
	});



 $(document).on("click", ".simpan-elemen", function() {		
		var ctahun 		= $(this).attr("data-tahun");
        var cinstansi	= $(this).attr("data-inst");
        var cgroup		= $(this).attr("data-group");
		var celemen		= $('#cbelemen').val();
		
		$.ajax({
					type: 'POST',
					data: ({ctahun,cinstansi,celemen,cgroup}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-Pengaturan-Manajemen-User/simpan-elemen",
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
					
					 
						 $.ajax({           
								url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/tambah-elemen'); ?>/'+ctahun+'/'+cinstansi+'/'+cgroup,
								method: 'POST',
								success: function(data) {
									
										$('#data-add-elemen').html(data);
										
										$.ajax({
											  url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/list-elemen'); ?>/'+ctahun+'/'+cinstansi+'/'+cgroup,
											  type: 'POST',
											  success: function(data){
												$("#cbelemen").html(data);
											  }
										});		
										
										
										
								},
								
								
							});
						 
						
					 
					}
			});
		 
		
	
	});




 $(document).on("click", ".simpan-topik", function() {		
		var ctahun 		= $(this).attr("data-tahun");
        var cinstansi	= $(this).attr("data-inst");
		var celemen		= $(this).attr("data-elemen");
        var cgroup		= $(this).attr("data-group");
        var cnogroup	= $(this).attr("data-nogroup");
        var cnoelemen	= $(this).attr("data-noelemen");
		
		
		
		
		var ctopik		= $('#cbtopik').val();
		
		$.ajax({
					type: 'POST',
					data: ({ctahun,cinstansi,celemen,ctopik,cgroup}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-Pengaturan-Manajemen-User/simpan-topik",
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
					
					 
						 $.ajax({           
								url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/tambah-topik'); ?>/'+ctahun+'/'+cinstansi+'/'+celemen+'/'+cgroup,
								method: 'POST',
								success: function(data) {
									
										$('#data-add-topik').html(data);
										
										
										$.ajax({
											  url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/list-topik'); ?>/'+ctahun+'/'+cinstansi+'/'+celemen+'/'+cgroup,
											  type: 'POST',
											  success: function(data){
												$("#cbtopik").html(data);
												checkPilihan();
												
												
											  }
										});		
										
										
										
										
								},
								
								
							});
						 
						
					 
					}
			});
		 
		
	
	});




$(document).on("click", ".tutup-profil", function() {
	checkPilihan();
});



$(document).on("click", ".tutup-elemen", function() {
	checkPilihan();
});



$(document).on("click", ".tutup-topik", function() {
	checkPilihan();
	
});

$(document).on("click", ".tutup-group", function() {
	checkPilihan();
	
});

$(document).on("click", ".tutup-group-profil", function() {
	checkPilihan();

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


	function bukakunci(clevel,cgroup){
			
	 var ctahun  = $('#ptahun').val();
	 var cinst 	 = $('#pkdinstansi').val();
	 var nmgroup = $('#cnmgroup').val();
	 
	 var cst1 = document.getElementById('ckunci_'+clevel).checked;
				if (cst1==false){
				   ckunci=0;
				   cketkunci="Buka Kunci Penilaian ";
				}else{
				   ckunci=1;
				   
				   cketkunci="Kunci Penilaian ";
				}
	
		Swal.fire({
              title: 'Apakah anda yakin?',
              text: cketkunci+" . " +nmgroup+" Level "+clevel+"..?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#074979',
              cancelButtonColor: '#d33',
              cancelButtonText: 'Batal',
              confirmButtonText: 'Ya, Kunci Form.'
            }).then((result) => {
              if (result.value) {

					$.ajax({
							type: 'POST',
							data: ({ctahun,cinst,clevel,ckunci,cgroup}),
							dataType: "json",
							url: "<?php echo base_url(); ?>kapip-Pengaturan-Manajemen-User/simpan-kunci",
							success: function(data) {
							   var status = data; 
							   if (cst1==false){
								   var pesan = "Berhasil di Buka";
							   }else{
								   var pesan = "Berhasil di Kunci";
							   }
							   
							   
								Swal.fire({
									position: 'top-end',
									icon: 'success',
									title: pesan,
									showConfirmButton: false,
									timer: 2000
								});
							 
								$.ajax({  
									  url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/get-simpulan'); ?>',
									  type: 'POST',
									  data:{ctahun,cinst,cgroup},
									  success: function(data){
										$("#data-simpulan").html(data);
									  }
									});	
							}
					}); 
					
			
			   }else{
					$.ajax({  
						  url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/get-simpulan'); ?>',
						  type: 'POST',
						  data:{ctahun,cinst,cgroup},
						  success: function(data){
							$("#data-simpulan").html(data);
						  }
						});	  
				   
				   
			   }
            })	
		
	}

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


	
	function checkPilihan(){
		
		var chpil = document.getElementById('cpilihan').checked;	
		var ctahun 	  = "<?php  echo $this->session->userdata('year_selected'); ?>";
		var ckode 	  = "<?php  echo $this->session->userdata('id_instansi'); ?>";
		
		if(chpil==true){
			document.getElementById("cpilihan").checked = true;
			$.ajax({  
				  url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/get-manajemen-profil'); ?>/'+ctahun+'/'+ckode,
				  type: 'POST',
				  success: function(data){
					$("#data-manajemen").html(data);
				   
				  }
				});	
		}else{
			document.getElementById("cpilihan").checked = false;
			$.ajax({  
				  url: '<?php echo base_url('kapip-Pengaturan-Manajemen-User/get-manajemen'); ?>/'+ctahun+'/'+ckode,
				  type: 'POST',
				  success: function(data){
					$("#data-manajemen").html(data);
				   
				  }
				});	
			
		//	document.getElementById("detgroup_1").open = true;
		//	document.getElementById("detelemen_1_1").open = true;
		}


	  
    }	

function kembali()
{
	href="<?= base_url($this->dynamic_menu->EncryptLink('kapip-Pengaturan-Manajemen-User'));?>";
	window.location = href;
}


</script>    

