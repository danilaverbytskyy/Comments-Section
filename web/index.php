<?php

use App\Auth;
use App\ImageManager;
use App\QueryBuilder;

if(!session_start()) {
    session_start();
}

require '../database/QueryBuilder.php';
require '../components/Auth.php';
require '../components/ImageManager.php';

$db = new QueryBuilder(new PDO("mysql:host=localhost; dbname=Comments Section", "root", ""));
$auth = new Auth($db);
$img = new ImageManager();

//Routing
$url = $_SERVER['REQUEST_URI'];

//Front Controller
if($url = '') {
    require '../index.php';
}
else if ($url='/sign-in') {
    require '../pages/sign in.php';
}
else if ($url = '/main') {
    require '../pages/main.php';
}
else {
    echo '404 || Error';
}
exit;





































