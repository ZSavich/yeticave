<?php
require_once 'functions.php';
require_once 'data.php';

$page_content = renderTemplate('templates/index.php', ['ads' => $ads]);
$layout_content = renderTemplate('templates/layout.php', ['content' => $page_content, 'categories' => $categories]);
print($layout_content);

; ?>


