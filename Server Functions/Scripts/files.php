<?php 
class FileHandle {
    public const ROOT = '/Projects/TheFacebook/Git/theFacebook/';
    public $_BASE_PATH_;
    public $_SERVER_PATH_;
    public $ServerConfig;    
    public function __construct() {
        $this->_BASE_PATH_ = $_SERVER['DOCUMENT_ROOT'] . '/Projects/TheFacebook/Git/thefacebook/';        
        $this->ServerConfig = json_decode($this->ReadFile('Server Config/main-config.json'));
        $this->_SERVER_PATH_ = $this->ServerConfig->{'Server-Configuration'}->{'Absolute-Path'};        
    }
    public function ReadFile($fileName) {
        $path = $this->_BASE_PATH_ . $fileName;
        $file = fopen($path, 'r');
        if (filesize($path) > 0) {
            $contents = fread($file, filesize($path));
        } else {
            $contents = '';
        }
        fclose($file);
        return $contents;
    }
    public function OverwriteFile($fileName, $data) {
        $path = $this->_BASE_PATH_ . $fileName;
        $file = fopen($path, 'w');
        fwrite($file, $data);
        fclose($file);
    }
}
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