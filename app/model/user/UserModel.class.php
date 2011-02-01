<?php

class UserModel{
	private $pdoTmpl;
	public function __construct(){
		$this->pdoTmpl=new PDOTemplate($GLOBALS["DSN"]);
	}
	public function delUser($username){
		if($username!='admin'){
			$this->pdoTmpl->execute("delete from t_record_user where name=?",$username);
		}else{
			Soso_Logger::info("can't del admin user");
			return false;
		}
	}

	public function addUser($name,$pass,$description=""){
		return $this->pdoTmpl->insert("insert into t_record_user(name,pass,description) values(?,?,?)",$name,$pass,$description);
	}
	public function getUser($name,$pass){
		$user=$this->pdoTmpl->queryForObject("SELECT * FROM t_record_user where name = ? and pass=? ",$name,$pass);
		if($user){	
			$user['isAdmin']=($user['name']=="admin");
			return $user;
		}else{
			return false;
		}
		
	}
	
	public function updateUser($name,$pass,$description){
		return $this->pdoTmpl->update("update t_record_user set pass=?,description=? where name=?",$pass,$description,$name);
	}
	
	public function getAllUsers($offset=0,$length=10){
		$users = $this->pdoTmpl->queryForList('SELECT * FROM t_record_user order by name');
		foreach ($users as &$user){
			$user['isAdmin']=$user['name']=="admin";
		}
		return $users;
	}
}
