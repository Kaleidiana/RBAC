<?php
$host = 'localhost';
$db = 'RBAC';
$user = 'root';
$password = '';

// Create connection
$conn = new mysqli($host, $user, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("ERROR CONNECTING TO DB: " . $conn->connect_error);
} 

// else {
//     echo "Connection to DB successful"; // Added a semicolon at the end
// }
?>
