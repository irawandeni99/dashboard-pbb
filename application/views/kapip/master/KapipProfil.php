<?php 
  $is_admin = $this->session->userdata('is_admin');
  if ($is_admin == 1) {
    $hidden = '';
  }else if ($is_admin == 2) {
    $hidden = '';
  }else if ($is_admin == 3) {
    $hidden = 'hidden';
  }
 ?>
<div class="panel panel-headline panel-primary" style="min-height:550px;">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="lnr lnr-book"></i> DATA PROFIL</h3>
	</div>
	
	<div class="panel-body">
		<div class="row">
      <div class="col-md-12">
				<div class="pull-right <?=$hidden; ?>">
					<a href="<?=base_url(EncryptLink('kapip-master-apip/add')); ?>" type="button" name="tambah" id="tambah" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Tambah</a>
				</div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
				
        <div class="table-responsive">
  				<table id="example1" class="table table-bordered table-striped table-condensed" style="width:100%" >
  				<thead>
  					<tr style="background-color: #EDDFB3;">
  					  <th  width="5%"  class="text-bold text-center">NO</th>
  					  <th  width="60%" class="text-bold text-center">PROFIL</th>
  					  <th  width="25%" class="text-bold text-center">TAHUN</th>
  					  <th  width="10%" class="text-bold text-center">AKSI</th>
  					</tr>
  					
  				</thead>
  				<!--<tfoot>
  					<tr style="background-color: #ddd;">
  						<th colspan="3" style="text-align:right; font-weight: bold;">Total:</th>
  						<th></th>
  						
  					</tr>
  				</tfoot>
  				-->
				</table>
        </div>
			</div>
		</div>
	</div> 
</div>  

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detail LHP</h4>
      </div>
      <div class="modal-body" id="listDetail">  
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-flat btn-lg btn-danger" data-dismiss="modal">Tutup</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/datatables/css/dataTables.bootstrap.min.css">  
<link rel="stylesheet" href="<?= base_url() ?>assets/css/custom.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/datatables/css/fixedHeader.bootstrap.min.css">  
<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/datatables/css/responsive.bootstrap.min.css">  
<!-- DataTables -->
<script src="<?= base_url() ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/dataTables.fixedHeader.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/responsive.bootstrap.min.js"></script>

<script>


	
	$(window).on('load', function () {
	  	$(function () {
		  	$('[data-toggle="tooltip"]').tooltip();
		});
	
	});


	var table;
    $(document).ready(function() {
        //datatables table
        table = $('#example1').DataTable({ 	
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('kapip-dataumum-profil-apip/getTable')?>",
                "type": "POST"
            },
             
            "columnDefs": [
            { 
                "targets": [ 0,1,2 ], 
                "orderable": false, 
            }, { 
                "targets": [ 0,2,3 ],  "className": 'text-center',
            },
            ],
	
        });
       
        function reload_table () {
        	table.ajax.reload( null, false ); // user paging is not reset on reload
        }

        setInterval( function () {
		    table.ajax.reload( null, false ); // user paging is not reset on reload
		}, 20000 );


    });

</script> 

<script type="text/javascript">

	$(document).on("click", ".showDetailbuttonApip", function() {
		var kode 		= $(this).attr("data-kd");
		var tahun 		= $(this).attr("data-tahun");
        var nama 		= $(this).attr("data-nama");
		
		
        $.ajax({
	      method: 'POST',
	      url: '<?php echo base_url(EncryptLink('kapip-dataumum-profil-apip/add')); ?>?kode='+kode+'&tahun='+tahun,
	    })
	    .done(function(data) {
			
	      	
	    })
	});

			


</script>


<script src="<?= base_url() ?>assets/vendor/mdb/js/mdb.js"></script>
<script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.mask.min.js"></script>

<script>
	// $(document).ready(function() {
	//   $('.treeview-colorful').mdbTreeview();
	// });
	$(document).ready(function(){
        $( '.function_separator' ).mask('00,000,000,000.00', {reverse: true});
    });
	

	$(document).on("click", ".update-temuan", function(e) {

        var data = $('#form-isi-edit-temuan').serialize();

        var jdl_temuan = $('#jdl_temuan_e').val();
        var nilai_temuan = $('#nilai_temuan_e').val();

       
        if (jdl_temuan == '') {
          Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA JUDUL TEMUAN BELUM DIISI',showConfirmButton: false,timer: 2000});
        exit();
        }
        if (nilai_temuan == '') {
          Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA NILAI TEMUAN BELUM DIISI',showConfirmButton: false,timer: 2000});
        exit();
        }


        
        $.ajax({
          method: 'POST',
          url: '<?php echo base_url('tlhp-kemendagri/update-temuan'); ?>',
          data: data
        })
        .done(function(data) {
          
          var out = jQuery.parseJSON(data);
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: out.pesan,
            showConfirmButton: false,
            timer: 2000
          });
	        var noreg = $('#noreg_e').val();
	        var no_lhp = $('#no_lhp_e').val();
	        refreshListData(noreg,no_lhp);
	        reload_table();
        })
        // $('#modalTemuan').modal('hide');
        
        
        e.preventDefault();
      });

		function refreshListData(noreg,no_lhp){
        $.ajax({
	      method: 'POST',
	      url: '<?php echo base_url('tlhp-kemendagri/get-detail-lhp'); ?>?noreg='+noreg+'&no_lhp='+no_lhp,
	    })
	    .done(function(data) {
	    	
	    	$('#listDetail').html(data);
	    })
	}

 $(document).on("click", ".update-rekomendasi", function(e) {

        var data = $('#form-isi-edit-rekomendasi').serialize();

        var rekomendasi = $('#rekomendasi_r').val();

        if (rekomendasi == '') {
          Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA REKOMENDASI BELUM DIISI',showConfirmButton: false,timer: 2000});
        exit();
        }


        
        $.ajax({
          method: 'POST',
          url: '<?php echo base_url('tlhp-kemendagri/update-rekomendasi'); ?>',
          data: data
        })
        .done(function(data) {
          
          var out = jQuery.parseJSON(data);
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: out.pesan,
            showConfirmButton: false,
            timer: 2000

          });
          var noreg = $('#noreg_r').val();
	        var no_lhp = $('#no_lhp_r').val();
	        refreshListData(noreg,no_lhp);
	        reload_table();
        })
        // $('#modalTemuan').modal('hide');
        e.preventDefault();
      });


  $(document).on("click", ".editTemuan", function() {
          
          var noreg     = $(this).attr("data-reg");
          var kode    = $(this).attr("data-kode");
          var lhp    = $(this).attr("data-lhp");
          
          

        $.ajax({
          url: '<?php echo base_url('tlhp-kemendagri/get-edit-temuan'); ?>',
          type: 'POST',
          data:{noreg:noreg,kode:kode,lhp:lhp}
      }).done(function(data2) {
          var out = jQuery.parseJSON(data2);
          $('#form-edit-temuan').removeAttr('hidden');
          $('#daftar-list-lhp').attr('hidden','');
          $('#noreg_e').val(out.noreg);
          $('#no_lhp_e').val(out.no_lhp);
          $('#kd_temuan_e').val(out.kd_temuan);
          $('#jdl_temuan_e').val(out.judul_temuan);
          $('#nilai_temuan_e').val(out.nilai_temuan);
      });
  });

  $(document).on("click", ".editRekom", function() {
      
      var noreg     = $(this).attr("data-reg");
      var kode    = $(this).attr("data-kode");
      var lhp    = $(this).attr("data-lhp");

      $.ajax({
          url: '<?php echo base_url('tlhp-kemendagri/get-edit-rekomendasi'); ?>',
          type: 'POST',
          data:{noreg:noreg,kode:kode,lhp:lhp}
      }).done(function(data2) {
          var out = jQuery.parseJSON(data2);
          $('#form-edit-rekomendasi').removeAttr('hidden');
          $('#daftar-list-lhp').attr('hidden','');
          $('#noreg_r').val(out.noreg);
          $('#no_lhp_r').val(out.no_lhp);
          $('#kd_temuan_r').val(out.kd_temuan);
          $('#kd_rekom_r').val(out.kd_rekom);
          $('#rekomendasi_r').val(out.rekomendasi);
      });
  });

  
 $(document).on("click", ".hapusTemuan", function() {

		var noreg 		= $(this).attr("data-reg");
		var lhp 		= $(this).attr("data-lhp");
		var kode 		= $(this).attr("data-kode");
        var nama 	= $(this).attr("data-nama");


        Swal.fire({
		  title: 'Apakah anda yakin?',
		  text: "Menghapus data ("+noreg+") "+nama,
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#074979',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'Batal',
		  confirmButtonText: 'Ya, Hapus Data Ini.'
		}).then((result) => {
		  if (result.value) {
		  	$.ajax({
		      method: 'POST',
		      url: '<?php echo base_url('tlhp-kemendagri/del-temuan'); ?>?noreg='+noreg+'&lhp='+lhp+"&kode="+kode,
		    })
		    .done(function(data) {
		    	var out = jQuery.parseJSON(data);
			  	Swal.fire({
				  position: 'top-end',
				  icon: 'success',
				  title: out.pesan,
				  showConfirmButton: false,
				  timer: 2000
				});
				
		        refreshListData(noreg,lhp);
		        reload_table();
				// $('#jml_temuan').html(out.jml_temuan);
		  //   	$('#modalTemuan').modal('hide');
		    })
		    // document.location.href = "<?= base_url('tlhp-kemendagri/del-temuan?'); ?>noreg="+noreg+"&lhp="+lhp+"&kode="+kode;
		  }
		})

});

 $(document).on("click", ".hapusRekom", function() {

		var noreg 		= $(this).attr("data-reg");
		var lhp 		= $(this).attr("data-lhp");
		var kode 		= $(this).attr("data-kode");
        var nama 	= $(this).attr("data-nama");
        Swal.fire({
		  title: 'Apakah anda yakin?',
		  text: "Menghapus data ("+noreg+") "+nama,
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#074979',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'Batal',
		  confirmButtonText: 'Ya, Hapus Data Ini.'
		}).then((result) => {
		  if (result.value) {
		    $.ajax({
		      method: 'POST',
		      url: '<?php echo base_url('tlhp-kemendagri/del-rekomendasi'); ?>?noreg='+noreg+'&lhp='+lhp+"&kode="+kode,
		    })
		    .done(function(data) {
		    	var out = jQuery.parseJSON(data);
			  	Swal.fire({
				  position: 'top-end',
				  icon: 'success',
				  title: out.pesan,
				  showConfirmButton: false,
				  timer: 2000
				});
		    	// $('#modalTemuan').modal('hide');
		    	
		        refreshListData(noreg,lhp);
		        reload_table();
		    	
		    })
		  }
		})
});

 	$(document).on("click", ".back_to_list", function(e) {
	    $('#form-edit-temuan').attr('hidden','');
	    $('#form-edit-rekomendasi').attr('hidden','');
	  	$('#daftar-list-lhp').removeAttr('hidden');
	    e.preventDefault();
  	});

</script>    
