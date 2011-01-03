<?php

require_once 'PHPUnit/TextUI/TestRunner.php';
define(ROOT_PATH,dirname(dirname(__FILE__))."/");
// ����һ������Դ����ArrayTest�Ĳ��ԵĲ����׼���
$suite = new PHPUnit_Framework_TestSuite();
$tmpDirList=array();
array_push($tmpDirList,ROOT_PATH.'/test/');
while(count($tmpDirList)!=0){
    $dir=array_pop($tmpDirList);
    if (($dh = opendir($dir)) === false){
        continue ;
    }

    while (($file = readdir($dh)) !== false)
    {
        if(preg_match("/^\./",$file)){
            continue;
        }
        if(is_dir("$dir/$file")){
            array_push($tmpDirList,"$dir/$file");
            continue ;
        }
        if(preg_match("/Test\.php$/", $file))
        {
            //system("phpunit $dir/$file");
           echo "add test ".$dir.'/'.$file."\n";
            $suite->addTestFile($dir."/".$file);
        }
    }
    closedir($dh);
}
//var_dump($suite);

// ���в��ԡ�
PHPUnit_TextUI_TestRunner::run($suite,array('reportDirectory'=>dirname(__FILE__)."/reports"));
//PHPUnit_TextUI_TestRunner::run($suite);
