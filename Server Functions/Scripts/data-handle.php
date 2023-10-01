<?php 
$path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/files.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/session-functions.php';
class DataHandle {
    public $PersonalInfoAttributes;              // table attributes for the 'personal_info' table
    public $DisplayAccountAttributes;            // displays the account attributes of a user
    public $DisplayUpdateAccountAttributes;      // displays the update account attributes when updating information
    public $DatabaseAccountAttributes;           // the order of values that will be inserted to the database
    public $education_status_choices;
    private $files;
    private $sh;
    public function __construct() {
        $this->files = new FileHandle();
        $this->sh = new SessionHandle();
        $this->PersonalInfoAttributes = [ 'birthday', 'sex', 'home_address', 'home_town', 'highschool', 'education_status', 'website', 'looking_for', 'interested_in', 'relationship_status', 'political_views', 'interests', 'favorite_music', 'favorite_movies', 'about' ];
        $this->DisplayAccountAttributes = [ 'Name', 'Member Since', 'Last Update', 'Username', 'Email', 'Mobile', 'Birthday', 'Sex', 'Home Address', 'Home Town', 'Highschool', 'Education Status', 'Website', 'Looking For', 'Interested In', 'Relationship Status', 'Political Views', 'Interests', 'Favorite Music', 'Favorite Movies', 'About Me' ];
        $this->DisplayUpdateAccountAttributes = [ 'First Name', 'Last Name', 'Username', 'Email', 'Mobile', 'Birthday', 'Sex', 'Home Address', 'Home Town', 'Highschool', 'Education Status', 'Website', 'Looking For', 'Interested In', 'Relationship Status', 'Political Views', 'Interests', 'Favorite Music', 'Favorite Movies', 'About Me' ];
        $this->DatabaseAccountAttributes = [ 'first-name', 'last-name', 'full-name', 'username', 'email', 'mobile', 'birthday', 'sex', 'home-address', 'home-town', 'highschool', 'education-status', 'website', 'looking-for', 'interested-in', 'relationship-status', 'political-views', 'interests', 'favorite-music', 'favorite-movies', 'about-me' ];
        $this->education_status_choices = [ 'Student', 'Grad-Student', 'Alumnus/Alumna', 'Faculty', 'Staff' ];
    }
    public function CreateAccount($sql, $register_data, $account_data) {
        if ($sql->CheckConnection()) {
            $sql->InsertAccountRow($register_data, $account_data);
        } else {
            echo 'not connected to database';
        }
        $this->sh->SetUserTokenCookie($account_data['username'], $account_data['email']);
    }
    public function CheckExistingAccount($sql, $username, $email) {
        $username_flag = false;
        $email_flag = false;
        $usernames = $sql->GetTableFieldData('username', 'account_info');
        $emails = $sql->GetTableFieldData('email', 'account_info');

        for ($i = 0; $i < count($usernames); ++$i) {
            if ($usernames[$i] == $username) {
                $username_flag = true;
            }
        }
        for ($i = 0; $i < count($emails); ++$i) {
            if ($emails[$i] == $email) {
                $email_flag = true;
            }
        }
        if ($username_flag && $email_flag) {
            return 'both';
        } else if ($username_flag) {
            return 'username';
        } else if ($email_flag) {
            return 'email';
        }
    }
    public function Login($sql, $email, $password) {
        $email_list = $sql->GetTableFieldData('email', 'account_info');
        $password_list = $sql->GetTableFieldData('password', 'account_info');
        $inc = 0;        
        for ($i = 0; $i < count($email_list); ++$i) {
            if ($email_list[$i] == $email) {
                ++$inc;
                break;
            }
        }
        for ($i = 0; $i < count($password_list); ++$i) {
            if ($password_list[$i] == $password) {
                ++$inc;
                break;
            }
        }
        if ($inc == 2) {
            return true;
        } else {
            return false;
        }
    }
    public function UpdatePersonalInfo($sql, $old_data, $new_data) {

        print_r($old_data);
        echo '<br><br>';
        print_r($new_data);

        //$sql->UpdateAccountRowByUsername('personal_info', '', '', 'asd');
    }
    public function RandomCharacters($length) {
        $letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $rand = null;
        for ($i = 0; $i < $length; ++$i) {
            $rand .= $letters[mt_rand(0, strlen($letters) - 1)];            
        }
        return $rand;
    }
    public function GetTimeStamp($type) {
        if ($type == 0) {                   // 2023-09-27
            return date('Y-m-d');
        } else if ($type == 1) {            // 2023/09/27
            return date('Y/m/d');           
        } else if ($type == 2) {            // 2023/09/27 094029 am
            return date('Y/m/d His a');  
        } else if ($type == 9) {
            return date('c', time());
        }
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
class UpdateData {
    private $dh;
    public function __construct() {
        $this->dh = new DataHandle();
    }

    public function __update_member_since_() {
        echo $this->dh->GetTimeStamp(2);
    }
    public function __update_member_since_timestamp_() {
        echo $this->dh->GetTimeStamp(2);
    }
    public function __update_last_update_() {
        echo $this->dh->GetTimeStamp(2);
    }
    public function __update_last_update_timestamp_() {
        echo $this->dh->GetTimeStamp(2);
    }
    public function __update_last_login_timestamp_() {
        echo $this->dh->GetTimeStamp(2);
    }
    public function __update_last_logout_timestamp_() {
        echo $this->dh->GetTimeStamp(2);
    }
    public function __update_last_password_attempt_timestamp_() {
        echo $this->dh->GetTimeStamp(2);
    }
    public function __update_last_password_changed_timestamp_() {
        echo $this->dh->GetTimeStamp(2);
    }
}
?>