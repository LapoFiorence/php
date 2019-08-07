<?php

// FRONT CONTROLLER

// 1. Общие настройки
ini_set('display_errors', 1);// отображение ошибок
error_reporting(E_ALL);

// 2. Подключение файлов системы
define('ROOT', dirname(__FILE__));
//echo print_r('ROOT');
require_once (ROOT.'/components/Router.php');

// 3. Установка соединения с БД

// 4. Вызов Router
$router = new Router();
$router->run();