<?php
session_set_cookie_params(0, '/', '.dashingdon.com');
session_start();
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
$titlefix = strtolower(str_replace("-", " ", $game));
$finder = R::getRow( 'SELECT * FROM users WHERE nick = :nickname', [ ':nickname' => $nickname ] );
$playerid = $finder['id'];
$thisgame = R::getRow( 'SELECT * FROM games WHERE usersid = :playerid AND url LIKE :game', [':playerid' => $playerid, ':game' => $game ] );
$stylesheet = $thisgame['stylesheet'];
$saveplugin = $thisgame['saveplugin'];
if($stylesheet==0){$stylesheet='';}
?>
<!DOCTYPE html>
<html>
<!--
Copyright 2010 by Dan Fabulich.

Dan Fabulich licenses this file to you under the
ChoiceScript License, Version 1.0 (the "License"); you may
not use this file except in compliance with the License. 
You may obtain a copy of the License at

 http://www.choiceofgames.com/LICENSE-1.0.txt

See the License for the specific language governing
permissions and limitations under the License.

Unless required by applicable law or agreed to in writing,
software distributed under the License is distributed on an
"AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND,
either express or implied.
-->
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name = "viewport" content = "width = device-width, initial-scale = 1.0, maximum-scale = 1.0">
<!-- INSERT correct meta values -->
<!-- <title>Multiple Choice Example Game | My First ChoiceScript Game</title> -->

<script>window.version="UNKNOWN"</script>
<script src="https://dashingdon.com/cog/assets/persist.js"></script>
<script src="https://dashingdon.com/cog/assets/alertify.min.js"></script>
<script src="https://dashingdon.com/cog/assets/util.js"></script>
<script src="https://dashingdon.com/cog/assets/ui.js"></script>
<script src="https://dashingdon.com/cog/assets/scene.js"></script>
<script src="https://dashingdon.com/cog/assets/smPlugin.js"></script>
<?php if($saveplugin==1){ ?>
<script src="https://dashingdon.com/cog/assets/smPluginMenuAddon.js"></script>
<?php } ?>
<script src="https://dashingdon.com/cog/assets/navigator.js"></script>
<script src="https://dashingdon.com/cog/assets/mygame.js"></script>
<link href="https://dashingdon.com/cog/assets/alertify.css" rel="stylesheet" type="text/css">
<link href="https://dashingdon.com/cog/assets/style<?=$stylesheet;?>.css" rel="stylesheet" type="text/css">
<!--[if IE 6]><style>.alertify-logs { position: absolute; }</style><![endif]-->
<link rel="icon" type="image/vnd.microsoft.icon" href="https://dashingdon.com/cog/assets/favicon.ico">
<meta name="apple-mobile-web-app-capable" content="yes" />
<link rel="apple-touch-icon-precomposed" href="mobile-icon.png"/>
<link rel="SHORTCUT ICON" href="https://dashingdon.com/cog/assets/favicon.ico"/>
<script>
// INSERT store name; disabled by default because it's confusing for newbie authors
window.storeName = null;
//Scene.generatedFast = true;
var rootDir = "https://dashingdon.com/cog/assets/";
</script>
</head>
<body>
<div id="advertisement">
</div>
<div id="header">
  <div id="identity"><a href="#" id="email">you@example.com</a><a href="#" id="logout">Sign Out</a></div>

  <h1 class="gameTitle"><!-- My First ChoiceScript Game --></h1>
<h2 id="author" class="gameTitle"><!--by INSERTINSERTINSERT --></h2>

  <p id="headerLinks">
      <!-- <a href="credits.html" id="aboutLink" class="spacedLink">About</a> -->
    </p>
  <p id="buttons"><button id="statsButton" class="spacedLink" onclick="showStats()">Show Stats</button> <button id="restartButton" class="spacedLink" onclick="restartGame('prompt')">Restart</button> <button id="achievementsButton" onclick="showAchievements()" class="spacedLink" style="display: none">Achievements</button></p>
</div>
<div id="main">
<div id="text">
</div>
<script>
startLoading();
</script>
</div>
<div id="mobileLinks" class="webOnly">
  <!-- INSERT fixed links
  <p class="mobileBadges">
    <a class='spacedLink' id='iphoneLink' href='http://itunes.apple.com/us/app/choice-of-broadsides/id365660770'><img src='https://dashingdon.com/cog/assets/icons/appstore.png' style='height: 3em;'></a>
    <a class='spacedLink' id='androidLink' href='https://play.google.com/store/apps/details?id=com.choiceofgames.broadsides'><img src='https://dashingdon.com/cog/assets/icons/droid.png' style='height: 3em;'></a>
    <a class='spacedLink' id='kindleLink' href='http://www.amazon.com/Choice-of-Broadsides/dp/B004FRH3PO'><img src='https://dashingdon.com/cog/assets/icons/kindle.png' style='height: 3em;'></a>
    <a class='spacedLink' id='chromeLink' href='https://chrome.google.com/webstore/detail/donhlnjhcdnocioldondhgngncepnpch'><img src='https://dashingdon.com/cog/assets/icons/chrome.png' style='height: 3em;'></a>
  </p>
  -->
</div>
<noscript>
<p>This game requires JavaScript; please enable JavaScript and refresh this page.</p>
</noscript>
<div style="text-align:right;font-size:0.8rem;">
<p><a href="https://www.choiceofgames.com/make-your-own-games/choicescript-intro/" target="_blank">Make your own games with ChoiceScript</a><br />
<a href="https://dashingdon.com/" target="_blank">Host your ChoiceScript game at DashingDon</a></p>
</div>
</body>
</html>
