

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
  content:'TIDAK';
  color: white;
  display: block;
  position: absolute;
  transform: translate(50%,-50%);
  top: 48%;
  left: 30%;
  font-size: 15px;
  font-family: Verdana, sans-serif;
}
input:checked + .slider:after {
  content:'YA';
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
  }else if ($is_admin == 2) {
    $hidden = '';
  }else if ($is_admin == 3) {
    $hidden = 'hidden';
  }
 ?>


<div class="swiffy-slider">
    <ul class="slider-container">
        <li>


			<div class="panel panel-headline  panel-primary">

				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<form class="form-horizontal" id="form-referensi" method="post" >
								<button name="btnp1" type="button" class="collapsible-form active-form">
								
										<div class="row">
												
											<div class="form-group"> 
												<div class="col-md-12"><a id="lbinforead1" style="text-align: right;"></a> 
												
												
													<div class="col-md-11"> 
															<h3 class="panel-title"><i class="fa fa-newspaper-o" style="padding-left: 10px"></i> Referensi  </h3>
									
													</div>
										
													<div class="col-md-1"> 
															<h3 class="panel-title"></h3>
													</div>
										
													
												</div>

											</div>
											
										</div>
								
								
								</button>
								
								<div class="content-form" style="display:block;">
					
									<div class="asset-inner" id="data-referensi">
									</div>
								</div>

						</div>
					</div>

				</div>
			</div>	

		</li>



</ul>


	
    <div class="slider-indicators">
        <button class="active"></button>
        <button></button>
        <button></button>	
    </div>
</div>

<!-- Modal -->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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


	<script src="https://cdn.jsdelivr.net/npm/swiffy-slider@1.5.3/dist/js/swiffy-slider.min.js" crossorigin="anonymous" defer></script>
	<link href="https://cdn.jsdelivr.net/npm/swiffy-slider@1.5.3/dist/css/swiffy-slider.min.css" rel="stylesheet" crossorigin="anonymous">


<style>

.slider-nav::after {
    content: "";
    mask: url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 0 0'><path fill-rule='evenodd' d='M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z'></path></svg>");
    mask-size: cover;
    background-color: #F6FBF4; var(--swiffy-slider-nav-light);
    background-origin: content-box;
	
    width: 5rem;
    height: 3rem;
}

</style>



	
<script type="text/javascript">
	
	
	 $(window).on('load', function () {
		
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
		
		;
		
	});






	$(window).on('load', function () {


			$(document).ready(function() {
				$('.treeview-animated').mdbTreeview();
			});
  
			var cinstansi= 1;
			var ctahun 	  = "<?php  echo $this->session->userdata('year_selected'); ?>";
			
			var level = 1; 
			
			
				if(level==1){ 
					clevel='( Level 1 )';
				}
				
				$.ajax({  
				  url: '<?php echo base_url('kapip-master-referensi/get-referensi'); ?>/'+ctahun+'/'+cinstansi,
				  type: 'POST',
				  success: function(data){
					$("#data-referensi").html(data);
					
				  }
				});
  

	});








$(document).on("click", ".simpan-referensi", function(e) {
	 var data = $('#form-referensi').serialize();
	 var clevel = $('#cblevel').val();
	 var ctahun = $('#ptahun').val();
	 var cinstansi = $('#pkdinstansi').val(); 	 

	 var cjml        = $(this).attr("data-jml"); 
	 var cjmltopik        = $(this).attr("data-jmltopik"); 
	
			var ckdtopik1 = '';
			
			var ckdtopik = '';
			var ckdpenilaian = '';
			var curaian = '';
			var cjawaban = '';
			var csimpulan = '';
				

			for (var r = 1, n = cjml; r <= n; r++) {

				
				var cpenjelasan = $('#cpenjelasanE1_'+r).val();  
				if(cpenjelasan==''){
					cst1 = false;
				}else{
					var cst1 = document.getElementById('cpilihanE1_'+r).checked;
				}
				
				
				if (cst1==false){
				   xjawaban=0;
				}else{
					xjawaban=1;
				}
				
				var ckdtopik = ckdtopik+'#'+$('#hkd_topikE1_'+r).val();
				var ckdpenilaian = ckdpenilaian+'#'+$('#hkd_penilaianE1_'+r).val();  
				var curaian = curaian+'#'+$('#uraianE1_'+r).val();
				var cjawaban = cjawaban+'#'+xjawaban;
				
			
			}
			
			
			$.ajax({
					type: 'POST',
					
					data: ({ctahun,cinstansi,clevel,ckdtopik,ckdpenilaian,curaian,cjawaban}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-penilaian/simpan-referensi",
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
							  url: '<?php echo base_url('kapip-penilaian/get-table-simpulan'); ?>/'+ctahun+'/'+cinstansi,
							  type: 'POST',
							  success: function(data){
								$("#data-table-simpulan").html(data);
							  }
							});	
							
						$.ajax({  
							  url: '<?php echo base_url('kapip-penilaian/get-elemen1'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
							  type: 'POST',
							  success: function(data){
							  $("#data-referensi").html(data);
							  }
							});			
						
					 
					}
			});
				
		e.preventDefault();
		
	});	



function kembali()
{
	href="<?= base_url($this->dynamic_menu->EncryptLink('dashboard'));?>";
	window.location = href;
}


	function uploadFileE1(cno){
		
		 
		 var data = $('#form-referensi').serialize();

			 const fileupload 	=$('#fileuploadE1_'+cno).prop('files')[0]; 
			 var   cfileupload  =$('#fileuploadE1_'+cno).val();  
			 var   curaian 		=$('#uraianE1_'+cno).val(); 
			 
		if(cfileupload==''){
			
			pesan=('File Upload masih kosong');
			return;
			
		}else if(curaian==''){
			
			alert('Keterangan tidak boleh kosong');	
				return;
			
		}else {

				var ctahun 		= $('#ptahun').val();
				var cinstansi 	= $('#pkdinstansi').val();
				
				
					
				if (fileupload!="") {	
					let formData = new FormData();
					formData.append('fileupload', fileupload);
				   // formData.append('nama_file', nama_file);
					formData.append('ctahun', ctahun);
					formData.append('cinstansi', cinstansi);
					//formData.append('celemen', celemen);
					//formData.append('clevel', clevel);
					//formData.append('ctopik', ctopik);
				//	formData.append('cpenilaian', cpenilaian);
					formData.append('curaian', curaian);
	  
				$(document).ready(function(){
					$.ajax({
						type: 'POST',
						url: "<?php echo site_url('uploadref.php')?>",
						data: formData,
						cache: false,
						processData: false,
						contentType: false,
						success: function (msg) {

							if(msg==0){
								
								pesan="File Gagal Upload";
								wal.fire({
									position: 'top-end',
									icon: 'error',
									title: pesan,
									showConfirmButton: false,
									timer: 2000
								});
								
							}else if(msg==2){
								
								pesan="File Sudah Ada";
								
								Swal.fire({
									position: 'top-end',
									icon: 'warning',
									title: pesan,
									showConfirmButton: false,
									timer: 2000
								});
								
								document.getElementById("uraianE1_"+cno).style.display = "none";
								
							}else if(msg==3){
								pesan="File Terlalu Besar";
								
								Swal.fire({
									position: 'top-end',
									icon: 'warning',
									title: pesan,
									showConfirmButton: false,
									timer: 2000
								});
								
								document.getElementById("uraianE1_"+cno).style.display = "none";
								
							}else{
																
								var urll = '<?php echo base_url(); ?>kapip-master-referensi/simpan-file';
									$.ajax({url:urll,
										 dataType:'json',
										 type: "POST",
										 data: formData,
										 contentType: false,
										 processData: false,
										 success:function(data){
										 
											if(data==0){
												pesan="Data Gagal Diupload";
												Swal.fire({
													position: 'top-end',
													icon: 'error',
													title: pesan,
													showConfirmButton: false,
													timer: 2000
												});
												document.getElementById("uraianE1_"+cno).style.display = "none";
											}else{
												
												pesan="File Berhasil Diupload";
													Swal.fire({
														position: 'top-end',
														icon: 'success',
														title: pesan,
														showConfirmButton: false,
														timer: 2000
													});
																									
													$.ajax({  
													  url: '<?php echo base_url('kapip-master-referensi/get-referensi'); ?>/'+ctahun+'/'+cinstansi,
													  type: 'POST',
													  success: function(data){
														$("#data-referensi").html(data);
														
														
														
													  }
													});	
												
												
											}
										 }
										 
										});  
								
							}
										

									
										
							document.getElementById("form-referensi").reset();			
						
						},
						error: function () {
							pesan="Data Gagal Diupload";
							Swal.fire({
								position: 'top-end',
								icon: 'success',
								title: pesan,
								showConfirmButton: false,
								timer: 2000
							});
						}
					});
				});
			}	
		
		}	



}





		function EditFileE1(ctahun,cinstansi,cfile,cnmfile,curut)
		{				 
			
			var   curaian = $('#uraianE1_'+curut).val(); 
			
			var data = $('#form-referensi').serialize();
			let formData = new FormData();
			formData.append('ctahun', ctahun);
			formData.append('cinstansi', cinstansi);
			formData.append('cfile', cfile);
			formData.append('cnmfile', cnmfile);
			formData.append('curaian', curaian);
			
 		Swal.fire({
              title: 'Apakah anda yakin?',
              text: "Edit Keterangan file "+cnmfile+"..?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#074979',
              cancelButtonColor: '#d33',
              cancelButtonText: 'Batal',
              confirmButtonText: 'Ya, Edit Data.'
            }).then((result) => {
              if (result.value) {			
			
			

			var urll = '<?php echo base_url(); ?>kapip-master-referensi/edit-file';
				$.ajax({url:urll,
					 dataType:'json',
					 type: "POST",
					 data: formData,
					 contentType: false,
					 processData: false,
					 success:function(data){
					 
						if(data==0){
							pesan="Data Gagal Edit";
								Swal.fire({
								  position: 'top-end',
								  icon: 'error',
								  title: pesan,
								  showConfirmButton: false,
								  timer: 2000
								});
							}else{
							
							pesan="Data Berhasil Di Edit";

							Swal.fire({
							  position: 'top-end',
							  icon: 'success',
							  title: pesan,
							  showConfirmButton: false,
							  timer: 2000
							});							
								
								$.ajax({  
								  url: '<?php echo base_url('kapip-master-referensi/get-referensi'); ?>/'+ctahun+'/'+cinstansi,
								  type: 'POST',
								  success: function(data){
									$("#data-referensi").html(data);
									
									
									
								  }
								});	
							
						
						}
					 }
					 
					}); 
			   }
            })					

		}





		function hapusFileE1(ctahun,cinstansi,cfile,cnmfile)
		{				 
			
			var data = $('#form-referensi').serialize();
			let formData = new FormData();
			formData.append('ctahun', ctahun);
			formData.append('cinstansi', cinstansi);
			formData.append('cfile', cfile);
			formData.append('cnmfile', cnmfile);
			
 		Swal.fire({
              title: 'Apakah anda yakin?',
              text: "Menghapus file "+cnmfile+"..?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#074979',
              cancelButtonColor: '#d33',
              cancelButtonText: 'Batal',
              confirmButtonText: 'Ya, Hapus Data.'
            }).then((result) => {
              if (result.value) {			
			
			

			var urll = '<?php echo base_url(); ?>kapip-master-referensi/hapus-file';
				$.ajax({url:urll,
					 dataType:'json',
					 type: "POST",
					 data: formData,
					 contentType: false,
					 processData: false,
					 success:function(data){
					 
						if(data==0){
							pesan="Data Gagal Hapus";
								Swal.fire({
								  position: 'top-end',
								  icon: 'error',
								  title: pesan,
								  showConfirmButton: false,
								  timer: 2000
								});
							}else{
							
							pesan="File Berhasil Di Hapus";

							Swal.fire({
							  position: 'top-end',
							  icon: 'success',
							  title: pesan,
							  showConfirmButton: false,
							  timer: 2000
							});							
								
								$.ajax({  
								  url: '<?php echo base_url('kapip-master-referensi/get-referensi'); ?>/'+ctahun+'/'+cinstansi,
								  type: 'POST',
								  success: function(data){
									$("#data-referensi").html(data);
									
									
									
								  }
								});	
							
						
						}
					 }
					 
					}); 
			   }
            })					

		}



	
   function validateFormat(fileInput,cnext){  

				document.getElementById("uraianE1_"+cnext).style.display = "block";
                 
                var filePath = fileInput.value; 
                const fileSize = fileInput.files[0].size;
                const size = Math.round((fileSize / 3072)); 
				
                

                var allowedExtensions =  
                        /(\.jpg|\.jpeg|\.png|\.gif|\.pdf)$/i; 
                
                if (!allowedExtensions.exec(filePath)) { 
                    Swal.fire({
							position: 'top-end',
								icon: 'error',
								title: 'PERHATIAN',
								text: 'Tipe File Tidak Diperbolehkan!',
								showConfirmButton: false,
								timer: 2000
						});
                    fileInput.value = ''; 
                    return false; 
                }  

                if (size > 3072) { 
                    Swal.fire({
						position: 'top-end',
							icon: 'error',
							title: 'PERHATIAN',
							text: 'Ukuran File Terlalu Besar! Maksimal Ukuran File : 3 MB',
						showConfirmButton: false,
						timer: 2000
						});
                    fileInput.value = ''; 
                    return false; 
                }
            
    }	
	
	

	function hide(_cid1,_cdir1,_cid2,_cdir2) {                      
    $(_cid1).toggle( 'slide',{direction: _cdir1}, 300,
            function(){
                $(_cid2).toggle('slide', {direction: _cdir2}, 300);
            });         
}



		
		

</script>    

