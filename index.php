<?php

// Format: dd-mm-yyyy
$srring = '21-11-2019';

$pattern = '/([0-9]{2}) - ([0-9]{2}) - ([0-9]{4})/';

$replacement = 'Год $3, месяц $2, день $1';

echo preg_replace($pattern, $replacement, $string);

die;
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