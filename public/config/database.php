<?php
// Database configuration
define('DB_HOST', 'mysql');
define('DB_USER', 'adminmysqldocker');
define('DB_PASS', 'password_enviroment');
define('DB_NAME', 'my_project');


$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);


if (!$link) {
   die("Connection failed: " . mysqli_connect_error());
}


// Create database connection
function getDBConnection() {
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }

        $conn->set_charset("utf8mb4");
        return $conn;
    } catch (Exception $e) {
        die("Database connection error: " . $e->getMessage());
    }
}




?>
