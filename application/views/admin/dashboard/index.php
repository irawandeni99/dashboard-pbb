
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


#container-potensi {
  width: 100%;
  height: 400px; /* atau sesuai kebutuhan */
  /* margin: 0 auto; */
}

#container-kecamatan {
  width: 100%;
  height: 100px; /* atau sesuai kebutuhan */
  /* margin: 0 auto; */
}



</style>



<style>
    /* Background gelap modal */
    .modal {
      display: none; /* awalnya tersembunyi */
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0,0,0,0.6);
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }

    /* Isi modal */
    .modal-content {
      background: #fff;
      padding: 20px;
      border-radius: 12px;
      max-width: 600px;
      max-height: 300px;
      width:  600px;
      height:  300px;
      text-align: center;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .modal-content img {
      width:  300px;
      height:  300px;
      max-height: 600px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 15px;
    }

    .modal-content h3 {
      margin: 0 0 10px;
      color: #007bff;
    }

    .modal-content p {
      margin: 5px 0;
      font-size: 14px;
    }

    .modal-footer {
      margin-top: 15px;
      display: flex;
      justify-content: space-between;
    }

    .btn {
      padding: 8px 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    .btn-primary { background: #007bff; color: #fff; }
    .btn-secondary { background: #6c757d; color: #fff; }

/* Modal wrapper */

/* Layout isi modal */
.popup-body {
  display: flex;
  gap: 20px;
}

/* Gambar kiri */
.popup-left img {
  width: 300px;
  height: 250px;
  border-radius: 10px;
  object-fit: cover; /* biar proporsional */
  box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}

/* Konten kanan */
.popup-right {
  flex: 1; /* ambil sisa space */
}

.popup-left {
  flex: 1; /* ambil sisa space */
}

/* Tombol */
.popup-buttons {
  margin-top: 20px;
  display: flex;
  gap: 10px;
}



/* Gambar kiri */
.data-left img {
  width: 320px;
  height: 200px;
  border-radius: 10px;
  object-fit: cover; /* biar proporsional */
  box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}

/* Konten kanan */
.data-right {
  flex: 1; /* ambil sisa space */
}

.data-left {
  flex: 1; /* ambil sisa space */
}

.btn {
  padding: 8px 14px;
  border-radius: 6px;
  cursor: pointer;
  border: none;
}
.btn-primary {
  background: #007bff;
  color: #fff;
}
.btn-secondary {
  background: #6c757d;
  color: #fff;
}


  </style>



<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Layout Peta & Chart</title>
  <style>
    :root{
      --bg:#f4f6fb;
      --card:#ffffff;
      --muted:#6b7280;
      --accent:#2563eb;
      --shadow: 0 6px 18px rgba(16,24,40,0.08);
      --gap:20px;
    }

    html,body{height:100%;margin:0;font-family:Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; background:var(--bg); color:#111827}

    /* Layout grid: kiri peta, kanan dua chart */

.wrapper {
  width: 100%;
  min-height: 100vh;
  display: grid;
  grid-template-columns: 1.5fr 1fr; /* kiri lebih lebar untuk peta */
  gap: var(--gap, 10px);
  padding: 10px;
  box-sizing: border-box;
}

/* Tablet: kolom tetap 2 tapi seimbang */
@media (max-width: 1024px) {
  .wrapper {
    grid-template-columns: 1fr 1fr;
  }
}

/* HP: jadi 1 kolom, peta di atas chart */
@media (max-width: 768px) {
  .wrapper {
    grid-template-columns: 1fr;
    grid-template-rows: auto auto; /* peta dulu baru chart */
  }
}



    /* .map-card {
      width: 100%;
      height: 80%;    
      position: relative;
    } */

     .map-card{
      display:flex;
      height: 90%;
      align-items:center;
      justify-content:center;
    }


    .card{
      background:var(--card);
      border-radius:12px;
      box-shadow:var(--shadow);
      padding:16p80
      box-sizing:border-box;
    }

    /* .map-card{
      display:flex;
      align-items:center;
      justify-content:center;
    } */

    .map-placeholder{
      width:100%;
      height:100%;
      background:#d1d5db;
      border-radius:8px;
      display:flex;
      align-items:center;
      justify-content:center;
      font-size:20px;
      color:#374151;
    }

    .right-col{
      display:flex;
      flex-direction:column;
      gap:var(--gap);
    }

    .right-col .card{flex:1; display:flex; align-items:center; justify-content:center;}

    /* Responsive */
    @media (max-width:900px){
      .wrapper{grid-template-columns:1fr;}
      .right-col{flex-direction:row;}
      .right-col .card{flex:1; height:250px;}
    }


 .image-container {
      position: relative; /* supaya anak-anaknya bisa absolute */
      display: inline-block;
    }

    .image-container img {
      display: block;
      max-width: 100%;
      border-radius: 8px;
    }

    .image-container button {
      position: absolute;
      bottom: 12px;   /* jarak dari bawah */
      right: 12px;    /* jarak dari kanan */
      padding: 8px 12px;
      border: none;
      border-radius: 6px;
      background: #2563eb;
      color: white;
      font-size: 14px;
      cursor: pointer;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    .image-container button:hover {
      background: #1e40af;
    }

	   /* Contoh posisi */
    .btn-bottom-right { bottom: 12px; right: 12px; }
    .btn-bottom-left  { bottom: 12px; left: 12px; }
    .btn-top-right    { top: 12px; right: 12px; }
    .btn-top-left     { top: 12px; left: 12px; }

    /* Tengah-tengah gambar */
    .btn-center {
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }


.pin-wrapper {
    display: flex;
    align-items: center;
    gap: 6px; /* jarak antara pin dan label */
  }

  .pin {
    width: 20px; 
    height: 20px;
    background: #0D9276;
    border-radius: 50% 50% 50% 0;
    transform: rotate(-45deg);
    border: none;
    cursor: pointer;
    transition: all 0.25s ease;
	z-index: 1; /* tombol ada di bawah */
  }


  .pin-label {
    font-size: 9px;
    color: black;
	font-weight: bold;
    transition: all 0.25s ease;
	transform-origin: left center; /* supaya scaling tetap center vertikal */
    display: inline-block;
    text-align: center;
	z-index: 2; /* font selalu di atas */
    position: relative; /* wajib untuk aktifkan z-index */
  }

  /* Saat hover pin */
  .pin:hover {
    background: #C5172E;
    transform: rotate(-45deg) scale(1.5); /* perbesar pin */
  }

  .pin:hover + .pin-label {
    font-size: 14px; /* label ikut membesar */
    font-weight: bold;
    color: #AC1754;
  }

  .pin-judul-label {
    font-size: 16px;
    color: #00809d;
	font-weight: bold;
    transition: all 0.25s ease;
	transform-origin: left center; /* supaya scaling tetap center vertikal */
    display: inline-block;
    text-align: center;
	z-index: 2; /* font selalu di atas */
    position: relative; /* wajib untuk aktifkan z-index */
  }

    .pin:hover + .pin-judul-label {
    font-size: 20px; /* label ikut membesar */
    font-weight: bold;
    color: #AC1754;
  }

/* 
.map-card {
  position: relative;
  width: 100%;
  height: 765px;   
}
.map-image {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: contain; 
} */


/* /// */


#list-potensi table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 15px;
  font-family: 'Inter', sans-serif;
  font-size: 14px;
  background: #fff;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

#list-potensi th, 
#list-potensi td {
  padding: 10px 14px;
  border-bottom: 1px solid #e5e7eb;
}

#list-potensi thead {
  background: #D8A25E;
  color: #fff;
  text-align: left;
}

#list-potensi tr:nth-child(even) {
  background: #f9fafb;
}

#list-potensi tr:hover {
  background: #eef2ff;
}

#list-potensi td.num {
  text-align: center;
  font-variant-numeric: tabular-nums; /* biar rapi sejajar */
}

  </style>
</head>
<body>
  <div class="wrapper">
    <!-- Kiri: Peta -->
    <div class="card map-card">
     
			<div style="position: relative; display: inline-block;">

        <div class="pin-wrapper">

          <button 
            clas ="pin"
            style="position: absolute; top: 50px; left: 1px; background:none; border:none; cursor:pointer;" 
            value="000"
            onclick="location.reload();">
            <img src="<?=base_url();?>assets/img/compas3.gif" alt="Globe" style="width:100px; height:130px;">
          </button>

					<span class="pin-judul-label" style="position: absolute; top: 80px; left: 110px; text-align: left;" >PETA <br>KABUPATEN<br> BULUNGAN</span>
        </div>	

			  <!-- Gambar peta -->
			 <img src="<?=base_url();?>assets/img/peta.JPG "  
			 style="object-fit: cover;" class="position-absolute w-100 h-100">
				<div class="pin-wrapper">
					<button 
						class="pin" 
						style="position: absolute; top: 300px; left: 469px;" 
            value="001"
						onclick=showPopupKecamatan(this.value)>
					</button>

					<span class="pin-label" style="position: absolute; top: 328px; left: 449px;" >KEC. TANJUNG PALAS</span>
				</div>	

				<div class="pin-wrapper">
          <button 
						class="pin" 
						style="position: absolute; top: 355px; left: 390px;" 
            value="002"
						>
					</button>
					<span class="pin-label" style="position: absolute; top: 382px; left: 345px;" >KEC. TANJUNG PALAS BARAT</span>
				</div>	

				<div class="pin-wrapper">
           <button 
						clasonclick=showPopupKecamatan(this.value)s="pin" 
						style="position: absolute; top: 200px; left: 420px;" 
            value="003"
						onclick=showPopupKecamatan(this.value)>
					</button>
					<span class="pin-label" style="position: absolute; top: 227px; left: 370px;" >KEC. TANJUNG PALAS UTARA</span>
				</div>	

				<div class="pin-wrapper">
           <button 
						class="pin" 
						style="position: absolute; top: 350px; left: 563px;" 
            value="004"
						onclick=showPopupKecamatan(this.value)>
					</button>
					<span class="pin-label" style="position: absolute; top: 376px; left: 523px;" >KEC. TANJUNG PALAS TIMUR</span>
				</div>		

				<div class="pin-wrapper">
          <button 
						class="pin" 
						style="position: absolute; top: 285px; left: 505px;"
            value="005"
						onclick=showPopupKecamatan(this.value)>
					</button>
					<span class="pin-label" style="position: absolute; top: 295px; left: 529px;" >KEC. TANJUNG SELOR</span>
				</div>

				<div class="pin-wrapper">
           <button 
						class="pin" 
						style="position: absolute; top: 225px; left: 520px;" 
            value="006"
						onclick=showPopupKecamatan(this.value)>
					</button>
					<span class="pin-label" style="position: absolute; top: 250px; left: 470px;" >KEC. TANJUNG PALAS TENGAH</span>
				</div>	

				<div class="pin-wrapper">
          <button 
						class="pin" 
						style="position: absolute; top: 345px; left: 183px;"  
            value="007"
						onclick=showPopupKecamatan(this.value)>
					</button>
					<span class="pin-label" style="position: absolute; top: 353px; left: 210px;" >KEC. PESO</span>
				</div>				

				<div class="pin-wrapper">
          <button 
						class="pin" 
						style="position: absolute; top: 255px; left: 340px;"  
            value="008"
						onclick=showPopupKecamatan(this.value)>
					</button>
					<span class="pin-label" style="position: absolute; top: 285px; left: 320px;" >KEC. PESO HILIR</span>
				</div>	        

				<div class="pin-wrapper">
          <button 
						class="pin" 
						style="position: absolute; top: 137px; left: 305px;" 
            value="009"
						onclick=showPopupKecamatan(this.value)>
					</button>
					<span class="pin-label" style="position: absolute; top: 145px; left: 330px;" >KEC. SEKATAK</span>
				</div>

				<div class="pin-wrapper">
            <button 
						class="pin" 
						style="position: absolute; top: 20px; left: 640px;" 
            value="010"
						onclick=showPopupKecamatan(this.value)>
					</button>
					<span class="pin-label" style="position: absolute; top: 45px; left: 625px;" >KEC. BUNYU</span>
				</div>	

			</div>


    </div>

    <!-- Kanan: dua chart -->
    <div class="right-col" >
      <!-- Chart 1 -->
        <div class="panel panel-headline panel-primary" style="max-height:350px; overflow-y:auto;">
          <!-- <div class="panel-body"> -->
            <form class="form-horizontal" id="form-profil2">
              <button type="button" disabled class="collapsible-form active-form w-100 text-left">
                <h3 class="panel-title mb-0">Potensi Wajib Pajak</h3>
              </button>

              <div class="col-md-12 mt-3">
                <figure class="highcharts-figure">
                  <div id="loading-spinner" style="display:none; text-align:center; margin:120px;">
									  <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
									<span>Loading data...</span>
								</div>
                  <div id="container-potensi" style="min-height: 300px; "></div>
                </figure>
                <div id="list-potensi" style="margin-top:20px; font-size:14px;"></div>
              </div>
            </form>
          <!-- </div> -->
        </div>
      
       <!-- Chart 2 -->
        <div class="panel panel-headline panel-primary" style="max-height:350px; overflow-y:auto; margin-top:-40px ">
          <!-- <div class="panel-body"> -->
            <form class="form-horizontal" id="form-profil2">
              <button type="button" disabled class="collapsible-form active-form w-100 text-left">
                <h3 class="panel-title mb-0">Data Kecamatan</h3>
              </button>

              <div class="col-md-12 mt-3">
                  <div id="container-kecamatan" style="min-height: 250px; ">

                        <div class="popup-body" id="div-data-kecamatan">
                            <div class="popup-left">
                              
                                <div class="data-left" style="margin-top:20px;" >
                                  <div class="avatar">
                                      <img id="dataImage" src="" alt="Foto Kecamatan">
                                  </div> 
                              </div>

                            </div>
                          <div class="data-right">
                            <p id="dataNama" style="font-size:16px; font-weight:bold; color:#00809d"></p>
                            <p style="text-align:left;"> <b>Kode : </b><span id="dataKdkec"></span></p>
                            
                            <p style="text-align:left;"><b>Alamat : </b> <span id="dataAlamat"></span></p>
                            <p style="text-align:left;"><b>No. Telp : </b> <span id="dataTelp"></span></p>
            
                          </div>
                        </div>


                  </div>
                <!-- </figure> -->

              </div>
            </form>
          <!-- </div> -->
        </div>

      </div>
    <!-- </div> -->
  </div>


  <div id="popupKecamatan" class="modal">
    <div class="modal-content">

        <button type="button" aria-label="Close" 
                onclick="closePopup()" 
                style="position:absolute; top:2px; right:10px;
                      background:transparent; 
                      border:none; 
                      font-size:14px; 
                      font-weight:bold; 
                      color:#800015; 
                      cursor:pointer;">
          X
        </button>

      <div class="popup-body">
        <div class="popup-left">
          
             <div class="popup-left">
              <div class="avatar">
                  <!-- <img id="popupImage" alt="Avatar"> -->
                   <img id="popupImage" src="" alt="Foto Kecamatan">
              </div> 
          </div>

        </div>

        <div class="popup-right">
          <p id="popupNama" style="font-size:16px; font-weight:bold; color:#00809d"></p>
          <p style="text-align:left;"> <b>Kode : </b><span id="popupKdkec"></span></p>
          
          <p style="text-align:left;"><b>Alamat : </b> <span id="popupAlamat"></span></p>
          <p style="text-align:left;"><b>No. Telp : </b> <span id="popupTelp"></span></p>
          <div class="popup-buttons" style="text-align:center;">
            <button class="btn btn-info" style="font-size:10px;" onclick=get_potensi_kecamatan()><b>Potensi</b></button>
            <button class="btn btn-success" style="font-size:10px;" onclick="closePopup()"><b>Penerimaan</b></button>
          </div>
        </div>
      </div>
    </div>
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
      
		  get_potensi_kecamatan();	
		  $('.treeview-animated').mdbTreeview();
		 
		});

	});


	$(document).ready(function () {
		$('#kecamatan').on('change', function () {
			var kec = $(this).val();
			get_potensi_kecamatan();
		});
	});	


   function showPopupKecamatan(kec) {

      $.ajax({
        url: '<?php echo base_url('master-mkecamatan-get'); ?>/' + encodeURIComponent(kec),
        type: 'POST',
        dataType: "json",
        success: function(data){
          document.getElementById("popupImage").src = "data:image/jpeg;base64," + data.foto;
          document.getElementById("popupNama").innerText   = "KECAMATAN "+data.nm_kecamatan;
          document.getElementById("popupAlamat").innerText = data.alamat;
          document.getElementById("popupTelp").innerText   = data.telp;
          document.getElementById("popupKdkec").innerText   = data.kd_kecamatan;
          document.getElementById("popupKecamatan").style.display = "flex";


          document.getElementById("dataImage").src = "data:image/jpeg;base64," + data.foto;
          document.getElementById("dataNama").innerText   = "KECAMATAN "+data.nm_kecamatan;
          document.getElementById("dataAlamat").innerText = data.alamat;
          document.getElementById("dataTelp").innerText   = data.telp;
          document.getElementById("dataKdkec").innerText   = data.kd_kecamatan;
         


        },
        error: function(xhr){
          console.error(xhr.responseText);
        }
      });

    }

    

    function closePopup() {
      document.getElementById("popupKecamatan").style.display = "none";
    }

    
    function get_potensi_kecamatan() {
    var el = document.getElementById("popupKdkec").innerText;
    var nmkec = document.getElementById("popupNama").innerText;
      nmkec = nmkec
        .toLowerCase()
        .replace(/\b\w/g, function(l) { return l.toUpperCase(); });

      document.getElementById("popupNama").innerText = nmkec;

    if (el !==''){
        var kec = el.slice(-3);
        var nmkec=nmkec;
        $('#div-data-kecamatan').show();
    }else{
        kec = '000';
        nmkec ='';
        $('#div-data-kecamatan').hide();
    }
    


    $('#loading-spinner').show();
    $('#container-potensi').empty();


    
    

    if(kec=='000'){
      instansi='KECAMATAN';
    }else{
      instansi='KELURAHAN';
    }

 
      $.ajax({
        url: '<?= base_url('chart-potensi/get'); ?>/' + encodeURIComponent(kec),
        type: 'POST',
        success: function (data) {
            var out       = jQuery.parseJSON(data);
            var namaGroup = out.group;
            var progres   = out.potensi;

            var pieData = [];
            for (var i = 0; i < namaGroup.length; i++) {
                pieData.push({
                    name: namaGroup[i],
                    y: parseFloat(progres[i]) || 0
                });
            }

            Highcharts.setOptions({
                colors: ['#1f77b4', '#2ca02c', '#ff7f0e', '#d62728',
                        '#9467bd', '#8c564b', '#e377c2', '#7f7f7f',
                        '#bcbd22', '#17becf']
            });
            var instansiFormatted = instansi.charAt(0).toUpperCase() + instansi.slice(1).toLowerCase();
            Highcharts.chart('container-potensi', {
                chart: { type: 'pie' },
                // title: { text: '' },
                title: { 
                    text: nmkec +'<br>Potensi Wajib Pajak ' + instansiFormatted, 
                    style: {
                        fontSize: '16px',
                        fontWeight: 'bold',
                        color: '#00809D'
                       
                    }
                },

                tooltip: {
                    pointFormat: '<b>{point.percentage:.1f}%</b> ({point.y})'
                },
                accessibility: {
                    point: { valueSuffix: '%' }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '{point.name}: {point.percentage:.1f}%'
                        }
                    }
                },
                credits: { enabled: false },
                series: [{
                    name: 'POTENSI WAJIB PAJAK',
                    colorByPoint: true,
                    data: pieData
                }]
            });

            // Tampilkan list kecamatan + jumlah potensi
            var htmlList = "<table>";
            htmlList += "<thead ><tr><th>"+instansi+" </th><th style='text-align:center;'>POTENSI</th></tr></thead><tbody>";

            for (var i = 0; i < namaGroup.length; i++) {
                htmlList += "<tr>";
                htmlList += "<td>" + namaGroup[i] + "</td>";
                htmlList += "<td class='num'>" +  ( (progres[i] || 0).toLocaleString('id-ID') )  + "</td>";
                htmlList += "</tr>";
            }

            htmlList += "</tbody></table>";
            $('#list-potensi').html(htmlList);


        },
        complete: function () {
           
            $('#loading-spinner').hide();
            closePopup();
            


        },
        error: function () {
            $('#container-potensi').html("<p style='color:red;text-align:center;'>Gagal memuat data</p>");
        }
    });
}

</script>

</body>
</html>


