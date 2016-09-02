<?php
session_start();
$thisnick = $_SESSION['nick'];
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8" />
  <title>DashingDon Create Game</title>

  <!-- styles -->
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
  <link rel="stylesheet" type="text/css" href="css/pure-min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
<h2 style="text-align:center;">Create New Game</h2>
<div class="holder" style="padding:10px;">

<form method="POST" action="create.php">
<p>Enter the Name of Your Game:<br />
<input type="text" name="gamename" placeholder="Name of Your Game" style="padding:10px;border:1px solid #999;width:50%"></p>

<p>Enter a Short Description of Your Game:<br />
<textarea placeholder="Short Description of Your Game" style="padding:10px;border:1px solid #999;height:80px;width:50%" name="blurb"></textarea></p>

<p style="width:50%;margin:0 auto;">Check this box only if you want everyone to be able to see your game on the DashingDon front page:</p>
<p><input type="checkbox" name="privvy" id="privvy" value=1 style="padding:10px;border:1px solid #999;"> <label for="privvy"><strong>Make my game public</strong></label></p>

<input type="submit" name="Create Game" value="Create Game" class="pure-button pure-button-primary">
</form>
</div>
</body>
</html>
