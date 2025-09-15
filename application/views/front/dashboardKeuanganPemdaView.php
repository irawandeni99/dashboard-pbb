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

   <style type="text/css">
   		@import url('https://fonts.googleapis.com/css2?family=Alata&family=Oswald:wght@600&family=Russo+One&display=swap');


@keyframes fade {
    0% {
        opacity: 0.2;
    }
    100% {
        opacity: 1;
    }
}

.slide-container {
    display: relative;
    max-width: 400px;
    max-height: 400px;
    margin: auto;
    position: relative;
}

.slide-container .slide {
    /*display: none;*/
    width: 100%;
}

.slide-container .slide.fade {
    animation: fade 0.5s cubic-bezier(0.55, 0.085, 0.68, 0.53) both;
}

.slide-container .slide img {
    width: 100%;
    position: relative;
    object-fit: cover;
}

.slide-container .prev,
.slide-container .next {
    cursor: pointer;
    position: absolute;
    top: 50%;
    width: auto;
    margin-top: -22px;
    padding: 16px;
    color: red;
    font-weight: bold;
    font-size: 20px;
    transition: all 0.6s ease;
    border-radius: 0 3px 3px 0;
    user-select: none;
}

.slide-container .prev:hover,
.slide-container .next:hover {
    background-color: rgba(0, 0, 0, 0.8);
    color: white;
}

.slide-container .prev {
    left: 2px;
}

.slide-container .next {
    right: 2px;
}

.container {
    width: 270px;
    height: 270px;
    overflow: hidden;
    background-color: white;
    border-radius: 15px;
    border-style: solid;
    border-color: rgba(255, 255, 255, 0);
    -webkit-box-shadow: 4px 8px 25px -1px rgba(0, 0, 0, 0.75);
    -moz-box-shadow: 4px 8px 25px -1px rgba(0, 0, 0, 0.75);
    box-shadow: 4px 8px 25px -1px rgba(0, 0, 0, 0.75);
    transition: 0.7s;
}

.logo {
    display: flex;
    position: relative;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 50px;

    background-color: red;
    /*clip-path: circle(100px at center 0);*/
    transition: 0.4s;
}

.team-logo {
    max-width: 150px;
    max-height: 150px;
}

.Read {
    display: flex;
    justify-content: center;
    align-content: center;
    flex-direction: row;
    width: 95%;
    margin-top: 10px;
    height: 100px;
    background-color: transparent;
    font-family: 'Alata', sans-serif;
    font-size: 13px;
}

.btn-div {
    margin-top: 7px;
    display: flex;
    justify-content: center;
    align-content: center;
    transition: 0.9s;
}

.btn {
    background-color: red;
    border-radius: 10px;
    color: white;
    cursor: default;
}

.btn p {
    margin: 9px;
    font-family: 'Oswald', sans-serif;
}

.ppg {
    border-style: solid;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    border-width: 0px;
    width: 33.33%;
    padding: 0px;
    margin: 0px;
}

.ppg h1 {
    padding: 0px;
    margin: 0px;
    font-size: 10pt;
    color: #fcb827;
}

.ppg p {
    font-size: 20px;
    padding: 0px;
    margin: 0px;
}

.sub {
    width: 80%;
    height: 33%;
    border-style: solid;
    border-width: 0px;
    display: flex;
    align-items: center;
    text-align: center;
}

.sub h1 {
    font-size: 12px;
    margin-right: 5px;
    font-weight: bold;

}

.sub p {
    font-size: 10px;
    margin-right: 5px;
    text-align: right;
}

.bottom-container {
    display: flex;
    /*justify-content: center;*/
    padding-left:10px;
}

.prec {
    width: 100%;
    height: 90%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.circle {
    position: relative;
    align-items: center;
    top: 8px;
    left: 8px;
    text-align: center;
    width: 64px;
    height: 64px;
    border-radius: 100%;
    background-color: white;
}

.active-border {
    position: relative;
    text-align: center;
    width: 80px;
    height: 80px;
    left:6px;
    border-radius: 100%;
    background-color: #39B4CC;
    background-image: linear-gradient(192deg, transparent 50%, white 50%), linear-gradient(90deg, white 50%, transparent 50%);
}

.score {
    margin-left: 10px;
    font-size: 15px;
    display: flex;
    align-items: flex-end;
    padding: 0px;
    font-family: 'Oswald', sans-serif;
}



/*bar*/
.skillBox {
  box-sizing:border-box;
  width: 100%;
  margin: 0 0 0px;
}

.skillBox p{
  color:#fcfcfc;
  text-transform: uppercase;
  margin: 0 0 0px;
  padding: 0;
  font-weight: bold;
  letter-spacing: 1px;
  font-size: 7pt;

}

.skillBox p:nth-child(2){
  float: right;
  position: relative;
  top : -30px;

}

.skill{
  background: #fff;
  padding: 1px;
  box-sizing:border-box;
  border: 1px solid #074979;
  border-radius: 2px;
}

.skill_level{
   background: #074979;
   width: 100%;
   height: 5px;
}


/*pagination*/

.page {
  display: none;
}
.page-active {
  display: block;
}
/*end css for pagination*/
/*bootstrap*/
.pagination {
  display: inline-block;
  padding-left: 0;
  margin: 20px 0;
  border-radius: 4px;
}
.pagination > li {
  display: inline;
}
.pagination > li > a,
.pagination > li > span {
  position: relative;
  float: left;
  padding: 6px 12px;
  margin-left: -1px;
  line-height: 1.42857143;
  color: #337ab7;
  text-decoration: none;
  background-color: #fff;
  border: 1px solid #ddd;
}
.pagination > li:first-child > a,
.pagination > li:first-child > span {
  margin-left: 0;
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px;
}
.pagination > li:last-child > a,
.pagination > li:last-child > span {
  border-top-right-radius: 4px;
  border-bottom-right-radius: 4px;
}
.pagination > li > a:hover,
.pagination > li > span:hover,
.pagination > li > a:focus,
.pagination > li > span:focus {
  z-index: 2;
  color: #23527c;
  background-color: #eee;
  border-color: #ddd;
}
.pagination > .active > a,
.pagination > .active > span,
.pagination > .active > a:hover,
.pagination > .active > span:hover,
.pagination > .active > a:focus,
.pagination > .active > span:focus {
  z-index: 3;
  color: #fff;
  cursor: default;
  background-color: #337ab7;
  border-color: #337ab7;
}
.pagination > .disabled > span,
.pagination > .disabled > span:hover,
.pagination > .disabled > span:focus,
.pagination > .disabled > a,
.pagination > .disabled > a:hover,
.pagination > .disabled > a:focus {
  color: #777;
  cursor: not-allowed;
  background-color: #fff;
  border-color: #ddd;
}
.pagination-lg > li > a,
.pagination-lg > li > span {
  padding: 10px 16px;
  font-size: 18px;
  line-height: 1.3333333;
}
.pagination-lg > li:first-child > a,
.pagination-lg > li:first-child > span {
  border-top-left-radius: 6px;
  border-bottom-left-radius: 6px;
}
.pagination-lg > li:last-child > a,
.pagination-lg > li:last-child > span {
  border-top-right-radius: 6px;
  border-bottom-right-radius: 6px;
}
.pagination-sm > li > a,
.pagination-sm > li > span {
  padding: 5px 10px;
  font-size: 12px;
  line-height: 1.5;
}
.pagination-sm > li:first-child > a,
.pagination-sm > li:first-child > span {
  border-top-left-radius: 3px;
  border-bottom-left-radius: 3px;
}
.pagination-sm > li:last-child > a,
.pagination-sm > li:last-child > span {
  border-top-right-radius: 3px;
  border-bottom-right-radius: 3px;
}

  /*Example of custom colors for pagination*/
.page-link {
    color: #000000;
    background-color: #ccc;
    border: 1px solid #111;
}
.page-item.disabled .page-link {
    color: #6c757d;
    background-color: #ccc;
    border-color: #111;
}
.page-item.active .page-link {
    color: #fff;
    background-color: #00B8D4;
    border-color: #00ACC1;
}
.page-link:hover {
    color: #0056b3;
    background-color: #e9ecef;
    border-color: #dee2e6;
}
.page-link:focus {
    box-shadow: 0 0 0 .2rem rgba(0,123,255,.25);
}
.prev .page-link {
    background-color: #ccc;
}
.first .page-link {
    background-color: #ccc;
}
.next .page-link {
    background-color: #ccc;
}
.last .page-link {
    background-color: #ccc;
}

.klikDetailDashboard {cursor: pointer;}


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
	         </li>	      -->    
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
	   			<h1>DASHBOARD KEUANGAN DAERAH</h1>
          <h3><?=strtoupper($ket) .' - '.$nm_daerah; ?></h3>
	   		</div>
	   		

     	</div>
     	<div class="row" id="dashboard-keuangan">
     		

     	</div>
      <center>
        
      <nav aria-label="Page navigation example">
        <ul id="pagination-demo" class="pagination pagination-lg justify-content-center">
        </ul>
      </nav>
      </center>



     	<div class="row" id="menu-pengawasan">

     		

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
   <script type="text/javascript" src="<?= base_url() ?>assets/vendor/jqvmap-master/dist/jquery.vmap.js"></script>
   <script type="text/javascript" src="<?= base_url() ?>assets/vendor/jqvmap-master/dist/maps/jquery.vmap.indonesia.js" charset="utf-8"></script>
   <script src="<?= base_url() ?>assets/vendor/datepicker/bootstrap-datepicker.js"></script>
   <script src="<?= base_url() ?>assets/vendor/sweetalert2/sweetalert2.all.min.js"></script>
   <script src="<?= base_url() ?>assets/vendor/twbs-pagination-master/jquery.twbsPagination.js"></script>
   
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
    	$(window).on('load', function () {

		  	var kode = 1;
		  	$.ajax({
				  url: '<?php echo base_url('profil-pemda/get-urusan'); ?>',
				  data:{kode:kode},
				  type: 'POST',
				  success: function(data){
				  	$("#pilihanMr").html(data);
				  }
			  })
		  	// ambil data default (data anggaran realisasi per kota dan provinsi)
		  	var cha = 'realAngg';
		  	var urusan = 'all';
        var daerah = <?=$id_daerah; ?>;
		  	$.ajax({
				  url: '<?php echo base_url('profil-pemda/get-rekap-realisasi-anggaran-pemda/'); ?>',
				  type: 'POST',
				  data:{cha:cha,urusan:urusan,daerah:daerah},
				  success: function(data){
				  	$("#dashboard-keuangan").html(data);
				  }
			  });

		  	
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
					$('#combo-kab').removeAttr('hidden','');
				}else{
					// alert(tipe);
					$('#combo-kab').attr('hidden','');
				}
			});


		$(document).on("click", "#search", function() {

        	var tipe = $('input[name=tipe_daerah]:checked').val();
        	var tahun = document.getElementById('tahun').value;
        	var daerah;
        	if (tipe == 'kab') {
        		var kabupaten = document.getElementById('kab').value;
        		daerah = kabupaten;
        	}else{
        		var provinsi = document.getElementById('prov').value;
        		daerah = provinsi;
        	}
        	if (daerah == '') {
        		// alert('HARAP PILIH DAERAH!');
        		Swal.fire({
						  icon: 'warning',
						  title: 'PERINGATAN!',
						  text: 'HARAP ISI PILIHAN DAERAH',
						});

        	}else{
        		$("#menu-pengawasan").html('<center><img src="<?php echo base_url('assets/img/loading.gif'); ?>" alt="Loading" height="42" width="42"></center>');
			  	$.ajax({
					  url: '<?php echo base_url('profil-pemda/get-info-keuangan'); ?>',
					  type: 'POST',
					  data:{daerah:daerah,tahun:tahun},
					  success: function(data){
					  	$("#menu-pengawasan").html(data);
					  }
				  });
        	}

		  });


    $(document).on("click", ".klikDetailDashboard", function() {

        var id_daerah = $(this).attr('data-daerah');
        window.location.href = "<?=base_url('profil-pemda/dashboard-keuangan-pemda/"+id_daerah+"'); ?>";

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

	</script>

</body>

</html>