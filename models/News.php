<?php
class News
{
    public static function getNewsItemById($id)// возвращает одну новость по id
    {
        //Запрос к БД
    }
    
    public static function getNewsList()// получение данных из БД
    {
        $host = 'localhost';
        $dbname = 'mvc_site';
        $user = 'root';
        $password = '';
        $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);// при помощи объекта $db происходит общение с БД
        
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