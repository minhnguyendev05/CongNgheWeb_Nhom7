<?php
// LessonController.php

require_once __DIR__ . '/../models/Lesson.php';
require_once __DIR__ . '/../models/Material.php';
require_once __DIR__ . '/../models/Course.php';
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../helpers/AuthHelper.php';
require_once __DIR__ . '/../helpers/ValidationHelper.php';

class LessonController {

    public function manageLessons($courseId) {
        requireRole(1);
        // Check if course belongs to instructor
        $course = Course::getCourseById($courseId);
        if ($course['instructor_id'] != $_SESSION['user']['id']) {
            throw new Exception('Access denied: Not course owner', 403);
        }
        $lessons = Lesson::getLessonsByCourse($courseId);
        // Fetch courses for the dropdown filter
        $courses = Course::getCoursesByInstructor($_SESSION['user']['id']);
        require 'views/instructor/lessons/manage.php';
    }

    public function createLesson($courseId) {
        requireRole(1);
        // Check ownership
        $course = Course::getCourseById($courseId);
        if ($course['instructor_id'] != $_SESSION['user']['id']) {
            throw new Exception('Access denied: Not course owner', 403);
        }
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate required fields
            $errors = ValidationHelper::validateRequired($_POST, ['title', 'content', 'order']);
            
            // Validate field formats
            if (!empty($_POST['title']) && (strlen($_POST['title']) < 3 || strlen($_POST['title']) > 255)) {
                $errors[] = "Lesson title must be 3-255 characters";
            }
            if (!empty($_POST['content']) && strlen($_POST['content']) < 10) {
                $errors[] = "Lesson content must be at least 10 characters";
            }
            if (!ValidationHelper::validateDuration($_POST['duration'] ?? '')) {
                $errors[] = "Duration must be a positive number";
            }
            if (!empty($_POST['order']) && !is_numeric($_POST['order'])) {
                $errors[] = "Order must be a number";
            }
            
            if (empty($errors)) {
                $lesson = new Lesson();
                $lesson->course_id = $courseId;
                $lesson->title = ValidationHelper::sanitize($_POST['title']);
                $lesson->description = !empty($_POST['description']) ? ValidationHelper::sanitize($_POST['description']) : null;
                $lesson->content = $_POST['content'];
                $lesson->video_url = !empty($_POST['video_url']) ? ValidationHelper::sanitize($_POST['video_url']) : null;
                $lesson->order_number = $_POST['order'];
                $lesson->duration = !empty($_POST['duration']) ? $_POST['duration'] : null;
                $lesson->save();
                
                // Upload materials if provided
                if (isset($_FILES['materials']) && !empty($_FILES['materials']['name'][0])) {
                    $this->handleMaterialsUpload($_FILES['materials'], $lesson->id);
                }
                
                header('Location: ' . BASE_PATH . '/instructor/course/' . $courseId . '/lessons');
                exit;
            } else {
                $error = $errors[0];
                require 'views/instructor/lessons/create.php';
            }
        } else {
            require 'views/instructor/lessons/create.php';
        }
    }

    public function editLesson($lessonId) {
        requireRole(1);
        // Get lesson and check ownership via course
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT l.*, c.instructor_id FROM lessons l JOIN courses c ON l.course_id = c.id WHERE l.id = ?");
        $stmt->execute([$lessonId]);
        $lesson = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$lesson || $lesson['instructor_id'] != $_SESSION['user']['id']) {
            throw new Exception('Access denied: Not course owner', 403);
        }
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate required fields
            $errors = ValidationHelper::validateRequired($_POST, ['title', 'content', 'order']);
            
            // Validate field formats
            if (!empty($_POST['title']) && (strlen($_POST['title']) < 3 || strlen($_POST['title']) > 255)) {
                $errors[] = "Lesson title must be 3-255 characters";
            }
            if (!empty($_POST['content']) && strlen($_POST['content']) < 10) {
                $errors[] = "Lesson content must be at least 10 characters";
            }
            if (!ValidationHelper::validateDuration($_POST['duration'] ?? '')) {
                $errors[] = "Duration must be a positive number";
            }
            if (!empty($_POST['order']) && !is_numeric($_POST['order'])) {
                $errors[] = "Order must be a number";
            }
            
            if (empty($errors)) {
                $lessonObj = new Lesson();
                $lessonObj->id = $lessonId;
                $lessonObj->title = ValidationHelper::sanitize($_POST['title']);
                $lessonObj->description = !empty($_POST['description']) ? ValidationHelper::sanitize($_POST['description']) : null;
                $lessonObj->content = $_POST['content'];
                $lessonObj->video_url = !empty($_POST['video_url']) ? ValidationHelper::sanitize($_POST['video_url']) : null;
                $lessonObj->order_number = $_POST['order'];
                $lessonObj->duration = !empty($_POST['duration']) ? $_POST['duration'] : null;
                $lessonObj->update();
                
                // Upload new materials if provided - delete old materials first
                if (isset($_FILES['materials']) && !empty($_FILES['materials']['name'][0])) {
                    $this->deleteOldMaterials($lessonId);
                    $this->handleMaterialsUpload($_FILES['materials'], $lessonId);
                }
                
                header('Location: ' . BASE_PATH . '/instructor/course/' . $lesson['course_id'] . '/lessons');
                exit;
            } else {
                $error = $errors[0];
                $courses = Course::getCoursesByInstructor($_SESSION['user']['id']);
                require 'views/instructor/lessons/edit.php';
            }
        } else {
            $courses = Course::getCoursesByInstructor($_SESSION['user']['id']);
            require 'views/instructor/lessons/edit.php';
        }
    }

    public function deleteLesson($lessonId) {
        requireRole(1);
        // Check ownership and get courseId
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT l.course_id, c.instructor_id FROM lessons l JOIN courses c ON l.course_id = c.id WHERE l.id = ?");
        $stmt->execute([$lessonId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result || $result['instructor_id'] != $_SESSION['user']['id']) {
            throw new Exception('Access denied: Not course owner', 403);
        }
        $courseId = $result['course_id'];
        Lesson::delete($lessonId);
        header('Location: ' . BASE_PATH . '/instructor/course/' . $courseId . '/lessons');
        exit;
    }

    /**
     * Handle materials upload for lesson
     * @param array $files Files array from $_FILES['materials']
     * @param int $lessonId Lesson ID
     * @throws Exception
     */
    private function handleMaterialsUpload($files, $lessonId) {
        if (!$files || !isset($files['name']) || empty($files['name'][0])) {
            return;
        }

        $allowedTypes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/zip',
            'application/x-rar-compressed',
            'text/plain',
            'image/jpeg',
            'image/png',
            'image/gif',
            'image/webp'
        ];

        // Create upload directory if not exists
        $uploadDir = __DIR__ . '/../assets/uploads/materials/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Process each file
        for ($i = 0; $i < count($files['name']); $i++) {
            if ($files['error'][$i] !== UPLOAD_ERR_OK) {
                continue; // Skip files with errors
            }

            // Validate file type using MIME
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $files['tmp_name'][$i]);
            finfo_close($finfo);

            if (!in_array($mimeType, $allowedTypes)) {
                throw new Exception("File '{$files['name'][$i]}' has invalid type. Only PDF, DOC, PPT, XLS, ZIP, TXT, and images are allowed.");
            }

            // Validate file size (50MB max)
            $maxSize = 50 * 1024 * 1024;
            if ($files['size'][$i] > $maxSize) {
                throw new Exception("File '{$files['name'][$i]}' exceeds 50MB limit.");
            }

            // Generate unique filename
            $extension = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
            $filename = uniqid('material_') . '.' . strtolower($extension);
            $filepath = $uploadDir . $filename;

            // Move file
            if (move_uploaded_file($files['tmp_name'][$i], $filepath)) {
                $material = new Material();
                $material->lesson_id = $lessonId;
                $material->filename = basename($files['name'][$i]);
                $material->file_path = 'assets/uploads/materials/' . $filename;
                $material->file_type = $mimeType;
                $material->save();
            }
        }
    }

    /**
     * Delete old materials for a lesson
     * @param int $lessonId Lesson ID
     */
    private function deleteOldMaterials($lessonId) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT file_path FROM materials WHERE lesson_id = ?");
        $stmt->execute([$lessonId]);
        $materials = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Delete files from server
        foreach ($materials as $material) {
            $filePath = __DIR__ . '/../' . $material['file_path'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        
        // Delete records from database
        $stmt = $pdo->prepare("DELETE FROM materials WHERE lesson_id = ?");
        $stmt->execute([$lessonId]);
    }
}
