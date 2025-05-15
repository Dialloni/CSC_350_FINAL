<?php
class AdminController {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function getAverageGrades() {
        $stmt = $this->db->query("
            SELECT 
                group_members, 
                group_number, 
                project_title, 
                AVG(total_score) AS average_grade 
            FROM grades 
            GROUP BY group_number, project_title, group_members
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>