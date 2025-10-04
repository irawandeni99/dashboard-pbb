<style type="text/css">
	.highcharts-figure, .highcharts-data-table table {
    min-width: 320px; 
    max-width: 500px;
    margin: 1em auto;
}

#container-penerimaan {
    height: 450px;
    width: 900px;
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
																<h3 class="panel-title"> <i class="fa fa-line-chart" style="padding-left: 10px"></i> Grafik penerimaan Pajak</h3> 

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
									
									
										<div class="col-md-12" style="text-align: center;"><label style="font-size:16pt;text-align: center;">Penerimaan Pajak Kecamatan</label></div><br>&nbsp;<br>
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
																<option value="000">Semua Kecamatan</option>
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
																	<input type="text" class="form-control" placeholder="Start Date" 
																	id="start_date" name="start_date" value="<?= date('01-01-Y'); ?>">
															</div>
															<span >S/D</span>

															<div class="input-group" style="width:160px;">
																<div class="input-group-addon">
																	<i class="lnr lnr-calendar-full text-danger"></i>
																</div>
																	<input type="text" class="form-control" placeholder="End Date" 
																	id="end_date" name="end_date" value="<?= date('d-m-Y'); ?>">
															</div>
															<button type="button" id="btn-tampil"  name="btn-tampil" class="btn btn-sm btn-primary" title='Tampilkan Grafik'>
																<i style="font-size:20px" class="fa">&#xf002;</i>
															</button>
														</div>

													</div>


												</div>

												<!-- Dropdown Tipe Chart --> 
												<div class="col-md-4">
													<div class="form-group">
														<div class="col-sm-4">
															<label class="col-sm-12 control-label input-sm">Tipe Chart</label>
														</div>
														<div class="col-sm-8">
															<select name="tipe_chart" id="tipe_chart"  class="form-control input-sm" style="width:100%">
																<option value="bar">Bar</option>
																<option value="column">Column</option>
																<option value="pie">Pie</option>
																<option value="area">Area</option>
																<option value="line">Line</option>
															</select>
														</div>
													</div>
												</div>
											</div>

										</div>
									</div>
					

										</div>
									</div>

									<div id="loading-spinner" style="display:none; text-align:center; margin:20px;">
                                    <center><img src="<?php echo base_url('assets/img/loading5.gif'); ?>" alt="Loading" height="135" width="135"></center>
									<span style="font-size:16px; color:#00809D;">Loading data...</span>

									</div>
																	
									<div class="col-md-8" style="margin-top:20px;">
										<figure class="highcharts-figure">
											<div id="container-penerimaan"></div>
										</figure>

										<div class="panel-footer" style="margin-top:20px; text-align:right;">
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
				</div>	
			</li>
	</ul>


    <div class="slider-indicators">
        <button class="active"></button>
        <button></button>
        <button></button>
    </div>
</div>



 <input type="hidden" class="form-control input-sm" placeholder="Tahun" readonly="" id="tahun" name="tahun" value="<?= $this->session->userdata('year_selected'); ?>">



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
		  get_penerimaan_kecamatan('000');	
		  $('.treeview-animated').mdbTreeview();

				$(function(){
					$("#start_date").datepicker({
						format: "dd-mm-yyyy",   
						autoclose: true
					});
				});

				$(function(){
					$("#end_date").datepicker({
						format: "dd-mm-yyyy",   
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
			get_penerimaan_kecamatan(kec);
		});
	});	


	$('#tipe_chart').on('change', function() {
		let kec = $('#kecamatan').val();
		get_penerimaan_kecamatan(kec);
	})

	$('#btn-tampil').on('click', function() {
		let kec = $('#kecamatan').val();
		get_penerimaan_kecamatan(kec);
	})

	function formatToYMD(dateStr) {
		const parts = dateStr.split('-'); // misalnya "25-09-2025"
		const d = new Date(parts[2], parts[1] - 1, parts[0]); // (Y, M-1, D)

		const year = d.getFullYear();
		const month = String(d.getMonth() + 1).padStart(2, '0');
		const day = String(d.getDate()).padStart(2, '0');

		return `${year}-${month}-${day}`;
	}


	function get_penerimaan_kecamatan_xxx(kec) {
		$('#loading-spinner').show();
		$('#container-penerimaan').empty();
		// Ambil nilai input sebagai string (format yyyy-mm-dd)
		const _startDate = document.getElementById('start_date').value;
		const _endDate = document.getElementById('end_date').value;
		const startDate = formatToYMD(_startDate);
		const endDate   = formatToYMD(_endDate);


				
		$.ajax({
			url: '<?= base_url('chart-penerimaan/get'); ?>/' + encodeURIComponent(kec),
			type: 'POST',
			data: { startDate, endDate },
			success: function (data) {
				var out = {};
				try {
					out = jQuery.parseJSON(data) || {};

				} catch(e) {
					console.error('JSON parse error:', e, data);
					$('#container-penerimaan').html("<p style='color:red;text-align:center;'>Data tidak Ditemukan</p>");
					return;
				}

				var namaGroup = out.group || [];
				var pokok     = (out.pokok || []).map(v => v || 0);
				var denda     = (out.denda || []).map(v => v || 0);

				// Jika tidak ada data, tampilkan pesan dan keluar
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

						? 'Penerimaan pajak per kecamatan <br> periode ' 
						+ formatTanggalIndonesia(startDate) + ' s/d ' 
						+ formatTanggalIndonesia(endDate)
						: 'Penerimaan pajak per kelurahan <br> periode ' 
						+ formatTanggalIndonesia(startDate) + ' s/d ' 
						+ formatTanggalIndonesia(endDate);	

				var tipeChart = $('#tipe_chart').val();
				let seriesData = [];

				if (tipeChart === 'pie') {
					namaGroup.forEach(function(nm, i) {
						seriesData.push({ name: nm, y: pokok[i] + denda[i] });
					});
				}

				Highcharts.chart('container-penerimaan', {
					chart: { type: tipeChart, backgroundColor: '#ffffff', style: { fontFamily: 'Segoe UI, Roboto, sans-serif' } },
					colors: ['#4e79a7','#f28e2b','#76b7b2','#e15759','#59a14f','#edc949'],
					title: { text: cjudul, style: { fontSize:'18px', fontWeight:'bold', color:'#00809d', lineHeight: '25.4em' } },
					xAxis: (tipeChart !== 'pie') ? { categories: namaGroup } : undefined,
					yAxis: (tipeChart !== 'pie') ? { min:0, title:{ text:'Jumlah (Rp)', style:{ fontWeight:'bold' } } } : undefined,
					tooltip: {
						shared: false,
						formatter: function() {
							if (this.series.type === 'pie') {
								return `<b>${this.point.name}</b><br/>
										Total: <b>${Highcharts.numberFormat(this.point.y,0,',','.')}</b><br/>
										(${Highcharts.numberFormat(this.point.percentage,1)}%)`;
							} else {
								var index = this.point.index;
								var pokokValue = pokok[index] || 0;
								var dendaValue = denda[index] || 0;
								var total = pokokValue + dendaValue;

								return `<p style="color:#007074; font-weight:bold; margin:0;">${this.point.category}</p><br/>
										Pokok  : <b style="color:#4e79a7;">${Highcharts.numberFormat(pokokValue,0,',','.')}</b><br/>
										Denda  : <b style="color:#e15759;">${Highcharts.numberFormat(dendaValue,0,',','.')}</b><br/>
										Total  : <b style="color:#2ca02c;">${Highcharts.numberFormat(total,0,',','.')}</b>`;
							}
						}
					},
					plotOptions: {
						series: {
							borderRadius: (tipeChart !== 'pie') ? 4 : 0,
							stacking: (tipeChart !== 'pie') ? 'normal' : undefined,
							dataLabels: { enabled:true, formatter:function(){ return Highcharts.numberFormat(this.y,0,',','.'); } }
						},
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							showInLegend: true,
							dataLabels: { enabled:true, format:'<b>{point.name}</b><br>{point.y:,.0f} ({point.percentage:.1f}%)' }
						}
					},
					credits: { enabled:false },
					series: (tipeChart === 'pie') ? [{ name:'Total Pajak', colorByPoint:true, data:seriesData }] 
												: [{ name:'Pokok', data:pokok }, { name:'Denda', data:denda }]
				});
			},
			complete: function(){ $('#loading-spinner').hide(); },
			error: function(){ $('#container-penerimaan').html("<p style='color:red;text-align:center;'>Gagal memuat data</p>"); }
		});



	}


function get_penerimaan_kecamatan(kec) {
	$('#loading-spinner').show();
	$('#container-penerimaan').empty();

	const _startDate = document.getElementById('start_date').value;
	const _endDate   = document.getElementById('end_date').value;
	const startDate  = formatToYMD(_startDate);
	const endDate    = formatToYMD(_endDate);

	$.ajax({
		url: '<?= base_url('chart-penerimaan/get'); ?>/' + encodeURIComponent(kec),
		type: 'POST',
		data: { startDate, endDate },
		success: function (data) {
			var out = {};
			try {
				out = jQuery.parseJSON(data) || {};
			} catch(e) {
				console.error('JSON parse error:', e, data);
				$('#container-penerimaan').html("<p style='color:red;text-align:center;'>Data tidak Ditemukan</p>");
				return;
			}

			var namaGroup = out.group || [];
			var pokok     = (out.pokok || []).map(v => v || 0);
			var denda     = (out.denda || []).map(v => v || 0);

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
				? 'Penerimaan pajak per kecamatan <br> periode ' 
				  + formatTanggalIndonesia(startDate) + ' s/d ' 
				  + formatTanggalIndonesia(endDate)
				: 'Penerimaan pajak per kelurahan <br> periode ' 
				  + formatTanggalIndonesia(startDate) + ' s/d ' 
				  + formatTanggalIndonesia(endDate);	

			var tipeChart = $('#tipe_chart').val();
			let seriesData = [];

			if (tipeChart === 'pie') {
				namaGroup.forEach(function(nm, i) {
					seriesData.push({ name: nm, y: pokok[i] + denda[i] });
				});
			}

			Highcharts.chart('container-penerimaan', {
				chart: { 
					type: tipeChart, 
					backgroundColor: '#ffffff', 
					style: { fontFamily: 'Segoe UI, Roboto, sans-serif' } 
				},
				colors: ['#4e79a7','#f28e2b','#76b7b2','#e15759','#59a14f','#edc949'],
				title: { 
					text: cjudul, 
					style: { fontSize:'18px', fontWeight:'bold', color:'#00809d', lineHeight: '25.4em' } 
				},
				xAxis: (tipeChart !== 'pie') ? { categories: namaGroup } : undefined,
				yAxis: (tipeChart !== 'pie') ? { 
					min:0, 
					title:{ text:'Jumlah (Rp)', style:{ fontWeight:'bold' } } 
				} : undefined,
				tooltip: {
					shared: false,
					formatter: function() {
						if (this.series.type === 'pie') {
							return `<b>${this.point.name}</b><br/>
									Total: <b>${Highcharts.numberFormat(this.point.y,0,',','.')}</b><br/>
									(${Highcharts.numberFormat(this.point.percentage,1)}%)`;
						} else {
							var index = this.point.index;
							var pokokValue = pokok[index] || 0;
							var dendaValue = denda[index] || 0;
							var total = pokokValue + dendaValue;

							return `<p style="color:#007074; font-weight:bold; margin:0;">${this.point.category}</p><br/>
									Pokok  : <b style="color:#4e79a7;">${Highcharts.numberFormat(pokokValue,0,',','.')}</b><br/>
									Denda  : <b style="color:#e15759;">${Highcharts.numberFormat(dendaValue,0,',','.')}</b><br/>
									Total  : <b style="color:#2ca02c;">${Highcharts.numberFormat(total,0,',','.')}</b>`;
						}
					}
				},
				plotOptions: {
					series: {
						borderRadius: (tipeChart === 'column' || tipeChart === 'bar') ? 4 : 0,
						stacking: (tipeChart === 'column' || tipeChart === 'bar') ? 'normal' : undefined,
						dataLabels: { 
							enabled:true, 
							formatter:function(){ return Highcharts.numberFormat(this.y,0,',','.'); } 
						}
					},
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						showInLegend: true,
						dataLabels: { enabled:true, format:'<b>{point.name}</b><br>{point.y:,.0f} ({point.percentage:.1f}%)' }
					},
					line: { dataLabels: { enabled: true }, enableMouseTracking: true },
					area: { dataLabels: { enabled: true }, enableMouseTracking: true }
				},
				credits: { enabled:false },
				series: (tipeChart === 'pie') 
					? [{ name:'Total Pajak', colorByPoint:true, data:seriesData }] 
					: [{ name:'Pokok', data:pokok }, { name:'Denda', data:denda }]
			});
		},
		complete: function(){ $('#loading-spinner').hide(); },
		error: function(){ $('#container-penerimaan').html("<p style='color:red;text-align:center;'>Gagal memuat data</p>"); }
	});
}


	function kembali()
	{
		href="<?= base_url($this->dynamic_menu->EncryptLink('dashboard'));?>";
		window.location = href;
	}



	var table;
    $(document).ready(function() {
 			$('input:radio').radiocharm({
			  'uncheckable': true
			});


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

	
    
function formatTanggalIndonesia(dateStr) {
    const bulan = ["Januari","Februari","Maret","April","Mei","Juni",
                   "Juli","Agustus","September","Oktober","November","Desember"];
    const d = new Date(dateStr);
    const hari = d.getDate();
    const bln = bulan[d.getMonth()];
    const thn = d.getFullYear();
    return `${hari} ${bln} ${thn}`;
}



</script>		