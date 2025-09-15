
<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/mdb/css/mdb.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/mdb/css/style.css">
<style>
.collapsible {
  background-color: #074979;
  color: white;
  cursor: pointer;
  /*padding: 18px;*/
  width: 100%;
  /*border: none;*/
  /*text-align: left;*/
  outline: none;
  font-size: 15px;
}

.active2, .collapsible:hover {
  background-color: #F1C40F;
  color: white;
}

.active2 {
  background-color: #F1C40F;
  color: white;
}

.collapsible:hover {
  background-color: #F1C40F;
  color: white;
}


.isi {
  padding: 0 18px;
  margin: 0px;
  display: none;
  overflow: hidden;
  background-color: #f1f1f1;
}
.btn{
	margin: 0px;
}
.treeview-animated-element{
	margin: 0px;
	padding: 0px;
}

</style>





<button type="button" class="collapsible btn btn-primary">LIHAT INFORMASI</button>
<div class="isi" id="keuangan">
  <?php echo $keuangan; ?>
</div>


<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active2");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>
<script type="text/javascript">
    $(document).on("click", ".showModal2", function() {

          var thn     = $(this).attr("data-thn");
          var id_daerah     = $(this).attr("data-daerah");
          var url     = $(this).attr("data-url");
          var link = url+'/'+id_daerah+'-'+thn
          window.location.assign("<?php echo base_url('profil-pemda/"+link+"');?>");
      });

</script>

