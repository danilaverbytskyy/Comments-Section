<?php

require '../vendor/autoload.php';

use Delight\Auth\Auth;

$db = new PDO("mysql:host=localhost; dbname=Comments Section", "root", "");
$auth = new Auth($db);
$rememberDuration = (int) (60 * 60 * 24 * 365.25);

try {
    $auth->login($_POST['email'], $_POST['password'], $rememberDuration);
    $_SESSION['message'] = 'Вы успешно вошли';
    $_SESSION['user'] = $auth->getUserId();
    header("Location: ../pages/main.php");
}
catch (\Delight\Auth\InvalidEmailException $e) {
    $_SESSION['message'] = 'Некорректный адрес почты';
    header("Location: /");
}
catch (\Delight\Auth\InvalidPasswordException $e) {
    $_SESSION['message'] = 'Некорректный пароль';
    header("Location: /");
}
catch (\Delight\Auth\EmailNotVerifiedException $e) {
    $_SESSION['message'] = 'Почта не подтверждена';
    header("Location: /");
}
catch (\Delight\Auth\TooManyRequestsException $e) {
    $_SESSION['message'] = 'Слишком много запросов';
    header("Location: /");
}
exit;