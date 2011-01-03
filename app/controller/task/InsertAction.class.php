<?php
class TaskAction {
	public function insert(){
	
	}

	public function delete(){
		@$rec_date=Utils::convertDate($_REQUEST['rec_date']);
		@$id=$_REQUEST['id'];
		if(!isset($id)){
			errorReturn($rec_date,"请输入要删除的id号");
		}
		@$record=getRecord($id);
		if(!isset($record)){
			return array("redirect:/index/day?rec_date=$rec_date&msg=".rawurlencode("没有这条记录"));
		}




		//检查权限
		if($_SESSION['username']!='admin' && $_SESSION['username']!=$record['name']){
			return array("redirect:/index/day?rec_date=$rec_date&msg=".rawurlencode("您没有删除用户的权限"));
		}


		try{
			$dbh = new PDO($GLOBALS["DSN"]);
			$stmt = $dbh->prepare('delete from record where id = ?');
			$stmt->bindParam(1, $id, PDO::PARAM_INT);
			$stmt->execute();
		}catch (PDOException $e) {
			errorReturn($rec_date,$e->getMessage());
		}

		header("location:room.php?rec_date=$rec_date");
		
	}
	public function get(){
		if(isset($_GET['id'])){
			$id=$_GET['id'];
			$dbh = new PDO($GLOBALS["DSN"]);
			$sql = "SELECT * FROM record where id = $id";
			$rs = $dbh->query($sql);
			$rs->setFetchMode(PDO::FETCH_ASSOC);
			return $rs->fetch();
		}
	}
}
