<?php 
$path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/ftp-handle.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/session-functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/sql-functions.php';
$sh = new SessionHandle();
$sql = new SQLHandle();
$ftp = new FTPHandle();
session_start();
if (!isset($_COOKIE['logout'])) {
    echo 'Warning: there is no sessionID that is set!<br>Can\'t locate your sessions\'s row!';
} else {
    try {
        $sql->Connect();
        $ftp->Connect();
        $ftp->Login();

        $logout_data = json_decode($_COOKIE['logout']);
        $id = $logout_data->{'id'};
        $file_to_delete = mysqli_fetch_assoc(mysqli_query($sql->connection, "SELECT profile_image_name FROM session_data WHERE session_data_id = $id;"))['profile_image_name'];
        $extension = mysqli_fetch_assoc(mysqli_query($sql->connection, "SELECT profile_image_extension FROM account_info WHERE account_id = $id;"))['profile_image_extension'];
        $ftp->DeleteFile($file_to_delete . '.' . $extension);
        $sh->EndUserSession($sql, $id);
        $sql->CloseConnection();
    } catch (Exception $e) {}
}
session_unset();
setcookie('user-token', '', 0, '/');
setcookie('user-data', '', 0, '/');
setcookie('account-attributes', '', 0, '/');
setcookie('logout', '', 0, '/');
$sh->Redirect('Pages/Logged Out Pages/Login.php');
?>