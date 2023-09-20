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
    public function LeftLoginLinks() {
        echo '
            <div class="left-login-links">
                <div class="left-login-flexbox">
                    <div>
                        <a href="' . PageData::ROOT . '/Pages/Logged Out Pages/Welcome.php">[ main ]</a>
                    </div>
                    <div>
                        <a href="' . PageData::ROOT . '/Pages/Logged Out Pages/Login.php">[ login ]</a>
                    </div>
                    <div>
                        <a href="' . PageData::ROOT . '/Pages/Logged Out Pages/RegisterUser.php">[ register ]</a>
                    </div>
                </div>
            </div>
        ';
    }
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
    public function LoginStyle() {
        echo '
            <style>
                .login-page-window {
                    width: calc(var(--standard-page-width) - 240px);
                    margin: 0 auto;
                }
                .login-page-content {
                    font-family: var(--font);
                    font-size: var(--content-font-size);
                    display: flex;
                    flex-direction: column;            
                }
                .login-page-form div {
                    width: 280px;
                    margin: 0 auto;
                    flex: 1;
                    display: grid;
                    grid-template-columns: 23% 78%;
                }
                .login-page-form div div {
                    height: 20px;
                }
                .login-page-form div div:nth-child(odd) {
                    margin-top: 2px;
                }
                .login-page-form div div label {
                    font-family: var(--font);
                    font-size: var(--content-font-size);
                    padding-top: -10px;
                }
                .email-input,
                .password-input {
                    font-family: var(--font);
                    font-size: var(--content-font-size);
                    background-color: var(--input-color);            
                    border: 1px solid black;
                    width: 180px;            
                }
                .login-buttons {
                    margin: 0 auto!important;            
                    margin-top: 10px!important;
                    width: 100px!important;
                    display: flex;
                    flex-direction: column;
                    align-items: center;    
                    gap: 50px;        
                }
                .login-buttons div {
                    flex: 1;
                }
                .login-buttons div input {
                    font-family: var(--font);
                    font-size: var(--content-font-size);
                    color: white;
                    background-color: var(--button-color);
                    border: 1.5px ridge;
                }
                .login-buttons div a {
                    height: 14.5px;
                }
                .login-page-text {
                    margin: 0 auto;
                    flex: 1;
                }
            </style>
        ';
     }
    public function RegisterAboutUserStyle() { }
    public function RegisterUserStyle() {
        echo '
            <style>
                .register-page-window {
                    width: calc(var(--standard-page-width) - 200px);
                    margin: 0 auto;
                }
                .register-page-content p,
                .register-page-content label {
                    font-family: var(--font);
                    font-size: var(--content-font-size);
                }
                .register-page-middle {
                    width: calc(var(--standard-page-width) - 360px);
                    margin: 0 auto;
                }
                .register-page-form {            
                
                }
                .register-page-grid {
                    display: grid;
                    grid-template-columns: 40% 60%;
                }
                .register-page-grid div {
                    height: 20px;
                }
                .register-username,
                .register-status,
                .register-email,
                .register-password {
                    font-family: var(--font);
                    font-size: var(--content-font-size);
                    background-color: var(--input-color);
                    border: 1px solid black;
                }
                .register-username,
                .register-email,
                .register-password {
                    width: 180px;
                }
                .register-status {
                    width: 130px;
                }
                .register-page-checkbox {
                    display: flex;
                    gap: 5px;
                    margin-bottom: -12px;
                }
                .register-page-checkbox p {
                    flex: 11;            
                }
                .register-page-checkbox input {
                    flex: 0.5;
                }
                .register-page-password {
                    display: flex;
                    margin-left: 8px;
                }
                .register-page-password p:first-child {
                    flex: 0.5;
                    margin-top: 15px;
                    font-weight: bold;
                }
                .register-page-password p:last-child {
                    flex : 10;
                }
                .register-page-button {
                    text-align: center;
                    padding-bottom: 10px;
                }
                .register-page-button input {
                    font-family: var(--font);
                    font-size: var(--content-font-size);
                    color: white;
                    background-color: var(--button-color);
                    border: 1.5px ridge;
                    padding: 2px 4px 2px 4px
                }
            </style>
        ';
    }
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
    public const LINK_CLASS = 'standard-link';
    public const BUTTON_CLASS = 'link-button';    
    public $LOGIN;
    public $REGISTER_ABOUT_USER;
    public $REGISTER_USER;
    public $WELCOME;

    public $ABOUT;
    public $CONTACT_US;
    public $FAQ_PAGE;
    public $PRIVACY_POLICY;
    public $TERMS_AND_CONDITIONS;

    public function __construct() {
        $this->LOGIN = PageData::ROOT . '/Pages/Logged Out Pages/Login.php';
        $this->REGISTER_ABOUT_USER = PageData::ROOT . '/Pages/Logged Out Pages/RegisterAboutUser.php';
        $this->REGISTER_USER = PageData::ROOT . '/Pages/Logged Out Pages/RegisterUser.php';
        $this->WELCOME = PageData::ROOT . '/Pages/Logged Out Pages/Login.php';
        $this->ABOUT = PageData::ROOT . '/Pages/Annual Pages/About.php';
        $this->CONTACT_US = PageData::ROOT . '/Pages/Annual Pages/ContactUs.php';
        $this->FAQ_PAGE = PageData::ROOT . '/Pages/Annual Pages/faqPage.php';
        $this->PRIVACY_POLICY = PageData::ROOT . '/Pages/Annual Pages/PrivacyPolicy.php';
        $this->TERMS_AND_CONDITIONS = PageData::ROOT . '/Pages/Annual Pages/TermsAndConditions.php';
    }
}
?>