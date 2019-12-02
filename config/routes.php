<?php
return array(
    'product/([0-9]+)'=>'product/view/$1', // actionView в ProductController

    'catalog'=>'catalog/index', // actionIndex в CatalogController
    'user/register'=>'user/register', // user registation page
    
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2',
    'category/([0-9]+)' => 'catalog/category/$1', // actionCategory в CatalogController
    
    'user/register' => 'user/register',
    
    'cabinet' => 'cabinet/index',

    '' => 'site/index', // actionIndex в SiteController
    'index.php' =>'site/index',
);

