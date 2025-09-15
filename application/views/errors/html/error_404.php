<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>404 Page Not Found</title>
<style type="text/css">

::selection { background-color: #E13300; color: white; }
::-moz-selection { background-color: #E13300; color: white; }
<?php 
	$base  = "http://".$_SERVER['HTTP_HOST'];
	$base .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
 ?>
html,body {
	/*background-color: #fcfcfc;
	margin: 40px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;*/
	
			/*background-repeat: repeat;
			background-position: center;
			background-size: cover;
			font-family: 'Roboto', sans-serif;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
			text-rendering: optimizeLegibility;
			font-size: 12px;*/
			height: 100%;
  			margin: 0;
}

.bg {
  /* The image used */
  background-image: url("<?php echo $base.'assets/img/hero-bg.jpg';?>");

  /* Full height */
  height: 100%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

/*h1 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
	text-align: center;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#container {
	margin: 10px;
	border: 1px solid #D0D0D0;
	box-shadow: 0 0 8px #D0D0D0;
}

p {
	margin: 12px 15px 12px 15px;
}*/

body, html {
  height: 100%;
  margin: 0;
  font: 400 15px/1.8 "Lato", sans-serif;
  color: #777;
}

.bgimg-1, .bgimg-2, .bgimg-3 {
  position: relative;
  opacity: 0.65;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;

}
.bgimg-1 {
  background-image: url("<?php echo $base.'assets/img/hero-bg.jpg';?>");
  /*background-color: deepskyblue;*/
  height: 100%;
}

.caption {
  position: absolute;
  left: 0;
  top: 40%;
  width: 100%;
  text-align: center;
  color: #000;
}

.caption span.border {
  background-color: #111;
  color: #fff;
  padding: 18px;
  font-size: 20px;
  letter-spacing: 10px;
}
.caption p {
  background-color: #111;
  color: #fff;
  padding: 18px;
  font-size: 20px;
  letter-spacing: 10px;
}

.caption button {
  background-color: #fcfcfc;
  color: #111;
  padding: 10px;
  font-size: 20px;
  border-radius: 50%;
  cursor:pointer;
}
</style>
</head>
<body>
<?php 
	$base  = "http://".$_SERVER['HTTP_HOST'];
	$base .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
 ?>
 	
 	<div class="bgimg-1">
	  <div class="caption">
	    <span class="border"><?php echo $heading; ?></span>
	    <?php echo $message; ?>
	    <button onclick="goBack()">Back</button>
	  </div>
	</div>
	<script>
		function goBack() {
		  window.history.back();
		}
	</script>
</body>
</html>