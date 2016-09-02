<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/ink/base.php');

if($_POST['gameid']==''||$_SESSION['nick']==''){
	header('Location: success.php');
	exit();
}

$gameid = $_POST['gameid'];
$usersid = $_SESSION['memberlog'];

$thisgame = R::getRow( 'SELECT * FROM games WHERE id = :gameid AND usersid = :usersid', [':gameid' => $gameid, ':usersid' => $usersid] );

$titlefix = strtolower(str_replace(" ", "-", $thisgame['title']));

if($thisgame['usersid']!=$usersid){
	header('Location: success.php');
	exit();
}

$rando = date('Y').'-'.date('m').'-'.date('B');
$cleantitle = strtolower(str_replace(" ", "-", $thisgame['title']));
$gonegame = '/var/www/play/'.$_SESSION['nick'].'/'.$cleantitle;
$byegame = '/var/www/play/'.$_SESSION['nick'].'/_'.$rando.'_'.$cleantitle;

rename($gonegame,$byegame);

$badgame = R::load('games', $gameid);
R::trash( $badgame );

header('Location: success.php?task=newgame');
exit();
?>