<?php
/*
define('DB_SERVER', '192.168.7.194');
define('DB_USERNAME', 'griz');
define('DB_PASSWORD', '1234');
define('DB_NAME', 'resto');
 
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
if($link === false)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
   
}
*/
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'resto');
 
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
if($link === false)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

?> 