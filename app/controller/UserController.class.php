<?php
class UserController extends BaseController{

	public function __construct(){
		$this->addInterceptor(new LoginInterceptor());
	}

}
