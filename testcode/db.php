<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'PremiumAdmin120');
define('DB_NAME', 'premiumretail');

//Creating connection 
//Using the SQLI method
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS, DB_NAME);

//Checking connection
if($conn->connect_error){
    die('Connection Failed'. $conn->connect_error);
}


?>


