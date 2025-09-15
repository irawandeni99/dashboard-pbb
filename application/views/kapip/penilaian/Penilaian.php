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
 	<div class="panel-body">
		
	
    <div class="row">
      <div class="col-md-12">
				
        <div class="table-responsive">
					<table id="example1" class="table table-bordered table-striped table-condensed" style="width:100%" >
						<thead>
							<tr style="background-color: #EDDFB3;">
							  <th  width="5%"  class="text-bold text-center">NO</th>
							  <th  width="60%" class="text-bold text-center">APIP</th>
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
                "url": "<?php echo site_url('kapip-penilaian/getTable')?>",
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
