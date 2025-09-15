
function openWindowWithPost(url,params){
    var newWindow = window.open(url, 'winpost'); 
    if (!newWindow) return false;
    var html = "";
    html += "<html><head></head><body><form  id='formid' method='post' action='" + url + "'>";

    $.each(params, function(key, value) { 
		if (value instanceof Array || value instanceof Object) {
			$.each(value, function(key1, value1) { 
				html += "<input type='hidden' name='" + key + "["+key1+"]' value='" + value1 + "'/>";
			});
		}else{
			html += "<input type='hidden' name='" + key + "' value='" + value + "'/>";
		}
    });
   
    html += "</form><script type='text/javascript'>document.getElementById(\"formid\").submit()</script></body></html>";
    newWindow.document.write(html);
    return newWindow;
}

function genPieChart(divnya, tipe, judul, data, pointformatnya, p1, p2){
	Highcharts.setOptions({
		lang:{
			thousandsSep: ','
		},
	});
	Highcharts.chart(divnya, {
		chart: {
			// backgroundColor: 'rgba(0, 0, 0, 0.7)',
			color: "#fff",
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie',
			height: p2,
			// width: '100px',
			
		},
		legend: {
			itemStyle: {
				// color: '#fff'
			}
		},
		credits: {
			enabled: false
		},
		title: {
			text: judul

		},
		tooltip: {
			pointFormat: 'Jumlah: <b>{point.y}</b>' + '<br/>{series.name}: <b>{point.percentage:.1f}%</b>', 

		},

		plotOptions: {
			pie: {
				allowPointSelect: false,
				cursor: 'pointer',
				dataLabels: {
					enabled: true,
					// format: '<b>{point.name}</b> : {point.percentage:.1f} %',
					format: '<b>{point.percentage:.1f} %</b>',
					style: {
						width: '100px',
					},
					distance: 10,

				},
				size : p1,
				showInLegend: true,
			}
		},
		series: data
	} );
}


function genColumnChartSampingflat2(divnya, xxChart, yyChart, judul, pointformatnya, par1, par2, par3, par4, par5){
	Highcharts.setOptions({
		lang:{
			thousandsSep: ','
		},
	});
	Highcharts.chart(divnya, {
		chart: {
			type: 'bar',
	    	height: par2,
	    	events: {
	    		load() {
	    			let chart = this;
	    			chart.xAxis[0].labelGroup.element.childNodes.forEach(function(label) {
	    				label.style.cursor = "pointer";
	    				label.onclick = function() {
	    					if(divnya == "container-nilai-samping-1" && par5 == 1){
	    						if (par4 == 'lk') {
		    						var param = {};
		    						$.blockUI({ message: '<img width="100px" src="'+host+'assets/img/loading.gif"><br/> Proses Filter Data' });
		    						param['group'] = this.textContent;
		    						// param['id_instansi'] = $('#kemendagri').val();
		    						// param['tahun'] = $('#tahun').val();
		    						param['tahun'] = par3;
		    						$.post(host+'dashboard-bpk/data_detail_chart_nilai_temuan', param, function(resp){
		    							if(resp){
		    								$('.judul').html('STATISTIK NILAI TEMUAN DAN PENYELESAIAN (SETORAN) '+param['group']);
		    								$('.listDetail').html(resp);
		    								$('.myModal').modal('show');
		    								$.unblockUI();
		    							}
		    						});
	    						}
	    						if (par4 == 'kinerja') {
		    						var param = {};
		    						$.blockUI({ message: '<img width="100px" src="'+host+'assets/img/loading.gif"><br/> Proses Filter Data' });
		    						param['group'] = this.textContent;
		    						// param['id_instansi'] = $('#kemendagri').val();
		    						// param['tahun'] = $('#tahun').val();
		    						param['tahun'] = par3;
		    						$.post(host+'dashboard-bpk-kinerja/data_detail_chart_nilai_temuan', param, function(resp){
		    							if(resp){
		    								$('.judul').html('STATISTIK NILAI TEMUAN DAN PENYELESAIAN (SETORAN) '+param['group']);
		    								$('.listDetail').html(resp);
		    								$('.myModal').modal('show');
		    								$.unblockUI();
		    							}
		    						});
	    						}

	    						if (par4 == 'dtt') {
		    						var param = {};
		    						$.blockUI({ message: '<img width="100px" src="'+host+'assets/img/loading.gif"><br/> Proses Filter Data' });
		    						param['group'] = this.textContent;
		    						// param['id_instansi'] = $('#kemendagri').val();
		    						// param['tahun'] = $('#tahun').val();
		    						param['tahun'] = par3;
		    						$.post(host+'dashboard-bpk-dtt/data_detail_chart_nilai_temuan', param, function(resp){
		    							if(resp){
		    								$('.judul').html('STATISTIK NILAI TEMUAN DAN PENYELESAIAN (SETORAN) '+param['group']);
		    								$('.listDetail').html(resp);
		    								$('.myModal').modal('show');
		    								$.unblockUI();
		    							}
		    						});
	    						}
	    					}

	    					if (divnya == "container-rekomendasi-sts" && par5 == 1){
	    						if (par4 == 'lk') {
		    						var param = {};
		    						$.blockUI({ message: '<img width="100px" src="'+host+'assets/img/loading.gif"><br/> Proses Filter Data' });
		    						param['group'] = this.textContent;
		    						// param['id_instansi'] = $('#kemendagri').val();
		    						// param['tahun'] = $('#tahun').val();
		    						param['tahun'] = par3;
		    						$.post(host+'dashboard-bpk/data_detail_chart_sts_rekom', param, function(resp){
		    							if(resp){
		    								$('.judul').html('STATISTIK STATUS REKOMENDASI '+param['group']);
		    								$('.listDetail').html(resp);
		    								$('.myModal').modal('show');
		    								$.unblockUI();
		    							}
		    						});
	    						}
	    						if (par4 == 'kinerja') {
		    						var param = {};
		    						$.blockUI({ message: '<img width="100px" src="'+host+'assets/img/loading.gif"><br/> Proses Filter Data' });
		    						param['group'] = this.textContent;
		    						// param['id_instansi'] = $('#kemendagri').val();
		    						// param['tahun'] = $('#tahun').val();
		    						param['tahun'] = par3;
		    						$.post(host+'dashboard-bpk-kinerja/data_detail_chart_sts_rekom', param, function(resp){
		    							if(resp){
		    								$('.judul').html('STATISTIK STATUS REKOMENDASI '+param['group']);
		    								$('.listDetail').html(resp);
		    								$('.myModal').modal('show');
		    								$.unblockUI();
		    							}
		    						});
	    						}
	    						if (par4 == 'dtt') {
		    						var param = {};
		    						$.blockUI({ message: '<img width="100px" src="'+host+'assets/img/loading.gif"><br/> Proses Filter Data' });
		    						param['group'] = this.textContent;
		    						// param['id_instansi'] = $('#kemendagri').val();
		    						// param['tahun'] = $('#tahun').val();
		    						param['tahun'] = par3;
		    						$.post(host+'dashboard-bpk-dtt/data_detail_chart_sts_rekom', param, function(resp){
		    							if(resp){
		    								$('.judul').html('STATISTIK STATUS REKOMENDASI '+param['group']);
		    								$('.listDetail').html(resp);
		    								$('.myModal').modal('show');
		    								$.unblockUI();
		    							}
		    						});
	    						}
	    					}
	    				}
	    			});

	    		}
	    	}
		},
		title: {
			text: ''
		},
		subtitle: {
			text: judul
		},
		xAxis: {
			categories: xxChart,
			title: {
				text: null
			},
			labels: {
				formatter: function () {
					if ('PEMDES' === this.value) {
						return '<span style="fill: red;" title="DETAIL CHART">' + this.value + '</span>';
					} else if ('BPSDM' === this.value){
						return '<span style="fill: red;" title="DETAIL CHART">' + this.value + '</span>';
					} else if ('IPDN' === this.value){
						return '<span style="fill: red;" title="DETAIL CHART">' + this.value + '</span>';
					}else {
						return this.value;
					}
				},
				style:{
					fontWeight : 'bold',
					color: 'black',
				},
			},
			

		},
		yAxis: {
			min: 0,
			title: {
				text: par1,
				align: 'high'
			},
			scrollbar: {
                enabled: true,
                showFull: false
            },
			labels: {
				overflow: 'justify',
				formatter: function() {
					var ret,
					numericSymbols = ['Ribu', 'Juta', 'Miliar', 'Triliun', 'P', 'E'],
					i = numericSymbols.length;
					if(this.value >=1000) {
						while (i-- && ret === undefined) {
							multi = Math.pow(1000, i + 1);
							if (this.value >= multi && numericSymbols[i] !== null) {
								ret = (this.value / multi) + numericSymbols[i];
							}
						}
					}
					return '' + (ret ? ret : this.value);

				}
			}
		},
		tooltip: {
			valueSuffix: ''
		},
		plotOptions: {
			bar: {
				dataLabels: {
					enabled: true,
					color: 'black',
					fontWeight: 'bold',
					align: 'top'
				},

				
			},
			series: {
				pointWidth: 10,
         		pointPadding: 0.1,
			}
		},

		legend: {
            align: 'center',
            verticalAlign: 'top',
            floating: false,
            x: 0,
            y: 0
        },
		credits: {
			enabled: false
		},
		series: yyChart
	});
}


function genColumnChartSampingflat(divnya, xxChart, yyChart, judul, pointformatnya, par1){
	Highcharts.chart(divnya, {
		chart: {
			// backgroundColor: 'rgba(0, 0, 0, 0.7)',
			type: 'bar'
		},
		title: {
            text: judul,
        },
        xAxis: {
            categories: xxChart,
            labels: {
				style: {
					color: 'black'
				}
			}
        },
		yAxis: {
			min: 0,
			title: {
				text: par1,
				align: 'high'
			},
			labels: {
				overflow: 'justify',
				formatter: function() {
					var ret,
					numericSymbols = ['Ribu', 'Juta', 'Miliar', 'Triliun', 'P', 'E'],
					i = numericSymbols.length;
					if(this.value >=1000) {
						while (i-- && ret === undefined) {
							multi = Math.pow(1000, i + 1);
							if (this.value >= multi && numericSymbols[i] !== null) {
								ret = (this.value / multi) + numericSymbols[i];
							}
						}
					}
					return '$' + (ret ? ret : this.value);
				}
			}
			
		},
		tooltip: {
			valueSuffix: '',
			
		},
		plotOptions: {
			series: {
				pointWidth: 30,
				// stacking: 'normal',
				 point: {
					events: {
						click: function () {
							if(divnya == "chart_statistik_samping"){
								$.blockUI({ message: '<img width="100px" src="'+host+'__assets/images/loader.gif"><br/> Proses Data' });
								
								var param = {};
								param['kode_kejati'] = par1['kode_kejati'][this.index];
								$.post(host+'pidsus4-get-table/tahapan-perkara-detail', param, function (resp){
									$('#headernya').html("DATA TABULASI KEJATI BERDASAR WILAYAH HUKUM DIBAWAHNYA");
									$('#modalencuk').html(resp);
									$('#pesanModal').modal('show');
									// console.log(resp);
									$.unblockUI();
								});
							}
						}
					}
				 }
			}
		},
		// legend: {
		// 	layout: 'vertical',
		// 	align: 'right',
		// 	verticalAlign: 'top',
		// 	x: -40,
		// 	y: 80,
		// 	floating: true,
		// 	borderWidth: 1,
		// 	backgroundColor:
		// 	Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
		// 	shadow: true
		// },
		credits: {
			enabled: false
		},
		series: yyChart
	});
}



function genColumnChart(divnya, type, xxChart, yyChart, judul, pointformatnya, par1, par2, par3){
	Highcharts.setOptions({
		lang:{
			thousandsSep: ','
		},
	});

	Highcharts.chart(divnya, {
        chart: {
            type: 'column',
            
            // backgroundColor: 'rgba(0, 0, 0, 0.5)',
        },
        title: {
            text: judul,
			style: {
				color: '#FFF',
				font: '16px Lucida Grande, Lucida Sans Unicode,' +
					' Verdana, Arial, Helvetica, sans-serif'
			}
        },
        xAxis: {
            categories: xxChart,
            reversed : par2,
            labels: {
				style: {
					color: '#000'
				}
			}
        },
        scrollbar: {
            enabled: false
        },

        rangeSelector: {
            selected: 1
        },
        yAxis: [{
        	labels: {
				overflow: 'justify',
				style: {
					color: '#000'
				}
			},
			title:{
				text:'JUMLAH',
			}
        },
        {
            min: 0,
            title: {
                text: ''
            },
        }, {
            title: {
                text: ''
            },
            opposite: true
        }],
        legend: {
            shadow: false,
            enabled: true,//(type == "pratut-tiga" ? false : true)
        },
        credits: {
        	enabled: false
        },
        tooltip: {
            shared:true,
			// pointFormat: ponitformatnya
        },
        plotOptions: {
	        column: {
	            pointPadding: 0.1,
	            borderWidth: 0,

	        },
	        series: {
	        	pointWidth: par3,
				cursor: (type == 'ctwna' ? 'pointer' : ""),
	        	dataLabels: {
	        		enabled: true,
	        		color: 'black',
	        		style: {fontWeight: 'bolder'},
	        		// formatter: function() {return this.x + ' : ' + this.y},
	        		inside: false,
	        		// rotation: 270
	        	},
				point: {
					events: {
						click: function () {
							if(type == "ctwna"){
								$.blockUI({ message: '<img width="100px" src="'+host+'__assets/images/loader.gif"><br/> Proses Data' });
								par1['idnya_wna'] = par1['id'][this.index];
								var negara = par1['negara'][this.index];
								
								// console.log(par1['idnya_wna']);
								$('#modalencuk').html('');
								$.post(host+'wna-detail/detail-wna-chart', par1, function (resp){
									 $('#headernya').html( "DETAIL CHART "+negara );
									 $('#modalencuk').html(resp);
									 $('#pesanModal').modal('show');
									 $.unblockUI();
								});
							}

							if(type == "spdp"){
								$.blockUI({ message: '<img width="100px" src="'+host+'__assets/images/loader.gif"><br/> Proses Data' });
								par1['idnya_jenis'] = par1['id_jenis'][this.index];
								par1['nama_jenis'] = this.category;
								
								$('#kotakan_spdp').hide();
								$('#tablean_spdp').html('');
								$.post(host+'pidana-umum3-dataperkara-table', par1, function (resp){
									$('#tablean_spdp').html(resp).show();
									$.unblockUI();
								});
							}
							
						}
					}
				 }
	        }
	    },
        series: yyChart
    });
}	


function genColumnChart2(divnya, type, xxChart, yyChart, judul, pointformatnya, par1, par2, par3){
	Highcharts.setOptions({
		lang:{
			thousandsSep: ','
		},
	});

	Highcharts.chart(divnya, {
        chart: {
            type: 'column',
            
            // backgroundColor: 'rgba(0, 0, 0, 0.5)',
        },
        title: {
            text: judul,
			style: {
				color: '#FFF',
				font: '16px Lucida Grande, Lucida Sans Unicode,' +
					' Verdana, Arial, Helvetica, sans-serif'
			}
        },
        xAxis: {
            categories: xxChart,
            reversed : par2,
            labels: {
				style: {
					color: '#000'
				}
			}
        },
        scrollbar: {
            enabled: false
        },

        rangeSelector: {
            selected: 1
        },
        yAxis: [{
        	labels: {
				overflow: 'justify',
				style: {
					color: '#000'
				}
			},
			title:{
				text:'PERSENTASE',
			},
        },
        {
            min: 0,
            title: {
                text: ''
            },
        }, {
            title: {
                text: ''
            },
            opposite: true
        }],
        legend: {
            shadow: false,
            enabled: true,//(type == "pratut-tiga" ? false : true)
        },
        credits: {
        	enabled: false
        },
        tooltip: {
        	formatter: function() {
        		return '' + this.series.name + ': ' + this.y + '%';
        	},

		},
        plotOptions: {
	        column: {
	            pointPadding: 0.1,
	            borderWidth: 0
	        },
	        series: {
	        	pointWidth: par3,
				cursor: (type == 'ctwna' ? 'pointer' : ""),
	        	dataLabels: {
	        		enabled: true,
	        		color: 'black',
	        		style: {fontWeight: 'bolder'},
	        		formatter: function() {return this.y + '%'},
	        		inside: false,
	        		// rotation: 270
	        	},
				point: {
					events: {
						click: function () {
							if(type == "ctwna"){
								$.blockUI({ message: '<img width="100px" src="'+host+'__assets/images/loader.gif"><br/> Proses Data' });
								par1['idnya_wna'] = par1['id'][this.index];
								var negara = par1['negara'][this.index];
								
								// console.log(par1['idnya_wna']);
								$('#modalencuk').html('');
								$.post(host+'wna-detail/detail-wna-chart', par1, function (resp){
									 $('#headernya').html( "DETAIL CHART "+negara );
									 $('#modalencuk').html(resp);
									 $('#pesanModal').modal('show');
									 $.unblockUI();
								});
							}

							if(type == "spdp"){
								$.blockUI({ message: '<img width="100px" src="'+host+'__assets/images/loader.gif"><br/> Proses Data' });
								par1['idnya_jenis'] = par1['id_jenis'][this.index];
								par1['nama_jenis'] = this.category;
								
								$('#kotakan_spdp').hide();
								$('#tablean_spdp').html('');
								$.post(host+'pidana-umum3-dataperkara-table', par1, function (resp){
									$('#tablean_spdp').html(resp).show();
									$.unblockUI();
								});
							}
							
						}
					}
				 }
	        }
	    },
        series: yyChart
    });
}	

function genColumnChart3(divnya, type, xxChart, yyChart, judul, pointformatnya, par1){
	Highcharts.setOptions({
		lang:{
			thousandsSep: ','
		},
	});

	Highcharts.chart(divnya, {
        chart: {
            type: 'column',
            // backgroundColor: 'rgba(0, 0, 0, 0.5)',
        },
        title: {
            text: judul,
			style: {
				color: '#FFF',
				font: '16px Lucida Grande, Lucida Sans Unicode,' +
					' Verdana, Arial, Helvetica, sans-serif'
			}
        },
        xAxis: {
            categories: xxChart,
            labels: {
				style: {
					color: '#fff'
				}
			}
        },
        scrollbar: {
            enabled: false
        },

        rangeSelector: {
            selected: 1
        },
        yAxis: [{
        	labels: {
				overflow: 'justify',
				style: {
					color: '#fff'
				}
			},
			title:{
				text:'PERSENTASE',
			}

        },
        {
            min: 0,
            title: {
                text: ''
            },
        }, {
            title: {
                text: ''
            },
            opposite: true
        }],
        legend: {
            shadow: false,
            enabled: false,//(type == "pratut-tiga" ? false : true)
        },
        credits: {
        	enabled: false
        },
        tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>', 

		},
        plotOptions: {
	        column: {
	            pointPadding: 0.1,
	            borderWidth: 0
	        },
	        series: {
				cursor: (type == 'ctwna' ? 'pointer' : ""),
	        	dataLabels: {
	        		enabled: true,
	        		color: '#fff',
	        		style: {fontWeight: 'bolder'},
	        		// formatter: function() {return this.x + ' : ' + this.y},
	        		inside: true,
	        		// rotation: 270
	        	},
				point: {
					events: {
						click: function () {
							if(type == "ctwna"){
								$.blockUI({ message: '<img width="100px" src="'+host+'__assets/images/loader.gif"><br/> Proses Data' });
								par1['idnya_wna'] = par1['id'][this.index];
								var negara = par1['negara'][this.index];
								
								//console.log(par1['idnya_wna']);
								$('#modalencuk').html('');
								$.post(host+'pidum4-detail/detail-wna', par1, function (resp){
									 $('#headernya').html( "DETAIL WNA "+negara );
									 $('#modalencuk').html(resp);
									 $('#pesanModal').modal('show');
									 $.unblockUI();
								});
							}
							
							if(type == "spdp"){
								$.blockUI({ message: '<img width="100px" src="'+host+'__assets/images/loader.gif"><br/> Proses Data' });
								par1['idnya_jenis'] = par1['id_jenis'][this.index];
								par1['nama_jenis'] = this.category;
								
								$('#kotakan_spdp').hide();
								$('#tablean_spdp').html('');
								$.post(host+'pidana-umum3-dataperkara-table', par1, function (resp){
									$('#tablean_spdp').html(resp).show();
									$.unblockUI();
								});
							}
							
						}
					}
				 }
	        }
	    },
        series: yyChart
    });
}	
	
function genColumnChart3D(divnya, type, xxChart, yyChart, judul, pointformatnya, par1){
    
    Highcharts.chart(divnya, {
        chart: {
            type: 'column',
            backgroundColor: 'rgba(0, 0, 0, 0.5)',
			options3d: {
                enabled: true,
				alpha: 24,
				beta: 0,
				depth: 90
            }
        },
        title: {
            text: judul,
			style: {
				color: '#FFF',
				font: '16px Lucida Grande, Lucida Sans Unicode,' +
					' Verdana, Arial, Helvetica, sans-serif'
			}
        },
        xAxis: {
            categories: xxChart,
            labels: {
				style: {
					color: '#fff'
				}
			}
        },
        scrollbar: {
            enabled: false
        },

        rangeSelector: {
            selected: 1
        },
        yAxis: [{
        	labels: {
				overflow: 'justify',
				style: {
					color: '#fff'
				}
			}
        },
        {
            min: 0,
            title: {
                text: ''
            },
        }, {
            title: {
                text: ''
            },
            opposite: true
        }],
        legend: {
            shadow: false,
            enabled: false,//(type == "pratut-tiga" ? false : true)
        },
        tooltip: {
            shared:true,
			// pointFormat: ponitformatnya
        },
        plotOptions: {
	        column: {
	            pointPadding: 0.1,
	            borderWidth: 0
	        },
	        series: {
	        	dataLabels: {
	        		enabled: true,
	        		color: '#fff',
	        		style: {fontWeight: 'bolder'},
	        		// formatter: function() {return this.x + ' : ' + this.y},
	        		inside: true,
	        		// rotation: 270
	        	},
				point: {
					events: {
						click: function () {
							var kotakan = "";
							var tablean = "";
							
							if(type == "badan"){
								kotakan = "#kotakan_badan";
								tablean = "#tablean_badan";
							}
							
							if(type == "kasasi"){
								kotakan = "#kotakan_kasasi";
								tablean = "#tablean_kasasi";
							}	
								
							if(type == "banding"){
								kotakan = "#kotakan_banding";
								tablean = "#tablean_banding";
							}
							
							if(type == "putusan"){
								kotakan = "#kotakan_putusan";
								tablean = "#tablean_putusan";
							}							
								
							if(type == "persidangan"){
								kotakan = "#kotakan_persidangan";
								tablean = "#tablean_persidangan";
							}
							
							if(type == "tahap_2"){
								kotakan = "#kotakan_tahap2";
								tablean = "#tablean_tahap2";
							}
							
							if(type == "tahap_1"){
								kotakan = "#kotakan_tahap1";
								tablean = "#tablean_tahap1";
							}
							
							if(type == "spdp"){
								kotakan = "#kotakan_spdp";
								tablean = "#tablean_spdp";
							}
							
							$.blockUI({ message: '<img width="100px" src="'+host+'__assets/images/loader.gif"><br/> Proses Data' });
							par1['idnya_jenis'] = par1['id_jenis'][this.index];
							par1['nama_jenis'] = this.category;
							
							$(kotakan).hide();
							$(tablean).html('');
							$.post(host+'pidana-umum3-dataperkara-table', par1, function (resp){
								$(tablean).html(resp).show();
								$.unblockUI();
							});
							
						}
					}
				 }
	        }
	    },
        series: yyChart
    });

}

