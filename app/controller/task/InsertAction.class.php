<?php
class InsertAction {
	public function index(){
		$rec_date=Utils::convertDate($_REQUEST['rec_date']);
		$startTime=Utils::convertTime($_REQUEST['startTime']);
		$endTime=($_REQUEST['endTime']);
		$description=$_REQUEST['description'];
		$name=$_SESSION['user']['name'];
		$taskModel=new TaskModel();
		if(!$taskModel->insert($name,$rec_date,$startTime,$endTime,$description)){
			return array("redirect:/index/day?rec_date=$rec_date&msg=".rawurlencode($taskModel->getMessage()));
		}
		return array("redirect:/index/day?rec_date=$rec_date");
	}
}
