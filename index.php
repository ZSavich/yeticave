<?php
require_once 'functions.php';

$is_auth = (bool) rand(0, 1);

$user_name = 'Константин';
$user_avatar = 'img/user.jpg';
$categories = ["Доски и лыжи","Крепления","Ботинки","Одежда","Инструменты","Разное"];
$ads = [
        [
            'title' => '2014 Rossiglon District Snowboard',
            'categories' => 'Доски и лыжи',
            'price' => 10999,
            'image' => 'img/lot-1.jpg'
        ],
        [
            'title' => 'DC Ply Mens 2016/2017 Snowboard',
            'categories' => 'Доски и лыжи',
            'price' => 159999,
            'image' => 'img/lot-2.jpg'
        ],
        [
            'title' => 'Креаления Union Contact Pro 2015 года размер L/XL',
            'categories' => 'Крепления',
            'price' => 8000,
            'image' => 'img/lot-3.jpg'
        ],
        [
            'title' => 'Ботинки для сноуборда DC Mutiny Charocal',
            'categories' => 'Ботинки',
            'price' => 10999,
            'image' => 'img/lot-4.jpg'
        ],
        [
            'title' => 'Куртка для сноуборда DC Mutiny Charocal',
            'categories' => 'Одежда',
            'price' => 7500,
            'image' => 'img/lot-5.jpg'
        ],
        [
            'title' => 'Маска Oakley Canopy',
            'categories' => 'Разное',
            'price' => 5400,
            'image' => 'img/lot-6.jpg'
        ]
];

function format_price($price) {
    $price = ceil($price);

  if($price > 999) {
      $final_price = number_format($price, 0, '', ' ');
      return $final_price;
  } else {
      return $price;
  }
}

function esc($text) {
    return strip_tags($text);
}

$page_content = renderTemplate('templates/index.php', ['ads' => $ads]);
$layout_content = renderTemplate('templates/layout.php', ['content' => $page_content, 'user_name' => $user_name, 'user_avatar' => $user_avatar, 'categories' => $categories, 'is_auth' => $is_auth]);
print($layout_content);

; ?>


