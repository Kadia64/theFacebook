<?php 
$path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/data-handle.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/files.php';
class SessionHandle {
    public $_30dayExpiration;
    public $_10minExpiration;
    public $_10pminExpiration;
    public $_5minExpiration;
    private $files;
    public function __construct() {
        $this->_30dayExpiration = time() + (30 * 24 * 60 * 60);
        $this->_10minExpiration = time() + (10 * 61);
        $this->_10pminExpiration = time() + (10 * 60);
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
        if (isset($_COOKIE['user-token'])) {
            setcookie('user-token', '', 0, '/');
        }
        $obj = new class($username, $email) {
            public $username;
            public $email;
            public function __construct($username, $email) {
                $this->username = $username;
                $this->email = $email;
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
        setcookie('user-data', json_encode($user_data), $this->_10pminExpiration, '/');
        setcookie('account-attributes', json_encode($attributes), $this->_10minExpiration, '/');
    }
    public function SetLogoutCookie($dbID) {
        $obj = array(
            'id' => $dbID
        );
        setcookie('logout', json_encode($obj), $this->_30dayExpiration, '/');
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
        $result = mysqli_query($sql->connection, 
           "SELECT $columns FROM account_info AS ai
            JOIN personal_info AS p ON ai.personal_info_id = p.personal_info_id
            JOIN account_stats AS stats ON ai.account_stats_id = stats.account_stats_id
            WHERE ai.email = '$email';
        ");
        $assoc_array = mysqli_fetch_assoc($result);
        return $assoc_array;
    }
    public function StartUserSession($sql, $dbID, $sessionID) {        
        mysqli_query($sql->connection, "INSERT INTO session_data (session_data_id, session_id, logged_in) VALUES ($dbID, '$sessionID', NOW());");
    }
    public function EndUserSession($sql, $dbID) {
        mysqli_query($sql->connection, "DELETE FROM session_data WHERE session_data_id = $dbID;");
    }
    public function SessionExpired($sql) {

    }
    public function GetUserSessionDataByEmail($sql, $email) {
        $id = $sql->GetIDByEmail($email);        
        $result = mysqli_query($sql->connection, "SELECT * FROM `session_data` WHERE session_data_id = $id;");
        $assoc_array = mysqli_fetch_assoc($result);
        return $assoc_array;
    }
}
?>