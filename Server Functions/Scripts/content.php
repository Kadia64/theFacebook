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
                <a href="' . PageData::ROOT . 'Pages/Annual Pages/About.php?logged-in=0">about</a>
            ';
        } else {
            $links = '
                <a href="' . PageData::ROOT . 'Pages/User Pages/UserHomePage.php?return-status=normal">home</a>
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
    public function BottomContent($logged_in) {
        echo '
            <div class="bottom-content">
                <a href="' . PageData::ROOT . 'Pages/Annual Pages/About.php?logged-in=' . $logged_in . '">about</a>
                <a href="' . PageData::ROOT . 'Pages/Annual Pages/ContactUs.php?logged-in=' . $logged_in . '">contact</a>                
                <a href="' . PageData::ROOT . 'Pages/Annual Pages/JobDescriptions.php?logged-in=' . $logged_in . '">jobs</a>                
                <a href="' . PageData::ROOT . 'Pages/Annual Pages/faqPage.php?logged-in=' . $logged_in . '">faq</a>
                <a href="' . PageData::ROOT . 'Pages/Annual Pages/TermsAndConditions.php?logged-in=' . $logged_in . '">terms</a>
                <a href="' . PageData::ROOT . 'Pages/Annual Pages/PrivacyPolicy.php?logged-in=' . $logged_in . '">privacy</a>
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
                        <li><a href="' . PageData::ROOT . 'Pages/User pages/MainProfilePage.php?return-status=normal">My Profile</a><a href="' . PageData::ROOT . 'Pages/User Pages/MainProfilePage.php?return-status=update-profile">[ edit ]</a></li>
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
    public function InfoField($data, $blue = false) {
        $class = null;
        if ($blue) {
            $class = 'class="profile-blue-info"';
        }
        if ($data == '') {
            return '<p ' . $class . '>................................</p>';
        } else {
            return '<p ' . $class . '>' . $data . '</p>';
        }        
    }
    public function Alert($text) {
        echo '<script>alert("' . $text . '");</script>';
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