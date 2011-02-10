<?php

class IndexAction{
	public function index(){
		$data['user']=$_SESSION['user'];
		$data['msg']=$_GET['msg'];
		$calendarModel=new CalendarModel();
		$calendars=$calendarModel->getCalendarsByUser($data['user']['name']);
		$data['calendars']=$calendars;

		@$weekOffset=isset($_GET['week']) ? $_GET['week'] : 0;
		$model=new TaskModel();
		$records=$model->getWeekTasks($weekOffset);
		$data['records']=$records;
		$data['days']=DatetimeUtils::getWeekDays($weekOffset);
		$data['weekOffset']=$weekOffset;
		return array('index.tpl',$data);
	}
}
