<?php 
class Content {
    public function WindowText($text) {
        echo '
            <div class="window-text">
                <span>' . $text . '</span>
            </div>
        ';
    }
    public function Startup($title) {
        echo '
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="icon" type="image/png" href="/Projects/TheFacebook/Git/theFacebook/Images/facebook-icon.ico">
            <link rel="stylesheet" href="/Projects/TheFacebook/Git/theFacebook/main-style.css">
            <title>[ theFacebook ] ' . $title . '</title>
        ';
    }
    public function TopContent() { 
        echo '
            <div class="main-top-box">
                <div class="main-top-content">
                    <img src="' . PageData::ROOT . '/Images/thefacebook-left.jpg">
                </div>
                <div class="main-top-content">
                    <img src="' . PageData::ROOT . '/Images/thefacebook-logo.jpg">
                    <br>
                    <div>
                        <a href="' . PageData::ROOT . '/Pages/Logged Out Pages/Login.php">login</a>
                        <a href="' . PageData::ROOT . '/Pages/Logged Out Pages/RegisterUser.php">register</a>
                        <a href="' . PageData::ROOT . '/Pages/Annual Pages/About.php">about</a>
                    </div>          
                </div>            
            </div>
        ';       
    }
    public function BottomContent() { 
        echo '
            <div class="bottom-content">
                <a href="' . PageData::ROOT . '/Pages/Annual Pages/About.php">about</a>
                <a href="' . PageData::ROOT . '/Pages/Annual Pages/ContactUs.php">contact</a>                
                <a href="' . PageData::ROOT . '/Pages/Annual Pages/JobDescriptions.php">jobs</a>                
                <a href="' . PageData::ROOT . '/Pages/Annual Pages/faqPage.php">faq</a>
                <a href="' . PageData::ROOT . '/Pages/Annual Pages/TermsAndConditions.php">terms</a>
                <a href="' . PageData::ROOT . '/Pages/Annual Pages/PrivacyPolicy.php">policy</a>
                <div>
                    <p>a Mark Zuckerberg production</p>
                    <p>Thefacebook © 2004</p>
                </div>
            </div>
        ';   
    }
    public function LeftLoginForm() {
        echo '
            <div class="left-login-box">
                <form method="POST" action="" class="left-login-form">
                    <div class="left-login-box-input">
                        <label for="left-email" class="left-login-label">Email:</label>
                        <input type="email" id="left-email" name="left-email" class="left-login-email-input" required>
                        <label for="left-password" class="left-login-label">Password:</label>
                        <input type="password" id="left-password" name="left-password" class="left-login-password-input">
                    </div>
                    <div class="left-login-buttons">
                        <input type="submit" name="left-login-button" value="login" class="left-login-button">
                        <a href="' . PageData::ROOT . '/Pages/Logged Out Pages/RegisterUser.php">register</a>
                    </div>
                </form>
            </div>
        ';            
    }
    public function LeftLoginLinks() { }
    public function Link($text, $page, $class = '') {
        $output = '<a href="' . $page . '"';
        if ($class != '') {
            $output = $output . ' class="' . $class . '">';
        }
        $output = $output . $text . '</a>';
        echo $output;
    }
}
class Styles {
    public function LoginStyle() { }
    public function RegisterAboutUserStyle() { }
    public function RegisterUserStyle() { }
    public function WelcomeStyle() {
        echo '
            <style>
                .welcome-page-window {
                    width: calc(var(--standard-page-width) - 240px);
                    margin: 0 auto;
                }
                .welcome-page-buttons {
                    text-align: center;
                    padding-bottom:  10px;
                }
                .welcome-page-buttons a {
                    font-family: var(--font);
                    font-size: var(--content-font-size);
                }
                .welcome-page-content ul {
                    margin: -10px 0px 0px -15px;
                }
                .welcome-page-content p,
                .welcome-page-content ul li {
                    font-family: var(--font);
                    font-size: var(--content-font-size);
                }
            </style>
        ';
    }
    public function EnableCookiesStyle() { }
    public function MainProfilePageStyle() { }
}
class PageData {
    public const ROOT = '/Projects/TheFacebook/Git/theFacebook/';
    public const BUTTON_CLASS = 'link-button';
    public $REGISTER_USER;
    public $WELCOME;
    public $LOGIN;

    public function __construct() {
        $this->REGISTER_USER = PageData::ROOT . '/Pages/Logged Out Pages/RegisterUser.php';
        $this->LOGIN = PageData::ROOT . '/Pages/Logged Out Pages/Login.php';
        $this->WELCOME = PageData::ROOT . '/Pages/Logged Out Pages/Login.php';
    }
}
?>