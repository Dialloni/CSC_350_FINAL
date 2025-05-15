<?php
require_once __DIR__ . '/../src/db/connection.php';
require_once __DIR__ . '/../src/controllers/submitGrades.php';

$gradeController = new GradeController($pdo); // Pass the database connection
$grades = $gradeController->getGrades(); // Fetch all grades
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>View Grades</title>
</head>
<body>
    <h1>Grades Submitted</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judge ID</th>
                <th>Group Number</th>
                <th>Total Score</th>
                <th>Average Score</th>
                <th>Comments</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($grades as $grade): ?>
                <tr>
                    <td><?php echo htmlspecialchars($grade['id']); ?></td>
                    <td><?php echo htmlspecialchars($grade['judge_id']); ?></td>
                    <td><?php echo htmlspecialchars($grade['group_number']); ?></td>
                    <td><?php echo htmlspecialchars($grade['total_score']); ?></td>
                    <td><?php echo htmlspecialchars($grade['average_score']); ?></td>
                    <td><?php echo htmlspecialchars($grade['comments']); ?></td>
                    <td><?php echo htmlspecialchars($grade['created_at']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>