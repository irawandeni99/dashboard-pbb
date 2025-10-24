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
		<h3 class="panel-title"><i class="lnr lnr-book"></i> DATA NOP</h3>
	</div>
	
	<div class="panel-body">
	
    <div class="row">
      <div class="col-md-12">
				
        <div class="table-responsive">
  				<table id="example1" class="table table-bordered table-striped table-condensed" style="width:100%" >
  				<thead>
  					<tr style="background-color: #d8a25e; color: white;">
  					  <th  width="5%"  class="text-bold text-center">No</th>
  					  <th  width="10%" class="text-bold text-center">NOP</th>
  					  <th  width="20%" class="text-bold text-center">Alamat OP</th>
  					  <th  width="10%" class="text-bold text-center">Luas bumi</th>
  					  <th  width="10%" class="text-bold text-center">Luas Bangunan</th>
  					  <th  width="10%" class="text-bold text-center">NIK</th>
  					  <th  width="10%" class="text-bold text-center">Nama WP</th>
  					  <th  width="20%" class="text-bold text-center">Alamat WP</th>
  					  <th  width="10%" class="text-bold text-center">Aksi</th>
  					</tr>
  				</thead>
				</table>
        </div>
			</div>
		</div>
	</div> 
</div>  



<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-header">

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-drivers-license-o" style="font-size:22px;"></i> Detail NOP</h4>
      </div>

        <div class="modal-body">

            <h5 class="text-primary mb-3" ><i class="fa fa-user"></i> <b>Data Wajib Pajak</b></h6>
            <table class="table table-bordered table-sm" style="font-size:15px;">
              <tr>
                <th style="width:20%">NOP</th>
                <td><span id="nop"></span></td>
              </tr>
             
              <tr>
                <th>Nama Wajib Pajak</th>
                <td><span id="nama_wp"></span></td>
              </tr>
              <tr>
                <th>Alamat Wajib Pajak</th>
                <td><span id="alamat"></span></td>
              </tr>

              <tr>
                <th >NPWP</th>
                <td><span id="npwp"></span></td>
              </tr> 
              <tr>
                <th >Telp</th>
                <td><span id="telp"></span></td>
              </tr>
            </table>

            <h5 class="text-primary mt-4 mb-3"><i class="fa fa-home"></i> <b>Data Objek Pajak</b></h6>
            <table class="table table-bordered table-sm" >

              <tr >
                <th style="width:20%;">Luas Tanah</th>
                <td><span id="luas_tanah"></span> m²</td>
              </tr>
              <tr>
                <th>Luas Bangunan</th>
                <td><span id="luas_bangunan"></span> m²</td>
              </tr>               
              <tr>
                <th >Alamat Objek Pajak</th>
                <td><span id="alamat_op"></span></td>
              </tr>              
            </table>

          </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-flat btn-lg btn-danger" data-dismiss="modal">Tutup</button>
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
                "url": "<?php echo site_url('cari-nop/getTable')?>",
                "type": "POST"
            },
             
            "columnDefs": [
            { 
                "targets": [ 0,1,2,3,4,5,6,7,8 ], 
                "orderable": false, 
            }, { 
                "targets": [ 0,1,3,4 ],  "className": 'text-center',
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

<script src="<?= base_url() ?>assets/vendor/mdb/js/mdb.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.mask.min.js"></script>

<script>




$(document).on('click', '.btn-detail', function() {

    // buka modal
    $('#detailModal').modal('show');  

    // ambil data dari atribut
    var nop          = $(this).data('nop');
    var nama         = $(this).data('nama');
    var telp         = $(this).data('telp');
    var npwp         = $(this).data('npwp');
    var alamat       = $(this).data('alamat');
    var luasTanah    = $(this).data('luas_tanah');
    var luasBangunan = $(this).data('luas_bangunan');
    var alamat_op    = $(this).data('alamat_op');

    // isi modal
    $('#nop').text(nop);
    $('#nama_wp').text(nama);
    $('#telp').text(telp);
    $('#npwp').text(npwp);
    $('#alamat').text(alamat);
    $('#luas_tanah').text(luasTanah);
    $('#luas_bangunan').text(luasBangunan);
    $('#alamat_op').text(alamat_op);

});

</script>
