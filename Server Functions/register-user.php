<?php 
$path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/session-functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/data-handle.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/sql-functions.php';

$sf = new SessionHandle();
$dh = new DataHandle();
$sql = new SQLHandle();
$sql->Connect();
session_start();

$account_info = [
    'username' => $_SESSION['username'],
    'status' => $_SESSION['status'],
    'email' => $_SESSION['email'],
    'password' => $_SESSION['password']
];
$register_data = $sf->GetRegisterData();

$dh->CreateAccount($sql, $register_data, $account_info);

$sql->CloseConnection();
?>