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
                <?php $content->WindowText('Welcome to Thefacebook!'); ?>
                <h4>[ Welcome to Thefacebook ]</h4>
                <div class="welcome-page-window">
                    <div class="welcome-page-content">
                        <p>Thefacebook is an online directory that connects people through social networks at colleges</p>
                        <p>We have opened up Thefacebook for popular consumption at <b>Harvard University.</b></p>
                        <p>You can use Thefacebook to:</p>
                        <ul>
                            <li>Search for people at your school</li>
                            <li>Find out who are in your classes</li>
                            <li>Look up your friends' friends</li>
                            <li>See a visualization of your social network</li>
                        </ul>
                        <p>To get started, click below to register. If you have already registered, you can log in.</p>                        
                    </div>
                    <div class="welcome-page-buttons">
                        <a href="" class="link-button">Register</a>
                        <a href="" class="link-button">Login</a>
                    </div>
                </div>
            </div>            
        </div>

        <!-- BOTTOM CONTENT -->
        <?php $content->BottomContent(); ?>        
        <!-- BOTTOM CONTENT -->

    </div>
</body>
</html>