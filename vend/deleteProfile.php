<?php
session_start();

$connect = mysqli_connect('localhost', 'annabelk', '201500Anna', 'testCoursework');
if (!$connect) {
    die('error connect to database');
}
$id = $_SESSION['id'];
    // Запрос на обновление данных в базе данных
    $sql = "DELETE FROM `usersCoursework` WHERE `id`= '$id'"; // Предполагается, что id пользователя равен 1
    if (mysqli_query($connect, $sql)) {
        $_SESSION['message'] = 'Профиль удален';
        unset($_SESSION['user']);
        header('Location: http://project/entrance.php');
    } else {
        $_SESSION['message'] = 'Ошибка' . mysqli_error($connect);
    }




