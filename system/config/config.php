<?php

return array(
    'timezone' => 'Asia/Jakarta',
    
    'db' => array(
        'default' => array(
            'host' => 'localhost',
            'port' => '3306',
            'username' => 'root',
            'password' => '',
            'dbname' => 'sakila'
        ),
    ),
    
    'debug' => true,
    
    'modules' => array(
        'admin',
    ),
);