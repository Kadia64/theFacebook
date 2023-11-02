<?php 
$_path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/methods.php';
class UpdateData {
    private $methods;
    private $sql;
    private $selector;
    public function __construct($sql, $selector) {
        $this->methods = new Methods();
        $this->sql = $sql;
        $this->selector = $selector;
    }
    public function __update_member_since_() {
        $this->sql->UpdateAccountStatByEmail($this->selector, 'member_since', $this->methods->GetTimeStamp(3));
    }
    public function __update_last_update_() {
        $this->sql->UpdateAccountStatByEmail($this->selector, 'last_update', $this->methods->GetTimeStamp(3));
    }    
    public function __update_last_login_timestamp_() {
        $this->sql->UpdateAccountStatByEmail($this->selector, 'last_login_timestamp', $this->methods->GetTimeStamp(3));
    }
    public function __update_last_logout_timestamp_() {
        $this->sql->UpdateAccountStatByEmail($this->selector, 'last_logout_timestamp', $this->methods->GetTimeStamp(3));
    }
    public function __update_last_password_attempt_timestamp_() {
        $this->sql->UpdateAccountStatByEmail($this->selector, 'last_password_attempt_timestamp', $this->methods->GetTimeStamp(3));
    }
    public function __update_last_password_changed_timestamp_() {
        $this->sql->UpdateAccountStatByEmail($this->selector, 'last_password_changed_timestamp', $this->methods->GetTimeStamp(3));
    }
}
?>