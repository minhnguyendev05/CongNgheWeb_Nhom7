<?php
// Course.php

require_once __DIR__ . '/../config/Database.php';

class Course {
    public $id;
    public $title;
    public $description;
    public $instructor_id;
    public $category_id;
    public $price;
    public $duration_weeks;
    public $level;
    public $image;
    public $created_at;
    public $updated_at;
    public $status;

    public static function getAllCourses() {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->query("SELECT * FROM courses");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getCourseById($id) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("
            SELECT c.*, u.fullname as instructor_name, cat.name as category_name
            FROM courses c
            LEFT JOIN users u ON c.instructor_id = u.id
            LEFT JOIN categories cat ON c.category_id = cat.id
            WHERE c.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getCoursesByInstructor($instructorId) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("
            SELECT 
                c.*,
                COUNT(DISTINCT e.id) as enrollment_count,
                COUNT(DISTINCT l.id) as lesson_count
            FROM courses c
            LEFT JOIN enrollments e ON c.id = e.course_id
            LEFT JOIN lessons l ON c.id = l.course_id
            WHERE c.instructor_id = ?
            GROUP BY c.id
            ORDER BY c.created_at DESC
        ");
        $stmt->execute([$instructorId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save() {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO courses (title, description, instructor_id, category_id, price, duration_weeks, level, image, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$this->title, $this->description, $this->instructor_id, $this->category_id, $this->price, $this->duration_weeks, $this->level, $this->image, $this->status]);
        $this->id = $pdo->lastInsertId();
    }

    public function update() {
        $pdo = Database::getInstance()->getConnection();
        // Only update editable fields, preserve instructor_id and status
        $stmt = $pdo->prepare("UPDATE courses SET title = ?, description = ?, category_id = ?, price = ?, duration_weeks = ?, level = ?, image = ? WHERE id = ?");
        $stmt->execute([$this->title, $this->description, $this->category_id, $this->price, $this->duration_weeks, $this->level, $this->image, $this->id]);
    }

    public static function delete($id) {
        $pdo = Database::getInstance()->getConnection();
        
        // Get all lessons for this course
        $stmtLessons = $pdo->prepare("SELECT id FROM lessons WHERE course_id = ?");
        $stmtLessons->execute([$id]);
        $lessons = $stmtLessons->fetchAll(PDO::FETCH_ASSOC);
        
        // Delete all materials for all lessons in this course
        foreach ($lessons as $lesson) {
            $stmtMaterials = $pdo->prepare("DELETE FROM materials WHERE lesson_id = ?");
            $stmtMaterials->execute([$lesson['id']]);
        }
        
        // Delete all lessons in this course
        $stmtDeleteLessons = $pdo->prepare("DELETE FROM lessons WHERE course_id = ?");
        $stmtDeleteLessons->execute([$id]);
        
        // Delete all enrollments for this course
        $stmtDeleteEnrollments = $pdo->prepare("DELETE FROM enrollments WHERE course_id = ?");
        $stmtDeleteEnrollments->execute([$id]);
        
        // Delete the course itself
        $stmt = $pdo->prepare("DELETE FROM courses WHERE id = ?");
        $stmt->execute([$id]);
    }
}
