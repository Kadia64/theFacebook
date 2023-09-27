<?php 
class FileHandle {
    public const ROOT = '/Projects/TheFacebook/Git/theFacebook/';
    public $_BASE_PATH_;
    public function __construct() {
        $this->_BASE_PATH_ = $_SERVER['DOCUMENT_ROOT'] . '/Projects/TheFacebook/Git/thefacebook/';
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
?>