<?php
// Lesson.php

require_once __DIR__ . '/../config/Database.php';

class Lesson {
    public $id;
    public $course_id;
    public $title;
    public $content;
    public $video_url;
    public $order;
    public $created_at;

    public static function getLessonsByCourse($courseId) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT * FROM lessons WHERE course_id = ? ORDER BY `order`");
        $stmt->execute([$courseId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save() {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO lessons (course_id, title, content, video_url, `order`) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$this->course_id, $this->title, $this->content, $this->video_url, $this->order]);
        $this->id = $pdo->lastInsertId();
    }

    public function update() {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE lessons SET title = ?, content = ?, video_url = ?, `order` = ? WHERE id = ?");
        $stmt->execute([$this->title, $this->content, $this->video_url, $this->order, $this->id]);
    }

    public static function delete($id) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("DELETE FROM lessons WHERE id = ?");
        $stmt->execute([$id]);
    }
}
