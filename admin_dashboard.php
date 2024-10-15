<?php
session_start();

if ($_SESSION['role'] != "admin"){
    header("Location:login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>ADMIN DASHBOARD</h1>
    <button>
        <a href="logout.php">Logout</a>
    </button>
</body>
</html>