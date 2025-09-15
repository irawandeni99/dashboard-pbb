

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
  }else{
    $hidden = 'hidden';
  }
 
 
 ?>


<div class="panel panel-headline  panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-list-alt"></i> FORM PENILAIAN MANDIRI</h3>
				
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form class="form-horizontal" id="form-elemen">
				<button type="button" class="collapsible-form active-form">


				  	<div class="row">
						<div class="col-md-12">
	
							<div class="form-group">
							<div class="col-md-10">
								<h3 class="panel-title"><?=$instansi ?> &nbsp;Tahun <?=$tahun ?> </h3>
								
									
									<input type="hidden" name="ptahun"  value=<?= $tahun ?> class="form-control input-sm" id="ptahun" placeholder="">
									<input type="hidden" name="pkdinstansi"  value=<?= $kode ?> class="form-control input-sm" id="pkdinstansi" placeholder="">
								
								
<!--   
//$elemen['e6']  -->
							</div>
								
								
								<div class="col-sm-2"><a>PILIH LEVEL</a>

									 <select name="cblevel" id="cblevel" class="form-control input-sm">
										<option value="0" ></option>
										<option value="1" >LEVEL 1</option>
										<option value="2" >LEVEL 2</option>
										<option value="3" >LEVEL 3</option>
										<option value="4" >LEVEL 4</option>
										<option value="5" >LEVEL 5</option>
									  </select>
								</div>
								
								
							</div>	
						
							<div class="form-group">
								
							</div>

						</div>
					</div>
				
				</button>
			</form>
			</div>
		</div>
	</div>

</div>  


<!-- 1 -->


<div class="modal fade" id="ModalPengawasan"  role="dialog" aria-labelledby="EmyModalLabelP1">
		<div class="modal-dialog" role="document" style="width: 80%; margin: auto;">
			<div class="modal-content">
			  <div class="modal-header">
			  
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" >FORM PENGAWASAN</h4>
			  </div>
				<div class="modal-body" id="data-pengawasan">

				</div>
		  </div>
		</div>

</div>



<div class="swiffy-slider">
    <ul class="slider-container">
	
	<?php if($elemen['e1'] >=1){  ?>
	
        <li>


			<div class="panel panel-headline  panel-primary">

				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<form class="form-horizontal" id="form-elemen1" method="post" >
								<button name="btnp1" type="button" disabled class="collapsible-form active-form">
								
										<div class="row">
												
											<div class="form-group"> 
												<div class="col-md-12"><a id="lbinforead1" style="text-align: right;"></a> 
												
												
													<div class="col-md-11"> 
															<h3 class="panel-title"><i class="fa fa-diamond" style="padding-left: 10px"></i> Elemen 1 : Pengelolaan SDM  <a id="lbinfo1" style="text-align: left;"></a> </h3>
									
													</div>
										
													<div class="col-md-1"> 
															<h3 class="panel-title"><i class="fa fa-chevron-right" aria-hidden="true" style="padding-left: 62px"></i></h3>
													</div>
										
													
												</div>

											</div>
											
										</div>
								
								
								</button>
								
								<div class="content-form" style="display:block;">
					
									<div class="asset-inner" id="data-elemen-1">

																		
									</div> 	
									


								</div>

						</div>
					</div>

				</div>
			</div>	
			

			</li>

						
	<?php } ?>

		<!-- 2 -->

	<?php if($elemen['e2'] >=1 ){  ?>

			<li>
			
			<div class="panel panel-headline  panel-primary">

				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<form class="form-horizontal" id="form-elemen2">
								<button name="btne2" type="button" disabled class="collapsible-form active-form">
								
										<div class="row">
												
											<div class="form-group"> 
												<div class="col-md-12"><a id="lbinforead2" style="text-align: right;"></a> 
												
												
													<div class="col-md-11"> 
															<h3 class="panel-title"><i class="fa fa-chevron-left fa-1x" style="margin-left: -25px" aria-hidden="true"></i> <i class="fa fa-diamond" style="padding-left: 10px"></i> Elemen 2 : Praktik Profesional  <a id="lbinfo2" style="text-align: left;"></a> </h3>
															
													</div>
										
													<div class="col-md-1"> 
															<h3 class="panel-title"><i class="fa fa-chevron-right" aria-hidden="true" style="margin-left: 72px"></i></h3>
													</div>
										
													
												</div>

											</div>
											<div class="form-group">
											</div>

										</div>
								
								
								</button>
							
							<div class="content-form" style="display:block;">
				
								<div class="asset-inner" id="data-elemen-2">
																	
								</div> 	
								

							</div>

						</div>
					</div>

				</div>
			</div>	

		</li>

	<?php } ?>
 
 			<!-- 3 -->

	<?php if($elemen['e3'] >= 1){  ?>
			<li>
			
			<div class="panel panel-headline  panel-primary">

				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<form class="form-horizontal" id="form-elemen2">
								<button name="btne3" type="button" disabled class="collapsible-form active-form">
								
										<div class="row">
												
											<div class="form-group"> 
												<div class="col-md-12"><a id="lbinforead3" style="text-align: right;"></a> 
												
												
													<div class="col-md-11"> 
															<h3 class="panel-title"><i class="fa fa-chevron-left fa-1x" style="margin-left: -25px" aria-hidden="true"></i><i class="fa fa-diamond" style="padding-left: 10px"></i> Elemen 3 : Akuntabilitas dan Manajemen Kinerja  <a id="lbinfo3" style="text-align: left;"></a> </h3>
									
													</div>
										
													<div class="col-md-1"> 
															<h3 class="panel-title"><i class="fa fa-chevron-right" aria-hidden="true" style="padding-left: 70px"></i></h3>
													</div>
										
													
												</div>

											</div>
											<div class="form-group">
											</div>

										</div>
								
								
								</button>
							
							<div class="content-form" style="display:block;">
								<div class="asset-inner" id="data-elemen-3">
																	
								</div> 

							</div>

						</div>
					</div>

				</div>
			</div>	

		</li>
 

	<?php } ?>
 
<!-- 4 -->
	

	<?php if($elemen['e4'] >=1 ){  ?>
	<li>
			
			<div class="panel panel-headline  panel-primary">

				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<form class="form-horizontal" id="form-elemen4">
								<button name="btne4" type="button" disabled class="collapsible-form active-form">
								
										<div class="row">
												
											<div class="form-group"> 
												<div class="col-md-12"><a id="lbinforead4" style="text-align: right;"></a> 
												
												
													<div class="col-md-11"> 
															<h3 class="panel-title"><i class="fa fa-chevron-left fa-1x" style="margin-left: -25px" aria-hidden="true"></i><i class="fa fa-diamond" style="padding-left: 10px"></i> Elemen 4 : Budaya dan Hubungan Organisasi  <a id="lbinfo4" style="text-align: left;"></a> </h3>
									
													</div>
										
													<div class="col-md-1"> 
															<h3 class="panel-title"><i class="fa fa-chevron-right" aria-hidden="true" style="margin-left: 75px"></i></h3>
													</div>
										
													
												</div>

											</div>
											<div class="form-group">
											</div>

										</div>
								
								
								</button>
							
							<div class="content-form" style="display:block;">
				
								<div class="asset-inner" id="data-elemen-4">
																	
								</div> 	
								

							</div>

						</div>
					</div>

				</div>
			</div>	

		</li>
 
	<?php } ?>
 
<!-- 5 -->

	<?php if($elemen['e5'] >=1 ){  ?>
		<li>
			
			<div class="panel panel-headline  panel-primary">

				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<form class="form-horizontal" id="form-elemen5">
								<button name="btne5" type="button" disabled class="collapsible-form active-form">
								
										<div class="row">
												
											<div class="form-group"> 
												<div class="col-md-12"><a id="lbinforead5" style="text-align: right;"></a> 
												
												
													<div class="col-md-11"> 
															<h3 class="panel-title"><i class="fa fa-chevron-left fa-1x" style="margin-left: -25px" aria-hidden="true"></i><i class="fa fa-diamond" style="padding-left: 10px"></i> Elemen 5 : Struktur Tata Kelola  <a id="lbinfo5" style="text-align: left;"></a> </h3>
									
													</div>
										
													<div class="col-md-1"> 
															<h3 class="panel-title"><i class="fa fa-chevron-right" aria-hidden="true" style="margin-left: 75px"></i></h3>
													</div>
										
													
												</div>

											</div>
											<div class="form-group">
											</div>

										</div>
								
								
								</button>
							
							<div class="content-form" style="display:block;">
				
								<div class="asset-inner" id="data-elemen-5">
																	
								</div> 	
								

							</div>

						</div>
					</div>

				</div>
			</div>	

		</li>
	<?php } ?>

<!-- 6 -->
	<?php if($elemen['e6'] >=1 ){  ?>
		<li>
			
			<div class="panel panel-headline  panel-primary">

				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<form class="form-horizontal" id="form-elemen6">
								<button name="btnp1" type="button" disabled class="collapsible-form active-form">
								
										<div class="row">
												
											<div class="form-group"> 
												<div class="col-md-12"><a id="lbinforead6" style="text-align: right;"></a> 
												
												
													<div class="col-md-11"> 
															<h3 class="panel-title"><i class="fa fa-chevron-left fa-1x" style="margin-left: -20px;" aria-hidden="true"></i><i class="fa fa-diamond" style="padding-left: 10px;"></i> Elemen 6 : Peran dan Layanan  <a id="lbinfo6" style="text-align: left;"></a></h3>
									
													</div>
										
													<div class="col-md-1"> 
															
															<h3 class="panel-title"></h3>
													</div>
										
													
												</div>

											</div>
											<div class="form-group">
											</div>

										</div>
								
								
								</button>
		
	<!-- KUALITAS PENGAWASAN -->
			
		<!-- KUALITAS PENGAWASAN -->		

							
							<div class="content-form" style="display:block;">
							
	
				
								<div class="asset-inner" id="data-elemen-6">
																	
								</div> 	
								

							</div>

						</div>
					</div>

				</div>
			</div>	


						


		</li>

  <?php } ?>

<!-- 6 -->	

<!--simpulan  -->	

</ul>


	<button type="button" data-toggle="tooltip" data-placement="top" title="Elemen Sebelumnya"  class="slider-nav"></button>
    <button type="button" data-toggle="tooltip" data-placement="top" title="Elemen Selanjutnya" class="slider-nav slider-nav-next"></button>

    <div class="slider-indicators">
        <button class="active"></button>
        <button></button>
        <button></button>	
    </div>
</div>

<!-- Modal -->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>

  
		$(document).ready(function(){
                $.ajax({
                    type: 'POST',
					url: "<?php echo site_url('upload.php')?>",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function (msg) {

						if(msg==0){
							
							alert('File Gagal Upload');
						}else if(msg==2){
							
							alert('File Sudah Ada');
						}else{
							
			
					//	var curl = 'Link : <a href="'+'<?php echo base_url() ?>'+msg+'" target="_blank" >'+fileupload+'</a>';
							//document.getElementById("lblinkE1_"+cno).innerHTML=curl;	
							
						
							
							var urll = '<?php echo base_url(); ?>kapip-penilaian/simpan-file';
								$.ajax({url:urll,
									 dataType:'json',
									 type: "POST",
									 data: formData,
									 contentType: false,
									 processData: false,
									 success:function(data){
									 
										if(data==0){
											alert("Data Gagal Diupload");
										}else{
											
											alert("File Berhasil Diupload");
											
																								
												$.ajax({  
												  url: '<?php echo base_url('kapip-penilaian/get-elemen1'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
												  type: 'POST',
												  success: function(data){
													$("#data-elemen-1").html(data);
												  }
												});	
											
											
										}
									 }
									 
									});  
							
						}
						                  
                        document.getElementById("form-elemen1").reset();			
					
					},
                    error: function () {
                        alert("Data Gagal Diupload");
                    }
                });
            });
        }	
	
	}	
		
	});	

 
	


	
</script>



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


//cekdni

	$('#cblevel').change(function(data) {			

			var cinstansi= '<?=$kode ?>';
			var ctahun= '<?= $tahun ?>';
			
			var chide1= '<?= $elemen['e1'] ?>';
			var chide2= '<?= $elemen['e2'] ?>';
			var chide3= '<?= $elemen['e3'] ?>';
			var chide4= '<?= $elemen['e4'] ?>';
			var chide5= '<?= $elemen['e5'] ?>';
			var chide6= '<?= $elemen['e6'] ?>';
						
			var level = (document.getElementById('cblevel').value); 
			
			
				if(level==1){ 
					clevel='( Level 1 )';
				}else if(level==2){
					clevel='( Level 2 )';
					
				}else if(level==3){
					clevel='( Level 3 )';
				}else if(level==4){
					clevel='( Level 4 )';
				}else if(level==5){
					clevel='( Level 5 )';
				}else{
					clevel='';
				}
					

				if(chide1>=1){
					document.getElementById("lbinfo1").innerHTML=clevel;
					
					$.ajax({  
					  url: '<?php echo base_url('kapip-penilaian/get-elemen1'); ?>/'+ctahun+'/'+cinstansi+'/'+level,
					  type: 'POST',
					  success: function(data){
						$("#data-elemen-1").html(data);
						
					  }
					});	
					
				}

				if(chide2>=1){
					document.getElementById("lbinfo2").innerHTML=clevel;
					$.ajax({  
					  url: '<?php echo base_url('kapip-penilaian/get-elemen2'); ?>/'+ctahun+'/'+cinstansi+'/'+level,
					  type: 'POST',
					  success: function(data){
						$("#data-elemen-2").html(data);
					  }
					});
				}

				if(chide3>=1){
					document.getElementById("lbinfo3").innerHTML=clevel;
					$.ajax({  
					  url: '<?php echo base_url('kapip-penilaian/get-elemen3'); ?>/'+ctahun+'/'+cinstansi+'/'+level,
					  type: 'POST',
					  success: function(data){
						$("#data-elemen-3").html(data);
					  }
					});
				}

				if(chide4>=1){
					document.getElementById("lbinfo4").innerHTML=clevel;
					$.ajax({  
					  url: '<?php echo base_url('kapip-penilaian/get-elemen4'); ?>/'+ctahun+'/'+cinstansi+'/'+level,
					  type: 'POST',
					  success: function(data){
						$("#data-elemen-4").html(data);
					  }
					});
				}

				if(chide5>=1){
					document.getElementById("lbinfo5").innerHTML=clevel;
					$.ajax({  
					  url: '<?php echo base_url('kapip-penilaian/get-elemen5'); ?>/'+ctahun+'/'+cinstansi+'/'+level,
					  type: 'POST',
					  success: function(data){
						$("#data-elemen-5").html(data);
					  }
					});
				}

				if(chide6>=1){
					document.getElementById("lbinfo6").innerHTML=clevel;
					$.ajax({  
					  url: '<?php echo base_url('kapip-penilaian/get-elemen6'); ?>/'+ctahun+'/'+cinstansi+'/'+level,
					  type: 'POST',
					  success: function(data){
						$("#data-elemen-6").html(data);
					  }
					});
				}
				

					
					
				
					$.ajax({
						type: 'POST',
						data: ({ctahun,cinstansi,level}),
						dataType: "json",
						url: "<?php echo base_url(); ?>kapip-penilaian/status-simpulan",
						success: function(data) {
						   var cstatus = data; 

							if(chide1>=1){
								document.getElementById("lbinforead1").innerHTML=cstatus;
							}
										
							if(chide1>=2){
								document.getElementById("lbinforead2").innerHTML=cstatus;
							}

							if(chide1>=3){
								document.getElementById("lbinforead3").innerHTML=cstatus;
							}

							if(chide1>=4){
								document.getElementById("lbinforead4").innerHTML=cstatus;
							}

							if(chide1>=5){
								document.getElementById("lbinforead5").innerHTML=cstatus;
							}

							if(chide1>=6){
								document.getElementById("lbinforead6").innerHTML=cstatus;
							}

						}
					});		

						

				

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


	function changepilihan($cnilai,$index,$cnmcheck){
		$cnm=('cek4_'+$cnmcheck);
		
		var cst1 = document.getElementById($cnm).checked;
			if (cst1==false){
			   $cnilai=0;
			}else{
				$cnilai=1;
			}	
	
		
		var myTable = document.getElementById("data-profil-4");

			content=$cnilai;
		var rn=$index;
		var cn=1;

			var x=document.getElementById('data-profil-4').rows[parseInt(rn,10)].cells;
			x[parseInt(cn,10)].innerHTML=content;
			
			
		
	}




$(document).on("click", ".simpan-simpulan", function(e) {
	 var data = $('#form-simpulan1').serialize();
/* 	 var clevel = $('#cblevel').val();*/

	 var ctahun = $('#ptahun').val();
	 var cinstansi = $('#pkdinstansi').val();  	 
	 var clevel        = $(this).attr("data-level"); 

	var cst1 = document.getElementById('chsimpulan_'+clevel).checked;
				if (cst1==false){
				   csimpulan=0;
				}else{
					csimpulan=1;
				}
		
			$.ajax({
					type: 'POST',
					data: ({ctahun,cinstansi,clevel,csimpulan}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-penilaian/simpan-simpulan1",
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
					 
						reload_all_level();
					}
			});
				
		e.preventDefault();
		
	});	





$(document).on("click", ".simpan-elemen1", function(e) {
	 var data = $('#form-elemen1').serialize();
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
				
		/* for (var r = 1, n = cjmltopik; r <= n; r++) {
				
				var cspl = document.getElementById('chsimpulE1_'+r).checked;
				if (cspl==false){
				    xsimpul=0;
				}else{
					xsimpul=1;
				}
				
				var csimpulan = csimpulan+'#'+xsimpul;
				var ckdtopik1 = ckdtopik1+'#'+$('#hkd_topiksimpulE1_'+r).val();
			}		 */		
			
			
			
			
			
			
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
					//data: ({ctahun,cinstansi,clevel,ckdtopik,ckdpenilaian,curaian,cjawaban,csimpulan,ckdtopik1}),
					
					data: ({ctahun,cinstansi,clevel,ckdtopik,ckdpenilaian,curaian,cjawaban}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-penilaian/simpan-elemen1",
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
							  url: '<?php echo base_url('kapip-penilaian/get-elemen1'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
							  type: 'POST',
							  success: function(data){
							  $("#data-elemen-1").html(data);
							  }
							});			
						
					 
					}
			});
				
		e.preventDefault();
		
	});	





$(document).on("click", ".simpan-elemen2", function(e) {
	 var data = $('#form-elemen2').serialize();
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
				
		/* for (var r = 1, n = cjmltopik; r <= n; r++) {
				
				var cspl = document.getElementById('chsimpulE2_'+r).checked;
				if (cspl==false){
				    xsimpul=0;
				}else{
					xsimpul=1;
				}
				
				var csimpulan = csimpulan+'#'+xsimpul;
				var ckdtopik1 = ckdtopik1+'#'+$('#hkd_topiksimpulE2_'+r).val();
			}		 */		
			
			
			
			
			
			
			for (var r = 1, n = cjml; r <= n; r++) {

				var cpenjelasan = $('#cpenjelasanE2_'+r).val();  
				if(cpenjelasan==''){
					cst1 = false;
				}else{
					var cst1 = document.getElementById('cpilihanE2_'+r).checked;
				}
				
				
				if (cst1==false){
				   xjawaban=0;
				}else{
					xjawaban=1;
				}
				
				var ckdtopik = ckdtopik+'#'+$('#hkd_topikE2_'+r).val();
				var ckdpenilaian = ckdpenilaian+'#'+$('#hkd_penilaianE2_'+r).val();  
				var curaian = curaian+'#'+$('#uraianE2_'+r).val();
				var cjawaban = cjawaban+'#'+xjawaban;
				
			
			}
			

	
			$.ajax({
					type: 'POST',
					
					data: ({ctahun,cinstansi,clevel,ckdtopik,ckdpenilaian,curaian,cjawaban}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-penilaian/simpan-elemen2",
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
							  url: '<?php echo base_url('kapip-penilaian/get-elemen2'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
							  type: 'POST',
							  success: function(data){
							  $("#data-elemen-2").html(data);
							  }
							});			
						
					 
					}
			});
				
		e.preventDefault();
		
	});	




$(document).on("click", ".simpan-elemen3", function(e) {
	 var data = $('#form-elemen3').serialize();
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

				var cpenjelasan = $('#cpenjelasanE3_'+r).val();  
				if(cpenjelasan==''){
					cst1 = false;
				}else{
					var cst1 = document.getElementById('cpilihanE3_'+r).checked;
				}
				
				
				if (cst1==false){
				   xjawaban=0;
				}else{
					xjawaban=1;
				}
				
				var ckdtopik = ckdtopik+'#'+$('#hkd_topikE3_'+r).val();
				var ckdpenilaian = ckdpenilaian+'#'+$('#hkd_penilaianE3_'+r).val();  
				var curaian = curaian+'#'+$('#uraianE3_'+r).val();
				var cjawaban = cjawaban+'#'+xjawaban;
				
			
			}
			

	
			$.ajax({
					type: 'POST',
					data: ({ctahun,cinstansi,clevel,ckdtopik,ckdpenilaian,curaian,cjawaban}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-penilaian/simpan-elemen3",
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
							  url: '<?php echo base_url('kapip-penilaian/get-elemen3'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
							  type: 'POST',
							  success: function(data){
							  $("#data-elemen-3").html(data);
							  }
							});			
						
					 
					}
			});
				
		e.preventDefault();
		
	});	



$(document).on("click", ".simpan-elemen4", function(e) {
	 var data = $('#form-elemen4').serialize();
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
				
		/* for (var r = 1, n = cjmltopik; r <= n; r++) {
				
				var cspl = document.getElementById('chsimpulE4_'+r).checked;
				if (cspl==false){
				    xsimpul=0;
				}else{
					xsimpul=1;
				}
				
				var csimpulan = csimpulan+'#'+xsimpul;
				var ckdtopik1 = ckdtopik1+'#'+$('#hkd_topiksimpulE4_'+r).val();
			}		 */		
			
			
			
			
			
			
			for (var r = 1, n = cjml; r <= n; r++) {

				var cpenjelasan = $('#cpenjelasanE4_'+r).val();  
				if(cpenjelasan==''){
					cst1 = false;
				}else{
					var cst1 = document.getElementById('cpilihanE4_'+r).checked;
				}
				
				
				if (cst1==false){
				   xjawaban=0;
				}else{
					xjawaban=1;
				}
				
				var ckdtopik = ckdtopik+'#'+$('#hkd_topikE4_'+r).val();
				var ckdpenilaian = ckdpenilaian+'#'+$('#hkd_penilaianE4_'+r).val();  
				var curaian = curaian+'#'+$('#uraianE4_'+r).val();
				var cjawaban = cjawaban+'#'+xjawaban;
				
			
			}
			

	
			$.ajax({
					type: 'POST',
					//data: ({ctahun,cinstansi,clevel,ckdtopik,ckdpenilaian,curaian,cjawaban,csimpulan,ckdtopik1}),
					
					data: ({ctahun,cinstansi,clevel,ckdtopik,ckdpenilaian,curaian,cjawaban}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-penilaian/simpan-elemen4",
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
							  url: '<?php echo base_url('kapip-penilaian/get-elemen4'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
							  type: 'POST',
							  success: function(data){
							  $("#data-elemen-4").html(data);
							  }
							});			
						
					 
					}
			});
				
		e.preventDefault();
		
	});	




$(document).on("click", ".simpan-elemen5", function(e) {
	 var data = $('#form-elemen5').serialize();
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
				
		/* for (var r = 1, n = cjmltopik; r <= n; r++) {
				
				var cspl = document.getElementById('chsimpulE5_'+r).checked;
				if (cspl==false){
				    xsimpul=0;
				}else{
					xsimpul=1;
				}
				
				var csimpulan = csimpulan+'#'+xsimpul;
				var ckdtopik1 = ckdtopik1+'#'+$('#hkd_topiksimpulE5_'+r).val();
			}		 */		
			
			
			
			
			
			
			for (var r = 1, n = cjml; r <= n; r++) {

				var cpenjelasan = $('#cpenjelasanE5_'+r).val();  
				if(cpenjelasan==''){
					cst1 = false;
				}else{
					var cst1 = document.getElementById('cpilihanE5_'+r).checked;
				}
				
				
				if (cst1==false){
				   xjawaban=0;
				}else{
					xjawaban=1;
				}
				
				var ckdtopik = ckdtopik+'#'+$('#hkd_topikE5_'+r).val();
				var ckdpenilaian = ckdpenilaian+'#'+$('#hkd_penilaianE5_'+r).val();  
				var curaian = curaian+'#'+$('#uraianE5_'+r).val();
				var cjawaban = cjawaban+'#'+xjawaban;
				
			
			}
			

	
			$.ajax({
					type: 'POST',
					//data: ({ctahun,cinstansi,clevel,ckdtopik,ckdpenilaian,curaian,cjawaban,csimpulan,ckdtopik1}),
					
					data: ({ctahun,cinstansi,clevel,ckdtopik,ckdpenilaian,curaian,cjawaban}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-penilaian/simpan-elemen5",
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
							  url: '<?php echo base_url('kapip-penilaian/get-elemen5'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
							  type: 'POST',
							  success: function(data){
							  $("#data-elemen-5").html(data);
							  }
							});			
						
					 
					}
			});
				
		e.preventDefault();
		
	});	



$(document).on("click", ".simpan-elemen6", function(e) {
	 var data = $('#form-elemen6').serialize();
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
				
		/* for (var r = 1, n = cjmltopik; r <= n; r++) {
				
				var cspl = document.getElementById('chsimpulE6_'+r).checked;
				if (cspl==false){
				    xsimpul=0;
				}else{
					xsimpul=1;
				}
				
				var csimpulan = csimpulan+'#'+xsimpul;
				var ckdtopik1 = ckdtopik1+'#'+$('#hkd_topiksimpulE6_'+r).val();
			}		 */		
			
			
			
			
			
			
			for (var r = 1, n = cjml; r <= n; r++) {

				var cpenjelasan = $('#cpenjelasanE6_'+r).val();  
				if(cpenjelasan==''){
					cst1 = false;
				}else{
					var cst1 = document.getElementById('cpilihanE6_'+r).checked;
				}
				
				
				if (cst1==false){
				   xjawaban=0;
				}else{
					xjawaban=1;
				}
				
				var ckdtopik = ckdtopik+'#'+$('#hkd_topikE6_'+r).val();
				var ckdpenilaian = ckdpenilaian+'#'+$('#hkd_penilaianE6_'+r).val();  
				var curaian = curaian+'#'+$('#uraianE6_'+r).val();
				var cjawaban = cjawaban+'#'+xjawaban;
				
			
			}
			

	
			$.ajax({
					type: 'POST',
					//data: ({ctahun,cinstansi,clevel,ckdtopik,ckdpenilaian,curaian,cjawaban,csimpulan,ckdtopik1}),
					
					data: ({ctahun,cinstansi,clevel,ckdtopik,ckdpenilaian,curaian,cjawaban}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-penilaian/simpan-elemen6",
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
							  url: '<?php echo base_url('kapip-penilaian/get-elemen6'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
							  type: 'POST',
							  success: function(data){
							  $("#data-elemen-6").html(data);
							  }
							});			
						
					 
					}
			});
				
		e.preventDefault();
		
	});	




$(document).on("click", ".simpan-verif", function(e) {
	// var data = $('#form-elemen6').serialize();
	 var clevel 		= $('#cblevel').val();
	 var ctahun 		= $('#ptahun').val();
	 var cinstansi 		= $('#pkdinstansi').val(); 
	 
	 var celemen		= $(this).attr("data-elemen"); 
	 var ctopik        	= $(this).attr("data-topik"); 
	 var cpenilaian     = $(this).attr("data-penilaian"); 
	 var cnomor     	= $(this).attr("data-nomor");

	 
	 var cverifikasi 	= $('#cverifikasiE'+celemen+'_'+cnomor).val();
	 var catatan 	= $('#catatanE'+celemen+'_'+cnomor).val();
	 
	 
 		Swal.fire({
              title: 'Apakah anda yakin?',
              text: "Verifikasi Data Penilaian Ini..?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#074979',
              cancelButtonColor: '#d33',
              cancelButtonText: 'Batal',
              confirmButtonText: 'Ya, Verifikasi Data.'
            }).then((result) => {
              if (result.value) {	

	
			$.ajax({
					type: 'POST',
					data: ({ctahun,cinstansi,celemen,clevel,ctopik,cpenilaian,cverifikasi,catatan}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-penilaian/simpan-verif",
					success: function(data) {
					   var status = data;  
					   var pesan = "Berhasil Di Verifikasi";
					   
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: pesan,
							showConfirmButton: false,
							timer: 2000
						});

					if(celemen==1){
						$.ajax({  
							  url: '<?php echo base_url('kapip-penilaian/get-elemen1'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
							  type: 'POST',
							  success: function(data){
							  $("#data-elemen-1").html(data);
							  document.getElementById("det_topikE1_"+ctopik).open = true;
							  document.getElementById("det_penilaianE1_"+ctopik+'_'+cnomor).open = true;
							  
							  }
							});	
						
					}else if(celemen==2){
						$.ajax({  
							  url: '<?php echo base_url('kapip-penilaian/get-elemen2'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
							  type: 'POST',
							  success: function(data){
							  $("#data-elemen-2").html(data);
							  document.getElementById("det_topikE2_"+ctopik).open = true;
							  document.getElementById("det_penilaianE2_"+ctopik+'_'+cnomor).open = true;
							  
							  }
							});	
						
					}else if(celemen==3){
						$.ajax({  
							  url: '<?php echo base_url('kapip-penilaian/get-elemen3'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
							  type: 'POST',
							  success: function(data){
							  $("#data-elemen-3").html(data);
							  document.getElementById("det_topikE3_"+ctopik).open = true;
							  document.getElementById("det_penilaianE3_"+ctopik+'_'+cnomor).open = true;
							  
							  }
							});	
						
					}else if(celemen==4){
						$.ajax({  
							  url: '<?php echo base_url('kapip-penilaian/get-elemen4'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
							  type: 'POST',
							  success: function(data){
							  $("#data-elemen-4").html(data);
							  document.getElementById("det_topikE4_"+ctopik).open = true;
							  document.getElementById("det_penilaianE4_"+ctopik+'_'+cnomor).open = true;
							  
							  }
							});	
						
					}else if(celemen==5){
						$.ajax({  
							  url: '<?php echo base_url('kapip-penilaian/get-elemen5'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
							  type: 'POST',
							  success: function(data){
							  $("#data-elemen-5").html(data);
							  document.getElementById("det_topikE5_"+ctopik).open = true;
							  document.getElementById("det_penilaianE5_"+ctopik+'_'+cnomor).open = true;
							  
							  }
							});	
						
					}else{
						$.ajax({  
							  url: '<?php echo base_url('kapip-penilaian/get-elemen6'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
							  type: 'POST',
							  success: function(data){
							  $("#data-elemen-6").html(data);
							  document.getElementById("det_topikE6_"+ctopik).open = true;
							  document.getElementById("det_penilaianE6_"+ctopik+'_'+cnomor).open = true;
							  
							  }
							});	
						
					}

						
					
					 
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


function uploadFileE1(celemen,cno,xno,utopik)
{
		
		 
		 var data = $('#form-elemen1').serialize();

			 const fileupload 	=$('#fileuploadE1_'+cno+'_'+xno).prop('files')[0]; 
			 var   cfileupload  =$('#fileuploadE1_'+cno+'_'+xno).val();  
			 var   curaian 		=$('#uraianE1_'+cno+'_'+xno).val(); 
			 
		if(cfileupload==''){
			
			pesan=('File Upload masih kosong');
			return;
			
		}else if(curaian==''){
			
			alert('Keterangan tidak boleh kosong');	
				return;
			
		}else {

				var ctahun 		= $('#ptahun').val();
				var cinstansi 	= $('#pkdinstansi').val();
				var celemen 	= celemen;
				var clevel 		= $('#cblevel').val();			
				var ctopik 		= $('#hkd_topikE1_'+cno).val(); 
				var cpenilaian 	= $('#hkd_penilaianE1_'+cno).val(); 
				var cpenilaian 	= $('#hkd_penilaianE1_'+cno).val(); 
				
					
				if (fileupload!="") {	
					let formData = new FormData();
					formData.append('fileupload', fileupload);
				   // formData.append('nama_file', nama_file);
					formData.append('ctahun', ctahun);
					formData.append('cinstansi', cinstansi);
					formData.append('celemen', celemen);
					formData.append('clevel', clevel);
					formData.append('ctopik', ctopik);
					formData.append('cpenilaian', cpenilaian);
					formData.append('curaian', curaian);
	  
				$(document).ready(function(){
					$.ajax({
						type: 'POST',
						url: "<?php echo site_url('upload.php')?>",
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
								
								document.getElementById("uraianE1_"+cno+'_'+xno).style.display = "none";
								
							}else if(msg==3){
								pesan="File Terlalu Besar";
								
								Swal.fire({
									position: 'top-end',
									icon: 'warning',
									title: pesan,
									showConfirmButton: false,
									timer: 2000
								});
								
								document.getElementById("uraianE1_"+cno+'_'+xno).style.display = "none";
								
							}else{
																
								var urll = '<?php echo base_url(); ?>kapip-penilaian/simpan-file';
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
												document.getElementById("uraianE1_"+cno+'_'+xno).style.display = "none";
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
													  url: '<?php echo base_url('kapip-penilaian/get-elemen1'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
													  type: 'POST',
													  success: function(data){
														$("#data-elemen-1").html(data);
														
														document.getElementById("det_topikE1_"+utopik).open = true;
														document.getElementById("det_penilaianE1_"+utopik+'_'+cno).open = true;
														
													  }
													});	
												
												
											}
										 }
										 
										});  
								
							}
										

									
										
							document.getElementById("form-elemen1").reset();			
						
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






		function reload_all_level(){
			

			var cinstansi= '<?=$kode ?>';
			var ctahun= '<?= $tahun ?>';				
		
			var chide1= '<?= $elemen['e1'] ?>';
			var chide2= '<?= $elemen['e2'] ?>';
			var chide3= '<?= $elemen['e3'] ?>';
			var chide4= '<?= $elemen['e4'] ?>';
			var chide5= '<?= $elemen['e5'] ?>';
			var chide6= '<?= $elemen['e6'] ?>';
						
			var level = (document.getElementById('cblevel').value); 
			
			
				if(level==1){ 
					clevel='( Level 1 )';
				}else if(level==2){
					clevel='( Level 2 )';
					
				}else if(level==3){
					clevel='( Level 3 )';
				}else if(level==4){
					clevel='( Level 4 )';
				}else if(level==5){
					clevel='( Level 5 )';
				}else{
					clevel='';
				}
					

				if(chide1>=1){
					document.getElementById("lbinfo1").innerHTML=clevel;
					
					$.ajax({  
					  url: '<?php echo base_url('kapip-penilaian/get-elemen1'); ?>/'+ctahun+'/'+cinstansi+'/'+level,
					  type: 'POST',
					  success: function(data){
						$("#data-elemen-1").html(data);
						
					  }
					});	
					
				}

				if(chide2>=1){
					document.getElementById("lbinfo2").innerHTML=clevel;
					$.ajax({  
					  url: '<?php echo base_url('kapip-penilaian/get-elemen2'); ?>/'+ctahun+'/'+cinstansi+'/'+level,
					  type: 'POST',
					  success: function(data){
						$("#data-elemen-2").html(data);
					  }
					});
				}

				if(chide3>=1){
					document.getElementById("lbinfo3").innerHTML=clevel;
					$.ajax({  
					  url: '<?php echo base_url('kapip-penilaian/get-elemen3'); ?>/'+ctahun+'/'+cinstansi+'/'+level,
					  type: 'POST',
					  success: function(data){
						$("#data-elemen-3").html(data);
					  }
					});
				}

				if(chide4>=1){
					document.getElementById("lbinfo4").innerHTML=clevel;
					$.ajax({  
					  url: '<?php echo base_url('kapip-penilaian/get-elemen4'); ?>/'+ctahun+'/'+cinstansi+'/'+level,
					  type: 'POST',
					  success: function(data){
						$("#data-elemen-4").html(data);
					  }
					});
				}

				if(chide5>=1){
					document.getElementById("lbinfo5").innerHTML=clevel;
					$.ajax({  
					  url: '<?php echo base_url('kapip-penilaian/get-elemen5'); ?>/'+ctahun+'/'+cinstansi+'/'+level,
					  type: 'POST',
					  success: function(data){
						$("#data-elemen-5").html(data);
					  }
					});
				}

				if(chide6>=1){
					document.getElementById("lbinfo6").innerHTML=clevel;
					$.ajax({  
					  url: '<?php echo base_url('kapip-penilaian/get-elemen6'); ?>/'+ctahun+'/'+cinstansi+'/'+level,
					  type: 'POST',
					  success: function(data){
						$("#data-elemen-6").html(data);
					  }
					});
				}
				

					
					
				
					$.ajax({
						type: 'POST',
						data: ({ctahun,cinstansi,level}),
						dataType: "json",
						url: "<?php echo base_url(); ?>kapip-penilaian/status-simpulan",
						success: function(data) {
						   var cstatus = data; 

							if(chide1>=1){
								document.getElementById("lbinforead1").innerHTML=cstatus;
							}
										
							if(chide1>=2){
								document.getElementById("lbinforead2").innerHTML=cstatus;
							}

							if(chide1>=3){
								document.getElementById("lbinforead3").innerHTML=cstatus;
							}

							if(chide1>=4){
								document.getElementById("lbinforead4").innerHTML=cstatus;
							}

							if(chide1>=5){
								document.getElementById("lbinforead5").innerHTML=cstatus;
							}

							if(chide1>=6){
								document.getElementById("lbinforead6").innerHTML=cstatus;
							}

						}
					});		

					
					
		}



		function EditFileE1(ctahun,cinstansi,celemen,ctopik,clevel,cpenilaian,cfile,cnmfile,curutnilai,curutfile)
		{				 
			
			var   curaian = $('#uraianE1_'+curutnilai+'_'+curutfile).val(); 

			var data = $('#form-elemen1').serialize();
			let formData = new FormData();
			formData.append('ctahun', ctahun);
			formData.append('cinstansi', cinstansi);
			formData.append('celemen', celemen);
			formData.append('clevel', clevel);
			formData.append('ctopik', ctopik);
			formData.append('cpenilaian', cpenilaian);
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
			
			

			var urll = '<?php echo base_url(); ?>kapip-penilaian/edit-file';
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
							
							pesan="File Berhasil Di Edit";

							Swal.fire({
							  position: 'top-end',
							  icon: 'success',
							  title: pesan,
							  showConfirmButton: false,
							  timer: 2000
							});							
								
								$.ajax({  
								  url: '<?php echo base_url('kapip-penilaian/get-elemen1'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
								  type: 'POST',
								  success: function(data){
									$("#data-elemen-1").html(data);
									
									document.getElementById("det_topikE1_"+ctopik).open = true;
									document.getElementById("det_penilaianE1_"+ctopik+'_'+curutnilai).open = true;
									
								  }
								});	
							
						
						}
					 }
					 
					}); 
			   }
            })					

		}


		function EditFileE2(ctahun,cinstansi,celemen,ctopik,clevel,cpenilaian,cfile,cnmfile,curutnilai,curutfile)
		{				 
			
			var   curaian = $('#uraianE2_'+curutnilai+'_'+curutfile).val(); 

			var data = $('#form-elemen2').serialize();
			let formData = new FormData();
			formData.append('ctahun', ctahun);
			formData.append('cinstansi', cinstansi);
			formData.append('celemen', celemen);
			formData.append('clevel', clevel);
			formData.append('ctopik', ctopik);
			formData.append('cpenilaian', cpenilaian);
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
			
			

			var urll = '<?php echo base_url(); ?>kapip-penilaian/edit-file';
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
							
							pesan="File Berhasil Di Edit";

							Swal.fire({
							  position: 'top-end',
							  icon: 'success',
							  title: pesan,
							  showConfirmButton: false,
							  timer: 2000
							});							
								
								$.ajax({  
								  url: '<?php echo base_url('kapip-penilaian/get-elemen2'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
								  type: 'POST',
								  success: function(data){
									$("#data-elemen-2").html(data);
									
									document.getElementById("det_topikE2_"+ctopik).open = true;
									document.getElementById("det_penilaianE2_"+ctopik+'_'+curutnilai).open = true;
									
								  }
								});	
							
						
						}
					 }
					 
					}); 
			   }
            })					

		}


		function EditFileE3(ctahun,cinstansi,celemen,ctopik,clevel,cpenilaian,cfile,cnmfile,curutnilai,curutfile)
		{				 
			
			var   curaian = $('#uraianE3_'+curutnilai+'_'+curutfile).val(); 

			var data = $('#form-elemen3').serialize();
			let formData = new FormData();
			formData.append('ctahun', ctahun);
			formData.append('cinstansi', cinstansi);
			formData.append('celemen', celemen);
			formData.append('clevel', clevel);
			formData.append('ctopik', ctopik);
			formData.append('cpenilaian', cpenilaian);
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
			
			

			var urll = '<?php echo base_url(); ?>kapip-penilaian/edit-file';
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
							
							pesan="File Berhasil Di Edit";

							Swal.fire({
							  position: 'top-end',
							  icon: 'success',
							  title: pesan,
							  showConfirmButton: false,
							  timer: 2000
							});							
								
								$.ajax({  
								  url: '<?php echo base_url('kapip-penilaian/get-elemen3'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
								  type: 'POST',
								  success: function(data){
									$("#data-elemen-3").html(data);
									
									document.getElementById("det_topikE3_"+ctopik).open = true;
									document.getElementById("det_penilaianE3_"+ctopik+'_'+curutnilai).open = true;
									
								  }
								});	
							
						
						}
					 }
					 
					}); 
			   }
            })					

		}


		function EditFileE4(ctahun,cinstansi,celemen,ctopik,clevel,cpenilaian,cfile,cnmfile,curutnilai,curutfile)
		{				 
			
			var   curaian = $('#uraianE4_'+curutnilai+'_'+curutfile).val(); 

			var data = $('#form-elemen4').serialize();
			let formData = new FormData();
			formData.append('ctahun', ctahun);
			formData.append('cinstansi', cinstansi);
			formData.append('celemen', celemen);
			formData.append('clevel', clevel);
			formData.append('ctopik', ctopik);
			formData.append('cpenilaian', cpenilaian);
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
			
			

			var urll = '<?php echo base_url(); ?>kapip-penilaian/edit-file';
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
							
							pesan="File Berhasil Di Edit";

							Swal.fire({
							  position: 'top-end',
							  icon: 'success',
							  title: pesan,
							  showConfirmButton: false,
							  timer: 2000
							});							
								
								$.ajax({  
								  url: '<?php echo base_url('kapip-penilaian/get-elemen4'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
								  type: 'POST',
								  success: function(data){
									$("#data-elemen-4").html(data);
									
									document.getElementById("det_topikE4_"+ctopik).open = true;
									document.getElementById("det_penilaianE4_"+ctopik+'_'+curutnilai).open = true;
									
								  }
								});	
							
						
						}
					 }
					 
					}); 
			   }
            })					

		}


		function EditFileE5(ctahun,cinstansi,celemen,ctopik,clevel,cpenilaian,cfile,cnmfile,curutnilai,curutfile)
		{				 
			
			var   curaian = $('#uraianE5_'+curutnilai+'_'+curutfile).val(); 

			var data = $('#form-elemen5').serialize();
			let formData = new FormData();
			formData.append('ctahun', ctahun);
			formData.append('cinstansi', cinstansi);
			formData.append('celemen', celemen);
			formData.append('clevel', clevel);
			formData.append('ctopik', ctopik);
			formData.append('cpenilaian', cpenilaian);
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
			
			

			var urll = '<?php echo base_url(); ?>kapip-penilaian/edit-file';
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
							
							pesan="File Berhasil Di Edit";

							Swal.fire({
							  position: 'top-end',
							  icon: 'success',
							  title: pesan,
							  showConfirmButton: false,
							  timer: 2000
							});							
								
								$.ajax({  
								  url: '<?php echo base_url('kapip-penilaian/get-elemen5'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
								  type: 'POST',
								  success: function(data){
									$("#data-elemen-5").html(data);
									
									document.getElementById("det_topikE5_"+ctopik).open = true;
									document.getElementById("det_penilaianE5_"+ctopik+'_'+curutnilai).open = true;
									
								  }
								});	
							
						
						}
					 }
					 
					}); 
			   }
            })					

		}


		function EditFileE6(ctahun,cinstansi,celemen,ctopik,clevel,cpenilaian,cfile,cnmfile,curutnilai,curutfile)
		{				 
			
			var   curaian = $('#uraianE6_'+curutnilai+'_'+curutfile).val(); 

			var data = $('#form-elemen6').serialize();
			let formData = new FormData();
			formData.append('ctahun', ctahun);
			formData.append('cinstansi', cinstansi);
			formData.append('celemen', celemen);
			formData.append('clevel', clevel);
			formData.append('ctopik', ctopik);
			formData.append('cpenilaian', cpenilaian);
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
			
			

			var urll = '<?php echo base_url(); ?>kapip-penilaian/edit-file';
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
							
							pesan="File Berhasil Di Edit";

							Swal.fire({
							  position: 'top-end',
							  icon: 'success',
							  title: pesan,
							  showConfirmButton: false,
							  timer: 2000
							});							
								
								$.ajax({  
								  url: '<?php echo base_url('kapip-penilaian/get-elemen5'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
								  type: 'POST',
								  success: function(data){
									$("#data-elemen-6").html(data);
									
									document.getElementById("det_topikE6_"+ctopik).open = true;
									document.getElementById("det_penilaianE6_"+ctopik+'_'+curutnilai).open = true;
									
								  }
								});	
							
						
						}
					 }
					 
					}); 
			   }
            })					

		}



		function hapusFileE1(ctahun,cinstansi,celemen,ctopik,clevel,cpenilaian,cfile,cnmfile,curutnilai)
		{				 
			
			var data = $('#form-elemen1').serialize();
			let formData = new FormData();
			formData.append('ctahun', ctahun);
			formData.append('cinstansi', cinstansi);
			formData.append('celemen', celemen);
			formData.append('clevel', clevel);
			formData.append('ctopik', ctopik);
			formData.append('cpenilaian', cpenilaian);
			formData.append('cfile', cfile);
			formData.append('cnmfile', cnmfile);
			
			//alert(curutnilai);return;
			
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
			
			

			var urll = '<?php echo base_url(); ?>kapip-penilaian/hapus-file';
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
								  url: '<?php echo base_url('kapip-penilaian/get-elemen1'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
								  type: 'POST',
								  success: function(data){
									$("#data-elemen-1").html(data);
									
									document.getElementById("det_topikE1_"+ctopik).open = true;
									document.getElementById("det_penilaianE1_"+ctopik+'_'+curutnilai).open = true;
									
								  }
								});	
							
						
						}
					 }
					 
					}); 
			   }
            })					

		}

		function hapusFileE2(ctahun,cinstansi,celemen,ctopik,clevel,cpenilaian,cfile,cnmfile,curutnilai)
		{				 
			
			var data = $('#form-elemen2').serialize();
			let formData = new FormData();
			formData.append('ctahun', ctahun);
			formData.append('cinstansi', cinstansi);
			formData.append('celemen', celemen);
			formData.append('clevel', clevel);
			formData.append('ctopik', ctopik);
			formData.append('cpenilaian', cpenilaian);
			formData.append('cfile', cfile);
			formData.append('cnmfile', cnmfile);
			
			//alert(curutnilai);return;
			
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
			
			

			var urll = '<?php echo base_url(); ?>kapip-penilaian/hapus-file';
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
								  url: '<?php echo base_url('kapip-penilaian/get-elemen2'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
								  type: 'POST',
								  success: function(data){
									$("#data-elemen-2").html(data);
									
									document.getElementById("det_topikE2_"+ctopik).open = true;
									document.getElementById("det_penilaianE2_"+ctopik+'_'+curutnilai).open = true;
									
								  }
								});	
							
						
						}
					 }
					 
					}); 
			   }
            })					

		}



		function hapusFileE3(ctahun,cinstansi,celemen,ctopik,clevel,cpenilaian,cfile,cnmfile,curutnilai)
		{				 
			
			var data = $('#form-elemen3').serialize();
			let formData = new FormData();
			formData.append('ctahun', ctahun);
			formData.append('cinstansi', cinstansi);
			formData.append('celemen', celemen);
			formData.append('clevel', clevel);
			formData.append('ctopik', ctopik);
			formData.append('cpenilaian', cpenilaian);
			formData.append('cfile', cfile);
			formData.append('cnmfile', cnmfile);
			
			//alert(curutnilai);return;
			
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
			
			

			var urll = '<?php echo base_url(); ?>kapip-penilaian/hapus-file';
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
								  url: '<?php echo base_url('kapip-penilaian/get-elemen3'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
								  type: 'POST',
								  success: function(data){
									$("#data-elemen-3").html(data);
									
									document.getElementById("det_topikE3_"+ctopik).open = true;
									document.getElementById("det_penilaianE3_"+ctopik+'_'+curutnilai).open = true;
									
								  }
								});	
							
						
						}
					 }
					 
					}); 
			   }
            })					

		}



		function hapusFileE4(ctahun,cinstansi,celemen,ctopik,clevel,cpenilaian,cfile,cnmfile,curutnilai)
		{				 
			
			var data = $('#form-elemen4').serialize();
			let formData = new FormData();
			formData.append('ctahun', ctahun);
			formData.append('cinstansi', cinstansi);
			formData.append('celemen', celemen);
			formData.append('clevel', clevel);
			formData.append('ctopik', ctopik);
			formData.append('cpenilaian', cpenilaian);
			formData.append('cfile', cfile);
			formData.append('cnmfile', cnmfile);
			
			//alert(curutnilai);return;
			
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
			
			

			var urll = '<?php echo base_url(); ?>kapip-penilaian/hapus-file';
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
								  url: '<?php echo base_url('kapip-penilaian/get-elemen4'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
								  type: 'POST',
								  success: function(data){
									$("#data-elemen-4").html(data);
									
									document.getElementById("det_topikE4_"+ctopik).open = true;
									document.getElementById("det_penilaianE4_"+ctopik+'_'+curutnilai).open = true;
									
								  }
								});	
							
						
						}
					 }
					 
					}); 
			   }
            })					

		}




		function hapusFileE5(ctahun,cinstansi,celemen,ctopik,clevel,cpenilaian,cfile,cnmfile,curutnilai)
		{				 
			
			var data = $('#form-elemen5').serialize();
			let formData = new FormData();
			formData.append('ctahun', ctahun);
			formData.append('cinstansi', cinstansi);
			formData.append('celemen', celemen);
			formData.append('clevel', clevel);
			formData.append('ctopik', ctopik);
			formData.append('cpenilaian', cpenilaian);
			formData.append('cfile', cfile);
			formData.append('cnmfile', cnmfile);
			
			//alert(curutnilai);return;
			
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
			
			

			var urll = '<?php echo base_url(); ?>kapip-penilaian/hapus-file';
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
								  url: '<?php echo base_url('kapip-penilaian/get-elemen5'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
								  type: 'POST',
								  success: function(data){
									$("#data-elemen-5").html(data);
									
									document.getElementById("det_topikE5_"+ctopik).open = true;
									document.getElementById("det_penilaianE5_"+ctopik+'_'+curutnilai).open = true;
									
								  }
								});	
							
						
						}
					 }
					 
					}); 
			   }
            })					

		}



		function hapusFileE6(ctahun,cinstansi,celemen,ctopik,clevel,cpenilaian,cfile,cnmfile,curutnilai)
		{				 
			
			var data = $('#form-elemen6').serialize();
			let formData = new FormData();
			formData.append('ctahun', ctahun);
			formData.append('cinstansi', cinstansi);
			formData.append('celemen', celemen);
			formData.append('clevel', clevel);
			formData.append('ctopik', ctopik);
			formData.append('cpenilaian', cpenilaian);
			formData.append('cfile', cfile);
			formData.append('cnmfile', cnmfile);
			
			//alert(curutnilai);return;
			
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
			
			

			var urll = '<?php echo base_url(); ?>kapip-penilaian/hapus-file';
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
								  url: '<?php echo base_url('kapip-penilaian/get-elemen6'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
								  type: 'POST',
								  success: function(data){
									$("#data-elemen-6").html(data);
									
									document.getElementById("det_topikE6_"+ctopik).open = true;
									document.getElementById("det_penilaianE6_"+ctopik+'_'+curutnilai).open = true;
									
								  }
								});	
							
						
						}
					 }
					 
					}); 
			   }
            })					

		}



function uploadFileE2(celemen,cno,xno,utopik)
{
		
		 
		 var data = $('#form-elemen2').serialize();

			 const fileupload 	=$('#fileuploadE2_'+cno+'_'+xno).prop('files')[0]; 
			 var   cfileupload  =$('#fileuploadE2_'+cno+'_'+xno).val();  
			 var   curaian 		=$('#uraianE2_'+cno+'_'+xno).val(); 
			 
		if(cfileupload==''){
			
			pesan=('File Upload masih kosong');
			return;
			
		}else if(curaian==''){
			
			alert('Keterangan tidak boleh kosong');	
				return;
			
		}else {

				var ctahun 		= $('#ptahun').val();
				var cinstansi 	= $('#pkdinstansi').val();
				var celemen 	= celemen;
				var clevel 		= $('#cblevel').val();			
				var ctopik 		= $('#hkd_topikE2_'+cno).val(); 
				var cpenilaian 	= $('#hkd_penilaianE2_'+cno).val(); 
				var cpenilaian 	= $('#hkd_penilaianE2_'+cno).val(); 
				
					
				if (fileupload!="") {	
					let formData = new FormData();
					formData.append('fileupload', fileupload);
				   // formData.append('nama_file', nama_file);
					formData.append('ctahun', ctahun);
					formData.append('cinstansi', cinstansi);
					formData.append('celemen', celemen);
					formData.append('clevel', clevel);
					formData.append('ctopik', ctopik);
					formData.append('cpenilaian', cpenilaian);
					formData.append('curaian', curaian);
	  
				$(document).ready(function(){
					$.ajax({
						type: 'POST',
						url: "<?php echo site_url('upload.php')?>",
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
								
								document.getElementById("uraianE2_"+cno+'_'+xno).style.display = "none";
								
							}else if(msg==3){
								pesan="File Terlalu Besar";
								
								Swal.fire({
									position: 'top-end',
									icon: 'warning',
									title: pesan,
									showConfirmButton: false,
									timer: 2000
								});
								
								document.getElementById("uraianE2_"+cno+'_'+xno).style.display = "none";
								
							}else{
																
								var urll = '<?php echo base_url(); ?>kapip-penilaian/simpan-file';
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
												document.getElementById("uraianE2_"+cno+'_'+xno).style.display = "none";
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
													  url: '<?php echo base_url('kapip-penilaian/get-elemen2'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
													  type: 'POST',
													  success: function(data){
														$("#data-elemen-2").html(data);
														
														document.getElementById("det_topikE2_"+utopik).open = true;
														document.getElementById("det_penilaianE2_"+utopik+'_'+cno).open = true;
														
													  }
													});	
												
												
											}
										 }
										 
										});  
								
							}
										

									
										
							document.getElementById("form-elemen2").reset();			
						
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



function uploadFileE3(celemen,cno,xno,utopik)
{
		
		 
		 var data = $('#form-elemen3').serialize();

			 const fileupload 	=$('#fileuploadE3_'+cno+'_'+xno).prop('files')[0]; 
			 var   cfileupload  =$('#fileuploadE3_'+cno+'_'+xno).val();  
			 var   curaian 		=$('#uraianE3_'+cno+'_'+xno).val(); 
			 
		if(cfileupload==''){
			
			pesan=('File Upload masih kosong');
			return;
			
		}else if(curaian==''){
			
			alert('Keterangan tidak boleh kosong');	
				return;
			
		}else {

				var ctahun 		= $('#ptahun').val();
				var cinstansi 	= $('#pkdinstansi').val();
				var celemen 	= celemen;
				var clevel 		= $('#cblevel').val();			
				var ctopik 		= $('#hkd_topikE3_'+cno).val(); 
				var cpenilaian 	= $('#hkd_penilaianE3_'+cno).val(); 
				var cpenilaian 	= $('#hkd_penilaianE3_'+cno).val(); 
				
					
				if (fileupload!="") {	
					let formData = new FormData();
					formData.append('fileupload', fileupload);
				   // formData.append('nama_file', nama_file);
					formData.append('ctahun', ctahun);
					formData.append('cinstansi', cinstansi);
					formData.append('celemen', celemen);
					formData.append('clevel', clevel);
					formData.append('ctopik', ctopik);
					formData.append('cpenilaian', cpenilaian);
					formData.append('curaian', curaian);
	  
				$(document).ready(function(){
					$.ajax({
						type: 'POST',
						url: "<?php echo site_url('upload.php')?>",
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
								
								document.getElementById("uraianE3_"+cno+'_'+xno).style.display = "none";
								
							}else if(msg==3){
								pesan="File Terlalu Besar";
								
								Swal.fire({
									position: 'top-end',
									icon: 'warning',
									title: pesan,
									showConfirmButton: false,
									timer: 2000
								});
								
								document.getElementById("uraianE3_"+cno+'_'+xno).style.display = "none";
								
							}else{
																
								var urll = '<?php echo base_url(); ?>kapip-penilaian/simpan-file';
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
												document.getElementById("uraianE3_"+cno+'_'+xno).style.display = "none";
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
													  url: '<?php echo base_url('kapip-penilaian/get-elemen3'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
													  type: 'POST',
													  success: function(data){
														$("#data-elemen-3").html(data);
														
														document.getElementById("det_topikE3_"+utopik).open = true;
														document.getElementById("det_penilaianE3_"+utopik+'_'+cno).open = true;
														
													  }
													});	
												
												
											}
										 }
										 
										});  
								
							}
										

									
										
							document.getElementById("form-elemen3").reset();			
						
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




function uploadFileE4(celemen,cno,xno,utopik)
{
		
		 
		 var data = $('#form-elemen4').serialize();

			 const fileupload 	=$('#fileuploadE4_'+cno+'_'+xno).prop('files')[0]; 
			 var   cfileupload  =$('#fileuploadE4_'+cno+'_'+xno).val();  
			 var   curaian 		=$('#uraianE4_'+cno+'_'+xno).val(); 
			 
		if(cfileupload==''){
			
			pesan=('File Upload masih kosong');
			return;
			
		}else if(curaian==''){
			
			alert('Keterangan tidak boleh kosong');	
				return;
			
		}else {

				var ctahun 		= $('#ptahun').val();
				var cinstansi 	= $('#pkdinstansi').val();
				var celemen 	= celemen;
				var clevel 		= $('#cblevel').val();			
				var ctopik 		= $('#hkd_topikE4_'+cno).val(); 
				var cpenilaian 	= $('#hkd_penilaianE4_'+cno).val(); 
				var cpenilaian 	= $('#hkd_penilaianE4_'+cno).val(); 
				
					
				if (fileupload!="") {	
					let formData = new FormData();
					formData.append('fileupload', fileupload);
				   // formData.append('nama_file', nama_file);
					formData.append('ctahun', ctahun);
					formData.append('cinstansi', cinstansi);
					formData.append('celemen', celemen);
					formData.append('clevel', clevel);
					formData.append('ctopik', ctopik);
					formData.append('cpenilaian', cpenilaian);
					formData.append('curaian', curaian);
	  
				$(document).ready(function(){
					$.ajax({
						type: 'POST',
						url: "<?php echo site_url('upload.php')?>",
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
								
								document.getElementById("uraianE4_"+cno+'_'+xno).style.display = "none";
								
							}else if(msg==3){
								pesan="File Terlalu Besar";
								
								Swal.fire({
									position: 'top-end',
									icon: 'warning',
									title: pesan,
									showConfirmButton: false,
									timer: 2000
								});
								
								document.getElementById("uraianE4_"+cno+'_'+xno).style.display = "none";
								
							}else{
																
								var urll = '<?php echo base_url(); ?>kapip-penilaian/simpan-file';
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
												document.getElementById("uraianE4_"+cno+'_'+xno).style.display = "none";
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
													  url: '<?php echo base_url('kapip-penilaian/get-elemen4'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
													  type: 'POST',
													  success: function(data){
														$("#data-elemen-4").html(data);
														
														document.getElementById("det_topikE4_"+utopik).open = true;
														document.getElementById("det_penilaianE4_"+utopik+'_'+cno).open = true;
														
													  }
													});	
												
												
											}
										 }
										 
										});  
								
							}
										

									
										
							document.getElementById("form-elemen4").reset();			
						
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




function uploadFileE5(celemen,cno,xno,utopik)
{
		
		 
		 var data = $('#form-elemen5').serialize();

			 const fileupload 	=$('#fileuploadE5_'+cno+'_'+xno).prop('files')[0]; 
			 var   cfileupload  =$('#fileuploadE5_'+cno+'_'+xno).val();  
			 var   curaian 		=$('#uraianE5_'+cno+'_'+xno).val(); 
			 
		if(cfileupload==''){
			
			pesan=('File Upload masih kosong');
			return;
			
		}else if(curaian==''){
			
			alert('Keterangan tidak boleh kosong');	
				return;
			
		}else {

				var ctahun 		= $('#ptahun').val();
				var cinstansi 	= $('#pkdinstansi').val();
				var celemen 	= celemen;
				var clevel 		= $('#cblevel').val();			
				var ctopik 		= $('#hkd_topikE5_'+cno).val(); 
				var cpenilaian 	= $('#hkd_penilaianE5_'+cno).val(); 
				var cpenilaian 	= $('#hkd_penilaianE5_'+cno).val(); 
				
					
				if (fileupload!="") {	
					let formData = new FormData();
					formData.append('fileupload', fileupload);
				   // formData.append('nama_file', nama_file);
					formData.append('ctahun', ctahun);
					formData.append('cinstansi', cinstansi);
					formData.append('celemen', celemen);
					formData.append('clevel', clevel);
					formData.append('ctopik', ctopik);
					formData.append('cpenilaian', cpenilaian);
					formData.append('curaian', curaian);
	  
				$(document).ready(function(){
					$.ajax({
						type: 'POST',
						url: "<?php echo site_url('upload.php')?>",
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
								
								document.getElementById("uraianE5_"+cno+'_'+xno).style.display = "none";
								
							}else if(msg==3){
								pesan="File Terlalu Besar";
								
								Swal.fire({
									position: 'top-end',
									icon: 'warning',
									title: pesan,
									showConfirmButton: false,
									timer: 2000
								});
								
								document.getElementById("uraianE5_"+cno+'_'+xno).style.display = "none";
								
							}else{
																
								var urll = '<?php echo base_url(); ?>kapip-penilaian/simpan-file';
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
												document.getElementById("uraianE5_"+cno+'_'+xno).style.display = "none";
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
													  url: '<?php echo base_url('kapip-penilaian/get-elemen5'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
													  type: 'POST',
													  success: function(data){
														$("#data-elemen-5").html(data);
														
														document.getElementById("det_topikE5_"+utopik).open = true;
														document.getElementById("det_penilaianE5_"+utopik+'_'+cno).open = true;
														
													  }
													});	
												
												
											}
										 }
										 
										});  
								
							}
										

									
										
							document.getElementById("form-elemen5").reset();			
						
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




function uploadFileE6(celemen,cno,xno,utopik)
{
		
		 
		 var data = $('#form-elemen6').serialize();

			 const fileupload 	=$('#fileuploadE6_'+cno+'_'+xno).prop('files')[0]; 
			 var   cfileupload  =$('#fileuploadE6_'+cno+'_'+xno).val();  
			 var   curaian 		=$('#uraianE6_'+cno+'_'+xno).val(); 
			 
		if(cfileupload==''){
			
			pesan=('File Upload masih kosong');
			return;
			
		}else if(curaian==''){
			
			alert('Keterangan tidak boleh kosong');	
				return;
			
		}else {

				var ctahun 		= $('#ptahun').val();
				var cinstansi 	= $('#pkdinstansi').val();
				var celemen 	= celemen;
				var clevel 		= $('#cblevel').val();			
				var ctopik 		= $('#hkd_topikE6_'+cno).val(); 
				var cpenilaian 	= $('#hkd_penilaianE6_'+cno).val(); 
				var cpenilaian 	= $('#hkd_penilaianE6_'+cno).val(); 
				
					
				if (fileupload!="") {	
					let formData = new FormData();
					formData.append('fileupload', fileupload);
				   // formData.append('nama_file', nama_file);
					formData.append('ctahun', ctahun);
					formData.append('cinstansi', cinstansi);
					formData.append('celemen', celemen);
					formData.append('clevel', clevel);
					formData.append('ctopik', ctopik);
					formData.append('cpenilaian', cpenilaian);
					formData.append('curaian', curaian);
	  
				$(document).ready(function(){
					$.ajax({
						type: 'POST',
						url: "<?php echo site_url('upload.php')?>",
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
								
								document.getElementById("uraianE6_"+cno+'_'+xno).style.display = "none";
								
							}else if(msg==3){
								pesan="File Terlalu Besar";
								
								Swal.fire({
									position: 'top-end',
									icon: 'warning',
									title: pesan,
									showConfirmButton: false,
									timer: 2000
								});
								
								document.getElementById("uraianE6_"+cno+'_'+xno).style.display = "none";
								
							}else{
																
								var urll = '<?php echo base_url(); ?>kapip-penilaian/simpan-file';
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
												document.getElementById("uraianE6_"+cno+'_'+xno).style.display = "none";
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
													  url: '<?php echo base_url('kapip-penilaian/get-elemen6'); ?>/'+ctahun+'/'+cinstansi+'/'+clevel,
													  type: 'POST',
													  success: function(data){
														$("#data-elemen-6").html(data);
														
														document.getElementById("det_topikE6_"+utopik).open = true;
														document.getElementById("det_penilaianE6_"+utopik+'_'+cno).open = true;
														
													  }
													});	
												
												
											}
										 }
										 
										});  
								
							}
										

									
										
							document.getElementById("form-elemen6").reset();			
						
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







 function hideRow(id) {
      var row = document.getElementById(id);
      row.style.display = 'none';
    }
	

    function toggleRow(id) {
      var row = document.getElementById(id);
	  
      if (row.style.display == '') {
        row.style.display = 'none';
      }
      else {
         row.style.display = '';
      }
    }
	

    function showRow(id) {
      var row = document.getElementById(id);
      row.style.display = '';
    }	

	
	
   function validateFormat(fileInput,celemen,cno,cnext){  

				document.getElementById("uraianE"+celemen+'_'+cno+'_'+cnext).style.display = "block";
                 
                var filePath = fileInput.value; 
                const fileSize = fileInput.files[0].size;
                const size = Math.round((fileSize / 3072)); 
				
                
                // Allowing file type 

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
				//	$('#dokumenE1_1').val('');
                    return false; 
                }
            
    }	
	
	

	
	function verifikasi(celemen,cno){
		
		div 	= document.getElementById("divCatatanE"+celemen+'_'+cno); 
		cverif	= $('#cverifikasiE'+celemen+'_'+cno).val();
		
		if(cverif==0){
			div.style.display = "none";
		}else{
			div.style.display = "block";
			
		}
		
	  
    }

	
	function checkPilihan(){
		
		var chpil1 = document.getElementById('cpilihanE1_1').checked;
		
	//	alert(chpil1);
		
		/* div 	= document.getElementById("divCatatanE1_"+cno); 
		cverif	= $('#cverifikasiE1_'+cno).val();
		
		if(cverif==0){
			div.style.display = "none";
		}else{
			div.style.display = "block";
			
		} */
		
	  
    }	


	function checkSimpulan(param){
		
		alert(param);
		
		//var chpil1 = document.getElementById('cpilihanE1_1').checked;
		
	//	alert(chpil1);
		
		/* div 	= document.getElementById("divCatatanE1_"+cno); 
		cverif	= $('#cverifikasiE1_'+cno).val();
		
		if(cverif==0){
			div.style.display = "none";
		}else{
			div.style.display = "block";
			
		} */
		
	  
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


	$('#role').select2({
		  placeholder: 'Jenis Uraian'
		});
		
		
		
	function showPengawasan(){	



			var ctahun 		= $('#ptahun').val();
			var cinstansi 	= $('#pkdinstansi').val();


			
	//		$('#ModalPengawasan').modal('show');	
			
		//	$('#ModalPengawasan').modal('toggle');
			$('#ModalPengawasan').modal('show');
			//$('#myModal').modal('hide');
		
			/* $.ajax({  
			  url: '<?php echo base_url('kapip-penilaian/get-pengawasan'); ?>/'+ctahun+'/'+cinstansi,
			  type: 'POST',
			  success: function(data){
				$("#data-pengawasan").html(data);
			   
			  }
			});	 */

			
	
	
	};
		

</script>    

