<?php if (count($chartDetail)!= 0) {?>
  <div class="col-full">
  <?php foreach ($chartDetail as $valueChart) {
    $percent = $valueChart['bobot'] == '' ? 0:$valueChart['bobot'];
    if($percent < 25) {$color = '#f52b48';}
    elseif($percent < 50) {$color = '#fefc61';}
    elseif($percent < 75) {$color = '#61fe68';}
    elseif($percent <= 100) {$color = '#618dfe';}    
    ?>
    
      <div style="cursor:pointer;" class="skillBox showSub" data-was="<?=$was;?>" data-kode = "<?=$valueChart['id_parameter'];?>" data-daerah="<?=$valueChart['id_daerah'];?>" data-tahun="<?=$valueChart['tahun'];?>" data-nama="<?=$valueChart['nm_parameter'];?>">
        <p><?=$valueChart['nm_parameter'];?> </p>
        <p><?=$percent;?> %</p>
        <div class="skill" id="column<?=$valueChart['id_parameter'];?>">
          <div class="skill_level" style="width:<?=$percent;?>%;background:<?=$color;?>;"></div>
        </div>
      </div>
      <div class="subDetail" id="subDetail<?=$valueChart['id_parameter'];?>" data-kode = "<?=$valueChart['id_parameter'];?>" data-active = "T" hidden></div>    

    <?php } ?>
  </div>
  <div class="col-full" hidden>
    <table border="0" width="100%" style="border:2px solid #f8a406;">
        <thead>
          <tr>
            <th width="100%" colspan = '2' style="padding-left:10px;font-size:6pt;text-align:center;" id="nm_list_<?=$was;?>">(NAMA SUB PARAMETER)</th>
          </tr>
        </thead>
        <tbody id="list_sub_parameter_<?=$was;?>">
          <tr>
            <td width="100%" colspan="2" style="text-align:center;">Pilih Detail!</td>
          </tr>
        </tbody>  
      </table>
  </div>
  <?php }else{ ?>
  <div class="row">
       <div class="block-1-1 block-tab-full group">
        <div class=" page-circle"> 
          <div class="header-chart" style="background-color:#074979;color:#fff;">
            <table border="0" width="100%" style="border:3px solid #f8a406;padding:0 0 0 0px;">
              <tr>
                <td width="100%" style="padding-left:10px;font-size:8pt;"><center>DATA DETAIL TIDAK TERSEDIA !</center></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>


  