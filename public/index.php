<?php
session_start();

// Include necessary files
require_once '../src/db/connection.php';
require_once '../src/controllers/authController.php';

// Check if the user is already logged in
if (isset($_SESSION['judge_id'])) {
    header('Location: judge_dashboard.php'); // Redirect to the dashboard if logged in
    exit();
}

// Redirect to the registration page by default
header('Location: register.php'); // Redirect to the registration page
exit();

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $authController = new AuthController();
    $loginResult = $authController->login($username, $password);

    if ($loginResult) {
        header('Location: judge_dashboard.php');
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="no">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="favicon.ico"> <!-- Link to the favicon -->
    <link rel="apple-touch-icon" href="apple-touch-icon.png"> <!-- Link to the Apple touch icon -->
    <title>Judge Login</title>
</head>
<body>
    <div class="container">
        <h1>Judge Login</h1>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="index.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>