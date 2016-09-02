<?php
session_start();
$thisnick = $_SESSION['nick'];
$memberlog = $_SESSION['memberlog'];
require_once($_SERVER['DOCUMENT_ROOT'].'/ink/base.php');

$gamename = $_POST['gamename'];
$thisgame = strtolower(str_replace(" ", "-", $_POST['gamename']));;

if($_POST['privvy']!=1){
	$privvy = 0;
}else{
	$privvy = 1;
}

$fixgame = R::load('games', $_SESSION['tepid']);

if($fixgame->usersid != $memberlog){
	header('Location: success.php');
	exit();
}

$fixgame->stylesheet = $_POST['stylesheet'];
$fixgame->privvy = $privvy;
$fixgame->blurb = $_POST['blurb'];
$id = R::store($fixgame);

header('Location: success.php');
exit();
?>