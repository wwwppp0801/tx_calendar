<?php
class DeleteAction {

	public function index(){
		@$rec_date=Utils::convertDate($_REQUEST['rec_date']);
		@$id=$_REQUEST['id'];
		if(!isset($id)){
			return array("redirect:/index/day?rec_date=$rec_date&msg=".rawurlencode("请输入要删除的id号"));
		}
		$taskModel=new TaskModel();
		@$record=$taskModel->get($id);
		if(!$record){
			return array("redirect:/index/day?rec_date=$rec_date&msg=".rawurlencode("没有这条记录"));
		}

		//检查权限
		if(!$_SESSION['user']['isAdmin'] && $_SESSION['user']['name']!=$record['name']){
			return array("redirect:/index/day?rec_date=$rec_date&msg=".rawurlencode("您没有删除用户的权限"));
		}

		if (!$taskModel->delete($id)){
			return array("redirect:/index/day?rec_date=$rec_date&msg=".rawurlencode($taskModel->getMessage()));
		}
		return ("redirect:/index/day?rec_date=$rec_date");
		
	}
}
