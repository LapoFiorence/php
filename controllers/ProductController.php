<?php

include_once ROOT . '/models/Category.php';
include_once ROOT . '/models/Product.php';

class ProductController
{
     /**
     * Action для страницы просмотра товара
     * @param integer $productId <p>id товара</p>
     */
    
    public function actionView($productId)
    {
        $categories = array();
        $categories = Category::getCategoriesList();
        
        $product = Product::getProductById($productId);
        
        require_once(ROOT . '/views/product/view.php');
        
        return true;
    }
}
