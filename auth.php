<?php
require 'connect.php';
require 'core.php';

# ищем пользователя по логину и паролю
$auth_username = isset($_POST['username']) ? $_POST['username'] : false;
$auth_password = isset($_POST['password']) ? $_POST['password'] : false;
$auth_type = isset($_POST['type']) ? $_POST['type'] : false; # тип post-запроса
$array_messages = array();
if($auth_type && $auth_type == 'auth'){
    # действия, выполняемые при авторизации
    if(!$auth_username){
        # логин не введен
        array_push($array_messages, 'Логин не введен');
    }
    if(!$auth_password){
        # пароль не введен
        array_push($array_messages, 'Пароль не введен');
    }
    # 'захэшируем пароль'
    $auth_password = md5($auth_password);
    if(!count($array_messages)){
        # пока ошибок не найдено, ищем пользователя
        $find_user = $mysqli->query("SELECT username, password FROM members WHERE username='$auth_username' AND password='$auth_password' LIMIT 1");
        # проверяем, найден ли пользователь
        if(!$find_user->num_rows){
            # не найден
            array_push($array_messages, 'Пользователь не найден');
        } else {
            # найден
            $user_data = $find_user->fetch_assoc();
            $_SESSION['username'] = $user_data['username'];
            $_SESSION['password'] = $user_data['password'];
            header('Location: /index.php');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
</head>
<body>
    <form action="/auth.php" method="post">
        <input type="hidden" name="type" value="auth">
        <input type="text" name="username" placeholder="Логин" required>
        <br>
        <input type="password" name="password" placeholder="Пароль" required>
        <br>
        <input type="submit" value="Вход">
    </form>
</body>
</html>