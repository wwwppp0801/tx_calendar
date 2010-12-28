<?php 
define("ROOT_PATH", dirname(dirname(__FILE__)));
function __autoload($classname)
{
    static $classpath = array("Smarty"=>"/usr/local/soso/libsoso_ver1.0/smarty/Smarty.class.php",
             "Soso_Logger"=>"/usr/local/soso/libsoso_ver1.0/Logger.class.php",
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
             "BaseDataParser"=>"lib/BaseDataParser.class.php",
             "Balancer"=>"lib/Balancer.class.php",
             "XmlToArray"=>"lib/XmlToArray.class.php",
             "ServiceAPI"=>"lib/ServiceAPI.class.php", 
			 "DirtyManager"=>"lib/DirtyManager.class.php",
             "BaseDataUtils"=>'lib/BaseDataUtils.class.php');
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
            //�Ҳ����͵��������ĵط�ȥ��
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
