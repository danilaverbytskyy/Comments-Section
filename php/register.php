<?php
declare(strict_types=1);

session_start();

require_once "../classes and functions/functions.php";
require_once "../classes and functions/User.php";
require_once "../classes and functions/QueryBuilder.php";

foreach ($_POST as $element) {
    $element = trim(htmlspecialchars($element));
    $invalidSymbols = "?#<>%^/@ ";

    if (strpbrk($element, $invalidSymbols) !== false) {
        $_SESSION['message'] = "Символы \"" . $invalidSymbols . "\" недопустимы";
        header('Location: /');
        exit;
    }
}
$_POST['password'] = hashPassword($_POST['password']);
$user = new User(mb_strtoupper($_POST['name']), mb_strtoupper($_POST['surname']), $_POST['password']);
$db = new QueryBuilder(new PDO("mysql:host=localhost; dbname=Comments Section", "root", ""));

if ($db->isUserInUsers($user)) {
    $_SESSION['message'] = "Такой пользователь уже зарегистрирован";
    header('Location: /');
    exit;
}
else {
    $db->store("users", $_POST);
    $_SESSION['message'] = "Вы успешно зарегистрировались";
    header('Location: ../pages/sign in.php');
    exit;
}