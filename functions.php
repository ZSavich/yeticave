<?php
session_start();
function renderTemplate($link, $array) {
    $content = "";
    if(file_exists($link)) {
        extract($array);
        ob_start();
        require_once $link;
        $content = ob_get_clean();
        return $content;
    }

    return $content;
}

function format_price($price) {
    $price = ceil($price);

    if($price > 999) {
        $final_price = number_format($price, 0, '', ' ');
        return $final_price;
    } else {
        return $price;
    }
}

function format_data($data) {
    date_default_timezone_set("Europe/Moscow");
    $minute = floor(((strtotime($data) - time())/60) % 60);
    $hour = floor(((strtotime($data) - time())/3600) % 24);
    $day = floor(((strtotime($data) - time())/86400) % 24);
    return $day . " дн. " . str_pad($hour, 2, '0', STR_PAD_LEFT) . ":" . str_pad($minute, 2, '0', STR_PAD_LEFT);
}

function esc($text) {
    return strip_tags($text);
}

function search_user_by_email($value, $array){
    foreach($array as $user => $key) {
        if($key['email'] == $value)
            return ['email' => $key['email'], 'name' => $key['name'], 'password' => $key['password']];
    }
    return false;
}
;?>
