<?php
require_once 'functions.php';
require_once 'data.php';

if(isset($_COOKIE['visited'])) {
    $visited_cookie = explode(",", $_COOKIE['visited']);
}


$page_content = renderTemplate('templates/history.php', ['lots_visited' => $visited_cookie, 'ads' => $ads]);
$layout_content = renderTemplate('templates/layout.php', ['content' => $page_content]);
print($layout_content);
