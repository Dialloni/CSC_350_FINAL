<?php

class Grade {
    private $criteria;
    private $scores;

    public function __construct() {
        $this->criteria = [
            'Articulate requirements' => 0,
            'Choose appropriate tools and methods for each task' => 0,
            'Give clear and coherent oral presentation' => 0,
            'Functioned well as a team' => 0
        ];
        $this->scores = [];
    }

    public function setScore($criterion, $score) {
        if (array_key_exists($criterion, $this->criteria) && $score >= 0) {
            $this->criteria[$criterion] = $score;
            $this->scores[] = $score;
        }
    }

    public function calculateTotal() {
        return array_sum($this->scores);
    }

    public function calculateAverage() {
        if (count($this->scores) === 0) {
            return 0;
        }
        return array_sum($this->scores) / count($this->scores);
    }

    public function getCriteria() {
        return $this->criteria;
    }
}