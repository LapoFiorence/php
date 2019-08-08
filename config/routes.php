<?php
return array(
    
    'news/([a-z]+)/([0-9]+)' => 'news/view/$1,$2',
    
//    'news' => 'news/index',
    'news' => 'view/index',// при запросе news будет вызван метод actionView в NewsController
//    'products' => 'product/list',
);

