<?php
require_once 'functions.php';
require_once 'data.php';
require_once 'userdata.php';


if($_SERVER['REQUEST_METHOD'] == "POST") {
    $form = $_POST;
    $require = ['email', 'password'];
    $dis = ['email' => 'Почта', 'password' => 'Пароль'];
    $errors = [];
    foreach($require as $key) {
        if(empty($_POST[$key])) {
            $errors[$key] = "Данное поле нужно заполнить!";
        }
    }

    if(!count($errors) and $user = search_user_by_email($form['email'], $users)) {
        if(password_verify($form['password'], $user['password'])) {
            $_SESSION['user'] = $user;
        } else {
            $errors['password'] = "Неверный пароль";
        }

    } else {
        $errors['email'] = "Такой пользователь не найден";
    }

    if(count($errors)) {
        $page_content = renderTemplate('templates/login.php', ['errors' => $errors, 'user' => $form]);
    } else {
        header("Location: /index.php");
        exit();
    }
} else {
    if(isset($_SESSION['user'])) {
       header("Location: /index.php");
       exit();
    } else {
        $page_content = renderTemplate('templates/login.php', []);
    }
}


$layout_content = renderTemplate('templates/layout.php', ['content' => $page_content]);
print($layout_content);