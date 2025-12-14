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
        $stmt = $pdo->prepare("
            SELECT 
                e.*,
                c.title as course_title,
                c.description as course_description,
                c.image as course_image,
                u.fullname as instructor_name,
                e.enrolled_date as enrollment_date
            FROM enrollments e
            LEFT JOIN courses c ON e.course_id = c.id
            LEFT JOIN users u ON c.instructor_id = u.id
            WHERE e.student_id = ?
            ORDER BY e.enrolled_date DESC
        ");
        $stmt->execute([$studentId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getEnrollmentsByCourse($courseId) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("
            SELECT 
                e.*,
                u.id as student_id,
                u.fullname as student_name,
                u.email as student_email,
                u.avatar,
                c.title as course_title,
                e.enrolled_date as enrollment_date
            FROM enrollments e
            LEFT JOIN users u ON e.student_id = u.id
            LEFT JOIN courses c ON e.course_id = c.id
            WHERE e.course_id = ?
            ORDER BY e.enrolled_date DESC
        ");
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
