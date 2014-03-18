<?php

namespace Core;

abstract class Controller
{
	public $layout = "layout";
    public $title = "title";
    protected $regions = array();
    
    public function render($_view, $_data, $_print = true)
    {
        extract($_data);
        
        $view_filepath = SYS_PATH.'/views/'.$_view.'.php';
        
        if(!file_exists($view_filepath))
        {
            throw new Exception('View doesn\'t exist');
        }
        
        if(!$_print)
        {
            ob_start();
        }
        
        require $view_filepath;
        
        if(!$_print)
        {
            return ob_get_clean();
        }
    }
    
    public function render_layout($_view, $_data)
    {
        extract($_data);
        
        $view_filepath = SYS_PATH.'/views/'.$_view.'.php';
        
        if(!file_exists($view_filepath))
        {
            throw new Exception('View doesn\'t exist');
        }
        
        ob_start();
        
        require $view_filepath;
        
        $content = ob_get_clean();
        
        require SYS_PATH.'/views/'.$this->layout.'.php';
    }
    
    public function start_region($key)
    {
        ob_start();
        $this->regions[$key] = '';
    }
    
    public function end_region()
    {
        end($this->regions);
        $key = key($this->regions);
        $this->regions[$key] = ob_get_clean();
    }
    
    public function region($key)
    {
        if(isset($this->regions[$key]))
        {
            return $this->regions[$key];
        }
    }
}