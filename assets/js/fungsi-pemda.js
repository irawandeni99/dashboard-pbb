
function openWindowWithPost(url,params){
    var newWindow = window.open(url, 'winpost'); 
    if (!newWindow) return false;

    var html = "";
    html += "<html><head></head><body><center>Loading...</center><form  id='formid"+params['jns_lap']+params['aksi']+"' method='post' action='" + url + "'>";

    $.each(params, function(key, value) { 
		if (value instanceof Array || value instanceof Object) {
			$.each(value, function(key1, value1) { 
				html += "<input type='hidden' name='" + key + "["+key1+"]' value='" + value1 + "'/>";
			});
		}else{
			html += "<input type='hidden' name='" + key + "' value='" + value + "'/>";
		}
    });
   
    html += "</form><script type='text/javascript'>document.getElementById(\"formid"+params['jns_lap']+params['aksi']+"\").submit()</script></body></html>";
    newWindow.document.write(html);
    return newWindow;
}

function genMapChart(divnya, tipe, judul, data, pointformatnya, p1){
	
	Highcharts.mapChart(divnya, {
		chart: {
			map: 'countries/id/id-all'	
		},
		mapNavigation: {
			enabled: true,
			enableDoubleClickZoomTo: true
	    },

	    colorAxis: {
	        min: 0,
	        max: 100,
	       	stops: [
	       	[0, 'red'],
	       	[0.05, 'red'],
	       	[0.10, 'red'],
	       	[0.15, 'red'],
	       	[0.20, 'red'],
	       	[0.24, 'red'],
	       	[0.25, 'yellow'],
	       	[0.30, 'yellow'],
	       	[0.35, 'yellow'],
	       	[0.40, 'yellow'],
	       	[0.45, 'yellow'],
	       	[0.50, 'yellow'],
	       	[0.55, 'yellow'],
	       	[0.59, 'yellow'],
	       	[0.60, 'lime'],
	       	[0.65, 'lime'],
	       	[0.70, 'lime'],
	       	[0.75, 'lime'],
	        [0.80, 'lime'],
	        [0.85, 'lime'],
	        [0.90, 'lime'],
	        [0.95, 'lime'],
	        [0.99, 'lime'],
	        [1, 'green']
	      ]
	    },
		
		credits: {
			enabled: false
		},
		title: {
			text: judul

		},
		
		
        tooltip: {
        	useHTML: true,
        	headerFormat: '',
            pointFormat: '' +
            	'<table border="0" width="100%" class="" style="font-size:8pt;">'+
            	'<tr style="border-bottom:1px solid grey;">'+
                '<td width = "10%" style="font-size:10pt;text-align:center;"><img src="'+host+'assets/img/pemda/{point.logo}" style="width: 15px; height: 15px;"/></td>' +
                '<td colspan = "2" width = "90%" style="font-size:10pt;"><b> PROVINSI {point.nama}</b></td>' +
                '</tr>'+
            	'<tr>'+
                '<td width = "10%" style="font-size:8pt;" align="center">1.</td>' +
                '<td width = "40%" style="font-size:8pt;">Nilai Temuan</td>' +
                '<td width = "50%" style="font-size:8pt;text-align:right;">{point.nilaiTem}</td>' +
                '</tr>'+
                '<tr>'+
                '<td width = "10%" style="font-size:8pt;" align="center">&nbsp;</td>' +
                '<td width = "40%" style="font-size:8pt;">Progres</td>' +
                '<td width = "50%" style="font-size:8pt;text-align:right;" align="left">{point.nilaiSetor}</td>' +
                '</tr>'+
                '<tr>'+
                '<td width = "10%" style="font-size:8pt;" align="center">&nbsp;</td>' +
                '<td width = "40%" style="font-size:8pt;">Sisa</td>' +
                '<td width = "50%" style="font-size:8pt;text-align:right;">{point.nilaiSisa}</td>' +
                '</tr>'+
                '<tr style="border-bottom:1px solid grey;">'+
                '<td width = "10%" style="font-size:8pt;" align="center"></td>' +
                '<td width = "40%" style="font-size:8pt;"></td>' +
                '<td width = "50%" style="font-size:8pt;" align="left"></td>' +
                '</tr>'+
                '<tr>'+
                '<td width = "10%" style="font-size:8pt;" align="center">2.</td>' +
                '<td colspan = "2" width = "90%" style="font-size:8pt;">Temuan Administrasi</td>' +
                '</tr>'+
                '<tr>'+
                '<td width = "10%" style="font-size:8pt;" align="center">&nbsp;</td>' +
                '<td width = "40%" style="font-size:8pt;">Temuan</td>' +
                '<td width = "50%" style="font-size:8pt;" align="left">: {point.temAdm} </td>' +
                '</tr>'+
                '<tr>'+
                '<td width = "10%" style="font-size:8pt;" align="center">&nbsp;</td>' +
                '<td width = "40%" style="font-size:8pt;">Rekomendasi</td>' +
                '<td width = "50%" style="font-size:8pt;" align="left">: {point.rekAdm} </td>' +
                '</tr>'+
                '<tr>'+
                '<td width = "10%" style="font-size:8pt;" align="center"></td>' +
                '<td colspan = "2" width = "90%" style="font-size:8pt;">- Progres</td>' +
                '</tr>'+
                '<tr>'+
                '<td width = "10%" style="font-size:8pt;" align="center">&nbsp;</td>' +
                '<td width = "40%" style="font-size:8pt;">a. Sesuai</td>' +
                '<td width = "50%" style="font-size:8pt;" align="left">: {point.rekS} </td>' +
                '</tr>'+
                '<tr>'+
                '<td width = "10%" style="font-size:8pt;" align="center">&nbsp;</td>' +
                '<td width = "40%" style="font-size:8pt;">b. Belum Sesuai</td>' +
                '<td width = "50%" style="font-size:8pt;" align="left">: {point.rekBS} </td>' +
                '</tr>'+
                '<tr>'+
                '<td width = "10%" style="font-size:8pt;" align="center">&nbsp;</td>' +
                '<td width = "40%" style="font-size:8pt;">c. Belum Ditindaklanjuti</td>' +
                '<td width = "50%" style="font-size:8pt;" align="left">: {point.rekBD} </td>' +
                '</tr>'+
                '<tr style="border-bottom:1px solid grey;">'+
                '<td width = "10%" style="font-size:8pt;" align="center">&nbsp;</td>' +
                '<td width = "40%" style="font-size:8pt;">d. Tidak Dapat Ditindaklanjuti</td>' +
                '<td width = "50%" style="font-size:8pt;" align="left">: {point.rekTPTD} </td>' +
                '</tr>'+
                '<tr>'+
                '<td width = "10%" style="font-size:8pt;" align="center">&nbsp;</td>' +
                '<td width = "40%" style="font-size:8pt;"><b>PERSENTASE PENYELESAIAN</b></td>' +
                '<td width = "50%" style="font-size:8pt;" align="left">: <b>{point.value} %</b></td>' +
                '</tr>'+
                
                '</table>',
        },
        legend: {
            shadow: false,
            enabled: false,//(type == "pratut-tiga" ? false : true)
        },
		

		series: data
	} )
	;
	
}


function genMapChart2(divnya, tipe, judul, data, pointformatnya, p1){
	
	Highcharts.mapChart(divnya, {
		chart: {
			map: 'countries/id/id-all'	
		},
		mapNavigation: {
			enabled: true,
			enableDoubleClickZoomTo: true
	    },
	    colorAxis: {
	        min: 0,
	        max: 100,
	       	stops: [
	       		[0, 'red'],
		       	[0.05, 'red'],
		       	[0.10, 'red'],
		       	[0.15, 'red'],
		       	[0.20, 'red'],
		       	[0.24, 'red'],
		       	[0.25, 'yellow'],
		       	[0.30, 'yellow'],
		       	[0.35, 'yellow'],
		       	[0.40, 'yellow'],
		       	[0.45, 'yellow'],
		       	[0.50, 'yellow'],
		       	[0.55, 'yellow'],
		       	[0.59, 'yellow'],
		       	[0.60, 'lime'],
		       	[0.65, 'lime'],
		       	[0.70, 'lime'],
		       	[0.75, 'lime'],
		        [0.80, 'lime'],
		        [0.85, 'lime'],
		        [0.90, 'lime'],
		        [0.95, 'lime'],
		        [0.99, 'lime'],
		        [1, 'green']
	      ]
	    },
		
		credits: {
			enabled: false
		},
		title: {
			text: judul
		},
		
        tooltip: {
        	useHTML: true,
        	headerFormat: '',
            pointFormat: '' +
            	'<table border="0" width="100%" class="" style="font-size:8pt;">'+
            	'<tr style="border-bottom:1px solid grey;">'+
                '<td width = "10%" style="font-size:10pt;text-align:center;"><img src="'+host+'assets/img/pemda/{point.logo}" style="width: 15px; height: 15px;"/></td>' +
                '<td colspan = "2" width = "90%" style="font-size:10pt;"><b> Provinsi {point.name}</b></td>' +
                '</tr>'+
            	'<tr>'+
                '<td width = "10%" style="font-size:8pt;" align="center"></td>' +
                '<td colspan = "2" width = "90%" style="font-size:8pt;"><b>ASPEK, FOKUS DAN SASARAN<br></b><div class="tooltipChart">{point.htmlFokus}</div></td>' +
                '</tr>'+
                '</table>',
        },
        legend: {
            shadow: false,
            enabled: false,//(type == "pratut-tiga" ? false : true)
        },
		

		series: data
	} )
	;
	
}


function genPieChart(divnya, tipe, judul, data, pointformatnya, p1){
	Highcharts.setOptions({
		lang:{
			thousandsSep: ','
		},
		colors: ['#FF0000',  '#FFD700',  '#32CD32', '#0437F2', '#5D3FD3', '#BF40BF', '#630330', '#800020','#FF5F1F']
	
	});
	Highcharts.chart(divnya, {
		chart: {
			// backgroundColor: 'rgba(0, 0, 0, 0.7)',
			color: "#fff",
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie',
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

function genPieChart3(divnya, tipe, judul, data, pointformatnya, p1){
	Highcharts.setOptions({
		lang:{
			thousandsSep: ','
		},
		colors: ['#FF0000',  '#FFD700',  '#32CD32', '#0437F2', '#5D3FD3', '#BF40BF', '#630330', '#800020','#FF5F1F']
	
	});
	Highcharts.chart(divnya, {
		chart: {
			// backgroundColor: 'rgba(0, 0, 0, 0.7)',
			color: "#fff",
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie',
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

function genPieChartDrill(divnya, tipe, judul, data, pointformatnya, p1){
	Highcharts.setOptions({
		lang:{
			thousandsSep: ','
		},
		colors: ['#FF0000',  '#FFD700',  '#32CD32', '#0437F2', '#5D3FD3', '#BF40BF', '#630330', '#800020','#FF5F1F']
	});
	Highcharts.chart(divnya, {
		chart: {
			// backgroundColor: 'rgba(0, 0, 0, 0.7)',
			color: "#fff",
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie',
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

function genColumnChartSamping(divnya, xxChart, yyChart, judul, pointformatnya, par1){
	Highcharts.chart(divnya, {
		chart: {
			// backgroundColor: 'rgba(0, 0, 0, 0.7)',
			type: 'bar',
			options3d: {
                enabled: false,
				alpha: 24,
				beta: 0,
				depth: 90
            }
		},
		title: {
            text: judul,
        },
        xAxis: {
            categories: xxChart,
            labels: {
				style: {
					color: '#fff'
				}
			}
        },
		yAxis: {
			min: 0,
			title: {
				text: 'Population (millions)',
				align: 'high'
			},
			labels: {
				overflow: 'justify'
			}
			
		},
		tooltip: {
			valueSuffix: '',
			
		},
		plotOptions: {
			series: {
				stacking: 'normal',
				 point: {
					events: {
						click: function () {
							if(divnya == "chart_penyidikan"){
								$.blockUI({ message: '<img width="100px" src="'+host+'__assets/images/loader.gif"><br/> Proses Data' });
								par1['idnya_sektor'] = par1['id_sektor'][this.index];
								par1['nama_sektor'] = this.category;
								
								$('#kotakan_penyidikan').hide();
								$('#tablean_penyidikan').html('');
								$.post(host+'pidana-khusus3-dataperkara-table', par1, function (resp){
									$('#tablean_penyidikan').html(resp).show();
									$.unblockUI();
								});
							}
							
							if(divnya == "chart_penyelidikan"){
								$.blockUI({ message: '<img width="100px" src="'+host+'__assets/images/loader.gif"><br/> Proses Data' });
								par1['idnya_sektor'] = par1['id_sektor'][this.index];
								par1['nama_sektor'] = this.category;
								
								$('#kotakan_penyelidikan').hide();
								$('#tablean_penyelidikan').html('');
								$.post(host+'pidana-khusus3-dataperkara-table', par1, function (resp){
									$('#tablean_penyelidikan').html(resp).show();
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
		// 		Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
		// 	shadow: true
		// },
		credits: {
			enabled: false
		},
		series: yyChart
	});
}

function genColumnChartSampingflat2(divnya, xxChart, yyChart, judul, pointformatnya, par1, par2){
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
	    					if(divnya == "container-nilai-samping-1"){
	    						alert('You clicked on ' + this.textContent);

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
			// labels: {
			// 	formatter: function () {
			// 		return '<a>' + this.value + '</a>'
			// 	},
			// 	useHTML: true
			// },
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
					enabled: true
				},
				
			},
			series: {
				pointWidth: 10
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

function genColumnChartSampingflatLogo(divnya, xxChart, yyChart, judul, pointformatnya, par1, par2,logoChart){
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
	    					if(divnya == "container-jumlah-tem-rek-tl-logo"){
	    						alert('You clicked on ' + this.textContent);

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
				text: 'PROVINSI'
			},
			labels: {
		      useHTML: true,
		      animate: true,
		      formatter: function() {
		        var value = this.value,
		          output,logo,resLogo;

		        xxChart.forEach(function(xxChart) {
		          if (xxChart === value) {
		            output = xxChart;
		            logo = xxChart.replace(/   |  | /gi,'_');
		            resLogo = logo;
		          }
		        });

		        return '<span><center><img src="'+host+'assets/img/pemda/'+logo+'.png" style="width: 20px; height: 20px;"/><br><small>'+output+'</small></center></span>';
		      }
		    }
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
					enabled: true
				},
				
			},
			series: {
				pointWidth: 10
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

function genColumnChartStacked(divnya, xxChart, yyChart, judul, pointformatnya, par1, par2){
	Highcharts.setOptions({
		colors: ['#FF0000',  '#FFD700',  '#32CD32', '#0437F2', '#5D3FD3', '#BF40BF', '#630330', '#800020','#FF5F1F']
	});
	Highcharts.chart(divnya, {
		chart: {
			type: 'column',
	    	height: par2,
	    	events: {
	    		load() {
	    			let chart = this;
	    			chart.xAxis[0].labelGroup.element.childNodes.forEach(function(label) {
	    				label.style.cursor = "pointer";
	    				label.onclick = function() {
	    					if(divnya == "container-jumlah-aspek-provinsi"){
	    						alert('You clicked on ' + this.textContent);
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
				text: 'PROVINSI'
			},
			labels: {
		      useHTML: true,
		      animate: true,
		      reserveSpace: true,
		      formatter: function() {
		        var value = this.value,
		          output,logo,resLogo;

		        xxChart.forEach(function(xxChart) {
		          if (xxChart === value) {
		            output = xxChart;
		            logo = xxChart.replace(/   |  | /gi,'_');
		            resLogo = logo;
		          }
		        });
		        return '<img src="'+host+'assets/img/pemda/'+logo+'.png" style="width:10px;"></img> '+output;
		      }
		    }
		},
		yAxis: {
			min: 0,
			title: {
				text: par1,
				align: 'high'
			},
			scrollbar: {
                enabled: true,
                showFull: true
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
		legend: {
		    reversed: true,
		    verticalAlign: 'top'
		  },
		tooltip: {
			valueSuffix: ''
		},
		plotOptions: {
			column: {
	            pointPadding: 0.2,
	            borderWidth: 0
	        },
			bar: {
				dataLabels: {
					enabled: true,
					formatter: function(){
                    return (this.y!=0)?this.y:"";
                    }
				},
				
			},
		},
		credits: {
			enabled: false
		},
		series: yyChart
	});
}

function genColumnChartStacked2(divnya, xxChart, yyChart, judul, pointformatnya, par1, par2){
	Highcharts.setOptions({
		colors: ['#FF0000',  '#FFD700',  '#32CD32', '#0437F2', '#5D3FD3', '#BF40BF', '#630330', '#800020','#FF5F1F']
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
	    					if(divnya == "container-jumlah-aspek-provinsi"){
	    						alert('You clicked on ' + this.textContent);
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
				text: ''
			},
			labels: {
		      useHTML: true,
		      animate: true,
		      reserveSpace: true,
		      formatter: function() {
		        var value = this.value,
		          output,logo,resLogo;

		        xxChart.forEach(function(xxChart) {
		          if (xxChart === value) {
		            output = xxChart;
		            logo = xxChart.replace(/   |  | /gi,'_');
		            resLogo = logo;
		          }
		        });
		        return '<img src="'+host+'assets/img/pemda/'+logo+'.png" style="width:10px;"></img> '+output;
		      }
		    }
		},
		yAxis: {
			min: 0,
			title: {
				text: par1,
				align: 'high'
			},
			scrollbar: {
                enabled: true,
                showFull: true
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
		legend: {
		    reversed: true,
		    verticalAlign: 'top'
		  },
		tooltip: {
			valueSuffix: ''
		},
		plotOptions: {
			column: {
	            pointPadding: 0.2,
	            borderWidth: 0
	        },
			bar: {
				dataLabels: {
					enabled: true,
					formatter: function(){
                    return (this.y!=0)?this.y:"";
                    }
				},
				
			},
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



function genColumnChart(divnya, type, xxChart, yyChart, judul, pointformatnya, par1, par2){
	Highcharts.setOptions({
		lang:{
			thousandsSep: ','
		},
		colors: ['#FF0000',  '#FFD700',  '#32CD32', '#0437F2', '#5D3FD3', '#BF40BF', '#630330', '#800020','#FF5F1F']
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
            enabled: false,//(type == "pratut-tiga" ? false : true)
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
	            borderWidth: 0
	        },
	        series: {
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
function genColumnChartLegend(divnya, type, xxChart, yyChart, judul, pointformatnya, par1, par2){
	Highcharts.setOptions({
		lang:{
			thousandsSep: ','
		},
		colors: ['#FF0000',  '#FFD700',  '#32CD32', '#0437F2', '#5D3FD3', '#BF40BF', '#630330', '#800020','#FF5F1F']
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
	            borderWidth: 0
	        },
	        series: {
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


function genColumnChart2(divnya, type, xxChart, yyChart, judul, pointformatnya, par1, par2){
	Highcharts.setOptions({
		lang:{
			thousandsSep: ','
		},
		colors: ['#FF0000',  '#FFD700',  '#32CD32', '#0437F2', '#5D3FD3', '#BF40BF', '#630330', '#800020','#FF5F1F']
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

         colorAxis: {
	        min: 0,
	        max: 100,
	       	stops: [
	       		[0, 'red'],
		       	[0.05, 'red'],
		       	[0.10, 'red'],
		       	[0.15, 'red'],
		       	[0.20, 'red'],
		       	[0.24, 'red'],
		       	[0.25, 'yellow'],
		       	[0.30, 'yellow'],
		       	[0.35, 'yellow'],
		       	[0.40, 'yellow'],
		       	[0.45, 'yellow'],
		       	[0.50, 'yellow'],
		       	[0.55, 'yellow'],
		       	[0.59, 'yellow'],
		       	[0.60, 'lime'],
		       	[0.65, 'lime'],
		       	[0.70, 'lime'],
		       	[0.75, 'lime'],
		        [0.80, 'lime'],
		        [0.85, 'lime'],
		        [0.90, 'lime'],
		        [0.95, 'lime'],
		        [0.99, 'lime'],
		        [1, 'green']
	      ]
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

function genColumnChartTgl(divnya, type, xxChart,yyChart, judul, pointformatnya, par1, par2){
	
	Highcharts.setOptions({
		lang:{
			thousandsSep: ','
		},
		colors: ['#FF0000',  '#FFD700',  '#32CD32', '#0437F2', '#5D3FD3', '#BF40BF', '#630330', '#800020','#FF5F1F']
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

         colorAxis: {
	        min: 0,
	        max: 100,
	       	stops: [
	       	[0, 'red'],
	       	[0.05, 'red'],
	       	[0.10, 'red'],
	       	[0.15, 'red'],
	       	[0.20, 'red'],
	       	[0.24, 'red'],
	       	[0.25, 'yellow'],
	       	[0.30, 'yellow'],
	       	[0.35, 'yellow'],
	       	[0.40, 'yellow'],
	       	[0.45, 'yellow'],
	       	[0.50, 'yellow'],
	       	[0.55, 'yellow'],
	       	[0.59, 'yellow'],
	       	[0.60, 'lime'],
	       	[0.65, 'lime'],
	       	[0.70, 'lime'],
	       	[0.75, 'lime'],
	        [0.80, 'lime'],
	        [0.85, 'lime'],
	        [0.90, 'lime'],
	        [0.95, 'lime'],
	        [0.99, 'lime'],
	        [1, 'green']
	      ]
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
			}
        },
        {
            min: 0,
            max: 120,
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
        	useHTML: true,
        	headerFormat: '',
            pointFormat: '' +
            	'<table border="0" width="100%" class="" style="font-size:8pt;">'+
            	'<tr style="border-bottom:1px solid grey;">'+
                '<td colspan = "3" width = "100%" style="font-size:10pt;"><b>{point.name}</b></td>' +
                '</tr>'+
                '<tr>'+
                '<td width = "40%" style="font-size:8pt;" align="center">Tanggal Penyelesaian</td>' +
                '<td colspan = "2" width = "60%" style="font-size:8pt;"><b>: {point.tgl}</b></div></td>' +
                '</tr>'+
            	'<tr>'+
                '<td width = "40%" style="font-size:8pt;" align="center">Persentase Penyelesaian</td>' +
                '<td colspan = "2" width = "60%" style="font-size:8pt;"><b>: {point.y} %</b></div></td>' +
                '</tr>'+
                '</table>',
        },
        plotOptions: {
	        series: {
	            cursor: 'pointer',
	            point: {
					events: {
						click: function () {
							var param = {};
    						$.blockUI({ message: '<img width="100px" src="'+host+'assets/img/loading.gif"><br/> Proses Filter Data' });
    						param['nm_instansi'] = this.name;
    						param['id_instansi'] = this.id_ins;
    						param['jns_lap'] = this.jns;
    						$.post(host+'dashboard-pemda-filter/get-detail-dashboard-narasi', param, function(resp){
    							if(resp){
    								$('.judul2').html('DATA TEMUAN DAN REKOMENDASI BELUM SESUAI ('+param['nm_instansi']+')');
    								$('.listDetail2').html(resp);
    								$('.myModal2').modal('show');
    								$.unblockUI();
    							}
    						});
							
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
		colors: ['#FF0000',  '#FFD700',  '#32CD32', '#0437F2', '#5D3FD3', '#BF40BF', '#630330', '#800020','#FF5F1F']
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

