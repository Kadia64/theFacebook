<?php 
$_path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/files.php';
$ftp = new FTPHandle();

$ftp->Connect();
$ftp->Login();

if (isset($_GET['def'])) {
    $ftp->ChangeDirectory('Cache/Default');
    $index = $_GET['def-index'];    
    header('Content-Type: image/jpeg');
    ftp_get($ftp->ConnectionID, 'php://output', 'def-' . $index . '.jpg', FTP_BINARY);
} else if (isset($_GET['profile'])) {
    $ftp->ChangeDirectory('Cache');
    $file_extension = $_GET['extension'];
    switch ($file_extension) {
        case 'jpg':
        case 'jpeg':
            header('Content-Type: image/jpeg');
            break;
        case 'png':
            header("Content-Type: image/png");
            break;
        case "gif":
            header("Content-Type: image/gif");
            break;
    }
    ftp_get($ftp->ConnectionID, 'php://output', $_GET['id'] . '.' . $file_extension, FTP_BINARY);
}

header('Content-Type: text/html');
$ftp->CloseConnection();
?>