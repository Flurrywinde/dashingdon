<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/ink/base.php');
$thisnick = $_SESSION['nick'];
$_SESSION['tepid'] = $_GET['gameid'];
$fixgame = R::load('games', $_SESSION['tepid']);
if($fixgame->usersid!=$_SESSION['memberlog']){
	exit();
}

if($fixgame->privvy == 1){
	$avval = 'checked=checked';
}else{
	$avval = '';
}
?>
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
<h2 style="text-align:center;">Edit Game &ldquo;<?=$fixgame['title'];?>&rdquo;</h2>
<div class="holder" style="padding:10px;">

<form method="POST" action="edit.php">

<p>Enter a Short Description of Your Game:<br />
<textarea placeholder="Short Description of Your Game" style="padding:10px;margin:5px;border:1px solid #999;height:150px;width:80%" name="blurb"><?=$fixgame->blurb;?></textarea></p>

<p>Select a theme for your game:<br />
<select name="stylesheet" id="stylesheet" style="padding:5px;margin:5px;">
<option value="0" <?php if($fixgame->stylesheet==0){ echo 'selected=selected'; }?>>Easy Reader</option>
<option value="1" <?php if($fixgame->stylesheet==1){ echo 'selected=selected'; }?>>Dark Tech</option>
<option value="2" <?php if($fixgame->stylesheet==2){ echo 'selected=selected'; }?>>Typewritten</option>
</select>
</p>

<p><input type="checkbox" name="privvy" id="privvy" value=1 style="padding:10px;border:1px solid #999;" <?=$avval;?>> <label for="privvy"><strong>Check to make game public</strong></label></p>

<input type="submit" name="Save Description" value="Save Description" class="pure-button pure-button-primary">
</form>
</div>
</body>
</html>
