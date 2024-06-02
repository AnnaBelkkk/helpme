<?php
session_start();
//require_once 'connect.php';
$connect = mysqli_connect('localhost', 'annabelk', '201500Anna', 'testCoursework');
if (!$connect) {
    die('error connect to database');
}
$allowedFormats = array(IMAGETYPE_JPEG, IMAGETYPE_PNG);
$name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
$login = filter_var($_POST['login'],FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
$password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
$password_confirm = filter_var($_POST['passwordConfirm'],FILTER_SANITIZE_STRING);

//    print_r($_FILES)
//$imageType = exif_imagetype($_FILES['img']['tmp_name']);
$kapha = filter_var($_POST['kapcha'],FILTER_SANITIZE_STRING);
    if ($password === $password_confirm) {
        if ($kapha === $_SESSION['rand_code']) {
            $email_check_query = "SELECT * FROM `usersCoursework` WHERE email='$email' or login ='$login' LIMIT 1";
            $result = mysqli_query($connect, $email_check_query);
            $user = mysqli_fetch_assoc($result);
            if ($user) {
                $_SESSION['message'] = 'Ошибка, такая почта или логин уже существуют';
                $_SESSION['name'] = $name;
                $_SESSION['login'] = $login;
                $_SESSION['email'] = $email;
                header('Location: ../registration.php');
                exit;
            }
           if (empty($_FILES['img']['tmp_name'])) {
               $ava = 'none';
//                $_SESSION['message'] = 'Ошибка, файл не был загружен';
//                $_SESSION['name'] = $name;
//                $_SESSION['login'] = $login;
//                $_SESSION['email'] = $email;
//                header('Location: ../registration.php');
//                exit;
            } else {
                $imageType = exif_imagetype($_FILES['img']['tmp_name']);
                $ava = 'uploads/' . time() . $_FILES['img']['name'];
                if (!move_uploaded_file($_FILES['img']['tmp_name'], '../' . $ava)) {
                    $_SESSION['message'] = 'Ошибка при загрузке файла';
                    $_SESSION['name'] = $name;
                    $_SESSION['login'] = $login;
                    $_SESSION['email'] = $email;
                    header('Location: ../registration.php');
                    exit;
                } else if ($_FILES['img']['size'] > 5242880 || !in_array($imageType, $allowedFormats)) {
                    $_SESSION['message'] = 'Ошибка, изображение превышает 5 МБ или не того формата (png, jpeg)';
                    $_SESSION['name'] = $name;
                    $_SESSION['login'] = $login;
                    $_SESSION['email'] = $email;
                    header('Location: ../registration.php');
                    exit;
                }
            }
            $password = md5($password);
            // Проверяем, установлена ли переменная в сессии
            // Инкрементируем значение переменной в сессии
            mysqli_query($connect, "INSERT INTO `usersCoursework` ( `name`, `login`, `email`, `password`, `img`) VALUES ( '$name', '$login', '$email', '$password', '$ava')");
            $_SESSION['message'] = 'Вы зарегистрированы';

//    mysqli_query($connect, "INSERT INTO `usersCoursework` (`id`, `name`, `login`, `email`, `password`, `img`) VALUES ('$a', '$name', '$login', '$email', '$password', '$ava')");
//    $_SESSION['message'] = 'вы зарегистрированы';
            header('Location: http://project/entrance.php');
        } else{
            header('Location: http://project/registration.php');
            $_SESSION['message'] = 'Captcha введена неверно';
            $_SESSION['name'] = $name;
            $_SESSION['login'] = $login;
            $_SESSION['email'] = $email;

        }
    } else {
        $_SESSION['message'] = 'Пароли не совпадают';
        header('Location: http://project/registration.php');
        $_SESSION['name'] = $name;
        $_SESSION['login'] = $login;
        $_SESSION['email'] = $email;
        //die('пароли не совпадают');

}
