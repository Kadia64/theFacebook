<?php
$path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/content.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/sql-functions.php';
$content = new Content();
$sql = new SQLHandle();

if (isset($_FILES['profile-image'])) {
    
    $file = $_FILES['profile-image'];
    $name = $file['name'];
    $type = $file['type'];
    $size = $file['size'];
    $image_data = addslashes(file_get_contents($_FILES['profile-image']['tmp_name']));
    
    $sql->Connect();    
    $query = "
        UPDATE account_info AS a
        SET
        a.profile_image = '" . $image_data . "'
        WHERE a.username = 'asd';
    ";
    mysqli_query($sql->connection, $query);
    $sql->CloseConnection();
    exit;
}
?>