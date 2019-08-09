<?php

class Router {
    private $routes;
    public function __construct()
    {
        $routesPath= ROOT.'/config/routes.php'; // указываем путь к роутам

        $this->routes = include($routesPath); // присваиваем свойству routes массив
        echo $routesPath;

        $this->routes = include($routesPath); // присваиваем свойству routes массив, который хранится в файле routes.php

    }
    
    private function getURI()//метод возвращает строку
    {
       if (!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'], '/'); 
    }
    }

    public function run()// отвечает за анализ запроса и передачу управления
    {     
//         Получить строку запроса
        $uri = $this->getURI();
        echo $uri;
//        print_r($this->routes);//проверка
        
        // Проверить наличие такого запроса в routes.php
        foreach ($this->routes as $uriPattern => $path){// для каждого маршрута, находящегося в массиве помещаем в переменную $uriPattern строку запроса из routes.php, а в переменную $path мы помещаем путь 'news/index'
           echo "<br>$uriPattern -> $path"; //обязательны двойные кавычки
//            
            // Сравниваем $uriPattern и $uri
            if (preg_match("~$uriPattern~", $uri)){
                
//                echo '<br>Где ищем (запрос, который набрал пользователь): '.$uri;
//                echo '<br>Что ищем (совпадение из правила): '.$uriPattern;
//                echo '<br>Кто обрабатывает: '.$path;
//                
                //Получаем внутренний путь из внешнего согласно правилу.
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri); // в строке запроса мы ищем параметры $path и $uri по определенному шаблону $uriPattern
                
//                echo '<br><br>Нужно сформировать: '.$internalRoute;
                
                
                // Определить какой контроллер и action обрабатывают запрос
                $segments = explode('/', $internalRoute); // explode делит строку на две части
//                echo '<pre>';
//                print_r($segments);
//                echo '</pre>';
                
                $controllerName = array_shift($segments).'Controller'; // получение имени контроллера, функция array_shift получает значение первого элемента в массиве и удаляет его из массива
//                echo $controllerName;
                $controllerName = ucfirst($controllerName);
                echo $controllerName;
                
                $actionName = 'action'.ucfirst(array_shift($segments));
                
                                
                echo '<br>controller name: '.$controllerName;
                echo '<br>action name: '.$actionName;
                $parameters = $segments;
                echo '<pre>';
                print_r($parameters);
                
                die;
                
                //Подключить файл класса-контроллера

                $controllerFile = ROOT . '/controller/' .// перенос
                $controllerName . '.php';

                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php'; 

                
                if (file_exists($controllerFile)){
                    include_once ($controllerFile);
                }
                

                // Создать объект, вызвать метод (т.е. action)
                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                //Создать объект класса контроллера, вызвать метод (т.е. action)
                $controllerObject = new $controllerName; // вместо имени класса подставляем переменную $controllerName, которая содержит строку с именем этого класса
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);// функция вызывает action с именем, содержащимся в $actionName у объекта $controllerObject

                if ($result != null){
                    break;
                }
            }
        }
        
    }
        
        
        
        // если есть совпадение, определить какой контроллер
        // и action обрабатывабт запрос
        
        
        
        
        
        
        
        
        
    
}
