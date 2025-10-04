
<style>

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
					<h4 class="modal-title" id="EmyModalLabelGroupProfil">FORM TAMBAH GROUP</h4>
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

			var ckode 	  = "<?php  echo $this->session->userdata('id_instansi'); ?>";
			
				$.ajax({  
				  url: '<?php echo base_url('manajemen-group-user/get-manajemen'); ?>',
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
					url: "<?php echo base_url(); ?>manajemen-group-user/hapus-menu",
	
                })
                .done(function(data) {
                    var out = jQuery.parseJSON(data);

					if(out==0){
					
						var pesan = "Gagal Hapus Data!";
						Swal.fire({
						  title: 'GAGAL HAPUS',	
						  position: 'top-center',
						  icon: 'warning',
						  text: pesan,
						  showConfirmButton: false,
						  timer: 2000
						});
						
						
						
						
						
					}else if(out==1){
						
						var pesan = "Data Berhasil Di Hapus!";
						Swal.fire({
						  position: 'top-center',
						  icon: 'success',
						  title: pesan,
						  showConfirmButton: false,
						  timer: 2000
						});
						 

						$.ajax({           
								url: '<?php echo base_url('manajemen-group-user/tambah-menu'); ?>/'+cgroup,
								method: 'POST',
								success: function(data) {
									
										$('#data-add-menu').html(data);
										
										$.ajax({
											  url: '<?php echo base_url('manajemen-group-user/list-menu'); ?>/'+cgroup,
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
						  position: 'top-center',
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
					data:({cidgroup}),
					dataType: "json",
					url: "<?php echo base_url(); ?>manajemen-group-user/hapus-group",
	
                })
                .done(function(data) {
                    var out = jQuery.parseJSON(data);

					if(out==0){
					
						var pesan = "Gagal Hapus Data!";
						Swal.fire({
						  title: 'GAGAL HAPUS',	
						  position: 'top-center',
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
						  position: 'top-center',
						  icon: 'success',
						  title: pesan,
						  showConfirmButton: false,
						  timer: 2000
						});
						 
						 // e.preventDefault();						  
						// window.location.reload();						  
						getData();
						
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
					url: "<?php echo base_url(); ?>manajemen-group-user/hapus-group",
	
                })
                .done(function(data) {
                    var out = jQuery.parseJSON(data);

					if(out==0){
					
						var pesan = "Gagal Hapus Data!";
						Swal.fire({
						  title: 'GAGAL HAPUS',	
						  position: 'top-center',
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
						  position: 'top-center',
						  icon: 'success',
						  title: pesan,
						  showConfirmButton: false,
						  timer: 2000
						});
						 
						 // e.preventDefault();						  
						// window.location.reload();						  
						getData();
						
					}
					
				})
				
			}
		})
	})




 $(document).on("click", ".showManajemen-menu", function() {		  
		var ctahun 			= $(this).attr("data-tahun");
        var cinst 			= $(this).attr("data-inst");
		var cgroup 			= $(this).attr("data-kdgroup");
		var cnmgroup 		= $(this).attr("data-nmgroup");


			
		$('#ModalAddMenu').modal('show');	
			$.ajax({           
			 url: '<?php echo base_url('manajemen-group-user/tambah-menu'); ?>/'+cgroup,
			method: 'POST',
            success: function(data) {

					$('#data-add-menu').html(data);
					$.ajax({
						  url: '<?php echo base_url('manajemen-group-user/list-menu'); ?>/'+cgroup,
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


 $(document).on("click", ".simpan-menu", function() {		
		
        var cgroup		= $(this).attr("data-group");
		var cmenu		= $('#cbmenu').val();
		
		$.ajax({
					type: 'POST',
					data: ({cmenu,cgroup}),
					dataType: "json",
					url: "<?php echo base_url(); ?>manajemen-group-user/simpan-menu",
					success: function(data) {
						
					   var status = data; 
					   var pesan = "Berhasil Disimpan";
					   
						Swal.fire({
							position: 'top-center',
							icon: 'success',
							title: pesan,
							showConfirmButton: false,
							timer: 2000
						});
					
					 
						 $.ajax({           
								url: '<?php echo base_url('manajemen-group-user/tambah-menu'); ?>/'+cgroup,
								method: 'POST',
								success: function(data) {
									
										$('#data-add-menu').html(data);
										
										$.ajax({
											  url: '<?php echo base_url('manajemen-group-user/list-menu'); ?>/'+cgroup,
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



// $(document).on("click", ".tutup-profil", function() {
// 	getData();
// });



// $(document).on("click", ".tutup-elemen", function() {
// 	getData();
// });



// $(document).on("click", ".tutup-topik", function() {
// 	getData();
	
// });

// $(document).on("click", ".tutup-group", function() {
// 	getData();
	
// });

// $(document).on("click", ".tutup-group-profil", function() {
// 	getData();

// });



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


	
	function getData(){
	
			$.ajax({  
				  url: '<?php echo base_url('manajemen-group-user/get-manajemen'); ?>',
				  type: 'POST',
				  success: function(data){
					$("#data-manajemen").html(data);
				   
				  }
				});	
		
		}


	

function kembali()
{
	href="<?= base_url($this->dynamic_menu->EncryptLink('manajemen-group-user'));?>";
	window.location = href;
}


</script>    

