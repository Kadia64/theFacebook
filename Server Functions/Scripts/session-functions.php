<?php 
$path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/data-handle.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/files.php';
class SessionHandle {
    public $_10minExpiration;
    public $_5minExpiration;
    private $files;
    public function __construct() {
        $this->_10minExpiration = time() + (10 * 60);
        $this->_5minExpiration = time() + (5 * 60);
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
        $root = $this->files->_SERVER_PATH_; 
        if ($type == 'PHP') {
            header('Location: ' . $root . $page);
        } else if ($type = 'js') {
            echo "<script>window.location.href = \"" . $root . $page . "\";</script>";
        }
    }
    public function CheckTraversal() {
        if (isset($_COOKIE['user-token'])) {            
            $this->Redirect('Pages/User Pages/MainProfilePage.php?return-status=traverse');
        }
    }
    public function CookiesEnabled() {
        setcookie('cookies_enabled', 'test', time() + (1 * 60), '/');
        if (isset($_COOKIE['cookies_enabled'])) {
            return true;
        } else {
            return false;
        }
    }
    public function SetUserTokenCookie($username, $email) {
        if (!$this->CookiesEnabled()) return;
        if (isset($_COOKIE['user-token'])) {
            setcookie('user-token', '', 0, '/');
        }
        $obj = new class($username, $email) {
            public $Username;
            public $Email;
            public function __construct($username, $email) {
                $this->Username = $username;
                $this->Email = $email;
            }
        };
        setcookie('user-token', json_encode($obj), $this->_10minExpiration, '/');
    }
    public function SetUserDataCookie($user_data) {
        if (isset($_COOKIE['user-data'])) {
            setcookie('user-data', '', 0, '/');
        }
        $attributes = array(
            'profile-image' => true
        );
        setcookie('user-data', json_encode($user_data), $this->_10minExpiration, '/');
        setcookie('account-attributes', json_encode($attributes), $this->_10minExpiration, '/');
    }
    public function ResetSessionCookies($username, $email, $user_data) {
        setcookie('user-token', '', 0, '/');
        setcookie('user-data', '', 0, '/');
        $this->SetUserTokenCookie($username, $email);
        $this->SetUserDataCookie($user_data);
    }
    public function ParseUserDataCookie($sql, $email) {
        $columns = array('ai.first_name', 'ai.last_name', 'ai.full_name', 'stats.member_since', 'stats.last_update', 'ai.username', 'ai.email', 'ai.mobile', 'p.birthday', 'p.sex', 'p.home_address', 'p.home_town', 'p.highschool', 'p.education_status', 'p.website', 'p.looking_for', 'p.interested_in', 'p.relationship_status', 'p.political_views', 'p.interests', 'p.favorite_music', 'p.favorite_movies', 'p.about_me');
        $columns = implode(', ', $columns);        
        $query = "
            SELECT $columns FROM account_info AS ai
            JOIN personal_info AS p ON ai.personal_info_id = p.personal_info_id
            JOIN account_stats AS stats ON ai.account_stats_id = stats.account_stats_id
            WHERE ai.email = '$email';
        ";
        
        $result = mysqli_query($sql->connection, $query);
        $assoc_array = mysqli_fetch_assoc($result);
        return $assoc_array;
    }
}
?>