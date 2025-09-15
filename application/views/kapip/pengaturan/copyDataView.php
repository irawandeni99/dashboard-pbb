

<style>
.collapsible-form {
  background-color: #074979;
  color: white;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border-radius: 0px;
  border: none;
  border-bottom: 2px solid #f8a406;
  text-align: left;
  outline: none;
  font-size: 12px;
}

.active-form, .collapsible-form:hover {
  background-color: #074979;
}

.content-form {
  padding: 10px 18px;
  display: none;
  border: 1px solid #ccc;
  overflow: hidden;
  background-color: #fcfcfc;
}






</style>



<style>

/**/
.nav-pills > li.active > a,
.nav-pills > li.active > a:hover,
.nav-pills > li.active > a:focus {
	color: #fff;
	background-color: #f8a406;
	box-shadow: inset 3px 3px 4px #fcfcfc;
}
.nav-pills > li > a {
	border-radius: 0px;
}
textarea{
	resize: vertical;
}

textarea {
    font-size: 0.1rem;
    letter-spacing: 0.1px;
}
textarea {
    padding: 1px 1px;
    line-height: 0.2;
    border-radius: 5px;
    border: 1px solid #ccc;
    box-shadow: 1px 1px 1px #999;
}
.ui-autocomplete {
  z-index: 100000000;
}
.form-group{
	margin: 5px 5px ;
}
.control-label{
	bottom: 6px ;
}


</style>

<?php 
  $is_admin = $this->session->userdata('is_admin');
	  if ($is_admin == 1) {
		$disabled = '';
	  }else{
		$disabled = 'disabled';
	  }
 ?>	


	
 <div class="panel panel-headline panel-primary" style="min-height:450px;">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="lnr lnr-book"></i> Data Awal Tahun</h3>
	</div>

	<div class="panel-body"
							<div class="content-form" style="display:block;">				
								<div class="row">
									<div class="col-md-12">
									

										<div class="product-status mg-b-15">
													<div class="container-fluid">
														<div class="row">
															<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																<div class="product-status-wrap">
																	
																	<div class="asset-inner"><br>
																		<div id="data-copydata"></div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>


									</div>
								</div>
								 <p id="info"></p>
								
								<div class="panel-footer">
									<center>
										<button <?php echo $disabled ?> type="button" class="btn btn-green btn-lg copy-data-awaltahun" ><i class="fa fa-clone"></i> Copy Data</button>
										<a href="<?= base_url($this->dynamic_menu->EncryptLink('dashboard'));?>" class="btn btn-danger btn-lg"><i class="fa fa-arrow-circle-left"></i> KEMBALI</a>
									</center>
									</form>
								</div>					

							</div>
 
					</div>					




		<div class="modal fade" id="ModalSettingPenilaian"  role="dialog" aria-labelledby="EmyModalLabelSetting">
			<div class="modal-dialog  " role="document">
				<div class="modal-content">
				  <div class="modal-header">
				  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="EmyModalLabelElemen"><i class="fa fa-wrench" aria-hidden="true"></i> Form Setting Akses Penilaian Mandiri</h4>
				  </div>
					
					<div class="container-fluid" <?= $hide ?> >  
								
						<div class="content-form" style="display:block;">
							<div class="row">
								<div class="row">
									<div class="col-md-12">
									
											<div>
												<div class="row">
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
														<div class="product-status-wrap"> 
													
																 <input type="hidden" name="ptahun"  value='.$ctahun.' class="form-control input-sm" id="ptahun">
																 <input type="hidden" name="pkdinstansi"  value='.$cinstansi.' class="form-control input-sm" id="pkdinstansi">


																		<div class="asset-inner" id="data-simpulan">
																		</div> 
														</div>
													</div>
								
												</div>

							</div>
					</div>					
					
					
					
			  </div>
			</div>

		</div>




<script>
var coll = document.getElementsByClassName("collapsible-form");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active-form");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}




</script>



	<script src="<?= base_url() ?>assets/vendor/datatables/autoCurrency.js"></script>
	<script src="<?= base_url() ?>assets/vendor/datatables/numberFormat.js"></script>
	
	<script src="<?= base_url() ?>assets/vendor/datepicker/bootstrap-datepicker.js"></script>
	<script src="<?= base_url() ?>assets/custom/custom.js"></script>

	<script type="text/javascript">
	
	
 $(window).on('load', function () {

			var ctahun 	  = "<?php  echo $this->session->userdata('year_selected'); ?>";
			var ckode 	  = "<?php  echo $this->session->userdata('id_instansi'); ?>";
			
				$.ajax({  
				  url: '<?php echo base_url('kapip-Pengaturan-Awaltahun/get-awaltahun'); ?>/'+ctahun+'/'+ckode,
				  type: 'POST',
				  success: function(data){
					$("#data-copydata").html(data);
				   
				  }
				});	

    });	
	
	
	
	$(document).ready(function() {	
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


$('#cbelemen').select2({
	placeholder: 'Pilih Elemen'
});


$('#cbtopik').select2({
	placeholder: 'Pilih Topik'
});





	$(document).on("click", ".copy-data-awaltahun", function() {	
		
		var ctahun 	  = "<?php  echo $this->session->userdata('year_selected'); ?>"; 
		
       Swal.fire({
              title: 'Apakah anda yakin?',
              text: "Copy Data Awal Tahun : "+ctahun+"..?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#074979',
              cancelButtonColor: '#d33',
              cancelButtonText: 'Batal',
              confirmButtonText: 'Ya, Copy Data.'
            }).then((result) => {
              if (result.value) { 

                  $.ajax({
					type: 'POST',
					data:({ctahun}),
					dataType: "json",
					url: "<?php echo base_url(); ?>kapip-Pengaturan-Awaltahun/Copydata",
	
                })
                .done(function(data) {
                    var out = jQuery.parseJSON(data);

					if(out==0){
					
						var pesan = "Gagal Copy Data!";
						Swal.fire({
						  title: 'GAGAL COPY DATA',	
						  position: 'top-end',
						  icon: 'warning',
						  text: pesan,
						  showConfirmButton: false,
						  timer: 2000
						});
						
						
						
						
						
					}else if(out==1){
						
						var pesan = "Data Berhasil Di Copy!";
						Swal.fire({
						  position: 'top-end',
						  icon: 'success',
						  title: pesan,
						  showConfirmButton: false,
						  timer: 2000
						});
						 

						var ctahun 	  = "<?php  echo $this->session->userdata('year_selected'); ?>";
						var ckode 	  = "<?php  echo $this->session->userdata('id_instansi'); ?>";
						
							$.ajax({  
							  url: '<?php echo base_url('kapip-Pengaturan-Awaltahun/get-awaltahun'); ?>/'+ctahun+'/'+ckode,
							  type: 'POST',
							  success: function(data){
								$("#data-copydata").html(data);
							   
							  }
							});							

						
					}else if(out==2){
						var pesan = "DATA SUDAH ADA";
						Swal.fire({
						  title: 'GAGAL COPY DATA',	
						  position: 'top-end',
						  icon: 'warning',
						  text: pesan,
						  showConfirmButton: false,
						  timer: 2000
						});
						
						
						
					}
					
					
					
				})
				
			}
		})
	})




	$(window).on('load', function () {

		<?php 
		$this->session->set_userdata(array('cart'=>0));
		?>
		$(function () {
			$('[data-toggle="tooltip"]').tooltip();
		});
			// Treeview Initialization
			$(document).ready(function() {
				$('.treeview-animated').mdbTreeview();
			});
  

	});


	
	function enter(ckey,_cid){
		
        if (ckey==13)
        	{    	       	       	    	   
        	   
			   document.getElementById("4").focus();
        	}     
    }
	
	
	function hide(_cid1,_cdir1,_cid2,_cdir2) {                      
    $(_cid1).toggle( 'slide',{direction: _cdir1}, 300,
            function(){
                $(_cid2).toggle('slide', {direction: _cdir2}, 300);
            });         
}


function kembali()
{
	href="<?= base_url($this->dynamic_menu->EncryptLink('kapip-Pengaturan-Manajemen-User'));?>";
	window.location = href;
}


</script>    

