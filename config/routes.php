<?php
return array(
    
    'news/([a-z]+)/([0-9]+)' => 'news/view/$1',
    
//    'news' => 'news/index',
    'news' => 'news/index',// при запросе news будет вызван метод actionView в NewsController
//    'products' => 'product/list',
);

