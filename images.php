<?php
session_start();
$thisnick = $_SESSION['nick'];
$thisgame = $_GET['gameurl'];
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8" />
  <title>DashingDon Upload</title>

  <!-- styles -->
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
  <link rel="stylesheet" type="text/css" href="css/pure-min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
<h2 style="text-align:center;">Editing &ldquo;<?=urldecode($_GET['gametitle']);?>&rdquo;</h2>
<div class="holder">  

  <!-- status message will be appear here -->
  <div class="status"></div>
  
  <!-- multiple file upload form -->
  <h3>Upload / Overwrite Image &amp; Sound Files:</h3>
  <p>(jpg, jpeg, png, gif, mp3 files only)</p>
  <form action="uploades.php" method="post" enctype="multipart/form-data" class="pure-form">
	<input type="hidden" name="gametitle" value="<?=$_GET['gametitle'];?>">
    <input type="file" name="files[]" multiple="multiple" id="files">
    <input type="submit" value="Upload" class="pure-button pure-button-primary">
  </form>
  
  <!-- progress bar -->
  <div class="progress">
    <div class="bar"></div >
    <div class="percent">0%</div >
  </div>
</div>

<div style="padding:10px;">
<p style="text-align:center;"><strong>Please note: Max image size is currently 1MB per image and you may only upload a maximum of 20 files at one time.</strong></p>
<p style="text-align:center;">The title picture that shows for your game on DashingDon can be changed by uploading a file named <strong>dashpic.jpg</strong> &ndash; the dashpic.jpg image will be cropped to <b>360x195</b> pixels.</p>
</div>

  <!-- javascript dependencies -->
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/jquery.form.min.js"></script>
  
  <!-- main script -->
  <script type="text/javascript" src="js/script.js"></script>
</body>
</html>
