<?php 
    $path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
    require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/content.php';
    $content = new Content();
    $styles = new Styles();
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>    
    <?php $content->Startup('Welcome'); ?>
    <?php $styles->WelcomeStyle(); ?>    
    <style>

    </style>
</head>
<body>
    <div class="main-pagebox">
        
    </div>
</body>
</html>