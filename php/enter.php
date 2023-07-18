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
$_POST['password'] = hashPassword($_POST['password']);

$user = new User(mb_strtoupper($_POST['name']), mb_strtoupper($_POST['surname']), $_POST['password']);
$db = new QueryBuilder(new PDO("mysql:host=localhost; dbname=Comments Section", "root", ""));

$userInformation = $db->getOne("users", $_POST);
if ($user->password === $userInformation['password']) {
    $_SESSION['user'] = [
        'user_id' => $userInformation['user_id'],
        'name' => $userInformation['name'],
        'surname' => $userInformation['surname'],
        'password' => $userInformation['password']
    ];
    header('Location: ../pages/main.php');
}
else {
    $_SESSION['message'] = "Нет такого пользователя или неверный пароль";
    header('Location: ../pages/sign in.php');
}
exit;
