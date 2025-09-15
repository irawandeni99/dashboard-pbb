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
		<h3 class="panel-title"><i class="lnr lnr-book"></i> DATA APIP</h3>
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
  					  <th  width="60%" class="text-bold text-center">APIP</th>
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
                "url": "<?php echo site_url('kapip-master-apip/getTable')?>",
                "type": "POST"
            },
             
            "columnDefs": [
            { 
                "targets": [ 0,1,2 ], 
                "orderable": false, 
            }, { 
                "targets": [ 0,2 ],  "className": 'text-center',
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
        var nama 		= $(this).attr("data-nama");
		
		
        $.ajax({
	      method: 'POST',
	      url: '<?php echo base_url(EncryptLink('kapip-master-apip/add')); ?>?kode='+kode,
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
	


</script>    
