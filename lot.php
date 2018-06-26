<?php
require_once 'functions.php';
require_once 'data.php';

$expire = strtotime("+30 days");
$path = "/";

if(isset($ads[key($_GET)])) {
    $ad = $ads[key($_GET)];


    if(isset($_COOKIE['visited'])) {
        $visited = explode(",", $_COOKIE['visited']);

        if(isset($visited[key($_GET)])) {
            array_splice($visited, $visited[key($_GET)], $visited[key($_GET)]);
        }


        array_unshift($visited, key($_GET));
        $cookie_value = implode(",",$visited);

    } else {
        $cookie_value = key($_GET);
    }
    setcookie("visited", $cookie_value, $expire, $path);
}
else {
    http_response_code(404);
}


$page_content = renderTemplate('templates/lot.php', ['ad' => $ad]);
$layout_content = renderTemplate('templates/layout.php', ['content' => $page_content, 'user_name' => $user_name, 'user_avatar' => $user_avatar, 'categories' => $categories, 'is_auth' => $is_auth]);
print($layout_content);


