
	$(window).on('load', function () {
  		$(function () {
	  		$('[data-toggle="tooltip"]').tooltip();
			 
		});
				// Treeview Initialization
		$(document).ready(function() {
		  get_realisasi_kab('000');	
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
			get_realisasi_kab(kec);
		});
	});	


	$('#tipe_chart').on('change', function() {
		let kec = $('#kecamatan').val();
		get_realisasi_kab(kec);
	})

	$('#btn-tampil').on('click', function() {
		let kec = $('#kecamatan').val();
		get_realisasi_kab(kec);
	})


function get_realisasi_kab(kec) {
    $('#loading-spinner').show();
    $('#container-penerimaan').empty();

    const startYear = document.getElementById('start_year').value;
    const endYear   = document.getElementById('end_year').value;

    $.ajax({
        url: 'chart-realisasi/get/' + encodeURIComponent(kec),
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

            let namaGroup = out.group || [];
            let pokok     = (out.pokok || []).map(v => Number(v) || 0);
            let denda     = (out.denda || []).map(v => Number(v) || 0);
            let jumlah    = (out.jumlah || []).map(v => Number(v) || 0);
            let nama      = out.nama || [];

            if (!namaGroup.length) {
                $('#container-penerimaan').html(`
                    <div class="alert alert-info text-center" role="alert">
                        <b>Informasi:</b> Tidak ditemukan data untuk periode ini
                    </div>
                `);
                return;
            }

            const cjudul = (kec === '000') 
                ? 'Realisasi PBB Kabupaten Bulungan'
                : 'Realisasi PBB Kecamatan ' + nama;

            const periode = startYear + ' s/d ' + endYear;
            const tipeChart = $('#tipe_chart').val() || 'column';

            // Hitung total realisasi keseluruhan
            const totalRealisasi = jumlah.reduce((a, b) => a + b, 0);

            $('#container-penerimaan').append(`
                <div id="chart-realisasi" style="width:100%; height:500px;"></div>
                <div id="summary-realisasi" 
                     style="text-align:center; margin-top:15px; font-size:15px; color:#00707a; font-weight:bold;">
                    Total Realisasi: Rp ${Highcharts.numberFormat(totalRealisasi, 0, ',', '.')}
                </div>
            `);

            Highcharts.chart('chart-realisasi', {
                chart: {
                    backgroundColor: 'transparent',
                    style: { fontFamily: 'Segoe UI, Roboto, sans-serif' }
                },
                title: {
                    text: `${cjudul}<br><p style="text-align:center; margin:0;">Periode ${periode}</p>`,
                    useHTML: true,
                    align: 'center',
                    style: { fontSize: '18px', fontWeight: 'bold', color: '#00707a' }
                },
                xAxis: {
                    categories: namaGroup,
                    crosshair: true,
                    labels: { style: { fontWeight: 'bold' } }
                },
                yAxis: {
                    title: { text: 'Nilai (Rp)', style: { color: '#00707a', fontWeight: 'bold' } },
                    labels: {
                        formatter: function() { return 'Rp ' + Highcharts.numberFormat(this.value, 0, ',', '.'); }
                    },
                    gridLineDashStyle: 'ShortDash'
                },
                tooltip: {
                    shared: true,
                    backgroundColor: 'rgba(255,255,255,0.95)',
                    borderColor: '#00707a',
                    useHTML: true,
                    formatter: function () {
                        let s = `<b>${this.x}</b><br/>`;
                        this.points.forEach(p => {
                            s += `<span style="color:${p.color}">●</span> ${p.series.name}: <b>Rp ${Highcharts.numberFormat(p.y, 0, ',', '.')}</b><br/>`;
                        });
                        return s;
                    }
                },
                plotOptions: {
                    column: {
                        borderRadius: 4,
                        dataLabels: {
                            enabled: true,
                            formatter: function() {
                                return 'Rp ' + Highcharts.numberFormat(this.y, 0, ',', '.');
                            },
                            style: { fontSize: '10px' }
                        }
                    },
                    line: {
                        dataLabels: {
                            enabled: true,
                            align: 'center',
                            verticalAlign: 'bottom',
                            y: -15, // 👈 naikkan label di atas titik
                            formatter: function() {
                                return 'Rp ' + Highcharts.numberFormat(this.y, 0, ',', '.');
                            },
                            style: {
                                fontSize: '11px',
                                fontWeight: 'bold',
                                color: '#2ca02c',
                                textOutline: 'none'
                            }
                        },
                        marker: {
                            symbol: 'circle',
                            radius: 5,
                            fillColor: '#2ca02c',
                            lineWidth: 1,
                            lineColor: '#1c7430'
                        }
                    },
                    series: { animation: { duration: 800 } }
                },
                colors: ['#1f77b4', '#ff7f0e', '#2ca02c'],
                legend: { align: 'center', verticalAlign: 'bottom', itemStyle: { fontWeight: 'bold' } },
                credits: { enabled: false },
                series: [
                    { name: 'Pokok Pajak', data: pokok, type: 'column' },
                    { name: 'Denda Pajak', data: denda, type: 'column' },
                    { 
                        name: 'Jumlah Realisasi', 
                        data: jumlah, 
                        type: 'line',
                        zIndex: 5,
                        color: '#2ca02c'
                    }
                ]
            });
        },
        complete: function(){ $('#loading-spinner').hide(); },
        error: function(){
            $('#container-penerimaan').html("<p style='color:red;text-align:center;'>Gagal memuat data</p>");
        }
    });
}





	