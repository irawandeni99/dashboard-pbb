<style type="text/css">
	.highcharts-figure, .highcharts-data-table table {
    min-width: 320px;
    max-width: 95%;
    margin: 1em auto;
}


#container-penerimaan {
    height: 450px;
    width: 100%;
}

.highcharts-data-table table {
	font-family: Verdana, sans-serif;
	border-collapse: collapse;
	border: 1px solid #BCA88D;
	margin: 10px auto;
	text-align: center;
	width: 95%;
	max-width: 95%; 
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

<?php 
	if ($_SESSION['is_admin'] == 1) {
		$hide = 'hidden';
	}else{
		
		$ceksql="select COUNT(*)jml FROM ms_group_menu_elemen WHERE id_group='".$_SESSION['is_admin']."'";
		$cekgroup = $this->db->query($ceksql)->row()->jml;
		if($cekgroup >= 1){
			$hide = '';
		}else{
			$hide = 'hidden';
		}
				
	}
 ?>

<div class="swiffy-slider">
		<ul class="slider-container">

			<li>
				<div class="panel panel-headline  panel-primary">

					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<form class="form-horizontal" id="form-profil2">
								<button type="button" disabled class="collapsible-form active-form">

										<div class="row">
												<div class="form-group"> 
													<div class="col-md-12">
														<div class="col-md-11"> 
																<h3 class="panel-title"> <i class="fa fa-line-chart" style="padding-left: 10px"></i> Grafik efektivitas realisasi</h3> 

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
									<div class="row">
									
									
										<!-- <div class="col-md-12" style="text-align: center;"><label style="font-size:16pt;text-align: center;">Efektivitas Realisasi PBB</label></div><br>&nbsp;<br> -->
									<div class="col-md-12">
									
									<div class="row">
										<div class="col-md-12">
										

											<div class="col-md-12">
												<div class="col-md-8">	
													<div class="form-group">
														<!-- Label Kecamatan -->
														<div class="col-sm-2">
															<label class="col-sm-2 control-label input-sm" id="label-tipe">Kecamatan</label>
														</div>
														<!-- Dropdown Kecamatan -->
														<div class="col-sm-8">
															<select name="kecamatan" id="kecamatan" class="form-control input-sm" style="width:100%">
																<option value="000">Keseluruhan</option>
																<?php foreach($kecamatan as $row): ?>
																	<option value="<?= $row->kd_kecamatan; ?>">
																		<?= $row->kd_kecamatan; ?> | <?= $row->nm_kecamatan; ?>
																	</option>
																<?php endforeach; ?>
															</select>
														</div>
													</div>

													<!-- Periode Tanggal -->
												<div class="form-group" style="margin-top:10px;">
														<div class="col-sm-2">
															<label class="control-label input-sm">Periode</label>
														</div>
											
														<div class="col-sm-10" style="display:flex; align-items:center; gap:5px;">
															<div class="input-group" style="width:160px;">
																<div class="input-group-addon">
																	<i class="lnr lnr-calendar-full text-danger"></i>
																</div>
																	<input type="text" class="form-control" placeholder="Start Year" 
																	id="start_year" name="start_year" value="<?= date('Y') - 5; ?>">
																	
															</div>
															<span >S/D</span>

															<div class="input-group" style="width:160px;">
																<div class="input-group-addon">
																	<i class="lnr lnr-calendar-full text-danger"></i>
																</div>
																	<input type="text" class="form-control" placeholder="End Year" 
																	id="end_year" name="end_year" value="<?= date('Y'); ?>">
															</div>
															<button type="button" id="btn-tampil"  name="btn-tampil" class="btn btn-sm btn-primary" title='Tampilkan Grafik'>
																<i style="font-size:20px" class="fa">&#xf002;</i>
															</button>
														</div>

													</div>


												</div>


											</div>

										</div>
									</div>
					

								</div>
							</div>

									<div id="loading-spinner" style="display:none; text-align:center; margin:20px;">
										<center><img src="<?php echo base_url('assets/img/loading.gif'); ?>" alt="Loading" height="135" width="135"></center>
										<span style="font-size:16px; color:#00809D;">Loading data...</span>

									</div>
																	

								</div>


									<div class="col-md-12" style="margin-top:20px;" center>
										<figure class="highcharts-figure">
											<div id="container-penerimaan"></div>
										</figure>

										<div class="panel-footer" style="margin-top:70px; text-align:right;">
											<a href="<?= base_url($this->dynamic_menu->EncryptLink('dashboard'));?>" 
											class="btn btn-danger btn-lg">
												<i class="fa fa-arrow-circle-left"></i> KEMBALI
											</a>
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



 <!-- <input type="hidden" class="form-control input-sm" placeholder="Tahun" readonly="" id="tahun" name="tahun" value="<?= $this->session->userdata('year_selected'); ?>">
 -->


<div class="swiffy-slider">
    <ul class="slider-container">

		<li>

		<li>
			<div class="panel panel-headline  panel-primary">

				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<form class="form-horizontal" id="form-profil2">
									<button type="button" disabled class="collapsible-form active-form">

									</button>
									<div class="content-form" style="display:block;">
										<div class="row">
											<div class="col-md-12">
						
											<div class="row">
											
										</div>
						

											</div>
										</div>
										
										
										<div class="panel-footer">
											<center>
												<a href="<?= base_url($this->dynamic_menu->EncryptLink('dashboard'));?>" class="btn btn-danger btn-lg"><i class="fa fa-arrow-circle-left"></i> KEMBALI</a>
												<button type="button" data-aksi="simpan" class="btn btn-success btn-lg simpan-profil2"><i class="fa fa-check-square"></i> SIMPAN</button>
												<button type="button"  data-aksi="new" class="btn btn-primary btn-lg confirm hidden"><i class="fa fa-plus"></i> confirm</button>
											</center>
									</form>
								</div>					

							</div>

						</div>
					</div>

				</div>
			</div>	


		</li>

	</ul>

</div>	



<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/dataTables.fixedHeader.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/responsive.bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/highcharts/code/highcharts.js"></script>    

<script src="https://cdn.jsdelivr.net/npm/swiffy-slider@1.5.3/dist/js/swiffy-slider.min.js" crossorigin="anonymous" defer></script>
<link href="https://cdn.jsdelivr.net/npm/swiffy-slider@1.5.3/dist/css/swiffy-slider.min.css" rel="stylesheet" crossorigin="anonymous">

<script type="text/javascript">
	$(window).on('load', function () {
  		$(function () {
	  		$('[data-toggle="tooltip"]').tooltip();
			 
		});
				// Treeview Initialization
		$(document).ready(function() {
		  get_efektivitas_kab('000');	
		  $('.treeview-animated').mdbTreeview();

			$(function(){
				$("#start_year").datepicker({
					format: "yyyy",           // tampilkan tahun saja
					viewMode: "years",        // tampilan awal daftar tahun
					minViewMode: "years",     // hanya bisa memilih tahun
					autoclose: true
				});
			});

			$(function(){
				$("#end_year").datepicker({
					format: "yyyy",
					viewMode: "years",
					minViewMode: "years",
					autoclose: true
				});
			});



			$(document).ready(function() {
				$('#kecamatan').select2({
					placeholder: "Pilih Kecamatan",
					allowClear: true,
					width: '100%'   // supaya full lebar
				});
			});
		});

	});


	$(document).ready(function () {
		// event onchange
		$('#kecamatan').on('change', function () {
			var kec = $(this).val();
			get_efektivitas_kab(kec);
		});
	});	


	$('#tipe_chart').on('change', function() {
		let kec = $('#kecamatan').val();
		get_efektivitas_kab(kec);
	})

	$('#btn-tampil').on('click', function() {
		let kec = $('#kecamatan').val();
		get_efektivitas_kab(kec);
	})



function get_efektivitas_kab(kec) {
	$('#loading-spinner').show();
	$('#container-penerimaan').empty();

	const startYear = document.getElementById('start_year').value;
	const endYear   = document.getElementById('end_year').value;

	$.ajax({
		url: '<?= base_url('chart-efektivitas/get'); ?>/' + encodeURIComponent(kec),
		type: 'POST',
		data: { startYear, endYear },
		success: function (data) {
			let out = {};
			try {
				out = jQuery.parseJSON(data) || {};
			} catch (e) {
				console.error('JSON parse error:', e, data);
				$('#container-penerimaan').html("<p style='color:red;text-align:center;'>Data tidak Ditemukan</p>");
				return;
			}

			let namaGroup   = out.group || [];
			let sppt_tetap  = (out.sppt_tetap || []).map(v => Number(v) || 0);
			let sppt_real   = (out.sppt_real || []).map(v => Number(v) || 0);
			let nilai_tetap = (out.nilai_tetap || []).map(v => Number(v) || 0);
			let nilai_real  = (out.nilai_real || []).map(v => Number(v) || 0);
			let nama	    = out.nama || [];

			if (!namaGroup.length) {
				$('#container-penerimaan').html(`
					<div class="alert alert-info alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<center><b>Informasi</b> Tidak ditemukan data untuk periode ini</center>
					</div>
				`);
				return;
			}

			let cjudul = (kec === '000') 
				? 'Efektivitas Realisasi PBB Kabupaten Bulungan'
				: 'Efektivitas Realisasi PBB Kecamatan '+nama;

			let periode = startYear + ' s/d ' + endYear;
			let tipeChart = $('#tipe_chart').val() || 'column';

			$('#container-penerimaan').append(`
				<div id="chart-efektivitas" style="width:100%; height:500px;"></div>
			`);

			Highcharts.chart('chart-efektivitas', {
				chart: {
					type: tipeChart,
					backgroundColor: '#ffffff',
					style: { fontFamily: 'Segoe UI, Roboto, sans-serif' }
				},
				title: {
					text: `${cjudul}<br><p style="text-align:center; margin:0;">Periode ${periode}</p>`,
					useHTML: true,
					align: 'center',
					style: { fontSize:'17px', fontWeight:'bold', color:'#00707a' }
				},
				xAxis: { categories: namaGroup },
				yAxis: [
					{ // Primary Y-axis — SPPT
						labels: { format: '{value}', style: { color: '#1f77b4' } },
						title: { text: 'Jumlah SPPT', style: { color: '#1f77b4', fontWeight: 'bold' } }
					}, 
					{ // Secondary Y-axis — Nilai (Rp)
						labels: { 
							format: 'Rp {value:,.0f}', 
							style: { color: '#2ca02c' } 
						},
						title: { text: 'Nilai Pajak (Rp)', style: { color: '#2ca02c', fontWeight: 'bold' } },
						opposite: true
					}
				],
				tooltip: {
					shared: true,
					formatter: function() {
						let s = `<b>${this.x}</b><br/>`;
						this.points.forEach(p => {
							let label = (p.series.userOptions.axisType === 'nilai') ? 
								`Rp ${Highcharts.numberFormat(p.y,0,',','.')}` : 
								Highcharts.numberFormat(p.y,0,',','.');
							s += `<span style="color:${p.color}">●</span> ${p.series.name}: <b>${label}</b><br/>`;
						});
						return s;
					}
				},
				plotOptions: {
					column: { borderRadius: 4, dataLabels: { enabled: true } },
					line: { dataLabels: { enabled: true } },
					area: { dataLabels: { enabled: true }, fillOpacity: 0.3 }
				},
				colors: ['#1f77b4', '#ff7f0e', '#2ca02c', '#d62728'],
				legend: { align: 'center', verticalAlign: 'bottom' },
				credits: { enabled: false },
				series: [
					{ name: 'SPPT Tetap (Target)', data: sppt_tetap, yAxis: 0, axisType: 'sppt', type: 'column' },
					{ name: 'SPPT Realisasi', data: sppt_real, yAxis: 0, axisType: 'sppt', type: 'column' },
					{ name: 'Nilai Tetap (Target)', data: nilai_tetap, yAxis: 1, axisType: 'nilai', type: 'line', marker: { symbol: 'circle' } },
					{ name: 'Nilai Realisasi', data: nilai_real, yAxis: 1, axisType: 'nilai', type: 'line', marker: { symbol: 'diamond' } }
				]
			});
		},
		complete: function(){ $('#loading-spinner').hide(); },
		error: function(){ 
			$('#container-penerimaan').html("<p style='color:red;text-align:center;'>Gagal memuat data</p>"); 
		}
	});
}



	function kembali()
	{
		href="<?= base_url($this->dynamic_menu->EncryptLink('dashboard'));?>";
		window.location = href;
	}


</script>		