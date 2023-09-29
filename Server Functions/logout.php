<?php 
$path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/session-functions.php';
$sh = new SessionHandle();
session_start();
setcookie('user-token', '', 0, '/');
setcookie('user-data', '', 0, '/');
session_unset();
$sh->Redirect('Pages/Logged Out Pages/Login.php');
?>