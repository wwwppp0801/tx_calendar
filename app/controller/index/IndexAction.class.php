<?php

class IndexAction{
	public function index(){
		$data['user']=$_SESSION['user'];
		$data['msg']=$_GET['msg'];

		@$weekOffset=isset($_GET['week']) ? $_GET['week'] : 0;
		$model=new TaskModel();
		list ($days,$record)=$model->getWeekTasks($weekOffset);
		$data['record']=$record;
		$data['weekOffset']=$weekOffset;
		for ($i=0;$i<14;$i++){
			$hours[$i]=$i;
		}
		$data['hours']=$hours;
		$data['days']=$days;
		return array('index.tpl',$data);
	}
}
