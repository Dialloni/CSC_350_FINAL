<?php
class JudgeController {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    /**
     * Submits grades to the database.
     *
     * @param int $judgeId
     * @param string $groupNumber
     * @param array $grades - keys: articulate_requirements, choose_tools, oral_presentation, teamwork
     * @param string $comments
     * @param string $judgeName
     * @param string $groupMembers
     * @param string $projectTitle
     * @return int totalScore
     */
    public function submitGrades($judgeId, $groupNumber, $grades, $comments, $judgeName, $groupMembers, $projectTitle) {
        $totalScore = array_sum($grades);

        // Prepare insert query with all required fields
        $stmt = $this->db->prepare("
            INSERT INTO grades (
                judge_id,
                group_number,
                group_members,
                project_title,
                articulate_requirements,
                choose_tools,
                oral_presentation,
                teamwork,
                total_score,
                judge_name,
                comments
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $judgeId,
            $groupNumber,
            $groupMembers,
            $projectTitle,
            $grades['articulate_requirements'],
            $grades['choose_tools'],
            $grades['oral_presentation'],
            $grades['teamwork'],
            $totalScore,
            $judgeName,
            $comments
        ]);

        return $totalScore;
    }

    /**
     * Fetches all grades submitted by a specific judge.
     *
     * @param int $judgeId
     * @return array
     */
    public function getJudgeGrades($judgeId) {
        $stmt = $this->db->prepare("SELECT * FROM grades WHERE judge_id = ? ORDER BY created_at DESC");
        $stmt->execute([$judgeId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
