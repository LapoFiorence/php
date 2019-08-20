<?php


class ProductController
{
     /**
     * Action для страницы просмотра товара
     * @param integer $productId <p>id товара</p>
     */
    
    public function actionView($productId)
    {
        require_once(ROOT . '/views/product/view.php');
        
        return true;
    }
}
