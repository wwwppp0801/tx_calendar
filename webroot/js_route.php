<?php

ini_set('track_errors', true);
ini_set("display_errors","On");
ini_set('error_reporting', E_ALL & ~E_NOTICE);
if (file_exists(dirname(dirname(__FILE__)).'/DEBUG')) {
    $ENV='test';
}
function page_include($fileName){
    $bt = debug_backtrace();
    $point=array_shift($bt);
    $dir=dirname($point['file']);
    global $pageName;
    $temp=$pageName;
    if (!isset($temp)){
        return;
    }
    do{
        if(isset($temp)&&is_dir("$dir/$temp")&&is_file("$dir/$temp/$fileName")){
            echo "\n";
            require "$dir/$temp/$fileName";
            return;
        }
        $temp=dirname($temp);
        if(is_file("$dir/$temp/DEFAULT_INC/$fileName")){
            echo "\n";
            require "$dir/$temp/DEFAULT_INC/$fileName";
            return;
        }
    }while($temp!='.');

}

function export($fileName=-1){
    global $EXPORT_FNAME;
    if (!isset($EXPORT_FNAME)){
        $EXPORT_FNAME=$fileName;
    }
    global $pageName;
    $point=array_shift(debug_backtrace());
    list ($pageName) = explode('.', basename($point['file']), 2);
}

define("U_HOME",dirname(__FILE__));

ini_set('include_path',ini_get('include_path').':'.U_HOME.'/js');

//echo $_GET['_reqphp'];
$requestURI=$_GET['_URL_'];
//$requestURI=substr($requestURI,strlen('icenter/'));

if(substr(ltrim($requestURI,'/'),0,3)=='js/'){
    require(U_HOME."/".$requestURI);
}   


