<?php
class LoginInterceptor{
	public function beforeAction(){
		if(!isset($_SESSION['user']))
		{
			throw new ModelAndViewException('not login',1,"redirect:/login");
		}
	}
	public function afterAction(){
		
	}
}
