<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/ink/base.php');

//$nickname	 = $_POST['usernamesignup'];

function clean($string) {
	$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	$string = strtolower($string);
	return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

$nickname = clean($_POST['usernamesignup']);
$username = $_POST['emailsignup'];
$password = hash('sha256', $_POST['passwordsignup']);

if($username != '' && $password != ''){

$finder = R::getRow( 'SELECT * FROM users WHERE nick = :nickname', [':nickname' => $nickname] );
if($finder['nick']==$nickname) {
	$_SESSION['error'] = 'Sorry, that nickname is already taken.';
	header('Location: membership.php#toregister');
	exit();
}

$finder = R::getRow( 'SELECT * FROM users WHERE email = :email', [':email' => $username] );
if($finder['email']==$username) {
	$_SESSION['error'] = 'Sorry, that email is already registered.';
	header('Location: membership.php#toregister');
	exit();
}

$book = R::dispense( 'users' );
$book->nick = $nickname;
$book->email =  $username;
$book->pass =  $password;
$newid = R::store( $book );

$_SESSION['memberlog']=$newid;
$_SESSION['nick']=$nickname;
$_SESSION['logger']='jackedin';
header('Location: index.php');
exit();

}else{
$_SESSION['error'] = 'Must provide an email and password.';
header('Location: membership.php?#toregister');
exit();

}
?>