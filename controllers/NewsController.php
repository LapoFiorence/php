<?php

 include_once ROOT. '/models/News.php';

class NewsController
{
    public function actionIndex()
    {

        // $newsList = array();
        // $newsList = News::getNewsList();

        $newsList = array();
        $newsList = News::getNewsList(); // статический метод
        
        require_once (ROOT.'/views/news/index.php');

        
        // echo '<pre>';
        // print_r($newsList);
        // echo '</pre>';
        
         return true;
    }
    
    public function actionView($category, $id)
    {
        echo '<br>'.$category;
        echo '<br>'.$id;
        
        return true;
    }
}

