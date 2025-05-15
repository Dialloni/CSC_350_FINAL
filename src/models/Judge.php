<?php

class Judge {
    private $id;
    private $name;
    private $email;
    private $password;

    public function __construct($id, $name, $email, $password) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function verifyPassword($password) {
        return password_verify($password, $this->password);
    }

    public function save() {
        // Code to save judge details to the database
    }

    public static function findById($id) {
        // Code to find a judge by ID from the database
    }

    public static function findAll() {
        // Code to retrieve all judges from the database
    }
}