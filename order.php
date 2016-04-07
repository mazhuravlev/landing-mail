<?php

require_once 'vendor/autoload.php';

const MAIL_HOST = 'smtp.gmail.com';
const MAIL_LOGIN = '';
const MAIL_PASSWORD = '';
const FROM_MAIL = '';
const FROM_NAME = '';
const TO_MAIL = '';
const TO_NAME = '';

if (!isset($_POST['phone'])) {
    json_response('no phone input', 400);
    die();
}

$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = MAIL_HOST;
$mail->SMTPAuth = true;
$mail->Username = MAIL_LOGIN;
$mail->Password = MAIL_PASSWORD;
$mail->SMTPSecure = "tls";
$mail->Port = 587;
$mail->From = FROM_MAIL;
$mail->FromName = FROM_NAME;
$mail->addAddress(TO_MAIL, TO_NAME);
$mail->isHTML(true);
$mail->Subject = "Заявка для " . $_POST['phone'];
$mail->Body = $_POST['phone'];
$mail->AltBody = $_POST['phone'];

if (!$mail->send()) {
    json_response($mail->ErrorInfo, 500);
} else {
    json_response('OK');
}

function json_response($data, $code = 200)
{
    header('Content-Type: application/json');
    http_response_code($code);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}