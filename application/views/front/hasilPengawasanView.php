<!DOCTYPE html>
<!--[if IE 8 ]><html class="no-js oldie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>

   <!--- basic page needs
   ================================================== -->
   <meta charset="utf-8">
	<title>SIP ITJEN KEMENDAGRI</title>
	<meta name="description" content="">  
	<meta name="author" content="">

   <!-- mobile specific metas
   ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

 	<!-- CSS
   ================================================== -->
   <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/infinity-master/css/base.css">
   <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/infinity-master/css/vendor.css">  
   <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/infinity-master/css/main.css"> 
   <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/radiocharm/jquery-radiocharm.css"> 
   <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/datepicker/datepicker3.css">
   <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/css-circle/css/circle.css">

   <link href="<?= base_url() ?>assets/vendor/jqvmap-master/dist/jqvmap.css" media="screen" rel="stylesheet" type="text/css">

   <!-- script
   ================================================== -->
	<script src="<?= base_url() ?>assets/vendor/infinity-master/js/modernizr.js"></script>
	<script src="<?= base_url() ?>assets/vendor/infinity-master/js/pace.min.js"></script>
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/mdb/css/mdb.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/mdb/css/style.css">

   <!-- favicons
	================================================== -->
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="icon" type="image/png" sizes="96x96" href="<?= base_url() ?>assets/img/favicon.png">
	<style type="text/css">
		html, body {
        padding: 0;
        margin: 0;
        width: 100%;
        height: 100%;
      }
      #vmap {
        width: 100%;
        height: 100%;
        background-color: red;
        -webkit-tap-highlight-color: rgba(0,0,0,0);
      }

       @media (max-width: 767px) {
		  .hidden-xs {
		    display: none !important;
		  }
		}
		@media (min-width: 768px) and (max-width: 991px) {
		  .hidden-sm {
		    display: none !important;
		  }
		}
		@media (min-width: 992px) and (max-width: 1199px) {
		  .hidden-md {
		    display: none !important;
		  }
		}
		@media (min-width: 1200px) {
		  .hidden-lg {
		    display: none !important;
		  }
		}
	</style>
	<style type="text/css" media="screen">
    #styles { 
      background: white;
      padding-top: 4rem;
      padding-bottom: 4rem;
    }      
   	#home{
   		height: 100px;
   		min-height: 100px;
   	}  	
   </style>   

   <style type="text/css">
   		/* BEGIN CARD DESIGN */
.hero {
  display: inline-block;
  position: relative;
  width: 100%;
  min-width: 100px;
  height: 200px;
  border-radius: 30px;
  overflow:hidden;
  box-shadow: 5px 5px 30px rgba(0, 0, 0, 0.3);
  margin: 30px;
}

.hero-profile-img {
  height: 100%;
}

.hero-description-bk {
  background-image: linear-gradient(0deg , #3f5efb, #fc466b);
  border-radius: 30px;
  position: absolute;
  top: 55%;
  left: -5px;
  height: 65%;
  width: 108%;
  transform: skew(19deg, -9deg);
}

.second .hero-description-bk {
  background-image: linear-gradient(-20deg , #bb7413, #e7d25c)
}

.hero-logo {
  height: 80px;
  width: 80px;
  border-radius: 20px;
  background-color: #fff;
  position: absolute;
  bottom: 30%;
  left: 30px;
  overflow:hidden;
  box-shadow: 5px 5px 30px rgba(0, 0, 0, 0.7);
}

.hero-logo img {
  height: 100%;
}

.hero-description {
  position: absolute;
  color: #fff;
  font-weight: 600;
  left: 10%;
  right: 30%;
  bottom: 40%;
}

.hero-btn {
  position: absolute;
  color: #fff;
  right: 30px;
  bottom: 10%;
  padding: 10px 20px;
  border: 1px solid #fff;
}

.hero-btn a {
  color: #fff;
}

#search {
  color: #fff;
  background-color: #074979;
}


/* END CARD DESIGN */


.btn i:before {
  width: 14px;
  height: 14px;
  position: fixed;
  color: #fff;
  background: #0077B5;
  padding: 10px;
  border-radius: 50%;
  top:5px;
  right:5px;
}
   </style>
</head>

<body id="top">

	<!-- header 
   ================================================== -->
   <header> 

   		<div class="header-logo">
	      <a href="<?php echo base_url(); ?>">SIP</a>
	   </div> 

		<a id="header-menu-trigger" href="#0">
		 	<span class="header-menu-text">Menu</span>
		  	<span class="header-menu-icon"></span>
		</a> 

		<nav id="menu-nav-wrap">

			<a href="#0" class="close-button" title="close"><span>Tutup</span></a>	

	   	<h3>SIP ITJEN <br><small>KEMENDAGRI</small></h3>  

			<ul class="nav-list">
				<!-- <li class="current"><a class="smoothscroll" href="#home" title="">Beranda</a></li> -->
				<li><a href="<?php echo base_url(); ?>" title=""><i class="icon-circle-left"></i> Dashboard </a></li>		
				<li><a href="<?=base_url(str_replace('=', '', base64_encode('login'))); ?>" title="">Login <i class="icon-circle-right"></i></a></li>						
			</ul>	
			<ul class="header-social-list">
	         <li>
	         	<a href="#"><i class="fa fa-facebook-square"></i></a>
	         </li>
	         <li>
	         	<a href="#"><i class="fa fa-twitter"></i></a>
	         </li>
	         <li>
	         	<a href="#"><i class="fa fa-instagram"></i></a>
	         </li>
            <!-- <li>
            	<a href="#"><i class="fa fa-behance"></i></a>
            </li>
	         <li>
	         	<a href="#"><i class="fa fa-dribbble"></i></a>
	         </li>	 -->         
	      </ul>		
	      
		</nav>  <!-- end #menu-nav-wrap -->

	</header> <!-- end header -->  


   <!-- home
   ================================================== -->
   <section id="home">

   	<div class="overlay"></div>

   	<div class="home-content-table">	
		   <div class="home-content-tablecell">
		   	
		   </div> <!-- end home-content-tablecell --> 		   
		</div> <!-- end home-content-table -->

		

				
   
   </section> <!-- end home -->


   <!-- styles
   ================================================== -->
   
   <section id="styles">

		
		<div class="row narrow add-bottom text-center">
	   		<div class="col-twelve tab-full">
	   			<h1>IKHTISAR HASIL PENGAWASAN (IHP)</h1>
		   		<input checked
					       data-radiocharm-background-color="ed3326" 
					       data-radiocharm-text-color="FFF" 
					       data-radiocharm-label="Nasional"
					       type="radio" class="tipe_daerah active" value="nasional" name ="tipe_daerah">
		   		<input 
					       data-radiocharm-background-color="074979" 
					       data-radiocharm-text-color="FFF" 
					       data-radiocharm-label="Provinsi"
					       type="radio" class="tipe_daerah" value="prov" name ="tipe_daerah">
					<input data-radiocharm-label="Kabupaten/Kota" 
					       data-radiocharm-background-color="F1C40F" 
					       data-radiocharm-text-color="FFF" 
					       type="radio" class="tipe_daerah" value="kab" name ="tipe_daerah">

	   		</div>
	   		

     	</div>
     	<div class="row">

     		<div class="col-two tab-full">
     			<input class="full-width" type="text" placeholder="Tahun" id="tahun" name="tahun" readonly="" value="<?= date('Y'); ?>">
     		</div>
     		<div class="col-three tab-full" id="combo-prov" hidden>
			  <select name="prov" id="prov" class="full-width">
								
			  </select>
			</div>
			<div class="col-three tab-full" id="combo-kab" hidden>
			  <select name="kab" id="kab" class="full-width">
				
			  </select>
			</div>
			<div class="col-two tab-full">
				<button type="submit" id="search"><i class="icon fa fa-search"></i> Cari&nbsp;&nbsp;</button>
			</div>
			<div class="col-two tab-full text-right pull-right" style="position:fix;">
				<button type="submit" id="login-ihp" class="btn-green"><i class="icon fa fa-pencil"></i> Input</button>
			</div>
			
     	</div>
     	


     		
				     	<div class="row" id="menu-pengawasan">
				     		<!-- isi data -->
						</div> <!-- end row -->
     					
     	



	     	<div class="row">
	     		<br>
	     		<div  class="col-four tab-full">&nbsp;</div>
	     		<div class="col-four tab-full"><center><button class="button-primary" type="button" onclick="back()" style="background-color:#074979;">KEMBALI</button></center></div>
	     		<div  class="col-four tab-full">&nbsp;</div>
	     	</div>

	</section> <!-- end styles -->   


   


	


	<!-- contact
   ================================================== -->
   <section id="contact">

      <div class="overlay"></div>

		<div class="row narrow section-intro with-bottom-sep animate-this">
   		<div class="col-twelve">
   			<h3>KONTAK</h3>
   			<h1>SARAN DAN KRITIK</h1>

   			<p class="lead">Pengaduan, saran dan kritik masyarakat dan info Masyarakat ke instansi terkait Guna memajukan daerah</p>
   		</div> 
   	</div> <!-- end section-intro -->

   	<div class="row contact-content">

   		<div class="col-seven tab-full animate-this">

   			<h5>Kirim Saran dan Kritik</h5>

            <!-- form -->
            <form name="contactForm" id="contactForm" method="post">     			

               <div class="form-field">
 					   <input name="contactName" type="text" id="contactName" placeholder="Nama" value="" minlength="2" required="">
               </div>

               <div class="row">
                 	<div class="col-six tab-full">
                 		<div class="form-field">
                 			<input name="contactEmail" type="email" id="contactEmail" placeholder="Email" value="" required="">
                 		</div>		      			   
		            </div>
	            	<div class="col-six tab-full">	            
	            		<div class="form-field">
	            			<input name="contactSubject" type="text" id="contactSubject" placeholder="Subjek" value="">
	                  </div>		     				   
		            </div>
               </div>
                                         
               <div class="form-field">
	              	<textarea name="contactMessage" id="contactMessage" placeholder="Saran dan Kritik" rows="10" cols="50" required=""></textarea>
	            </div> 

               <div class="form-field">
                  <button class="submitform">Kirim</button>

                  <div id="submit-loader">
                     <div class="text-loader">Sending...</div>                             
       			      <div class="s-loader">
							  	<div class="bounce1"></div>
							  	<div class="bounce2"></div>
							  	<div class="bounce3"></div>
							</div>
						</div>
               </div>

      		</form> <!-- end form -->

            <!-- contact-warning -->
            <div id="message-warning"></div> 

            <!-- contact-success -->
      		<div id="message-success">
               <i class="fa fa-check"></i>Saran dan Kritik Terkirim, Terima Kasih!<br>
      		</div>

         </div> <!-- end col-seven --> 

         <div class="col-four tab-full contact-info end animate-this">

         	<h5>Informasi Kontak</h5>

         	<div class="cinfo">
	   			<h6>Lokasi</h6>
	   			<p>
	            	Jl Medan Merdeka Timur No. 8<br>
	            	Gambir Jakarta Pusat<br>
	            	10110 
	            </p>
	   		</div> <!-- end cinfo -->

	   		<div class="cinfo">
	   			<h6>Email Kami di:</h6>
	   			<p>
	   				ulaitjen.kemendagri@gmail.com			     
				   </p>
	   		</div> <!-- end cinfo -->

	   		<div class="cinfo">
	   			<h6>Hubungi Kami :</h6>
	   			<p>
	   				Phone: (021) 3846391<br>
				   	
				   </p>
	   		</div>

         </div> <!-- end cinfo --> 

   	</div> <!-- end row contact-content -->
		
	</section> <!-- end contact -->




	<!-- footer
   ================================================== -->
	<footer>
     	

   	<div class="footer-bottom">

      	<div class="row">

      		<div class="col-twelve">
	      		<div class="copyright">
		         	<span>© Copyright ITJEN KEMENDAGRI 2020.</span> 
		         	<!-- <span>Design by 
		         	<a href="#"></a> -->
		         	<!-- <a href="http://www.styleshout.com/">styleshout</a> -->
		         	<!-- </span>		         	 -->
		         </div>		               
	      	</div>

      	</div>   	

      </div> <!-- end footer-bottom -->

      <div id="go-top">
		   <a class="smoothscroll" title="Kembali Ke Atas" href="#top">
		   	<i class="fa fa-long-arrow-up" aria-hidden="true"></i>
		   </a>
		</div>		
   </footer>

   <div id="preloader"> 
    	<div id="loader"></div>
   </div> 

   <!-- Java Script
   ================================================== --> 
   <script src="<?= base_url() ?>assets/vendor/infinity-master/js/jquery-2.1.3.min.js"></script>
   <script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
   <script src="<?= base_url() ?>assets/vendor/bootstrap-treeview-master/dist/bootstrap-treeview.min.js"></script>

   <script src="<?= base_url() ?>assets/vendor/infinity-master/js/plugins.js"></script>
   <script src="<?= base_url() ?>assets/vendor/infinity-master/js/main.js"></script>
   <script src="<?= base_url() ?>assets/vendor/radiocharm/jquery-radiocharm.js"></script>
   
   <script src="<?= base_url() ?>assets/vendor/datepicker/bootstrap-datepicker.js"></script>
   <script src="<?= base_url() ?>assets/vendor/sweetalert2/sweetalert2.all.min.js"></script>
   
   <script>
      

      function back () {
      	window.location.href = "<?= base_url(); ?>";
      }


    </script>
    <script type="text/javascript">
    	$(window).on('load', function () {

		  	var kode = 1;
		  	$.ajax({
				  url: '<?php echo base_url('data-user/getprovfront'); ?>',
				  data:{kode:kode},
				  type: 'POST',
				  success: function(data){
				  	$("#prov").html(data);
				  }
			  })


		  	// default nasional
		  	var tipe = 'nasional';
        	if(!tipe){
        		Swal.fire({
						  icon: 'warning',
						  title: 'PERINGATAN!',
						  text: 'HARAP ISI PILIHAN TIPE',
						});
        		exit();
        	}
        	var tahun = document.getElementById('tahun').value;
        	var daerah;
        	if (tipe == 'kab') {
        		var kabupaten = document.getElementById('kab').value;
        		daerah = kabupaten;
        	}else if(tipe == 'prov'){
        		var provinsi = document.getElementById('prov').value;
        		daerah = provinsi;
        	}else if(tipe == 'nasional'){
        		daerah = tipe;
        	}
        	else{
        		daerah = '';
        	}
        	if (daerah == '') {
        		Swal.fire({
						  icon: 'warning',
						  title: 'PERINGATAN!',
						  text: 'HARAP ISI PILIHAN DAERAH',
						});
        	}else{
        		$("#menu-pengawasan").html('<center><img src="<?php echo base_url('assets/img/loading.gif'); ?>" alt="Loading" height="42" width="42"></center>');
			  	$.ajax({
					  url: '<?php echo base_url('hasil-pengawasan/get'); ?>',
					  type: 'POST',
					  data:{daerah:daerah,tahun:tahun},
					  success: function(data){
					  	$("#menu-pengawasan").html('');
					  	$("#menu-pengawasan").html(data);
					  }
				  });
        	}


		  	
		});

		$("#prov").change(function(){
				var header=$(this).val();
				$.ajax({
				  url: '<?php echo base_url('data-user/getkab'); ?>',
				  data:{kode:header},
				  type: 'POST',
				  	success: function(data){
		  		  		$('#kab').html(data);
					}
				})
			});

		$('input:radio').radiocharm({
		  'uncheckable': true
		});
		$(".tipe_daerah").change(function(){
				var tipe=$(this).val();
				if (tipe=='kab') {
					// alert(tipe);
					$('#combo-prov').removeAttr('hidden','');
					$('#combo-kab').removeAttr('hidden','');
				}else if(tipe=='prov'){
					$('#combo-prov').removeAttr('hidden','');
					$('#combo-kab').attr('hidden','');
				}else{
					// alert(tipe);
					$('#combo-prov').attr('hidden','');
					$('#combo-kab').attr('hidden','');
				}
			});
		$(document).on("click", "#login-ihp", function() {
			Swal.fire({
				  title: 'Anda Harus Login Untuk Input Data.',
				  text: "Lakukan Login?.",
				  icon: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  cancelButtonText: 'Batal',
				  confirmButtonText: 'Ya, Lakukan Login.'
				}).then((result) => {
				  if (result.value) {
				    document.location.href = "<?=base_url(str_replace('=', '', base64_encode('login-ihp'))); ?>";
				  }
				})

		  });

		$(document).on("click", "#search", function() {

        	
        	var tipe = $('input[name=tipe_daerah]:checked').val();
        	if(!tipe){
        		Swal.fire({
						  icon: 'warning',
						  title: 'PERINGATAN!',
						  text: 'HARAP ISI PILIHAN TIPE',
						});
        		exit();
        	}
        	var tahun = document.getElementById('tahun').value;
        	var daerah;
        	if (tipe == 'kab') {
        		var kabupaten = document.getElementById('kab').value;
        		daerah = kabupaten;
        	}else if(tipe == 'prov'){
        		var provinsi = document.getElementById('prov').value;
        		daerah = provinsi;
        	}else if(tipe == 'nasional'){
        		daerah = tipe;
        	}
        	else{
        		daerah = '';
        	}
        	if (daerah == '') {
        		Swal.fire({
						  icon: 'warning',
						  title: 'PERINGATAN!',
						  text: 'HARAP ISI PILIHAN DAERAH',
						});
        	}else{
        		$("#menu-pengawasan").html('<center><img src="<?php echo base_url('assets/img/loading.gif'); ?>" alt="Loading" height="42" width="42"></center>');
			  	$.ajax({
					  url: '<?php echo base_url('hasil-pengawasan/get'); ?>',
					  type: 'POST',
					  data:{daerah:daerah,tahun:tahun},
					  success: function(data){
					  	$("#menu-pengawasan").html('');
					  	$("#menu-pengawasan").html(data);
					  }
				  });
        	}

		  });
	</script>
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

	<script type="text/javascript">
  $(document).on("click", ".showDetail", function(e) {
        var kode = $(this).attr('data-kode');
        var was = $(this).attr('data-was');
        var daerah = $(this).attr('data-daerah');
        var tahun = $(this).attr('data-tahun');
        var nama = $(this).attr('data-nama');
        var idChart = $(this).attr('id');
        $.ajax({
          method: 'POST',
          url: '<?php echo base_url('hasil-pengawasan/get-detail'); ?>',
          data: {was:was,kode:kode,daerah:daerah,tahun:tahun}
        })
        .done(function(data) {
          if (was == 'binwas') {
            $('#nm_parameter_binwas').html(kode + ' - ' + nama);
            $('#detail2binwas').html(data);
          }else if(was == 'teknis'){
            $('#nm_parameter_teknis').html(kode + ' - ' + nama);
            $('#detail2teknis').html(data);
          }else{
            $('#nm_parameter_umum').html(kode + ' - ' + nama);
            $('#detail2umum').html(data);
          }

        })
        
        if (was == 'binwas') {	
          	$('.ChartBinwas').removeAttr('style');
            $('#'+idChart).attr('style','box-shadow: 0px 0px 10px 5px orange !important;');
          }else if(was == 'teknis'){
          	$('.ChartTeknis').removeAttr('style');
            $('#'+idChart).attr('style','box-shadow: 0px 0px 10px 5px orange !important;');
          }else{
          	$('.ChartUmum').removeAttr('style');
        	$('#'+idChart).attr('style','box-shadow: 0px 0px 10px 5px orange !important;');
          }


        e.preventDefault();
        
      });

</script>

<script type="text/javascript">
  $(document).on("click", ".showSub", function(e) {
        var kode = $(this).attr('data-kode');
        var was = $(this).attr('data-was');
        var daerah = $(this).attr('data-daerah');
        var tahun = $(this).attr('data-tahun');
        var nama = $(this).attr('data-nama');


        $.ajax({
          method: 'POST',
          url: '<?php echo base_url('hasil-pengawasan/get-sub-detail'); ?>',
          data: {was:was,kode:kode,daerah:daerah,tahun:tahun}
        })
        .done(function(data) {
          // if (was == 'binwas') {
          //   $('#nm_list_binwas').html(kode + ' - ' + nama);
          //   $('#list_sub_parameter_binwas').html(data);
          // }else if(was == 'teknis'){
          //   $('#nm_list_teknis').html(kode + ' - ' + nama);
          //   $('#list_sub_parameter_teknis').html(data);
          // }else{
          //   $('#nm_list_umum').html(kode + ' - ' + nama);
          //   $('#list_sub_parameter_umum').html(data);
          // }
          var act = $('#subDetail'+kode).attr('data-active');
          
          if (act == 'Y') {
          	$('#column'+kode).attr('style','column:pointer;');
            $('#subDetail'+kode).attr('hidden','');
            $('#subDetail'+kode).attr('data-active','T');
            $('#subDetail'+kode).html(data);

          }else{
            $('#column'+kode).attr('style','column:pointer;box-shadow: 0px 0px 10px 2px orange !important;');
            $('#subDetail'+kode).removeAttr('hidden');
            $('#subDetail'+kode).attr('data-active','Y');
            $('#subDetail'+kode).html(data);
          }


        })
        
        e.preventDefault();
      });
</script>

</body>

</html>