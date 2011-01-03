<?php
class InsertAction {
	public function index(){
		$rec_date=Utils::convertDate($_GET['rec_date']);
		$startTime=Utils::convertTime($_GET['startTime']);
		$endTime=Utils::convertTime($_GET['endTime']);
		$name=$_SESSION['user']['name'];
		$taskModel=new TaskModel();
		if(!$taskModel->insert($rec_date,$startTime,$endTime,$description)){
			return array("redirect:/index/day?rec_date=$rec_date&msg=".rawurlencode($taskModel->getMessage()));
		}
		return array("redirect:/index/day?rec_date=$rec_date");
	}
}
