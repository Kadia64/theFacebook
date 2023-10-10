<?php 
$path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/session-functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/sql-functions.php';
$sh = new SessionHandle();
$sql = new SQLHandle();
session_start();
if (!isset($_COOKIE['logout'])) {
    echo 'Warning: there is no sessionID that is set!<br>Can\'t locate your sessions\'s row!';
} else {
    $sql->Connect();
    $logout_data = json_decode($_COOKIE['logout']);
    $sh->EndUserSession($sql, $logout_data->{'id'});
}
session_unset();
setcookie('user-token', '', 0, '/');
setcookie('user-data', '', 0, '/');
setcookie('account-attributes', '', 0, '/');
setcookie('logout', '', 0, '/');
$sh->Redirect('Pages/Logged Out Pages/Login.php');
?>