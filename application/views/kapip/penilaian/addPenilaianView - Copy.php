

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
  left: 41%;
  font-size: 10px;
  font-family: Verdana, sans-serif;
}
input:checked + .slider:after {
  content:'Ya';
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
								<h3 class="panel-title"><?=$instansi ?> &nbsp;Tahun <?= $tahun ?> </h3>
								
									
									<input type="hidden" name="ptahun"  value=<?= $tahun ?> class="form-control input-sm" id="ptahun" placeholder="">
									<input type="hidden" name="pkdinstansi"  value=<?= $kode ?> class="form-control input-sm" id="pkdinstansi" placeholder="">
								
								
								
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
			</div>
		</div>
	</div>

</div>  


<!-- 1 -->



<div class="swiffy-slider">
    <ul class="slider-container">
        <li>


			<div class="panel panel-headline  panel-primary">

				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<form class="form-horizontal" id="form-elemen1">
								<button name="btnp1" type="button" class="collapsible-form active-form">
								
										<div class="row">
												
											<div class="form-group"> 
												<div class="col-md-12">
												
												
													<div class="col-md-11"> 
															<h3 class="panel-title"><i class="fa fa-diamond" style="padding-left: 10px"></i> Elemen 1 : Pengelolaan SDM  <a id="lbinfo1" style="text-align: left;"></a> </h3>
									
													</div>
										
													<div class="col-md-1"> 
															<h3 class="panel-title"><i class="fa fa-chevron-right" aria-hidden="true" style="padding-left: 67px"></i></h3>
													</div>
										
													
												</div>

											</div>
											<div class="form-group">
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


		<!-- 2 -->

			<li>
			
			<div class="panel panel-headline  panel-primary">

				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<form class="form-horizontal" id="form-elemen2">
								<button name="btne2" type="button" class="collapsible-form active-form">
								
										<div class="row">
												
											<div class="form-group"> 
												<div class="col-md-12">
												
												
													<div class="col-md-11"> 
															<h3 class="panel-title"><i class="fa fa-chevron-left fa-20x" style="margin-left: -20px" aria-hidden="true"></i> <i class="fa fa-diamond" style="padding-left: 10px"></i> Elemen 2 : Praktik Profesional  <a id="lbinfo2" style="text-align: left;"></a> </h3>
															
													</div>
										
													<div class="col-md-1"> 
															<h3 class="panel-title"><i class="fa fa-chevron-right" aria-hidden="true" style="margin-left: 62px"></i></h3>
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

 
 
 			<!-- 3 -->

			<li>
			
			<div class="panel panel-headline  panel-primary">

				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<form class="form-horizontal" id="form-elemen2">
								<button name="btne3" type="button" class="collapsible-form active-form">
								
										<div class="row">
												
											<div class="form-group"> 
												<div class="col-md-12">
												
												
													<div class="col-md-11"> 
															<h3 class="panel-title"><i class="fa fa-chevron-left fa-20x" style="margin-left: -20px" aria-hidden="true"></i><i class="fa fa-diamond" style="padding-left: 10px"></i> Elemen 3 : Akuntabilitas dan Manajemen Kinerja  <a id="lbinfo3" style="text-align: left;"></a> </h3>
									
													</div>
										
													<div class="col-md-1"> 
															<h3 class="panel-title"><i class="fa fa-chevron-right" aria-hidden="true" style="padding-left: 67px"></i></h3>
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
 

<!-- 4 -->
			<li>
			
			<div class="panel panel-headline  panel-primary">

				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<form class="form-horizontal" id="form-elemen4">
								<button name="btne4" type="button" class="collapsible-form active-form">
								
										<div class="row">
												
											<div class="form-group"> 
												<div class="col-md-12">
												
												
													<div class="col-md-11"> 
															<h3 class="panel-title"><i class="fa fa-chevron-left fa-20x" style="margin-left: -20px" aria-hidden="true"></i><i class="fa fa-diamond" style="padding-left: 10px"></i> Elemen 4 : Budaya dan Hubungan Organisasi  <a id="lbinfo4" style="text-align: left;"></a> </h3>
									
													</div>
										
													<div class="col-md-1"> 
															<h3 class="panel-title"><i class="fa fa-chevron-right" aria-hidden="true" style="padding-left: 67px"></i></h3>
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
 

<!-- 5 -->


		<li>
			
			<div class="panel panel-headline  panel-primary">

				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<form class="form-horizontal" id="form-elemen5">
								<button name="btne5" type="button" class="collapsible-form active-form">
								
										<div class="row">
												
											<div class="form-group"> 
												<div class="col-md-12">
												
												
													<div class="col-md-11"> 
															<h3 class="panel-title"><i class="fa fa-chevron-left fa-20x" style="margin-left: -20px" aria-hidden="true"></i><i class="fa fa-diamond" style="padding-left: 10px"></i> Elemen 5 : Budaya dan Hubungan Organisasi  <a id="lbinfo5" style="text-align: left;"></a> </h3>
									
													</div>
										
													<div class="col-md-1"> 
															<h3 class="panel-title"><i class="fa fa-chevron-right" aria-hidden="true" style="padding-left: 67px"></i></h3>
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
 

<!-- 6 -->

		<li>
			
			<div class="panel panel-headline  panel-primary">

				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<form class="form-horizontal" id="form-elemen6">
								<button name="btnp1" type="button" class="collapsible-form active-form">
								
										<div class="row">
												
											<div class="form-group"> 
												<div class="col-md-12">
												
												
													<div class="col-md-11"> 
															<h3 class="panel-title"><i class="fa fa-chevron-left fa-20x" style="margin-left: -20px" aria-hidden="true"></i><i class="fa fa-diamond" style="padding-left: 10px"></i> Elemen 6 : Struktur Tata Kelola  <a id="lbinfo6" style="text-align: left;"></a> </h3>
									
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
								

							
							<div class="content-form" style="display:block;">
				
								<div class="asset-inner" id="data-elemen-6">
																	
								</div> 	
								

							</div>

						</div>
					</div>

				</div>
			</div>	


						


		</li>


<!-- 6 -->	



</ul>


	<button type="button" data-toggle="tooltip" data-placement="top" title="Elemen Sebelumnya"  class="slider-nav"></button>
    <button type="button" data-toggle="tooltip" data-placement="top" title="Elemen Selanjutnya" class="slider-nav slider-nav-next"></button>

    <div class="slider-indicators">
        <button class="active"></button>
        <button></button>
        <button></button>	
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
	



    $('#uploadx').submit(function() {		
		alert('toooos');		
	}); 
        
     /*    var bukti = $('#dokumentasi').val();
        var fileRAB = $("#rab").val();
        var fileSampul = $("#sampul").val();
        var no_kontrak = $("#no_kontrak").val();
        var nilai_kontrak = $("#nilai_kontrak").val();
        var kontraktor = $("#kontraktor").val();

        var ev = $(document.activeElement).attr('aksi');
		

		var thn        = $('#tahun_anggaran').val();
		var subkeg     = $('#kd_subkegiatan').val();
		var skpd       = $(kd_skpd).val();
		var rek        = $('#kode_rek').val();
		var po         = $('#kode_po').val();
		
		 var bukti = $('#dokumentasi').val();
        var kd_lamp    = bukti;

	  
        
            if (bukti == '' ) {
              
                Swal.fire({position: 'top-end',icon: 'warning',title: 'HARAP PILIH FILE TERLEBIH DAHULU',showConfirmButton: false,timer: 2000});
                $('.fileInputTemuan').focus();
                e.preventDefault();
                exit();
              

            }else{
				       
		
              $.ajax({
                method: 'POST',
                url: '<?php echo base_url('input-data-pemantauan-file'); ?>?thn='+thn+'&skpd='+skpd+'&subkeg='+subkeg+'&rek='+rek+'&po='+po+'&lamp='+kd_lamp,
 
                data: new FormData(this),
                contentType:false,
                cache : false,
                processData:false,
              })
			  
			  
              .done(function(data) {
                var out = jQuery.parseJSON(data);
                $("#isi_lampiran2").html(out.tableLampiran);
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: out.pesan,
                  showConfirmButton: false,
                  timer: 2000
                });
                var inputFile = $("#nm_lampiran2");
                inputFile.replaceWith(inputFile.val('').clone(true));
                 $('#dokumentasi').val('');
                  e.preventDefault();
              })
              e.preventDefault();
                

            } 
      
        
      }); */



// Upload file
function uploadFile() {	
	
		    var bukti = $('#filex').val();
            var kd_lamp    = bukti;
			//var data 		= $('#form-elemen1').serialize();
			var clevel 		= $('#cblevel').val();
			var ctahun 		= $('#ptahun').val();
			var cinstansi 	= $('#pkdinstansi').val(); 	 
			var cjml      	= $(this).attr("data-jml"); 
	 
			var ckdtopik = '1';
			var ckdpenilaian = '1';






$.ajax({
			type: 'POST',
			data: ({ctahun,cinstansi,clevel,ckdtopik,ckdpenilaian,kd_lamp}),
			dataType: "json",
			//data: new FormData(this),
			url: "<?php echo base_url(); ?>kapip-penilaian/simpan-file",
			success: function(data) {
			   var cdir = data; 
			   
			   
			//   alert(status);
			  // var pesan = "Berhasil Disimpan file";
			   
				/* Swal.fire({
					position: 'top-end',
					icon: 'success',
					title: pesan,
					showConfirmButton: false,
					timer: 2000
				}); */





   var files = document.getElementById("filex").files;
   if(files.length > 0 ){

      var formData = new FormData();
      formData.append("filex", files[0]);

      var xhttp = new XMLHttpRequest(); 

      // Set POST method and ajax file path
      xhttp.open("POST", "ajaxfile.php", true);

      // call on request changes state
      xhttp.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {

           var response = this.responseText;
		   
		  
           if(response == 1){
              alert("Upload successfully.");
           }else{
              alert("File not uploaded.");
           }
         }
      };

      // Send request with data
      xhttp.send(formData);

   }else{
      alert("Please select a file");
   }

			 
			}
	});





<?php

// ambil data file
/* $namaFile = $_FILES['filex']['name'];
$namaSementara = $_FILES['filex']['tmp_name'];
 */
//$message = "wrong answer";


//"<script type='text/javascript'>alert(".$message.");</script>";
/* 

if($namaFile<>''){
	

// tentukan lokasi file akan dipindahkan
$dirUpload = $cdir;

$target_file = $dirUpload . basename($_FILES['filex']['name']);

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if file already exists
if (file_exists($target_file)) {
  echo "File Sudah Ada.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES['filex']['size'] > 500000) {
  echo "Gaga Upload. File Terlalu Besar";
  $uploadOk = 0;
}


// Allow certain file formats  
if($imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Maaf, Format File tidak sesuai.";
  $uploadOk = 0;
}



// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Gagal Upload.";
// if everything is ok, try to upload file
} else {

// pindahkan file
	$terupload = move_uploaded_file($namaSementara, $dirUpload.$namaFile);
	if ($terupload) {
		echo "Upload berhasil!<br/>";
		echo "Link: <a href='".$dirUpload.$namaFile."'>".$namaFile."</a>";

	} else {	
		echo "Upload Gagal!";
	}

}

} */

?>









			

	
	
	
	
	/* 
   var files = document.getElementById("filex").files;
   if(files.length > 0 ){

      var formData = new FormData();
      formData.append("filex", files[0]);

      var xhttp = new XMLHttpRequest(); 

      // Set POST method and ajax file path
      xhttp.open("POST", "ajaxfile.php", true);

      // call on request changes state
      xhttp.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {

           var response = this.responseText;
		   
		  
           if(response == 1){
              alert("Upload successfully.");
           }else{
              alert("File not uploaded.");
           }
         }
      };

      // Send request with data
      xhttp.send(formData);

   }else{
      alert("Please select a file");
   }*/

}
 



	
	
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




	$('#cblevel').change(function(data) {			

			var cinstansi= '<?=$kode ?>';
			var ctahun= '<?= $tahun ?>';
			
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
						document.getElementById("lbinfo1").innerHTML=clevel;	
						document.getElementById("lbinfo2").innerHTML=clevel;	
 						document.getElementById("lbinfo3").innerHTML=clevel;	
						document.getElementById("lbinfo4").innerHTML=clevel;	
						document.getElementById("lbinfo5").innerHTML=clevel;	
						document.getElementById("lbinfo6").innerHTML=clevel; 	
		  
				$.ajax({  
				  url: '<?php echo base_url('kapip-penilaian/get-elemen1'); ?>/'+ctahun+'/'+cinstansi+'/'+level,
				  type: 'POST',
				  success: function(data){
					$("#data-elemen-1").html(data);
				  }
				});	


				$.ajax({  
				  url: '<?php echo base_url('kapip-penilaian/get-elemen2'); ?>/'+ctahun+'/'+cinstansi+'/'+level,
				  type: 'POST',
				  success: function(data){
					$("#data-elemen-2").html(data);
				  }
				});


				$.ajax({  
				  url: '<?php echo base_url('kapip-penilaian/get-elemen3'); ?>/'+ctahun+'/'+cinstansi+'/'+level,
				  type: 'POST',
				  success: function(data){
					$("#data-elemen-3").html(data);
				  }
				});

				$.ajax({  
				  url: '<?php echo base_url('kapip-penilaian/get-elemen4'); ?>/'+ctahun+'/'+cinstansi+'/'+level,
				  type: 'POST',
				  success: function(data){
					$("#data-elemen-4").html(data);
				  }
				});

				$.ajax({  
				  url: '<?php echo base_url('kapip-penilaian/get-elemen5'); ?>/'+ctahun+'/'+cinstansi+'/'+level,
				  type: 'POST',
				  success: function(data){
					$("#data-elemen-5").html(data);
				  }
				});

				$.ajax({  
				  url: '<?php echo base_url('kapip-penilaian/get-elemen6'); ?>/'+ctahun+'/'+cinstansi+'/'+level,
				  type: 'POST',
				  success: function(data){
					$("#data-elemen-6").html(data);
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



$(document).on("click", ".simpan-elemen1", function(e) {
	 var data = $('#form-elemen1').serialize();
	 var clevel = $('#cblevel').val();
	 var ctahun = $('#ptahun').val();
	 var cinstansi = $('#pkdinstansi').val(); 	 

	 var cjml        = $(this).attr("data-jml"); 
	
	
			var ckdtopik = '';
			var ckdpenilaian = '';
			var curaian = '';
			var cjawaban = '';
				
			for (var r = 1, n = cjml; r <= n; r++) {
				
				var cst1 = document.getElementById('cpilihanE1_'+r).checked;
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
					 
					}
			});
				
	




			var bukti 		= $('#dokumenE1_1').val();
			var ev		 	= $(document.activeElement).attr('aksi');
			var kd_lamp     = bukti;
			
/* alert(kd_lamp);
return; */

			var data 		= $('#form-elemen1').serialize();
			var clevel 		= $('#cblevel').val();
			var ctahun 		= $('#ptahun').val();
			var cinstansi 	= $('#pkdinstansi').val(); 	 
			var cjml      	= $(this).attr("data-jml"); 
	 
			var ckdtopik = '1';
			var ckdpenilaian = '1';
			

			$.ajax({
					type: 'POST',
					data: ({ctahun,cinstansi,clevel,ckdtopik,ckdpenilaian,kd_lamp}),
					dataType: "json",
					//data: new FormData(this),
					url: "<?php echo base_url(); ?>kapip-penilaian/simpan-file",
					success: function(data) {
					   var status = data; 
					   var pesan = "Berhasil Disimpan file";
					   
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: pesan,
							showConfirmButton: false,
							timer: 2000
						});
					 
					}
			});
			
			
			
			
/* 			 $.ajax({
                method: 'POST',
                url: '<?php echo base_url('kapip-penilaian/simpan-file'); ?>?ctahun='+ctahun+'&cinstansi='+cinstansi+'&clevel='+clevel+'&ckdtopik='+ckdtopik+'&ckdpenilaian='+ckdpenilaian+'&kd_lamp='+bukti,
                //data: FormData(this),
                contentType:false,
                cache : false,
                processData:false,
              }) */


       /*          var inputFile = $("#nm_dokumenE1_1");
                inputFile.replaceWith(inputFile.val('').clone(true)); */
	
		
		
	});	



$(document).on("click", ".simpan-elemen2", function(e) {
	 var data 		= $('#form-elemen2').serialize();
	 var clevel 	= $('#cblevel').val();
	 var ctahun 	= $('#ptahun').val();
	 var cinstansi 	= $('#pkdinstansi').val(); 	 
	 var cjml       = $(this).attr("data-jml"); 
	
	
			var ckdtopik = '';
			var ckdpenilaian = '';
			var curaian = '';
			var cjawaban = '';
				
			for (var r = 1, n = cjml; r <= n; r++) {
				
				var cst1 = document.getElementById('cpilihanE2_'+r).checked;
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
					 
					}
			});		
	});	




$(document).on("click", ".simpan-elemen3", function(e) {
			var data 		= $('#form-elemen3').serialize();
			var clevel 		= $('#cblevel').val();
			var ctahun 		= $('#ptahun').val();
			var cinstansi 	= $('#pkdinstansi').val(); 	 
			var cjml      	= $(this).attr("data-jml"); 
	 
			var ckdtopik = '';
			var ckdpenilaian = '';
			var curaian = '';
			var cjawaban = '';
				
			for (var r = 1, n = cjml; r <= n; r++) {
				
				var cst1 = document.getElementById('cpilihanE3_'+r).checked;
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
					 
					}
			});		
	});	



$(document).on("click", ".simpan-elemen4", function(e) {
			var data 		= $('#form-elemen4').serialize();
			var clevel 		= $('#cblevel').val();
			var ctahun 		= $('#ptahun').val();
			var cinstansi 	= $('#pkdinstansi').val(); 	 
			var cjml      	= $(this).attr("data-jml"); 
	 
			var ckdtopik = '';
			var ckdpenilaian = '';
			var curaian = '';
			var cjawaban = '';
				
			for (var r = 1, n = cjml; r <= n; r++) {
				
				var cst1 = document.getElementById('cpilihanE4_'+r).checked;
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
					 
					}
			});		
	});	



$(document).on("click", ".simpan-elemen5", function(e) {
			var data 		= $('#form-elemen5').serialize();
			var clevel 		= $('#cblevel').val();
			var ctahun 		= $('#ptahun').val();
			var cinstansi 	= $('#pkdinstansi').val(); 	 
			var cjml      	= $(this).attr("data-jml"); 
	 
			var ckdtopik = '';
			var ckdpenilaian = '';
			var curaian = '';
			var cjawaban = '';
				
			for (var r = 1, n = cjml; r <= n; r++) {
				
				var cst1 = document.getElementById('cpilihanE5_'+r).checked;
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
					 
					}
			});		
	});	



$(document).on("click", ".simpan-elemen6", function(e) {
			var data 		= $('#form-elemen6').serialize();
			var clevel 		= $('#cblevel').val();
			var ctahun 		= $('#ptahun').val();
			var cinstansi 	= $('#pkdinstansi').val(); 	 
			var cjml      	= $(this).attr("data-jml"); 
	 
			var ckdtopik = '';
			var ckdpenilaian = '';
			var curaian = '';
			var cjawaban = '';
				
			for (var r = 1, n = cjml; r <= n; r++) {				
				var cst1 = document.getElementById('cpilihanE6_'+r).checked;
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
					 
					}
			});		
	});	



function kembali()
{
	href="<?= base_url($this->dynamic_menu->EncryptLink('kapip-penilaian-mandiri'));?>";
	window.location = href;
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



    $(".fileInputDokumen_E1").change(function(){

alert('change');
/*         var namaFile = $('#nm_dokumenE1_1').val();
        var namaLamp = namaFile.replace("C:\\fakepath\\", "");
        $('#dokumenE1_1').val(namaLamp); */
    });
	
	
   function validateFormat(fileInput){
                
                var filePath = fileInput.value; 
                const fileSize = fileInput.files[0].size;
                const size = Math.round((fileSize / 5120)); 

                
                // Allowing file type 

                var allowedExtensions =  
                        /(\.jpg|\.jpeg|\.png|\.gif|\.pdf)$/i; 
                
                if (!allowedExtensions.exec(filePath)) { 
                    Swal.fire({
            position: 'top-end',
                icon: 'error',
                title: 'Oops...',
                text: 'Tipe File Tidak Diperbolehkan!',
            showConfirmButton: false,
            timer: 2000
            });
                    fileInput.value = ''; 
                    return false; 
                }  

                if (size > 5120) { 
                    Swal.fire({
            position: 'top-end',
                icon: 'error',
                title: 'PERHATIAN',
                text: 'Ukuran File Terlalu Besar! Maksimal Ukuran File : 5 MB',
            showConfirmButton: false,
            timer: 2000
            });
                    fileInput.value = ''; 
					$('#dokumenE1_1').val('');
                    return false; 
                }else{
					
					
					var namaFile = $('#nm_dokumenE1_1').val();
					var namaLamp = namaFile.replace("C:\\fakepath\\", "");
					$('#dokumenE1_1').val(namaLamp);				
					
					
				}
            
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
		

		

</script>    

