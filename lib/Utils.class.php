<?php 
class Utils {
    
    public static function _encodeURIComponent($str) {
        return rawurlencode(mb_convert_encoding($str, 'UTF-8', 'GBK'));
    }
    
    public static function toUTF8($str) {
        return mb_convert_encoding($str, 'UTF-8', 'GBK');
    }
    public static function toGBK($str) {
        return mb_convert_encoding($str, 'GBK', 'UTF-8');
    }
    
    public static function _decodeURIComponent($str) {
        return mb_convert_encoding(rawurldecode($str), 'GBK', 'UTF-8');
    }
    
    
    public static function curlGet($url, $timeout = 1, $headerAry = '') {
        //var_dump($url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        //outputʱ����http��Ӧͷ
        curl_setopt($ch, CURLOPT_HEADER, false);
        //����http�����ͷ����Ϣ ÿ���������е�һ��
        //��url����ip����ʱ��������hostָ����������
        if ($headerAry != '') {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headerAry);
        }
        
        $res = curl_exec($ch);
        
        return $res;
    }
    
    public static function curlPost($url, $data, $timeout = 1, $headerAry = '') {
        $ch = curl_init();
        //var_dump($url);
        //var_dump($data);
        //var_dump($headerAry);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        //outputʱ����http��Ӧͷ
        curl_setopt($ch, CURLOPT_HEADER, false);
        //����http�����ͷ����Ϣ ÿ���������е�һ��
        //��url����ip����ʱ��������hostָ����������
        if ($headerAry != '') {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headerAry);
        }
        $res = curl_exec($ch);
        //var_dump($url);
        return $res;
    }

    
    public static function getClientIP() {
        if ($_SERVER["HTTP_X_FORWARDED_FOR"]) {
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } elseif ($_SERVER["HTTP_CLIENT_IP"]) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        } elseif ($_SERVER["REMOTE_ADDR"]) {
            $ip = $_SERVER["REMOTE_ADDR"];
        } elseif (getenv("HTTP_X_FORWARDED_FOR")) {
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        } elseif (getenv("HTTP_CLIENT_IP")) {
            $ip = getenv("HTTP_CLIENT_IP");
        } elseif (getenv("REMOTE_ADDR")) {
            $ip = getenv("REMOTE_ADDR");
        } else {
            $ip = false;
        }
        $ip = explode(",", $ip, 2);
        $ip = trim($ip[0]);
        return $ip;
    }

}
?>
