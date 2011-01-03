<?php
class GetAction {
	public function index(){
		if(isset($_GET['id'])){
			$taskModel=new TaskModel();
			return $taskModel->get($_GET['id']);
		}
	}
}
