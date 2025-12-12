<?php

require_once __DIR__ . '/../models/Course.php';
require_once __DIR__ . '/../models/Lesson.php';
require_once __DIR__ . '/../models/Material.php';
require_once __DIR__ . '/../models/Enrollment.php';
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../helpers/AuthHelper.php';

class CourseController {

    public function dashboard() {
        requireRole(1);
        $courses = Course::getCoursesByInstructor($_SESSION['user']['id']);
        require 'views/instructor/dashboard.php';
    }

    public function manageCourses() {
        requireRole(1);
        $courses = Course::getCoursesByInstructor($_SESSION['user']['id']);
        require 'views/instructor/course/manage.php';
    }

    public function createCourse() {
        requireRole(1);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $course = new Course();
            $course->title = $_POST['title'];
            $course->description = $_POST['description'];
            $course->instructor_id = $_SESSION['user']['id'];
            $course->category_id = $_POST['category_id'];
            $course->price = $_POST['price'];
            $course->duration_weeks = $_POST['duration_weeks'] ?? null;
            $course->level = $_POST['level'] ?? null;
            $course->image = $_POST['image'] ?? null;
            $course->status = 'pending';
            $course->save();
            header('Location: index.php?action=manageCourses');
            exit;
        } else {
            require_once __DIR__ . '/../models/Category.php';
            $categories = Category::getAllCategories();
            require 'views/instructor/course/create.php';
        }
    }

    public function editCourse($courseId) {
        requireRole(1);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $course = new Course();
            $course->id = $courseId;
            $course->title = $_POST['title'];
            $course->description = $_POST['description'];
            $course->category_id = $_POST['category_id'];
            $course->price = $_POST['price'];
            $course->duration_weeks = $_POST['duration_weeks'] ?? null;
            $course->level = $_POST['level'] ?? null;
            $course->image = $_POST['image'] ?? null;
            $course->update();
            header('Location: index.php?action=manageCourses');
            exit;
        } else {
            $course = Course::getCourseById($courseId);
            require_once __DIR__ . '/../models/Category.php';
            $categories = Category::getAllCategories();
            require 'views/instructor/course/edit.php';
        }
    }

    public function deleteCourse($courseId) {
        requireRole(1);
        Course::delete($courseId);
        header('Location: index.php?action=manageCourses');
        exit;
    }

    public function uploadMaterial($lessonId) {
        requireRole(1);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate file
            if (!isset($_FILES['material']) || $_FILES['material']['error'] != UPLOAD_ERR_OK) {
                echo "Upload error.";
                return;
            }
            $file = $_FILES['material'];
            $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-powerpoint'];
            if (!in_array($file['type'], $allowedTypes)) {
                echo "Invalid file type.";
                return;
            }
            if ($file['size'] > 10 * 1024 * 1024) { // 10MB
                echo "File too large.";
                return;
            }
            $material = new Material();
            $material->lesson_id = $lessonId;
            $material->filename = basename($file['name']);
            $material->file_path = 'assets/uploads/materials/' . uniqid() . '_' . $material->filename;
            $material->file_type = $file['type'];
            if (move_uploaded_file($file['tmp_name'], $material->file_path)) {
                $material->save();
                header('Location: index.php?action=manageLessons&courseId=' . $_GET['courseId']);
                exit;
            } else {
                echo "Upload failed.";
            }
        } else {
            $courses = Course::getCoursesByInstructor($_SESSION['user']['id']);
            $lessons = [];
            foreach ($courses as $course) {
                $courseLessons = Lesson::getLessonsByCourse($course['id']);
                $lessons = array_merge($lessons, $courseLessons);
            }
            $recentMaterials = []; // Add logic to get recent materials if needed
            require 'views/instructor/materials/upload.php';
        }
    }

    public function viewEnrolledStudents($courseId) {
        requireRole(1);
        $course = Course::getCourseById($courseId);
        if ($course['instructor_id'] != $_SESSION['user']['id']) {
            echo "Access denied.";
            return;
        }
        $enrollments = Enrollment::getEnrollmentsByCourse($courseId);
        $courses = Course::getCoursesByInstructor($_SESSION['user']['id']);
        $stats = [
            'total_students' => count($enrollments),
            'active_students' => count(array_filter($enrollments, function($e) { return strtotime($e['last_activity'] ?? '2000-01-01') > strtotime('-7 days'); })),
            'completion_rate' => 0 // Calculate based on your logic
        ];
        $isAllStudents = false;
        $selectedCourse = $courseId;
        require 'views/instructor/students/list.php';
    }

    public function viewAllStudents() {
        requireRole(1);
        $courses = Course::getCoursesByInstructor($_SESSION['user']['id']);
        $allEnrollments = [];
        foreach ($courses as $course) {
            $enrollments = Enrollment::getEnrollmentsByCourse($course['id']);
            foreach ($enrollments as $enrollment) {
                $enrollment['course_title'] = $course['title'];
                $allEnrollments[] = $enrollment;
            }
        }
        $enrollments = $allEnrollments;
        $stats = [
            'total_students' => count(array_unique(array_column($enrollments, 'student_id'))),
            'active_students' => count(array_filter($enrollments, function($e) { return strtotime($e['last_activity'] ?? '2000-01-01') > strtotime('-7 days'); })),
            'completion_rate' => 0 // Calculate based on your logic
        ];
        $isAllStudents = true;
        require 'views/instructor/students/list.php';
    }

    public function trackStudentProgress($courseId, $studentId) {
        requireRole(1);
        $course = Course::getCourseById($courseId);
        if ($course['instructor_id'] != $_SESSION['user']['id']) {
            echo "Access denied.";
            return;
        }
        $enrollment = Enrollment::getEnrollmentsByStudent($studentId);
        $enrollment = array_filter($enrollment, function($e) use ($courseId) { return $e['course_id'] == $courseId; });
        $enrollment = reset($enrollment);
        $lessons = Lesson::getLessonsByCourse($courseId);
        require 'views/instructor/student_progress.php';
    }
}
