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
        $require = ['email','password','name','message'];
        $dis = ['email' => 'Почта', 'password' => 'Пароль', 'name' => 'Имя', 'message' => 'Контактные данные'];
        $errors = [];

        foreach($require as $key) {
            if(empty($_POST[$key])) {
                $errors[$key] = "Данное поле нужно заполнить!";
            }
        }

        if(!empty($_FILES['photo1']['name'])) {
            $tmp_name = ['photo1']['tmp_name'];
            $path = ['photo1']['name'];

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $file_type = finfo_file($finfo, $tmp_name);
            if ($file_type != "image/jpeg") {
                $errors['file'] = "Загрузите картинку в формамте jpg";
            } else {
                move_uploaded_file($tmp_name, 'img/users/' . $path);
                $form['image'] = "img/" . $path;
            }
        }

        if(count($errors)) {
            $page_content = renderTemplate('templates/sing-up.php',['errors' => $errors, 'dis' => $dis, 'form' => $form]);
        }
        else {
            $sql = "INSERT INTO users(name, email, password_hash, contacts, registration_date) VALUES (?,?,?,?,?)";
            $stmt = db_get_prepare_stmt($connect, $sql, [$form['name'],$form['email'],password_hash($form['password'], PASSWORD_DEFAULT),$form['message'], time()]);
            $res = mysqli_stmt_execute($stmt);

            if($res) {
                $page_content = renderTemplate('templates/login.php',[]);
            } else {
                $page_content = renderTemplate('templates/error.php', ['error' => mysqli_error($connect)]);
            }

        }
    }
    else {
        $page_content = renderTemplate('templates/sing-up.php',[]);
    }
}



$layout_content = renderTemplate('templates/layout.php',['content' => $page_content]);
print($layout_content);