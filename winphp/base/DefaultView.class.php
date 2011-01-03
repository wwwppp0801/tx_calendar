<?php 
function smarty_modifier_startWith($string, $startStr)
{
    return (strncmp($string, $startStr, strlen($startStr)) === 0);
}


function smarty_modifier_toUTF8($string)
{
    return Utils::toUTF8($string);
}

function smarty_modifier_toGBK($string)
{
    return Utils::toGBK($string);
}

function smarty_modifier_decodeURIComponent($string)
{
	return Utils::_decodeURIComponent($string);
}

function smarty_function_json_encode($params)
{
    return json_encode($params['obj']);
}

class DefaultView
{
    private $templateFile;
    private $local;
    private $data;
    
    public function DefaultView($view, $model)
    {
        $this->data = $model;
        $this->templateFile = $view;
    }
    
    public function render()
    {
        if (strstr($this->templateFile, "redirect:"))
        {
            $url = substr($this->templateFile, strlen("redirect:"));
            header("Location:".$url);
            return "";
        }
        if (strstr($this->templateFile, "json:"))
        {
            if($this->templateFile=='json:'){
                $callback = WinRequest::getParameter('callback');
            }else{
                $callback = substr($this->templateFile, strlen("json:"));
            }
            $callback = preg_replace("/[^a-zA-Z0-9_]/", "", $callback);
            return $callback."(".json_encode($this->data).");";
        }
        if (strstr($this->templateFile, "text:"))
        {
            $text = substr($this->templateFile, strlen("text:"));
            return $text;
        }
        else
        {
            return $this->getRenderOutput();
        }
    }
    
    private function getRenderOutput()
    {
        $template = DefaultViewSetting::getTemplate();
        if (!file_exists(DefaultViewSetting::getRootDir().$this->templateFile))
        {
            throw new SystemException("no this template:".$this->templateFile);
        }
        DefaultViewSetting::setTemplateSetting($template);
		//var_dump($this->data);
        $template->register_modifier('startWith', 'smarty_modifier_startWith');
        $template->register_modifier('toUTF8', 'smarty_modifier_toUTF8');
        $template->register_modifier('toGBK', 'smarty_modifier_toGBK');
		$template->register_modifier('decodeURIComponent', 'smarty_modifier_decodeURIComponent');
        $template->register_function('json_encode', 'smarty_function_json_encode');
        $template->assign($this->data);

        return $template->fetch($this->templateFile);
    }
    
}



