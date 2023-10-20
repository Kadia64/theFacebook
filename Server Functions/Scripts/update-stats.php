<?php 
$_path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/methods.php';
class UpdateData {
    private $methods;
    public function __construct() {
        $this->methods = new Methods();
    }
    public function __update_member_since_() {
        echo $this->methods->GetTimeStamp(2);
    }
    public function __update_member_since_timestamp_() {
        echo $this->methods->GetTimeStamp(2);
    }
    public function __update_last_update_() {
        echo $this->methods->GetTimeStamp(2);
    }
    public function __update_last_update_timestamp_() {
        echo $this->methods->GetTimeStamp(2);
    }
    public function __update_last_login_timestamp_() {
        echo $this->methods->GetTimeStamp(2);
    }
    public function __update_last_logout_timestamp_() {
        echo $this->methods->GetTimeStamp(2);
    }
    public function __update_last_password_attempt_timestamp_() {
        echo $this->methods->GetTimeStamp(2);
    }
    public function __update_last_password_changed_timestamp_() {
        echo $this->methods->GetTimeStamp(2);
    }
}
?>