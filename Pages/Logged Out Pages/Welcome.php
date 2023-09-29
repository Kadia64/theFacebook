<?php 
    $path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
    require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/content.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/session-functions.php';
    $content = new Content();
    $styles = new Styles();
    $pages = new PageData();
    $sh = new SessionHandle();
    session_start();
    $sh->CheckTraversal();
?>
<!DOCTYPE html>
<html lang="en">
<head>    
    <?php $content->Startup('Welcome'); ?>
    <?php $styles->WelcomeStyle(); ?>
</head>
<body>
    <div class="main-pagebox">
        <?php $content->TopContent(false); ?>
        <div class="main-page-flexbox">
            <?php $content->LeftLoginForm(); ?>
            <div class="right-main-window">
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
                        <?php $content->Link('Register', $pages->REGISTER_USER, PageData::BUTTON_CLASS); ?>
                        <?php $content->Link('Login', $pages->LOGIN, PageData::BUTTON_CLASS); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php $content->BottomContent(); ?>
    </div>
</body>
</html>