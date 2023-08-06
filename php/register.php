<?php
declare(strict_types=1);

session_start();

require_once "../classes and functions/functions.php";
require_once "../classes and functions/User.php";
require_once "../database/QueryBuilder.php";
require_once "../components/Auth.php";

$db = new QueryBuilder(new PDO("mysql:host=localhost; dbname=Comments Section", "root", ""));
$auth = new Auth($db);
if($auth->register("users", $_POST)) {
    $_SESSION['message'] = "Вы успешно зарегистрировались";
    $auth->redirect("../pages/sign in.php");
}
else if($auth->isInTable("users", $_POST)) {
    $_SESSION['message'] = "Такой пользователь уже зарегистрирован";
    $auth->redirect("/");
}
else {
    $_SESSION['message'] = "Вы ввели недопустимые символы";
    $auth->redirect("/");
}
exit;