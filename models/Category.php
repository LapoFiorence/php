<?php

class Category
{
    public static function getCategoriesList()//возвращает список категорий
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT id, name FROM category WHERE status = 1 ORDER BY sort_order, name ASC');

        $categoryList = array();

        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $i++;
        }
        return $categoryList;

//        $con = mysqli_connect("localhost", "root", "root", "super_mag");
//        if (mysqli_connect_errno()){
//            echo "Failed to connect to MySQL: " . mysqli_connect_error();
//        }
//
//        $result = mysqli_query($con, 'SELECT `id`, `name` * FROM `category` WHERE status = `1` ORDER BY `sort_order`, name ASC');
//
//        $i = 0;
//        while ($row = mysqli_fetch_array($result)){
//            $categoryList[$i]['id'] = $row['id'];
//            $categoryList[$i]['name'] = $row['name'];
//            $i++;
//        }
    }

    public static function getProductsListByCategory($categoryId = false)
    {
        if ($categoryId) {
            $db = Db::getConnection();
            $products = array();
            $result = $db->query("SELECT id, name, price, is_new FROM product WHERE status = 1 AND category_id = '$categoryId' ORDER BY id DESC");
//                    . "WHERE status = 1 AND category_id = '$categoryId'"
//                    . "ORDER BY id DESC");
//                    . "LIMIT".self::SHOW_BY_DEFAULT);

            $i = 0;
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
}
