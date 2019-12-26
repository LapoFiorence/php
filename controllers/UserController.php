<?php

class UserController
{
    public function actionRegister()
    {
        $name = '';
        $email = '';
        $password = '';
        $result = false;


        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;

            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }

            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }

            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должно быть короче 6-ти символов';
            }

            if (!User::checkEmailExists($email)) {
                $errors[] = 'Такой email уже существует';
            }

            if ($errors == false) {
                $result = User::register($name, $email, $password);
                if ($result == true){
                    echo "Информация занесена в базу данных";
                }else{
                    echo "Информация не занесена в базу данных";
                }
            }
        }
        require_once(ROOT . '/views/user/register.php');

        return true;
    }

    public function actionLogin()
    {
        $email = '';
        $password ='';

        if (isset($_POST['submit'])){
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;

            //Валидация полей
            if (!User::checkEmail($email)){
                $errors[] = 'Неправильный email';
            }
            if (!User::checkPassword($password)){
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            // Проверяем существует ли пользователь
            $userId = User::checkUserData($email, $password);

            if ($userId == false) {
                //если данные неправильные - показываем ошибку
                $errors[] = 'Неправильные данные для входа на сайт';
            } else {
                //если данные правильные запоминаем пользователя(сессия)
                User::auth($userId);

                //перенаправляем пользователя в закрытую часть - кабинет
                header("Location: /cabinet/");
            }

        }

        require_once (ROOT . '/views/user/login.php');

        return true;
    }

    public function actionLogout()
    {
        // session_start();
        unset($_SESSION["user"]);
        header("Location: /");
    }
}
