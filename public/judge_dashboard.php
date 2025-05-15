<?php
session_start();
require_once __DIR__ . '/../src/db/connection.php';
require_once __DIR__ . '/../src/controllers/judgeController.php';

// Ensure the judge is logged in
if (!isset($_SESSION['judge_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}

$judge_id = $_SESSION['judge_id'];
$judge_name = $_SESSION['judge_name'] ?? 'Unknown Judge';

// Static placeholders — replace these with dynamic DB data if needed
$project_title = "Computer Science Project";
$group_members = "John Doe, Jane Smith";
$group_number = "Group 1";

$judgeController = new JudgeController($pdo);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $criteria_scores = [
        'articulate_requirements' => $_POST['requirements'],
        'choose_tools' => $_POST['tools_methods'],
        'oral_presentation' => $_POST['presentation'],
        'teamwork' => $_POST['teamwork']
    ];

    $comments = $_POST['comments'];

    // Save the grades and comments to the database
    $totalScore = $judgeController->submitGrades(
        $judge_id,
        $group_number,
        $criteria_scores,
        $comments,
        $judge_name,
        $group_members,
        $project_title
    );

    $successMessage = "Grades submitted successfully! Total Score: $totalScore";
}

// Fetch all grades submitted by the judge
$gradesList = $judgeController->getJudgeGrades($judge_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Judge Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1><?php echo htmlspecialchars($project_title); ?></h1>
    <p><strong>Group:</strong> <?php echo htmlspecialchars($group_number); ?></p>
    <p><strong>Members:</strong> <?php echo htmlspecialchars($group_members); ?></p>

    <?php if (isset($successMessage)): ?>
        <div class="success"><?php echo htmlspecialchars($successMessage); ?></div>
    <?php endif; ?>

    <form method="POST">
        <h2>Evaluation Criteria</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Criteria</th>
                    <th>Developing (0–10)</th>
                    <th>Accomplished (10–15)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Articulate requirements</td>
                    <td><input type="number" id="requirements" name="requirements" min="0" max="10" required></td>
                    <td><input type="number" id="requirements_accomplished" name="requirements_accomplished" min="10" max="15"></td>
                </tr>
                <tr>
                    <td>Choose appropriate tools and methods for each task</td>
                    <td><input type="number" id="tools_methods" name="tools_methods" min="0" max="10" required></td>
                    <td><input type="number" id="tools_methods_accomplished" name="tools_methods_accomplished" min="10" max="15"></td>
                </tr>
                <tr>
                    <td>Give clear and coherent oral presentation</td>
                    <td><input type="number" id="presentation" name="presentation" min="0" max="10" required></td>
                    <td><input type="number" id="presentation_accomplished" name="presentation_accomplished" min="10" max="15"></td>
                </tr>
                <tr>
                    <td>Functioned well as a team</td>
                    <td><input type="number" id="teamwork" name="teamwork" min="0" max="10" required></td>
                    <td><input type="number" id="teamwork_accomplished" name="teamwork_accomplished" min="10" max="15"></td>
                </tr>
            </tbody>
        </table>

        <h3>Total: <span id="total_score">0</span></h3>

        <label>Judge Name:</label>
        <input type="text" name="judge_name" value="<?php echo htmlspecialchars($judge_name); ?>" readonly>

        <label>Comments:</label>
        <textarea name="comments" rows="4"></textarea>

        <button type="submit">Submit Grades</button>
        <!-- Updated link to redirect to login.php for admin login -->
        <a href="login.php">Go to Admin Page</a>
    </form>
</div>

<script>
    // JavaScript to calculate the total score dynamically
    const inputs = document.querySelectorAll('input[type="number"]');
    inputs.forEach(input => {
        input.addEventListener('input', () => {
            let total = 0;
            inputs.forEach(i => {
                total += parseInt(i.value) || 0;
            });
            document.getElementById('total_score').textContent = total;
        });
    });
</script>