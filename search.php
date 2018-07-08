<?php

require_once 'init.php';

if(isset($_GET['search'])) {

    mysqli_query($connect, 'CREATE FULLTEXT INDEX lot_search ON lots(name, description)');

    $search = $_GET['search'] ?? '';

    $sql = "SELECT * FROM lots WHERE MATCH(name, description) AGAINST (?)";
    $stmt = db_get_prepare_stmt($connect, $sql, [$search]);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $page_content = renderTemplate('templates/search.php', ['lots' => $rows]);
} else {

}

$layout_content = renderTemplate('templates/layout.php',['content' => $page_content]);
print($layout_content);