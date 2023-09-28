<?php 
$path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/files.php';
class SessionHandle {
    public $files;
    public function __construct() {
        $this->files = new FileHandle();        
    }
    public function GetRegisterData() {
        return [
            'first-name' => $_POST['first-name'],
            'last-name' => $_POST['last-name'],
            'sex' => $_POST['sex'],
            'birthday' => $_POST['birthday'],
            'home-address' => $_POST['home-address'],
            'home-town' => $_POST['home-town'],
            'highschool' => $_POST['highschool'],
            'mobile' => $_POST['mobile'],
            'website' => $_POST['website'],
            'looking-for' => $_POST['looking-for'],
            'interested-in' => $_POST['interested-in'],
            'relationship-status' => $_POST['relationship-status'],
            'political-views' => $_POST['political-views'],
            'interests' => $_POST['interests'],
            'favorite-music' => $_POST['favorite-music'],
            'favorite-movies' => $_POST['favorite-movies'],
            'about-me' => $_POST['about-me']
        ];
    }
    public function Redirect($page, $type = 'PHP') {
        $root = $this->files->_BASE_PATH_;
        if ($type == 'PHP') {
            header('Location: ../' . $page);
        } else if ($type = 'js') {
            echo "<script>window.location.href = \"../" . $page . "\";</script>";
        }
    }
    public function CookiesEnabled() {
        setcookie('cookies_enabled', 'test', time() + 3600, '/');
        if (isset($_COOKIE['cookies_enabled'])) {
            return true;
        } else {
            return false;
        }
    }    
}
?>