<?php

class Product
{
    const SHOW_BY_DEFAULT = 3;

    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT)
    {
        $count = intval($count);

        $db = Db::getConnection();

        $productsList = array();

        $result = $db->query("SELECT id, name, price, is_new FROM product "
                . "WHERE status = 1 "
                . "ORDER BY id DESC "
                . "LIMIT " . $count);

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
    
    public static function getProductById($id)
    {
        $id = intval($id);
        
        if ($id) {
            $db = Db::getConnection();
            
            $result = $db->query('SELECT * FROM product WHERE id=' . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            
            return $result->fetch();
        }
    }
     public static function getProductsListByCategory($categoryId = false, $page = 1)
    {
        if ($categoryId) {
            
//            $limit = Product::SHOW_BY_DEFAULT;
            
            $page = intval($page);
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
            
            $db = Db::getConnection();
            $products = array();
            $result = $db->query(" SELECT id, name, price, is_new FROM product "
                        . " WHERE status = 1 AND category_id = '$categoryId' " 
                        . " ORDER BY id ASC "
                        . " LIMIT ". self::SHOW_BY_DEFAULT
                        . " OFFSET ". $offset);
//                    . "WHERE status = 1 AND category_id = '$categoryId'"
//                    . "ORDER BY id DESC");
//                    . "LIMIT".self::SHOW_BY_DEFAULT);
            
//            $result = $db->prepare($sql);
//            $result->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
//            $result->bindParam(':limit', $limit, PDO::PARAM_INT);
//            $result->bindParam(':offset', $offset, PDO::PARAM_INT);
//            
//            $result->execute();

            $i = 0;
//            $products = array();
            while ($row = $result->fetch()) {
                $products[$i]['id'] = $row['id'];
                $products[$i]['name'] = $row['name'];
                $products[$i]['price'] = $row['price'];
                $products[$i]['is_new'] = $row['is_new'];
                $i++;
            }

            return $products;
        }
    }
    
    public static function getTotalProductsInCategory($categoryId)
    {
        $db = Db::getConnection();
        
        $result = $db->query('SELECT count(id) AS count FROM product '
                . 'WHERE status="1" AND category_id ="'.$categoryId.'"');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        
        return $row['count'];
    }
    
      public static function getProdustsByIds($idsArray)
    {
        $products = array();  
        // Соединение с БД
        $db = Db::getConnection();
        // Превращаем массив в строку для формирования условия в запросе
        $idsString = implode(',', $idsArray);
        // Текст запроса к БД
        $sql = "SELECT * FROM product WHERE status='1' AND id IN ($idsString)";
        $result = $db->query($sql);
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        // Получение и возврат результатов
        $i = 0;
        $products = array();
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }
        return $products;
    }

}
