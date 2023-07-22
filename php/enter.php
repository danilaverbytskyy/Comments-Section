<?php
declare(strict_types=1);

session_start();

require_once "../classes and functions/functions.php";
require_once "../classes and functions/User.php";
require_once "../classes and functions/QueryBuilder.php";

foreach ($_POST as $element) {
    $element = trim(htmlspecialchars($element));
}

$invalidSymbols = "?#<>%^/@ ";
foreach ($_POST as $element) {
    if (strpbrk($element, $invalidSymbols) !== false) {
        $_SESSION['message'] = "Символы \"" . $invalidSymbols . "\" недопустимы";
        header('Location: ../pages/sign in.php');
        exit;
    }
}
$_POST['name'] = mb_strtoupper($_POST['name']);
$_POST['surname'] = mb_strtoupper($_POST['surname']);
$_POST['password'] = hashPassword($_POST['password']);

$user = new User($_POST['name'], $_POST['surname'], $_POST['password']);
$db = new QueryBuilder(new PDO("mysql:host=localhost; dbname=Comments Section", "root", ""));
$userInformation = $db->getOne("users", $_POST);

if ($user->password === $userInformation['password']) {
    $_SESSION['user'] = [
        'name' => $user->name,
        'surname' => $user->surname,
        'password' => $user->password
    ];
    header('Location: ../pages/main.php');
    exit;
}
else {
    $_SESSION['message'] = "Пароль неверный или нет такого пользователя";
    header('Location: ../pages/sign in.php');
    exit;
}
