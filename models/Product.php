<?php

class Product
{
    const SHOW_BY_DEFAULT = 3;
    
    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT)
    {
        $count = intval($count);
        
        $db = Db::getConnection();
        
        $productsList = array();
        
        $result = $db->query('SELECT id, name, price, is_new FROM product WHERE status = 1 ORDER BY id DESC');
//                
        
        $i = 0;
        while ($row = $result->fetch()){
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
//            $productsList[$i]['image'] = $row['image'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        
        return $productsList;
    }
}
