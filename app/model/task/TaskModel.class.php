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
	public function getDayTasks($date){
		$dbh = new PDO($GLOBALS["DSN"]);
		$sql = "SELECT * FROM record where rec_date = '$date' order by startTime";

		$rs = $dbh->query($sql);
		$rs->setFetchMode(PDO::FETCH_ASSOC);
		$tasks=array();
		while($task=$rs->fetch())
		{
			$tasks[]=$task;
		}
		return $tasks;
	}

	public function delete($id){
		try{
			$dbh = new PDO($GLOBALS["DSN"]);
			$stmt = $dbh->prepare('delete from record where id = ?');
			$stmt->bindParam(1, $id, PDO::PARAM_INT);
			$stmt->execute();
		}catch (PDOException $e) {
			$this->setMessage($e->getMessage());
		}
	}

	public function get($id){
		$dbh = new PDO($GLOBALS["DSN"]);
		$sql = "SELECT * FROM record where id = $id";
		$rs = $dbh->query($sql);
		$rs->setFetchMode(PDO::FETCH_ASSOC);
		return $rs->fetch();
	}

	public function insert($name,$rec_date,$startTime,$endTime,$description){
		if($startTime>=$endTime){
			$this->setMessage("开始时间必须在结束时间之前");
			return false;
		}
		
		if($startTime<8 || $endTime>22){
			$this->setMessage("只能预订8点到22点之间的时间");
			return false;
		}
		
		$dbh = new PDO($GLOBALS["DSN"]);
		
		//检查是否与其他预定冲突
		$sql="SELECT count(*) FROM record where rec_date = '$rec_date' and 
			  ((startTime<'$startTime' and endTime>'$startTime') or 
			  (startTime<'$endTime' and endTime>'$endTime') or
			  ((startTime>='$startTime' and endTime<='$endTime'))
			  )";
		$rs=$dbh->query($sql);
		$count=$rs->fetch();
		if ($count[0]>0){
			$this->setMessage("输入时间有误，与其它预订时间冲突");
			return false;
		}

		//加入新的预定	
		try{
			$stmt = $dbh->prepare('INSERT INTO record(rec_date,name,startTime,endTime,description) VALUES(?,?,?,?,?)');

			$stmt->bindParam(1, $rec_date, PDO::PARAM_STR);
			$stmt->bindParam(2, $name, PDO::PARAM_STR);
			$stmt->bindParam(3, $startTime, PDO::PARAM_STR);
			$stmt->bindParam(4, $endTime, PDO::PARAM_STR);
			$stmt->bindParam(5, $description, PDO::PARAM_STR);
			if(!$stmt->execute()){
				$this->setMessage($stmt->errorInfo());
				return false;
			}
	//assert($stmt->execute());
		}catch (PDOException $e) {
			$this->setMessage($e->getMessage());
			return false;
		}
		return true;	
	}


	public function setMessage($message){
		$this->message=$message;
	}

	public function getMessage(){
		if (is_array( $this->message)){
			return implode("\n",$this->message);
		}
		return $this->message;
	}
}
