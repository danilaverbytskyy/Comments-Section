<?php
declare(strict_types=1);

session_start();

require_once "../classes and functions/functions.php";
require_once "../classes and functions/User.php";
require_once "../database/QueryBuilder.php";
require_once "../components/Auth.php";

$auth = new Auth(new PDO("mysql:host=localhost; dbname=Comments Section", "root", ""));
if($auth->login($_POST)) {
    $_SESSION['user'] = [
      'name' => $_POST['name'],
      'surname' => $_POST['surname']
    ];
    $auth->redirect("../pages/main.php");
}
else if($auth->isInTable('users', ['name' => $_POST['name'], 'surname' => $_POST['surname']])) {
    $_SESSION['message'] = "Неверный пароль";
    $auth->redirect("../pages/sign in.php");
}
else {
    $_SESSION['message'] = "Нет такого пользователя";
    $auth->redirect("../pages/sign in.php");
}
exit;