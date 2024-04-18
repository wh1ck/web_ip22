<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
</head>
<body>
    <form action="/auth.php" method="post">
        <input type="text" name="username" placeholder="Логин" required>
        <br>
        <input type="password" name="password" placeholder="Пароль" required>
        <br>
        <input type="submit" value="Вход">
    </form>
</body>
</html>