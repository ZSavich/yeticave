<?php
require_once 'functions.php';
require_once 'data.php';

if(isset($ads[key($_GET)]))
    $ad = $ads[key($_GET)];
else {
    http_response_code(404);
}



$page_content = renderTemplate('templates/lot.php', ['ad' => $ad]);
$layout_content = renderTemplate('templates/layout.php', ['content' => $page_content, 'user_name' => $user_name, 'user_avatar' => $user_avatar, 'categories' => $categories, 'is_auth' => $is_auth]);
print($layout_content);


