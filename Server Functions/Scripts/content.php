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
                    <img src="../../Images/thefacebook-left.jpg">
                </div>
                <div class="main-top-content">
                    <img src="../../Images/thefacebook-logo.jpg">
                    <br>
                    <div>
                        <a href="">login</a>
                        <a href="">register</a>
                        <a href="">about</a>                    
                    </div>          
                </div>            
            </div>
        ';       
    }
    public function BottomContent() { 
        echo '
            <div class="bottom-content">
                <a href="">about</a>
                <a href="">contact</a>
                <a href="">jobs</a>
                <a href="">faq</a>
                <a href="">terms</a>
                <a href="">policy</a>
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
                        <a href="">register</a>
                    </div>
                </form>
            </div>
        ';            
    }
    public function LeftLoginLinks() { }
}
class Styles {
    public function LoginStyle() { }
    public function RegisterAboutUserStyle() { }
    public function RegisterUserStyle() { }
    public function WelcomeStyle() { }
    public function EnableCookiesStyle() { }
    public function MainProfilePageStyle() { }    
}
?>