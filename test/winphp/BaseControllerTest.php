<?php
require_once("PHPUnit/Framework.php");
if(!defined("ROOT_PATH")){
    define("ROOT_PATH",dirname(dirname(dirname(__FILE__)))."/");
}
require_once(ROOT_PATH."/winphp/base/UrlMapper.class.php");
require_once(ROOT_PATH."/winphp/base/BaseController.class.php");
require_once(ROOT_PATH."/winphp/base/DefaultView.class.php");
require_once(ROOT_PATH."/config/DefaultViewSetting.class.php");
require_once(ROOT_PATH."/winphp/Exception.class.php");
require_once(ROOT_PATH."/winphp/WinRequest.class.php");
require_once("/usr/local/soso/libsoso_ver1.0/smarty/Smarty.class.php");

class TestController extends BaseController{

}

class TestAction{
    public function index(){
        return false;
    }
}

class IFilter{
    public function beforeAction(){}
    public function afterAction(){}

}

class BaseControllerTest extends PHPUnit_Framework_TestCase {
    public function setUp(){
        $this->assertTrue(file_put_contents(ROOT_PATH."/app/view/test.tpl","this is a test template")>0);    
    }
    public function tearDown(){
        $this->assertTrue(unlink(ROOT_PATH."/app/view/test.tpl"));
    }
    public function testBeforeInterceptor(){
        $this->mockAction=$this->getMock("TestAction");
        $this->mockAction->expects($this->never())
            ->method("index");
        $mapper=$this->getMock('UrlMapper');
        $this->controller=new BaseController();
        $mapper->expects($this->once())
            ->method('getAction')
            ->will($this->returnValue($this->mockAction));
        $mapper->expects($this->once())
            ->method('getMethod')
            ->will($this->returnValue("index"));
        $mapper->expects($this->once())
            ->method('getController')
            ->will($this->returnValue($this->controller));
        WinRequest::setAttribute("mapper",$mapper);
        $this->mockInterceptor=$this->getMock("IFilter");
        $this->mockInterceptor->expects($this->once())
             ->method("beforeAction")
             ->will($this->throwException(new ModelAndViewException("test exception",1,"test.tpl",array("msg"=>'error'))));
        $this->controller->addInterceptor($this->mockInterceptor);
        $c=$mapper->getController();
        $c->process();
    }

    public function  testProcess(){
        $this->mockAction=$this->getMock("TestAction");
        $mapper=$this->getMock('UrlMapper');
        $this->controller=new BaseController();
        $mapper->expects($this->once())
            ->method('getAction')
            ->will($this->returnValue($this->mockAction));
        $mapper->expects($this->once())
            ->method('getMethod')
            ->will($this->returnValue("index"));
        $mapper->expects($this->once())
            ->method('getController')
            ->will($this->returnValue($this->controller));

        
        WinRequest::setAttribute("mapper",$mapper);
        $mapper=WinRequest::getAttribute("mapper");
        $this->mockAction->expects($this->once())
            ->method("index")
            ->will($this->returnValue(array(
                "view"=>'test.tpl',
                'model'=>array()
                )));
        $c=$mapper->getController();
        $c->process();
    }
}
