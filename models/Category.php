<?php

class Category
{
    public static function getCategoriesList()//возвращает список категорий
    {
        $db = Db::getConnection();
        
        $result = $db->query('SELECT id, name FROM category'
                . 'ORDER BY sort_order ASC');
        
        $categoryList = array();
                        
        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $i++;
        }
        
        return $categoryList;
    }
}