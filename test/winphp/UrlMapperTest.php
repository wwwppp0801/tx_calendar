<?php


require_once("PHPUnit/Framework.php");
define("PHP_ROOT",dirname(dirname(dirname(__FILE__)))."/");
require_once(PHP_ROOT."winphp/base/UrlMapper.class.php");
require_once(PHP_ROOT."winphp/base/BaseController.class.php");
require_once(PHP_ROOT."winphp/Exception.class.php");
require_once(PHP_ROOT."winphp/WinRequest.class.php");
class UrlMapperTest extends PHPUnit_Framework_TestCase{
	public function testGetAction(){
		$mapper=new UrlMapper("keysub/index");
		$controller=$mapper->getController();
		$controllerClassName=get_class($controller);
		$this->assertEquals("KeysubController",$controllerClassName);
		
		$action=$mapper->getAction();
		$this->assertEquals("IndexAction",get_class($action));
		$this->assertSame($mapper->getController(),$controller);
		$this->assertSame($mapper->getAction(),$action);
	}
	public function testParameter(){
		$mapper=new UrlMapper("keysub/index/index/c/kkkkk/b/aaa/d");
		$controller=$mapper->getController();
		$controllerClassName=get_class($controller);
		$this->assertEquals("KeysubController",$controllerClassName);
		
		$action=$mapper->getAction();
		$this->assertEquals("IndexAction",get_class($action));
		$this->assertSame($mapper->getController(),$controller);
		$this->assertSame($mapper->getAction(),$action);
        $this->assertEquals("kkkkk",WinRequest::getParameter("c"));
        $this->assertEquals("aaa",WinRequest::getParameter("b"));
        $this->assertEquals("",WinRequest::getParameter("d"));
	}
	public function testDefaultAction(){
		$mapper=new UrlMapper("keysub/");
		$controller=$mapper->getController();
		$controllerClassName=get_class($controller);
		$this->assertEquals("KeysubController",$controllerClassName);
		
		$action=$mapper->getAction();
		$this->assertEquals("IndexAction",get_class($action));
		$this->assertSame($mapper->getController(),$controller);
		$this->assertSame($mapper->getAction(),$action);
		
	}

	/**
	  @expectedException SystemException
	  */
	public function testNoAction(){
		$mapper=new UrlMapper("keysub/noAction");
		$controller=$mapper->getController();
		$controllerClassName=get_class($controller);
		$this->assertEquals("KeysubController",$controllerClassName);
		
		$action=$mapper->getAction();
		$this->assertSame($mapper->getController(),$controller);
		$this->assertSame($mapper->getAction(),$action);
		
		//$info=ReflectionClass::export($controller);
		//var_dump($info);
	}
	/**
	  @expectedException SystemException
	  */
	public function testNoController(){
		$mapper=new UrlMapper("noController");
		$controller=$mapper->getController();
		$controllerClassName=get_class($controller);
	}
	function testDefaultController(){
		$mapper=new UrlMapper("");
		$controller=$mapper->getController();
		$controllerClassName=get_class($controller);
		$this->assertEquals("IndexController",$controllerClassName);
	}
	function testDefaultMethod(){
		$mapper=new UrlMapper("keysub");
		$method=$mapper->getMethod();
		$this->assertEquals("index",$method);
	}
	function testMethod(){
		$mapper=new UrlMapper("keysub/index/get");
		$method=$mapper->getMethod();
		$this->assertEquals("get",$method);
	}
	
	/**
	  @expectedException SystemException
	  */
	function testNoMethod(){
		$mapper=new UrlMapper("keysub/index/noMethod");
		$method=$mapper->getMethod();
	}
}


class IndexAction{
    public function index(){
    }
    public function get(){
    }
}
class KeysubController extends BaseController{
    
}
class IndexController extends BaseController{
    
}
