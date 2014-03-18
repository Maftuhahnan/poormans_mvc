<?php

namespace Controller;

use Core\Controller;

class Home extends Controller
{
	public function index()
    {
        echo 'welcome to php mvc framework';
    }
    
    public function hello($name = "rully")
    {
        $this->render_layout('hello', array('name'=>$name));
    }
}