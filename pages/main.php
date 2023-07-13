<?php
declare(strict_types = 1);

session_start();

require_once "../classes and functions/User.php";
require_once "../classes and functions/MrDataBase.php";

if(!$_SESSION['user']) {
    header('Location: ../index.classes and functions');
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
<body>
    <a href="../php/logout.php" class="logout">Выход</a>
    <?php
        $user = new User($_SESSION['user']['name'], $_SESSION['user']['surname'], $_SESSION['user']['password']);
        $mrBase = new MrDataBase("localhost", "Comments Section", "root", "");
        echo $mrBase->getUserId($user);
    ?>
</body>
</html>
