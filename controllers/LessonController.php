<?php
// LessonController.php

require_once __DIR__ . '/../models/Lesson.php';
require_once __DIR__ . '/../models/Material.php';
require_once __DIR__ . '/../models/Course.php';
require_once __DIR__ . '/../helpers/AuthHelper.php';

class LessonController {

    public function manageLessons($courseId) {
        requireRole(1);
        // Check if course belongs to instructor
        $course = Course::getCourseById($courseId);
        if ($course['instructor_id'] != $_SESSION['user']['id']) {
            echo "Access denied.";
            return;
        }
        $lessons = Lesson::getLessonsByCourse($courseId);
        require 'views/instructor/lessons/manage.php';
    }

    public function createLesson($courseId) {
        requireRole(1);
        // Check ownership
        $course = Course::getCourseById($courseId);
        if ($course['instructor_id'] != $_SESSION['user']['id']) {
            echo "Access denied.";
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $lesson = new Lesson();
            $lesson->course_id = $courseId;
            $lesson->title = $_POST['title'];
            $lesson->content = $_POST['content'];
            $lesson->video_url = $_POST['video_url'];
            $lesson->order = $_POST['order'];
            $lesson->save();
            header('Location: index.php?action=manageLessons&courseId=' . $courseId);
            exit;
        } else {
            $courses = Course::getCoursesByInstructor($_SESSION['user']['id']);
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
            echo "Access denied.";
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $lessonObj = new Lesson();
            $lessonObj->id = $lessonId;
            $lessonObj->title = $_POST['title'];
            $lessonObj->content = $_POST['content'];
            $lessonObj->video_url = $_POST['video_url'];
            $lessonObj->order = $_POST['order'];
            $lessonObj->update();
            header('Location: index.php?action=manageLessons&courseId=' . $_POST['course_id']);
            exit;
        } else {
            $courses = Course::getCoursesByInstructor($_SESSION['user']['id']);
            require 'views/instructor/lessons/edit.php';
        }
    }

    public function deleteLesson($lessonId) {
        requireRole(1);
        // Check ownership
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT c.instructor_id FROM lessons l JOIN courses c ON l.course_id = c.id WHERE l.id = ?");
        $stmt->execute([$lessonId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result || $result['instructor_id'] != $_SESSION['user']['id']) {
            echo "Access denied.";
            return;
        }
        Lesson::delete($lessonId);
        header('Location: index.php?action=manageLessons&courseId=' . $_GET['courseId']);
        exit;
    }
}
