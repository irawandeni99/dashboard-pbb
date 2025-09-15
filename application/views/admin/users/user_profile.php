<style type="text/css">
	.pass_show{position: relative} 

	.pass_show .ptxt { 

	position: absolute; 

		top: 50%; 

		right: 25px; 

		z-index: 1; 

		color: #f36c01; 

		margin-top: -8px; 

		cursor: pointer; 

		transition: .3s ease all; 

	} 

	.pass_show .ptxt:hover{color: #333333;} 
</style>

<div class="container-fluid">
	<div class="panel panel-profile">
		<div class="clearfix" style="min-height:450px;">
			<!-- LEFT COLUMN -->
			<div class="profile-left">
				<!-- PROFILE HEADER -->
				<div class="profile-header">
					<div class="overlay"></div>
					<div class="profile-main">
						<?php 
							$logoTemp = explode('.', $this->session->userdata('logo'));
							$logo = $logoTemp[0];
							$format = $logoTemp[1];
							if ($this->session->userdata('logo') <> ''): ?>
							<img src="<?= base_url().'assets/img/pemda/'.strtoupper($logo).'.png';?>" alt="" class="img-circle" style="width:64px;height:64px;padding:3px;"/>
						<?php else: ?>
						<img src="<?=base_url().'assets/img/user-profile.png';?>" class="img-circle" alt="Avatar">
						<!-- <i class = "fa fa-user-circle-o"></i> -->
							<!-- <img src="<?= base_url() ?>assets/img/logo-s.png"  class="img-circle" style="width:24px;height:24px;padding:3px;">  -->
						<?php endif ?>

						<h3 class="name" id="nama_user">...</h3>
						<span class="online-status status-available">Available</span>
					</div>
					
				</div>
				<!-- END PROFILE HEADER -->
				<!-- PROFILE DETAIL -->
				<div class="profile-detail">
					<div class="profile-info">
						<h4 class="heading">Data User</h4>
						<ul class="list-unstyled list-justify">
							<li>Username <span id="username_user">...</span></li>
							<li>Telepon <span id="telp_user">...</span></li>
							<li>Email <span id="email_user">...</span></li>
							<li class="hidden">Terakhir Login <span id="last_login_user">...</span></li>
						</ul>
					</div>
					<!-- <div class="profile-info">
						<h4 class="heading">Social</h4>
						<ul class="list-inline social-icons">
							<li><a href="#" class="facebook-bg"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#" class="twitter-bg"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#" class="google-plus-bg"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#" class="github-bg"><i class="fa fa-github"></i></a></li>
						</ul>
					</div> -->
					<!-- <div class="profile-info">
						<h4 class="heading">About</h4>
						<p>Interactively fashion excellent information after distinctive outsourcing.</p>
					</div> -->
					<div class="text-center"><a href="#" id="change_pw" class="btn btn-primary btn-md">Ubah Password</a></div>
				</div>
				<!-- END PROFILE DETAIL -->
			</div>
			<!-- END LEFT COLUMN -->
			<!-- RIGHT COLUMN -->
			<div class="profile-right">
				<!-- <h4 class="heading">NAMA USER</h4> -->
				<!-- AWARDS -->
				<!-- <div class="awards">
					<div class="row">
						<div class="col-md-3 col-sm-6">
							<div class="award-item">
								<div class="hexagon">
									<span class="lnr lnr-sun award-icon"></span>
								</div>
								<span>Most Bright Idea</span>
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="award-item">
								<div class="hexagon">
									<span class="lnr lnr-clock award-icon"></span>
								</div>
								<span>Most On-Time</span>
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="award-item">
								<div class="hexagon">
									<span class="lnr lnr-magic-wand award-icon"></span>
								</div>
								<span>Problem Solver</span>
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="award-item">
								<div class="hexagon">
									<span class="lnr lnr-heart award-icon"></span>
								</div>
								<span>Most Loved</span>
							</div>
						</div>
					</div>
					<div class="text-center"><a href="#" class="btn btn-default">See all awards</a></div>
				</div> -->
				<!-- END AWARDS -->
				<!-- TABBED CONTENT -->
				<div class="custom-tabs-line tabs-line-bottom left-aligned">
					<ul class="nav" role="tablist">
						<li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Aktifitas Terakhir</a></li>
						<li class="hidden"><a href="#tab-bottom-left2" role="tab" data-toggle="tab">Temuan <span class="badge badge-danger">7</span></a></li>
					</ul>
				</div>
				<div class="tab-content">
					<div class="tab-pane fade in active" id="tab-bottom-left1">
						<ul class="list-unstyled activity-timeline" id="act-user-page">
							<li>
								<center><img width="100px" src="<?=base_url();?>assets/img/loading.gif"><br/> Proses Cek Data</center>
							</li>
							
						</ul>
						<div class="margin-top-30 text-center"><a href="<?= base_url($this->dynamic_menu->EncryptLink('activity'));?>" class="btn btn-primary btn-md">Lihat Selengkapnya</a></div>
					</div>
					<div class="tab-pane fade" id="tab-bottom-left2">
						<div class="table-responsive">
							<table class="table project-table">
								<thead>
									<tr>
										<th>Title</th>
										<th>Progress</th>
										<th>Leader</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><a href="#">Spot Media</a></td>
										<td>
											<div class="progress">
												<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
													<span>60% Complete</span>
												</div>
											</div>
										</td>
										<td><img src="assets/img/user2.png" alt="Avatar" class="avatar img-circle"> <a href="#">Michael</a></td>
										<td><span class="label label-success">ACTIVE</span></td>
									</tr>
									<tr>
										<td><a href="#">E-Commerce Site</a></td>
										<td>
											<div class="progress">
												<div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%;">
													<span>33% Complete</span>
												</div>
											</div>
										</td>
										<td><img src="assets/img/user1.png" alt="Avatar" class="avatar img-circle"> <a href="#">Antonius</a></td>
										<td><span class="label label-warning">PENDING</span></td>
									</tr>
									<tr>
										<td><a href="#">Project 123GO</a></td>
										<td>
											<div class="progress">
												<div class="progress-bar" role="progressbar" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100" style="width: 68%;">
													<span>68% Complete</span>
												</div>
											</div>
										</td>
										<td><img src="assets/img/user1.png" alt="Avatar" class="avatar img-circle"> <a href="#">Antonius</a></td>
										<td><span class="label label-success">ACTIVE</span></td>
									</tr>
									<tr>
										<td><a href="#">Wordpress Theme</a></td>
										<td>
											<div class="progress">
												<div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">
													<span>75%</span>
												</div>
											</div>
										</td>
										<td><img src="assets/img/user2.png" alt="Avatar" class="avatar img-circle"> <a href="#">Michael</a></td>
										<td><span class="label label-success">ACTIVE</span></td>
									</tr>
									<tr>
										<td><a href="#">Project 123GO</a></td>
										<td>
											<div class="progress">
												<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
													<span>100%</span>
												</div>
											</div>
										</td>
										<td><img src="assets/img/user1.png" alt="Avatar" class="avatar img-circle" /> <a href="#">Antonius</a></td>
										<td><span class="label label-default">CLOSED</span></td>
									</tr>
									<tr>
										<td><a href="#">Redesign Landing Page</a></td>
										<td>
											<div class="progress">
												<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
													<span>100%</span>
												</div>
											</div>
										</td>
										<td><img src="assets/img/user5.png" alt="Avatar" class="avatar img-circle" /> <a href="#">Jason</a></td>
										<td><span class="label label-default">CLOSED</span></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- END TABBED CONTENT -->
			</div>
			<!-- END RIGHT COLUMN -->
		</div>
	</div>
</div>

<form class="form-horizontal" action="" id="form-baru" enctype="multipart/form-data" method="post">
<!-- modal nilai -->
<div class="modal fade" id="modalPassword" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog  modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Ubah Password</h4>
      </div>
      <div class="modal-body">  
      		<input type="text" name="id_user" class="form-control input-sm hidden" id="id_user" readonly placeholder="" value="">
         	
			<div class="form-group ">
				<label for="kd_temuan" class="col-sm-3 control-label input-sm">Password Lama</label>
				<div class="col-sm-9 pass_show">
					<input type="password" value="" id="c_password" name="c_password" class="form-control input-sm input_pass" placeholder="Password Lama"> 
				</div>
			</div>
			<div class="form-group ">
				<label for="kd_temuan" class="col-sm-3 control-label input-sm">Password Baru</label>
				<div class="col-sm-9 pass_show">
					<input type="password" value="" id="n_password" name="n_password" class="form-control input-sm input_pass" placeholder="Password Baru"> 
				</div>
			</div>
			<div class="form-group" <?= $roNilai; ?> >
				<label for="kd_temuan" class="col-sm-3 control-label input-sm">Konfirmasi Password</label>
				<div class="col-sm-9 pass_show">
					<input type="password" value="" id="n2_password" name="n2_password" class="form-control input-sm input_pass" placeholder="Konfirmasi Password"> 
				</div>
			</div>
      </div>
      <div class="modal-footer">
      	<input type="submit" name="submit" value="Simpan" id="simpan" class="btn btn-success btn-lg">
        <!-- <button type="button" class="btn btn-flat btn-lg btn-success simpanSetoran">Simpan</button> -->
        <button type="button" class="btn btn-flat btn-lg btn-danger" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>

</form>



<script type="text/javascript">
	$(window).on('load', function () {
  		// GET DATA USER
  		$.ajax({
		  	url: '<?php echo base_url('get-user-profile'); ?>',
		  	type: 'POST'
		}).done(function(data2) {
	  	var out = jQuery.parseJSON(data2);
		  	$('#id_user').val(out.id_user);
		  	$('#email_user').html(out.email);
		  	$('#telp_user').html(out.telp);
		  	$('#username_user').html(out.username);
		  	$('#nama_user').html(out.nama);
		  	$('#last_login_user').html(out.last_login);
	    });
	    $.ajax({
		  	url: '<?php echo base_url('get-user-activity'); ?>',
		  	type: 'POST'
		}).done(function(data2) {
	  	var out = jQuery.parseJSON(data2);

		  	$('#act-user-page').html(out.act);
	    })
	});



	$('#form-baru').submit(function(e) {
        var c_password = $('#c_password').val();
        var n_password = $('#n_password').val();
        var n2_password = $('#n2_password').val();
        
        if (c_password == '' || n_password == '' || n2_password == '') {
            Swal.fire({position: 'top-end',icon: 'warning',title: 'HARAP LENGKAPI SEMUA ISIAN',showConfirmButton: false,timer: 2000});
            $('#c_password').focus();
            e.preventDefault();
            exit();
        }

              $.ajax({
                method: 'POST',
                url: '<?php echo base_url('cek-password'); ?>',
                data: new FormData(this),
                contentType:false,
                cache : false,
                processData:false,
              })
              .done(function(data) {
                var out = jQuery.parseJSON(data);
                
                
	                Swal.fire({
	                  position: 'top-end',
	                  icon: out.status,
	                  title: out.pesan,
	                  showConfirmButton: false,
	                  timer: 2000
	                });
	                if (out.status == 'success') {
                		$('#modalPassword').modal('hide');
	                }
              })
              
              e.preventDefault();

            // }
        
        
        
      });

	$(document).ready(function(){
	$('.pass_show').append('<span class="ptxt">Show</span>');  
	});
	  

	$(document).on('click','.pass_show .ptxt', function(){ 
		$(this).text($(this).text() == "Show" ? "Hide" : "Show"); 
		$(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; }); 
	}); 

	$(document).on("click", "#change_pw", function(e) {
		$('#nilai_setor').val('');
		$('#tgl_setor').val('');
		$('#jns_setor').val('');
		$('#modalPassword').modal('show');
		e.preventDefault();
	});
</script>