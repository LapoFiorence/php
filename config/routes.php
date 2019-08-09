<?php
return array(
    
<<<<<<< HEAD
    'news/([a-z]+)/([0-9]+)' => 'news/view/$1,$2',
    
//    'news' => 'news/index',
    'news' => 'view/index',// при запросе news будет вызван метод actionView в NewsController
=======
    'news/([a-z]+)/([0-9]+)' => 'news/view/$1/$2',
    
//    'news' => 'news/index',
    'products' => 'product/list',// при запросе news будет вызван метод actionView в NewsController
    'news' => 'news/index',
>>>>>>> 4cdef4e7109179c44e4bbbdfc6cfd18ec2ab6a36
//    'products' => 'product/list',
);

