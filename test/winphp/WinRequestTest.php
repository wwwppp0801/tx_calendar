<?php
require_once("PHPUnit/Framework.php");
if (!defined("ROOT_PATH")){
    define("ROOT_PATH",dirname(dirname(dirname(__FILE__)))."/");
}
require_once(ROOT_PATH."/winphp/WinRequest.class.php");

class WinRequestTest extends PHPUnit_Framework_TestCase {
    public function testAttribute(){
		$this->assertNull(WinRequest::getAttribute("foo"));
		$mapper=array("keysub/index");
		WinRequest::setAttribute("foo",$mapper);
		$this->assertSame($mapper,WinRequest::getAttribute("foo"));
	}
    /*
	public function testParam(){
		$this->assertNull(WinRequest::getParameter("aa"));
		WinRequest::setParameter("aa","value");
		$this->assertEquals("value",WinRequest::getParameter("aa"));
	}
*/
	
}

