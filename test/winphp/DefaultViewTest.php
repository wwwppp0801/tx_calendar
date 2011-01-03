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
class DefaultViewTest extends PHPUnit_Framework_TestCase{
    public function setUp(){
        $this->assertTrue(file_put_contents(ROOT_PATH."/app/view/test1.tpl",'<{$msg}>')>0);    
    }
    public function tearDown(){
        $this->assertTrue(unlink(ROOT_PATH."/app/view/test1.tpl"));
    }
    public function testSmarty(){
        $msg="this is a message";
        $view=new DefaultView("test1.tpl",array("msg"=>$msg));
        $out=$view->render();
        $this->assertContains($msg,$out);
    } 
    /**
      @expectedException SystemException
     */
    public function testNoTemplate(){
        $msg="this is a message";
        $view=new DefaultView("notExist.tpl",array("msg"=>$msg));
        $out=$view->render();
    } 
    public function testRedirect(){
        $msg="this is a message";
        $view=new DefaultView("redirect:http://www.soso.com",array("msg"=>$msg));
        $out=$view->render();
    } 
    public function testJson(){
        $model=array("msg"=>"this is a message");
        $view=new DefaultView("json:http://www.soso.com",$model);
        $out=$view->render();
        $this->assertEquals("httpwwwsosocom(".json_encode($model).");",$out);
    } 
    public function testText(){
        $model=array("msg"=>"this is a message");
        $view=new DefaultView("text:testtest",$model);
        $out=$view->render();
        $this->assertEquals("testtest",$out);
    } 
}
