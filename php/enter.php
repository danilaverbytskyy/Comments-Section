<?php
declare(strict_types=1);

use App\Auth;
use App\QueryBuilder;

session_start();

require_once "../classes and functions/functions.php";
require_once "../classes and functions/User.php";
require_once "../database/QueryBuilder.php";
require_once "../components/Auth.php";

$db = new QueryBuilder(new PDO("mysql:host=localhost; dbname=Comments Section", "root", ""));
$auth = new Auth($db);
if($auth->login("users", $_POST)) {
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