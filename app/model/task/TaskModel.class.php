<?php
class TaskModel{
	public function getWeekTasks($weekOffset){
		$record=array();
		$weekday= date('N',mktime(0,0,0,date('n'),date('j'),date('Y')));

		for($i=0;$i<7;$i++){
			$days[$i]=date('Y-m-d',mktime(0,0,0,date('n'),date('j')-$weekday+$i+1+$weekOffset*7,date('Y')));
		}
		$data['days']=$days;

		$dbh = new PDO($GLOBALS["DSN"]);
		$sql = "SELECT * FROM record WHERE rec_date>='{$days[0]}' and rec_date<='{$days[6]}' order by rec_date ";
		$rs = $dbh->query($sql);
		$rs->setFetchMode(PDO::FETCH_ASSOC);
		while($row=$rs->fetch())
		{	
			$date_arr =	explode('-',$row['rec_date'],3);
			//记录的那天是星期几
			$date_week = date('N',mktime(0,0,0,$date_arr[1],$date_arr[2],$date_arr[0]));
			for ($i=$row['startTime'];$i<$row['endTime'];$i++){
				$record[$date_week-1][$i-8]=$row;
			}
		}
		return array($days,$record);
	}
}
