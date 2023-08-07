<?php
session_start();

require_once "../classes and functions/functions.php";
require_once "../classes and functions/User.php";
require_once "../database/QueryBuilder.php";
require_once "../components/Auth.php";

$db = new QueryBuilder(new PDO("mysql:host=localhost; dbname=Comments Section", "root", ""));
$auth = new Auth($db);
$auth->logout();
$auth->redirect('../pages/sign in.php');
exit;