<?php

require_once 'controllers/HomeController.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/CourseController.php';
require_once 'controllers/EnrollmentController.php';
require_once 'controllers/LessonController.php';
require_once 'controllers/AdminController.php';

$action = $_GET['action'] ?? 'home';

$userRole = $_SESSION['user']['role'] ?? null;

// Instantiate controllers based on role if needed
$authController = new AuthController();
$enrollmentController = new EnrollmentController();
$courseController = new CourseController();
$lessonController = new LessonController();
$adminController = new AdminController();

switch ($action) {
    // Home
    case 'home':
        $homeController = new HomeController();
        $homeController->index();
        break;
    
    // Auth actions (no role check needed)
    case 'login':
        $authController->login();
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'register':
        $authController->register();
        break;
    
    // Student actions
    case 'listCourses':
        $enrollmentController->listCourses();
        break;
    case 'viewCourse':
        $enrollmentController->viewCourse($_GET['id'] ?? null);
        break;
    case 'enrollCourse':
        $enrollmentController->enrollCourse($_GET['courseId'] ?? null);
        break;
    case 'myCourses':
        $enrollmentController->myCourses();
        break;
    case 'studentDashboard':
        $enrollmentController->studentDashboard();
        break;
    case 'trackProgress':
        $enrollmentController->trackProgress($_GET['courseId'] ?? null);
        break;
    case 'viewLesson':
        $enrollmentController->viewLesson($_GET['lessonId'] ?? null);
        break;
    case 'viewEnrolledCourseLessons':
        $enrollmentController->viewEnrolledCourseLessons($_GET['courseId'] ?? null);
        break;
    case 'viewMaterial':
        $enrollmentController->viewMaterial($_GET['materialId'] ?? null);
        break;
    
    
    // Instructor actions
    case 'instructorDashboard':
        $courseController->dashboard();
        break;
    case 'manageCourses':
        $courseController->manageCourses();
        break;
    case 'createCourse':
        $courseController->createCourse();
        break;
    case 'editCourse':
        $courseController->editCourse($_GET['courseId'] ?? null);
        break;
    case 'deleteCourse':
        $courseController->deleteCourse($_GET['courseId'] ?? null);
        break;
    case 'manageLessons':
        $lessonController->manageLessons($_GET['courseId'] ?? null);
        break;
    case 'createLesson':
        $lessonController->createLesson($_GET['courseId'] ?? null);
        break;
    case 'editLesson':
        $lessonController->editLesson($_GET['lessonId'] ?? null);
        break;
    case 'deleteLesson':
        $lessonController->deleteLesson($_GET['lessonId'] ?? null);
        break;
    case 'uploadMaterial':
        $courseController->uploadMaterial($_GET['lessonId'] ?? null);
        break;
    case 'viewEnrolledStudents':
        $courseController->viewEnrolledStudents($_GET['courseId'] ?? null);
        break;
    case 'viewAllStudents':
        $courseController->viewAllStudents();
        break;
    case 'trackStudentProgress':
        $courseController->trackStudentProgress($_GET['courseId'] ?? null, $_GET['studentId'] ?? null);
        break;
    
    // Admin actions
    case 'adminDashboard':
        $adminController->dashboard();
        break;
    case 'manageUsers':
        $adminController->manageUsers();
        break;
    case 'createUser':
        $adminController->createUser();
        break;
    case 'editUser':
        $adminController->editUser($_GET['id'] ?? null);
        break;
    case 'deleteUser':
        $adminController->deleteUser($_GET['id'] ?? null);
        break;
    case 'toggleUserStatus':
        $adminController->toggleUserStatus($_GET['id'] ?? null);
        break;
    case 'manageCategories':
        $adminController->manageCategories();
        break;
    case 'createCategory':
        $adminController->createCategory();
        break;
    case 'editCategory':
        $adminController->editCategory($_GET['id'] ?? null);
        break;
    case 'deleteCategory':
        $adminController->deleteCategory($_GET['id'] ?? null);
        break;
    case 'viewStatistics':
        $adminController->viewStatistics();
        break;
    case 'approveCourses':
        $adminController->approveCourses();
        break;
    case 'approveCourse':
        $adminController->approveCourse($_GET['id'] ?? null);
        break;
    case 'rejectCourse':
        $adminController->rejectCourse($_GET['id'] ?? null);
        break;
    
    default:
        //echo 'Action not found';
        require("views/errors/404.php");
        break;
}
