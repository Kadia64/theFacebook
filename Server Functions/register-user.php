<?php 
$path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/session-functions.php';

$sf = new SessionHandle();

$register_data = $sf->GetRegisterData();

print_r($register_data);
//echo '<br>success';

?>