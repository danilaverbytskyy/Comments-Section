<?php
session_start();

if(isset($_SESSION['user'])) {
    header('Location: /pages/main.php');
}
?>

<!DOCKTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Вход</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="/css/index.css">
</head>
<body>
<br>
<form action="../php/enter.php" method="post" enctype="multipart/form-data">
    <center><h2 title="Форма регистрации">Вход</h2></center>
    <div class="group">
        <label for="email">Почта:</label>
        <input id="email" name="email" type="text" required>
    </div>
    <div class="group">
        <label for="password">Пароль:</label>
        <input id="password" name="password"  type="text" required>
    </div>
    <div class="group">
        <center>
            <button type="submit">Войти</button>
        </center>
    </div>
    <center>
        <div>Еще нет аккаунта? <a href="sign-up.php">Зарегистрироваться</a> </div>
    </center>
    <?php
    if (isset($_SESSION['message'])) {
        echo '<center><p class="msg"> ' . $_SESSION['message'] . ' </p></center>';
    }
    unset($_SESSION['message']);
    ?>
</form>
</body>
</html>