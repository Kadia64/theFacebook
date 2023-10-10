<?php 

$img = $sql->GetValueByEmail('profile_image', 'account_info', $email);

// 10 min | 600 seconds
$cachedTime = 600;

header('Cache-Control: public, max-age=' . $cachedTime);
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $cachedTime) . ' GMT');
header('Last-Modified: ' . gmdate('D, d, M Y H:i:s', time()) . ' GMT');

return $img;
?>