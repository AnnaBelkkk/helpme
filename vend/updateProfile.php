<?php
session_start();
$connect = mysqli_connect('localhost', 'annabelk', '201500Anna', 'testCoursework');
if (!$connect) {
    die('error connect to database');
}
$id = $_SESSION['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['name'];
    $email = $_POST['email'];

    $email_check_query = "SELECT * FROM `usersCoursework` WHERE `email`='$email' LIMIT 1";
    $result = mysqli_query($connect, $email_check_query);
    $user = mysqli_fetch_assoc($result);
    if ($user) {
        $_SESSION['message'] = 'Ошибка, такая почта уже существуют';
        $_SESSION['email'] = $email;

    }else {
        // Запрос на обновление данных в базе данных
        $sql = "UPDATE `usersCoursework` SET  `email`='$email' WHERE `id`= '$id'";

        if (mysqli_query($connect, $sql)) {
            $_SESSION['user']['name'] = $username; // Обновляем имя пользователя в сессии
            $_SESSION['user']['email'] = $email;   // Обновляем почту пользователя в сессии
            $_SESSION['message'] = 'Профиль обновлен';
        } else {
            $_SESSION['message'] = 'Ошибка' . mysqli_error($connect);
        }
    }
    header('Location: http://project/profile.php');
    mysqli_close($connect); // Закрытие соединения с базой данных
}
?>
