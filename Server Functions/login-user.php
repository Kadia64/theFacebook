<?php 
$path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/data-handle.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/session-functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/sql-functions.php';
$dh = new DataHandle();
$sh = new SessionHandle();
$sql = new SQLHandle();
session_start();
$sql->Connect();

$email = $_POST['email'];
$username = $sql->GetUsernameByEmail($email);
$salt = $sql->GetValueByEmail('password_salt', 'account_info', $email);
$password = hash('sha256', $_POST['password'] . $salt);
if ($dh->Login($sql, $email, $password)) {
    $sql->CloseConnection();
    $_SESSION['email'] = $email;
    $sh->SetUserDataCookie($username, $email);
    $sh->Redirect('Pages/User Pages/MainProfilePage.php?return-status=logged-in');
    exit;
} else {

    echo 'trash';
}

$sql->CloseConnection();
exit;
?>