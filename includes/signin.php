<?php
declare(strict_types=1);

session_start();

require_once "../php/functions.php";
require_once "../php/User.php";
require_once "../php/MrDataBase.php";


foreach ($_POST as $element) {
    $element = trim(htmlspecialchars($element));
}
$user = new User(mb_strtoupper($_POST['name']), mb_strtoupper($_POST['surname']), hashPassword($_POST['password']));
$mrBase = new MrDataBase("localhost", "Comments Section", "root", "");

$userHashedPassword = $mrBase->getUserHashedPassword($user);
echo $userHashedPassword . '<br>';
if ($user->password != $userHashedPassword) {
    $_SESSION['message'] = "Нет такого пользователя";
    header('Location: ../pages/страница входа.php');
} else {
    $_SESSION['user'] = [
        'name' => $user->name,
        'surname' => $user->surname,
    ];
    header('Location: ../pages/main.php');
}
