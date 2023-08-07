<?php

use App\Auth;
use App\QueryBuilder;

session_start();

$db = new QueryBuilder(new PDO("mysql:host=localhost; dbname=Comments Section", "root", ""));
$auth = new Auth($db);
$auth->logout();
$auth->redirect('../pages/sign in.php');
exit;