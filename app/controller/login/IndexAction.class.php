<?php

class IndexAction{
	public function index(){
		@$username=$_POST['name'];
		@$password=$_POST['pass'];
		if(isset($username) && isset($password))
		{
			$model=new UserModel();
			$user=$model->getUser($username,$password);
			if ($user){
				$_SESSION['user'] = $user;
				return array("redirect:/index?msg=".rawurlencode("登录成功"));
			}else{
				$data['msg']="用户名或密码错误";
			}
		}
		return array("login.tpl",$data);
		
	}

	public function logout(){
		unset($_SESSION['user']);
		return array("login.tpl");
	}
}
