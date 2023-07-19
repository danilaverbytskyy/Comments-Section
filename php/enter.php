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

$user = new User(mb_strtoupper($_POST['name']), mb_strtoupper($_POST['surname']), hashPassword($_POST['password']));
$db = new QueryBuilder("localhost", "Comments Section", "root", "");

$userInformation = $db->getUserFromUsers($user);
echo $userInformation . '<br>';
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
    if ($userInformation !== null) {
        $_SESSION['message'] = "Пароль неверный";
    }
    else {
        $_SESSION['message'] = "Нет такого пользователя";
    }
    header('Location: ../pages/sign in.php');
    exit;
}
