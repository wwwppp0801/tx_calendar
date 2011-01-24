<?php

class PDOTemplate{
    private $dsn;
    private $pdo;
    private $user;
    private $password;
	private $fetchMode=PDO::FETCH_ASSOC;
    private function getPDO(){
        if(!$this->pdo){
            $this->pdo=new PDO($this->dsn,$this->user,$this->password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        }
        return $this->pdo;
    }
    public function __construct($dsn,$user='',$password=''){
        $this->dsn=$dsn;
        $this->user=$user;
        $this->password=$password;
    }

	public function lastInsertId(){
		return $this->pdo->lastInsertId();
	}
	public function insert(){
		$args=func_get_args();
		return $this->execute($args);
	}
	
	public function update(){
		$args=func_get_args();
		return $this->execute($args);
	}
	
	public function delete(){
		$args=func_get_args();
		return $this->execute($args);
	}

	public function execute($args){
        if(count($args)==0){
            throw new SystemException('no args error');
        }
        $this->executeSql($args,$executeResult);
		return $executeResult;
	}

    public function queryForList(){
        $args=func_get_args();
        if(count($args)==0){
            throw new SystemException('queryForList no args error');
        }
        $stmt=$this->executeSql($args);
//        var_dump($stmt);
		$result=$stmt->fetchAll($this->fetchMode);
		if($result===false){
			return null;
		}
        return $result;
    }
    
    public function queryForObject(){
        $args=func_get_args();
        if(count($args)==0){
            throw new SystemException('queryForObj no args error');
        }
        $stmt=$this->executeSql($args);
		$result= $stmt->fetch($this->fetchMode);
		if($result===false){
			return null;
		}
		return $result;
    }
    
    public function queryForInt(){
        $args=func_get_args();
        if(count($args)==0){
            throw new SystemException('queryForInt no args error');
        }
        $stmt=$this->executeSql($args);
        $res= $stmt->fetch($this->fetchMode);
		//var_dump($res);
		if($res===false){
			return null;
		}
		//$res是一个关联数组，由于默认的fetchMode
        $values= array_values($res);
		return $values[0];
    }
    
    private function executeSql($args,&$executeResult=false){
        $sql=array_shift($args);
        if(count($args)==0){
            $stmt=$this->getPDO()->query($sql);
        }else{
            $bindArgs=array();
            foreach($args as $i=>$arg){
                if(!is_array($arg)){
                    if(is_string($i)){
                        $bindArgs[$i]=$arg;
                    }else{
                        $bindArgs[]=$arg;
                    }
                    continue;
                }
                if(is_string($i)){
                    $sql=str_replace(":$i",$this->array2str($arg),$sql);
                }else{
                    $tokens=explode("?",$sql);
                    $sql=implode("?",array_slice($tokens,0,$i-1)).$this->array2str($arg).implode("?",array_slice($tokens,$i+1));
                }
            }
			//var_dump($sql);
            $stmt=$this->getPDO()->prepare($sql);
			//var_dump($bindArgs);
            foreach($bindArgs as $i=>$arg){
				$bindIdx=is_int($i)?$i+1:$i;

                if(is_int($arg)){
					//注意bindParam和bindValue的区别
                    $stmt->bindValue($bindIdx, $arg, PDO::PARAM_INT);
                }
                if(is_string($arg)){
                    $stmt->bindValue($bindIdx, $arg, PDO::PARAM_STR);
                }
            }
            $executeResult=$stmt->execute();
        }
        return $stmt; 
    }
    
    private function array2str($arr){
        if(count($arr)==0){
            throw new SystemException('can\'t be new array');
        }
        if(is_int($arr[0])){
            return "(".implode(",",$arr).")";
        }
        foreach ($arr as &$param){
			$param=$this->getPDO()->quote($param);
        }
        return "(".implode(",",$arr).")";
    }



}
