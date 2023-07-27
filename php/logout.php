<?php
session_start();

require_once "../classes and functions/functions.php";
require_once "../classes and functions/User.php";
require_once "../database/QueryBuilder.php";
require_once "../components/Auth.php";

$auth = new Auth(new PDO("mysql:host=localhost; dbname=Comments Section", "root", ""));
$auth->logout();
$auth->redirect('../pages/sign in.php');
exit;