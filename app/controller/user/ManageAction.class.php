<?php
class ManageAction{
	public function index(){
		$user=$_SESSION['user'];
		$userModel=new UserModel();
		$password=$_GET['passBefore'];
		if($user){
		}else{
			if(isset($_GET['passBefore']))
				$data['msg']="原密码填写有误";
		}
		$data['user']=$_SESSION['user'];

		return array('changeUserInfo.tpl',$data);
	}
	public function update(){
		if($_GET['passAfter1']!=$_GET['passAfter2']){
			return array("redirect:/user/manage?msg=".urlencode("密码输入不一致"));
		}elseif(!$_GET['passAfter1']){
			return array("redirect:/user/manage?msg=".urlencode("请输入密码"));
		}else {
			$password=$_GET['passAfter1'];
			$userModel=new UserModel();
			$userModel->updateUser($_SESSION['user']['name'],$password,$_GET['description']);
			$_SESSION['user']['description']=$_GET['description'];
			return array("redirect:/?msg=".urlencode("修改成功"));
		}
	
	}
}
