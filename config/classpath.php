<?php 
define("ROOT_PATH", dirname(dirname(__FILE__)));
function __autoload($classname)
{
	static $classpath = array("Smarty"=>"/usr/share/php/smarty/Smarty.class.php",
		"UrlMapper"=>"winphp/base/UrlMapper.class.php",
		"SystemException"=>"winphp/Exception.class.php",
		"BizException"=>"winphp/Exception.class.php",
		"ModelAndViewException"=>"winphp/Exception.class.php",
		"Interceptor"=>"winphp/base/Interceptor.class.php",
		"WinRequest"=>"winphp/WinRequest.class.php",
		"BaseController"=>"winphp/base/BaseController.class.php",
		"DefaultView"=>"winphp/base/DefaultView.class.php",
		"DefaultViewSetting"=>"config/DefaultViewSetting.class.php",
		"Utils"=>"lib/Utils.class.php",
		"Soso_Logger"=>"lib/Logger.class.php",
		"PDOTemplate"=>"winphp/db/PDOTemplate.class.php",
	);
	$file = $classpath[$classname];
	if (! empty($file))
	{
		if ($file[0] == '/')
		{
			include_once ($file);
		}
		else
		{
			include_once (ROOT_PATH.'/'.$file);
		}
	}
	else
	{
		if (preg_match("/Controller$/", $classname))
		{
			$classFile = ROOT_PATH."/app/controller/$classname.class.php";
			if (file_exists($classFile))
			{
				include_once ($classFile);
			}
		}
		else if (preg_match("/Model$/", $classname))
		{
			$path = preg_replace('/([a-z])([A-Z])/', '$1/$2', $classname);
			$path = explode("/", $path);
			$path = array_map("strtolower", $path);
			array_pop($path);
			$path = implode("/", $path);
			$classFile = ROOT_PATH."/app/model/$path/$classname.class.php";
			//var_dump($classFile);
			if (file_exists($classFile))
			{
				include_once ($classFile);
			}
		}
		else if (preg_match("/Interceptor/", $classname))
		{
			$classFile = ROOT_PATH."/app/interceptor/$classname.class.php";
			if (file_exists($classFile))
			{
				include_once ($classFile);
			}
		}else
			{
				//找不到就到更基础的地方去找
				if (file_exists('/usr/local/soso/libsoso_ver1.0/Loader.class.php'))
				{
					require_once ('/usr/local/soso/libsoso_ver1.0/Loader.class.php');
					return Soso_Loader::load($classname);
				}
				else
				{
					return false;
				}
			}
	}
}
