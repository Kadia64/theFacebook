<?php 
class Content {
    public function WindowText($text, $right_text = null, $get = false) {
        if ($right_text != null)  {
            $right_text = '<span class="window-text-right">' . $right_text . '</span>';
        }        
        $data = '
            <div class="window-text">
                <span class="window-text-left">' . $text . '</span>
                ' . $right_text . '
            </div>
        ';
        if (!$get) {
            echo $data;
        } else {
            return $data;
        }
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
    public function TopContent($logged_in) { 
        $links = null;    
        if (!$logged_in) {
            $links = '        
                <a href="' . PageData::ROOT . 'Pages/Logged Out Pages/Login.php">login</a>
                <a href="' . PageData::ROOT . 'Pages/Logged Out Pages/RegisterUser.php">register</a>
                <a href="' . PageData::ROOT . 'Pages/Annual Pages/About.php">about</a>
            ';
        } else {
            $links = '
                <a href="">home</a>
                <a href="">search</a>
                <a href="">global</a>
                <a href="">social net</a>
                <a href="">invite</a>
                <a href="">faq</a>
                <a href="' . PageData::ROOT . 'Server Functions/logout.php">logout</a>
            ';
        }        
        echo '
            <div class="main-top-box">
                <div class="main-top-content">
                    <img src="' . PageData::ROOT . 'Images/thefacebook-left.jpg">
                </div>
                <div class="main-top-content">
                    <img src="' . PageData::ROOT . 'Images/thefacebook-logo.jpg">
                    <br>
                    <div>
                        ' . $links . '
                    </div>          
                </div>            
            </div>
        ';       
    }
    public function BottomContent() { 
        echo '
            <div class="bottom-content">
                <a href="' . PageData::ROOT . 'Pages/Annual Pages/About.php">about</a>
                <a href="' . PageData::ROOT . 'Pages/Annual Pages/ContactUs.php">contact</a>                
                <a href="' . PageData::ROOT . 'Pages/Annual Pages/JobDescriptions.php">jobs</a>                
                <a href="' . PageData::ROOT . 'Pages/Annual Pages/faqPage.php">faq</a>
                <a href="' . PageData::ROOT . 'Pages/Annual Pages/TermsAndConditions.php">terms</a>
                <a href="' . PageData::ROOT . 'Pages/Annual Pages/PrivacyPolicy.php">policy</a>
                <div>
                    <p>a Mark Zuckerberg production</p>
                    <p>Thefacebook © 2004</p>
                </div>
            </div>
        ';   
    }
    public function LeftLoginForm($url) {
        echo '
            <div class="left-login-box">
                <form method="POST" action="' . PageData::ROOT . 'Server Functions/login-user.php?prev-page=' . $url . '" class="left-login-form">
                    <div class="left-login-box-input">
                        <label for="left-email" class="left-login-label">Email:</label>
                        <input type="email" id="left-email" name="email" class="left-login-email-input" required>
                        <label for="left-password" class="left-login-label">Password:</label>
                        <input type="password" id="left-password" name="password" class="left-login-password-input">
                    </div>
                    <div class="left-login-buttons">
                        <input type="submit" name="left-login-button" value="login" class="left-login-button">
                        <a href="' . PageData::ROOT . 'Pages/Logged Out Pages/RegisterUser.php">register</a>
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
                        <a href="' . PageData::ROOT . 'Pages/Logged Out Pages/Welcome.php">[ main ]</a>
                    </div>
                    <div>
                        <a href="' . PageData::ROOT . 'Pages/Logged Out Pages/Login.php">[ login ]</a>
                    </div>
                    <div>
                        <a href="' . PageData::ROOT . 'Pages/Logged Out Pages/RegisterUser.php">[ register ]</a>
                    </div>
                </div>
            </div>
        ';
    }
    public function LeftProfileLinks() {
        echo '
            <div class="left-profile-links">
                <div class="left-profile-links-search">
                    <form method="" action="">
                        <div class="left-profile-links-search-bar">
                            <input type="text">
                        </div>
                        <div class="left-profile-links-button">
                            <div>
                                <label for="search-submit">quick search</label>
                            </div>
                            <div>
                                <input type="submit" id="search-submit" name="search" value="go">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="left-profile-links-box">
                    <ul>
                        <li><a href="">My Profile</a><a href="">[ edit ]</a></li>
                        <li><a href="">My Friends</a></li>
                        <li><a href="">My Groups</a></li>
                        <li><a href="">My Messages</a></li>
                        <li><a href="">My Account</a></li>
                        <li><a href="">My Privacy</a></li>
                    </ul>
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
    public function Alert($text) {
        echo '<script>alert("' . $text . '");</script>';
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
                    row-gap: 3px;
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
    public function RegisterAboutUserStyle() {
        echo '
            <style>
                .register-about-page-window {
                    width: calc(var(--standard-page-width) - 240px);
                    margin: 0 auto;
                }
                .register-about-content {
                }
                .register-about-page-middle {
                    width: calc(var(--standard-page-width) - 270px);
                    margin: 0 auto;
                }
                .register-about-page-text {
                    font-family: var(--font);
                    font-size: var(--content-font-size);
                    text-align: center;
                }
                .register-form-grid {
                    display: grid;
                    grid-template-columns: 40% 60%;
                    column-gap: 15px;
                    row-gap: 4px;
                    margin: 0 auto;
                    width: 290px;
                }
                .register-form-grid label {
                    font-family: var(--font);
                    font-size: var(--content-font-size);
                }
                .register-form-grid input,
                .register-form-grid select,
                .register-form-grid textarea {
                    font-family: var(--font);
                    font-size: var(--content-font-size);
                    background-color: var(--input-color);
                    border: 1px solid black;
                    width: 130px;
                }
                .register-form-grid textarea {
                    resize: none;
                    height: 42px;
                    width: 150px;
                }        
                .register-button {            
                    text-align: center;
                    margin-top: 10px;
                    margin-bottom: 10px;
                }
                .register-button input {
                    font-family: var(--font);
                    font-size: var(--content-font-size);
                    background-color: var(--button-color);
                    color: white;
                    border: 1.5px ridge;
                    padding: 4px;
                }
            </style>
        ';
    }
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
    public function EnableCookiesStyle() {        
        echo '
            <style>
                .enable-cookies-page-window {
                    width: calc(var(--standard-page-width) - 240px);
                    margin: 0 auto;
                }
                .enable-cookies-page-content {
                    font-family: var(--font);
                    font-size: var(--content-font-size);
                }
                .enable-cookies-page-link {
                    width: 100px;
                    margin: 0 auto;
                    padding-top: 10px;
                    padding-bottom: 20px;
                }
                .enable-cookies-page-link a {
                    color: white;
                    background-color: var(--button-color);
                    text-decoration: none;
                    border: 1.5px ridge;
                    padding: 3px;
                }
            </style>
        ';
    }
    public function MainProfilePageStyle() {
        echo '
            <style>
                .main-profile-page-window {
                    width: calc(var(--standard-page-width) - 180px);
                    margin: 0 auto;
                }
                .main-profile-page-flexbox {
                    display: flex;
                    padding: 10px;
                    width: 480px;
                    margin: 0 auto;
                    gap: 10px;
                }
                .main-profile-page-left {         
                    flex: 1.35;
                    display: flex;
                    flex-direction: column;
                    gap: 10px;
                }
                .main-profile-page-right {
                    flex: 2;
                }
                .window-content:first-child {
                    overflow: hidden;    
                }
                .profile-image-window img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
                .profile-links-window {
                    height: 78px;
                }
                .profile-links-window ul {
                    margin-left: -40px;
                    margin-top: 0px;
                    list-style-type: none;
                }
                .profile-links-window ul li:nth-child(odd):not(.profile-links-window ul li:first-child) {
                    border-top: 1px solid var(--darkblue);
                }
                .profile-links-window ul li:first-child {
                    border-bottom: 1px solid var(--darkblue);
                }
                .profile-links-window ul li:last-child {
                    border-top:  1px solid var(--darkblue);
                }
                .profile-links-window ul li a {
                    font-family: var(--font);
                    font-size: calc(var(--font-size) + 1.5px);
                    color: var(--lightblue);
                    text-decoration: none;
                    margin-left: 4px;
                }
                .profile-links-window ul li a:hover {
                    color: var(--hover-lightblue);
                    text-decoration: underline;
                }
                .empty-connection-window,
                .empty-friends-window {
                    text-align: center;
                }
                .window-text {
                    text-align: left!important;
                }
                .empty-connection-window p,
                .empty-friends-window p {
                    font-family: var(--font);
                    font-size: var(--font-size);
                    padding: 10px;
                }
                .main-profile-page-info-grid {
                    margin: 1px 9.5px 10px 0px;
                    display: grid;
                    grid-template-columns: 45% 35%;
                    column-gap: 10px;
                    row-gap: 2px;
                    width: 265px;
                    float: right;
                    word-wrap: break-word!important;
                }
                .main-profile-page-info-grid div {
                    width: 120px;
                }
                .main-profile-page-info-grid p {
                    font-family: var(--font);
                    font-size: 10.5px;                /* ATTRIBUTES */
                    display: inline;            
                }
                .main-profile-update-grid {
                    display: grid;
                    grid-template-columns: 45% 35%;
                    column-gap: 25px;
                    row-gap: 4px;
                    width: 240px!important;
                }
                .main-profile-update-grid div {
                    width: 120px!important;
                }
                .profile-update-input {
                    margin-left: -10px;
                }
                .profile-update-input input,
                .profile-update-input select,
                .profile-update-input textarea {
                    font-family: var(--font);
                    font-size: 10.5px;
                    background-color: var(--input-color);
                    border: 1px solid black;
                }
                .profile-update-input select {
                    width: 120px;
                }
                .profile-update-input textarea {
                    resize: none;
                    height: 42px;
                    width: 135px;
                }
                .profile-update-info-button {
                    text-align: center;
                    margin: 10px 0px 0px 65px;                    
                }
                .profile-update-info-button input {
                    background-color: var(--button-color);
                    font-family: var(--font);
                    font-size: var(--font-size);
                    color: white;
                    border: 1.5px ridge;
                    padding: 3px;
                }
            </style>
        ';
    }
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