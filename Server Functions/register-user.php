<?php 
$path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/session-functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/methods.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/data-handle.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/sql-functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/ftp-handle.php';

$sh = new SessionHandle();
$methods = new Methods();
$dh = new DataHandle();
$sql = new SQLHandle();
$ftp = new FTPHandle();
session_start();
$sql->Connect();
$ftp->Connect();
$ftp->Login();

$generated_sessionID = $methods->RandomCharacters(32);
$salt = $methods->RandomCharacters(32);
$email = $_SESSION['email'];
$username = $_SESSION['username'];
$account_info = [
    'username' => $username,
    'status' => ucwords(str_replace('s-a', 's/A', $_SESSION['status']), '-'),
    'email' => $email,
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
$default_image_check = $sql->CheckValueNull('profile_image', 'account_info', 'email', $email);
$sh->CacheProfileImage($ftp, $sql, $email, $dh->ParseProfileImageHash($username, $email, '.' . $sql->GetValueByEmail('profile_image_extension', 'account_info', $email)), $default_image_check);
$sql->CloseConnection();
$sh->Redirect('Pages/User Pages/MainProfilePage.php?return-status=account-created&username=' . $account_info['username'] . '&email=' . $account_info['email']);
exit;
?>