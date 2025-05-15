<?php
require_once __DIR__ . '/../src/db/connection.php';
require_once __DIR__ . '/../src/controllers/submitGrades.php';

$gradeController = new GradeController($pdo); // Pass the database connection
class GradeController {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection; // Assign the passed database connection to the class property
    }

    public function submitGrades($judgeId, $groupNumber, $grades, $comments, $judgeName) {
        $totalScore = array_sum($grades); // Calculate total
    
        // Insert into the database, including judge_name
        $stmt = $this->db->prepare("
            INSERT INTO grades (
                judge_id, 
                group_number, 
                articulate_requirements, 
                choose_tools, 
                oral_presentation, 
                teamwork, 
                total_score, 
                comments,
                judge_name
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
    
        $stmt->execute([
            $judgeId,
            $groupNumber,
            $grades['articulate_requirements'],
            $grades['choose_tools'],
            $grades['oral_presentation'],
            $grades['teamwork'],
            $totalScore,
            $comments,
            $judgeName
        ]);
    
        return $totalScore;
    }
    
}