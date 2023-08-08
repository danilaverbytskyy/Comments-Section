<?php
require '../vendor/autoload.php';

use Delight\Auth\Auth;

$db = new PDO("mysql:host=localhost; dbname=Comments Section", "root", "");
$auth = new Auth($db);

$auth->logOut();
unset($_SESSION['user']);
header("Location: ../pages/log-in.php");
exit;