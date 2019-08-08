<?php
return array(
    
    'news/([a-z]+)/([0-9]+)' => 'news/view/$1',
    
//    'news' => 'news/index',
    'products' => 'product/list',// при запросе news будет вызван метод actionView в NewsController
    'news' => 'news/index',
//    'products' => 'product/list',
);

