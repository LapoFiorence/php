<?php
class News
{
    public static function getNewsItemById($id)// возвращает одну новость по id
    {
        $id = intval($id);
        
        if ($id) {
//            $host = 'localhost';
//            $dbname = 'mvc_site';
//            $user = 'root';
//            $password = '';
//            $db = new mysqli("mysql:host=$host;dbname=$dbname", $user, $password);
            
            $db = Db::getConnection();
            
            $result = $db->query('SELECT * from news WHERE id=' . $id);
            
//            $result->setFetchMode(PDO::FETCH_NUM);
//            $result->setFetchMode(PDO::FETCH_ASSOC);
            
            $newsItem = $result->fetch(); // fetch возвращает массив в котором содержатся все элементы
            
            return $newsItem;
        }
    }
    
    public static function getNewsList()// получение данных из БД
    {
        $db = Db::getConnection();
        
        $newsList = array();
        
        $result = $db->query('SELECT id, title, date, short_content' // описание запроса к БД
                . 'FROM news '
                . 'ORDER BY date DESC '
                . 'LIMIT 10');
        
        $i = 0;
        while($row = $result->fetch()){
            $newsList[$i] ['id'] = $row['id'];
            $newsList[$i] ['title'] = $row['title'];
            $newsList[$i] ['date'] = $row['date'];
            $newsList[$i] ['short_content'] = $row['short_content'];
            $i++;
        }
        
        return $newsList;
    }
}