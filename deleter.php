<?php
session_start();
if($_SESSION['nick']==''){
	header('Location: membership.php');
	exit();
}
$thisnick = $_SESSION['nick'];
$thisgame = $_GET['gameid'];
$titlefix = strtoupper(str_replace("-", " ", $_GET['gameurl']));
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8" />
  <title>DashingDon Delete Game</title>

  <!-- styles -->
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
  <link rel="stylesheet" type="text/css" href="css/pure-min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  
</head>
<body>
<h2 style="text-align:center;">Deleting &ldquo;<?=$titlefix;?>&rdquo;</h2>
<div class="holder" style="padding:10px;">

<form method="POST" action="delete.php">
<h2>Are you sure you want to delete &ldquo;<?=$titlefix;?>&rdquo;?</h2>
<p><strong>Warning:</strong> A game cannot be easily restored once deleted!</p>
<input type="hidden" name="gameid" value="<?=$thisgame;?>"></p>
<input type="submit" name="Delete Game" value="Yes, Delete This Game" class="pure-button pure-button-primary" style="background:#C00;">
</form>
<p><a href="#" onclick="parent.$.nmTop().close();" class="pure-button pure-button-primary">No, Do Not Delete</a></p>
</div>
</body>
</html>
