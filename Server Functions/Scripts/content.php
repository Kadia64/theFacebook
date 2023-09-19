<?php 
class Content {

    public function Startup($title) {
        echo '
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="icon" type="image/png" href="/Projects/TheFacebook/Git/theFacebook/Images/facebook-icon.ico">
            <link rel="stylesheet" href="/Projects/TheFacebook/Git/theFacebook/main-style.css">
            <title>[ theFacebook ] ' . $title . '</title>
        ';
    }
    public function TopContent() { }
    public function BottomContent() { }
    public function LeftLoginForm() { }
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