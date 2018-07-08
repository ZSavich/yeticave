<?php
require_once 'data.php';
require_once 'init.php';

if(!$connect) {
    $error = mysqli_connect_error();
    print(renderTemplate('template/error.php', ['error' => $error]));
    exit();
} else {
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
            $sql = "INSERT INTO lots (name, description, price, step, category_id, user_id, winner_id, create_date, expire_date, image) VALUES (?,?,?,?,?,?,?,?,?,?)";
            $stmt = db_get_prepare_stmt($connect, $sql, [$ad['lot-name'], $ad['message'], $ad['lot-rate'], $ad['lot-step'], $ad['category'], $_SESSION['user']['id'], '3', time(), strtotime($ad['lot-date']), $ad['image']]);
            $res = mysqli_stmt_execute($stmt);

            if($res) {

            } else {
                $page_content = renderTemplate('templates/error.php', ['error' => mysqli_error($connect)]);
            }
        }
    } else {
        if(!isset($_SESSION['user'])){
            $page_content = renderTemplate('templates/add-lot.php', []);
        } else
            http_response_code(403);
        $page_content = renderTemplate('templates/add-lot.php', []);
    }
}


$layout_content = renderTemplate('templates/layout.php', ['content' => $page_content, 'categories' => $categories]);
print($layout_content);