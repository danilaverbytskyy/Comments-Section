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
$user = new User(mb_strtoupper($_POST['name']), mb_strtoupper($_POST['surname']), hashPassword($_POST['password']));
$db = new QueryBuilder("localhost", "Comments Section", "root", "");

$userInformation = $db->getUserFromUsers($user);
if($db->isUserInUsers($user)) {
    $_SESSION['message'] = "Такой пользователь уже зарегистрирован";
    header('Location: /');
    exit;
}
$db->addUserToUsers($user);
$_SESSION['message'] = "Вы успешно зарегистрировались";
header('Location: ../pages/sign in.php');
exit;