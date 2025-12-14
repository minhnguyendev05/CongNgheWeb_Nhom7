<?php
// Lesson.php

require_once __DIR__ . '/../config/Database.php';

class Lesson {
    public $id;
    public $course_id;
    public $title;
    public $description;
    public $content;
    public $video_url;
    public $order_number;
    public $duration;
    public $created_at;

    public static function getLessonsByCourse($courseId) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT l.*, c.title as course_title FROM lessons l LEFT JOIN courses c ON l.course_id = c.id WHERE l.course_id = ? ORDER BY l.order_number");
        $stmt->execute([$courseId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save() {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO lessons (course_id, title, description, content, video_url, order_number, duration) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$this->course_id, $this->title, $this->description, $this->content, $this->video_url, $this->order_number, $this->duration]);
        $this->id = $pdo->lastInsertId();
    }

    public function update() {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE lessons SET title = ?, description = ?, content = ?, video_url = ?, order_number = ?, duration = ? WHERE id = ?");
        $stmt->execute([$this->title, $this->description, $this->content, $this->video_url, $this->order_number, $this->duration, $this->id]);
    }

    public static function delete($id) {
        $pdo = Database::getInstance()->getConnection();
        
        // Delete all materials for this lesson first
        $stmtMaterials = $pdo->prepare("DELETE FROM materials WHERE lesson_id = ?");
        $stmtMaterials->execute([$id]);
        
        // Then delete the lesson
        $stmt = $pdo->prepare("DELETE FROM lessons WHERE id = ?");
        $stmt->execute([$id]);
    }
}
