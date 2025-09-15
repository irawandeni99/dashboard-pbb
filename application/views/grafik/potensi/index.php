<style type="text/css">
	.highcharts-figure, .highcharts-data-table table {
    min-width: 320px; 
    max-width: 500px;
    margin: 1em auto;
}

#container-potensi {
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
															<h3 class="panel-title"> <i class="fa fa-line-chart" style="padding-left: 10px"></i> Grafik Potensi Wajib Pajak</h3> 

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
								
								
									<div class="col-md-12" style="text-align: center;"><label style="font-size:16pt;text-align: center;">Potensi Wajib Pajak Kecamatan</label></div>
									<div class="col-md-12">
									
									<div class="row">
									<div class="col-md-12">
									
									<!-- <div class="col-md-12">

										<div class="col-md-8">	
											<div class="form-group">
												<div class="col-sm-2">
													<label class="col-sm-2 control-label input-sm" id="label-tipe">Kecamatan</label>
												</div>
												<div class="col-sm-10">
													<select name="kecamatan" id="kecamatan" class="form-control input-sm" style="width:100%">
														<option value="000">Semua Kecamatan</option>
														<?php foreach($kecamatan as $row): ?>
															<option value="<?= $row->kd_kecamatan; ?>"><?=$row->kd_kecamatan; ?> | <?=$row->nm_kecamatan; ?></option>
														<?php endforeach; ?>

													</select>
												</div>
											</div>
										</div>	
									</div> -->

                                    <div class="col-md-12">
										<div class="col-md-8">	
											<div class="form-group">
												<!-- Label Kecamatan -->
												<div class="col-sm-2">
													<label class="col-sm-2 control-label input-sm" id="label-tipe">Kecamatan</label>
												</div>
												<!-- Dropdown Kecamatan -->
												<div class="col-sm-10">
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
									<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
									<span>Loading data...</span>
								</div>
																
								<div class="col-md-8" style="margin-top:20px;">
									<figure class="highcharts-figure">
										<div id="container-potensi"></div>
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
		  get_potensi_kecamatan('000');	
		  $('.treeview-animated').mdbTreeview();
		 
		});

	});


	$(document).ready(function () {
		// event onchange
		$('#kecamatan').on('change', function () {
			var kec = $(this).val();
			get_potensi_kecamatan(kec);
		});
	});	


function get_penerimaan_kecamatan(kec) {
    $('#loading-spinner').show();
    $('#container-penerimaan').empty();

    $.ajax({
        url: '<?= base_url('chart-penerimaan/get'); ?>/' + encodeURIComponent(kec),
        type: 'POST',
        success: function (data) {
            var out   = jQuery.parseJSON(data);
            var namaGroup = out.group || [];
            var pokok     = out.pokok || [];
            var denda     = out.denda || [];

            let cjudul = (kec === '000') 
                ? 'Penerimaan Pajak per Kecamatan' 
                : 'Penerimaan Pajak per Kelurahan';

            var tipeChart = $('#tipe_chart').val();
            let seriesData = [];

            if (tipeChart === 'pie') {
                namaGroup.forEach(function(nm, i) {
                    let total = (pokok[i] || 0) + (denda[i] || 0);
                    seriesData.push({ name: nm, y: total });
                });
            }

            // Hitung total semua Pokok + Denda
            let totalKeseluruhan = 0;
            pokok.forEach((v, i) => {
                totalKeseluruhan += (v || 0) + (denda[i] || 0);
            });

            Highcharts.chart('container-penerimaan', {
                chart: { 
                    type: tipeChart, 
                    backgroundColor: '#ffffff',
                    style: { fontFamily: 'Segoe UI, Roboto, sans-serif' }
                },
                colors: ['#4e79a7', '#f28e2b', '#76b7b2', '#e15759', '#59a14f', '#edc949'],
                title: { 
                    text: cjudul,
                    style: { fontSize: '18px', fontWeight: 'bold', color: '#333' }
                },
                subtitle: (tipeChart !== 'pie') ? {
                    text: 'Total Penerimaan: <b>' + Highcharts.numberFormat(totalKeseluruhan, 0, ',', '.') + '</b>',
                    style: { fontSize: '14px', color: '#666' }
                } : undefined,
                legend: {
                    backgroundColor: '#f9f9f9',
                    borderRadius: 5,
                    itemStyle: { fontWeight: 'normal', color: '#333' },
                    itemHoverStyle: { color: '#000' }
                },
                xAxis: (tipeChart !== 'pie') ? { 
                    categories: namaGroup,
                    labels: { style: { fontSize: '12px', color: '#444' } }
                } : undefined,
                yAxis: (tipeChart !== 'pie') ? {
                    min: 0,
                    title: { text: 'Jumlah (Rp)', align: 'high', style: { fontWeight: 'bold' } },
                    labels: {
                        formatter: function () {
                            return Highcharts.numberFormat(this.value, 0, ',', '.');
                        },
                        style: { fontSize: '12px', color: '#444' }
                    },
                    gridLineColor: '#e6e6e6'
                } : undefined,
                tooltip: { 
                    backgroundColor: '#ffffff',
                    borderColor: '#ccc',
                    borderRadius: 8,
                    shadow: true,
                    style: { fontSize: '12px' },
                    shared: (tipeChart !== 'pie'),
                    formatter: function () {
                        if (this.series.type === 'pie') {
                            return '<b>' + this.point.name + '</b><br/>' +
                                   'Total: <b>' + Highcharts.numberFormat(this.y, 0, ',', '.') + '</b><br/>' +
                                   '(' + Highcharts.numberFormat(this.percentage, 1) + '%)';
                        } else {
                            var total = 0;
                            (this.points || [this.point]).forEach(function(p) { total += p.y; });

                            // Hitung total keseluruhan semua bar/column
                            var chart = this.points ? this.points[0].series.chart : this.point.series.chart;
                            var grandTotal = 0;
                            for (var i = 0; i < chart.series[0].data.length; i++) {
                                var sumRow = 0;
                                chart.series.forEach(function(s) {
                                    if (s.visible && s.data[i]) sumRow += s.data[i].y;
                                });
                                grandTotal += sumRow;
                            }

                            var percent = (grandTotal > 0) ? (total / grandTotal) * 100 : 0;

                            // Detail Pokok & Denda
                            var detail = (this.points || [this.point]).map(function(p) {
                                return '<span style="color:' + p.color + '">\u25CF</span> ' + 
                                       p.series.name + ': <b>' + Highcharts.numberFormat(p.y, 0, ',', '.') + '</b>';
                            }).join('<br/>');

                            return '<b>' + this.x + '</b><br/>' + detail + '<br/>' +
                                   '<span style="color:#000">\u25CF</span> Total: <b>' + 
                                   Highcharts.numberFormat(total, 0, ',', '.') + '</b> (' + 
                                   Highcharts.numberFormat(percent, 1) + '%)';
                        }
                    }
                },
                plotOptions: {
                    series: {
                        borderRadius: (tipeChart !== 'pie') ? 4 : 0,
                        shadow: (tipeChart !== 'pie'),
                        stacking: (tipeChart !== 'pie') ? 'normal' : undefined,
                        dataLabels: {
                            enabled: true,
                            style: { fontSize: '11px', color: '#111' },
                            formatter: function () {
                                return Highcharts.numberFormat(this.y, 0, ',', '.');
                            }
                        }
                    },
                    bar: { pointPadding: 0.05, borderWidth: 0 },
                    column: { pointPadding: 0.05, borderWidth: 0 },
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            style: { fontSize: '12px', fontWeight: 'bold' },
                            format: '<b>{point.name}</b><br>{point.y:,.0f} ({point.percentage:.1f} %)'
                        },
                        showInLegend: true
                    }
                },
                credits: { enabled: false },
                series: (tipeChart === 'pie') ? [{
                    name: 'Total Pajak',
                    colorByPoint: true,
                    data: seriesData
                }] : [
                    { name: 'Pokok', data: pokok },
                    { name: 'Denda', data: denda }
                ]
            });
        },
        complete: function () { $('#loading-spinner').hide(); },
        error: function () {
            $('#container-penerimaan').html("<p style='color:red;text-align:center;'>Gagal memuat data</p>");
        }
    });
}


$('#tipe_chart').on('change', function() {
    let kec = $('#kecamatan').val();
    get_potensi_kecamatan(kec);
});


function get_potensi_kecamatan(kec) {
    // Tampilkan spinner, kosongkan chart
    $('#loading-spinner').show();
    $('#container-potensi').empty();

    $.ajax({
    url: '<?= base_url('chart-potensi/get'); ?>/' + encodeURIComponent(kec),
    type: 'POST',
    success: function (data) {
        var out       = jQuery.parseJSON(data) || {};
        var namaGroup = out.group || [];
        var progres   = out.potensi || [];

        var tipeChart = $('#tipe_chart').val();
        let seriesData = [];

        if (tipeChart === 'pie') {
            namaGroup.forEach(function(nm, i) {
                seriesData.push({ name: nm, y: progres[i] || 0 });
            });
        }

        Highcharts.setOptions({
            colors: ['#1f77b4', '#2ca02c', '#ff7f0e', '#d62728',
                     '#9467bd', '#8c564b', '#e377c2', '#7f7f7f',
                     '#bcbd22', '#17becf']
        });

        Highcharts.chart('container-potensi', {
            chart: { 
                type: tipeChart, 
                backgroundColor: '#ffffff',
                style: { fontFamily: 'Segoe UI, Roboto, sans-serif' }
            },
            title: { text: '' },
            xAxis: (tipeChart !== 'pie') ? {
                categories: namaGroup,
                title: { text: null }
            } : undefined,
            yAxis: (tipeChart !== 'pie') ? {
                min: 0,
                title: { text: 'Wajib Pajak', align: 'high' },
                labels: { overflow: 'justify', formatter: function () { return this.value; } }
            } : undefined,
            tooltip: {
                useHTML: true,
                formatter: function() {
                    if (tipeChart === 'pie') {
                        return `<b>${this.point.name}</b><br/>Potensi: <b>${this.point.y}</b>`;
                    } else {
                        return `<b>${this.point.category}</b><br/>Potensi: <b>${this.point.y}</b>`;
                    }
                }
            },
            plotOptions: {
                series: {
                    dataLabels: { enabled: true }
                },
                bar: { borderRadius: 4, pointPadding: 0.1 },
                column: { borderRadius: 4, pointPadding: 0.1 },
                pie: { allowPointSelect: true, cursor: 'pointer', showInLegend: true }
            },
            credits: { enabled: false },
            series: (tipeChart === 'pie') ? [{
                name: 'Potensi Wajib Pajak',
                colorByPoint: true,
                data: seriesData
            }] : [{
                name: 'Potensi Wajib Pajak',
                data: progres,
                colorByPoint: true
            }]
        });
    },
    complete: function () { $('#loading-spinner').hide(); },
    error: function () {
        $('#container-potensi').html("<p style='color:red;text-align:center;'>Gagal memuat data</p>");
    }
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

	
    
</script>		