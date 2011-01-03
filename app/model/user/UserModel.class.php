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

	public function addUser($user){
		$dbh = new PDO($GLOBALS["DSN"]);
		$sql = "insert into record_user(name,pass) values(?,?)";
		$stmt = $dbh->prepare($sql);
		$stmt->bindParam(1, $user['user'], PDO::PARAM_STR);
		$stmt->bindParam(2, $user, PDO::PARAM_STR);
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
		$user['isAdmin']=$user['name']=="admin";
		return $user;
	}
}
