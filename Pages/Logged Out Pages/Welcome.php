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
        .welcome-page-window {

        }
    </style>
</head>
<body>
    <div class="main-pagebox">

        <!-- TOP CONTENT -->
        <?php $content->TopContent(); ?>
        <!-- TOP CONTENT -->

        <div class="main-page-flexbox">

            <!-- LEFT LOGIN FORM -->
            <?php $content->LeftLoginForm(); ?>            
            <!-- LEFT LOGIN FORM -->

            <div class="right-main-window welcome-page-window">
                <p>testing</p>
            </div>            
        </div>

        <!-- BOTTOM CONTENT -->
        <?php $content->BottomContent(); ?>
        <!-- BOTTOM CONTENT -->

    </div>
</body>
</html>