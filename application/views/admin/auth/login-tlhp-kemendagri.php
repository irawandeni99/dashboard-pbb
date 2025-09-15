
<!doctype html>
<html lang="en" class="fullscreen-bg">
<head>
<title><?=SHORT_APP_NAME; ?> - LOGIN TLHP</title>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

	<!-- VENDOR CSS -->

	<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">

	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/font-awesome/css/font-awesome.min.css">

	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/linearicons/style.css">

	<!-- MAIN CSS -->

	<link rel="stylesheet" href="<?= base_url() ?>assets/css/main.css">

	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->

	<link rel="stylesheet" href="<?= base_url() ?>assets/css/demo.css">

	<!-- GOOGLE FONTS -->

   <!-- <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/infinity-master/css/main.css">  -->
	<link href="<?= base_url() ?>assets/css/font-googleapis.css" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/radiocharm/jquery-radiocharm.css"> 
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/datepicker/datepicker3.css">

	<!-- ICONS -->

	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/kemendagri.png">

	<link rel="icon" type="image/png" sizes="90x60" href="assets/img/favicon.png">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/datepicker/datepicker3.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/select2/select2.min.css">
	<style type="text/css">
		body {
			background-image: url("<?php base_url(); ?>assets/img/hero-bg.jpg");
			background-repeat: repeat;
			background-position: center;
			background-size: cover;
			font-family: 'Roboto', sans-serif;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
			text-rendering: optimizeLegibility;
			font-size: 12px;
		}
	</style>
	<style type="text/css">
    body {
        color: #999;
		/*background: #f5f5f5;*/
		font-family: 'Varela Round', sans-serif;
	}
	.form-control {
		box-shadow: none;
		border-color: #ddd;
	}
	.form-control:focus {
		border-color: #074979; 
	}
	.login-form {
        width: 300px;
		margin: 20px auto;
		/*padding: 30px 0;*/
	}



    .login-form form {
        color: #434343;
		border-radius: 1px;
    	margin-bottom: 15px;
        background: #fff;
        opacity: 0.95;
		border: 1px solid #f3f3f3;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
	}
	.login-form h4 {
		text-align: center;
		font-size: 22px;
        margin-bottom: 20px;
	}
    .login-form .avatar {
        color: #fff;
		margin: 0 auto 20px;
        text-align: center;
		width: 105px;
		height: 105px;
		border-radius: 50%;
		border: 3px solid #f8a403;
		z-index: 9;
		background: #074979;
		padding: 15px;
		box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
	}
    .login-form .avatar i {
        font-size: 62px;
    }
    .login-form .form-group {
        margin-bottom: 20px;
    }
	.login-form .form-control, .login-form .btn {
		min-height: 40px;
		border-radius: 2px; 
        transition: all 0.5s;
	}
	.login-form .close {
        position: absolute;
		top: 15px;
		right: 15px;
	}
	.login-form .btn {
		background: #074979;
		border: 3px solid #f8a403;
		line-height: normal;
	}
	.login-form .btn:hover, .login-form .btn:focus {
		background: #074960;
	}
    .login-form .checkbox-inline {
        float: left;
    }
    .login-form input[type="checkbox"] {
        margin-top: 2px;
    }
    .login-form .forgot-link {
        float: right;
    }
    .login-form .small {
        font-size: 13px;
    }
    .login-form a {
        color: #074979;
    }
    .login-form .back a {
        color: #fff;
    }
</style>

<style type="text/css">
.highcharts-figure, .highcharts-data-table table {
    min-width: 120px; 
    max-width: 300px;
    margin: 1em auto;
}

#container-rekomendasi {
    height: 275px;
}
#container-temuan {
    height: 275px;
}
#container-nilai-temuan {
    height: 275px;
}

.highcharts-data-table table {
	font-family: Verdana, sans-serif;
	border-collapse: collapse;
	border: 1px solid #EBEBEB;
	margin: 10px auto;
	text-align: center;
	width: 100%;
	max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
	font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

</style>

</head>
<body>
	<div class="row">
		<div class="col-md-9 hidden">
			<div class="panel panel-primary" style="margin: 20px 20px;height:600px;opacity: 0.95;"> 
			<div class="panel-heading">
				<center><h4>DASHBOARD MANAJEMEN TLHP KEMENDAGRI</h4></center>
			</div>
			<div class="panel-body">
				<div class="row hidden">
					<div class="col-md-12">
				   		<input 
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
				
				<br>
				<div class="row">
		     		<div class="col-md-3" id="combo-prov" >
					  <select name="prov" id="prov" class="form-control input-sm" style="width:100%">
										
					  </select>
					</div>
					<div class="col-md-3" id="combo-kab" hidden>
					  <select name="kab" id="kab" class="form-control input-sm" style="width:100%">
						
					  </select>
					</div>
		     		<div class="col-md-3">
		     			<div class="input-group">
		     				<div class="input-group-addon"><i class="lnr lnr-calendar-full"></i></div>
		     				<input class="form-control input-sm" type="text" placeholder="Tahun" id="tahunSearch" name="tahun" readonly="" value="<?= date('Y'); ?>">
		     			</div>
		     		</div>
					<div class="col-md-3">
						<button type="submit" class="btn-primary " id="search"><i class="icon fa fa-search"></i> Cari</button>
					</div>
		     	</div>
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="col-md-4">
						<div class="panel" style="min-height:300px;margin:0px 0px 10px 0px;">
							<div class="panel-body">
								<h6>STATISTIK REKOMENDASI 
								<span class="badge badge-primary pull-right" id="jml-rekomendasi">TOTAL : 0</span>
								</h6>
								<div style="border-top:2px solid #f8a406;padding:5px 5px 10px 5px;"></div>
								<figure class="highcharts-figure">
								    <div id="container-rekomendasi">
								    	<center>
								    		<img src="<?php echo base_url('assets/img/kemendagri.png'); ?>" alt="Loading" width="150" style= "opacity:0.2;">
								    	</center>
								    </div>
								</figure>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="panel" style="min-height:300px;margin:0px 0px 10px 0px;">
							<div class="panel-body">
								<h6>STATISTIK TEMUAN 
								<span class="badge badge-primary pull-right" id="jml-temuan">TOTAL : 0</span>
								</h6>
								<div style="border-top:2px solid #f8a406;padding:5px 5px 10px 5px;"></div>
								<figure class="highcharts-figure">
								    <div id="container-temuan">
										<div style="margin-top:10px;">
											<center>
												<img src="<?php echo base_url('assets/img/kemendagri.png'); ?>" alt="Loading" width="150" style= "opacity:0.2;">
											</center>
										</div>

								    </div>
								</figure>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="panel" style="min-height:300px;margin:0px 0px 10px 0px;">
							<div class="panel-body">
								<h6>STATISTIK NILAI TEMUAN
								<span class="badge badge-primary pull-right" id="jml-nilai-temuan">NILAI (Jt) : 0</span>
								</h6>
								<div style="border-top:2px solid #f8a406;padding:5px 5px 10px 5px;">
									<figure class="highcharts-figure">
								    <div id="container-nilai-temuan">
								    	<center>
											<img src="<?php echo base_url('assets/img/kemendagri.png'); ?>" alt="Loading" width="150" style= "opacity:0.2;">
								    	</center>
								    </div>
								</figure>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	     	<br>
			<div style="border-top:2px solid #f8a406;padding:5px 5px 10px 5px;"></div>



			


			</div>

		</div>
		<div class="fluid">
			<div class="login-form">    
		    <?php echo form_open(base_url(str_replace('=', '', base64_encode('login-tlhp-kemendagri'))), ''); ?>
				<div class="avatar"><img src="assets/img/kemendagri.png" style="width:64px; height:80px;"></div>
		    	<h4 class="modal-title"><label>LOGIN <?=SHORT_APP_NAME; ?></label><br><label style="font-size:9pt;">(PEMANTAUAN TLHP BPK)</label></h4>
		        <div class="form-group">
					<label for="signin-email" class="control-label sr-only">Username</label>
					<input type="text" name="username" class="form-control" id="signin-email" placeholder="Username"  required>
				</div>
				
				<div class="form-group">
					<label for="signin-password" class="control-label sr-only">Password</label>
					<input type="password" name="password" class="form-control" id="signin-password" placeholder="Password" required>
				</div>

		        <div class="form-group">
				    <div class="input-group">
				      <div class="input-group-addon"><i class="lnr lnr-calendar-full"></i></div>
				      <input type="text" class="form-control" placeholder="Tahun" readonly="" id="tahun" name="tahun" value="<?= date('Y'); ?>">
				    </div>
			    </div>
		        <input class="btn btn-primary btn-block btn-lg"  type="submit" name="submit" id="submit" value="Login">              
		    <?php echo form_close( ); ?>
		    	<div class="text-center small back"><a href="<?php echo base_url(); ?>">Kembali Ke Dashboard</a></div>
			</div>
		</div>
	</div>

	
	<script src="<?= base_url() ?>assets/js/jquery-3.3.1.js"></script>
	<script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?= base_url() ?>assets/vendor/datepicker/bootstrap-datepicker.js"></script>
	<script src="<?= base_url() ?>assets/vendor/radiocharm/jquery-radiocharm.js"></script>
	<script src="<?= base_url() ?>assets/vendor/select2/select2.min.js"></script>
	<script src="<?= base_url() ?>assets/vendor/highcharts/code/highcharts.js"></script>    
	<script src="<?= base_url() ?>assets/vendor/sweetalert2/sweetalert2.all.min.js"></script>
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
	});
	</script>

	<script type="text/javascript">
    	$(window).on('load', function () {

		  	var kode = 1;
		  	$.ajax({
				  url: '<?php echo base_url('data-user/getinstansi'); ?>',
				  data:{kode:kode},
				  type: 'POST',
				  success: function(data){
				  	$("#prov").html(data);
				  }
			  })

		  	$('#prov').select2({
		  	placeholder: 'Pilih Instansi'
			});
	        // kab
			$('#kab').select2({
				 placeholder: 'Pilih Kabupaten/Kota'
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

		$(document).on("click", "#search", function() {

        	
        	
        	var tahun = document.getElementById('tahunSearch').value;
    		var provinsi = document.getElementById('prov').value;
    		daerah = provinsi;
        	
        	if (daerah == '') {
        		Swal.fire({
						  icon: 'warning',
						  title: 'PERINGATAN!',
						  text: 'HARAP ISI PILIHAN INSTANSI',
						});
        	}else{
        		$("#container-rekomendasi").html('<div style="margin-top:10px;"><center><img src="<?php echo base_url('assets/img/spinner.gif'); ?>" alt="Loading" height="150" width="150" style= "opacity:0.2;"><br>Loading ...</center></div>');
        		$("#container-temuan").html('<div style="margin-top:10px;"><center><img src="<?php echo base_url('assets/img/spinner.gif'); ?>" alt="Loading" height="150" width="150" style= "opacity:0.2;"><br>Loading ...</center></div>');
        		$("#container-nilai-temuan").html('<div style="margin-top:10px;"><center><img src="<?php echo base_url('assets/img/spinner.gif'); ?>" alt="Loading" height="150" width="150" style= "opacity:0.2;"><br>Loading ...</center></div>');


			  	$.ajax({
					  url: '<?php echo base_url('hasil-pengawasan/get-chart-kemendagri'); ?>',
					  type: 'POST',
					  data:{daerah:daerah,tahun:tahun},
					  success: function(data){
					  	var out = jQuery.parseJSON(data);

					  	$("#jml-rekomendasi").html(out.jml_rekomendasi);
					  	$("#jml-temuan").html(out.jml_temuan);
					  	$("#jml-nilai-temuan").html(out.jml_nilai_temuan);



					  	// untuk temuan
					  	var s = out.chart_rekomendasi;
					  	var t = out.chart_temuan;


					  	// untuk nilai temuan
						var nama = out.nama;
						var nilai_temuan = out.nilai_temuan;
						var nilai_setoran = out.nilai_setoran;

						// disini highchart

						Highcharts.setOptions({
						    colors: ['deepskyblue', 'forestgreen', 'gold', 'red']
						});

						if (out.jml_rekomendasi_angka > 0) {
								// rekomendasi
								Highcharts.chart('container-rekomendasi', {
							    chart: {
							        plotBackgroundColor: null,
							        plotBorderWidth: 0,
							        plotShadow: false
							    },
							    title: {
							        text: '',
							        align: 'center',
							        verticalAlign: 'middle',
							        y: 60
							    },
							    tooltip: {
							        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
							    },
							    accessibility: {
							        point: {
							            valueSuffix: '%'
							        }
							    },
							    plotOptions: {
							        pie: {
							            
							            cursor: 'pointer',
							            dataLabels: {
							                enabled: false
							            },
							            showInLegend: {enabled :true,allowPointSelect: true,},
							            legend: {
									        itemStyle: {
									            color: '#000000',
									            fontWeight: 'bold',
									            fontSize:'1px',
									        }
									    },
							           
							            center: ['50%', '50%'],
							            size: '100%'
							        }
							    },
							    credits: {
							        enabled: false
							    },
							    series: [{
							        type: 'pie',
							        name: 'Persentase',
							        data: s
							    }]
							});
						}else{
							$('#container-rekomendasi').html('<center>BELUM ADA REKOMENDASI</center>');
						}
						
						if (out.jml_temuan_angka > 0) {
							//temuan
							Highcharts.chart('container-temuan', {
							    chart: {
							        plotBackgroundColor: null,
							        plotBorderWidth: 0,
							        plotShadow: false
							    },
							    title: {
							        text: '',
							        align: 'center',
							        verticalAlign: 'middle',
							        y: 60
							    },
							    tooltip: {
							        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
							    },
							    accessibility: {
							        point: {
							            valueSuffix: '%'
							        }
							    },
							    plotOptions: {
							        pie: {
							            
							            cursor: 'pointer',
							            dataLabels: {
							                enabled: false
							            },
							            showInLegend: {enabled :true,allowPointSelect: true,},
							            legend: {
									        itemStyle: {
									            color: '#000000',
									            fontWeight: 'bold',
									            fontSize:'1px',
									        }
									    },
							            center: ['50%', '50%'],
							            size: '100%'
							        }
							    },
							    credits: {
							        enabled: false
							    },
							    series: [{
							        type: 'pie',
							        name: 'Persentase',
							        data: t
							    }]
							});

							// nilai
							Highcharts.chart('container-nilai-temuan', {
							    chart: {
							        type: 'bar'
							    },
							    title: {
							        text: ''
							    },
							    xAxis: {
							        categories: nama,
							        title: {
							            text: null
							        }
							    },
							    yAxis: {
							        min: 0,
							        title: {
							            text: 'Rupiah (Juta)',
							            align: 'high'
							        },
							        labels: {
							            overflow: 'justify'
							        }
							    },
							    tooltip: {
							        valueSuffix: ' Juta'
							    },
							    plotOptions: {
							        bar: {
							            dataLabels: {
							                enabled: true
							            }
							        }
							    },
							    
							    credits: {
							        enabled: false
							    },
							    series: [{
							        name: 'TEMUAN',
							        data: nilai_temuan
							    }, {
							        name: 'SETORAN',
							        data: nilai_setoran
							    }]
							});

						}else{
							$('#container-temuan').html('<center>BELUM ADA TEMUAN</center>');
							$('#container-nilai-temuan').html('<center>BELUM ADA TEMUAN</center>');
						}

					

					

					  }
				  });
        	}

		  });
	</script>
	<script type="text/javascript">
	$(document).ready(function() {	
		 $(function() {
			  $("#tahunSearch").datepicker({
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

</body>
</html>


