<?php

namespace Core;

class Autoloader
{
    private static $paths = array();
    
    public static function add(array $routes)
    {
        self::$paths = $routes;
    }
    
	public static function register()
    {
        spl_autoload_register(array(new self, 'autoload'), true);
    }
    
    public static function autoload($class_name)
    {
        $class_name = ltrim($class_name, '\\');
        
        foreach(self::$paths as $ns => $p)
        {
            if(strpos($class_name, $ns) === 0)
            {
                $rest_of_ns = str_replace($ns, '', $class_name);
                $file_name = $p.'/'.str_replace('\\', '/', $rest_of_ns).'.php';
                
                require $file_name;
                break;
            }
        }
    }
}
