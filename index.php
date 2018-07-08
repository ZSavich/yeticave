<?php
require_once 'data.php';
require_once 'init.php';

if(!$connect) {
    $error = mysqli_connect_error();
    print(renderTemplate('templates/error.php', ['error' => $error]));
    exit();
} else {

    $sql = "SELECT * FROM lots WHERE expire_date > '" . time() . "' ORDER BY create_date";
    $res = mysqli_query($connect, $sql);
    $rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
}

$page_content = renderTemplate('templates/index.php', ['ads' => $rows]);
$layout_content = renderTemplate('templates/layout.php', ['content' => $page_content, 'categories' => $categories]);
print($layout_content);

; ?>


