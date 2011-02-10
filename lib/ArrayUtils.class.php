<?php
class ArrayUtils{
	public static function extract($arr,$key){
		if(!is_array($arr)){
			return false;
		}
		$ret=array();
		foreach($arr as $item){
			$ret[]=$item[$key];
		}
		return $ret;
		
	}
}
