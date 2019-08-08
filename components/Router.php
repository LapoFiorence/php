<?php

class Router {
    private $routes;
    public function __construct()
    {
        $routesPath= ROOT.'/config/routes.php'; // указываем путь к роутам
        $this->routes = include($routesPath); // присваиваем свойству routes массив
        echo $routesPath;
    }
    
    private function getURI()//метод возвращает строку
    {
       if (!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'], '/'); 
    }
    }

    public function run()
    {     
//         Получить строку запроса
        $uri = $this->getURI();
        
        
        
        // Проверить наличие такого запроса в routes.php
        foreach ($this->routes as $uriPattern => $path){// для каждого маршрута, находящегося в массиве помещаем в переменную $uriPattern строку запроса из routes.php, а в переменную $path мы помещаем путь 'news/index'
           echo "<br>$uriPattern -> $path"; //обязательны двойные кавычки
//            
            // Сравниваем $uriPattern и $uri
            if (preg_match("~$uriPattern~", $uri)){
                
                echo '<br>Где ищем (запрос, который набрал пользователь): '.$uri;
                echo '<br>Что ищем (совпадение из правила): '.$uriPattern;
                echo '<br>Кто обрабатывает: '.$path;
//                
                //Получаем внутренний путь из внешнего согласно правилу.
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri); // в строке запроса мы ищем параметры $path и $uri по определенному шаблону $uriPattern
                
                echo '<br><br>Нужно сформировать: '.$internalRoute;
                
                
                // Определить какой контроллер и action обрабатывают запрос
                $segments = explode('/', $internalRoute); // explode делит строку на две части
                                
                $controllerName = array_shift($segments).'Controller'; // получение имени контроллера
                $controllerName = ucfirst($controllerName);
                echo $controllerName;
                
                $actionName = 'action'.ucfirst(array_shift($segments));
                
                                
                echo '<br>controller name: '.$controllerName;
                echo '<br>action name: '.$actionName;
                $parameters = $segments;
                
                
//                die;
                
                //Подключить файл класса-контроллера
                $controllerFile = ROOT . '/controller/' .// перенос
                $controllerName . '.php';
                
                if (file_exists($controllerFile)){
                    include_once ($controllerFile);
                }
                
                // Создать объект, вызвать метод (т.е. action)
                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                if ($result != null){
                    break;
                }
            }
        }
        
    }
        
        
        
        // если есть совпадение, определить какой контроллер
        // и action обрабатывабт запрос
        
        
        
        
        
        
        
        
        
    
}
