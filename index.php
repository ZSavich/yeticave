<?php
require_once 'functions.php';
require_once 'data.php';

$page_content = renderTemplate('templates/index.php', ['ads' => $ads]);
$layout_content = renderTemplate('templates/layout.php', ['content' => $page_content, 'user_name' => $user_name, 'user_avatar' => $user_avatar, 'categories' => $categories, 'is_auth' => $is_auth]);
print($layout_content);

; ?>


