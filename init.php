<?php
require_once 'functions.php';

$connect = mysqli_connect("localhost", "root", "", "yeticave");

mysqli_set_charset($connect, "utf8");

require_once 'mysql_helper.php';
