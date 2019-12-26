<?php
include_once ROOT . '/models/Category.php';
include_once ROOT . '/models/Product.php';

class SiteController
{
    public function actionIndex()
    {
        $categories = array();
        $categories = Category::getCategoriesList();
        
        $latestProducts = array();
        $latestProducts = Product::getLatestProducts(3);
        
        require_once(ROOT . '/views/site/index.php');
        
        return true;
    }
    
    public static function actionContact()
    {
        $userEmail = '';
        $userText = '';
        $result = false;
        
        if (isset($_POST['submit'])){
            
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];
            
            $errors = false;
            
            // Валидация полей
            if (!User::checkEmail($userEmail)){
                $errors[] = 'Неправильный email';
            }
            
            if ($errors == false){
                $adminEmail = 'dolgova_v@mail.ru';
                $message = "Текст: {$userText}. От{$userEmail}";
                $subject = 'Тема письма';
                $result = mail($adminEmail, $subject, $message);
                $result = true;
            }
        }
        
        
        $mail = 'dolgova_v@mail.ru';
        $subject = 'Тема письма';
        $message = 'Содержание письма';
        $result = mail($mail, $subject, $message);
        
        var_dump($result);
        
        die;
    }
}
