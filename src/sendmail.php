<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->setLanguage('ru', 'phpmailer/language/');
$mail->isHTML(true);

//От кого письмо
$mail->setFrom('info@ericaclinic.com', 'Erica Clinic');
//Кому отправить
$mail->addAddress('ericaclinic@gmail.com');
//Тема письма
$mail->Subject = 'Форма обратной связи';

//Тело письма
$body = '<h3>Получена заявка на сайте: </h3>';

if(trim(!empty($_POST['name']))) {
	$body.='<p><strong>Имя:</strong> '.$_POST['name'].'</p>';
}
if(trim(!empty($_POST['email']))) {
	$body.='<p><strong>Телефон:</strong> '.$_POST['email'].'</p>';
}

$mail->Body = $body;

//Отправляем
if (!$mail->send()) {
	$message = 'Ошибка';
} else {
	$message = 'Данные отправлены!';
}

$response = ['message' => $message];

header('Content-type: application/json');
echo json_encode($response);
?>