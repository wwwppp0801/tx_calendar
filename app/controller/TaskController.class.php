<?php
class TaskController extends BaseController{
	public function __construct(){
		$this->addInterceptor(new LoginInterceptor());
	}

}
