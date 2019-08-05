<?php

class Router {
    private $routes;
    public function __construct()
    {
        $routesPath= ROOT.'/config/routes.php'; // указываем путь к роутам
        $this->routes = include($routesPath); // присваиваем свойству routes массив
    }
    
    public function run()
    {
//        print_r($this->routes);
//        echo 'Class Router, method run';
        // Получить строку запроса
        
        // Проверить наличие такого запроса в routes.php
        
        // если есть совпадение, определить какой контроллер
        // и action обрабатывабт запрос
        
        //Подключить файл класса-контроллера
        
        //Создать объект, вызвать метод (т.е. action)
        
        
        
        
        
    }
}
