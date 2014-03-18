<?php

namespace Core;

class Config
{
    private static $config_items = array();
    
    public static function load($config_path)
    {
        self::$config_items = include $config_path;
    }
    
    public static function set($key, $value)
    {
        self::$config_items[$key] = $value;
    }
    
    public static function get($key, $default = null)
    {
        if(isset(self::$config_items[$key])){
            return self::$config_items[$key];
        }
        return $default;
    }
    
    public static function fetch($key, $default=null)
    {
        $nested = explode('.',$key);
        array_unshift($nested, self::$config_items);
        $exists = call_user_func_array(__CLASS__.'::exists', $nested);
        if($exists !== null){
            return $exists;
        }
        return $default;
    }
    
    public static function has($key)
    {
        if(isset(self::$config_items[$key])){
            return true;
        }
        return false;
    }
    
    protected static function exists()
    {
        $args = func_get_args();
        $arr = array_shift($args);
        if(empty($args)){
            return false;
        }
        foreach($args as $key){
            if(!isset($arr[$key])){
                return false;
            }
            $arr = $arr[$key];
        }
        return $arr;
    }
}