<?php 
$path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/session-functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/sql-functions.php';
$sh = new SessionHandle();
$sql = new SQLHandle();
session_start();
if (isset($_COOKIE['user-token'])) {
    $sql->Connect();
    $user_token = json_decode($_COOKIE['user-token']);
    $sh->EndUserSession($sql, $sql->GetIDByEmail($user_token->{'email'}));
    $sql->CloseConnection();
}
session_unset();
setcookie('user-token', '', 0, '/');
setcookie('user-data', '', 0, '/');
setcookie('account-attributes', '', 0, '/');
$sh->Redirect('Pages/Logged Out Pages/Login.php');
?>