<?php 
$_path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/sql-functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/ftp-handle.php';
$ftp = new FTPHandle();
$sql = new SQLHandle();
$sql->Connect();

$user_token = json_decode($_COOKIE['user-token']);
$email = $user_token->{'email'};

$target_id = $_GET['id'];
$target_email = $sql->GetEmailByID($target_id);
$default_image_check = $sql->CheckValueNull('profile_image', 'account_info', 'email', $target_email);

if ($default_image_check) {
    $ftp->Connect();
    $ftp->Login();
    $ftp->ChangeDirectory('Cache/Default');
    header('Content-Type: image/jpeg');
    ftp_get($ftp->ConnectionID, 'php://output', 'def-' . $_GET['def-index'] . '.jpg', FTP_BINARY);
    $ftp->CloseConnection();    
} else {
    $extension = $sql->GetValueByEmail('profile_image_extension', 'account_info', $email);
    switch ($extension) {
        case "jpg":
            header('Content-Type: image/jpeg');
            break;
        case "png":
            break;
        case "gif":
            break;
    }

    $img_result = mysqli_query($sql->connection, "SELECT profile_image FROM account_info WHERE email = '$target_email'");
    $row = mysqli_fetch_assoc($img_result);
    echo $row['profile_image'];
}

header('Content-Type: text/html');
$sql->CloseConnection();
?>