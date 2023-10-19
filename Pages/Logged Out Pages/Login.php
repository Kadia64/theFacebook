<?php 
    $_path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
    require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/content.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/session-functions.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/files.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/sql-functions.php';
    $content = new Content();
    $styles = new Styles();
    $pages = new PageData();
    $sh = new SessionHandle();
    $ftp = new FTPHandle();
    session_start();
    session_unset();
    $sh->CheckTraversal();
?>
<!DOCTYPE html>
<html lang="en">
<head>    
    <script type="module">
        import { CheckCookiesEnabled } from '../../client-functions.js'
        var cookiesEnabled = CheckCookiesEnabled('Pages/Logged Out Pages/Login.php');
    </script>
    <?php $content->Startup('Login'); ?>
    <?php $styles->LoginStyle(); ?>
</head>
<body>
    <div class="main-pagebox">
        <?php $content->TopContent(false); ?>
        <div class="main-page-flexbox">
            <?php $content->LeftLoginLinks(); ?>
            <div class="right-main-window">
                <h4>[ Login ]</h4>
                <div class="login-page-window">
                    <div class="login-page-content">                        
                        <form method="POST" action="<?php echo PageData::ROOT . 'Server Functions/login-user.php?prev-page=Pages/Logged Out Pages/Login.php'?>" class="login-page-form">
                            <div>
                                <div>
                                    <label for="email">Email:</label>
                                </div>
                                <div>
                                    <input type="text" id="email" name="email" class="email-input">
                                </div>
                                <div>
                                    <label for="password">Password:</label>
                                </div>
                                <div>
                                    <input type="password" id="password" name="password" class="password-input">
                                </div>
                            </div>
                            <div class="login-buttons">
                                <div>
                                    <input type="submit" id="login" name="login" value="Login" class="login-button">
                                </div>
                                <div>
                                    <?php $content->Link('Register', $pages->REGISTER_USER, PageData::BUTTON_CLASS); ?>
                                </div>
                            </div>
                        </form>
                        <div class="login-page-text">
                            <p>If you have forgotton your password, click here to reset it.</p>
                        </div>                        
                    </div>
                </div>
            </div>            
        </div>
        <?php $content->BottomContent(0); ?>        
    </div>
</body>
</html>