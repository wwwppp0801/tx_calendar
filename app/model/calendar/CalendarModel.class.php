<?php
class CalendarModel{
	private $pdoTmpl;
	public function __construct(){
		$this->pdoTmpl=new PDOTemplate($GLOBALS["DSN"]);
	}

	public function getCalendar($id){
		$calendar=$this->pdoTmpl->queryForObject("select * from t_calendar where id=?",$id);
		return $calendar;
	}

	public function getCalendarsByUser($username){
		$userCals=$this->pdoTmpl->queryForList("select * from t_calendar_user where name=?",$username);
		$ids=ArrayUtils::extract($userCals,'cal_id');
		$cals=$this->pdoTmpl->queryForList("select * from t_calendar where id in ?",$ids);
		return $cals;
	}
}
