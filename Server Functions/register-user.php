<?php 
$path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/session-functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/data-handle.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/sql-functions.php';

$sh = new SessionHandle();
$dh = new DataHandle();
$sql = new SQLHandle();
$sql->Connect();
session_start();

$salt = $dh->RandomCharacters(32);
$account_info = [
    'username' => $_SESSION['username'],
    'status' => $_SESSION['status'],
    'email' => $_SESSION['email'],
    'password' => hash('sha256', $_SESSION['password'] . $salt),
    'salt' => $salt
];
$register_data = $sh->GetRegisterData();

$dh->CreateAccount($sql, $register_data, $account_info);
$sql->CloseConnection();
$sh->Redirect('Pages/User Pages/MainProfilePage.php?return-status=account-created');
exit;
?>