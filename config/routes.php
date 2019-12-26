<?php
return array(
    'product/([0-9]+)'=>'product/view/$1', // actionView в ProductController

    'catalog'=>'catalog/index', // actionIndex в CatalogController
    'user/register'=>'user/register', // user registation page
    
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2',
    'category/([0-9]+)' => 'catalog/category/$1', // actionCategory в CatalogController
    
    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1',
    'cart/add/([0-9]+)' => 'cart/add/$1',
    
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    
    'cabinet/edit' => 'cabinet/edit',
    'cabinet' => 'cabinet/index',
    
    'contacts' => 'site/contact',

    '' => 'site/index', // actionIndex в SiteController
    'index.php' =>'site/index',
);

