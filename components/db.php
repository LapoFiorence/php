<?php

class Db
{
    public static function getConnection()// статический метод
    {
        $paramsPath = ROOT . '/config/db_params.php';
        $params = include($paramsPath); // получаем параметры соединения
        
        
        $dsn = "mysql:host={$params['host']}; dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);
        
        $db->exec("set names utf8");
        
        return $db;
    }
}

