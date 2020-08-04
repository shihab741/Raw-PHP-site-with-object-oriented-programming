<?php

/**
 *
 * This class takes care of frontend url.
 *
 */
namespace App\classes;

class simpleUrl
{
	var $site_path;

	function __construct($site_path)
	{
		$this->site_path = $this->removeSlash($site_path);
	}

	function __toString(){
		return $this->site_path;
	}


	private function removeSlash($string)
	{
		if($string[strlen($string) - 1] == '/')
		{
			$string = rtrim($string, '/');
		}
		return $string;
	}

	function segment($segment)
	{
		$url = str_replace($this->site_path, '', $_SERVER['REQUEST_URI']);
		$url = explode('/', $url);

		if(isset($url[$segment]))
			return $url[$segment];
		else
			return false;

	}

    function getBaseUrl() 
    {
        // output: /myproject/index.php
        $currentPath = $_SERVER['PHP_SELF']; 
        
        // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
        $pathInfo = pathinfo($currentPath); 
        
        // output: localhost
        $hostName = $_SERVER['HTTP_HOST']; 
        
        // output: http://
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
        
        // return: http://localhost/myproject/
        return $protocol.$hostName.$pathInfo['dirname']."/";
    }

     function getBaseUrlForAdminPanel() 
    {
        // output: /myproject/index.php
        $currentPath = $_SERVER['PHP_SELF']; 
        
        // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
        $pathInfo = pathinfo($currentPath); 
        
        // output: localhost
        $hostName = $_SERVER['HTTP_HOST']; 
        
        // output: http://
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
        
        // return: http://localhost/myproject/
        $baseUrl = $protocol.$hostName.$pathInfo['dirname']."/";

        $baseUrlForAdminPanel = rtrim($baseUrl, 'admin/').'/';

        return $baseUrlForAdminPanel;

    }

}