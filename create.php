<?php
session_start();

if($_POST['gamename']==''||$_SESSION['nick']==''){
	header('Location: index.php');
	exit();
}

function clean($string) {
	$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	$string = strtolower($string);
	return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function smallclean($string) {
	return str_replace('%', '-', $string); // Replaces all spaces with hyphens.
}

require_once($_SERVER['DOCUMENT_ROOT'].'/ink/base.php');

$thisnick = $_SESSION['nick'];
$gamename = smallclean($_POST['gamename']);
$thisgame = clean($_POST['gamename']);

$structure = "play/$thisnick/$thisgame/mygame/scenes";
$gamebase = "./play/$thisnick/$thisgame/";
$thisbase = "./play/_base/";

if (!mkdir($structure, 0777, true)) {
	die('Failed to create folders...');
}


$thesefiles = array('.htaccess', 'index.php', 'mygame/index.php');

foreach($thesefiles as $file){
	$newfile = $gamebase.$file;
	$file = $thisbase.$file;
	if (!copy($file, $newfile)) {
		echo "failed to copy $file...\n";
	}
}

if($_POST['privvy']!=1){
	$privvy = 0;
}else{
	$privvy = 1;
}

$newgame = R::dispense('games');
$newgame->usersid = $_SESSION['memberlog'];
$newgame->title = $gamename;
$newgame->url = $thisgame;
$newgame->blurb = $_POST['blurb'];
$newgame->privvy = $privvy;
$id = R::store($newgame);

header('Location: success.php?task=newgame');
exit();
?>