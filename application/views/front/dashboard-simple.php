<!DOCTYPE html>
<!--[if IE 8 ]><html class="no-js oldie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>

   <!--- basic page needs
   ================================================== -->
   <meta charset="utf-8">
	<title><?= SHORT_APP_NAME.' - '.APP_NAME; ?></title>
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
   <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/datepicker/datepicker3.css">

   <link href="<?= base_url() ?>assets/vendor/jqvmap-master/dist/jqvmap.css" media="screen" rel="stylesheet" type="text/css">

   <!-- script
   ================================================== -->
	<script src="<?= base_url() ?>assets/vendor/infinity-master/js/modernizr.js"></script>
	<script src="<?= base_url() ?>assets/vendor/infinity-master/js/pace.min.js"></script>

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
      	@media (max-width: 400px) {
		  .hidden-xs {
		    display: none !important;
		  }
		  .column-tlhp {
			  float: left;
			  width: 50%;
			  padding: 0px 0px 0px 0px;
			}

		}

       @media (max-width: 767px) {
		  .hidden-xs {
		    display: none !important;
		  }
		  .column-tlhp {
			  float: left;
			  width: 50%;
			  padding: 5px 10px 5px 10px;
			}
		}
		@media (min-width: 768px) and (max-width: 991px) {
		  .hidden-sm {
		    display: none !important;
		  }
		  .column-tlhp {
			  float: left;
			  width: 50%;
			  padding: 20px 40px 20px 40px;
			}
		}
		@media (min-width: 992px) and (max-width: 1199px) {
		  .hidden-md {
		    display: none !important;
		  }
		  .column-tlhp {
			  float: left;
			  width: 50%;
			  padding: 30px 60px 30px 60px;
			}
		}
		@media (min-width: 1200px) {
		  .hidden-lg {
		    display: none !important;
		  }
		  .column-tlhp {
			  float: left;
			  width: 50%;
			  padding: 30px 800px 30px 80px;
			}
		}
		
	</style>
	<style type="text/css">
		 /* The Modal (background) */
		.modal {
		  display: none; /* Hidden by default */
		  position: fixed; /* Stay in place */
		  z-index: 1; /* Sit on top */
		  left: 0;
		  top: 0;
		  width: 100%; /* Full width */
		  height: 100%; /* Full height */
		  overflow: auto; /* Enable scroll if needed */
		  background-color: rgb(0,0,0); /* Fallback color */
		  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
		}

		/* Modal Content/Box */
		.modal-content {
		  background-color: #fefefe;
		  margin: 5% auto; /* 15% from the top and centered */
		  padding: 20px;
		  border: 1px solid #888;
		  width: 80%; /* Could be more or less, depending on screen size */
		}

		/* The Close Button */
		.close {
		  color: #fcfcfc;
		  float: right;
		  font-size: 28px;
		  font-weight: bold;
		}

		.close:hover,
		.close:focus {
		  color: red;
		  text-decoration: none;
		  cursor: pointer;
		}


	</style>
	<style>
		/* Float four columns side by side */
		.column-tlhp {
		  float: left;
		  width: 50%;
		  padding: 40px 80px 40px 80px;
		}

		.column-sip {
		  float: left;
		  width: 100%;
		  padding: 10px 10px 10px 10px;
		  text-align: center;
		}
		.column-sip img{
		  width: 30px;
		}

		.isDisabled {
		  color: currentColor;
		  cursor: not-allowed;
		  opacity: 0.5;
		  text-decoration: none;
		}

		/* Remove extra left and right margins, due to padding */
		.row-tlhp {margin: 0 -5px;}
		.row-sip {margin: 0 -5px;}

		/* Clear floats after the columns */
		.row-tlhp:after {
		  content: "";
		  display: table;
		  clear: both;
		}
		.row-sip:after {
		  content: "";
		  display: table;
		  clear: both;
		}

		/* Responsive columns */
		@media screen and (max-width: 800px) {
		  .column-tlhp {
		    width: 100%;
		    display: block;
		    margin-bottom: 20px;
		    padding: 10px 20px 10px 20px!important;
		  }

		  .modal-content {
			  background-color: #fefefe;
			  margin: 20% auto; /* 15% from the top and centered */
			  padding: 10px;
			  border: 1px solid #888;
			  width: 80%; /* Could be more or less, depending on screen size */
			}


			#mapRekapTemuan {
			    width: 600px;
			    height: 300px;
			    margin: 0 auto;
			}
		}

		/* Style the counter cards */
		.card-tlhp {
		  box-shadow: 0 4px 6px 0 rgba(0, 0, 0, 0.6);
		  padding: 10px;
		  text-align: center;
		  background-color: #f1f1f1;
		  cursor: pointer;
		}

		#mapRekapTemuan {
		    width: 1200px;
		    height: 600px;
		    margin: 0 auto;
		}
		.loadingMap {
		    margin-top: 10em;
		    text-align: center;
		    color: gray;
		}
		</style>

</head>

<body id="top">

	<!-- header
   ================================================== -->
   <header>

   		<div class="header-logo hidden-lg hidden-md">
	      <a href="<?php echo base_url(); ?>"><?=SHORT_APP_NAME; ?></a>
	   </div>

		<!-- <a id="header-menu-trigger" href="#0">
		 	<span class="header-menu-text">Menu</span>
		  	<span class="header-menu-icon"></span>
		</a> -->

		<!-- <nav id="menu-nav-wrap">

			<a href="#0" class="close-button" title="close"><span>Tutup</span></a>

	   	<h3><?=SHORT_APP_NAME; ?><br><small><?=SHORT_UNIT_NAME.' '.SHORT_INSTITUTIONS_NAME; ?></small></h3>

			<ul class="nav-list">
				<li><a class="smoothscroll" href="#services" title=""><?=SHORT_APP_NAME; ?></a></li>
				<li><a class="smoothscroll" href="#contact" title="">Kontak</a></li>
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
	      </ul>

		</nav>   -->

	</header> <!-- end header -->


   <!-- home
   ================================================== -->
   <section id="home" hidden>

   	<div class="overlay"></div>

   	<div class="home-content-table">
		   <div class="home-content-tablecell">
		   	<div class="row">
		   		<div class="col-twelve">

			  				<h1 class="animate-intro">SIP</h1>
				  			<h3 class="animate-intro">
							(SISTEM INFORMASI PENGAWASAN)
				  			</h3>

				  			<div class="more animate-intro">
				  				<a class="smoothscroll button stroke" href="#about">
				  					BACA SELENGKAPNYA
				  				</a>
				  			</div>

			  		</div> <!-- end col-twelve -->
		   	</div> <!-- end row -->
		   </div> <!-- end home-content-tablecell -->
		</div> <!-- end home-content-table -->

		<ul class="home-social-list">
	      <li class="animate-intro">
	        	<a href="#"><i class="fa fa-facebook-square"></i></a>
	      </li>
	      <li class="animate-intro">
	        	<a href="#"><i class="fa fa-twitter"></i></a>
	      </li>
	      <li class="animate-intro">
	        	<a href="#"><i class="fa fa-instagram"></i></a>
	      </li>
         <!-- <li class="animate-intro">
           	<a href="#"><i class="fa fa-behance"></i></a>
         </li>
	      <li class="animate-intro">
	        	<a href="#"><i class="fa fa-dribbble"></i></a>
	      </li>	     -->
	   </ul> <!-- end home-social-list -->

		<div class="scrolldown">
			<a href="#about" class="scroll-icon smoothscroll">
		   	Selanjutnya
		   	<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
			</a>
		</div>

   </section> <!-- end home -->


   <!-- about
   ================================================== -->
   <section id="about" hidden>

   	<div class="row about-wrap">
   		<div class="col-full">

   			<div class="about-profile-bg"></div>

				<div class="intro">
					<h3 class="animate-this">SISTEM INFORMASI PENGAWASAN</h3>
	   			<p><span>Sistem Informasi Pengawasan (SIP)</span>  penyelenggaraan pemerintahan daerah secara nasional kepada Presiden merupakan operasionalisasi mandat Menteri Dalam Negeri, sesuai Pasal 24 ayat (7) Peraturan Pemerintah Nomor 12 Tahun 2017 tentang Pembinaan dan Pengawasan Penyelenggaraan Pemerintahan Daerah. Sejak reformasi penyelenggaraan pemerintahan daerah yang ditandai dengan hadirnya Undang-Undang Nomor 22 Tahun 1999 tentang Pemerintahan Daerah yang dijabarkan ke dalam Peraturan Pemerintah Nomor 79 Tahun 2005, kewajiban penyampaian informasi pengawasan belum pernah dilaporkan kepada Presiden.
	   			<br>
Esensi hadirnya Aparat Pengawasan Internal Pemerintah (APIP) daerah adalah untuk membantu Kepala Daerah dalam melakukan dan pengawasan penyelenggaraan pemerintahan daerah. APIP harus mampu untuk meyakinkan tujuan otonomi daerah tercapai dan meyakinkan perangkat daerah telah menerapkan tata kelola (governance), sistem pengendalian (control) dan penilaian risiko (risk management) secara memadai dalam pelaksanaan urusan pemerintahan daerah.

Peraturan Pemerintah Nomor 12 Tahun 2017 tentang Pembinaan dan Pengawasan Penyelenggaraan Pemerintahan Daerah, sebagai turunan dari Undang-Undang Nomor 23 Tahun 2014 tentang Pemerintahan Daerah mengamanatkan kepada Menteri Dalam Negeri untuk melakukan koordinasi pengawasan penyelenggaraan pemerintaan daerah yang dilakukan oleh APIP Kementerian/Lembaga dan APIP Daerah terhadap aspek perencanaan, penganggaran, pengorganisasian, pelaksanaan, pelaporan dan evaluasi. Secara spesifik, salah satu mandat yang diatur dalam Peraturan Pemerintah Nomor 12 Tahun 2017 tentang Pembinaan dan Pengawasan Penyelenggaraan Pemerintahan Daerah adalah kewajiban bagi Menteri Dalam Negeri untuk menyampaikan Ikhtisar Hasil Pengawasan Pemerintahan Daerah secara Nasional (selanjutnya disebut IHP-PDN) kepada Presiden. IHP-PDN tersebut memuat hasil pengawasan umum yang dilakukan oleh Inspektorat Jenderal Dalam Negeri dan hasil pengawasan teknis yang dilakukan oleh Inspektorat Jenderal Kementerian/Lembaga sesuai dengan urusannya masing-masing serta hasil pembinaan dan pengawasan APIP Daerah terhadap perangkat daerahnya.</p>
				</div>

   		</div> <!-- end col-full  -->
   	</div> <!-- end about-wrap  -->

   </section> <!-- end about -->


   <!-- about
   ================================================== -->
   <section id="services">
   	<div class="h-100 w-100 position-absolute overflow-hidden d-flex mandala align-items-center">
   		<div class="img-small left"></div>
   		<div class="img-big left"></div>
   		<div class="img-small right"></div>
   		<div class="img-big right "></div>
   	</div>

   	<div class="overlay"></div>
   	<div class="gradient-overlay"></div>

   	<div class="row narrow section-intro animate-this">
   		<div class="col-full ass">
   			<!-- <img src="<?= base_url() ?>assets/img/kemendagri.png" style="width:70px;padding-bottom: 20px;"> -->
   			<a href="#services" id="myBtn2">
	            <div class="service-content">
	            	<img src="<?= base_url() ?>assets/img/kemendagri.png" style="width:80px;" class="hidden-sm hidden-xs">
   					<!-- <h1><?= strtoupper(APP_NAME);?></h1> -->
   					<h1><?= strtoupper(APP_NAME);?></h1>
   					<h3>(<?= strtoupper(SHORT_APP_NAME);?>)</h3>
	            	<h3 class="h05">
	            	<i class="fa fa-long-arrow-down" aria-hidden="true"></i></h3>
	            </div>
		   	</a>
   	   </div> <!-- end col-full -->
   	</div> <!-- end row -->

   	<div class="row services-content">

   		<div class="services-list block-1-4 block-tab-full group">

	      	<div class="bgrid service-item animate-this">
	      		<a href="<?=base_url(base64_encode('profil-pemda')); ?>">
	      			<span class="icon"><i class="icon-pin"></i></span>

		            <div class="service-content">
		            	<h3 class="h05">PROFIL PEMDA</h3>
		         	</div>
		         </a>
			</div> <!-- end bgrid -->

			<div class="bgrid service-item animate-this" >
	      		<!-- <a href="<?=base_url(str_replace('=', '', base64_encode('e-audit'))); ?>" class = "isDisabled"> -->
	      		<a href="#" class = "isDisabled">
	      			<span class="icon" ><i class="icon-edit" style="color:grey;"></i></span>
		            <div class="service-content">
		            	<h3 class="h05" style="color:grey;">E-AUDIT</h3>
		         	</div>
		         </a>
			</div> <!-- end bgrid -->

			<div class="bgrid service-item animate-this">
				<a href="<?=base_url(str_replace('=', '', base64_encode('hasil-pengawasan'))); ?>">
					<span class="icon"><i class="icon-pie-chart"></i></span>
		            <div class="service-content">
		            	<h3 class="h05">IKHTISAR HASIL PENGAWASAN (IHP)</h3>
		            </div>
	            </a>
		   	</div> <!-- end bgrid -->

		   <div class="bgrid service-item animate-this">
			   	<a href="#services" id="myBtn">
				   	<span class="icon"><i class="icon-list"></i></span>
		            <div class="service-content">
		            	<h3 class="h05">PEMANTAUAN TLHP</h3>
		            </div>
			   	</a>

		   </div> <!-- end bgrid -->


	      </div> <!-- end services-list -->

   	</div> <!-- end services-content -->

   	<div class="row services-content">

   		<div class="services-list block-1-4 block-tab-full group">
   			<div class="bgrid service-item animate-this">
	      		<a href="#"  class="isDisabled">
	      			<span class="icon"><i class="icon-form"  style="color:grey;"></i></span>

		            <div class="service-content">
		            	<h3 class="h05"  style="color:grey;">WASINMENDAGRI</h3>
		         	</div>
		         </a>
			</div> <!-- end bgrid -->

	      	<div class="bgrid service-item animate-this">
	      		<a href="https://ppupd.kemendagri.go.id/">
	      			<span class="icon"><i class="icon-book"></i></span>

		            <div class="service-content">
		            	<h3 class="h05">E-DUPAK</h3>
		         	</div>
		         </a>
			</div> <!-- end bgrid -->

			<div class="bgrid service-item animate-this">
	      		<a href="https://edumas.kemendagri.go.id/">
	      			<span class="icon"><i class="icon-users"></i></span>

		            <div class="service-content">
		            	<h3 class="h05">E-DUMAS</h3>
		         	</div>
		         </a>
			</div> <!-- end bgrid -->

			<div class="bgrid service-item animate-this">
	      		<a href="#" class="isDisabled">
	      			<span class="icon"><i class="icon-tie" style="color:grey;"></i></span>

		            <div class="service-content">
		            	<h3 class="h05" style="color:grey;">PENILAIAN KAPABILITAS</h3>
		         	</div>
		         </a>
			</div> <!-- end bgrid -->


	      </div> <!-- end services-list -->

   	</div> <!-- end services-content -->


   	<div class="row services-content">

   		<div class="services-list block-1-4 block-tab-full group">
   			<div class="bgrid service-item animate-this">
   				<a href="<?=base_url().'jadwas/'; ?>">
	      			<span class="icon" ><i class="icon-calendar"></i></span>
		            <div class="service-content">
		            	<h3 class="h05">JADWAS</h3>
		         	</div>
		         </a>
			</div> <!-- end bgrid -->

	      	<div class="bgrid service-item animate-this">
	      		<a href="#"  class="isDisabled">
	      			<span class="icon"><i class="icon-map" style="color:grey;"></i></span>

		            <div class="service-content">
		            	<h3 class="h05" style="color:grey;">GIS</h3>
		         	</div>
		         </a>
			</div> <!-- end bgrid -->

			<div class="bgrid service-item animate-this">
	      		<a href="<?=base_url(str_replace('=', '', base64_encode('login-review'))); ?>">
	      			<span class="icon" ><i class="icon-search"></i></span>
		            <div class="service-content">
		            	<h3 class="h05">REVIEW</h3>
		         	</div>
		         </a>
			</div> <!-- end bgrid -->

			<div class="bgrid service-item animate-this">

			</div> <!-- end bgrid -->

	      </div> <!-- end services-list -->

   	</div> <!-- end services-content -->
   	<!-- <footer> -->


   	<div class="footer-bottom">

      	<div class="row">

      		<div class="col-twelve">
	      		<div class="copyright">
		         	<span style="color:#f0c672;text-shadow: 0 0 5px #000;">© Copyright ITJEN KEMENDAGRI 2020.</span>
		         	<!-- <span>Design by
		         	<a href="#"></a> -->
		         	<!-- <a href="http://www.styleshout.com/">styleshout</a> -->
		         	<!-- </span>		         	 -->
		         </div>
	      	</div>

      	</div>

      </div> <!-- end footer-bottom -->

     <!--  <div id="go-top">
		   <a class="smoothscroll" title="Kembali Ke Atas" href="#top">
		   	<i class="fa fa-long-arrow-up" aria-hidden="true"></i>
		   </a>
		</div>	 -->
   <!-- </footer> -->

   </section> <!-- end services -->



<!-- <section id="testimonials" class="">

   	<div class="row">
   		<div class="col-twelve"> -->
   			<!-- <h2 class="animate-this">INDONESIA</h2> -->
   			<!-- <div class="text-center animate-this">
   				<center> -->

	   			<!-- <select>
	   				<option>JUMLAH TEMUAN</option>
	   			</select> -->
	   			<!-- <div class="col-two tab-full">
	     			<input class="full-width" type="text" placeholder="Tahun" id="tahun" name="tahun" readonly="" value="<?= 2019; ?>">
	     		</div>
		     	<div class="col-two tab-full">
					<button type="submit" id="search"><i class="icon fa fa-search"></i> Cari&nbsp;&nbsp;</button>
				</div>
   				</center>
   			</div>
   		</div>
   	</div>
   	<center>

      <div class="row">
      	<div>

      		<div id="mapRekapTemuan">

      		</div>
      	</div> -->
    		<!-- <div id="vmap" style="width: 900px; height: 400px;" class="hidden-xs hidden-sm">

    		</div> -->
      <!-- </div>

   	</center>
   </section> --> <!-- end testimonials -->









	<!-- contact
   ================================================== -->
 <!--   <section id="contact">

      <div class="overlay"></div>

		<div class="row narrow section-intro with-bottom-sep animate-this">
   		<div class="col-twelve">
   			<h3>KONTAK</h3>
   			<h1>SARAN DAN KRITIK</h1>

   			<p class="lead">Pengaduan, saran dan kritik masyarakat dan info Masyarakat ke instansi terkait Guna memajukan daerah</p>
   		</div>
   	</div>  --><!-- end section-intro -->

<!--    	<div class="row contact-content">

   		<div class="col-seven tab-full animate-this">

   			<h5>Kirim Saran dan Kritik</h5> -->

            <!-- form -->
            <!-- <form name="contactForm" id="contactForm">

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

               <div class="form-field"> -->
                  <!-- <button class="submitform">Kirim</button> -->
                  <!-- <button type="submit" name="submit" value="Simpan" id="simpan2" class="submitform">KIRIM</button>

                  <div id="submit-loader">
                     <div class="text-loader">Sending...</div>
       			      <div class="s-loader">
							  	<div class="bounce1"></div>
							  	<div class="bounce2"></div>
							  	<div class="bounce3"></div>
							</div>
						</div>
               </div>

      		</form> --> <!-- end form -->

            <!-- contact-warning -->
            <!-- <div id="message-warning"></div>  -->

            <!-- contact-success -->
      		<!-- <div id="message-success">
               <i class="fa fa-check"></i>Saran dan Kritik Terkirim, Terima Kasih!<br>
      		</div>

         </div> --> <!-- end col-seven -->

         <!-- <div class="col-four tab-full contact-info end animate-this">

         	<h5>Informasi Kontak</h5>

         	<div class="cinfo">
	   			<h6>Lokasi</h6>
	   			<p>
	            	Jl Medan Merdeka Timur No. 8<br>
	            	Gambir Jakarta Pusat<br>
	            	10110
	            </p>
	   		</div>  --><!-- end cinfo -->

	   		<!-- <div class="cinfo">
	   			<h6>Email Kami di:</h6>
	   			<p>
	   				ulaitjen.kemendagri@gmail.com
				   </p>
	   		</div> --> <!-- end cinfo -->

	   		<!-- <div class="cinfo">
	   			<h6>Hubungi Kami :</h6>
	   			<p>
	   				Phone: (021) 3846391<br>

				   </p>
	   		</div>

         </div> --> <!-- end cinfo -->

   	<!-- </div> --> <!-- end row contact-content -->

	<!-- </section> --> <!-- end contact -->


	<!-- footer
   ================================================== -->
	<!-- <footer>


   	<div class="footer-bottom">

      	<div class="row">

      		<div class="col-twelve">
	      		<div class="copyright">
		         	<span>© Copyright ITJEN KEMENDAGRI 2020.</span>  -->
		         	<!-- <span>Design by
		         	<a href="#"></a> -->
		         	<!-- <a href="http://www.styleshout.com/">styleshout</a> -->
		         	<!-- </span>		         	 -->
		         <!-- </div>
	      	</div>

      	</div>   -->

      <!-- </div> --> <!-- end footer-bottom -->

      <!-- <div id="go-top">
		   <a class="smoothscroll" title="Kembali Ke Atas" href="#top">
		   	<i class="fa fa-long-arrow-up" aria-hidden="true"></i>
		   </a>
		</div>
   </footer> -->


  <!-- Trigger/Open The Modal -->


<!-- The Modal -->
<div id="myModal" class="modal fadeIn">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close" style = "padding-right:5px;">&times;</span>
    <div style="background-color:#074979;color:#fff;text-align:center;" class="arial header-modal">
    	PEMANTAUAN TLHP
    </div>
    <div style="border:4px #074979 solid;width:100%;min-height:400px;height:auto;">
    <div class="row-tlhp">
	  <div class="column-tlhp">
	    <div class="card-tlhp" id="card-tlhp-bpk" style="">
	      <h3>&nbsp;TLHP BPK &nbsp;</h3>
	      <a href="<?=base_url(str_replace('=', '', base64_encode('login-tlhp-kemendagri'))); ?>">
				<img src="<?= base_url() ?>assets/img/bpk-icon.png">
			</a>
	    </div>
	  </div>

	  <div class="column-tlhp">
	    <div class="card-tlhp" id="card-tlhp-itjen" style="">
	      <h3>TLHP ITJEN</h3>
	      <a href="<?=base_url(str_replace('=', '', base64_encode('login-tlhp-itjen'))); ?>">
				<img src="<?= base_url() ?>assets/img/itjen-icon.png" >
			</a>
	    </div>
	  </div>
	</div>
    </div>
  </div>

</div>

<div id="myModal2" class="modal fadeIn">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close" style = "padding-right:5px;">&times;</span>
    <div style="background-color:#074979;color:#fff;text-align:center;" class="arial header-modal">
    	TENTANG SIP
    </div>
    <div style="border:4px #074979 solid;width:100%;height:auto;min-height:300px;">
    <div class="row-sip">
	  <div class="column-sip">
	  	<img src="<?= base_url() ?>assets/img/kemendagri.png" style="width:60px;">
	  	<h3 class="animate-this"><?= strtoupper(APP_NAME); ?></h3>
	   			<p class="arial-p header-modal-p"><span><?=APP_NAME; ?> (SIWASIAT)</span>  penyelenggaraan pemerintahan daerah secara nasional kepada Presiden merupakan operasionalisasi mandat Menteri Dalam Negeri, sesuai Pasal 24 ayat (7) Peraturan Pemerintah Nomor 12 Tahun 2017 tentang Pembinaan dan Pengawasan Penyelenggaraan Pemerintahan Daerah. Sejak reformasi penyelenggaraan pemerintahan daerah yang ditandai dengan hadirnya Undang-Undang Nomor 22 Tahun 1999 tentang Pemerintahan Daerah yang dijabarkan ke dalam Peraturan Pemerintah Nomor 79 Tahun 2005, kewajiban penyampaian informasi pengawasan belum pernah dilaporkan kepada Presiden.
	   			<br>
Esensi hadirnya Aparat Pengawasan Internal Pemerintah (APIP) daerah adalah untuk membantu Kepala Daerah dalam melakukan dan pengawasan penyelenggaraan pemerintahan daerah. APIP harus mampu untuk meyakinkan tujuan otonomi daerah tercapai dan meyakinkan perangkat daerah telah menerapkan tata kelola (governance), sistem pengendalian (control) dan penilaian risiko (risk management) secara memadai dalam pelaksanaan urusan pemerintahan daerah.

Peraturan Pemerintah Nomor 12 Tahun 2017 tentang Pembinaan dan Pengawasan Penyelenggaraan Pemerintahan Daerah, sebagai turunan dari Undang-Undang Nomor 23 Tahun 2014 tentang Pemerintahan Daerah mengamanatkan kepada Menteri Dalam Negeri untuk melakukan koordinasi pengawasan penyelenggaraan pemerintaan daerah yang dilakukan oleh APIP Kementerian/Lembaga dan APIP Daerah terhadap aspek perencanaan, penganggaran, pengorganisasian, pelaksanaan, pelaporan dan evaluasi. Secara spesifik, salah satu mandat yang diatur dalam Peraturan Pemerintah Nomor 12 Tahun 2017 tentang Pembinaan dan Pengawasan Penyelenggaraan Pemerintahan Daerah adalah kewajiban bagi Menteri Dalam Negeri untuk menyampaikan Ikhtisar Hasil Pengawasan Pemerintahan Daerah secara Nasional (selanjutnya disebut IHP-PDN) kepada Presiden. IHP-PDN tersebut memuat hasil pengawasan umum yang dilakukan oleh Inspektorat Jenderal Dalam Negeri dan hasil pengawasan teknis yang dilakukan oleh Inspektorat Jenderal Kementerian/Lembaga sesuai dengan urusannya masing-masing serta hasil pembinaan dan pengawasan APIP Daerah terhadap perangkat daerahnya.</p>
	  </div>
	</div>
    </div>
  </div>

</div>

   <div id="preloader">
    	<div id="loader"></div>
   </div>

   <!-- Java Script
   ================================================== -->
   <script src="<?= base_url() ?>assets/vendor/infinity-master/js/jquery-2.1.3.min.js"></script>
   <script src="<?= base_url() ?>assets/vendor/infinity-master/js/plugins.js"></script>
   <script src="<?= base_url() ?>assets/vendor/infinity-master/js/main.js"></script>
   <script src="<?= base_url() ?>assets/vendor/datepicker/bootstrap-datepicker.js"></script>
   <script type="text/javascript" src="<?= base_url() ?>assets/vendor/jqvmap-master/dist/jquery.vmap.js"></script>
   <script type="text/javascript" src="<?= base_url() ?>assets/vendor/jqvmap-master/dist/maps/jquery.vmap.indonesia.js" charset="utf-8"></script>
   <script src="https://code.highcharts.com/maps/highmaps.js"></script>
	<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/mapdata/countries/id/id-all.js"></script>
	<script type="text/javascript">
		$(window).on('load', function () {
			// var tahun = '<?=date("Y");?>';
			var tahun = '2019';
		  	$.ajax({
				url: '<?php echo base_url('hasil-pengawasan/get-chart-map'); ?>',
				type: 'POST',
				data:{tahun:tahun},
				success: function(data){
					var out = jQuery.parseJSON(data);
					Highcharts.mapChart('mapRekapTemuan', {
				    chart: {
				        map: 'countries/id/id-all'
				    },

				    title: {
				        text: '<b>JUMLAH TEMUAN</b>'
				    },

				    subtitle: {
				        text: 'Per Provinsi Tahun '+tahun
				    },

				    mapNavigation: {
				        enabled: false
				    },

				    colorAxis: {
				        min: 0,
				        max: 10,
				       	stops: [
				        [0, '#F44336'],
				        [0.25, '#2196F3'],
				        [0.50, '#4CAF50'],
				        [0.75, '#FFEB3B'],
				        [1, '#F44336']
				      ]
				    },
				     credits: {
		    			enabled: false
		  			},
				    series: [{
				        data: out.chart_temuan,
				        name: 'Jumlah Temuan',
				        states: {
				            hover: {
				                color: '#BADA55'
				            },
				        },
				        dataLabels: {
				            enabled: true,

				            format: '{point.name}'
				        }
				    }],
				    responsive: {
					  rules: [{
					    condition: {
					      maxWidth: 600
					    },
					    chartOptions: {
					      legend: {
					        enabled: false
					      }
					    }
					  }]
					}
				});

				}
			});


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

		$(document).on("click", "#search", function() {
			$("#mapRekapTemuan").html('<center><img src="<?php echo base_url('assets/img/loading.gif'); ?>" alt="Loading" height="60" width="60"></center>');
			var tahun = document.getElementById('tahun').value;
		  	$.ajax({
				url: '<?php echo base_url('hasil-pengawasan/get-chart-map'); ?>',
				type: 'POST',
				data:{tahun:tahun},
				success: function(data){
					var out = jQuery.parseJSON(data);
					Highcharts.mapChart('mapRekapTemuan', {
				    chart: {
				        map: 'countries/id/id-all'
				    },

				    title: {
				        text: 'Jumlah Temuan'
				    },

				    subtitle: {
				        text: 'Per Provinsi Tahun '+tahun
				    },

				    mapNavigation: {
				        enabled: true,
				        buttonOptions: {
				            verticalAlign: 'bottom'
				        }
				    },

				    colorAxis: {
				        min: 0,
				        max: 10,
				       	stops: [
				        [0, '#fcfcfc'],
				        [0.25, '#2196F3'],
				        [0.50, '#4CAF50'],
				        [0.75, '#FFEB3B'],
				        [1, '#F44336']
				      ]
				    },

				    series: [{
				        data: out.chart_temuan,
				        name: 'Jumlah Temuan',
				        states: {
				            hover: {
				                color: '#BADA55'
				            }
				        },
				        dataLabels: {
				            enabled: true,
				            format: '{point.name}'
				        }
				    }]
				});

				}
			});
		});

		$(document).on("click", "#card-tlhp-bpk", function() {
			window.location.href ='<?=base_url(str_replace('=', '', base64_encode('login-tlhp-kemendagri'))); ?>'; 
		});

		$(document).on("click", "#card-tlhp-itjen", function() {
			window.location.href ='<?=base_url(str_replace('=', '', base64_encode('login-tlhp-itjen'))); ?>'; 
		});

	});
	</script>

   <script type="text/javascript">
   		// Get the modal
		var modal = document.getElementById("myModal");

		// Get the button that opens the modal
		var btn = document.getElementById("myBtn");

		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];

		// When the user clicks on the button, open the modal
		btn.onclick = function() {
		  modal.style.display = "block";
		}

		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
		  modal.style.display = "none";
		}

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
		  if (event.target == modal) {
		    modal.style.display = "none";
		  }
		}
   </script>
   <script type="text/javascript">
   		// Get the modal
		var modal2 = document.getElementById("myModal2");

		// Get the button that opens the modal
		var btn2 = document.getElementById("myBtn2");

		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[1];

		// When the user clicks on the button, open the modal
		btn2.onclick = function() {
		  modal2.style.display = "block";
		}

		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
		  modal2.style.display = "none";
		}

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
		  if (event.target == modal2) {
		    modal2.style.display = "none";
		  }
		}
   </script>
   <script>
      jQuery(document).ready(function () {
        jQuery('#vmap').vectorMap(
		{
		    map: 'indonesia_id',
		    backgroundColor: 'transparent',

		    borderColor: '#fff',
		    borderOpacity: 0.50,
		    borderWidth: 2,
		    color: '#074979',
		    enableZoom: true,
		    hoverColor: '#33b7c6',
		    hoverOpacity: null,
		    normalizeFunction: 'linear',
		    scaleColors: ['#b6d6ff', '#005ace'],
		    selectedColor: '#c9dfaf',
		    selectedRegions: null,
		    showTooltip: true,

		    onRegionClick: function(element, code, region)
		    {
		        var message = 'Nama Daerah : '
		            + region;

		        alert(message);
		    }
		});
      });
    </script>
    <script type="text/javascript">
    function showMenuTlhp() {
    	$('#myModal').modal('show');
    }

    function showSIP() {
    	$('#myModal2').modal2('show');
    }
    </script>
    <script type="text/javascript">
    	// Prepare demo data
		// Data is joined to map using value of 'hc-key' property by default.
		// See API docs for 'joinBy' for more info on linking data and map.
    </script>

</body>

</html>
