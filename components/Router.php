<?php

class Router {
    private $routes;
    public function __construct()
    {
        $routesPath= ROOT.'/config/routes.php'; // указываем путь к роутам
        $this->routes = include($routesPath); // присваиваем свойству routes массив
    }
    
    private function getURI()//метод возвращает строку
    {
       if (!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'], '/'); 
    }
    }

    public function run()
    {     
//        print_r($this->routes);
//        echo 'Class Router, method run';
        // Получить строку запроса
        $uri = $this->getURI();
//        echo $uri;
        // Проверить наличие такого запроса в routes.php
        foreach ($this->routes as $uriPattern => $path){// для каждого маршрута, находящегося в массиве помещаем в переменную $uriPattern строку запроса из routes.php, а в переменную $path мы помещаем путь 'news/index'
//            echo "<br>$uriPattern -> $path"; //обязательны двойные кавычки
//            
            // Сравниваем $uriPattern и $uri
            if (preg_match("~$uriPattern~", $uri)){
                
                // Определить какой контроллер и action обрабатывают запрос
                $segments = explode('/', $path); // explode делит строку на две части
                
//                echo '<pre>';
//                print_r($segments);
//                echo '</pre>';
                $controllerName = array_shift($segments).'Controller'; // получение имени контроллера
                $controllerName = ucfirst($controllerName);
                
                $actionName = 'action'.ucfirst(array_shift($segments));
                
                //Подключить файл класса-контроллера
                $controllerFile = ROOT . '/controllers/' .// перенос
                        $controllerName . '.php';
                
                if (file_exists($controllerFile)){
                    include_once ($controllerFile);
                }
                
                //Создать объект, вызвать метод (т.е. action)
                $controllerObject = new $controllerName;
                $result = $controllerObject->$actionName();
                if ($result != null){
                    break;
                }
            }
        }
        
    }
        
        
        
        // если есть совпадение, определить какой контроллер
        // и action обрабатывабт запрос
        
        
        
        
        
        
        
        
        
    
}
