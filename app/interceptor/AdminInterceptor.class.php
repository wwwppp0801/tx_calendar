<?php
/*
 * 只有admin用户能通过这个interceptor
 *
 * */
class AdminInterceptor{
	public function beforeAction(){
		if(!isset($_SESSION['user'])||!$_SESSION['user']['isAdmin'])
		{
			throw new ModelAndViewException('not admin',2,"redirect:/login?msg=".urlencode('对不起，您不是管理员用户'));
		}
	}
	public function afterAction(){
		
	}
}
