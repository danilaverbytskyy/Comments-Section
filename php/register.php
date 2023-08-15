<?php

require '../vendor/autoload.php';

use Delight\Auth\Auth;

$db = new PDO("mysql:host=localhost; dbname=Comments Section", "root", "");

$auth = new Auth($db);
try {
    $userId = $auth->register($_POST['email'], $_POST['password'], $_POST['nickname']);
    $_SESSION['message'] = 'Вы успешно зарегистрировались';
    header("Location: ../index");
}
catch (\Delight\Auth\InvalidEmailException $e) {
    $_SESSION['message'] = 'Некорректный адрес почты';
    header("Location: ../pages/");
}
catch (\Delight\Auth\InvalidPasswordException $e) {
    $_SESSION['message'] = 'Некорректный пароль';
    header("Location: /");
}
catch (\Delight\Auth\UserAlreadyExistsException $e) {
    $_SESSION['message'] = 'Такой пользователь уже существует';
    header("Location: /");
}
catch (\Delight\Auth\TooManyRequestsException $e) {
    $_SESSION['message'] = 'Слишком много запросов';
    header("Location: /");
}
exit;