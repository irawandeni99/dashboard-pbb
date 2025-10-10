
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">

<nav class="navbar navbar-default navbar-fixed-top">

	<div class="brand">	
		<center>
			<a href="#">
				<img src="<?=base_url();?>assets/img/logo-1.png" 
					alt="DASHBOARD PBB" 
					class="img-responsive logo" 
					style="width:140px; height:auto;">
			</a>
		</center>
	</div>

	<div class="container-fluid">
		<div class="hidden-lg hidden-md" style="padding:10px;border-bottom:1px dashed #f8a406;">
		<center>
			<!-- <a href="#"><img src="<?=base_url();?>assets/img/logo-1.png" alt="DASHBOARD-PBB" class="img-responsive logo"></a> -->
		</center>
		</div>
		<div class="navbar-btn">
			<button type="button" class="btn-toggle-fullwidth menu-toggler"><i class="lnr lnr-arrow-left-circle"></i></button>
		</div>
		
		<form class="navbar-form navbar-left">
			<div class="input-group">
				<!-- <span 
				style="color:#fff; border:0; background:transparent; font-size:clamp(14px, 2vw, 20px); font-weight:bold;" 
				class="input-group-addon" 
				id="basic-addon1">
				KABUPATEN BULUNGAN
				</span> -->

				<span 
					style="color:#fff; 
							border:0; 
							background:transparent; 
							font-size:clamp(14px, 2vw, 20px); 
							font-weight:600; 
							font-family: 'Poppins', sans-serif;" 
					class="input-group-addon" 
					id="basic-addon1">
					Kabupaten Bulungan
				</span>


				<!-- <span style="color:#fff;border:0px;background:transparent;" class="input-group-addon" id="basic-addon1">KABUPATEN BULUNGAN</span> -->
				<!-- <span style="color:#fff;border:0px;background:transparent;" class="input-group-addon" id="basic-addon1"><i class="lnr lnr-calendar-full"></i></span> -->
				<!-- <input type="text" class="input-sm"  size="4" style="background:transparent;border:0px;text-align:left;font-size:14pt;bottom:5px;" placeholder="Tahun" readonly="" id="tahunSession" name="tahunSession" value="<?=$this->session->userdata('year_selected')?>"> -->
			</div>
		</form>

		<div id="navbar-menu">
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
						<i class="lnr lnr-alarm"></i>
						<?php
							$countNotif = 0; //$this->dynamic_menu->get_count_notif();
						?>
						<span class="badge badge-danger ms-2" style="font-size:8pt;opacity:0.9;"><?= $countNotif; ?></span>
					</a>

					<ul class="dropdown-menu notifications">
						<?php
							$showNotif = $this->dynamic_menu->get_notif();
							echo $showNotif;
						?>
						<li><a href="<?= base_url($this->dynamic_menu->EncryptLink('notifikasi'));?>" class="more">Lihat Selengkapnya</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<?php 
							$logoTemp = explode('.', $this->session->userdata('logo'));
							$logo = $logoTemp[0];
							$format = $logoTemp[1];
							if ($this->session->userdata('logo') <> ''): ?>
							<img src="<?= base_url().'assets/img/pemda/'.strtoupper($logo).'.png';?>" alt="" class="img-circle" style="width:24px;height:24px;padding:3px;"/>
						<?php else: ?>
						<i class = "fa fa-user-circle-o"></i>
							<!-- <img src="<?= base_url() ?>assets/img/logo-s.png"  class="img-circle" style="width:24px;height:24px;padding:3px;">  -->
						<?php endif ?>
						<span><?=$this->session->userdata('alias') == '' ? $this->session->userdata('nama'):$this->session->userdata('alias');?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
					<ul class="dropdown-menu dropdown-menu-logout" >
						<li><a href="<?= base_url($this->dynamic_menu->EncryptLink('user-profile'));?>"><i class="fa fa-vcard-o"></i> <span>Lihat Profil</span></a></li>
						<li><a href="<?= base_url($this->dynamic_menu->EncryptLink('manual-book'));?>"><i class="fa fa-question-circle"></i> <span>Bantuan</span></a></li>
						<li><a href="#" class="tombol-logout"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>

<?php
if ($this->session->userdata('is_admin_login') == FALSE) {
			redirect(base_url(''), 'refresh');
		}
?>

<script type="text/javascript">

	$(document).on("click", ".tombol-logout", function() {
        Swal.fire({
		  title: 'Apakah anda yakin?',
		  text: "Anda akan keluar dari aplikasi.",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'Batal',
		  confirmButtonText: 'Ya, Lakukan Logout.'
		}).then((result) => {
		  if (result.value) {
		    document.location.href = "<?=base_url('logout')?>";
		  }
		})

	});

</script>

<script type="text/javascript">
	$(document).ready(function() {	
			  $("#tahunSession").datepicker({
			  	minViewMode: 2,
	         	format: 'yyyy',
			  }).on("change", function() {
			    var thn = this.value;
			    $.ajax({
				  url: '<?php echo base_url('ubah-tahun-anggaran'); ?>',
				  data:{thn:thn},
				  type: 'POST',
				  	success: function(data){
		  		  		location.reload();
					}
				})
			  });
			  $('.dropdown-toggle').dropdown();
	});
</script>
