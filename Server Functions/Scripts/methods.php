<?php 
class Methods {
    public function RandomCharacters($length) {
        $letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $rand = null;
        for ($i = 0; $i < $length; ++$i) {
            $rand .= $letters[mt_rand(0, strlen($letters) - 1)];            
        }
        return $rand;
    }    
    public function GetTimeStamp($type) {
        $time = new DateTime();
        if ($type == 0) {                   // 2023-09-27
            return date('Y-m-d');
        } else if ($type == 1) {            // 2023/09/27
            return date('Y/m/d');           
        } else if ($type == 2) {            // 2023/09/27 094029 am
            return date('Y/m/d His a');  
        } else if ($type == 7) {            // +10 minutes from now
            $now = $time->format('Y-m-d g:i:s A');
            $time->add(new DateInterval('PT10M'));
            return $time->format('Y-m-d g:i:s A');
        } else if ($type == 9) {
            return date('c', time());
        }
    }  
}
?>