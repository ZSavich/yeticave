<?php
require_once 'data.php';
require_once 'init.php';

if(!$connect) {
    $error = mysqli_connect_error();
    print(renderTemplate('templates/error.php', ['error' => $error]));
    exit();
} else {
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

        $sql = "SELECT * FROM users WHERE email = '" . $form['email'] . "'";


        if(!count($errors) and $query = mysqli_query($connect, $sql)) {
            $rows = mysqli_fetch_array($query, MYSQLI_ASSOC);
            if(password_verify($form['password'], $rows['password_hash'])) {
                $_SESSION['user'] = $rows;
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
}


$layout_content = renderTemplate('templates/layout.php', ['content' => $page_content]);
print($layout_content);