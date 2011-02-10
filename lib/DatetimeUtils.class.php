<?php
class DatetimeUtils {
	public static function getWeekDays($weekOffset=0){ 
		$weekday=date('N');
		for($i=0;$i<7;$i++){
			$days[$i]=date('Y-m-d',mktime(0,0,0,date('n'),date('j')-$weekday+$i+1+$weekOffset*7,date('Y')));
		}
		return $days;
	}
}
