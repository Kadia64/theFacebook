<?php 
    $path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
    require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/content.php';
    $content = new Content();
    $styles = new Styles();
    $pages = new PageData();
    session_start();
    $link = $_GET['prev-page'];
?>
<!DOCTYPE html>
<html lang="en">
<head>    
    <?php $content->Startup('Template'); ?>
    <?php $styles->EnableCookiesStyle(); ?>    
</head>
<body>
    <div class="main-pagebox">
        <?php $content->TopContent(); ?>
        <div class="main-page-flexbox">
            <?php $content->LeftLoginForm(); ?>
            <div class="right-main-window">
                <?php $content->WindowText('Enable Cookies'); ?>
                <div class="enable-cookies-page-window">
                    <div class="enable-cookies-page-content">
                        <p>Our website requires the use of cookies to function properly. Cookies are small text files that are stored on your device and allow us to remember your preferences and personalize your experience. Please enable cookies in your browser settings to continue using our website.</p>
                        <div class="enable-cookies-page-link">
                            <a href="<?php echo PageData::ROOT . $link; ?>">Cookies Enabled!</a>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
        <?php $content->BottomContent(); ?>        
    </div>
</body>
</html>