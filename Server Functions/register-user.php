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

$generated_sessionID = $dh->RandomCharacters(32);
$salt = $dh->RandomCharacters(32);
$account_info = [
    'username' => $_SESSION['username'],
    'status' => ucwords(str_replace('s-a', 's/A', $_SESSION['status']), '-'),
    'email' => $_SESSION['email'],
    'password' => hash('sha256', $_SESSION['password'] . $salt),
    'salt' => $salt,
    'profile-image' => null
];
$register_data = $sh->GetRegisterData();
$register_data['sex'] = ucwords($register_data['sex']);
$register_data['looking-for'] = str_replace('-', ' ', ucwords($register_data['looking-for'], '-'));
$register_data['interested-in'] = ucwords($register_data['interested-in']);

$dh->CreateAccount($sql, $register_data, $account_info);
$userID = $sql->GetIDByEmail($account_info['email']);
$sh->StartuserSession($sql, $sql->GetIDByEmail($account_info['email']), $generated_sessionID);
$sh->SetLogoutCookie($userID);
$sql->CloseConnection();
$sh->Redirect('Pages/User Pages/MainProfilePage.php?return-status=account-created&username=' . $account_info['username'] . '&email=' . $account_info['email']);
exit;
?>