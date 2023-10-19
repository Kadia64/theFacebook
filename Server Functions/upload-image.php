<?php
$path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/content.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/session-functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/data-handle.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/sql-functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/files.php';
$content = new Content();
$sh = new SessionHandle();
$dh = new DataHandle();
$sql = new SQLHandle();
$ftp = new FTPHandle();
session_start();
$cookie_data = json_decode($_COOKIE['user-data']);
$email = $cookie_data->{'email'};
$username = $cookie_data->{'username'};

if (isset($_FILES['profile-image'])) {
    $file = $_FILES['profile-image'];
    $name = $file['name'];
    $type = $file['type'];
    $size = $file['size'];
    $image_data = addslashes(file_get_contents($_FILES['profile-image']['tmp_name']));        

    $sql->Connect();
    $ftp->Connect();
    $ftp->Login();
    $user_token = json_decode($_COOKIE['user-token']);
    $email = $user_token->{'email'};
    $username = $user_token->{'username'};
    $extension = 'jpg';

    if (!$sql->CheckValueNull('profile_image', 'account_info', 'email', $email)) {
        $old_profile_image_name = mysqli_fetch_assoc(mysqli_query($sql->connection, "SELECT profile_image_name FROM account_info WHERE email = '$email'"))['profile_image_name'];
        $old_profile_image_extension = mysqli_fetch_assoc(mysqli_query($sql->connection, "SELECT profile_image_extension FROM account_info WHERE email = '$email'"))['profile_image_extension'];
        $ftp->DeleteFile($old_profile_image_name . '.' . $old_profile_image_extension);
    }    

    mysqli_query($sql->connection, "UPDATE account_info AS a SET a.profile_image = '$image_data' WHERE a.username = '$username';");
    $file_name = $dh->ParseProfileImageHash($username, $email, '.' . $extension);
    $sh->CacheProfileImage($ftp, $sql, $email, $file_name);

    // update the database to store the cached file name
    $parts = explode('.', $file_name);
    $file_name = $parts[0];
    mysqli_query($sql->connection, "UPDATE account_info SET profile_image_name = '$file_name' WHERE email = '$email';");
    mysqli_query($sql->connection, "UPDATE account_info SET profile_image_extension = '$extension' WHERE email = '$email';");

    // update the account-attributes cookie
    $account_attributes = array(
        'profile-image' => false,
        'profile-image-id' => $file_name,
        'profile-image-extension' => $extension
    );
    $sh->UpdateCookies($sql, $email, null, $account_attributes);

    $sql->CloseConnection();
    exit;
}
?>