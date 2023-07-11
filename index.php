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
    <title>Регистрация</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="/css/index.css">
</head>
<body>
<br>
    <form action="includes/register.php" method="post" enctype="multipart/form-data">
        <center><h2 title="Форма регистрации">Регистрация</h2></center>
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
                <button type="submit" name="go">Зарегистрироваться</button>
            </center>
        </div>
            <center>
                <div>Уже есть аккаунт? <a href="pages/страница входа.php">Войти</a> </div>
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