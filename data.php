<?php
$is_auth = (bool) rand(0, 1);

$user_name = 'Константин';
$user_avatar = 'img/user.jpg';
$categories = ["Доски и лыжи","Крепления","Ботинки","Одежда","Инструменты","Разное"];

// ставки пользователей, которыми надо заполнить таблицу
$bets = [
    ['name' => 'Иван', 'price' => 11500, 'ts' => strtotime('-' . rand(1, 50) .' minute')],
    ['name' => 'Константин', 'price' => 11000, 'ts' => strtotime('-' . rand(1, 18) .' hour')],
    ['name' => 'Евгений', 'price' => 10500, 'ts' => strtotime('-' . rand(25, 50) .' hour')],
    ['name' => 'Семён', 'price' => 10000, 'ts' => strtotime('last week')]
];

$ads = [
    [
        'lot-name' => '2014 Rossiglon District Snowboard',
        'categoty' => 'Доски и лыжи',
        'lot-rate' => 10999,
        'image' => 'img/lot-1.jpg'
    ],
    [
        'lot-name' => 'DC Ply Mens 2016/2017 Snowboard',
        'categoty' => 'Доски и лыжи',
        'lot-rate' => 159999,
        'image' => 'img/lot-2.jpg'
    ],
    [
        'lot-name' => 'Креаления Union Contact Pro 2015 года размер L/XL',
        'categoty' => 'Крепления',
        'lot-rate' => 8000,
        'image' => 'img/lot-3.jpg'
    ],
    [
        'lot-name' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'categoty' => 'Ботинки',
        'lot-rate' => 10999,
        'image' => 'img/lot-4.jpg'
    ],
    [
        'lot-name' => 'Куртка для сноуборда DC Mutiny Charocal',
        'categoty' => 'Одежда',
        'lot-rate' => 7500,
        'image' => 'img/lot-5.jpg'
    ],
    [
        'lot-name' => 'Маска Oakley Canopy',
        'categoty' => 'Разное',
        'lot-rate' => 5400,
        'image' => 'img/lot-6.jpg'
    ]
];