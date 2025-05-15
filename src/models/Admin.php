<?php

class Admin {
    private $id;
    private $username;
    private $password;

    public function __construct($id, $username, $password) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function validateCredentials($inputPassword) {
        return password_verify($inputPassword, $this->password);
    }

    public static function fetchAllAdmins($dbConnection) {
        $stmt = $dbConnection->prepare("SELECT * FROM admins");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findAdminById($dbConnection, $id) {
        $stmt = $dbConnection->prepare("SELECT * FROM admins WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}