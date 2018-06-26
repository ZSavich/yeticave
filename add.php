<?php
require_once 'functions.php';
require_once 'data.php';

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $ad = $_POST;
    $required = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date'];
    $dis = ['lot-name' => "Наименование", 'category' => "Категория", 'message' => "Описание", 'lot-rate' => "Начальная цена", 'lot-step' => "Шаг ставки", 'lot-date' => "Дата завершения лота", 'file' => "Изображение"];
    $errors = [];
    foreach($required as $key) {
        if(empty($_POST[$key])) {
            $errors[$key] = "Это поле надо заполнить.";
        } else if ($_POST[$key] == "Выберите категорию") {
            $errors[$key] = "Это поле надо заполнить.";
        } else if (($key == 'lot-rate' || $key == 'lot-step') && ctype_alpha($_POST[$key])) {
            $errors[$key] = "Введите числовые данные";
        } else if ($key == 'lot-date' && ctype_alpha($_POST[$key])) {
            $errors[$key] = "Введите корректную дату";
        }
    }

    if(!empty($_FILES['lot-photo']['name'])) {
        $tmp_name = $_FILES['lot-photo']['tmp_name'];
        $path = $_FILES['lot-photo']['name'];


        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $tmp_name);
        if($file_type !== "image/jpeg") {
            $errors['file'] = "Загрузите картинку в формамте jpg";
        } else {
            move_uploaded_file($tmp_name, 'img/' . $path);
            $ad['image'] = "img/" . $path;
        }
    } else {
        $errors['file'] = "Загрузите изображение";
    }
    if(count($errors)){
        $page_content = renderTemplate('templates/add-lot.php', ['errors' => $errors, 'dis' => $dis]);
    } else {
        $page_content = renderTemplate('templates/lot.php', ['ad' => $ad]);
    }
} else {
    if(isset($_SESSION['user'])){
        $page_content = renderTemplate('templates/add-lot.php', []);
    } else
        http_response_code(403);
        $page_content = renderTemplate('templates/add-lot.php', []);
}

$layout_content = renderTemplate('templates/layout.php', ['content' => $page_content, 'categories' => $categories]);
print($layout_content);