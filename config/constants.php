<?php
//session start
session_start();

define('SITEURL','http://localhost/food-order/');

//create constant to store to store no repeating values  CONSTANT MUST BE IN CAPITAL LETTER
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food-order');
// 3.execute query and save it to database
    $conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());//database connection
    $db_select=mysqli_select_db($conn,DB_NAME) or die(mysqli_error());// select database

    ?>