<?php 
$path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/session-functions.php';
$sh = new SessionHandle();
session_start();
session_unset();
setcookie('user-token', '', 0, '/');
setcookie('user-data', '', 0, '/');
$sh->Redirect('Pages/Logged Out Pages/Login.php');
?>