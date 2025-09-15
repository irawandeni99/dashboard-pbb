
<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/mdb/css/mdb.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/mdb/css/style.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/css-circle/css/circle.css">
<!-- <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/infinity-master/css/base.css"> -->
<!-- <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/infinity-master/css/vendor.css">   -->
<!-- <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/infinity-master/css/main.css">  -->
<!-- <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/infinity-master/css/base.css"> -->
<!-- <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap/css/bootstrap.min.css"> -->
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

 .page-circle {
    margin-top: 10px;
    margin-bottom: 10px;
}
.clearfix:before,.clearfix:after {content: " "; display: table;}
.clearfix:after {clear: both;}
.clearfix {*zoom: 1;}
.ow {
    display: inline-block;
    text-align: center;
    width: 100%;
    max-width: 85px; 
    word-wrap: break-word;
    font-size: 6pt;
    font-weight: bold;
    margin-top:5px;
    line-height: 1.4;
}

.centerChart{
  
  position: relative;
  width: 95%;
  /*top: 50%;*/
  left: 2.5%;
  right: 2.5%;
  transform:translate(-2.5px,-2.5px);
  /*padding: 20px;*/

}

.header-chart{
  
  position: relative;
  width: 95%;
  left: 2.5%;
  right: 2.5%;
  transform:translate(-2.5px,-2.5px);
  /*padding: 20px;*/

}

.header-chart-detail{
  
  position: relative;
  width: 90%;
  left: 5%;
  right: 5%;
  transform:translate(-5px,-5px);
  /*padding: 20px;*/

}



.skillBox {
  box-sizing:border-box;
  width: 100%;
  margin: 10px 0;
}

.skillBox p{
  color:#000;
  text-transform: uppercase;
  margin: 0 0 0px;
  padding: 0;
  font-weight: bold;
  letter-spacing: 1px;
  font-size: 7pt;

}

.skillBox p:nth-child(2){
  float: right;
  position: relative;
  top : -30px;

}

.skill{
  background: #fff;
  padding: 4px;
  box-sizing:border-box;
  border: 2px solid #074979;
  border-radius: 2px;
}

.skill_level{
   background: #074979;
   width: 100%;
   height: 5px;
}
</style>




<div class="panel panel-default">
  <div class="panel-heading" style="text-align:center;font-weight:bold;" id="namaDaerah">
        <?=$namaDaerah; ?>
  </div>
  <div class="panel-body">




          <?php $u=1; ?>

<button type="button" class="collapsible btn btn-primary">PENGAWASAN UMUM</button>
<div class="isi" id="umum">
<?php if (count($chartUmum1) != 0) {  ?>
  <div class="grafik-itjen">
    <div class="row">
      <div class="block-1-8 block-s-1-8 block-tab-1-4 block-mob-1-8 group">
        <!-- <?php print_r($pie_umum); ?> -->
        <?php foreach ($chartUmum1 as $valueChart) {
          $percent = $valueChart['bobot'] == '' ? 0:$valueChart['bobot'];
            if($percent < 25) {$color = '#f52b48';$class='softRed';}
            elseif($percent < 50) {$color = '#d7df00';$class='softYellow';}
            elseif($percent < 75) {$color = '#61fe68';$class='softGreen';}
            elseif($percent <= 100) {$color = '#618dfe';$class='softBlue';}    

          ?>
        <div class="bgrid page-circle"> 
             <div class="clearfix">
                <div class="c100 p<?=$percent;?> small center <?=$class; ?> showDetail ChartUmum" id = "chart<?=$valueChart['id_parameter']; ?>"
                data-kode = "<?=$valueChart['id_parameter'];?>" data-was="umum" data-daerah="<?=$valueChart['id_daerah'];?>" data-tahun="<?=$valueChart['tahun'];?>" data-nama="<?=$valueChart['nm_parameter'];?>">
                    <span style = "color:#074979;font-weight:bold;"><?=$percent; ?>%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>

            </div>
            
            <center>
              <div class="ow"><?=$valueChart['nm_parameter']; ?></div>
            </center>
        </div>
       <?php } ?>
      </div>
    </div>
    <div class="row">
       <div class="block-1-1 block-tab-full group">
        <div class=" page-circle"> 
          <div class="header-chart" style="background-color:#074979;color:#fff;">
            <table border="0" width="100%" style="border:3px solid #f8a406;padding:0 0 0 0px;">
              <tr>
                <td width="80%" style="padding-left:10px;font-size:10pt;" id="nm_parameter_umum"></td>
                <td width="20%" style="padding-left:10px;font-size:8pt;" class="hidden-xs">* Klik Chart Untuk Melihat Detail</td>
              </tr>
            </table>
          </div>
          <div class="col-full">
            
            <div class="centerChart" id="detail2umum"> 
              
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>
  <div class="list-itjen" hidden>
        
    <?php echo $umum; ?>
  </div>
<?php }else{ ?>
  <div class="row">
       <div class="block-1-1 block-tab-full group">
        <div class=" page-circle"> 
          <div class="header-chart" style="background-color:#074979;color:#fff;">
            <table border="0" width="100%" style="border:3px solid #f8a406;padding:0 0 0 0px;">
              <tr>
                <td width="100%" style="padding-left:10px;font-size:8pt;"><center>DATA TIDAK TERSEDIA !</center></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
<?php } ?>
</div>
<button type="button" class="collapsible btn btn-primary">PENGAWASAN TEKNIS</button>
<div class="isi" id="teknis">
<?php if (count($chartTeknis1) != 0) {  ?>
  <div class="grafik-itjen">
    <!-- <div class="row">
      <div class="block-1-1 block-tab-full group">
        <div class="page-circle"> 
          <div class="centerChart">
           <?php foreach ($chartTeknis1 as $valueChart) {
            $percent = $valueChart['bobot'] == '' ? 0:$valueChart['bobot'];
            

            if($percent < 25) {$color = '#f52b48';}
            elseif($percent < 50) {$color = '#fefc61';}
            elseif($percent < 75) {$color = '#61fe68';}
            elseif($percent <= 100) {$color = '#618dfe';}    
            ?>
            <div class="skillBox" onclick="alert('UNDER CONSTRUCTION!');">
              <p><?=$valueChart['nm_parameter'];?></p>
              <p><?=$percent;?> %</p>
              <div class="skill">
                <div class="skill_level" style="width:<?=$percent;?>%;background:<?=$color;?>;"></div>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div> -->

    <div class="row">
      <div class="block-1-8 block-s-1-8 block-tab-1-4 block-mob-1-8 group">
        <!-- <?php print_r($pie_umum); ?> -->
        <?php foreach ($chartTeknis1 as $valueChart) {
          $percent = $valueChart['bobot'] == '' ? 0:$valueChart['bobot'];
            if($percent < 25) {$color = '#f52b48';$class='softRed';}
            elseif($percent < 50) {$color = '#d7df00';$class='softYellow';}
            elseif($percent < 75) {$color = '#61fe68';$class='softGreen';}
            elseif($percent <= 100) {$color = '#618dfe';$class='softBlue';}    

          ?>
        <div class="bgrid page-circle"> 
             <div class="clearfix">
                <div class="c100 p<?=$percent;?> small center <?=$class; ?> showDetail ChartTeknis" id = "chart<?=$valueChart['id_parameter']; ?>" 
                data-kode = "<?=$valueChart['id_parameter'];?>" data-was="teknis" data-daerah="<?=$valueChart['id_daerah'];?>" data-tahun="<?=$valueChart['tahun'];?>" data-nama="<?=$valueChart['nm_parameter'];?>">
                    <span style = "color:#074979;font-weight:bold;"><?=$percent; ?>%</span>
                    <div class="slice">
                        <div class="bar" ></div>
                        <div class="fill"></div>
                    </div>
                </div>

            </div>
            
            <center>
              <div class="ow"><?=$valueChart['nm_parameter']; ?></div>
            </center>
        </div>
       <?php } ?>
      </div>
    </div>
    <div class="row" >
       <div class="block-1-1 block-tab-full group">
        <div class=" page-circle"> 
           
          <div class="header-chart" style="background-color:#074979;color:#fff;">
            <table border="0" width="100%" style="border:3px solid #f8a406;">
              <tr>
                <td width="80%" style="padding-left:10px;font-size:10pt;" id="nm_parameter_teknis"></td>
                <td width="20%" style="padding-left:10px;font-size:8pt;" class="hidden-xs">* Klik Chart Untuk Melihat Detail</td>
              </tr>
            </table>
          </div>
          <div class="col-full">
            
            <div class="centerChart" id="detail2teknis">
              
            </div>

          </div>

        </div>
      </div>
    </div>

  </div>
  <div class="list-itjen" hidden>
    <?php echo $teknis; ?>  
  </div>
  <?php }else{ ?>
    <div class="row">
       <div class="block-1-1 block-tab-full group">
        <div class=" page-circle"> 
          <div class="header-chart" style="background-color:#074979;color:#fff;">
            <table border="0" width="100%" style="border:3px solid #f8a406;padding:0 0 0 0px;">
              <tr>
                <td width="100%" style="padding-left:10px;font-size:8pt;"><center>DATA TIDAK TERSEDIA !</center></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
</div>
<button type="button" class="collapsible btn btn-primary">BINWAS KDH</button>
<div class="isi" id="binwas">
<?php if (count($chartBinwas1) != 0) {?>
  <div class="grafik-itjen">
     <div class="row">
      <div class="block-1-8 block-s-1-8 block-tab-1-4 block-mob-1-8 group">
        <!-- <?php print_r($pie_umum); ?> -->
        <?php foreach ($chartBinwas1 as $valueChart) {
          $percent = $valueChart['bobot'] == '' ? 0:$valueChart['bobot'];
            if($percent < 25) {$color = '#f52b48';$class='softRed';}
            elseif($percent < 50) {$color = '#d7df00';$class='softYellow';}
            elseif($percent < 75) {$color = '#61fe68';$class='softGreen';}
            elseif($percent <= 100) {$color = '#618dfe';$class='softBlue';}    

          ?>
        <div class="bgrid page-circle"> 
             <div class="clearfix">
                <div class="c100 p<?=$percent;?> small center <?=$class; ?> showDetail ChartBinwas" id = "chart<?=$valueChart['id_parameter']; ?>"
                data-kode = "<?=$valueChart['id_parameter'];?>" data-was="binwas" data-daerah="<?=$valueChart['id_daerah'];?>" data-tahun="<?=$valueChart['tahun'];?>" data-nama="<?=$valueChart['nm_parameter'];?>">
                    <span style = "color:#074979;font-weight:bold;"><?=$percent; ?>%</span>
                    <div class="slice">
                        <div class="bar" ></div>
                        <div class="fill"></div>
                    </div>
                </div>

            </div>
            
            <center>
              <div class="ow"><?=$valueChart['nm_parameter']; ?></div>
            </center>
        </div>
       <?php } ?>
      </div>
    </div>
    <div class="row" >
       <div class="block-1-1 block-tab-full group">
        <div class=" page-circle"> 
           
          <div class="header-chart" style="background-color:#074979;color:#fff;">
            <table border="0" width="100%" style="border:3px solid #f8a406;">
              <tr>
                <td width="80%" style="padding-left:10px;font-size:10pt;" id="nm_parameter_binwas"></td>
                <td width="20%" style="padding-left:10px;font-size:8pt;" class="hidden-xs">* Klik Chart Untuk Melihat Detail</td>
              </tr>
            </table>
          </div>
          <div class="col-full">
            
            <div class="centerChart" id="detail2binwas">
              
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>
  <div class="list-itjen" hidden>
    <?php echo $binwas; ?>
  </div>
  <?php }else{ ?>
  <div class="row">
       <div class="block-1-1 block-tab-full group">
        <div class=" page-circle"> 
          <div class="header-chart" style="background-color:#074979;color:#fff;">
            <table border="0" width="100%" style="border:3px solid #f8a406;padding:0 0 0 0px;">
              <tr>
                <td width="100%" style="padding-left:10px;font-size:8pt;"><center>DATA TIDAK TERSEDIA !</center></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
</div>

</div>
</div>

<script src="<?= base_url() ?>assets/vendor/infinity-master/js/jquery-2.1.3.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- 
<script src="<?= base_url() ?>assets/vendor/highcharts/code/highcharts.js"></script>    
<script src="<?= base_url() ?>assets/vendor/highcharts/code/modules/drilldown.js"></script>    
<script src="<?= base_url() ?>assets/vendor/highcharts/code/modules/exporting.js"></script>    
<script src="<?= base_url() ?>assets/vendor/highcharts/code/modules/export-data.js"></script> 
 -->
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

