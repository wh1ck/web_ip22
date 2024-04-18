<?php
include 'connect.php';
$reg_username = isset($_POST['username']) ? $_POST['username'] : false;
$reg_password = isset($_POST['password']) ? $_POST['password'] : false;
$reg_repeat = isset($_POST['prepeat']) ? $_POST['prepeat'] : false;
$reg_your_name = isset($_POST['your_name']) ? $_POST['your_name'] : false;
$reg_surename = isset($_POST['surename']) ? $_POST['surename'] : false;
$reg_type = isset($_POST['type']) ? $_POST['type'] : false; # тип post-запроса
$array_messages = array(); # массив для хранения ошибок
if($reg_type == 'reg'){
    if(!$reg_username){
        # логин не введен
        array_push($array_messages, 'Логин не введен');
    }
    if(!$reg_password){
        # пароль не введен
        array_push($array_messages, 'Пароль не введен');
    } else {
        # пароль введен, проверяем введен ли второй
        if(!$reg_repeat){
            # второй пароль не введен
            array_push($array_messages, 'Подтверждение пароля не введено');
        } else {
            # второй пароль введен, сравниваем первый и второй
            if($reg_password != $reg_repeat){
                array_push($array_messages, 'Пароли не совпадают');
            } else {
                # пароли введены и равны
                $reg_password = md5($reg_password);
            }
        }
    }
    if(!$reg_your_name){
        # имя не введено
        array_push($array_messages, 'Имя не введено');
    }
    if(!$reg_surename){
        # фамилия не введена
        array_push($array_messages, 'Фамилия не введена');
    }
    # проверки закончены.
    if(!count($array_messages)){
        # регистрацию продолжать можно
        $result = $mysqli->query("INSERT INTO members (username,password,name,surename) VALUES('$reg_username','$reg_password','$reg_your_name','$reg_surename')");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
</head>
<body>
    <?php
    foreach($array_messages as $value){
        echo($value . '<br>');
    }
    ?>
    <form action="/reg.php" method="POST">
        <input type="hidden" name="type" value="reg">
        <input type="text" placeholder="Логин" name="username" required>
        <br>
        <input type="password" placeholder="Пароль" name="password" required>
        <br>
        <input type="password" placeholder="Повторите пароль" name="prepeat" required>
        <br>
        <input type="text" placeholder="Имя" name="your_name" required>
        <br>
        <input type="text" placeholder="Фамилия" name="surename" required>
        <br>
        <input type="submit" value="Отправить">
    </form>
</body>
</html>
