<?php
declare(strict_types = 1);

session_start();

require_once "../classes and functions/User.php";
require_once "../classes and functions/QueryBuilder.php";

if(!$_SESSION['user']) {
    header('Location: ../index.php');
}
?>
<!DOCKTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Регистрация</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/main.css">
</head>

<?php include('../includes/header.php'); ?>
<a href="../php/logout.php">Vihod</a>
<body>

</body>
</html>
