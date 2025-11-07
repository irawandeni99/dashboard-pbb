
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
																<option value="column">Column</option>
																<option value="bar">Bar</option>
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
                                    <center><img src="<?php echo base_url('assets/img/loading.gif'); ?>" alt="Loading" height="135" width="135"></center>
									<span style="font-size:16px; color:#00809D;">Loading data...</span>

									</div>
																	
									<div class="col-md-12" style="margin-top:20px;">
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

</div>

<script src="<?= base_url() ?>assets/vendor/highcharts/code/highcharts.js"></script>    
<script src="<?= base_url() ?>assets/js/app/penerimaan.js"></script>


<script type="text/javascript">

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