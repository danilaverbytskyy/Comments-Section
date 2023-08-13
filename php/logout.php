<?php
require '../vendor/autoload.php';

use Delight\Auth\Auth;

$db = new PDO("mysql:host=localhost; dbname=Comments Section", "root", "");
$auth = new Auth($db);

try {
    $auth->logOutEverywhereElse();
    unset($_SESSION['user']);
    $_SESSION['message'] = 'Вы успешно вышли';
}
catch (\Delight\Auth\NotLoggedInException $e) {

}
header("Location: ../pages/log-in.php");
exit;