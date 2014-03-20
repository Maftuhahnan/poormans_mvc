<?php

namespace Controller;

use Core\Controller;
use Core\Db;

class Home extends Controller
{
	public function index()
    {
        $this->render_layout('index');
    }
    
    public function hello($name = "rully")
    {
        $this->render_layout('hello', array('name'=>$name));
    }
    
    public function get_db()
    {
        $cities = Db::all('select * from city limit 30');
        
        $this->render('get_db', array('cities' => $cities));
    }
    
    public function one_row($id)
    {
        $film = Db::row('select * from film where film_id = :id limit 1', array(':id' => $id));
        
        $this->render('one_row', array('film' => $film));
    }
}