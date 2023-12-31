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
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="/css/index.css">
</head>
<body>
<br>
    <form action="../php/register.php" method="post" enctype="multipart/form-data">
        <center><h2 title="Форма регистрации">Регистрация</h2></center>
        <div class="group">
            <label for="nickname">Никнейм:</label>
            <input id="nickname" name="nickname" type="text" required>
        </div>
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
                <button type="submit">Зарегистрироваться</button>
            </center>
        </div>
            <center>
                <div>Уже есть аккаунт? <a href="log-in.php">Войти</a> </div>
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