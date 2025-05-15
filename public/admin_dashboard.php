<?php
session_start();
require_once '../src/db/connection.php';

// Ensure the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

$stmt = $pdo->query("SELECT * FROM grades");
$gradesList = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <h2>Submitted Grades</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Group Number</th>
                    <th>Group Members</th>
                    <th>Project Title</th>
                    <th>Articulate Requirements</th>
                    <th>Choose Tools</th>
                    <th>Oral Presentation</th>
                    <th>Teamwork</th>
                    <th>Total Score</th>
                    <th>Comments</th>
                    <th>Submitted At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($gradesList as $grade): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($grade['group_number'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($grade['group_members'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($grade['project_title'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($grade['articulate_requirements'] ?? '0'); ?></td>
                        <td><?php echo htmlspecialchars($grade['choose_tools'] ?? '0'); ?></td>
                        <td><?php echo htmlspecialchars($grade['oral_presentation'] ?? '0'); ?></td>
                        <td><?php echo htmlspecialchars($grade['teamwork'] ?? '0'); ?></td>
                        <td><?php echo htmlspecialchars($grade['total_score'] ?? '0'); ?></td>
                        <td><?php echo htmlspecialchars($grade['comments'] ?? 'No comments'); ?></td>
                        <td><?php echo htmlspecialchars($grade['created_at'] ?? 'N/A'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>