<!doctype html>
<html lang="en">
<head>
  <title><?=SHORT_APP_NAME; ?></title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <!-- VENDOR CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/main.css">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>assets/img/apple-icon.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url() ?>assets/img/favicon.png">  
  <!-- Javascript -->
  <!-- script src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script -->
  <script src="<?= base_url() ?>assets/js/jquery-3.3.1.js"></script>
  <script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
  



  <style type="text/css">
    html { overflow-y: scroll; overflow-x:hidden; }
    body {
        font-family: Arial, Helvetica, sans-serif;
        background: grey;
    }
  </style>

</head>

<body>
  
  <!-- WRAPPER -->
  <div id="row" style="padding:0 0 0 0px;">
    <div class="col-md-12" style="padding:0 0 0 0px;">
      <div class="panel panel-primary" style="padding:0 0 0 0px;">
        <div class="panel-heading">
          <h2 class="panel-title"><?=$title; ?></h2>
        </div>
        <div class="panel-body">
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="<?=$link; ?>" allowfullscreen></iframe>
            </div>
        </div>
      </div>
    </div>
   
  </div>

  
</body>

</html>

