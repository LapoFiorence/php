<?php

// include_once ROOT. '/models/News.php';

class NewsController
{
    public function actionIndex()
    {
<<<<<<< HEAD
        // $newsList = array();
        // $newsList = News::getNewsList();
=======
        $newsList = array();
        $newsList = News::getNewsList(); // статический метод
>>>>>>> 4cdef4e7109179c44e4bbbdfc6cfd18ec2ab6a36
        
        // echo '<pre>';
        // print_r($newsList);
        // echo '</pre>';
        
        // return true;
    }
    
    public function actionView($category, $id)
    {
        echo '<br>'.$category;
        echo '<br>'.$id;
        
        return true;
    }
}

