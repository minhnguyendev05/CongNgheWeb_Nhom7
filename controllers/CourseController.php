<?php

require_once __DIR__ . '/../models/Course.php';
require_once __DIR__ . '/../models/Lesson.php';
require_once __DIR__ . '/../models/Material.php';
require_once __DIR__ . '/../models/Enrollment.php';
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../helpers/AuthHelper.php';
require_once __DIR__ . '/../helpers/ValidationHelper.php';

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
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate required fields
            $errors = ValidationHelper::validateRequired($_POST, ['title', 'description', 'category_id', 'price', 'level']);
            
            // Validate field formats
            if (!empty($_POST['title']) && (strlen($_POST['title']) < 3 || strlen($_POST['title']) > 255)) {
                $errors[] = "Title must be 3-255 characters";
            }
            if (!empty($_POST['description']) && strlen($_POST['description']) < 10) {
                $errors[] = "Description must be at least 10 characters";
            }
            if (!ValidationHelper::validatePrice($_POST['price'] ?? '')) {
                $errors[] = "Price must be a non-negative number";
            }
            if (!empty($_POST['duration_weeks']) && !ValidationHelper::validateDuration($_POST['duration_weeks'])) {
                $errors[] = "Duration must be a positive number";
            }
            if (!ValidationHelper::validateLevel($_POST['level'] ?? '')) {
                $errors[] = "Invalid level selected";
            }
            
            if (empty($errors)) {
                $course = new Course();
                $course->title = ValidationHelper::sanitize($_POST['title']);
                $course->description = ValidationHelper::sanitize($_POST['description']);
                $course->instructor_id = $_SESSION['user']['id'];
                $course->category_id = $_POST['category_id'];
                $course->price = $_POST['price'];
                $course->duration_weeks = $_POST['duration_weeks'] ?? null;
                $course->level = $_POST['level'] ?? null;
                $course->image = $this->handleImageUpload($_FILES['image'] ?? null);
                $course->status = 'pending';
                $course->save();
                header('Location: ' . BASE_PATH . '/instructor/courses');
                exit;
            } else {
                $error = $errors[0];
                require_once __DIR__ . '/../models/Category.php';
                $categories = Category::getAllCategories();
                require 'views/instructor/course/create.php';
            }
        } else {
            require_once __DIR__ . '/../models/Category.php';
            $categories = Category::getAllCategories();
            require 'views/instructor/course/create.php';
        }
    }

    public function editCourse($courseId) {
        requireRole(1);
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate required fields
            $errors = ValidationHelper::validateRequired($_POST, ['title', 'description', 'category_id', 'price', 'level']);
            
            // Validate field formats
            if (!empty($_POST['title']) && (strlen($_POST['title']) < 3 || strlen($_POST['title']) > 255)) {
                $errors[] = "Title must be 3-255 characters";
            }
            if (!empty($_POST['description']) && strlen($_POST['description']) < 10) {
                $errors[] = "Description must be at least 10 characters";
            }
            if (!ValidationHelper::validatePrice($_POST['price'] ?? '')) {
                $errors[] = "Price must be a non-negative number";
            }
            if (!empty($_POST['duration_weeks']) && !ValidationHelper::validateDuration($_POST['duration_weeks'])) {
                $errors[] = "Duration must be a positive number";
            }
            if (!ValidationHelper::validateLevel($_POST['level'] ?? '')) {
                $errors[] = "Invalid level selected";
            }
            
            if (empty($errors)) {
                $course = new Course();
                $course->id = $courseId;
                $course->title = ValidationHelper::sanitize($_POST['title']);
                $course->description = ValidationHelper::sanitize($_POST['description']);
                $course->category_id = $_POST['category_id'];
                $course->price = $_POST['price'];
                $course->duration_weeks = $_POST['duration_weeks'] ?? null;
                $course->level = $_POST['level'] ?? null;
                
                // Handle image upload - if null, keep the old image
                $newImage = $this->handleImageUpload($_FILES['image'] ?? null, $courseId);
                if ($newImage !== null) {
                    $course->image = $newImage;
                } else {
                    // Keep old image if no new image uploaded
                    $oldCourse = Course::getCourseById($courseId);
                    $course->image = $oldCourse['image'] ?? null;
                }
                
                $course->update();
                header('Location: ' . BASE_PATH . '/instructor/courses');
                exit;
            } else {
                $error = $errors[0];
                $course = Course::getCourseById($courseId);
                require_once __DIR__ . '/../models/Category.php';
                $categories = Category::getAllCategories();
                require 'views/instructor/course/edit.php';
            }
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
        header('Location: ' . BASE_PATH . '/instructor/courses');
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
            $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'text/plain', 'image/jpeg', 'image/png'];
            if (!in_array($file['type'], $allowedTypes)) {
                echo "Invalid file type.";
                return;
            }
            if ($file['size'] > 50 * 1024 * 1024) { // 50MB
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
                header('Location: ' . BASE_PATH . '/instructor/course/' . $_GET['courseId'] . '/lessons');
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
            throw new Exception('Access denied: Not course owner', 403);
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
            throw new Exception('Access denied: Not course owner', 403);
        }
        
        // Get student info
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT id, fullname as name, email, avatar FROM users WHERE id = ?");
        $stmt->execute([$studentId]);
        $student = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Get enrollment info
        $enrollments = Enrollment::getEnrollmentsByStudent($studentId);
        $enrollment = null;
        foreach ($enrollments as $e) {
            if ($e['course_id'] == $courseId) {
                $enrollment = $e;
                break;
            }
        }
        
        // Get progress
        $progress = [];
        if ($enrollment) {
            $lessons = Lesson::getLessonsByCourse($courseId);
            $progress['total_lessons'] = count($lessons);
            $progress['completed_lessons'] = 0; // TODO: Get from database
            $progress['progress_percentage'] = $progress['total_lessons'] > 0 ? 
                round(($progress['completed_lessons'] / $progress['total_lessons']) * 100) : 0;
            $progress['time_spent'] = 0; // TODO: Get from database
        }
        
        // Get lesson progress
        $lessonProgress = [];
        $lessons = Lesson::getLessonsByCourse($courseId);
        foreach ($lessons as $lesson) {
            $lessonProgress[] = [
                'id' => $lesson['id'],
                'title' => $lesson['title'],
                'description' => $lesson['description'] ?? '',
                'completed' => false, // TODO: Get from database
                'progress_percentage' => 0, // TODO: Get from database
                'last_accessed' => null, // TODO: Get from database
                'time_spent' => 0 // TODO: Get from database
            ];
        }
        
        // Get activities
        $activities = []; // TODO: Get from database
        
        require 'views/instructor/student_progress.php';
    }

    /**
     * Handle image upload for course
     * @param array|null $file File array from $_FILES
     * @param int|null $courseId Course ID for existing courses (to delete old image)
     * @return string|null Image path or null
     */
    private function handleImageUpload($file, $courseId = null) {
        if (!$file || !isset($file['name']) || $file['error'] === UPLOAD_ERR_NO_FILE) {
            return null;
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Upload error: ' . $file['error']);
        }

        // Validate file type
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mimeType, $allowedTypes)) {
            throw new Exception('Invalid file type. Only JPG, PNG, GIF, and WebP are allowed.');
        }

        // Validate file size (5MB max)
        $maxSize = 5 * 1024 * 1024;
        if ($file['size'] > $maxSize) {
            throw new Exception('File size exceeds 5MB limit.');
        }

        // Delete old image if updating
        if ($courseId) {
            $course = Course::getCourseById($courseId);
            if ($course && !empty($course['image'])) {
                $oldImagePath = __DIR__ . '/../' . $course['image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        }

        // Create upload directory if not exists
        $uploadDir = __DIR__ . '/../assets/uploads/courses/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Generate unique filename
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid('course_') . '.' . strtolower($extension);
        $filepath = $uploadDir . $filename;

        // Move file
        if (!move_uploaded_file($file['tmp_name'], $filepath)) {
            throw new Exception('Failed to upload file.');
        }

        return 'assets/uploads/courses/' . $filename;
    }
}
