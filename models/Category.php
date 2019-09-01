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
}
