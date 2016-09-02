<?php
session_start();
if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
    if(!headers_sent()) {
        header("Status: 301 Moved Permanently");
        header(sprintf(
            'Location: https://%s%s',
            $_SERVER['HTTP_HOST'],
            $_SERVER['REQUEST_URI']
        ));
        exit();
    }
}
require_once($_SERVER['DOCUMENT_ROOT'].'/ink/base.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel='stylesheet' href='assets/scss/chosen.css'>
<link rel='stylesheet' href='assets/scss/font-awesome/font-awesome.css'>
<link rel='stylesheet' href='assets/css/app.css'>
<link rel="stylesheet" type="text/css" href="css/nyroModal.css" />
<link href='https://fonts.googleapis.com/css?family=Oswald:300,400,700|Open+Sans:400,700,300' rel='stylesheet' type='text/css'>

  <link href="assets/favicon.ico" rel="shortcut icon">
  <link href="assets/apple-touch-icon.png" rel="apple-touch-icon">
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    @javascript html5shiv respond.min
  <![endif]-->

<title>DashingDon: Free ChoiceScript Game Hosting</title>
		<meta name="description" content="DashingDon: Free ChoiceScript Game Hosting" />
		
		<meta name="author" content="DashingDon" />
</head>

<body>
<div class="all-wrapper">
  <div class="row">
    <div class="col-md-12">

      <div class="content-wrapper wood-wrapper">
        <div class="content-inner">
          <div class="page-header">
  <div class="header-links hidden-xs">
<ol class="breadcrumb">
	<?php if($_SESSION['nick']!=''){
		echo '<li style="font-weight:bold"><a href="manage.php"><i class="icon-gears"></i> Manage Your Games</a></li>';
		echo '<li><a href="logout.php" style="color:#C00"><i class="icon-signout"></i> Logout '.$_SESSION['nick'].'</a></li>';
	}else{
		echo '<li><b><a href="membership.php" style="color:#0C0"><i class="icon-signin"></i> Register / Login</a></b></li>';
	} ?>
</ol>
  </div>
  <h1>DashingDon: Free ChoiceScript Game Hosting</h1>
</div>
          <div class="main-content">
            <div class="widget">
              <div class="alert alert-warning text-center">
                <i class="icon-info-sign"></i> DashingDon is not associated or affiliated with Choice of Games LLC or Hosted Games LLC<br />If you need support, please message <b>dashingdon </b> on the <a href="https://forum.choiceofgames.com" target="_blank">Choice of Games forum</a>
              </div>
            </div>
            <div class="widget">
			
<?php
	$thesegames = R::getAll("SELECT * FROM games WHERE privvy = 1 ORDER BY id DESC");
	$rowstart = true;
	echo '<div class="row">';
	foreach ($thesegames as $row) {
		$thismem = R::getRow("SELECT * FROM users WHERE id = ".$row['usersid']);
		$authorfix = str_replace(" ", "-", $thismem['nick']);
		$titlefix = $row['url'];
		$urltitlefix = str_replace("'", "\'", $titlefix);
		$urlauthorfix = str_replace("'", "\'", $authorfix);
		
		
		$justdid=false;
		if($rowstart==true){
			echo '<div class="row">';
			$rowstart=false;
		}
		
		echo '<div class="col-lg-3 col-md-4 col-sm-6 text-center" style="margin-bottom:20px;">';
        echo '<div class="widget-content-white padded glossed" style="position:relative;">';
		
		if($row['stylesheet']!=0){
				if($row['stylesheet']==1){
					$thistheme = 'DARK TECH';
					$thiscolor = '84281F';
				}elseif($row['stylesheet']==2){
					$thistheme = '<span style="font-family: serif;">TYPEWRITTEN</span>';
					$thiscolor = 'a9acaf';
				}
			echo '<div style="position:absolute;padding:5px;background:#'.$thiscolor.';color:#FFF;right:0;bottom:0;font-size:10px">'.$thistheme.'</div>';
		}else{
			echo '<div style="position:absolute;padding:5px;background:#999;color:#FFF;right:0;bottom:0;font-size:10px">EASY READER</div>';
		}		
				
			if(file_exists('/var/www/play/'.$authorfix.'/'.$titlefix.'/mygame/dashpic.jpg')){
				$burl = "https://dashingdon.com/play/$urlauthorfix/$urltitlefix/mygame/dashpic.jpg";
			}elseif(file_exists('/var/www/play/'.$authorfix.'/'.$titlefix.'/mygame/dashpic.JPG')){
				$burl = "https://dashingdon.com/play/$urlauthorfix/$urltitlefix/mygame/dashpic.JPG";
			}else{
				$burl = "img/04.png";
			}
		
?>
		<a href="https://dashingdon.com/play/<?=$authorfix;?>/<?=$titlefix;?>/mygame/" target="_blank">
			<div class="pre-value-block" style="background: url('<?=$burl;?>') no-repeat center;width:100%;height:195px;">
			</div>
		</a>
		<div class="value-block">
			<div class="value-self"><sup><i class="icon-quote-left" style="font-size:12px;color:#AAA"></i></sup><a href="https://dashingdon.com/play/<?=$authorfix;?>/<?=$titlefix;?>/mygame/" target="_blank"><?=$row['title'];?></a><sup><i class="icon-quote-right" style="font-size:12px;color:#AAA"></i></sup></div>
			<p>by <?=$thismem['nick'];?></p>
			<div class="value-sub"><?=$row['blurb'];?></div>
		</div>
<?php	

		echo '</div>';
		echo '</div>';

	}
	if($justdid!=true){
		echo '</div>';
	}
?>
			
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<br /><br /><br />
<p class="info text-center"><b>&copy;<?=date('Y');?> DashingDon.com &ndash; All Rights Reserved</b><br /><em>DashingDon is not associated or affiliated with Choice of Games LLC or Hosted Games LLC</em><br /><a href="terms.php" class="nyroModal">Terms of Service</a> | <a href="privacy.php" class="nyroModal">Privacy Policy</a></p>
<br /><br /><br />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="js/jquery.nyroModal.custom.min.js"></script>
	<script>
	$(document).ready(function() {
		$('.nyroModal').nyroModal();
	});
	</script>
</body>

</html>