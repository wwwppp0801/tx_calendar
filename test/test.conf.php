<?php
require_once("PHPUnit/Framework.php");
require_once 'PHPUnit/Extensions/Database/TestCase.php';
require_once 'PHPUnit/Extensions/Database/DataSet/CsvDataSet.php';
define("ROOT_PATH",dirname(dirname(__FILE__)));
ini_set('track_errors', true);
ini_set("display_errors", "On");
ini_set('error_reporting', E_ALL & ~E_NOTICE);
