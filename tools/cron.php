<?php

set_time_limit(0);
$lines=explode("\n",file_get_contents(dirname(__FILE__)."/cron"));
$lines=array_map("trim",$lines);
$lines=array_filter($lines);
$time=time();
foreach ($lines as $line){
	if($line[0]=='#'){
		continue;
	}
	$arr=preg_split("/\s+/",$line,6);
	if(count($arr)!=6){
		errorReport($line);
	}
	if(matchTime(array_slice($arr,0,5),$time)){
		system('cd "'.dirname(__FILE__).'";'.$arr[5]);
	}
}
function matchTime($expArr,$time){
	$time_formats=array('i','G','j','n','Y');//分，时，日，月，年
	for ($i=0;$i<5;$i++){
		$exp=$expArr[$i];
		$time_col=intval(date($time_formats[$i],$time),10);
		if($exp=='*'){
			continue;	
		}else if(preg_match('/\*\/(\d+)/',$exp,$matches)){
			if ($time_col%$matches[1]!=0){
				return false;
			}
		}else if(preg_match('/\d+(,\d+)*/',$exp)){
			foreach(explode(',',$exp) as $num){
				if($time_col==$num){
					continue;
				}
			}
			return false;
		}else{
			errorReport(implode(" ",$expArr));
			
		}
	}
	return true;
}
function errorReport($line){
	file_put_contents($line."\n".date(),dirname(__FILE__)."/error.log","a");
}
