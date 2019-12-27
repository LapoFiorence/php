<?php

class CartController
{
    public function actionAdd($id)
    {
        Cart::addProduct($id);
                
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
    }
    
    public function actionAddAjax($id)
    {
        echo Cart::addProduct($id);
        return true;
               
    }
    
    public function actionIndex()
    {
        $categories = array();
        // Список категорий для левого меню
        $categories = Category::getCategoriesList();
        // Получим идентификаторы и количество товаров в корзине
        $productsInCart = false;
        
        $productsInCart = Cart::getProducts();
        if ($productsInCart) {
            // Если в корзине есть товары, получаем полную информацию о товарах для списка
            // Получаем массив только с идентификаторами товаров
            $productsIds = array_keys($productsInCart);
            // Получаем массив с полной информацией о необходимых товарах
            $products = Product::getProdustsByIds($productsIds);
            // Получаем общую стоимость товаров
            $totalPrice = Cart::getTotalPrice($products);
        }
        // Подключаем вид
        require_once(ROOT . '/views/cart/index.php');
        return true;
    }
    
    /**
     * Action для страницы "Оформление покупки"
     */
    public function actionCheckout()
    {
        $categories = array();
        $categories = Category::getCategoriesList();
        
        // Статус успешного оформления заказа
        $result = false;
        
        // Получием данные из корзины      
        $productsInCart = Cart::getProducts();
        // Если товаров нет, отправляем пользователи искать товары на главную
        if ($productsInCart == false) {
            header("Location: /");
        } else {
        
            // Находим общую стоимость
            $productsIds = array_keys($productsInCart);
            $products = Product::getProdustsByIds($productsIds);
            $totalPrice = Cart::getTotalPrice($products);
            // Количество товаров
            $totalQuantity = Cart::countItems();
            // Поля для формы
            $userName = false;
            $userPhone = false;
            $userComment = false;
            // Статус успешного оформления заказа
            $result = false;
            // Проверяем является ли пользователь гостем
            if (!User::isGuest()) {
                // Если пользователь не гость
                // Получаем информацию о пользователе из БД
                $userId = User::checkLogged();
                $user = User::getUserById($userId);
                $userName = $user['name'];
                } else {
                    // Если гость, поля формы останутся пустыми
                    $userId = false;
                }
            }
        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];
            // Флаг ошибок
            $errors = false;
            // Валидация полей
            if (!User::checkName($userName)) {
                $errors[] = 'Неправильное имя';
            }
            if (!User::checkPhone($userPhone)) {
                $errors[] = 'Неправильный телефон';
            }
            if ($errors == false) {
                // Если ошибок нет
                // Сохраняем заказ в базе данных
                $productsInCart = Cart::getProducts();
                if (User::isGuest()){
                    $userId = false;
                } else {
                    $userId = User::checkLogged();
                }
                // Сохраняем заказ в БД
                $result = Order::save($userName, $userPhone, $userComment, $userId, $productsInCart);
                
                if ($result) {
                    // Если заказ успешно сохранен
                    // Оповещаем администратора о новом заказе по почте                
                    $adminEmail = 'dolgova_v@mail.ru';
                    $message = '<a href="http://digital-mafia.net/admin/orders">Список заказов</a>'; //ссылка на административный раздел
                    $subject = 'Новый заказ!';
                    mail($adminEmail, $subject, $message);
                    // Очищаем корзину
                    Cart::clear();
                }
            } else {
                //Форма отправленна не корректно
                $productsInCart = Cart::getProducts();
                $productsIds = array_keys($productsInCart);                
                $products = Product::getProdustsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItems();
            }
        } else {
            
        }
        // Подключаем вид
        require_once(ROOT .'/views/cart/checkout.php');
        return true;
    }
    
    public function actionDelete($id)
    {
        header ("Location: /cart/");
    }
      
 
}