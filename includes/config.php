<?php

//session start

session_start();

//create constants to storenon repeating values
define('SITEURL','http://localhost/restorant/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'Pratibha@2001');
define('DB_NAME', 'food-restaurant');

//execute query and save data into database

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));
?>