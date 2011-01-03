<?php
ini_set('track_errors', true);
ini_set("display_errors","On");
ini_set('error_reporting', E_ALL & ~E_NOTICE);
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
global $baseDir;

$baseDir=$argv[1];
$toDir=$argv[2];
$ENV=$argv[3];

if(!isset ($baseDir)){
    echo "usage: {$argv[0]} BASE_DIR TO_DIR ENV\n";
    exit(0);
}
@mkdir($toDir,0777,true);

chdir($baseDir);

$tmpDirList=array();
array_push($tmpDirList,".");
while(count($tmpDirList)!=0){
    $dir=array_pop($tmpDirList);
    $dh = opendir($dir);
    if ($dh=== false){
        continue ;
    }

    while (($file = readdir($dh)) !== false)
    {
        if(preg_match("/^\./",$file)){//忽略隐藏文件
            continue;
        }
        if(is_dir("$dir/$file")){//如果是目录
            array_push($tmpDirList,"$dir/$file");
            continue ;
        }else if (is_file("$dir/$file")){
            echo ("processing $dir/$file\n");
            //如果是文件
            ob_start();
            require ("$dir/$file");
            $static_content= ob_get_contents(); //此处关键
            ob_end_clean();
            if(isset ($EXPORT_FNAME)){
                @mkdir($toDir,0777,true);
                chdir($toDir);
                @mkdir($dir,0777,true);

                if($EXPORT_FNAME==-1){
                    $outputFileName="$dir/$file";
                }else{
                    $outputFileName="$dir/$EXPORT_FNAME";
                }
                echo ("export $baseDir/$dir/$file to
                    $toDir/$outputFileName\n");
                file_put_contents($outputFileName, $static_content);
                unset ($EXPORT_FNAME);
                chdir($baseDir);
            }
			unset ($pageName);
        }
    }
    closedir($dh);
}

echo "ok! finish\n";
return 0;
