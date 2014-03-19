<?php

namespace Core;

class Db
{
    private static $conn = array();

    private function __construct()
    {
        
    }
    
    private static function connect($conn_name = 'default')
    {
        if(!isset(self::$conn[$conn_name])){
            $conf = Config::fetch('db.'.$conn_name);
            $dsn = "mysql:host=".$conf['host'].";port=".$conf['port'].";dbname=".$conf['dbname'];
            try{
                self::$conn[$conn_name] = new \PDO($dsn, $conf['username'], $conf['password']);
                self::$conn[$conn_name]->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::$conn[$conn_name]->setAttribute(\PDO::ATTR_EMULATE_PREPARES, FALSE);
            }catch(\PDOException $e){
                self::disconnect();
                echo $e->getMessage();
            }
        }
        return self::$conn[$conn_name];
    }
    
    public function disconnect($conn_name = 'default'){
        self::$conn[$conn_name] = null;
    }
    
    public function execute($sql, $params = null, $conn_name = 'default')
    {
        try{
            $conn = self::connect($conn_name);
            $stmt = $conn->prepare($sql);
            $stmt->execute($params);
        }catch(\PDOException $e){
            self::disconnect($conn_name);
            echo $e->getMessage();
        }
    }
    
    public function all($sql, $params = null, $fetch_style = \PDO::FETCH_OBJ, $conn_name = 'default')
    {
        $result = null;
        try{
            $conn = self::connect($conn_name);
            $stmt = $conn->prepare($sql);
            $stmt->execute($params);
            $result = $stmt->fetchAll($fetch_style);
        }catch(\PDOException $e){
            self::disconnect($conn_name);
            echo $e->getMessage();
        }
        return $result;
    }
    
    public function row($sql, $params = null, $fetch_style = \PDO::FETCH_OBJ, $conn_name = 'default')
    {
        $result = null;
        try{
            $conn = self::connect($conn_name);
            $stmt = $conn->prepare($sql);
            $stmt->execute($params);
            $result = $stmt->fetch($fetch_style);
        }catch(\PDOException $e){
            self::disconnect($conn_name);
            echo $e->getMessage();
        }
        return $result;
    }
    
    public function one($sql, $params = null, $conn_name = 'default')
    {
        $result = null;
        try{
            $conn = self::connect($conn_name);
            $stmt = $conn->prepare($sql);
            $stmt->execute($params);
            $result = $stmt->fetch(\PDO::FETCH_NUM);
            $result = $result[0];
        }catch(\PDOException $e){
            self::disconnect($conn_name);
            echo $e->getMessage();
        }
        return $result;
    }
}