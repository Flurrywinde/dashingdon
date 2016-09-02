<?php
session_set_cookie_params(0, '/', '.dashingdon.com');
session_start();
header("Content-type: text/css; charset: UTF-8");
require_once($_SERVER['DOCUMENT_ROOT'].'/ink/base.php');

function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

$fullurl = parse_url(curPageURL());
$urlparts = explode("/", $fullurl['path']);
$nickname = $urlparts[2];
$game = $urlparts[3];


//$nickname = trim($nickname," \t\n\r\0\x0B");

//print_r($urlparts);
//echo $nickname.'<br />';

$titlefix = strtolower(str_replace("-", " ", $game));

//echo '<h1>'.$titlefix.'</h1>';

$finder = R::getRow( 'SELECT * FROM users WHERE nick = :nickname', [ ':nickname' => $nickname ] );


//R::getRow('select * from page where title like ? limit 1', array('%Jazz%'));
/*
echo '<pre>';
print_r($finder);
echo '</pre>';
*/

$playerid = $finder['id'];

//echo $playerid;


$thisgame = R::getRow( 'SELECT * FROM games WHERE usersid = :playerid AND title LIKE :game', [':playerid' => $playerid, ':game' => $titlefix ] );


//print_r($thisgame);

$stylesheet = $thisgame['stylesheet'];
if($stylesheet==0){$stylesheet='';}
require_once($_SERVER['DOCUMENT_ROOT'].'/cog/assets/style.css');
?>

