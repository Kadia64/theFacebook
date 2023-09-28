<?php 
$path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/session-functions.php';
$sf = new SessionHandle();
session_start();


if (!$sf->CookiesEnabled()) {
    $sf->Redirect('Pages/EnableCookies.php');
    exit;
} else {
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['status'] = $_POST['status'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['password'] = $_POST['password'];
    $sf->Redirect('Pages/Logged Out Pages/RegisterAboutUser.php', 'PHP');
    exit;
}
?>