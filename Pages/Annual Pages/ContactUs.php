<?php 
    $path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
    require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/content.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/styles.php';
    $content = new Content();
    $styles = new Styles();
    $pages = new PageData();
    session_start();

    $logged_in = $_GET['logged-in'] ?? false;
    if (!isset($_COOKIE['user-token'])) {
        $logged_in = 0;
    }
    $home_link = PageData::ROOT . 'Pages/';
?>
<!DOCTYPE html>
<html lang="en">
<head>    
    <?php $content->Startup('Contact Us'); ?>
    <?php $styles->ContactUsPageStyle(); ?>
</head>
<body>
    <div class="main-pagebox">
        <?php $content->TopContent($logged_in); ?>
        <div class="main-page-flexbox">
            <?php 
                if ($logged_in) {
                    $home_link .= 'User Pages/UserHomePage.php';
                    $content->LeftProfileLinks();
                } else {
                    $home_link .= 'Logged Out Pages/Welcome.php';
                    $content->LeftLoginForm('Pages/Annual Pages/ContactUs.php'); 
                }
            ?>
            <div class="right-main-window">
                <?php $content->WindowText('Contact Us'); ?>
                <h4>[ Contact Us ]</h4>
                <div class="contact-us-page-window">
                    <div class="contact-us-page-content">
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('Email'); ?>
                            <div class="box1-grid">
                                <div>
                                    <p><b>Information/Support:</b></p>
                                </div>
                                <div>
                                    <p><a href="">info@thefacebook.com</a></p>
                                </div>
                                <div>
                                    <p><b>Suggestions/Requests:</b></p>
                                </div>
                                <div>
                                    <p><a href="">suggest@thefacebook.com</a></p>
                                </div>
                                <div>
                                    <p><b>Business Development:</b></p>
                                </div>
                                <div>
                                    <p><a href="">business@thefacebook.com</a></p>
                                </div>
                                <div>
                                    <p><b>Press Inquiries:</b></p>
                                </div>
                                <div>
                                    <p><a href="">press@thefacebook.com</a></p>
                                </div>
                                <div>
                                    <p><b>Advertising:</b></p>
                                </div>
                                <div>
                                    <p><a href="">advertise@thefacebook.com</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="contact-us-page-back-button">
                            <a href="<?php echo $home_link; ?>">Home</a>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
        <?php $content->BottomContent($logged_in); ?>        
    </div>
</body>
</html>