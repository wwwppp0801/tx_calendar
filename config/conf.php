<?php 
if (file_exists(ROOT_PATH.'/DEBUG'))
{
    global $IS_DEBUG;
    $IS_DEBUG = true;
    ini_set('track_errors', true);
    ini_set("display_errors", "On");
    ini_set('error_reporting', E_ALL & ~E_NOTICE);
    Soso_Logger::setLevel(3);
}
else
{
    Soso_Logger::setLevel(1);
}

define("LOG_PATH", ROOT_PATH."/logs/");
define("MASTER_PAGE", 0);
define("GUEST_PAGE", 1);
define("MODEL_SUFFIX", "Model");
define("VERSION", 921);
define("IS_DEBUG", $IS_DEBUG);
session_start();

$GLOBALS["DSN"]="sqlite:".ROOT_PATH."/db/calendar.db";
