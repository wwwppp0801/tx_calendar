<?php

class UserModel{
	public function delUser($username){
		if($username!='admin'){
			$dbh = new PDO($GLOBALS["DSN"]);
			$sql = "delete from record_user where name=?";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(1, $username, PDO::PARAM_STR);
			return $stmt->execute();
		}else{
			Soso_Logger::info("can't del admin user");
			return false;
		}
	}

	public function addUser($name,$pass,$description=""){
		$dbh = new PDO($GLOBALS["DSN"]);
		$sql = "insert into record_user(name,pass,description) values(?,?,?)";
		$stmt = $dbh->prepare($sql);
		$stmt->bindParam(1, $name, PDO::PARAM_STR);
		$stmt->bindParam(2, $pass, PDO::PARAM_STR);
		$stmt->bindParam(3, $description, PDO::PARAM_STR);
		return $stmt->execute();
	}
	public function getUser($name,$pass){
		$dbh = new PDO($GLOBALS["DSN"]);
		$sql = "SELECT * FROM record_user where name = ? and pass=? ;";
		$stmt = $dbh->prepare($sql);
		$stmt->bindParam(1, $name, PDO::PARAM_STR);
		$stmt->bindParam(2, $pass, PDO::PARAM_STR);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$user=	$stmt->fetch();
		if($user){	$user['isAdmin']=($user['name']=="admin");
			return $user;
		}else{
			return false;
		}
		
	}
	
	public function updateUser($name,$pass,$description){
		$sql="update record_user set pass=?,description=? where name=?";
		$dbh = new PDO($GLOBALS["DSN"]);
		$stmt = $dbh->prepare($sql);
		$stmt->bindParam(1, $pass, PDO::PARAM_STR);
		$stmt->bindParam(2, $description, PDO::PARAM_STR);
		$stmt->bindParam(3, $name, PDO::PARAM_STR);
		return $stmt->execute();
	}
	public function getAllUsers(){
		$dbh = new PDO($GLOBALS["DSN"]);
		$sql = "SELECT * FROM record_user order by name;";
		$rs = $dbh->query($sql);
		$users=	$rs->fetchAll();
		foreach ($users as &$user){
			$user['isAdmin']=$user['name']=="admin";
		}
		return $users;
	}
}
