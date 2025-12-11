<?php

require_once __DIR__ . '/../models/Course.php';
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/Enrollment.php';
require_once __DIR__ . '/../models/Lesson.php';
require_once __DIR__ . '/../models/Material.php';
require_once __DIR__ . '/../config/Database.php';

class EnrollmentController {

    public function listCourses() {
        $search = $_GET['search'] ?? '';
        $category = $_GET['category'] ?? '';
        $pdo = Database::getInstance()->getConnection();
        $query = "SELECT c.*, u.fullname as instructor_name, cat.name as category_name FROM courses c LEFT JOIN users u ON c.instructor_id = u.id LEFT JOIN categories cat ON c.category_id = cat.id WHERE c.status = 'approved' AND 1=1";
        $params = [];
        if ($search) {
            $query .= " AND c.title LIKE ?";
            $params[] = "%$search%";
        }
        if ($category) {
            $query .= " AND c.category_id = ?";
            $params[] = $category;
        }
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $categories = Category::getAllCategories();

        // Check enrolled courses for logged-in users
        $enrolledCourses = [];
        if (isset($_SESSION['user'])) {
            $enrollments = Enrollment::getEnrollmentsByStudent($_SESSION['user']['id']);
            $enrolledCourses = array_column($enrollments, 'course_id');
        }

        require 'views/student/list_courses.php';
    }

    public function viewCourse($id) {
        $course = Course::getCourseById($id);
        $lessons = Lesson::getLessonsByCourse($id);

        // Check if user is enrolled in this course
        $isEnrolled = false;
        if (isset($_SESSION['user'])) {
            $enrollments = Enrollment::getEnrollmentsByStudent($_SESSION['user']['id']);
            foreach ($enrollments as $e) {
                if ($e['course_id'] == $id) {
                    $isEnrolled = true;
                    break;
                }
            }
        }

        require 'views/student/course_detail.php';
    }

    public function viewEnrolledCourseLessons($courseId) {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit;
        }

        // Check if user is enrolled in this course
        $enrollments = Enrollment::getEnrollmentsByStudent($_SESSION['user']['id']);
        $isEnrolled = false;
        $enrollment = null;
        foreach ($enrollments as $e) {
            if ($e['course_id'] == $courseId) {
                $isEnrolled = true;
                $enrollment = $e;
                break;
            }
        }

        if (!$isEnrolled) {
            header('Location: index.php?action=myCourses');
            exit;
        }

        $course = Course::getCourseById($courseId);
        if (!$course) {
            header('Location: index.php?action=myCourses');
            exit;
        }

        $lessons = Lesson::getLessonsByCourse($courseId);
        require 'views/student/enrolled_course_lessons.php';
    }

    public function enrollCourse($courseId) {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit;
        }

        // Check if user is already enrolled in this course
        $enrollments = Enrollment::getEnrollmentsByStudent($_SESSION['user']['id']);
        foreach ($enrollments as $e) {
            if ($e['course_id'] == $courseId) {
                // User is already enrolled, redirect to my courses
                header('Location: index.php?action=myCourses');
                exit;
            }
        }

        $enrollment = new Enrollment();
        $enrollment->course_id = $courseId;
        $enrollment->student_id = $_SESSION['user']['id'];
        $enrollment->status = 'active';
        $enrollment->progress = 0;
        $enrollment->save();
        header('Location: index.php?action=myCourses');
        exit;
    }

    public function myCourses() {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit;
        }
        $enrollments = Enrollment::getEnrollmentsByStudent($_SESSION['user']['id']);
        $courses = [];
        foreach ($enrollments as $enrollment) {
            $course = Course::getCourseById($enrollment['course_id']);
            if ($course) {
                $course['progress'] = $enrollment['progress'] ?? 0;
                $courses[] = $course;
            }
        }
        require 'views/student/my_courses.php';
    }

    public function studentDashboard() {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit;
        }
        $enrollments = Enrollment::getEnrollmentsByStudent($_SESSION['user']['id']);
        require 'views/student/dashboard.php';
    }

    public function trackProgress($courseId) {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit;
        }
        $enrollments = Enrollment::getEnrollmentsByStudent($_SESSION['user']['id']);
        $enrollment = array_filter($enrollments, function($e) use ($courseId) { return $e['course_id'] == $courseId; });
        $enrollment = reset($enrollment);
        if (!$enrollment) {
            header('Location: index.php?action=myCourses');
            exit;
        }
        $course = Course::getCourseById($courseId);
        $lessons = Lesson::getLessonsByCourse($courseId);
        $completedLessons = []; // You might want to implement this based on progress tracking
        require 'views/student/course_progress.php';
    }

    public function viewLesson($lessonId) {
        // Get lesson by ID
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT * FROM lessons WHERE id = ?");
        $stmt->execute([$lessonId]);
        $lesson = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$lesson) {
            // Instead of redirecting, show lesson detail page with "no lesson found" message
            $lesson = null;
            $course = null;
            $materials = [];
            $lessonNumber = 0;
        } else {
            $course = Course::getCourseById($lesson['course_id']);
            $materials = Material::getMaterialsByLesson($lessonId);
            // Get lesson number
            $stmt = $pdo->prepare("SELECT COUNT(*) as lesson_number FROM lessons WHERE course_id = ? AND id <= ?");
            $stmt->execute([$lesson['course_id'], $lessonId]);
            $lessonNumber = $stmt->fetch(PDO::FETCH_ASSOC)['lesson_number'];
        }
        require 'views/student/lesson_detail.php';
    }

    public function viewMaterial($materialId) {
        $material = Material::getMaterialById($materialId);
        if (!$material) {
            header('Location: index.php?action=myCourses');
            exit;
        }
        // Check if user is enrolled in the course
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT l.course_id FROM materials m JOIN lessons l ON m.lesson_id = l.id WHERE m.id = ?");
        $stmt->execute([$materialId]);
        $courseId = $stmt->fetch(PDO::FETCH_ASSOC)['course_id'];
        $enrollments = Enrollment::getEnrollmentsByStudent($_SESSION['user']['id']);
        $enrolled = false;
        foreach ($enrollments as $enrollment) {
            if ($enrollment['course_id'] == $courseId) {
                $enrolled = true;
                break;
            }
        }
        if (!$enrolled) {
            header('Location: index.php?action=myCourses');
            exit;
        }
        // Serve the file
        $filePath = $material['file_path'];
        if (file_exists($filePath)) {
            header('Content-Type: ' . $material['file_type']);
            header('Content-Disposition: inline; filename="' . $material['filename'] . '"');
            readfile($filePath);
            exit;
        } else {
            echo "File not found.";
        }
    }
}
