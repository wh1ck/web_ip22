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
    # поиск пользователя по логину
    $find_username = $mysqli->query("SELECT id FROM members WHERE username='$reg_username' LIMIT 1");
        if($find_username->num_rows){
            array_push($array_messages, 'Пользователь уже существует');
        }
    # проверки закончены.
    if(!count($array_messages)){
        # регистрацию продолжать можно
        $result = $mysqli->query("INSERT INTO members (username,password,name,surename) VALUES('$reg_username','$reg_password','$reg_your_name','$reg_surename')");
        header('Location: /auth.php');
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Регистрация</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body class="bg-body-tertiary">
    <div class="container">
        <main>
            <div class="py-5 text-center">
                <h2>Регистрация</h2>
            </div>
            <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last">
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (USD)</span>
            <strong>$20</strong>
          </li>
        </ul>
      </div>
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Заполните ваши данные</h4>
        <form class="needs-validation" novalidate>
          <div class="row g-3">
            <div class="col-sm-6">
              <label for="firstName" class="form-label">Имя</label>
              <input type="text" class="form-control" id="firstName" placeholder="Имя" value="" name="your_name" required>
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">Фамилия</label>
              <input type="text" class="form-control" id="lastName" placeholder="Фамилия" value="" required>
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>

            <div class="col-12">
              <label for="username" class="form-label">Логин</label>
              <div class="input-group has-validation">
                <span class="input-group-text">@</span>
                <input type="text" class="form-control" id="username" placeholder="Логин" required>
              <div class="invalid-feedback">
                  Your username is required.
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <label for="firstName" class="form-label">Пароль</label>
              <input type="password" class="form-control" id="firstName" placeholder="Пароль" value="" required>
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">Подтвердите пароль</label>
              <input type="password" class="form-control" id="lastName" placeholder="Подтвердите пароль" value="" required>
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>
          <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" type="submit">Создать аккаунт</button>
        </form>
      </div>
    </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>