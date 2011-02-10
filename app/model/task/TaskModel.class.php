<?php
class TaskModel{
	private $pdoTmpl;
	public function __construct(){
		$this->pdoTmpl=new PDOTemplate($GLOBALS["DSN"]);
	}

	public function getWeekTasks($weekOffset,$cal_id=false){
		$days=DatetimeUtils::getWeekDays($weekOffset);

		if($cal_id!==false){
			$rawRecords=$this->pdoTmpl->queryForList("SELECT * FROM t_record WHERE rec_date>=? and rec_date<=? and cal_id=? order by rec_date",$days[0],$days[6],$cal_id);
		}else{
			$rawRecords=$this->pdoTmpl->queryForList("SELECT * FROM t_record WHERE rec_date>=? and rec_date<=? order by rec_date",$days[0],$days[6]);
		}
		$records=array();
		foreach($rawRecords as $row)
		{
			//记录的那天是星期几
			$date_week = date('N',strtotime($row['rec_date']));
			for ($i=$row['startTime'];$i<$row['endTime'];$i++){
				$records[$date_week-1][$i-8]=$row;
			}
		}
		return $records;
	}
	public function getDayTasks($date){
		$tasks = $this->pdoTmpl->queryForList("SELECT * FROM t_record where rec_date = ? order by startTime",$date);
		return $tasks;
	}

	public function delete($id){
		return $this->pdoTmpl->delete("delete from t_record where id = ?",$id);
	}

	public function get($id){
		return $this->pdoTmpl->queryForObject('SELECT * FROM t_record where id = ?',$id);
	}

	public function insert($name,$rec_date,$startTime,$endTime,$description,$cal_id=0){
		if($startTime>=$endTime){
			$this->setMessage("开始时间必须在结束时间之前");
			return false;
		}
		
		if($startTime<8 || $endTime>22){
			$this->setMessage("只能预订8点到22点之间的时间");
			return false;
		}
		
		//检查是否与其他预定冲突
		//$sql="SELECT count(*) FROM t_record where rec_date = '$rec_date' and 
		//	  ((startTime<'$startTime' and endTime>'$startTime') or 
		//	  (startTime<'$endTime' and endTime>'$endTime') or
		//	  ((startTime>='$startTime' and endTime<='$endTime'))
		//	  )";
		$count=$this->pdoTmpl->queryForInt("SELECT count(*) FROM t_record where rec_date = ? and 
			  ((startTime<? and endTime>?) or 
			  (startTime<? and endTime>?) or
			  ((startTime>=? and endTime<=?))
			  )",$rec_date,$startTime,$startTime,$endTime,$endTime,$startTime,$endTime);
		if ($count>0){
			$this->setMessage("输入时间有误，与其它预订时间冲突");
			return false;
		}

		//加入新的预定	
		try{
			$result=$this->pdoTmpl->insert('INSERT INTO t_record(rec_date,name,startTime,endTime,description,cal_id) VALUES(?,?,?,?,?,?)',
				$rec_date,$name,$startTime,$endTime,$description,$cal_id
			);
	//assert($stmt->execute());
		}catch (PDOException $e) {
			$this->setMessage($e->getMessage());
			return false;
		}
		return $result;
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
