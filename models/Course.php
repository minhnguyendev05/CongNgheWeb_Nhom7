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
        $stmt = $pdo->prepare("SELECT * FROM courses WHERE instructor_id = ?");
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
        $stmt = $pdo->prepare("UPDATE courses SET title = ?, description = ?, category_id = ?, price = ?, duration_weeks = ?, level = ?, image = ?, status = ? WHERE id = ?");
        $stmt->execute([$this->title, $this->description, $this->category_id, $this->price, $this->duration_weeks, $this->level, $this->image, $this->status, $this->id]);
    }

    public static function delete($id) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("DELETE FROM courses WHERE id = ?");
        $stmt->execute([$id]);
    }
}
