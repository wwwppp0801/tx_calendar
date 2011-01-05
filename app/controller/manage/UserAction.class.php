<?php
class UserAction{
	protected $userModel;
	public function __construct(){
		$this->userModel=new UserModel();
	}
	public function index(){
		$data=array();
		$users=$this->userModel->getAllUsers();
		$data['users']=$users;
		$data['user']=$_SESSION['user'];
		$data['msg']=$_GET['msg'];
		return array('userManage.tpl',$data);
	}
	public function add(){
		$name=$_REQUEST['name'];
		$pass=$name;
		$this->userModel->addUser($name,$pass);
		return array("redirect:/manage/user");
	}
}
