<?php

namespace Core;

class Application
{
    
    public static function run($dispatcher)
    {
        list($module_name, $controller_name, $action_name, $args) = $dispatcher->get_controller_action_args($dispatcher->parse_uri());
        
        if(!empty($module_name))
        {
            if(!empty($controller_name))
            {
                $cname = 'Controller\\'.$module_name.'\\'.$controller_name;
            }
            else
            {
                $cname = 'Controller\\'.$module_name.'\\Home';
            }
        }
        else
        {
            if(!empty($controller_name))
            {
                $cname = 'Controller\\'.$controller_name;
            }
            else
            {
                $cname = 'Controller\Home';
            }
        }

        if(empty($action_name))
        {
            $action_name = 'index';
        }

        try
        {
            $controller = new $cname();
            if(method_exists($controller, $action_name))
            {
                call_user_func_array(array($controller, $action_name), $args);
            }
            else
            {
                throw new \Exception('Action not found');
            }
        }
        catch(\Exception $e)
        {
            $args[1] = $e->getMessage();
            $controller = new \Controller\Error();
            call_user_func_array(array($controller, 'handle'), $args);
        }
    }
}
