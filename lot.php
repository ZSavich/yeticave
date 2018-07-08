<?php
require_once 'init.php';

$expire = strtotime("+30 days");
$path = "/";
$id_lot = intval($_GET['id']);
$id_user = $_SESSION['user']['id'];

if(!$connect) {
    $error = mysqli_connect_error();
    print(renderTemplate('templates/error.php',['error' => $error]));
    exit();
} else {

    $sql = "SELECT * FROM lots WHERE id = '" . $_GET['id'] . "'";
    $query = mysqli_query($connect, $sql);
    $rows = mysqli_fetch_array($query, MYSQLI_ASSOC);
    $ad = $rows;

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

    $sql = "SELECT bets.*, users.id, users.name FROM bets, users WHERE bets.lot_id = " . $id_lot . " AND users.id = bets.user_id";
    $query = mysqli_query($connect, $sql);
    $rows = mysqli_fetch_all($query, MYSQLI_ASSOC);


    $bets = $rows;

    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['cost'])) {
        $bet = $_POST;
        $required = ['cost'];
        $errors = [];
        foreach($required as $key) {
            if(empty($_POST[$key])) {
                $errors = "Добавить ставку";
            }
        }

        if(!count($errors)) {
            $cost = intval($bet['cost']);
            $data_add = time();

            $sql = "INSERT INTO bets (create_date, value, lot_id, user_id) VALUES (".time().",".$cost.",".$id_lot.", ".$id_user.")";
            $query = mysqli_query($connect, $sql);

            $sql = "UPDATE lots SET price = " . $cost . " WHERE id = " . $id_lot;
            $query = mysqli_query($connect, $sql);

            if($query) {
                header('Location: ' . $_SERVER['REQUEST_URI']);
                exit();

            } else {
                print("ERROR");
                print(mysqli_error($connect));
            }


        }
    }

}




$page_content = renderTemplate('templates/lot.php', ['ad' => $ad, 'bets' => $bets]);
$layout_content = renderTemplate('templates/layout.php', ['content' => $page_content, 'user_name' => $user_name, 'user_avatar' => $user_avatar, 'categories' => $categories, 'is_auth' => $is_auth]);
print($layout_content);


