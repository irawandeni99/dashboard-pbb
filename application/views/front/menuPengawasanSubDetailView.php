<?php if (count($chartSubDetail)!= 0) {?>
  <!-- <div class="row"> -->
  <div class="row">
       <div class="block-1-1 block-tab-full group">
        <div class="page-circle"> 
          <div class="header-chart-detail" style="background-color:#074979;color:#fff;">
            <table border="0" width="100%" style="border:3px solid #f8a406;padding:0 0 0 0px;">
<?php foreach ($chartSubDetail as $valueChart) {
  $percent = $valueChart['bobot'] == '' ? 0:$valueChart['bobot'];
  if($percent < 25) {$color = '#f52b48';}
  elseif($percent < 50) {$color = '#fefc61';}
  elseif($percent < 75) {$color = '#61fe68';}
  elseif($percent <= 100) {$color = '#618dfe';}    
  ?>
  			<tr>
                <td width="90%" style="padding-left:10px;font-size:7pt;background-color:<?=$color;?>"><?=$valueChart['nm_parameter'];?></td>
                <td width="10%" style="padding-left:10px;font-size:8pt;background-color:<?=$color;?>"><center><?=$percent;?>%</center></td>
             </tr>
  		<!-- <div class="col-3-4" style="font-size:6pt;background-color:<?=$color;?>"><?=$valueChart['nm_parameter'];?></div> -->
  		<!-- <div class="col-1-4" align="center" style="font-size:8pt;align:center;color:black;background-color:<?=$color;?>"><?=$percent;?>%</div> -->
  	

  <?php } ?>
  			</table>
          </div>
        </div>
      </div>
    </div>
  <!-- </div> -->
  <?php }else{ ?>
  <div class="row">
       <div class="block-1-1 block-tab-full group">
        <div class=" page-circle"> 
          <div class="header-chart" style="background-color:#074979;color:#fff;">
            <table border="0" width="100%" style="border:3px solid #f8a406;padding:0 0 0 0px;">
              <tr>
                <td width="100%" style="padding-left:10px;font-size:5pt;"><center>DATA DETAIL TIDAK TERSEDIA !</center></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
  
