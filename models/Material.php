<?php
// Material.php

require_once __DIR__ . '/../config/Database.php';

class Material {
    public $id;
    public $lesson_id;
    public $filename;
    public $file_path;
    public $file_type;
    public $uploaded_at;

    public static function getMaterialsByLesson($lessonId) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT * FROM materials WHERE lesson_id = ?");
        $stmt->execute([$lessonId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getMaterialById($id) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT * FROM materials WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function save() {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO materials (lesson_id, filename, file_path, file_type) VALUES (?, ?, ?, ?)");
        $stmt->execute([$this->lesson_id, $this->filename, $this->file_path, $this->file_type]);
        $this->id = $pdo->lastInsertId();
    }

    public static function delete($id) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("DELETE FROM materials WHERE id = ?");
        $stmt->execute([$id]);
    }
}
