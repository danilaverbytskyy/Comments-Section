<?php
declare(strict_types=1);

session_start();

require_once "../classes and functions/functions.php";
require_once "../classes and functions/User.php";
require_once "../classes and functions/MrDataBase.php";


foreach ($_POST as $element) {
    $element = trim(htmlspecialchars($element));
    $invalidSymbols = "?#<>%^/@ ";

    if (strpbrk($element, $invalidSymbols) !== false) {
        $_SESSION['message'] = "Символы \"" . $invalidSymbols . "\" недопустимы";
        header('Location: ../pages/sign in.php');
        exit;
    }
}
$user = new User(mb_strtoupper($_POST['name']), mb_strtoupper($_POST['surname']), hashPassword($_POST['password']));
$mrBase = new MrDataBase("localhost", "Comments Section", "root", "");

$userHashedPassword = $mrBase->getUserHashedPassword($user);
echo $userHashedPassword . '<br>';
if ($user->password != $userHashedPassword) {
    $_SESSION['message'] = "Нет такого пользователя";
    header('Location: ../pages/sign in.php');
    exit;
}
else {
    $_SESSION['user'] = [
        'name' => $user->name,
        'surname' => $user->surname,
    ];
    header('Location: ../pages/main.php');
    exit;
}
