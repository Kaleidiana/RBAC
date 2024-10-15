<?php
require('db.php'); // Include your database connection file
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement to fetch user data
    
    $stmt = $conn->prepare($sql = "SELECT id, password, username, role FROM users WHERE username = ?");
    $stmt->bind_param(types: "s", var: $username);
    $stmt->execute();
    $stmt->store_result();


    // Check if the user exists
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $hashed_password, $role);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Store user information in session
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            $_SESSION['user_id'] = $id;

            // Redirect based on user role
            if ($user["role"] === 'admin') {
                header("Location: admin_dashboard.php"); // Change this to your admin dashboard page
            } else {
                header("Location: user_dashboard.php"); // Change this to your user dashboard page
            }
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Login</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
