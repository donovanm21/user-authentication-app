<?php

// Define all MySQL vars
define('DBHOST', 'server host');
define('DBUSER', 'username');
define('DBPASS', 'password');
define('DBNAME', 'librarydb');

// Define application vars
define('ROOT', 'https://my.amazingapp.com/');

// MySQL connection
$mysqli = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

// Check for connection errors
if($mysqli === false){
    die('ERROR: Connection failed. ' . $mysqli->connect_error);
}