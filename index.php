<?php

// FRONT CONTROLLER

// 1. Общие настройки
ini_set('display_errors', 1);// отображение ошибок
error_reporting(E_ALL);

// 2. Подключение файлов системы(каркаса)
define('ROOT', dirname(__FILE__));//dirname(__FILE__)-путь к файлу на диске(функция dirname, псевдоконстанта __FILE__ )
//echo print_r('ROOT');
require_once (ROOT.'/components/Router.php');

// 3. Установка соединения с БД

// 4. Вызов Router
$router = new Router();// создание экземпляра класса Router
$router->run();// запускаем метод run(), передав на него управление