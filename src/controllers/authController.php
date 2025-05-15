<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../db/connection.php';

class AuthController {
    private $db;

    public function __construct($db) {
        $this->db = $db; // Assign the passed database connection to the class property
    }

  
public function login($username, $password) {
    // Check if the user is a judge
    $stmt = $this->db->prepare("SELECT id, name, username, password, 'judge' AS role FROM judges WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $judge = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($judge && password_verify($password, $judge['password'])) {
        return $judge; // Return judge details
    }

    // Check if the user is an admin
    $stmt = $this->db->prepare("SELECT id, username, password, 'admin' AS role FROM admins WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($password, $admin['password'])) {
        return $admin; // Return admin details
    }

    // If no match is found, return false
    return false;
 }
}
?>