<?php
session_start();
//получаем данные из формы
//пароль приложения
//pymb rltb crgx antz
$Fullname = filter_var($_POST['Fullname'],FILTER_SANITIZE_STRING);
$emailMes = filter_var($_POST['emailMes'],FILTER_VALIDATE_EMAIL);
$adres = filter_var($_POST['adres'],FILTER_SANITIZE_STRING);
$description = filter_var($_POST['description'],FILTER_SANITIZE_STRING);
//преобразует символы вводимые в форму
$Fullname  = htmlspecialchars($Fullname);
$emailMes = htmlspecialchars($emailMes);
$adres = htmlspecialchars($adres);
$description = htmlspecialchars($description);

//если пользователь пытается вствить url в форму, декодируем
$Fullname = urldecode($Fullname);
$emailMes = urldecode($emailMes);
$adres = urldecode($adres);
$description = urldecode($description);

//удалить пробелы
$Fullname = trim($Fullname);
$emailMes = trim($emailMes);
$subject = "🏠 Письмо с сайта Семейный центр 🏠";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

$mail = new PHPMailer(true);

$kapha = filter_var($_POST['kapcha'],FILTER_SANITIZE_STRING);

if ($kapha === $_SESSION['rand_code']) {
//    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'annabelk1515@gmail.com';                     //SMTP username
        $mail->Password = 'pymb rltb crgx antz';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->CharSet = 'UTF-8';
        //Recipients
        $mail->setFrom('annabelk1515@gmail.com', 'User');
        $mail->addAddress('annab35515@gmail.com', 'Anna');     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = "<h2>Имя отправителя: <i>$Fullname</i></h2> <br/><h2>'Электронный адрес отправителя: <i>$emailMes</i></h2> <br/><h2>Почтовый адрес отправителя: <i>$adres</i></h2>  <br/><h2>Сообщение: <i>$description</i></h2>";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
//        echo 'Message has been sent';
//    } catch (Exception $e) {
//        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//    }
    //header('Location:  http://project/done.php');
    header('Location: http://project/electronicUsing.php');
    $_SESSION['message'] = 'Сообщение отправлено';
} else{
    header('Location: http://project/electronicUsing.php');
    $_SESSION['message'] = 'Captcha введена неверно';
}
//header('Location:  http://project/done.php');

