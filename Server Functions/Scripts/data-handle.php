<?php 
$_path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/files.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/methods.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/session-functions.php';
class DataHandle {
    public $AccountInfoColumn;
    public $PersonalInfoColumn;
    public $PersonalInfoAttributes;              // table attributes for the 'personal_info' table
    public $DisplayAccountAttributes;            // displays the account attributes of a user
    public $DisplayUpdateAccountAttributes;      // displays the update account attributes when updating information
    public $DatabaseAccountAttributes;           // the order of values that will be inserted to the database
    public $education_status_choices;
    public $looking_for_choices;
    private $files;
    private $methods;
    private $sh;
    public function __construct() {
        $this->files = new FileHandle();
        $this->methods = new Methods();
        $this->sh = new SessionHandle();

        $this->AccountInfoColumn = array('username', 'email', 'mobile', 'first_name', 'last_name', 'full_name');
        $this->PersonalInfoColumn = array('birthday', 'sex', 'home_address', 'home_town', 'highschool', 'education_status', 'website', 'looking_for', 'interested_in', 'relationship_status', 'political_views', 'interests', 'favorite_music', 'favorite_movies', 'about_me');
        $this->PersonalInfoAttributes = [ 'birthday', 'sex', 'home_address', 'home_town', 'highschool', 'education_status', 'website', 'looking_for', 'interested_in', 'relationship_status', 'political_views', 'interests', 'favorite_music', 'favorite_movies', 'about_me' ];
        $this->DisplayAccountAttributes = [ 'Name', 'Member Since', 'Last Update', 'Username', 'Email', 'Mobile', 'Birthday', 'Sex', 'Home Address', 'Home Town', 'Highschool', 'Education Status', 'Website', 'Looking For', 'Interested In', 'Relationship Status', 'Political Views', 'Interests', 'Favorite Music', 'Favorite Movies', 'About Me' ];
        $this->DisplayUpdateAccountAttributes = [ 'First Name', 'Last Name', 'Username', 'Email', 'Mobile', 'Birthday', 'Sex', 'Home Address', 'Home Town', 'Highschool', 'Education Status', 'Website', 'Looking For', 'Interested In', 'Relationship Status', 'Political Views', 'Interests', 'Favorite Music', 'Favorite Movies', 'About Me' ];
        $this->DatabaseAccountAttributes = [ 'first-name', 'last-name', 'full-name', 'username', 'email', 'mobile', 'birthday', 'sex', 'home-address', 'home-town', 'highschool', 'education-status', 'website', 'looking-for', 'interested-in', 'relationship-status', 'political-views', 'interests', 'favorite-music', 'favorite-movies', 'about-me' ];
        $this->education_status_choices = [ 'Student', 'Grad-Student', 'Alumnus/Alumna', 'Faculty', 'Staff' ];
        $this->looking_for_choices = [ 'Friendship', 'Dating', 'A Relationship' ];
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
    public function UpdatePersonalInfo($sql, $display_array, $session_array) {
        $new_data = null;
        $old_data = null;
        for ($i = 0; $i < count($this->DisplayUpdateAccountAttributes); ++$i) {
            $new_data[] = $_GET[strtolower(str_replace(' ', '-', $this->DisplayUpdateAccountAttributes[$i]))];
            //echo $new_data[$i] . '<br>';
        }
        array_splice($new_data, 2, 0, $new_data[0] . ' ' . $new_data[1]);

        $k = 3;
        while ($k < count($this->DatabaseAccountAttributes)) {
            $old_data[] = $display_array[$k];
            ++$k;
        }
        array_unshift($old_data, $session_array[0], $session_array[1], $session_array[2]);
        for ($i = 0; $i < count($old_data); ++$i) {
            $old_data[$i] = $new_data[$i];            
        }
        $old_data[2] = $old_data[0] . ' ' . $old_data[1];
        $old_username = $session_array[2];
        $old_email = $session_array[6];
        
        $query = '
            UPDATE account_info AS a
            JOIN personal_info AS p ON a.personal_info_id = p.personal_info_id
            SET
        ';
        $db_attributes = $this->DatabaseAccountAttributes;
        for ($i = 0; $i < count($old_data); ++$i) {
            $variable = null;
            $current_attribute = $db_attributes[$i];
            if ($current_attribute == 'first-name' || $current_attribute == 'last-name' || $current_attribute == 'full-name' || $current_attribute == 'mobile' || $current_attribute == 'username' || $current_attribute == 'email') {
                $variable = 'a';
            } else {
                $variable = 'p';
            }
            $query .= $variable . '.' . str_replace('-', '_', $current_attribute) . " = " . $sql->Nullable($old_data[$i]) . "";
            if ($i != count($old_data) - 1) $query .= ', ';
            //echo $old_data[$i] . '<br>';
        }
        $query .= " WHERE a.username = '" . $old_username . "';";
        //echo $query;
        //exit;        
        mysqli_query($sql->connection, $query);
    }    
    public function GetDisplayAttributesFromDB($sql, $email, $account_data, $account_stats) {
        $tmp = array_slice(array_values($sql->GetDataByEmail('personal_info', $email, null, true)), 1);
        array_unshift($tmp, $account_data['full_name'], $account_stats['member_since'], $account_stats['last_update'], $account_data['username'], $account_data['email'], $account_data['mobile']);
        return $tmp;
    }
    public function GetDisplayAttributesFromCookie($cookie, $version1 = false) {
        $tmp = array_values(get_object_vars((json_decode($cookie))));
        if ($version1) {
            unset($tmp[2]);
            unset($tmp[3]);
            unset($tmp[4]);
        } else {
            unset($tmp[0]);
            unset($tmp[1]);
        }
        return array_values($tmp);
    }        
    public function ParseProfileImageHash($username, $email, $file_type) {
        $salt = $this->methods->RandomCharacters(32);
        return md5($username . $email . $salt) . $file_type;
    }
    public function GetProfileImageName($sql, $id) {
        $row = mysqli_fetch_assoc(mysqli_query($sql->connection, "SELECT profile_image_name	FROM session_data WHERE session_data_id = $id"));
        return $row['profile_image_name'];
    }
}
?>