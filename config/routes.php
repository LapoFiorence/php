<?php
return array(
    'product'=>'product/view/$1', // actionView в ProductController
    
    'catalog'=>'catalog/index', // actionIndex в CatalogController
    'category/([0-9]+)' => 'catalog/category/$1', // actionCategory в CatalogController
    
    '' => 'site/index', // actionIndex в SiteController
    'index.php' =>'site/index',
);

