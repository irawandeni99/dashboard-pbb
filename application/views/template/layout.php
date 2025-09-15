<!doctype html>
<html lang="en">
<head>
	<title><?=SHORT_APP_NAME; ?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/chartist/css/chartist-custom.css">
	<!-- <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/yearpicker/yearpicker.css"> -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/datepicker/datepicker3.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/mdb/css/mdb.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/mdb/css/style.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap-treeview-master/dist/bootstrap-treeview.min.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/main.css">
	<!-- link rel="stylesheet" href="<?= base_url() ?>assets/css/reset.css" -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/accordion_style.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="<?= base_url() ?>assets/css/font-googleapis.css" rel="stylesheet">
	<!-- select2 -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/select2/select2.min.css">
	<!-- radiocharm -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/radiocharm/jquery-radiocharm.css">
	
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?= base_url() ?>assets/img/favicon.png">

	<style type="text/css">
	.function_separator{
		text-align: right;
	}
	.function_right{
		text-align: right;
	}
	.function_separator_rp{
		text-align: right;
	}
	textarea{  
	  display: block;
	  box-sizing: padding-box;
	  overflow: hidden;
	}

</style>
	<!-- Javascript -->
	<!-- script src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script -->
	<script src="<?= base_url() ?>assets/js/jquery-3.3.1.js"></script>
	<script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?= base_url() ?>assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?= base_url() ?>assets/scripts/klorofil-common.js"></script>
	<script src="<?= base_url() ?>assets/scripts/script.js"></script>
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/css/multi-select.css">

	<script src="<?= base_url(); ?>/assets/js/jquery.multi-select.js"></script>
<!-- 
	<script src="<?= base_url() ?>assets/vendor/yearpicker/yearpicker.js"></script>
	 -->
	<script src="<?= base_url() ?>assets/vendor/datepicker/bootstrap-datepicker.js"></script>

	<script src="<?= base_url() ?>assets/vendor/mdb/js/mdb.js"></script>
	<script src="<?= base_url() ?>assets/vendor/bootstrap-treeview-master/dist/bootstrap-treeview.min.js"></script>
	<script src="<?= base_url() ?>assets/vendor/select2/select2.min.js"></script>
	<script src="<?= base_url() ?>assets/vendor/radiocharm/jquery-radiocharm.js"></script>
	<script src="<?= base_url() ?>assets/vendor/sweetalert2/sweetalert2.all.min.js"></script>
	<script src="<?= base_url() ?>assets/vendor/datepicker/bootstrap-datepicker.js"></script>
	<script src="<?= base_url() ?>assets/js/jquery.mask.min.js"></script>
	<script src="<?= base_url() ?>assets/js/jquery.number.min.js"></script>
	
	
	<script src="<?= base_url() ?>assets/js/blockui.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		    // Format mata uang.
		    $( '.function_separator' ).mask('00,000,000,000.00', {reverse: true});
		    $( '.function_separator_rp' ).mask('00.000.000.000,00', {reverse: true});
		    $( '.function_nik' ).mask('00000000 000000 0 000', {reverse: true});

		});

	$(document)
    .one('focus.autoExpand', 'textarea.autoExpand', function(){
        var savedValue = this.value;
        this.value = '';
        this.baseScrollHeight = this.scrollHeight;
        this.value = savedValue;
    })
    .on('input.autoExpand', 'textarea.autoExpand', function(){
        var minRows = this.getAttribute('data-min-rows')|0, rows;
        this.rows = minRows;
        rows = Math.ceil((this.scrollHeight - this.baseScrollHeight) / 16);
        this.rows = minRows + rows;
    });
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			const flashdata = $('.flash-data').data('flashdata');
			if (flashdata) {
				Swal.fire({
				  position: 'top-end',
				  icon: 'success',
				  title: flashdata,
				  showConfirmButton: false,
				  timer: 2000
				})
			};
		});
	</script>

	

	<style type="text/css">
		html { overflow-y: scroll; overflow-x:hidden; }
		body {
		    font-family: Arial, Helvetica, sans-serif;
		}
	</style>

</head>

<body>
	<!-- WRAPPER -->
	<div id="container-new">
	<a id="btnScrollToTop"></a>
		<!-- NAVBAR -->
		<header class="">
			<?php include('navbar.php'); ?>
		</header>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<section id="sidebar-new">
			<?php include('sidebar.php'); ?>
		</section>
		<!-- END LEFT SIDEBAR -->
		<section id="pathway"></section>
		<!-- MAIN -->
		<section id="wrapper-new">		
			<!-- MAIN CONTENT -->
			<div class="contentpane">
				<!-- <div class="container-fluid"> -->
				<!-- <?php echo $breadcrumbs ?> -->
				<?php
			$bc 	= $this->breadcrumbs->generate_breadcrumb();
			echo $bc;
		?>
				<?php $this->load->view($view);?>
				<!-- </div> -->
			</div>
			<!-- END MAIN CONTENT -->
		</section>
		<!-- END MAIN -->
		<div class="clearfix"></div>

		<!-- Footer -->
		<footer class="page-footer font-small blue py-10" style="height:30px !important;">

		  <!-- Copyright -->
		 <!--  <div class="footer-copyright text-center py-3">© 2020 Copyright:
		    <a href="https://mdbootstrap.com/"> MDBootstrap.com</a>
		  </div> -->
		  <!-- Copyright -->


			<div class="container-fluid">
				<div class="copyright">&copy; 2021 MSM. All Rights Reserved. Version 1.2.0</div>
			</div>

		</footer>
		
		<!-- Footer -->
	</div>
	<!-- END WRAPPER -->

	<script type="text/javascript">
		var btn = $('#btnScrollToTop');

		$(window).scroll(function() {
		  if ($(window).scrollTop() > 300) {
		    btn.addClass('show');
		  } else {
		    btn.removeClass('show');
		  }
		});

		btn.on('click', function(e) {
		  e.preventDefault();
		  $('html, body').animate({scrollTop:0}, '300');
		});
	</script>

	
</body>

</html>
