<?php
class IndexController extends BaseController{

	public function __construct(){
		$this->addInterceptor(new LoginInterceptor());
	}

}
