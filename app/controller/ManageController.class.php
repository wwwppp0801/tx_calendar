<?php
class ManageController extends BaseController{

	public function __construct(){
		$this->addInterceptor(new LoginInterceptor());
		$this->addInterceptor(new AdminInterceptor());
		
	}

}
