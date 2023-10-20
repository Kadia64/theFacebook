<?php 
class FTPHandle {    
    public $ConnectionID;
    public function __construct() {}
    public function Connect() {
        $this->ConnectionID = ftp_connect('10.0.0.140');
    }
    public function Login() {
        $username = 'sessionmanager';
        $password = getenv('FTP_PASSWORD');
        if (ftp_login($this->ConnectionID, $username, $password)) {
            return true;
        } else return false;
    }
    public function CheckConnection() {
        if ($this->ConnectionID) {
            return true;
        } else return false;
    }
    public function CloseConnection() {
        ftp_close($this->ConnectionID);
    }
    public function ChangeDirectory($dirName) {
        ftp_chdir($this->ConnectionID, $dirName);
    }
    public function ParentDirectory($times) {
        $k = 0;
        while ($k < $times) {
            ftp_cdup($this->ConnectionID);
            ++$k;
        }
    }
    public function CreateDirectory($dirName) {
        ftp_mkdir($this->ConnectionID, $dirName);
    }
    public function DeleteFile($fileName) {
        $this->ChangeDirectory('Cache');
        ftp_delete($this->ConnectionID, $fileName);
        $this->ParentDirectory(1);
    }
    public function __PrintDirectory() {
        $files = ftp_nlist($this->ConnectionID, '.');
        foreach ($files as $file) {
            echo $file . '<br>';
        }
    }
    public function __GetCurrentDirectory() {
        return ftp_pwd($this->ConnectionID);
    }
}
?>