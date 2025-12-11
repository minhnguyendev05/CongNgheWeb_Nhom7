<?php
// Enrollment.php

require_once __DIR__ . '/../config/Database.php';

class Enrollment {
    public $id;
    public $course_id;
    public $student_id;
    public $enrolled_date;
    public $status;
    public $progress;

    public static function getEnrollmentsByStudent($studentId) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT * FROM enrollments WHERE student_id = ?");
        $stmt->execute([$studentId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getEnrollmentsByCourse($courseId) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT * FROM enrollments WHERE course_id = ?");
        $stmt->execute([$courseId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save() {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO enrollments (course_id, student_id, status, progress) VALUES (?, ?, ?, ?)");
        $stmt->execute([$this->course_id, $this->student_id, $this->status, $this->progress]);
        $this->id = $pdo->lastInsertId();
    }

    public function update() {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE enrollments SET status = ?, progress = ? WHERE id = ?");
        $stmt->execute([$this->status, $this->progress, $this->id]);
    }
}
