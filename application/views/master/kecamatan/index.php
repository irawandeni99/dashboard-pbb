<style>
.delete-data,
.edit-data {
  transition: transform 0.2s ease, box-shadow 0.2s ease;
  display: inline-block; 
  border-radius: 6px;
}

.delete-data:hover,
.edit-data:hover {
  transform: scale(1.1); 
  background-color: #07f5ddff; 
  color: #f9fd04ff; 
  box-shadow: 0 4px 12px rgba(0,0,0,0.2); 
}

</style>

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
		<h3 class="panel-title"><i class="lnr lnr-book"></i> DATA KECAMATAN</h3>
	</div>
	
	<div class="panel-body">

		<div class="row">
      <div class="col-md-12">
				<div class="pull-right <?=$hidden; ?>">
					<a href="<?=base_url(EncryptLink('kecamatan/add')); ?>" type="button" name="tambah" id="tambah" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Tambah</a>
				</div>
      </div>
    </div>  
	
    <div class="row">
      <div class="col-md-12">
				
        <div class="table-responsive">
  				<table id="example1" class="table table-bordered table-striped table-condensed" style="width:100%" >
  				<thead>
  					<tr style="background-color: #d8a25e; color: white;">
  					  <th  width="5%"  class="text-bold text-center">No</th>
              <th  width="10%" class="text-bold text-center">Foto Kantor</th>
  					  <th  width="10%" class="text-bold text-center">Kode Kecamatan</th>
  					  <th  width="15%" class="text-bold text-center">Nama Kecamatan</th>
  					  <th  width="25%" class="text-bold text-center">Alamat</th>
  					  <th  width="10%" class="text-bold text-center">No Telp</th>
  					  
  					  <th  width="5%" class="text-bold text-center">Aksi</th>
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
                <th>Foto</th>
                <td><span id="foto"></span></td>
              </tr>
            
              <tr>
                <th style="width:30%">Kode Kecamatan</th>
                <td><span id="kd_kecamatan"></span></td>
              </tr>
              <tr>
                <th>Nama Kecamatan</th>
                <td><span id="nm_kecamatan"></span></td>
              </tr>
              <tr>
                <th>Alamat</th>
                <td><span id="alamat"></span></td>
              </tr>

              <tr>
                <th>Telp</th>
                <td><span id="telp"></span></td>
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
                "url": "<?php echo site_url('kecamatan/getTable')?>",
                "type": "POST"
            },
             
            "columnDefs": [
            { 
                "targets": [ 0,1,2,3,4,5 ], 
                "orderable": false, 
            }, { 
                "targets": [ 0,1,2,5,6 ],  "className": 'text-center',
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
    var kode         = $(this).data('kd_kecamatan');
    var nama         = $(this).data('nm_kecamatan');
    var alamat       = $(this).data('alamat');
    var telp         = $(this).data('telp');
    var foto         = $(this).data('foto');

    // isi modal
    $('#kode').text(kode);
    $('#nm_kecamatan').text(nama);
    $('#alamat').text(alamat);
    $('#telp').text(telp);
    $('#foto').text(foto);
});


$(document).on("click", ".delete-data", function(e) {	
    e.preventDefault(); // cegah link <a> jalan

    var kode = $(this).attr("data-kode");
    var nama = $(this).attr("data-nama");

    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Menghapus Data " + kode + " : " + nama + "..?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#074979',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Batal',
        confirmButtonText: 'Ya, Hapus Data.'
    }).then((result) => {
        // kompatibel semua versi
        if (result.isConfirmed || result.value) { 
            
            $.ajax({
                type: 'POST',
                url: "<?= base_url('kecamatan-delete'); ?>",
                data: { kode: kode },
                dataType: "json"
            })
            .done(function(out) {
                if (out.status == 0) {
                    Swal.fire({
                        title: 'GAGAL HAPUS',	
                        position: 'top-center',
                        icon: 'warning',
                        text: 'Gagal Hapus Data!',
                        showConfirmButton: false,
                        timer: 2000
                    });
                } else {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Data Berhasil Di Hapus!',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    window.location.reload();
                }
            })
            .fail(function(xhr, status, error) {
                console.error("AJAX Error:", status, error);
                console.log(xhr.responseText);
                Swal.fire("Error", "Terjadi kesalahan AJAX!", "error");
            });
        }
    });
});



</script>
