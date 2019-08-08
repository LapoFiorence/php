<?php

include_once ROOT. '/models/News.php';

class NewsController
{
    public function actionIndex()
    {
        echo 'Список новостей';
    }
    
    public function actionView()
    {
        echo 'Просмотр одной новости';
        
        return true;
    }
}

