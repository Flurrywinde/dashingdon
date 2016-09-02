<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/ink/base.php');
$username = $_POST['username'];
$password = hash('sha256', $_POST['password']);

$thismember = R::getRow( 'SELECT * FROM users WHERE email = :username AND pass = :password', [':username' => $username, ':password' => $password] );
if($thismember==''){
$_SESSION['error']='Invalid Match';
header('Location: membership.php');
exit();
}
$reload = R::load('users',$thismember['id']);
$reload->logins = $reload->logins + 1;
$newreload = R::store( $reload );
$_SESSION['memberlog']=$thismember['id'];
$_SESSION['nick']=$thismember['nick'];
$_SESSION['logger']='jackedin';
header('Location: index.php');
exit();
?>