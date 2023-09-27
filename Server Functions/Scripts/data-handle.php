<?php 
$path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/files.php';
class DataHandle {
    private $files;
    public function __construct() {
        $this->files = new FileHandle();
    }
    public function CreateAccount($sql, $register_data, $account_data) {
        $sql->InsertAccountRow($register_data, $account_data);
    }

    public function GetTimeStamp($type) {
        if ($type == 0) {                   // 2023-09-27
            return date('Y-m-d');
        } else if ($type == 1) {            // 2023/09/27
            return date('Y/m/d');           
        } else if ($type == 2) {            // 2023/09/27 09:40:29 am
            return date('Y/m/d H:i:s a');  
        } else if ($type == 9) {
            return date('c', time());
        }
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