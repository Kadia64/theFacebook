<?php 
$path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/data-handle.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/files.php';
class SessionHandle {
    public $_30dayExpiration;
    public $_10minExpiration;
    public $_5minExpiration;
    public $sessionExpirationTime;
    private $files;
    private $ServerConfig;    
    public function __construct() {
        date_default_timezone_set('America/Chicago');
        $this->files = new FileHandle();
        $this->ServerConfig = $this->files->ServerConfig;
        $this->sessionExpirationTime = $this->ServerConfig->{"Server-Configuration"}->{"Sessions-Length-Min"};
        $this->_30dayExpiration = time() + (30 * 24 * 60 * 60);
        $this->_10minExpiration = time() + (10 * 60);
        $this->_5minExpiration = time() + (5 * 60);
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
    public function SetUserDataCookie($user_data, $attributes, $default_profile_image = true) {
        if (isset($_COOKIE['user-data'])) {
            setcookie('user-data', '', 0, '/');
        }        
        setcookie('user-data', json_encode($user_data), $this->_10minExpiration, '/');
        setcookie('account-attributes', json_encode($attributes), $this->_10minExpiration, '/');
    }
    public function SetLogoutCookie($dbID) {
        $obj = array(
            'id' => $dbID
        );
        setcookie('logout', json_encode($obj), $this->_30dayExpiration, '/');
    }    
    public function UpdateCookies($sql, $email, $user_data = null, $attributes = null) {
        $_user_data = $user_data == null ? json_decode($_COOKIE['user-data']) : $user_data;
        $_attributes = $attributes == null ? json_decode($_COOKIE['account-attributes']) : $attributes;
        setcookie('user-data', '', 0, '/');
        setcookie('account-attributes', '', 0, '/');
        setcookie('logout', '', 0, '/');
        $this->SetUserDataCookie($_user_data, $_attributes);
        $this->SetLogoutCookie($sql->GetIDByEmail($email));
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
        $time = new DateTime();
        $now_time = $time->format('Y-m-d g:i:s A');
        $time->add(new DateInterval('PT' . $this->sessionExpirationTime . 'M'));
        $new_time = $time->format('Y-m-d g:i:s A');
        mysqli_query($sql->connection, 
           "INSERT INTO session_data (session_data_id, session_id, logged_in, session_expiration) 
            VALUES ($dbID, '$sessionID', '$now_time', '$new_time');
        ");
    }
    public function EndUserSession($sql, $dbID) {
        mysqli_query($sql->connection, "DELETE FROM session_data WHERE session_data_id = $dbID;");
    }
    public function GetUserSessionDataByEmail($sql, $email) {
        $id = $sql->GetIDByEmail($email);        
        $result = mysqli_query($sql->connection, "SELECT * FROM `session_data` WHERE session_data_id = $id;");
        $assoc_array = mysqli_fetch_assoc($result);
        return $assoc_array;
    }
    public function CheckSessionRow($sql, $id) {
        $result = mysqli_query($sql->connection, "SELECT * FROM `session_data` WHERE session_data_id = $id;");
        $assoc_array = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else return false;
    } 
    public function CacheDefaultProfileImage($ftp, $iterator) {
        $root = $_SERVER['DOCUMENT_ROOT'] . '/Projects/TheFacebook/Git/thefacebook/';
        $def_img_path =  $root . 'Images/default-profile-image.jpg';
        $ftp->ChangeDirectory('Cache/Default');
        ftp_put($ftp->ConnectionID, 'def-' . $iterator . '.jpg', $def_img_path, FTP_BINARY);
        $ftp->ParentDirectory(2);
    }
    public function CacheProfileImage($ftp, $sql, $email, $file_name) {
        $result = mysqli_query($sql->connection, "SELECT profile_image FROM account_info WHERE email = '$email';");
        $row = mysqli_fetch_assoc($result);
        $img = $row['profile_image'];

        $stream = fopen('php://temp', 'r+');
        fwrite($stream, $img);
        rewind($stream);

        $ftp->ChangeDirectory('Cache');
        ftp_fput($ftp->ConnectionID, $file_name , $stream, FTP_BINARY);
        ftp_chmod($ftp->ConnectionID, 0755, $file_name);
        $ftp->ParentDirectory(1);

        $parts = explode('.', $file_name);
        $file_name = $parts[0];
        mysqli_query($sql->connection, "UPDATE account_info AS a SET a.profile_image_name = '$file_name' WHERE email = '$email';");
    }
}
?>