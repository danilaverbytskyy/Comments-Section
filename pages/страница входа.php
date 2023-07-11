<?php

session_start();

if ($_SESSION['user']) {
    header('Location: /pages/main.php');
}
?>

<!DOCKTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Войти</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
<br>
<form action="../includes/signin.php" method="post" enctype="multipart/form-data">
    <center><h2 title="Форма регистрации">Вход</h2></center>
    <div class="group">
        <label for="name">Имя:</label>
        <input id="name" name="name" type="text" required>
    </div>
    <div class="group">
        <label for="surname">Фамилия:</label>
        <input id="surname" name="surname" type="text" required>
    </div>
    <div class="group">
        <label for="password">Пароль:</label>
        <input id="password" name="password"  type="text" required>
    </div>
    <div class="group">
        <center>
            <button type="submit" name="go">Войти</button>
        </center>
    </div>
    <center>
        <div>Еще нет аккаунта? <a href="../index.php">Зарегистрироваться</a> </div>
    </center>
    <?php
    if ($_SESSION['message']) {
        echo '<center><p class="msg"> ' . $_SESSION['message'] . ' </p></center>';
    }
    unset($_SESSION['message']);
    ?>
</form>
</body>
</html>





