<?php

define('DB_HOST', '');
define('DB_USER', '');
define('DB_PASS', '');
define('DB_NAME', '');
//The above credentials are blank for protection
//Creating connection 
//Using the SQLI method
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS, DB_NAME);

//Checking connection
if($conn->connect_error){
    die('Connection Failed'. $conn->connect_error);
}


?>


