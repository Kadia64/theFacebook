<?php 
$path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/session-functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/data-handle.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/sql-functions.php';
$sf = new SessionHandle();
$dh = new DataHandle();
$sql = new SQLHandle();

session_start();
$sql->Connect();
if (!$sf->CookiesEnabled()) {
    $sf->Redirect('Pages/EnableCookies.php');
    exit;
} else {
    $username = $_POST['username'];
    $email = $_POST['email'];
    if ($dh->CheckExistingAccount($sql, $username, $email) == 'username') {
        $sf->Redirect('Pages/Logged Out Pages/RegisterUser.php?account-create-fail=username');
    } else if ($dh->CheckExistingAccount($sql, $username, $email) == 'email') {
        $sf->Redirect('Pages/Logged Out Pages/RegisterUser.php?account-create-fail=email');
    } else if ($dh->CheckExistingAccount($sql, $username, $email) == 'both') {
        $sf->Redirect('Pages/Logged Out Pages/RegisterUser.php?account-create-fail=both');
    } else {        
        // free username & email
        $sql->CloseConnection();

        $_SESSION['username'] = $_POST['username'];
        $_SESSION['status'] = $_POST['status'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['password'] = $_POST['password'];
        $sf->Redirect('Pages/Logged Out Pages/RegisterAboutUser.php', 'PHP');
    }    
}
exit;
?>