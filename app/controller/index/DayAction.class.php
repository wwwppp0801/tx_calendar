<?php
class DayAction{
	public function index(){
		
		$date = Utils::convertDate($_GET['rec_date']);
		$taskModel=new TaskModel();
		$tasks=$taskModel->getDayTasks($date);
		$data['tasks']=$tasks;

		for ($i=0;$i<14;$i++){
			$hours[$i]=$i;
		}
		$data['hours']=$hours;
		$data['date']=$date;
		$data['startTime'] = isset($_GET['startTime'])?$_GET['startTime']:8;
		$data['endTime'] = isset($_GET['endTime']) ? $_GET['endTime']:($data['startTime']+1);
		$data['msg'] = isset($_GET['msg']) ? $_GET['msg']:'';
		return array('day.tpl',$data);
	
	}
}
