<?php

require_once 'core/Route.php';

// Require controllers
require_once 'controllers/HomeController.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/CourseController.php';
require_once 'controllers/EnrollmentController.php';
require_once 'controllers/LessonController.php';
require_once 'controllers/AdminController.php';
require_once 'controllers/StudentController.php';
require_once 'controllers/InstructorController.php';

// Home
Route::get('/', 'HomeController', 'index')->name('home');
Route::get('/home', 'HomeController', 'index')->name('home.alt');

// Auth routes
Route::get('/login', 'AuthController', 'login')->name('login');
Route::post('/login', 'AuthController', 'login');
Route::get('/logout', 'AuthController', 'logout')->name('logout');
Route::get('/register', 'AuthController', 'register')->name('register');
Route::post('/register', 'AuthController', 'register');

// Student routes
Route::get('/courses', 'EnrollmentController', 'listCourses')->name('courses.list');
Route::get('/course/{id}', 'EnrollmentController', 'viewCourse')->name('course.view');
Route::post('/course/{courseId}/enroll', 'EnrollmentController', 'enrollCourse')->name('course.enroll');
Route::get('/my-courses', 'EnrollmentController', 'myCourses')->name('my.courses');
Route::get('/dashboard', 'EnrollmentController', 'studentDashboard')->name('student.dashboard');
Route::get('/course/{courseId}/progress', 'EnrollmentController', 'trackProgress')->name('course.progress');
Route::get('/lesson/{lessonId}', 'EnrollmentController', 'viewLesson')->name('lesson.view');
Route::get('/course/{courseId}/lessons', 'EnrollmentController', 'viewEnrolledCourseLessons')->name('course.lessons');
Route::get('/material/{materialId}', 'EnrollmentController', 'viewMaterial')->name('material.view');

// Instructor routes
Route::get('/instructor/dashboard', 'CourseController', 'dashboard')->name('instructor.dashboard');
Route::get('/instructor/courses', 'CourseController', 'manageCourses')->name('instructor.courses');
Route::get('/instructor/course/create', 'CourseController', 'createCourse')->name('course.create');
Route::post('/instructor/course/create', 'CourseController', 'createCourse');
Route::get('/instructor/course/{courseId}/edit', 'CourseController', 'editCourse')->name('course.edit');
Route::post('/instructor/course/{courseId}/edit', 'CourseController', 'editCourse');
Route::post('/instructor/course/{courseId}/delete', 'CourseController', 'deleteCourse')->name('course.delete');
Route::get('/instructor/course/{courseId}/lessons', 'LessonController', 'manageLessons')->name('lessons.manage');
Route::get('/instructor/course/{courseId}/lesson/create', 'LessonController', 'createLesson')->name('lesson.create');
Route::post('/instructor/course/{courseId}/lesson/create', 'LessonController', 'createLesson');
Route::get('/instructor/lesson/{lessonId}/edit', 'LessonController', 'editLesson')->name('lesson.edit');
Route::post('/instructor/lesson/{lessonId}/edit', 'LessonController', 'editLesson');
Route::post('/instructor/lesson/{lessonId}/delete', 'LessonController', 'deleteLesson')->name('lesson.delete');
Route::post('/instructor/lesson/{lessonId}/upload', 'CourseController', 'uploadMaterial')->name('material.upload');
Route::get('/instructor/course/{courseId}/students', 'CourseController', 'viewEnrolledStudents')->name('course.students');
Route::get('/instructor/students', 'CourseController', 'viewAllStudents')->name('students.all');
Route::get('/instructor/course/{courseId}/student/{studentId}/progress', 'CourseController', 'trackStudentProgress')->name('student.progress');

// Admin routes
Route::get('/admin/dashboard', 'AdminController', 'dashboard')->name('admin.dashboard');
Route::get('/admin/users', 'AdminController', 'manageUsers')->name('users.manage');
Route::get('/admin/user/create', 'AdminController', 'createUser')->name('user.create');
Route::post('/admin/user/create', 'AdminController', 'createUser');
Route::get('/admin/user/{id}/edit', 'AdminController', 'editUser')->name('user.edit');
Route::post('/admin/user/{id}/edit', 'AdminController', 'editUser');
Route::post('/admin/user/{id}/delete', 'AdminController', 'deleteUser')->name('user.delete');
Route::post('/admin/user/{id}/toggle', 'AdminController', 'toggleUserStatus')->name('user.toggle');
Route::get('/admin/categories', 'AdminController', 'manageCategories')->name('categories.manage');
Route::get('/admin/category/create', 'AdminController', 'createCategory')->name('category.create');
Route::post('/admin/category/create', 'AdminController', 'createCategory');
Route::get('/admin/category/{id}/edit', 'AdminController', 'editCategory')->name('category.edit');
Route::post('/admin/category/{id}/edit', 'AdminController', 'editCategory');
Route::post('/admin/category/{id}/delete', 'AdminController', 'deleteCategory')->name('category.delete');
Route::get('/admin/statistics', 'AdminController', 'viewStatistics')->name('statistics.view');
Route::get('/admin/courses/approve', 'AdminController', 'approveCourses')->name('courses.approve');
Route::post('/admin/course/{id}/approve', 'AdminController', 'approveCourse')->name('course.approve');
Route::post('/admin/course/{id}/reject', 'AdminController', 'rejectCourse')->name('course.reject');
