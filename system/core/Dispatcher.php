<?php

namespace Core;

class Dispatcher
{
    private $uri;
    
    function __construct($uri)
    {
        $this->uri = $uri;
    }
    
	public function parse_uri()
    {
        $real_uri = preg_replace(
            array('~^'.APP_FOLDER.'~', '~index.php~'),
            '',
            $this->uri,
            1
        );
        
        $uri_array = explode('/', $real_uri);
        
        if(empty($uri_array[0]))
        {
            array_shift($uri_array);
        }
        
        if(empty($uri_array[count($uri_array)-1]))
        {
            array_pop($uri_array);
        }
        
        return $uri_array;
    }

    public function get_controller_action_args($uri_array)
    {
        $module = '';
        $first_part = isset($uri_array[0]) ? $uri_array[0] : '';
        if(in_array($first_part, Config::get('modules')))
        {
            $module = array_shift($uri_array);
        }
        $controller = array_shift($uri_array);
        $action = array_shift($uri_array);
        $args = $uri_array;
        
        return array(ucfirst($module), ucfirst($controller), $action, $args);
    }
}
