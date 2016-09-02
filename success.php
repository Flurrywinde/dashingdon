<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8" />
  <title>DashingDon Edit Game</title>

  <!-- styles -->
	<link rel="stylesheet" type="text/css" href="css/demo.css" />
	<link rel="stylesheet" type="text/css" href="css/component.css" />
	<link rel="stylesheet" type="text/css" href="css/pure-min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
<h2 style="text-align:center;">Success!</h2>
<div class="holder" style="padding:10px;">

<p style="text-align:center">Your game was successfully updated.</p>
<?php if($_GET['task']=='newgame'){ ?>
<h2 style="text-align:center">Please reload page to refresh your games list.</h2>
<?php } ?>
</div>
</body>
</html>
