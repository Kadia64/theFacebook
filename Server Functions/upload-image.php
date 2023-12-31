<?php
$path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/content.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/session-functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/data-handle.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/sql-functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/ftp-handle.php';
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
    $raw_data = file_get_contents($_FILES['profile-image']['tmp_name']);
    $source_file_name = $_FILES['profile-image']['name'];
    $extension = strtolower(pathinfo($source_file_name, PATHINFO_EXTENSION));
    
    $sql->Connect();
    $ftp->Connect();
    $ftp->Login();
    $user_token = json_decode($_COOKIE['user-token']);
    $email = $user_token->{'email'};
    $username = $user_token->{'username'};
    $id = $sql->GetIDByEmail($email);

    // if the user does not have a defaut profile image already
    if (!$sql->CheckValueNull('profile_image', 'account_info', 'email', $email)) {
        // remove their previous profile image
        $old_profile_image_name = mysqli_fetch_assoc(mysqli_query($sql->connection, "SELECT profile_image_name FROM session_data WHERE session_data_id = $id;"))['profile_image_name'];
        $old_profile_image_extension = mysqli_fetch_assoc(mysqli_query($sql->connection, "SELECT profile_image_extension FROM account_info WHERE email = '$email';"))['profile_image_extension'];
        $ftp->DeleteFile($old_profile_image_name . '.' . $old_profile_image_extension);
    }

    // recreate the new profile image with what the user selected
    mysqli_query($sql->connection, "UPDATE account_info AS a SET a.profile_image = '$image_data' WHERE a.username = '$username';");
    $file_name = $dh->ParseProfileImageHash($username, $email, '.' . $extension);
    $sh->UpdateCachedProfileImage($ftp, $sql, $email, $file_name);

    // update the database to store the cached file name
    $parts = explode('.', $file_name);
    $file_name = $parts[0];
    mysqli_query($sql->connection, "UPDATE account_info SET profile_image_extension = '$extension' WHERE email = '$email';");

    // update the account-attributes cookie

    $old_account_attributes = json_decode($_COOKIE['account-attributes']);
    $account_attributes = array(
        'profile-image' => false,
        'profile-image-id' => $dh->GetProfileImageName($sql, $id),
        'profile-image-extension' => $extension,
        'class-connection-count' => 0,
        'friend-connection-count' => 0,
        'friends-id-list' => $old_account_attributes->{'friends-id-list'},
        'friend-message-count' => 0,
        'group-message-count' => 0
    );
    $sh->UpdateCookies($sql, $email, null, $account_attributes);
    $sql->CloseConnection();
    exit;
}
?>