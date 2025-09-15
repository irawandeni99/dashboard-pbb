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
           <!--  <li>
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
	   			<h1>PROFIL PEMDA</h1>
	   		</div>

     	</div>



     	<div class="row">

     		<div class="col-four tab-full">
     			<div class="second hero klikLink" data-id = "infopembangunan" style="cursor:pointer" >
				  <img class="hero-profile-img" src="<?= base_url() ?>assets/img/hero-bg.jpg" alt="" width="100%">
				  <div class="hero-description-bk"></div>
				  
				  <div class="hero-description">
				    <p>Informasi Pembangunan Daerah</p>
				  </div>
				  
				  <div class="hero-btn">
				    <a target="_blank" href="<?=base_url($this->dynamic_menu->EncryptLink('profil-pemda/informasi-pembangunan-daerah')); ?>">Lihat</a>
				  </div>
				</div>	
	     	</div>

	     	<div class="col-four tab-full">
     			<div class="second hero klikLink" data-id = "infokeu" style="cursor:pointer" >
				  <img class="hero-profile-img" src="<?= base_url() ?>assets/img/hero-bg.jpg" alt="" width="100%">
				  <div class="hero-description-bk"></div>
				  
				  <div class="hero-description">
				    <p>Informasi Keuangan Daerah</p>
				  </div>
				  
				  <div class="hero-btn">
				    <a  href="<?=base_url($this->dynamic_menu->EncryptLink('profil-pemda/informasi-keuangan-daerah')); ?>">Lihat</a>
				  </div>
				</div>	
	     	</div>

	     	<div class="col-four tab-full">
     			<div class="second hero klikLink" data-id = "infolainnya" style="cursor:pointer" >
				  <img class="hero-profile-img" src="<?= base_url() ?>assets/img/hero-bg.jpg" alt="" width="100%">
				  <div class="hero-description-bk"></div>
				  
				  <div class="hero-description">
				    <p>Informasi Daerah Lainnya</p>
				  </div>
				  
				  <div class="hero-btn">
				    <a target="_blank" href="<?=base_url($this->dynamic_menu->EncryptLink('profil-pemda/informasi-daerah-lainnya')); ?>">Lihat</a>
				  </div>
				</div>	
	     	</div>

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
   <script src="<?= base_url() ?>assets/vendor/infinity-master/js/plugins.js"></script>
   <script src="<?= base_url() ?>assets/vendor/infinity-master/js/main.js"></script>
   <script type="text/javascript" src="<?= base_url() ?>assets/vendor/jqvmap-master/dist/jquery.vmap.js"></script>
   <script type="text/javascript" src="<?= base_url() ?>assets/vendor/jqvmap-master/dist/maps/jquery.vmap.indonesia.js" charset="utf-8"></script>
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

      function back () {
      	window.location.href = "<?= base_url(); ?>";
      }
    </script>

    <script type="text/javascript">
    	 $(document).on("click", ".klikLink", function() {

        	var id = $(this).attr('data-id');
        	if (id == 'infopembangunan') {
        		window.location.href = "<?=base_url($this->dynamic_menu->EncryptLink('profil-pemda/informasi-pembangunan-daerah')); ?>";
        	}else if(id == 'infokeu'){
        		window.location.href = "<?=base_url($this->dynamic_menu->EncryptLink('profil-pemda/informasi-keuangan-daerah')); ?>";
        	}else if(id == 'infolainnya'){
        		window.location.href = "<?=base_url($this->dynamic_menu->EncryptLink('profil-pemda/informasi-daerah-lainnya')); ?>";
        	}

		  });

    </script>

</body>

</html>