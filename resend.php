<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/ink/base.php');
$username = $_POST['username'];

$thismember = R::getRow( 'SELECT * FROM users WHERE email = :username', [':username' => $username] );
if($thismember==''){
$_SESSION['error']='Invalid Match';
header('Location: membership.php');
exit();
}else{

$reload = R::load('users',$thismember['id']);
$plainpass = uniqid();
$newpass = hash('sha256', $plainpass);
$reload->pass = $newpass;
$update = R::store( $reload );

$to      = $reload->email;
$subject = 'New Password';
$message = 'Your password for DashingDon.com has been reset to: '.$plainpass;
$headers = 'From: webmaster@dashingdon.com' . "\r\n" .
    'Reply-To: webmaster@dashingdon.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

$_SESSION['error']='A new password has been sent to your email address.';
header('Location: membership.php');
exit();
}
?>