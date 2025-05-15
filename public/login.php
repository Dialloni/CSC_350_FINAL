<?php
session_start();
require_once '../src/db/connection.php';

// Hardcoded admin credentials
$adminUsername = 'admin';
$adminPassword = 'admin123';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check for admin login
    if ($username === $adminUsername && $password === $adminPassword) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin_dashboard.php');
        exit();
    }

    // Check for judge login
    $stmt = $pdo->prepare("SELECT * FROM judges WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $judge = $stmt->fetch();

    if ($judge && password_verify($password, $judge['password'])) {
        $_SESSION['judge_id'] = $judge['id'];
        $_SESSION['judge_name'] = $judge['username'];
        header('Location: judge_dashboard.php');
        exit();
    }

    $error = "Invalid username or password.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
         <p>Admins can log in using the username <strong>admin</strong> and password <strong>admin123</strong>.</p>
          <p>Don't have an account? <a href="register.php">Register here</a>.</p>
    </div>
</body>
</html>